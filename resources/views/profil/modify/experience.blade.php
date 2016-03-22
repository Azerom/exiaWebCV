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
                    <div class="panel-heading">Liste des profils <a href="{{ url('/modify') }}">Retourner au profil</a></div>
                    <div class="panel-body">
                        {!! Form::model($profil, array('url' => '/modify/experience')) !!}

                        {!! csrf_field() !!}

                        <a href="#" onclick="addFields('experience', 'Experience ',
                        ['year', 'mission', 'entreprise', 'detail_Mission', 'place'],
                        ['date', 'text', 'text', 'text', 'text'])">Ajouter un champ</a>

                        <div id="experiences-container">
                            <?php $fcount = $profil->Experiences->count(); ?>
                            Nb : {{$fcount}}
                            <input type="text" value="{{$fcount}}" id="experienceNb" name="experienceNb3" >
                            @foreach($profil->Experiences as $field)


                                <div id="experience{{$field->id-1}}">
                                    Experience {{$field->id}}
                                    <a href="#" onclick="deleteField({{$field->id-1}}, 'experience')">Delete</a>
                                    <input type="text" name="year{{$field->id-1}}" value="{{$field->year}}">
                                    <input type="text" name="mission{{$field->id-1}}" value="{{$field->mission}}">
                                    <input type="text" name="entreprise{{$field->id-1}}" value="{{$field->entreprise}}">
                                    <input type="text" name="detail_Mission{{$field->id-1}}" value="{{$field->detail_Mission}}">
                                    <input type="text" name="place{{$field->id-1}}" value="{{$field->place}}">
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