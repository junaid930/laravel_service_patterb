<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

use Auth;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Article $model)
    {
        $this->model = $model;
    }


    public function create(array $payload): ?Model
    {
        $article = Auth::user()->articles()->create($payload);
        $article->tags()->attach($payload['tags']);
        return $article->fresh();
    }

}
