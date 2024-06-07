<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Dokter;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $user = $this->record;
        $doctor = Dokter::where('id_user', $user->id)->first();
        if ($doctor) {
            $doctor->update([
                'id_poli' => $this->data['id_poli'],
                'no_hp' => $this->data['no_hp'],
                'alamat' => $this->data['alamat'],
            ]);
        } else {
            $doctor = new Dokter();
            $doctor->id_poli = $this->data['id_poli'];
            $doctor->id_user = $user->id;
            $doctor->no_hp = $this->data['no_hp'];
            $doctor->alamat = $this->data['alamat'];

            $doctor->save();
        }
    }
}
