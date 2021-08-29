<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
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
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}
