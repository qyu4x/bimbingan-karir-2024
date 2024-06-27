<?php

namespace App\Filament\Resources\PeriksaResource\Pages;

use App\Filament\Resources\PeriksaResource;
use App\Models\Obat;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditPeriksa extends EditRecord
{
    protected static string $resource = PeriksaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $totalBiaya = Obat::whereIn('id', $data['obats']);

        $data['biaya_periksa'] = $totalBiaya->sum('harga');

        $this->formData = $data;
        return $data;
    }


    protected function afterSave(): void
    {
        $periksa = $this->record;
        $obatIds = $this->formData['obats'];

        $insertValues = [];

        foreach ($obatIds as $obatId) {
            $insertValues[] = [
                'periksa_id' => $periksa->id,
                'obat_id' => $obatId,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::transaction(function () use ($periksa, $insertValues) {
            DB::table('detail_periksas')->where('periksa_id', $periksa->id)->delete();

            // Sisipkan data baru
            DB::table('detail_periksas')->insert($insertValues);
        });

    }
}
