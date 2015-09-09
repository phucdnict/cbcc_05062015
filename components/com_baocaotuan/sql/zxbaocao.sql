/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : cbcc_local

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-08-03 10:27:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zxbaocao
-- ----------------------------
DROP TABLE IF EXISTS `zxbaocao`;
CREATE TABLE `zxbaocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trangthai` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `batdau` date DEFAULT NULL,
  `ketthuc` date DEFAULT NULL,
  `dophuctap` int(255) DEFAULT NULL,
  `ykiendexuat` varchar(255) DEFAULT NULL,
  `hai` int(255) DEFAULT NULL,
  `ba` int(255) DEFAULT NULL,
  `tu` int(255) DEFAULT NULL,
  `nam` int(255) DEFAULT NULL,
  `sau` int(255) DEFAULT NULL,
  `bay` int(255) DEFAULT NULL,
  `hoanthanh` int(255) DEFAULT NULL,
  `maduan` varchar(255) DEFAULT NULL,
  `tenduan` varchar(255) DEFAULT NULL,
  `congviec` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zxduan
-- ----------------------------
DROP TABLE IF EXISTS `zxduan`;
CREATE TABLE `zxduan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maduan` varchar(255) DEFAULT NULL,
  `tenduan` varchar(255) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `sapxep` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for zxlamthemgio
-- ----------------------------
DROP TABLE IF EXISTS `zxlamthemgio`;
CREATE TABLE `zxlamthemgio` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `timebatdau` time DEFAULT NULL,
  `timeketthuc` time DEFAULT NULL,
  `congvieclamthem` text,
  `ngaylamthem` date DEFAULT NULL,
  `thoigian` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
