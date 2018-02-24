CREATE TABLE IF NOT EXISTS `%prefix%attachments_all` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `source` TEXT NOT NULL,
  `type` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_saved` TINYINT(1) NOT NULL DEFAULT 0,
  KEY `ik_userId_createdAt` (`created_at`,`user_id`),
  PRIMARY KEY(`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%attachment_type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(128) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%messages_attachments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `message_id` BIGINT UNSIGNED NOT NULL,
  `attachment_all_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY(`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%activity_attachments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_id` BIGINT UNSIGNED NOT NULL,
  `attachment_all_id` BIGINT UNSIGNED NOT NULL,
  KEY `ik_activity_id` (`activity_id`),
  PRIMARY KEY(`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

ALTER TABLE `%prefix%groups_users`
  ADD COLUMN `is_creator` TINYINT(1) NOT NULL DEFAULT 0;
