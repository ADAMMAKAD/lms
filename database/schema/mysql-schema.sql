/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned DEFAULT NULL,
  `sender_type` enum('user','admin','guest') NOT NULL DEFAULT 'user',
  `message` text NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `attachment_name` varchar(255) DEFAULT NULL,
  `attachment_type` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_messages_chat_id_created_at_index` (`chat_id`,`created_at`),
  KEY `chat_messages_sender_type_sender_id_index` (`sender_type`,`sender_id`),
  KEY `chat_messages_is_read_sender_type_index` (`is_read`,`sender_type`),
  KEY `chat_messages_created_at_index` (`created_at`),
  CONSTRAINT `chat_messages_chat_id_foreign` FOREIGN KEY (`chat_id`) REFERENCES `chats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `admin_id` bigint unsigned DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `status` enum('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high','urgent') NOT NULL DEFAULT 'medium',
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `last_message_at` timestamp NULL DEFAULT NULL,
  `is_resolved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chats_status_created_at_index` (`status`,`created_at`),
  KEY `chats_admin_id_status_index` (`admin_id`,`status`),
  KEY `chats_user_id_status_index` (`user_id`,`status`),
  KEY `chats_last_message_at_index` (`last_message_at`),
  CONSTRAINT `chats_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  CONSTRAINT `chats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2023_11_05_045432_create_admins_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2023_11_05_114814_create_languages_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2023_11_06_043247_create_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2023_11_06_054251_create_seo_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2023_11_06_094842_create_custom_paginations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2023_11_06_115856_create_email_templates_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2023_11_07_051924_create_multi_currencies_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2023_11_07_104315_create_blog_categories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2023_11_07_104328_create_blog_category_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2023_11_07_104336_create_blogs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2023_11_07_104343_create_blog_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (16,'2023_11_07_104546_create_blog_comments_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (17,'2023_11_09_100621_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (18,'2023_11_16_035458_add_user_info_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (19,'2023_11_16_061508_add_forget_info_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (20,'2023_11_16_063639_add_phone_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (21,'2023_11_19_055229_add_image_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (22,'2023_11_19_064341_create_banned_histories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (23,'2023_11_21_043030_create_news_letters_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (24,'2023_11_21_094702_create_contact_messages_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (25,'2023_11_22_105539_create_permission_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (26,'2023_11_29_095126_create_coupons_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (27,'2023_11_29_104658_create_testimonials_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (28,'2023_11_29_104704_create_testimonial_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (29,'2023_11_29_105234_create_coupon_histories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (30,'2023_11_29_113632_add_min_price_to_coupon',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (31,'2023_11_30_044838_create_faqs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (32,'2023_11_30_044844_create_faq_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (33,'2023_11_30_095404_add_wallet_balance_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (34,'2024_01_01_054644_create_socialite_credentials_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (35,'2024_01_03_092007_create_custom_codes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (36,'2024_02_10_060044_create_configurations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (37,'2024_02_28_064128_add_forgot_info_to_admins',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (38,'2024_03_28_095207_create_menus_wp_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (39,'2024_03_28_095208_create_menu_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (40,'2024_03_28_095209_create_menu_items_wp_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (41,'2024_03_28_095210_create_menu_item_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (42,'2024_03_28_095211_add-role-id-to-menu-items-table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (43,'2024_04_03_042331_add_new_columns_to_users',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (44,'2024_04_03_044043_create_user_education_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (45,'2024_04_03_044103_create_user_experiences_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (46,'2024_04_03_044134_create_user_skill_topics_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (47,'2024_04_05_060046_create_countries_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (48,'2024_04_05_060133_create_states_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (49,'2024_04_05_060149_create_cities_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (50,'2024_04_08_041719_create_instructor_requests_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (51,'2024_04_08_042513_create_instructor_request_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (52,'2024_04_15_103628_create_course_categories_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (53,'2024_04_15_112656_create_course_category_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (54,'2024_04_18_031942_create_course_languages_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (55,'2024_04_18_044110_create_course_levels_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (56,'2024_04_18_044125_create_course_level_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (57,'2024_04_18_070749_create_courses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (58,'2024_04_21_093245_create_course_partner_instructors_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (59,'2024_04_21_094654_create_course_selected_levels_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (60,'2024_04_21_094841_create_course_selected_languages_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (61,'2024_04_21_095342_create_course_selected_filter_options_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (62,'2024_04_22_114039_create_course_chapters_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (63,'2024_04_23_090340_create_course_chapter_items_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (64,'2024_04_23_090700_create_course_chapter_lessons_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (65,'2024_04_24_093046_create_quizzes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (66,'2024_04_24_114441_create_quiz_questions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (67,'2024_04_28_034905_create_quiz_question_answers_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (68,'2024_05_12_035535_create_course_progress_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (69,'2024_05_13_041532_create_quiz_results_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (70,'2024_05_13_101033_create_lesson_questions_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (71,'2024_05_13_101258_create_lesson_replies_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (72,'2024_05_14_095807_create_announcements_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (73,'2024_05_14_114640_create_course_reviews_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (74,'2024_05_16_034644_create_certificate_builders_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (75,'2024_05_16_041919_create_certificate_builder_items_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (76,'2024_05_16_110701_create_badges_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (77,'2024_05_20_052819_create_brands_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (78,'2024_05_20_094331_create_featured_course_sections_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (79,'2024_05_21_060612_create_featured_instructors_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (80,'2024_05_21_060634_create_featured_instructor_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (81,'2024_05_26_032547_create_section_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (82,'2024_05_26_052359_create_footer_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (83,'2024_05_26_065953_create_social_links_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (84,'2024_05_26_164008_create_contact_sections_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (85,'2024_05_27_045919_create_custom_pages_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (86,'2024_05_27_050016_create_custom_page_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (87,'2024_06_02_045115_add_softdelete_to_courses_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (88,'2024_06_02_080423_create_course_delete_requests_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (89,'2024_09_01_042119_create_zoom_credentials_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (90,'2024_09_01_042120_create_course_live_classes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (91,'2024_09_04_122554_create_jitsi_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (92,'2024_09_10_103347_create_marketing_settings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (93,'2024_09_29_090219_create_instructor_request_setting_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (94,'2024_10_08_060425_create_homes_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (95,'2024_10_08_060618_create_sections_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (96,'2024_10_08_060636_create_section_translations_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (97,'2024_12_09_064934_favorite_course_user',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (98,'2024_12_10_051251_create_custom_addons_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (99,'2025_01_13_082341_create_carts_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (100,'2025_08_07_201919_create_orders_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (101,'2025_08_07_201925_create_order_items_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (102,'2025_08_07_201931_create_enrollments_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (103,'2025_08_08_015811_create_assessments_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (104,'2025_08_08_015838_create_user_assessments_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (105,'2025_08_08_020019_add_homepage_fields_to_testimonials_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (106,'2024_01_01_000001_create_withdraw_methods_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (107,'2024_01_01_000002_create_withdraw_requests_table',5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (108,'2024_12_19_000000_set_default_section_settings',6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (111,'2024_01_20_000001_create_chats_table',7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (112,'2024_01_20_000002_create_chat_messages_table',7);
