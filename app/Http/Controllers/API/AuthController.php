<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\AuthValidator;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;

class AuthController extends Controller
{

    private $authValidator;
    private $userRepository;

    public function __construct(Request $request , UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['register' , 'login'];
        if(in_array($actionName, $actoinNameForValidation)){
            $this->authValidator = new AuthValidator($request , $actionName);
        }
    }

    public function register(Request $request)
    {

        $validator = $this->authValidator->validate();
        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') , $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = $this->userRepository->create($input);

        $success['token'] = $user->createToken('Access-Token')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success , __('common.action_performed' , ['model' => 'User' , 'action' => 'registered']));
    }


    public function login(Request $request)
    {

        $validator = $this->authValidator->validate();

        if($validator->fails()){
            return $this->sendError(__('common.validation_failed') , $validator->errors());
        }

        if(Auth::attempt(['email'=>$request->email , 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('Access-Token')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success , __('common.action_performed' , ['model' => 'User' , 'action' => 'login']));
        }
        return $this->sendError('Unaothorized' , ['error' => __('auth.failed')]);
    }


}
