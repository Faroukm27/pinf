-- Création de la base de données
CREATE DATABASE IF NOT EXISTS transmaroc2i_v3;
USE transmaroc2i_v3;

-- 1. Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('client', 'admin') DEFAULT 'client',
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 2. Table des villes
CREATE TABLE villes (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    pays ENUM('France', 'Maroc'),
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- 3. Table des colis (Les objets à transporter)
CREATE TABLE colis (
    id INT(11) NOT NULL AUTO_INCREMENT,
    numero_suivi VARCHAR(50) NOT NULL UNIQUE,
    id_utilisateur INT(11),
    poids DECIMAL(10,2),
    statut ENUM('en_attente', 'en_transit', 'livre', 'annule') DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_colis_user FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
) ENGINE=InnoDB;

-- 4. Table des trajets (La feuille de route / Le camion)
CREATE TABLE trajets (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_colis INT(11) NOT NULL,
    id_ville INT(11) NOT NULL,
    ordre_etape INT(11) NOT NULL,    -- 1, 2, 3...
    type_etape ENUM('depart', 'etape', 'arrivee') NOT NULL,
    date_passage DATETIME,
    statut_etape ENUM('prevu', 'effectue', 'annule') DEFAULT 'prevu',
    PRIMARY KEY (id),
    CONSTRAINT fk_trajet_ville FOREIGN KEY (id_ville) REFERENCES villes(id),
    CONSTRAINT fk_colis FOREIGN KEY (id_colis) REFERENCES colis(id)
) ENGINE=InnoDB;

-- 5. LA TABLE CLÉ : Chargements (Fait le lien Colis <-> Trajet)
-- C'est ici que tu sais quel colis est transporté dans quel trajet
CREATE TABLE chargements (
    id_trajet INT(11) NOT NULL,
    id_colis INT(11) NOT NULL,
    date_chargement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_trajet, id_colis),
    CONSTRAINT fk_chargement_trajet FOREIGN KEY (id_trajet) REFERENCES trajets(id) ON DELETE CASCADE,
    CONSTRAINT fk_chargement_colis FOREIGN KEY (id_colis) REFERENCES colis(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 6. Historique (Tracking pour le client final)
CREATE TABLE historique_colis (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_colis INT(11) NOT NULL,
    description VARCHAR(255),
    date_evenement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_hist_colis FOREIGN KEY (id_colis) REFERENCES colis(id) ON DELETE CASCADE
) ENGINE=InnoDB;

