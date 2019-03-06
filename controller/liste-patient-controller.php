<?php
//Instenciation de l'objet clients. 
//$client devient une instance de la classe client.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
$patients= new patients();
//$patientList=$patients->getPatientsList();


if (isset($_GET['delete'])) {
    $deletePatient = new patients();
    $deletePatient->id = $_GET['delete'];
    $deletePatients = $deletePatient->deletePatientAndAppointments();
}
    
//Si j'appuie sur le bouton et que mon input est remplie alors j'attribue la valeur de mon poste à $search
if (isset($_POST['searchSubmit'])) {
    if (!empty($_POST['search'])) {
//pour sécuriser le formulaire contre les failles html
        $search = htmlspecialchars($_POST['search']);
        $search = trim($search); //pour supprimer les espaces dans la requête de l'internaute
        $search = strip_tags($search); //pour supprimer les balises html dans la requête
        $resultSearch = $patients->patientSearch($search); // je lance ma methode avec $search en paramètre    
    }
} else {


//controleur de la methode qui permet la pagination
$totalPatient = $patients->paging();
$limit = 4;
$numberOfPage = ceil($totalPatient->countResult / $limit);
if (!empty($_GET['page'])) {
    if (!is_numeric($_GET['page']) || $_GET['page'] > $numberOfPage || $_GET['page'] <= 0) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
$listPatientPage = $patients->getPatientsForPaging($limit, $offset);
}

?>