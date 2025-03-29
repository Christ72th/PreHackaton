/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.32-MariaDB : Database - hackaton
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hackaton` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `hackaton`;

/*Table structure for table `avis` */

DROP TABLE IF EXISTS `avis`;

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text DEFAULT NULL,
  `date_publication` timestamp NOT NULL DEFAULT current_timestamp(),
  `note` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_projet` char(7) DEFAULT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_projet` (`id_projet`),
  CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `avis` */

/*Table structure for table `engagements` */

DROP TABLE IF EXISTS `engagements`;

CREATE TABLE `engagements` (
  `id_engagement` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `tarif_negocie` decimal(10,2) DEFAULT NULL,
  `nom_utilisateur` varchar(255) DEFAULT NULL,
  `id_projet` char(7) DEFAULT NULL,
  PRIMARY KEY (`id_engagement`),
  KEY `nom_utilisateur` (`nom_utilisateur`),
  KEY `id_projet` (`id_projet`),
  CONSTRAINT `engagements_ibfk_1` FOREIGN KEY (`nom_utilisateur`) REFERENCES `freelances` (`nom_utilisateur`),
  CONSTRAINT `engagements_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `engagements` */

/*Table structure for table `freelances` */

DROP TABLE IF EXISTS `freelances`;

CREATE TABLE `freelances` (
  `nom_utilisateur` varchar(255) NOT NULL,
  `descriptions` text DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `tarif_journalier` decimal(10,2) DEFAULT NULL,
  `numero_telephone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `localisation` varchar(100) DEFAULT NULL,
  `domaine_competence` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nom_utilisateur`),
  CONSTRAINT `freelances_ibfk_1` FOREIGN KEY (`nom_utilisateur`) REFERENCES `utilisateurs` (`nom_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `freelances` */

insert  into `freelances`(`nom_utilisateur`,`descriptions`,`competences`,`tarif_journalier`,`numero_telephone`,`email`,`localisation`,`domaine_competence`,`cv`,`photo_profil`) values 
('angel',NULL,NULL,NULL,'1223444','kn@gmail.com',NULL,NULL,NULL,NULL),
('christian',NULL,NULL,NULL,'658083646','christianeyebe@gmail.com',NULL,NULL,NULL,NULL),
('gel',NULL,NULL,NULL,'672760700','keq@gmail.com',NULL,NULL,NULL,NULL),
('glrs','html, css, js, php, ...',NULL,NULL,'672760700','glrs@kag.com','ngousso','dev web','',NULL);

/*Table structure for table `projets` */

DROP TABLE IF EXISTS `projets`;

CREATE TABLE `projets` (
  `id_projet` char(7) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `descriptions` text DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `url_executable` varchar(255) DEFAULT NULL,
  `url_images` varchar(255) DEFAULT NULL,
  `url_readme` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url_code_source` varchar(255) DEFAULT NULL,
  `statut` enum('Debut','En_cours','Termine') DEFAULT NULL,
  `nom_utilisateur_f` varchar(255) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `budget_estime` decimal(10,0) DEFAULT NULL,
  `competences_requises` text DEFAULT NULL,
  `technologies_utilisees` text DEFAULT NULL,
  `niveau_experience` enum('debutant','intermediare') DEFAULT NULL,
  `type_collaboration` enum('Benevolat','Remuneration','Partenariat') DEFAULT NULL,
  `lien_depot` varchar(255) DEFAULT NULL,
  `ressources_supplementaires` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_projet`),
  KEY `ibkf_freelances` (`nom_utilisateur_f`),
  CONSTRAINT `ibkf_freelances` FOREIGN KEY (`nom_utilisateur_f`) REFERENCES `freelances` (`nom_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `projets` */

insert  into `projets`(`id_projet`,`titre`,`descriptions`,`date_debut`,`date_fin`,`url_executable`,`url_images`,`url_readme`,`url_code_source`,`statut`,`nom_utilisateur_f`,`duree`,`budget_estime`,`competences_requises`,`technologies_utilisees`,`niveau_experience`,`type_collaboration`,`lien_depot`,`ressources_supplementaires`) values 
('10E9671','hackaton','','2025-03-27','2025-03-27','','','ReadmeUpload/readme.txt','SourceUpload/ProjetHackaton.zip','Termine','angel',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('15F3538','Projet html','Ptit projet html, css, php','2025-03-23','2025-03-23','ExecutablesUpload/','ImagesUpload/','ReadmeUpload/COPYING.txt','SourceUpload/','En_cours','christian',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('38G7251','hack','hackaton','2025-03-27','2025-03-27','ExecutablesUpload/rufus-4.1.exe','ImagesUpload/Capture_ecran .png','ReadmeUpload/readme.txt','','En_cours','christian',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('54N7060','test','ras','2025-03-28','2025-03-28','uploads/projets/ProjetHackaton.zip','uploads/images/Capturedcran1.png','uploads/readmes/readme.txt',NULL,'En_cours','angel',NULL,50000,'dev','html','debutant','Benevolat','',''),
('54V4038','succes','sa marche','2025-03-29','2025-03-29',NULL,NULL,NULL,NULL,'Termine','angel',NULL,300000,'dev web','html, css, php, JV','','Partenariat','',''),
('69J2733','test','just for try','2025-03-28','2025-03-28','uploads/projets/ProjetHackaton_1.zip','uploads/images/me.jpg','uploads/readmes/readme_1.txt',NULL,'En_cours','angel',NULL,50000,'designer ux','html, php','','Partenariat','',''),
('84U5338','succes1','ca marche +','2025-03-29','2025-03-29','uploads/projets/ProjetHackaton_2.zip','uploads/images/WIN_20240625_22_24_58_Pro.jpg','uploads/readmes/readme_2.txt',NULL,'Termine','angel',NULL,300000,'dev web (back & front)','html, css, php, jv, sql','','Remuneration','','');

/*Table structure for table `sponsors` */

DROP TABLE IF EXISTS `sponsors`;

CREATE TABLE `sponsors` (
  `nom_utilisateur` varchar(255) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nom_utilisateur`),
  CONSTRAINT `sponsors_ibfk_1` FOREIGN KEY (`nom_utilisateur`) REFERENCES `utilisateurs` (`nom_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sponsors` */

insert  into `sponsors`(`nom_utilisateur`,`numero`,`email`) values 
('chris','658083646','christianeyebe27@gmail.com');

/*Table structure for table `utilisateurs` */

DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `ville_residence` varchar(255) DEFAULT NULL,
  `nom_utilisateur` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `numero_telephone` varchar(20) DEFAULT NULL,
  `roles` enum('sponsor','visiteur','freelance') DEFAULT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp(),
  `localisation` varchar(100) DEFAULT NULL,
  `domaine_competence` varchar(255) DEFAULT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `utilisateurs` */

insert  into `utilisateurs`(`id_utilisateur`,`nom`,`prenom`,`date_naissance`,`ville_residence`,`nom_utilisateur`,`mot_de_passe`,`email`,`numero_telephone`,`roles`,`date_inscription`,`localisation`,`domaine_competence`,`descriptions`,`photo_profil`,`cv`) values 
(1,'Eyebe','Christian','0000-00-00','Yaounde','chris','12345','christianeyebe27@gmail.com','658083646','sponsor','2025-03-13 11:44:20',NULL,NULL,NULL,NULL,NULL),
(3,'Eyebe','Christian','0000-00-00','Yaounde','christian','12345','christianeyebe@gmail.com','658083646','freelance','2025-03-19 00:52:20',NULL,NULL,NULL,NULL,NULL),
(4,'angel','kag','2025-03-24','yaounde','angel','123qwe ','kn@gmail.com','1223444','freelance','2025-03-24 06:59:24',NULL,NULL,NULL,NULL,NULL),
(5,'kag','gel','2025-03-03','yaounde','gel','qwerty','keq@gmail.com','672760700','freelance','2025-03-24 07:12:05',NULL,NULL,NULL,NULL,NULL),
(6,'dior','kag','2025-03-07','yaounde','dior','qwerty','knmgnngglrs@gmail.com','672760700','freelance','2025-03-28 17:47:06','ngousso','dev web','html, css, js, php, ...','',''),
(9,'glrs','kag','2025-03-07','yaounde','glrs','bonita','glrs@kag.com','672760700','freelance','2025-03-28 18:07:01','ngousso','dev web','html, css, js, php, ...','','');

/*Table structure for table `visites_projets` */

DROP TABLE IF EXISTS `visites_projets`;

CREATE TABLE `visites_projets` (
  `id_visite` int(11) NOT NULL AUTO_INCREMENT,
  `id_visiteur` int(11) DEFAULT NULL,
  `id_projet` char(7) DEFAULT NULL,
  PRIMARY KEY (`id_visite`),
  KEY `id_visiteur` (`id_visiteur`),
  KEY `id_projet` (`id_projet`),
  CONSTRAINT `visites_projets_ibfk_1` FOREIGN KEY (`id_visiteur`) REFERENCES `visiteurs` (`id_visiteur`),
  CONSTRAINT `visites_projets_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `visites_projets` */

/*Table structure for table `visiteurs` */

DROP TABLE IF EXISTS `visiteurs`;

CREATE TABLE `visiteurs` (
  `id_visiteur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `visiteurs` */

insert  into `visiteurs`(`id_visiteur`,`email`) values 
(1,'christianeyebe72@gmail.com'),
(2,'kn@gmail.com'),
(3,'kn@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
