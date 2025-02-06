<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Patient;

class PatientController extends Controller {
    private $patientModel;

    public function __construct() {
        $this->patientModel = new Patient();
    }

    public function index() {
        $patients = $this->patientModel->findAll();
        $this->render('patients/index', ['patients' => $patients]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'date_naissance' => $_POST['date_naissance'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone']
            ];

            if ($this->patientModel->create($data)) {
                $this->redirect('/patients');
            }
        }
        
        $this->render('patients/create');
    }

    public function edit($id) {
        $patient = $this->patientModel->findById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'date_naissance' => $_POST['date_naissance'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone']
            ];

            if ($this->patientModel->update($id, $data)) {
                $this->redirect('/patients');
            }
        }
        
        $this->render('patients/edit', ['patient' => $patient]);
    }
}

