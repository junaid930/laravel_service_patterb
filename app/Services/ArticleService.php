<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ArticleRepositoryInterface;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function all()
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

    public function createWithRelation($request)
    {
        $article = $this->articleRepository->createWithRelation(Auth::user(),'articles',$request);
        return $this->articleRepository->attachRelationWithModel($article,'tags',$request['tags']);
    }

    public function deleteById($request)
    {
        return $this->articleRepository->deleteById($request);
    }
}
