<?php

namespace App\Http\Validators;

use Validator;

class TagValidator
{
    private $validations = [
        'store' => [
            'name' => 'required', 
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
