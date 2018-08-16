<?php

namespace App\Http\Controllers;

use App\Forms\EditPasswordForm;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordsController extends Controller
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
     * @param FormBuilder $formBuilder
     * @return View
     */
    public function edit(FormBuilder $formBuilder): View
    {
        $user = $this->repository->find(Auth::user()->id);
        $form = $formBuilder->create(EditPasswordForm::class, [
            'model' => $user
        ]);

        return view('users.editPassword', [
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function update(Request $request, $id, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(EditPasswordForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user = $this->repository->update([
            'password' => bcrypt($request->password)
        ], $id);

        $response = [
            'message' => 'User updated.',
            'data' => $user->toArray(),
        ];

        return redirect()->route('posts.index')->with('message', $response['message']);
    }
}
