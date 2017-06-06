<?php

namespace App\Http\Controllers;

use App\Criteria\HotCriteria;
use App\Criteria\QueueCriteria;
use App\Forms\PostForm;
use App\Repositories\GameRepository;
use Backpack\Settings\app\Models\Setting;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use Kris\LaravelFormBuilder\FormBuilder;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
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
        $this->repository->pushCriteria(HotCriteria::class);
        $posts = $this->repository->paginate(10);
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
        $this->repository->pushCriteria(app(RequestCriteria::class));
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

    public function create(FormBuilder $formBuilder)
    {
        $games = app(GameRepository::class)->all();
        $form = $formBuilder->create(PostForm::class);
        return view('posts.create', [
            'form' => $form,
            'games' => $games
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

        $image = $request->file('image');
        $fileName = $request->title . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads\\' . $fileName);
        Image::make($image)->resize(863, 486)->save($location);

        $post = $this->repository->create([
            'title' => $request->title,
            'image' => $fileName,
            'youTube' => $request->youTube,
            'embeddedCode' => $request->embeddedCode,
            'date' => Carbon::now()
        ]);

        $this->repository->sync($post->id, 'games', $request->game);

        $response = [
            'message' => 'Post created.',
            'data' => $post->toArray(),
        ];

        return redirect()->back()->with('message', $response['message']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $post,
            ]);
        }

        return view('posts.show', compact('post'));
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
