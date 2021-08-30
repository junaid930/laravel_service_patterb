<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserController extends Controller
{
   
    private $userService;

    public function __construct(Request $request , UserService $userService){
        $this->userService = $userService;
    }
   
    public function index()
    {
        $data = $this->userService->getAll();
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'Users' , 'action' => 'fetched']));
    }

    
    public function show(User $user)
    {
        $data = $this->userService->findById($user->id);
        return $this->sendResponse($data , __('common.action_performed' , ['model' => 'User' , 'action' => 'fetched']));
    }

   
    public function update(Request $request, User $user)
    {
        
    }

  
    public function destroy(User $user)
    {
        //
    }
}
