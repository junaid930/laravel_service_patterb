<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ArticleRepositoryInterface;
use GuzzleHttp\Promise\Create;

class ArticleService
{
    
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAll()
    {
        return $this->articleRepository->all(['*'],['tags']);
    }

    public function findById($id)
    {
        return $this->articleRepository->findById($id , ['*'] , ['tags']);
    }

    public function create($request)
    {
        return $this->articleRepository->create($request);
    }

}
