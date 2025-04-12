<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\EnrollmentStatus;
use App\Models\Academy;
use App\Models\Communication;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\LegalGuardian;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Academy::factory(2)->has(
            Course::factory(4)
        )->create();

        LegalGuardian::factory(5)->has(
            Student::factory(rand(1, 3))->has(
                Enrollment::factory()
                    ->count(1)
                    ->state(function (array $attributes, \App\Models\Student $student) {
                        return [
                            'course_id' => Course::inRandomOrder()->first()->id,
                        ];
                    })
            )
        )->create();

        Enrollment::with('course')->get()->each(function ($enrollment) {
            if (EnrollmentStatus::COMPLETED === $enrollment->status) {
                Payment::factory()->create([
                    'enrollment_id' => $enrollment->id,
                    'amount' => $enrollment->course?->cost ?? 100,
                    'paid_at' => now(),
                ]);
            }
        });

        Communication::factory(5)->create();
    }
}
