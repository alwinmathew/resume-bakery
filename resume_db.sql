-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abc`
--

DROP TABLE IF EXISTS `abc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abc` (
  `name` varchar(2) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abc`
--

LOCK TABLES `abc` WRITE;
/*!40000 ALTER TABLE `abc` DISABLE KEYS */;
/*!40000 ALTER TABLE `abc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES ('ancy','8d10344331a7ac7665c83d8956bfc992'),('alwin','8d10344331a7ac7665c83d8956bfc992'),('melwin','69f50a8fa8200560db52e968572e2542'),('vinu','cb07901c53218323c4ceacdea4b23c98'),('gijo','f89fe64cb052a52b05f556b63ffb124e');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personalinfo`
--

DROP TABLE IF EXISTS `personalinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personalinfo` (
  `username` varchar(32) NOT NULL,
  `area_of_work` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL DEFAULT 'firstname',
  `last_name` varchar(20) NOT NULL DEFAULT 'lastname',
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` char(1) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `profile_pic` char(1) NOT NULL DEFAULT '0',
  `summary` varchar(2000) DEFAULT NULL,
  `skills` varchar(2000) DEFAULT NULL,
  `experience` varchar(2000) DEFAULT NULL,
  `studies` varchar(2000) DEFAULT NULL,
  `interests` varchar(2000) DEFAULT NULL,
  `hobbies` varchar(2000) DEFAULT NULL,
  `languages` varchar(2000) DEFAULT NULL,
  `certificates` varchar(2000) DEFAULT NULL,
  `publications` varchar(2000) DEFAULT NULL,
  `awards` varchar(2000) DEFAULT NULL,
  `header_image` varchar(25) DEFAULT NULL,
  `font_family` varchar(60) NOT NULL DEFAULT 'Trebuchet MS, Helvetica, sans-serif',
  `font_size` varchar(2) NOT NULL DEFAULT '12',
  `margin_width` varchar(4) NOT NULL DEFAULT '8mm',
  `margin_color` varchar(10) NOT NULL DEFAULT 'white',
  `border_width` char(1) NOT NULL DEFAULT '0',
  `background_color` varchar(10) NOT NULL DEFAULT 'white',
  PRIMARY KEY (`username`,`area_of_work`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personalinfo`
--

LOCK TABLES `personalinfo` WRITE;
/*!40000 ALTER TABLE `personalinfo` DISABLE KEYS */;
INSERT INTO `personalinfo` VALUES ('alwin','general','Alwin','Mathew','M','2006-06-03','S','0484-2295565','91 8891406276','alwinmathew316@gmail.com',NULL,'XI/673H, Puthenpurackal House, Kunnumpuram, Thrikkakara, Cochin - 682021','0','The weakened economy coupled with a rising unemployment rate has swelled the \njob seeking market, giving employers a bigger pool to choose from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to \nfrom and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to from and workers more \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nresume writing services to polish their resume in a way that makes them attractive to ','sfa f asf my skills field..\nsfsdfg s','sdg dsgs sd s experience section...','',NULL,'hobbies section...\n ggggg akasj jg',NULL,NULL,NULL,NULL,NULL,'Times New Roman, Times, serif','14','10mm','#4A36FF','2','#DBFF4A');
/*!40000 ALTER TABLE `personalinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `username` varchar(32) NOT NULL,
  `area_of_work` varchar(20) NOT NULL,
  `summary` char(1) DEFAULT '0',
  `skills` char(1) DEFAULT '0',
  `experience` char(1) DEFAULT '0',
  `studies` char(1) DEFAULT '0',
  `interests` char(1) DEFAULT '0',
  `hobbies` char(1) DEFAULT '0',
  `languages` char(1) DEFAULT '0',
  `certificates` char(1) DEFAULT '0',
  `publications` char(1) DEFAULT '0',
  `awards` char(1) DEFAULT '0',
  `sharing` char(1) DEFAULT '0',
  PRIMARY KEY (`username`,`area_of_work`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES ('alwin','general','1','1','1','0','0','1','0','0','0','0','1'),('ancy','general','1','1','0','0','0','0','0','0','0','0','0');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-06-11 13:29:43
