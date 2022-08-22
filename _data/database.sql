/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : vc_microsite

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 21/09/2020 12:05:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for wne_admins
-- ----------------------------
DROP TABLE IF EXISTS `wne_admins`;
CREATE TABLE `wne_admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `language_id` int(11) NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT 0,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ga_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Google Authenticator Code',
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` tinyint(4) NULL DEFAULT 1 COMMENT '1: Male, 0: Female',
  `others` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_admins
-- ----------------------------
INSERT INTO `wne_admins` VALUES (1, 'Letha Kutch DDS', 'admin1@gmail.com', NULL, '$2y$10$NztiwFpmgKHlue9HCJi4gOvbLGb5PkO7vOa0TKqOQTqZxR7G/Ib9S', 'dSJNxpBoSerELJVMfAJSiT4uJYciFURYFhlHYGmVIYMyZNSRTYYbwWHiILAl', NULL, -1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, '2019-09-25 11:32:25', '2019-09-25 11:32:25');
INSERT INTO `wne_admins` VALUES (2, 'Maria Lebsack', 'admin2@gmail.com', NULL, '$2y$10$KQkgNEYWU7L/3siHqGZ4PebDMm7Q0MB77C0.7mOzvQnmgIUabdTV2', NULL, NULL, -1, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 4, '2019-09-25 11:32:25', '2019-09-25 11:32:25');

-- ----------------------------
-- Table structure for wne_audits
-- ----------------------------
DROP TABLE IF EXISTS `wne_audits`;
CREATE TABLE `wne_audits`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `module_item_id` int(11) NULL DEFAULT NULL,
  `type_changes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `action` tinyint(4) NULL DEFAULT NULL,
  `before` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `after` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_agent` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 107 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_audits
-- ----------------------------
INSERT INTO `wne_audits` VALUES (17, 'shop_product', 10, 'weight', 2, NULL, '1', NULL, NULL, 1, '2020-03-21 08:12:19', '2020-03-21 08:12:19');
INSERT INTO `wne_audits` VALUES (18, 'shop_product', 10, 'quantity', 2, NULL, '2', NULL, NULL, 1, '2020-03-21 08:12:19', '2020-03-21 08:12:19');
INSERT INTO `wne_audits` VALUES (19, 'cms_news', 30, 'publish_at', 2, NULL, '2020/03/22 00:00:00', NULL, NULL, 1, '2020-03-21 08:40:24', '2020-03-21 08:40:24');
INSERT INTO `wne_audits` VALUES (20, 'cms_news', 30, 'publish_at', 2, '2020-03-22 00:00:00', '2020/03/24 00:00:00', NULL, NULL, 1, '2020-03-21 08:40:32', '2020-03-21 08:40:32');
INSERT INTO `wne_audits` VALUES (21, 'cms_news', 30, 'publish_at', 2, '2020-03-24 00:00:00', '2020-03-25 00:00:00', NULL, NULL, 1, '2020-03-21 08:41:02', '2020-03-21 08:41:02');
INSERT INTO `wne_audits` VALUES (22, 'cms_news', 30, 'gallery', 2, NULL, '{\"media\\/2020-03\\/14\\/favicon-195412.ico\":\"favicon\"}', NULL, NULL, 1, '2020-03-21 08:42:08', '2020-03-21 08:42:08');
INSERT INTO `wne_audits` VALUES (23, 'cms_news', 30, 'gallery', 2, '{\"media\\/2020-03\\/14\\/favicon-195412.ico\":\"favicon\"}', '', NULL, NULL, 1, '2020-03-21 08:42:15', '2020-03-21 08:42:15');
INSERT INTO `wne_audits` VALUES (24, 'shop_order', 18, NULL, 1, NULL, NULL, NULL, NULL, 1, '2020-03-21 10:10:27', '2020-03-21 10:10:27');
INSERT INTO `wne_audits` VALUES (25, 'shop_order', 18, NULL, 0, NULL, NULL, NULL, NULL, 1, '2020-03-21 10:13:35', '2020-03-21 10:13:35');
INSERT INTO `wne_audits` VALUES (26, 'shop_order', 18, NULL, 0, NULL, NULL, NULL, NULL, 1, '2020-03-21 10:13:48', '2020-03-21 10:13:48');
INSERT INTO `wne_audits` VALUES (27, 'shop_order', 18, NULL, 0, NULL, NULL, NULL, NULL, 1, '2020-03-21 10:14:00', '2020-03-21 10:14:00');
INSERT INTO `wne_audits` VALUES (28, 'shop_order', 18, NULL, 1, NULL, NULL, NULL, NULL, 1, '2020-03-21 10:22:16', '2020-03-21 10:22:16');
INSERT INTO `wne_audits` VALUES (29, 'shop_order', 18, NULL, 0, NULL, NULL, NULL, NULL, 1, '2020-03-21 11:20:29', '2020-03-21 11:20:29');
INSERT INTO `wne_audits` VALUES (30, 'shop_product', 1, 'rating', 2, '3', '1', NULL, NULL, 1, '2020-03-21 11:32:58', '2020-03-21 11:32:58');
INSERT INTO `wne_audits` VALUES (31, 'shop_order', 18, NULL, 1, NULL, NULL, NULL, NULL, 1, '2020-03-21 16:37:38', '2020-03-21 16:37:38');
INSERT INTO `wne_audits` VALUES (32, 'shop_order', 18, NULL, 2, NULL, NULL, NULL, NULL, 1, '2020-03-21 16:38:25', '2020-03-21 16:38:25');
INSERT INTO `wne_audits` VALUES (33, 'shop_product', 1, 'views', 2, '10', '9', NULL, NULL, 1, '2020-03-21 16:52:49', '2020-03-21 16:52:49');
INSERT INTO `wne_audits` VALUES (34, 'shop_product', 1, 'views', 2, '10', '9', NULL, NULL, 1, '2020-03-22 08:41:21', '2020-03-22 08:41:21');
INSERT INTO `wne_audits` VALUES (35, 'shop_product', 1, 'introtext', 2, 'Đối với những anh em đam mê cà phê thì chắc hẳn sẽ có suy nghĩ giống mình là muốn sắm một chiếc máy pha cà phê ngay tại nhà. Mình đã tham khảo nhiều loại máy pha cà phê trên thị trường và rất hoang mang không biết nên chọn loại nào. Tuy nhiên, trong một lần tìm hiểu mình đã bắt gặp máy pha cà phê Espresso Tiross TS621 và thấy khá là ưng và phù hợp với điều kiện của bản thân. Nhỏ gọn, sang trọng và đặc biệt là giá cả hết sức phải chăng, phù hợp sử dụng đối với gia đình. Trong bài viết này, mình sẽ review về máy pha cà phê Espresso Tiross TS-621 cho anh em tham khảo.', 'Đối với những anh em đam mê cà phê thì chắc hẳn sẽ có suy nghĩ giống mình là muốn sắm một chiếc máy pha cà phê ngay tại nhà.', NULL, NULL, 1, '2020-03-22 10:28:55', '2020-03-22 10:28:55');
INSERT INTO `wne_audits` VALUES (36, 'cms_news', 30, 'category_id', 2, '3', '6', NULL, NULL, 1, '2020-06-09 13:58:48', '2020-06-09 13:58:48');
INSERT INTO `wne_audits` VALUES (37, 'cms_fields', 31, 'id', 1, '', 'Wow Holiday', NULL, NULL, 1, '2020-06-09 15:52:36', '2020-06-09 15:52:36');
INSERT INTO `wne_audits` VALUES (38, 'cms_fields', 31, 'category_id', 2, '22', '30', NULL, NULL, 1, '2020-06-11 16:36:53', '2020-06-11 16:36:53');
INSERT INTO `wne_audits` VALUES (39, 'cms_fields', 31, 'image', 2, 'media/2020-06/09/banner2-155130.png', 'media/2020-06/11/w-item-1-163502.jpg', NULL, NULL, 1, '2020-06-11 16:36:53', '2020-06-11 16:36:53');
INSERT INTO `wne_audits` VALUES (40, 'cms_fields', 31, 'productline_id', 2, NULL, '24', NULL, NULL, 1, '2020-06-11 16:45:17', '2020-06-11 16:45:17');
INSERT INTO `wne_audits` VALUES (41, 'cms_fields', 32, 'id', 1, '', 'Aeon', NULL, NULL, 1, '2020-06-11 16:48:31', '2020-06-11 16:48:31');
INSERT INTO `wne_audits` VALUES (42, 'cms_fields', 33, 'id', 1, '', 'To Save', NULL, NULL, 1, '2020-06-11 16:49:31', '2020-06-11 16:49:31');
INSERT INTO `wne_audits` VALUES (43, 'cms_fields', 34, 'id', 1, '', 'Dự án 1', NULL, NULL, 1, '2020-06-12 09:37:10', '2020-06-12 09:37:10');
INSERT INTO `wne_audits` VALUES (44, 'cms_fields', 35, 'id', 1, '', 'Dự án 2', NULL, NULL, 1, '2020-06-12 09:40:43', '2020-06-12 09:40:43');
INSERT INTO `wne_audits` VALUES (45, 'cms_fields', 36, 'id', 1, '', 'Dự án 3', NULL, NULL, 1, '2020-06-12 10:12:40', '2020-06-12 10:12:40');
INSERT INTO `wne_audits` VALUES (46, 'cms_fields', 35, 'category_id', 2, '23', '24', NULL, NULL, 1, '2020-06-12 10:16:07', '2020-06-12 10:16:07');
INSERT INTO `wne_audits` VALUES (47, 'cms_fields', 36, 'image', 2, 'media/2020-06/12/w-item-18-101231.jpg', 'media/2020-06/12/hau121-212544.jpg', NULL, NULL, 1, '2020-06-12 21:25:47', '2020-06-12 21:25:47');
INSERT INTO `wne_audits` VALUES (48, 'cms_fields', 36, 'image', 2, 'media/2020-06/12/hau121-212544.jpg', 'media/2020-06/12/images-212733.jpg', NULL, NULL, 1, '2020-06-12 21:27:36', '2020-06-12 21:27:36');
INSERT INTO `wne_audits` VALUES (49, 'cms_fields', 36, 'image_intro', 2, NULL, 'media/2020-06/12/images-212933.jpg', NULL, NULL, 1, '2020-06-12 21:30:10', '2020-06-12 21:30:10');
INSERT INTO `wne_audits` VALUES (50, 'cms_fields', 36, 'introtext', 2, NULL, 'Dự &aacute;n Wow Holiday', NULL, NULL, 1, '2020-06-12 21:32:02', '2020-06-12 21:32:02');
INSERT INTO `wne_audits` VALUES (51, 'cms_fields', 36, 'introtext', 2, 'Dự &aacute;n Wow Holiday', '<h1>sdfsdfsdf</h1>', NULL, NULL, 1, '2020-06-12 21:40:26', '2020-06-12 21:40:26');
INSERT INTO `wne_audits` VALUES (52, 'cms_fields', 36, 'introtext', 2, '<h1>sdfsdfsdf</h1>', '<h1>RACETRAX OFFERS UNIQUE EXPERIENCE THROUGH PERSONALIZED TRIPS TO ONE OF THE BIGGEST, BADDEST AND MOST COMPLEX TRACK EVER MADE &ndash; THE N&Uuml;RBURGRING.</h1>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n</ul>\r\n\r\n<p>Art direction, branding &amp; illustration: Piotr Hojda</p>\r\n\r\n<p>Photo credits: Racetrax + Nicholas Ruggeri / Max Boettinger / Illia Cherednychenko / Lloyd Dirks _ Unsplash</p>', NULL, NULL, 1, '2020-06-12 21:42:18', '2020-06-12 21:42:18');
INSERT INTO `wne_audits` VALUES (53, 'cms_fields', 36, 'fulltext', 2, NULL, '<div><img alt=\"content\" class=\"img-fluid\" src=\"http://microsite_visual.local/media/2020-06/12/content-214433.png\" />\r\n<div>content</div>\r\n</div>\r\n\r\n<p>...</p>', NULL, NULL, 1, '2020-06-12 21:44:41', '2020-06-12 21:44:41');
INSERT INTO `wne_audits` VALUES (54, 'cms_fields', 36, 'fulltext', 2, '<div><img alt=\"content\" class=\"img-fluid\" src=\"http://microsite_visual.local/media/2020-06/12/content-214433.png\" />\r\n<div>content</div>\r\n</div>\r\n\r\n<p>...</p>', '<div><img alt=\"content\" class=\"img-fluid\" src=\"http://microsite_visual.local/media/2020-06/12/content-214433.png\" />\r\n<div>&nbsp;</div>\r\n</div>', NULL, NULL, 1, '2020-06-12 21:46:07', '2020-06-12 21:46:07');
INSERT INTO `wne_audits` VALUES (55, 'cms_fields', 36, 'text_plus', 2, NULL, '<h3>THANK YOU!</h3>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n	<li>By Visual</li>\r\n</ul>\r\n\r\n<p><span style=\"color:#7f8c8d;\">Published: September 13th 2019</span></p>', NULL, NULL, 1, '2020-06-12 21:46:07', '2020-06-12 21:46:07');
INSERT INTO `wne_audits` VALUES (56, 'cms_fields', 36, 'image_home', 2, NULL, 'media/2020-06/12/cropped-224727.jpg', NULL, NULL, 1, '2020-06-12 22:47:30', '2020-06-12 22:47:30');
INSERT INTO `wne_audits` VALUES (57, 'cms_fields', 36, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:47:43', '2020-06-12 22:47:43');
INSERT INTO `wne_audits` VALUES (58, 'cms_fields', 35, 'image', 2, 'media/2020-06/12/w-item-13-094039.jpg', 'media/2020-06/12/w-item-2-225517.jpg', NULL, NULL, 1, '2020-06-12 22:55:41', '2020-06-12 22:55:41');
INSERT INTO `wne_audits` VALUES (59, 'cms_fields', 35, 'image_home', 2, NULL, 'media/2020-06/12/test-2-225537.png', NULL, NULL, 1, '2020-06-12 22:55:41', '2020-06-12 22:55:41');
INSERT INTO `wne_audits` VALUES (60, 'cms_fields', 35, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:55:45', '2020-06-12 22:55:45');
INSERT INTO `wne_audits` VALUES (61, 'cms_fields', 34, 'image_home', 2, NULL, 'media/2020-06/12/test-2-225609.png', NULL, NULL, 1, '2020-06-12 22:56:13', '2020-06-12 22:56:13');
INSERT INTO `wne_audits` VALUES (62, 'cms_fields', 34, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:56:18', '2020-06-12 22:56:18');
INSERT INTO `wne_audits` VALUES (63, 'cms_fields', 33, 'category_id', 2, '24', '23', NULL, NULL, 1, '2020-06-12 22:56:46', '2020-06-12 22:56:46');
INSERT INTO `wne_audits` VALUES (64, 'cms_fields', 33, 'image_home', 2, NULL, 'media/2020-06/12/test-4-225632.png', NULL, NULL, 1, '2020-06-12 22:56:46', '2020-06-12 22:56:46');
INSERT INTO `wne_audits` VALUES (65, 'cms_fields', 33, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:56:50', '2020-06-12 22:56:50');
INSERT INTO `wne_audits` VALUES (66, 'cms_fields', 32, 'image_home', 2, NULL, 'media/2020-06/12/test-3-225704.png', NULL, NULL, 1, '2020-06-12 22:57:07', '2020-06-12 22:57:07');
INSERT INTO `wne_audits` VALUES (67, 'cms_fields', 31, 'category_id', 2, '30', '23', NULL, NULL, 1, '2020-06-12 22:57:41', '2020-06-12 22:57:41');
INSERT INTO `wne_audits` VALUES (68, 'cms_fields', 31, 'image_home', 2, NULL, 'media/2020-06/12/test-4-225727.png', NULL, NULL, 1, '2020-06-12 22:57:41', '2020-06-12 22:57:41');
INSERT INTO `wne_audits` VALUES (69, 'cms_fields', 32, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:57:50', '2020-06-12 22:57:50');
INSERT INTO `wne_audits` VALUES (70, 'cms_fields', 31, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 22:58:30', '2020-06-12 22:58:30');
INSERT INTO `wne_audits` VALUES (71, 'cms_fields', 31, 'featured', 2, '1', '0', NULL, NULL, 1, '2020-06-12 22:59:51', '2020-06-12 22:59:51');
INSERT INTO `wne_audits` VALUES (72, 'cms_fields', 32, 'featured', 2, '1', '0', NULL, NULL, 1, '2020-06-12 22:59:55', '2020-06-12 22:59:55');
INSERT INTO `wne_audits` VALUES (73, 'cms_fields', 32, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 23:00:06', '2020-06-12 23:00:06');
INSERT INTO `wne_audits` VALUES (74, 'cms_fields', 31, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-06-12 23:00:09', '2020-06-12 23:00:09');
INSERT INTO `wne_audits` VALUES (75, 'cms_fields', 36, 'introtext', 2, '31', '<p>31</p>', NULL, NULL, 1, '2020-06-12 23:28:06', '2020-06-12 23:28:06');
INSERT INTO `wne_audits` VALUES (76, 'cms_fields', 42, 'image_intro', 2, 'media/2020-06/12/images-212933.jpg', 'media/2020-06/23/galaxy-a-01-how-to-guide-gpr-0-100331.jpeg', NULL, NULL, 1, '2020-06-23 10:07:57', '2020-06-23 10:07:57');
INSERT INTO `wne_audits` VALUES (77, 'cms_fields', 42, 'introtext', 2, '31', '<h1>Racetrax offers unique experience through personalized trips to one of the biggest, baddest and most complex track ever made – the NÜRBURGRING.</h1>\r\n\r\n<ul>\r\n                                <li>Brand wowholiday.co</li>\r\n                                <li>Client wowholiday</li>\r\n                             </ul>\r\n<p>Art direction, branding &amp; illustration: Piotr Hojda</p>\r\n<p>Photo credits: Racetrax + Nicholas Ruggeri / Max Boettinger / Illia Cherednychenko / Lloyd Dirks _ Unsplash</p>', NULL, NULL, 1, '2020-06-23 10:07:57', '2020-06-23 10:07:57');
INSERT INTO `wne_audits` VALUES (78, 'cms_fields', 42, 'image', 2, 'media/2020-06/12/images-212733.jpg', 'media/2020-06/23/banner2-100814.png', NULL, NULL, 1, '2020-06-23 10:08:17', '2020-06-23 10:08:17');
INSERT INTO `wne_audits` VALUES (79, 'cms_fields', 42, 'introtext', 2, '<h1>Racetrax offers unique experience through personalized trips to one of the biggest, baddest and most complex track ever made – the NÜRBURGRING.</h1>\r\n\r\n<ul>\r\n                                <li>Brand wowholiday.co</li>\r\n                                <li>Client wowholiday</li>\r\n                             </ul>\r\n<p>Art direction, branding &amp; illustration: Piotr Hojda</p>\r\n<p>Photo credits: Racetrax + Nicholas Ruggeri / Max Boettinger / Illia Cherednychenko / Lloyd Dirks _ Unsplash</p>', '<h1>Racetrax offers unique experience through personalized trips to one of the biggest, baddest and most complex track ever made &ndash; the N&Uuml;RBURGRING.</h1>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n</ul>\r\n\r\n<p>Art direction, branding &amp; illustration: Piotr Hojda</p>\r\n\r\n<p>Photo credits: Racetrax + Nicholas Ruggeri / Max Boettinger / Illia Cherednychenko / Lloyd Dirks _ Unsplash</p>', NULL, NULL, 1, '2020-06-23 10:08:17', '2020-06-23 10:08:17');
INSERT INTO `wne_audits` VALUES (80, 'cms_fields', 36, 'image', 2, 'media/2020-06/12/images-212733.jpg', 'media/2020-06/23/chu-ky-so-1581592087310-101000.jpg', NULL, NULL, 1, '2020-06-23 10:10:04', '2020-06-23 10:10:04');
INSERT INTO `wne_audits` VALUES (81, 'cms_fields', 39, 'category_id', 2, '24', '23', NULL, NULL, 1, '2020-06-23 10:10:58', '2020-06-23 10:10:58');
INSERT INTO `wne_audits` VALUES (82, 'cms_news', 31, 'id', 1, '', 'Chương trình khuyến mại xuân 2020', NULL, NULL, 1, '2020-07-04 09:00:30', '2020-07-04 09:00:30');
INSERT INTO `wne_audits` VALUES (83, 'cms_news', 31, 'featured', 2, '0', '1', NULL, NULL, 1, '2020-07-06 10:27:19', '2020-07-06 10:27:19');
INSERT INTO `wne_audits` VALUES (84, 'cms_questions', 31, 'title', 2, 'Chương trình khuyến mại xuân 2020', 'Tin tức 5', NULL, NULL, 1, '2020-09-18 15:47:33', '2020-09-18 15:47:33');
INSERT INTO `wne_audits` VALUES (85, 'cms_questions', 31, 'title', 2, 'Tin tức 5', 'sdfsdf', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (86, 'cms_questions', 31, 'answer_1', 2, NULL, 'tin tưc 1', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (87, 'cms_questions', 31, 'answer_2', 2, NULL, 'tin tưc 2', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (88, 'cms_questions', 31, 'answer_3', 2, NULL, 'tin tưc 3', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (89, 'cms_questions', 31, 'answer_4', 2, NULL, 'tin tưc 4', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (90, 'cms_questions', 31, 'answer_5', 2, NULL, 'tin tưc 5', NULL, NULL, 1, '2020-09-18 15:48:26', '2020-09-18 15:48:26');
INSERT INTO `wne_audits` VALUES (91, 'cms_questions', 32, 'id', 1, '', 'asdfsdf 2', NULL, NULL, 1, '2020-09-18 15:52:59', '2020-09-18 15:52:59');
INSERT INTO `wne_audits` VALUES (92, 'cms_questions', 31, 'ordering', 2, '2', '1', NULL, NULL, 1, '2020-09-18 16:27:38', '2020-09-18 16:27:38');
INSERT INTO `wne_audits` VALUES (93, 'cms_questions', 32, 'ordering', 2, '2', '1', NULL, NULL, 1, '2020-09-18 16:27:49', '2020-09-18 16:27:49');
INSERT INTO `wne_audits` VALUES (94, 'cms_questions', 31, 'ordering', 2, '2', '1', NULL, NULL, 1, '2020-09-18 16:28:37', '2020-09-18 16:28:37');
INSERT INTO `wne_audits` VALUES (95, 'cms_questions', 32, 'ordering', 2, '2', '1', NULL, NULL, 1, '2020-09-18 16:28:53', '2020-09-18 16:28:53');
INSERT INTO `wne_audits` VALUES (96, 'cms_questions', 32, 'ordering', 2, '1', '2', NULL, NULL, 1, '2020-09-18 16:28:56', '2020-09-18 16:28:56');
INSERT INTO `wne_audits` VALUES (97, 'cms_questions', 32, 'ordering', 2, '2', '1', NULL, NULL, 1, '2020-09-18 16:28:58', '2020-09-18 16:28:58');
INSERT INTO `wne_audits` VALUES (98, 'cms_videos_course', 31, 'video_link', 2, NULL, 'media/2020-09/18/2020072409232202-164032.mp4', NULL, NULL, 1, '2020-09-18 16:40:50', '2020-09-18 16:40:50');
INSERT INTO `wne_audits` VALUES (99, 'cms_questions', 32, 'correct', 2, NULL, '2', NULL, NULL, 1, '2020-09-21 08:40:34', '2020-09-21 08:40:34');
INSERT INTO `wne_audits` VALUES (100, 'cms_questions', 32, 'correct', 2, '2', '4', NULL, NULL, 1, '2020-09-21 08:40:46', '2020-09-21 08:40:46');
INSERT INTO `wne_audits` VALUES (101, 'cms_questions', 32, 'correct', 2, '4', '3', NULL, NULL, 1, '2020-09-21 08:42:12', '2020-09-21 08:42:12');
INSERT INTO `wne_audits` VALUES (102, 'cms_questions', 32, 'answer_2', 2, NULL, 'tin tưc 2', NULL, NULL, 1, '2020-09-21 08:59:51', '2020-09-21 08:59:51');
INSERT INTO `wne_audits` VALUES (103, 'cms_questions', 32, 'answer_3', 2, NULL, 'tin tưc 3', NULL, NULL, 1, '2020-09-21 08:59:51', '2020-09-21 08:59:51');
INSERT INTO `wne_audits` VALUES (104, 'cms_questions', 32, 'answer_4', 2, NULL, 'tin tưc 4', NULL, NULL, 1, '2020-09-21 08:59:51', '2020-09-21 08:59:51');
INSERT INTO `wne_audits` VALUES (105, 'cms_questions', 31, 'answer_5', 2, 'tin tưc 5', NULL, NULL, NULL, 1, '2020-09-21 08:59:59', '2020-09-21 08:59:59');
INSERT INTO `wne_audits` VALUES (106, 'cms_questions', 31, 'correct', 2, NULL, '0', NULL, NULL, 1, '2020-09-21 08:59:59', '2020-09-21 08:59:59');

-- ----------------------------
-- Table structure for wne_cms_attr_category
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_attr_category`;
CREATE TABLE `wne_cms_attr_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT 0,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` tinyint(4) NOT NULL DEFAULT 4,
  `ordering` tinyint(4) NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_attr_category
-- ----------------------------
INSERT INTO `wne_cms_attr_category` VALUES (1, 0, 'Thuộc tính cho sản phẩm', NULL, 4, 1, 1, '2020-03-15 10:07:43', 0, '2020-03-15 10:07:43');

-- ----------------------------
-- Table structure for wne_cms_attr_items
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_attr_items`;
CREATE TABLE `wne_cms_attr_items`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT 0,
  `type` int(1) NULL DEFAULT NULL,
  `section` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'skill',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `is_filter` int(1) NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 4,
  `ordering` tinyint(4) NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_attr_items
-- ----------------------------
INSERT INTO `wne_cms_attr_items` VALUES (1, 1, 4, 'skill', 'Kích thước', NULL, NULL, NULL, 1, 4, 1, 1, '2020-03-15 10:08:27', 1, '2020-03-21 22:51:30');
INSERT INTO `wne_cms_attr_items` VALUES (2, 1, 11, 'skill', 'Màu sắc', NULL, NULL, NULL, 0, 4, 2, 1, '2020-03-15 10:08:44', 1, '2020-03-21 16:50:43');
INSERT INTO `wne_cms_attr_items` VALUES (3, 1, 0, 'skill', 'Dài x Rộng x Cao', NULL, NULL, NULL, 0, 4, 4, 1, '2020-03-21 16:42:13', 0, '2020-03-22 08:53:44');
INSERT INTO `wne_cms_attr_items` VALUES (4, 1, 3, 'skill', 'Chế độ Bảo hành', NULL, NULL, NULL, 0, 4, 3, 1, '2020-03-22 08:53:41', 1, '2020-03-22 08:53:44');

-- ----------------------------
-- Table structure for wne_cms_attr_items_options
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_attr_items_options`;
CREATE TABLE `wne_cms_attr_items_options`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `attr_id` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ordering` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_attr_items_options
-- ----------------------------
INSERT INTO `wne_cms_attr_items_options` VALUES (1, 1, 'S', NULL, 1);
INSERT INTO `wne_cms_attr_items_options` VALUES (2, 1, 'M', NULL, 2);
INSERT INTO `wne_cms_attr_items_options` VALUES (3, 1, 'L', NULL, 3);
INSERT INTO `wne_cms_attr_items_options` VALUES (4, 1, 'XL', NULL, 4);
INSERT INTO `wne_cms_attr_items_options` VALUES (5, 2, 'Xanh', 'blue', 1);
INSERT INTO `wne_cms_attr_items_options` VALUES (6, 2, 'Đỏ', 'red', 2);
INSERT INTO `wne_cms_attr_items_options` VALUES (7, 2, 'Tím', 'pink', 3);
INSERT INTO `wne_cms_attr_items_options` VALUES (8, 4, '12 Tháng', NULL, 1);
INSERT INTO `wne_cms_attr_items_options` VALUES (9, 4, '24 Tháng', NULL, 2);

-- ----------------------------
-- Table structure for wne_cms_attr_items_value
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_attr_items_value`;
CREATE TABLE `wne_cms_attr_items_value`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '0',
  `attr_id` int(11) NULL DEFAULT NULL,
  `attr_ordering` int(11) NULL DEFAULT NULL,
  `attr_multiple` tinyint(1) NULL DEFAULT 0,
  `item_id` int(11) NULL DEFAULT NULL,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `value_object` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `value_display` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `value_search` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `must_choose` tinyint(1) NULL DEFAULT 0,
  `related_price` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_attr_items_value
-- ----------------------------
INSERT INTO `wne_cms_attr_items_value` VALUES (18, 'product', 3, 4, 0, 1, '123 cm', '', '', '', 0, 0);
INSERT INTO `wne_cms_attr_items_value` VALUES (19, 'product', 4, 3, 1, 1, '9', '[{\"id\":9,\"attr_id\":4,\"title\":\"24 Th\\u00e1ng\",\"image\":null,\"ordering\":2,\"price\":0,\"qty\":0}]', '24 Tháng', '9,', 0, 0);
INSERT INTO `wne_cms_attr_items_value` VALUES (16, 'product', 1, 1, 1, 1, '1,2', '[{\"id\":1,\"attr_id\":1,\"title\":\"S\",\"image\":null,\"ordering\":1,\"price\":\"1000\",\"qty\":\"30\"},{\"id\":2,\"attr_id\":1,\"title\":\"M\",\"image\":null,\"ordering\":2,\"price\":\"2000\",\"qty\":\"40\"}]', 'S, M', '1,2,', 1, 1);
INSERT INTO `wne_cms_attr_items_value` VALUES (20, 'product', 2, 2, 1, 1, '5,6', '[{\"id\":5,\"attr_id\":2,\"title\":\"Xanh\",\"image\":\"blue\",\"ordering\":1,\"price\":0,\"qty\":0},{\"id\":6,\"attr_id\":2,\"title\":\"\\u0110\\u1ecf\",\"image\":\"red\",\"ordering\":2,\"price\":0,\"qty\":0}]', 'Xanh, Đỏ', '5,6,', 1, 0);

-- ----------------------------
-- Table structure for wne_cms_banners
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_banners`;
CREATE TABLE `wne_cms_banners`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_banners
-- ----------------------------
INSERT INTO `wne_cms_banners` VALUES (17, NULL, 'home1', 'Khách hàng 2', 'media/2020-06/13/test-4-001642.png', NULL, 'https://admicro.vn/', 1, 2, 4, 1, 1, '2020-06-13 00:16:48', '2020-09-18 16:25:55');
INSERT INTO `wne_cms_banners` VALUES (16, NULL, 'home1', 'Khách hàng 1', 'media/2020-06/13/cropped-001604.jpg', NULL, 'https://admicro.vn/', 1, 3, 4, 1, 1, '2020-06-13 00:16:14', '2020-09-18 16:24:21');
INSERT INTO `wne_cms_banners` VALUES (18, NULL, 'home1', 'Khách hàng 3', 'sdfsdf', NULL, NULL, 1, 1, 4, 1, 1, '2020-09-18 15:54:11', '2020-09-18 15:56:04');

-- ----------------------------
-- Table structure for wne_cms_categories
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_categories`;
CREATE TABLE `wne_cms_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `attribute_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT 0,
  `module` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `others` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_categories
-- ----------------------------
INSERT INTO `wne_cms_categories` VALUES (20, NULL, NULL, 0, 1, 'Tin tức', 'tin-tuc', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 4, 1, 1, '2020-07-04 08:58:29', '2020-07-06 10:05:40');

-- ----------------------------
-- Table structure for wne_cms_comments
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_comments`;
CREATE TABLE `wne_cms_comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `module_item_id` int(11) NULL DEFAULT NULL,
  `parent_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `rating` tinyint(4) NULL DEFAULT 1,
  `likes` int(11) NULL DEFAULT 0,
  `status` tinyint(4) NULL DEFAULT 2 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 215 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_comments
-- ----------------------------
INSERT INTO `wne_cms_comments` VALUES (207, 'shop_product', 2, 0, 'Chu văn Vinh', NULL, '0978999256', 'Bình luận số 2', 1, 2, 4, 0, NULL, '2020-03-14 19:30:56', '2020-03-16 12:18:36');
INSERT INTO `wne_cms_comments` VALUES (208, 'shop_product', 2, 207, 'Admin - Hồng', NULL, '978999256', 'Đây là nội dung trả lời bình luận này', 1, 1, 4, 0, NULL, '2020-03-14 19:31:31', '2020-03-16 12:18:39');
INSERT INTO `wne_cms_comments` VALUES (209, 'shop_product', 1, 0, 'Vinh', NULL, '0978999256', 'Tôi đánh giá rất cao sản phẩm này', 1, 1, 4, 0, NULL, '2020-03-14 21:48:02', '2020-03-16 12:54:54');
INSERT INTO `wne_cms_comments` VALUES (210, 'shop_product', 1, 0, 'Vinh', NULL, '0978999256', 'Sản phẩm này rất tốt đấy', 5, 2, 4, 0, 0, '2020-03-14 21:50:02', '2020-03-16 12:54:56');
INSERT INTO `wne_cms_comments` VALUES (211, 'shop_product', 1, 0, 'Vinh', NULL, '0978999256', 'Bài này chỉ đáng 4 sao', 4, 1, 4, 0, NULL, '2020-03-14 22:04:15', '2020-03-16 12:54:58');
INSERT INTO `wne_cms_comments` VALUES (212, 'shop_product', 1, 211, 'Admin', NULL, '0978999256', 'Bạn nói đúng đấy', 1, 1, 2, 0, 1, '2020-03-14 22:08:21', '2020-03-17 16:16:43');
INSERT INTO `wne_cms_comments` VALUES (213, 'shop_product', 1, 0, 'Admin - Hồng', NULL, '978999256', 'Bài này mới nhất đấy nhé', 3, 1, 4, 0, 1, '2020-03-14 22:19:44', '2020-03-17 14:30:40');
INSERT INTO `wne_cms_comments` VALUES (214, 'shop_product', 1, 210, 'Vinh 1', NULL, '978999256', 'Cảm ơn bạn đã quan tâm', 1, 0, 4, 0, 1, '2020-03-14 22:25:39', '2020-03-17 12:21:20');

-- ----------------------------
-- Table structure for wne_cms_contact
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_contact`;
CREATE TABLE `wne_cms_contact`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `item_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1' COMMENT '1: Male, 0: Female',
  `birth_day` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NULL DEFAULT 2 COMMENT '0: Deleted, 1: Draft, 2: UnRead, 3: Read, 4: Reply',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_contact
-- ----------------------------
INSERT INTO `wne_cms_contact` VALUES (1, NULL, NULL, NULL, 'Chu Văn Vinh', NULL, '0978999256', '1', NULL, NULL, 'test', NULL, 4, 0, NULL, '2020-03-14 16:43:53', '2020-03-14 16:43:53');
INSERT INTO `wne_cms_contact` VALUES (2, NULL, 3, NULL, 'Vinh', NULL, '0978999256', '1', NULL, NULL, 'Tôi muốn hỏi sản phẩm này hiện đang bán giá bao nhiêu', NULL, 4, 0, 1, '2020-03-14 22:37:19', '2020-03-17 14:31:28');
INSERT INTO `wne_cms_contact` VALUES (3, NULL, 5, NULL, 'Vinh Chu', NULL, '0978999256', '1', NULL, NULL, '111111', NULL, 2, 0, 1, '2020-03-17 16:22:54', '2020-03-17 16:23:20');
INSERT INTO `wne_cms_contact` VALUES (7, NULL, NULL, NULL, 'Hồ', 'hocongtru95@gmail.com', '0369222669', '0', '01/01/1921', NULL, NULL, NULL, 2, 0, NULL, '2020-07-04 12:15:43', '2020-07-04 12:15:43');
INSERT INTO `wne_cms_contact` VALUES (8, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '03/04/1970', NULL, NULL, NULL, 2, 0, NULL, '2020-07-06 14:53:28', '2020-07-06 14:53:28');
INSERT INTO `wne_cms_contact` VALUES (9, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '03/04/1970', NULL, NULL, NULL, 2, 0, NULL, '2020-07-06 14:53:42', '2020-07-06 14:53:42');
INSERT INTO `wne_cms_contact` VALUES (10, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '01/02/1921', NULL, NULL, NULL, 2, 0, NULL, '2020-07-07 14:06:09', '2020-07-07 14:06:09');
INSERT INTO `wne_cms_contact` VALUES (11, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '03/02/1923', NULL, NULL, NULL, 2, 0, NULL, '2020-07-09 09:24:35', '2020-07-09 09:24:36');
INSERT INTO `wne_cms_contact` VALUES (12, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '03/02/1923', NULL, NULL, NULL, 2, 0, NULL, '2020-07-09 09:25:03', '2020-07-09 09:25:03');
INSERT INTO `wne_cms_contact` VALUES (13, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '02/03/1923', NULL, NULL, NULL, 2, 0, NULL, '2020-07-09 09:25:16', '2020-07-09 09:25:16');
INSERT INTO `wne_cms_contact` VALUES (14, NULL, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', '02/03/1923', NULL, NULL, NULL, 2, 0, NULL, '2020-07-09 10:54:56', '2020-07-09 10:54:56');

-- ----------------------------
-- Table structure for wne_cms_documents
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_documents`;
CREATE TABLE `wne_cms_documents`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_faq
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_faq`;
CREATE TABLE `wne_cms_faq`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `quenstion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_fields
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_fields`;
CREATE TABLE `wne_cms_fields`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `productline_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_intro` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_home` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `text_plus` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `link_demo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `implement_date` date NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `is_hot` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `publish_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_fields
-- ----------------------------
INSERT INTO `wne_cms_fields` VALUES (31, NULL, 23, 24, 'Wow Holiday', 'wow-holiday', NULL, 'media/2020-06/11/w-item-1-163502.jpg', 'media/2020-06/12/test-4-225727.png', NULL, NULL, NULL, NULL, NULL, 100, 1, 0, 1, 4, 1, 1, '2020-06-09 00:00:00', '2020-06-09 15:52:36', '2020-06-12 23:00:09');
INSERT INTO `wne_cms_fields` VALUES (32, NULL, 23, 23, 'Aeon', 'aeon', NULL, 'media/2020-06/11/w-item-2-164751.jpg', 'media/2020-06/12/test-3-225704.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-11 00:00:00', '2020-06-11 16:48:31', '2020-06-12 23:00:06');
INSERT INTO `wne_cms_fields` VALUES (33, NULL, 23, 23, 'To Save', 'to-save', NULL, 'media/2020-06/11/w-item-3-164928.jpg', 'media/2020-06/12/test-4-225632.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-11 00:00:00', '2020-06-11 16:49:31', '2020-06-12 22:56:50');
INSERT INTO `wne_cms_fields` VALUES (34, NULL, 23, NULL, 'Dự án 1', 'du-an-1', NULL, 'media/2020-06/12/w-item-22-093707.jpg', 'media/2020-06/12/test-2-225609.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:37:10', '2020-06-12 22:56:18');
INSERT INTO `wne_cms_fields` VALUES (35, NULL, 24, NULL, 'Dự án 2', 'du-an-2', NULL, 'media/2020-06/12/w-item-2-225517.jpg', 'media/2020-06/12/test-2-225537.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:40:42', '2020-06-12 22:55:45');
INSERT INTO `wne_cms_fields` VALUES (36, NULL, 23, NULL, 'Dự án 3', 'du-an-3', 'media/2020-06/12/images-212933.jpg', 'media/2020-06/23/chu-ky-so-1581592087310-101000.jpg', 'media/2020-06/12/cropped-224727.jpg', '<p>31</p>', '<div><img alt=\"content\" class=\"img-fluid\" src=\"http://microsite_visual.local/media/2020-06/12/content-214433.png\" />\r\n<div>&nbsp;</div>\r\n</div>', '<h3>THANK YOU!</h3>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n	<li>By Visual</li>\r\n</ul>\r\n\r\n<p><span style=\"color:#7f8c8d;\">Published: September 13th 2019</span></p>', NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 10:12:40', '2020-06-23 10:10:04');
INSERT INTO `wne_cms_fields` VALUES (37, NULL, 23, 24, 'Wow Holiday', 'wow-holiday', NULL, 'media/2020-06/11/w-item-1-163502.jpg', 'media/2020-06/12/test-4-225727.png', NULL, NULL, NULL, NULL, NULL, 100, 1, 0, 1, 4, 1, 1, '2020-06-09 00:00:00', '2020-06-09 15:52:36', '2020-06-12 23:00:09');
INSERT INTO `wne_cms_fields` VALUES (38, NULL, 23, NULL, 'Dự án 1', 'du-an-1', NULL, 'media/2020-06/12/w-item-22-093707.jpg', 'media/2020-06/12/test-2-225609.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:37:10', '2020-06-12 22:56:18');
INSERT INTO `wne_cms_fields` VALUES (39, NULL, 23, NULL, 'Dự án 2', 'du-an-2', NULL, 'media/2020-06/12/w-item-2-225517.jpg', 'media/2020-06/12/test-2-225537.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:40:42', '2020-06-23 10:10:58');
INSERT INTO `wne_cms_fields` VALUES (40, NULL, 23, NULL, 'Dự án 1', 'du-an-1', NULL, 'media/2020-06/12/w-item-22-093707.jpg', 'media/2020-06/12/test-2-225609.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:37:10', '2020-06-12 22:56:18');
INSERT INTO `wne_cms_fields` VALUES (41, NULL, 24, NULL, 'Dự án 2', 'du-an-2', NULL, 'media/2020-06/12/w-item-2-225517.jpg', 'media/2020-06/12/test-2-225537.png', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 09:40:42', '2020-06-12 22:55:45');
INSERT INTO `wne_cms_fields` VALUES (42, NULL, 23, NULL, 'Dự án 3', 'du-an-3', 'media/2020-06/23/galaxy-a-01-how-to-guide-gpr-0-100331.jpeg', 'media/2020-06/23/banner2-100814.png', 'media/2020-06/12/cropped-224727.jpg', '<h1>Racetrax offers unique experience through personalized trips to one of the biggest, baddest and most complex track ever made &ndash; the N&Uuml;RBURGRING.</h1>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n</ul>\r\n\r\n<p>Art direction, branding &amp; illustration: Piotr Hojda</p>\r\n\r\n<p>Photo credits: Racetrax + Nicholas Ruggeri / Max Boettinger / Illia Cherednychenko / Lloyd Dirks _ Unsplash</p>', '<div><img alt=\"content\" class=\"img-fluid\" src=\"http://microsite_visual.local/media/2020-06/12/content-214433.png\" />\r\n<div>&nbsp;</div>\r\n</div>', '<h3>THANK YOU!</h3>\r\n\r\n<ul>\r\n	<li>Brand wowholiday.co</li>\r\n	<li>Client wowholiday</li>\r\n	<li>By Visual</li>\r\n</ul>\r\n\r\n<p><span style=\"color:#7f8c8d;\">Published: September 13th 2019</span></p>', NULL, NULL, 1, 1, 0, 1, 4, 1, 1, '2020-06-12 00:00:00', '2020-06-12 10:12:40', '2020-06-23 10:08:17');

-- ----------------------------
-- Table structure for wne_cms_fields_categories
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_fields_categories`;
CREATE TABLE `wne_cms_fields_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `attribute_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT 0,
  `module` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `others` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_fields_categories
-- ----------------------------
INSERT INTO `wne_cms_fields_categories` VALUES (23, NULL, NULL, 33, 1, 'Giải trí', 'giai-tri', NULL, 'media/2020-06/11/work-1-151044.jpg', NULL, NULL, NULL, NULL, 2, 1, 4, 1, 1, '2020-06-11 15:10:50', '2020-06-12 08:51:32');
INSERT INTO `wne_cms_fields_categories` VALUES (24, NULL, NULL, 33, 1, 'Giới trẻ', 'gioi-tre', NULL, 'media/2020-06/11/work-4-151136.jpg', NULL, NULL, NULL, NULL, 3, 1, 4, 1, 1, '2020-06-11 15:11:38', '2020-06-12 08:51:34');
INSERT INTO `wne_cms_fields_categories` VALUES (25, NULL, NULL, 33, 1, 'Mẹ & Bé', 'me--be', NULL, 'media/2020-06/11/work-7-153309.jpg', NULL, NULL, NULL, NULL, 4, 1, 4, 1, 1, '2020-06-11 15:33:17', '2020-06-12 08:51:35');
INSERT INTO `wne_cms_fields_categories` VALUES (26, NULL, NULL, 33, 1, 'Mỹ phẩm', 'my-pham', NULL, 'media/2020-06/11/work-9-153349.jpg', NULL, NULL, NULL, NULL, 5, 1, 4, 1, 1, '2020-06-11 15:33:53', '2020-06-12 08:51:37');
INSERT INTO `wne_cms_fields_categories` VALUES (27, NULL, NULL, 33, 1, 'Dược phẩm', 'duoc-pham', NULL, 'media/2020-06/11/work-2-153422.jpg', NULL, NULL, NULL, NULL, 6, 1, 4, 1, 1, '2020-06-11 15:34:24', '2020-06-12 08:51:39');
INSERT INTO `wne_cms_fields_categories` VALUES (28, NULL, NULL, 33, 1, 'FMCG', 'fmcg', NULL, 'media/2020-06/11/work-5-153451.jpg', NULL, NULL, NULL, NULL, 7, 1, 4, 1, 1, '2020-06-11 15:34:53', '2020-06-12 08:51:41');
INSERT INTO `wne_cms_fields_categories` VALUES (29, NULL, NULL, 33, 1, 'Du lịch', 'du-lich', NULL, 'media/2020-06/11/work-8-153521.jpg', NULL, NULL, NULL, NULL, 8, 1, 4, 1, 1, '2020-06-11 15:35:23', '2020-06-12 08:51:43');
INSERT INTO `wne_cms_fields_categories` VALUES (30, NULL, NULL, 33, 1, 'Bất động sản', 'bat-dong-san', NULL, 'media/2020-06/11/work-10-153546.jpg', NULL, NULL, NULL, NULL, 9, 1, 4, 1, 1, '2020-06-11 15:35:49', '2020-06-12 08:51:44');
INSERT INTO `wne_cms_fields_categories` VALUES (31, NULL, NULL, 33, 1, 'Tài chính', 'tai-chinh', NULL, 'media/2020-06/11/work-3-153611.jpg', NULL, NULL, NULL, NULL, 10, 1, 4, 1, 1, '2020-06-11 15:36:14', '2020-06-12 08:51:46');
INSERT INTO `wne_cms_fields_categories` VALUES (32, NULL, NULL, 33, 1, 'Ngân hàng', 'ngan-hang', NULL, 'media/2020-06/11/work-6-153632.jpg', NULL, NULL, NULL, NULL, 11, 1, 4, 1, 1, '2020-06-11 15:49:44', '2020-06-12 08:51:48');
INSERT INTO `wne_cms_fields_categories` VALUES (33, NULL, NULL, 0, 1, 'Ngành hàng', 'nganh-hang', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 4, 1, 1, '2020-06-12 08:44:36', '2020-06-12 08:45:08');
INSERT INTO `wne_cms_fields_categories` VALUES (34, NULL, NULL, 0, 1, 'Thể loại', 'the-loai', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 4, 1, NULL, '2020-06-12 08:46:48', '2020-06-12 08:46:48');
INSERT INTO `wne_cms_fields_categories` VALUES (35, NULL, NULL, 34, 1, 'Thiết kế quảng cáo trực tuyến', 'thiet-ke-quang-cao-truc-tuyen', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 4, 1, NULL, '2020-06-12 08:47:36', '2020-06-12 08:47:36');
INSERT INTO `wne_cms_fields_categories` VALUES (36, NULL, NULL, 34, 1, 'Tạp chí doanh nghiệp', 'tap-chi-doanh-nghiep', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 4, 1, NULL, '2020-06-12 08:47:51', '2020-06-12 08:47:51');
INSERT INTO `wne_cms_fields_categories` VALUES (37, NULL, NULL, 34, 1, 'THIẾT KẾ SOCIAL MARKETING', 'thiet-ke-social-marketing', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 4, 1, NULL, '2020-06-12 08:48:02', '2020-06-12 08:48:02');
INSERT INTO `wne_cms_fields_categories` VALUES (38, NULL, NULL, 34, 1, 'THIẾT KẾ WEBSITE', 'thiet-ke-website', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 4, 1, NULL, '2020-06-12 08:48:12', '2020-06-12 08:48:12');
INSERT INTO `wne_cms_fields_categories` VALUES (39, NULL, NULL, 34, 1, 'THIẾT KẾ LOGO', 'thiet-ke-logo', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 4, 1, NULL, '2020-06-12 08:48:23', '2020-06-12 08:48:23');
INSERT INTO `wne_cms_fields_categories` VALUES (40, NULL, NULL, 34, 1, 'NHẬN DIỆN THƯƠNG HIỆU', 'nhan-dien-thuong-hieu', NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 4, 1, NULL, '2020-06-12 08:48:38', '2020-06-12 08:48:38');
INSERT INTO `wne_cms_fields_categories` VALUES (41, NULL, NULL, 34, 1, 'THIẾT KẾ BAO BÌ', 'thiet-ke-bao-bi', NULL, NULL, NULL, NULL, NULL, NULL, 7, 0, 4, 1, NULL, '2020-06-12 08:48:53', '2020-06-12 08:48:53');
INSERT INTO `wne_cms_fields_categories` VALUES (42, NULL, NULL, 34, 1, 'THIẾT KẾ IN ẤN', 'thiet-ke-in-an', NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, 4, 1, NULL, '2020-06-12 08:49:07', '2020-06-12 08:49:07');
INSERT INTO `wne_cms_fields_categories` VALUES (43, NULL, NULL, 34, 1, 'MINH HỌA', 'minh-hoa', NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, 4, 1, NULL, '2020-06-12 08:49:21', '2020-06-12 08:49:21');
INSERT INTO `wne_cms_fields_categories` VALUES (44, NULL, NULL, 34, 1, 'ĐỒ HỌA ĐỘNG', 'do-hoa-dong', NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, 4, 1, NULL, '2020-06-12 08:49:31', '2020-06-12 08:49:31');

-- ----------------------------
-- Table structure for wne_cms_fields_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_fields_to_categories`;
CREATE TABLE `wne_cms_fields_to_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of wne_cms_fields_to_categories
-- ----------------------------
INSERT INTO `wne_cms_fields_to_categories` VALUES (14, 35, 39);
INSERT INTO `wne_cms_fields_to_categories` VALUES (10, 35, 24);
INSERT INTO `wne_cms_fields_to_categories` VALUES (5, 36, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (6, 36, 39);
INSERT INTO `wne_cms_fields_to_categories` VALUES (8, 34, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (9, 34, 40);
INSERT INTO `wne_cms_fields_to_categories` VALUES (12, 32, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (13, 32, 36);
INSERT INTO `wne_cms_fields_to_categories` VALUES (15, 33, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (16, 33, 37);
INSERT INTO `wne_cms_fields_to_categories` VALUES (17, 31, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (18, 31, 38);
INSERT INTO `wne_cms_fields_to_categories` VALUES (19, 42, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (20, 42, 35);
INSERT INTO `wne_cms_fields_to_categories` VALUES (21, 40, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (22, 40, 38);
INSERT INTO `wne_cms_fields_to_categories` VALUES (23, 39, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (24, 39, 37);
INSERT INTO `wne_cms_fields_to_categories` VALUES (25, 38, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (26, 38, 40);
INSERT INTO `wne_cms_fields_to_categories` VALUES (27, 37, 23);
INSERT INTO `wne_cms_fields_to_categories` VALUES (28, 37, 39);

-- ----------------------------
-- Table structure for wne_cms_gallery
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_gallery`;
CREATE TABLE `wne_cms_gallery`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_menu
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_menu`;
CREATE TABLE `wne_cms_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_menu
-- ----------------------------
INSERT INTO `wne_cms_menu` VALUES (1, NULL, 'Main Menu', 4, 1, NULL, '2019-09-25 11:49:15', '2019-09-25 11:49:15');

-- ----------------------------
-- Table structure for wne_cms_menu_items
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_menu_items`;
CREATE TABLE `wne_cms_menu_items`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `target` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_news
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_news`;
CREATE TABLE `wne_cms_news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `refer_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `refer_date` date NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `is_hot` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `related_products` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `publish_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_news
-- ----------------------------
INSERT INTO `wne_cms_news` VALUES (31, NULL, 20, 'Chương trình khuyến mại xuân 2020', 'chuong-trinh-khuyen-mai-xuan-2020', 'media/2020-07/04/967946862637130103200819311104-090016.jpg', 'sdfsdfsdf', '<p>sdfsdfsdfsd</p>', '', NULL, NULL, 102, 1, 0, '', 1, 4, 1, 1, '2020-07-04 00:00:00', '2020-07-04 09:00:30', '2020-07-10 11:36:04');

-- ----------------------------
-- Table structure for wne_cms_news_categories
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_news_categories`;
CREATE TABLE `wne_cms_news_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for wne_cms_pages
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_pages`;
CREATE TABLE `wne_cms_pages`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_partners
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_partners`;
CREATE TABLE `wne_cms_partners`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_projects
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_projects`;
CREATE TABLE `wne_cms_projects`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_questions
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_questions`;
CREATE TABLE `wne_cms_questions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `answer_5` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `correct` tinyint(1) NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` int(11) NULL DEFAULT 1,
  `ordering` int(11) NULL DEFAULT 1,
  `is_hot` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `publish_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_questions
-- ----------------------------
INSERT INTO `wne_cms_questions` VALUES (31, NULL, 20, 'sdfsdf', 'tin tưc 1', 'tin tưc 2', 'tin tưc 3', 'tin tưc 4', NULL, 0, 'sdfsdf', 'sdfsdfsdf', '<p>sdfsdfsdfsd</p>', 102, 2, 0, 1, 4, 1, 1, '2020-07-04 00:00:00', '2020-07-04 09:00:30', '2020-09-21 08:59:59');
INSERT INTO `wne_cms_questions` VALUES (32, NULL, NULL, 'asdfsdf 2', 'tin tưc 1', 'tin tưc 2', 'tin tưc 3', 'tin tưc 4', NULL, 3, 'asdfsdf-2', NULL, NULL, 1, 1, 0, 0, 4, 1, 1, '2020-09-18 00:00:00', '2020-09-18 15:52:59', '2020-09-21 08:59:51');

-- ----------------------------
-- Table structure for wne_cms_seo
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_seo`;
CREATE TABLE `wne_cms_seo`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `module_item_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 89 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_seo
-- ----------------------------
INSERT INTO `wne_cms_seo` VALUES (1, 'shop_category', 2, 'Công cụ & Dụng cụ', '', '');
INSERT INTO `wne_cms_seo` VALUES (2, 'shop_category', 4, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (3, 'shop_category', 5, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (4, 'shop_category', 6, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (5, 'shop_category', 7, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (6, 'shop_category', 8, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (7, 'shop_category', 9, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (8, 'shop_category', 10, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (9, 'shop_category', 11, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (10, 'shop_category', 12, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (11, 'shop_category', 13, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (12, 'shop_category', 14, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (13, 'shop_category', 3, 'Máy pha cà phê', '', '');
INSERT INTO `wne_cms_seo` VALUES (14, 'shop_category', 15, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (15, 'shop_category', 16, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (16, 'shop_category', 17, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (17, 'shop_category', 18, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (18, 'shop_category', 19, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (19, 'shop_category', 20, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (20, 'shop_category', 21, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (21, 'shop_product', 1, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (28, 'cms_news', 21, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (29, 'cms_news', 23, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (30, 'cms_news', 24, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (31, 'cms_news', 25, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (32, 'cms_news', 26, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (33, 'cms_category', 17, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (34, 'cms_category', 18, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (35, 'cms_category', 19, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (36, 'cms_news', 27, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (37, 'cms_news', 28, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (38, 'cms_news', 29, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (39, 'cms_news', 30, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (40, 'shop_category', 22, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (22, 'shop_product', 2, 'Cây nước nóng lạnh Sunhouse SHD9601', 'media/2020-03/14/cropped-202441.jpg', 'Cây nước nóng lạnh Sunhouse SHD9601');
INSERT INTO `wne_cms_seo` VALUES (23, 'shop_product', 3, 'Hộp hâm nóng thức ăn Mishio MK-182 inox 304', 'media/2020-03/14/cropped-202654.jpg', 'Hộp cơm hâm nóng đa năng phù hợp nhu cầu sử dụng giữ ấm cơm cho nhân viên văn phòng, mang theo đồ ăn đi dã ngoại, người làm việc bên ngoài, thậm chí dùng để nấu cơm cho gia đình từ 1 - 2 người. Hộp hâm cơm thức ăn là loại nồi cơm mini có cắm điện phục vụ nhu cầu ăn nóng, ăn sạch nhưng gọn nhẹ của người tiêu dùng.');
INSERT INTO `wne_cms_seo` VALUES (24, 'shop_product', 4, 'Máy vắt cam Hafele GS-401', 'media/2020-03/14/cropped-203758.jpg', 'Máy vắt cam Hafele GS-401 (535.43.089) có công suất hoạt động tối đa là 100W, đảm bảo tốc độ quay vắt sẽ ổn định hơn, giúp bạn nhanh chóng có được những cốc nước cam bổ dưỡng.');
INSERT INTO `wne_cms_seo` VALUES (25, 'shop_product', 5, 'Quạt trần Panasonic F-56MZG (4 cánh - có điều khiển từ xa)', 'media/2020-03/18/damcuoilangmancuamch-115557.jpg', 'Quạt trần Panasonic F-56MZG được trang bị tới 4 cánh quạt, sải cánh dài với đường kính cánh lên tới 140cm cho khả năng làm mát cho không gian phòng rộng thật hiệu quả. fds fdsa fdsa fdsa fsda dfsda fsda dfsad fsad fsda fsda fsd afsda fsd à sdaf sda fsda fsda fsda fsda fsda fsda fsda fsda fsda fasd fsda fsda fsda fsda fsda fsda fasd fsdaf sad');
INSERT INTO `wne_cms_seo` VALUES (26, 'cms_category', 16, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (27, 'cms_news', 22, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (41, 'shop_category', 23, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (42, 'shop_category', 24, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (43, 'shop_category', 25, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (44, 'shop_category', 26, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (45, 'shop_category', 27, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (46, 'shop_category', 28, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (47, 'shop_category', 29, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (48, 'shop_product', 6, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (49, 'shop_product', 7, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (50, 'shop_product', 8, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (51, 'shop_product', 9, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (52, 'shop_product', 10, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (53, 'cms_category', 20, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (54, 'cms_category', 21, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (55, 'cms_category', 22, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (56, 'cms_news', 31, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (57, 'cms_category', 23, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (58, 'cms_category', 24, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (59, 'cms_category', 25, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (60, 'cms_category', 26, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (61, 'cms_category', 27, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (62, 'cms_category', 28, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (63, 'cms_category', 29, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (64, 'cms_category', 30, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (65, 'cms_category', 31, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (66, 'cms_category', 32, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (67, 'cms_news', 32, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (68, 'cms_news', 33, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (69, 'cms_category', 33, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (70, 'cms_category', 34, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (71, 'cms_category', 35, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (72, 'cms_category', 36, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (73, 'cms_category', 37, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (74, 'cms_category', 38, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (75, 'cms_category', 39, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (76, 'cms_category', 40, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (77, 'cms_category', 41, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (78, 'cms_category', 42, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (79, 'cms_category', 43, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (80, 'cms_category', 44, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (81, 'cms_news', 34, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (82, 'cms_news', 35, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (83, 'cms_news', 36, '', '', '');
INSERT INTO `wne_cms_seo` VALUES (84, 'cms_news', 42, 'Dự án 3', 'media/2020-06/12/images-212733.jpg', '31');
INSERT INTO `wne_cms_seo` VALUES (85, 'cms_news', 40, 'Dự án 1', 'media/2020-06/12/w-item-22-093707.jpg', '');
INSERT INTO `wne_cms_seo` VALUES (86, 'cms_news', 39, 'Dự án 2', 'media/2020-06/12/w-item-2-225517.jpg', '');
INSERT INTO `wne_cms_seo` VALUES (87, 'cms_news', 38, 'Dự án 1', 'media/2020-06/12/w-item-22-093707.jpg', '');
INSERT INTO `wne_cms_seo` VALUES (88, 'cms_news', 37, 'Wow Holiday', 'media/2020-06/11/w-item-1-163502.jpg', '');

-- ----------------------------
-- Table structure for wne_cms_staff
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_staff`;
CREATE TABLE `wne_cms_staff`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `position` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `experence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1' COMMENT '1: Male, 0: Female',
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NULL DEFAULT 2 COMMENT '0: Deleted, 1: Draft, 2: UnRead, 3: Read, 4: Reply',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_staff
-- ----------------------------
INSERT INTO `wne_cms_staff` VALUES (1, NULL, 'Chu Văn Vinh', NULL, '0978999256', NULL, NULL, NULL, '1', NULL, NULL, 4, 0, NULL, '2020-03-14 16:43:53', '2020-03-14 16:43:53');
INSERT INTO `wne_cms_staff` VALUES (2, NULL, 'Vinh', NULL, '0978999256', NULL, NULL, NULL, '1', NULL, NULL, 4, 0, 1, '2020-03-14 22:37:19', '2020-03-17 14:31:28');
INSERT INTO `wne_cms_staff` VALUES (3, NULL, 'Vinh Chu', NULL, '0978999256', NULL, NULL, NULL, '1', NULL, NULL, 4, 0, 1, '2020-03-17 16:22:54', '2020-06-12 23:56:13');
INSERT INTO `wne_cms_staff` VALUES (7, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', 'Nhân viên lập trình', 'Senior', 'media/2020-06/12/test-2-235333.png', '1', 'Số 42, Lê Quang Đạo', 'Là một nhân viên lập trình PHP', 4, 1, 1, '2020-06-09 14:32:38', '2020-06-12 23:56:10');

-- ----------------------------
-- Table structure for wne_cms_subscribe
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_subscribe`;
CREATE TABLE `wne_cms_subscribe`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1' COMMENT '1: Male, 0: Female',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_cms_tags
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_tags`;
CREATE TABLE `wne_cms_tags`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_tags
-- ----------------------------
INSERT INTO `wne_cms_tags` VALUES (1, 'Virut Corona', NULL, 3, 1, 1, '2020-02-10 16:11:17', '2020-02-10 16:11:32');
INSERT INTO `wne_cms_tags` VALUES (2, 'Tag mới', NULL, 3, 1, NULL, '2020-03-13 22:36:00', '2020-03-13 22:36:00');

-- ----------------------------
-- Table structure for wne_cms_tags_modules
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_tags_modules`;
CREATE TABLE `wne_cms_tags_modules`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `module_item_id` int(11) NULL DEFAULT NULL,
  `tag_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_tags_modules
-- ----------------------------
INSERT INTO `wne_cms_tags_modules` VALUES (4, 'product', 5, '2');
INSERT INTO `wne_cms_tags_modules` VALUES (6, 'news', 21, '2');

-- ----------------------------
-- Table structure for wne_cms_test
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_test`;
CREATE TABLE `wne_cms_test`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1' COMMENT '1: Male, 0: Female',
  `score` tinyint(4) NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NULL DEFAULT 2 COMMENT '0: Deleted, 1: Draft, 2: UnRead, 3: Read, 4: Reply',
  `user_id` int(11) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_test
-- ----------------------------
INSERT INTO `wne_cms_test` VALUES (1, NULL, NULL, 'Chu Văn Vinh', NULL, '0978999256', '1', NULL, 'test', 4, NULL, 0, NULL, '2020-03-14 16:43:53', '2020-03-14 16:43:53');
INSERT INTO `wne_cms_test` VALUES (2, NULL, NULL, 'Vinh', NULL, '0978999256', '1', NULL, 'Tôi muốn hỏi sản phẩm này hiện đang bán giá bao nhiêu', 4, NULL, 0, 1, '2020-03-14 22:37:19', '2020-03-17 14:31:28');
INSERT INTO `wne_cms_test` VALUES (3, NULL, NULL, 'Vinh Chu', NULL, '0978999256', '1', NULL, '111111', 2, NULL, 0, 1, '2020-03-17 16:22:54', '2020-03-17 16:23:20');
INSERT INTO `wne_cms_test` VALUES (7, NULL, NULL, 'Hồ', 'hocongtru95@gmail.com', '0369222669', '0', NULL, NULL, 2, NULL, 0, NULL, '2020-07-04 12:15:43', '2020-07-04 12:15:43');
INSERT INTO `wne_cms_test` VALUES (8, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', NULL, NULL, 2, NULL, 0, NULL, '2020-07-06 14:53:28', '2020-07-06 14:53:28');
INSERT INTO `wne_cms_test` VALUES (9, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', NULL, NULL, 2, NULL, 0, NULL, '2020-07-06 14:53:42', '2020-07-06 14:53:42');
INSERT INTO `wne_cms_test` VALUES (10, NULL, NULL, 'Hồ Công Trứ', 'hocongtru95@gmail.com', '0369222669', '0', NULL, NULL, 2, NULL, 0, NULL, '2020-07-07 14:06:09', '2020-07-07 14:06:09');

-- ----------------------------
-- Table structure for wne_cms_video
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_video`;
CREATE TABLE `wne_cms_video`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `media_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `youtube_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `related_products` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `views` int(11) NULL DEFAULT 1,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `publish_at` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_video
-- ----------------------------
INSERT INTO `wne_cms_video` VALUES (5, NULL, 0, 'Hướng dẫn cách làm Kho quẹt tóp mỡ tôm khô', 'huong-dan-cach-lam-kho-quet-top-mo-tom-kho', NULL, NULL, NULL, NULL, 'Wat0J5UeIpY', '', 3, 0, 4, NULL, 1, NULL, '2020-03-12 20:06:17', '2020-03-16 12:02:00');
INSERT INTO `wne_cms_video` VALUES (6, NULL, 17, 'Quay phim Foody, món ăn ngon', 'quay-phim-foody-mon-an-ngon', NULL, NULL, NULL, NULL, 'pD-ix15xRP8', '', 6, 0, 4, NULL, 1, NULL, '2020-03-12 20:09:13', '2020-07-07 12:08:18');
INSERT INTO `wne_cms_video` VALUES (7, NULL, 16, 'Quay phim, chụp ảnh - Food Bánh Mỳ và Salad', 'quay-phim-chup-anh--food-banh-my-va-salad', 'media/2020-07/07/bophatwifitusim-3-g-4-ghuaweie-110547.jpeg', 'media/2020-07/07/top-5-intro-template-no-text---110607.mp4', NULL, NULL, 'gEeCefzLjIM', '', 3, 0, 4, NULL, 1, NULL, '2020-03-12 20:09:34', '2020-07-07 11:06:18');
INSERT INTO `wne_cms_video` VALUES (8, NULL, 17, 'Video Quảng cáo Sản phẩm Handmade Sapo', 'video-quang-cao-san-pham-handmade-sapo', NULL, 'media/2020-07/04/2-top-5-intro-template-no-text-092751.mp3', NULL, NULL, 'brzqPzcQCJE', '', 3, 0, 4, NULL, 1, NULL, '2020-03-12 20:09:57', '2020-07-07 11:04:45');
INSERT INTO `wne_cms_video` VALUES (9, NULL, 16, 'GIỚI THIỆU SẢN PHẨM _ ACAFÉ', 'gioi-thieu-san-pham--acafe', 'media/2020-07/07/1-1581642232492-105535.jpg', 'media/2020-07/04/top-5-intro-template-no-text---092003.mp4', NULL, NULL, 'PDZwpSvhmVw', '', 4, 1, 4, NULL, 1, NULL, '2020-03-12 20:10:22', '2020-07-07 10:55:37');

-- ----------------------------
-- Table structure for wne_cms_video_category
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_video_category`;
CREATE TABLE `wne_cms_video_category`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `attribute_id` int(11) NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT 0,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `others` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_video_category
-- ----------------------------
INSERT INTO `wne_cms_video_category` VALUES (16, NULL, NULL, 0, 'Video', 'video', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 4, 1, 1, '2020-03-14 10:06:22', '2020-07-04 09:01:40');
INSERT INTO `wne_cms_video_category` VALUES (17, NULL, NULL, 0, 'Âm thanh', 'am-thanh', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 4, 1, 1, '2020-07-04 09:01:50', '2020-07-04 09:06:10');

-- ----------------------------
-- Table structure for wne_cms_videos_course
-- ----------------------------
DROP TABLE IF EXISTS `wne_cms_videos_course`;
CREATE TABLE `wne_cms_videos_course`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `video_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `is_hot` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `featured` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `publish_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_cms_videos_course
-- ----------------------------
INSERT INTO `wne_cms_videos_course` VALUES (31, NULL, 20, 'Chương trình khuyến mại xuân 2020', 'media/2020-09/18/2020072409232202-164032.mp4', 'chuong-trinh-khuyen-mai-xuan-2020', 'media/2020-07/04/967946862637130103200819311104-090016.jpg', 'sdfsdfsdf', '<p>sdfsdfsdfsd</p>', 1, 0, 1, 4, 1, 1, '2020-07-04 00:00:00', '2020-07-04 09:00:30', '2020-09-18 16:40:50');

-- ----------------------------
-- Table structure for wne_contest
-- ----------------------------
DROP TABLE IF EXISTS `wne_contest`;
CREATE TABLE `wne_contest`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT 0,
  `round` int(11) NULL DEFAULT 1,
  `language_id` int(11) NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_full` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_share` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_exif` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_root` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `votes` int(11) NULL DEFAULT 0,
  `shares` int(11) NULL DEFAULT 0,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ip_address` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shared` tinyint(1) NULL DEFAULT NULL,
  `ranks` int(11) NULL DEFAULT 0,
  `user_id` int(11) NULL DEFAULT NULL,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `gift_id` int(11) NULL DEFAULT 0,
  `featured` tinyint(1) NULL DEFAULT 0,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `utm_source` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `utm_medium` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `utm_campaign` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 161 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_contest
-- ----------------------------
INSERT INTO `wne_contest` VALUES (157, 2, 0, NULL, 'media/2020-03/10/15838136846507.jpg', 'media/2020-03/10/1583813685188577.jpg', 'media/2020-03/10/1583813685436173.jpg', '{\"FileName\":\"1583813685528534.jpg\",\"FileDateTime\":1583813685,\"FileSize\":48719,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"\",\"COMPUTED\":{\"html\":\"width=\\\"640\\\" height=\\\"507\\\"\",\"Height\":507,\"Width\":640,\"IsColor\":1}}', 'media/2020-03/10/1583813685528534.jpg', 'gfsdfsd', 'gfsdfsd', 'gfsdfsd', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-03-10 11:14:45', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (153, 2, 1, NULL, 'media/2020-02/26/1582710010697346.jpg', 'media/2020-02/26/1582710010358360.jpg', 'media/2020-02/26/15827100102037.jpg', '{\"FileName\":\"1582710010224673.jpg\",\"FileDateTime\":1582710010,\"FileSize\":54825,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"\",\"COMPUTED\":{\"html\":\"width=\\\"480\\\" height=\\\"640\\\"\",\"Height\":640,\"Width\":480,\"IsColor\":1}}', 'media/2020-02/26/1582710010224673.jpg', 'fdsaf ds', 'fdsaf-ds', 'fdsaf ds', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-02-26 16:40:10', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (159, 2, 0, NULL, 'media/2020-03/10/1583813951832596.jpg', 'media/2020-03/10/1583813951161423.jpg', 'media/2020-03/10/1583813951415803.jpg', '{\"FileName\":\"158381395147651.jpg\",\"FileDateTime\":1583813951,\"FileSize\":48719,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"\",\"COMPUTED\":{\"html\":\"width=\\\"640\\\" height=\\\"507\\\"\",\"Height\":507,\"Width\":640,\"IsColor\":1}}', 'media/2020-03/10/158381395147651.jpg', 'fdsafsda', 'fdsafsda', 'fdsafsda', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-03-10 11:19:11', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (158, 2, 0, NULL, 'media/2020-03/10/1583813708160720.jpg', 'media/2020-03/10/1583813709797299.jpg', 'media/2020-03/10/1583813708124687.jpg', '{\"FileName\":\"1583813709245505.jpg\",\"FileDateTime\":1583813709,\"FileSize\":48719,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"\",\"COMPUTED\":{\"html\":\"width=\\\"640\\\" height=\\\"507\\\"\",\"Height\":507,\"Width\":640,\"IsColor\":1}}', 'media/2020-03/10/1583813709245505.jpg', 'fdsafdsa', 'fdsafdsa', 'fdsafdsa', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-03-10 11:15:09', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (152, 3, 1, NULL, 'media/2020-02/22/1582343384451066.jpg', 'media/2020-02/22/1582343384888951.jpg', 'media/2020-02/22/1582343384116659.jpg', '{\"FileName\":\"1582343384182074.jpg\",\"FileDateTime\":1582343384,\"FileSize\":48719,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"\",\"COMPUTED\":{\"html\":\"width=\\\"640\\\" height=\\\"507\\\"\",\"Height\":507,\"Width\":640,\"IsColor\":1}}', 'media/2020-02/22/1582343384182074.jpg', '111111111', '111111111', '111111111', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, 1, '2020-02-22 10:49:44', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (154, 2, 1, NULL, 'media/2020-02/26/1582710038335072.jpg', 'media/2020-02/26/1582710038527750.jpg', 'media/2020-02/26/158271003895301.jpg', '{\"FileName\":\"1582710038916827.jpg\",\"FileDateTime\":1582710038,\"FileSize\":5629,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0\",\"COMPUTED\":{\"html\":\"width=\\\"140\\\" height=\\\"140\\\"\",\"Height\":140,\"Width\":140,\"IsColor\":1,\"ByteOrderMotorola\":0},\"Software\":\"Google\"}', 'media/2020-02/26/1582710038916827.jpg', 'dsafgsdafsd', 'dsafgsdafsd', 'dsafgsdafsd', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-02-26 16:40:38', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (155, 2, 1, NULL, 'media/2020-02/26/1582712662657520.jpg', 'media/2020-02/26/1582712662809311.jpg', 'media/2020-02/26/1582712661846803.jpg', '{\"FileName\":\"1582712662438130.jpg\",\"FileDateTime\":1582712662,\"FileSize\":575077,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF, GPS\",\"COMPUTED\":{\"html\":\"width=\\\"2576\\\" height=\\\"1160\\\"\",\"Height\":1160,\"Width\":2576,\"IsColor\":1,\"ByteOrderMotorola\":0,\"ApertureFNumber\":\"f\\/2.4\",\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\",\"Thumbnail.Height\":230,\"Thumbnail.Width\":512},\"ImageWidth\":2576,\"ImageLength\":1160,\"Make\":\"samsung\",\"Model\":\"SM-A515F\",\"Orientation\":6,\"XResolution\":\"72\\/1\",\"YResolution\":\"72\\/1\",\"ResolutionUnit\":2,\"Software\":\"A515FXXU1ATA4\",\"DateTime\":\"2020:02:26 17:08:58\",\"YCbCrPositioning\":1,\"Exif_IFD_Pointer\":238,\"GPS_IFD_Pointer\":656,\"THUMBNAIL\":{\"ImageWidth\":512,\"ImageLength\":230,\"Compression\":6,\"XResolution\":\"72\\/1\",\"YResolution\":\"72\\/1\",\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":876,\"JPEGInterchangeFormatLength\":27396},\"ExposureTime\":\"1\\/346\",\"FNumber\":\"240\\/100\",\"ExposureProgram\":2,\"ISOSpeedRatings\":40,\"ExifVersion\":\"0220\",\"DateTimeOriginal\":\"2020:02:26 17:08:58\",\"DateTimeDigitized\":\"2020:02:26 17:08:58\",\"ShutterSpeedValue\":\"1\\/346\",\"ApertureValue\":\"252\\/100\",\"BrightnessValue\":\"1775\\/100\",\"ExposureBiasValue\":\"0\\/100\",\"MaxApertureValue\":\"252\\/100\",\"MeteringMode\":2,\"Flash\":0,\"FocalLength\":\"213\\/100\",\"ColorSpace\":1,\"ExifImageWidth\":2576,\"ExifImageLength\":1160,\"ExposureMode\":0,\"WhiteBalance\":0,\"DigitalZoomRatio\":\"100\\/100\",\"FocalLengthIn35mmFilm\":25,\"SceneCaptureType\":0,\"ImageUniqueID\":\"B05LGMG11AM\",\"GPSLatitudeRef\":\"N\",\"GPSLatitude\":[\"20\\/1\",\"24\\/1\",\"9808559\\/1000000\"],\"GPSLongitudeRef\":\"E\",\"GPSLongitude\":[\"106\\/1\",\"29\\/1\",\"48205320\\/1000000\"]}', 'media/2020-02/26/1582712662438130.jpg', 'dfsafdsa', 'dfsafdsa', 'dfsafdsa', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, NULL, '2020-02-26 17:24:22', '2020-03-10 12:29:01');
INSERT INTO `wne_contest` VALUES (156, 2, 1, NULL, 'media/2020-02/28/cropped-113014.jpg', 'media/2020-02/28/cropped-113014.jpg', 'media/2020-02/27/1582780558477127.jpg', '{\"FileName\":\"1582780558501294.jpg\",\"FileDateTime\":1582780558,\"FileSize\":328795,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\",\"COMPUTED\":{\"html\":\"width=\\\"2133\\\" height=\\\"1200\\\"\",\"Height\":1200,\"Width\":2133,\"IsColor\":1,\"ByteOrderMotorola\":0,\"CCDWidth\":\"8mm\",\"ApertureFNumber\":\"f\\/2.4\",\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"ImageWidth\":8688,\"ImageLength\":5792,\"BitsPerSample\":[8,8,8],\"Compression\":1,\"Make\":\"samsung\",\"Model\":\"SM-A515F\",\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":\"3000000\\/10000\",\"YResolution\":\"3000000\\/10000\",\"PlanarConfiguration\":1,\"ResolutionUnit\":2,\"Software\":\"A515FXXU1ASL6\",\"DateTime\":\"2020:02:23 09:39:58\",\"Exif_IFD_Pointer\":266,\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":\"72\\/1\",\"YResolution\":\"72\\/1\",\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":984,\"JPEGInterchangeFormatLength\":3796},\"ExposureTime\":\"1\\/110\",\"FNumber\":\"12\\/5\",\"ExposureProgram\":1,\"ISOSpeedRatings\":64,\"UndefinedTag:0x8830\":2,\"UndefinedTag:0x8832\":100,\"ExifVersion\":\"0231\",\"DateTimeOriginal\":\"2020:02:21 05:47:52\",\"DateTimeDigitized\":\"2020:02:21 05:47:52\",\"UndefinedTag:0x9010\":\"-05:00\",\"ShutterSpeedValue\":\"7643856\\/1000000\",\"ApertureValue\":\"6\\/1\",\"ExposureBiasValue\":\"0\\/1\",\"MaxApertureValue\":\"3\\/1\",\"MeteringMode\":2,\"Flash\":9,\"FocalLength\":\"2\\/1\",\"SubSecTimeOriginal\":\"99\",\"SubSecTimeDigitized\":\"99\",\"ColorSpace\":65535,\"ExifImageWidth\":2133,\"ExifImageLength\":1200,\"FocalPlaneXResolution\":\"79080107\\/32768\",\"FocalPlaneYResolution\":\"79080107\\/32768\",\"FocalPlaneResolutionUnit\":3,\"CustomRendered\":0,\"ExposureMode\":1,\"WhiteBalance\":0,\"FocalLengthIn35mmFilm\":25,\"SceneCaptureType\":0,\"UndefinedTag:0xA431\":\"032021000152\",\"UndefinedTag:0xA432\":[\"65\\/1\",\"65\\/1\",\"0\\/0\",\"0\\/0\"],\"UndefinedTag:0xA434\":\"MP-E65mm f\\/2.8 1-5x Macro Photo\",\"UndefinedTag:0xA435\":\"0000000000\"}', 'media/2020-02/27/1582780558501294.jpg', 'gádfdsa', 'gadfdsa', 'gádfdsa', NULL, 0, 0, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36', NULL, NULL, 0, NULL, 'Chu văn Vinh', 'chuvanvinh@gmail.com', '0978999256', NULL, NULL, NULL, 1, 0, 0, 3, NULL, NULL, NULL, 0, 1, '2020-02-27 12:15:58', '2020-03-10 12:29:01');

-- ----------------------------
-- Table structure for wne_contest_category
-- ----------------------------
DROP TABLE IF EXISTS `wne_contest_category`;
CREATE TABLE `wne_contest_category`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT 0,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_contest_category
-- ----------------------------
INSERT INTO `wne_contest_category` VALUES (1, 0, 'Thế giới ẩm thực', 'the-gioi-am-thuc', NULL, NULL, NULL, 1, 4, 1, 1, '2019-09-26 14:18:52', '2020-02-20 17:26:10');
INSERT INTO `wne_contest_category` VALUES (2, 0, 'Thiên nhiên diệu kỳ', 'thien-nhien-dieu-ky', NULL, NULL, NULL, 2, 4, 1, 1, '2019-09-26 14:19:07', '2020-03-05 10:05:43');
INSERT INTO `wne_contest_category` VALUES (3, 0, 'Cuộc sống muôn màu', 'cuoc-song-muon-mau', NULL, NULL, NULL, 3, 4, 1, 1, '2019-09-26 14:19:18', '2020-03-05 10:05:58');

-- ----------------------------
-- Table structure for wne_contest_gift
-- ----------------------------
DROP TABLE IF EXISTS `wne_contest_gift`;
CREATE TABLE `wne_contest_gift`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `week` tinyint(1) NULL DEFAULT NULL,
  `card_type` tinyint(2) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `user_mobile` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `contest_id` int(11) NULL DEFAULT NULL,
  `received_at` timestamp(0) NULL DEFAULT NULL,
  `release_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3001 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_contest_log
-- ----------------------------
DROP TABLE IF EXISTS `wne_contest_log`;
CREATE TABLE `wne_contest_log`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NULL DEFAULT 1 COMMENT '1: Vote, 2: Share',
  `contest_id` int(11) NULL DEFAULT 0,
  `user_id` int(11) NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ip_address` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_contest_log
-- ----------------------------
INSERT INTO `wne_contest_log` VALUES (5, 1, 66, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '127.0.0.1', NULL, NULL, '2019-10-02 14:21:53', '2019-10-02 14:21:53');
INSERT INTO `wne_contest_log` VALUES (4, 2, 66, 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '127.0.0.1', NULL, NULL, '2019-10-02 14:20:47', '2019-10-02 14:20:47');

-- ----------------------------
-- Table structure for wne_failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `wne_failed_jobs`;
CREATE TABLE `wne_failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_languages
-- ----------------------------
DROP TABLE IF EXISTS `wne_languages`;
CREATE TABLE `wne_languages`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `default` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `flag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ordering` tinyint(4) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_languages
-- ----------------------------
INSERT INTO `wne_languages` VALUES (1, 'Tiếng Việt', 'vi', 'vi_VN', 0, '', 1, NULL, NULL, 4, '2019-09-25 11:32:25', '2020-03-12 10:40:32');
INSERT INTO `wne_languages` VALUES (2, 'English', 'en', 'en_GB', 1, '', 2, NULL, NULL, 4, '2019-09-25 11:32:25', '2020-03-12 10:40:32');

-- ----------------------------
-- Table structure for wne_languages_refer
-- ----------------------------
DROP TABLE IF EXISTS `wne_languages_refer`;
CREATE TABLE `wne_languages_refer`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `item_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `item_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_location_district
-- ----------------------------
DROP TABLE IF EXISTS `wne_location_district`;
CREATE TABLE `wne_location_district`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `ordering` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 974 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_location_province
-- ----------------------------
DROP TABLE IF EXISTS `wne_location_province`;
CREATE TABLE `wne_location_province`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ordering` tinyint(1) NULL DEFAULT 3,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of wne_location_province
-- ----------------------------
INSERT INTO `wne_location_province` VALUES (1, 'Hà Nội', 'Trung ương', 1);
INSERT INTO `wne_location_province` VALUES (2, 'Hà Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (4, 'Cao Bằng', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (6, 'Bắc Kạn', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (8, 'Tuyên Quang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (10, 'Lào Cai', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (11, 'Điện Biên', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (12, 'Lai Châu', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (14, 'Sơn La', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (15, 'Yên Bái', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (17, 'Hoà Bình', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (19, 'Thái Nguyên', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (20, 'Lạng Sơn', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (22, 'Quảng Ninh', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (24, 'Bắc Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (25, 'Phú Thọ', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (26, 'Vĩnh Phúc', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (27, 'Bắc Ninh', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (30, 'Hải Dương', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (31, 'Hải Phòng', 'Trung ương', 3);
INSERT INTO `wne_location_province` VALUES (33, 'Hưng Yên', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (34, 'Thái Bình', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (35, 'Hà Nam', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (36, 'Nam Định', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (37, 'Ninh Bình', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (38, 'Thanh Hóa', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (40, 'Nghệ An', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (42, 'Hà Tĩnh', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (44, 'Quảng Bình', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (45, 'Quảng Trị', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (46, 'Thừa Thiên Huế', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (48, 'Đà Nẵng', 'Trung ương', 3);
INSERT INTO `wne_location_province` VALUES (49, 'Quảng Nam', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (51, 'Quảng Ngãi', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (52, 'Bình Định', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (54, 'Phú Yên', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (56, 'Khánh Hòa', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (58, 'Ninh Thuận', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (60, 'Bình Thuận', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (62, 'Kon Tum', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (64, 'Gia Lai', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (66, 'Đắk Lắk', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (67, 'Đắk Nông', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (68, 'Lâm Đồng', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (70, 'Bình Phước', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (72, 'Tây Ninh', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (74, 'Bình Dương', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (75, 'Đồng Nai', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (77, 'Bà Rịa - Vũng Tàu', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (79, 'Hồ Chí Minh', 'Trung ương', 2);
INSERT INTO `wne_location_province` VALUES (80, 'Long An', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (82, 'Tiền Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (83, 'Bến Tre', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (84, 'Trà Vinh', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (86, 'Vĩnh Long', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (87, 'Đồng Tháp', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (89, 'An Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (91, 'Kiên Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (92, 'Cần Thơ', 'Trung ương', 3);
INSERT INTO `wne_location_province` VALUES (93, 'Hậu Giang', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (94, 'Sóc Trăng', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (95, 'Bạc Liêu', 'Tỉnh', 3);
INSERT INTO `wne_location_province` VALUES (96, 'Cà Mau', 'Tỉnh', 3);

-- ----------------------------
-- Table structure for wne_location_ward
-- ----------------------------
DROP TABLE IF EXISTS `wne_location_ward`;
CREATE TABLE `wne_location_ward`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ordering` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32249 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_media
-- ----------------------------
DROP TABLE IF EXISTS `wne_media`;
CREATE TABLE `wne_media`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mine_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_media
-- ----------------------------
INSERT INTO `wne_media` VALUES (13, NULL, 'favicon', 'image', '188864', 'media/2020-03/14/favicon-195412.ico', NULL, NULL, 3, '2020-03-14 19:54:12', '2020-03-14 19:54:12');
INSERT INTO `wne_media` VALUES (14, NULL, 'content', 'image', '3568835', 'media/2020-06/12/content-214433.png', NULL, NULL, 3, '2020-06-12 21:44:34', '2020-06-12 21:44:34');
INSERT INTO `wne_media` VALUES (15, NULL, 'logo', 'image', '1193', 'media/2020-06/12/logo-220016.png', NULL, NULL, 3, '2020-06-12 22:00:16', '2020-06-12 22:00:16');
INSERT INTO `wne_media` VALUES (16, NULL, 'logo', 'image', '1193', 'media/2020-06/12/logo-220147.png', NULL, NULL, 3, '2020-06-12 22:01:47', '2020-06-12 22:01:47');
INSERT INTO `wne_media` VALUES (17, NULL, 'Top 5 Intro Template No Text + Free Download + No Copyright', 'video', '4145946', 'media/2020-07/04/top-5-intro-template-no-text---092003.mp4', NULL, NULL, 3, '2020-07-04 09:20:03', '2020-07-04 09:20:03');
INSERT INTO `wne_media` VALUES (18, NULL, '#2 Top 5 Intro Template No Text + Free Download [Updated]', 'audio', '1134385', 'media/2020-07/04/2-top-5-intro-template-no-text-092751.mp3', NULL, NULL, 3, '2020-07-04 09:27:51', '2020-07-04 09:27:51');
INSERT INTO `wne_media` VALUES (19, NULL, 'Top 5 Intro Template No Text + Free Download + No Copyright', 'video', '4145946', 'media/2020-07/07/top-5-intro-template-no-text---110607.mp4', NULL, NULL, 3, '2020-07-07 11:06:07', '2020-07-07 11:06:07');
INSERT INTO `wne_media` VALUES (20, NULL, '20200724_092322_02', 'video', '1152229', 'media/2020-09/18/2020072409232202-164032.mp4', NULL, NULL, 3, '2020-09-18 16:40:33', '2020-09-18 16:40:33');
INSERT INTO `wne_media` VALUES (21, NULL, 'video_gốc', 'video', '19045472', 'media/2020-09/19/videogoc-093744.mp4', NULL, NULL, 3, '2020-09-19 09:37:44', '2020-09-19 09:37:44');
INSERT INTO `wne_media` VALUES (22, NULL, 'VID_20200806_091510', 'video', '33758388', 'media/2020-09/19/vid20200806091510-095146.mp4', NULL, NULL, 3, '2020-09-19 09:51:46', '2020-09-19 09:51:46');
INSERT INTO `wne_media` VALUES (23, NULL, 'Natto Enzym 2016 30sec HD SOUTH', 'video', '7635268', 'media/2020-09/19/natto-enzym-2016-30sec-hd-sout-095344.mp4', NULL, NULL, 3, '2020-09-19 09:53:44', '2020-09-19 09:53:44');

-- ----------------------------
-- Table structure for wne_migrations
-- ----------------------------
DROP TABLE IF EXISTS `wne_migrations`;
CREATE TABLE `wne_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_migrations
-- ----------------------------
INSERT INTO `wne_migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `wne_migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `wne_migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `wne_migrations` VALUES (4, '2019_09_04_150802_update_users_table', 1);
INSERT INTO `wne_migrations` VALUES (5, '2019_09_05_103800_cms_table', 1);
INSERT INTO `wne_migrations` VALUES (6, '2019_09_05_115502_contest_table', 1);
INSERT INTO `wne_migrations` VALUES (9, '2020_02_29_200050_shop', 2);

-- ----------------------------
-- Table structure for wne_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `wne_password_resets`;
CREATE TABLE `wne_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_roles
-- ----------------------------
DROP TABLE IF EXISTS `wne_roles`;
CREATE TABLE `wne_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `default` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  `ordering` tinyint(4) NULL DEFAULT 1,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 3 COMMENT '0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_roles
-- ----------------------------
INSERT INTO `wne_roles` VALUES (1, 'Admin', '', '', 1, 1, 0, NULL, 3, '2019-09-25 11:32:25', '2019-09-25 11:32:25');
INSERT INTO `wne_roles` VALUES (2, 'Staff', 'Chỉ được thực hiện những quyền sau đây', 'admin.cms,admin.cms.news,admin.cms.news.view,admin.cms,admin.cms.category,admin.cms.category.view', 0, 2, 0, 1, 3, '2019-09-25 11:32:25', '2020-02-05 16:38:05');

-- ----------------------------
-- Table structure for wne_settings
-- ----------------------------
DROP TABLE IF EXISTS `wne_settings`;
CREATE TABLE `wne_settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `auto_load` tinyint(4) NULL DEFAULT 0 COMMENT '1: Yes, 0: No',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 57 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_settings
-- ----------------------------
INSERT INTO `wne_settings` VALUES (1, NULL, 'system', 'general_title', 'Hexagon agency', 0);
INSERT INTO `wne_settings` VALUES (2, NULL, 'system', 'general_description', 'Chúng tôi là Visual Content - đơn vị thiết kế quảng cáo trực thuộc Admicro / VCCorp, có nền tảng chuyên sâu về sáng tạo và thiết kế đồ hoạ. Chúng tôi tạo nên các sản phẩm quảng cáo trực tuyến, hệ thống nhận diện thương hiệu, xây dựng các sản phẩm minh hoạ và đồ hoạ động.', 0);
INSERT INTO `wne_settings` VALUES (3, NULL, 'system', 'general_favicon', 'media/2020-03/14/favicon-195412.ico', 0);
INSERT INTO `wne_settings` VALUES (4, NULL, 'system', 'general_logo', 'media/2020-06/12/logo-220147.png', 0);
INSERT INTO `wne_settings` VALUES (5, NULL, 'system', 'general_share', 'media/2020-03/14/21-195514.png', 0);
INSERT INTO `wne_settings` VALUES (6, NULL, 'system', 'contact_admin_name', '', 0);
INSERT INTO `wne_settings` VALUES (7, NULL, 'system', 'contact_admin_email', '', 0);
INSERT INTO `wne_settings` VALUES (8, NULL, 'system', 'contact_admin_mobile', '', 0);
INSERT INTO `wne_settings` VALUES (9, NULL, 'system', 'contact_name', 'Vinh', 0);
INSERT INTO `wne_settings` VALUES (10, NULL, 'system', 'contact_email', 'chuvanvinh@gmail.com', 0);
INSERT INTO `wne_settings` VALUES (11, NULL, 'system', 'contact_address', '147 Truong Dinh Hai Ba Trung Ha Noi', 0);
INSERT INTO `wne_settings` VALUES (12, NULL, 'system', 'contact_facebook', '', 0);
INSERT INTO `wne_settings` VALUES (13, NULL, 'system', 'contact_youtube', '', 0);
INSERT INTO `wne_settings` VALUES (14, NULL, 'system', 'contact_twitter', '', 0);
INSERT INTO `wne_settings` VALUES (15, NULL, 'system', 'contact_google_plus', '', 0);
INSERT INTO `wne_settings` VALUES (16, NULL, 'system', 'contact_pinterest', '', 0);
INSERT INTO `wne_settings` VALUES (17, NULL, 'system', 'apikey_facebook_app_id', '2176504276004960', 0);
INSERT INTO `wne_settings` VALUES (18, NULL, 'system', 'apikey_facebook_app_secret', '4dcaa4e91afef21e07015ebc4e2262ad', 0);
INSERT INTO `wne_settings` VALUES (19, NULL, 'system', 'apikey_facebook_pixel_id', '964115780450532', 0);
INSERT INTO `wne_settings` VALUES (20, NULL, 'system', 'apikey_google_captcha_sitekey', '6LcRobgUAAAAAKu3GIr1_3u6TXf34K8vgU14WrQz', 0);
INSERT INTO `wne_settings` VALUES (21, NULL, 'system', 'apikey_google_captcha_secret', '6LcRobgUAAAAANvCdEXYwzTf2Xwyj1vqkKe4rzrw', 0);
INSERT INTO `wne_settings` VALUES (22, NULL, 'system', 'apikey_google_tag_id', '', 0);
INSERT INTO `wne_settings` VALUES (23, NULL, 'system', 'email_type', 'smtp', 0);
INSERT INTO `wne_settings` VALUES (24, NULL, 'system', 'email_host', '', 0);
INSERT INTO `wne_settings` VALUES (25, NULL, 'system', 'email_port', '', 0);
INSERT INTO `wne_settings` VALUES (26, NULL, 'system', 'email_username', '', 0);
INSERT INTO `wne_settings` VALUES (27, NULL, 'system', 'email_password', '', 0);
INSERT INTO `wne_settings` VALUES (28, NULL, 'system', 'email_encryption', '', 0);
INSERT INTO `wne_settings` VALUES (29, NULL, 'system', 'storage_type', 'public', 0);
INSERT INTO `wne_settings` VALUES (30, NULL, 'system', 'offline_status', 'no', 0);
INSERT INTO `wne_settings` VALUES (31, NULL, 'system', 'offline_datetime', '', 0);
INSERT INTO `wne_settings` VALUES (32, NULL, 'system', 'offline_title', '', 0);
INSERT INTO `wne_settings` VALUES (33, NULL, 'system', 'offline_description', '', 0);
INSERT INTO `wne_settings` VALUES (34, NULL, 'system', 'offline_image', '', 0);
INSERT INTO `wne_settings` VALUES (35, NULL, 'system', 'offline_opencode', '', 0);
INSERT INTO `wne_settings` VALUES (36, NULL, 'contest', 'round_1_start_create', '2019/10/01 00:00:00', 0);
INSERT INTO `wne_settings` VALUES (37, NULL, 'contest', 'round_1_end_create', '2019/11/01 00:00:00', 0);
INSERT INTO `wne_settings` VALUES (38, NULL, 'contest', 'round_1_start_vote', '2019/10/01 00:00:00', 0);
INSERT INTO `wne_settings` VALUES (39, NULL, 'contest', 'round_1_end_vote', '2019/11/01 00:00:00', 0);
INSERT INTO `wne_settings` VALUES (40, NULL, 'contest', 'round_2_start_vote', '', 0);
INSERT INTO `wne_settings` VALUES (41, NULL, 'contest', 'round_2_end_vote', '', 0);
INSERT INTO `wne_settings` VALUES (42, NULL, 'contest', 'round_3_start_vote', '', 0);
INSERT INTO `wne_settings` VALUES (43, NULL, 'contest', 'round_3_end_vote', '', 0);
INSERT INTO `wne_settings` VALUES (44, NULL, 'contest', 'share_hastag', '', 0);
INSERT INTO `wne_settings` VALUES (45, NULL, 'contest', 'share_utm_campaign', '', 0);
INSERT INTO `wne_settings` VALUES (46, NULL, 'contest', 'share_utm_source', '', 0);
INSERT INTO `wne_settings` VALUES (47, NULL, 'contest', 'share_utm_medium', '', 0);
INSERT INTO `wne_settings` VALUES (48, NULL, 'system', 'version', '1591975089', 0);
INSERT INTO `wne_settings` VALUES (49, NULL, 'system', 'general_fanpage', 'https://fb.com', 0);
INSERT INTO `wne_settings` VALUES (50, NULL, 'system', 'contact_mobile', '0978999256', 0);
INSERT INTO `wne_settings` VALUES (51, NULL, 'system', 'contact_facebook_messenger', 'vinhwebsite', 0);
INSERT INTO `wne_settings` VALUES (52, NULL, 'shop', 'promotion_enable', '0', 0);
INSERT INTO `wne_settings` VALUES (53, NULL, 'shop', 'promotion_end_date', '2020-04-14 00:00:00', 0);
INSERT INTO `wne_settings` VALUES (54, NULL, 'shop', 'promotion_products', '5,2', 0);
INSERT INTO `wne_settings` VALUES (55, NULL, 'system', 'general_twitter', 'https://twitter.com', 0);
INSERT INTO `wne_settings` VALUES (56, NULL, 'system', 'general_instagram', 'https://www.instagram.com/', 0);

-- ----------------------------
-- Table structure for wne_shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_brand`;
CREATE TABLE `wne_shop_brand`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_featured` tinyint(1) NULL DEFAULT 0,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_brand
-- ----------------------------
INSERT INTO `wne_shop_brand` VALUES (1, 'SONY', 'sony', 'media/2020-03/14/logosony033435590-195614.jpg', NULL, NULL, 1, 4, 1, 1, '2020-03-11 22:26:10', '2020-03-14 19:56:17');

-- ----------------------------
-- Table structure for wne_shop_brand_warranty
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_brand_warranty`;
CREATE TABLE `wne_shop_brand_warranty`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NULL DEFAULT NULL,
  `province_id` int(11) NULL DEFAULT NULL,
  `district_id` int(11) NULL DEFAULT NULL,
  `ward_id` int(11) NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `working_time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lat_lng` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ordering` tinyint(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_brand_warranty
-- ----------------------------
INSERT INTO `wne_shop_brand_warranty` VALUES (12, 1, 95, 957, 31879, NULL, NULL, NULL, NULL, NULL, NULL, 0);
INSERT INTO `wne_shop_brand_warranty` VALUES (13, 1, 89, 884, 30319, '147 Truong Dinh Hai Ba Trung Ha Noi', 'fds', 'fdsa', 'fsda', 'afdsa', '1111', 1);

-- ----------------------------
-- Table structure for wne_shop_category
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_category`;
CREATE TABLE `wne_shop_category`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT 0,
  `attr_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `banner_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `is_home` tinyint(1) NULL DEFAULT 0,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_category
-- ----------------------------
INSERT INTO `wne_shop_category` VALUES (1, 0, NULL, 'Đồ gia dụng', 'do-gia-dung', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 4, 1, 1, '2020-03-11 21:23:25', '2020-03-11 22:20:28');
INSERT INTO `wne_shop_category` VALUES (2, 0, NULL, 'Công cụ & Dụng cụ', 'cong-cu--dung-cu', NULL, NULL, NULL, 'media/2020-03/14/680-200222.png', NULL, NULL, 2, 1, 4, 1, 1, '2020-03-11 21:23:43', '2020-03-14 20:02:26');
INSERT INTO `wne_shop_category` VALUES (3, 1, 1, 'Máy pha cà phê', 'may-pha-ca-phe', 'media/2020-03/14/c581150x150-200926.jpg', NULL, NULL, NULL, NULL, NULL, 1, 0, 4, 1, 1, '2020-03-12 19:56:19', '2020-03-15 10:10:59');
INSERT INTO `wne_shop_category` VALUES (4, 0, NULL, 'Y tế & Sức khỏe', 'y-te--suc-khoe', NULL, NULL, NULL, 'media/2020-03/14/290-200311.png', NULL, NULL, 3, 0, 4, 1, NULL, '2020-03-14 20:03:15', '2020-03-14 20:03:15');
INSERT INTO `wne_shop_category` VALUES (5, 0, NULL, 'Thể thao & Ngoài trời', 'the-thao--ngoai-troi', NULL, NULL, NULL, 'media/2020-03/14/263-200348.png', NULL, NULL, 4, 0, 4, 1, NULL, '2020-03-14 20:03:50', '2020-03-14 20:03:50');
INSERT INTO `wne_shop_category` VALUES (6, 0, NULL, 'Điện máy  - Điện lạnh', 'dien-may---dien-lanh', NULL, NULL, NULL, 'media/2020-03/14/1013-200420.png', NULL, NULL, 5, 0, 4, 1, NULL, '2020-03-14 20:04:23', '2020-03-14 20:04:23');
INSERT INTO `wne_shop_category` VALUES (7, 0, NULL, 'Thiết bị số - Phụ kiện', 'thiet-bi-so--phu-kien', NULL, NULL, NULL, 'media/2020-03/14/880-200452.png', NULL, NULL, 6, 0, 4, 1, NULL, '2020-03-14 20:04:54', '2020-03-14 20:04:54');
INSERT INTO `wne_shop_category` VALUES (8, 0, NULL, 'Thiết bị văn phòng', 'thiet-bi-van-phong', NULL, NULL, NULL, 'media/2020-03/14/514-200512.png', NULL, NULL, 7, 0, 4, 1, NULL, '2020-03-14 20:05:15', '2020-03-14 20:05:15');
INSERT INTO `wne_shop_category` VALUES (9, 0, NULL, 'Nhà cửa - Đời sống', 'nha-cua--doi-song', NULL, NULL, NULL, 'media/2020-03/14/728-200537.png', NULL, NULL, 8, 0, 4, 1, NULL, '2020-03-14 20:05:42', '2020-03-14 20:05:42');
INSERT INTO `wne_shop_category` VALUES (10, 0, NULL, 'Mỹ phẩm - Làm đẹp', 'my-pham--lam-dep', NULL, NULL, NULL, 'media/2020-03/14/906-200606.png', NULL, NULL, 9, 0, 4, 1, NULL, '2020-03-14 20:06:09', '2020-03-14 20:06:09');
INSERT INTO `wne_shop_category` VALUES (11, 0, NULL, 'Mẹ và Bé', 'me-va-be', NULL, NULL, NULL, 'media/2020-03/14/229-200632.png', NULL, NULL, 10, 0, 4, 1, NULL, '2020-03-14 20:06:34', '2020-03-14 20:06:34');
INSERT INTO `wne_shop_category` VALUES (12, 0, NULL, 'Thực phẩm chức năng', 'thuc-pham-chuc-nang', NULL, NULL, NULL, 'media/2020-03/14/3267-200651.png', NULL, NULL, 11, 0, 4, 1, NULL, '2020-03-14 20:06:53', '2020-03-14 20:06:53');
INSERT INTO `wne_shop_category` VALUES (13, 0, NULL, 'Thời trang - Du lịch', 'thoi-trang--du-lich', NULL, NULL, NULL, 'media/2020-03/14/3320-200711.png', NULL, NULL, 12, 0, 4, 1, NULL, '2020-03-14 20:07:14', '2020-03-14 20:07:14');
INSERT INTO `wne_shop_category` VALUES (14, 0, NULL, 'Hàng thanh lý', 'hang-thanh-ly', NULL, NULL, NULL, 'media/2020-03/14/1237-200810.png', NULL, NULL, 13, 0, 4, 1, NULL, '2020-03-14 20:08:13', '2020-03-14 20:08:13');
INSERT INTO `wne_shop_category` VALUES (15, 1, NULL, 'Cây nước nóng lạnh', 'cay-nuoc-nong-lanh', 'media/2020-03/14/c565150x150-201002.jpg', NULL, NULL, NULL, NULL, NULL, 2, 0, 4, 1, 1, '2020-03-14 20:10:05', '2020-03-14 20:10:21');
INSERT INTO `wne_shop_category` VALUES (16, 1, NULL, 'Các loại nồi', 'cac-loai-noi', 'media/2020-03/14/c1099150x150-201046.jpg', NULL, NULL, NULL, NULL, NULL, 3, 0, 4, 1, NULL, '2020-03-14 20:10:50', '2020-03-14 20:10:50');
INSERT INTO `wne_shop_category` VALUES (17, 1, NULL, 'Hộp cơm giữ nhiệt', 'hop-com-giu-nhiet', 'media/2020-03/14/c385150x150-201112.jpg', NULL, NULL, NULL, NULL, NULL, 4, 0, 4, 1, 1, '2020-03-14 20:11:14', '2020-03-14 20:11:27');
INSERT INTO `wne_shop_category` VALUES (18, 1, NULL, 'Máy xay đa năng', 'may-xay-da-nang', 'media/2020-03/14/c443150x150-201204.jpg', NULL, NULL, NULL, NULL, NULL, 5, 0, 4, 1, 1, '2020-03-14 20:12:06', '2020-03-14 20:12:14');
INSERT INTO `wne_shop_category` VALUES (19, 1, NULL, 'Quạt - Máy làm mát', 'quat--may-lam-mat', 'media/2020-03/14/c448150x150-201245.jpg', NULL, NULL, NULL, NULL, NULL, 6, 0, 4, 1, NULL, '2020-03-14 20:12:50', '2020-03-14 20:12:50');
INSERT INTO `wne_shop_category` VALUES (20, 1, NULL, 'Máy hút bụi', 'may-hut-bui', 'media/2020-03/14/c386150x150-201321.jpg', NULL, NULL, NULL, NULL, NULL, 14, 0, 4, 1, 1, '2020-03-14 20:13:23', '2020-03-14 20:14:01');
INSERT INTO `wne_shop_category` VALUES (21, 1, NULL, 'Đồ dùng nhà bếp', 'do-dung-nha-bep', 'media/2020-03/14/c383150x150-201344.jpg', NULL, NULL, NULL, NULL, NULL, 7, 0, 4, 1, NULL, '2020-03-14 20:13:46', '2020-03-14 20:13:46');
INSERT INTO `wne_shop_category` VALUES (22, 2, 0, 'Máy rửa xe', 'may-rua-xe', 'media/2020-03/19/c817150x150-105109.jpg', NULL, NULL, NULL, NULL, NULL, 1, 0, 4, 1, NULL, '2020-03-19 10:51:13', '2020-03-19 10:51:13');
INSERT INTO `wne_shop_category` VALUES (23, 2, 0, 'Máy bắt Vít - ốc', 'may-bat-vit--oc', 'media/2020-03/19/c904150x150-105145.jpg', NULL, NULL, NULL, NULL, NULL, 2, 0, 4, 1, NULL, '2020-03-19 10:51:47', '2020-03-19 10:51:47');
INSERT INTO `wne_shop_category` VALUES (24, 2, 0, 'Máy khoan', 'may-khoan', 'media/2020-03/19/c681150x150-105215.jpg', NULL, NULL, NULL, NULL, NULL, 3, 0, 4, 1, NULL, '2020-03-19 10:52:18', '2020-03-19 10:52:18');
INSERT INTO `wne_shop_category` VALUES (25, 2, 0, 'Máy hàn điện tử', 'may-han-dien-tu', 'media/2020-03/19/c973150x150-105245.jpg', NULL, NULL, NULL, NULL, NULL, 4, 0, 4, 1, NULL, '2020-03-19 10:52:47', '2020-03-19 10:52:47');
INSERT INTO `wne_shop_category` VALUES (26, 2, 0, 'Máy bơm nước', 'may-bom-nuoc', 'media/2020-03/19/c854150x150-105313.jpg', NULL, NULL, NULL, NULL, NULL, 5, 0, 4, 1, NULL, '2020-03-19 10:53:15', '2020-03-19 10:53:15');
INSERT INTO `wne_shop_category` VALUES (27, 2, 0, 'Máy hàn miệng túi', 'may-han-mieng-tui', 'media/2020-03/19/c984150x150-105348.jpg', NULL, NULL, NULL, NULL, NULL, 6, 0, 4, 1, NULL, '2020-03-19 10:53:51', '2020-03-19 10:53:51');
INSERT INTO `wne_shop_category` VALUES (28, 2, 0, 'Máy nén khí', 'may-nen-khi', 'media/2020-03/19/c816150x150-105419.jpg', NULL, NULL, NULL, NULL, NULL, 7, 0, 4, 1, NULL, '2020-03-19 10:54:22', '2020-03-19 10:54:22');
INSERT INTO `wne_shop_category` VALUES (29, 2, 0, 'Máy cắt các loại', 'may-cat-cac-loai', 'media/2020-03/19/c814150x150-105457.jpg', NULL, NULL, NULL, NULL, NULL, 8, 0, 4, 1, NULL, '2020-03-19 10:54:59', '2020-03-19 10:54:59');

-- ----------------------------
-- Table structure for wne_shop_order
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_order`;
CREATE TABLE `wne_shop_order`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` int(6) NULL DEFAULT NULL,
  `product_total` int(11) NULL DEFAULT 0,
  `shipping_total` int(11) NULL DEFAULT NULL,
  `grand_total` int(11) NULL DEFAULT NULL,
  `product_count` int(11) NULL DEFAULT 0,
  `user_id` int(11) NULL DEFAULT NULL,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `billing_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `billing_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `billing_mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `billing_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `billing_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipping_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipping_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipping_mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipping_address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shipping_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_id` int(11) NULL DEFAULT NULL,
  `shipping_id` int(11) NULL DEFAULT NULL,
  `admin_note` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_order
-- ----------------------------
INSERT INTO `wne_shop_order` VALUES (25, 407538, 0, NULL, 12000, 3, 0, 'Chu Văn Vinh', 'chuvanvinh@gmail.com', '0978999256', 'Hà Nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, '2020-03-22 12:07:23', '2020-03-22 12:07:23');
INSERT INTO `wne_shop_order` VALUES (26, 491723, 0, 10000, 713000, 3, 0, 'Chu Văn Vinh', 'chuvanvinh@gmail.com', '0978999256', 'Hà Nội', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2020-03-22 14:48:32', '2020-03-22 15:15:18');

-- ----------------------------
-- Table structure for wne_shop_order_details
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_order_details`;
CREATE TABLE `wne_shop_order_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `product_price` int(11) NULL DEFAULT NULL,
  `product_qty` int(11) NULL DEFAULT NULL,
  `product_total` int(11) NULL DEFAULT NULL,
  `product_attr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `product_attr_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_order_details
-- ----------------------------
INSERT INTO `wne_shop_order_details` VALUES (10, 26, 1, 1000, 3, 3000, '[{\"attr_id\":1,\"attr_title\":\"K\\u00edch th\\u01b0\\u1edbc\",\"attr_option_id\":\"1\",\"attr_option_title\":\"S\"},{\"attr_id\":2,\"attr_title\":\"M\\u00e0u s\\u1eafc\",\"attr_option_id\":\"6\",\"attr_option_title\":\"\\u0110\\u1ecf\"}]', 'Kích thước: S, Màu sắc: Đỏ', 4, 0, 1, '2020-03-22 14:48:32', '2020-03-22 15:12:53');
INSERT INTO `wne_shop_order_details` VALUES (11, 26, 10, 700000, 1, 700000, '[]', '', 4, 1, NULL, '2020-03-22 15:15:18', '2020-03-22 15:15:18');

-- ----------------------------
-- Table structure for wne_shop_payment
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_payment`;
CREATE TABLE `wne_shop_payment`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_shop_product
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_product`;
CREATE TABLE `wne_shop_product`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NULL DEFAULT 0,
  `brand_id` int(11) NULL DEFAULT 0,
  `promotion_id` int(11) NULL DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sku` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gallery` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `price` int(11) NULL DEFAULT NULL,
  `price_old` int(11) NULL DEFAULT NULL,
  `weight` int(11) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `promotion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `package` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `warranty` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `made_in` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `related_news` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `related_products` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_sale` tinyint(4) NULL DEFAULT 0,
  `is_hot` tinyint(4) NULL DEFAULT 0,
  `is_new` tinyint(4) NULL DEFAULT 0,
  `views` int(11) NULL DEFAULT 1,
  `comments` int(11) NULL DEFAULT 0,
  `rating` int(11) NULL DEFAULT 3,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_product
-- ----------------------------
INSERT INTO `wne_shop_product` VALUES (1, 3, 1, 0, 'Máy pha cà phê Espresso Tiross TS-621', 'may-pha-ca-phe-espresso-tiross-ts621', 'TS-621', 'media/2020-03/14/ma621yphacapheespres-201548.png', '', 949000, 1000000, NULL, NULL, NULL, NULL, '12 tháng', 'Italy', 'Đối với những anh em đam mê cà phê thì chắc hẳn sẽ có suy nghĩ giống mình là muốn sắm một chiếc máy pha cà phê ngay tại nhà.', '<p>Đối với những anh em đam m&ecirc; c&agrave; ph&ecirc; th&igrave; chắc hẳn sẽ c&oacute; suy nghĩ giống m&igrave;nh l&agrave; muốn sắm một chiếc m&aacute;y pha c&agrave; ph&ecirc; ngay tại nh&agrave;. M&igrave;nh đ&atilde; tham khảo nhiều loại m&aacute;y pha c&agrave; ph&ecirc; tr&ecirc;n thị trường v&agrave; rất hoang mang kh&ocirc;ng biết n&ecirc;n chọn loại n&agrave;o. Tuy nhi&ecirc;n, trong một lần t&igrave;m hiểu m&igrave;nh đ&atilde; bắt gặp m&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS621 v&agrave; thấy kh&aacute; l&agrave; ưng v&agrave; ph&ugrave; hợp với điều kiện của bản th&acirc;n. Nhỏ gọn, sang trọng v&agrave; đặc biệt l&agrave; gi&aacute; cả hết sức phải chăng, ph&ugrave; hợp sử dụng đối với gia đ&igrave;nh. Trong b&agrave;i viết n&agrave;y, m&igrave;nh sẽ review về m&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS-621 cho anh em tham khảo.</p>', '', '', 0, 1, 0, 9, 4, 1, 4, 1, 1, '2020-03-11 22:27:49', '2020-03-22 10:28:55');
INSERT INTO `wne_shop_product` VALUES (2, 15, 1, 1, 'Cây nước nóng lạnh Sunhouse SHD9601', 'cay-nuoc-nong-lanh-sunhouse-shd9601', 'SHD9601', 'media/2020-03/14/caynuocnonglanhsunho-202359.jpg', '', 850000, 1000000, NULL, NULL, NULL, NULL, '12 tháng', 'Việt Nam', 'Cây nước nóng lạnh Sunhouse SHD9601 có 2 chế độ lấy nước nóng và lạnh. Với nhiệt độ nóng 86°C - 94°C, giúp bạn dễ dàng pha coffee, pha sữa hay pha trà, nấu mì nhanh chóng và tiện dụng. Bên cạnh đó, nước lạnh có nhiệt độ khoảng 10°C - 15°C giúp bạn giải khát nhanh chóng trong mùa hè oi bức. Ngoài ra, cây nước nóng còn có màn hình và đèn báo hiệu chế độ lấy nước nóng lạnh cho người dùng dễ dàng quan sát.', '<p>C&acirc;y nước n&oacute;ng lạnh Sunhouse SHD9601 c&oacute; 2 chế độ lấy nước n&oacute;ng v&agrave; lạnh. Với nhiệt độ n&oacute;ng 86&deg;C - 94&deg;C, gi&uacute;p bạn dễ d&agrave;ng pha coffee, pha sữa hay pha tr&agrave;, nấu m&igrave; nhanh ch&oacute;ng v&agrave; tiện dụng. B&ecirc;n cạnh đ&oacute;, nước lạnh c&oacute; nhiệt độ khoảng 10&deg;C - 15&deg;C gi&uacute;p bạn giải kh&aacute;t nhanh ch&oacute;ng trong m&ugrave;a h&egrave; oi bức. Ngo&agrave;i ra, c&acirc;y nước n&oacute;ng c&ograve;n c&oacute; m&agrave;n h&igrave;nh v&agrave; đ&egrave;n b&aacute;o hiệu chế độ lấy nước n&oacute;ng lạnh cho người d&ugrave;ng dễ d&agrave;ng quan s&aacute;t.</p>', '21', '1', 0, 1, 0, 10, 0, 1, 4, 1, 1, '2020-03-13 11:25:00', '2020-03-22 11:55:15');
INSERT INTO `wne_shop_product` VALUES (3, 17, 1, 1, 'Hộp hâm nóng thức ăn Mishio MK-182 inox 304', 'hop-ham-nong-thuc-an-mishio-mk182-inox-304', 'MK-182', 'media/2020-03/14/hophamnongthucanmish-202626.jpg', '', 599000, 700000, NULL, NULL, NULL, NULL, '12 tháng', 'Chính hãng', 'Hộp cơm hâm nóng đa năng phù hợp nhu cầu sử dụng giữ ấm cơm cho nhân viên văn phòng, mang theo đồ ăn đi dã ngoại, người làm việc bên ngoài, thậm chí dùng để nấu cơm cho gia đình từ 1 - 2 người. Hộp hâm cơm thức ăn là loại nồi cơm mini có cắm điện phục vụ nhu cầu ăn nóng, ăn sạch nhưng gọn nhẹ của người tiêu dùng.', '<p>Hộp cơm h&acirc;m n&oacute;ng đa năng ph&ugrave; hợp nhu cầu sử dụng giữ ấm cơm cho nh&acirc;n vi&ecirc;n văn ph&ograve;ng, mang theo đồ ăn đi d&atilde; ngoại, người l&agrave;m việc b&ecirc;n ngo&agrave;i, thậm ch&iacute; d&ugrave;ng để nấu cơm cho gia đ&igrave;nh từ 1 - 2 người. Hộp h&acirc;m cơm thức ăn l&agrave; loại nồi cơm mini c&oacute; cắm điện phục vụ nhu cầu ăn n&oacute;ng, ăn sạch nhưng gọn nhẹ của người ti&ecirc;u d&ugrave;ng.</p>', '', '', 0, 1, 0, 108, 0, 3, 4, 1, 1, '2020-03-14 20:27:04', '2020-03-22 12:10:38');
INSERT INTO `wne_shop_product` VALUES (4, 18, 1, 1, 'Máy vắt cam Hafele GS-401', 'may-vat-cam-hafele-gs401', 'GS-401', 'media/2020-03/14/mayvatcamhafele53543-203732.jpg', '', 650000, 800000, NULL, NULL, NULL, NULL, '24 Tháng', 'Chính hãng', 'Máy vắt cam Hafele GS-401 (535.43.089) có công suất hoạt động tối đa là 100W, đảm bảo tốc độ quay vắt sẽ ổn định hơn, giúp bạn nhanh chóng có được những cốc nước cam bổ dưỡng.', '<p>M&aacute;y vắt cam Hafele GS-401 (535.43.089) c&oacute; c&ocirc;ng suất hoạt động tối đa l&agrave; 100W, đảm bảo tốc độ quay vắt sẽ ổn định hơn, gi&uacute;p bạn nhanh ch&oacute;ng c&oacute; được những cốc nước cam bổ dưỡng.&nbsp;</p>', '', '', 0, 1, 0, 109, 0, 3, 4, 1, 1, '2020-03-14 20:38:00', '2020-03-22 10:08:18');
INSERT INTO `wne_shop_product` VALUES (5, 19, 1, 0, 'Quạt trần Panasonic F-56MZG (4 cánh - có điều khiển từ xa)', 'quat-tran-panasonic-f56mzg-4-canh--co-dieu-khien-t', 'F-56MZG', 'media/2020-03/14/quattranpanasonicf56-204100.jpg', '', 2090000, 2500000, NULL, NULL, NULL, NULL, '24 Tháng', 'Malaysia', 'Quạt trần Panasonic F-56MZG được trang bị tới 4 cánh quạt, sải cánh dài với đường kính cánh lên tới 140cm cho khả năng làm mát cho không gian phòng rộng thật hiệu quả.', '<p>Quạt trần Panasonic F-56MZG được trang bị tới 4 c&aacute;nh quạt, sải c&aacute;nh d&agrave;i với đường k&iacute;nh c&aacute;nh l&ecirc;n tới 140cm cho khả năng l&agrave;m m&aacute;t cho kh&ocirc;ng gian ph&ograve;ng rộng thật hiệu quả.</p>', '', '', 0, 1, 0, 109, 0, 1, 4, 1, 1, '2020-03-14 20:41:36', '2020-03-21 23:09:37');
INSERT INTO `wne_shop_product` VALUES (6, 22, 0, 0, 'Máy xịt rửa xe cao áp cảm ứng từ Kachi MK164 (1400W)', 'may-xit-rua-xe-cao-ap-cam-ung-tu-kachi-mk164-1400w', 'MK164', 'media/2020-03/19/mayxitruaxecaoapcamu-105715.jpg', '', 1450000, 1650000, NULL, NULL, NULL, NULL, '12 tháng', 'Vietnam', 'Máy xịt rửa xe cao áp MK-164 1.400W thích hợp sử dụng cho gia đình hỗ trợ làm sạch xe máy, ô tô, tường nhà, sân vườn, bể cá…', '<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>\r\n\r\n<p>M&aacute;y xịt rửa xe cao &aacute;p MK-164 1.400W th&iacute;ch hợp sử dụng cho gia đ&igrave;nh hỗ trợ l&agrave;m sạch xe m&aacute;y, &ocirc; t&ocirc;, tường nh&agrave;, s&acirc;n vườn, bể c&aacute;&hellip;</p>', '', '', 0, 1, 0, 103, 0, 3, 4, 1, 1, '2020-03-19 10:57:37', '2020-03-21 09:45:43');
INSERT INTO `wne_shop_product` VALUES (7, 23, 0, 0, 'Máy vặn vít dùng pin Black & Decker KC4815KA15', 'may-van-vit-dung-pin-black--decker-kc4815ka15', 'KC4815KA15', 'media/2020-03/19/mayvanvitdungpinblac-105845.jpg', '', 510000, 599997, NULL, NULL, NULL, NULL, '24 Tháng', 'Vietnam', 'Máy vặn vít dùng pin Black&Decker KC4815KA15 có dung lượng pin 4.8V/600mAh là dụng cụ cầm tay không thể thiếu trong các ngành nghề cơ khí hay sửa chữa xe cộ, các loại máy móc. Sản phẩm có kích thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ dàng sử dụng.', '<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>\r\n\r\n<p>M&aacute;y vặn v&iacute;t d&ugrave;ng pin Black&amp;Decker KC4815KA15 c&oacute; dung lượng pin 4.8V/600mAh l&agrave; dụng cụ cầm tay kh&ocirc;ng thể thiếu trong c&aacute;c ng&agrave;nh nghề cơ kh&iacute; hay sửa chữa xe cộ, c&aacute;c loại m&aacute;y m&oacute;c. Sản phẩm c&oacute; k&iacute;ch thước gọn, thiết kế cầm tay hiện đại, cho bạn dễ d&agrave;ng sử dụng.</p>', '', '', 0, 1, 0, 103, 0, 3, 4, 1, 1, '2020-03-19 10:59:04', '2020-03-21 09:44:35');
INSERT INTO `wne_shop_product` VALUES (8, 24, 0, 0, 'Máy khoan động lực Bosch GSB 16 RE', 'may-khoan-dong-luc-bosch-gsb-16-re', 'GSB16RE', 'media/2020-03/19/maykhoandonglucbosch-110011.jpg', '', 1550000, 1750000, NULL, NULL, NULL, NULL, '24 Tháng', 'Vietnam', 'Máy khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu dáng công thái học. Máy khoan Bosch có nút đảo chiều để có thể bắt vít trên nhiều chất liệu. Máy khoan nhỏ gọn, nặng 2.1kg cầm thao tác thoải mái.', '<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>\r\n\r\n<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>\r\n\r\n<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>\r\n\r\n<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>\r\n\r\n<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>\r\n\r\n<p>M&aacute;y khoan động lực Bosch GSB 16 RE được thiết kế khỏe khoắn hơn với kiểu d&aacute;ng c&ocirc;ng th&aacute;i học. M&aacute;y khoan Bosch c&oacute; n&uacute;t đảo chiều để c&oacute; thể bắt v&iacute;t tr&ecirc;n nhiều chất liệu. M&aacute;y khoan nhỏ gọn, nặng 2.1kg cầm thao t&aacute;c thoải m&aacute;i.&nbsp;</p>', '', '', 0, 1, 0, 104, 0, 3, 4, 1, 1, '2020-03-19 11:00:28', '2020-03-21 20:12:51');
INSERT INTO `wne_shop_product` VALUES (9, 25, 0, 0, 'Máy hàn điện tử Hồng Ký HK 200N', 'may-han-dien-tu-hong-ky-hk-200n', 'HK200N', 'media/2020-03/19/mayhandientuhongkyhk-110208.jpg', '', 2160000, 2560000, NULL, NULL, NULL, NULL, '12 tháng', 'Vietnam', 'Máy hàn điện tử Hồng Ký HK 200N là chiếc máy hàn que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa trên những góp ý của khách hàng, giúp người dùng hoàn toàn yên tâm khi sử dụng.', '<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>M&aacute;y h&agrave;n điện tử Hồng K&yacute; HK 200N l&agrave; chiếc m&aacute;y h&agrave;n que chất lượng, tiện lợi nhất từ trước tới nay, được sản xuất dựa tr&ecirc;n những g&oacute;p &yacute; của kh&aacute;ch h&agrave;ng, gi&uacute;p người d&ugrave;ng ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m khi sử dụng.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '', '', 0, 1, 0, 101, 0, 3, 4, 1, 1, '2020-03-19 11:02:22', '2020-03-20 22:16:34');
INSERT INTO `wne_shop_product` VALUES (10, 26, 0, 0, 'Máy bơm chân không đẩy cao Shining SHP-150E', 'may-bom-chan-khong-day-cao-shining-shp150e', 'SHP-150E', 'media/2020-03/19/may-bom-chan-khong-s-111134.jpg', '', 700000, 800000, 1, 2, NULL, NULL, '12 tháng', 'Vietnam', 'Máy bơm đẩy cao với tính năng bơm nhanh, tiết kiệm thời gian, động cơ vận hành khỏe, độ bền cao, sử dụng lâu dài, bảo hành 6 tháng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ sét, giữ bền màu vô thời hạn.', '<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>\r\n\r\n<p>M&aacute;y bơm đẩy cao với t&iacute;nh năng bơm nhanh, tiết kiệm thời gian, động cơ vận h&agrave;nh khỏe, độ bền cao, sử dụng l&acirc;u d&agrave;i, bảo h&agrave;nh 6 th&aacute;ng. Shining SHP-150E hoạt động với độ ồn thấp. Sản phẩm được sơn tĩnh điện để bảo vệ, chống gỉ s&eacute;t, giữ bền m&agrave;u v&ocirc; thời hạn.&nbsp;</p>', '', '', 0, 1, 0, 101, 0, 1, 4, 1, 1, '2020-03-19 11:04:11', '2020-03-21 09:44:24');

-- ----------------------------
-- Table structure for wne_shop_promotion
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_promotion`;
CREATE TABLE `wne_shop_promotion`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `popup` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fulltext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `related_products` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `views` int(11) NULL DEFAULT 0,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_promotion
-- ----------------------------
INSERT INTO `wne_shop_promotion` VALUES (1, 'KHUYẾN MẠI CUỐI TUẦN', 'khuyen-mai-cuoi-tuan', '2020-03-16 00:00:39', '2020-09-16 00:00:39', 'https://www.phucanh.vn/media/banner/popup_pop%20ip%20th%C3%A1ng%203.png', '<p>Chương tr&igrave;nh khuyến mại cuối tuần</p>', '4,5,3,1,2', 2, 3, 1, 1, '2020-03-16 17:18:35', '2020-03-19 10:00:57');

-- ----------------------------
-- Table structure for wne_shop_shipping
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_shipping`;
CREATE TABLE `wne_shop_shipping`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `introtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ordering` int(11) NULL DEFAULT 1,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for wne_shop_store
-- ----------------------------
DROP TABLE IF EXISTS `wne_shop_store`;
CREATE TABLE `wne_shop_store`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coordinates` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `province_id` int(11) NULL DEFAULT NULL,
  `district_id` int(11) NULL DEFAULT NULL,
  `ward_id` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 4 COMMENT '0: Deleted, 1: Draft, 2: Pending, 3: Disable, 4: Enable',
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_shop_store
-- ----------------------------
INSERT INTO `wne_shop_store` VALUES (1, 'Cửa hàng chính', 'cua-hang-chinh', NULL, NULL, NULL, NULL, NULL, 27, 263, 9490, 4, 1, 1, '2020-03-21 07:50:39', '2020-03-21 07:55:50');

-- ----------------------------
-- Table structure for wne_users
-- ----------------------------
DROP TABLE IF EXISTS `wne_users`;
CREATE TABLE `wne_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `language_id` int(11) NULL DEFAULT NULL,
  `type` int(11) NULL DEFAULT 0,
  `gender` tinyint(4) NULL DEFAULT 1 COMMENT '1: Male, 0: Female',
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `id_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `province_id` int(11) NULL DEFAULT NULL,
  `district_id` int(11) NULL DEFAULT NULL,
  `ward_id` int(11) NULL DEFAULT NULL,
  `facebook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `others` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 2 COMMENT '0: Deleted, 1: Draft, 2: Confirm, 3: Disable, 4: Enable',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wne_users
-- ----------------------------
INSERT INTO `wne_users` VALUES (9, 'Hồ Trứ', 'teendocbao@gmail.com', NULL, '', NULL, NULL, '2020-09-21 09:11:20', NULL, 0, 0, '0369222669', 'media/2020-07/14/1-1581642232492-140702.jpg', '1921-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, 2, 2);

SET FOREIGN_KEY_CHECKS = 1;
