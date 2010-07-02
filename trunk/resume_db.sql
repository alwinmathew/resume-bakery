-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.3

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
INSERT INTO `members` VALUES ('alwin','8d10344331a7ac7665c83d8956bfc992'),('neenu','736b19f69aaca691fecd8400294cc383'),('Angel','f4f068e71e0d87bf0ad51e6214ab84e9'),('new','22af645d1859cb5ca6da0c484f1f37ea'),('abcd','e2fc714c4727ee9395f324cd2e7f331f');
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
  `area_of_work` varchar(10) NOT NULL DEFAULT 'General',
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
  `header_image` char(1) NOT NULL DEFAULT '0',
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
  `template_id` varchar(16) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`username`,`area_of_work`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personalinfo`
--

LOCK TABLES `personalinfo` WRITE;
/*!40000 ALTER TABLE `personalinfo` DISABLE KEYS */;
INSERT INTO `personalinfo` VALUES ('alwin','General','Alwin','Mathew','M','1989-09-08','S','0484-2295565','91 8891406276','alwinmathew316@gmail.com',NULL,'XI/673H, Puthenpurackal House, Kunnumpuram, Thrikkakara, Cochin - 682021','0','0','The weakened economy coupled with a rising unemployment rate has swelled the \njob seeking market, giving employers a bigger pool to choose from and workers fmore \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses The weakened economy coupled with a rising unemployment rate has swelled the \njob seeking market, giving employers a bigger pool to choose from and workers fmore \n\ndf sdg','The weakened economy coupled with a rising unemployment rate has swelled the \njob seeking market, giving employers a bigger pool to choose from and workers fmore \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses kjdghdsfhssh sdghsd sfggsg23421423\n\ngdgdgsg dfs    gftsfgg\ng sdfgdfs','The weakened economy coupled with a rising unemployment rate has swelled the \njob seeking market, giving employers a bigger pool to choose from and workers fmore \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses sdfg agda tfh sdhsdghs \n\ndfgd \n\n\n\ndghdhgh dghdh dgh     dgfdgdhdh \n\ndghdh',NULL,NULL,'The weakened economy coupled with a rising unemployment rate has swelled the dfghdhh dh\njob seeking market, giving employers a bigger pool to choose from and workers fmore \npeople to compete with. In an effort to stand out in a crowd of many, unemployed uses \nsfgs\n\n\ndghd  d    dgh df\ndg',NULL,NULL,NULL,NULL,'f8606df00eba7e08'),('abcd','General','firstname','lastname',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'default'),('neenu','General','firstname','lastname',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'c41e81e5639f3710'),('Angel','General','Steve','Carter','M','1982-01-14','M','127 3376882',NULL,'stevecarter@gmail.com',NULL,'Chicago, Illinois, US','1','0','To obtain a position as a senior technician in a company where I can maximize my knowledge of most economic packages and mentor others. Use my prophecy in Excel and Access in creating templates for in-house reports and help the engineering staff with Reserve Reports, database management and analyzing new and existing properties. ',NULL,'Donald Corporations, Mumbai, 2007-Present\n\n    * Operate Environmental Test Chambers, Robotic cycle test equipment and Temperature Data Acquisition instruments to provide M.S. Excel data graphs to engineering for evaluation.\n    * Provide logistic support for ATMÂ´s to include packaging, shipping and fork lift operation (Licensed Fork Lift Operator).\n    * Troubleshoot and repair of electro-mechanical devices to include Automated Teller Machines (ATMÂ´s) and their supporting equipment.\n\nSenior Engineer Tech\n\nNiagara Engineering Works, Mumbai, 2004-2007\n\n    * Assembly and repair of computer systems; upgrade and install software.\n    * Engineering Lab supervisor responsible for parts procurement, tracking and inventory for new product development.\n    * Specialized provider of industrial air filters with 75 employees.\n\nElectro-Mechanical Field Service Tech\n\nSwift Associates, Mumbai, 2002-2004\n\n    * Air compressor testing, filtration testing, and preventive maintenance.\n    * Mechanical repair and hydraulic maintenance of material handling equipment.\n    * Direct customer contact in the process of field equipment service and parts counter operation.\n    * Parts department operation utilizing computer, microfiche and manuals for parts information.\n','    * 1 year diploma course in Industrial Heavy Engineering\n\nNational Institute for Industrial Engineering, Mumbai, 2002\n\n    * Master of Engineering Services\n\nThe Engineering College, Mumbai 2001\n\n    * B.Sc. (engineering and technology management)\n\nSt. Peter College, Mumbai 1999',NULL,NULL,NULL,NULL,NULL,NULL,'fe821c5e2176f89e'),('new','General','firstname','lastname',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'default'),('alwin','Arts','firstname','lastname',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'f8606df00eba7e08'),('abcd','abcd','firstname','lastname',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'default');
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
  `area_of_work` varchar(10) NOT NULL DEFAULT 'General',
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
INSERT INTO `sections` VALUES ('alwin','General','1','1','1','0','0','1','0','0','0','0','1'),('neenu','General','1','1','1','1','1','1','1','1','1','1','0'),('Angel','General','1','0','1','1','0','0','0','0','0','0','1'),('alwin','Arts','0','0','0','0','0','0','0','0','0','0','0'),('new','General','0','0','0','0','0','0','0','0','0','0','0'),('abcd','General','0','1','0','0','0','1','1','0','0','0','0'),('abcd','abcd','0','0','0','0','0','0','0','0','0','0','0');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `templates` (
  `template_name` varchar(32) NOT NULL,
  `template_key` varchar(16) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `users` varchar(32) NOT NULL,
  `read_only` char(1) NOT NULL DEFAULT '1',
  `header_image` char(1) NOT NULL DEFAULT '0',
  `font_family` varchar(60) NOT NULL DEFAULT 'Lucida Console, Monaco, monospace',
  `font_size` varchar(2) NOT NULL DEFAULT '12',
  `margin_width` varchar(4) NOT NULL DEFAULT '8mm',
  `margin_color` varchar(10) NOT NULL DEFAULT 'white',
  `border_width` char(1) NOT NULL DEFAULT '0',
  `background_color` varchar(10) NOT NULL DEFAULT 'white',
  PRIMARY KEY (`template_key`,`users`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES ('default','default','','','1','0','Trebuchet MS, Helvetica, sans-serif','12','8mm','white','0','white'),('test1','ff7c7037aecb0dd4','alwin','neenu','1','0','Times New Roman, Times, serif','14','8mm','#FF5E24','1','#8CF4FF'),('test1','ff7c7037aecb0dd4','alwin','alwin','1','0','Times New Roman, Times, serif','14','8mm','#FF5E24','1','#8CF4FF'),('angel template','fe821c5e2176f89e','angel','angel','1','1','Lucida Console, Monaco, monospace','12','8mm','#0A0A0A','2','#FFFFFF'),('alwin template','812011202e9e1a31','alwin','alwin','0','0','Lucida Console, Monaco, monospace','12','8mm','#3819FF','2','#FFCDAB'),('alwin template','c41e81e5639f3710','neenu','neenu','1','0','Times New Roman, Times, serif','14','8mm','#29FF37','2','#FFCDAB'),('qwerty','f8606df00eba7e08','alwin','alwin','1','1','Lucida Console, Monaco, monospace','12','8mm','#FFFFFF','0','#F4FF5E'),('alwin template','9a9a2a3bd7bc8c79','alwin','alwin','1','1','Lucida Console, Monaco, monospace','12','8mm','#FFFFFF','0','#FFFFFF');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-07-02 22:11:04
