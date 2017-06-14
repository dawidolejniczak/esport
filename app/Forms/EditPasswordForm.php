<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class EditPasswordForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password', [
                'label' => 'New Password',
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
