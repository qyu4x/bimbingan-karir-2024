<?php

namespace App\Filament\Resources\PeriksaResource\Pages;

use App\Filament\Resources\PeriksaResource;
use App\Models\Obat;
use App\Models\Periksa;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreatePeriksa extends CreateRecord
{
    protected static string $resource = PeriksaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $totalBiaya = Obat::whereIn('id', $data['obats']);

        $data['biaya_periksa'] = $totalBiaya->sum('harga');

        $this->formData = $data;

        return $data;
    }


    protected function afterCreate(): void
    {
        $periksa = $this->record;
        $obatIds = $this->formData['obats'];

        foreach ($obatIds as $obatId) {
            DB::table('detail_periksas')->insert([
                'periksa_id' => $periksa->id,
                'obat_id' => $obatId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        Log::info("id daftar poli : " . $periksa->id_daftar_poli);
        DB::table('daftar_polis')->where('id', $periksa->id_daftar_poli)
            ->update([
                'status_periksa' => true
            ]);

    }

}
