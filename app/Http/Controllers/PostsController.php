<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Criteria\HotCriteria;
use App\Criteria\QueueCriteria;
use App\Forms\PostForm;
use App\Repositories\GameRepository;
use Backpack\Settings\app\Models\Setting;
use Carbon\Carbon;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilder;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;


class PostsController extends Controller
{

    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display all Hot Posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $pagination = Setting::where('key', 'pagination')->first();
        $this->repository->pushCriteria(HotCriteria::class);
        $posts = $this->repository->paginate($pagination->value);
        return view('posts.hot', compact('posts'));
    }

    /**
     * Display all Posts in Queue
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function queue()
    {
        $pagination = Setting::where('key', 'pagination')->first();
        $this->repository->pushCriteria(QueueCriteria::class);
        $posts = $this->repository->paginate($pagination->value);
        return view('posts.queue', compact('posts'));
    }

    /**
     * Form to non-admin && admin user
     *
     * @param FormBuilder $formBuilder
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create(FormBuilder $formBuilder, PostCreateRequest $request)
    {
        $form = $formBuilder->create(PostForm::class);
        return view('posts.create', [
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(PostForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if (!isset($request->image) && !isset($request->youTube)) {
            return redirect()->back()->withErrors(['message' => 'Video or Image is required'])->withInput();
        }

        $timestamp = date('YmdHis');
        if (isset($request->image)) {
            $image = $request->file('image');
            list($width, $height) = getimagesize($image);
            $originalExtension = $image->getClientOriginalExtension();
        } else {
            $videoCode = Youtube::parseVidFromURL($request->youTube);
            $image = 'https://img.youtube.com/vi/' . $videoCode . '/maxresdefault.jpg';
            $originalExtension = substr($image, strpos($image, 'maxresdefault.') + 14);
            if(!file_exists(public_path($image))){
                return redirect()->back()->withErrors(['message' => 'Change Video'])->withInput();
            }
        }

        $fileNameMedium = $request->title . $timestamp . '.medium.' . $originalExtension;
        $location = public_path('uploads\\' . $fileNameMedium);
        Image::make($image)->fit(config('image.medium_size'))->save($location);

        $fileNameMin = $request->title . $timestamp . '.min.' . $originalExtension;
        $location = public_path('uploads\\' . $fileNameMin);
        Image::make($image)->resize(config('image.small_size'), config('image.small_size'))->save($location);

        $fileNameOriginal = $request->title . $timestamp . '.original.' . $originalExtension;
        $image->move('uploads', $fileNameOriginal);

        if ($originalExtension == 'gif') {
            $fileName = $fileNameOriginal;
        } else {
            if (isset($request->image)) {
                $fileName = $request->title . $timestamp . '.' . $originalExtension;
                $location = public_path('uploads\\' . $fileName);
                Image::make($image)->fit(config('image.large_width'), $height)->save($location);
            } else {
                $fileName = $request->title . $timestamp . '.' . $originalExtension;
                $location = public_path('uploads\\' . $fileName);
                Image::make($image)->fit(config('image.large_width'), '720')->save($location);
            }
        }

        $post = $this->repository->create([
            'title' => $request->title,
            'image' => $fileName,
            'youTube' => $request->youTube,
            'embeddedCode' => $request->embeddedCode,
            'date' => Carbon::now(),
            'user_id' => Auth::user()->id
        ]);

        $this->repository->sync($post->id, 'games', $request->game);

        $response = [
            'message' => 'Post created.',
            'data' => $post->toArray(),
        ];

        return redirect()->route('queue')->with('message', $response['message']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        $post = $this->repository->findByField('title', $title)->first();
        $youTube = Embed::make($post->youTube)->parseUrl();
        if ($youTube) {
            $youTube->setAttribute(['width' => 710]);
            $youTube = $youTube->getHtml();
        }

        $embed = Embed::make($post->embeddedCode)->parseUrl();
        if ($embed) {
            $embed->setAttribute(['width' => 710]);
            $embed = $embed->getHtml();
        }

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $post,
            ]);
        }

        return view('posts.show', [
            'post' => $post,
            'youTube' => $youTube,
            'embed' => $embed
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = $this->repository->find($id);

        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(PostUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $post = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Post updated.',
                'data' => $post->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Post deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Post deleted.');
    }
}
