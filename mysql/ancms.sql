-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ancms
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `ancms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ancms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ancms`;

--
-- Table structure for table `ExchangeWall`
--

DROP TABLE IF EXISTS `ExchangeWall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExchangeWall` (
  `REGISTERED` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) unsigned NOT NULL,
  `from_cryptocoin_id` bigint(20) unsigned NOT NULL,
  `to_cryptocoin_id` bigint(20) unsigned NOT NULL,
  `COUNT_FROM` float NOT NULL,
  `COUNT_TO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExchangeWall`
--

LOCK TABLES `ExchangeWall` WRITE;
/*!40000 ALTER TABLE `ExchangeWall` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExchangeWall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Item`
--

DROP TABLE IF EXISTS `Item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Item` (
  `Category` varchar(100) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `PriceDollars` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Item`
--

LOCK TABLES `Item` WRITE;
/*!40000 ALTER TABLE `Item` DISABLE KEYS */;
/*!40000 ALTER TABLE `Item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shop`
--

DROP TABLE IF EXISTS `Shop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shop` (
  `shopid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `REGISTERED` time DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Не проверенный',
  `balance` float DEFAULT NULL,
  `CRYPTOCOIN_PREFIX` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`shopid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shop`
--

LOCK TABLES `Shop` WRITE;
/*!40000 ALTER TABLE `Shop` DISABLE KEYS */;
/*!40000 ALTER TABLE `Shop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_user` bigint(20) DEFAULT -1,
  `second_user` bigint(20) DEFAULT -1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,29,30),(2,30,30),(3,29,29);
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cryptocoins`
--

DROP TABLE IF EXISTS `cryptocoins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cryptocoins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT 'GOSTCoin',
  `host` varchar(100) NOT NULL DEFAULT 'localhost',
  `port` int(11) NOT NULL DEFAULT 9376,
  `rpcuser` varchar(100) NOT NULL DEFAULT 'gostcoinrpc',
  `rpcpassword` varchar(100) NOT NULL DEFAULT '97WDPgQADfazR6pQRdMEjQeDeCSzTwVaMEZU1dGaTmLo',
  `user_prefix` varchar(100) NOT NULL DEFAULT 'ANCMS_',
  `equialentindollars` float DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cryptocoins`
--

LOCK TABLES `cryptocoins` WRITE;
/*!40000 ALTER TABLE `cryptocoins` DISABLE KEYS */;
INSERT INTO `cryptocoins` VALUES (1,'GOSTCoin','localhost',19376,'gostcoinrpc','97WDPgQADfazR6pQRdMEjQeDeCSzTwVaMEZU1dGaTmLo','ANCMS_',1),(2,'tDash','localhost',19998,'dash','123','ANCMS_',1);
/*!40000 ALTER TABLE `cryptocoins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gpg_reg_ses`
--

DROP TABLE IF EXISTS `gpg_reg_ses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gpg_reg_ses` (
  `fingeprint` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gpg_reg_ses`
--

LOCK TABLES `gpg_reg_ses` WRITE;
/*!40000 ALTER TABLE `gpg_reg_ses` DISABLE KEYS */;
INSERT INTO `gpg_reg_ses` VALUES ('fingeprint','id','2020-09-02 14:32:57','piska');
/*!40000 ALTER TABLE `gpg_reg_ses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_chat`
--

DROP TABLE IF EXISTS `messages_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` bigint(20) DEFAULT NULL,
  `author` bigint(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_chat`
--

LOCK TABLES `messages_chat` WRITE;
/*!40000 ALTER TABLE `messages_chat` DISABLE KEYS */;
INSERT INTO `messages_chat` VALUES (32,0,28,'hello blay','2020-09-06 16:17:44'),(33,0,28,'hello sooqa','2020-09-06 16:17:52'),(34,0,28,'&lt;b&gt;test blyat&lt;/b&gt;','2020-09-06 16:18:40'),(35,0,28,'123','2020-09-06 16:18:45'),(36,0,28,'13241324','2020-09-06 16:18:46'),(37,0,28,'1234','2020-09-06 16:18:48'),(38,0,28,'1234','2020-09-06 16:18:49'),(39,0,28,'1234','2020-09-06 16:18:50'),(40,0,28,'1234','2020-09-06 16:18:51'),(41,0,30,'пинг всем','2020-09-07 15:23:00'),(42,0,30,'пинг','2020-09-07 15:23:06'),(43,0,29,'пинг пинг','2020-09-07 15:23:18'),(44,0,29,'дарова','2020-09-07 15:23:27'),(45,0,30,'Дарова, да','2020-09-07 15:23:43'),(46,0,30,'privet','2020-09-07 15:30:10'),(47,0,29,'привет да','2020-09-07 15:30:26'),(48,0,29,'привет да','2020-09-07 15:30:26'),(49,0,29,'test','2020-09-07 15:32:01'),(50,5,0,'1324','2020-09-07 16:06:57'),(51,5,0,'1234','2020-09-07 16:07:01'),(52,5,0,'1234','2020-09-07 16:07:04'),(53,5,0,'1234','2020-09-07 16:07:05'),(54,5,0,'1234','2020-09-07 16:07:11'),(55,5,0,'1324','2020-09-07 16:07:15'),(56,5,0,'1324','2020-09-07 16:07:16'),(57,5,0,'1234','2020-09-07 16:07:37'),(58,5,0,'1234','2020-09-07 16:07:56'),(59,5,0,'1324','2020-09-07 16:08:12'),(60,5,29,'1234','2020-09-07 16:08:49'),(61,5,29,'312412343124','2020-09-07 16:08:52'),(62,5,29,'13241324','2020-09-07 16:08:54'),(63,5,29,'1234','2020-09-07 16:09:10'),(64,5,29,'1324','2020-09-07 16:09:11'),(65,5,29,'1234','2020-09-07 16:10:45'),(66,5,29,'1234','2020-09-07 16:10:59'),(67,5,29,'1234','2020-09-07 16:11:00'),(68,5,29,'1234','2020-09-07 16:11:15'),(69,5,29,'1234','2020-09-07 16:11:39'),(70,5,29,'1234','2020-09-07 16:12:30'),(71,5,29,'1234','2020-09-07 16:12:30'),(72,5,29,'1234','2020-09-07 16:13:16'),(73,5,29,'1234','2020-09-07 16:13:31'),(74,5,29,'о привет ебать','2020-09-07 16:13:37'),(75,5,29,'о привет ебать','2020-09-07 16:13:39'),(76,6,30,'hello','2020-09-07 16:14:10'),(77,0,30,'hello','2020-09-07 16:14:15'),(78,7,29,'hello blyat','2020-09-07 16:14:49'),(79,6,30,'о приватный чат пашет','2020-09-07 16:15:02'),(80,7,29,'hello blyat','2020-09-07 16:15:06'),(81,7,29,'hello blyat','2020-09-07 16:15:07'),(82,7,29,'hello blyat','2020-09-07 16:15:07'),(83,7,29,'hello blyat','2020-09-07 16:15:08'),(84,7,29,'hello blyat','2020-09-07 16:15:09'),(85,7,29,'ghbdtn','2020-09-07 16:15:13'),(86,7,29,'привет','2020-09-07 16:15:16'),(87,7,29,'привет','2020-09-07 16:15:19'),(88,8,30,'hello','2020-09-07 16:15:38'),(89,8,30,'1324','2020-09-07 16:15:43'),(91,2,30,'hello','2020-09-07 16:16:40'),(92,2,30,'hello','2020-09-07 16:16:45'),(97,2,30,'he','2020-09-07 16:16:53'),(98,2,30,'he','2020-09-07 16:16:57'),(100,2,29,'hello','2020-09-07 16:17:09'),(101,2,29,'hello','2020-09-07 16:17:12'),(104,2,29,'работает?','2020-09-07 16:17:45'),(107,2,29,'кажись','2020-09-07 16:18:05'),(109,2,29,'кажись','2020-09-07 16:18:13'),(110,2,29,'кажись','2020-09-07 16:18:14'),(111,2,29,'кажись','2020-09-07 16:18:15'),(113,2,30,'кажись','2020-09-07 16:19:49'),(114,2,30,'hello','2020-09-07 16:19:52'),(116,2,30,'hello','2020-09-07 16:19:59'),(117,2,30,'1234','2020-09-07 16:20:06'),(171,1,29,'123','2020-09-07 16:32:36'),(172,1,29,'hello','2020-09-07 16:32:46'),(173,1,30,'дарова ага','2020-09-07 16:32:51'),(174,1,30,'здарова','2020-09-07 16:32:55');
/*!40000 ALTER TABLE `messages_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sellers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shop_id` bigint(20) unsigned NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sellers_UN` (`shop_id`),
  CONSTRAINT `sellers_FK` FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`shopid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `name` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hash',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_shop` tinyint(1) NOT NULL DEFAULT 0,
  `REGISTERED` timestamp NOT NULL DEFAULT current_timestamp(),
  `browser-info` varchar(100) DEFAULT NULL,
  `secret` varchar(60) DEFAULT NULL,
  `about` varchar(120) DEFAULT 'new person',
  `mind` varchar(120) DEFAULT 'Hi, i am use ancms',
  `is_blocked` tinyint(1) DEFAULT 0,
  `carma` int(11) DEFAULT 0,
  `gpgkey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('Ghzg6cDhF7','ffd699d9eb96f304a0fba398dba3d456e5b14c7e407f2a5364772d70a03937310149bb716582da0a5a2608555c45bb0a5ff2d67bd31b692f10a04f80f1f1df8c',1,0,0,'2020-08-24 21:11:26',NULL,'812934b10da7c243c32d5e124f362fe3','new person','Hi, i am use ancms',NULL,NULL,NULL),('0iNX2mMQt3','fbe0f70774448eb3a95d0dbe4b87e1b107e72b0f5b437e198a3d3bc2b90ee81d1e588af0151fc3353b064d1c2485976055c95f4a7cb099c08b41e973b8a3e517',2,0,0,'2020-08-24 21:13:38',NULL,'7d9fad2c255fb31d550c621181f6ff19','new person','Hi, i am use ancms',NULL,NULL,NULL),('sg7q82kmzV','a5f7503823aa352c639e185f63ab87fde25df43c464219a51caf1cb254a41ace6c64703dad95d9cf048cb0f3372f895e9f263f682100b22bc2fed3428fda9d37',3,0,0,'2020-08-24 21:14:01',NULL,'52cba24251c8fcb31f6119bcde7f42e3','new person','Hi, i am use ancms',NULL,NULL,NULL),('ZFv3tPTEWE','406974000b4dcaf6d0b721e0fa93672843204ef0148cf193bbdd3c5874dac2e35ca20e45f978cb6f122823a000bd25e0e0540e0eef3099603a01b008dae70797',4,0,0,'2020-08-24 21:14:25',NULL,'d6f07e768dae635428e48e6db0f71c26','new person','Hi, i am use ancms',NULL,NULL,NULL),('f6aLjK91mp','523837b2556c6255dfab6d81323ed722eb00cd918676c41973a484755b1622012b0ad55334e51c60f3e4e5af5c51487ba1f000876a305014e160b1a8f89ead18',5,0,0,'2020-08-24 21:16:28',NULL,'3cb461373497a6e88cf7e9b34bce329c','new person','Hi, i am use ancms',NULL,NULL,NULL),('Rlj4XOKiCL','c7a587bb362e396fba8cbd1abe8c2089844005a3f937f60c83a19e647d4c491f56c931041e3bef19ed3425c5d39e18d220ef7cf4f823c1eac9e62c146b034446',6,0,0,'2020-08-24 21:16:57',NULL,'b2a115cdeb988ed5cac210b9b89c2d16','new person','Hi, i am use ancms',NULL,NULL,NULL),('fOS6SAQFoO','d8307735023090586cac81bf539e7f9ced4bb0a52d2b932f890dce010ae761616ab24f453cb7db014e31bff208e9a68dc13d1d38b2ec2ff7cb4c351a2a223357',7,0,0,'2020-08-24 21:17:16',NULL,'73b07ef205cc0749fe4c87187f9c6acc','new person','Hi, i am use ancms',NULL,NULL,NULL),('UW8b4IkNcx','0961aee99821868c053ef42b448d595339fa00a9c3d74bc057259b1f36b83fcd22e448558036c86417f5bb0346e852b277c2a2f4c770e5b0e48f31eff78941e1',8,0,0,'2020-08-24 21:17:28',NULL,'238990b707f20679eb8652db4702ed17','new person','Hi, i am use ancms',NULL,NULL,NULL),('ptvbvECqP1','d9af7c3a70e3d9f3120449dafc19ddfb2a6f640585530a7d8e7fb9422a654f443491723429688227d53aa64a06bc35cd619d18132581f4ebe28faef6cdb1eaff',9,0,0,'2020-08-27 04:49:47',NULL,'5d6c386e2c9fe247ecd1b4f644672231','new person','Hi, i am use ancms',NULL,NULL,NULL),('RNayKytti4','7068df9923fe63c601df70abddf6f3f3520d5de9e0f2c8571d20042e0a41a5a04e2b1ecc5a95b1d0a6fef21ab236bc8dd4ea0453a472b00f9020969a3464cfa6',10,0,0,'2020-08-27 08:16:53',NULL,'c36c06b1a46f58f454e79a38d60c218c','new person','Hi, i am use ancms',NULL,NULL,NULL),('nnAZ6FrEVi','89b96c71a140ccabf3e94423ae31be252ea6a16394bda8bc9688b746830fff38c3887064d45f8855a1e2fc80f6a8ad849c467136bf03077a012659fba55675ce',11,0,0,'2020-08-27 09:10:50',NULL,'3b76ac212b459f598273f7c97c6078b3','new person','Hi, i am use ancms',NULL,NULL,NULL),('wOfmMyzuYp','31a3906c92a3b07999b3c01911cd745cee7e667b5bc9fe8fbc7b6f74f2de93d01f056daec9c93c636ac7d9c1996c351df9f031d60561027903222ed78da44403',12,0,0,'2020-08-27 11:17:49',NULL,'760eab1bfb3e11d351394ff88163bc93','new person','Hi, i am use ancms',NULL,NULL,NULL),('FDmb6koboW','dc584a1562ea8f3e205522607aafda57728ce4ff9bc93c3b3afde275f92df58211e7789f5ad9b872cffde2690eceaf757a439b4e65b26960fd828981242a3874',13,0,0,'2020-08-27 13:59:25',NULL,'caa3ce00c77c150750ba66aee3a9cf10','new person','Hi, i am use ancms',NULL,NULL,NULL),('iNQKXRFtJk','ff97f074e1b087e09f1892e6249449c267fdc207fa281fdb372343c15e8079f474e96f813e122e423fe4ca62b113a678efe51de3b4d9a5642c8233f60c42d93b',14,0,0,'2020-09-01 12:06:41',NULL,'1fc9efd74642764287fcbbb75adb1df5','new person','Hi, i am use ancms',NULL,NULL,NULL),('dsYiCSrL2D','d3bb85044f907b7585068a74c7c5cc8a9e8415d4a66a00b4c2810f970a6cdbf8cbca5ef300fcc7e28b643be6f8b947a0929932e03e7325962d61e370a243522d',15,0,0,'2020-09-02 13:01:58',NULL,'bfec88cb537604fd0005cf9c733f6e52','new person','Hi, i am use ancms',0,0,NULL),('wZiiNN5Pkw','5e648453766f3a49d3f4207b616ddc2fcef375bd906284ec2fae5ff0a938815119976ee2737b8282b8525f00c8a334aecd3c76ce0ca8e2202a324ad880a21ca8',16,0,0,'2020-09-02 13:03:05',NULL,'f7b0c8cffbb1e8377e48935c711d7e30','new person','Hi, i am use ancms',0,0,NULL),('eEsaXlYQXO','ed0c881ba449157306dba4ddc24d50e9c775f1f066eaa458254047b7c2d78215b7d288e9dc081628e11905f3c021f77612d15c31f0b9fc9cc8185c2292a8c112',17,0,0,'2020-09-02 13:03:10',NULL,'27f1a713eab8efff1148b7ff790443fe','new person','Hi, i am use ancms',0,0,NULL),('fqtNraM71l','a5248e7a7e57dcc94ee37898f5dbf11dcc479bdc748340885d07a7a6162b3bda828a0f1077c18bfbaf3d9bbcefe66eec986afe0fa08e4b45b36a80ae333c4782',18,0,0,'2020-09-02 13:04:21',NULL,'9455d4bfdccfc4661eceb72358a04b09','new person','Hi, i am use ancms',0,0,NULL),('MKSPyRUQEM','192835f02e514caf5f2f0dceb6e69740107fa4f264d101bb32f4c739dfd1d7662078223f93d8313c81237cf96cbe713e817f8ad4db3f944c7beb99ba6f93fb54',19,0,0,'2020-09-02 13:05:13',NULL,'607c63e6db44275941d5408424b8e68f','new person','Hi, i am use ancms',0,0,NULL),('bt8LzzpCO4','16252a2d60f778ed9c0a15f4dc2ae426142c58aed7a86908bdd7fbc9e5863aeca334b07c264801dcd890b63b86a11b0159a013915fc3f5eb35b549b7fc62bc2b',20,0,0,'2020-09-02 13:05:15',NULL,'7dcbfbdaba7946c3847202e394a0c372','new person','Hi, i am use ancms',0,0,NULL),('GtXV0BzJEF','025a93a1f6fdb9be30bab025eef8769d1f7759b377593fd8f1bc2fc796f5199f45a2d66c544cdfb6b448aded52fafe3ebd93c3da596fd8b1849acec430ed0c9a',21,0,0,'2020-09-02 13:06:25',NULL,'62fda2b2213ce380f0df2b2ad4ac86c3','new person','Hi, i am use ancms',0,0,NULL),('ObdZsoA8Fy','fdf352b0d1d5e7a883fe04064731a4d248ecd0d208d28cd6d7e75b801480b80884f6e5daebbececce351ade3534d6be77e219a42525f940a253670d954429b89',22,0,0,'2020-09-02 13:06:39',NULL,'032ebbe9320792a3a946b5142618b4fb','new person','Hi, i am use ancms',0,0,NULL),('CVUcTADpQv','c75497f0be6d62c151f41ec3eeef67d5fe53f045df892baf0ce67c8bd43aa1dcd6caac44db6a27a969b65b56883372b075195059eb6a843e981952e21a07cc4c',23,0,0,'2020-09-02 13:07:03',NULL,'ebbddea012c422ff028a022f19fc8379','new person','Hi, i am use ancms',0,0,NULL),('GwFFuYO5yO','0251fe998db2ca0532727743079267ec1193b404786f943988e5a812efd53c03288ad43c6797392c22ef90e6413e5ca027d484e596ab7a7b016a4f2a94ece6d5',24,0,0,'2020-09-02 13:07:05',NULL,'937fc0d9e34f4c7eab5be3375874e8e3','new person','Hi, i am use ancms',0,0,NULL),('Qmf3eJ52Op','700eb0f9ab714702761e735054495e674574d23f9622bafadef40b6e06ed2f833498b15b6efa38e1cf6dee1061739da07f3ffafa6e5a5ea6c60a877552567290',25,0,0,'2020-09-02 13:12:07',NULL,'5fbd752f76a01497ffee0d05ab48f969','new person','Hi, i am use ancms',0,0,NULL),('a2Fn411BTa','1710175c68043409596cae4a8811437310fa49d1527699cc6f10496f5ff550298079371ae1030e6281a670fc6c17dce2ef82cf00d7bc6292184b0c96cec9c24a',26,0,0,'2020-09-02 15:28:58',NULL,'380a56588ea1467cbf1246b0728c6eda','new person','Hi, i am use ancms',0,0,NULL),('S4YrzVnJaw','dae8707011160b78e89c9b05215bd0b2810292a4a94099afcf7fba0162ef11390b1ffcd0100d43904ddcd4f01664a7a52a7c0c7a5011adb2dfc9c875a6276e1b',27,0,0,'2020-09-05 13:32:16',NULL,'21d0983f2f8b1eb9f952c0a72217a44e','new person','Hi, i am use ancms',0,0,NULL),('zJcaRCcbGZ','df4a8996bac985998e252e831f3dab4d2f7311310d761d925409075f6d8ec613492f58aca2af77394e1ab55a3f7bf67bb78f6a482fffc3f0332bfff8f9f73414',28,0,0,'2020-09-06 12:38:55',NULL,'6186c341009d8424cb26208fe07ba59b','new person','Hi, i am use ancms',0,0,NULL),('LBHPgMzniJ','9b13d49339f59edc3f9b6184dcf9653ad8f0d2d8112cdecb9ce7b50a940ab8318664f93249eb27bd81c33035412364fb9f4dcaf160e2058e37d5e4043de6b96f',29,0,0,'2020-09-07 15:18:57',NULL,'7a7b6275c8d5625f6572dc649275afa3','new person','Hi, i am use ancms',0,0,NULL),('eA36GeXt1c','cbcddcae79d6e56e56540c757f2a0cfdbdd2e84f76fb423705c47efc340f399ee651a56604fb6627ae421e9ef567efe0f0a071a2f829cf996b3a5c43ccc007c2',30,0,0,'2020-09-07 15:22:27',NULL,'734a8ab8f767558085d84e0c4a1a3c80','new person','Hi, i am use ancms',0,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id_balance` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `cryptocoin_id` int(10) unsigned NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_balance`,`owner_id`,`cryptocoin_id`),
  KEY `balances_FK` (`cryptocoin_id`),
  KEY `balances_FK_1` (`owner_id`),
  CONSTRAINT `balances_FK` FOREIGN KEY (`cryptocoin_id`) REFERENCES `cryptocoins` (`id`),
  CONSTRAINT `balances_FK_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-07 19:33:18
