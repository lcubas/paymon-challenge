<?php

namespace App\UseCases\LegalGuardian\DTOs;

class CreateAcademyDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {}
}
