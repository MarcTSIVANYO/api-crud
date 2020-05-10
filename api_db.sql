/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : api_db

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 10/05/2020 14:30:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `view` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES (8, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (9, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (10, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (11, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (12, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (13, 'Amazing Pillow 2.0', '199', 'The best pillow for amazing programmers.', 2);
INSERT INTO `blogs` VALUES (16, 'Test', 'treesteete', 'rehrhejsjkjsf', 13);
INSERT INTO `blogs` VALUES (18, 'Test 12 ', 'test 12', 'test', 12);
INSERT INTO `blogs` VALUES (19, 'AZAE', 'AZZEA', 'ZEZREZ', 12);

SET FOREIGN_KEY_CHECKS = 1;
