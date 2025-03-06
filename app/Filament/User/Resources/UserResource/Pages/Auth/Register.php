<?php
    
    namespace App\Filament\User\Resources\UserResource\Pages\Auth;
    
    use App\Mail\UserRegistered;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Mail;
    
    
    class Register
    {
        protected function afterRegister(): void
        {
            $user = $this->getUser(); // Obtener el usuario recién registrado
            
            //Auth::login($user, true);
            
            Log::info("🟢 Usuario registrado en Filament: ".$user->email); // Agregar log
            
            Mail::to($user->email)->send(new UserRegistered($user));
            Mail::to(config('mail.admin_email'))->send(new UserRegistered($user));
        }
    }