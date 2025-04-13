<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\EnrollmentResource;
use App\UseCases\Enrollment\CreateEnrollmentUseCase;
use App\Http\Requests\Api\CreateEnrollmentRequest;
use App\UseCases\Enrollment\DTOs\CreateEnrollmentDTO;
use App\UseCases\Enrollment\DTOs\StudentForCreateEnrollmentDTO;
use Exception;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends BaseApiController
{
    public function __construct(
        private readonly CreateEnrollmentUseCase $createEnrollmentUseCase
    ) {}

    public function store(CreateEnrollmentRequest $request)
    {
        try {
            $enrollment = $this->createEnrollmentUseCase->execute(
                new CreateEnrollmentDTO(
                    courseId: $request->course_id,
                    student: new StudentForCreateEnrollmentDTO(
                        firstName: $request->student_first_name,
                        lastName: $request->student_last_name,
                        birthDate: $request->student_birthdate,
                        legalGuardianId: Auth::id(),
                    ),
                )
            );

            return $this->respondWithItem(
                new EnrollmentResource($enrollment),
                'Enrollment created successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
