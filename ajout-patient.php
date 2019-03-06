<?php
include 'navbar.php';
include 'model/patients.php';
include 'controller/ajout-patient-controller.php';
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
                    FORMULAIRE D'INSCRIPTION :
                    <?php if ($isSuccess) { ?>
                        <p class="text-success">Enregistrement effectué !</p>
                        <?php
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="text-center col-10 formPatient">
                            <form method="POST" action="ajout-patient.php">
                                <div class="form-group">
                                    <div class="form-row">             
                                        <label for="lastname">Nom:</label><input name="lastname" type="text" class="form-control" id="lastname" placeholder="Nom" value="<?= isset($lastName) ? $lastName : '' ?>"  />
                                        <p class="text-danger"> <?= isset($formError['lastname']) ? $formError['lastname'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="firstname">Prenom:</label><input name="firstname" type="text" class="form-control" id="firstname" placeholder="Prenom" value="<?= isset($firstName) ? $firstName : '' ?>"  />
                                        <p class="text-danger"> <?= isset($formError['firstname']) ? $formError['firstname'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="birthdate">Date de naissance ex : (10/10/1980)</label><input name="birthdate" type="date" class="form-control" id="birthdate" placeholder="Date de naissance" value="<?= isset($birthDate) ? $birthDate : '' ?>" />
                                        <p class="text-danger"> <?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="phone">Téléphone :</label><input name="phone" type="tel" class="form-control" id="phone" placeholder="Téléphone" value="<?= isset($phone) ? $phone : '' ?>"  />
                                        <p class="text-danger"> <?= isset($formError['phone']) ? $formError['phone'] : '' ?> </p>
                                    </div>
                                    <div class="form-row">             
                                        <label for="mail">Email :</label><input name="mail" type="email" class="form-control" id="mail" placeholder="Email" value="<?= isset($mail) ? $mail : '' ?>" />
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
    </body>
</html>