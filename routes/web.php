<?php

use App\Livewire\Academies\AcademyList;
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
Route::get('/enroll', CreateEnrollment::class)->name('enroll');
