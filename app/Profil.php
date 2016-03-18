<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public $timestamps = false;
<<<<<<< HEAD

    public function Skill()
    {
        return $this->hasMany('App\Skill', 'id_profil');
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

    public function Experience()
    {
        return $this->hasMany('App\Experience', 'id_profil');
    }
=======
    public function skills()
    {
        return $this->hasMany('App\Skill', 'id_profil');
    }
>>>>>>> origin/master
}



