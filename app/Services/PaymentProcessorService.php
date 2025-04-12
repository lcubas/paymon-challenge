<?php

namespace App\Services;

use App\DTOs\Payment\CreatePaymentDTO;
use App\Enums\PaymentMethod;
use Exception;

class PaymentProcessorService
{
    public function processPayment(CreatePaymentDTO $paymentDTO): array
    {
        return match($paymentDTO->paymentMethod) {
            PaymentMethod::CASH => $this->processCashPayment(),
            PaymentMethod::BANK_TRANSFER => $this->processBankTransferPayment(),
            default => throw new Exception('Método de pago no soportado'),
        };
    }

    private function processCashPayment(): array
    {
        // Simulate cash payment processing
        return [
            'success' => true,
            'transaction_id' => 'CASH_' . uniqid(),
        ];
    }

    private function processBankTransferPayment(): array
    {
        // Simulate bank transfer processing
        return [
            'success' => true,
            'transaction_id' => 'TRANSFER_' . uniqid(),
        ];
    }
}
