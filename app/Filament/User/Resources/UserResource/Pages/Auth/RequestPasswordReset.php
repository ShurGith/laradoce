<?php

namespace App\Filament\User\Resources\UserResource\Pages\Auth;

use App\Filament\User\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class RequestPasswordReset extends ManageRecords
{
    protected static string $resource = UserResource::class;
}
