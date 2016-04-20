@extends('layouts.master')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#monCompte">Mon Compte</a></li>
            <li><a data-toggle="tab" href="#menu1">Profil</a></li>
            <li><a data-toggle="tab" href="#menu2">Message principal</a></li>
            <li><a data-toggle="tab" href="#menu3">Compétences</a></li>
            <li><a data-toggle="tab" href="#menu4">Expérience</a></li>
            <li><a data-toggle="tab" href="#menu5">Formation</a></li>
            <li><a data-toggle="tab" href="#menu6">Projet</a></li>
        </ul>

        <div class="tab-content">
            <div id="monCompte" class="tab-pane fade">
                <h3>Mon Compte</h3>
                <p>Informations sur mon compte</p>
            <div id="menu1" class="tab-pane fade">
                <h3>Profil</h3>
                <p>Informations sur mon profil</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Message principal</h3>
                <p>Informations sur le message principal</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Compétences</h3>
                <p>Informations sur les compétences</p>
            </div>
            <div id="menu4" class="tab-pane fade">
                <h3>Expérience</h3>
                <p>Informations sur mon expérience</p>
            </div>
            <div id="menu5" class="tab-pane fade">
                <h3>Formation</h3>
                <p>Informations sur ma formation</p>
            </div>
            <div id="menu6" class="tab-pane fade">
                <h3>Projet</h3>
                <p>Informations sur mes projets</p>
            </div>
        </div>
    </div>
@endsection
