<?php

namespace App\UseCases\Course;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\AcademyRepositoryInterface;
use Exception;

class GetCoursesByAcademyUseCase
{
    protected $courseRepository;
    protected $academyRepository;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        AcademyRepositoryInterface $academyRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->academyRepository = $academyRepository;
    }

    public function execute(int $academyId)
    {
        if (!$this->academyRepository->find($academyId)) {
            throw new Exception('La academia no existe');
        }

        return $this->courseRepository->findByCriteria([
            'academy_id' => $academyId,
        ]);
    }
}

