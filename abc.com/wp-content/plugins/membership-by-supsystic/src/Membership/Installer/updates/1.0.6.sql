ALTER TABLE `%prefix%activity` ADD status varchar(45) NOT NULL DEFAULT 'active' AFTER foreign_id;

CREATE TABLE IF NOT EXISTS `%prefix%users_statuses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `%prefix%users_statuses_user_id_index` (`user_id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

INSERT INTO `%prefix%users_statuses` (user_id, user_status) SELECT ID, user_status FROM %wp_base_prefix%users wu WHERE wu.id NOT IN(SELECT user_id FROM `%prefix%users_statuses`);