<?php

namespace App\DTOs;

class PaymentDTO
{
    public int $enrollmentId;
    public float $amount;
    public string $method;
    public ?string $transactionReference;
}

