<?php

namespace App\UseCases\Enrollment;

use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\DTOs\EnrollmentDTO;
use App\Models\Enrollment;
use Exception;

class CreateEnrollmentUseCase
{
    protected $enrollmentRepository;
    protected $studentRepository;
    protected $courseRepository;

    public function __construct(
        EnrollmentRepositoryInterfacE $enrollmentRepository,
        StudentRepositoryInterface $studentRepository,
        CourseRepositoryInterface $courseRepository
    ) {
        $this->enrollmentRepository = $enrollmentRepository;
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
    }

    public function execute(EnrollmentDTO $enrollment): Enrollment
    {
        $student = $this->studentRepository->find($enrollment->studentId);

        if (!$student) {
            throw new Exception('Student not found');
        }

        $course = $this->courseRepository->find($enrollment->courseId);

        if (!$course) {
            throw new Exception('Course not found');
        }

        $existingEnrollment = $this->enrollmentRepository->findByCriteria([
            'course_id' => $enrollment->courseId,
            'student_id' => $enrollment->studentId,
        ]);

        if ($existingEnrollment) {
            throw new Exception('Enrollment already exists');
        }

        $enrollment = $this->enrollmentRepository->create([
            'course_id' => $enrollment->courseId,
            'student_id' => $enrollment->studentId,
            'enrolled_at' => now(),
            'status' => 'active',
        ]);

        return $enrollment;
    }
}

