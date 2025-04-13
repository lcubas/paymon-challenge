<?php

namespace App\UseCases\Enrollment;

use App\Enums\EnrollmentStatus;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\UseCases\Enrollment\DTOs\CreateEnrollmentDTO;
use Error;

class CreateEnrollmentUseCase
{
    public function __construct(
        private readonly CourseRepositoryInterface $courseRepository,
        private readonly StudentRepositoryInterface $studentRepository,
        private readonly EnrollmentRepositoryInterface $enrollmentRepository,
    ) {}

    public function execute(CreateEnrollmentDTO $enrollment)
    {
        $course = $this->courseRepository->find($enrollment->courseId);

        // TODO: Some courses may have a limit of students or any other criteria to be enrolled
        if (!$course) {
            throw new Error('El curso no está disponible.');
        }

        // TODO: Validate if the guardian is authorized to enroll the student
        // TODO: Improve the search criteria and search by truly unique fields like email, phone, etc.
        $student = $this->studentRepository->findOrCreate([
            'first_name' => $enrollment->student->firstName,
            'last_name' => $enrollment->student->lastName,
            'birth_date' => $enrollment->student->birthDate,
            'legal_guardian_id' => $enrollment->student->legalGuardianId,
        ]);

        $existingEnrollment = $this->enrollmentRepository->findByCriteria([
            'course_id' => $enrollment->courseId,
            'student_id' => $student->id,
        ]);

        if ($existingEnrollment) {
            throw new Error('Enrollment already exists');
        }

        return $this->enrollmentRepository->create([
            'student_id' => $student->id,
            'course_id' => $enrollment->courseId,
            'status' => EnrollmentStatus::ACTIVE,
        ]);
    }
}
