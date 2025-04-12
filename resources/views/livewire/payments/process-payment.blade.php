<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Procesar Pago</h1>
            <p class="text-lg text-emerald-100">Complete los detalles del pago para la matrícula</p>
        </div>

        <!-- Payment Details Card -->
        <div class="bg-gray-800/80 rounded-2xl shadow-lg overflow-hidden border border-emerald-800/40 backdrop-blur-sm mb-8">
            <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 px-6 py-8">
                <div class="max-w-3xl">
                    <h2 class="text-2xl font-bold text-white mb-2">Detalles de la Matrícula</h2>
                    <div class="text-emerald-50">
                        <p>Estudiante: {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</p>
                        <p>Curso: {{ $enrollment->course->name }}</p>
                        <p class="mt-2 text-xl font-semibold">Monto a pagar: S/{{ number_format($enrollment->course->price, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <form wire:submit.prevent="processPayment" class="space-y-6">
                    <div>
                        <label class="block text-emerald-100 mb-2">Método de Pago</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 bg-gray-900/40 rounded-lg border border-emerald-700/30 cursor-pointer hover:border-emerald-500 transition-all duration-300">
                                <input type="radio" wire:model="paymentMethod" value="CASH" class="w-4 h-4 text-emerald-500 bg-gray-900 border-emerald-700/30 focus:ring-emerald-500 focus:ring-offset-0">
                                <span class="ml-3 text-white">Efectivo</span>
                            </label>
                            <label class="flex items-center p-3 bg-gray-900/40 rounded-lg border border-emerald-700/30 cursor-pointer hover:border-emerald-500 transition-all duration-300">
                                <input type="radio" wire:model="paymentMethod" value="BANK_TRANSFER" class="w-4 h-4 text-emerald-500 bg-gray-900 border-emerald-700/30 focus:ring-emerald-500 focus:ring-offset-0">
                                <span class="ml-3 text-white">Transferencia Bancaria</span>
                            </label>
                        </div>
                        @error('paymentMethod') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if($paymentMethod === 'BANK_TRANSFER')
                        <div>
                            <label class="block text-emerald-100 mb-2">Número de Operación</label>
                            <input
                                type="text"
                                wire:model="transactionReference"
                                class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                placeholder="Ingrese el número de operación"
                            >
                            @error('transactionReference') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="pt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('enrollments.show', $enrollment) }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors duration-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-8 py-2.5 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-500 transition-all duration-300 shadow-sm hover:shadow-emerald-600/20">
                            Procesar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mt-4 bg-emerald-900/70 border border-emerald-700/30 text-emerald-100 rounded-xl p-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 bg-red-900/70 border border-red-700/30 text-red-100 rounded-xl p-4">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
