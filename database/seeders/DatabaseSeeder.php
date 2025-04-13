<?php

namespace Database\Seeders;

use App\Enums\EnrollmentStatus;
use App\Models\Academy;
use App\Models\Communication;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\LegalGuardian;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Academy::factory(2)->has(
            Course::factory(4)
        )->create();

        User::factory(5)->create()->each(function ($user) {
            LegalGuardian::factory()
                ->for($user)
                ->has(
                    Student::factory()
                        ->count(rand(1, 3)) // rand dentro de la llamada
                        ->has(
                            Enrollment::factory()
                                ->state(function (array $attributes, \App\Models\Student $student) {
                                    return [
                                        'course_id' => Course::inRandomOrder()->first()->id,
                                    ];
                                })
                        )
                )
                ->create();
        });

        Enrollment::with('course')->get()->each(function ($enrollment) {
            if (EnrollmentStatus::COMPLETED === $enrollment->status) {
                Payment::factory()->create([
                    'paid_at' => now(),
                    'enrollment_id' => $enrollment->id,
                    'amount' => $enrollment->course->cost,
                ]);
            }
        });

        Communication::factory(5)->create();
    }
}
