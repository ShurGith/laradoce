<?php

namespace App\Filament\Resources\GeneraloptionsResource\Pages;

use App\Filament\Resources\GeneraloptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGeneraloptions extends EditRecord
{
    protected static string $resource = GeneraloptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
