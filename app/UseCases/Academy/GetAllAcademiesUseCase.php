<?php

namespace App\UseCases\Academy;

use App\Repositories\Contracts\AcademyRepositoryInterface;

class GetAllAcademiesUseCase
{
    protected $academyRepository;

    public function __construct(AcademyRepositoryInterface $academyRepository)
    {
        $this->academyRepository = $academyRepository;
    }

    public function execute(): array
    {
        return $this->academyRepository->all();
    }
}
