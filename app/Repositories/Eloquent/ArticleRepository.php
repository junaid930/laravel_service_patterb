<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;



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



}
