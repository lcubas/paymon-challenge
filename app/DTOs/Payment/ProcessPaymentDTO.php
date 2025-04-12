<?php

namespace App\DTOs;

class ProcessPaymentDTO
{
    public int $paymentId;
    public int $enrollmentId;
    public ?string $transactionReference;
}
