<?php

namespace App\UseCases\Course\DTOs;

class CourseFilterDTO
{
    public function __construct(
        public ?int $courseId = null,
        public ?int $academyId = null,
    ) {}
}
