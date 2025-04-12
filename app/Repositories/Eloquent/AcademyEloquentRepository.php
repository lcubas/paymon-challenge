<?php

namespace App\Repositories\Eloquent;

use App\Models\Academy;
use App\Repositories\Contracts\AcademyRepositoryInterface;

class AcademyEloquentRepository extends BaseEloquentRepository implements AcademyRepositoryInterface
{
    /**
     * AcademyEloquentRepository constructor.
     *
     * @param Academy $model
     */
    public function __construct(Academy $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getWithCourses()
    {
        return $this->model->with('courses')->get();
    }
}

