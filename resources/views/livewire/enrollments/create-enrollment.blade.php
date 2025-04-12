<div class="py-12 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Matrícula del Curso</h1>
            <p class="text-lg text-emerald-100">Complete los datos del estudiante para asegurar su lugar en el curso</p>
        </div>

        <!-- Course Card -->
        <div class="bg-gray-800/80 rounded-2xl shadow-lg overflow-hidden border border-emerald-800/40 backdrop-blur-sm mb-8">
            <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 px-6 py-8">
                <div class="max-w-3xl">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $course->name }}</h2>
                    <p class="text-emerald-50">{{ $course->description }}</p>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 text-sm text-emerald-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $course->duration_hours }} horas
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            {{ $course->modality }}
                        </span>
                    </div>
                    <span class="px-3 py-1 bg-emerald-900/70 text-emerald-200 rounded-full text-sm font-medium shadow-sm">
                        S/{{ number_format($course->cost, 2) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Enrollment Form -->
        <div class="bg-gray-800/80 rounded-2xl shadow-lg overflow-hidden border border-emerald-800/40 backdrop-blur-sm">
            <div class="p-6">
                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-emerald-100 mb-2">Nombres del Estudiante</label>
                            <input type="text" wire:model="firstName" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Nombres">
                            @error('firstName') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-emerald-100 mb-2">Apellidos del Estudiante</label>
                            <input type="text" wire:model="lastName" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Apellidos">
                            @error('lastName') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-emerald-100 mb-2">Fecha de Nacimiento</label>
                            <input type="date" wire:model="birthDate" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                            @error('birthDate') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('home') }}" class="px-6 py-2.5 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors duration-300">
                            Cancelar
                        </a>
                        <button type="submit" class="px-8 py-2.5 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-500 transition-all duration-300 shadow-sm hover:shadow-emerald-600/20">
                            Confirmar Matrícula
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
