<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_name',
        'organization',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'description',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
