<?php

namespace App\UseCases\Payment;

use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\DTOs\Payments\CreatePaymentDTO;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Exception;

class CreatePaymentUseCase
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

    public function execute(CreatePaymentDTO $payment): Payment
    {
        $enrollment = $this->enrollmentRepository->find($payment->enrollmentId);

        if (!$enrollment) {
            throw new Exception('Enrollment not found');
        }

        $payment = $this->paymentRepository->create([
            'enrollment_id' => $payment->enrollmentId,
            'amount' => $enrollment->course->price,
            'payment_method' => $payment->paymentMethod,
            'status' => PaymentStatus::PENDING,
        ]);

        return $payment;
    }
}
