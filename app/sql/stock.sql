CREATE DATABASE IF NOT EXISTS stocks;

USE stocks;

CREATE TABLE `users` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_UN` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8_unicode_ci;

CREATE TABLE `stock_outlook` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `symbol_id` smallint unsigned NOT NULL,
 `json` json NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `symbol_id` (`symbol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25683 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci