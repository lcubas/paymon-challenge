<?php

namespace App\UseCases\Course;

use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class GetCourseByIdUseCase
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(int $courseId)
    {
        return $this->courseRepository->find($courseId);
    }
}
