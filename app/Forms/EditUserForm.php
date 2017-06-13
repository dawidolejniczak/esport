<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EditUserForm extends Form
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
                'rules' => 'required|string|email|max:255',
            ])
            ->add('submit', 'submit', [
                'label' => 'Continue',
                'attr' => [
                    'class' => 'btn btn-go'
                ]
            ]);
    }
}
