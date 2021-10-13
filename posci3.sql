-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`id_customer`, `nama_customer`, `jenis_kelamin`, `telp`, `alamat`, `created`, `updated`) VALUES
(1,	'Mas Roni',	'L',	'081293738292',	'Boyolali',	1590167565,	0),
(2,	'Eva F',	'P',	'081293738292',	'Bandung',	1590167601,	0),
(6,	'Sigit',	'L',	'08129519047',	'Bandung',	0,	0),
(8,	'Joko P',	'L',	'08129519047',	'Boyolali',	0,	0),
(9,	'Ana F',	'P',	'08129519047',	'Bandung',	0,	0),
(10,	'Tomi',	'L',	'08129519047',	'Purwakarta',	0,	0),
(11,	'Aman A',	'L',	'1234',	'Solo',	0,	0),
(12,	'Basir',	'L',	'1234',	'Bandung',	0,	0),
(13,	'Novi A',	'P',	'1234',	'Boyolali',	0,	0),
(14,	'Aila P',	'P',	'2111',	'Bandung',	0,	0),
(15,	'Yunita F',	'P',	'08129519047',	'Boyolali',	0,	0),
(17,	'Topo S',	'L',	'1234',	'Boyolali',	0,	0),
(18,	'Umum',	'L',	'0',	'',	0,	0);

DROP TABLE IF EXISTS `detail_transaksi_penjualan`;
CREATE TABLE `detail_transaksi_penjualan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `diskon_item` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_item` (`id_item`),
  CONSTRAINT `detail_transaksi_penjualan_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_transaksi_penjualan` (`id_detail`, `id_penjualan`, `id_item`, `harga`, `qty`, `diskon_item`, `total`) VALUES
(43,	46,	11,	5000,	2,	500,	9000),
(44,	46,	12,	5000,	3,	0,	15000),
(45,	46,	14,	2000,	2,	0,	4000);

DELIMITER ;;

CREATE TRIGGER `update_stok` AFTER INSERT ON `detail_transaksi_penjualan` FOR EACH ROW
BEGIN
	UPDATE item SET stok = stok - NEW.qty
    WHERE id_item = NEW.id_item;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(100) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created` int(11) NOT NULL,
  `updated` int(11) DEFAULT 0,
  PRIMARY KEY (`id_item`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_unit` (`id_unit`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  CONSTRAINT `item_ibfk_2` FOREIGN KEY (`id_unit`) REFERENCES `unit` (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `item` (`id_item`, `barcode`, `nama_item`, `id_kategori`, `id_unit`, `harga`, `stok`, `created`, `updated`) VALUES
(11,	'A0001',	'Teh Botol Sosro',	2,	2,	5000,	1,	1590383064,	1590383716),
(12,	'A0002',	'Supermi',	1,	8,	5000,	6,	1590383690,	1590383732),
(14,	'A0003',	'Paramex',	6,	8,	2000,	4,	1590383835,	1590383940),
(15,	'A0004',	'Bodrex',	6,	8,	2000,	0,	1590383850,	0),
(16,	'A0005',	'Minyak Goreng',	1,	5,	10000,	0,	1590383873,	0),
(17,	'A0006',	'Roti Kelapa',	1,	4,	10000,	0,	1590383913,	0),
(18,	'A0007',	'Mie Sedap Rebus',	1,	8,	2000,	0,	1590383997,	0),
(19,	'A0008',	'Mie Sedap Goreng',	1,	8,	2000,	0,	1590384014,	0),
(20,	'A0009',	'Sprit',	2,	2,	5000,	0,	1590384033,	0),
(21,	'A0010',	'Fanta Orange',	2,	2,	5000,	0,	1590384055,	0),
(22,	'A0011',	'Kulkas 2 Pintu',	3,	4,	1000000,	0,	1590384089,	0);

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created`, `updated`) VALUES
(1,	'Makanan',	1590218991,	1590253307),
(2,	'Minuman',	1590218991,	1590253317),
(3,	'Elektronik',	1590219854,	1590253381),
(6,	'Obat',	1590252855,	1590253387);

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `diskon_item` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_keranjang`),
  KEY `id_item` (`id_item`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(50) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total_akhir` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_customer` (`id_customer`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `penjualan` (`id_penjualan`, `invoice`, `id_customer`, `total_harga`, `diskon`, `total_akhir`, `cash`, `kembalian`, `catatan`, `tanggal`, `id_user`, `created`, `updated`) VALUES
(46,	'AT2005270001',	0,	28000,	3000,	25000,	50000,	25000,	'lunas',	'2020-05-27',	1,	1590550813,	0);

DROP TABLE IF EXISTS `stok`;
CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_stok`),
  KEY `id_item` (`id_item`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`),
  CONSTRAINT `stok_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stok` (`id_stok`, `id_item`, `type`, `detail`, `id_supplier`, `qty`, `tanggal`, `id_user`, `created`, `updated`) VALUES
(58,	11,	'in',	'kulakan',	1,	10,	'2020-05-26',	1,	1590499946,	0),
(59,	12,	'in',	'kulakan',	1,	20,	'2020-05-26',	1,	1590502046,	0),
(60,	14,	'in',	'kulakan',	2,	10,	'2020-05-27',	1,	1590540362,	0);

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `telp`, `alamat`, `keterangan`, `created`, `updated`) VALUES
(1,	'Toko A',	'08129519047',	'Jl. Bandung Raya',	'Supplier Pakaian',	1590157482,	1590254460),
(2,	'Toko B',	'081293738292',	'Jl. Jakarta',	'Supplier Makanan',	1590157532,	1590382154),
(8,	'Toko C',	'08129519047',	'Boyolali',	'Supplier Elektronik',	0,	1590382160),
(10,	'Toko Jaya',	'08129519047',	'Boyolali',	'Umum',	0,	0);

DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(100) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `unit` (`id_unit`, `nama_unit`, `created`, `updated`) VALUES
(2,	'Botol',	1590218991,	1590253459),
(4,	'Box',	1590220325,	1590253464),
(5,	'Kilogram',	1590237222,	1590253472),
(8,	'Pcs',	1590295890,	0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin, 2:kasir',
  `created` int(11) NOT NULL,
  `updated` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `level`, `created`, `updated`) VALUES
(1,	'admin',	'$2y$10$BCowPS45JNQmu54JabwRAeQ89yNth5qCM9gOUjCIU9ZaR32nSWFxe',	'Mas Roni',	'Bandung',	1,	1590070286,	1590151696),
(2,	'kasir',	'$2y$10$cwQ.ZLT9lprDaV7Y5d/li.mCIP4imkLgHdMIs0qR9nLgMeyRU2c7C',	'Kasir',	'boyolali',	2,	1590070320,	1590166906),
(4,	'aman',	'$2y$10$ErUOXDluZjh70lIjk5rMfuyRktLa1xwIydess.lAOH0cPDJ7hrnyC',	'aman a',	'purwakarta',	2,	1590382656,	NULL);

-- 2021-10-13 13:58:53
