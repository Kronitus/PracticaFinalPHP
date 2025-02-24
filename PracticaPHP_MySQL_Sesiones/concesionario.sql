-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: concesionario
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `alquileres`
--

DROP TABLE IF EXISTS `alquileres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alquileres` (
  `id_alquiler` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `id_coche` int(10) unsigned DEFAULT NULL,
  `prestado` datetime DEFAULT NULL,
  `devuelto` datetime DEFAULT NULL,
  PRIMARY KEY (`id_alquiler`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_coche` (`id_coche`),
  CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id_coche`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alquileres`
--

LOCK TABLES `alquileres` WRITE;
/*!40000 ALTER TABLE `alquileres` DISABLE KEYS */;
INSERT INTO `alquileres` VALUES (1,1,3,'2024-12-01 10:00:00',NULL),(2,2,5,'2024-11-25 14:30:00','2024-12-27 09:00:00'),(9,9,6,'2024-11-23 10:00:00','2024-11-30 10:00:00'),(18,8,2,'2024-12-01 09:00:00',NULL),(20,10,9,'2024-11-29 14:00:00',NULL),(23,20,4,'2025-02-20 12:54:25',NULL),(24,20,6,'2025-02-23 18:58:23','2025-02-23 18:59:44'),(25,20,10,'2025-02-23 18:58:29','2025-02-23 18:59:44');
/*!40000 ALTER TABLE `alquileres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches`
--

DROP TABLE IF EXISTS `coches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches` (
  `id_coche` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `alquilado` tinyint(1) DEFAULT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `id_vendedor` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_coche`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches`
--

LOCK TABLES `coches` WRITE;
/*!40000 ALTER TABLE `coches` DISABLE KEYS */;
INSERT INTO `coches` VALUES (1,'Model S','Tesla','Rojo',80000,0,'model_s.jpg',4),(2,'Civic','Honda','Azul',25000,1,'civic.jpg',7),(3,'Corolla','Toyota','Blanco',20000,1,'corolla.jpg',7),(4,'Mustang','Ford','Negro',55000,1,'mustang.jpg',11),(5,'Ibiza','Seat','Gris',18000,0,'ibiza.jpg',5),(6,'Astra','Opel','Verde',22000,0,'astra.jpg',5),(7,'Golf','Volkswagen','Amarillo',30000,0,'golf.jpg',7),(8,'Fiesta','Ford','Azul',15000,0,'fiesta.jpg',11),(9,'Accord','Honda','Rojo',27000,1,'accord.jpg',5),(10,'Camry','Toyota','Negro',31000,0,'camry.jpg',4),(20,'Tatra','Tatra 87','Gris',90000,0,'tatra.jpg',11),(23,'Serie 3','BMW','Negro',35000,0,'serie3.jpg',11);
/*!40000 ALTER TABLE `coches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `saldo` float DEFAULT NULL,
  `tipo_usuario` enum('comprador','vendedor','administrador') DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'pass1234','Juan','Pérez','12345678A',10000,'comprador'),(2,'password1','Ana','López','87654321B',5000,'comprador'),(3,'securepass','Carlos','García','11223344C',15000,'administrador'),(4,'mypass2023','María','Martínez','44332211D',2000,'vendedor'),(5,'qwerty','Luis','Hernández','55667788E',3000,'vendedor'),(6,'adminpass','Laura','Fernández','99887766F',7500,'administrador'),(7,'12345','Pedro','Sánchez','22334455G',12000,'vendedor'),(8,'abcd1234','Sofía','Díaz','66778899H',4000,'comprador'),(9,'mypassword','Javier','Morales','88990011I',8500,'comprador'),(10,'letmein','Carmen','Ortiz','33445566J',9200,'comprador'),(11,'caramelo','Manisha','Kumar','12312312A',4000,'vendedor'),(14,'cafe','Alvaro','Lopez','45645645B',1000,'administrador'),(20,'capo','Iker','Iturbide','02755940B',20000,'comprador'),(21,'camion','Jose','Prieto','23866051D',6000,'administrador');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-24 18:54:46
