# Host: localhost  (Version: 5.5.53)
# Date: 2018-04-29 16:27:38
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "lottery_bank_list"
#

DROP TABLE IF EXISTS `lottery_bank_list`;
CREATE TABLE `lottery_bank_list` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL DEFAULT '',
  `sort` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `isDelete` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='银行列表';

#
# Data for table "lottery_bank_list"
#

INSERT INTO `lottery_bank_list` VALUES (1,'支付宝',22,1),(2,'财付通',0,0),(3,'广东发展银行',0,1),(4,'华夏银行',0,1),(5,'交通银行',0,1),(6,'平安银行',0,1),(7,'上海浦东发展银行',0,1),(8,'兴业银行',0,1),(9,'中国邮政储蓄银行',0,1),(10,'中国光大银行',0,1),(11,'中国工商银行',0,1),(12,'中国建设银行',0,1),(13,'中国民生银行',0,1),(14,'中国农业银行',0,1),(15,'中国银行',0,1),(16,'招商银行',0,1),(17,'中信银行',0,1),(18,'微信支付',0,1),(21,'在线支付',0,0),(22,'银联扫码',0,0),(23,'北京银行',0,1),(24,'上海银行',0,1),(25,'广州银行',0,1),(26,'快捷支付',0,0);
