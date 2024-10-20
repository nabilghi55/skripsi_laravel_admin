<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_mentor',
        'keahlian',
        'lulusan_tahun',
        'riwayat_pendidikan',
        'pekerjaan_saat_ini',
        'testimoni',
        'kontak_alumni',
        'foto_alumni',
        'email', 
        'is_approved',
    ];
}
