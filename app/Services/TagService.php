<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\TagRepositoryInterface;
use GuzzleHttp\Promise\Create;

class TagService
{
    
    private $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAll()
    {
        return $this->tagRepository->all();
    }

    public function findById($id)
    {
        return $this->tagRepository->findById($id);
    }

    public function create($request)
    {
        return $this->tagRepository->create($request);
    }

}
