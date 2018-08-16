<?php

namespace App\Http\Controllers;

use App\Forms\EditUserForm;
use App\Forms\UserForm;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Image;

class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     * @param UserService $userService
     */
    public function __construct(UserRepository $repository, UserService $userService)
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $this->repository->pushCriteria(app(RequestCriteria::class));
        $users = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $users,
            ]);
        }

        return view('users.index', compact('users'));
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class);
        return view('users.create', [
            'form' => $form,
        ]);
    }

    /**
     * @param UserCreateRequest $request
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput()->with('dropdown', 'register');
        }

        $fileName = $this->userService->storeImage($request);

        $user = $this->repository->create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $fileName,
            'password' => bcrypt($request->password),
        ]);

        $response = [
            'message' => 'User created.',
            'data' => $user->toArray(),
        ];

        return redirect()->back()->with('message', $response['message']);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }


    /**
     * @param FormBuilder $formBuilder
     * @return View
     */
    public function edit(FormBuilder $formBuilder): View
    {
        $user = $this->repository->find(Auth::user()->id);
        $form = $formBuilder->create(UserForm::class, [
            'model' => $user
        ]);

        return view('users.edit', [
            'form' => $form,
            'user' => $user
        ]);
    }


    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(EditUserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $fileName = $this->userService->storeImage($request);


        $user = $this->repository->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $fileName,
        ], $id);

        $response = [
            'message' => 'User updated.',
            'data' => $user->toArray(),
        ];

        return redirect()->route('posts.index')->with('message', $response['message']);
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
