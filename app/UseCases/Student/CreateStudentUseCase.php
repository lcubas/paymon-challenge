<?php

namespace App\UseCases\Student;

use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;
use App\Models\Student;
use App\UseCases\Student\DTOs\CreateStudentDTO;
use Exception;

class CreateStudentUseCase
{
    public function __construct(
        private readonly StudentRepositoryInterface $studentRepository,
        private readonly LegalGuardianRepositoryInterface $legalGuardianRepository,
    ) {}

    public function execute(CreateStudentDTO $student): Student
    {
        if (!$this->legalGuardianRepository->find($student->legalGuardianId)) {
            throw new Exception('El tutor legal no existe');
        }

        return $this->studentRepository->create([
            'legal_guardian_id' => $student->legalGuardianId,
            'first_name' => $student->firstName,
            'last_name' => $student->lastName,
            'birth_date' => $student->birthDate,
        ]);
    }
}
