<?php
namespace Core;

abstract class Controller {
    protected $user = null;
    protected $csrf_token;

    public function __construct() {
        session_start();
        
        // Vérification de l'authentification
        if (isset($_SESSION['user_id'])) {
            $userModel = new \App\Models\User();
            $this->user = $userModel->findById($_SESSION['user_id']);
        }
        
        // Génération du token CSRF
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $this->csrf_token = $_SESSION['csrf_token'];
    }

    protected function render($view, $data = []) {
        // Ajout des données de base
        $data['csrf_token'] = $this->csrf_token;
        $data['user'] = $this->user;
        $data['flash'] = $this->getFlashMessages();
        
        extract($data);
        
        ob_start();
        require "../app/views/{$view}.php";
        $content = ob_get_clean();
        
        require "../app/views/layout.php";
    }

    protected function validateCSRF() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $this->csrf_token) {
            throw new \Exception('Token CSRF invalide');
        }
    }

    protected function setFlash($type, $message) {
        $_SESSION['flash'][$type] = $message;
    }

    protected function getFlashMessages() {
        $flash = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flash;
    }

    protected function requireAuth() {
        if (!$this->user) {
            $this->setFlash('error', 'Vous devez être connecté pour accéder à cette page');
            $this->redirect('/login');
        }
    }

    protected function requireRole($role) {
        $this->requireAuth();
        if ($this->user['role'] !== $role) {
            $this->setFlash('error', 'Accès non autorisé');
            $this->redirect('/');
        }
    }
}

