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
                'label' => 'Title'
            ])
            ->add('image', 'image')
            ->add('youTube', 'text', [
                'label' => 'Youtube'
            ])
            ->add('embeddedCode', 'text', [
                'label' => 'Embedded code (twitch, oddshot etc.)'
            ]);

        $games = Game::all(); // TODO Repository

        foreach ($games as $game) {
            $this
                ->add('game' . $game->id, 'checkbox', [
                    'value' => $game->id,
                    'label' => $game->name
                ]);
        }
    }
}
