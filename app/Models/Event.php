<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'waktu', 'lokasi', 'deskripsi', 'gambar'
    ];

    // Relasi ke pendaftaran
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
