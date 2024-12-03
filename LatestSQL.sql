-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for job_application_db
CREATE DATABASE IF NOT EXISTS `job_application_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `job_application_db`;

-- Dumping structure for table job_application_db.activity_logs
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job_application_db.activity_logs: ~5 rows (approximately)
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `created_at`) VALUES
	(12, 6, 'Insert', 'Inserted a new job application for Marcross Amaba (Email: skysales0321@gmail.com)', '2024-12-03 06:10:08'),
	(13, 6, 'Insert', 'Inserted a new job application for Sky Sales (Email: skysales0321@gmail.com)', '2024-12-03 06:10:31'),
	(14, 6, 'Update', 'Updated job application ID: 17. Changes: First Name: Sky to Marc, Last Name: Sales to Ross', '2024-12-03 06:11:00'),
	(15, 6, 'Delete', 'Deleted job application for Marc Ross (Email: skysales0321@gmail.com)', '2024-12-03 06:11:18'),
	(16, 6, 'Delete', 'Deleted job application for Marcross Amaba (Email: skysales0321@gmail.com)', '2024-12-03 06:11:26');

-- Dumping structure for table job_application_db.job_applications
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `year_of_exp` int(2) NOT NULL,
  `language` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job_application_db.job_applications: ~0 rows (approximately)

-- Dumping structure for table job_application_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job_application_db.users: ~2 rows (approximately)
INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`, `created_at`) VALUES
	(5, 'Marc', '$2y$10$ix3.ndFzclfGzmc87qALIe6dBw3hpKSBrq5KS//swOgfEAZKpEiJC', 'skysales0321@gmail.com', '0956145976', '2024-12-03 04:49:22'),
	(6, 'Lowks', '$2y$10$A1xdzblrCR8aPxs6gxvdWeGVzFYOOqL3XYksMK6heBZNFjHGguiTO', 'Lowks21@gmail.com', '09561459834', '2024-12-03 06:09:47');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
