-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: db_eprekursor
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `tbl_cabperusahaan`
--

DROP TABLE IF EXISTS `tbl_cabperusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cabperusahaan` (
  `id_cabperusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_perusahaan` int(11) NOT NULL,
  `nama_cabperusahaan` varchar(100) NOT NULL,
  `alamat_cabperusahaan` varchar(255) NOT NULL,
  `nomor_telp_cabperusahaan` varchar(12) NOT NULL,
  PRIMARY KEY (`id_cabperusahaan`),
  KEY `perusahaanUpload` (`id_perusahaan`),
  CONSTRAINT `id_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `tbl_perusahaan` (`id_perusahaan`),
  CONSTRAINT `perusahaanUpload` FOREIGN KEY (`id_perusahaan`) REFERENCES `tbl_perusahaan` (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cabperusahaan`
--

LOCK TABLES `tbl_cabperusahaan` WRITE;
/*!40000 ALTER TABLE `tbl_cabperusahaan` DISABLE KEYS */;
INSERT INTO `tbl_cabperusahaan` VALUES (1,1,'Orvamedia','Orvamedia','12345678'),(3,2,'Orvamedia','ffadads','12345678');
/*!40000 ALTER TABLE `tbl_cabperusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jenis_user`
--

DROP TABLE IF EXISTS `tbl_jenis_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jenis_user` (
  `id_jenis_user` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jenis_user`
--

LOCK TABLES `tbl_jenis_user` WRITE;
/*!40000 ALTER TABLE `tbl_jenis_user` DISABLE KEYS */;
INSERT INTO `tbl_jenis_user` VALUES (1,'Admin'),(2,'Kepala Subbid'),(3,'Importir'),(4,'Exportir');
/*!40000 ALTER TABLE `tbl_jenis_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_login` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username_login` varchar(255) NOT NULL,
  `password_login` varchar(255) NOT NULL,
  `id_jenis_user` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `status_user` enum('aktif','menunggu') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_login`
--

LOCK TABLES `tbl_login` WRITE;
/*!40000 ALTER TABLE `tbl_login` DISABLE KEYS */;
INSERT INTO `tbl_login` VALUES (1,'test','test',1,'2017-12-03 00:00:00','aktif'),(2,'jokoganteng','jokoganteng',3,NULL,'aktif'),(4,'OrvamediaOrvamedia','Orvamedia',3,NULL,'menunggu');
/*!40000 ALTER TABLE `tbl_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pegawai`
--

DROP TABLE IF EXISTS `tbl_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pegawai` (
  `nip` char(18) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `alamat_pegawai` varchar(255) NOT NULL,
  `email_pegawai` varchar(100) NOT NULL,
  `telp_pegawai` varchar(12) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`nip`),
  KEY `pegawailogin` (`id_user`),
  CONSTRAINT `pegawailogin` FOREIGN KEY (`id_user`) REFERENCES `tbl_login` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pegawai`
--

LOCK TABLES `tbl_pegawai` WRITE;
/*!40000 ALTER TABLE `tbl_pegawai` DISABLE KEYS */;
INSERT INTO `tbl_pegawai` VALUES ('196012261989031004','Orvamedia','Orvamedia','orvamedia@gmail.com','08192391',1);
/*!40000 ALTER TABLE `tbl_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perrekomendasi`
--

DROP TABLE IF EXISTS `tbl_perrekomendasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perrekomendasi` (
  `id_perrekomendasi` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_prekursor` enum('exportir','importir') NOT NULL,
  `negara_asal` varchar(100) NOT NULL,
  `negara_tujuan` varchar(255) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `pelabuhan_tujuan` varchar(255) NOT NULL,
  `jumlah_berat` int(11) NOT NULL,
  `berkas_perrekomendasi` text NOT NULL,
  `status_perrekomendasi` enum('Ditolak','Diterima','menunggu') NOT NULL,
  `nama_perusahaan_asal` varchar(255) NOT NULL,
  `tanggalberkasupload` date NOT NULL,
  PRIMARY KEY (`id_perrekomendasi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perrekomendasi`
--

LOCK TABLES `tbl_perrekomendasi` WRITE;
/*!40000 ALTER TABLE `tbl_perrekomendasi` DISABLE KEYS */;
INSERT INTO `tbl_perrekomendasi` VALUES (5,'importir','Afrika','Indonesia',2,'Tanjung Priok',120,'old_amikom_ac_id_index1.pdf','menunggu','PT. Freeport','2017-12-05'),(6,'importir','Afrika','Indonesia',2,'Tanjung Priok',120,'old_amikom_ac_id_index2.pdf','menunggu','PT. Freeport','2017-12-05');
/*!40000 ALTER TABLE `tbl_perrekomendasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perusahaan`
--

DROP TABLE IF EXISTS `tbl_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(255) NOT NULL,
  `bidang_usaha` varchar(255) NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL,
  `nomor_siup` varchar(50) NOT NULL,
  `nomor_apiu` varchar(50) NOT NULL,
  `nomor_tdp` char(12) NOT NULL,
  `npwp` char(19) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `kota_perusahaan` varchar(100) NOT NULL,
  `kode_pos_perusahaan` char(5) NOT NULL,
  `email_perusahaan` varchar(255) NOT NULL,
  `telepon_perusahaan` varchar(12) NOT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_perusahaan`),
  KEY `provinsiPerusahaan` (`id_provinsi`),
  KEY `userLogin` (`id_user`),
  CONSTRAINT `provinsiPerusahaan` FOREIGN KEY (`id_provinsi`) REFERENCES `tbl_provinsi` (`id_provinsi`),
  CONSTRAINT `userLogin` FOREIGN KEY (`id_user`) REFERENCES `tbl_login` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perusahaan`
--

LOCK TABLES `tbl_perusahaan` WRITE;
/*!40000 ALTER TABLE `tbl_perusahaan` DISABLE KEYS */;
INSERT INTO `tbl_perusahaan` VALUES (1,'Orvamedia','Orvamedia','Orvamedia','Orvamedia','Orvamedia','Orvamedia','Orvamedia','Orvamedia','Orvamedia',31,'Orvamedia','55123','Orvamedia','Orvamedia','2017-12-06',1),(2,'Orvamedia22','Orvamedia','Orvamedia','Orvamedia','12345678','12345678','12345678','12345678','Orvamedia',52,'Orvamedia','44832','muhammad30hidaya696@gmail.com','081949162028','2017-12-07',4);
/*!40000 ALTER TABLE `tbl_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_provinsi`
--

DROP TABLE IF EXISTS `tbl_provinsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_provinsi`
--

LOCK TABLES `tbl_provinsi` WRITE;
/*!40000 ALTER TABLE `tbl_provinsi` DISABLE KEYS */;
INSERT INTO `tbl_provinsi` VALUES (11,'Aceh'),(12,'Sumater Utara'),(13,'Sumater Barat'),(14,'Riau'),(15,'Jambi'),(16,'Sumatera Selatan'),(17,'Bengkulu'),(18,'Lampung'),(19,'Kepulauan Bangka Belitung'),(21,'Kepulauan Riau'),(31,'DKI Jakarta'),(32,'Jawa Barat'),(33,'Jawa Tengah'),(34,'DI Yogyakarta'),(35,'Jawa Timur'),(36,'Banten'),(51,'Bali'),(52,'Nusa Tenggara Barat'),(53,'Nusa Tenggara Timur'),(61,'Kalimantan Barat'),(62,'Kalimantan Tengah'),(63,'Kalimantan Selatan'),(64,'Kalimantan Timur'),(65,'Kalimantan Utara'),(71,'Sulawesi Utara'),(72,'Sulawesi Tengah'),(73,'Sulawesi Selatan'),(74,'Sulawesi Tenggara'),(75,'Gorontalo'),(76,'Sulawesi Barat'),(81,'Maluku'),(82,'Maluku Utara'),(91,'Papua'),(92,'Papua Barat');
/*!40000 ALTER TABLE `tbl_provinsi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-05 22:03:47
