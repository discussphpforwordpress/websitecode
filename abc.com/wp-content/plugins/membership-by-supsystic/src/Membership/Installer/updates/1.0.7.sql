CREATE TABLE IF NOT EXISTS `%prefix%conversations_users_blocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `blocked_user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `blocked_users` (`user_id`, `blocked_user_id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

DROP INDEX linked_role ON %prefix%roles;

ALTER TABLE %prefix%roles CHANGE linked_role type VARCHAR(255) NOT NULL DEFAULT 'custom';

CREATE TABLE IF NOT EXISTS `%prefix%users_roles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `%prefix%users_roles_user_id_index` (`user_id`),
  KEY `%prefix%users_roles_id_fk` (`role_id`),
  FOREIGN KEY (`role_id`) REFERENCES `%prefix%roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `%prefix%users_roles`
(user_id, role_id)
(
  SELECT
    um.user_id, r.id
  FROM %prefix%roles AS r
    JOIN %wp_base_prefix%usermeta AS um ON um.meta_key = '%wp_prefix%capabilities' AND um.meta_value REGEXP r.type
  WHERE type != '__guest__'
  AND um.user_id NOT IN (SELECT user_id FROM `%prefix%users_roles`)
);