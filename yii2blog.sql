# Host: 127.0.0.1  (Version: 5.5.5-10.0.18-MariaDB)
# Date: 2015-06-29 10:35:53
# Generator: MySQL-Front 5.3  (Build 4.156)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "y2bg_article"
#

DROP TABLE IF EXISTS `y2bg_article`;
CREATE TABLE `y2bg_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `uid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `alias` varbinary(255) NOT NULL DEFAULT '' COMMENT '别名',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` blob NOT NULL COMMENT '内容',
  `cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='文章表';

#
# Structure for table "y2bg_category"
#

DROP TABLE IF EXISTS `y2bg_category`;
CREATE TABLE `y2bg_category` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pid` smallint(6) NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `intro` varchar(255) DEFAULT NULL COMMENT '简介',
  `alias` varbinary(255) DEFAULT NULL COMMENT '路由别名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='分类表';

#
# Structure for table "y2bg_link"
#

DROP TABLE IF EXISTS `y2bg_link`;
CREATE TABLE `y2bg_link` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT '标题',
  `intro` varchar(255) DEFAULT NULL COMMENT '描述',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `method` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '打开方式',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='友情链接表';

#
# Structure for table "y2bg_user"
#

DROP TABLE IF EXISTS `y2bg_user`;
CREATE TABLE `y2bg_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '电子邮箱',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `logo` varchar(255) DEFAULT NULL COMMENT 'Logo',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='用户表';
