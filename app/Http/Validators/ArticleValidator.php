<?php

namespace App\Http\Validators;

use Validator;

class ArticleValidator
{
    private $validations = [
        'store' => [
            'title' => 'required', 
            'tags' => 'required|exists:tags,id'
        ],
    ];

    private $input;
    private $rules;

    function __construct($request , $action){
        $this->input = $request->all();
        $this->rules = $this->validations[$action];

    }

    function validate(){
        return Validator::make($this->input, $this->rules);
    }

}
