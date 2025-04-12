<?php

use App\Livewire\Academies\AcademyList;
use App\Livewire\Communications\CreateCommunication;
use Illuminate\Support\Facades\Route;

use App\Livewire\Enrollments\CreateEnrollment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', AcademyList::class)->name('home');
Route::get('/courses/{courseId}/enroll', CreateEnrollment::class)->name('courses.enroll');
Route::get('/communications/create', CreateCommunication::class)->name('communications.create');
Route::get('/payments/{enrollment}/process', \App\Livewire\Payments\ProcessPayment::class)->name('payments.process');
