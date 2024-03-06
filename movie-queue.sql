-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: movie-queue
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_customers`
--

DROP TABLE IF EXISTS `tbl_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customers`
--

LOCK TABLES `tbl_customers` WRITE;
/*!40000 ALTER TABLE `tbl_customers` DISABLE KEYS */;
INSERT INTO `tbl_customers` VALUES (1,'Juan','Dela Cruz','delacruzjuan@email.com'),(3,'Test','Test','test@a.com'),(4,'test','test','test@test.com'),(5,'a','a','a@a.com'),(6,'b','b','b@b.com'),(7,'c','c','c@c.com'),(8,'w','w','w@w.com'),(9,'sed','Doe','grep@a.com'),(10,'z','z','z@z.com'),(11,'John','Doe','email@example.com'),(12,'Test','test','t@t.com'),(13,'p','p','p@p.com');
/*!40000 ALTER TABLE `tbl_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_movies`
--

DROP TABLE IF EXISTS `tbl_movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(255) NOT NULL,
  `movie_rating` enum('G','PG','R13','R16','R18') NOT NULL,
  `release_date` date NOT NULL,
  `run_time` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `youtube_trailer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_movies`
--

LOCK TABLES `tbl_movies` WRITE;
/*!40000 ALTER TABLE `tbl_movies` DISABLE KEYS */;
INSERT INTO `tbl_movies` VALUES (1,'Rewind','R18','2024-02-01',150,'Drama',100.00,'_31Tod1VvLM?si=bhPMfqSU8KdJuTqR'),(2,'Demon Slayer','PG','2024-02-01',120,'Action',50.00,'SXcCdQdcBtw?si=BXc8rrjeVzWp8PKC');
/*!40000 ALTER TABLE `tbl_movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reservations`
--

DROP TABLE IF EXISTS `tbl_reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reservations` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `selected_seats` varchar(255) NOT NULL,
  `selected_time` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaction_reference` char(36) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`),
  UNIQUE KEY `uuid` (`transaction_reference`),
  KEY `customer_id` (`customer_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `tbl_reservations_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`id`),
  CONSTRAINT `tbl_reservations_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reservations`
--

LOCK TABLES `tbl_reservations` WRITE;
/*!40000 ALTER TABLE `tbl_reservations` DISABLE KEYS */;
INSERT INTO `tbl_reservations` VALUES (1,4,2,'A1,A2,B2','1PM','2024-03-04 12:19:28','2024-03-06 14:08:08','f577c85b-dbc2-11ee-b1ac-7c575860591d'),(2,5,1,'A1','1PM','2024-03-05 00:11:34','2024-03-06 14:08:08','f57821b6-dbc2-11ee-b1ac-7c575860591d'),(3,6,1,'A2','1PM','2024-03-05 00:37:01','2024-03-06 14:08:08','f5782b2b-dbc2-11ee-b1ac-7c575860591d'),(4,5,1,'A3,A4,B1','1PM','2024-03-05 04:51:36','2024-03-06 14:08:08','f5782c3e-dbc2-11ee-b1ac-7c575860591d'),(5,7,1,'B2','1PM','2024-03-05 15:49:33','2024-03-06 14:08:08','f5782cf5-dbc2-11ee-b1ac-7c575860591d'),(6,8,1,'B3','1PM','2024-03-05 16:27:03','2024-03-06 14:08:08','f5782d73-dbc2-11ee-b1ac-7c575860591d'),(7,9,1,'B4','1PM','2024-03-05 16:49:44','2024-03-06 14:08:08','f5782de7-dbc2-11ee-b1ac-7c575860591d'),(8,10,1,'C1','1PM','2024-03-06 10:57:57','2024-03-06 14:08:08','f5782e54-dbc2-11ee-b1ac-7c575860591d'),(9,11,1,'C2','1PM','2024-03-06 14:17:35','2024-03-06 14:17:35','47b6672d-dbc4-11ee-b1ac-7c575860591d'),(10,12,1,'C3','1PM','2024-03-06 14:29:33','2024-03-06 14:29:33','f35b6fbb-dbc5-11ee-b1ac-7c575860591d'),(11,13,1,'C4','1PM','2024-03-06 14:45:25','2024-03-06 14:45:25','2ad24933-dbc8-11ee-b1ac-7c575860591d');
/*!40000 ALTER TABLE `tbl_reservations` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER before_tbl_reservations
BEFORE INSERT ON tbl_reservations
FOR EACH ROW
BEGIN
    SET NEW.transaction_reference = UUID();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tbl_seats`
--

DROP TABLE IF EXISTS `tbl_seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_seats` (
  `seat_id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_number` varchar(10) NOT NULL,
  `seat_status` enum('available','booked') NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`seat_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `tbl_seats_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_seats`
--

LOCK TABLES `tbl_seats` WRITE;
/*!40000 ALTER TABLE `tbl_seats` DISABLE KEYS */;
INSERT INTO `tbl_seats` VALUES (33,'A1','booked',1),(34,'A2','booked',1),(35,'A3','booked',1),(36,'A4','booked',1),(37,'B1','booked',1),(38,'B2','booked',1),(39,'B3','booked',1),(40,'B4','booked',1),(41,'C1','booked',1),(42,'C2','booked',1),(43,'C3','booked',1),(44,'C4','booked',1),(45,'D1','available',1),(46,'D2','available',1),(47,'D3','available',1),(48,'D4','available',1),(49,'A1','available',2),(50,'A2','available',2),(51,'A3','available',2),(52,'A4','available',2),(53,'B1','available',2),(54,'B2','available',2),(55,'B3','available',2),(56,'B4','available',2),(57,'C1','available',2),(58,'C2','available',2),(59,'C3','available',2),(60,'C4','available',2),(61,'D1','available',2),(62,'D2','available',2),(63,'D3','available',2),(64,'D4','available',2);
/*!40000 ALTER TABLE `tbl_seats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access` enum('admin','non_admin') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'admin','*6AF6EE9F117B12E463CBE8426CFA74245756F09F','admin');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-06 23:24:54
