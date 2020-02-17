/*
SQLyog Community v13.1.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - analysis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`analysis` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `analysis`;

/*Table structure for table `an_export` */

DROP TABLE IF EXISTS `an_export`;

CREATE TABLE `an_export` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Project Name',
  `s_date` datetime DEFAULT NULL COMMENT 'Date Submitted',
  `domains` longtext COMMENT 'Domains Submitted',
  `username` varchar(255) DEFAULT NULL COMMENT 'Username to login on Ahrefs',
  `password` varchar(255) DEFAULT NULL COMMENT 'Password to login on Ahrefs',
  `status` int(11) DEFAULT '0',
  `result_file` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Export Data Project';

/*Table structure for table `result` */

DROP TABLE IF EXISTS `result`;

CREATE TABLE `result` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `category` text COLLATE utf8_bin,
  `url` text COLLATE utf8_bin,
  `mark` float DEFAULT NULL,
  `maintype` text COLLATE utf8_bin,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
