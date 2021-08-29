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

        if(!count($this->input)){
            foreach ($this->rules as $key => $value) {
                \Log::debug($key);
                $this->input[$key] = '';
                \Log::debug($this->input);

            }
        }
        
    }

    function validate(){
        return Validator::make($this->input, $this->rules);
    }

}
