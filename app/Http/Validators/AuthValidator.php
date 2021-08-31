<?php

namespace App\Http\Validators;

use Validator;

class AuthValidator
{
    private $validations = [
        'register' => [
            'name' => 'required', 
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ],
        'login' => [
            'email' => 'required|email',
            'password' => 'required',
        ],
        'forgot' => [
            'email' => 'required|email',
        ],
        'reset' => [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
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
