<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PaymentResource;
use App\UseCases\Payment\CreatePaymentUseCase;
use App\UseCases\Payment\DTOs\CreatePaymentDTO;
use App\Http\Requests\Api\CreatePaymentRequest;
use Exception;

class PaymentController extends BaseApiController
{
    public function __construct(
        private readonly CreatePaymentUseCase $createPaymentUseCase
    ) {}

    public function store(CreatePaymentRequest $request)
    {
        try {
            $payment = $this->createPaymentUseCase->execute(
                new CreatePaymentDTO(
                    enrollmentId: $request->enrollment_id,
                    amount: $request->amount,
                    paymentMethod: $request->payment_method
                )
            );

            return $this->respondWithItem(
                new PaymentResource($payment),
                'Payment processed successfully'
            );
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
