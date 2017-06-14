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
                'rules' => 'required|min:5|max:100|unique:posts,title',
            ])
            ->add('image', 'file', [
                'attr' => [
                    'accept' => 'image/*'
                ]
            ])
            ->add('youTube', 'text', [
                'label' => 'Youtube',
                'rules' => 'nullable|url',
            ])
            ->add('embeddedCode', 'text', [
                'label' => 'Embedded code (twitch, oddshot etc.)',
                'rules' => 'nullable|url',
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
