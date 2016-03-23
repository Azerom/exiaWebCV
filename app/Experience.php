<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    public function Skills()
    {
        return $this->belongsToMany('App\Skill', 'experienceskill', 'id_experiences', 'id_competence');
    }

}
