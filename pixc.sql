/*
 Navicat Premium Data Transfer

 Source Server         : Xserver
 Source Server Type    : MySQL
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : pixc

 Target Server Type    : MySQL
 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 02/28/2016 14:18:33 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `created_by` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `created_date` varchar(20) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `customers`
-- ----------------------------
BEGIN;
INSERT INTO `customers` VALUES ('1', 'Kingsley', 'Okoh', 'kingsley@yahoo.com', '08125872592', 'No 35 ade suwa street,ikeja', 'Male', '09/12/2016', '3', 'active', '1456664847', b'0'), ('2', 'Paul', 'Adeoti', 'ishola@yahoo.com', '08022758748', '7, ishola street, ipaja, lagos', 'Male', '08/09/1988', '2', 'active', '1456665059', b'0'), ('3', 'Ahmed', 'Musa', 'ahmed@yahoo.com', '07061782781', 'Railway Quaters, alagomeji, Yaba', 'Male', '09/02/1992', '2', 'active', '1456665048', b'0'), ('4', 'Aderele', 'Ojo', 'adetayo@yahoo.com', '08102901902', '9, Adetayo street, yaba, Lagos', 'Male', '09/11/1990', '4', 'active', '1456665371', b'0'), ('5', 'Nkechi', 'Nnamdi', 'nke@yahoo.com', '08092810912', '1004 Buildings, Law School, Lagos', 'Male', '02/09/1993', '4', 'active', '1456665445', b'0');
COMMIT;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'Admin'), ('2', 'Staff'), ('3', 'Customers');
COMMIT;

-- ----------------------------
--  Table structure for `role_group`
-- ----------------------------
DROP TABLE IF EXISTS `role_group`;
CREATE TABLE `role_group` (
  `name` varchar(20) DEFAULT NULL,
  `groups` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `role_group`
-- ----------------------------
BEGIN;
INSERT INTO `role_group` VALUES ('dashboard', '1,2'), ('users', '1'), ('customers', '1,2'), ('user_count', '1'), ('logout', '1,2'), ('404', '1,2'), ('new_customer', '2'), ('edit_customer', '2'), ('view_customer', '1,2');
COMMIT;

-- ----------------------------
--  Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `userid` int(11) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user_group`
-- ----------------------------
BEGIN;
INSERT INTO `user_group` VALUES ('1', '1'), ('2', '2'), ('3', '2'), ('4', '2');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `is_deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'Badejo', 'Olwatobi', '02/04/1992', 'admin@xyz.com', '08125872592', '$2y$10$11uvzJvbXFxs8jJ8E27o1OiajioaDC3e.GVfhBGzyZcmbqQotcCPa', b'0'), ('2', 'Jide', 'Bello', '03/09/1990', 'staff1@xyz.om', '09109200190', '$2y$10$11uvzJvbXFxs8jJ8E27o1OiajioaDC3e.GVfhBGzyZcmbqQotcCPa', b'0'), ('3', 'Chima', 'Uche', '02/09/2009', 'staff2@xyz.com', '09109200190', '$2y$10$11uvzJvbXFxs8jJ8E27o1OiajioaDC3e.GVfhBGzyZcmbqQotcCPa', b'0'), ('4', 'Kingsley', 'Ajah', '02/03/1992', 'staff3@xyz.com', '091200910', '$2y$10$11uvzJvbXFxs8jJ8E27o1OiajioaDC3e.GVfhBGzyZcmbqQotcCPa', b'0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
