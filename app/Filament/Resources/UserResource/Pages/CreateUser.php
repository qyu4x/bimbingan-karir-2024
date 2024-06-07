<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helper\Role;
use App\Models\Dokter;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        //$data['role'] = Role::DOCTOR;

        return $data;
    }

    protected function afterCreate(): void
    {
        $user = $this->record;

        if ($user->role === Role::DOCTOR) {
            $doctor = new Dokter();
            $doctor->id_poli = $this->data['id_poli'];
            $doctor->id_user = $user->id;
            $doctor->no_hp = $this->data['no_hp'];
            $doctor->alamat = $this->data['alamat'];

            $doctor->save();
        }
    }


}
