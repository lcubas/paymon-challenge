<?php

use App\Models\User;
use App\UseCases\LegalGuardian\DTOs\RegisterLegalGuardianDTO;
use App\UseCases\LegalGuardian\RegisterLegalGuardianUseCase;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string', 'max:255', 'unique:legal_guardians'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $userValues = collect($validated)->except('phone')->toArray();

        event(new Registered($user = User::create($userValues)));
        app(RegisterLegalGuardianUseCase::class)->execute(new RegisterLegalGuardianDTO(
            name: $validated['name'],
            email: $validated['email'],
            phone: $validated['phone'],
            userId: $user->id,
        ));

        // Auth::login($user);

        $this->redirectIntended(default: route('login', absolute: false), navigate: true);
    }
}; ?>

<div class="min-w-[400px] max-w-[500px] w-full">
    <!-- Title and Description -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Create Your Account') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            {{ __('Join Paymon and start your journey in financial education') }}
        </p>
    </div>

    <div class="text-center mb-4">
        <p class="text-gray-600 dark:text-gray-400">
            {{ __("Already have an account?") }}
            <a class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 font-semibold" href="{{ route('login') }}" wire:navigate>
                {{ __('Sign in here') }}
            </a>
        </p>
    </div>

    <form wire:submit="register" class="bg-white dark:bg-gray-800 shadow-md rounded-lg px-8 pt-6 pb-8">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="text" name="phone" required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Create Account') }}
            </x-primary-button>
        </div>
    </form>
</div>
