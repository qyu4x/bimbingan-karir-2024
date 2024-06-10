<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use App\Models\Pasien;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreatePasien extends CreateRecord
{
    protected static string $resource = PasienResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password'])
        ];

        $user = new User($userData);
        $user->save();

        $data['id_user'] = $user->id;
        $data['no_rm'] = Pasien::generateMedicalRecordNumber();

        return $data;
    }
}
