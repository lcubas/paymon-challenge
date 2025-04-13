<?php

namespace App\UseCases\Student\DTOs;

class CreateStudentDTO
{
    public function __construct(
        public readonly int $legalGuardianId,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $birthDate,
    ) {}
}
