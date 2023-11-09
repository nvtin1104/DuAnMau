-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: bookshop
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_items`
--

LOCK TABLES `cart_items` WRITE;
/*!40000 ALTER TABLE `cart_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `label_group`
--

DROP TABLE IF EXISTS `label_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `label_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `label_group`
--

LOCK TABLES `label_group` WRITE;
/*!40000 ALTER TABLE `label_group` DISABLE KEYS */;
INSERT INTO `label_group` VALUES (4,'Sách tham khảo toán','2023-09-22 14:30:26'),(5,'Truyện tranh','2023-09-22 14:37:07'),(6,'văn vở ','2023-09-22 15:19:04'),(9,'Truyện Manga','2023-09-24 15:29:35'),(12,'Sale','2023-09-28 12:28:39'),(13,'Giáo Khoa - Tham Khảo','2023-09-30 00:24:40');
/*!40000 ALTER TABLE `label_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_group` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_group` (`id_group`),
  CONSTRAINT `fk_group` FOREIGN KEY (`id_group`) REFERENCES `label_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labels`
--

LOCK TABLES `labels` WRITE;
/*!40000 ALTER TABLE `labels` DISABLE KEYS */;
INSERT INTO `labels` VALUES (16,'sach van','2023-09-28 04:28:57',4),(17,'sach van','2023-09-28 04:29:30',4),(18,'sach van hoc ','2023-09-28 05:00:19',4),(19,'Sach tham khao lop 1','2023-09-28 19:40:09',4),(20,'Sach tham khao lop 2','2023-09-28 19:40:14',4),(21,'Sach tham khao lop 1','2023-09-28 19:41:45',4),(22,'dasd','2023-09-28 19:41:55',4),(23,'Sach 1','2023-09-28 19:54:05',4),(24,'134','2023-09-28 19:59:44',4),(25,'&#9;Sach tham khao lop 1','2023-09-28 19:59:52',5),(26,'&#9;Sach tham khao lop 1','2023-09-28 19:59:56',9),(27,'&#9;Sach tham khao lop 1','2023-09-28 20:00:04',9),(28,'Hot-sale','2023-09-29 21:02:30',12),(29,'New','2023-09-29 21:02:49',12),(30,'Giáo khoa lớp 1','2023-09-30 07:25:04',13);
/*!40000 ALTER TABLE `labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_code` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_price` decimal(10,2) unsigned NOT NULL,
  `phone` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `payment` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_code_UNIQUE` (`order_code`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_list` (
  `id` int unsigned NOT NULL,
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `total_price` decimal(10,2) unsigned NOT NULL,
  `quantity` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_oder` (`order_id`),
  CONSTRAINT `fk_oder` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_list`
--

LOCK TABLES `order_list` WRITE;
/*!40000 ALTER TABLE `order_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_img`
--

DROP TABLE IF EXISTS `product_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_img` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `img_dir` varchar(150) COLLATE utf8mb3_unicode_ci NOT NULL,
  `alt` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `link` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product` (`product_id`),
  CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_img`
--

LOCK TABLES `product_img` WRITE;
/*!40000 ALTER TABLE `product_img` DISABLE KEYS */;
INSERT INTO `product_img` VALUES (24,28,'./uploads/3300000015880-1_1_1.jpg',NULL,NULL),(25,28,'./uploads/3300000015880-1_1_1-Copy.jpg',NULL,NULL),(26,28,'./uploads/3300000015880-1_1_1-Copy(1).jpg',NULL,NULL),(27,28,'./uploads/3300000015880-1_1_1-Copy(2).jpg',NULL,NULL);
/*!40000 ALTER TABLE `product_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) unsigned NOT NULL,
  `new_price` decimal(10,2) unsigned DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `quantity` int unsigned NOT NULL,
  `policy` varchar(14) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `made_in` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `form` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `specification` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sale` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'true',
  `label` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (28,'Sách Giáo Khoa Bộ Lớp 1 - Cánh Diều - Sách Bài Tập (Bộ 11 Cuốn) (2023)','2023-09-30 00:29:06',134000.00,NULL,1,'2023-09-30 07:29:06','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc',1000,'true','Đại Học Sư Phạm TPHCM','Nhiều Tác Giả','Bìa Mềm','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc s','false','sach van, sach van, sach van hoc , Sach tham khao lop 1, Sach tham khao lop 2, Sach tham khao lop 1, dasd, Sach 1, 134'),(29,'Sách Giáo Khoa Bộ Lớp 1 - Cánh Diều - Sách Bài Tập (Bộ 11 Cuốn) (2023)','2023-09-30 01:35:26',134000.00,NULL,1,'2023-09-30 08:35:26','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc',100,'true','Đại Học Sư Phạm TPHCM','Nhiều Tác Giả','Bìa Mềm','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','false',''),(30,'Sách Giáo Khoa Bộ Lớp 1 - Cánh Diều - Sách Bài Tập (Bộ 11 Cuốn) (2023)','2023-09-30 01:37:16',134000.00,NULL,1,'2023-09-30 08:37:16','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc',100,'true','Đại Học Sư Phạm TPHCM','Nhiều Tác Giả','Bìa Mềm','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','false',''),(31,'Sách Giáo Khoa Bộ Lớp 1 - Cánh Diều - Sách Bài Tập (Bộ 11 Cuốn) (2023)','2023-09-30 01:38:03',134000.00,NULL,1,'2023-09-30 08:38:03','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc',100,'true','Đại Học Sư Phạm TPHCM','Nhiều Tác Giả','Bìa Mềm','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','Giá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...&#13;&#10;Chính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc','false','');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'active',
  `phone` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Khach hang',
  `sex` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Nam',
  `address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'adminroot','bguyt46@gmail.com','taokobitla123','2023-09-20 13:43:35','2023-09-20 13:43:35','admin','active',NULL,'Nguyễn Văn Tín','Nam',NULL,NULL),(2,'thai','thai123@gmail.com','$2y$10$qZn9glA8z0NurvCSsEWif.X7kxHfWu8fuXkk5ZzXNrdERs1KOZQ2C','2023-09-21 02:37:07','2023-09-21 02:37:07','user','active',NULL,'Khach hang','Nam',NULL,NULL),(3,'thai2','thai1d23@gmail.com','$2y$10$15P4EOG5uENohUFAb6l1E.jE3e4qFv9maJGmgA1FjIlUlgmwWSQ7i','2023-09-21 02:59:31','2023-09-21 02:59:31','user','active',NULL,'Khach hang','Nam',NULL,NULL),(4,'nvtin1104','nvtin1104@gmail.com','$2y$10$t/IHz9ERNsWBPwczajwLG.K83fo/Saj6qxVUvEz7mHQ.l.oMwb/7u','2023-09-21 03:28:39','2023-09-21 03:28:39','user','active',NULL,'Nguyen Van Tin','',NULL,'2023-09-21'),(7,'admin','ga@mgail.com','$2y$10$1xwltJxZ1J9Pc34M6JtBeeB69mdD9mCH61yKZY/tuzKC7tvW6zzju','2023-09-21 07:28:35','2023-09-21 07:28:35','user','active',NULL,'Khach hang','Nam',NULL,NULL),(8,'tintest','2@gmail.com','$2y$10$iTlh/JZwL36h20hejaXpduk7ggpqbIi9dXC9y.410mEDc0GLevY7y','2023-09-21 08:04:30','2023-09-21 08:04:30','user','active',NULL,'Khach hang','Nam',NULL,NULL),(9,'thaitest','nguyenngocthai2332003@gmail.com','$2y$10$rVmPm4FxKHKFr3FVdpzuNO.O7yOAmL10YBEZngghztN5TjQhF84vi','2023-09-21 10:33:53','2023-09-21 10:33:53','user','active',NULL,'Khach hang','Nam',NULL,NULL),(10,'thai1','nguyenngocthai23302003@gmail.com','$2y$10$QjkFFNl22NtCdUlFuZBeVOWNWRCEKJPoA6z1xD/uPrxfH6hgV9LbS','2023-09-22 12:20:10','2023-09-22 12:20:10','user','active',NULL,'Thái xa lem','',NULL,'2004-03-23'),(11,'melax','thainnpk03331@fpt.edu.vn','$2y$10$U8wf7X86YTR5z4ZvMQ1FwevXHBw/MmQdpV8at.D8ulIf2fRREa0ou','2023-09-22 12:36:40','2023-09-22 12:36:40','user','active',NULL,'thai xa lem','',NULL,'1990-12-11'),(12,'huydeptrai','phamtrangiahuy2004@gmail.com','$2y$10$rkjssVaf/5x/4txbyErbRux68HWc5o/MxsJMctZDhoKaFTV1bErxe','2023-09-22 12:53:25','2023-09-22 12:53:25','user','active',NULL,'huy đẹp trai vãi òn','',NULL,'2004-09-08'),(13,'tin114','ti@gmail.com','$2y$10$lffX4FBow69pRkMoqZ7h8.4sAdHduK3zpJd7/HZUZQUZX6L2LeaX6','2023-09-24 15:54:20','2023-09-24 15:54:20','user','active',NULL,'Khach hang','Nam',NULL,NULL),(14,'dangnhap123','dangnhap@gmail.com','$2y$10$TBromlIPj/TwqztOv4DXhevMW/dDXj58Ir1RJn/xSLVIdEyxbR/TG','2023-09-25 01:48:24','2023-09-25 01:48:24','user','active',NULL,'Khach hang','Nam',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voucher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `voucher_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `voucher_code` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voucher`
--

LOCK TABLES `voucher` WRITE;
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'bookshop'
--

--
-- Dumping routines for database 'bookshop'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-30  9:47:08
