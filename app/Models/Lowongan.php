<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',        // Nama perusahaan
        'company_logo',        // Logo perusahaan
        'title',               // Judul lowongan
        'salary',              // Gaji (opsional)
        'minimal_pendidikan',  // Minimal pendidikan
        'persyaratan',         // Persyaratan pekerjaan
        'link_url',            // Link pendaftaran
        'tipe_kerja',          // Tipe kerja (WFO, WFH, Hybrid)
        'lokasi',              // Lokasi pekerjaan
    ];
}
