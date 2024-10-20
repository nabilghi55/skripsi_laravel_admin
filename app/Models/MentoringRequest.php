<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentoringRequest extends Model
{
    use HasFactory;

    protected $table = 'mentoring_requests';

    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'status',
        'schedule_id',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function mentee()
    {
        return $this->belongsTo(Mentee::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
