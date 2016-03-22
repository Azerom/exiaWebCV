<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps = false;

    public function getAccessAttribute($value)
    {
        if($value == 1){
            return true;
        }
        else{
            return false;
        }
    }
}
