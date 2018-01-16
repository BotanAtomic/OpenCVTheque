/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100126
Source Host           : localhost:3306
Source Database       : opencvtheque

Target Server Type    : MYSQL
Target Server Version : 100126
File Encoding         : 65001

Date: 2018-01-16 09:22:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cv
-- ----------------------------
DROP TABLE IF EXISTS `cv`;
CREATE TABLE `cv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1500) NOT NULL,
  `name` varchar(1500) NOT NULL,
  `forename` varchar(1500) NOT NULL,
  `email` varchar(1500) DEFAULT NULL,
  `address` varchar(1500) DEFAULT NULL,
  `birthday` varchar(1500) DEFAULT NULL,
  `languages` varchar(1500) DEFAULT NULL,
  `training` varchar(1500) DEFAULT NULL,
  `phone_number` varchar(1500) DEFAULT NULL,
  `career` varchar(1500) DEFAULT NULL,
  `last_modification` bigint(255) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cv
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `forename` varchar(30) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `id` (`id`,`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'ahmed.botan94@gmail.com', '159357456b', 'Ahmad', 'Botan');
