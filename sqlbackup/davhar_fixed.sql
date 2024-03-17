-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: bd
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
  `Cus_Name` varchar(50) NOT NULL,
  `Cus_email` varchar(100) NOT NULL,
  `Cus_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`Cus_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
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
  `Cat_ID` int DEFAULT NULL,
  PRIMARY KEY (`Prod_ID`),
  KEY `fk_product_category` (`Cat_ID`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
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

-- Dump completed on 2024-03-17 22:19:36
