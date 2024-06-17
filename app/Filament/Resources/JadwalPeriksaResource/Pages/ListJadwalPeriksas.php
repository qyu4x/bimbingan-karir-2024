<?php

namespace App\Filament\Resources\JadwalPeriksaResource\Pages;

use App\Filament\Resources\JadwalPeriksaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPeriksas extends ListRecords
{
    protected static string $resource = JadwalPeriksaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
