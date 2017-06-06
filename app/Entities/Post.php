<?php

namespace App\Entities;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;
    use CrudTrait;

    protected $fillable = [
        'title',
        'content',
        'image',
        'status',
        'youTube',
        'embeddedCode',
        'date'
    ];

    protected $fieldSearchable = [
        'games.id',
        'title'
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
