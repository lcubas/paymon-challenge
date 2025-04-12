<?php

namespace App\Repositories\Contracts;

interface AcademyRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get academies with their courses.
     *
     * @return mixed
     */
    public function getWithCourses();
}

