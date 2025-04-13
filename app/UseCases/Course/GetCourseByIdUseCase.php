<?php

namespace App\UseCases\Course;

use App\Repositories\Contracts\CourseRepositoryInterface;

class GetCourseByIdUseCase
{
    public function __construct(
        private readonly CourseRepositoryInterface $courseRepository,
    ) {}

    public function execute(int $courseId)
    {
        return $this->courseRepository->find($courseId);
    }
}
