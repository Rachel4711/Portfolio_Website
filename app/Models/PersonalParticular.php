<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalParticular extends Model
{
    use HasFactory;

     protected $fillable = [
        'full_name',
        'title',
        'email',
        'phone',
        'linkedin',
        'github',
        'about_me',
        'profile_image',
        'address',
        'age',
        'gender',
        'nationality',
        'marital_status',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
