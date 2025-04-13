<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Page Header -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('Impulsa el Futuro de tus Hijos') }}</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Descubre las mejores academias y cursos diseñados para el desarrollo integral de tus pequeños') }}
                    </p>
                </div>
            </div>

            <!-- Academies List -->
            @foreach($academies as $academy)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $academy->name }}</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $academy->description }}</p>
                    </div>

                    <!-- Courses Grid -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($academy->courses as $course)
                            <div class="relative bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $course->name }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-100/20 dark:text-green-100">
                                            S/.{{ number_format($course->cost, 2) }}
                                        </span>
                                    </div>

                                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $course->description }}</p>

                                    <div class="mt-4 flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center">
                                            <x-icons.clock class="w-4 h-4 mr-1" />
                                            {{ $course->duration_hours }} horas
                                        </span>
                                        <span class="flex items-center">
                                            <x-icons.academic-cap class="w-4 h-4 mr-1" />
                                            {{ $course->modality }}
                                        </span>
                                    </div>

                                    <div class="mt-6">
                                        <x-primary-button wire:click="startEnrollment({{ $course->id }})">
                                            {{ __('Matricular Ahora') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
