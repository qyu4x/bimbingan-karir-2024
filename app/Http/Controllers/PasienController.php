<?php

namespace App\Http\Controllers;

use App\Helper\Role;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasienRegisterRequest;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{

    public function login(): Response
    {
        return response()
            ->view('pasien.login', [
                'title' => 'Pasien Login'
            ]);
    }

    public function doLogin(LoginRequest $request): Response | RedirectResponse
    {
        $credential = $request->validated();

        if (Auth::attempt($credential)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors([
            'error' => 'Email or password is wrong.',
        ]);
    }

    public function register() : Response
    {
        return response()
            ->view('pasien.register', [
                'title' => 'Pasien Register'
            ]);
    }

    public function doRegister(PasienRegisterRequest $request) : Response | RedirectResponse
    {
        $data = $request->validated();

        if (User::query()->where('email', $data['email'])->first()) {
            return redirect()->back()->withErrors([
                'email' => 'Email Already Registered.',
            ]);
        }

        if (Pasien::query()->where('no_hp', $data['no_hp'])->first()) {
            return redirect()->back()->withErrors([
                'phone_number' => 'Phone Number Already Registered.',
            ]);
        }

        if (Pasien::query()->where('no_ktp', $data['no_ktp'])->first()) {
            return redirect()->back()->withErrors([
                'ktp' => 'Failed to create an account.',
            ]);
        }

        $data['no_rm']  = Pasien::generateMedicalRecordNumber();

        $data['password'] = Hash::make($data['password']);

        $user = new User();
        $user->name = $data['nama'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role = Role::PATIENT;
        $user->save();

        $patient = new Pasien();
        $patient->id_user = $user->id;
        $patient->alamat = $data['alamat'];
        $patient->no_ktp = $data['no_ktp'];
        $patient->no_hp = $data['no_hp'];
        $patient->no_rm = $data['no_rm'];
        $patient->save();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->withErrors([
                'login' => 'Email or password is incorrect.',
            ]);
        }
    }

}
