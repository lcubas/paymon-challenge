<?php

namespace App\UseCases\Academy;

use App\Repositories\Contracts\AcademyRepositoryInterface;
use App\UseCases\LegalGuardian\DTOs\CreateAcademyDTO;

class CreateAcademyUseCase
{
    public function __construct(
        private readonly AcademyRepositoryInterface $academyRepository,
    ) {}

    public function execute(CreateAcademyDTO $academy)
    {
        return $this->academyRepository->create([
            'name' => $academy->name,
            'description' => $academy->description,
        ]);
    }
}
