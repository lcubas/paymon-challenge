<?php

namespace App\UseCases\LegalGuardian;

use App\Repositories\Contracts\LegalGuardianRepositoryInterface;
use App\UseCases\LegalGuardian\DTOs\RegisterLegalGuardianDTO;

class RegisterLegalGuardianUseCase
{
    public function __construct(
        private readonly LegalGuardianRepositoryInterface $legalGuardianRepository,
    ) {}

    public function execute(RegisterLegalGuardianDTO $legalGuardian)
    {
        return $this->legalGuardianRepository->create([
            'name' => $legalGuardian->name,
            'email' => $legalGuardian->email,
            'phone' => $legalGuardian->phone,
            'user_id' => $legalGuardian->userId,
        ]);
    }
}
