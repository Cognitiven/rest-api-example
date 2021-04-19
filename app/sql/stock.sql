CREATE DATABASE IF NOT EXISTS stocks;

USE stocks;

CREATE TABLE `stock_outlook` (
 `id` int unsigned NOT NULL AUTO_INCREMENT,
 `symbol_id` smallint unsigned NOT NULL,
 `json` json NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `symbol_id` (`symbol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25683 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci