<?php

namespace App\UseCases\Payment;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\DTOs\PaymentDTO;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Exception;

class ProcessPaymentUseCase
{
    protected $paymentRepository;
    protected $enrollmentRepository;

    public function __construct(
        PaymentRepositoryInterface $paymentRepository,
        EnrollmentRepositoryInterface $enrollmentRepository
    ) {
        $this->paymentRepository = $paymentRepository;
        $this->enrollmentRepository = $enrollmentRepository;
    }

    public function execute(PaymentDTO $payment): Payment
    {
        $enrollment = $this->enrollmentRepository->find($payment->enrollmentId);

        if (!$enrollment) {
            throw new Exception('Enrollment not found');
        }

        if ($payment->amount <= 0) {
            throw new Exception('Payment amount must be positive');
        }

        // TODO: Improve payment processing logic for other payment status and not only paid status
        $payment = $this->paymentRepository->create([
            'enrollment_id' => $payment->enrollmentId,
            'amount' => $payment->amount,
            'method' => $payment->method,
            'paid_at' => now(),
            'status' => PaymentStatus::PAID,
            'transaction_reference' => $payment->transactionReference,
        ]);

        return $payment;
    }
}
