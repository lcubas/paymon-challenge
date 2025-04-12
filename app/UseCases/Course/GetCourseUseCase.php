<?php

namespace App\UseCases\Course;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Error;

class GetCourseUseCase
{
    public function __construct(
        private CourseRepositoryInterface $courseRepository
    ) {}

    public function execute(int $courseId): Course
    {
        $course = $this->courseRepository->find($courseId);

        if (!$course) {
            throw new Error('El curso solicitado no está disponible.');
        }

        return $course;
    }
}
