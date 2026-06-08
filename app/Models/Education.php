<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_started',
        'year_completed',
        'month_started',
        'month_completed',
        'institution',
        'qualification',
        'field_of_study',
        'cgpa',
        'result',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
