/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : calendar_note

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 19/10/2021 18:52:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for calendar_demo
-- ----------------------------
DROP TABLE IF EXISTS `calendar_demo`;
CREATE TABLE `calendar_demo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of calendar_demo
-- ----------------------------

-- ----------------------------
-- Table structure for calendar_note_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_note_list`;
CREATE TABLE `calendar_note_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标题',
  `content` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '内容',
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '颜色值#fff等',
  `class_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '前端标签类名',
  `start_time` datetime(0) NULL DEFAULT NULL,
  `end_time` datetime(0) NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `obj_id` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of calendar_note_list
-- ----------------------------

-- ----------------------------
-- Table structure for calendar_obj_config
-- ----------------------------
DROP TABLE IF EXISTS `calendar_obj_config`;
CREATE TABLE `calendar_obj_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) NULL DEFAULT NULL,
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of calendar_obj_config
-- ----------------------------

-- ----------------------------
-- Table structure for calendar_obj_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_obj_list`;
CREATE TABLE `calendar_obj_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `note` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `u_id` int(11) NULL DEFAULT NULL,
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `sort` int(11) NULL DEFAULT NULL,
  `pwd` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of calendar_obj_list
-- ----------------------------

-- ----------------------------
-- Table structure for calendar_style_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_style_list`;
CREATE TABLE `calendar_style_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NULL DEFAULT NULL,
  `name_cn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `text_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `background_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `border_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of calendar_style_list
-- ----------------------------
INSERT INTO `calendar_style_list` VALUES (1, 99, '绿色', 'green', '#ffffff', '#369a5f', '#257e4a');
INSERT INTO `calendar_style_list` VALUES (2, 99, '黄色', 'yellow', '#ffffff', '#f3b20f', '#af7d00');
INSERT INTO `calendar_style_list` VALUES (3, 99, '粉红色', 'pink-red', '#ffffff', '#ea5454', '#b11616');
INSERT INTO `calendar_style_list` VALUES (4, 99, '粉色', 'pink', '#ffffff', '#ff005e', '#dc024a');
INSERT INTO `calendar_style_list` VALUES (6, 99, '翠绿', 'color-c-name6', '#ffffff', '#05f765', '#04e876');
INSERT INTO `calendar_style_list` VALUES (15, 99, '(淡)紫色', 'color-c-name15', '#ffffff', '#f3bbfe', '');
INSERT INTO `calendar_style_list` VALUES (8, 999, '(淡)绿色', 'color-c-name8', '#ffffff', '#9cf2be', '');
INSERT INTO `calendar_style_list` VALUES (9, 999, '(淡)蓝绿色', 'color-c-name9', '#ffffff', '#9df2de', '');
INSERT INTO `calendar_style_list` VALUES (10, 999, '(淡)粉色', 'color-c-name10', '#ffffff', '#ff9f9f', '');
INSERT INTO `calendar_style_list` VALUES (11, 999, '(淡)黄色', 'color-c-name11', '#ffffff', '#ffefb1', '');
INSERT INTO `calendar_style_list` VALUES (14, 99, '蓝色', 'color-c-name14', '#ffffff', '#15c8ff', '#02c5cc');
INSERT INTO `calendar_style_list` VALUES (13, 999, '(淡)蓝色', 'color-c-name13', '#ffffff', '#9de7f2', '');

-- ----------------------------
-- Table structure for calendar_user
-- ----------------------------
DROP TABLE IF EXISTS `calendar_user`;
CREATE TABLE `calendar_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `loginkey` varchar(52) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of calendar_user
-- ----------------------------
INSERT INTO `calendar_user` VALUES (1, '', 'test123', 'e10adc3949ba59abbe56e057f20f883e', '14a7c7d88cbc5309d697b05dd10b31d5test123');

SET FOREIGN_KEY_CHECKS = 1;
