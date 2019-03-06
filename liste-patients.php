<?php
include 'navbar.php';
include 'model/patients.php';
include 'controller/liste-patient-controller.php';
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
        <div class="row">
            <div class="col-md-12 text-center">
                <form class="mt-3" action="liste-patients.php" method="POST">
                    <input type="search" name="search"/>
                    <input class="btn btn-outline-primary" type="submit" name="searchSubmit" value ="Rechercher" />
                </form>
                <?php
                if (isset($_POST['searchSubmit'])) {
                    if (isset($_POST['search'])) {
                        ?>
                        <h1>Liste des patients</h1>
                        <a href="ajout-patient.php" target="_self"><button type="button" class="btn btn-info disabled" href="ajout-patient.php">Ajouter un patient</button></a>
                        <table class="table table-dark">
                            <thead >
                                <tr>
                                    <th scope="col">Noms</th>
                                    <th scope="col">Prenoms</th>
                                    <th scope="col">Date de naissance</th>
                                    <th scope="col">Numéro de Téléphone</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Afficher les profiles</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($resultSearch as $patient) { ?>
                                    <tr>
                                        <td><?= $patient->lastname ?></td>
                                        <td><?= $patient->firstname ?></td>
                                        <td><?= $patient->birthdate ?></td>
                                        <td><?= $patient->phone ?></td>
                                        <td><?= $patient->mail ?></td>
                                        <td><a href="profil-patient.php?id=<?= $patient->id ?>" >Afficher le profile</a></td>
                                        <td><a class="btn btn-danger" href="liste-patients.php?delete=<?= $patient->id ?>" id="delete" name="delete"> Supprimer</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php
                    }
                } else {
                    ?>

                    <h1>Liste des patients</h1>
                    <a href="ajout-patient.php" target="_self"><button type="button" class="btn btn-info disabled" href="ajout-patient.php">Ajouter un patient</button></a>
                    <table class="table table-dark">
                        <thead >
                            <tr>
                                <th scope="col">Noms</th>
                                <th scope="col">Prenoms</th>
                                <th scope="col">Date de naissance</th>
                                <th scope="col">Numéro de Téléphone</th>
                                <th scope="col">Mail</th>
                                <th scope="col">Afficher les profiles</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($listPatientPage as $patient) { ?>
                                <tr>
                                    <td><?= $patient->lastname ?></td>
                                    <td><?= $patient->firstname ?></td>
                                    <td><?= $patient->birthdate ?></td>
                                    <td><?= $patient->phone ?></td>
                                    <td><?= $patient->mail ?></td>
                                    <td><a href="profil-patient.php?id=<?= $patient->id ?>" >Afficher le profile</a></td>
                                    <td><a class="btn btn-danger" href="liste-patients.php?delete=<?= $patient->id ?>" id="delete" name="delete"> Supprimer</a></td>
                                </tr>
                            <?php }
                         ?>
                    </tbody>
                </table>


                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>" ><a class="page-link" href="liste-patients.php?page=<?= $page - 1 ?>">&lt;</a></li>
                        <?php for ($i = 1; $i <= $numberOfPage; $i++) { ?>
                            <li class = "page-item"><a class = "page-link" href = "liste-patients.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item <?= $page == $numberOfPage ? 'disabled' : '' ?>"><a class="page-link" href="liste-patients.php?page=<?= $page + 1 ?>">&gt;</a></li>
                    </ul>
                </nav>
                            <?php
                        }
                        ?>
            </div>
        </div>
    </body>
</html>