@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <script type='text/javascript'>
        function addFields(){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("skill-container");
            if(container.childElementCount != 1){
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
        function addExpFields(){

            // Number of inputs to create
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("experience-container");
            if(container.childElementCount != 1){
                var lastSkill = document.getElementById("experience-container").lastElementChild.getAttribute("id").substring(5);

                var number = parseInt(lastSkill) + 1;
            }
            else
            {
                number = parseInt(0);
            }

            alert(number);

            // Append a node with a random text
            container.appendChild(document.createTextNode("Experience " + (number+1)));

            var div = document.createElement("div");
            div.name = "experience" + number;
            container.appendChild(div);

            // Create an <input> element, set its type and name attributes
            var input = document.createElement("input");
            input.type = "text";
            input.name = "experience" + number;
            div.appendChild(input);

            var level = document.createElement("input");
            level.type = "text";
            level.name = "lexperience" + number;
            div.appendChild(level);

            nbskills = document.getElementById("experiencesNb").getAttribute("value");

            document.getElementById("experiencesNb").value = parseInt(nbskills) + parseInt(1);





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
                        {!! Form::open(array('url' => 'foo/bar')) !!}
                        //
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection