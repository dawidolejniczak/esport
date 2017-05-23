<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PostValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'tile' => 'required|min:10',
            'image' => 'required',
            'youTube' => 'nullable',
            'embeddedCode' => 'nullable'
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
