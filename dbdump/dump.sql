-- MySQL dump 10.13  Distrib 5.7.14, for osx10.11 (x86_64)
--
-- Host: localhost    Database: njuskalo
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ad_common_fields`
--

DROP TABLE IF EXISTS `ad_common_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_common_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `common_field_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`),
  KEY `common_field_id` (`common_field_id`),
  CONSTRAINT `ad_common_fields_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`),
  CONSTRAINT `ad_common_fields_ibfk_2` FOREIGN KEY (`common_field_id`) REFERENCES `category_common_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_common_fields`
--

LOCK TABLES `ad_common_fields` WRITE;
/*!40000 ALTER TABLE `ad_common_fields` DISABLE KEYS */;
INSERT INTO `ad_common_fields` VALUES (16,38,7,'','Varaždinska'),(17,38,8,'','60000'),(18,38,9,'','Dizel'),(19,38,10,'','12100 Eur'),(20,38,11,'','Octavia I'),(21,39,7,'','Zadarska'),(22,39,8,'','180000 km'),(23,39,9,'','Dizel'),(24,39,10,'','2999 Eur'),(25,39,11,'','Octavia I'),(26,39,12,'','1400ccm');
/*!40000 ALTER TABLE `ad_common_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (38,48,2,'Škoda Octavia II, odlična i ... skoro nova ili','Auto je odličan, 1.9 SDI\r\n\r\nPrvi vlasnik, registriran prije nešto više od tri mjeseca .. bla bla','2016-08-07 15:19:17','2016-08-07 15:19:17'),(39,48,2,'Prodajem Octaviu 1.9 TDI, 180000 km, samo 3000 Eur','Prodajem Octaviu 1.9 TDI, 180000 km, samo 3000 Eur','2016-08-07 23:12:06','2016-08-07 23:12:06');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_cat_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_cat_id` (`parent_cat_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_cat_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,4,'root',NULL),(5,4,'Auto Moto',NULL),(6,4,'Nekretnine',NULL),(7,4,'Usluge',NULL),(8,4,'Informatika',NULL),(9,5,'Osobni Automobili',NULL),(10,5,'Motocikli',NULL),(11,5,'Gospodarska vozila',NULL),(12,5,'Kamperi',NULL),(13,6,'Prodaja kuca',NULL),(14,6,'Prodaja stanova',NULL),(15,6,'Prodaja zemljista',NULL),(16,8,'PC racunala',NULL),(17,8,'Monitori',NULL),(18,8,'PC Komponente',NULL),(19,8,'Mac',NULL),(20,9,'Alfa Romeo',NULL),(21,9,'Skoda',NULL),(22,9,'VW',NULL),(23,9,'Rover',NULL),(24,9,'Peugeot',NULL),(25,9,'Suzuki','desc'),(26,9,'BMW',''),(27,9,'Mercedes','bla'),(28,9,'Audi',''),(29,9,'Rover',''),(30,9,'Fiat','fiat'),(33,9,'Lada',''),(34,7,'Muške usluge',''),(35,10,'Novi',''),(36,10,'Stari',''),(37,11,'Nova',''),(38,11,'Stara',''),(39,12,'Novi',''),(40,12,'Stari',''),(41,9,'Ladač',''),(42,9,'čćžšđ',''),(43,9,'ČĆŽŠĐ',''),(44,9,'č',''),(45,9,'ć',''),(46,5,'Bicikli',''),(47,18,'Grafičke Kartice',''),(48,21,'Octavia',''),(49,21,'Fabia',''),(50,21,'Superb','');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_common_fields`
--

DROP TABLE IF EXISTS `category_common_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_common_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `common_field_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `template_type` varchar(100) DEFAULT NULL,
  `template_lov` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `common_field_id` (`common_field_id`),
  CONSTRAINT `category_common_fields_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `category_common_fields_ibfk_2` FOREIGN KEY (`common_field_id`) REFERENCES `common_fields` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_common_fields`
--

LOCK TABLES `category_common_fields` WRITE;
/*!40000 ALTER TABLE `category_common_fields` DISABLE KEYS */;
INSERT INTO `category_common_fields` VALUES (1,20,1,'Marka','LOV',''),(2,20,2,'Model','LOV',''),(3,20,3,'Lokacija Vozila','LOV','Zagreb,Zagrebačka,Karkovačka,Varaždinska,Vinkovačka,Zadarska'),(4,20,4,'Cijena',NULL,NULL),(5,20,5,'Motor',NULL,NULL),(6,47,4,'Cijena',NULL,NULL),(7,48,3,'Lokacija Vozila','LOV','Zagreb,Zagrebačka,Karkovačka,Varaždinska,Vinkovačka,Zadarska'),(8,48,8,'Kilometri','Normal,Number',''),(9,48,5,'Motor','LOV','Benzin,Dizel'),(10,48,4,'Cijena','Normal,Number',''),(11,48,1,'Marka','LOV','Octavia I,Octavia II,Octavia III'),(12,48,6,'Radni obujam(ccm)','LOV','1000ccm,1200ccm,1400ccm,1600ccm');
/*!40000 ALTER TABLE `category_common_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chars`
--

DROP TABLE IF EXISTS `chars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chars` (
  `a` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chars`
--

LOCK TABLES `chars` WRITE;
/*!40000 ALTER TABLE `chars` DISABLE KEYS */;
INSERT INTO `chars` VALUES ('aaa'),('č'),('ć'),('čćžšđ'),('ČĆŽŠĐ');
/*!40000 ALTER TABLE `chars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `common_fields`
--

DROP TABLE IF EXISTS `common_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `common_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `template_type` varchar(100) DEFAULT NULL,
  `template_lov` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `common_fields`
--

LOCK TABLES `common_fields` WRITE;
/*!40000 ALTER TABLE `common_fields` DISABLE KEYS */;
INSERT INTO `common_fields` VALUES (1,'Marka',NULL,NULL),(2,'Model',NULL,NULL),(3,'Lokacija Vozila',NULL,NULL),(4,'Cijena',NULL,NULL),(5,'Motor',NULL,NULL),(6,'Radni obujam(ccm)',NULL,NULL),(7,'Snaga motora',NULL,NULL),(8,'Kilometri',NULL,NULL);
/*!40000 ALTER TABLE `common_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photographs`
--

DROP TABLE IF EXISTS `photographs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photographs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `caption` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`),
  CONSTRAINT `photographs_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photographs`
--

LOCK TABLES `photographs` WRITE;
/*!40000 ALTER TABLE `photographs` DISABLE KEYS */;
INSERT INTO `photographs` VALUES (17,38,'20160807231004_2_2.jpeg','image/jpeg',6452,'2'),(18,38,'20160807231022_2_4.jpg','image/jpeg',197662,'4'),(19,38,'20160807231033_2_octavia4.jpeg','image/jpeg',7667,'octavia1'),(20,39,'20160807231227_2_skoda_octavia_estate_2014.jpg','image/jpeg',121953,''),(21,39,'20160807231235_2_skoda-octavia-3.jpg','image/jpeg',222013,'');
/*!40000 ALTER TABLE `photographs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `adress` varchar(100) DEFAULT NULL,
  `post_number` int(10) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bborkovic','pass',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'leon','leon',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-07 23:17:02
