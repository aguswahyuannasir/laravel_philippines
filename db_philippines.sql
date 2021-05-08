/*
 Navicat Premium Data Transfer

 Source Server         : mysql_localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : db_philippines

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 08/05/2021 10:03:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for rfpermission
-- ----------------------------
DROP TABLE IF EXISTS `rfpermission`;
CREATE TABLE `rfpermission` (
  `IdPermission` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(255) DEFAULT NULL,
  `Label` varchar(255) DEFAULT NULL,
  `TglRecord` datetime DEFAULT NULL,
  `TglUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`IdPermission`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of rfpermission
-- ----------------------------
BEGIN;
INSERT INTO `rfpermission` VALUES (13, 'manage-role', 'Me-Manage Master Role ', '2020-04-29 15:08:23', NULL);
INSERT INTO `rfpermission` VALUES (14, 'manage-user', 'Me-manage Master User ', '2020-04-29 15:08:23', NULL);
INSERT INTO `rfpermission` VALUES (1, 'number-1', 'Question 1', '2021-05-07 22:33:53', NULL);
INSERT INTO `rfpermission` VALUES (2, 'number-2', 'Question 2', '2021-05-07 22:33:57', NULL);
COMMIT;

-- ----------------------------
-- Table structure for rfrole
-- ----------------------------
DROP TABLE IF EXISTS `rfrole`;
CREATE TABLE `rfrole` (
  `IdRole` int(255) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(255) DEFAULT NULL,
  `Label` varchar(255) DEFAULT NULL,
  `TglRecord` datetime DEFAULT NULL,
  `TglUpdate` datetime DEFAULT NULL,
  `FlgAktif` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdRole`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of rfrole
-- ----------------------------
BEGIN;
INSERT INTO `rfrole` VALUES (1, 'admin', 'Administrator', '2019-10-15 00:00:00', '2020-12-16 00:00:00', 1);
COMMIT;

-- ----------------------------
-- Table structure for rfuser
-- ----------------------------
DROP TABLE IF EXISTS `rfuser`;
CREATE TABLE `rfuser` (
  `IdUser` int(255) NOT NULL AUTO_INCREMENT,
  `TglRecord` datetime DEFAULT NULL,
  `TglUpdate` datetime DEFAULT NULL,
  `IdUserRecord` int(11) DEFAULT NULL,
  `IdUserUpdate` int(11) DEFAULT NULL,
  `FlgAktif` int(255) DEFAULT NULL,
  `NmUser` varchar(255) DEFAULT NULL,
  `UserLogin` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `SecretKey` varchar(255) DEFAULT NULL,
  `FlgLDAP` int(11) DEFAULT NULL,
  `FlgMitra` int(11) DEFAULT NULL,
  `IdRole` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdUser`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of rfuser
-- ----------------------------
BEGIN;
INSERT INTO `rfuser` VALUES (1, '2021-01-06 16:00:43', NULL, 2, NULL, 1, 'agus annasir', 'agus', '$2y$10$MmxVczUb2lz3pq82cGL3nu143BkWcAVa7oWHH62yg/26Thi7hEEgu', NULL, 0, 0, 1);
COMMIT;

-- ----------------------------
-- Table structure for tbl_arr
-- ----------------------------
DROP TABLE IF EXISTS `tbl_arr`;
CREATE TABLE `tbl_arr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_arr
-- ----------------------------
BEGIN;
INSERT INTO `tbl_arr` VALUES (1, 1);
INSERT INTO `tbl_arr` VALUES (2, -1);
INSERT INTO `tbl_arr` VALUES (3, 3);
INSERT INTO `tbl_arr` VALUES (4, -4);
INSERT INTO `tbl_arr` VALUES (5, 5);
INSERT INTO `tbl_arr` VALUES (6, -2);
INSERT INTO `tbl_arr` VALUES (7, 7);
INSERT INTO `tbl_arr` VALUES (8, 4);
INSERT INTO `tbl_arr` VALUES (9, 2);
COMMIT;

-- ----------------------------
-- Table structure for tbl_data
-- ----------------------------
DROP TABLE IF EXISTS `tbl_data`;
CREATE TABLE `tbl_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_data
-- ----------------------------
BEGIN;
INSERT INTO `tbl_data` VALUES (1, 1111, 'APPLE', 10.00, 'READY');
INSERT INTO `tbl_data` VALUES (2, 1111, 'APPLE', 20.00, 'DELIVERED');
INSERT INTO `tbl_data` VALUES (3, 1111, 'APPLE', 30.00, 'SENT');
INSERT INTO `tbl_data` VALUES (4, 1111, 'APPLE', 10.00, 'ONHOLD');
INSERT INTO `tbl_data` VALUES (5, 1111, 'APPLE', 20.00, 'PACKING');
INSERT INTO `tbl_data` VALUES (6, 1111, 'APPLE', 40.00, 'SENT');
INSERT INTO `tbl_data` VALUES (7, 1111, 'APPLE', 50.00, 'SENT');
INSERT INTO `tbl_data` VALUES (8, 1122, 'PINAPPLE', 10.00, 'READY');
INSERT INTO `tbl_data` VALUES (9, 1122, 'PINAPPLE', 10.00, 'DELIVERED');
INSERT INTO `tbl_data` VALUES (10, 1122, 'PINAPPLE', 10.00, 'PACKING');
INSERT INTO `tbl_data` VALUES (11, 1122, 'PINAPPLE', 10.00, 'DELIVERED');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
