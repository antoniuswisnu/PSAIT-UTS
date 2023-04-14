/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.22-MariaDB : Database - sait_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sait_db_uts` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sait_db_uts`;

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(40) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

insert  into `mahasiswa`(`nim`,`nama`,`alamat`,`tanggal_lahir`) values 
('sv_001','joko','bantul', '1999-12-07'),
('sv_002','paul','sleman', '2000-10-07'),
('sv_003','andy','surabaya', '2000-02-09');

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah`(
  `kode_mk` varchar(10) DEFAULT NULL,
  `nama_mk` varchar(20) DEFAULT NULL,
  `sks` int(2) DEFAULT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

insert into `matakuliah`(`kode_mk`,`nama_mk`,`sks`) values
('svpl_001','database',2),
('svpl_002','kecerdasan artifisial',2),
('svpl_003','interoperabilitas',2);

drop table if exists `perkuliahan`;

CREATE TABLE `perkuliahan`(
  `id_perkuliahan` int(5) NOT NULL AUTO_INCREMENT,
  `nim` varchar(10) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nilai` int(3) NOT NULL,
  PRIMARY KEY (`id_perkuliahan`),
  FOREIGN KEY (`nim`) REFERENCES `mahasiswa`(`nim`),
  FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah`(`kode_mk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mahasiswa` */

insert into `perkuliahan`(`id_perkuliahan`,`nim`,`kode_mk`,`nilai`) values
(1,'sv_001','svpl_001',90),
(2,'sv_001','svpl_002',87),
(3,'sv_001','svpl_003',88),
(4,'sv_002','svpl_001',98),
(5,'sv_002','svpl_002',77);

-- Join 3 Table

-- select mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
-- from mahasiswa
-- join perkuliahan on mahasiswa.nim = perkuliahan.nim
-- join matakuliah on matakuliah.kode_mk = perkuliahan.kode_mk;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
