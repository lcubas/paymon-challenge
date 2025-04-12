<?php

namespace App\Repositories\Contracts;

interface LegalGuardianRepositoryInterface extends BaseRepositoryInterface {
    /**
     * Find records based on criteria.
     *
     * @param int $courseId
     * @return mixed
     */
    public function findByCourseId(int $courseId);
}
