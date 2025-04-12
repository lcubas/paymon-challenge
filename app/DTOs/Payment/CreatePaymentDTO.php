<?php

namespace App\DTOs\Payments;

use App\Enums\PaymentMethod;

class CreatePaymentDTO
{
    public int $enrollmentId;
    public int $amount;
    public PaymentMethod $paymentMethod;
}
