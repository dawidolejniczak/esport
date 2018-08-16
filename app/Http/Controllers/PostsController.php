<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Criteria\HotCriteria;
use App\Criteria\QueueCriteria;
use App\Forms\PostForm;
use App\Services\PostService;
use Carbon\Carbon;
use Cohensive\Embed\Facades\Embed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
use Prettus\Validator\Contracts\ValidatorInterface;


class PostsController extends Controller
{

    /**
     * @var PostRepository
     */
    private $repository;

    /**
     * @var PostService
     */
    private $postService;


    /**
     * PostsController constructor.
     * @param PostRepository $repository
     * @param PostService $postService
     */
    public function __construct(PostRepository $repository, PostService $postService)
    {
        $this->repository = $repository;
        $this->postService = $postService;
    }

    /**
     * Display all Hot Posts
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $this->repository->pushCriteria(HotCriteria::class);
        $posts = $this->repository->paginate(25);
        return view('posts.hot', compact('posts'));
    }

    /**
     * @return View
     */
    public function queue(): View
    {
        $this->repository->pushCriteria(QueueCriteria::class);
        $posts = $this->repository->paginate(25);
        return view('posts.queue', compact('posts'));
    }

    /**
     * @param FormBuilder $formBuilder
     * @param PostCreateRequest $request
     * @return View
     */
    public function create(FormBuilder $formBuilder, PostCreateRequest $request): View
    {
        $form = $formBuilder->create(PostForm::class);
        return view('posts.create', [
            'form' => $form,
        ]);
    }

    /**
     * @param PostCreateRequest $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(PostForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if (!isset($request->image) && !isset($request->youTube)) {
            return redirect()->back()->withErrors(['message' => 'Video or Image is required'])->withInput();
        }

        $post = $this->postService->storePost($request);

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
     * @param PostUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
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
        } catch (\Exception $e) {

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
     * @param $id
     * @return \Illuminate\Http\JsonResponse|RedirectResponse
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
