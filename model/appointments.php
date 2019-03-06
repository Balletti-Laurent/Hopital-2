<?php

//model

class appointments {

//attribus
    public $id = 0;
    public $datehour = '0000-00-00 00:00:00';
    public $idpatients = 0;
    private $db;

    public function __construct() {
        //protection contre l'erreur
        //si il n'y a pas d'erreur
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'laurent', 'Yasmina');
            //si il y a une erreur
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    /**
     * la méthode sert a créer un nouveau rdv (5)
     * @return array
     */
    public function getAddAppointments() {
        // On insert les données du patient à l'aide de la requête INSERT INTO et le nom des champs de la table
        $query = 'INSERT INTO `appointments` (`dateHour`,`idPatients`) VALUES (:dateHour, :idPatients)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function checkFreeAppointment() {
        $result = FALSE;
//        verifie que le rendez vous n est pas pris
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatients`=:idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    public function getAppointmentsList() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                  `appointments`.`id`, 
                  `patients`.`lastname`,
                  `patients`.`firstname`
                  FROM `appointments`
                  LEFT JOIN `patients` 
                  ON `appointments`.`idPatients`=`patients`.`id` 
                  ORDER BY `patients`.`lastname`';
        //$query = 'SELECT `patients.firstname`, `patient.lasname`, `appointments.dateHour` DATE_FORMAT(`datehour`,\'%d/%m/%Y\') AND DATE_TIME(`dateHour`,\'H:i\') AS `datehour` FROM `patients` INNER JOIN `appointments` ON `patients.id`=`appointments.idPatients` WHERE `patient.lasname` ORDER BY lastname ASC';
        //appointments.dateHour FROM appointments INNER JOIN 
        //$query = 'SELECT DATE_FORMAT(`datehour`,\'%d/%m/%Y\') AS `datehour`, `hour` FROM `appointments` ORDER BY `lastname` ASC';
        $Resultquery = $this->db->query($query);
        if (is_object($Resultquery)) {
            $result = $Resultquery->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * methode permettant de recuperer un profil patient
     * @return type
     * getprofilpatientbyid
     */
    public function showAppointmentsPatient() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                  `patients`.`lastname`,
                  `patients`.`firstname`
                  FROM `appointments`
                  LEFT JOIN `patients` 
                  ON `appointments`.`idPatients`=`patients`.`id`
                  WHERE `appointments`.`id` = :id';


        //$query = 'SELECT * FROM `Appointments` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//si la requete c'est bien executé alors on rempli $returnArray avec un objet         
        if ($queryResult->execute()) {
            //renvoye un tableau d'objet
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
//si $return est un objet alors on hydrate       
        if (is_object($return)) {
            $this->lastname = $return->lastname;
            $this->firstname = $return->firstname;
            $this->date = $return->date;
            $this->hour = $return->hour;

            // $this->id = $return->id;
            //$this->mail = $return->mail;
            $isOk = TRUE;
        }
        return $isOk;
    }

    /**
     * Méthode permetant de modifier le rendez-vous d'un patients
     * @return type
     */
    public function modifyAppointmentPatient() {
        $query = $this->db->prepare('UPDATE `appointments` SET `dateHour` =:dateHour, `idPatients`=:idPatients WHERE `id`=:idAppointement');
        $query->bindValue(':dateHour', $this->datehour, PDO::PARAM_STR);
        $query->bindValue(':idAppointement', $this->id, PDO::PARAM_INT);
        $query->bindValue(':idPatients', $this->idpatients, PDO::PARAM_INT);
        return $query->execute();
    }

    /**
     * Fonction permetant d'afficher tous les rendez-vous d'un seul patient
     * @return type
     */
    /*public function showAppointmentsPatientInProfilPatient() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                  `appointments`.`id`,
                  `appointments`.`idPatients`,
                  FROM `appointments`
                  WHERE `appointements.`idPatients`=:idPatients';
        $Resultquery = $this->db->query($query);
        if (is_object($Resultquery)) {
            $result = $Resultquery->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }*/
    
        /**
     * methode pour filtrer les rendez-vous en fonction des patients
     * @return type
     */
    public function showAppointmentsPatientInProfilPatient() {
        $result = array();
        $query = 'SELECT id, DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS date, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS hour,                        
                 `idPatients` FROM `appointments` WHERE `appointments`.`idPatients`=:idPatient';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idPatient', $this->idPatient, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Fonction permetant de supprimer un rendez-vous
     * @return type
     */
    public function removeAppointment() {
        $query = 'DELETE FROM `appointments`
                  WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
            
        return $result;
    }
}
    ?>

