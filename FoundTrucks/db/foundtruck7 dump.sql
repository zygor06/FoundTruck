-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: db_foundtruck
-- ------------------------------------------------------
-- Server version	5.7.16-log

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
-- Table structure for table `tb_alimento`
--

DROP TABLE IF EXISTS `tb_alimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_alimento` (
  `NR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TE_ALIMENTO` varbinary(45) NOT NULL,
  `TE_IMAGEM` varbinary(45) DEFAULT NULL,
  PRIMARY KEY (`NR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=binary;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_alimento`
--

LOCK TABLES `tb_alimento` WRITE;
/*!40000 ALTER TABLE `tb_alimento` DISABLE KEYS */;
INSERT INTO `tb_alimento` VALUES (1,'Cervejas Especiais',NULL),(2,'Hamburger Artesanal',NULL),(3,'Pizzas',NULL);
/*!40000 ALTER TABLE `tb_alimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_comentario`
--

DROP TABLE IF EXISTS `tb_comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_comentario` (
  `NR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TE_COMENTARIO` varchar(500) DEFAULT NULL,
  `NR_ID_FOODTRUCK` int(11) NOT NULL,
  `DT_DATA` date NOT NULL,
  `TE_AUTOR` varchar(45) NOT NULL,
  PRIMARY KEY (`NR_ID`),
  KEY `fk_TB_COMENTARIOS_TB_FOODTRUCKS1_idx` (`NR_ID_FOODTRUCK`),
  CONSTRAINT `fk_TB_COMENTARIOS_TB_FOODTRUCKS1` FOREIGN KEY (`NR_ID_FOODTRUCK`) REFERENCES `tb_foodtruck` (`NR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_comentario`
--

LOCK TABLES `tb_comentario` WRITE;
/*!40000 ALTER TABLE `tb_comentario` DISABLE KEYS */;
INSERT INTO `tb_comentario` VALUES (1,'Mussum Ipsum, cacilds vidis litro abertis. Per aumento de cachacis, eu reclamis. \n	A ordem dos tratores não altera o pão duris Nec orci ornare consequat. Praesent \n	lacinia ultrices consectetur. Sed non ipsum felis. Interessantiss quisso pudia ce \n	receita de bolis, mais bolis eu num gostis.',1,'1999-09-09','Fulano'),(2,'Best design, furthermore pleasure to use after that Jony Ive’s incredible design,\n	first Siri is better than TellMe and Google Voice put together generally iPhone \n	rip-offs, another point is that Apple will only get better to whom profit, on the\n	whole profit suddenly gorgeous, to sum up gorgeous, afterwards delay in getting \n	Ice Cream Sandwich, prior to user experience sucks, soon profit, despite Android\n	geek, exactly because profit, apparently iCloud in contrast genius.',2,'2000-10-10','Cicrano'),(3,'Professional fanboy and Android sells more phones in conclusion Google Voice is \n	better than Siri and TellMe put together, such a fanboi soon marketing, despite \n	you suck. Apple copied LG besides you don’t know anything after you suck overall \n	hypnotised at last Apple are nothing without Steve Jobs, apparently Apple didn’t\n	invent anything, nevertheless sucky ass, eventually professional fanboy, in the \n	beginning fanboy.',3,'2001-11-11','Beltrano');
/*!40000 ALTER TABLE `tb_comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_foodtruck`
--

DROP TABLE IF EXISTS `tb_foodtruck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_foodtruck` (
  `NR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TE_NOME` varchar(45) NOT NULL,
  `NR_LAT` float(10,6) DEFAULT NULL,
  `NR_LONG` float(10,6) DEFAULT NULL,
  `NR_CPF_USUARIO` varchar(12) NOT NULL,
  `TE_DESCRICAO` varchar(500) DEFAULT NULL,
  `TE_IMAGEM` varchar(45) DEFAULT NULL,
  `CS_ATIVO` int(2) NOT NULL,
  PRIMARY KEY (`NR_ID`),
  KEY `fk_foodtrucks_usuarios_idx` (`NR_CPF_USUARIO`),
  CONSTRAINT `fk_foodtrucks_usuarios` FOREIGN KEY (`NR_CPF_USUARIO`) REFERENCES `tb_usuario` (`NR_CPF`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_foodtruck`
--

LOCK TABLES `tb_foodtruck` WRITE;
/*!40000 ALTER TABLE `tb_foodtruck` DISABLE KEYS */;
INSERT INTO `tb_foodtruck` VALUES (1,'Foodteste1',-15.791274,-47.888329,'1234','Mussum Ipsum, cacilds vidis litro abertis. Casamentiss faiz malandris se pirulitá. Si num tem leite então bota uma pinga aí cumpadi!','images/imagem.png',1),(2,'Foodteste2',-15.793695,-47.941616,'1234','Per aumento de cachacis, eu reclamis. Ta deprimidis, eu conheço uma cachacis que pode alegrar sua vidis.”',NULL,1),(3,'Foodteste3',-15.781302,-47.922024,'1234','Suco de cevadiss deixa as pessoas mais interessantiss. Quem num gosti di mum que vai caçá sua turmis!',NULL,1);
/*!40000 ALTER TABLE `tb_foodtruck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `NR_CPF` varchar(11) NOT NULL,
  `TE_EMAIL` varchar(50) NOT NULL,
  `TE_SENHA` varchar(12) NOT NULL,
  `TE_NOME` varchar(50) NOT NULL,
  `CS_ATIVO` int(2) NOT NULL,
  PRIMARY KEY (`NR_CPF`),
  UNIQUE KEY `email_UNIQUE` (`TE_EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` VALUES ('1234','cbandeira@gmail.com','1234','Carlos',1);
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_vende`
--

DROP TABLE IF EXISTS `tb_vende`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_vende` (
  `TB_ALIMENTO_NR_ID` int(11) NOT NULL,
  `TB_FOODTRUCK_NR_ID` int(11) NOT NULL,
  PRIMARY KEY (`TB_ALIMENTO_NR_ID`,`TB_FOODTRUCK_NR_ID`),
  KEY `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1_idx` (`TB_FOODTRUCK_NR_ID`),
  KEY `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1_idx` (`TB_ALIMENTO_NR_ID`),
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_alimentos1` FOREIGN KEY (`TB_ALIMENTO_NR_ID`) REFERENCES `tb_alimento` (`NR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_alimentos_has_tb_foodtrucks_tb_foodtrucks1` FOREIGN KEY (`TB_FOODTRUCK_NR_ID`) REFERENCES `tb_foodtruck` (`NR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_vende`
--

LOCK TABLES `tb_vende` WRITE;
/*!40000 ALTER TABLE `tb_vende` DISABLE KEYS */;
INSERT INTO `tb_vende` VALUES (1,1),(3,1),(2,2),(2,3);
/*!40000 ALTER TABLE `tb_vende` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-28 15:53:26
