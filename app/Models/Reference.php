<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'company',
        'phone',
        'email',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }
}
