<?php

namespace App\Repositories\Contracts;

interface CourseRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get courses from a specific academy.
     *
     * @param int $academyId
     * @return mixed
     */
    public function getByAcademy(int $academyId);

    /**
     * Get courses with student enrollment count.
     *
     * @return mixed
     */
    public function getWithEnrollmentCount();
}

