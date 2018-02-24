ALTER TABLE `%prefix%notifications`
DROP COLUMN `data`,
DROP COLUMN `type`,
CHANGE COLUMN `category` `type` VARCHAR(45) NOT NULL ,
ADD COLUMN `target_id` BIGINT(20) UNSIGNED NULL AFTER `type`,
ADD COLUMN `object_id` BIGINT(20) UNSIGNED NULL AFTER `target_id`,
ADD INDEX  (`target_id` ASC),
ADD INDEX  (`object_id` ASC),
ADD INDEX (`viewed` ASC);