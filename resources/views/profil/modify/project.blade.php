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
                        {!! Form::model($profil, array('url' => '/modify/project')) !!}

                        {!! csrf_field() !!}

                        <a href="#" onclick="addFields('project', 'Projet ',
                        ['name', 'description', 'illustration', 'links', 'source'],
                        ['text', 'text', 'text', 'text', 'text'])"class="btn btn-default">Ajouter un champ</a><br><br>

                        <div id="projects-container">
                            <?php $fcount = $profil->Projet->count(); ?>

                            <input type="text" value="{{$fcount}}" id="projectsNb" name="projectsNb3" >
                            @foreach($profil->Projet as $field)
                                <div id="project{{$field->id-1}}">
									<div class="panel panel-default">
											<div class="panel-body">
												<div class="col-sm-4 col-md-6">
													Projet {{$field->id}}
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<input type="text" name="name{{$field->id-1}}" value="{{$field->name}}">
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<input type="text" name="description{{$field->id-1}}" value="{{$field->description}}">
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<input type="text" name="illustration{{$field->id-1}}" value="{{$field->illustration}}">
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<input type="text" name="links{{$field->id-1}}" value="{{$field->links}}">
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<input type="text" name="source{{$field->id-1}}" value="{{$field->source}}">
												</div>
												<div class="clearfix visible-xs"><br></div>
												
												<div class="col-sm-4 col-md-6">
													<a href="#" onclick="deleteField({{$field->id-1}}, 'project')"class="btn btn-default">Delete</a>
												</div>
												<div class="clearfix visible-xs"><br></div>
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