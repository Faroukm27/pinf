<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TransMaroc2i</title>
    <link rel="stylesheet" href="css/style_global.css"> 
    
    <?php 
        // Si on est sur une page admin, on charge le CSS admin
        if (strpos($view, 'admin') !== false) {
            echo '<link rel="stylesheet" href="css/style_admin.css">';
        } else {
            // Sinon, on charge le CSS client
            echo '<link rel="stylesheet" href="css/style_client.css">';
        }
    ?>
</head>
<body>

<header>
    <div class="logo">
        <h2><a href="index.php?view=accueil">TransMaroc2i</a></h2>
    </div>
    
    <nav>
        <ul>
            <?php
            // On vérifie si quelqu'un est connecté et on récupère son rôle
            $connecte = isset($_SESSION["connecte"]) && $_SESSION["connecte"] === true;
            $role = isset($_SESSION["role"]) ? $_SESSION["role"] : "";

            // ---------------------------------------------------------
            // 1. MENU POUR L'ADMINISTRATEUR
            // ---------------------------------------------------------
            if ($connecte && $role === "admin") {
                echo '<li><a href="index.php?view=admin_dashboard">Dashboard</a></li>';
                echo '<li><a href="index.php?view=admin_departs">Départs Camions</a></li>';
                echo '<li><a href="index.php?view=admin_cities">Villes</a></li>';
                echo '<li><a href="index.php?view=admin_clients">Clients</a></li>';
                // Le lien de déconnexion pointe vers le controleur !
                echo '<li><a href="controleur.php?action=Logout">Déconnexion</a></li>';
            } 
            
            // ---------------------------------------------------------
            // 2. MENU POUR LE CLIENT CONNECTÉ
            // ---------------------------------------------------------
            elseif ($connecte && $role === "client") {
                echo '<li><a href="index.php?view=accueil">Accueil</a></li>';
                echo '<li><a href="index.php?view=tracking">Suivre un colis</a></li>'; // Changé
                echo '<li><a href="index.php?view=reserve">Envoyer un colis</a></li>';
                echo '<li><a href="index.php?view=cities">Nos villes</a></li>'; // Ajouté !
                echo '<li><a href="index.php?view=contact">Contact</a></li>'; // Ajouté !
                echo '<li><a href="index.php?view=dashboard"><b>Mon Espace</b></a></li>'; // Mis en valeur
                echo '<li><a href="controleur.php?action=Logout">Déconnexion</a></li>';
            }
            
            // ---------------------------------------------------------
            // 3. MENU PUBLIC (VISITEUR NON CONNECTÉ)
            // ---------------------------------------------------------
            else {
                echo '<li><a href="index.php?view=accueil">Accueil</a></li>';
                echo '<li><a href="index.php?view=tracking">Suivre un colis</a></li>';
                echo '<li><a href="index.php?view=cities">Nos villes</a></li>';
                echo '<li><a href="index.php?view=contact">Contact</a></li>';
                echo '<li><a href="index.php?view=login">Connexion / Inscription</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<main>