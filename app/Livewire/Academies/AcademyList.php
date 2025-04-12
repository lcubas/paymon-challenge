<?php

namespace App\Livewire\Academies;

use Livewire\Component;
use App\UseCases\Academy\GetAllAcademiesUseCase;

class AcademyList extends Component
{
    public $academies = [];

    private readonly GetAllAcademiesUseCase $getAllAcademiesUseCase;

    public function boot(GetAllAcademiesUseCase $getAllAcademiesUseCase)
    {
        $this->getAllAcademiesUseCase = $getAllAcademiesUseCase;
    }

    public function mount()
    {
        $this->academies = $this->getAllAcademiesUseCase->execute();
    }

    public function startEnrollment($courseId)
    {
        return redirect()->route('courses.enroll', ['courseId' => $courseId]);
    }

    public function render()
    {
        return view('livewire.academies.academy-list');
    }

    public function layout()
    {
        return 'layouts.guest';
    }
}
