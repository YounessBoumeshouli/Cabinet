<?php
class PatientModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllPatients() {
        $query = "SELECT * FROM patients ORDER BY nom, prenom";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPatient($nom, $prenom, $dateNaissance) {
        $query = "INSERT INTO patients (nom, prenom, date_naissance) VALUES (:nom, :prenom, :date_naissance)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':date_naissance' => $dateNaissance
        ]);
    }

    // Autres méthodes (getPatientById, updatePatient, deletePatient, etc.)
}

