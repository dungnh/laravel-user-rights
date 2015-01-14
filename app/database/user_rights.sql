/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : user_permission

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2015-01-14 14:17:01
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin_groups`
-- ----------------------------
DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_groups
-- ----------------------------
INSERT INTO admin_groups VALUES ('1', 'Administrator', '', '[\"admin.users.index\",\"admin.users.create\",\"admin.users.store\",\"admin.users.edit\",\"admin.users.update\",\"admin.users.destroy\",\"admin.groups.index\",\"admin.groups.create\",\"admin.users.store\",\"admin.groups.edit\",\"admin.groups.store\",\"admin.groups.destroy\",\"admin.groups.permission\",\"admin.language.translation\",\"admin.language.index\",\"admin.language.add\"]', '2014-11-22 09:44:08', '2014-11-22 09:44:44');
INSERT INTO admin_groups VALUES ('2', 'Editor', 'Editor group', '[\"admin.users.index\",\"admin.users.create\",\"admin.users.store\",\"admin.users.edit\",\"admin.users.update\"]', '2014-11-22 09:50:26', '2014-12-29 10:59:20');

-- ----------------------------
-- Table structure for `admin_users`
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `date_of_birth` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_supper` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO admin_users VALUES ('1', 'Admin', 'Admin', 'admin@admin.com', '$2y$10$h2E8QXSlJGuxWaL69RXK4OU/WK/1oX48Ujg1zpIzEQP3xV7oBMZyi', '0', null, '1', null, '2014-11-22 09:44:08', '2014-11-22 09:44:08', '1');
INSERT INTO admin_users VALUES ('2', 'Danien', 'Jonh Deep', 'jonh@gmail.com', '$2y$10$Gj4vi.XRJI.6ObLab5gxYOQR.QLBfq3N43LLLzi2BtY5PLWKql88e', '0', null, '1', null, '2014-11-22 09:44:08', '2014-11-22 09:44:08', '0');
INSERT INTO admin_users VALUES ('3', 'Editor', 'Editor', 'editor@gmail.com', '$2y$10$BZMd2vhpe5D4sZScL1PdcuNMbKCW9Z//UHH4vl62JQISHb0Uafg2i', '0', null, '1', null, '2014-11-22 09:46:25', '2014-11-22 09:46:25', '0');

-- ----------------------------
-- Table structure for `admin_user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_groups`;
CREATE TABLE `admin_user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user_groups
-- ----------------------------
INSERT INTO admin_user_groups VALUES ('1', '2', '3');
INSERT INTO admin_user_groups VALUES ('2', '2', '2');

-- ----------------------------
-- Table structure for `app_languages`
-- ----------------------------
DROP TABLE IF EXISTS `app_languages`;
CREATE TABLE `app_languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '1',
  `lack` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of app_languages
-- ----------------------------
INSERT INTO app_languages VALUES ('1', 'English', 'en', '1', '0', '1');
INSERT INTO app_languages VALUES ('2', 'Japanese', 'jp', '0', '127', '298');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` char(36) NOT NULL,
  `code` varchar(5) NOT NULL,
  `languages` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO languages VALUES ('1', 'af', 'Afrikaans', '0', '0');
INSERT INTO languages VALUES ('10', 'zh', 'Chinese (Mandarin)', '0', '0');
INSERT INTO languages VALUES ('11', 'hr', 'Croatian', '0', '0');
INSERT INTO languages VALUES ('12', 'cs', 'Czech', '0', '0');
INSERT INTO languages VALUES ('13', 'da', 'Danish', '0', '0');
INSERT INTO languages VALUES ('14', 'nl', 'Dutch', '0', '0');
INSERT INTO languages VALUES ('15', 'en', 'English', '1', '0');
INSERT INTO languages VALUES ('16', 'et', 'Estonian', '0', '0');
INSERT INTO languages VALUES ('17', 'fj', 'Fiji', '0', '0');
INSERT INTO languages VALUES ('18', 'fi', 'Finnish', '0', '0');
INSERT INTO languages VALUES ('19', 'fr', 'French', '1', '1');
INSERT INTO languages VALUES ('2', 'sq', 'Albanian', '0', '0');
INSERT INTO languages VALUES ('20', 'ka', 'Georgian', '0', '0');
INSERT INTO languages VALUES ('21', 'de', 'German', '1', '0');
INSERT INTO languages VALUES ('22', 'el', 'Greek', '0', '0');
INSERT INTO languages VALUES ('23', 'gu', 'Gujarati', '0', '0');
INSERT INTO languages VALUES ('24', 'he', 'Hebrew', '0', '0');
INSERT INTO languages VALUES ('25', 'hi', 'Hindi', '0', '0');
INSERT INTO languages VALUES ('26', 'hu', 'Hungarian', '0', '0');
INSERT INTO languages VALUES ('27', 'is', 'Icelandic', '0', '0');
INSERT INTO languages VALUES ('28', 'id', 'Indonesian', '0', '0');
INSERT INTO languages VALUES ('29', 'ga', 'Irish', '0', '0');
INSERT INTO languages VALUES ('3', 'ar', 'Arabic', '0', '0');
INSERT INTO languages VALUES ('30', 'it', 'Italian', '0', '0');
INSERT INTO languages VALUES ('31', 'jp', 'Japanese', '0', '0');
INSERT INTO languages VALUES ('32', 'jw', 'Javanese', '0', '0');
INSERT INTO languages VALUES ('33', 'ko', 'Korean', '0', '0');
INSERT INTO languages VALUES ('34', 'la', 'Latin', '0', '0');
INSERT INTO languages VALUES ('35', 'lv', 'Latvian', '0', '0');
INSERT INTO languages VALUES ('36', 'lt', 'Lithuanian', '0', '0');
INSERT INTO languages VALUES ('37', 'mk', 'Macedonian', '0', '0');
INSERT INTO languages VALUES ('38', 'ms', 'Malay', '0', '0');
INSERT INTO languages VALUES ('39', 'ml', 'Malayalam', '0', '0');
INSERT INTO languages VALUES ('4', 'hy', 'Armenian', '0', '0');
INSERT INTO languages VALUES ('40', 'mt', 'Maltese', '0', '0');
INSERT INTO languages VALUES ('41', 'mi', 'Maori', '0', '0');
INSERT INTO languages VALUES ('42', 'mr', 'Marathi', '0', '0');
INSERT INTO languages VALUES ('43', 'mn', 'Mongolian', '0', '0');
INSERT INTO languages VALUES ('44', 'ne', 'Nepali', '0', '0');
INSERT INTO languages VALUES ('45', 'no', 'Norwegian', '0', '0');
INSERT INTO languages VALUES ('46', 'fa', 'Persian', '0', '0');
INSERT INTO languages VALUES ('47', 'pl', 'Polish', '0', '0');
INSERT INTO languages VALUES ('48', 'pt', 'Portuguese', '0', '0');
INSERT INTO languages VALUES ('49', 'pa', 'Punjabi', '0', '0');
INSERT INTO languages VALUES ('5', 'eu', 'Basque', '0', '0');
INSERT INTO languages VALUES ('50', 'qu', 'Quechua', '0', '0');
INSERT INTO languages VALUES ('51', 'ro', 'Romanian', '0', '0');
INSERT INTO languages VALUES ('52', 'ru', 'Russian', '0', '0');
INSERT INTO languages VALUES ('53', 'sm', 'Samoan', '0', '0');
INSERT INTO languages VALUES ('54', 'sr', 'Serbian', '0', '0');
INSERT INTO languages VALUES ('55', 'sk', 'Slovak', '0', '0');
INSERT INTO languages VALUES ('56', 'sl', 'Slovenian', '0', '0');
INSERT INTO languages VALUES ('57', 'es', 'Spanish', '0', '0');
INSERT INTO languages VALUES ('58', 'sw', 'Swahili', '0', '0');
INSERT INTO languages VALUES ('59', 'sv', 'Swedish ', '0', '0');
INSERT INTO languages VALUES ('6', 'bn', 'Bengali', '0', '0');
INSERT INTO languages VALUES ('60', 'ta', 'Tamil', '0', '0');
INSERT INTO languages VALUES ('61', 'tt', 'Tatar', '0', '0');
INSERT INTO languages VALUES ('62', 'te', 'Telugu', '0', '0');
INSERT INTO languages VALUES ('63', 'th', 'Thai', '0', '0');
INSERT INTO languages VALUES ('64', 'bo', 'Tibetan', '0', '0');
INSERT INTO languages VALUES ('65', 'to', 'Tonga', '0', '0');
INSERT INTO languages VALUES ('66', 'tr', 'Turkish', '0', '0');
INSERT INTO languages VALUES ('67', 'uk', 'Ukrainian', '0', '0');
INSERT INTO languages VALUES ('68', 'ur', 'Urdu', '0', '0');
INSERT INTO languages VALUES ('69', 'uz', 'Uzbek', '0', '0');
INSERT INTO languages VALUES ('7', 'bg', 'Bulgarian', '0', '0');
INSERT INTO languages VALUES ('70', 'vi', 'Vietnamese', '0', '0');
INSERT INTO languages VALUES ('71', 'cy', 'Welsh', '0', '0');
INSERT INTO languages VALUES ('72', 'xh', 'Xhosa', '0', '0');
INSERT INTO languages VALUES ('8', 'ca', 'Catalan', '0', '0');
INSERT INTO languages VALUES ('9', 'km', 'Cambodian', '0', '0');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO migrations VALUES ('2014_07_08_143546_create_admin_users_table', '1');
INSERT INTO migrations VALUES ('2014_07_08_144425_crate_admin_groups_table', '1');
INSERT INTO migrations VALUES ('2014_07_08_144835_create_admin_user_group_table', '1');
INSERT INTO migrations VALUES ('2014_07_15_095439_admin_users_add_is_supper', '1');
