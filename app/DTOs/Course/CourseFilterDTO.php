<?php

namespace App\DTOs\Course;

class CourseFilterDTO
{
    public function __construct(
        public ?int $courseId = null,
        public ?int $academyId = null,
    ) {}
}
