<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill_Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_name',
        'description',
    ];

    public function getSkill()
    {
        return $this->belongsTo(Skill::class);
    }
}
