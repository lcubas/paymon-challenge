<?php

namespace App\Repositories\Contracts;

interface EnrollmentRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get enrollments by student.
     *
     * @param int $studentId
     * @return mixed
     */
    public function getByStudent(int $studentId);

    /**
     * Get enrollments by course.
     *
     * @param int $courseId
     * @return mixed
     */
    public function getByCourse(int $courseId);

    /**
     * Get enrollment with student, course and payment details.
     *
     * @param int $id
     * @return mixed
     */
    public function getWithDetails(int $id);
}
