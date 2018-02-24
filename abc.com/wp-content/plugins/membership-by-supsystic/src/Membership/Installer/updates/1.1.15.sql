CREATE TABLE IF NOT EXISTS `%prefix%google_maps_easy` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maps_preset_id` INT(11) NOT NULL,
  `post_id` BIGINT(20) UNSIGNED,
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `position` INT(11) DEFAULT 0,
  `data` TEXT,
  `date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  -- KEY `%prefix%google_maps_easy_ind1` (`post_id`, `user_id`),
  PRIMARY KEY (`id`),
  FOREIGN KEY `fk_%prefix%_activity_id`(`post_id`)
    REFERENCES `%prefix%activity`(`id`)
      ON DELETE CASCADE
      ON UPDATE CASCADE
) COLLATE='utf8_general_ci' ENGINE=InnoDB;