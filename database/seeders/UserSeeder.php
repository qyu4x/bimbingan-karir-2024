<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'Neko Hime';
        $admin->email = 'nekohime@gmail.com';
        $admin->role = 'ADMIN';
        $admin->password = Hash::make('neko');

        $admin->save();
    }
}
