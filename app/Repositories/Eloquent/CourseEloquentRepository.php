<?php

namespace App\Repositories\Eloquent;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;

class CourseEloquentRepository extends BaseEloquentRepository implements CourseRepositoryInterface
{
    /**
     * CourseEloquentRepository constructor.
     *
     * @param Course $model
     */
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getByAcademy(int $academyId)
    {
        return $this->model->where('academy_id', $academyId)->get();
    }

    /**
     * @inheritDoc
     */
    public function getWithEnrollmentCount()
    {
        return $this->model->withCount('enrollments')->get();
    }
}
