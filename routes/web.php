<?php

use App\Livewire\Pages\Academies\AcademyList;
use App\Livewire\Pages\Communications\CreateCommunication;
use App\Livewire\Pages\Enrollments\CreateEnrollment;
use App\Livewire\Pages\Payments\ProcessPayment;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::view('profile', 'profile')->name('profile');
    Route::view('dashboard', 'dashboard')->middleware('verified')->name('dashboard');

    Route::get('/', fn() => redirect()->route('courses.index'));
    Route::get('/courses', AcademyList::class)->name('courses.index');
    Route::get('/courses/{courseId}/enroll', CreateEnrollment::class)->name('courses.enroll');
    Route::get('/communications/create', CreateCommunication::class)->name('communications.create');

    Route::prefix('admin')->group(function () {
        Route::get('/payments/{enrollment}/process', ProcessPayment::class)->name('payments.process');
    })->name('admin.');
});
