@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <script type='text/javascript'>
        function addFields(){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("skill-container");
            if(container.childElementCount != 0){
                var lastSkill = document.getElementById("skill-container").lastElementChild.getAttribute("id").substring(5);

                var number = parseInt(lastSkill) + 1;
            }
            else
            {
                var number = 0;
            }



            // Append a node with a random text
            container.appendChild(document.createTextNode("Skill " + (number+1)));

            var div = document.createElement("div");
            div.name = "skill" + number;
            container.appendChild(div);

            // Create an <input> element, set its type and name attributes
            var input = document.createElement("input");
            input.type = "text";
            input.name = "skill" + number;
            div.appendChild(input);

            var level = document.createElement("input");
            level.type = "text";
            level.name = "lskill" + number;
            div.appendChild(level);

            nbskills = document.getElementById("skillsNb").getAttribute("value");

            document.getElementById("skillsNb").value = parseInt(nbskills) + parseInt(1);





        }
        function deleteField(nb){

            var element = document.getElementById("skill" + nb);
            element.parentNode.removeChild(element);

            nbskills = document.getElementById("skillsNb").getAttribute("value");
            document.getElementById("skillsNb").value = parseInt(nbskills) - parseInt(1);
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des profils</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/modify/' . $id) }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('pseudo') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Pseudo</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="pseudo" value="{{ $profil->pseudo }}">

                                    @if ($errors->has('pseudo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('pseudo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Message d'acceuil</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="home_msg" value="{{ $profil->home_msg }}">

                                </div>
                            </div>


                            <a href="#" onclick="addFields()">Ajouter un skill</a>

                            <div id="skill-container">
                                <?php $count = $profil->skills->count(); ?>
                                <input type="hidden" value="{{$count}}" id="skillsNb" name="skillsNb" >
                                @foreach($profil->skills as $skill)

                                    Skill {{$skill->id}}
                                    <a href="#" onclick="deleteField({{$skill->id-1}})">Delete</a>
                                    <div id="skill{{$skill->id-1}}">
                                        <input type="text" name="skill{{$skill->id-1}}" value="{{$skill->name}}">
                                        <input type="text" name="lskill{{$skill->id-1}}" value="{{$skill->level}}">
                                    </div>

                                @endforeach
                                <?php echo $count ?>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Valider
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection