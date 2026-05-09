-- database.sql
-- Run this script in phpMyAdmin or MySQL shell to create the seminary database and admissions table.

CREATE DATABASE IF NOT EXISTS `uruseminary` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `uruseminary`;

CREATE TABLE IF NOT EXISTS `admissions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `gender` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `address` TEXT NOT NULL,
  `previous_school` VARCHAR(255) NOT NULL,
  `subjects` TEXT NOT NULL,
  `level_applying` VARCHAR(100) NOT NULL,
  `declaration` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
