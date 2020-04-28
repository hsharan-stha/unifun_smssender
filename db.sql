/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.22-0ubuntu0.16.04.1 : Database - db_messaging_app
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `campaigns` */

DROP TABLE IF EXISTS `campaigns`;

CREATE TABLE `campaigns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `campaigns` */

insert  into `campaigns`(`id`,`campaign_name`,`sms_text`,`schedule_date`,`status`,`is_delete`,`response`,`created_at`,`updated_at`) values (1,'Test Campaign 1','Test SmS 1','2018-08-29 00:00:00',1,1,'','2018-08-09 03:45:00',NULL),(2,'Test Campaign 2','Test SmS 2','2018-08-27 00:00:00',1,0,'0: Accepted for delivery','2018-08-09 03:47:00',NULL);

/*Table structure for table `delivery` */

DROP TABLE IF EXISTS `delivery`;

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `response` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `delivery` */

insert  into `delivery`(`id`,`campaign_id`,`phone`,`delivery_date`,`response`) values (4,2,'22370000000','2018-08-09 09:42:18','1'),(5,2,'22370000001','2018-08-09 09:42:19','1'),(6,2,'22370000002','2018-08-09 09:42:19','1'),(7,2,'22370000003','2018-08-09 09:42:19','1'),(8,2,'22370000004','2018-08-09 09:42:19','1'),(9,2,'22370000005','2018-08-09 09:42:19','1'),(10,2,'22370000006','2018-08-09 09:42:19','1'),(11,2,'22370000007','2018-08-09 09:42:19','1'),(12,2,'22370000008','2018-08-09 09:42:19','1'),(13,2,'22370000009','2018-08-09 09:42:19','1'),(14,2,'22370000010','2018-08-09 09:42:20','1'),(15,2,'22370000011','2018-08-09 09:42:20','1'),(16,2,'22370000012','2018-08-09 09:42:20','1'),(17,2,'22370000013','2018-08-09 09:42:20','1'),(18,2,'22370000014','2018-08-09 09:42:20','1'),(19,2,'22370000015','2018-08-09 09:42:20','1'),(20,2,'22370000016','2018-08-09 09:42:20','1'),(21,2,'22370000017','2018-08-09 09:42:20','1'),(22,2,'22370000018','2018-08-09 09:42:20','1'),(23,2,'22370000019','2018-08-09 09:42:20','1');

/*Table structure for table `numbers` */

DROP TABLE IF EXISTS `numbers`;

CREATE TABLE `numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campaign_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `numbers` */

insert  into `numbers`(`id`,`number`,`campaign_id`) values (1,'22370000000',1),(2,'22370000001',1),(3,'22370000002',1),(4,'22370000003',1),(5,'22370000004',1),(6,'22370000005',1),(7,'22370000006',1),(8,'22370000007',1),(9,'22370000008',1),(10,'22370000009',1),(11,'22370000010',1),(12,'22370000011',1),(13,'22370000012',1),(14,'22370000013',1),(15,'22370000014',1),(16,'22370000015',1),(17,'22370000016',1),(18,'22370000017',1),(19,'22370000018',1),(20,'22370000019',1),(21,'22370000000',2),(22,'22370000001',2),(23,'22370000002',2),(24,'22370000003',2),(25,'22370000004',2),(26,'22370000005',2),(27,'22370000006',2),(28,'22370000007',2),(29,'22370000008',2),(30,'22370000009',2),(31,'22370000010',2),(32,'22370000011',2),(33,'22370000012',2),(34,'22370000013',2),(35,'22370000014',2),(36,'22370000015',2),(37,'22370000016',2),(38,'22370000017',2),(39,'22370000018',2),(40,'22370000019',2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`) values (1,'Destroyer','k.nakarmi@unifun.com','21232f297a57a5a743894a0e4a801fc3'),(2,'Sushil Shrestha','s.shrestha@unifun.com','21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
