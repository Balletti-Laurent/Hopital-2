<?php

//model

class patients {

//attribus
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '00/00/0000';
    public $phone = '0000000000';
    public $mail = '';
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'laurent', 'Yasmina');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

//public function addpatients() est un méthode
    public function addpatients() {
// Parametre : lastname,firstname...
        $query = 'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) '
                . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
//marqueur nominatif = requete préparé (prepare(query)
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryResult->execute();
//       $date = DateTime::createFromFormat('d/m/Y', $this->birthdate);
//       $dateUs = $date->format('Y-m-d');
//       $addPatients->bindValue(':birthdate', $dateUs, PDO::PARAM_STR);
    }

    /**
     * methode permettant de recuperer la liste des patients
     * @return array
     */
    public function getPatientsList() {
        $result = array();
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` ORDER BY `lastname` ASC';
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
    public function showProfilPatient() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT * FROM `patients` WHERE `id`= :id';
//$query = 'SELECT `lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` WHERE `id`= :id';
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
            $this->birthdate = $return->birthdate;
            $this->phone = $return->phone;
            $this->id = $return->id;
            $this->mail = $return->mail;
            $isOk = TRUE;
        }
        return $isOk;
    }

    public function modifyProfilPatient() {
        $query = 'UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate, `phone`=:phone, `mail`=:mail WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //méthode pour supprimer un patient et ses RDV
    public function deletePatientAndAppointments() {
        $result = array();
        $query = $this->db->prepare('DELETE FROM `patients` WHERE `id`=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //méthode pour recherche un patient
    public function patientSearch($search) {
//        $result = array();
        $query = $this->db->prepare('SELECT `id`,`lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` WHERE `firstname` LIKE :search  OR `lastname` LIKE :search');
        $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        if ($query->execute()) {
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function paging() {
        $query = 'SELECT COUNT(`id`) AS `countResult` FROM `patients`';
        $total = $this->db->query($query);
        if (is_object($total)) {
            $result = $total->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //methode qui permet la pagination
    public function getPatientsForPaging($limit, $offset) {
        $result = array();
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` LIMIT :limit OFFSET :offset';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':limit', $limit, PDO::PARAM_INT);
        $queryResult->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            if (is_object($queryResult)) {
                $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return $result;
    }

}

?>