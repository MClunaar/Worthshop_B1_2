<?php
// On démarre les sessions
session_start();
$INC_DIR = $_SERVER["DOCUMENT_ROOT"];


// Si l'utilisateur n'est pas connecté ou s'il n'est pas admin alors on l'envoir vers la page erreur
if (! isset($_SESSION["roleUser"]) || $_SESSION["roleUser"] != 100) { //TODO edit le role user
    // La vue
    require ($INC_DIR. "/MVC_UDEPSI/view/edit_USER.php");
    exit;
}

// Le modèle
require ($INC_DIR. "/model/udepsi.php");

// Le contrôleur
// On regarde comment a été appellé la page
$user_id = -1;
$user = null;

$alertCSS = "success";
$alertMessage = "";


// La BDD
$bdd = getDataBase();

if (isset($_GET) && count($_GET) > 0) {
    // L'utilisateur a cliqué sur le lien a href
    // 2 - On récupère l'id
    if (isset($_GET['id'])) {
        $user_id = htmlspecialchars($_GET['id']);
        // L'id doit être une valeur numérique
        if (is_numeric($user_id)) {
            $user = getPublisher($user_id, $bdd);
        }
    }
}
elseif (isset($_POST) && count($_POST) > 0) {

    // L'utilisateur a cliqué sur le bouton submit

    // 1 - On récupère les infos du formulaires
    extract(array_map("htmlspecialchars", $_POST));
    // 2 - On valide les infos dans la bdd
    // 2 : Connexion
    $bdd = getDataBase();

    $nbModifs = updateUSER($user_id, $user_name, $city, $state, $cbCountry, $bdd); //TODO edit les modifs
    if ($nbModifs == 0) {
        $alertCSS = "danger";
        $alertMessage = "La mise à jour a échoué";
    }
    else
        $alertMessage = "La mise à jour a réussi";

    $publisher = getUSER($user_id, $bdd);
}

// Si l'utilisateur est connecté, il peut modifier les valeurs
$canEdit = false;
if (isset($_SESSION["loginUser"])) {
    $canEdit = true;
}
/* //TODO est ce qu'on garde ce truc ?
// Obtention de la liste des pays
$countries = getContries($bdd);
*/

// La vue
require ($INC_DIR. "/MVC_UDEPSI/view/edit_USER.php");