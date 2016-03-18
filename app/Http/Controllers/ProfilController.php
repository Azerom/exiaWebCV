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

	public function viewOne($id){

		//get the profil
		$profil = Profil::find($id);
		$profil -> home_msg;
		$profil -> pseudo;
		dd($profil);
		//return view::make('profil.id')->with('id', $id);
	}

    public function add(){

    }
}


