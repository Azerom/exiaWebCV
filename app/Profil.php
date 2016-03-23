<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public $timestamps = false;

    public function Experiences()
    {
        return $this->hasMany('App\Experience', 'id_profil');
    }

    public function Projet()
    {
        return $this->hasMany('App\Projet', 'id_profil');
    }

    public function Formation()
    {
        return $this->hasMany('App\Formation', 'id_profil');
    }

    public function Field()
    {
        return $this->hasMany('App\Field', 'id_profil');
    }

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



