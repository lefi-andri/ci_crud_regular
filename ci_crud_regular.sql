/*
 Navicat Premium Data Transfer

 Source Server         : Maria DB
 Source Server Type    : MariaDB
 Source Server Version : 100310
 Source Host           : 127.0.0.1:3309
 Source Schema         : ci_crud_regular

 Target Server Type    : MariaDB
 Target Server Version : 100310
 File Encoding         : 65001

 Date: 08/02/2022 16:02:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for organisasi
-- ----------------------------
DROP TABLE IF EXISTS `organisasi`;
CREATE TABLE `organisasi`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_organisasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of organisasi
-- ----------------------------
INSERT INTO `organisasi` VALUES (1, 'DPMPTSP', 'Jakarta');
INSERT INTO `organisasi` VALUES (2, 'Capil', 'Jakarta');
INSERT INTO `organisasi` VALUES (3, 'Kelurahan', 'Jakarta');
INSERT INTO `organisasi` VALUES (4, 'Puskesmas', 'Jakarta');
INSERT INTO `organisasi` VALUES (5, 'Dinas Sosial', 'Jakarta');
INSERT INTO `organisasi` VALUES (6, 'Kementerian', 'Jakarta');
INSERT INTO `organisasi` VALUES (7, 'Pemda', 'Surabaya');
INSERT INTO `organisasi` VALUES (8, 'Swasta', 'Jakarta');
INSERT INTO `organisasi` VALUES (9, 'Industri', 'Jakarta');
INSERT INTO `organisasi` VALUES (10, 'Dinas Pemukiman', 'Jakarta');
INSERT INTO `organisasi` VALUES (11, 'Rumah Sakit Daerah', 'Jakarta');
INSERT INTO `organisasi` VALUES (12, 'Rumah Sakit Provinsi', 'Jakarta');
INSERT INTO `organisasi` VALUES (14, 'Test Sidoarjo', 'Sidoarjo');
INSERT INTO `organisasi` VALUES (15, 'Dinas Pertanian', 'Aceh Utara');
INSERT INTO `organisasi` VALUES (16, 'Dinas Pemukiman', 'Sidoarjo');
INSERT INTO `organisasi` VALUES (17, 'Lapan', 'Lapan');
INSERT INTO `organisasi` VALUES (18, 'a', 'a');
INSERT INTO `organisasi` VALUES (19, 's', 's');
INSERT INTO `organisasi` VALUES (20, 'v', 'v');
INSERT INTO `organisasi` VALUES (21, 'r', 'r');
INSERT INTO `organisasi` VALUES (22, 'q', 'q');

SET FOREIGN_KEY_CHECKS = 1;
