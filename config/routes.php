<?php
// Routes pour les patients
$router->add('GET', '/Cabinet/patients', 'PatientController', 'index');
$router->add('GET', '/Cabinet/patients/create', 'PatientController', 'create');
$router->add('POST', '/Cabinet/patients/create', 'PatientController', 'create');
$router->add('GET', '/Cabinet/patients/edit/{id}', 'PatientController', 'edit');
$router->add('POST', '/Cabinet/patients/edit/{id}', 'PatientController', 'edit');

// Routes pour l'authentification
$router->add('GET', '/Cabinet/login', 'AuthController', 'login');
$router->add('POST', '/Cabinet/login', 'AuthController', 'login');
$router->add('GET', '/Cabinet/logout', 'AuthController', 'logout');

// Routes pour le tableau de bord
$router->add('GET', '/Cabinet/', 'HomeController', 'index');