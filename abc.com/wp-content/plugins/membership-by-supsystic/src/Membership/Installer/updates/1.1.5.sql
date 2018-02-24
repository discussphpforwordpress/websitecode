ALTER TABLE `%prefix%groups_followers`
ADD COLUMN `followed_at` TIMESTAMP NULL DEFAULT NULL AFTER `group_id`,
ADD INDEX `followed_at` (`followed_at` DESC);

ALTER TABLE `%prefix%followers`
ADD COLUMN `followed_at` TIMESTAMP NULL DEFAULT NULL AFTER `following_id`,
ADD INDEX `followed_at` (`followed_at` DESC);