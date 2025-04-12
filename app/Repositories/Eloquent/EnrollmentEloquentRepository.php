<?php

namespace App\Repositories\Eloquent;

use App\Models\Enrollment;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;

class EnrollmentEloquentRepository extends BaseEloquentRepository implements EnrollmentRepositoryInterface
{
    /**
     * EnrollmentEloquentRepository constructor.
     *
     * @param Enrollment $model
     */
    public function __construct(Enrollment $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function getByStudent(int $studentId)
    {
        return $this->model->where('student_id', $studentId)
            ->with(['course', 'payment'])
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByCourse(int $courseId)
    {
        return $this->model->where('course_id', $courseId)
            ->with(['student', 'payment'])
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getWithDetails(int $id)
    {
        return $this->model->with(['student.legalGuardian', 'course.academy', 'payment'])
            ->find($id);
    }
}
