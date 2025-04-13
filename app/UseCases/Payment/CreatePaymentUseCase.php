<?php

namespace App\UseCases\Payment;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Services\PaymentProcessorService;
use App\UseCases\Payment\DTOs\CreatePaymentDTO;
use Exception;

class CreatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository,
        protected EnrollmentRepositoryInterface $enrollmentRepository,
        protected PaymentProcessorService $paymentProcessor
    ) {}

    public function execute(CreatePaymentDTO $paymentDTO): Payment
    {
        $enrollment = $this->enrollmentRepository->find($paymentDTO->enrollmentId);

        if (!$enrollment) {
            throw new Exception('Matrícula no encontrada');
        }

        // Process the payment through the payment processor
        $processResult = $this->paymentProcessor->processPayment($paymentDTO);

        if (!$processResult['success']) {
            throw new Exception('Error al procesar el pago');
        }

        // Create payment record
        $payment = $this->paymentRepository->create([
            'enrollment_id' => $paymentDTO->enrollmentId,
            'amount' => $paymentDTO->amount,
            'payment_method' => $paymentDTO->paymentMethod,
            'status' => PaymentStatus::PAID,
            'transaction_reference' => $processResult['transaction_id'],
            'paid_at' => $processResult['processed_at'],
        ]);

        return $payment;
    }
}
