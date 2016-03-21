@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <div class="col-md-8 col-md-offset-2">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Profil</div>
			<div class="panel-body"> 
				<p>Profil n°:{{ $profil->id }}</p>
				<p>nom: {{$profil->pseudo}}</p>
			</div>
		</div>				
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@endsection