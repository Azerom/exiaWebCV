<!--
|--------------------------------------------------------------------------
| Display Modify profil informations view.
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
                                <li><a href="{{ url('/modify/skills') }}">Compétences</a></li>
                                <li><a href="{{ url('/modify/form') }}">Formations</a></li>
                                <li><a href="{{ url('/modify/experience') }}">Experience</a></li>
                                <li><a href="{{ url('/modify/project') }}">Projects</a></li>
                            </ul>
                        </div>
					</div>
                    <div class="panel-body">
                        {!! Form::model($profil, array('url' => '/modify')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('pseudo') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Pseudo</label>

                                <div class="col-md-6">
                                    {{Form::text('pseudo', null, array('class' => 'form-control'))}}

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
                                    {{Form::text('home_msg', null, array('class' => 'form-control'))}}

                                </div>
                            </div>
                        <a href="#" onclick="addFields('field', 'Field ', ['field', 'vfield', 'afield'], ['text', 'text', 'checkbox'])" class="btn btn-default">Ajouter un champ (titre de la donnée suivi de la valeur)</a>
                        <br>
                        <div id="fields-container">
							<br>
                            <?php $fcount = $profil->Field->count(); ?>
                            
                            <input type="text" value="{{$fcount}}" id="fieldsNb" name="fieldsNb1" >

                            @foreach($profil->Field as $field)
                                <div id="field{{$field->id-1}}">
								    <div class="panel panel-default">
									    <div class="panel-body">
                                            <div class="col-sm-3 col-md-6">
                                                Field {{$field->id}}
                                            </div>
                                            <div class="clearfix visible-xs"><br></div>

                                            <div class="col-sm-3 col-md-6">
                                                <input type="text" name="field{{$field->id-1}}" value="{{$field->name}}">
                                            </div>
                                            <div class="clearfix visible-xs"><br></div>

                                            <div class="col-sm-3 col-md-6">
                                                <input type="text" name="vfield{{$field->id-1}}" value="{{$field->value}}">
                                            </div>
                                            <div class="clearfix visible-xs"><br></div>

                                            <div class="col-sm-3 col-md-6">
                                                <input name="afield{{$field->id-1}}" <?php if($field->access){ echo 'checked ="checked"';}?> type="checkbox">
                                                <br>
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