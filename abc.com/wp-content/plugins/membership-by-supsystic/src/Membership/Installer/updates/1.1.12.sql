CREATE TABLE IF NOT EXISTS `%prefix%slider` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `slider_preset_id` BIGINT(20) NOT NULL,
  `post_id` BIGINT(20),
  `user_id` BIGINT(20) unsigned NOT NULL,
  `position` INT(11) DEFAULT 0,
  `date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `%prefix%slider_ind1` (`post_id`, `user_id`),
  PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `%prefix%slider_images` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `slider_id` BIGINT(20) NOT NULL,
  `height` INT(11),
  `width` INT(11),
  `url` VARCHAR(1000),
  `position` INT(11) DEFAULT 0,
  `date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `%prefix%slider_images_ind1` (`slider_id`),
  PRIMARY KEY (`id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;