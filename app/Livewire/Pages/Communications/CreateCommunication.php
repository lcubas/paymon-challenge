<?php

namespace App\Livewire\Pages\Communications;

use App\UseCases\Communication\DTOs\SendCommunicationDTO;
use App\UseCases\Communication\SendCommunicationUseCase;
use App\UseCases\Course\GetCoursesUseCase;
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
        $courses = $this->getCoursesUseCase->execute();

        if (empty($this->search)) {
            $this->courses = $courses->all();
            return;
        }

        $searchTerm = strtolower($this->search);
        $this->courses = $courses->filter(function($course) use ($searchTerm) {
            return str_contains(strtolower($course->name), $searchTerm) ||
                str_contains(strtolower($course->description), $searchTerm);
        })->values()->all();
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
            // $communicationDTO->title = $this->title;
            // $communicationDTO->message = $this->message;
            // $communicationDTO->courseId = $this->courseId ?: null;
            // $communicationDTO->minAge = $this->minAge ?: null;
            // $communicationDTO->maxAge = $this->maxAge ?: null;

            $sendCommunicationUseCase->execute($communicationDTO);

            session()->flash('message', 'Comunicado enviado exitosamente');
            $this->reset(['title', 'message', 'courseId', 'minAge', 'maxAge']);
        } catch (\Exception $e) {
            session()->flash('error', 'Error al enviar el comunicado: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.communications.create-communication');
    }
}
