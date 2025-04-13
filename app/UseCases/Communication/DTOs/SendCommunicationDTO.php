<?php

namespace App\UseCases\Communication\DTOs;

class SendCommunicationDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $message,
        public readonly ?int $courseId,
    ) {}
}
