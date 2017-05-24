<?php

namespace App\Forms;

use App\Models\Game;
use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => 'Title',
                'attr' => [
                    'placeholder' => 'Some Title',
                ]
            ])
            ->add('image', 'file', [
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
