CREATE DATABASE /*!32312 IF NOT EXISTS*/`awwwards` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `awwwards`;

/*Table structure for table `an_export` */

DROP TABLE IF EXISTS `an_export`;

CREATE TABLE `an_export` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Project Name',
  `s_date` datetime DEFAULT NULL COMMENT 'Date Submitted',
  `domains` longtext COMMENT 'Domains Submitted',
  `username` varchar(255) DEFAULT NULL COMMENT 'Username to login on Awwwards',
  `password` varchar(255) DEFAULT NULL COMMENT 'Password to login on Awwwards',
  `status` int(11) DEFAULT '0',
  `result_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Export Data Project';

/*Table structure for table `an_result` */

DROP TABLE IF EXISTS `an_result`;

CREATE TABLE `an_result` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `category` text COLLATE utf8_bin,
  `url` text COLLATE utf8_bin,
  `mark` float DEFAULT NULL,
  `maintype` text COLLATE utf8_bin,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `an_result_mark` */

DROP TABLE IF EXISTS `an_result_mark`;

CREATE TABLE `an_result_mark` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `category` text COLLATE utf8_bin,
  `url` text COLLATE utf8_bin,
  `mark` float DEFAULT NULL,
  `maintype` text COLLATE utf8_bin,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
