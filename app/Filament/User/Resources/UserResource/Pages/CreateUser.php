<?php
    
    namespace App\Filament\User\Resources\UserResource\Pages;
    
    use App\Filament\User\Resources\App\Filament\User\UserResource;
    use Filament\Resources\Pages\Page;
    
    class CreateUser extends Page
    {
        protected static string $resource = UserResource::class;
        
        protected static string $view = 'filament.user.resources.app.filament.user.user-resource.pages.create-user';
    }
