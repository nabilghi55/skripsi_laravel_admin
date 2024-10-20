<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenteeRegistration extends Model
{
    use HasFactory;

    // Specify the table if it differs from the default plural form
    protected $table = 'mentee_registrations';

    // Specify the fillable fields
    protected $fillable = [
        'user_id',
        'mentor_id',
        'angkatan',
        'hal_yang_ingin_ditanyakan',
        'nomor_hp',
        'is_approved',
        'nama',
        'email'
    ];

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to Mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id'); // Atau model lain jika berbeda
    }
}
