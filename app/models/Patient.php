<?php
namespace App\Models;

use Core\Model;

class Patient extends Model {
    protected $table = 'patients';
    protected $relations = [
        'rendezVous' => [
            'type' => 'hasMany',
            'model' => RendezVous::class,
            'foreignKey' => 'patient_id'
        ]
    ];

    public function validateData($data) {
        $errors = [];
        
        if (empty($data['nom'])) {
            $errors['nom'] = "Le nom est requis";
        }
        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le prénom est requis";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email invalide";
        }
        if (!preg_match("/^[0-9]{10}$/", $data['telephone'])) {
            $errors['telephone'] = "Numéro de téléphone invalide";
        }
        
        return $errors;
    }

    public function getRendezVousAVenir($patientId) {
        $query = "SELECT rv.*, m.nom as medecin_nom, m.prenom as medecin_prenom 
                 FROM rendez_vous rv 
                 JOIN medecins m ON rv.medecin_id = m.id 
                 WHERE rv.patient_id = :patient_id 
                 AND rv.date_heure > NOW() 
                 ORDER BY rv.date_heure";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute(['patient_id' => $patientId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}

