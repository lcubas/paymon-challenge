<?php

namespace App\UseCases\Enrollment\DTOs;

class StudentForCreateEnrollmentDTO
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $birthDate,
        public readonly int $legalGuardianId,
    ) {}
}

