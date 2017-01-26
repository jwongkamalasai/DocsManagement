/*
Navicat MySQL Data Transfer

Source Server         : LocalDB
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : documents

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-01-26 21:01:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `documents`
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`content_id`  varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`doc_id`  int(11) NOT NULL ,
`years`  int(4) NOT NULL ,
`docno`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`doc_date`  date NOT NULL ,
`doc_form`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`doc_to`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`topic`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`detail`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`ref`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`deps`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' ,
`register`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`comment`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`date_receive`  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP ,
`docs`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`others`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
UNIQUE INDEX `docno` (`docno`) USING BTREE ,
UNIQUE INDEX `ref` (`ref`) USING BTREE ,
INDEX `docid` (`doc_id`, `years`) USING BTREE ,
INDEX `content_id` (`content_id`) USING BTREE ,
INDEX `years` (`years`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=4

;

-- ----------------------------
-- Records of documents
-- ----------------------------
BEGIN;
INSERT INTO `documents` VALUES ('2', '02', '96', '2345', 'อบ.0032.001/ว1', '2017-01-17', 'สำนักงานสาธารณสุขจังหวัดอุบลราชธานี', 'ผอ.`รพช', 'ทดสอบเอกสาร', 'nmsy yrms', 'ReCp4zMR_-y_40iZTFbT28', '02', 'jackie', 'ทดสอบ', '2017-01-23 00:00:00', 'null', '{\"6f9db2b04b21c58581b60e89728714f5.pdf\":\"9645.pdf\"}'), ('3', '01', '1', '2560', 'สธ0246/1351', '2017-01-26', 'สสจ.', 'ผอ.`รพช', 'ขอเชิญประชุม', '', 'pNynCHVVPUfn9ukAXeBGK9', '02', 'วีรยา', '', '2017-01-26 00:00:00', 'null', '{\"b640ab2e77362c2a76c753351ebcba05.pdf\":\"9645 (1).pdf\"}');
COMMIT;

-- ----------------------------
-- Table structure for `download`
-- ----------------------------
DROP TABLE IF EXISTS `download`;
CREATE TABLE `download` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`ref`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`download_by`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`download_date`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of download
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `l_content`
-- ----------------------------
DROP TABLE IF EXISTS `l_content`;
CREATE TABLE `l_content` (
`id`  varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`content`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of l_content
-- ----------------------------
BEGIN;
INSERT INTO `l_content` VALUES ('00', 'แบบฟอร์ม'), ('01', 'หนังสือรับ'), ('02', 'หนังสือส่ง'), ('03', 'หนังสือรับรอง'), ('04', 'บันทึกข้อความ'), ('05', 'หนังสือขอไปราชการ');
COMMIT;

-- ----------------------------
-- Table structure for `l_dep`
-- ----------------------------
DROP TABLE IF EXISTS `l_dep`;
CREATE TABLE `l_dep` (
`id`  varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`depname`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of l_dep
-- ----------------------------
BEGIN;
INSERT INTO `l_dep` VALUES ('01', 'บริหาร'), ('02', 'ยุทธ์/ประกันฯ'), ('03', 'การพยาบาล'), ('04', 'แพทย์'), ('05', 'ทันตะ'), ('06', 'เภสัช'), ('07', 'แลป'), ('08', 'เวชฯ');
COMMIT;

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
`version`  varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`apply_time`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`version`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of migration
-- ----------------------------
BEGIN;
INSERT INTO `migration` VALUES ('m000000_000000_base', '1483540219'), ('m140209_132017_init', '1483542856'), ('m140403_174025_create_account_table', '1483542856'), ('m140504_113157_update_tables', '1483542857'), ('m140504_130429_create_token_table', '1483542858'), ('m140830_171933_fix_ip_field', '1483542858'), ('m140830_172703_change_account_table_name', '1483542858'), ('m141222_110026_update_ip_field', '1483542859'), ('m141222_135246_alter_username_length', '1483542859'), ('m150202_124833_init', '1483540229'), ('m150614_103145_update_social_account_table', '1483542859'), ('m150623_212711_fix_username_notnull', '1483542859'), ('m151218_234654_add_timezone_to_profile', '1483542860'), ('m160929_103127_add_last_login_at_to_user_table', '1484231295');
COMMIT;

-- ----------------------------
-- Table structure for `monthth`
-- ----------------------------
DROP TABLE IF EXISTS `monthth`;
CREATE TABLE `monthth` (
`id`  int(2) UNSIGNED NOT NULL AUTO_INCREMENT ,
`monthnameth`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=13

;

-- ----------------------------
-- Records of monthth
-- ----------------------------
BEGIN;
INSERT INTO `monthth` VALUES ('1', 'มกราคม'), ('2', 'กุมภาพันธ์'), ('3', 'มีนาคม'), ('4', 'เมษายน'), ('5', 'พฤษภาคม'), ('6', 'มิถุนายน'), ('7', 'กรกฎาคม'), ('8', 'สิงหาคม'), ('9', 'กันยายน'), ('10', 'ตุลาคม'), ('11', 'พฤศจิกายน'), ('12', 'ธันวาคม');
COMMIT;

-- ----------------------------
-- Table structure for `profile`
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
`user_id`  int(11) NOT NULL ,
`name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`public_email`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`gravatar_email`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`gravatar_id`  varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`location`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`website`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`bio`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
`timezone`  varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
PRIMARY KEY (`user_id`),
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci

;

-- ----------------------------
-- Records of profile
-- ----------------------------
BEGIN;
INSERT INTO `profile` VALUES ('4', null, null, null, null, null, null, null, null), ('7', null, null, null, null, null, null, null, null);
COMMIT;

-- ----------------------------
-- Table structure for `social_account`
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`user_id`  int(11) NULL DEFAULT NULL ,
`provider`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`client_id`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`data`  text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
`code`  varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`created_at`  int(11) NULL DEFAULT NULL ,
`email`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`username`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`role`  smallint(2) NOT NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
UNIQUE INDEX `account_unique` (`provider`, `client_id`) USING BTREE ,
UNIQUE INDEX `account_unique_code` (`code`) USING BTREE ,
INDEX `fk_user_account` (`user_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of social_account
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `token`
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
`user_id`  int(11) NOT NULL ,
`code`  varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`created_at`  int(11) NOT NULL ,
`type`  smallint(6) NOT NULL ,
FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
UNIQUE INDEX `token_unique` (`user_id`, `code`, `type`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci

;

-- ----------------------------
-- Records of token
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `uploads`
-- ----------------------------
DROP TABLE IF EXISTS `uploads`;
CREATE TABLE `uploads` (
`upload_id`  int(11) NOT NULL AUTO_INCREMENT ,
`ref`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`file_name`  varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ชื่อไฟล์' ,
`real_filename`  varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ชื่อไฟล์จริง' ,
`create_date`  timestamp NULL DEFAULT CURRENT_TIMESTAMP ,
`type`  int(11) NULL DEFAULT NULL COMMENT 'ประเภท' ,
PRIMARY KEY (`upload_id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Records of uploads
-- ----------------------------
BEGIN;
INSERT INTO `uploads` VALUES ('1', 'ReCp4zMR_-y_40iZTFbT28', '9645.pdf', '6f9db2b04b21c58581b60e89728714f5.pdf', '2017-01-26 01:51:08', null), ('2', 'pNynCHVVPUfn9ukAXeBGK9', '9645 (1).pdf', 'b640ab2e77362c2a76c753351ebcba05.pdf', '2017-01-26 13:19:03', null);
COMMIT;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`username`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`email`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`password_hash`  varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`auth_key`  varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`confirmed_at`  int(11) NULL DEFAULT NULL ,
`unconfirmed_email`  varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`blocked_at`  int(11) NULL DEFAULT NULL ,
`registration_ip`  varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`created_at`  int(11) NOT NULL ,
`updated_at`  int(11) NOT NULL ,
`last_login_at`  int(11) NOT NULL DEFAULT 0 ,
`flags`  int(11) NOT NULL DEFAULT 0 ,
`role`  int(1) UNSIGNED NOT NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
UNIQUE INDEX `user_unique_email` (`email`) USING BTREE ,
UNIQUE INDEX `user_unique_username` (`username`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci
AUTO_INCREMENT=8

;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
COMMIT;
