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

$patientProfil = false;
$patient = new patients();
if (!empty($_GET['id'])) {
    $patient->id = htmlspecialchars($_GET['id']);
    $patientProfil = $patient->showProfilPatient();
}

$appointments = new appointments();
$appointments->idPatient = $patient->id;
$appointmentsListPatient= $appointments->showAppointmentsPatientInProfilPatient();


// Modification Patient

//Déclaration regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//Déclaration regex nom
$regexName = '/([a-zA-Z_])$/';
//Déclaration regex date
//$regexDate = "/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/i";
//Déclaration regex mail
$regexMail = '/^[\w.-]+@[\w.-]+\.[a-z]{2,6}$/i';
//Déclaration regex texte
$regexText = '/^[0-9a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-\ \.\,\?\:\!\']+$/';
//Déclaration regex nombre et lettre
$regexNumberLetter = '/^[0-9A-z]+$/';
//Déclaration des erreurs du formulaire:
$formError = array();
$isSuccess = FALSE;
//si le submit est isset
if (isset($_POST['submit'])) {
    if (isset($_POST['lastname'])) {
        // Si $POST lastname existe alors je declare ma varible $lastname
// et je la verrifie avec ma regex.
// 
// si mon $_POST['lastname'] est différent de vide
        if (!empty($_POST['lastname'])) {
// Si lastname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
// dont mon tableau formError
            if (preg_match($regexName, $_POST['lastname'])) {
                $lastname = htmlspecialchars($_POST['lastname']);
            } else {
                $formError['lastname'] = 'Nom, la saisie est invalide.';
            }
        } else {
            $formError['lastname'] = 'Erreur,merci de remplir le champ Nom.';
        }
    }
    if (isset($_POST['firstname'])) {
        if (!empty($_POST['firstname'])) {
// Si firstname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
// dont mon tableau formError
            if (preg_match($regexName, $_POST['firstname'])) {
                $firstname = htmlspecialchars($_POST['firstname']);
            } else {
                $formError['firstname'] = 'Prénom, la saisie est invalide.';
            }
        } else {
            $formError['firstname'] = 'Erreur,merci de remplir le champ Prenom.';
        }
    }
    if (isset($_POST['birthdate'])) {
        //Date de naissance
        if (!empty($_POST['birthdate'])) {
// Si birthdate ne respecte pas les conditions de ma regex alors je stock un message d'erreur
// dont mon tableau formError
            $birthdate = htmlspecialchars($_POST['birthdate']);
        } else {
            $formError['birthdate'] = 'Erreur,merci de remplir le champ date de naissance.';
        }
    }
    if (isset($_POST['mail'])) {
        //Mail
        if (!empty($_POST['mail'])) {
// Si mail ne respecte pas le filter_var alors je stock un message d'erreur
// dont mon tableau formError
//Emploi de la fonction PHP Filter_var pour valider l'adresse Email.
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Mail, la saisie est invalide.';
            }
        } else {
            $formError['mail'] = 'Erreur,merci de remplir le champ Mail.';
        }
    }
    if (isset($_POST['phone'])) {
        //Telephone
        if (!empty($_POST['phone'])) {
// Si phone ne respecte pas les conditions de ma regex alors je stock un message d'erreur
// dont mon tableau formError
            if (preg_match($regexPhone, $_POST['phone'])) {
                $phone = htmlspecialchars($_POST['phone']);
            } else {
                $formError['phone'] = 'Telephone, la saisie est invalide.';
            }
        } else {
            $formError['phone'] = 'Erreur, merci de remplir le champ telephone.';
        }
    }

        //Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé ne
        //on verifie si il n'y a pas d'erreur alors on instancie la classe "patients".
    if (count($formError) == 0) {
        $patient->lastname = $lastname;
        $patient->firstname = $firstname;
        $patient->birthdate = $birthdate;
        $patient->mail = $mail;
        $patient->phone = $phone;
        $patient->modifyProfilPatient();
//        //$patient->id = $_GET['id'];
//        $patients->lastname = $lastname;
//        $patients->firstname = $firstname;
//        $patients->birthdate = $birthdate;
//        $patients->mail = $mail;
//        $patients->phone = $phone;
//        //$patientProfil=$patient->modifyProfilPatient();
//        $patients->modifyProfilPatient();
//        
        //$isSuccess = TRUE;
    }

}


?>