<?php

namespace App\Http\Controllers;

use App\Profil;
use App\Skill;
use App\Field;
use App\Formation;
use App\Projet;
use App\User;
use App\Experience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfilController extends Controller
{
    public function viewAll()
    {
        $profils = Profil::all();
        return view('profil.index', ['profils' => $profils]);
    }

    public function viewOne($id)
    {

        //get the profil
        $profil = Profil::find($id);

        //return the id at the view
        return view('profil', ['profil' => $profil]);
    }

    public function viewSelf(){
        $user = Auth::user();
        $id = $user->id_profil;
        return $this->viewOne($id);
    }

    public function modify()
    {
        if(! Auth::check()){
            return view('errors.401');
        }
        $user = Auth::user();
        $id = $user->id_profil;
        $profil = Profil::find($id);

        if (isset($_POST['pseudo'])) {

            $profil->pseudo = $_POST['pseudo'];
            $profil->home_msg = $_POST['home_msg'];

            $i = 0;
            $count = $_POST['fieldsNb1'];
            $nFields = [];
            $vFields = [];
            $aFields = [];
            while ($count != 0) {

                if (isset($_POST['field' . $i])) {

                    array_push($nFields, $_POST['field' . $i]);
                    array_push($vFields, $_POST['vfield' . $i]);
                    if (isset($_POST['afield' . $i])) {
                        array_push($aFields, $_POST['afield' . $i]);
                    } else {
                        array_push($aFields, "off");
                    }
                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach ($profil->Field as $field) {
                if (in_array($field->name, $nFields)) {
                    if ($field->value != $vFields[$i]) {
                        $field->value = $vFields[$i];
                    }
                    if ($field->access != $aFields[$i]) {
                        $field->access = $aFields[$i];
                    }
                    unset($nFields[$i]);
                    unset($vFields[$i]);
                    unset($aFields[$i]);
                } else {
                    //$profil->skills->splice($profil->skills->search($skill), 1);
                    $field->id_profil = null;
                }
                echo($field->name);
                $i++;
            }

            foreach ($nFields as $nSkill) {
                $field = new Field();
                $field->name = $nSkill;
                $field->id_profil = $id;
                $field->value = $vFields[array_search($nSkill, $nFields)];
                if ($vFields[array_search($nSkill, $nFields)] == "on") {
                    $field->access = 1;
                } else {
                    $field->access = 0;
                }

                $profil->Field->add($field);
                unset($nFields[$i]);
                unset($vFields[$i]);
                unset($aFields[$i]);
            }

            $profil->push();
            return redirect()->route('getModify');
        }


        return view('profil.modify.modify', ['profil' => $profil, 'id' => $id]);

    }

    public function modifySkills()
    {
        if(! Auth::check()){
            return view('errors.401');
        }
        $user = Auth::user();
        $id = $user->id_profil;
        $profil = Profil::find($id);

        if (isset($_POST['skillsNb'])) {

            $i = 0;
            $count = $_POST['skillsNb'];
            $nSkills = [];
            $lSkills = [];
            while ($count != 0) {

                if (isset($_POST['skill' . $i])) {

                    array_push($nSkills, $_POST['skill' . $i]);
                    array_push($lSkills, $_POST['lskill' . $i]);
                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach ($profil->skills as $skill) {
                if (in_array($skill->name, $nSkills)) {
                    if ($skill->level != $lSkills[$i]) {
                        $skill->level = $lSkills[$i];
                    }
                    unset($nSkills[$i]);
                    unset($lSkills[$i]);
                } else {
                    //$profil->skills->splice($profil->skills->search($skill), 1);
                    $skill->id_profil = null;
                }
                echo($skill->name);
                $i++;
            }

            foreach ($nSkills as $nSkill) {
                $skill = new Skill();
                $skill->name = $nSkill;
                $skill->id_profil = $id;
                $skill->level = $lSkills[array_search($nSkill, $nSkills)];
                $profil->skills->add($skill);
                unset($nSkills[$i]);
                unset($lSkills[$i]);
            }

            $profil->push();
            return redirect()->route('getModifySkills');
        } else {

            return view('profil.modify.skills', ['profil' => $profil, 'id' => $id]);
        }
    }

    public function modifyFormations()
    {
        if(! Auth::check()){
            return view('errors.401');
        }
        $user = Auth::user();
        $id = $user->id_profil;
        $profil = Profil::find($id);
        if (isset($_POST['formsNb3'])) {

            $i = 0;
            $count = $_POST['formsNb3'];
            $nForms = [[], [], [], [], []];


            while($count != 0){


                if (isset($_POST['fyear' . $i])) {

                    array_push($nForms[0], $_POST['fyear' . $i]);
                    array_push($nForms[1], $_POST['ftitle' . $i]);
                    array_push($nForms[2], $_POST['fdiploma' . $i]);
                    array_push($nForms[3], $_POST['fplace' . $i]);
                    array_push($nForms[4], $_POST['fdesc' . $i]);
                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach ($profil->Formation as $form) {
                if (in_array($form->title, $nForms[1])) {
                    for ($j = 0; $j <= 4; $j++) {
                        unset($nForms[$j][$i]);
                    }
                } else {
                    //$profil->skills->splice($profil->skills->search($skill), 1);
                    $form->id_profil = null;
                }
                echo($form->title);
                $i++;
            }

            foreach ($nForms[1] as $nForm) {
                $i = array_search($nForm, $nForms[1]);
                $form = new Formation();
                $form->title = $nForm;
                $form->id_profil = $id;
                $form->year = $nForms[0][$i];
                $form->diploma = $nForms[2][$i];
                $form->place = $nForms[3][$i];
                $form->description = $nForms[4][$i];

                $profil->Formation->add($form);
                for ($j = 0; $j <= 4; $j++) {
                    unset($nForms[$j][$i]);
                }
            }

            $profil->push();
            return redirect()->route('getModifyFormations');
        } else {

            return view('profil.modify.formations', ['profil' => $profil, 'id' => $id]);
        }
    }

    public function delete($id)
    {
        if(! Auth::check()){
            return view('errors.401');
        }

        //get the profil
        $profil = Profil::find($id);

        echo "Profil delete";
        $profil->delete();

    }


    public function add()
    {

    }

    public function modifyProject()
    {
        $user = Auth::user();
        $id = $user->id_profil;
        $profil = Profil::find($id);
        if (isset($_POST['projectsNb3'])) {



            $i = 0;
            $count = $_POST['projectsNb3'];
            $nProjects = [[], [], [], [], []];

            while ($count != 0) {

                if (isset($_POST['name' . $i])) {

                    array_push($nProjects[0], $_POST['name' . $i]);
                    array_push($nProjects[1], $_POST['description' . $i]);
                    array_push($nProjects[2], $_POST['illustration' . $i]);
                    array_push($nProjects[3], $_POST['links' . $i]);
                    array_push($nProjects[4], $_POST['source' . $i]);
                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach ($profil->Projet as $project) {
                if (in_array($project->name, $nProjects[0])) {
                    for ($j = 0; $j <= 4; $j++) {
                        unset($nProjects[$j][$i]);
                    }
                } else {

                    $project->id_profil = null;
                }

                $i++;
            }

            foreach ($nProjects[0] as $nProject) {
                $i = array_search($nProject, $nProjects[0]);
                $form = new Projet();
                $form->name = $nProject;
                $form->id_profil = $id;
                $form->description = $nProjects[1][$i];
                $form->illustration = $nProjects[2][$i];
                $form->links = $nProjects[3][$i];
                $form->source = $nProjects[4][$i];

                $profil->Projet->add($form);
                for ($j = 0; $j <= 4; $j++) {
                    unset($nProjects[$j][$i]);
                }
            }

            $profil->push();
            return redirect()->route('getModifyProject');

        }
        else {

            return view('profil.modify.project', ['profil' => $profil, 'id' => $id]);
        }
    }

    public function modifyExperience()
    {
        $user = Auth::user();
        $id = $user->id_profil;
        $profil = Profil::find($id);
        if (isset($_POST['experienceNb3'])) {



            $i = 0;
            $count = $_POST['experienceNb3'];
            $nExperience = [[], [], [], [], []];

            while ($count != 0) {

                if (isset($_POST['year' . $i])) {

                    array_push($nExperience[0], $_POST['year' . $i]);
                    array_push($nExperience[1], $_POST['mission' . $i]);
                    array_push($nExperience[2], $_POST['entreprise' . $i]);
                    array_push($nExperience[3], $_POST['detail_Mission' . $i]);
                    array_push($nExperience[4], $_POST['place' . $i]);
                    $count--;
                }

                $i++;
            }

            $i = 0;
            foreach ($profil->Experiences as $experience) {
                if (in_array($experience->year, $nExperience[0])) {
                    for ($j = 0; $j <= 4; $j++) {
                        unset($nExperience[$j][$i]);
                    }
                } else {

                    $experience->id_profil = null;
                }

                $i++;
            }

            foreach ($nExperience[0] as $nExperiences) {
                $i = array_search($nExperiences, $nExperience[0]);
                $form = new Experience();
                $form->year = $nExperiences;
                $form->id_profil = $id;
                $form->mission = $nExperience[1][$i];
                $form->entreprise = $nExperience[2][$i];
                $form->detail_Mission = $nExperience[3][$i];
                $form->place = $nExperience[4][$i];

                $profil->Experiences->add($form);
                for ($j = 0; $j <= 4; $j++) {
                    unset($nExperience[$j][$i]);
                }
            }

            $profil->push();
            return redirect()->route('getModifyExperience', ['id' => $id]);

        }
        else {

            return view('profil.modify.experience', ['profil' => $profil, 'id' => $id]);
        }



    }


}


