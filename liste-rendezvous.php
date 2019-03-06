<?php
include 'navbar.php';
include 'model/appointments.php';
include 'model/patients.php';
include 'controller/liste-rendezvous-controller.php';
?>
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset ="utf-8">
        <title>liste-patients</title>
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/litera/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="background">
        <h1>Liste des rendez-vous</h1>
        <a href="ajout-rendezvous.php" target="_self" class="btn btn-info">Ajouter un rendez-vous</button></a>
        <table class="table table-dark">
            <thead >
                <tr>
                    <th scope="col">Noms</th>
                    <th scope="col">Prenoms</th>
                    <th scope="col">Dates</th>
                    <th scope="col">Horaires</th>
                    <th scope="col">Afficher les rendez-vous</th>
                    <th scope="col">Supprimer les rendez-vous</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointmentsList as $appointments) { ?>
                    <tr>
                        <td><?= $appointments->lastname ?></td>
                        <td><?= $appointments->firstname ?></td>
                        <td><?= $appointments->date ?></td>
                        <td><?= $appointments->hour ?></td>
                        <td><a href="rendezvous.php?id=<?= $appointments->id ?>" >Afficher le rendez-vous</a></td>
                        <td><a class="btn btn-danger" href="liste-rendezvous.php?idDelete=<?= $appointments->id ?>" id="delete" name="delete"> Supprimer</a></td>
                        
                    </tr>
                <?php } ?>                   
            </tbody>
        </table>
    </body>
</html>