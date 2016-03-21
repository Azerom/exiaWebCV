@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Liste des profils</div>
                    <div class="panel-body">
                        @foreach ($profils as $profil)
						<div class="panel panel-primary">	
								<div class="panel-body"> 
									<h3><a href="{{url('/profil/' . $profil->id)}}" class="btn btn-primary"> {{ $profil->pseudo }}</a></h3>
									<p>{{  $profil->home_msg  }}</p>
									@foreach($profil->skills as $skill)
										<p>{{ $skill->name }} : {{ $skill->level }}</p>
									@endforeach
								</div>
						</div>
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection