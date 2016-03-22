@extends('layouts.app')

        <!-- Main Content -->
@section('content')
    <div class="col-md-8 col-md-offset-2">
    	<br>
		<div class="panel panel-default">	
			<div class="panel-heading">Profil</div>
			 <div class="panel-body"> 
				<p>Profil n°:{{ $profil->id }}</p>
				<p>nom: {{$profil->pseudo}}</p>
			</div>
		</div>	
	</div>
	
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">	
			<div class="panel-heading">Skills</div>
			<div class="panel-body"> 
				<p>@foreach($profil->skills as $skill)
                                <p>{{ $skill->name }} : {{ $skill->level }}</p>
                            @endforeach</p>
			</div>
		</div>	
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">	
			<div class="panel-heading">Experiences</div>
			<div class="panel-body"> 
				<p>@foreach($profil->Experiences as $Experiences)
						<div class="col-sm-4 col-md-6">
							<div class="panel panel-default">	
								<div class="panel-body"> 
									<p> Entreprise : {{ $Experiences->entreprise }}  <br> En : {{ $Experiences->year }} <br> Mission : {{ $Experiences->mission }}<br> Détail de la Mission : {{ $Experiences->detail_Mission }} <br>Place : {{ $Experiences->place }}</p>
								</div>
							</div>
						</div>
						<div class="clearfix visible-xs"><br></div>
					@endforeach</p>
			</div>
		</div>	
	</div>
	
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">	
			<div class="panel-heading">Formation</div>
			<div class="panel-body"> 
				<p>@foreach($profil->Formation as $Formation)
						<div class="col-sm-4 col-md-6">
							<div class="panel panel-default">	
								<div class="panel-body"> 
									<p>{{ $Formation->title }} <br> En : {{ $Formation->year }} <br> {{ $Formation->diploma }} <br> {{ $Formation->place }} <br> {{ $Formation->description }}</p>
								</div>
							</div>
						</div>
						<div class="clearfix visible-xs"><br></div>
					@endforeach</p>
			</div>
		</div>	
	</div>
	
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">	
			<div class="panel-heading">Projet</div>
			<div class="panel-body"> 
				
				<p>@foreach($profil->Projet as $Projet)
						<div class="col-sm-4 col-md-6">
							<div class="panel panel-default">	
								<div class="panel-body"> 
									<div class="col-md-4">
										<IMG SRC="{{ $Projet->illustration }}" ALT="illus">
									</div>
									<div class="clearfix visible-xs"><br></div>
									<div class="col-md-8">
										<p>{{ $Projet->name }} <br> {{ $Projet->description }} <br>  <br> <a href="{{ $Projet->links }}">Lien</a> <br> <a href="{{ $Projet->source }}">Source</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix visible-xs"><br></div>
				@endforeach</p>
				
			</div>
		</div>	
	</div>
	<div class="col-md-8 col-md-offset-2">
		<div>
			<a href="javascript:history.back()" class="btn btn-default">
				<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
			</a>
		</div>
	</div>
@endsection