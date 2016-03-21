<?php

namespace App\Http\Controllers;

use App\Profil;
use App\Skill;
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

		return view::make('profil.id')->with('id', $id);
	}

    public function modify($id){

        if(isset($_POST['pseudo'])){

            $profil = Profil::find($id);
            $profil->pseudo = $_POST['pseudo'];
            $profil->home_msg = $_POST['home_msg'];


            $i = 0;
            $count = $_POST['skillsNb'];
            $nSkills = [];
            while($count != 0){

                if(isset($_POST['skill' . $i])){

                    array_push($nSkills, $_POST['skill' . $i]);

                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach($profil->skills as $skill){
                if(in_array($skill->name, $nSkills)){
                    unset($nSkills[$i]);
                }
                else{
                    //$profil->skills->splice($profil->skills->search($skill), 1);
                    $skill->id_profil = null;
                }
                echo($skill->name);
                $i++;
            }

            foreach($nSkills as $nSkill){
                $skill = new Skill();
                $skill->name = $nSkill;
                $skill->id_profil = $id;

                $profil->skills->add($skill);
            }

            $profil->push();
            return redirect()->route('getModify', ['id' => $id]);
        }
        $profil = Profil::find($id);

        return view('profil.modify', ['profil' => $profil, 'id' => $id]);
    }

    public function add(){

    }
}


