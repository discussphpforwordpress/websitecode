CREATE TABLE IF NOT EXISTS `%prefix%groups_category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(204) NOT NULL,
  `date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

ALTER TABLE `%prefix%groups`
ADD COLUMN `category_id` INT;
