<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfilController extends Controller
{
    public function viewAll(){
        $profils = Profil::all();

        return view('profil.index', ['profils' => $profils]);
    }
}
