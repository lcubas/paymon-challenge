<?php

namespace App\Livewire\Pages\Enrollments;

use App\Models\Course;
use App\UseCases\Course\GetCourseByIdUseCase;
use App\UseCases\Enrollment\CreateEnrollmentUseCase;
use App\UseCases\Enrollment\DTOs\CreateEnrollmentDTO;
use App\UseCases\Enrollment\DTOs\StudentForCreateEnrollmentDTO;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateEnrollment extends Component
{
    public Course $course;
    public string $firstName = '';
    public string $lastName = '';
    public string $birthDate = '';
    public string $paymentMethod = '';

    protected $rules = [
        'firstName' => 'required|min:2',
        'lastName' => 'required|min:2',
        'birthDate' => 'required|date|before:today',
    ];

    private GetCourseByIdUseCase $getCourseByIdUseCase;
    private CreateEnrollmentUseCase $createEnrollmentUseCase;

    public function boot(
        GetCourseByIdUseCase $getCourseByIdUseCase,
        CreateEnrollmentUseCase $createEnrollmentUseCase,
    ) {
        $this->getCourseByIdUseCase = $getCourseByIdUseCase;
        $this->createEnrollmentUseCase = $createEnrollmentUseCase;
    }

    public function mount(int $courseId)
    {
        $this->course = $this->getCourseByIdUseCase->execute($courseId);
    }

    public function submit()
    {
        $this->validate();

        try {
            $legalGuardian = Auth::user()->legalGuardian;

            if (!$legalGuardian) {
                throw new \Exception('Legal guardian profile not found');
            }

            $student = new StudentForCreateEnrollmentDTO(
                firstName: $this->firstName,
                lastName: $this->lastName,
                birthDate: $this->birthDate,
                legalGuardianId: $legalGuardian->id,
            );

            $enrollment = new CreateEnrollmentDTO(
                courseId: $this->course->id,
                student: $student,
            );

            $this->createEnrollmentUseCase->execute($enrollment);

            return redirect()
                ->route('courses.index')
                ->with('success', 'Matrícula realizada con éxito');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al procesar la matrícula: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.enrollments.create-enrollment');
    }
}
