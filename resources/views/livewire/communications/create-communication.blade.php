<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Envío de Comunicados</h1>
            <p class="text-lg text-emerald-100">Mantén informados a los padres de familia sobre las novedades y actualizaciones importantes</p>
        </div>

        <!-- Communication Form -->
        <div class="bg-gray-800/80 rounded-2xl shadow-lg overflow-hidden border border-emerald-800/40 backdrop-blur-sm">
            <div class="p-6">
                <form wire:submit.prevent="submit" class="space-y-6">
                    <div>
                        <label class="block text-emerald-100 mb-2">Título del Comunicado</label>
                        <input type="text" wire:model="title" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Ingrese el título">
                        @error('title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-emerald-100 mb-2">Mensaje</label>
                        <textarea wire:model="message" rows="4" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Escriba el mensaje del comunicado"></textarea>
                        @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <div>
                                <label class="block text-emerald-100 mb-2">Curso (Opcional)</label>
                                <select
                                    wire:model="courseId"
                                    class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
                                >
                                    <option value="">Elige un curso</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('courseId') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-emerald-100 mb-2">Edad Mínima</label>
                            <input type="number" wire:model="minAge" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Edad mínima">
                            @error('minAge') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-emerald-100 mb-2">Edad Máxima</label>
                            <input type="number" wire:model="maxAge" class="w-full bg-gray-900/40 border border-emerald-700/30 rounded-lg text-white px-4 py-2.5 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Edad máxima">
                            @error('maxAge') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white font-medium rounded-lg hover:bg-emerald-500 transition-all duration-300 shadow-sm hover:shadow-emerald-600/20">
                            Enviar Comunicado
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
