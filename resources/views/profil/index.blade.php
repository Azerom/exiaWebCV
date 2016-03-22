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
						<div class="panel panel-default">	
								<div class="panel-body"> 
									<div class="col-xs-6 col-sm-4">
									<h3><a href="{{url('/profil/' . $profil->id)}}" > {{ $profil->pseudo }}</a></h3>
									</div>
									<div class="col-xs-6 col-sm-4">
									<p>{{  $profil->home_msg  }}</p>
									</div>
									<div class="col-xs-6 col-sm-4">
									@foreach($profil->skills as $skill)
										
											<p>{{ $skill->name }} : {{ $skill->level }}</p>
										
									@endforeach
									</div>
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