-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;



-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Listage des données de la table forum.category : ~2 rows (environ)
INSERT INTO `category` (`id_category`, `categoryName`) VALUES
	(1, 'jardinage'),
	(2, 'automobile');



-- Listage de la structure de table forum. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '0',
  `pseudo` varchar(50) NOT NULL DEFAULT '0',
  `mdp` varchar(255) NOT NULL DEFAULT '0',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.membre : ~2 rows (environ)
INSERT INTO `membre` (`id_membre`, `email`, `pseudo`, `mdp`, `registrationDate`, `role`) VALUES
	(1, 'casper@example.com', 'casper', '0', '2024-12-23 15:00:06', 'admin'),
	(2, 'jasmine@example.com', 'jasmine', '0', '2024-12-23 15:00:17', 'moderateur');




-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `topicName` varchar(50) NOT NULL DEFAULT '0',
  `topicDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topicStatus` tinyint NOT NULL DEFAULT '0',
  `membre_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `id_membre` (`membre_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `topicName`, `topicDate`, `topicStatus`, `membre_id`, `category_id`) VALUES
	(1, 'vidange', '2024-12-23 15:06:00', 0, 1, 2),
	(2, 'taille rosiers', '2024-12-23 15:08:15', 0, 1, 1),
	(3, 'clignotant défectueux', '2024-12-23 15:08:57', 0, 2, 2),
	(4, 'semis tomates', '2024-12-23 15:09:23', 0, 2, 1);



-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `postContent` text NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int NOT NULL,
  `membre_id` int NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `membre_id` (`membre_id`),
  CONSTRAINT `FK_post_membre` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~12 rows (environ)
INSERT INTO `post` (`id_post`, `postContent`, `postDate`, `topic_id`, `membre_id`) VALUES
	(1, 'Quand doit être réalisée la vidange pour Citroen C1 ?', '2024-12-23 14:53:52', 1, 1),
	(2, 'Quelle période pour tailler ses rosiers?', '2024-12-23 15:04:51', 2, 1),
	(3, 'Les feux de ma Peugeot sont défectueux', '2024-12-23 15:06:15', 3, 2),
	(4, 'Pourquoi mes semis de tomates ne grandissent pas?', '2024-12-23 15:12:34', 4, 2),
	(5, 'La vidange doit être réalisée entre 10 000 km et 15 000 km si vous avez une essence, tous les 7 000 km si vous conduisez un diesel ou tous les ans si vous roulez moins.', '2024-12-23 15:21:06', 1, 2),
	(6, 'Merci pour ta réponse Jasmine !', '2024-12-23 15:22:42', 1, 1),
	(7, 'Le début du printemps est la période idéale pour la taille des rosiers, généralement entre février et mars, toujours en dehors des moments où il gèle.', '2024-12-23 15:23:49', 2, 2),
	(8, 'Merci pour ta réponse Jasmine !', '2024-12-23 15:25:52', 2, 1),
	(9, 'Si les lumières du clignotant ne s\'allument pas du tout, cela peut indiquer un problème avec le système électrique, l\'ampoule ou le relais.', '2024-12-23 15:27:12', 3, 1),
	(10, 'Merci pour ta réponse Casper !', '2024-12-23 15:29:52', 3, 2),
	(11, 'Un sol trop pauvre. Des pieds à la tige fine, au feuillage peu fourni ou jaune, qui se développent peu, peuvent indiquer un problème de nutrition, une carence en nutriments. La tomate est une plante gourmande, qui a besoin d\'un sol riche pour bien se développer et donner de beaux fruits.', '2024-12-23 15:31:02', 4, 1),
	(12, 'Merci pour ta réponse Casper !', '2024-12-23 15:31:36', 4, 2);



/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
