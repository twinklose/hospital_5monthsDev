<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Appointment.php');
require_once(__DIR__.'/../models/Patient.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[1];
$description = HEAD_DESCRIPTION[1];
$style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/leftbar.css">
    <link rel="stylesheet" href="../public/css/listing.css">
    <link rel="stylesheet" href="../public/css/rightbar.css">';

$javascript = '<script defer src="../public/js/openModal.js"></script>
            <script defer src="../public/js/openNavbar.js"></script>';

// Récupération du nombre de pages avec la méthode statique howManyPages
$totalPages = Appointment::howManyPages();
// Récupération de la page actuelle avec la méthode statique getPage
$page = Appointment::setPage();
// Récupération de la liste des patients par page avec la méthode statique getByTen
$patientsList = Appointment::getByTen();
// Récupération de la liste de tout les patients pour le select
$patientsAll = Patient::getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instanciation de la classe RegisterAppointement
    $registerAppointement = new Appointment('dateHour', 'id');
    if (Database::validationInput($registerAppointement->getDate(), REGEX_DATETIME) && 
    Database::validationInput($registerAppointement->getId(), REGEX_ID)) {
        if ($registerAppointement->idExists() == true) {
            if ($registerAppointement->datetimeIsAvailable() == true) {
                $registerAppointement->addAppointement();
                $confirmation = 'Le rendez-vous a bien été enregistré';
            } else {
                $error = 'La date et l\'heure du rendez-vous ne sont pas disponibles';
            }
        } else {
            $error = 'Le patient n\'existe pas';
        }
    } else {
        $error = 'Les données ne sont pas conformes';
    }
}

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/listAppointments.php');
include(__DIR__.'/../views/templates/footer.php');