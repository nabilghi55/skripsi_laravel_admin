<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'user_id',
        'title',
        'company_name',
        'company_logo',
        'company_description',
        'salary',
        'education',
        'url',
        'requirement',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
