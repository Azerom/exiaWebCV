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
		
		//return the id at the view
		return view('profil', ['profil' => $profil]);
	}

    public function modify($id){
        $profil = Profil::find($id);
        dd($profil);
    }
	
	public function delete($id){
		
		//get the profil
        $profil = Profil::find($id);
		
		echo "Profil delete";
		$profil->delete();
		
    }
	
	

    public function add(){

    }
}


