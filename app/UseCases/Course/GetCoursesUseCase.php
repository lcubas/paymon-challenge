<?php

namespace App\UseCases\Course;

use App\DTOs\Course\CourseFilterDTO;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class GetCoursesUseCase
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function execute(?CourseFilterDTO $filters = null): Collection
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
