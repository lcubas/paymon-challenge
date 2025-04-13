<?php

use App\Livewire\Pages\Academies\AcademyList;
use App\Livewire\Pages\Communications\CreateCommunication;
use App\Livewire\Pages\Enrollments\CreateEnrollment;
use App\Livewire\Pages\Payments\ProcessPayment;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/academies', AcademyList::class)->name('home');
Route::get('/courses/{courseId}/enroll', CreateEnrollment::class)->name('courses.enroll');
Route::get('/communications/create', CreateCommunication::class)->name('communications.create');
Route::get('/payments/{enrollment}/process', ProcessPayment::class)->name('payments.process');
