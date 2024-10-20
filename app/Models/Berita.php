<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas'; 
    
    protected $fillable = ['title', 'uploaded_by', 'image', 'content', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug'; // Agar Laravel menggunakan slug untuk route model binding
    }
}
