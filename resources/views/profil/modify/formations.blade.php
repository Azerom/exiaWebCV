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
                    <div class="panel-heading">Liste des profils <a href="{{ url('/modify/' . $id) }}">Retourner au profil</a></div>
                    <div class="panel-body">
                        {!! Form::model($profil, array('url' => '/modify/' . $id . '/form')) !!}

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

                        <a href="#" onclick="addFields('form', 'Formation ',
                        ['fyear', 'ftitle', 'fdiploma', 'fplace', 'fdesc'],
                        ['text', 'text', 'text', 'text', 'text'])">Ajouter un champ</a>

                        <div id="forms-container">
                            <?php $fcount = $profil->Formation->count(); ?>
                            Nb : {{$fcount}}
                            <input type="text" value="{{$fcount}}" id="formsNb" name="formsNb3" >
                            @foreach($profil->Formation as $field)


                                <div id="form{{$field->id-1}}">
                                    Formation {{$field->id}}
                                    <a href="#" onclick="deleteField({{$field->id-1}}, 'form')">Delete</a>
                                    <input type="text" name="fyear{{$field->id-1}}" value="{{$field->year}}">
                                    <input type="text" name="ftitle{{$field->id-1}}" value="{{$field->title}}">
                                    <input type="text" name="fdiploma{{$field->id-1}}" value="{{$field->diploma}}">
                                    <input type="text" name="fplace{{$field->id-1}}" value="{{$field->place}}">
                                    <input type="text" name="fdesc{{$field->id-1}}" value="{{$field->description}}">
                                </div>

                            @endforeach

                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Valider
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <a href="{{ url('/modify/' . $id . '/skills') }}">Skills</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection