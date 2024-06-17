<?php

namespace App\Filament\Resources\DaftarPoliResource\Pages;

use App\Filament\Resources\DaftarPoliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarPoli extends EditRecord
{
    protected static string $resource = DaftarPoliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
