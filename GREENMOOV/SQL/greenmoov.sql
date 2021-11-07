DROP DATABASE IF EXISTS `GREENMOOV`;
CREATE DATABASE `GREENMOOV`; 
USE `GREENMOOV`;

SET NAMES utf8 ;
SET character_set_client = utf8mb4 ;

CREATE TABLE `users_table` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut_id` tinyint(4) DEFAULT '1',
  `date` date DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `sexe` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `users_table` (prenom, nom, email, tel, password, statut_id) VALUES ('admin','admin','admin','admin', '$2y$10$mf6a3lS8Q0hX7gfEvMmqveBwYg4USxVpxEi7hqAWMXL1BhPPjZZ7S', 3);
INSERT INTO `users_table` (prenom, nom, email, tel, password, statut_id) VALUES ('membre','membre','membre','membre', '$2y$10$mf6a3lS8Q0hX7gfEvMmqveBwYg4USxVpxEi7hqAWMXL1BhPPjZZ7S', 2);
INSERT INTO `users_table` (prenom, nom, email, tel, password, statut_id) VALUES ('visiteur','visiteur','visiteur','visiteur', '$2y$10$mf6a3lS8Q0hX7gfEvMmqveBwYg4USxVpxEi7hqAWMXL1BhPPjZZ7S', 1);

CREATE TABLE `orders` (
  `commande_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `commande_date` date NOT NULL,
  `livraison_date` date DEFAULT NULL,
  `panier` int(20) NOT NULL,  
  `payement` VARCHAR(50) NOT NULL,
  `donation` tinyint(2) DEFAULT NULL,
  `deja_paye` tinyint(2) DEFAULT NULL, 
  `commentaire` varchar(2000) DEFAULT NULL,
  `statut_commande` varchar(50) DEFAULT 'En cours',
  PRIMARY KEY (`commande_id`),
  `user_id` int REFERENCES `users_table`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `events` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `date_heure` DATETIME NOT NULL,
  `durée` varchar(10) DEFAULT NULL,
  `titre` varchar(50) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `lieu` varchar(20) DEFAULT NULL,
  `max_participants` int(50) NOT NULL,
  `prix` varchar(20) DEFAULT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `events` (date_heure, durée, titre, contenu, lieu, max_participants, prix) VALUES ('2021-09-20 15:00:00','2:00','Conférence sur les plantes','Veznez partager votre amour pour les plantes avec des personnes spécialisées dans la bio.', 'TG-202', 20, 5);

CREATE TABLE `news` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(300) NOT NULL,
  `sous_titre` VARCHAR(200) DEFAULT NULL,
  `a_link` VARCHAR(200) DEFAULT NULL,
  `a_titre` varchar(200) DEFAULT NULL,
  `a_content` varchar(2000) DEFAULT NULL,
  `a_image` varchar(200) DEFAULT NULL,
  `date` DATETIME NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `news` (titre, sous_titre, a_link, a_titre, a_content, a_image, date) VALUES ('Vous souhaitez acheter plus écolo ? Marre de descendre la poubelle tous les jours ?','Voici notre article pour vous sauver !','https://telegra.ph/Acheter-sans-emballages-01-20','Acheter sans emballages', "Avec 75kg d'emballages consommés annuellement par les français, les emballages représentent 20% de l'ensemble des déchets ménagers ! Pour répondre à ce problème on peut acheter en vrac. Acheter en vrac, c’est acheter en se souciant de l’environnement.", 'https://telegra.ph/file/bed8b73e26900e9c7a6ea.png', '2021-06-08 11:30:00');
INSERT INTO `news` (titre, sous_titre, a_link, a_titre, a_content, a_image, date) VALUES ('Vous souhaitez acheter plus écolo ? Marre de descendre la poubelle tous les jours ?','Voici notre article pour vous sauver !','https://telegra.ph/Acheter-sans-emballages-01-20','Acheter sans emballages', "Avec 75kg d'emballages consommés annuellement par les français, les emballages représentent 20% de l'ensemble des déchets ménagers ! Pour répondre à ce problème on peut acheter en vrac. Acheter en vrac, c’est acheter en se souciant de l’environnement.", 'https://telegra.ph/file/bed8b73e26900e9c7a6ea.png', '2021-06-08 11:30:00');
INSERT INTO `news` (titre, sous_titre, a_link, a_titre, a_content, a_image, date) VALUES ('Vous souhaitez acheter plus écolo ? Marre de descendre la poubelle tous les jours ?','Voici notre article pour vous sauver !','https://telegra.ph/Acheter-sans-emballages-01-20','Acheter sans emballages', "Avec 75kg d'emballages consommés annuellement par les français, les emballages représentent 20% de l'ensemble des déchets ménagers ! Pour répondre à ce problème on peut acheter en vrac. Acheter en vrac, c’est acheter en se souciant de l’environnement.", 'https://telegra.ph/file/bed8b73e26900e9c7a6ea.png', '2021-06-08 11:30:00');

CREATE TABLE `inscription_event` (
  `inscription_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`inscription_id`),
  `user_id` int REFERENCES `users_table`(`id`),
  `event_id` int REFERENCES `events`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `panier` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `légumes` VARCHAR(50) NOT NULL,
  `quantité`VARCHAR(50) NOT NULL,
  `unité` VARCHAR(50) NOT NULL,
  `type` INT(10) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('pommes de terre', '700', 'g', 10);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('carottes', '500', 'g', 10);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('navets', '500', 'g', 10);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('poireaux', '1', 'p', 10);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('butternut', '1', 'p', 10);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('pommes de terre', '1000', 'g', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('carottes', '1000', 'g', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('navets', '500', 'g', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('oignons', '500', 'g', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('poireaux', '1', 'p', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('butternut', '2', 'p', 20);
INSERT INTO `panier`(légumes, quantité, unité, type) VALUES ('chou blanc', '1', 'p', 20);

