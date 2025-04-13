<?php

namespace App\UseCases\Course;

use App\Repositories\Contracts\CourseRepositoryInterface;
use App\UseCases\Course\DTOs\CourseFilterDTO;

class GetCoursesUseCase
{
    public function __construct(
        private readonly CourseRepositoryInterface $courseRepository
    ) {}

    public function execute(?CourseFilterDTO $filters = null)
    {
        if (!$filters) {
            return $this->courseRepository->all();;
        }

        return $this->courseRepository->getByCriteria([
            'id' => $filters->courseId,
            'academy_id' => $filters->academyId,
        ]);
    }
}
