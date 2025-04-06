-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: o_data
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `allowed_ips`
--

DROP TABLE IF EXISTS `allowed_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `allowed_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allowed_ips`
--

LOCK TABLES `allowed_ips` WRITE;
/*!40000 ALTER TABLE `allowed_ips` DISABLE KEYS */;
INSERT INTO `allowed_ips` VALUES (1,'192.168.1.10','zrng IP',1,'2025-03-21 20:12:17');
/*!40000 ALTER TABLE `allowed_ips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_logs`
--

DROP TABLE IF EXISTS `backup_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `status` enum('success','failure') DEFAULT 'success',
  `cloudinary_url` varchar(500) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_logs`
--

LOCK TABLES `backup_logs` WRITE;
/*!40000 ALTER TABLE `backup_logs` DISABLE KEYS */;
INSERT INTO `backup_logs` VALUES (2,'manual_backup_2025-03-22_22-11.sql','failure','','Empty file','2025-03-22 19:11:08'),(3,'manual_backup_2025-03-22_22-11.sql','failure','','Empty file','2025-03-22 19:11:14'),(4,'manual_backup_2025-03-22_22-19.sql','failure','','Empty file','2025-03-22 19:19:33');
/*!40000 ALTER TABLE `backup_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checkup`
--

DROP TABLE IF EXISTS `checkup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checkup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gen1_load` int(11) DEFAULT NULL,
  `gen1_temp` int(11) DEFAULT NULL,
  `gen1_op_bar` int(11) DEFAULT NULL,
  `gen1_fp_bar` int(11) DEFAULT NULL,
  `gen1_hours` int(11) DEFAULT NULL,
  `gen2_load` int(11) DEFAULT NULL,
  `gen2_temp` int(11) DEFAULT NULL,
  `gen2_op_bar` int(11) DEFAULT NULL,
  `gen2_fp_bar` int(11) DEFAULT NULL,
  `gen2_hours` int(11) DEFAULT NULL,
  `gen3_load` int(11) DEFAULT NULL,
  `gen3_temp` int(11) DEFAULT NULL,
  `gen3_op_bar` int(11) DEFAULT NULL,
  `gen3_fp_bar` int(11) DEFAULT NULL,
  `gen3_hours` int(11) DEFAULT NULL,
  `gen4_load` int(11) DEFAULT NULL,
  `gen4_temp` int(11) DEFAULT NULL,
  `gen4_op_bar` int(11) DEFAULT NULL,
  `gen4_fp_bar` int(11) DEFAULT NULL,
  `gen4_hours` int(11) DEFAULT NULL,
  `fuel_gas` int(11) DEFAULT NULL,
  `fuel_lpg` int(11) DEFAULT NULL,
  `ats_load` int(11) DEFAULT NULL,
  `ats_temp` int(11) DEFAULT NULL,
  `ats_kw` int(11) DEFAULT NULL,
  `oxygen_compressor_bar` int(11) DEFAULT NULL,
  `oxygen_temp` int(11) DEFAULT NULL,
  `oxygen_hours` int(11) DEFAULT NULL,
  `oxygen_quality` varchar(255) DEFAULT NULL,
  `oxygen_dryer` enum('working','not working') DEFAULT NULL,
  `o2_right` int(11) DEFAULT NULL,
  `o2_left` int(11) DEFAULT NULL,
  `o2_out` int(11) DEFAULT NULL,
  `boiler1` int(11) DEFAULT NULL,
  `boiler2` int(11) DEFAULT NULL,
  `burner1` int(11) DEFAULT NULL,
  `burner2` int(11) DEFAULT NULL,
  `softener` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `ro_right` int(11) DEFAULT NULL,
  `ro_left` int(11) DEFAULT NULL,
  `blood_status` enum('تێیدایە','تێییکراوە') DEFAULT NULL,
  `dynamo1_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dynamo2_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `chiller1_in` int(11) DEFAULT NULL,
  `chiller1_out` int(11) DEFAULT NULL,
  `chiller2_in` int(11) DEFAULT NULL,
  `chiller2_out` int(11) DEFAULT NULL,
  `chiller3_in` int(11) DEFAULT NULL,
  `chiller3_out` int(11) DEFAULT NULL,
  `chiller4_in` int(11) DEFAULT NULL,
  `chiller4_out` int(11) DEFAULT NULL,
  `water_treatment_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `chlor_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `park_globe_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `pool_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `vacuum` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `vacuum_power` int(11) DEFAULT NULL,
  `vacuum_temp` int(11) DEFAULT NULL,
  `vacuum_oil` varchar(255) DEFAULT NULL,
  `surgery_comp_right_power` int(11) DEFAULT NULL,
  `surgery_comp_right_temp` int(11) DEFAULT NULL,
  `surgery_comp_left_power` int(11) DEFAULT NULL,
  `surgery_comp_left_temp` int(11) DEFAULT NULL,
  `teeth_comp_right_power` int(11) DEFAULT NULL,
  `teeth_comp_right_temp` int(11) DEFAULT NULL,
  `teeth_comp_left_power` int(11) DEFAULT NULL,
  `teeth_comp_left_temp` int(11) DEFAULT NULL,
  `tank1_percentage` int(11) DEFAULT NULL,
  `tank2_percentage` int(11) DEFAULT NULL,
  `tank3_percentage` int(11) DEFAULT NULL,
  `taqim_right_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `taqim_left_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `lab_right_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `lab_left_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_service_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_surgery_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_forward_right_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_forward_left_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_lab_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `elevator_noringa_status` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `ups_b_load` int(11) DEFAULT NULL,
  `ups_b_temp` int(11) DEFAULT NULL,
  `ups_b_split` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `ups_g_load` int(11) DEFAULT NULL,
  `ups_g_temp` int(11) DEFAULT NULL,
  `ups_g_split` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_b` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_g` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_1` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_2` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_3` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_4` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `dafia_norenga` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `server_split` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `server_temp` int(11) DEFAULT NULL,
  `server_network` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `server_badala` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `server_camera` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `server_fire_system` enum('کاردەکات','کار ناکات') DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `current_datetime` datetime DEFAULT NULL,
  `files` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checkup`
--

LOCK TABLES `checkup` WRITE;
/*!40000 ALTER TABLE `checkup` DISABLE KEYS */;
INSERT INTO `checkup` VALUES (44,1,45,45,45,45,4545,4,54,54,54,654,65,465,46,546,46,46,54,654,654,654,65,465,46,546,54,64,64,654,'65','',5465465,46,546,4,654,654,64,'',654,8,'','','',984,98,498,498,49,84,94,984,'','','','کاردەکات','کاردەکات',54,654,'654',654,654,65,46,654,654,65,465,46,45,654,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',54,5,'کاردەکات',545,4,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',651,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','zrng','2025-03-28 22:53:41','[\"https://res.cloudinary.com/dy9bzsux3/image/upload/v1743191614/checkup/2025/03/28/file_1743191617_67e6fe4147e87.png\"]','651'),(45,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'0',NULL,0,0,0,0,0,0,0,'',0,0,'','','',0,0,0,0,0,0,0,0,'','','','کاردەکات','کاردەکات',0,0,'0',0,0,0,0,0,0,0,0,0,0,0,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',0,0,NULL,0,0,NULL,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',0,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','zrng','2025-03-28 23:02:28','[\"https://res.cloudinary.com/dy9bzsux3/image/upload/v1743192144/checkup/2025/03/28/file_1743192146_67e7005239ac5.png\"]',''),(46,7,863863,863,8638,638,63863863,863,8635,46,54,54,64,654,654,654,654,654,654,65,465,465,46,54,654,654,654,654,654,6,'465','',5,54,654,65,46,546,54,'',654,654,'','','',1,31,321,321,31,32,132,13,'','','','کاردەکات','کاردەکات',321,31,'3',13,213,1,31,132,13,213,13,21,321,31,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',321,321,NULL,31,321,NULL,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات','کاردەکات',31,'کاردەکات','کاردەکات','کاردەکات','کاردەکات','123456','2025-03-29 00:49:06','[\"https://res.cloudinary.com/dy9bzsux3/image/upload/v1743198541/checkup/2025/03/28/file_1743198543_67e7194fa8215.png\"]','213');
/*!40000 ALTER TABLE `checkup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `devices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_access`
--

DROP TABLE IF EXISTS `emergency_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `granted_by` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `granted_by` (`granted_by`),
  CONSTRAINT `emergency_access_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `emergency_access_ibfk_2` FOREIGN KEY (`granted_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_access`
--

LOCK TABLES `emergency_access` WRITE;
/*!40000 ALTER TABLE `emergency_access` DISABLE KEYS */;
INSERT INTO `emergency_access` VALUES (1,1,1,'Emergency admin access',1,'2025-03-21 23:12:27','2025-03-22 23:12:27','2025-03-21 20:12:27');
/*!40000 ALTER TABLE `emergency_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_name` (`permission_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'manage_users','ڕێگەپێدان بۆ بەڕێوەبردنی بەکارهێنەران','2025-03-21 20:09:50'),(2,'view_reports','بینینی ڕاپۆرتەکان','2025-03-21 20:09:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
INSERT INTO `role_permissions` VALUES (1,1,1,'2025-03-21 20:09:50'),(2,1,2,'2025-03-21 20:09:50');
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','بەڕێوەبەری گشتی','2025-03-21 20:09:50'),(2,'user','بەکارهێنەری ئاسایی','2025-03-21 20:09:50');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(100) NOT NULL,
  `task_number` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `employee` text DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `team` enum('تەکنیکی','دەرەکی') DEFAULT 'تەکنیکی',
  `status` enum('چاوەڕوانی','دەستپێکراوە','تەواوکراوە') DEFAULT 'چاوەڕوانی',
  `cost` decimal(10,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'IQD',
  `date` datetime NOT NULL,
  `files` text DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `image_url` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','چاوەڕوانی',45.00,'IQD','2025-03-21 23:33:00','',NULL,NULL,'2025-03-21 20:33:42',0),(2,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:36:30','','2025-03-22 00:36:40',NULL,'2025-03-21 21:36:30',0),(3,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:36:33','','2025-03-22 00:36:40',NULL,'2025-03-21 21:36:33',0),(4,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:36:33','','2025-03-22 00:36:40',NULL,'2025-03-21 21:36:33',0),(5,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:36:34','','2025-03-22 00:36:40',NULL,'2025-03-21 21:36:34',0),(6,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','چاوەڕوانی',45.00,'IQD','2025-03-22 00:36:35','',NULL,NULL,'2025-03-21 21:36:35',0),(7,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:39:39','','2025-03-28 23:17:08',NULL,'2025-03-21 21:39:39',0),(8,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:39:40','','2025-03-28 23:17:08',NULL,'2025-03-21 21:39:40',0),(9,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-22 00:39:41','','2025-03-28 23:17:08',NULL,'2025-03-21 21:39:41',0),(10,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','تەواوکراوە',34563456.00,'IQD','2025-03-22 00:51:00','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg','2025-03-28 23:17:08',NULL,'2025-03-21 21:51:50',0),(11,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','تەواوکراوە',34563456.00,'IQD','2025-03-22 00:52:30','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg','2025-03-22 00:52:36',NULL,'2025-03-21 21:52:30',0),(12,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','تەواوکراوە',34563456.00,'IQD','2025-03-22 00:52:31','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg','2025-03-28 23:17:08',NULL,'2025-03-21 21:52:31',0),(13,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','تەواوکراوە',5456.00,'IQD','2025-03-02 00:52:00','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg','2025-03-22 00:53:29',NULL,'2025-03-21 21:53:12',0),(14,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','چاوەڕوانی',5456.00,'IQD','2025-03-22 00:53:20','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg',NULL,NULL,'2025-03-21 21:53:20',0),(15,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','چاوەڕوانی',5456.00,'IQD','2025-03-22 00:53:21','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg',NULL,NULL,'2025-03-21 21:53:21',0),(16,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','چاوەڕوانی',5456.00,'IQD','2025-03-25 22:42:08','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg',NULL,NULL,'2025-03-25 19:42:08',0),(17,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','چاوەڕوانی',5456.00,'IQD','2025-03-25 22:42:09','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg',NULL,NULL,'2025-03-25 19:42:09',0),(18,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','دەستپێکراوە',34563456.00,'IQD','2025-03-25 22:42:12','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg',NULL,NULL,'2025-03-25 19:42:12',0),(19,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','دەستپێکراوە',34563456.00,'IQD','2025-03-25 22:42:16','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg',NULL,NULL,'2025-03-25 19:42:16',0),(20,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','تەواوکراوە',45.00,'IQD','2025-03-25 22:42:19','','2025-03-28 23:17:08',NULL,'2025-03-25 19:42:19',0),(21,'سیۆسی','سیرس','سیر','سیر','سیر','تەکنیکی','چاوەڕوانی',0.00,'IQD','2025-03-26 04:47:00','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742953677/o_data_uploads/2025/03/26/file_1742953672_67e35cc89224f.png',NULL,NULL,'2025-03-26 01:47:58',0),(22,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','دەستپێکراوە',34563456.00,'IQD','2025-03-28 23:16:53','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg',NULL,NULL,'2025-03-28 20:16:53',0),(23,'asdv','asdv','asdv','asdv,fgxfgb','asdv','دەرەکی','دەستپێکراوە',34563456.00,'IQD','2025-03-28 23:16:54','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593910/o_data_uploads/2025/03/21/file_1742593899_67dddf6bad864.jpg',NULL,NULL,'2025-03-28 20:16:54',0),(24,'drtghr5beyve','5ywv4','5ywe45','5yw5y,5yb45yb,456456,4564,4564ghjf','yvw45yw45y','تەکنیکی','چاوەڕوانی',5456.00,'IQD','2025-03-28 23:16:55','https://res.cloudinary.com/dy9bzsux3/image/upload/v1742593991/o_data_uploads/2025/03/21/file_1742593982_67dddfbed01fe.jpg',NULL,NULL,'2025-03-28 20:16:55',0),(25,'ءبشسیب','شسیب','شیب','شیب','یشب','تەکنیکی','چاوەڕوانی',45.00,'IQD','2025-03-28 23:16:56','',NULL,NULL,'2025-03-28 20:16:56',0),(26,'پڕکردنەوەی خوێ ئاڕ ئۆ','2 كیسە','میكانیكی دەرەوە','زرنگ','','تەکنیکی','تەواوکراوە',0.00,'IQD','2025-03-29 00:49:00','https://res.cloudinary.com/dy9bzsux3/image/upload/v1743198588/o_data_uploads/2025/03/28/file_1743198591_67e7197f4369b.png','2025-03-29 00:50:00',NULL,'2025-03-28 21:49:53',0);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity_log`
--

DROP TABLE IF EXISTS `user_activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity_log`
--

LOCK TABLES `user_activity_log` WRITE;
/*!40000 ALTER TABLE `user_activity_log` DISABLE KEYS */;
INSERT INTO `user_activity_log` VALUES (1,1,'logout','::1',NULL,'2025-03-29 00:47:31','2025-03-29 00:47:31'),(2,1,'login','::1','2025-03-29 00:47:36',NULL,'2025-03-29 00:47:36'),(3,1,'logout','::1',NULL,'2025-03-29 00:48:08','2025-03-29 00:48:08'),(4,7,'login','::1','2025-03-29 00:48:13',NULL,'2025-03-29 00:48:13'),(5,7,'login','::1','2025-03-29 00:48:22',NULL,'2025-03-29 00:48:22'),(6,7,'logout','::1',NULL,'2025-03-29 00:50:16','2025-03-29 00:50:16'),(7,1,'login','::1','2025-03-29 00:50:22',NULL,'2025-03-29 00:50:22'),(8,1,'logout','::1',NULL,'2025-03-29 01:33:08','2025-03-29 01:33:08'),(9,1,'login','::1','2025-03-29 01:33:14',NULL,'2025-03-29 01:33:14'),(10,1,'logout','::1',NULL,'2025-03-29 01:33:39','2025-03-29 01:33:39'),(11,1,'login','::1','2025-03-29 01:33:41',NULL,'2025-03-29 01:33:41'),(12,1,'logout','::1',NULL,'2025-03-29 01:33:43','2025-03-29 01:33:43'),(13,1,'login','::1','2025-03-29 01:33:46',NULL,'2025-03-29 01:33:46'),(14,1,'logout','::1',NULL,'2025-03-29 01:35:15','2025-03-29 01:35:15'),(15,7,'login','::1','2025-03-29 01:35:19',NULL,'2025-03-29 01:35:19'),(16,7,'login','::1','2025-03-29 01:37:00',NULL,'2025-03-29 01:37:00'),(17,7,'login','::1','2025-03-29 01:37:51',NULL,'2025-03-29 01:37:51'),(18,7,'logout','::1',NULL,'2025-03-29 03:59:57','2025-03-29 03:59:57'),(19,1,'login','::1','2025-03-29 04:00:03',NULL,'2025-03-29 04:00:03'),(20,1,'login','::1','2025-03-29 04:02:47',NULL,'2025-03-29 04:02:47'),(21,1,'login','::1','2025-03-29 04:07:56',NULL,'2025-03-29 04:07:56'),(22,1,'logout','::1',NULL,'2025-03-29 04:09:41','2025-03-29 04:09:41'),(23,7,'login','::1','2025-03-29 04:09:52',NULL,'2025-03-29 04:09:52'),(24,7,'logout','::1',NULL,'2025-03-29 04:10:37','2025-03-29 04:10:37'),(25,1,'login','::1','2025-03-29 04:10:45',NULL,'2025-03-29 04:10:45'),(26,1,'logout','::1',NULL,'2025-03-29 04:12:29','2025-03-29 04:12:29'),(27,7,'login','::1','2025-03-29 04:12:35',NULL,'2025-03-29 04:12:35'),(28,7,'logout','::1',NULL,'2025-03-29 04:13:00','2025-03-29 04:13:00'),(29,1,'login','::1','2025-03-29 04:13:05',NULL,'2025-03-29 04:13:05');
/*!40000 ALTER TABLE `user_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role_id` (`role_id`),
  KEY `role_id_2` (`role_id`),
  CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'zrng','$2a$12$ey9TsAAQeXcjty1XSskpounrJw1LPkb2ULiDhtdkmvYL3JiqIq.I2','zrng Nawroz Gharib','zrng@example.com','07501234567',1,'active',NULL,'2025-03-21 20:11:22'),(7,'123456','$2y$10$BrZH33RkHQVwvEDqWcnFIuKTA9vd/fIggPoon/cqVbJ.QOVbxHl5O','',NULL,'35467345734573457345',2,'active',NULL,'2025-03-21 23:29:47');
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

-- Dump completed on 2025-03-29  4:13:07
