<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\NewUserRegistered;
use App\Notifications\WellcomeNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);
        // Enviar email al usuario registrado
        $user->notify(new WellcomeNewUser($user));
        // Enviar email al administrador
        $admin = User::where('id', 1)->first(); // Asegúrate de que tienes un campo is_admin en la tabla users
        if ($admin) {
            $admin->notify(new NewUserRegistered($user));
        }

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
