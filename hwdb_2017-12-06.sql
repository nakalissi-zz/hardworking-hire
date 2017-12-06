# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.33)
# Database: hwdb
# Generation Time: 2017-12-06 03:18:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table allocations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `allocations`;

CREATE TABLE `allocations` (
  `alloc_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `builder_id` int(11) DEFAULT NULL,
  `labour_id` int(11) DEFAULT NULL,
  `alloc_init` datetime DEFAULT NULL,
  `alloc_end` datetime DEFAULT NULL,
  `alloc_address` varchar(255) DEFAULT NULL,
  `alloc_status` varchar(50) DEFAULT NULL,
  `alloc_responsible` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`alloc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `allocations` WRITE;
/*!40000 ALTER TABLE `allocations` DISABLE KEYS */;

INSERT INTO `allocations` (`alloc_id`, `job_id`, `builder_id`, `labour_id`, `alloc_init`, `alloc_end`, `alloc_address`, `alloc_status`, `alloc_responsible`, `created_at`, `updated_at`, `ip_address`)
VALUES
	(1,2,1,1,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(2,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(3,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','canceled',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(4,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(5,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','pending',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(6,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(7,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(8,2,1,5,'2017-09-26 00:00:00','2017-09-28 00:00:00','257 Harbord Road, North Curl Curl, New South Wales, Australia','allocated',NULL,'0000-00-00 00:00:00',NULL,NULL),
	(41,NULL,NULL,1,NULL,NULL,NULL,'new',NULL,'2017-12-02 19:30:34','2017-12-02 19:30:34','::1');

/*!40000 ALTER TABLE `allocations` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
