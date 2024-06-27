<?php

namespace App\Filament\Resources\PeriksaResource\Pages;

use App\Filament\Resources\PeriksaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeriksas extends ListRecords
{
    protected static string $resource = PeriksaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
