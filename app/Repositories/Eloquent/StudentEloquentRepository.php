<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;

class StudentEloquentRepository extends BaseEloquentRepository implements StudentRepositoryInterface
{
    /**
     * StudentEloquentRepository constructor.
     *
     * @param Student $model
     */
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }
}

