<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'trx_pendaftaran';
    public $timestamps = false;
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'waktu_registrasi', 'no_registrasi', 'no_rekam_medis', 'nama_pasien', 'jenis_kelamin', 'tanggal_lahir', 'jenis_registrasi', 'layanan',
        'jenis_pembayaran', 'status_registrasi', 'waktu_mulai_pelayanan', 'waktu_selesai_pelayanan', 'petugas_pendaftaran'
    ];
}
