<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => 'Title',
                'rules' => 'required|min:5|unique:posts,title',
                'attr' => [
                    'placeholder' => 'Some Title',
                ]
            ])
            ->add('image', 'file', [
                'rules' => 'required',
                'attr' => [
                    'accept' => 'image/*'
                ]
            ])
            ->add('youTube', 'text', [
                'label' => 'Youtube'
            ])
            ->add('embeddedCode', 'text', [
                'label' => 'Embedded code (twitch, oddshot etc.)'
            ])
            ->add('games', 'checkbox', [
                'template' => 'layouts.posts.checkboxes'
            ])
            ->add('submit', 'submit', [
                'label' => 'Add now',
                'attr' => [
                    'class' => 'btn btn-go'
                ]
            ]);
    }
}
