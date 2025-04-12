<?php

namespace App\Repositories\Eloquent;

use App\Models\Academy;
use App\Repositories\Contracts\StudentRepositoryInterface;

class StudentEloquentRepository extends BaseEloquentRepository implements StudentRepositoryInterface
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
}

