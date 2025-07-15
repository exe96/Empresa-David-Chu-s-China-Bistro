-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: ikigai
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_agent` varchar(250) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `inicio` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_persona` (`id_persona`),
  CONSTRAINT `actividad_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',6,'2024-10-02 19:33:53'),(2,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',7,'2024-10-02 19:33:57'),(3,'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Mobile Safari/537.36 OPR/83.0.0.0',1,'2024-10-02 19:34:00');
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extension` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `letter` varchar(10) NOT NULL,
  `number` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`,`letter`),
  KEY `letter` (`letter`),
  KEY `extension` (`extension`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`letter`) REFERENCES `menu_category_item` (`letter`),
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`extension`) REFERENCES `soported_extension` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,2,21.95,'Beef with Eggplant in Garlic Sauce','sliced beef sauteed with eggplant in garlic sauce','F',6),(2,2,21.95,'Beef with Garlic Sauce','sliced beef sauteed in garlic sauce','F',5),(3,2,21.95,'Mongolian Beef','sliced beef sauteed with bamboo shoots, onions, and green onions in chef\'s sauce','F',10),(4,2,21.95,'Kung Pao Beef','sliced beef sauteed with peanuts and celery in delicious Kung Pao sauce','F',9),(5,2,21.95,'Beef with Mixed Vegetables','sliced beef sauteed with broccoli, carrots, snow peas, mushrooms and baby corns.','F',4),(6,2,21.95,'Beef with Snow Peas','sliced beef sauteed with snow peas in brown sauce','F',7),(7,2,21.95,'Beef with String Bean','sliced beef sauteed with string beans and onions','F',12),(8,2,21.95,'Hunan Beef','beef sauteed with broccoli, mushrooms, and carrots in spicy Hunan sauce','F',2),(9,2,22.90,'Beef Broccoli','sliced beef sauteed with broccoli in brown sauce','F',1),(10,2,21.95,'Szechuan Beef','beef sauteed with carrots and celery, in a spicy Szechuan sauce','F',3),(11,2,21.95,'Moo Shu Beef','sliced beef sauteed  with shredded cabbage, mushrooms and eggs, then wrapped with pancake and delicious plum sauce','F',11),(12,2,21.95,'Beef with Green Pepper','sliced beef sauteed with green peppers and onions in brown sauce','F',8),(13,2,24.95,'Hunan Veal','veal sauteed with broccoli, mushrooms, and carrots in spicy Hunan sauce','V',1),(14,2,18.95,'Veal with Mixed Vegetables','sliced veal sauteed with carrots, broccoli, snow peas, string beans, water chestnuts, and mushrooms in brown sauce','V',2),(15,2,18.95,'Veal with Green Peppers','sliced veal sauteed with onions and green peppers in brown sauce','V',6),(16,2,18.95,'Veal with Garlic Sauce','sliced veal sauteed with mushrooms, string beans, and water chestnuts in garlic sauce','V',3),(17,2,18.95,'Szechuan Veal','veal sauteed with carrots, celery, and bean sprouts in Szechuan sauce','V',7),(18,2,18.95,'Mongolian Veal','veal sauteed with onions, green onions, and bamboo shoots in chef\'s sauce','V',5),(19,2,18.95,'Kung Pao Veal','sliced veal sauteed with peanuts and celery in delicious Kung Pao sauce','V',4),(20,2,34.95,'Crispy Duck','boneless duck meat, lightly breaded, deep fried to a crisp, topped with vegetables in chef\'s special sauce','DK',2),(21,2,34.95,'Duck with Vegetables','sliced lean duck meat sauteed with mixed vegtables in brown sauce','DK',3),(22,2,30.95,'Peking Duck','marinated duck roasted crisp and served with pancake and green onion with special sauce','DK',1),(23,2,15.95,'Wok\'s Mixed Vegetables','broccoli, carrots, baby corn, water chestnuts, mushrooms, and snow peas sauteed in brown sauce','VG',1),(24,2,15.95,'Sauteed String Beans, Szechuan','onions and string beans sauteed with chef\'s sauce','VG',2),(25,2,15.95,'Crispy Eggplant in Garlic Sauce','breaded and fried eggplants sauteed in sweet garlic sauce and sesame seeds','VG',4),(27,2,13.95,'Lo Mein','white meat chicken OR beef OR vegetables, sauteed with onions, and bean sprouts and soft lo mein noodles','L',26),(27,2,15.95,'Sauteed Bean Sprouts','fresh bean sprouts sauteed with scallions','VG',14),(28,2,13.95,'Sesame Chicken','chunks of chicken, breaded and deep-fried with a sesame seed sauce. White meat $1 extra.','L',27),(28,2,15.95,'Orange Bean Curd','Tofu lightly breaded and fried and sauteed with orange peel in sweet brown sauce','VG',12),(29,2,15.95,'Moo Shu Vegetables','shredded cabbage sauteed with mushrooms, carrots, and scrambled eggs','VG',6),(30,2,15.95,'Eggplant in Garlic Sauce','eggplant sauteed with water chestnuts and string beans in garlic sauce','VG',3),(31,2,15.95,'Bean Curd with Mushrooms','bean curd sauteed with black mushrooms and regular mushrooms in brown sauce','VG',11),(32,2,15.95,'Bean Curd with Eggplant in Garlic Sauce','Tofu lightly breaded and fried and sauteed with water chestnuts, string beans, and mushrooms in garlic sauce','VG',13),(33,2,15.95,'Bean Curd, Hunan Style','bean curd lightly fried then sauteed with green pepper, snow peas, and water chestnuts in brown sauce','VG',9),(34,2,16.95,'Broccoli Sauteed wtih Mushrooms in Light Sauce','broccoli sauteed with fresh mushrooms in white sauce','VG',5),(35,2,15.95,'Bean Curd, Szechuan Style','silky soft bean curd braised in chef\'s brown sauce','VG',8),(36,2,15.95,'Bean Curd with Mixed Vegetables','Tofu lightly breaded and fried and sauteed with carrots, broccoli, snow peas, string beans, water chestnuts, and mushrooms in brown sauce','VG',10),(37,2,18.95,'Curry Chicken','white meat chicken sauteed with ionions, peas, carrots, and broccoli','CU',21),(38,2,19.95,'Curry Veal','veal sauteed with ionions, peas, carrots, and broccoli','CU',23),(39,2,18.95,'Curry Beef','beef sauteed with ionions, peas, carrots, and broccoli','CU',22),(40,2,16.95,'Beef Lo Mein','beef, onions, and bean sprouts sauteed with soft lo mein noodles','NL',3),(41,2,16.95,'Chicken Lo Mein','white meat chicken, onions, and bean sprouts sauteed with soft lo mein noodles','NL',2),(42,2,15.95,'Vegetable Lo Mein','broccoli, carrots, onions, snow peas, and bean sprouts sauteed with soft lo mein noodles','NL',1),(43,2,17.95,'Veal Lo Mein','veal, onions, and bean sprouts sauteed with soft lo mein noodles','NL',4),(44,2,18.95,'House Special Lo Mein','white meat chicken, beef, veal, onions, and bean sprouts sauteed with soft lo mein noodles','NL',5),(45,2,21.95,'Beef Mei Fan','beef sauteed with onions and bean sprouts','NF',12),(46,2,21.95,'Chicken Mei Fan','white meat chicken sauteed with onions and bean sprouts','NF',11),(47,2,18.95,'Vegetable Mei Fan','broccoli, snow peas, onions, and bean sprouts sauteed with rice noodles','NF',10),(48,2,24.95,'House Special Mei Fan','white meat chicken, beef, and veal sauteed with onions and bean sprouts','NF',13),(49,2,22.95,'Pan Fried Noodles with Beef','sliced beef sauteed with broccoli, snow peas, mushrooms, water chestnuts, and carrots with brown sauce on a bed of crispy crunchy noodles','PF',3),(50,2,22.95,'Pan Fried Noodles with Chicken','white meat chicken sauteed with broccoli, snow peas, mushrooms, water chestnuts, and carrots with brown sauce on a bed of crispy crunchy noodles','PF',2),(51,2,23.95,'Pan Fried Noodles with Veal','sliced veal sauteed with broccoli, snow peas, mushrooms, water chestnuts, and carrots with brown sauce on a bed of crispy crunchy noodles','PF',4),(52,2,19.95,'Pan Fried Noodles with Vegetables','broccoli, snow peas, mushrooms, water chestnuts, and carrots sauteed with brown sauce on a bed of crispy crunchy noodles','PF',1),(53,2,25.95,'House Special Pan Fried Noodles','veal, beef, and chicken sauteed with broccoli, snow peas, mushrooms, water chestnuts, and carrots with brown sauce on a bed of crispy crunchy noodles','PF',5),(54,2,15.95,'Vegetable Chow Mein','broccoli, snow peas, onions, bean sprouts, and celery sauteed with white sauce','CM',1),(55,2,16.95,'Chicken Chow Mein','white meat chicken sauteed with bean sprouts, onions, and celery in white sauce','CM',2),(56,2,18.95,'House Special Chow Mein','veal, beef, and chicken sauteed with bean sprouts, onions, and celery in brown sauce','CM',5),(57,2,16.95,'Beef Chow Mein','beef sauteed with bean sprouts, onions, and celery in brown sauce','CM',3),(58,2,17.95,'Veal Chow Mein','veal sauteed with bean sprouts, onions, and celery in brown sauce','CM',4),(59,2,20.95,'Chicken Egg Foo Young','white meat chicken, shredded cabbage, onions, bean sprouts, celery, snow peas, and carrots in egg','FY',2),(60,2,23.95,'House Egg Foo Young','veal, beef, and chicken, shredded cabbage, onions, bean sprouts, celery, snow peas, and carrots in egg','FY',5),(61,2,21.95,'Veal Egg Foo Young','veal, shredded cabbage, onions, bean sprouts, celery, snow peas, and carrots in egg','FY',4),(62,2,19.95,'Vegetable Egg Foo Young','shredded cabbage, onions, bean sprouts, celery, snow peas, and carrots in egg','FY',1),(63,2,20.95,'Beef Egg Foo Young','beef, shredded cabbage, onions, bean sprouts, celery, snow peas, and carrots in egg','FY',3),(64,2,4.00,'Fortune Cookies (12)','individually wrapped cookies','SO',6),(65,2,7.95,'French Fries','/','SO',2),(66,2,4.50,'Brown Rice','/','SO',3),(67,2,13.95,'Chicken Nuggets with French Fries','/','SO',1),(68,2,3.95,'Fountain Soda Large','/','SO',7),(69,2,4.50,'Extra White Rice','/','SO',4),(70,2,4.50,'Extra Fried Rice','/','SO',5),(71,2,6.00,'Chocolate Truffle Cake','Layers of German chocolate cake are soaked in rum to moist perfection. Extravagant amounts of chocolate create special truffle filling, and a superb chocolate ganache icing to cover this entire indulgence.','DS',1),(72,2,6.00,'Cappuccino Apricot Cake','This cake combines coffee liquer and espresso cream complimented with a pure apricot jam, layered between cappuccino chiffon.','DS',2),(73,2,6.00,'Cappuccino Apricot Cake','This cake combines coffee liquer and espresso cream complimented with a pure apricot jam, layered between cappuccino chiffon.','DS',2),(74,2,20.95,'Beef with Fresh Vegetables','sliced beef sauteed with mixed vegetables','D',10),(75,2,20.95,'Beef with Garlic Sauce','sliced beef sauteed in garlic sauce','D',9),(76,2,20.95,'Beef Broccoli','sliced beef sauteed with broccoli in brown sauce','D',8),(77,2,20.95,'Chow Mein','Chow mein is sauteed with bean sprouts, onions, and celery in brown sauce or white sauce.','D',18),(78,2,20.95,'Veal with Fresh Vegetables','sliced veal sauteed with mixed vegetables','D',11),(79,2,20.95,'Sweet and Sour Chicken','white meat chicken, breaded and fried with some green pepper, onion, and pineapples','D',7),(80,2,20.95,'Sesame Chicken','chunks of chicken, breaded and deep-fried with a sesame seed sauce. White meat on your request and pay $1 extra.','D',3),(81,2,20.95,'Orange Chicken','chunks of chicken, breaded and deep-fried with sauce containing orange peels; white meat by request and pay $1 extra.','D',1),(82,2,19.95,'Eggplant with Garlic Sauce','eggplant sauteed with water chestnuts and string beans in garlic sauce','D',16),(83,2,20.95,'Veal with Garlic Sauce','sliced veal sauteed in garlic sauce','D',12),(84,2,20.95,'Chicken with Vegetables','white meat chicken in a clear white sauce','D',6),(85,2,20.95,'Mixed Vegetables','broccoli, carrots, baby corn, water chestnuts, mushrooms, and snow peas sauteed in brown sauce','D',15),(86,2,20.95,'Hunan Bean Curd','bean curd lightly fried then sauteed with green pepper, snow peas, and water chestnuts in brown sauce','D',13),(87,2,20.95,'Kung Pao Chicken','diced chicken sauteed with peanuts, and celery in delicious kung pao sauce; white meat by request and pay $1 extra.','D',4),(88,2,19.95,'General Tso\'s Chicken','chunks of chicken, breaded and deep-fried with sauce and scallions; white meat by request and pay $1 extra.','D',2),(89,2,20.95,'Lo Mein','onions, and bean sprouts sauteed with soft lo mein noodles','D',17),(90,2,20.95,'Bean Curd with Fresh Vegetables','Tofu lightly breaded and fried and sauteed with carrots, broccoli, snow peas, string beans, water chestnuts, and mushrooms in brown sauce','D',14),(91,2,20.95,'Chicken Cashewnuts','diced chicken with waterchestnuts, green peppers, and celery, and cashewnuts; white meat by request and pay $1 extra.','D',5),(178,2,16.95,'Chicken Fried Rice','white meat chicken sauteed with onions and bean sprouts with rice','FR',2),(179,2,16.95,'Beef Fried Rice','sliced beef sauteed with onions and bean sprouts with rice','FR',3),(180,2,18.95,'House Fried Rice','veal, beef, and chicken sauteed with onions and bean sprouts with rice','FR',5),(181,2,17.95,'Veal Fried Rice','sliced veal sauteed with onions and bean sprouts with rice','FR',4),(182,2,15.95,'Vegetable Fried Rice','broccoli, snow peas, onions, and bean sprouts sauteed with rice','FR',1),(183,2,11.50,'Won Ton Soup with Chicken','chicken-stuffed won tons in clear chicken broth with white meat chicken pieces and a few scallions','A',1),(184,2,11.50,'Egg Drop Soup','chicken broth with egg drop','A',2),(185,2,11.50,'Chicken Corn Soup','clear chicken broth with creamy corn and egg drop with white meat chicken pieces','A',3),(186,2,11.50,'Hot and Sour Soup','tofu, chicken, mushroom, bamboo shoot, and egg','A',4),(187,2,13.50,'Egg Drop with Won Ton Soup','chicken soup with egg drop and won tons','A',5),(188,2,12.50,'Chicken Noodle (or Rice) Soup','clear broth and lo mein noodles or white rice, chicken pieces','A',6),(189,2,12.50,'Garden Vegetable Soup','clear chicken broth with mixed vegetables (carrots, cabbage, baby corn, mushroom, snow peas)','A',7),(190,2,13.50,'Garden Vegetable Soup with Tofu','clear chicken broth with mixed vegetables (carrots, cabbage, baby corn, mushroom, snow peas) with tofu pieces','A',8),(191,2,13.50,'Chicken with Garden Vegetable Soup','clear chicken broth with mixed vegetables (carrots, cabbage, baby corn, mushroom, snow peas) and chicken pieces','A',9),(192,2,15.50,'Hong Kong Style Won Ton Soup','clear chicken broth with carrots, mushrooms, snow peas, and broccoli, and a few pieces of Hong Kong style won tons','A',10),(193,2,20.95,'Young Chow Won Ton Soup (for 2)','clear chicken broth with vegetables, veal, chicken, and beef and won tons','A',11),(194,2,4.25,'Beef Egg Roll','eggroll with cabbage, carrots and beef','B',1),(195,2,4.25,'Spring Roll (1)','thin wraps with white meat and cabbage','B',2),(196,2,3.75,'Vegetable Egg Roll (1)','cabbage and carrots in eggroll wrappers','B',3),(197,2,13.95,'Fried Won Ton with Chicken Meat (6)','triangle shaped won ton with ground white meat chicken inside','B',4),(198,2,13.95,'Chicken Toast (4)','ground chicken meat on bread, deep-fried, comes with 4 pieces','B',5),(199,2,13.95,'Fried Silky Tofu with Special Garlic Sauce','4 large tofu cubes, breaded and deep-fried, with garlic sauce on the side','B',6),(200,2,14.95,'Scallion Pancake','dough mixed with scallion and pan-fried','B',7),(201,2,4.25,'Steamed (or Pan Fried) Chicken Dumplings (6)','house-made dough dumpling with chicken','B',8),(202,2,14.95,'Steamed (or Pan Fried) Vegetable Dumplings (6)','house-made dough dumpling with carrot, mushroom, cellophane noodles, cabbage (6 pieces)','B',9),(203,2,14.95,'Szechuan Soft Won Ton (8)','soft won tons filled with chicken, with garlic sauce','B',10),(204,2,15.95,'Chicken in Soothing Lettuce Wraps','white-meat chicken with mushrooms, green peppers, water chestnuts, carrots sauteed with special house sauce, wrapped in fresh lettuce','B',11),(205,2,14.95,'Teriyaki Beef (6)','6 pieces of beef on skewers with teriyaki sauce','B',12),(206,2,10.95,'Fried Chicken Wing (6)','6 pieces of curry-flavored chicken wings','B',13),(207,2,18.95,'B.B.Q. Spareribs','marinated grilled roast barbeque ribs','B',14),(208,2,25.95,'Pu Pu Platter (for 2)','2 spring egg rolls, 2 fried won tons, 2 BBQ ribs, 2 chicken toast, 2 teriyaki beef','B',15),(209,2,13.95,'Cold Sesame Noodle','Peanut butter sauce and sesame seeds on lo mein noodles','B',16),(210,2,27.95,'Chinese Scallion Pancake Wrap','with choice of string bean, string bean chicken, string bean beef, beef onions, moo shu vegetable','SP',1),(211,2,25.95,'Grilled Veal','marinated and grilled veal served with vegetables and lo mein on the side','SP',6),(212,2,26.95,'Happy Family','beef, veal, and chicken sauteed with mixed vegetables in chef\'s special sauce; lo mein served on the side','SP',5),(213,2,25.95,'Orange Beef','a few cuts of beef, breaded, deep-fried with sauce containing orange peels; served with lo mein on the side','SP',7),(214,2,26.95,'Orange Chicken and Beef Combo','white meat chicken and beef, breaded and deep-fried with special house sauce; served with lo mein and vegetables','SP',4),(215,2,24.95,'Teriyaki Chicken','marinated grilled chicken breast with vegetables and lo mein on the side','SP',2),(216,2,25.95,'Vegetable Tempura','assorted vegetables breaded and fried, served with lo mein on the side','SP',3),(217,2,25.95,'Sesame Beef','a few cuts of beef, breaded, deep-fried with sauce containing sesame seeds; served with lo mein on the side','SP',8),(218,2,21.95,'White Meat Chicken with String Bean','white meat chicken sauteed with string beans and soy sauce','C',3),(219,2,21.95,'General Tso\'s Chicken','chunks of chicken, breaded and deep-fried with sauce and scallions; white meat by request and pay $1 extra for a pint and $2 for a large.','C',2),(220,2,22.95,'Chicken with Broccoli','white meat chicken sauteed with broccoli in brown sauce','C',16),(221,2,22.95,'White Meat Chicken with Garlic Sauce','chicken sauteed with string beans, mushrooms, and waterchestnuts in garlic sauce','C',11),(222,2,22.95,'Lemon Chicken','white meat chicken breaded and fried, served with lemon sauce on the side','C',17),(223,2,21.95,'White Meat Chicken with Fresh Vegetables','white meat chicken in a clear white sauce sauteed with mixed vegetables','C',6),(224,2,21.95,'Szechuan Chicken','white meat chicken sauteed with carrots, celery, and bean sprouts in Szechuan sauce','C',9),(225,2,21.95,'Sweet and Sour Chicken','white meat chicken, breaded and fried with some green pepper, onion, and pineapples','C',15),(226,2,21.95,'Sesame Chicken','chunks of chicken, breaded and deep-fried with a sesame seed sauce','C',7),(227,2,21.95,'Moo Goo Gau Pan','white meat chicken sauteed with broccoli, snow peas, mushrooms, and waterchestnuts in a white sauce','C',14),(228,2,21.95,'Kung Pao Chicken','diced chicken sauteed with peanuts, and celery in delicious kung pao sauce; white meat by request and pay $1 extra for a pint and $2 extra for a large.','C',10),(229,2,21.95,'Salt & Pepper Chicken','chunks of chicken breaded and fried, the sauteed with green peppers','C',19),(230,2,21.95,'Hunan Chicken','white meat chicken sauteed with broccoli, mushrooms, and baby corn in Hunan sauce','C',8),(231,2,21.95,'Eight Treasure Chicken','diced chicken sauteed with mushrooms, waterchestnuts, celery, peas, carrots, peanuts, and cahsews in a chef\'s sauce; white meat by request and pay $1 extra for a pint and $2 for a large.','C',18),(232,2,22.95,'Dry Shredded Chicken','white meat chicken lightly breaded and fried until crip, then sauteed with celery and carrots in a special chef\'s sauce','C',12),(233,2,21.95,'Chicken Cashewnuts','diced chicken with waterchestnuts, green peppers, and celery, and cashewnuts; white meat by request: for pint $1 extra, for large $2 extra','C',5),(234,2,21.95,'White Meat Chicken with Eggplant In Garlic Sauce','white meat chicken, string beans, waterchestnuts, mushrooms, and eggplant, in garlic sauce','C',4),(235,2,21.95,'Orange Chicken','chunks of chicken, breaded and deep-fried with sauce containing orange peels; white meat by request and  $1 extra for a pint and $2 extra for a large.','C',1),(236,2,21.95,'Moo Shu Chicken','white meat chicken sauteed with shredded cabbage, mushrooms and eggs, then wrapped with pancake and delicious plum sauce','C',13),(237,2,13.95,'Orange Chicken','chunks of chicken, breaded and deep-fried with sauce containing orange peels; white meat by request, $1 more for white meat.','L',1),(239,2,13.95,'Chicken Cashewnuts','diced chicken with waterchestnuts, green peppers, and celery, and cashewnuts; white meat by request, $1 extra for white meat.','L',3),(244,2,13.95,'General Tso\'s Chicken','chunks of chicken, breaded and deep-fried with sauce and scallions; white meat by request, $1 extra for white meat.','L',2),(246,2,13.95,'Kung Pao Chicken','Dark meat chicken sauteed with carrots and celery, in a spicy Szechuan sauce, $1 more for white meat chicken.','L',4),(247,2,13.95,'Chicken String Bean','white meat chicken sauteed with string beans and soy sauce','L',5),(248,2,13.95,'Chicken Vegetable','white meat chicken in a clear white sauce sauteed with mixed vegetables','L',6),(249,2,13.95,'Chicken Garlic Sauce','chicken sauteed with string beans, mushrooms, and waterchestnuts in garlic sauce','L',7),(250,2,13.95,'Chicken Eggplant with Garlic Sauce','white meat chicken, string beans, waterchestnuts, mushrooms, and eggplant, in garlic sauce','L',8),(251,2,13.95,'Sweet and Sour Chicken','white meat chicken, breaded and fried with some green pepper, onion, and pineapples','L',9),(252,2,13.95,'Chicken Broccoli','white meat chicken sauteed with broccoli in brown sauce','L',10),(253,2,13.95,'Hunan Chicken','white meat chicken sauteed with broccoli, mushrooms, and baby corn in Hunan sauce','L',11),(254,2,13.95,'Szechuan Chicken','white meat chicken sauteed with carrots, celery, and bean sprouts in Szechuan sauce','L',12),(255,2,13.95,'Hunan Beef','beef sauteed with broccoli, mushrooms, and carrots in spicy Hunan sauce','L',14),(257,2,13.95,'Beef with Garlic Sauce','sliced beef sauteed in garlic sauce','L',15),(258,2,13.95,'Beef String Bean','sliced beef sauteed with string beans and onions','L',16),(259,2,13.95,'Beef with Green Pepper','sliced beef sauteed with green peppers and onions in brown sauce','L',17),(260,2,13.95,'Veal with Mixed Vegetables','sliced veal sauteed with carrots, broccoli, snow peas, string beans, water chestnuts, and mushrooms in brown sauce','L',18),(261,2,13.95,'Hunan Bean Curd','bean curd lightly fried then sauteed with green pepper, snow peas, and water chestnuts in brown sauce','L',19),(262,2,13.95,'Bean Curd with Vegetables','Tofu lightly breaded and fried and sauteed with carrots, broccoli, snow peas, string beans, water chestnuts, and mushrooms in brown sauce','L',20),(263,2,13.95,'Wok\'s Mixed Vegetables','broccoli, carrots, baby corn, water chestnuts, mushrooms, and snow peas sauteed in brown sauce','L',21),(264,2,13.95,'Szechuan String Bean','onions and string beans sauteed with chef\'s sauce','L',22),(265,2,13.95,'Eggplant with Garlic Sauce','eggplant sauteed with water chestnuts and string beans in garlic sauce','L',23),(266,2,13.95,'Chicken Mei Fan','white meat chicken sauteed with onions and bean sprouts','L',24),(267,2,6.50,'Asparagus Sushi Roll','/','SR',2),(268,2,3.50,'Yellowtail Sashimi','A piece of yellow tail on top of some sushi rice.','SR',27),(269,2,8.00,'California  Roll','Crab meat, avocado and cucumber','SR',5),(270,2,6.50,'Cucumber Sushi Roll','/','SR',1),(271,2,3.00,'Imitation Crab Stick Sashimi','A imitation crab stick on top of some sushi rice.','SR',28),(272,2,8.50,'Salmon and Avocado Sushi Roll','/','SR',11),(273,2,3.00,'Salmon Sashimi','A piece of salmon on top of some rice','SR',25),(274,2,7.50,'Salmon Sushi Roll','/','SR',6),(275,2,8.50,'Spicy Tuna Sushi Roll','With green onions','SR',13),(276,2,7.00,'Avocado Sushi Roll','/','SR',3),(277,2,3.00,'Tuna Sashimi','A piece of tuna on top of some sushi rice.','SR',26),(278,2,7.50,'Tuna Sushi Roll','/','SR',7),(279,2,8.00,'Yellowtail  Roll','/','SR',8),(280,2,8.50,'Yellowtail and Avocado Sushi Roll','/','SR',12),(281,2,8.50,'Tuna and Avocado Sushi Roll','/','SR',10),(282,2,9.50,'Salmon Tartar Temaki Roll','/','SR',24),(283,2,10.25,'Tiriyaki Combo Cooked Sushi Roll','Cooked salmon and tuna','SR',20),(284,2,15.00,'Alaska Roll','Crispy fried crab stick topped with smoked salmon, cucumber and spicy mayog','SR',34),(285,2,16.00,'Double Happiness','Salmon, tuna, cucumber inside, topped with avocado.','SR',30),(286,2,15.00,'Dragon Roll','California roll topped with seared tuna and yellowtail.','SR',37),(287,2,8.50,'Fried Sweet Potato Sushi Roll','/','SR',15),(288,2,8.50,'Garden Salad','Sliced cucumber, lettuce, shiitake mushroom, red pepper with sliced avocado and sesame seed on top.','SR',29),(289,2,16.00,'Love Roll','spicy tuna roll topped with tuna.','SR',32),(290,2,15.00,'Orioles','Spicy tuna, avocado topped with seared salmon and spicy mayo.','SR',36),(291,2,15.00,'Rainbow Roll','California roll topped with tuna, salmon, avocado.','SR',35),(292,2,8.50,'Philadelphia Sushi Roll','Smoked Salmon, Tofu Cream Cheese & Cucumber.','SR',16),(293,2,11.50,'Salmon Tempura Cooked Sushi Roll','Crispy fried salmon topped with scallions and mayo.','SR',17),(294,2,10.50,'Salmon Skin and Cucumber Temaki Roll','/','SR',22),(295,2,23.00,'Sashimi Combo','4 tuna, 3 salmon, 3 yellowtail','SR',41),(296,2,19.00,'Sashimi Maki Combo','6 pieces of sashimi with a California roll.','SR',43),(297,2,34.95,'Sushi Sashimi Combo','9 pieces sashimi with 8 pieces sushi & a California roll.','SR',42),(298,2,8.50,'Spicy Salmon Sushi Roll','Chopped up salmon with some green onions','SR',14),(299,2,10.50,'Teriyaki Salmon Cooked Sushi Roll','Cooked salmon with teriyaki sauce on top.','SR',19),(300,2,10.50,'Teriyaki Tuna Cooked Sushi Roll','Cooked tuna roll with teriyaki sauce on top.','SR',18),(301,2,9.00,'Tuna and Cucumber Temaki Hand Roll','/','SR',21),(302,2,9.00,'Yellowtail Avocado Temaki Roll','Hand roll','SR',23),(303,2,16.00,'Volcano Roll','Baked California Roll topped with spicy tuna & spicy mayo.','SR',33),(304,2,16.00,'Golden Dragon Roll','Imitation crabmeat, avocado, cucumber, tofu cream cheese. (deep fried)','SR',39),(305,2,17.00,'Las Vegas Roll','Salmon, cucumber, avocado and tofu cream cheese inside, topped with spicy mayo, teriyaki sauce and scallions. (deep fried)','SR',31),(306,2,9.50,'Salmon Skin & Cucumber Sushi Roll','/','SR',9),(307,2,16.00,'Blossom Roll','Tuna, salmon, yellowtail, imitation crabmeat rolled with cucumber.','SR',38),(308,2,18.00,'Festival Roll','Tuna, yellowtail, salmon, imitation crabmeat, red pepper and asparagus. (10 pieces)','SR',40),(309,2,8.00,'Garden Vegetable Sushi Roll','Cucumber, Asparagus, Red Pepper, Shiitake Mushroom.','SR',4),(310,4,1.00,'pepe','luis','B',17);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_category_item`
--

DROP TABLE IF EXISTS `menu_category_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `letter` varchar(10) NOT NULL,
  `extension` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`,`name`,`letter`),
  UNIQUE KEY `letter` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_category_item`
--

LOCK TABLES `menu_category_item` WRITE;
/*!40000 ALTER TABLE `menu_category_item` DISABLE KEYS */;
INSERT INTO `menu_category_item` VALUES (1,'LUNCH','L',2),(2,'SOUP','A',2),(3,'APPETIZERS','B',2),(4,'CHEF\'s RECOMMENDATIONS','SP',2),(5,'CHICKEN','C',2),(6,'BEEF','F',2),(7,'VEAL','V',2),(8,'DUCK','DK',2),(9,'VEGETABLES','VG',2),(10,'CURRY','CU',2),(11,'NOODLES(LO MEIN)','NL',2),(12,'MEI FAN(VERY FINE NOODLES)','NF',2),(13,'PAN FRIED NOODLES','PF',2),(14,'FRIED RICE','FR',2),(15,'CHOW MEIN','CM',2),(16,'EGG FOO YOUNG','FY',2),(17,'SIDE ORDERS','SO',2),(18,'DESSERTS','DS',2),(19,'DINNER COMBO','D',2),(20,'SUSHI MENU','SR',2);
/*!40000 ALTER TABLE `menu_category_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `segundo_nombre` varchar(150) DEFAULT NULL,
  `segundo_apellido` varchar(150) DEFAULT NULL,
  `rol` varchar(50) DEFAULT 'cliente',
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `edad` tinyint(3) unsigned NOT NULL,
  `imagen_perfil` mediumblob,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `rol` (`rol`),
  CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol_permitido` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Juan','Garmendia',NULL,NULL,'cliente','Juan_garmendia@gmail.com','luis1234',34,NULL),(2,'Maria','Luiza',NULL,NULL,'cliente','Maria_Luiza@gmail.com','luis1234',30,NULL),(3,'Natalia','Oreiro',NULL,NULL,'cliente','Natalia_oreiro@gmail.com','luis1234',34,NULL),(4,'Hernesto','Garmendia',NULL,NULL,'cliente','Hernesto_garmendia@gmail.com','luis1234',37,NULL),(5,'Jose','Lopez',NULL,NULL,'cliente','Jose_Lopez@gmail.com','luis1234',36,NULL),(6,'Gonzalo','Miguel',NULL,NULL,'gerente','Gonza@gmail.com','pepe1234',29,NULL),(7,'Sebastian','Miguel',NULL,NULL,'gerente','Seba@gmail.com','pepe1234',24,NULL),(8,'Adan','Smith',NULL,NULL,'profesor','adan_@gmail.com','pepe1234',29,NULL),(9,'Florencia','Mendez',NULL,NULL,'profesor','florencia_mendez@gmail.com','pepe1234',23,NULL),(10,'Noriss','Stive',NULL,NULL,'cliente','noriss_stive@hotmail.com','pepe1234',28,NULL),(12,'Noriss','Stive',NULL,NULL,'cliente','noriss_tive@hotmail.com','pepe1234',28,NULL),(13,'no','on',NULL,NULL,'cliente','ese@hotmail.com','1234',28,NULL),(14,'bo','on',NULL,NULL,'cliente','luissss8@hotmail.com','1234',57,NULL),(15,'no','on',NULL,NULL,'cliente','luissss8ewewewe@hotmail.com','1234',57,NULL),(16,'no','on',NULL,NULL,'cliente','luissss8ewweweqeqqewewe@hotmail.com','1234',57,NULL),(17,'no ','sirve',NULL,NULL,'cliente','ese2@gmail.com','1234',88,NULL),(18,'no','srive',NULL,NULL,'cliente','ese3@hotmail.com','1234',20,NULL),(19,'Luis','Nelson',NULL,NULL,'cliente','luisnelson@hotmail.com','1234',32,NULL),(20,'martin','moris',NULL,NULL,'cliente','martin@hotmail.com','1234',21,NULL),(21,'Noriss','Stive',NULL,NULL,'cliente','noris_tive@hotmail.com','pepe1234',28,NULL),(22,'no','sirve',NULL,NULL,'cliente','ese4@hotmail.com','1234',28,NULL),(23,'Steve','Jobs',NULL,NULL,'cliente','SteveJobs@gmail.com','$2y$12$bLT25jwHcOdF/NytjRMcHuUNaEmCS1MmmmfOSTwYeTV8eRterjMU.',26,NULL);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_permitido`
--

DROP TABLE IF EXISTS `rol_permitido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol_permitido` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `rol_permitidos` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_permitido`
--

LOCK TABLES `rol_permitido` WRITE;
/*!40000 ALTER TABLE `rol_permitido` DISABLE KEYS */;
INSERT INTO `rol_permitido` VALUES (1,'cliente'),(3,'gerente'),(2,'profesor');
/*!40000 ALTER TABLE `rol_permitido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('tmCLwjHiAHCXMuA3aDZtfuiv2n7dTCbGlIjj1gBX',23,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoienFDYmY3QzhvQ3d3NGMyN1RidG1La1BTZUN4U3ZrcnNqSWQ4M3BacyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lL2Nvb2tpbmcvbWVudSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIzO30=',1752584679);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soported_extension`
--

DROP TABLE IF EXISTS `soported_extension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soported_extension` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soported_extension`
--

LOCK TABLES `soported_extension` WRITE;
/*!40000 ALTER TABLE `soported_extension` DISABLE KEYS */;
INSERT INTO `soported_extension` VALUES (1,'jpeg'),(2,'jpg'),(4,'not found'),(3,'png');
/*!40000 ALTER TABLE `soported_extension` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `title_items`
--

DROP TABLE IF EXISTS `title_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `title_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `letter` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`letter`),
  UNIQUE KEY `letter` (`letter`),
  CONSTRAINT `title_items_ibfk_1` FOREIGN KEY (`letter`) REFERENCES `menu_category_item` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `title_items`
--

LOCK TABLES `title_items` WRITE;
/*!40000 ALTER TABLE `title_items` DISABLE KEYS */;
INSERT INTO `title_items` VALUES (1,'Lunch Menu','Sunday-Friday 11:15am-3:00pm. Served with your choice of rice (Vegetable Fried RIce, Steamed Rice, Brown Rice), AND EITHER soup (Hot & Sour, Wonton, Vegetable, Egg Drop, Chicken Corn Soup) OR veggie egg roll.','L'),(2,'Soup Menu','','A'),(3,'Appetizers Menu','','B'),(4,'Chef\'s Recommendations Menu','','SP'),(5,'Chicken Menu','','C'),(6,'Beef Menu','','F'),(7,'Veal Menu','','V'),(8,'Duck Menu','','DK'),(9,'Vegetables Menu','','VG'),(10,'Curry Menu','','CU'),(11,'Noodles (Lo Mein) Menu','','NL'),(12,'Mei Fan (Very Fine Noodles) Menu','','NF'),(13,'Pan Fried Noodles Menu','','PF'),(14,'Fried Rice Menu','','FR'),(15,'Chow Mein Menu','','CM'),(16,'Egg Foo Young Menu','','FY'),(17,'Side Orders Menu','','SO'),(18,'Desserts Menu','','DS'),(19,'Dinner Combo Menu','Served with your choice of rice (Vegetable Fried RIce, Steamed Rice, Brown Rice), AND EITHER soup (Hot & Sour, Wonton, Vegetable, Egg Drop, Chicken Corn Soup) OR veggie egg roll.','D'),(20,'Sushi Menu Menu','Contains raw ingredients. Consuming raw or undercooked meat, poultry, or seafood may increase your risk of food borne illness.','SR');
/*!40000 ALTER TABLE `title_items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-15 10:13:56
