<?php
include 'navbar.php';
include 'model/patients.php';
include 'model/appointments.php';
include 'controller/rendezvous-controller.php';
//include 'controller/modification-patient-controller.php';
?>
<!doctype HTML>
<html lang="fr">
    <head>
        <meta charset ="utf-8">
        <title>Rendez-vous</title>
        <script src="assets/jquery/jquery-3.2.1.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.2.1/litera/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="background">
        <?php
        if ($appointmentDetail) {
            ?>
            <div class="text-center col-12" >
                <h1>Rendez-vous</h1>
                <div>Nom : <?= $appointment->lastname ?></div>
                <div>Prénom : <?= $appointment->firstname ?></div>
                <div>Date : <?= $appointment->date ?></div>
                <div>Horaire : <?= $appointment->hour ?></div>
                <?php if ($isSuccess) { ?>
                    <p class="text-success">Modification effectué !</p>
                    <?php
                }
                ?>
                <!--Formulaire-->
                <p><button class="btn btn-primary">Modifier le rendez-vous</button></p>
            </div>
            <div id="hiddenForm" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="text-center text-info col-12" >
                            MODIFICATION DU RENDEZ-VOUS :
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
                                    <form method="POST" action="rendezvous.php?id=<?= $appointment->id ?>">
                                        <div class="form-group">
                                            <?php if ($isSuccess) { ?>
                                                <p class="text-success">Votre modification de rendez-vous a bien été prises en compte</p>
                                                <?php
                                            }
                                            if ($isError) {
                                                ?>
                                                <p class="text-danger">Désolé, votre modification de rendez-vous n'a pu être enregistré !</p>
                                                <?php
                                            }
                                            ?>
                                            <div class="form-row">    
                                                <fieldset>
                                                    <legend>Modifier un rendez-Vous</legend>
                                                    <!--<p>Nom et prénom du patient : <? = $appointment->lastname . ' ' . $appointment->firstname ?></p>-->
                                                    <form name="form" method="POST" action="rendezvous.php?id=<?= $appointment->id ?>" enctype="multipart/form-data">
                                                        <label for="idPatients">Nom du patient</label>
                                                        <select name="idPatients" class="form-control">
                                                            <?php foreach ($patientsList as $patient) { ?>
                                                                <!-- Si l'id du rdv existe et que l'id du patient est égale à l'id patient du rdv alors je rajoute l'attribut selected  -->
                                                                <option value="<?= $patient->id ?>" <?= isset($appointment->idPatients) && ($patient->id == $appointment->idPatients) ? 'selected' : '' ?>><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        
                                                        <p><strong>Date:</strong><input type="date" class="form-control" title="<?= $appointment->date ?>" value="<?= $appointment->date ?>" name="date" placeholder="<?= $appointment->date ?>"/>
                                                           </p>
                                                        <p><strong>Heure:</strong><input type="time" class="form-control" title="<?= $appointment->hour ?>" value="<?= $appointment->hour ?>" name="hour" placeholder="<?= $appointment->hour ?>"/>
                                                          </p>
                                                        <button type="submit" class="btn btn-primary mt-3" value="valider" name="submit">Valider</button>

                                                </fieldset>

                                            </div>
                                        </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div>Le rendez-vous n'a pas été trouvé!</div>
                            <?php
                        }
                        ?>
                        <script type="text/javascript" src="assets/js/script.js"></script>
                        </body>
                        </html>