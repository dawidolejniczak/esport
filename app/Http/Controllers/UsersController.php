<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Forms\UserForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
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
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if ($request->image) {
            $image = $request->file('image');
            $fileName = $request->name . Carbon::now() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads\\' . $fileName);
            Image::make($image)->resize(50, 50)->save($location);
        } else {
            $fileName = NULL;
        }

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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
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
     * Edit My Profile
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(FormBuilder $formBuilder)
    {
        $user = $this->repository->find(Auth::user()->id);
        $form = $formBuilder->create(UserForm::class);
        return view('users.create', [
            'form' => $form,
            'model' => $user,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id, FormBuilder $formBuilder)
    {

        $form = $formBuilder->create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if ($request->image) {
            $image = $request->file('image');
            $fileName = $request->name . Carbon::now() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads\\' . $fileName);
            Image::make($image)->resize(50, 50)->save($location);
        } else {
            $fileName = NULL;
        }


        $user = $this->repository->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $fileName,
            'password' => bcrypt($request->password),
        ], $id);

        $response = [
            'message' => 'User updated.',
            'data' => $user->toArray(),
        ];

        return redirect()->back()->with('message', $response['message']);
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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }
}
