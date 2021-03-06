<!--
|--------------------------------------------------------------------------
| Display Modify experience informations view.
|--------------------------------------------------------------------------
-->

@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <script type='text/javascript'>
        function addFields(keyword, text, fields, types){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById(keyword + "s-container");
            if(container.childElementCount > 1){
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

                var input = document.createElement("input");
                input.type = types[i];
                input.name = fields[i] + number;
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
                    <div class="panel-heading">
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Modifier mon profil <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/modify') }}">Pseudo</a></li>
                                <li><a href="{{ url('/modify/skills') }}">Skills</a></li>
                                <li><a href="{{ url('/modify/form') }}">Formations</a></li>
                                <li><a href="{{ url('/modify/experience') }}">Experience</a></li>
                                <li><a href="{{ url('/modify/project') }}">Projects</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($profil, array('url' => '/modify/experience')) !!}

                        {!! csrf_field() !!}

                        <a href="#" onclick="addFields('experience', 'Experience ',
                        ['year', 'mission', 'entreprise', 'detail_Mission', 'place'],
                        ['date', 'text', 'text', 'text', 'text'])"class="btn btn-default">Ajouter un champ</a><br><br>

                        <div id="experiences-container">
                            <?php $fcount = $profil->Experiences->count(); ?>

                            <input type="text" value="{{$fcount}}" id="experiencesNb" name="experienceNb3" >

                            @foreach($profil->Experiences as $field)

                                <div id="experience{{$field->id-1}}">
									<div class="panel panel-default">
										<div class="panel-body">
											<div class="col-sm-4 col-md-6">
												Experience {{$field->id}}
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<input type="text" name="year{{$field->id-1}}" value="{{$field->year}}">
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<input type="text" name="mission{{$field->id-1}}" value="{{$field->mission}}">
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<input type="text" name="entreprise{{$field->id-1}}" value="{{$field->entreprise}}">
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<input type="text" name="detail_Mission{{$field->id-1}}" value="{{$field->detail_Mission}}">
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<input type="text" name="place{{$field->id-1}}" value="{{$field->place}}">
											</div>
											<div class="clearfix visible-xs"><br></div>
											<div class="col-sm-4 col-md-6">
												<br><a href="#" onclick="deleteField({{$field->id-1}}, 'experience')"class="btn btn-default">Delete</a>
											</div>
											<div class="col-sm-4 col-md-6">
												<br><a href="{{ url('/modify/expSkills/' . $field->id) }}"class="btn btn-default">Related skills</a>
											</div>
										</div>
									</div>
                                </div>

                            @endforeach

                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-sign-in"></i>Valider
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
						
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection