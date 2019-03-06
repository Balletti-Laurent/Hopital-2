<?php
include 'navbar.php';
include 'model/patients.php';
include 'model/appointments.php';
include 'controller/profil-patient-controller.php';
//include 'controller/modification-patient-controller.php';
?>
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset ="utf-8">
        <title>Profil-patient</title>
        <script src="assets/jquery/jquery-3.2.1.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/litera/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="background">
        <?php
        if ($patientProfil) {
            ?>
            <div class="text-center col-12" >
                <h1>Profil du patient</h1>
                <div>Nom : <?= $patient->lastname ?></div>
                <div>Prénom : <?= $patient->firstname ?></div>
                <div>Date de naissance : <?= $patient->birthdate ?></div>
                <div>Numéro de Téléphone : <?= $patient->phone ?></div>
                <div>Mail : <?= $patient->mail ?></div>
                <?php if ($isSuccess) { ?>
                    <p class="text-success">Modification effectué !</p>
                    <?php
                }
                ?>
                <!--Formulaire-->
                <p><button class="btn btn-primary">Modifier le profil</button></p>
            </div>
            <div id="hiddenForm" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="text-center text-info col-12" >
                            MODIFICATION DU PROFIL :

                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="text-center col-10 formPatient">
                                    <form method="POST" action="profil-patient.php?id=<?= $patient->id ?>">
                                        <div class="form-group">
                                            <div class="form-row">             
                                                <label for="lastname">Nom:</label><input name="lastname" type="text" class="form-control" id="lastname" placeholder="<?= $patient->lastname ?>" value="<?= $patient->lastname ?>"  />
                                                <p class="text-danger"> <?= isset($formError['lastname']) ? $formError['lastname'] : '' ?> </p>
                                            </div>
                                            <div class="form-row">             
                                                <label for="firstname">Prenom:</label><input name="firstname" type="text" class="form-control" id="firstname" placeholder="<?= $patient->firstname ?>" value="<?= $patient->firstname ?>"  />
                                                <p class="text-danger"> <?= isset($formError['firstname']) ? $formError['firstname'] : '' ?> </p>
                                            </div>
                                            <div class="form-row">             
                                                <label for="birthdate">Date de naissance ex : (10/10/1980)</label><input name="birthdate" type="date" class="form-control" id="birthdate" placeholder="<?= $patient->birthdate ?>" value="<?= $patient->birthdate ?>" />
                                                <p class="text-danger"> <?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?> </p>
                                            </div>
                                            <div class="form-row">             
                                                <label for="phone">Téléphone :</label><input name="phone" type="tel" class="form-control" id="phone" placeholder="<?= $patient->phone ?>" value="<?= $patient->phone ?>"  />
                                                <p class="text-danger"> <?= isset($formError['phone']) ? $formError['phone'] : '' ?> </p>
                                            </div>
                                            <div class="form-row">             
                                                <label for="mail">Email :</label><input name="mail" type="email" class="form-control" id="mail" placeholder="<?= $patient->mail ?>" value="<?= $patient->mail ?>" />
                                                <p class="text-danger"> <?= isset($formError['mail']) ? $formError['mail'] : '' ?> </p>
                                            </div>                            
                                            <input class="btn btn-info" type="submit" value="Valider" name='submit' />
                                        </div>   
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div>Le patient n'a pas été trouvé!</div>
            <?php
        }
        ?>


        <h2>Liste des rendez-vous du patient</h2>
        <table class="table table-dark">
            <thead >
                <tr>
                    <th scope="col">Dates</th>
                    <th scope="col">Horaires</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointmentsListPatient as $appointments) { ?>
                    <tr>
                        <td><?= $appointments->id ?></td>
                        <td><?= $appointments->date ?></td>
                        <td><?= $appointments->hour ?></td>
                        <td><a class= "valid" href="profil-patient.php?id=<?= $appointments->id ?>" name="valid"> Voir le detail</a></td>
                        
                    </tr>
                <?php } ?>                 
            </tbody>
        </table>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </body>
</html>