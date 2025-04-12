<?php

namespace App\Livewire\Payments;

use App\DTOs\Payment\CreatePaymentDTO;
use App\Enums\PaymentMethod;
use App\Models\Enrollment;
use App\UseCases\Payment\CreatePaymentUseCase;
use Livewire\Component;
use Illuminate\Validation\Rules\Enum;

class ProcessPayment extends Component
{
    public Enrollment $enrollment;
    public string $paymentMethod = '';
    public ?string $transactionReference = null;

    protected function rules()
    {
        return [
            'paymentMethod' => ['required', new Enum(PaymentMethod::class)],
            'transactionReference' => 'required_if:paymentMethod,' . PaymentMethod::BANK_TRANSFER->value
        ];
    }

    public function mount(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment;
    }

    public function processPayment(CreatePaymentUseCase $createPaymentUseCase)
    {
        $this->validate();

        try {
            $paymentDTO = new CreatePaymentDTO(
                enrollmentId: $this->enrollment->id,
                amount: $this->enrollment->course->price,
                paymentMethod: PaymentMethod::from($this->paymentMethod),
                transactionReference: $this->transactionReference
            );

            $createPaymentUseCase->execute($paymentDTO);

            return redirect()
                ->route('enrollments.show', $this->enrollment)
                ->with('success', 'Pago procesado exitosamente');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.payments.process-payment');
    }
}
