<?php

namespace App\UseCases\Student;

use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Contracts\LegalGuardianRepositoryInterface;
use App\DTOs\StudentDTO;
use App\Models\Student;
use Exception;

class CreateStudentUseCase
{
    protected $studentRepository;
    protected $legalGuardianRepository;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        LegalGuardianRepositoryInterface $legalGuardianRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->legalGuardianRepository = $legalGuardianRepository;
    }

    public function execute(StudentDTO $student): Student
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
