<?php

//Instenciation de l'objet clients. 
//$client devient une instance de la classe client.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
////$patient= new patients();
//récupérer l'id présent dans l'URL de la vu et je l'attribue a l'id de l'objet instentier $patient
////$patient->id = $_GET['id'];
//Appel de la méthode
//  crer vue le tableau $patient qu'on récupère avec la méthode showProfilPatient() du modèle
//en train d'appeler la méthode showProfilPatient()
////$patientProfil=$patient->showProfilPatient();
//$appointmentPatient = false;
$appointment = new appointments();
if (isset ($_GET['id'])){
    $appointment->id = $_GET['id'];
    
}


$patient = new patients();
$patientsList = $patient->getPatientsList();


//Modification RDV

$regexName = '/^[a-zA-Z\- ]+$/';
//Déclaration regex date
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
if (isset($_POST['submit'])) {
    if (isset($_POST['idPatients'])) {
        $idPatients = htmlspecialchars($_POST['idPatients']);
    } else {
        $formError['patient'] = 'Veuillez selectioner un patient';
    }
//Date du rdv
    if (isset($_POST['date'])) {
        if (!empty($_POST['date'])) {
            if (preg_match($regexDate, $_POST['date'])) {
                $date = htmlspecialchars($_POST['date']);
            } else {
                $formError['date'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
//Heure du rdv
    if (isset($_POST['hour'])) {
        if (!empty($_POST['hour'])) {
            if (preg_match($regexHour, $_POST['hour'])) {
                $hour = htmlspecialchars($_POST['hour']);
            } else {
                $formError['hour'] = 'Votre heure de rendez-vous est invalide.';
            }
        } else {
            $formError['hour'] = 'Erreur,merci de remplir le champ heure de rendez-vous.';
        }
    }

    //Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé ne
    //on verifie si il n'y a pas d'erreur alors on instancie la classe "appointments".
    if (count($formError) == 0) {
        $appointment = new appointments();
        $appointment->id = $_GET['id'];
        $appointment->datehour = $date . ' ' . $hour;
        $appointment->idpatients = $idPatients;
        $appointment->modifyAppointmentPatient();
        $appointment->showAppointmentsPatient();

        
        $isSuccess = TRUE;
    }
}
$appointmentDetail = $appointment->showAppointmentsPatient();

?>

