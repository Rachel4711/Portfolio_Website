<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the educations for the user.
     */
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the personal particulars for the user.
     */
    public function personalParticulars()
    {
        return $this->hasOne(PersonalParticular::class);
    }

    /**
     * Get the objectives for the user.
     */
    public function objectives()
    {
        return $this->hasOne(Objective::class);
    }

    /**
     * Get the experiences for the user.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the extracurriculars for the user.
     */
    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class);
    }

    /**
     * Get the achievements for the user.
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    /**
     * Get the skills for the user.
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Get the projects for the user.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the references for the user.
     */
    public function references()
    {
        return $this->hasMany(Reference::class);
    }
}
