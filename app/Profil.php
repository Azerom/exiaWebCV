<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Profil extends Authenticatable
{
    public $timestamps = false;
    public function skills()
    {
        return $this->hasMany('App\Skill', 'id_profil');
    }

    protected $fillable = [
        'pseudo', 'mdp',
    ];

    protected $hidden = [
        'mdp', 'remember_token',
    ];

    protected $table = 'profils';
}
