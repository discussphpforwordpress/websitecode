CREATE TABLE IF NOT EXISTS `%prefix%reports` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content_type` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `reporter_id` bigint(20) unsigned NOT NULL,
  `reported_id` bigint(20) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'new',
  `date` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX (`reported_id` ASC),
  INDEX (`reporter_id` ASC)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;