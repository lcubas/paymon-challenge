<?php

namespace App\UseCases\LegalGuardian\DTOs;

class RegisterLegalGuardianDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $userId,
    ) {}
}
