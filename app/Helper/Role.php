<?php

namespace App\Helper;

enum Role : string
{
    case ADMIN = 'ADMIN';
    case PATIENT = 'PASIEN';
    case DOCTOR = 'DOKTER';
}
