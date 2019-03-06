<?php
//Instenciation de l'objet clients. 
//$client devient une instance de la classe client.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
//$appointments= new appointments();
//$appointmentsList=$appointments->getAppointmentsList();
//$remove=$appointments->removeAppointment();


$appointments = new appointments();
//on appel la méthode grâce a $appointments qui se trouve dans ma classe et qui me retourne un tableau stocké dans $appointmentsList
$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $appointments->id = htmlspecialchars($_GET['idDelete']);
    if ($appointments->removeAppointment()) {
        $isDelete = TRUE;
    }
}
$appointmentsList = $appointments->getAppointmentsList();
?>


