<?php

namespace App\UseCases\Academy;

use App\Repositories\Contracts\AcademyRepositoryInterface;

class GetAllAcademiesUseCase
{
    public function __construct(
        private readonly AcademyRepositoryInterface $academyRepository,
    ) {}

    public function execute()
    {
        return $this->academyRepository->getWithCourses();
    }
}
