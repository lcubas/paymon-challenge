<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEloquentRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseEloquentRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id, array $relations = [])
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * @inheritDoc
     */
    public function all(array $relations = [])
    {
        return $this->model->with($relations)->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes)
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($attributes);
            return $model->fresh();
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function findByCriteria(array $criteria, array $relations = [])
    {
        $query = $this->model->with($relations);

        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get();
    }
}

