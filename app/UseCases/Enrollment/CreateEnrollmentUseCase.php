<?php

namespace App\UseCases\Enrollment;

use App\DTOs\CreateEnrollmentDTO;
use App\DTOs\Payments\CreatePaymentDTO;
use App\Enums\EnrollmentStatus;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\UseCases\Payment\CreatePaymentUseCase;
use Error;
use Illuminate\Support\Facades\DB;

class CreateEnrollmentUseCase
{
    private $studentRepository;
    private $courseRepository;
    private $enrollmentRepository;
    private $createPaymentUseCase;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        StudentRepositoryInterface $studentRepository,
        EnrollmentRepositoryInterface $enrollmentRepository,
        CreatePaymentUseCase $createPaymentUseCase
    ) {
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->createPaymentUseCase = $createPaymentUseCase;
    }

    public function execute(CreateEnrollmentDTO $createEnrollment)
    {
        $course = $this->courseRepository->find($createEnrollment->courseId);

        // TODO: Some courses may have a limit of students or any other criteria to be enrolled
        if (!$course) {
            throw new Error('El curso no está disponible.');
        }

        // TODO: Validate if the guardian is authorized to enroll the student
        // TODO: Improve the search criteria and search by truly unique fields like email, phone, etc.
        $student = $this->studentRepository->findOrCreate([
            'first_name' => $createEnrollment->student->firstName,
            'last_name' => $createEnrollment->student->lastName,
            'birth_date' => $createEnrollment->student->birthDate,
        ]);

        $existingEnrollment = $this->enrollmentRepository->findByCriteria([
            'course_id' => $createEnrollment->courseId,
            'student_id' => $student->id,
        ]);

        if ($existingEnrollment) {
            throw new Error('Enrollment already exists');
        }

        DB::beginTransaction();

        try {
            $enrollment = $this->enrollmentRepository->create([
                'student_id' => $student->id,
                'course_id' => $createEnrollment->courseId,
                'status' => EnrollmentStatus::ACTIVE,
            ]);

            $this->createPaymentUseCase->execute(new CreatePaymentDTO(
                $enrollment->id,
                $course->price,
                $createEnrollment->paymentMethod,
            ));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $enrollment;
    }
}
