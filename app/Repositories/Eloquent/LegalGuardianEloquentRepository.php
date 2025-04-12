<?php

namespace App\Repositories\Eloquent;

use App\Models\LegalGuardian;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;

class LegalGuardianEloquentRepository extends BaseEloquentRepository implements LegalGuardianRepositoryInterface
{
    /**
     * LegalGuardianEloquentRepository constructor.
     *
     * @param LegalGuardian $model
     */
    public function __construct(LegalGuardian $model)
    {
        parent::__construct($model);
    }

    public function findByCourseId(int $courseId)
    {
        return $this->model
            ->whereHas('students', function ($query) use ($courseId) {
                $query->whereHas('enrollments', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                });
            })
            ->get();
    }
}

