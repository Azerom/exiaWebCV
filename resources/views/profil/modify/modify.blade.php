@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <script type='text/javascript'>
        function addFields(keyword, text, fields, types){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById(keyword + "s-container");
            if(container.childElementCount != 1){
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

            // Append a node with a random text
            div.appendChild(document.createTextNode(text + (number+1)));

            var delLink = document.createElement("a");
            delLink.setAttribute("onclick", "deleteField(" + number + ", '" + keyword + "')");

            delLink.href = "#";
            delLink.innerHTML = "Delete";
            div.appendChild(delLink);




            for(var i = 0; i < fields.length; i++){

                var input = document.createElement("input");
                input.type = types[i];
                input.name = fields[i] + number;
                div.appendChild(input);
            }

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
						Modifier mon profil
						<a href="{{ url('/modify/skills') }}"class="btn btn-default">Skills</a>
						<a href="{{ url('/modify/form') }}"class="btn btn-default">Formations</a>

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

                        <a href="#" onclick="addFields('field', 'Field ', ['field', 'vfield', 'afield'], ['text', 'text', 'checkbox'])" class="btn btn-default">Ajouter un champ</a>
						<br>

                        <div id="fields-container">
							<br>
                            <?php $fcount = $profil->Field->count(); ?>
                            
                            <input type="text" value="{{$fcount}}" id="fieldsNb" name="fieldsNb1" >
                            <p>@foreach($profil->Field as $field)
								<div class="panel panel-default">	
									<div class="panel-body"> 
										<div id="field{{$field->id-1}}">
											Field {{$field->id}}
											<input type="text" name="field{{$field->id-1}}" value="{{$field->name}}">
											<div class="clearfix visible-xs"><br></div>
											<input type="text" name="vfield{{$field->id-1}}" value="{{$field->value}}">
											<input name="afield{{$field->id-1}}" <?php if($field->access){ echo 'checked ="checked"';}?> type="checkbox">
											<div class="clearfix visible-xs"><br></div>
											<a href="#" onclick="deleteField({{$field->id-1}}, 'field')"class="btn btn-default">Delete</a>
										</div>
									</div>
								</div>
                            </p>@endforeach

                        </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-sign-in"></i>Valider
                                </button>
                            </div>
                        {!! Form::close() !!}

                        <a href="{{ url('/modify/skills') }}">Skills</a>
                        <a href="{{ url('/modify/form') }}">Formations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection