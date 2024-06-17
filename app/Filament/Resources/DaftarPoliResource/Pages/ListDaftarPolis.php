<?php

namespace App\Filament\Resources\DaftarPoliResource\Pages;

use App\Filament\Resources\DaftarPoliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarPolis extends ListRecords
{
    protected static string $resource = DaftarPoliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
