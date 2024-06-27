<?php

namespace App\Filament\Resources\JadwalPeriksaResource\Pages;

use App\Filament\Resources\JadwalPeriksaResource;
use App\Models\JadwalPeriksa;
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

    protected function mutateFormDataBeforeSave(array $data): array
    {

        if ($data['is_active']) {
            $data['id_dokter'] = auth()->user()->dokter->id;

            JadwalPeriksa::where('id_dokter', $data['id_dokter'])
                ->update(['is_active' => false]);
        }

        return $data;
    }

}
