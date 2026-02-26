<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/modele.php";

$view = valider("view");
if (!$view) $view = "accueil";

include "templates/header.php";


switch($view) {
    //Côté Client
    case "accueil":  include "templates/accueil.php"; break;
    case "login":    include "templates/login.php"; break;
    case "tracking": include "templates/client/tracking.php"; break;
    case "cities":   include "templates/client/cities.php"; break;
    case "contact":  include "templates/client/contact.php"; break;
    //Côté Admin
    case "admin":    include "templates/admin/dashboard.php"; break;
    case "admin_departs":    include "templates/admin/daparts.php"; break;
    case "admin_colis":    include "templates/admin/gestion_colis.php"; break;
    case "admin_cities":    include "templates/admin/cities.php"; break;
    case "admin_clients": include "templates/admin/gestion_clients.php"; break;

    //Erreur
    default:         echo "<h2 style='text-align:center; padding:50px;'>Erreur 404 : Page introuvable</h2>"; break;
}


include "templates/footer.php";
?>