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
                            <h3>{{ $profil->pseudo }}</h3>
                            <p>{{  $profil->home_msg  }}</p>
                            @foreach($profil->skills as $skill)
                                <p>{{ $skill->name }} : {{ $skill->level }}</p>
                            @endforeach
                        @endforeach
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection