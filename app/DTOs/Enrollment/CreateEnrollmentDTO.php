<?php

namespace App\DTOs\Enrollment;

class CreateEnrollmentDTO
{
    public function __construct(
        public readonly int $courseId,
        public readonly StudentForCreateEnrollmentDTO $student,
    ) {}
}
