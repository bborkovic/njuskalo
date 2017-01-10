-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: njuskalo
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

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
  CONSTRAINT `ad_common_fields_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ad_common_fields_ibfk_2` FOREIGN KEY (`common_field_id`) REFERENCES `category_common_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_common_fields`
--

LOCK TABLES `ad_common_fields` WRITE;
/*!40000 ALTER TABLE `ad_common_fields` DISABLE KEYS */;
INSERT INTO `ad_common_fields` VALUES (27,40,59,'','Zagreb'),(28,40,60,'','10000'),(29,40,61,'','Benzin'),(30,40,62,'','1400ccm'),(31,40,63,'','80kW'),(32,40,64,'','100000');
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
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (40,58,1,'Prodajem skodu octaviu','default value','2016-08-10 13:18:38','2016-08-10 13:18:38'),(48,58,1,'title','desc','2016-09-19 10:36:57','2016-09-19 10:36:57'),(49,58,1,'title','desc','2016-09-19 10:39:38','2016-09-19 10:39:38');
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
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,4,'root',NULL),(58,4,'Auto Moto',''),(59,4,'Category2','Category2 ');
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
  `template_lov` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `common_field_id` (`common_field_id`),
  CONSTRAINT `category_common_fields_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_common_fields_ibfk_2` FOREIGN KEY (`common_field_id`) REFERENCES `common_fields` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_common_fields`
--

LOCK TABLES `category_common_fields` WRITE;
/*!40000 ALTER TABLE `category_common_fields` DISABLE KEYS */;
INSERT INTO `category_common_fields` VALUES (59,58,3,'Lokacija Vozila',NULL,NULL),(60,58,4,'Cijena',NULL,NULL),(61,58,5,'Motor',NULL,NULL),(62,58,6,'Radni obujam(ccm)',NULL,NULL),(63,58,7,'Snaga motora',NULL,NULL),(64,58,8,'Kilometri',NULL,NULL),(65,58,1,'Marka',NULL,NULL);
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
  `template_lov` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `common_fields`
--

LOCK TABLES `common_fields` WRITE;
/*!40000 ALTER TABLE `common_fields` DISABLE KEYS */;
INSERT INTO `common_fields` VALUES (1,'Marka',NULL,NULL),(2,'Model',NULL,NULL),(3,'Lokacija Vozila','LOV','Zagreb,Zagrebacka,Varazdinska,Vinkovacka'),(4,'Cijena',NULL,NULL),(5,'Motor',NULL,NULL),(6,'Radni obujam(ccm)',NULL,NULL),(7,'Snaga motora',NULL,NULL),(8,'Kilometri',NULL,NULL);
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
  CONSTRAINT `photographs_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photographs`
--

LOCK TABLES `photographs` WRITE;
/*!40000 ALTER TABLE `photographs` DISABLE KEYS */;
INSERT INTO `photographs` VALUES (22,40,'20160810132034_1_25.jpg','image/jpeg',190117,''),(25,40,'20160810132110_1_images (1).jpg','image/jpeg',7549,''),(26,40,'20160810132116_1_images.jpg','image/jpeg',7728,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bborkovic','pass','Boris','Borkovic',NULL,NULL,10450,NULL,'bborkovic@gmail.com'),(2,'leon','leon','BLA BLA','cla cla Cla',NULL,NULL,102,NULL,NULL),(3,'mborkovic','aaabbbccc','Marko','Borkovic',NULL,NULL,NULL,NULL,NULL),(4,'korisnik','pass','Janko','Borkovic',NULL,NULL,10450,NULL,NULL),(7,'korisnik2','pass1','First Name','Last Name',NULL,NULL,111235,NULL,NULL),(8,'testuser','testuser','testuser','testuser',NULL,NULL,10001,NULL,NULL);
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

-- Dump completed on 2017-01-10 14:59:49
