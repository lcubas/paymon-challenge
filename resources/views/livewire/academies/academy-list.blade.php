<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Impulsa el Futuro de tus Hijos</h1>
            <p class="text-lg text-emerald-100">Descubre las mejores academias y cursos diseñados para el desarrollo integral de tus pequeños</p>
        </div>

        <!-- Academies List -->
        <div class="space-y-16">
            @foreach($academies as $academy)
                <div class="bg-gray-800/80 rounded-2xl shadow-lg overflow-hidden border border-emerald-800/40 backdrop-blur-sm">
                    <!-- Academy Header -->
                    <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 px-6 py-8">
                        <div class="max-w-3xl">
                            <h2 class="text-2xl font-bold text-white mb-2">{{ $academy->name }}</h2>
                            <p class="text-emerald-50">{{ $academy->description }}</p>
                        </div>
                    </div>

                    <!-- Courses Grid -->
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($academy->courses as $course)
                                <div class="relative bg-gray-900/40 rounded-xl border border-emerald-700/30 hover:border-emerald-500 hover:shadow-xl hover:shadow-emerald-900/20 transition-all duration-300 overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <div class="relative p-6">
                                        <div class="flex items-start justify-between mb-4">
                                            <h3 class="text-lg font-semibold text-white group-hover:text-emerald-300 transition-colors duration-300">{{ $course->name }}</h3>
                                            <span class="px-3 py-1 bg-emerald-900/70 text-emerald-200 rounded-full text-sm font-medium shadow-sm">
                                                S/{{ number_format($course->cost, 2) }}
                                            </span>
                                        </div>

                                        <p class="text-gray-300 mb-4 line-clamp-2">{{ $course->description }}</p>

                                        <div class="flex items-center gap-4 text-sm text-gray-400 mb-4">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-emerald-100">{{ $course->duration_hours }} horas</span>
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                                <span class="text-emerald-100">{{ $course->modality }}</span>
                                            </span>
                                        </div>

                                        <button wire:click="startEnrollment({{ $course->id }})" class="w-full bg-emerald-700/60 hover:bg-emerald-600/60 text-white font-medium py-2.5 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md group-hover:bg-emerald-600/80">
                                            Matricular Ahora
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
