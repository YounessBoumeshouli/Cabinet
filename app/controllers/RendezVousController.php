<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\RendezVous;
use App\Models\Medecin;

class RendezVousController extends Controller {
    private $rendezVousModel;
    private $medecinModel;

    public function __construct() {
        parent::__construct();
        $this->requireAuth();
        $this->rendezVousModel = new RendezVous();
        $this->medecinModel = new Medecin();
    }

    public function index() {
        $rendezVous = $this->rendezVousModel->findAll(
            ['patient_id' => $this->user['id']],
            ['medecin']
        );
        
        $this->render('rendez-vous/index', [
            'rendezVous' => $rendezVous
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCSRF();
            
            $data = [
                'medecin_id' => $_POST['medecin_id'],
                'date_heure' => $_POST['date'] . ' ' . $_POST['heure'],
                'motif' => $_POST['motif'],
                'patient_id' => $this->user['id']
            ];
            
            // Validation des données
            $errors = $this->rendezVousModel->validateData($data);
            
            if (empty($errors)) {
                try {
                    $this->rendezVousModel->create($data);
                    $this->setFlash('success', 'Rendez-vous créé avec succès');
                    $this->redirect('/rendez-vous');
                } catch (\Exception $e) {
                    $this->setFlash('error', 'Erreur lors de la création du rendez-vous');
                }
            }
        }
        
        $medecins = $this->medecinModel->findAll();
        $this->render('rendez-vous/create', [
            'medecins' => $medecins,
            'errors' => $errors ?? []
        ]);
    }

    public function cancel($id) {
        $rendezVous = $this->rendezVousModel->findById($id);
        
        if (!$rendezVous || $rendezVous['patient_id'] !== $this->user['id']) {
            $this->setFlash('error', 'Rendez-vous non trouvé');
            $this->redirect('/rendez-vous');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCSRF();
            
            try {
                $this->rendezVousModel->update($id, ['statut' => 'annulé']);
                $this->setFlash('success', 'Rendez-vous annulé avec succès');
            } catch (\Exception $e) {
                $this->setFlash('error', 'Erreur lors de l\'annulation du rendez-vous');
            }
            
            $this->redirect('/rendez-vous');
        }
        
        $this->render('rendez-vous/cancel', [
            'rendezVous' => $rendezVous
        ]);
    }
}

