<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use App\Models\Pasien;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
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

        $this->checkPatientAlreadyExists($userData);

        $user = new User($userData);
        $user->save();

        $data['id_user'] = $user->id;
        $data['no_rm'] = Pasien::generateMedicalRecordNumber();

        return $data;
//        try {
//            $this->checkPatientAlreadyExists($userData);
//
//            $user = new User($userData);
//            $user->save();
//
//            $data['id_user'] = $user->id;
//            $data['no_rm'] = Pasien::generateMedicalRecordNumber();
//
//            return $data;
//        }catch (\Exception $exception) {
//            return Notification::make()
//                ->title($exception->getMessage())
//                ->danger()
//                ->seconds(5)
//                ->persistent();
//        }
    }

    /**
     * @throws \Exception
     */
    function checkPatientAlreadyExists(array $userData) : void {
        if (User::query()->where('email', $userData['email'])->first()) {
            throw new \Exception('Email Already Registered');
        }
    }
}
