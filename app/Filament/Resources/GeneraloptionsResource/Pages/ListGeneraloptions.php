<?php

namespace App\Filament\Resources\GeneraloptionsResource\Pages;

use App\Filament\Resources\GeneraloptionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGeneraloptions extends ListRecords
{
    protected static string $resource = GeneraloptionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
