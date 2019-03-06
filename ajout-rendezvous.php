<?php
include 'navbar.php';
include 'model/appointments.php';
include 'model/patients.php';
include 'controller/ajout-rendezvous-controller.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" centent="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projet Hopital index</title>
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/litera/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="background">

        <div class="container-fluid">
            <div class="row">
                <div class="text-center text-info col-12" >
                    FORMULAIRE DE PRISE DE RENDEZ-VOUS :
                    <?php if ($isSuccess) { ?>
                        <p class="text-success">Rendez-vous enregistré !</p>
                        <?php
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="text-center col-10 formPatient">
                            <p class="text-danger"><?= isset($formError['checkAppointment']) ? $formError['checkAppointment'] : '' ?></p>
                            <form method="POST" action="ajout-rendezvous.php">
                                <div class="form-group">
                <?php if ($isSuccess) { ?>
                    <p class="text-success">Votre rendez-vous a bien été prises en compte</p>
                    <?php
                }
                if ($isError) {
                    ?>
                    <p class="text-danger">Désolé, votre rendez-vous n'a pu être enregistré !</p>
                    <?php
                }
                ?>
                    <div class="form-row">    
                <fieldset>
                    <legend>Ajouter un rendez-Vous</legend>
                    <label for="idLastname"> Nom et prénom du patient : </label>
                    <select name="idLastname" id="idLastname">
                        <option value="">Choix du patient</option>
                        <?php foreach ($patientsList as $patientDetail) { ?>
                            <option value = "<?= $patientDetail->id ?>"><?= $patientDetail->lastname . ' ' . $patientDetail->firstname ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger"><?= isset($formError['patient']) ? $formError['patient'] : '' ?></p>
                    <label for="date"> Date du rendez-vous : </label><input type="date" id="date" name="date" value="<?= isset($date) ? $date : '' ?>"/>
                    <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                    <p><label for="hour">Heure du rendez-vous (heures d'ouverture 08:00 à 20:00) : </label><input id="hour" type="time" name="hour" min="08:00" max="20:00" value="<?= isset($hour) ? $hour : '' ?>"/></p>
                    <div>
                        <div class="nav-item">
                            <input type="submit" class="valid" value="Valider" name="submit"/></a>
                        </div>
                    </div>
</fieldset>
<!--                                        <label for="lastname">Date : </label><input name="date" type="date" class="form-control" id="date" placeholder="Date" value="<?= isset($date) ? $date : '' ?>"  />
                                        <p class="text-danger"> <? = isset($formError['date']) ? $formError['date'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="firstname">Horaire : </label><input name="time" type="time" class="form-control" id="time" placeholder="Heure" value="<?= isset($time) ? $time : '' ?>"  />
                                        <p class="text-danger"> <? = isset($formError['time']) ? $formError['time'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="birthdate">Identifiant du patient</label><input name="idpatient" type="text" class="form-control" id="idpatient" placeholder="Numéro d'identifiant" value="<?= isset($idpatient) ? $idpatient : '' ?>" />
                                        <p class="text-danger"> <? = isset($formError['idpatient']) ? $formError['idpatient'] : '' ?> </p>
                                    </div>                          
                                    <input class="btn btn-info" type="submit" value="Valider" name='submit' />-->
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
