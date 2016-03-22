<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Titre de page</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <!--    <style>
                body {
                    font-family: 'Lato';
                }

                .fa-btn {
                    margin-right: 6px;
                }
            </style>
        -->
    </head>

    <body>

        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">eXiaFolio</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Profil</a></li>
                        <li><a href="#">Espace Membre</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> S'inscrire</a> </li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a> </li>
                    </ul>
                </div>
            </nav>
        </header>

        @yield('content')
        <!-- <footer>
            <p>Footer !</p>
        </footer> -->
    </body>
</html>