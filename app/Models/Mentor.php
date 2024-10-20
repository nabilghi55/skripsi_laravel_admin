<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
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
    ];
    // In the Mentor class
    public function mentorRegistration()
    {
        return $this->hasOne(MentorRegistration::class, 'email', 'email');
    }
    public function menteeRequests()
    {
        return $this->hasMany(MenteeRegistration::class, 'mentor_id');
    }

}
