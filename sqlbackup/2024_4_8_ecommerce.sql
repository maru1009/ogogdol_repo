-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `Cart_ID` int NOT NULL AUTO_INCREMENT,
  `Cus_ID` int DEFAULT NULL,
  `Prod_ID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  PRIMARY KEY (`Cart_ID`),
  KEY `fk_customer_cart` (`Cus_ID`),
  KEY `fk_product_cart` (`Prod_ID`),
  CONSTRAINT `fk_customer_cart` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`),
  CONSTRAINT `fk_product_cart` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `Cat_ID` int NOT NULL AUTO_INCREMENT,
  `Cat_name` varchar(50) NOT NULL,
  `Parent_Cat_ID` int DEFAULT NULL,
  PRIMARY KEY (`Cat_ID`),
  KEY `fk__category` (`Parent_Cat_ID`),
  CONSTRAINT `fk__category` FOREIGN KEY (`Parent_Cat_ID`) REFERENCES `category` (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `Cus_ID` int NOT NULL AUTO_INCREMENT,
  `cus_first_name` varchar(50) DEFAULT NULL,
  `cus_last_name` varchar(50) DEFAULT NULL,
  `Cus_email` varchar(100) NOT NULL,
  `Cus_pass` varchar(100) NOT NULL,
  `pass_salt` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Cus_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'asd','ads','test@gmail.com','7ea2673456b2beda0a98e52ff036a26b052616939131791063a50bcd9ca75e40','660585122a196',0,NULL,NULL),(2,'das','asd','forctf0@gmail.com','867a0d4b9138b99358a4ff7a622ac391150f8f2e85d612598abfea6b10dd1c01','66081428519fb',1,NULL,NULL);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_history` (
  `Order_Hist_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int DEFAULT NULL,
  `Cus_ID` int DEFAULT NULL,
  `Prod_ID` int DEFAULT NULL,
  `Order_date` date DEFAULT NULL,
  `Total_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Order_Hist_ID`),
  KEY `fk_order_orderHistoy` (`Order_ID`),
  KEY `fk_customer_orderHistoy` (`Cus_ID`),
  KEY `fk_product_orderHistoy` (`Prod_ID`),
  CONSTRAINT `fk_customer_orderHistoy` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`),
  CONSTRAINT `fk_order_orderHistoy` FOREIGN KEY (`Order_ID`) REFERENCES `orders` (`Ord_ID`),
  CONSTRAINT `fk_product_orderHistoy` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_history`
--

LOCK TABLES `order_history` WRITE;
/*!40000 ALTER TABLE `order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item` (
  `Item_id` int NOT NULL AUTO_INCREMENT,
  `Ord_ID` int DEFAULT NULL,
  `Prod_ID` int DEFAULT NULL,
  `Item_quan` int DEFAULT '0',
  `Item_price` decimal(7,2) NOT NULL,
  PRIMARY KEY (`Item_id`),
  KEY `fk_order` (`Ord_ID`),
  KEY `fk_product` (`Prod_ID`),
  CONSTRAINT `fk_order` FOREIGN KEY (`Ord_ID`) REFERENCES `orders` (`Ord_ID`),
  CONSTRAINT `fk_product` FOREIGN KEY (`Prod_ID`) REFERENCES `product` (`Prod_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `Ord_ID` int NOT NULL AUTO_INCREMENT,
  `Ord_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_price` decimal(10,2) DEFAULT NULL,
  `Cus_ID` int DEFAULT NULL,
  `Pay_ID` int DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Ord_ID`),
  KEY `fk_cus` (`Cus_ID`),
  KEY `fk_pay` (`Pay_ID`),
  CONSTRAINT `fk_cus` FOREIGN KEY (`Cus_ID`) REFERENCES `payment` (`Pay_ID`),
  CONSTRAINT `fk_pay` FOREIGN KEY (`Pay_ID`) REFERENCES `payment` (`Pay_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `Pay_ID` int NOT NULL AUTO_INCREMENT,
  `Pay_date` datetime DEFAULT NULL,
  `Pay_method` varchar(10) NOT NULL,
  `Pay_amount` decimal(10,2) NOT NULL,
  `Pay_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Pay_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `Prod_ID` int NOT NULL AUTO_INCREMENT,
  `Prod_Name` varchar(100) NOT NULL,
  `Prod_description` text,
  `Prod_quan` int DEFAULT '0',
  `Prod_Cost` decimal(10,2) NOT NULL,
  `Prod_img` varchar(25) DEFAULT NULL,
  `Cat_ID` int DEFAULT NULL,
  PRIMARY KEY (`Prod_ID`),
  KEY `fk_product_category` (`Cat_ID`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Air Force 1','Air Force 1 white',15,200000.00,'1_product.webp',NULL),(2,'TMNT x Adidas','TNMT Special Edition ',20,300000.00,'2_product.webp',NULL),(3,'Jordan Retro 3','Retro edition',50,250000.00,'3_product.webp',NULL),(4,'New Balance 327','New Balance 327 Beige',25,199999.00,'4_product.webp',NULL),(5,'All-Pro NITRO Marcus','All-Pro NITRO Marcus Basketball Shoes',35,150000.00,'5_product.webp',NULL),(6,'adidas AE 1','adidas AE 1 men',25,169999.00,'6_product.webp',NULL),(7,'PUMA x Easy Rider','PUMA x Easy Rider 123',10,500000.00,'7_product.webp',NULL),(8,'Nike Zoom Lebron IV','Nike Zoom Lebron IV 123',15,450000.00,'8_product.webp',NULL),(9,'AIR MAX','AIR MAX 1 86 OG BIG BUBBLE',10,144444.00,'9_product.jpg',NULL),(10,'AIR MAX 180','AIR MAX 180 ULTRAMARINE 2018',23,155555.00,'10_product.jpg',NULL),(11,'AIR JORDAN 9 RETRO','AIR JORDAN 9 RETRO POWDER BLUE 2024',12,265000.00,'11_product.jpg',NULL),(12,'AIR JORDAN 1 RETRO HIGH OG','AIR JORDAN 1 RETRO HIGH OG CRAFT - IVORY',23,123000.00,'12_product.jpg',NULL),(13,'RAYSSA LEAL X DUNK LOW SB','RAYSSA LEAL X DUNK LOW SB Limited edition',51,191919.00,'13_product.jpg',NULL),(14,'DUNK LOW RETRO','DUNK LOW RETRO VOL. 1 SP PLUM 2024',21,304034.00,'14_product.jpg',NULL),(15,'AIR JORDAN 5 RETRO','AIR JORDAN 5 RETRO OLIVE 2024\r\n',20,140000.00,'15_product.jpg',NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipment` (
  `ship_id` int NOT NULL AUTO_INCREMENT,
  `ship_addr` varchar(100) NOT NULL,
  `Cus_contact` varchar(25) NOT NULL,
  `prod_id` int DEFAULT NULL,
  `Cus_id` int DEFAULT NULL,
  PRIMARY KEY (`ship_id`),
  KEY `fk_product_shipment` (`prod_id`),
  KEY `fk_customer_shipment` (`Cus_id`),
  CONSTRAINT `fk_customer_shipment` FOREIGN KEY (`Cus_id`) REFERENCES `customer` (`Cus_ID`),
  CONSTRAINT `fk_product_shipment` FOREIGN KEY (`prod_id`) REFERENCES `product` (`Prod_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-08 12:45:28
