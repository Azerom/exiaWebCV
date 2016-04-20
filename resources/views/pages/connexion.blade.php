@extends('layouts.master')

@section('content')
    <div class="container">
        <form role="form">
            <div class="form-group">
                <label for="email">Adresse email :</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Mot de passe:</label>
                <input type="password" class="form-control" id="pwd">
            </div>
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="Connexion" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
