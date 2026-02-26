<?php
session_start();
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php"; 
include_once "libs/modele.php"; 

// --- CHARGEMENT DE PHPMAILER ---
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'libs/PHPMailer/Exception.php';
require_once 'libs/PHPMailer/PHPMailer.php';
require_once 'libs/PHPMailer/SMTP.php';

$addArgs = ""; 
$qs = array(); // Ce tableau construira l'URL de redirection finale

if ($action = valider("action"))
{
    ob_start(); 

    switch($action)
    {
        case 'Connexion':
            // Exemple de logique
            if ($login = valider("email"))
            if ($passe = valider("passe")) {
                $qs = ["view" => "admin", "msg" => "Bienvenue"];
            } else {
                $qs = ["view" => "login", "erreur" => "1"];
            }
            break;

        case 'Logout':
            session_unset();
            session_destroy();
            $qs = ["view" => "login"];
            break;

        case 'EnvoyerMessageContact':
            $nom = valider("nom");
            $email = valider("email"); // L'email de la personne qui écrit
            $message = valider("message");

            if ($nom && $email && $message) {
                $mail = new PHPMailer(true); // true permet d'activer les erreurs

                try {
                    // --- CONFIGURATION DU SERVEUR (À REMPLACER PAR LES VRAIS ACCÈS) ---
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com'; // Ex: smtp.gmail.com ou ssl0.ovh.net
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'testpinf1@gmail.com'; // Le vrai mail d'envoi
                    $mail->Password   = 'cudmvhrjbadroxie ';          // Le mot de passe
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // ou ENCRYPTION_STARTTLS
                    $mail->Port       = 465; // Souvent 465 pour SMTPS, ou 587 pour STARTTLS

                    // --- EXPÉDITEUR ET DESTINATAIRE ---
                    // Qui envoie physiquement le mail (doit souvent être = à Username pour éviter les spams)
                    $mail->setFrom('testpinf1@gmail.com', 'Site TransMaroc2i'); 
                    
                    // Qui reçoit le mail (le Gérant)
                    $mail->addAddress('testpinf1@gmail.com', 'Gérant TransMaroc2i'); 
                    
                    // Si le gérant clique sur "Répondre", ça écrira directement au client !
                    $mail->addReplyTo($email, $nom);

                    // --- CONTENU DU MAIL ---
                    $mail->isHTML(true); // Permet de mettre du gras, des sauts de ligne, etc.
                    $mail->Subject = "Nouveau message depuis le site transMaroc2i de : $nom";
                    $mail->Body    = "
                        <h2>Nouveau message de contact</h2>
                        <p><strong>Nom :</strong> $nom</p>
                        <p><strong>Email :</strong> $email</p>
                        <hr>
                        <p><strong>Message :</strong></p>
                        <p>" . nl2br(htmlspecialchars($message)) . "</p>
                    ";

                    // Go !
                    $mail->send();
                    
                    // Redirection avec succès
                    $qs = ["view" => "contact", "msg" => "Votre message a bien été envoyé !"];
                } catch (Exception $e) {
                    // Si le serveur SMTP refuse la connexion, on affiche l'erreur
                    $qs = ["view" => "contact", "erreur" => "Erreur technique lors de l'envoi : {$mail->ErrorInfo}"];
                }
            } else {
                $qs = ["view" => "contact", "erreur" => "Veuillez remplir tous les champs."];
            }
            break;

        case 'AjouterVille':
            $nom = valider("nom");
            $pays = valider("pays");

            if ($nom && $pays) {
                addVille($nom, $pays);
                $qs = ["view" => "admin_cities", "msg" => "La ville a bien été ajoutée !"];
            } else {
                $qs = ["view" => "admin_cities", "erreur" => "Veuillez remplir le nom et le pays."];
            }
            break;

        case 'SupprimerVille':
            $id = valider("id");
            if ($id) {
                deleteVille($id);
                $qs = ["view" => "admin_cities", "msg" => "La ville a été supprimée."];
            }
            break;
        // --- GESTION DES CLIENTS ---
        case 'SupprimerClient':
            $id = valider("id");
            if ($id) {
                supprimerClient($id);
                $qs = ["view" => "admin_clients", "msg" => "Le compte client a été supprimé."];
            }
            break;


    }
}

// ----------------------------------------------------
// REDIRECTION FINALE AUTOMATIQUE
// ----------------------------------------------------

if (!empty($qs)) {
    $addArgs = "?" . http_build_query($qs); // Transforme le tableau en ?view=...&msg=...
} else {
    $addArgs = "?view=accueil"; // Sécurité si aucun $qs n'est défini
}

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
header("Location:" . $urlBase . $addArgs);
ob_end_flush();
?>