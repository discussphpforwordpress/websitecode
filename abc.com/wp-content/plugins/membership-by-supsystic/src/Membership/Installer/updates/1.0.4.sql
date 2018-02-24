CREATE TABLE IF NOT EXISTS `%prefix%groups_followers` (
	`id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` BIGINT(20) UNSIGNED NOT NULL,
	`group_id` BIGINT(20) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
 	INDEX (`user_id` ASC),
 	INDEX (`group_id` ASC),
	UNIQUE INDEX (`user_id` ASC, `group_id` ASC)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

INSERT INTO %prefix%followers (user_id, following_id)
	SELECT user_id, friend_id
	FROM %prefix%friends
ON DUPLICATE KEY UPDATE %prefix%followers.user_id = %prefix%friends.user_id;

INSERT INTO %prefix%groups_followers (user_id, group_id)
	SELECT group_id, user_id
	FROM %prefix%groups_users
ON DUPLICATE KEY UPDATE %prefix%groups_followers.user_id = %prefix%groups_users.user_id;

CREATE TABLE IF NOT EXISTS `%prefix%links` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` TEXT NOT NULL,
  `url_hash` VARCHAR(40) NOT NULL,
  `meta` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `links_url_hash_UNIQUE` (`url_hash` ASC)
 ) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%activity_links` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `activity_id` BIGINT(20) UNSIGNED NULL,
  `link_id` BIGINT(20) UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `%prefix%activity_links_activity_id_idx` (`activity_id` ASC),
  INDEX `%prefix%activity_links_link_id_idx` (`link_id` ASC),
  UNIQUE INDEX `activity_links_activity_id_link_id_UNIQUE` (`activity_id` ASC, `link_id` ASC),
  CONSTRAINT `%prefix%activity_links_activity_id` FOREIGN KEY (`activity_id`) REFERENCES `%prefix%activity` (`id`) ON DELETE CASCADE,
  CONSTRAINT `%prefix%activity_links_link_id` FOREIGN KEY (`link_id`) REFERENCES `%prefix%links` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%activity_tags` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag` VARCHAR(150) NULL,
  `activity_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `activity_tags_tag_activity_id` (`tag` ASC, `activity_id` ASC),
  CONSTRAINT `activity_tags_activity_id` FOREIGN KEY (`activity_id`) REFERENCES `%prefix%activity` (`id`) ON DELETE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

SET sql_mode = 'ALLOW_INVALID_DATES';

ALTER TABLE `%prefix%activity` ADD INDEX `created_at` (`created_at` ASC);

SET sql_mode = (SELECT @@GLOBAL.SQL_MODE);