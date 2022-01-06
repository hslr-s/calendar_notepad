/*
 Navicat Premium Data Transfer

 Source Server Type    : MySQL
 Source Server Version : 50644
 Source Schema         : rili_demo

 Target Server Type    : MySQL
 Target Server Version : 50644
 File Encoding         : 65001

 Date: 04/12/2021 13:52:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for calendar_config
-- ----------------------------
DROP TABLE IF EXISTS `calendar_config`;
CREATE TABLE `calendar_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for calendar_holiday_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_holiday_list`;
CREATE TABLE `calendar_holiday_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '标题',
  `type` int(11) DEFAULT NULL,
  `start_time` datetime(0) DEFAULT NULL,
  `end_time` datetime(0) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 268 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calendar_holiday_list
-- ----------------------------
INSERT INTO `calendar_holiday_list` VALUES (145, NULL, 1, '2020-07-26 00:00:00', '2020-07-27 00:00:00', '2020-08-09 20:15:32');
INSERT INTO `calendar_holiday_list` VALUES (144, NULL, 1, '2020-07-25 00:00:00', '2020-07-26 00:00:00', '2020-08-09 20:15:32');
INSERT INTO `calendar_holiday_list` VALUES (143, NULL, 1, '2020-07-19 00:00:00', '2020-07-20 00:00:00', '2020-08-09 20:15:29');
INSERT INTO `calendar_holiday_list` VALUES (141, NULL, 1, '2020-07-12 00:00:00', '2020-07-13 00:00:00', '2020-08-09 20:15:26');
INSERT INTO `calendar_holiday_list` VALUES (142, NULL, 1, '2020-07-18 00:00:00', '2020-07-19 00:00:00', '2020-08-09 20:15:28');
INSERT INTO `calendar_holiday_list` VALUES (140, NULL, 1, '2020-07-11 00:00:00', '2020-07-12 00:00:00', '2020-08-09 20:15:26');
INSERT INTO `calendar_holiday_list` VALUES (138, NULL, 1, '2020-07-04 00:00:00', '2020-07-05 00:00:00', '2020-08-09 20:15:21');
INSERT INTO `calendar_holiday_list` VALUES (139, NULL, 1, '2020-07-05 00:00:00', '2020-07-06 00:00:00', '2020-08-09 20:15:22');
INSERT INTO `calendar_holiday_list` VALUES (137, NULL, 1, '2020-12-27 00:00:00', '2020-12-28 00:00:00', '2020-08-09 20:15:11');
INSERT INTO `calendar_holiday_list` VALUES (136, NULL, 1, '2020-12-26 00:00:00', '2020-12-27 00:00:00', '2020-08-09 20:15:10');
INSERT INTO `calendar_holiday_list` VALUES (135, NULL, 1, '2020-12-20 00:00:00', '2020-12-21 00:00:00', '2020-08-09 20:15:06');
INSERT INTO `calendar_holiday_list` VALUES (133, NULL, 1, '2020-12-13 00:00:00', '2020-12-14 00:00:00', '2020-08-09 20:15:02');
INSERT INTO `calendar_holiday_list` VALUES (134, NULL, 1, '2020-12-19 00:00:00', '2020-12-20 00:00:00', '2020-08-09 20:15:05');
INSERT INTO `calendar_holiday_list` VALUES (132, NULL, 1, '2020-12-12 00:00:00', '2020-12-13 00:00:00', '2020-08-09 20:15:02');
INSERT INTO `calendar_holiday_list` VALUES (131, NULL, 1, '2020-12-06 00:00:00', '2020-12-07 00:00:00', '2020-08-09 20:14:58');
INSERT INTO `calendar_holiday_list` VALUES (130, NULL, 1, '2020-12-05 00:00:00', '2020-12-06 00:00:00', '2020-08-09 20:14:58');
INSERT INTO `calendar_holiday_list` VALUES (129, NULL, 1, '2020-11-29 00:00:00', '2020-11-30 00:00:00', '2020-08-09 20:14:48');
INSERT INTO `calendar_holiday_list` VALUES (128, NULL, 1, '2020-11-28 00:00:00', '2020-11-29 00:00:00', '2020-08-09 20:14:48');
INSERT INTO `calendar_holiday_list` VALUES (127, NULL, 1, '2020-11-22 00:00:00', '2020-11-23 00:00:00', '2020-08-09 20:14:46');
INSERT INTO `calendar_holiday_list` VALUES (126, NULL, 1, '2020-11-21 00:00:00', '2020-11-22 00:00:00', '2020-08-09 20:14:46');
INSERT INTO `calendar_holiday_list` VALUES (125, NULL, 1, '2020-11-15 00:00:00', '2020-11-16 00:00:00', '2020-08-09 20:14:43');
INSERT INTO `calendar_holiday_list` VALUES (124, NULL, 1, '2020-11-14 00:00:00', '2020-11-15 00:00:00', '2020-08-09 20:14:42');
INSERT INTO `calendar_holiday_list` VALUES (123, NULL, 1, '2020-11-08 00:00:00', '2020-11-09 00:00:00', '2020-08-09 20:14:39');
INSERT INTO `calendar_holiday_list` VALUES (122, NULL, 1, '2020-11-07 00:00:00', '2020-11-08 00:00:00', '2020-08-09 20:14:38');
INSERT INTO `calendar_holiday_list` VALUES (121, NULL, 1, '2020-11-01 00:00:00', '2020-11-02 00:00:00', '2020-08-09 20:14:35');
INSERT INTO `calendar_holiday_list` VALUES (120, NULL, 1, '2020-08-30 00:00:00', '2020-08-31 00:00:00', '2020-08-09 19:32:02');
INSERT INTO `calendar_holiday_list` VALUES (119, NULL, 1, '2020-08-29 00:00:00', '2020-08-30 00:00:00', '2020-08-09 19:32:01');
INSERT INTO `calendar_holiday_list` VALUES (118, NULL, 1, '2020-08-23 00:00:00', '2020-08-24 00:00:00', '2020-08-09 19:31:57');
INSERT INTO `calendar_holiday_list` VALUES (117, NULL, 1, '2020-08-22 00:00:00', '2020-08-23 00:00:00', '2020-08-09 19:31:57');
INSERT INTO `calendar_holiday_list` VALUES (116, NULL, 1, '2020-08-16 00:00:00', '2020-08-17 00:00:00', '2020-08-09 19:31:53');
INSERT INTO `calendar_holiday_list` VALUES (115, NULL, 1, '2020-08-15 00:00:00', '2020-08-16 00:00:00', '2020-08-09 19:31:53');
INSERT INTO `calendar_holiday_list` VALUES (114, NULL, 1, '2020-08-09 00:00:00', '2020-08-10 00:00:00', '2020-08-09 19:31:49');
INSERT INTO `calendar_holiday_list` VALUES (113, NULL, 1, '2020-08-08 00:00:00', '2020-08-09 00:00:00', '2020-08-09 19:31:49');
INSERT INTO `calendar_holiday_list` VALUES (112, NULL, 1, '2020-08-02 00:00:00', '2020-08-03 00:00:00', '2020-08-09 19:31:46');
INSERT INTO `calendar_holiday_list` VALUES (111, NULL, 1, '2020-08-01 00:00:00', '2020-08-02 00:00:00', '2020-08-09 19:31:46');
INSERT INTO `calendar_holiday_list` VALUES (110, NULL, 1, '2020-09-26 00:00:00', '2020-09-27 00:00:00', '2020-08-09 19:35:14');
INSERT INTO `calendar_holiday_list` VALUES (109, NULL, 1, '2020-09-20 00:00:00', '2020-09-21 00:00:00', '2020-08-09 19:35:10');
INSERT INTO `calendar_holiday_list` VALUES (108, NULL, 1, '2020-09-19 00:00:00', '2020-09-20 00:00:00', '2020-08-09 19:35:09');
INSERT INTO `calendar_holiday_list` VALUES (107, NULL, 1, '2020-09-13 00:00:00', '2020-09-14 00:00:00', '2020-08-09 19:35:02');
INSERT INTO `calendar_holiday_list` VALUES (106, NULL, 1, '2020-09-12 00:00:00', '2020-09-13 00:00:00', '2020-08-09 19:35:01');
INSERT INTO `calendar_holiday_list` VALUES (105, NULL, 1, '2020-09-06 00:00:00', '2020-09-07 00:00:00', '2020-08-09 19:34:58');
INSERT INTO `calendar_holiday_list` VALUES (104, NULL, 1, '2020-09-05 00:00:00', '2020-09-06 00:00:00', '2020-08-09 19:34:57');
INSERT INTO `calendar_holiday_list` VALUES (90, NULL, 2, '2020-10-01 00:00:00', '2020-10-02 00:00:00', '2020-08-09 19:23:55');
INSERT INTO `calendar_holiday_list` VALUES (91, NULL, 2, '2020-10-02 00:00:00', '2020-10-03 00:00:00', '2020-08-09 19:23:55');
INSERT INTO `calendar_holiday_list` VALUES (92, NULL, 2, '2020-10-03 00:00:00', '2020-10-04 00:00:00', '2020-08-09 19:23:55');
INSERT INTO `calendar_holiday_list` VALUES (93, NULL, 1, '2020-10-04 00:00:00', '2020-10-05 00:00:00', '2020-08-09 19:23:56');
INSERT INTO `calendar_holiday_list` VALUES (94, NULL, 1, '2020-10-05 00:00:00', '2020-10-06 00:00:00', '2020-08-09 19:23:56');
INSERT INTO `calendar_holiday_list` VALUES (95, NULL, 1, '2020-10-06 00:00:00', '2020-10-07 00:00:00', '2020-08-09 19:23:57');
INSERT INTO `calendar_holiday_list` VALUES (96, NULL, 1, '2020-10-07 00:00:00', '2020-10-08 00:00:00', '2020-08-09 19:23:58');
INSERT INTO `calendar_holiday_list` VALUES (97, NULL, 1, '2020-10-08 00:00:00', '2020-10-09 00:00:00', '2020-08-09 19:23:59');
INSERT INTO `calendar_holiday_list` VALUES (98, NULL, 1, '2020-10-11 00:00:00', '2020-10-12 00:00:00', '2020-08-09 19:24:00');
INSERT INTO `calendar_holiday_list` VALUES (99, NULL, 1, '2020-10-17 00:00:00', '2020-10-18 00:00:00', '2020-08-09 19:24:03');
INSERT INTO `calendar_holiday_list` VALUES (100, NULL, 1, '2020-10-18 00:00:00', '2020-10-19 00:00:00', '2020-08-09 19:24:03');
INSERT INTO `calendar_holiday_list` VALUES (101, NULL, 1, '2020-10-24 00:00:00', '2020-10-25 00:00:00', '2020-08-09 19:24:07');
INSERT INTO `calendar_holiday_list` VALUES (102, NULL, 1, '2020-10-25 00:00:00', '2020-10-26 00:00:00', '2020-08-09 19:24:07');
INSERT INTO `calendar_holiday_list` VALUES (103, NULL, 1, '2020-10-31 00:00:00', '2020-11-01 00:00:00', '2020-08-09 19:24:10');
INSERT INTO `calendar_holiday_list` VALUES (146, NULL, 1, '2021-02-06 00:00:00', '2021-02-07 00:00:00', '2021-02-04 10:52:25');
INSERT INTO `calendar_holiday_list` VALUES (147, NULL, 2, '2021-02-11 00:00:00', '2021-02-12 00:00:00', '2021-02-04 10:52:27');
INSERT INTO `calendar_holiday_list` VALUES (148, NULL, 1, '2021-02-21 00:00:00', '2021-02-22 00:00:00', '2021-02-04 10:52:35');
INSERT INTO `calendar_holiday_list` VALUES (149, NULL, 1, '2021-02-27 00:00:00', '2021-02-28 00:00:00', '2021-02-04 10:52:36');
INSERT INTO `calendar_holiday_list` VALUES (263, NULL, 1, '2021-01-17 00:00:00', '2021-01-18 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (151, NULL, 2, '2021-02-12 00:00:00', '2021-02-13 00:00:00', '2021-02-04 10:52:28');
INSERT INTO `calendar_holiday_list` VALUES (152, NULL, 2, '2021-02-13 00:00:00', '2021-02-14 00:00:00', '2021-02-04 10:52:29');
INSERT INTO `calendar_holiday_list` VALUES (153, NULL, 2, '2021-02-14 00:00:00', '2021-02-15 00:00:00', '2021-02-04 10:52:30');
INSERT INTO `calendar_holiday_list` VALUES (154, NULL, 2, '2021-02-15 00:00:00', '2021-02-16 00:00:00', '2021-02-04 10:52:31');
INSERT INTO `calendar_holiday_list` VALUES (155, NULL, 2, '2021-02-16 00:00:00', '2021-02-17 00:00:00', '2021-02-04 10:52:32');
INSERT INTO `calendar_holiday_list` VALUES (156, NULL, 2, '2021-02-17 00:00:00', '2021-02-18 00:00:00', '2021-02-04 10:52:33');
INSERT INTO `calendar_holiday_list` VALUES (262, NULL, 1, '2021-01-16 00:00:00', '2021-01-17 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (158, NULL, 1, '2021-02-28 00:00:00', '2021-03-01 00:00:00', '2021-02-04 10:52:37');
INSERT INTO `calendar_holiday_list` VALUES (159, NULL, 1, '2021-03-06 00:00:00', '2021-03-07 00:00:00', '2021-02-04 10:58:47');
INSERT INTO `calendar_holiday_list` VALUES (160, NULL, 1, '2021-03-07 00:00:00', '2021-03-08 00:00:00', '2021-02-04 10:58:48');
INSERT INTO `calendar_holiday_list` VALUES (161, NULL, 1, '2021-03-13 00:00:00', '2021-03-14 00:00:00', '2021-02-04 10:58:49');
INSERT INTO `calendar_holiday_list` VALUES (162, NULL, 1, '2021-03-14 00:00:00', '2021-03-15 00:00:00', '2021-02-04 10:58:50');
INSERT INTO `calendar_holiday_list` VALUES (163, NULL, 1, '2021-03-20 00:00:00', '2021-03-21 00:00:00', '2021-02-04 10:58:51');
INSERT INTO `calendar_holiday_list` VALUES (164, NULL, 1, '2021-03-21 00:00:00', '2021-03-22 00:00:00', '2021-02-04 10:58:52');
INSERT INTO `calendar_holiday_list` VALUES (165, NULL, 1, '2021-03-27 00:00:00', '2021-03-28 00:00:00', '2021-02-04 10:58:53');
INSERT INTO `calendar_holiday_list` VALUES (166, NULL, 1, '2021-03-28 00:00:00', '2021-03-29 00:00:00', '2021-02-04 10:58:54');
INSERT INTO `calendar_holiday_list` VALUES (167, NULL, 2, '2021-04-03 00:00:00', '2021-04-04 00:00:00', '2021-02-04 10:59:21');
INSERT INTO `calendar_holiday_list` VALUES (168, NULL, 2, '2021-04-04 00:00:00', '2021-04-05 00:00:00', '2021-02-04 10:59:22');
INSERT INTO `calendar_holiday_list` VALUES (169, NULL, 2, '2021-04-05 00:00:00', '2021-04-06 00:00:00', '2021-02-04 10:59:23');
INSERT INTO `calendar_holiday_list` VALUES (170, NULL, 1, '2021-04-10 00:00:00', '2021-04-11 00:00:00', '2021-02-04 10:59:24');
INSERT INTO `calendar_holiday_list` VALUES (171, NULL, 1, '2021-04-11 00:00:00', '2021-04-12 00:00:00', '2021-02-04 10:59:25');
INSERT INTO `calendar_holiday_list` VALUES (172, NULL, 1, '2021-04-17 00:00:00', '2021-04-18 00:00:00', '2021-02-04 10:59:26');
INSERT INTO `calendar_holiday_list` VALUES (173, NULL, 1, '2021-04-18 00:00:00', '2021-04-19 00:00:00', '2021-02-04 10:59:27');
INSERT INTO `calendar_holiday_list` VALUES (174, NULL, 1, '2021-04-24 00:00:00', '2021-04-25 00:00:00', '2021-02-04 10:59:28');
INSERT INTO `calendar_holiday_list` VALUES (261, NULL, 1, '2021-01-10 00:00:00', '2021-01-11 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (176, NULL, 2, '2021-05-01 00:00:00', '2021-05-02 00:00:00', '2021-02-04 10:59:38');
INSERT INTO `calendar_holiday_list` VALUES (177, NULL, 2, '2021-05-02 00:00:00', '2021-05-03 00:00:00', '2021-02-04 10:59:39');
INSERT INTO `calendar_holiday_list` VALUES (178, NULL, 2, '2021-05-03 00:00:00', '2021-05-04 00:00:00', '2021-02-04 10:59:40');
INSERT INTO `calendar_holiday_list` VALUES (179, NULL, 2, '2021-05-04 00:00:00', '2021-05-05 00:00:00', '2021-02-04 10:59:41');
INSERT INTO `calendar_holiday_list` VALUES (180, NULL, 2, '2021-05-05 00:00:00', '2021-05-06 00:00:00', '2021-02-04 10:59:42');
INSERT INTO `calendar_holiday_list` VALUES (260, NULL, 1, '2021-01-09 00:00:00', '2021-01-10 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (182, NULL, 1, '2021-05-09 00:00:00', '2021-05-10 00:00:00', '2021-02-04 10:59:44');
INSERT INTO `calendar_holiday_list` VALUES (183, NULL, 1, '2021-05-15 00:00:00', '2021-05-16 00:00:00', '2021-02-04 10:59:45');
INSERT INTO `calendar_holiday_list` VALUES (184, NULL, 1, '2021-05-16 00:00:00', '2021-05-17 00:00:00', '2021-02-04 10:59:46');
INSERT INTO `calendar_holiday_list` VALUES (185, NULL, 1, '2021-05-22 00:00:00', '2021-05-23 00:00:00', '2021-02-04 10:59:47');
INSERT INTO `calendar_holiday_list` VALUES (186, NULL, 1, '2021-05-23 00:00:00', '2021-05-24 00:00:00', '2021-02-04 10:59:48');
INSERT INTO `calendar_holiday_list` VALUES (187, NULL, 1, '2021-05-29 00:00:00', '2021-05-30 00:00:00', '2021-02-04 10:59:49');
INSERT INTO `calendar_holiday_list` VALUES (188, NULL, 1, '2021-05-30 00:00:00', '2021-05-31 00:00:00', '2021-02-04 10:59:50');
INSERT INTO `calendar_holiday_list` VALUES (189, NULL, 1, '2021-06-05 00:00:00', '2021-06-06 00:00:00', '2021-02-04 10:59:57');
INSERT INTO `calendar_holiday_list` VALUES (190, NULL, 1, '2021-06-06 00:00:00', '2021-06-07 00:00:00', '2021-02-04 10:59:58');
INSERT INTO `calendar_holiday_list` VALUES (191, NULL, 2, '2021-06-12 00:00:00', '2021-06-13 00:00:00', '2021-02-04 10:59:59');
INSERT INTO `calendar_holiday_list` VALUES (192, NULL, 2, '2021-06-13 00:00:00', '2021-06-14 00:00:00', '2021-02-04 11:00:00');
INSERT INTO `calendar_holiday_list` VALUES (193, NULL, 2, '2021-06-14 00:00:00', '2021-06-15 00:00:00', '2021-02-04 11:00:01');
INSERT INTO `calendar_holiday_list` VALUES (194, NULL, 1, '2021-06-19 00:00:00', '2021-06-20 00:00:00', '2021-02-04 11:00:02');
INSERT INTO `calendar_holiday_list` VALUES (195, NULL, 1, '2021-06-20 00:00:00', '2021-06-21 00:00:00', '2021-02-04 11:00:03');
INSERT INTO `calendar_holiday_list` VALUES (196, NULL, 1, '2021-06-26 00:00:00', '2021-06-27 00:00:00', '2021-02-04 11:00:04');
INSERT INTO `calendar_holiday_list` VALUES (197, NULL, 1, '2021-06-27 00:00:00', '2021-06-28 00:00:00', '2021-02-04 11:00:05');
INSERT INTO `calendar_holiday_list` VALUES (198, NULL, 1, '2021-07-03 00:00:00', '2021-07-04 00:00:00', '2021-02-04 11:00:46');
INSERT INTO `calendar_holiday_list` VALUES (199, NULL, 1, '2021-07-04 00:00:00', '2021-07-05 00:00:00', '2021-02-04 11:00:47');
INSERT INTO `calendar_holiday_list` VALUES (200, NULL, 1, '2021-07-10 00:00:00', '2021-07-11 00:00:00', '2021-02-04 11:00:48');
INSERT INTO `calendar_holiday_list` VALUES (201, NULL, 1, '2021-07-11 00:00:00', '2021-07-12 00:00:00', '2021-02-04 11:00:49');
INSERT INTO `calendar_holiday_list` VALUES (202, NULL, 1, '2021-07-17 00:00:00', '2021-07-18 00:00:00', '2021-02-04 11:00:50');
INSERT INTO `calendar_holiday_list` VALUES (203, NULL, 1, '2021-07-18 00:00:00', '2021-07-19 00:00:00', '2021-02-04 11:00:51');
INSERT INTO `calendar_holiday_list` VALUES (204, NULL, 1, '2021-07-24 00:00:00', '2021-07-25 00:00:00', '2021-02-04 11:00:52');
INSERT INTO `calendar_holiday_list` VALUES (205, NULL, 1, '2021-07-25 00:00:00', '2021-07-26 00:00:00', '2021-02-04 11:00:53');
INSERT INTO `calendar_holiday_list` VALUES (206, NULL, 1, '2021-07-31 00:00:00', '2021-08-01 00:00:00', '2021-02-04 11:00:54');
INSERT INTO `calendar_holiday_list` VALUES (207, NULL, 1, '2021-08-01 00:00:00', '2021-08-02 00:00:00', '2021-02-04 11:01:50');
INSERT INTO `calendar_holiday_list` VALUES (208, NULL, 1, '2021-08-07 00:00:00', '2021-08-08 00:00:00', '2021-02-04 11:01:51');
INSERT INTO `calendar_holiday_list` VALUES (209, NULL, 1, '2021-08-08 00:00:00', '2021-08-09 00:00:00', '2021-02-04 11:01:52');
INSERT INTO `calendar_holiday_list` VALUES (210, NULL, 1, '2021-08-14 00:00:00', '2021-08-15 00:00:00', '2021-02-04 11:01:53');
INSERT INTO `calendar_holiday_list` VALUES (211, NULL, 1, '2021-08-15 00:00:00', '2021-08-16 00:00:00', '2021-02-04 11:01:54');
INSERT INTO `calendar_holiday_list` VALUES (212, NULL, 1, '2021-08-21 00:00:00', '2021-08-22 00:00:00', '2021-02-04 11:01:55');
INSERT INTO `calendar_holiday_list` VALUES (213, NULL, 1, '2021-08-22 00:00:00', '2021-08-23 00:00:00', '2021-02-04 11:01:56');
INSERT INTO `calendar_holiday_list` VALUES (214, NULL, 1, '2021-08-28 00:00:00', '2021-08-29 00:00:00', '2021-02-04 11:01:57');
INSERT INTO `calendar_holiday_list` VALUES (215, NULL, 1, '2021-08-29 00:00:00', '2021-08-30 00:00:00', '2021-02-04 11:01:58');
INSERT INTO `calendar_holiday_list` VALUES (216, NULL, 1, '2021-09-04 00:00:00', '2021-09-05 00:00:00', '2021-02-04 11:03:42');
INSERT INTO `calendar_holiday_list` VALUES (217, NULL, 1, '2021-09-05 00:00:00', '2021-09-06 00:00:00', '2021-02-04 11:03:43');
INSERT INTO `calendar_holiday_list` VALUES (218, NULL, 1, '2021-09-11 00:00:00', '2021-09-12 00:00:00', '2021-02-04 11:03:44');
INSERT INTO `calendar_holiday_list` VALUES (219, NULL, 1, '2021-09-12 00:00:00', '2021-09-13 00:00:00', '2021-02-04 11:03:45');
INSERT INTO `calendar_holiday_list` VALUES (259, NULL, 2, '2021-01-03 00:00:00', '2021-01-04 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (221, NULL, 2, '2021-09-19 00:00:00', '2021-09-20 00:00:00', '2021-02-04 11:03:47');
INSERT INTO `calendar_holiday_list` VALUES (222, NULL, 2, '2021-09-20 00:00:00', '2021-09-21 00:00:00', '2021-02-04 11:03:48');
INSERT INTO `calendar_holiday_list` VALUES (223, NULL, 2, '2021-09-21 00:00:00', '2021-09-22 00:00:00', '2021-02-04 11:03:49');
INSERT INTO `calendar_holiday_list` VALUES (224, NULL, 1, '2021-09-25 00:00:00', '2021-09-26 00:00:00', '2021-02-04 11:03:50');
INSERT INTO `calendar_holiday_list` VALUES (258, NULL, 2, '2021-01-02 00:00:00', '2021-01-03 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (226, NULL, 2, '2021-10-01 00:00:00', '2021-10-02 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (227, NULL, 2, '2021-10-02 00:00:00', '2021-10-03 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (228, NULL, 2, '2021-10-03 00:00:00', '2021-10-04 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (229, NULL, 2, '2021-10-04 00:00:00', '2021-10-05 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (230, NULL, 2, '2021-10-05 00:00:00', '2021-10-06 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (231, NULL, 2, '2021-10-06 00:00:00', '2021-10-07 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (232, NULL, 2, '2021-10-07 00:00:00', '2021-10-08 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (257, NULL, 2, '2021-01-01 00:00:00', '2021-01-02 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (234, NULL, 1, '2021-10-10 00:00:00', '2021-10-11 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (235, NULL, 1, '2021-10-16 00:00:00', '2021-10-17 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (236, NULL, 1, '2021-10-17 00:00:00', '2021-10-18 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (237, NULL, 1, '2021-10-23 00:00:00', '2021-10-24 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (238, NULL, 1, '2021-10-24 00:00:00', '2021-10-25 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (239, NULL, 1, '2021-10-30 00:00:00', '2021-10-31 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (240, NULL, 1, '2021-10-31 00:00:00', '2021-11-01 00:00:00', '2021-02-04 11:04:06');
INSERT INTO `calendar_holiday_list` VALUES (241, NULL, 1, '2021-11-06 00:00:00', '2021-11-07 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (242, NULL, 1, '2021-11-07 00:00:00', '2021-11-08 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (243, NULL, 1, '2021-11-13 00:00:00', '2021-11-14 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (244, NULL, 1, '2021-11-14 00:00:00', '2021-11-15 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (245, NULL, 1, '2021-11-20 00:00:00', '2021-11-21 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (246, NULL, 1, '2021-11-21 00:00:00', '2021-11-22 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (247, NULL, 1, '2021-11-27 00:00:00', '2021-11-28 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (248, NULL, 1, '2021-11-28 00:00:00', '2021-11-29 00:00:00', '2021-02-04 11:04:15');
INSERT INTO `calendar_holiday_list` VALUES (249, NULL, 1, '2021-12-04 00:00:00', '2021-12-05 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (250, NULL, 1, '2021-12-05 00:00:00', '2021-12-06 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (251, NULL, 1, '2021-12-11 00:00:00', '2021-12-12 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (252, NULL, 1, '2021-12-12 00:00:00', '2021-12-13 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (253, NULL, 1, '2021-12-18 00:00:00', '2021-12-19 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (254, NULL, 1, '2021-12-19 00:00:00', '2021-12-20 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (255, NULL, 1, '2021-12-25 00:00:00', '2021-12-26 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (256, NULL, 1, '2021-12-26 00:00:00', '2021-12-27 00:00:00', '2021-02-04 11:04:23');
INSERT INTO `calendar_holiday_list` VALUES (264, NULL, 1, '2021-01-23 00:00:00', '2021-01-24 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (265, NULL, 1, '2021-01-24 00:00:00', '2021-01-25 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (266, NULL, 1, '2021-01-30 00:00:00', '2021-01-31 00:00:00', '2021-02-04 11:17:37');
INSERT INTO `calendar_holiday_list` VALUES (267, NULL, 1, '2021-01-31 00:00:00', '2021-02-01 00:00:00', '2021-02-04 11:17:37');

-- ----------------------------
-- Table structure for calendar_note_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_note_list`;
CREATE TABLE `calendar_note_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '标题',
  `content` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '内容',
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '颜色值#fff等',
  `class_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '前端标签类名',
  `start_time` datetime(0) DEFAULT NULL,
  `end_time` datetime(0) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  `obj_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for calendar_obj_config
-- ----------------------------
DROP TABLE IF EXISTS `calendar_obj_config`;
CREATE TABLE `calendar_obj_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) DEFAULT NULL,
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for calendar_obj_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_obj_list`;
CREATE TABLE `calendar_obj_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  `update_time` datetime(0) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `pwd` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for calendar_style_list
-- ----------------------------
DROP TABLE IF EXISTS `calendar_style_list`;
CREATE TABLE `calendar_style_list`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL,
  `name_cn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `text_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `background_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `border_color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `loginkey` varchar(52) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `auth_id` int(11) DEFAULT NULL,
  `create_time` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calendar_user
-- ----------------------------
INSERT INTO `calendar_user` VALUES (1, '小猎人', 'test123', 'e10adc3949ba59abbe56e057f20f883e', '', 1, 1, '2021-11-19 22:05:15');

DROP TABLE IF EXISTS `calendar_obj_subject`;
CREATE TABLE `calendar_obj_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '标题',
  `obj_id` int(11) DEFAULT NULL COMMENT '项目id',
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=FIXED;

SET FOREIGN_KEY_CHECKS = 1;
