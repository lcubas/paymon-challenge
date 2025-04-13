<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Course Enrollment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Course Information -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $course->name }}</h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $course->description }}</p>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center">
                                <x-icons.clock class="w-4 h-4 mr-1" />
                                {{ $course->duration_hours }} {{ __('hours') }}
                            </span>
                            <span class="flex items-center">
                                <x-icons.academic-cap class="w-4 h-4 mr-1" />
                                {{ $course->modality }}
                            </span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-200/20 dark:text-green-100">
                            S/{{ number_format($course->cost, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Enrollment Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form wire:submit="submit" class="space-y-6">
                        <div>
                            <x-input-label for="firstName" :value="__('Student First Name')" />
                            <x-text-input wire:model="firstName" id="firstName" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="lastName" :value="__('Student Last Name')" />
                            <x-text-input wire:model="lastName" id="lastName" type="text" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="birthDate" :value="__('Birth Date')" />
                            <x-text-input wire:model="birthDate" id="birthDate" type="date" class="mt-1 block w-full" required />
                            <x-input-error :messages="$errors->get('birthDate')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Confirm Enrollment') }}</x-primary-button>

                            <x-secondary-button href="{{ route('home') }}" wire:navigate>
                                {{ __('Cancel') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Status Messages -->
            @if (session()->has('message'))
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <x-action-message class="mr-3" on="saved">
                        {{ session('message') }}
                    </x-action-message>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <p class="text-sm text-red-600 dark:text-red-400">
                        {{ session('error') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
