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
                    'accept' => 'image/*',
                    'id' => 'imageUpload'
                ]
            ])
            ->add('email', 'text', [
                'label' => 'Email',
                'rules' => 'required|string|email|max:255',
            ])
            ->add('password', 'password', [
                'label' => 'Password',
                'rules' => 'required|string|min:6|confirmed',
                'value' => ''
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Password Confirmation',
                'rules' => 'required|string|min:6',
            ])
            ->add('submit', 'submit', [
                'label' => 'Continue',
                'attr' => [
                    'class' => 'btn btn-go'
                ]
            ]);
    }
}
