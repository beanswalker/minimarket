CREATE DATABASE  IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `store`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	5.7.21-1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `idcategory` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_article`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_article_category_idx` (`idcategory`),
  CONSTRAINT `fk_article_category` FOREIGN KEY (`idcategory`) REFERENCES `category` (`idcategory`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,3,NULL,'reloj Casio deportivo Azul',2,'Relojes',NULL,1),(2,7,NULL,'Shampoo Fresh H&S Manzana',4,'Shampoo Anticaspa',NULL,1),(3,1,NULL,'camisa Ofcorse manga larga negro S',1,'Camisa casual',NULL,1),(4,1,NULL,'camisa J&R Manga larga blanco M',2,'Camisa Elegante',NULL,1),(5,6,NULL,'Jean marca Gato azul 32',2,'Jeans Casuales',NULL,1),(6,6,NULL,'Jean marca gato azul 28',3,'Jeans Casuales',NULL,1);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idcategory`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Camisa H','Camisas Para Hombre',0),(2,'Camisa M','Camisas Para Mujer',1),(3,'Reloj U','Relojes Unisex',1),(4,'Botas H','Botas Para Hombre',1),(5,'Pantalon H','Pantalones Para Hombre',1),(6,'Pantalon M','Pantalones Para Mujer',1),(7,'Shampoo UP','Shampoo Uso Personal',1),(8,'Shampoo UV','Shampoo Uso Veretinario',1),(9,'Jabón AP','Jabón de aseo personal',1),(10,'Jabon UV','Jabon de uso veterinario',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_entry`
--

DROP TABLE IF EXISTS `detail_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_entry` (
  `id_detail_entry` int(11) NOT NULL AUTO_INCREMENT,
  `id_entry` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `cantidad_articles` int(11) NOT NULL,
  `price_purchase` decimal(11,2) NOT NULL,
  `price_sale` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id_detail_entry`),
  KEY `fk_detail_entry_entry_idx` (`id_entry`),
  KEY `fk_detail_entry_article_idx` (`id_article`),
  CONSTRAINT `fk_detail_entry_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_entry_entry` FOREIGN KEY (`id_entry`) REFERENCES `entry` (`id_entry`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_entry`
--

LOCK TABLES `detail_entry` WRITE;
/*!40000 ALTER TABLE `detail_entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_sale`
--

DROP TABLE IF EXISTS `detail_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detail_sale` (
  `id_detail_sale` int(11) NOT NULL AUTO_INCREMENT,
  `id_sale` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `cantidad_articles` int(11) NOT NULL,
  `price_sale` decimal(11,2) NOT NULL,
  `discount` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id_detail_sale`),
  KEY `fk_detail_sale_idx` (`id_sale`),
  KEY `fk_detail_article_idx` (`id_article`),
  CONSTRAINT `fk_detail_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detail_sale` FOREIGN KEY (`id_sale`) REFERENCES `sale` (`id_sale`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sale`
--

LOCK TABLES `detail_sale` WRITE;
/*!40000 ALTER TABLE `detail_sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry` (
  `id_entry` int(11) NOT NULL AUTO_INCREMENT,
  `id_provider` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_voucher` varchar(20) NOT NULL,
  `serie_voucher` varchar(7) DEFAULT NULL,
  `num_voucher` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  `tax` decimal(4,2) DEFAULT NULL,
  `total_purchase` decimal(11,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_entry`),
  KEY `fk_provider_entry_idx` (`id_provider`),
  KEY `fk_user_entry_idx` (`id_user`),
  CONSTRAINT `fk_provider_entry` FOREIGN KEY (`id_provider`) REFERENCES `person` (`idperson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_entry` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry`
--

LOCK TABLES `entry` WRITE;
/*!40000 ALTER TABLE `entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id_permission` int(11) NOT NULL AUTO_INCREMENT,
  `name_permission` varchar(30) NOT NULL,
  PRIMARY KEY (`id_permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `idperson` int(11) NOT NULL AUTO_INCREMENT,
  `typeperson` varchar(20) NOT NULL,
  `nameperson` varchar(100) NOT NULL,
  `typedocument` varchar(20) NOT NULL,
  `numdocument` varchar(20) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idperson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sale` (
  `id_sale` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_voucher` varchar(20) DEFAULT NULL,
  `serie_voucher` varchar(7) DEFAULT NULL,
  `num_voucher` varchar(10) NOT NULL,
  `date_sale` datetime NOT NULL,
  `tax` decimal(4,2) NOT NULL,
  `total_sale` decimal(11,2) NOT NULL,
  `status` enum('pendiente','pagado','finalizado','enviado','cancelado') NOT NULL,
  PRIMARY KEY (`id_sale`),
  KEY `fk_sale_person_idx` (`id_client`),
  KEY `fk_sale_user_idx` (`id_user`),
  CONSTRAINT `fk_sale_person` FOREIGN KEY (`id_client`) REFERENCES `person` (`idperson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sale_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale`
--

LOCK TABLES `sale` WRITE;
/*!40000 ALTER TABLE `sale` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(100) NOT NULL,
  `type_document_user` varchar(20) NOT NULL,
  `num_document_user` varchar(20) NOT NULL,
  `address_user` varchar(80) DEFAULT NULL,
  `phone_user` varchar(20) DEFAULT NULL,
  `email_user` varchar(50) DEFAULT NULL,
  `perfil_user` varchar(20) DEFAULT NULL,
  `login_user` varchar(45) NOT NULL,
  `password_user` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `login_user_UNIQUE` (`login_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `id_user_permission` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL,
  PRIMARY KEY (`id_user_permission`),
  KEY `fk_user_permission_user_idx` (`id_user`),
  KEY `fk_user_permission_permission_idx` (`id_permission`),
  CONSTRAINT `fk_user_permission_permission` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id_permission`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_permission_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'store'
--

--
-- Dumping routines for database 'store'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-13 16:23:14
