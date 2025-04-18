<?php

namespace App\UseCases\Enrollment;

use App\Enums\EnrollmentStatus;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use Exception;

class CancelEnrollmentUseCase
{
    public function __construct(
        private readonly EnrollmentRepositoryInterface $enrollmentRepository,
    ) {}

    public function execute(int $enrollmentId): void
    {
        $enrollment = $this->enrollmentRepository->find($enrollmentId);

        if (!$enrollment) {
            throw new Exception('La matrícula no existe');
        }

        if ($enrollment->status !== EnrollmentStatus::ACTIVE) {
            throw new Exception('La matrícula no está activa');
        }

        $this->enrollmentRepository->update($enrollmentId, ['status' => EnrollmentStatus::DROPPED]);
    }
}
