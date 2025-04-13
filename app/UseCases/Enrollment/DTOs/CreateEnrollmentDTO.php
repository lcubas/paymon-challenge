<?php

namespace App\UseCases\Enrollment\DTOs;

class CreateEnrollmentDTO
{
    public function __construct(
        public readonly int $courseId,
        public readonly StudentForCreateEnrollmentDTO $student,
    ) {}
}
