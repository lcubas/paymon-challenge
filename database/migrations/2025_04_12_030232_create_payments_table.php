<?php

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $paymentMethods = PaymentMethod::values();
        $paymentStatus = PaymentStatus::values();

        Schema::create('payments', function (Blueprint $table) use ($paymentStatus, $paymentMethods) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('method', $paymentMethods);
            $table->timestamp('paid_at')->useCurrent();
            $table->enum('status', $paymentStatus)->default(PaymentStatus::PAID);
            $table->string('transaction_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
