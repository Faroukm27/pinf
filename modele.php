<?php
include_once("maLibSQL.pdo.php"); 
// définit les fonctions SQLSelect, SQLUpdate...
// ==========================================
// STATISTIQUES POUR LE DASHBOARD ADMIN
// ==========================================

function getNbDepartsPrevus() {
    // On compte les trajets prévus (les camions qui ne sont pas encore partis)
    return SQLGetChamp("SELECT COUNT(*) FROM trajets WHERE type_etape = 'depart' AND statut_etape = 'prevu'");
}

function getNbColisEnAttente() {
    return SQLGetChamp("SELECT COUNT(*) FROM colis WHERE statut = 'en_attente'");
}

function getNbColisEnTransit() {
    return SQLGetChamp("SELECT COUNT(*) FROM colis WHERE statut = 'en_transit'");
}

function getNbColisLivres() {
    return SQLGetChamp("SELECT COUNT(*) FROM colis WHERE statut = 'livre'");
}


function getDerniersColis() {
    // Récupère les 5 derniers colis avec le nom du client
    $SQL = "SELECT c.numero_suivi, c.statut, c.date_creation, u.nom, u.prenom 
            FROM colis c 
            LEFT JOIN utilisateurs u ON c.id_utilisateur = u.id 
            ORDER BY c.date_creation DESC 
            LIMIT 5";
    return parcoursRs(SQLSelect($SQL));
}

function getVilles() {
    $SQL = "SELECT * FROM villes ORDER BY pays, nom";
    return parcoursRs(SQLSelect($SQL));
}

function addVille($nom, $pays) {
    $nom = addslashes($nom);
    $pays = addslashes($pays);
    $SQL = "INSERT INTO villes (nom, pays) VALUES ('$nom', '$pays')";
    return SQLInsert($SQL);
}

function deleteVille($id) {
    $SQL = "DELETE FROM villes WHERE id = '$id'";
    return SQLDelete($SQL);
}

function getClients() {
    // On récupère uniquement les utilisateurs qui ont le rôle 'client'
    $SQL = "SELECT * FROM utilisateurs WHERE role = 'client' ORDER BY nom, prenom";
    return parcoursRs(SQLSelect($SQL));
}

function supprimerClient($id_client) {
    $SQL = "DELETE FROM utilisateurs WHERE id = '$id_client'";
    return SQLDelete($SQL);
}