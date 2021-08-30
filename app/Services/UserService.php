<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        return $this->userRepository->all(['*'],['articles','articles.tags']);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id,['*'],['articles','articles.tags']);
    }

    public function create($request)
    {
        return $this->userRepository->create($request);
    }

}
