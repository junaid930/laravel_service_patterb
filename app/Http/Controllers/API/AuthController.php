<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CommonHelper;
use App\Http\Validators\AuthValidator;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use Auth;

class AuthController extends Controller
{

    private $authValidator;
    private $userService;

    public function __construct(Request $request, UserService $userService)
    {
        $this->userService = $userService;
        $CommonHelper = new CommonHelper();
        $actionName = $CommonHelper->getRouteActionName();
        $actoinNameForValidation = ['register', 'login', 'forgot', 'reset'];
        if (in_array($actionName, $actoinNameForValidation)) {
            $this->authValidator = new AuthValidator($request, $actionName);
        }
    }

    public function register(Request $request)
    {

        $validator = $this->authValidator->validate();
        if ($validator->fails()) {
            return $this->sendError(__('common.validation_failed'), 400, $validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = $this->userService->create($input);
        $data['token'] = $user->createToken('Access-Token')->accessToken;
        $data['name'] = $user->name;
        return $this->sendResponse(__('common.action_performed', ['model' => 'User', 'action' => 'registered']), 201, $data);
    }


    public function login(Request $request)
    {

        $validator = $this->authValidator->validate();
        if ($validator->fails()) {
            return $this->sendError(__('common.validation_failed'), 400, $validator->errors());
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('Access-Token')->accessToken;
            $data['name'] = $user->name;
            return $this->sendResponse(__('common.action_performed', ['model' => 'User', 'action' => 'login']), 200, $data);
        }
        return $this->sendError('Unauthorized', 401, ['error' => __('auth.failed')]);
    }


    public function profile()
    {
        $data = Auth::user();
        return $this->sendResponse(__('common.action_performed', ['model' => 'User', 'action' => 'fetched']), 200, $data);
    }


    public function forgot(Request $request)
    {
        $validator = $this->authValidator->validate();
        if ($validator->fails()) {
            return $this->sendError(__('common.validation_failed'), 400, $validator->errors());
        }
        $user = User::where('email', '=', $request->input('email'))->first();
        if (!$user) {
            return $this->sendError(__('common.not_found', ['resouce' => 'User']), 405);
        }
        Password::sendResetLink($request->all());
        return $this->sendResponse(__('passwords.sent'), 200);
    }


    public function reset(Request $request)
    {
        $validator = $this->authValidator->validate();
        if ($validator->fails()) {
            return $this->sendError(__('common.validation_failed'), 400, $validator->errors());
        }
        $reset_password_status = Password::reset($request->all(), function ($user, $password) {
            $user['password'] = bcrypt($password);
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->sendError(__('passwords.token'), 401);
        }
        return $this->sendResponse(__('passwords.reset'), 200);
    }
}
