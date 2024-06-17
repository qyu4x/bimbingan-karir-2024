<?php

namespace App\Filament\Resources\JadwalPeriksaResource\Pages;

use App\Filament\Resources\JadwalPeriksaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPeriksa extends EditRecord
{
    protected static string $resource = JadwalPeriksaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
