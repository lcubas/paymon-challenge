<?php

namespace App\Livewire\Pages\Communications;

use App\UseCases\Communication\DTOs\SendCommunicationDTO;
use App\UseCases\Communication\SendCommunicationUseCase;
use App\UseCases\Course\GetCoursesUseCase;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateCommunication extends Component
{
    public $title = '';
    public $message = '';
    public $courseId = '';
    public $minAge = '';
    public $maxAge = '';

    public $courses = [];

    protected $rules = [
        'title' => 'required|min:3',
        'message' => 'required|min:10',
        'courseId' => 'nullable|exists:courses,id',
        'minAge' => 'nullable|numeric|min:0',
        'maxAge' => 'nullable|numeric|min:0|gte:minAge',
    ];

    private GetCoursesUseCase $getCoursesUseCase;

    public function boot(GetCoursesUseCase $getCoursesUseCase)
    {
        $this->getCoursesUseCase = $getCoursesUseCase;
    }

    public function mount()
    {
        $this->courses = $this->getCoursesUseCase->execute();
    }

    public function updatedSearch()
    {
        $this->loadCourses();
    }

    private function loadCourses()
    {
        $this->courses = $this->getCoursesUseCase->execute();
    }

    public function submit(SendCommunicationUseCase $sendCommunicationUseCase)
    {
        $this->validate();

        try {
            $communicationDTO = new SendCommunicationDTO(
                title: $this->title,
                message: $this->message,
                courseId: $this->courseId,
            );

            $sendCommunicationUseCase->execute($communicationDTO);

            session()->flash('message', 'Comunicado enviado exitosamente');
            $this->reset(['title', 'message', 'courseId', 'minAge', 'maxAge']);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al enviar el comunicado: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.communications.create-communication');
    }
}
