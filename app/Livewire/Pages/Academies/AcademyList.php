<?php

namespace App\Livewire\Pages\Academies;

use Livewire\Component;
use App\UseCases\Academy\GetAllAcademiesUseCase;
use Livewire\Attributes\Layout;

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

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.pages.academies.academy-list');
    }
}
