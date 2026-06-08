<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'title',
        'issuer',
        'description',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
