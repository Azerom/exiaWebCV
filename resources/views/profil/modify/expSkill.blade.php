@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <script type='text/javascript'>
        function addFields(keyword, text, fields, types){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById(keyword + "s-container");
            if(container.childElementCount > 2){
                var lastField = document.getElementById(keyword + "s-container").lastElementChild.getAttribute("id").substring(keyword.length);

                var number = parseInt(lastField) + 1;
            }
            else
            {
                var number = 0;
            }

            var div = document.createElement("div");
            div.name = keyword + number;
            div.id = keyword + number;
            container.appendChild(div);

            var div2 = document.createElement("div");
            div2.classList.add("panel");
            div2.classList.add("panel-default");
            div.appendChild(div2);

            var div3 = document.createElement("div");
            div3.classList.add("panel-body");
            div2.appendChild(div3);

            // Append a node with a random text
            var div = document.createElement("div");
            div.classList.add("col-sm-3");
            div.classList.add("col-md-6");
            div.appendChild(document.createTextNode(text + (number+1)));
            div3.appendChild(div);

            for(var i = 0; i < fields.length; i++){

                var div = document.createElement("div");
                div.classList.add("col-sm-3");
                div.classList.add("col-md-6");

                var model = document.getElementById("model");

                var input = model.cloneNode(true)
                input.name = fields[i] + number;
                input.id = fields[i] + number;
                input.hidden = false;
                div.appendChild(input);
                div3.appendChild(div);



            }

            var delLink = document.createElement("a");
            delLink.setAttribute("onclick", "deleteField(" + number + ", '" + keyword + "')");
            delLink.href = "#";
            delLink.innerHTML = "Delete";
            delLink.classList.add("btn");
            delLink.classList.add("btn-default");

            var div = document.createElement("div");
            div.classList.add("col-sm-3");
            div.classList.add("col-md-6");

            div.appendChild(delLink);
            div3.appendChild(div);

            fieldsNb = document.getElementById(keyword + "sNb").getAttribute("value");

            document.getElementById(keyword + "sNb").value = parseInt(fieldsNb) + parseInt(1);

        }

        function deleteField(nb, keyword){

            var element = document.getElementById(keyword + nb);
            element.parentNode.removeChild(element);

            nbsfields = document.getElementById(keyword + "sNb").getAttribute("value");
            document.getElementById(keyword + "sNb").value = parseInt(nbsfields) - parseInt(1);
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"> <a href="{{ url('/modify') }}">Modifier mon profil</a>
                        <a href="{{ url('/modify/skills') }}"class="btn btn-default">Skills</a>
                        <a href="{{ url('/modify/form') }}"class="btn btn-default">Formations</a>
                        <a href="{{ url('/modify/experience') }}"class="btn btn-default">Experience</a>
                        <a href="{{ url('/modify/project') }}"class="btn btn-default">Projects</a>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($profil, array('url' => '/modify/expSkills/' . $id)) !!}

                        {!! csrf_field() !!}

                        <a href="#" onclick="addFields('field', 'Skill ', ['field'], ['select'])" class="btn btn-default">Ajouter un champ</a>
                        <br>

                        <select hidden id="model">
                            @foreach($profil->skills as $skill)
                                <option value="{{$skill->id}}" >{{$skill->name}}</option>
                            @endforeach
                        </select>

                        <div id="fields-container">
                            <br>
                            <?php $fcount = $profil->Field->count();
                                $exp = \App\Experience::find($id);
                            ?>

                            <input type="text" value="{{$fcount}}" id="fieldsNb" name="fieldsNb1" >

                            @foreach($exp->Skills as $field)
                                <div id="field{{$field->id}}">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="col-sm-3 col-md-6">
                                                Skill {{$field->id}}
                                            </div>

                                            <div class="col-sm-3 col-md-6">
                                                <select name="field{{$field->id}}">
                                                    @foreach($profil->skills as $skill)
                                                    <option @if($skill->id == $field->id) selected @endif value="{{$skill->id}}" >{{$skill->name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-3 col-md-6">
                                                <a href="#" onclick="deleteField({{$field->id-1}}, 'field')"class="btn btn-default">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-sign-in"></i>Valider
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection