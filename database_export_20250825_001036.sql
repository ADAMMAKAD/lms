-- MySQL dump 10.13  Distrib 9.3.0, for macos15.2 (arm64)
--
-- Host: localhost    Database: dololoet_test
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Current Database: `dololoet_test`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dololoet_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `dololoet_test`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `bio` text,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'adam z great','admin@gmail.com','uploads/website-images/admin.jpg','$2y$12$J6UpqsnOrd0NBIeUmQx5YOvdMAUfnGI9h6RqXItBjVNDvefNG8Ham',NULL,'active','2025-08-07 21:04:00','2025-08-08 11:06:54',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `announcement` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessments`
--

DROP TABLE IF EXISTS `assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assessments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `technology` varchar(100) NOT NULL,
  `description` text,
  `logo_url` varchar(500) DEFAULT NULL,
  `skill_level` enum('Beginner','Intermediate','Advanced') NOT NULL DEFAULT 'Beginner',
  `course_count` int NOT NULL DEFAULT '0',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assessments_is_popular_index` (`is_popular`),
  KEY `assessments_technology_index` (`technology`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessments`
--

LOCK TABLES `assessments` WRITE;
/*!40000 ALTER TABLE `assessments` DISABLE KEYS */;
INSERT INTO `assessments` VALUES (1,'JavaScript Skill Assessment','JavaScript','Test your JavaScript knowledge with real-world scenarios','https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg','Intermediate',45,1,'2025-08-08 09:01:37','2025-08-08 09:01:37'),(2,'React Development Assessment','React','Evaluate your React skills and component architecture knowledge','https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg','Advanced',32,1,'2025-08-08 09:01:37','2025-08-08 09:01:37'),(3,'Python Programming Assessment','Python','Comprehensive Python assessment covering fundamentals to advanced topics','https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg','Beginner',58,1,'2025-08-08 09:01:37','2025-08-08 09:01:37'),(4,'Node.js Backend Assessment','Node.js','Test your server-side JavaScript and API development skills','https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg','Intermediate',28,0,'2025-08-08 09:01:37','2025-08-08 09:01:37');
/*!40000 ALTER TABLE `assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `condition_from` int NOT NULL DEFAULT '0',
  `condition_to` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` VALUES (1,'registration_badge_one','uploads/custom-images/wsus-img-2024-06-05-08-13-59-9888.png','Badge 1',NULL,1,2,1,'2024-06-05 15:13:58','2024-06-05 15:13:59'),(2,'registration_badge_two','uploads/custom-images/wsus-img-2024-06-05-08-14-23-4795.png','badge 2',NULL,3,4,1,'2024-06-05 15:14:23','2024-06-05 15:14:23'),(3,'registration_badge_three','uploads/custom-images/wsus-img-2024-06-05-08-14-55-9047.png','Badge 3',NULL,5,6,1,'2024-06-05 15:14:55','2024-06-05 15:14:55'),(4,'course_count_badge_one','uploads/custom-images/wsus-img-2024-06-05-08-15-33-5592.png','Badge 1',NULL,1,2,1,'2024-06-05 15:15:33','2024-06-05 15:15:33'),(5,'course_count_badge_two','uploads/custom-images/wsus-img-2024-06-05-08-16-01-1865.png','Badge 2',NULL,3,4,1,'2024-06-05 15:16:01','2024-06-05 15:16:01'),(6,'course_count_badge_three','uploads/custom-images/wsus-img-2024-06-05-08-16-24-6251.png','Badge 3',NULL,4,5,1,'2024-06-05 15:16:24','2024-06-05 15:16:24'),(7,'course_rating_badge_one','uploads/custom-images/wsus-img-2024-06-05-08-16-57-4076.png','Badge 1',NULL,0,1,1,'2024-06-05 15:16:57','2024-06-05 15:18:18'),(8,'course_rating_badge_two','uploads/custom-images/wsus-img-2024-06-05-08-17-26-1574.png','Badge 2',NULL,2,3,1,'2024-06-05 15:17:26','2024-06-05 15:18:28'),(9,'course_rating_badge_three','uploads/custom-images/wsus-img-2024-06-05-08-18-48-6887.png','Badge 3',NULL,4,5,1,'2024-06-05 15:17:52','2024-06-05 15:18:48'),(10,'course_enroll_badge_one','uploads/custom-images/wsus-img-2024-06-05-08-19-08-6764.png','Badge 1',NULL,1,2,1,'2024-06-05 15:19:08','2024-06-05 15:19:08'),(11,'course_enroll_badge_two','uploads/custom-images/wsus-img-2024-06-05-08-19-24-6958.png','Badge 2',NULL,2,3,1,'2024-06-05 15:19:24','2024-06-05 15:19:24'),(12,'course_enroll_badge_three','uploads/custom-images/wsus-img-2024-06-05-08-19-52-2846.png','Badge 3',NULL,4,5,1,'2024-06-05 15:19:52','2024-06-05 15:19:52');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banned_histories`
--

DROP TABLE IF EXISTS `banned_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banned_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `reasone` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banned_histories`
--

LOCK TABLES `banned_histories` WRITE;
/*!40000 ALTER TABLE `banned_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `banned_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `parent_id` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'eduction',0,NULL,1,'2025-08-09 00:21:40','2025-08-09 00:21:40');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category_translations`
--

DROP TABLE IF EXISTS `blog_category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_category_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_category_translations_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `blog_category_translations_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category_translations`
--

LOCK TABLES `blog_category_translations` WRITE;
/*!40000 ALTER TABLE `blog_category_translations` DISABLE KEYS */;
INSERT INTO `blog_category_translations` VALUES (1,1,'en','Eduction',NULL,'2025-08-09 00:21:40','2025-08-09 00:21:40');
/*!40000 ALTER TABLE `blog_category_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comments`
--

DROP TABLE IF EXISTS `blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comments`
--

LOCK TABLES `blog_comments` WRITE;
/*!40000 ALTER TABLE `blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_translations`
--

DROP TABLE IF EXISTS `blog_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `seo_title` text,
  `seo_description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_translations`
--

LOCK TABLES `blog_translations` WRITE;
/*!40000 ALTER TABLE `blog_translations` DISABLE KEYS */;
INSERT INTO `blog_translations` VALUES (1,1,'en','test','<p>test test test test ets test etst</p>','etst','test','2025-08-09 00:22:16','2025-08-09 00:22:16');
/*!40000 ALTER TABLE `blog_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned NOT NULL DEFAULT '0',
  `blog_category_id` bigint unsigned NOT NULL,
  `slug` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `views` bigint NOT NULL DEFAULT '0',
  `show_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `tags` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,1,1,'test','uploads/custom-images/wsus-img-2025-08-08-05-22-16-7387.avif',0,1,0,'[{\"value\":\"test\"}]',1,'2025-08-09 00:22:16','2025-08-22 08:00:38');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_course_id_foreign` (`course_id`),
  CONSTRAINT `carts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1000,2,1,'2025-08-09 04:11:48','2025-08-09 04:11:48');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate_builder_items`
--

DROP TABLE IF EXISTS `certificate_builder_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate_builder_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `element_id` varchar(255) DEFAULT NULL,
  `x_position` varchar(255) DEFAULT NULL,
  `y_position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate_builder_items`
--

LOCK TABLES `certificate_builder_items` WRITE;
/*!40000 ALTER TABLE `certificate_builder_items` DISABLE KEYS */;
INSERT INTO `certificate_builder_items` VALUES (1,'title','326.99993896484375','208',NULL,'2024-05-16 12:00:14'),(2,'sub_title','377.00006103515625','249',NULL,'2024-05-16 17:05:19'),(3,'description','25','306',NULL,'2024-05-16 17:45:02'),(4,'signature','401','412.99998474121094',NULL,'2024-05-16 17:14:05');
/*!40000 ALTER TABLE `certificate_builder_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate_builders`
--

DROP TABLE IF EXISTS `certificate_builders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate_builders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `background` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` text,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate_builders`
--

LOCK TABLES `certificate_builders` WRITE;
/*!40000 ALTER TABLE `certificate_builders` DISABLE KEYS */;
INSERT INTO `certificate_builders` VALUES (1,'uploads/website-images/certificate.png','Awarded to [student_name]','For completing [course]','This certificate is awarded to recognize the successful completion of the course [course] offered on the platform [platform_name] by [instructor_name]. The recipient,[student_name], has demonstrated commendable dedication and proficiency.','uploads/website-images/signature.png','2024-05-16 10:56:38','2024-05-16 17:02:12');
/*!40000 ALTER TABLE `certificate_builders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_id` bigint unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_state_id_foreign` (`state_id`),
  CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` VALUES (1,'setup_complete','1','2025-08-07 21:03:59','2025-08-07 21:03:59'),(2,'setup_stage','5','2025-08-07 21:03:59','2025-08-07 21:03:59');
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_sections`
--

DROP TABLE IF EXISTS `contact_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `phone_one` varchar(255) DEFAULT NULL,
  `phone_two` varchar(255) DEFAULT NULL,
  `email_one` varchar(255) DEFAULT NULL,
  `email_two` varchar(255) DEFAULT NULL,
  `map` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_sections`
--

LOCK TABLES `contact_sections` WRITE;
/*!40000 ALTER TABLE `contact_sections` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_histories`
--

DROP TABLE IF EXISTS `coupon_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupon_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) NOT NULL,
  `coupon_id` int NOT NULL,
  `discount_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_histories`
--

LOCK TABLES `coupon_histories` WRITE;
/*!40000 ALTER TABLE `coupon_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) NOT NULL,
  `offer_percentage` decimal(8,2) NOT NULL,
  `expired_date` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `min_price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_categories`
--

DROP TABLE IF EXISTS `course_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `order` int DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `show_at_trending` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_categories`
--

LOCK TABLES `course_categories` WRITE;
/*!40000 ALTER TABLE `course_categories` DISABLE KEYS */;
INSERT INTO `course_categories` VALUES (1,'elixone-technology',NULL,'uploads/custom-images/wsus-img-2025-08-08-01-26-56-4912.png',NULL,1,1,'2025-08-08 08:25:49','2025-08-08 08:26:56'),(2,'codeing',NULL,'uploads/custom-images/wsus-img-2025-08-08-02-56-13-4247.png',NULL,1,1,'2025-08-08 09:56:13','2025-08-08 09:56:13'),(3,'maths',NULL,'uploads/custom-images/wsus-img-2025-08-08-02-56-30-3498.png',NULL,1,1,'2025-08-08 09:56:30','2025-08-08 09:56:30'),(4,'amharic',NULL,'uploads/custom-images/wsus-img-2025-08-08-02-57-15-6532.png',NULL,1,1,'2025-08-08 09:57:15','2025-08-08 09:57:15'),(5,'chemistry',NULL,'uploads/custom-images/wsus-img-2025-08-08-02-57-42-2578.png',NULL,1,1,'2025-08-08 09:57:42','2025-08-08 09:57:42'),(6,'biology',NULL,'uploads/custom-images/wsus-img-2025-08-08-02-57-59-2429.png',NULL,1,1,'2025-08-08 09:57:59','2025-08-08 09:57:59'),(7,'data-science',NULL,'uploads/custom-images/wsus-img-2025-08-08-03-01-54-5257.png',NULL,1,1,'2025-08-08 10:01:54','2025-08-08 10:01:54'),(8,'machine-learning',NULL,'uploads/custom-images/wsus-img-2025-08-08-03-02-13-4762.png',NULL,1,1,'2025-08-08 10:02:13','2025-08-08 10:02:13');
/*!40000 ALTER TABLE `course_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_category_translations`
--

DROP TABLE IF EXISTS `course_category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_category_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_category_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_category_translations`
--

LOCK TABLES `course_category_translations` WRITE;
/*!40000 ALTER TABLE `course_category_translations` DISABLE KEYS */;
INSERT INTO `course_category_translations` VALUES (1,1,'en','Pitching','2025-08-08 08:25:49','2025-08-22 21:26:36'),(2,2,'en','Pitch coaching (coaching)','2025-08-08 09:56:13','2025-08-22 21:26:11'),(3,3,'en','Fundraising','2025-08-08 09:56:30','2025-08-22 21:25:43'),(4,4,'en','Financial Projection','2025-08-08 09:57:15','2025-08-22 21:25:21'),(5,5,'en','Operations Management','2025-08-08 09:57:42','2025-08-22 21:24:52'),(6,6,'en','Marketing Management','2025-08-08 09:57:59','2025-08-22 21:22:53'),(7,7,'en','Financial Management','2025-08-08 10:01:54','2025-08-22 21:21:26'),(8,8,'en','Business Planning Training','2025-08-08 10:02:13','2025-08-22 21:20:59');
/*!40000 ALTER TABLE `course_category_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_chapter_items`
--

DROP TABLE IF EXISTS `course_chapter_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_chapter_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `type` enum('lesson','document','quiz','live') NOT NULL DEFAULT 'lesson',
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_chapter_items_instructor_id_foreign` (`instructor_id`),
  KEY `course_chapter_items_chapter_id_foreign` (`chapter_id`),
  CONSTRAINT `course_chapter_items_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `course_chapters` (`id`),
  CONSTRAINT `course_chapter_items_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_chapter_items`
--

LOCK TABLES `course_chapter_items` WRITE;
/*!40000 ALTER TABLE `course_chapter_items` DISABLE KEYS */;
INSERT INTO `course_chapter_items` VALUES (1,1003,3,'quiz',1,'2025-08-11 21:04:10','2025-08-11 21:04:10');
/*!40000 ALTER TABLE `course_chapter_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_chapter_lessons`
--

DROP TABLE IF EXISTS `course_chapter_lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_chapter_lessons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `instructor_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `chapter_item_id` bigint unsigned NOT NULL,
  `file_path` text,
  `storage` enum('upload','youtube','vimeo','external_link','google_drive','iframe','aws','wasabi','live') NOT NULL DEFAULT 'upload',
  `volume` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `file_type` enum('video','audio','pdf','txt','docx','iframe','image','file','other') NOT NULL DEFAULT 'video',
  `downloadable` tinyint(1) NOT NULL DEFAULT '1',
  `order` int DEFAULT NULL,
  `is_free` tinyint(1) DEFAULT '0',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_chapter_lessons_instructor_id_foreign` (`instructor_id`),
  KEY `course_chapter_lessons_chapter_id_foreign` (`chapter_id`),
  KEY `course_chapter_lessons_chapter_item_id_foreign` (`chapter_item_id`),
  CONSTRAINT `course_chapter_lessons_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `course_chapters` (`id`),
  CONSTRAINT `course_chapter_lessons_chapter_item_id_foreign` FOREIGN KEY (`chapter_item_id`) REFERENCES `course_chapter_items` (`id`),
  CONSTRAINT `course_chapter_lessons_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_chapter_lessons`
--

LOCK TABLES `course_chapter_lessons` WRITE;
/*!40000 ALTER TABLE `course_chapter_lessons` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_chapter_lessons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_chapters`
--

DROP TABLE IF EXISTS `course_chapters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_chapters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `order` int NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_chapters_course_id_foreign` (`course_id`),
  CONSTRAINT `course_chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_chapters`
--

LOCK TABLES `course_chapters` WRITE;
/*!40000 ALTER TABLE `course_chapters` DISABLE KEYS */;
INSERT INTO `course_chapters` VALUES (1,'test',1002,1,1,'active','2025-08-09 03:06:21','2025-08-09 03:06:21'),(2,'test',1003,2,1,'active','2025-08-09 03:13:56','2025-08-09 03:13:56'),(3,'Melaku',1003,2,2,'active','2025-08-11 21:03:21','2025-08-11 21:03:21');
/*!40000 ALTER TABLE `course_chapters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_delete_requests`
--

DROP TABLE IF EXISTS `course_delete_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_delete_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_delete_requests`
--

LOCK TABLES `course_delete_requests` WRITE;
/*!40000 ALTER TABLE `course_delete_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_delete_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_languages`
--

DROP TABLE IF EXISTS `course_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_languages`
--

LOCK TABLES `course_languages` WRITE;
/*!40000 ALTER TABLE `course_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_level_translations`
--

DROP TABLE IF EXISTS `course_level_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_level_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_level_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_level_translations`
--

LOCK TABLES `course_level_translations` WRITE;
/*!40000 ALTER TABLE `course_level_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_level_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_levels`
--

DROP TABLE IF EXISTS `course_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_levels`
--

LOCK TABLES `course_levels` WRITE;
/*!40000 ALTER TABLE `course_levels` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_live_classes`
--

DROP TABLE IF EXISTS `course_live_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_live_classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint unsigned NOT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `type` enum('zoom','jitsi') NOT NULL DEFAULT 'zoom',
  `meeting_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `join_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_live_classes_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `course_live_classes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `course_chapter_lessons` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_live_classes`
--

LOCK TABLES `course_live_classes` WRITE;
/*!40000 ALTER TABLE `course_live_classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_live_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_partner_instructors`
--

DROP TABLE IF EXISTS `course_partner_instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_partner_instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_partner_instructors`
--

LOCK TABLES `course_partner_instructors` WRITE;
/*!40000 ALTER TABLE `course_partner_instructors` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_partner_instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_progress`
--

DROP TABLE IF EXISTS `course_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned DEFAULT NULL,
  `chapter_id` bigint unsigned DEFAULT NULL,
  `lesson_id` bigint unsigned DEFAULT NULL,
  `watched` tinyint(1) NOT NULL DEFAULT '0',
  `current` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('lesson','quiz','document','live') NOT NULL DEFAULT 'lesson',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_progress`
--

LOCK TABLES `course_progress` WRITE;
/*!40000 ALTER TABLE `course_progress` DISABLE KEYS */;
INSERT INTO `course_progress` VALUES (1,1002,2,3,1,1,1,'quiz','2025-08-11 21:35:13','2025-08-22 22:06:07'),(2,1003,2,3,1,1,0,'quiz','2025-08-11 21:36:14','2025-08-22 22:06:07');
/*!40000 ALTER TABLE `course_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_reviews`
--

DROP TABLE IF EXISTS `course_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `review` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_reviews`
--

LOCK TABLES `course_reviews` WRITE;
/*!40000 ALTER TABLE `course_reviews` DISABLE KEYS */;
INSERT INTO `course_reviews` VALUES (1,2,1002,5,'don\'t',1,'2025-08-11 21:44:59','2025-08-13 23:28:37'),(2,1,1002,4,'test',0,'2025-08-22 06:51:40','2025-08-22 06:51:40');
/*!40000 ALTER TABLE `course_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_selected_filter_options`
--

DROP TABLE IF EXISTS `course_selected_filter_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_selected_filter_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `filter_id` bigint unsigned NOT NULL,
  `filter_option_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_selected_filter_options`
--

LOCK TABLES `course_selected_filter_options` WRITE;
/*!40000 ALTER TABLE `course_selected_filter_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_selected_filter_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_selected_languages`
--

DROP TABLE IF EXISTS `course_selected_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_selected_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `language_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_selected_languages`
--

LOCK TABLES `course_selected_languages` WRITE;
/*!40000 ALTER TABLE `course_selected_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_selected_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_selected_levels`
--

DROP TABLE IF EXISTS `course_selected_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_selected_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `level_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_selected_levels`
--

LOCK TABLES `course_selected_levels` WRITE;
/*!40000 ALTER TABLE `course_selected_levels` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_selected_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `type` enum('course','webinar') NOT NULL DEFAULT 'course',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `demo_video_storage` enum('upload','youtube','vimeo','external_link','aws','wasabi') NOT NULL DEFAULT 'upload',
  `demo_video_source` text,
  `description` text,
  `capacity` int DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `discount` double DEFAULT NULL,
  `certificate` tinyint(1) NOT NULL DEFAULT '0',
  `downloadable` tinyint(1) NOT NULL DEFAULT '0',
  `partner_instructor` tinyint(1) NOT NULL DEFAULT '0',
  `qna` tinyint(1) NOT NULL DEFAULT '0',
  `message_for_reviewer` text,
  `status` enum('active','is_draft','inactive') NOT NULL DEFAULT 'is_draft',
  `is_approved` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1002,1,'course','test','test','test',NULL,30,NULL,'/uploads/store/photos/1/dental-care-horizontal-banner-template_23-2149267635.jpg','youtube','https://www.youtube.com/watch?v=pMzGDBP6Bic','<p>best course test ets test ets test test ets </p>\r\n<p>best course test ets test ets test test ets </p>\r\n<p>best course test ets test ets test test ets</p>',0,1300,NULL,1,0,0,1,'test','active','approved','2025-08-08 10:10:27','2025-08-09 03:06:40',NULL),(2,1003,1,'course','test','test-1','127',NULL,120,NULL,'/uploads/store/photos/1/dental-care-horizontal-banner-template_23-2149267635.jpg','youtube','https://www.youtube.com/watch?v=Od3Bddtfxws','<p>test test test test test</p>',120,200,NULL,1,0,0,1,NULL,'active','approved','2025-08-09 03:13:31','2025-08-22 08:28:32',NULL),(3,1,1,'course','Ethical Hacking Course','ethical-hacking-course','Learn ethical hacking from basics to advanced',NULL,600,NULL,'default-course.jpg','youtube','https://www.youtube.com/watch?v=dQw4w9WgXcQ','Comprehensive ethical hacking course covering penetration testing, vulnerability assessment, and security auditing.',100,136,0,1,0,0,0,NULL,'active','approved','2025-08-13 08:39:37','2025-08-13 08:39:37',NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_addons`
--

DROP TABLE IF EXISTS `custom_addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_addons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `isPaid` tinyint(1) NOT NULL DEFAULT '1',
  `description` text,
  `author` json DEFAULT NULL,
  `options` json DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_addons_name_index` (`name`),
  KEY `idx_custom_addons_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_addons`
--

LOCK TABLES `custom_addons` WRITE;
/*!40000 ALTER TABLE `custom_addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_codes`
--

DROP TABLE IF EXISTS `custom_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `css` text,
  `javascript` text,
  `header_javascript` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_codes`
--

LOCK TABLES `custom_codes` WRITE;
/*!40000 ALTER TABLE `custom_codes` DISABLE KEYS */;
INSERT INTO `custom_codes` VALUES (1,'/* write your css code here without the style tag *\\','//write your javascript here without the script tag','//write your javascript here without the script tag','2025-08-08 07:47:33','2025-08-08 07:47:33');
/*!40000 ALTER TABLE `custom_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_page_translations`
--

DROP TABLE IF EXISTS `custom_page_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_page_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_page_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_page_translations`
--

LOCK TABLES `custom_page_translations` WRITE;
/*!40000 ALTER TABLE `custom_page_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_page_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_pages`
--

DROP TABLE IF EXISTS `custom_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_pages`
--

LOCK TABLES `custom_pages` WRITE;
/*!40000 ALTER TABLE `custom_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_paginations`
--

DROP TABLE IF EXISTS `custom_paginations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `custom_paginations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) NOT NULL,
  `item_qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_paginations`
--

LOCK TABLES `custom_paginations` WRITE;
/*!40000 ALTER TABLE `custom_paginations` DISABLE KEYS */;
INSERT INTO `custom_paginations` VALUES (1,'Blog List',10,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'Blog Comment',10,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'Media List',10,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'Language List',50,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'Blog List',10,'2025-08-08 07:17:24','2025-08-08 07:17:24'),(6,'Blog Comment',10,'2025-08-08 07:17:24','2025-08-08 07:17:24'),(7,'Media List',10,'2025-08-08 07:17:24','2025-08-08 07:17:24'),(8,'Language List',50,'2025-08-08 07:17:24','2025-08-08 07:17:24');
/*!40000 ALTER TABLE `custom_paginations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'password_reset','Password Reset','<p>Dear {{user_name}},</p>\n                <p>Do you want to reset your password? Please Click the following link and Reset Your Password.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'contact_mail','Contact Email','<p>Hello there,</p>\n                <p>&nbsp;Mr. {{name}} has sent a new message. you can see the message details below.&nbsp;</p>\n                <p>Email: {{email}}</p>\n                <p>Phone: {{phone}}</p>\n                <p>Subject: {{subject}}</p>\n                <p>Message: {{message}}</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'subscribe_notification','Subscribe Notification','<p>Hi there, Congratulations! Your Subscription has been created successfully. Please Click the following link and Verified Your Subscription. If you will not approve this link, you can not get any newsletter from us.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'user_verification','User Verification','<p>Dear {{user_name}},</p>\n                <p>Congratulations! Your Account has been created successfully. Please Click the following link and Active your Account.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'approved_refund','Refund Request Approval','<p>Dear {{user_name}},</p>\n                <p>We are happy to say that, we have send {{refund_amount}} USD to your provided bank information. </p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(6,'new_refund','New Refund Request','<p>Hello UNDO, </p>\n\n                <p>Mr. {{user_name}} has send a new refund request to you.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(7,'pending_wallet_payment','Wallet Payment Approval','<p>Hello {{user_name}},</p>\n                <p>We have received your wallet payment request. we find your payment to our bank account.</p>\n                <p>Thanks &amp; Regards</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(8,'approved_withdraw','Withdraw Request Approval','<p>Dear {{user_name}},</p>\n                <p>We are happy to say that, we have send a withdraw amount to your provided bank information.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>UNDO</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(9,'rejected_withdraw','Withdraw Request Rejected','<p>Dear {{user_name}},</p>\n                <p> your withdraw request has been rejected.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>UNDO</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(10,'pending_withdraw','Withdraw Request Pending','<p>Dear {{user_name}},</p>\n                <p> your withdraw request is waiting for approval.</p>\n                <p>Thanks &amp; Regards</p>\n                <p>UNDO</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(11,'instructor_request_approved','Instructor Request Approval','<p>Dear {{user_name}},</p>\n                <p>you are now approved as an instructor.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(12,'instructor_request_rejected','Instructor Request Rejected','<p>Dear {{user_name}},</p>\n                <p>your request has been rejected. please resubmit your request with proper document. or contact us.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(13,'instructor_request_pending','Instructor Request is waiting for approval','<p>Dear {{user_name}},</p>\n                <p>your request for become an instructor is waiting for approval. please wait. we will send you an email when your request is approved.</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(14,'instructor_quick_contact','Mail for instructor contact form','<p>Name: {{name}}</p>\n                <p>Email: {{email}}</p>\n                <p>Subject: {{subject}}</p>\n                <p>{{message}}</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(15,'order_completed','Your order has been placed','<p>HI, {{name}}</p>\n                <p>Invoice ID: {{order_id}}</p>\n                <p>paid amount: {{paid_amount}}</p>\n                <p>payment method: {{payment_method}}</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(16,'payment_status','Update Payment Status','<p>HI, {{name}}</p>\n                <p>Invoice ID: {{order_id}}</p>\n                <p>paid amount: {{paid_amount}}</p>\n                <p>payment status: {{payment_status}}</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(17,'qna_reply_mail','QNA Replay mail','<p>Hi {{user_name}}, your instructor has replied to your question. Please see the answer below:</p><p>Course: {{course}}</p><p>Lesson: {{lesson}}</p><p>Question: {{question}}</p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(18,'live_class_mail','Live class notification mail','<p>Hi {{user_name}},</p>\n                <p>Your live class is starting at {{start_time}}. Please see the details below:</p>\n                <p><strong>Course:</strong> {{course}}</p>\n                <p><strong>Lesson:</strong> {{lesson}}</p>\n                <p><strong>Meeting Link:</strong> <a href=\"{{join_url}}\">{{join_url}}</a></p>','2025-08-07 21:04:00','2025-08-07 21:04:00'),(19,'gift_course','Gift Course Notification','<p>Hi {{name}},</p>\n                <p>{{sender_name}} has gifted you a course! Click the link below to enroll and claim your course. <strong>Do not share this link with anyone.</strong></p>\n                <p><strong>Claim Course:</strong> <a href=\"{{link}}\">{{link}}</a></p>\n                <p><strong>Visit Course:</strong> <a href=\"{{course_link}}\">{{course_name}}</a></p>\n                <p><strong>Sender Email:</strong> {{sender_email}}</p>\n                <p><strong>Message from Sender:</strong> {{message}}</p>\n                <p>Enjoy your learning!</p>','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `has_access` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enrollments_order_id_foreign` (`order_id`),
  CONSTRAINT `enrollments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_translations`
--

DROP TABLE IF EXISTS `faq_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `faq_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_translations`
--

LOCK TABLES `faq_translations` WRITE;
/*!40000 ALTER TABLE `faq_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorite_course_user`
--

DROP TABLE IF EXISTS `favorite_course_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite_course_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorite_course_user_user_id_foreign` (`user_id`),
  KEY `favorite_course_user_course_id_foreign` (`course_id`),
  CONSTRAINT `favorite_course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorite_course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite_course_user`
--

LOCK TABLES `favorite_course_user` WRITE;
/*!40000 ALTER TABLE `favorite_course_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorite_course_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_course_sections`
--

DROP TABLE IF EXISTS `featured_course_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_course_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `all_category` int DEFAULT NULL,
  `all_category_ids` text,
  `all_category_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_one` int DEFAULT NULL,
  `category_one_ids` text,
  `category_one_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_two` int DEFAULT NULL,
  `category_two_ids` text,
  `category_two_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_three` int DEFAULT NULL,
  `category_three_ids` text,
  `category_three_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_four` int DEFAULT NULL,
  `category_four_ids` text,
  `category_four_status` tinyint(1) NOT NULL DEFAULT '1',
  `category_five` int DEFAULT NULL,
  `category_five_ids` text,
  `category_five_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_course_sections`
--

LOCK TABLES `featured_course_sections` WRITE;
/*!40000 ALTER TABLE `featured_course_sections` DISABLE KEYS */;
INSERT INTO `featured_course_sections` VALUES (1,NULL,'[1,2]',1,NULL,NULL,1,NULL,NULL,1,NULL,NULL,1,NULL,NULL,1,NULL,NULL,1,'2025-08-09 03:37:40','2025-08-09 03:37:40');
/*!40000 ALTER TABLE `featured_course_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_instructor_translations`
--

DROP TABLE IF EXISTS `featured_instructor_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_instructor_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `featured_instructor_section_id` bigint unsigned NOT NULL DEFAULT '1',
  `lang_code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_instructor_translations`
--

LOCK TABLES `featured_instructor_translations` WRITE;
/*!40000 ALTER TABLE `featured_instructor_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `featured_instructor_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_instructors`
--

DROP TABLE IF EXISTS `featured_instructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_instructors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `button_url` varchar(255) DEFAULT NULL,
  `instructor_ids` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_instructors`
--

LOCK TABLES `featured_instructors` WRITE;
/*!40000 ALTER TABLE `featured_instructors` DISABLE KEYS */;
INSERT INTO `featured_instructors` VALUES (1,NULL,NULL,'2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `featured_instructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `footer_settings`
--

DROP TABLE IF EXISTS `footer_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `footer_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `get_in_touch_text` varchar(255) DEFAULT NULL,
  `google_play_link` varchar(255) DEFAULT NULL,
  `apple_store_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `footer_settings`
--

LOCK TABLES `footer_settings` WRITE;
/*!40000 ALTER TABLE `footer_settings` DISABLE KEYS */;
INSERT INTO `footer_settings` VALUES (1,'uploads/custom-images/wsus-img-2025-08-22-12-53-52-5975.png','Elixone Tech Pls','Addis ABaba Ethiopia','98238182','Where future and Enovation Meets',NULL,NULL,'2025-08-22 01:16:48','2025-08-22 07:53:52');
/*!40000 ALTER TABLE `footer_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homes`
--

DROP TABLE IF EXISTS `homes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `homes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `homes_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homes`
--

LOCK TABLES `homes` WRITE;
/*!40000 ALTER TABLE `homes` DISABLE KEYS */;
INSERT INTO `homes` VALUES (1,'main','2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'online','2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'university','2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'business','2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'yoga','2025-08-07 21:04:00','2025-08-07 21:04:00'),(6,'kitchen','2025-08-07 21:04:00','2025-08-07 21:04:00'),(7,'kindergarten','2025-08-07 21:04:00','2025-08-07 21:04:00'),(8,'language','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `homes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_request_setting_translations`
--

DROP TABLE IF EXISTS `instructor_request_setting_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_request_setting_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_request_setting_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_request_setting_translations`
--

LOCK TABLES `instructor_request_setting_translations` WRITE;
/*!40000 ALTER TABLE `instructor_request_setting_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_request_setting_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_request_settings`
--

DROP TABLE IF EXISTS `instructor_request_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_request_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `need_certificate` tinyint(1) NOT NULL DEFAULT '1',
  `need_identity_scan` tinyint(1) NOT NULL DEFAULT '1',
  `bank_information` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_request_settings`
--

LOCK TABLES `instructor_request_settings` WRITE;
/*!40000 ALTER TABLE `instructor_request_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_request_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_requests`
--

DROP TABLE IF EXISTS `instructor_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instructor_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `certificate` text,
  `identity_scan` text,
  `payout_account` varchar(255) DEFAULT NULL,
  `payout_information` text,
  `extra_information` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_requests`
--

LOCK TABLES `instructor_requests` WRITE;
/*!40000 ALTER TABLE `instructor_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jitsi_settings`
--

DROP TABLE IF EXISTS `jitsi_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jitsi_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `permissions` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jitsi_settings_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `jitsi_settings_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jitsi_settings`
--

LOCK TABLES `jitsi_settings` WRITE;
/*!40000 ALTER TABLE `jitsi_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `jitsi_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `direction` varchar(255) NOT NULL DEFAULT 'ltr',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `is_default` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_name_unique` (`name`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en',NULL,'ltr','1','1','2025-08-07 21:03:59','2025-08-07 21:03:59');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson_questions`
--

DROP TABLE IF EXISTS `lesson_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lesson_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `lesson_id` bigint unsigned NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `question_description` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_questions`
--

LOCK TABLES `lesson_questions` WRITE;
/*!40000 ALTER TABLE `lesson_questions` DISABLE KEYS */;
INSERT INTO `lesson_questions` VALUES (1,1002,2,1,'test 1','<p>test 1</p>',0,'2025-08-11 21:44:41','2025-08-11 21:44:41'),(2,1002,2,1,'test 1','<p>test 1</p>',0,'2025-08-11 21:44:41','2025-08-11 21:44:41');
/*!40000 ALTER TABLE `lesson_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson_replies`
--

DROP TABLE IF EXISTS `lesson_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lesson_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `reply` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lesson_replies_question_id_foreign` (`question_id`),
  CONSTRAINT `lesson_replies_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `lesson_questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_replies`
--

LOCK TABLES `lesson_replies` WRITE;
/*!40000 ALTER TABLE `lesson_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `lesson_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_settings`
--

DROP TABLE IF EXISTS `marketing_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marketing_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_settings`
--

LOCK TABLES `marketing_settings` WRITE;
/*!40000 ALTER TABLE `marketing_settings` DISABLE KEYS */;
INSERT INTO `marketing_settings` VALUES (1,'register','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'course_details','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'add_to_cart','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'remove_from_cart','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'checkout','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(6,'order_success','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(7,'order_failed','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(8,'contact_page','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(9,'instructor_contact','1','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `marketing_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_item_translations`
--

DROP TABLE IF EXISTS `menu_item_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_item_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_item_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_item_translations_menu_item_id_foreign` (`menu_item_id`),
  CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_item_translations`
--

LOCK TABLES `menu_item_translations` WRITE;
/*!40000 ALTER TABLE `menu_item_translations` DISABLE KEYS */;
INSERT INTO `menu_item_translations` VALUES (1,1,'en','Home','2025-08-08 08:42:27','2025-08-08 08:42:27'),(2,2,'en','Courses','2025-08-08 23:38:14','2025-08-08 23:38:14'),(3,3,'en','About Us','2025-08-08 23:38:20','2025-08-08 23:38:20'),(4,4,'en','Contact','2025-08-08 23:38:23','2025-08-08 23:38:23');
/*!40000 ALTER TABLE `menu_item_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `class` varchar(255) DEFAULT NULL,
  `menu_id` bigint unsigned NOT NULL,
  `depth` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,'Home','/',0,0,NULL,9,0,'2025-08-08 08:42:27','2025-08-08 23:38:14',0),(2,'Courses','/courses',0,1,NULL,9,0,'2025-08-08 23:38:14','2025-08-08 23:38:20',0),(3,'About Us','/about-us',0,2,NULL,9,0,'2025-08-08 23:38:20','2025-08-08 23:38:23',0),(4,'Contact','/contact',0,4,NULL,9,0,'2025-08-08 23:38:23','2025-08-08 23:38:23',0);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_translations`
--

DROP TABLE IF EXISTS `menu_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_translations_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_translations_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_translations`
--

LOCK TABLES `menu_translations` WRITE;
/*!40000 ALTER TABLE `menu_translations` DISABLE KEYS */;
INSERT INTO `menu_translations` VALUES (7,9,'en','Nav Menu','2024-05-23 19:10:20','2025-08-08 08:42:27'),(9,10,'en','footer_col_one','2024-05-26 13:25:04','2024-05-26 13:25:04'),(15,13,'en','footer_col_two','2024-05-26 13:25:37','2024-05-26 13:25:37'),(17,14,'en','footer_col_three','2024-05-26 13:32:09','2024-05-26 13:32:09'),(23,9,'bn','nav_menu','2024-06-01 00:14:54','2024-06-01 00:14:54'),(24,10,'bn','footer_col_one','2024-06-01 00:14:54','2024-06-01 00:14:54'),(25,13,'bn','footer_col_two','2024-06-01 00:14:54','2024-06-01 00:14:54'),(26,14,'bn','footer_col_three','2024-06-01 00:14:54','2024-06-01 00:14:54');
/*!40000 ALTER TABLE `menu_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (9,'Nav Menu','nav-menu','2024-05-23 19:10:20','2025-08-08 08:42:27'),(10,'footer_col_one','footer-col-one','2024-05-26 13:25:04','2024-05-26 13:25:04'),(13,'footer_col_two','footer-col-two-1PiTN','2024-05-26 13:25:37','2024-05-26 13:25:37'),(14,'footer_col_three','footer-col-three','2024-05-26 13:32:09','2024-05-26 13:32:09');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_11_05_045432_create_admins_table',1),(6,'2023_11_05_114814_create_languages_table',1),(7,'2023_11_06_043247_create_settings_table',1),(8,'2023_11_06_054251_create_seo_settings_table',1),(9,'2023_11_06_094842_create_custom_paginations_table',1),(10,'2023_11_06_115856_create_email_templates_table',1),(11,'2023_11_07_051924_create_multi_currencies_table',1),(12,'2023_11_07_104315_create_blog_categories_table',1),(13,'2023_11_07_104328_create_blog_category_translations_table',1),(14,'2023_11_07_104336_create_blogs_table',1),(15,'2023_11_07_104343_create_blog_translations_table',1),(16,'2023_11_07_104546_create_blog_comments_table',1),(17,'2023_11_09_100621_create_jobs_table',1),(18,'2023_11_16_035458_add_user_info_to_users',1),(19,'2023_11_16_061508_add_forget_info_to_users',1),(20,'2023_11_16_063639_add_phone_to_users',1),(21,'2023_11_19_055229_add_image_to_users',1),(22,'2023_11_19_064341_create_banned_histories_table',1),(23,'2023_11_21_043030_create_news_letters_table',1),(24,'2023_11_21_094702_create_contact_messages_table',1),(25,'2023_11_22_105539_create_permission_tables',1),(26,'2023_11_29_095126_create_coupons_table',1),(27,'2023_11_29_104658_create_testimonials_table',1),(28,'2023_11_29_104704_create_testimonial_translations_table',1),(29,'2023_11_29_105234_create_coupon_histories_table',1),(30,'2023_11_29_113632_add_min_price_to_coupon',1),(31,'2023_11_30_044838_create_faqs_table',1),(32,'2023_11_30_044844_create_faq_translations_table',1),(33,'2023_11_30_095404_add_wallet_balance_to_users',1),(34,'2024_01_01_054644_create_socialite_credentials_table',1),(35,'2024_01_03_092007_create_custom_codes_table',1),(36,'2024_02_10_060044_create_configurations_table',1),(37,'2024_02_28_064128_add_forgot_info_to_admins',1),(38,'2024_03_28_095207_create_menus_wp_table',1),(39,'2024_03_28_095208_create_menu_translations_table',1),(40,'2024_03_28_095209_create_menu_items_wp_table',1),(41,'2024_03_28_095210_create_menu_item_translations_table',1),(42,'2024_03_28_095211_add-role-id-to-menu-items-table',1),(43,'2024_04_03_042331_add_new_columns_to_users',1),(44,'2024_04_03_044043_create_user_education_table',1),(45,'2024_04_03_044103_create_user_experiences_table',1),(46,'2024_04_03_044134_create_user_skill_topics_table',1),(47,'2024_04_05_060046_create_countries_table',1),(48,'2024_04_05_060133_create_states_table',1),(49,'2024_04_05_060149_create_cities_table',1),(50,'2024_04_08_041719_create_instructor_requests_table',1),(51,'2024_04_08_042513_create_instructor_request_settings_table',1),(52,'2024_04_15_103628_create_course_categories_table',1),(53,'2024_04_15_112656_create_course_category_translations_table',1),(54,'2024_04_18_031942_create_course_languages_table',1),(55,'2024_04_18_044110_create_course_levels_table',1),(56,'2024_04_18_044125_create_course_level_translations_table',1),(57,'2024_04_18_070749_create_courses_table',1),(58,'2024_04_21_093245_create_course_partner_instructors_table',1),(59,'2024_04_21_094654_create_course_selected_levels_table',1),(60,'2024_04_21_094841_create_course_selected_languages_table',1),(61,'2024_04_21_095342_create_course_selected_filter_options_table',1),(62,'2024_04_22_114039_create_course_chapters_table',1),(63,'2024_04_23_090340_create_course_chapter_items_table',1),(64,'2024_04_23_090700_create_course_chapter_lessons_table',1),(65,'2024_04_24_093046_create_quizzes_table',1),(66,'2024_04_24_114441_create_quiz_questions_table',1),(67,'2024_04_28_034905_create_quiz_question_answers_table',1),(68,'2024_05_12_035535_create_course_progress_table',1),(69,'2024_05_13_041532_create_quiz_results_table',1),(70,'2024_05_13_101033_create_lesson_questions_table',1),(71,'2024_05_13_101258_create_lesson_replies_table',1),(72,'2024_05_14_095807_create_announcements_table',1),(73,'2024_05_14_114640_create_course_reviews_table',1),(74,'2024_05_16_034644_create_certificate_builders_table',1),(75,'2024_05_16_041919_create_certificate_builder_items_table',1),(76,'2024_05_16_110701_create_badges_table',1),(77,'2024_05_20_052819_create_brands_table',1),(78,'2024_05_20_094331_create_featured_course_sections_table',1),(79,'2024_05_21_060612_create_featured_instructors_table',1),(80,'2024_05_21_060634_create_featured_instructor_translations_table',1),(81,'2024_05_26_032547_create_section_settings_table',1),(82,'2024_05_26_052359_create_footer_settings_table',1),(83,'2024_05_26_065953_create_social_links_table',1),(84,'2024_05_26_164008_create_contact_sections_table',1),(85,'2024_05_27_045919_create_custom_pages_table',1),(86,'2024_05_27_050016_create_custom_page_translations_table',1),(87,'2024_06_02_045115_add_softdelete_to_courses_table',1),(88,'2024_06_02_080423_create_course_delete_requests_table',1),(89,'2024_09_01_042119_create_zoom_credentials_table',1),(90,'2024_09_01_042120_create_course_live_classes_table',1),(91,'2024_09_04_122554_create_jitsi_settings_table',1),(92,'2024_09_10_103347_create_marketing_settings_table',1),(93,'2024_09_29_090219_create_instructor_request_setting_translations_table',1),(94,'2024_10_08_060425_create_homes_table',1),(95,'2024_10_08_060618_create_sections_table',1),(96,'2024_10_08_060636_create_section_translations_table',1),(97,'2024_12_09_064934_favorite_course_user',1),(98,'2024_12_10_051251_create_custom_addons_table',1),(99,'2025_01_13_082341_create_carts_table',1),(100,'2025_08_07_201919_create_orders_table',2),(101,'2025_08_07_201925_create_order_items_table',2),(102,'2025_08_07_201931_create_enrollments_table',2),(103,'2025_08_08_015811_create_assessments_table',3),(104,'2025_08_08_015838_create_user_assessments_table',4),(105,'2025_08_08_020019_add_homepage_fields_to_testimonials_table',4),(106,'2024_01_01_000001_create_withdraw_methods_table',5),(107,'2024_01_01_000002_create_withdraw_requests_table',5),(108,'2024_12_19_000000_set_default_section_settings',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\Admin',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_currencies`
--

DROP TABLE IF EXISTS `multi_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multi_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_icon` varchar(255) NOT NULL,
  `is_default` varchar(255) NOT NULL,
  `currency_rate` double(8,2) NOT NULL,
  `currency_position` varchar(255) NOT NULL DEFAULT 'before_price',
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_currencies`
--

LOCK TABLES `multi_currencies` WRITE;
/*!40000 ALTER TABLE `multi_currencies` DISABLE KEYS */;
INSERT INTO `multi_currencies` VALUES (1,'Birr','Br','USD','$','yes',1.00,'before_price','active','2025-08-07 21:03:59','2025-08-08 23:33:22');
/*!40000 ALTER TABLE `multi_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_letters`
--

DROP TABLE IF EXISTS `news_letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_letters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not_verified',
  `verify_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_letters`
--

LOCK TABLES `news_letters` WRITE;
/*!40000 ALTER TABLE `news_letters` DISABLE KEYS */;
/*!40000 ALTER TABLE `news_letters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price` double NOT NULL,
  `item_type` enum('course','product') NOT NULL DEFAULT 'course',
  `product_id` bigint unsigned DEFAULT NULL,
  `course_id` bigint unsigned NOT NULL,
  `commission_rate` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` text,
  `buyer_id` bigint unsigned DEFAULT NULL,
  `seller_id` bigint unsigned DEFAULT NULL,
  `status` enum('pending','processing','completed','declined') NOT NULL DEFAULT 'pending',
  `has_coupon` tinyint(1) NOT NULL DEFAULT '0',
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_discount_percent` int DEFAULT NULL,
  `coupon_discount_amount` double DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payable_amount` double DEFAULT NULL,
  `gateway_charge` double DEFAULT NULL,
  `payable_with_charge` double DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `conversion_rate` double DEFAULT NULL,
  `payable_currency` varchar(255) DEFAULT NULL,
  `payment_details` text,
  `transaction_id` varchar(255) DEFAULT NULL,
  `commission_rate` int DEFAULT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'course',
  `order_details` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard.view','admin','dashboard','2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'admin.profile.view','admin','admin profile','2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'admin.profile.update','admin','admin profile','2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'admin.view','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'admin.create','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(6,'admin.store','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(7,'admin.edit','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(8,'admin.update','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(9,'admin.delete','admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00'),(10,'blog.category.view','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(11,'blog.category.create','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(12,'blog.category.translate','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(13,'blog.category.store','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(14,'blog.category.edit','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(15,'blog.category.update','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(16,'blog.category.delete','admin','blog category','2025-08-07 21:04:00','2025-08-07 21:04:00'),(17,'blog.view','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(18,'blog.create','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(19,'blog.translate','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(20,'blog.store','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(21,'blog.edit','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(22,'blog.update','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(23,'blog.delete','admin','blog','2025-08-07 21:04:00','2025-08-07 21:04:00'),(24,'blog.comment.view','admin','blog comment','2025-08-07 21:04:00','2025-08-07 21:04:00'),(25,'blog.comment.update','admin','blog comment','2025-08-07 21:04:00','2025-08-07 21:04:00'),(26,'blog.comment.delete','admin','blog comment','2025-08-07 21:04:00','2025-08-07 21:04:00'),(27,'role.view','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(28,'role.create','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(29,'role.store','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(30,'role.assign','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(31,'role.edit','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(32,'role.update','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(33,'role.delete','admin','role','2025-08-07 21:04:00','2025-08-07 21:04:00'),(34,'setting.view','admin','setting','2025-08-07 21:04:00','2025-08-07 21:04:00'),(35,'setting.update','admin','setting','2025-08-07 21:04:00','2025-08-07 21:04:00'),(36,'basic.payment.view','admin','basic payment','2025-08-07 21:04:00','2025-08-07 21:04:00'),(37,'basic.payment.update','admin','basic payment','2025-08-07 21:04:00','2025-08-07 21:04:00'),(38,'contect.message.view','admin','contect message','2025-08-07 21:04:00','2025-08-07 21:04:00'),(39,'contect.message.delete','admin','contect message','2025-08-07 21:04:00','2025-08-07 21:04:00'),(40,'currency.view','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(41,'currency.create','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(42,'currency.store','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(43,'currency.edit','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(44,'currency.update','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(45,'currency.delete','admin','currency','2025-08-07 21:04:00','2025-08-07 21:04:00'),(46,'customer.view','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(47,'customer.bulk.mail','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(48,'customer.create','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(49,'customer.store','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(50,'customer.edit','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(51,'customer.update','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(52,'customer.delete','admin','customer','2025-08-07 21:04:00','2025-08-07 21:04:00'),(53,'language.view','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(54,'language.create','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(55,'language.store','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(56,'language.edit','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(57,'language.update','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(58,'language.delete','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(59,'language.translate','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(60,'language.single.translate','admin','language','2025-08-07 21:04:00','2025-08-07 21:04:00'),(61,'menu.view','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(62,'menu.create','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(63,'menu.store','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(64,'menu.edit','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(65,'menu.update','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(66,'menu.delete','admin','menu builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(67,'page.management','admin','page builder','2025-08-07 21:04:00','2025-08-07 21:04:00'),(68,'newsletter.view','admin','newsletter','2025-08-07 21:04:00','2025-08-07 21:04:00'),(69,'newsletter.mail','admin','newsletter','2025-08-07 21:04:00','2025-08-07 21:04:00'),(70,'newsletter.delete','admin','newsletter','2025-08-07 21:04:00','2025-08-07 21:04:00'),(71,'testimonial.view','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(72,'testimonial.create','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(73,'testimonial.translate','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(74,'testimonial.store','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(75,'testimonial.edit','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(76,'testimonial.update','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(77,'testimonial.delete','admin','testimonial','2025-08-07 21:04:00','2025-08-07 21:04:00'),(78,'faq.view','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(79,'faq.create','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(80,'faq.translate','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(81,'faq.store','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(82,'faq.edit','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(83,'faq.update','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(84,'faq.delete','admin','faq','2025-08-07 21:04:00','2025-08-07 21:04:00'),(85,'location.view','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(86,'location.create','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(87,'location.store','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(88,'location.edit','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(89,'location.update','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(90,'location.delete','admin','locations','2025-08-07 21:04:00','2025-08-07 21:04:00'),(91,'instructor.request.list','admin','instructor request','2025-08-07 21:04:00','2025-08-07 21:04:00'),(92,'instructor.request.setting','admin','instructor request','2025-08-07 21:04:00','2025-08-07 21:04:00'),(93,'course.management','admin','courses','2025-08-07 21:04:00','2025-08-07 21:04:00'),(94,'course.certificate.management','admin','course certificate management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(95,'badge.management','admin','Badges','2025-08-07 21:04:00','2025-08-07 21:04:00'),(96,'order.management','admin','order management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(97,'coupon.management','admin','coupon management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(98,'withdraw.management','admin','withdraw management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(99,'appearance.management','admin','site appearance management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(100,'section.management','admin','site appearance management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(101,'brand.management','admin','brand management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(102,'footer.management','admin','footer management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(103,'social.link.management','admin','social link management','2025-08-07 21:04:00','2025-08-07 21:04:00'),(104,'addon.view','admin','Addons','2025-08-07 21:04:00','2025-08-07 21:04:00'),(105,'addon.install','admin','Addons','2025-08-07 21:04:00','2025-08-07 21:04:00'),(106,'addon.update','admin','Addons','2025-08-07 21:04:00','2025-08-07 21:04:00'),(107,'addon.status.change','admin','Addons','2025-08-07 21:04:00','2025-08-07 21:04:00'),(108,'addon.remove','admin','Addons','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_question_answers`
--

DROP TABLE IF EXISTS `quiz_question_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_question_answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `question_id` bigint unsigned NOT NULL,
  `correct` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_question_answers`
--

LOCK TABLES `quiz_question_answers` WRITE;
/*!40000 ALTER TABLE `quiz_question_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_question_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` bigint unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('descriptive','multiple') NOT NULL DEFAULT 'multiple',
  `grade` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_questions_quiz_id_foreign` (`quiz_id`),
  CONSTRAINT `quiz_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quiz_id` bigint unsigned NOT NULL,
  `result` json DEFAULT NULL,
  `user_grade` int DEFAULT NULL,
  `status` enum('pass','failed') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_results`
--

LOCK TABLES `quiz_results` WRITE;
/*!40000 ALTER TABLE `quiz_results` DISABLE KEYS */;
INSERT INTO `quiz_results` VALUES (1,1003,1,'[]',0,'failed','2025-08-11 21:36:23','2025-08-11 21:36:23'),(2,1002,1,'[]',0,'failed','2025-08-11 21:44:09','2025-08-11 21:44:09'),(3,1002,1,'[]',0,'failed','2025-08-11 21:51:35','2025-08-11 21:51:35');
/*!40000 ALTER TABLE `quiz_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quizzes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chapter_item_id` bigint unsigned NOT NULL,
  `instructor_id` bigint unsigned NOT NULL,
  `chapter_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `time` varchar(255) DEFAULT NULL,
  `attempt` varchar(255) DEFAULT NULL,
  `pass_mark` varchar(255) DEFAULT NULL,
  `total_mark` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quizzes`
--

LOCK TABLES `quizzes` WRITE;
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` VALUES (1,1,1003,3,2,'what is the capital city of ethiopia','2','2','8','10','active','2025-08-11 21:04:10','2025-08-11 21:42:20');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(97,1),(98,1),(99,1),(100,1),(101,1),(102,1),(103,1),(104,1),(105,1),(106,1),(107,1),(108,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','admin','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_settings`
--

DROP TABLE IF EXISTS `section_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hero_section` tinyint(1) NOT NULL DEFAULT '0',
  `top_category_section` tinyint(1) NOT NULL DEFAULT '0',
  `brands_section` tinyint(1) NOT NULL DEFAULT '0',
  `about_section` tinyint(1) NOT NULL DEFAULT '0',
  `featured_course_section` tinyint(1) NOT NULL DEFAULT '0',
  `news_letter_section` tinyint(1) NOT NULL DEFAULT '0',
  `featured_instructor_section` tinyint(1) NOT NULL DEFAULT '0',
  `counter_section` tinyint(1) NOT NULL DEFAULT '0',
  `faq_section` tinyint(1) NOT NULL DEFAULT '0',
  `our_features_section` tinyint(1) NOT NULL DEFAULT '0',
  `testimonial_section` tinyint(1) NOT NULL DEFAULT '0',
  `banner_section` tinyint(1) NOT NULL DEFAULT '0',
  `latest_blog_section` tinyint(1) NOT NULL DEFAULT '0',
  `blog_page` tinyint(1) NOT NULL DEFAULT '0',
  `about_page` tinyint(1) NOT NULL DEFAULT '0',
  `contact_page` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_settings`
--

LOCK TABLES `section_settings` WRITE;
/*!40000 ALTER TABLE `section_settings` DISABLE KEYS */;
INSERT INTO `section_settings` VALUES (1,1,1,1,1,1,1,1,1,1,1,0,1,1,0,0,0,'2025-08-08 03:09:55','2025-08-08 03:09:55');
/*!40000 ALTER TABLE `section_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section_translations`
--

DROP TABLE IF EXISTS `section_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `section_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `content` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section_translations_section_id_foreign` (`section_id`),
  CONSTRAINT `section_translations_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section_translations`
--

LOCK TABLES `section_translations` WRITE;
/*!40000 ALTER TABLE `section_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `section_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `home_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `global_content` json DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sections_home_id_foreign` (`home_id`),
  CONSTRAINT `sections_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `homes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,1,'hero_section','{\"banner_image\": \"uploads/custom-images/wsus-img-2024-06-26-06-06-24-6800.webp\", \"hero_background\": \"uploads/custom-images/wsus-img-2024-06-23-04-25-27-8319.webp\", \"video_button_url\": \"https://www.youtube.com/watch?v=pMzGDBP6Bic\", \"action_button_url\": \"/courses\", \"banner_background\": \"uploads/custom-images/wsus-img-2024-06-03-09-44-49-7136.webp\", \"enroll_students_image\": \"uploads/custom-images/wsus-img-2024-06-03-09-44-49-4396.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,1,'about_section','{\"image\": \"uploads/custom-images/wsus-img-2024-06-03-07-17-53-5562.webp\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,1,'newsletter_section','{\"image\": \"uploads/custom-images/wsus-img-2024-06-04-11-18-08-2099.webp\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,1,'counter_section','{\"total_awards_count\": 50, \"total_courses_count\": 800, \"total_student_count\": 3000, \"total_instructor_count\": 100}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,1,'faq_section','{\"image\": \"uploads/custom-images/wsus-img-2024-06-04-11-35-48-7341.webp\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(6,1,'our_features_section','{\"image_one\": \"uploads/custom-images/wsus-img-2024-06-11-05-27-50-9263.png\", \"image_two\": \"uploads/custom-images/wsus-img-2024-06-11-05-49-32-6821.png\", \"image_four\": \"uploads/custom-images/wsus-img-2024-06-11-05-27-50-7828.png\", \"image_three\": \"uploads/custom-images/wsus-img-2024-06-23-05-11-29-2802.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(7,1,'banner_section','{\"student_image\": \"uploads/custom-images/wsus-img-2024-06-04-11-44-52-8789.webp\", \"instructor_image\": \"uploads/custom-images/wsus-img-2024-06-04-11-44-52-4232.webp\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(8,2,'hero_section','{\"banner_image\": \"uploads/custom-images/theme_online_banner_img.png\", \"hero_background\": \"uploads/custom-images/theme_online_hero_bg.png\", \"video_button_url\": \"https://www.youtube.com/watch?v=pMzGDBP6Bic\", \"action_button_url\": \"/courses\", \"banner_background\": \"uploads/custom-images/theme_online_banner_bg.svg\", \"enroll_students_image\": \"uploads/custom-images/theme_online_enroll_students_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(9,2,'about_section','{\"image\": \"uploads/custom-images/theme_online_about_img.png\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(10,2,'newsletter_section','{\"image\": \"uploads/custom-images/theme_online_newsletter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(11,2,'counter_section','{\"total_courses_count\": 800, \"total_student_count\": 3000, \"total_instructor_count\": 100}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(12,2,'faq_section','{\"image\": \"uploads/custom-images/theme_online_faq.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(13,2,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_online_features_icon_1.png\", \"image_two\": \"uploads/custom-images/theme_online_features_icon_2.png\", \"image_four\": \"uploads/custom-images/theme_online_features_icon_4.png\", \"image_three\": \"uploads/custom-images/theme_online_features_icon_3.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(14,2,'banner_section','{\"student_image\": \"uploads/custom-images/theme_online_student_image.png\", \"instructor_image\": \"uploads/custom-images/theme_online_instructor_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(15,3,'hero_section','{\"banner_image\": \"uploads/custom-images/theme_university_banner_img.png\", \"hero_background\": \"uploads/custom-images/theme_university_hero_bg.jpg\", \"action_button_url\": \"/courses\", \"banner_background\": \"uploads/custom-images/theme_university_banner_bg.svg\", \"enroll_students_image\": \"uploads/custom-images/theme_university_enroll_students_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(16,3,'about_section','{\"image\": \"uploads/custom-images/theme_university_about_img.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\", \"year_experience\": \"15\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(17,3,'newsletter_section','{\"image\": \"uploads/custom-images/theme_university_newsletter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(18,3,'counter_section','{\"button_url\": \"/courses\", \"total_courses_count\": 800, \"total_student_count\": 3000, \"total_instructor_count\": 100}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(19,3,'faq_section','{\"image\": \"uploads/custom-images/theme_university_faq.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(20,3,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_university_features_icon_1.svg\", \"image_two\": \"uploads/custom-images/theme_university_features_icon_2.svg\", \"image_four\": \"uploads/custom-images/theme_university_features_icon_4.svg\", \"image_three\": \"uploads/custom-images/theme_university_features_icon_3.svg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(21,3,'banner_section','{\"bg_image\": \"uploads/custom-images/wsus-img-2024-06-04-11-44-52-8799.jpg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(22,4,'slider_section','{\"image_one\": \"uploads/custom-images/theme_business_slider_1.jpg\", \"image_two\": \"uploads/custom-images/theme_business_slider_2.jpg\", \"image_three\": \"uploads/custom-images/theme_business_slider_3.jpg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(23,4,'about_section','{\"image\": \"uploads/custom-images/theme_business_about_img.jpg\", \"image_two\": \"uploads/custom-images/wsus-img-2024-06-03-07-17-53-5555.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\", \"image_three\": \"uploads/custom-images/wsus-img-2024-06-03-07-17-53-6666.jpg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(24,4,'newsletter_section','{\"image\": \"uploads/custom-images/theme_business_newsletter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(25,4,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_business_features_icon_1.png\", \"image_two\": \"uploads/custom-images/theme_business_features_icon_2.png\", \"image_four\": \"uploads/custom-images/theme_business_features_icon_4.png\", \"image_three\": \"uploads/custom-images/theme_business_features_icon_3.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(26,4,'banner_section','{\"student_image\": \"uploads/custom-images/theme_business_student_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(27,4,'faq_section','{\"image\": \"uploads/custom-images/theme_business_faq.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(28,5,'hero_section','{\"banner_image\": \"uploads/custom-images/h4_hero_img.png\", \"booking_number\": \"+1 (123) 909090\", \"hero_background\": \"uploads/custom-images/h4_hero_bg.jpg\", \"action_button_url\": \"/courses\", \"banner_background\": \"uploads/custom-images/h4_hero_img_shape02.svg\", \"banner_background_two\": \"uploads/custom-images/h4_hero_img_shape01.svg\", \"enroll_students_image\": \"uploads/custom-images/theme_yoga_enroll_students_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(29,5,'our_features_section','{\"image_one\": \"uploads/custom-images/h4_features_icon01.svg\", \"image_two\": \"uploads/custom-images/h4_features_icon02.svg\", \"image_four\": \"uploads/custom-images/h4_features_icon04.png\", \"image_three\": \"uploads/custom-images/h4_features_icon03.svg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(30,5,'about_section','{\"image\": \"uploads/custom-images/h4_choose_img.jpg\", \"image_two\": \"uploads/custom-images/h4_choose_img02.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(31,5,'banner_section','{\"bg_image\": \"uploads/custom-images/h4_video_bg.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=pMzGDBP6Bic\", \"student_image\": \"uploads/custom-images/h4_cta_img.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(32,5,'newsletter_section','{\"image\": \"uploads/custom-images/theme_yoga_newslettter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(33,5,'faq_section','{\"image\": \"uploads/custom-images/theme_yoga_faq.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(34,6,'hero_section','{\"banner_image\": \"uploads/custom-images/h8_hero_img.png\", \"hero_background\": \"uploads/custom-images/h8_hero_bg.jpg\", \"banner_background\": \"uploads/custom-images/h8_hero_img_shape.svg\", \"banner_background_two\": \"uploads/custom-images/h8_hero_img_shape02.svg\", \"enroll_students_image\": \"uploads/custom-images/theme_kitchen_enroll_students_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(35,6,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_kitchen_features_icon_1.png\", \"image_two\": \"uploads/custom-images/theme_kitchen_features_icon_2.png\", \"image_four\": \"uploads/custom-images/theme_kitchen_features_icon_4.png\", \"image_three\": \"uploads/custom-images/theme_kitchen_features_icon_3.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(36,6,'about_section','{\"image\": \"uploads/custom-images/h8_about_img01.jpg\", \"image_two\": \"uploads/custom-images/h8_about_img02.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\", \"image_three\": \"uploads/custom-images/undo-diploma.png\", \"course_success\": \"86\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(37,6,'banner_section','{\"student_image\": \"uploads/custom-images/h8_cta_img.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(38,6,'faq_section','{\"image\": \"uploads/custom-images/theme_kitchen_faq.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(39,6,'newsletter_section','{\"image\": \"uploads/custom-images/theme_kitchen_newslettter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(40,7,'hero_section','{\"banner_image\": \"uploads/custom-images/h5_hero_img.png\", \"hero_background\": \"uploads/custom-images/h5_hero_bg.jpg\", \"action_button_url\": \"/courses\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(41,7,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_kindergarten_features_icon_1.png\", \"image_two\": \"uploads/custom-images/theme_kindergarten_features_icon_2.png\", \"image_four\": \"uploads/custom-images/theme_kindergarten_features_icon_4.png\", \"image_three\": \"uploads/custom-images/theme_kindergarten_features_icon_3.png\", \"button_url_one\": \"/about-us\", \"button_url_two\": \"/about-us\", \"button_url_four\": \"/about-us\", \"button_url_three\": \"/about-us\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(42,7,'about_section','{\"image\": \"uploads/custom-images/h5_about_img01.jpg\", \"image_two\": \"uploads/custom-images/h5_about_img02.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\", \"phone_number\": \"+985 0059 500\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(43,7,'faq_section','{\"image\": \"uploads/custom-images/h5_faq_img.jpg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(44,7,'newsletter_section','{\"image\": \"uploads/custom-images/theme_kindergarten_newsletter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(45,7,'banner_section','{\"student_image\": \"uploads/custom-images/theme_kindergarten_student_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(46,8,'hero_section','{\"banner_image\": \"uploads/custom-images/h6_hero_img.jpg\", \"hero_background\": \"uploads/custom-images/h6_hero_bg.jpg\", \"video_button_url\": \"https://www.youtube.com/watch?v=pMzGDBP6Bic\", \"action_button_url\": \"/courses\", \"enroll_students_image\": \"uploads/custom-images/theme_language_enroll_students_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(47,8,'about_section','{\"image\": \"uploads/custom-images/h6_choose_img.jpg\", \"video_url\": \"https://www.youtube.com/watch?v=VkBnNxneA_A\", \"button_url\": \"/about-us\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(48,8,'faq_section','{\"image\": \"uploads/custom-images/h6_faq_img01.jpg\", \"image_two\": \"uploads/custom-images/h6_faq_img02.jpg\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(49,8,'counter_section','{\"image\": \"uploads/custom-images/theme_language_fact_img.png\", \"total_student_count\": 3000, \"total_instructor_count\": 100}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(50,8,'our_features_section','{\"image_one\": \"uploads/custom-images/theme_language_features_icon_1.png\", \"image_two\": \"uploads/custom-images/theme_language_features_icon_2.png\", \"image_four\": \"uploads/custom-images/theme_language_features_icon_4.png\", \"image_three\": \"uploads/custom-images/theme_language_features_icon_3.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(51,8,'banner_section','{\"student_image\": \"uploads/custom-images/theme_language_student_image.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00'),(52,8,'newsletter_section','{\"image\": \"uploads/custom-images/theme_language_newsletter.png\"}',1,'2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_settings`
--

DROP TABLE IF EXISTS `seo_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seo_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `seo_title` text NOT NULL,
  `seo_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_settings`
--

LOCK TABLES `seo_settings` WRITE;
/*!40000 ALTER TABLE `seo_settings` DISABLE KEYS */;
INSERT INTO `seo_settings` VALUES (1,'home_page','Home || UNDO','Home || UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00'),(2,'about_page','About || UNDO','About || UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00'),(3,'course_page','Course || UNDO','Course || UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00'),(4,'blog_page','Blog || UNDO','Blog || UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00'),(5,'contact_page','Contact || UNDO','Contact || UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `seo_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'app_name','UNDO LMS','2025-08-07 21:03:59','2025-08-08 08:56:02'),(2,'version','1.0','2025-08-07 21:03:59','2025-08-08 07:20:25'),(3,'logo','uploads/custom-images/wsus-img-2025-08-22-12-52-15-9835.png','2025-08-07 21:03:59','2025-08-22 07:52:15'),(4,'timezone','Asia/Dhaka','2025-08-07 21:03:59','2025-08-08 08:56:02'),(5,'favicon','uploads/custom-images/wsus-img-2025-08-22-12-52-15-1041.png','2025-08-07 21:03:59','2025-08-22 07:52:15'),(6,'cookie_status','active','2025-08-07 21:03:59','2025-08-22 07:52:58'),(7,'border','normal','2025-08-07 21:03:59','2025-08-22 07:52:58'),(8,'corners','none','2025-08-07 21:03:59','2025-08-22 07:52:58'),(9,'background_color','#51a0f5','2025-08-07 21:03:59','2025-08-22 07:52:58'),(10,'text_color','#fafafa','2025-08-07 21:03:59','2025-08-22 07:52:58'),(11,'border_color','#5d99f8','2025-08-07 21:03:59','2025-08-22 07:52:58'),(12,'btn_bg_color','#fffceb','2025-08-07 21:03:59','2025-08-22 07:52:58'),(13,'btn_text_color','#222758','2025-08-07 21:03:59','2025-08-22 07:52:58'),(14,'link_text','More Info','2025-08-07 21:03:59','2025-08-22 07:52:58'),(15,'link','/page/privacy-policy','2025-08-07 21:03:59','2025-08-22 07:52:58'),(16,'btn_text','Yes','2025-08-07 21:03:59','2025-08-22 07:52:58'),(17,'message','This website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only upon approval.','2025-08-07 21:03:59','2025-08-22 07:52:58'),(18,'copyright_text','UNDO 2025','2025-08-07 21:03:59','2025-08-22 07:53:07'),(19,'recaptcha_site_key','recaptcha_site_key','2025-08-07 21:03:59','2025-08-07 21:03:59'),(20,'recaptcha_secret_key','recaptcha_secret_key','2025-08-07 21:03:59','2025-08-07 21:03:59'),(21,'recaptcha_status','inactive','2025-08-07 21:03:59','2025-08-07 21:03:59'),(22,'tawk_status','inactive','2025-08-07 21:03:59','2025-08-07 21:03:59'),(23,'tawk_chat_link','tawk_chat_link','2025-08-07 21:03:59','2025-08-07 21:03:59'),(24,'google_tagmanager_status','inactive','2025-08-07 21:03:59','2025-08-09 00:00:03'),(25,'google_tagmanager_id','google_tagmanager_id','2025-08-07 21:03:59','2025-08-07 21:03:59'),(26,'pixel_status','inactive','2025-08-07 21:03:59','2025-08-07 21:03:59'),(27,'pixel_app_id','pixel_app_id','2025-08-07 21:03:59','2025-08-07 21:03:59'),(28,'facebook_login_status','inactive','2025-08-07 21:03:59','2025-08-07 21:03:59'),(29,'facebook_app_id','facebook_app_id','2025-08-07 21:03:59','2025-08-07 21:03:59'),(30,'facebook_app_secret','facebook_app_secret','2025-08-07 21:03:59','2025-08-07 21:03:59'),(31,'facebook_redirect_url','facebook_redirect_url','2025-08-07 21:03:59','2025-08-07 21:03:59'),(32,'google_login_status','inactive','2025-08-07 21:03:59','2025-08-07 21:03:59'),(33,'gmail_client_id','gmail_client_id','2025-08-07 21:03:59','2025-08-07 21:03:59'),(34,'gmail_secret_id','gmail_secret_id','2025-08-07 21:03:59','2025-08-07 21:03:59'),(35,'gmail_redirect_url','gmail_redirect_url','2025-08-07 21:03:59','2025-08-07 21:03:59'),(36,'default_avatar','uploads/website-images/default-avatar.png','2025-08-07 21:03:59','2025-08-07 21:03:59'),(37,'breadcrumb_image','uploads/website-images/breadcrumb-image.jpg','2025-08-07 21:03:59','2025-08-07 21:03:59'),(38,'mail_host','mailpit','2025-08-07 21:03:59','2025-08-08 04:14:32'),(39,'mail_sender_email','sender@gmail.com','2025-08-07 21:04:00','2025-08-07 21:04:00'),(40,'mail_username','','2025-08-07 21:04:00','2025-08-08 04:14:33'),(41,'mail_password','','2025-08-07 21:04:00','2025-08-08 04:14:33'),(42,'mail_port','1025','2025-08-07 21:04:00','2025-08-08 04:13:44'),(43,'mail_encryption','','2025-08-07 21:04:00','2025-08-08 04:14:33'),(44,'mail_sender_name','UNDO','2025-08-07 21:04:00','2025-08-07 21:04:00'),(45,'contact_message_receiver_mail','receiver@gmail.com','2025-08-07 21:04:00','2025-08-07 21:04:00'),(46,'pusher_app_id','pusher_app_id','2025-08-07 21:04:00','2025-08-07 21:04:00'),(47,'pusher_app_key','pusher_app_key','2025-08-07 21:04:00','2025-08-07 21:04:00'),(48,'pusher_app_secret','pusher_app_secret','2025-08-07 21:04:00','2025-08-07 21:04:00'),(49,'pusher_app_cluster','pusher_app_cluster','2025-08-07 21:04:00','2025-08-07 21:04:00'),(50,'pusher_status','inactive','2025-08-07 21:04:00','2025-08-07 21:04:00'),(51,'club_point_rate','1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(52,'club_point_status','active','2025-08-07 21:04:00','2025-08-07 21:04:00'),(53,'maintenance_mode','0','2025-08-07 21:04:00','2025-08-11 20:34:50'),(54,'maintenance_title','Website Under maintenance','2025-08-07 21:04:00','2025-08-11 20:34:51'),(55,'maintenance_description','<p>We are currently performing maintenance on our website to<br>improve your experience. Please check back later.</p>\r\n<p><a title=\"UNDO\" href=\"https://elixone.com/\">UNDO</a></p>','2025-08-07 21:04:00','2025-08-11 20:34:51'),(56,'last_update_date','2025-08-07 14:03:59','2025-08-07 21:04:00','2025-08-07 21:04:00'),(57,'is_queable','inactive','2025-08-07 21:04:00','2025-08-08 08:56:02'),(58,'commission_rate','0','2025-08-07 21:04:00','2025-08-07 21:04:00'),(59,'site_address','Addis Ababa Ethiopia','2025-08-07 21:04:00','2025-08-08 08:56:02'),(60,'site_email','test@gmail.com','2025-08-07 21:04:00','2025-08-08 08:56:02'),(61,'site_theme','university','2025-08-07 21:04:00','2025-08-08 11:08:39'),(62,'preloader','/frontend/img/logo/preloader.svg','2025-08-07 21:04:00','2025-08-07 21:04:00'),(63,'primary_color','#5751e1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(64,'secondary_color','#ffc224','2025-08-07 21:04:00','2025-08-07 21:04:00'),(65,'common_color_one','#050071','2025-08-07 21:04:00','2025-08-07 21:04:00'),(66,'common_color_two','#282568','2025-08-07 21:04:00','2025-08-07 21:04:00'),(67,'common_color_three','#1C1A4A','2025-08-07 21:04:00','2025-08-07 21:04:00'),(68,'common_color_four','#06042E','2025-08-07 21:04:00','2025-08-07 21:04:00'),(69,'common_color_five','#4a44d1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(70,'show_all_homepage','0','2025-08-07 21:04:00','2025-08-07 21:04:00'),(71,'google_analytic_status','inactive','2025-08-07 21:04:00','2025-08-07 21:04:00'),(72,'google_analytic_id','google_analytic_id','2025-08-07 21:04:00','2025-08-07 21:04:00'),(73,'preloader_status','1','2025-08-07 21:04:00','2025-08-08 08:56:02'),(74,'maintenance_image','','2025-08-07 21:04:00','2025-08-07 21:04:00'),(75,'live_mail_send','5','2025-08-07 21:04:00','2025-08-08 08:56:02'),(76,'wasabi_access_id','wasabi_access_id','2025-08-07 21:04:00','2025-08-07 21:04:00'),(77,'wasabi_secret_key','wasabi_secret_key','2025-08-07 21:04:00','2025-08-07 21:04:00'),(78,'wasabi_region','us-east-1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(79,'wasabi_bucket','wasabi_bucket','2025-08-07 21:04:00','2025-08-07 21:04:00'),(80,'wasabi_status','inactive','2025-08-07 21:04:00','2025-08-07 21:04:00'),(81,'aws_access_id','aws_access_id','2025-08-07 21:04:00','2025-08-07 21:04:00'),(82,'aws_secret_key','aws_secret_key','2025-08-07 21:04:00','2025-08-07 21:04:00'),(83,'aws_region','us-east-1','2025-08-07 21:04:00','2025-08-07 21:04:00'),(84,'aws_bucket','aws_bucket','2025-08-07 21:04:00','2025-08-07 21:04:00'),(85,'aws_status','inactive','2025-08-07 21:04:00','2025-08-07 21:04:00'),(86,'header_topbar_status','active','2025-08-07 21:04:00','2025-08-08 08:56:02'),(87,'cursor_dot_status','inactive','2025-08-07 21:04:00','2025-08-08 08:56:02'),(88,'header_social_status','active','2025-08-07 21:04:00','2025-08-08 08:56:02'),(89,'watermark_img','uploads/website-images/watermark.svg','2025-08-07 21:04:00','2025-08-07 21:04:00'),(90,'position','top_right','2025-08-07 21:04:00','2025-08-07 21:04:00'),(91,'opacity','0.7','2025-08-07 21:04:00','2025-08-07 21:04:00'),(92,'max_width','300','2025-08-07 21:04:00','2025-08-07 21:04:00'),(93,'watermark_status','active','2025-08-07 21:04:00','2025-08-07 21:04:00');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_links`
--

DROP TABLE IF EXISTS `social_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_links`
--

LOCK TABLES `social_links` WRITE;
/*!40000 ALTER TABLE `social_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socialite_credentials`
--

DROP TABLE IF EXISTS `socialite_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socialite_credentials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `provider_id` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socialite_credentials`
--

LOCK TABLES `socialite_credentials` WRITE;
/*!40000 ALTER TABLE `socialite_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `socialite_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_id` bigint unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `states_country_id_foreign` (`country_id`),
  CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial_translations`
--

DROP TABLE IF EXISTS `testimonial_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonial_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint unsigned NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonial_translations_lang_code_index` (`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial_translations`
--

LOCK TABLES `testimonial_translations` WRITE;
/*!40000 ALTER TABLE `testimonial_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonial_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quote` text,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `photo_url` varchar(500) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `testimonials_is_featured_index` (`is_featured`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,NULL,'0',1,'2025-08-08 09:01:43','2025-08-08 09:01:43','SkillGro has transformed how our team approaches learning. The skill assessments helped us identify knowledge gaps and create targeted learning paths.','Sarah Johnson','Engineering Manager','TechCorp','https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',1),(2,NULL,'0',1,'2025-08-08 09:01:43','2025-08-08 09:01:43','The personalized learning experience is incredible. I went from beginner to advanced in React within 6 months.','Michael Chen','Frontend Developer','StartupXYZ','https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',1),(3,NULL,'0',1,'2025-08-08 09:01:43','2025-08-08 09:01:43','SkillGro\'s certification program gave me the confidence to transition into a senior developer role. Highly recommended!','Emily Rodriguez','Senior Developer','InnovateLab','https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',1);
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_assessments`
--

DROP TABLE IF EXISTS `user_assessments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_assessments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `assessment_id` bigint unsigned NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `skill_iq` varchar(50) DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_assessments_user_id_index` (`user_id`),
  KEY `user_assessments_assessment_id_index` (`assessment_id`),
  KEY `user_assessments_completed_at_index` (`completed_at`),
  CONSTRAINT `user_assessments_assessment_id_foreign` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_assessments`
--

LOCK TABLES `user_assessments` WRITE;
/*!40000 ALTER TABLE `user_assessments` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_assessments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_education`
--

DROP TABLE IF EXISTS `user_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_education` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `current` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_education`
--

LOCK TABLES `user_education` WRITE;
/*!40000 ALTER TABLE `user_education` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_experiences`
--

DROP TABLE IF EXISTS `user_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `current` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_experiences`
--

LOCK TABLES `user_experiences` WRITE;
/*!40000 ALTER TABLE `user_experiences` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_skill_topics`
--

DROP TABLE IF EXISTS `user_skill_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_skill_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_skill_topics`
--

LOCK TABLES `user_skill_topics` WRITE;
/*!40000 ALTER TABLE `user_skill_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_skill_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('instructor','student') NOT NULL DEFAULT 'student',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `is_banned` varchar(255) NOT NULL DEFAULT 'no',
  `verification_token` varchar(255) DEFAULT NULL,
  `forget_password_token` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '/uploads/website-images/frontend-avatar.png',
  `cover` varchar(255) NOT NULL DEFAULT '/uploads/website-images/frontend-cover.png',
  `wallet_balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `bio` text,
  `short_bio` text,
  `job_title` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `age` int DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1000,'DAGNACHEW MELKNEW TSEGAW','admin@test.com','student','2025-08-08 06:52:28','$2y$12$GDJ1T/PuaXnOXT.jghV3jeJyu9ZHRBoA7gEieG/b6FIpkdsTexP3a',NULL,'2025-08-08 04:07:03','2025-08-08 06:58:23','active','no','fQqnAzKC11jsDutwpENvLcDTeKAEvfTJ5vrPEGxVeaASxOoP1Nojz3ILqBx6Tdd6YYMD95Ob2d2a9O5kDgczI3KvISlaBvPUjTtg',NULL,'07887874915',NULL,'/uploads/website-images/frontend-avatar.png','/uploads/website-images/frontend-cover.png',0.00,NULL,NULL,NULL,'male',12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1001,'DAGNACHEW MELKNEW TSEGAW','d.melknew@elixone.com','student','2025-08-08 10:42:32','$2y$12$Y.JwMqmkxhM8nH0HMR0r8.H5puVD8zV1Q7BiT.h8ODx36RX8ObR.W',NULL,'2025-08-08 04:07:21','2025-08-08 10:42:32','active','no','5bb1aXBBWThRGzTtfhriKhbHbuUuc5lg2CS3H9Ynzk8a1avXbO4VPOn6nrKTqTXQpicshmL77WldFAxroOxzyUpQHHauW9nU4Lp4',NULL,NULL,NULL,'/uploads/website-images/frontend-avatar.png','/uploads/website-images/frontend-cover.png',0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1002,'melaku','admins@gmail.com','instructor','2025-08-08 10:09:12','$2y$12$4HkrPx6cgsOcZ3o9GViGwO/PDOGv2AUy9Scb3QUt9zDot.Y2waa1e',NULL,'2025-08-08 10:09:12','2025-08-22 06:46:52','active','no',NULL,NULL,'07887874915',NULL,'/uploads/website-images/frontend-avatar.png','uploads/custom-images/wsus-img-2025-08-21-11-45-37-6423.jpeg',0.00,NULL,NULL,NULL,'male',21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(1003,'DAGNACHEW MELKNEW TSEGAW','mdagnachew10@gmail.com','instructor','2025-08-09 00:00:59','$2y$12$E3RzGmN/FOjOvSxUKkStZem8XGV.rj0sIVw0x0YeDYhKrqM7cHRSa',NULL,'2025-08-09 00:00:59','2025-08-09 00:00:59','active','no',NULL,NULL,NULL,NULL,'/uploads/website-images/frontend-avatar.png','/uploads/website-images/frontend-cover.png',0.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_methods`
--

DROP TABLE IF EXISTS `withdraw_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_methods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maximum_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `withdraw_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_methods`
--

LOCK TABLES `withdraw_methods` WRITE;
/*!40000 ALTER TABLE `withdraw_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraw_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_requests`
--

DROP TABLE IF EXISTS `withdraw_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `withdraw_method_id` bigint unsigned NOT NULL,
  `withdraw_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `withdraw_charge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `account_info` json DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `approved_date` timestamp NULL DEFAULT NULL,
  `admin_feedback` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `withdraw_requests_user_id_foreign` (`user_id`),
  KEY `withdraw_requests_withdraw_method_id_foreign` (`withdraw_method_id`),
  CONSTRAINT `withdraw_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `withdraw_requests_withdraw_method_id_foreign` FOREIGN KEY (`withdraw_method_id`) REFERENCES `withdraw_methods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_requests`
--

LOCK TABLES `withdraw_requests` WRITE;
/*!40000 ALTER TABLE `withdraw_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdraw_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_credentials`
--

DROP TABLE IF EXISTS `zoom_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_credentials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instructor_id` bigint unsigned NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zoom_credentials_instructor_id_foreign` (`instructor_id`),
  CONSTRAINT `zoom_credentials_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_credentials`
--

LOCK TABLES `zoom_credentials` WRITE;
/*!40000 ALTER TABLE `zoom_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `zoom_credentials` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-25  0:10:36
