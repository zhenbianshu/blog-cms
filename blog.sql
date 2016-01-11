
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(64) NOT NULL,
  `author` char(32) NOT NULL,
  `address` varchar(64) DEFAULT NULL,
  `pubtime` int(10) unsigned NOT NULL,
  `description` char(64) NOT NULL DEFAULT '好文，力荐！',
  `abstract` varchar(512) NOT NULL,
  `pic` char(96) DEFAULT NULL,
  `content` text NOT NULL,
  `readnum` int(10) unsigned NOT NULL DEFAULT '0',
  `class` tinyint(3) unsigned NOT NULL,
  `top` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `r_class` (`class`),
  CONSTRAINT `r_class` FOREIGN KEY (`class`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `article2tag`;
CREATE TABLE `article2tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `r_article` (`article_id`),
  KEY `r_tag` (`tag_id`),
  CONSTRAINT `r_tag` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `r_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pubtime` int(10) unsigned NOT NULL,
  `ip` char(16) NOT NULL,
  `author` char(32) NOT NULL,
  `avater` char(96) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `article_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `r_comment` (`article_id`),
  CONSTRAINT `r_comment` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `route` char(16) NOT NULL,
  `pmenu` tinyint(3) unsigned NOT NULL,
  `level` enum('1','2') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO `menu` VALUES ('1', '编程语言', '', '0', '1');
INSERT INTO `menu` VALUES ('2', 'PHP', 'php', '1', '2');
INSERT INTO `menu` VALUES ('3', 'NODE', 'node', '1', '2');
INSERT INTO `menu` VALUES ('4', '数据库相关', '', '0', '1');
INSERT INTO `menu` VALUES ('5', 'MySQL', 'mysql', '4', '2');
INSERT INTO `menu` VALUES ('6', 'NoSQL', 'nosql', '4', '2');
INSERT INTO `menu` VALUES ('7', '前端设计', '', '0', '1');
INSERT INTO `menu` VALUES ('8', 'JS', 'js', '7', '2');
INSERT INTO `menu` VALUES ('9', 'CSS', 'css', '7', '2');
INSERT INTO `menu` VALUES ('10', 'HTML', 'html', '7', '2');
INSERT INTO `menu` VALUES ('11', '编程基础', '', '0', '1');
INSERT INTO `menu` VALUES ('12', 'Linux', 'linux', '11', '2');
INSERT INTO `menu` VALUES ('13', '算法', 'algorithms', '11', '2');
INSERT INTO `menu` VALUES ('14', '其他文章', 'life', '0', '1');
INSERT INTO `menu` VALUES ('15', '最新讯息', 'news', '14', '2');
INSERT INTO `menu` VALUES ('16', '美文鉴赏', 'elegant', '14', '2');
INSERT INTO `menu` VALUES ('17', '闲言碎语', 'think', '14', '2');
INSERT INTO `menu` VALUES ('18', '资源分享', 'source', '14', '2');

DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pubtime` int(10) unsigned NOT NULL,
  `ip` char(16) NOT NULL,
  `author` char(32) NOT NULL,
  `avater` char(32) NOT NULL,
  `content` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `msg` VALUES ('1', '1451726614', '127.0.0.1', '枕边书', '/img/avater/default.jpg', '先坐了沙发。');

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opt` char(32) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `setting` VALUES ('1', 'site_name', '枕边书');
INSERT INTO `setting` VALUES ('2', 'nick_name', '枕边书');
INSERT INTO `setting` VALUES ('3', 'desc', '常怀敬畏之心。');
INSERT INTO `setting` VALUES ('4', 'address', 'zhenbianshu@foxmail.com');

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `zbs_admin`;
CREATE TABLE `zbs_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(32) NOT NULL,
  `passwd` char(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `zbs_admin` VALUES ('1', '枕边书', '88410ab5bc3a1de89af4d8530f18e47e');
INSERT INTO `zbs_admin` VALUES ('2', '宣室夜', '770f8e448d07586afbf77bb59f698587');
