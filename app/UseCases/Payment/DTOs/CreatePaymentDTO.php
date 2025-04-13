<?php

namespace App\UseCases\Payment\DTOs;

use App\Enums\PaymentMethod;

class CreatePaymentDTO
{
    public function __construct(
        public readonly int $enrollmentId,
        public readonly float $amount,
        public readonly PaymentMethod $paymentMethod,
        public readonly ?string $transactionReference = null
    ) {}
}
