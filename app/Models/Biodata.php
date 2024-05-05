<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Biodata extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    protected $table = 'biodata';
    protected $fillable = [
        'nik',
        'nama',
        'jekel',
        'tempat_lahir',
        'tgl_lahir',
        'idpekerjaan',
        'agama',
        'kota',
        'kecamatan',
        'desa',
        'alamat',
        'warganegara',
        'status_nikah',
        'status_warga',
        'rt',
        'rw',
        'alamat',
        'telepon',
        'email',
        'kodepos',
        'website',
        'password',
        'role',
        'foto_ktp',
        'foto_kk',
        'status',
    ];
}
