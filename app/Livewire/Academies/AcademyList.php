<?php

namespace App\Livewire\Academies;

use Livewire\Component;
use App\UseCases\Academy\GetAllAcademiesUseCase;

class AcademyList extends Component
{
    public $academies = [];

    public function mount(GetAllAcademiesUseCase $getAllAcademiesUseCase)
    {
        $this->academies = $getAllAcademiesUseCase->execute();
    }

    public function startEnrollment($courseId)
    {
        return redirect()->route('enroll', ['courseId' => $courseId]);
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
