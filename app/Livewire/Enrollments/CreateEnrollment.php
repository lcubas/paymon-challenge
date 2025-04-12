<?php

namespace App\Livewire\Enrollments;

use App\DTOs\Enrollment\CreateEnrollmentDTO;
use App\DTOs\Enrollment\StudentForCreateEnrollmentDTO;
use App\Enums\PaymentMethod;
use App\Models\Course;
use App\UseCases\Course\GetCourseUseCase;
use App\UseCases\Enrollment\CreateEnrollmentUseCase;
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
        'paymentMethod' => 'required|in:CASH,BANK_TRANSFER'
    ];

    private GetCourseUseCase $getCourseUseCase;
    private CreateEnrollmentUseCase $createEnrollmentUseCase;

    public function mount(
        GetCourseUseCase $getCourseUseCase,
        CreateEnrollmentUseCase $createEnrollmentUseCase
    ) {
        $this->getCourseUseCase = $getCourseUseCase;
        $this->createEnrollmentUseCase = $createEnrollmentUseCase;

        $courseId = request()->get('courseId');
        $this->course = $this->getCourseUseCase->execute($courseId);
    }

    public function submit()
    {
        $this->validate();

        try {
            $studentDTO = new StudentForCreateEnrollmentDTO(
                firstName: $this->firstName,
                lastName: $this->lastName,
                birthDate: $this->birthDate
            );

            $enrollmentDTO = new CreateEnrollmentDTO(
                courseId: $this->course->id,
                student: $studentDTO,
                paymentMethod: PaymentMethod::from($this->paymentMethod)
            );

            $this->createEnrollmentUseCase->execute($enrollmentDTO);

            session()->flash('message', 'Matrícula realizada con éxito');
            return redirect()->route('home');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al procesar la matrícula: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.enrollments.create-enrollment');
    }
}
