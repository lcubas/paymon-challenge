<?php

namespace App\DTOs;

use App\Enums\PaymentMethod;

class CreateEnrollmentDTO
{
    public int $courseId;
    public int $legalGuardianId;
    public PaymentMethod $paymentMethod;
    public StudentForCreateEnrollmentDTO $student;
}
