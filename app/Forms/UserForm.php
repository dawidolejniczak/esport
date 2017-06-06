<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Login',
                'rules' => 'required|string|max:100',
            ])
            ->add('image', 'file', [
                'attr' => [
                    'accept' => 'image/*'
                ]
            ])
            ->add('email', 'text', [
                'label' => 'Email',
                'rules' => 'required|string|email|max:255|unique:users',
            ])
            ->add('password', 'password', [
                'label' => 'Password',
                'rules' => 'required|string|min:6|confirmed',
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Password Confirmation',
                'rules' => 'required|string|min:6'
            ])
            ->add('submit', 'submit', [
                'label' => 'Register',
                'attr' => [
                    'class' => 'btn btn-go'
                ]
            ]);
    }
}
