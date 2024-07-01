-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: appsalon_mvc
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citas_ibfk_1` (`usuario_id`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (2,'2024-06-30','11:00:00',3),(3,'2024-07-17','15:00:00',3),(4,'2024-07-30','17:00:00',4),(5,'2024-07-22','12:50:00',5);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas_servicios`
--

DROP TABLE IF EXISTS `citas_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `citas_servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cita_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cita_id` (`cita_id`),
  KEY `servicio_id` (`servicio_id`),
  CONSTRAINT `citas_servicios_ibfk_1` FOREIGN KEY (`cita_id`) REFERENCES `citas` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `citas_servicios_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas_servicios`
--

LOCK TABLES `citas_servicios` WRITE;
/*!40000 ALTER TABLE `citas_servicios` DISABLE KEYS */;
INSERT INTO `citas_servicios` VALUES (2,2,2),(3,2,7),(4,3,5),(5,4,2),(6,4,5),(7,5,4),(8,5,1),(9,5,9),(10,5,10);
/*!40000 ALTER TABLE `citas_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'Corte de Cabello Mujer',160.00),(2,'Corte de Cabello Hombre',100.00),(3,'Corte de Cabello Niño',80.00),(4,'Peinado Mujer',80.00),(5,'Peinado Hombre',60.00),(6,'Peinado Niño',60.00),(7,'Corte de Barba',60.00),(8,'Tinte Mujer',300.00),(9,'Pintado de Uñas',400.00),(10,'Lavado de Cabello',50.00),(11,'Tratamiento Capilar',150.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Admin','SuperPorderoso','admin@gmail.com','$2y$10$PXk900wc42x8fjGfQWwPuuNraKl5d8A8RSgkeHQHhmIK5Bq6M334O','12345678',1,1,NULL),(2,' Laura','Oseguera','sofiaoseguera111@gmail.com','$2y$10$PXk900wc42x8fjGfQWwPuuNraKl5d8A8RSgkeHQHhmIK5Bq6M334O','19203856',0,0,'666fa2bccca1a '),(3,'Carlos','Ramos','carlosramos14@gmail.com','$2y$10$HeU9E5vCf8OZPpb.Y8AflObmEz1TQk/28aSdjMKPLzKAPzcumospa','91456780',0,1,''),(4,'Andoni','Hernandez','andonihernandez1990@gmail.com','$2y$10$PXk900wc42x8fjGfQWwPuuNraKl5d8A8RSgkeHQHhmIK5Bq6M334O','97940675',0,1,NULL),(5,' Sofía','Ramírez','sofia.ramirez@example.com','$2y$10$mcDu48SUsb963QV8x/DC/.Y2U.7e3yD4jjwp6/SemMDuuRz68sYTu','55443322',0,1,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'appsalon_mvc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-30 22:24:09
