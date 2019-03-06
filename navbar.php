<?php
//index.php
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" centent="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projet Hopital index</title>
        <link href="assets/css/style.css" rel="tylesheet"/>
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/litera/bootstrap.min.css" rel="stylesheet">
        <link href="assets/bootstrap/js/bootstrap.js" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">Hopital</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Acceil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ajout-patient.php">Ajouter patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="liste-patients.php">Liste patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profil-patient.php">Profil patient</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ajout-rendezvous.php">Ajouter RDV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="liste-rendezvous.php">Liste RDV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rendezvous.php">RDV</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>  
        </header>  
    </body>
</html>








