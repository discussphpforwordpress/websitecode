CREATE TABLE IF NOT EXISTS `%prefix%settings` (
	`setting` VARCHAR(255) NOT NULL,
	`value` MEDIUMTEXT NOT NULL,
	UNIQUE KEY (`setting`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%fields` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`name` VARCHAR(100) NOT NULL,
	`privacy` VARCHAR(45) NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `user_id_name` (`user_id`, `name`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%fields_data` (
	`field_id` BIGINT(20) UNSIGNED NOT NULL,
	`data` TEXT NOT NULL,
	FOREIGN KEY (`field_id`) REFERENCES `%prefix%fields` (`id`) ON DELETE CASCADE
 ) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`description` VARCHAR(2000),
	`alias` varchar(255) NOT NULL,
	`is_blocked` TINYINT(1) NOT NULL DEFAULT 0,
	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`alias`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_users` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`group_role` VARCHAR(255) NOT NULL,
	`user_id` BIGINT(20) NOT NULL,
	`approved` TINYINT(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),	
	UNIQUE KEY (`group_id` ASC, `user_id` ASC),
	INDEX (`user_id` ASC),
	FOREIGN KEY (`group_id`) REFERENCES `%prefix%groups` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_blacklists` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`blocked_by` BIGINT(20) UNSIGNED NOT NULL,
	`reason` VARCHAR(45) NULL,
	`commentary` TEXT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX (`group_id` ASC, `user_id` ASC),
	FOREIGN KEY (`group_id`) REFERENCES `%prefix%groups` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_invites` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`invited_by` BIGINT(20) UNSIGNED NOT NULL,
  `invitation_type` VARCHAR(45) NOT NULL DEFAULT 'user',
	PRIMARY KEY (`id`),
	UNIQUE INDEX (`group_id` ASC, `user_id` ASC),
	FOREIGN KEY (`group_id`) REFERENCES `%prefix%groups` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_settings` (
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`setting` VARCHAR(45) NOT NULL,
	`value` VARCHAR(45) NOT NULL,
	UNIQUE INDEX (group_id, setting),
	UNIQUE KEY (`group_id` ASC, `setting` ASC),
	FOREIGN KEY (`group_id`) REFERENCES `%prefix%groups` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%roles` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL UNIQUE,
	`permissions` MEDIUMTEXT NOT NULL,
	`linked_role` VARCHAR(255) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%activity` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NOT NULL,
	`object_id` BIGINT(20) UNSIGNED NULL,
	`target_id` BIGINT(20) UNSIGNED NULL,
	`data` MEDIUMTEXT,
	`foreign_id` BIGINT(20) UNSIGNED,
	`created_at` TIMESTAMP NULL,
	`updated_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`),
	INDEX (`object_id` ASC, `type` ASC),
	INDEX (`user_id` ASC, `type` ASC),
	INDEX (`target_id` ASC, `type` ASC),
	FOREIGN KEY (`foreign_id`) REFERENCES `%prefix%activity` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%friends` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`friend_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX (`user_id` ASC),	
	INDEX (`friend_id` ASC),
	UNIQUE INDEX (`user_id` ASC, `friend_id` ASC)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%followers` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`following_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX (`user_id` ASC),
	INDEX (`following_id` ASC),
	UNIQUE INDEX (`user_id` ASC, `following_id` ASC)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%conversations` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`created_by` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX (`type` ASC)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%messages` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`message` MEDIUMTEXT NOT NULL,
	`author_id` BIGINT(20) UNSIGNED NOT NULL,
	`conversation_id` BIGINT(20) UNSIGNED NOT NULL,
	`created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`),
	INDEX (`conversation_id` ASC),
	FOREIGN KEY (`conversation_id`) REFERENCES `%prefix%conversations` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%conversations_users` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`conversation_id` BIGINT(20) UNSIGNED NOT NULL,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`conversation_state` VARCHAR(45) NULL,
	PRIMARY KEY (`id`),
	INDEX (`user_id` ASC),
	INDEX (`conversation_id` ASC, `user_id` ASC),
	FOREIGN KEY (`conversation_id`) REFERENCES `%prefix%conversations` (`id`) ON DELETE CASCADE
 ) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%messages_users` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`message_id` BIGINT(20) UNSIGNED NOT NULL,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`message_state` VARCHAR(45) NULL,
	PRIMARY KEY (`id`),
	INDEX (`message_id` ASC),
	INDEX (`user_id` ASC),
	FOREIGN KEY (`message_id`) REFERENCES `%prefix%messages` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%images` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`width` INT NULL,
	`height` INT NULL,
	`source` VARCHAR(255) NOT NULL,
	`created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%images_thumbnails` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`image_id` BIGINT(20) UNSIGNED NOT NULL,
	`source` VARCHAR(255) NOT NULL,
	`width` INT NULL,
	`height` INT NULL,
	`created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`image_id`) REFERENCES `%prefix%images` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%attachments` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`source` TEXT NOT NULL,
	`type` VARCHAR(40) NOT NULL,
	`created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%albums` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`title` VARCHAR(255) NULL,
	`description` TEXT NULL,
	`created_at` TIMESTAMP NULL,
	PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%albums_images` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`album_id` BIGINT(20) UNSIGNED NOT NULL,
	`image_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX (`album_id` ASC, `image_id` ASC),
	INDEX (`image_id` ASC),
	FOREIGN KEY (`album_id`) REFERENCES `%prefix%albums` (`id`) ON DELETE CASCADE,
	FOREIGN KEY (`image_id`) REFERENCES `%prefix%images` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_albums` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`album_id` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`album_id`) REFERENCES `%prefix%albums` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%users_albums` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`album_id` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`album_id`) REFERENCES `%prefix%albums` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%users_images` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`image_id` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NOT NULL,
	`crop` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX (`image_id` ASC),
	UNIQUE INDEX (`user_id` ASC, `type` ASC),
	FOREIGN KEY (`image_id`) REFERENCES `%prefix%images` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%groups_images` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	`image_id` BIGINT(20) UNSIGNED NOT NULL,
	`type` VARCHAR(45) NOT NULL,
	`crop` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX (`image_id` ASC),
	UNIQUE INDEX (`group_id` ASC, `type` ASC),
	FOREIGN KEY (`image_id`) REFERENCES `%prefix%images` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%activity_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` bigint(20) unsigned NOT NULL,
  `image_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `activity_id` (`activity_id`,`image_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `%prefix%activity_images_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `%prefix%activity` (`id`) ON DELETE CASCADE,
  CONSTRAINT `%prefix%activity_images_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `%prefix%images` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `%prefix%notifications` (
	`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` bigint(20) unsigned NOT NULL,
	`category` varchar(45) NOT NULL,
	`type` mediumint(9) NOT NULL DEFAULT '1',
	`viewed` tinyint(1) NOT NULL DEFAULT '0',
	`data` mediumtext,
	`created_at` timestamp NULL,
	`updated_at` timestamp NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `%prefix%notifications_id_uindex` (`id`),
	KEY `%prefix%notifications_ifbk_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `%prefix%tags` (
	`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	`tag` varchar(255) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `%prefix%tags_id_uindex` (`id`),
	UNIQUE KEY `%prefix%tags_tag_uindex` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `%prefix%groups_tags` (
	`group_id` bigint(20) unsigned NOT NULL,
	`tag_id` bigint(20) unsigned NOT NULL,
	KEY `%prefix%groups_tags_ifbk_1` (`group_id`),
	KEY `%prefix%groups_tags_ifbk_2` (`tag_id`),
	CONSTRAINT `%prefix%groups_tags_ifbk_2` FOREIGN KEY (`tag_id`) REFERENCES `%prefix%tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `%prefix%groups_tags_ifbk_1` FOREIGN KEY (`group_id`) REFERENCES `%prefix%groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `%prefix%roles`
	(name, permissions, linked_role)
	VALUES ('Membership Administrator', 'a:0:{}', 'administrator');

INSERT IGNORE INTO `%prefix%roles`
(name, permissions, linked_role)
VALUES ('Membership User', 'a:0:{}', 'subscriber');

INSERT IGNORE INTO `%prefix%roles`
(name, permissions, linked_role)
VALUES ('Membership Guest', 'a:0:{}', '__guest__');