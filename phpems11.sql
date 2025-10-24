/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50738 (5.7.38-log)
 Source Host           : localhost:3306
 Source Schema         : phpems11

 Target Server Type    : MySQL
 Target Server Version : 50738 (5.7.38-log)
 File Encoding         : 65001

 Date: 24/10/2025 16:59:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for x2_answer
-- ----------------------------
DROP TABLE IF EXISTS `x2_answer`;
CREATE TABLE `x2_answer`  (
  `asrid` int(11) NOT NULL AUTO_INCREMENT,
  `asruserid` int(11) NULL DEFAULT NULL,
  `asraskid` int(11) NULL DEFAULT NULL,
  `asrcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `asrtime` int(11) NULL DEFAULT NULL,
  `asrstatus` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`asrid`) USING BTREE,
  INDEX `asruserid`(`asruserid`) USING BTREE,
  INDEX `asraskid`(`asraskid`) USING BTREE,
  INDEX `asrstatus`(`asrstatus`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_answer
-- ----------------------------

-- ----------------------------
-- Table structure for x2_app
-- ----------------------------
DROP TABLE IF EXISTS `x2_app`;
CREATE TABLE `x2_app`  (
  `appid` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `appname` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `appthumb` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `appstatus` int(1) NOT NULL DEFAULT 0,
  `appsetting` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`appid`) USING BTREE,
  INDEX `appstatus`(`appstatus`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_app
-- ----------------------------
INSERT INTO `x2_app` VALUES ('user', '用户', 'files/attach/images/content/20130401/13647895355562.png.png', 1, 'a:9:{s:11:\"closeregist\";s:1:\"0\";s:9:\"registype\";s:1:\"0\";s:11:\"managemodel\";s:1:\"0\";s:10:\"loginmodel\";s:1:\"0\";s:11:\"emailverify\";s:1:\"0\";s:12:\"emailaccount\";s:0:\"\";s:13:\"emailpassword\";s:0:\"\";s:9:\"regfields\";s:11:\"useraddress\";s:9:\"outfields\";s:11:\"useraddress\";}');
INSERT INTO `x2_app` VALUES ('exam', '考试', '*value*', 1, 'a:2:{s:10:\"autorecord\";s:1:\"1\";s:14:\"recordperiodic\";s:0:\"\";}');
INSERT INTO `x2_app` VALUES ('seminar', '专题', 'app/core/styles/images/noimage.gif', 0, '');
INSERT INTO `x2_app` VALUES ('core', '全局', '*value*', 1, '');
INSERT INTO `x2_app` VALUES ('document', '文件', '*value*', 1, '');
INSERT INTO `x2_app` VALUES ('content', '内容', '*value*', 1, '');
INSERT INTO `x2_app` VALUES ('item', '商品', 'app/core/styles/images/noimage.gif', 1, '');
INSERT INTO `x2_app` VALUES ('weixin', '微信', 'app/core/styles/images/noimage.gif', 0, '');
INSERT INTO `x2_app` VALUES ('bank', '财务', '*value*', 1, '');
INSERT INTO `x2_app` VALUES ('course', '课程', '*value*', 1, '');
INSERT INTO `x2_app` VALUES ('certificate', '证书', 'files/attach/images/content/20190912/15683023154368.jpg', 1, '');
INSERT INTO `x2_app` VALUES ('docs', '文档', 'app/core/styles/images/noimage.gif', 1, '');
INSERT INTO `x2_app` VALUES ('autoform', '表单', 'files/attach/images/content/20191104/15728805945530.jpg', 0, '');
INSERT INTO `x2_app` VALUES ('job', '招聘', 'app/core/styles/images/noimage.gif', 0, '');
INSERT INTO `x2_app` VALUES ('ask', '问答', 'app/core/styles/images/noimage.gif', 1, '');
INSERT INTO `x2_app` VALUES ('info', '信息', 'app/core/styles/images/noimage.gif', 1, '');
INSERT INTO `x2_app` VALUES ('survey', '调查', 'app/core/styles/images/noimage.gif', 1, '');
INSERT INTO `x2_app` VALUES ('shop', '餐厅', 'app/core/styles/images/noimage.gif', 1, 'a:13:{s:8:\"webtitle\";s:12:\"海鲜烧烤\";s:8:\"telphone\";s:11:\"13800138000\";s:12:\"openprovince\";s:6:\"410000\";s:8:\"opencity\";s:6:\"410700\";s:8:\"openarea\";s:6:\"410702\";s:7:\"address\";s:9:\"洪门镇\";s:8:\"webmajor\";s:9:\"中餐厅\";s:12:\"itemlisttype\";s:1:\"1\";s:4:\"locx\";d:113.933081;s:4:\"locy\";d:35.284830999999997;s:12:\"shopdescribe\";s:31:\"&lt;p&gt;海鲜烧烤&lt;/p&gt;\";s:7:\"website\";a:17:{s:8:\"webtitle\";s:18:\"海鲜烧烤店铺\";s:8:\"telphone\";s:11:\"13800138000\";s:12:\"openprovince\";s:6:\"410000\";s:8:\"opencity\";s:6:\"410700\";s:8:\"openarea\";s:6:\"410702\";s:7:\"address\";s:9:\"洪门镇\";s:8:\"webmajor\";s:9:\"中餐厅\";s:12:\"itemlisttype\";s:1:\"1\";s:4:\"locx\";d:113.933094;s:4:\"locy\";d:35.284868000000003;s:12:\"shopdescribe\";s:31:\"&lt;p&gt;海鲜烧烤&lt;/p&gt;\";s:13:\"shopadvstring\";s:18:\"海鲜烧烤店铺\";s:12:\"qrcodestring\";s:18:\"海鲜烧烤店铺\";s:10:\"shopappurl\";s:21:\"http://www.phpems.net\";s:15:\"shopworkingtime\";a:4:{i:0;a:3:{s:4:\"name\";s:6:\"早市\";s:9:\"starttime\";s:5:\"04:00\";s:7:\"endtime\";s:5:\"10:00\";}i:1;a:3:{s:4:\"name\";s:6:\"午市\";s:9:\"starttime\";s:7:\"11：00\";s:7:\"endtime\";s:7:\"15：00\";}i:2;a:3:{s:4:\"name\";s:6:\"晚市\";s:9:\"starttime\";s:7:\"17：00\";s:7:\"endtime\";s:7:\"21：00\";}i:3;a:3:{s:4:\"name\";s:6:\"夜宵\";s:9:\"starttime\";s:7:\"22：00\";s:7:\"endtime\";s:7:\"02：00\";}}s:10:\"shoppdtime\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";}s:13:\"shoptabletype\";a:6:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"8\";i:5;s:2:\"16\";}}s:4:\"shop\";a:6:{s:13:\"shopadvstring\";s:18:\"海鲜烧烤店铺\";s:12:\"qrcodestring\";s:18:\"海鲜烧烤店铺\";s:10:\"shopappurl\";s:21:\"http://www.phpems.net\";s:15:\"shopworkingtime\";a:4:{i:0;a:4:{s:4:\"name\";s:6:\"早市\";s:9:\"starttime\";s:5:\"04:00\";s:7:\"endtime\";s:5:\"09:00\";s:7:\"disable\";s:1:\"1\";}i:1;a:4:{s:4:\"name\";s:6:\"午市\";s:9:\"starttime\";s:7:\"11：00\";s:7:\"endtime\";s:7:\"15：00\";s:7:\"disable\";s:1:\"1\";}i:2;a:3:{s:4:\"name\";s:6:\"晚市\";s:9:\"starttime\";s:7:\"17：00\";s:7:\"endtime\";s:7:\"21：00\";}i:3;a:3:{s:4:\"name\";s:6:\"夜宵\";s:9:\"starttime\";s:7:\"22：00\";s:7:\"endtime\";s:7:\"02：00\";}}s:10:\"shoppdtime\";a:4:{i:0;s:1:\"1\";i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";}s:13:\"shoptabletype\";a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"4\";i:3;s:1:\"6\";i:4;s:1:\"8\";}}}');
INSERT INTO `x2_app` VALUES ('enroll', '报名', 'app/core/styles/images/noimage.gif', 1, '');

-- ----------------------------
-- Table structure for x2_area
-- ----------------------------
DROP TABLE IF EXISTS `x2_area`;
CREATE TABLE `x2_area`  (
  `areaid` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `areacode` int(12) NOT NULL DEFAULT 0,
  `arealevel` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`areaid`) USING BTREE,
  INDEX `area`(`area`, `arealevel`) USING BTREE,
  INDEX `areacode`(`areacode`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_area
-- ----------------------------
INSERT INTO `x2_area` VALUES (5, '陕西', 29, 0);
INSERT INTO `x2_area` VALUES (6, '河北', 311, 0);
INSERT INTO `x2_area` VALUES (7, '天津', 22, 0);
INSERT INTO `x2_area` VALUES (8, '山东', 531, 0);
INSERT INTO `x2_area` VALUES (9, '江苏', 25, 0);
INSERT INTO `x2_area` VALUES (10, '湖北', 27, 0);
INSERT INTO `x2_area` VALUES (11, '辽宁', 24, 0);
INSERT INTO `x2_area` VALUES (12, '贵州', 851, 0);
INSERT INTO `x2_area` VALUES (13, '北京', 1001, 0);
INSERT INTO `x2_area` VALUES (14, '云南', 871, 0);
INSERT INTO `x2_area` VALUES (15, '四川', 28, 0);
INSERT INTO `x2_area` VALUES (16, '安徽', 551, 0);
INSERT INTO `x2_area` VALUES (17, '深圳', 755, 0);
INSERT INTO `x2_area` VALUES (18, '吉林', 431, 0);
INSERT INTO `x2_area` VALUES (19, '广东', 20, 0);
INSERT INTO `x2_area` VALUES (20, '新疆', 991, 0);
INSERT INTO `x2_area` VALUES (21, '广西', 771, 0);
INSERT INTO `x2_area` VALUES (22, '福建', 591, 0);
INSERT INTO `x2_area` VALUES (23, '湖南', 731, 0);
INSERT INTO `x2_area` VALUES (24, '上海', 21, 0);
INSERT INTO `x2_area` VALUES (25, '重庆', 23, 0);
INSERT INTO `x2_area` VALUES (26, '江西', 791, 0);
INSERT INTO `x2_area` VALUES (27, '浙江', 571, 0);
INSERT INTO `x2_area` VALUES (28, '山西', 351, 0);

-- ----------------------------
-- Table structure for x2_ask
-- ----------------------------
DROP TABLE IF EXISTS `x2_ask`;
CREATE TABLE `x2_ask`  (
  `askid` int(11) NOT NULL AUTO_INCREMENT,
  `askuserid` int(11) NULL DEFAULT NULL,
  `asktitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `asktime` int(11) NULL DEFAULT NULL,
  `askcoin` int(11) NULL DEFAULT NULL,
  `askcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `askisshow` int(1) NULL DEFAULT NULL,
  `askstatus` int(1) NULL DEFAULT NULL,
  `askorder` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`askid`) USING BTREE,
  INDEX `askuserid`(`askuserid`) USING BTREE,
  INDEX `askstatus`(`askstatus`) USING BTREE,
  INDEX `askisshow`(`askisshow`) USING BTREE,
  INDEX `askorder`(`askorder`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_ask
-- ----------------------------
INSERT INTO `x2_ask` VALUES (1, 1, 'qweqweqwe', 1760527203, 0, '<p>qweqweqwe</p>', 0, 0, 0);

-- ----------------------------
-- Table structure for x2_attach
-- ----------------------------
DROP TABLE IF EXISTS `x2_attach`;
CREATE TABLE `x2_attach`  (
  `attid` int(11) NOT NULL AUTO_INCREMENT,
  `attpath` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `atttitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `attext` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `attinputtime` int(11) NOT NULL DEFAULT 0,
  `attsize` int(11) NOT NULL DEFAULT 0,
  `attmd5` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `attuserid` int(11) NOT NULL DEFAULT 0,
  `attcntype` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`attid`) USING BTREE,
  INDEX `attext`(`attext`, `attinputtime`) USING BTREE,
  INDEX `attuserid`(`attuserid`) USING BTREE,
  INDEX `attcntype`(`attcntype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_attach
-- ----------------------------
INSERT INTO `x2_attach` VALUES (1, 'files/attach/images/content/20241017/17291338997515.jpg', '410182197507147553zp.jpg', 'jpg', 1729133899, 21216, '', 1, 'image/jpeg');

-- ----------------------------
-- Table structure for x2_attachtype
-- ----------------------------
DROP TABLE IF EXISTS `x2_attachtype`;
CREATE TABLE `x2_attachtype`  (
  `atid` int(11) NOT NULL AUTO_INCREMENT,
  `attachtype` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `attachexts` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`atid`) USING BTREE,
  INDEX `attachtype`(`attachtype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_attachtype
-- ----------------------------
INSERT INTO `x2_attachtype` VALUES (1, '图片', 'jpg,png,gif,bmp');
INSERT INTO `x2_attachtype` VALUES (2, '音频', 'mp3');
INSERT INTO `x2_attachtype` VALUES (3, '多媒体', 'flv,wmv,mp4,avi');
INSERT INTO `x2_attachtype` VALUES (4, '批量导入文件', 'csv,xls,xlsx');
INSERT INTO `x2_attachtype` VALUES (5, '文字类', 'pdf');
INSERT INTO `x2_attachtype` VALUES (6, '压缩文件', 'zip,rar');

-- ----------------------------
-- Table structure for x2_basic
-- ----------------------------
DROP TABLE IF EXISTS `x2_basic`;
CREATE TABLE `x2_basic`  (
  `basicid` int(11) NOT NULL AUTO_INCREMENT,
  `basic` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `basicareaid` int(4) NOT NULL DEFAULT 0,
  `basicsubjectid` int(11) NOT NULL DEFAULT 0,
  `basicsection` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `basicknows` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `basicexam` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `basicapi` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `basicdemo` int(1) NOT NULL DEFAULT 0,
  `basicthumb` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `basicprice` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `basicclosed` int(1) NOT NULL DEFAULT 0,
  `basictop` int(1) NULL DEFAULT NULL,
  `basicdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`basicid`) USING BTREE,
  INDEX `basicexamid`(`basicareaid`) USING BTREE,
  INDEX `basicsubjectid`(`basicsubjectid`) USING BTREE,
  INDEX `basicapi`(`basicapi`) USING BTREE,
  INDEX `basicdemo`(`basicdemo`) USING BTREE,
  INDEX `basicclosed`(`basicclosed`) USING BTREE,
  INDEX `basictop`(`basictop`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_basic
-- ----------------------------
INSERT INTO `x2_basic` VALUES (1, '结业考试', 5, 1, 'a:1:{i:0;i:1;}', 'a:1:{i:1;a:2:{i:1;s:1:\"1\";i:2;s:1:\"2\";}}', 'a:16:{s:9:\"rulemodel\";s:1:\"0\";s:5:\"model\";s:1:\"0\";s:14:\"changesequence\";s:1:\"0\";s:4:\"auto\";s:3:\"1,2\";s:12:\"autotemplate\";s:15:\"exampaper_paper\";s:4:\"self\";s:1:\"1\";s:12:\"selftemplate\";s:10:\"exam_paper\";s:5:\"batch\";s:0:\"\";s:8:\"opentime\";a:2:{s:5:\"start\";b:0;s:3:\"end\";b:0;}s:10:\"selectrule\";s:1:\"1\";s:10:\"faceverify\";s:1:\"1\";s:10:\"fullsubmit\";s:1:\"0\";s:10:\"unjointime\";s:0:\"\";s:10:\"examnumber\";s:2:\"10\";s:12:\"notviewscore\";s:1:\"0\";s:10:\"allowgroup\";s:0:\"\";}', '', 1, 'files/attach/images/content/20210830/16302941093914.jpg', '1:1', 0, NULL, '本考场为PHPEMS系统演示考场');

-- ----------------------------
-- Table structure for x2_block
-- ----------------------------
DROP TABLE IF EXISTS `x2_block`;
CREATE TABLE `x2_block`  (
  `blockid` int(11) NOT NULL AUTO_INCREMENT,
  `block` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `blocktype` int(1) NOT NULL DEFAULT 0,
  `blockposition` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `blockcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`blockid`) USING BTREE,
  INDEX `blocktype`(`blocktype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_block
-- ----------------------------
INSERT INTO `x2_block` VALUES (1, '注册协议', 1, '注册页面', 'a:1:{s:7:\"content\";s:52765:\"&lt;div class=&quot;content&quot;&gt;\r\n&lt;p class=&quot;daoyu&quot;&gt;一、用户条款内容&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）本协议内容包括协议正文及所有xxx已经发布的或将来可能发布的各类规则。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。除另行明确声明外，xxx提供的服务均受本协议约束。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）您应当在使用xxx服务之前认真阅读全部协议内容。如您对协议有任何疑问，应向xxx咨询。但无论您事实上是否在使用xxx服务之前认真阅读了本协议内容，只要您使用xxx服务，则本协议即对您产生约束，届时您不能以未阅读本协议的内容或者未获得xxx对您问询的解答等理由，主张本协议无效，或要求撤销本协议。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）您承诺接受并遵守本协议的约定。如果您违反本协议约定的内容，您应立即停止注册程序或停止使用xxx服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）xxx有权根据需要不定时地制订、修改本协议及各类规则，并以网站公示的方式进行公告，不再另行通知，用户可随时在xxx网站查阅版服务协议。变更后的协议和规则一经在网站公布后，立即自动生效。如您不同意相关变更内容，应当提出并立即停止使用xxx服务。如您继续使用xxx服务的，即表示您对修改的协议无异议并接受。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）本协议适用于xxx提供的各种服务，但当用户使用xxx的某一特定服务时，如该服务另有单独的服务条款、指引或规则，用户应遵守本服务条款及xxx随时公布的与该服务相关的服务条款、指引或规则等。&lt;/p&gt;\r\n\r\n&lt;p&gt;二、用户注册&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）注册者资格：在您完成注册程序或以其他xxx公司允许的方式实际使用xxx服务时，您应当是具备完全民事权利能力和完全民事行为能力的自然人、法人或其他组织。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）注册信息：为了您更好的体验xxx服务及接受xxx的合规性监管，用户注册时应当提供真实、正确、完整的单位或个人资料并及时更新，因虚假或者滞后的单位和个人资料所造成的损失由用户自行承担。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）账户：账户设置用户名和密码，通过该用户名密码或与该用户名密码关联的其它用户名密码登录xxx。您设置的用户名不得侵犯或涉嫌侵犯他人合法权益。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）您应对您的账户（用户名和密码）安全，以及对通过您的账户实施的行为负责。除非有法律规定或司法裁定，且征得xxx的同意，否则，账户不得以任何方式转让、赠与或 继承 （与账户相关的财产权益除外）。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）如果发现任何人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以有效方式通知，要求xxx暂停相关服务。请您理解xxx对您的请求采取相应措施，在采取措施前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;三、用户管理&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）您在本网站的所有行为都须符合中国的法律 法规 ，您不得利用本网站提供的服务制作、复制、发布、传播以下信息：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、反对 宪法 基本原则的；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、危害国家安全、泄露国家秘密、颠覆国家政权、破坏国家统一的；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、损害国家荣誉和利益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、煽动民族仇恨、民族歧视、破坏民族团结的；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、破坏国家宗教政策，宣扬邪教和封建迷信的；&lt;/p&gt;\r\n\r\n&lt;p&gt;6、散布谣言、扰乱社会秩序、破坏社会稳定的；&lt;/p&gt;\r\n\r\n&lt;p&gt;7、散布淫秽、色情、赌博、暴力、凶杀、恐怖内容或者教唆犯罪的；&lt;/p&gt;\r\n\r\n&lt;p&gt;8、侮辱或者诽谤他人，侵害他人合法权益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;9、以及法律、法规禁止的其他内容。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）您在本网站的行为，还必须符合其它国家和地区的法律规定以及国际法的有关规定。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）不得利用本网站从事以下活动：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、未经允许，进入他人计算机信息网络或者使用他人计算机信息网络的资源；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、未经允许，对他人计算机信息网络的功能进行删除、修改或增加；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、未经允许，对他人计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、制作、故意传播计算机病毒等破坏性程序的；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、其他危害计算机信息网络安全的行为。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）遵守本网站其他规定和程序：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、您对自己在本网站中的行为和操作承担全部责任；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、您承担责任的形式包括但不仅限于，对受到侵害者进行赔偿、在本网站首先承担了因您的行为导致的 行政处罚 或侵权损害赔偿责任后，您应给予本网站的等额赔偿；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、如果本网站发现您传输的信息含有本协议所规定的内容，本网站有权在不通知您的情况下采取包括但不仅限于向国家有关机关报告、保存有关记录、删除该内容及链接地址、关闭服务器、暂停您账号的操作权限、停止向您提供服务等措施。&lt;/p&gt;\r\n\r\n&lt;p&gt;四、注册会员权利和义务&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）注册会员有权用本网站提供的服务功能。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）注册会员同意遵守包括但不仅限于《中华人民共和国国保守国家秘密法》、《中华人民共和国国计算机信息系统安全保护条例》、《计算机软件保护条例》、《互联网电子公告服务管理规定》、《互联网信息服务管理办法》等在内的法律、法规。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）您注册时有义务提供完整、真实、的个人信息，信息如有变更，应及时更新。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）您成为注册会员须妥善保管用户名和密码，用户登录后进行的一切活动均视为是您本人的行为和意愿，您负全部责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）您在使用本网站服务时，同意且接受本网站提供的各类信息服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;（六）您使用本网站时，禁止有以下行为：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、上载、张贴、发送电子邮件或以其他方式传送含有违反国家法律、法规的信息或资料，这些资料包括但不仅限于资讯、资料、文字、软件、音乐、照片、图形、等（下同）；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的资料；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、冒充任何个人或机构，或以虚伪不实的方式误导他人以为其与任何人或任何机构有关；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、通过本网站干扰、破坏或限制他人计算机软件、硬件或通讯设备功能的行为；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、通过本网站跟踪或以其他方式骚扰他人。&lt;/p&gt;\r\n\r\n&lt;p&gt;五、用户隐私我们承诺，对您个人的信息和隐私的安全承担保密义务。未经您授权或同意，本网站不会将您的个人资料信息泄露给第三方，但以下情况除外，且本网站不承担任何责任：&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）政府单位按照中华人民共和国国的法律、行政法规、部门规章、司法解释等规范性法律文件（统称法律法规），要求本网站提供的。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）由于您将用户和密码告知或泄露给他人，由此导致的个人资料泄露。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）包括但不仅限于黑客攻击、计算机病毒侵入或发作、政府 管制 等不可抗力而造成的用户个人资料泄露、丢失、被盗用或被篡改等。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）为免除他人正在遭受威胁到其生命、身体或财产等方面的危险，所采取的措施。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）本网站会与其他网站链接，但不对其他网站的隐私政策及内容负责。&lt;/p&gt;\r\n\r\n&lt;p&gt;（六）此外，您若发现有任何非法使用您的用户账号或安全漏洞的情况，应立即通告本网站。&lt;/p&gt;\r\n\r\n&lt;p&gt;（七）由于您自身的疏忽、大意等过错所导致的。&lt;/p&gt;\r\n\r\n&lt;p&gt;（八）您在本网站的有关记录有可能成为您违反法律法规和本协议的 证据 。&lt;/p&gt;\r\n\r\n&lt;p&gt;六、 知识产权 本网站所有的域名、商号、 商标 、文字、视像及声音内容、图形及图像均受有关所有权和知识产权法律的保护，未经本网站事先以书面明确允许，任何个人或单位，均不得进行复制和使用。&lt;/p&gt;\r\n\r\n&lt;p&gt;七、法律适用&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）协议由本网站的所有人负责修订，并通过本网站公布，您的注册行为即被视为您自愿接受协议的全部条款，受其约束。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）协议的生效、履行、解释及争议的解决均适用中华人民共和国国法律。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）您使用网站提供的服务如产生争议，原则上双方协商解决，协商不成可向本网站所有人所在的仲裁机构、人民法院进行调解或提起 诉讼 。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）协议的条款如与法律相抵触，本网站可进行重新解析，而其他条款则保持对您产生法律效力和约束。&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;a name=&quot;220477&quot;&gt;&lt;/a&gt;\r\n\r\n&lt;h3 style=&quot;border-left:5px solid #3991e5;color:#3991e5;background:#f5f7f7;line-height:38px;margin:25px 0;font-weight:bold;&quot;&gt;【第2篇】网站用户注册协议书范本专业版&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;一、总则&lt;/p&gt;\r\n\r\n&lt;p&gt;此份协议是注册用户接受_______________网站（以下简称本站）产品和服务时适用的通用条款。因此，请您在注册成为本站用户前或接受本站的产品和服务之前，请您详细地阅读本注册用户协议的所有内容。&lt;/p&gt;\r\n\r\n&lt;p&gt;1、注册用户了解并同意：&lt;/p&gt;\r\n\r\n&lt;p&gt;①只要注册用户点击&amp;ldquo;同意&amp;rdquo;按钮并完成注册，注册用户就已接受了本注册用户协议及本站公布的各项服务规则（包括填写实名的联系方式等等），并愿意受其约束。如果发生纠纷，注册用户不得以未仔细阅读为由进行抗辩。&lt;/p&gt;\r\n\r\n&lt;p&gt;②随着市场经营情况的变化，本站有权随时更改本注册用户协议及相关服务规则。修改本注册用户协议时，本站将于相关页面公告修改的事实，有权不对注册用户进行个别通知。注册用户应该在每次登录前查询网站的相关公告，以了解注册用户协议及其他服务规则的变化。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、若注册用户不同意本注册用户协议或相关服务规则，或者不同意本站作出的修改，注册用户可以主动停止使用本站提供的产品和服务，如果在本站修改协议或服务规则后，注册用户仍继续使用本站提供的产品和服务，即表示注册用户同意本站对本注册用户协议及相关服务规则所做的所有修改。由于注册用户在注册用户协议变更后因未熟悉公告规定而引起的损失，本站将不会承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本站的各项电子服务的所有权和运作权归本站。本站提供的服务将完全按照其发布的服务条款和操作规则严格执行。注册用户必须完全同意所有服务条款并完成注册程序，才能成为本站的注册用户。注册用户确认：本协议条款是处理双方权利义务的当然约定依据，除非违反国家强制性法律，否则始终有效。&lt;/p&gt;\r\n\r\n&lt;p&gt;二、服务简介&lt;/p&gt;\r\n\r\n&lt;p&gt;1、本站运用自己的操作系统通过国际互联网络为注册用户提供网络服务。同时，注册用户必须：自行配备上网的所需设备，包括个人电脑、调制解调器或其他必备上网装置。自行负担个人上网所支付的与此服务有关的电话费用、网络费用。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、基于本站所提供的网络服务的重要性，注册用户应同意：提供详尽、准确的个人资料。不断更新注册资料，符合及时、详尽、准确的要求。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本站对注册用户的电子邮件、手机号等隐私资料进行保护，承诺不会在未获得注册用户许可的情况下擅自将注册用户的个人资料信息出租或出售给任何第三方，但以下情况除外：注册用户同意让第三方共享资料；注册用户同意公开其个人资料，享受为其提供的产品和服务；本站需要听从法庭传票、法律命令或遵循法律程序；本站发现注册用户违反了本站服务条款或本站其它使用规定。&lt;/p&gt;\r\n\r\n&lt;p&gt;4、关于注册用户隐私的具体协议以本站的隐私声明为准。如果注册用户提供的资料包含有不正确的信息，本站保留结束注册用户使用网络服务资格的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;三、帐户密码和安全性&lt;/p&gt;\r\n\r\n&lt;p&gt;注册用户一旦注册成功，成为本站的合法的注册用户。您可随时根据需要改变您的密码。注册用户将对注册用户名和密码安全负全部责任。另外，每个注册用户都要对以其注册用户名进行的所有活动和事件负全责。注册用户若发现任何非法使用注册用户帐户或存在安全漏洞的情况，请立即通告本站。&lt;/p&gt;\r\n\r\n&lt;p&gt;四、拒绝提供担保&lt;/p&gt;\r\n\r\n&lt;p&gt;注册用户个人对网络服务的使用承担风险。本站对此不作任何类型的担保，不论是明确的或隐含的，但是不对商业性的隐含担保、特定目的和不违反规定的适当担保作限制。本站不担保服务一定能满足注册用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。&lt;/p&gt;\r\n\r\n&lt;p&gt;五、有限责任&lt;/p&gt;\r\n\r\n&lt;p&gt;本站对任何直接、间接、偶然、特殊及继起的损害不负责任，这些损害可能来自：不正当使用网络服务，在网上购买商品或进行同类型服务，在网上进行交易，非法使用网络服务或注册用户传送的信息有所变动。这些行为都有可能会导致本站的形象受损，所以本站事先提出这种损害的可能性。&lt;/p&gt;\r\n\r\n&lt;p&gt;六、通告&lt;/p&gt;\r\n\r\n&lt;p&gt;所有发给注册用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。本站的活动信息也将定期通过页面公告及电子邮件方式向注册用户发送。注册用户协议条款的修改、服务变更、或其它重要事件的通告会以电子邮箱或者短信进行通知。&lt;/p&gt;\r\n\r\n&lt;p&gt;七、注册用户的建议奖励&lt;/p&gt;\r\n\r\n&lt;p&gt;注册用户在他们发表的一些良好建议以及一些比较有价值的策划方案时，本站愿意展示用户的构想落于实现，这其中本站会对一些比较好的注册用户反馈信息进行不等的产品奖励或者是积分奖励，但如出现用户策划与广告销售商之间的矛盾本站不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;八、责任限制&lt;/p&gt;\r\n\r\n&lt;p&gt;1、如因不可抗力或其他本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，本站不承担责任。但是本站会尽可能合理地协助处理善后事宜，并努力使客户免受经济损失。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、除了本站的使用条件中规定的其它限制和除外情况之外，在中国法律法规所允许的限度内，对于因交易而引起的或与之有关的任何直接的、间接的、特殊的、附带的、后果性的或惩罚性的损害，或任何其它性质的损害，本站、本站的董事、管理人员、雇员、代理或其它代表在任何情况下都不承担责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;九、法律管辖和适用&lt;/p&gt;\r\n\r\n&lt;p&gt;1、本协议的订立、执行和解释及争议的解决均应适用中国法律。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它合法条款则依旧保持对注册用户产生法律效力和影响。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。&lt;/p&gt;\r\n\r\n&lt;p&gt;4、如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向本站所在地的____________人民法院提起诉讼。&lt;/p&gt;\r\n\r\n&lt;p&gt;十、其他规定&lt;/p&gt;\r\n\r\n&lt;p&gt;1、如本用户协议中的任何内容无论因何种原因完全或部分无效或不具有执行力，本用户协议的其余内容仍应有效并且对协议各方有约束力。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、本用户协议中的标题仅为方便而设，不具法律或契约效果。&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;a name=&quot;219246&quot;&gt;&lt;/a&gt;\r\n\r\n&lt;h3 style=&quot;border-left:5px solid #3991e5;color:#3991e5;background:#f5f7f7;line-height:38px;margin:25px 0;font-weight:bold;&quot;&gt;【第3篇】网站用户注册协议书通用版&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;一、总则此份协议是注册用户接受_______________网站（以下简称本站）产品和服务时适用的通用条款。因此，请您在注册成为本站用户前或接受本站的产品和服务之前，请您详细地阅读本注册用户协议的所有内容。&lt;/p&gt;\r\n\r\n&lt;p&gt;1、注册用户了解并同意：&lt;/p&gt;\r\n\r\n&lt;p&gt;①只要注册用户点击同意按钮并完成注册，注册用户就已接受了本注册用户协议及本站公布的各项服务规则（包括填写实名的联系方式等等），并愿意受其约束。如果发生纠纷，注册用户不得以未仔细阅读为由进行抗辩。&lt;/p&gt;\r\n\r\n&lt;p&gt;②随着市场经营情况的变化，本站有权随时更改本注册用户协议及相关服务规则。修改本注册用户协议时，本站将于相关页面公告修改的事实，有权不对注册用户进行个别通知。注册用户应该在每次登录前查询网站的相关公告，以了解注册用户协议及其他服务规则的变化。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、若注册用户不同意本注册用户协议或相关服务规则，或者不同意本站作出的修改，注册用户可以主动停止使用本站提供的产品和服务，如果在本站修改协议或服务规则后，注册用户仍继续使用本站提供的产品和服务，即表示注册用户同意本站对本注册用户协议及相关服务规则所做的所有修改。由于注册用户在注册用户协议变更后因未熟悉公告规定而引起的损失，本站将不会承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本站的各项电子服务的所有权和运作权归本站。本站提供的服务将完全按照其发布的服务条款和操作规则严格执行。注册用户必须完全同意所有服务条款并完成注册程序，才能成为本站的注册用户。注册用户确认：本协议条款是处理双方权利义务的当然约定依据，除非违反国家强制性法律，否则始终有效。&lt;/p&gt;\r\n\r\n&lt;p&gt;二、服务简介&lt;/p&gt;\r\n\r\n&lt;p&gt;1、本站运用自己的操作系统通过国际互联网络为注册用户提供网络服务。同时，注册用户必须：自行配备上网的所需设备，包括个人电脑、调制解调器或其他必备上网装置。自行负担个人上网所支付的与此服务有关的电话费用、网络费用。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、基于本站所提供的网络服务的重要性，注册用户应同意：提供详尽、准确的个人资料。不断更新注册资料，符合及时、详尽、准确的要求。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本站对注册用户的电子邮件、手机号等隐私资料进行保护，承诺不会在未获得注册用户许可的情况下擅自将注册用户的个人资料信息出租或出售给任何第三方，但以下情况除外：注册用户同意让第三方共享资料；注册用户同意公开其个人资料，享受为其提供的产品和服务；本站需要听从法庭传票、法律命令或遵循法律程序；本站发现注册用户违反了本站服务条款或本站其它使用规定。&lt;/p&gt;\r\n\r\n&lt;p&gt;4、关于注册用户隐私的具体协议以本站的隐私声明为准。如果注册用户提供的资料包含有不正确的信息，本站保留结束注册用户使用网络服务资格的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;三、帐户密码和安全性注册用户一旦注册成功，成为本站的合法的注册用户。您可随时根据需要改变您的密码。注册用户将对注册用户名和密码安全负全部责任。另外，每个注册用户都要对以其注册用户名进行的所有活动和事件负全责。注册用户若发现任何非法使用注册用户帐户或存在安全漏洞的情况，请立即通告本站。&lt;/p&gt;\r\n\r\n&lt;p&gt;四、拒绝提供担保注册用户个人对网络服务的使用承担风险。本站对此不作任何类型的担保，不论是明确的或隐含的，但是不对商业性的隐含担保、特定目的和不违反规定的适当担保作限制。本站不担保服务一定能满足注册用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。&lt;/p&gt;\r\n\r\n&lt;p&gt;五、有限责任本站对任何直接、间接、偶然、特殊及继起的损害不负责任，这些损害可能来自：不正当使用网络服务，在网上购买商品或进行同类型服务，在网上进行交易，非法使用网络服务或注册用户传送的信息有所变动。这些行为都有可能会导致本站的形象受损，所以本站事先提出这种损害的可能性。&lt;/p&gt;\r\n\r\n&lt;p&gt;六、通告所有发给注册用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。本站的活动信息也将定期通过页面公告及电子邮件方式向注册用户发送。注册用户协议条款的修改、服务变更、或其它重要事件的通告会以电子邮箱或者短信进行通知。&lt;/p&gt;\r\n\r\n&lt;p&gt;七、注册用户的建议奖励注册用户在他们发表的一些良好建议以及一些比较有价值的策划方案时，本站愿意展示用户的构想落于实现，这其中本站会对一些比较好的注册用户反馈信息进行不等的产品奖励或者是积分奖励，但如出现用户策划与广告销售商之间的矛盾本站不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;八、责任限制&lt;/p&gt;\r\n\r\n&lt;p&gt;1、如因不可抗力或其他本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，本站不承担责任。但是本站会尽可能合理地协助处理善后事宜，并努力使客户免受经济损失。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、除了本站的使用条件中规定的其它限制和除外情况之外，在中国法律法规所允许的限度内，对于因交易而引起的或与之有关的任何直接的、间接的、特殊的、附带的、后果性的或惩罚性的损害，或任何其它性质的损害，本站、本站的董事、管理人员、雇员、代理或其它代表在任何情况下都不承担责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;九、法律管辖和适用&lt;/p&gt;\r\n\r\n&lt;p&gt;1、本协议的订立、执行和解释及争议的解决均应适用中国法律。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、如发生本站服务条款与中国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它合法条款则依旧保持对注册用户产生法律效力和影响。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、本协议的规定是可分割的，如本协议任何规定被裁定为无效或不可执行，该规定可被删除而其余条款应予以执行。&lt;/p&gt;\r\n\r\n&lt;p&gt;4、如双方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向本站所在地的____________人民法院提起诉讼。&lt;/p&gt;\r\n\r\n&lt;p&gt;十、其他规定&lt;/p&gt;\r\n\r\n&lt;p&gt;1、如本用户协议中的任何内容无论因何种原因完全或部分无效或不具有执行力，本用户协议的其余内容仍应有效并且对协议各方有约束力。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、本用户协议中的标题仅为方便而设，不具法律或契约效果。&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;a name=&quot;303849&quot;&gt;&lt;/a&gt;\r\n\r\n&lt;h3 style=&quot;border-left:5px solid #3991e5;color:#3991e5;background:#f5f7f7;line-height:38px;margin:25px 0;font-weight:bold;&quot;&gt;【第4篇】用户注册协议书范本&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;一、总则&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）平台的所有权和运营权归_______________公司所有。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）用户在注册之前，应当仔细阅读本协议，并同意遵守本协议后方可成为注册用户。一旦注册成功，则用户与平台之间自动形成协议关系，用户应当受本协议的约束。用户必须完全同意所有服务条款并完成注册程序，才能成为平台的正式用户。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）本协议可由平台随时更新，用户应当及时关注并同意本站不承担通知义务。本站的通知、公告、声明或其它类似内容是本协议的一部分。&lt;/p&gt;\r\n\r\n&lt;p&gt;二、服务内容&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）平台的具体内容由本站根据实际情况提供。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）本站仅提供相关的网络服务，除此之外与相关网络服务有关的设备（如个人电脑、手机、及其他与接入互联网或移动网有关的装置）及所需的费用（如为接入互联网而支付的电话费及上网费、为使用移动网而支付的手机费）均应由用户自行负担。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）如果用户提供的资料包含有不正确的信息，本平台保留结束用户使用网络服务资格的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;三、用户账号&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）经本站注册系统完成注册程序并通过身份认证的用户即成为正式用户，可以获得本站规定用户所应享有的一切权限；未经身份认证仅享有本站规定的部分会员权限。平台有权对会员的权限设计进行变更。如果用户提供的注册资料不合法、不真实、不准确、不详尽的，用户需承担因此引起的相应责任及后果，并且平台保留终止用户使用平台服务的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）用户只能按照注册要求使用真实手机号码注册。用户有义务保证密码和账号的安全，用户利用该密码和账号所进行的一切活动引起的任何损失或损害，由用户自行承担全部责任，本站不承担任何责任。如用户发现账号遭到未授权的使用或发生其他任何安全问题，应立即修改账号密码并妥善保管，如有必要，请通知本站。因黑客行为或用户的保管疏忽导致账号非法使用，本站不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）用户若发现任何非法使用用户账号或存在安全漏洞的情况，请立即通告平台。&lt;/p&gt;\r\n\r\n&lt;p&gt;四、使用规则&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）遵守中华人民共和国国相关法律 法规 ，包括但不限于《中华人民共和国国计算机信息系统安全保护条例》、《计算机软件保护条例》、《最高人民法院关于审理涉及计算机网络 著作权 纠纷案件适用法律若干问题的解释（法释1号）》、《全国人大常委会关于维护互联网安全的决定》、《互联网电子公告服务管理规定》、《互联网新闻信息服务管理规定》、《互联网著作权行政保护办法》和《信息网络传播权保护条例》等有关计算机互联网规定和 知识产权 的法律和法规、实施办法。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）用户对其自行发表、上传或传送的内容负全部责任，所有用户不得在本站任何页面发布、转载、传送含有下列内容之一的信息，否则本站有权自行处理并不通知用户：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、违反 宪法 确定的基本原则的；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、损害国家荣誉和利益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、煽动民族仇恨、民族歧视，破坏民族团结的；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、破坏国家宗教政策，宣扬邪教和封建迷信的；&lt;/p&gt;\r\n\r\n&lt;p&gt;6、散布谣言，扰乱社会秩序，破坏社会稳定的；&lt;/p&gt;\r\n\r\n&lt;p&gt;7、散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的；&lt;/p&gt;\r\n\r\n&lt;p&gt;8、侮辱或者诽谤他人，侵害他人合法权益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;9、煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的；&lt;/p&gt;\r\n\r\n&lt;p&gt;10、以非法民间组织名义活动的；1&lt;/p&gt;\r\n\r\n&lt;p&gt;1、含有法律、行政法规禁止的其他内容的；1&lt;/p&gt;\r\n\r\n&lt;p&gt;2、不得传输或发表：煽动抗拒、破坏宪法和法律、行政法规实施的言论，煽动颠覆国家政权，推翻社会主义制度的言论，煽动分裂国家、破坏国家统一的的言论，煽动民族仇恨、民族歧视、破坏民族团结的言论。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）用户承诺对其发表或者上传于本站的所有信息（即属于《中华人民共和国国 著作权法 》规定的作品，包括但不限于地图数据、文字、图片、音乐、电影、表演和录音录像制品和电脑程序等）均享有完整的知识产权，或者已经得到相关权利人的合法授权；如用户违反本条规定造成本站被第三人索赔的，用户应全额补偿本站一切费用（包括但不限于各种赔偿费、 诉讼 代理 费及为此支出的其它合理费用）。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）当第三方认为用户发表或者上传于本站的信息侵犯其权利，并根据《信息网络传播权保护条例》或者相关法律规定向本站发送权利通知书时，用户同意本站可以自行判断决定删除涉嫌侵权信息，除非用户提交书面 证据 材料排除侵权的可能性，本站将不会自动恢复上述删除的信息。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）平台保有删除站内各类不符合法律政策或不真实的信息内容而无须通知用户的权利。若用户未遵守以上规定的，平台有权作出独立判断并采取暂停或关闭用户账号等措施。用户须对自己在网上的言论和行为承担法律责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;五、隐私保护&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）尊重您个人信息的隐私是平台的一项基本制度，平台将会采取合理的措施保护您的个人信息。平台保证不对外公开或向第三方提供您的个人信息，但下列情况除外：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、您的个人信息属于或者成为可公开获取的信息；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、由平台通过合法方式获知且无需对其履行保密义务的个人信息；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、通过可以合法披露此个人信息且无需对其履行保密义务的第三方获得的信息；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、事先获得您的明确授权；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、根据有关的法律法规的要求；&lt;/p&gt;\r\n\r\n&lt;p&gt;6、按照相关政府主管部门或司法部门的要求；&lt;/p&gt;\r\n\r\n&lt;p&gt;7、为维护社会公众的利益；&lt;/p&gt;\r\n\r\n&lt;p&gt;8、为维护平台、其附属关联公司的合法权益。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）您理解并同意，平台可能会与第三方合作向您提供该服务，在此情况下，如该第三方同意承担与平台同等的保护您个人信息的责任，则平台将授权第三方通过________定义接口调用经过加密的您的个人信息，平台保证第三方不会直接获取您的个人信息。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）您理解并同意，在不透露您个人信息的前提下，平台有权对该服务的整个用户数据库进行分析并对用户数据库进行商业上的利用。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）在您使用该服务时，平台可能自动接收并记录您的地图应用端上的服务器数值，包括但不限于地址等数据、您和用户要求取用的网页记录及各种记录、该服务的操作状态以及使用习惯等一些明确且客观反映在平台服务器端的基本记录信息。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）________不允许任何人以任何手段收集、编辑、出售或者无偿传播您或其他用户的个人信息。一经发现您实施上述行为，________有权立即终止向您提供服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;六、免责声明&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）若平台已经明示其网络服务提供方式发生变更并提醒用户应当注意事项，用户未按要求操作所产生的一切后果由用户自行承担。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）用户明确同意其使用平台网络服务，以及因此对平台网络服务加以依赖所存在的全部责任和风险将完全由其自己承担；因其使用平台网络服务过程的行为，以及因此而产生的一切后果也由其自己承担，平台对用户不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）平台不担保网络服务一定能满足用户的要求，也不担保网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作担保。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）用户因使用平台网络服务而产生的任何间接的、附带的、特殊的、结果性的或惩戒性的损害（包括但不限于利润亏损、商誉、使用服务、数据的损害或其它无形损失），平台概不负责，均由用户自行承担。&lt;/p&gt;\r\n\r\n&lt;p&gt;（五）用户或用户的代理或关联人士违反本协议或相关法律，或因用户或用户的代理或关联人士（以参与者的身份行事）所做出的行为或疏忽而产生的任何损害，概由用户自行负责。&lt;/p&gt;\r\n\r\n&lt;p&gt;七、拒绝提供担保用户个人对网络服务的使用承担风险。平台对此不作任何类型的担保，不论是明确的或隐含的，但是不对商业性的隐含担保、特定目的和不违反规定的适当担保作限制。平台不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。&lt;/p&gt;\r\n\r\n&lt;p&gt;八、有限责任平台对任何直接、间接、偶然、特殊及继起的损害不负责任，这些损害可能来自：不正当使用网络服务，在网上进行交易，非法使用网络服务或用户传送的信息有所变动。这些行为都有可能会导致本平台的形象受损，所以平台事先提出这种损害的可能性。&lt;/p&gt;\r\n\r\n&lt;p&gt;九、对用户信息的存储和限制平台不对用户所发布信息的删除或储存失败负责。平台有判定用户的行为是否符合平台服务条款的要求和精神的保留权利，如果用户违背了服务条款的规定，平台有中断对其提供网络服务的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;十、用户管理&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）用户单独承担发布内容的责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）用户对服务的使用是根据所有适用于平台的国家法律、地方法律和国际法律标准的。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）用户必须遵循：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、从中国境内向外传输技术性资料时必须符合中国有关法规；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、使用网络服务不作非法用途；&lt;/p&gt;\r\n\r\n&lt;p&gt;3、不干扰或混乱网络服务；&lt;/p&gt;\r\n\r\n&lt;p&gt;4、遵守所有使用网络服务的网络协议、规定、程序和惯例；&lt;/p&gt;\r\n\r\n&lt;p&gt;5、招商引资活动符合法律规定及双方约定；&lt;/p&gt;\r\n\r\n&lt;p&gt;6、用户须承诺不传输任何非法的、骚扰性的、中伤他人的、辱骂性的、恐性的、伤害性的、庸俗的，淫秽等信息资料；&lt;/p&gt;\r\n\r\n&lt;p&gt;7、另外，用户也不能传输何教唆他人构成犯罪行为的资料；不能传输助长国内不利条件和涉及国家安全的资料；不能传输任何不符合当地法规、国家法律和国际法律的资料。未经许可而非法进入其它电脑系统是禁止的；&lt;/p&gt;\r\n\r\n&lt;p&gt;8、若用户的行为不符合以上提到的服务条款，平台将作出独立判断立即取消用户服务账号。用户需对自己在网上的行为承担法律责任；&lt;/p&gt;\r\n\r\n&lt;p&gt;9、用户若在平台上散布和传播反动、色情或其他违反国家法律的信息，平台的系统记录有可能作为用户违反法律的证据。十&lt;/p&gt;\r\n\r\n&lt;p&gt;一、保障用户同意保障和维护平台全体成员的利益，违反服务条款的损害补偿费用等。十&lt;/p&gt;\r\n\r\n&lt;p&gt;二、结束服务&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）平台可随时根据实际情况中断一项或多项网络服务。平台不需对任何个人或第三方负责而随时中断服务。用户对后来的条款修改有异议，或对平台的服务不满，可以行使如下权利：&lt;/p&gt;\r\n\r\n&lt;p&gt;1、停止使用平台的网络服务；&lt;/p&gt;\r\n\r\n&lt;p&gt;2、通告平台停止对该用户的服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）结束用户服务后，用户使用网络服务的权利马上中止。从那时起，用户有权利，平台也没有义务传送任何未处理的信息或未完成的服务给户或第三方。十&lt;/p&gt;\r\n\r\n&lt;p&gt;三、通告所有发给用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。服务条款的修改、服务变更、或其它重要事件的通告都会以此形式进行。十&lt;/p&gt;\r\n\r\n&lt;p&gt;四、参与广告策划用户在他们发表的信息中加入宣传资料或参与广告策划，在本平台的服务上展示他们的招商条件等，任何这类宣传方法，只是在相应的用户和入驻商户之间发生。平台不承担任何责任，平台没有义务为这类广告负任何责任。十&lt;/p&gt;\r\n\r\n&lt;p&gt;五、网络服务内容的所有权&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）平台定义的网络服务内容包括：文字、软件、声音、图片、录像、图表、广告中的全部内容；电子邮件的全部内容；本平台为用户提供的其他信息。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）所有这些内容受版权、 商标 、标签和其它财产所有权法律的保护。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）所以，用户只能在本平台和广告商授权下才能使用这些内容，而不能擅自复制、再造这些内容、或创造与内容有关的派生产品。&lt;/p&gt;\r\n\r\n&lt;p&gt;（四）平台所有的文章版权归原文作者和平台共同所有，任何人需要转载本平台的文章，必须征得原文作者或平台授权。十&lt;/p&gt;\r\n\r\n&lt;p&gt;六、法律及 管辖&lt;/p&gt;\r\n\r\n&lt;p&gt;（一）网络服务条款要与中华人民共和国国的法律解释相一致，用户和平台一致同意服从高等法院所有管辖。如发生平台服务条款与中华人民共和国国法律相抵触时，则这些条款将完全按法律规定重新解释，而其它条款则依旧保持对用户产生法律效力和影响。&lt;/p&gt;\r\n\r\n&lt;p&gt;（二）因本用户协议产生纠纷的，用户可向网络服务提供者_______________人民法院提起诉讼。&lt;/p&gt;\r\n\r\n&lt;p&gt;（三）一经注册成为本网站的用户，即代表同意签署本用户协议并愿意遵守相关条款约束。&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;a name=&quot;289043&quot;&gt;&lt;/a&gt;\r\n\r\n&lt;h3 style=&quot;border-left:5px solid #3991e5;color:#3991e5;background:#f5f7f7;line-height:38px;margin:25px 0;font-weight:bold;&quot;&gt;【第5篇】b2b网站用户注册协议书范本&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;尊敬的客户，欢迎您注册成为________________网站用户（以下简称网站）。在注册前请您仔细阅读如下服务条款：本协议双方为网站与网站用户，本协议具有合同效力。您确认本协议后，本协议即在您和网站之间产生法律效力。请您务必在注册之前认真阅读全部服务协议内容，如有任何疑问，可向网站咨询。无论您事实上是否在注册之前认真阅读了本服务协议，只要您点击协议正本下方的注册按钮并按照网站注册程序成功注册为用户，您的行为仍然表示您同意并签署了本协议。&lt;/p&gt;\r\n\r\n&lt;p&gt;1、网站服务条款的确认和接纳网站各项服务的所有权和运作权归网站拥有。&lt;/p&gt;\r\n\r\n&lt;p&gt;2、用户必须：&lt;/p&gt;\r\n\r\n&lt;p&gt;①自行配备使用网站的所需设备，包括个人电脑、手机等。&lt;/p&gt;\r\n\r\n&lt;p&gt;②自行负担个人上网所支付的与此服务有关的电话费用、网络费用。&lt;/p&gt;\r\n\r\n&lt;p&gt;3、用户承诺不得在网站上上传和发布下列违法文件及信息：&lt;/p&gt;\r\n\r\n&lt;p&gt;①反对宪法所确定的基本原则的；&lt;/p&gt;\r\n\r\n&lt;p&gt;②危害国家安全，泄露国家秘密，颠覆国家政权，破坏国家统一的；&lt;/p&gt;\r\n\r\n&lt;p&gt;③损害国家荣誉和利益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;④煽动民族仇恨、民族歧视，破坏民族团结的；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑤破坏国家宗教政策，宣扬邪教和封建迷信的；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑥散布谣言，扰乱社会秩序，破坏社会稳定的；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑦散布淫秽、色情、赌博、暴力、凶杀、恐怖或者教唆犯罪的；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑧侮辱或者诽谤他人，侵害他人合法权益的；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑨含有法律、行政法规禁止的其他内容的&lt;/p&gt;\r\n\r\n&lt;p&gt;4、电子邮件用户在注册时应当选择稳定性及安全性相对较好的电子邮箱，并且同意接受并阅读网站发往用户的各类电子邮件。如用户未及时从自己的电子邮箱接受电子邮件或因用户电子邮箱或用户电子邮件接收及阅读程序本身的问题使电子邮件无法正常接收或阅读的，只要网站成功发送了电子邮件，应当视为用户已经接收到相关的电子邮件。电子邮件在发信服务器上所记录的发出时间视为送达时间。&lt;/p&gt;\r\n\r\n&lt;p&gt;5、服务条款的修改网站有权在必要时修改服务条款，网站服务条款一旦发生变动，将会在重要页面上提示修改内容。如果不同意所改动的内容，用户可以主动停止使用网站及网站的一切服务。如果用户继续使用网站任何服务，则视为接受服务条款的变动。网站保留随时修改或中断服务而不需通知用户的权利。网站行使修改或中断服务的权利，不需对用户或第三方负责。&lt;/p&gt;\r\n\r\n&lt;p&gt;6、用户管理用户在使用网站服务过程中，必须遵循以下原则：&lt;/p&gt;\r\n\r\n&lt;p&gt;①遵守中国有关的法律和法规；&lt;/p&gt;\r\n\r\n&lt;p&gt;②不得为任何非法目的而使用网络服务系统；&lt;/p&gt;\r\n\r\n&lt;p&gt;③遵守所有与网络服务有关的网络协议、规定和程序；&lt;/p&gt;\r\n\r\n&lt;p&gt;④不得利用网站服务系统进行任何可能对互联网的正常运转造成不利影响的行为；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑤不得利用网站服务系统传输任何骚扰性的、中伤他人的、辱骂性的、恐吓性的、庸俗淫秽的或其他任何非法的信息资料；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑥不得利用网站服务系统进行任何不利于网站的行为；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑦就网站及合作商业伙伴的服务、产品、业务咨询应采取相应机构提供的沟通渠道，不得在公众场合发布有关网站及相关服务的负面宣传；&lt;/p&gt;\r\n\r\n&lt;p&gt;⑧不得以任何方式危害未成年人。&lt;/p&gt;\r\n\r\n&lt;p&gt;7、用户帐号安全&lt;/p&gt;\r\n\r\n&lt;p&gt;①用户可以通过在网站注册或使用其他合作网站的帐号使用网站提供的各项服务。用户注册成功后，网站将给用户一个帐号及密码，每个帐号对应一个唯一的名字（或昵称、用户名）。网站帐号的所有权归网站，用户完成申请注册手续后，获得的网站帐号的使用权，但仅限为与网站相关的业务或服务而非其它商业目的使用。&lt;/p&gt;\r\n\r\n&lt;p&gt;②用户须妥善管理自己的用户名及密码，禁止赠与、借用、租用、转让或者售卖。若出于您的原因导致密码泄露，您需自行承担相应的一切责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;③用户帐号和密码遭到他人非法使用或发生其他任何安全问题，用户应当立即联系网站。网站在收到用户要求采取措施暂停其帐号登录和使用的申请后，应当要求用户提供与其注册身份信息一致的个人有效身份信息及其他证件和资料。网站核实审查无误后，应当及时采取措施暂停用户帐号的登录和使用。用户没按要求提供相关信息或者信息有误，网站有权拒绝用户的前述请求。&lt;/p&gt;\r\n\r\n&lt;p&gt;④用户每次使用完网站相关服务后，请关闭退出有关帐号。因黑客行为或用户的过错导致帐号、密码或被他人非法使用，网站不承担任何责任。&lt;/p&gt;\r\n\r\n&lt;p&gt;8、用户个人资料用户同意：&lt;/p&gt;\r\n\r\n&lt;p&gt;①提供及时、详尽及准确的的个人资料。&lt;/p&gt;\r\n\r\n&lt;p&gt;②同意接收来自网站的信息。&lt;/p&gt;\r\n\r\n&lt;p&gt;③不断更新注册资料，如因注册信息不真实而引起的问题由用户本人承担，网站不承担任何责任，并有权暂停或终止该用户帐号使用权。&lt;/p&gt;\r\n\r\n&lt;p&gt;9、使用风险用户明确同意对网站的使用由用户个人承担风险。网站无法担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保，但会在能力范围内，避免出错。&lt;/p&gt;\r\n\r\n&lt;p&gt;10、有限责任网站对来自：不正当使用网站相关功能及服务，或用户上传的内容不符合规定等任何直接、间接、偶然、不负责任的损害网站都不负责任，但会尽量避免这种损害的发生。并保留因用户不正当使用网站而给网站造成各种损害（包括名誉损害等），网站通过法律途径向其追索法律及经济责任的权利。1&lt;/p&gt;\r\n\r\n&lt;p&gt;1、服务限制网站有判定用户的行为是否符合网站服务条款的要求和精神的权利，如果用户违背网站服务条款的规定，网站有权中断其服务的帐号。1&lt;/p&gt;\r\n\r\n&lt;p&gt;2、利益保障用户同意保障和维护网站全体成员的利益，并承担由用户使用超出服务范围或不正当使用而引起的法律纠纷而产生的律师费用、交通费、违反服务条款的损害补偿费用、其他人使用用户的电脑、手机、帐号和其它知识产权的追索费等相关费用。1&lt;/p&gt;\r\n\r\n&lt;p&gt;3、服务内容&lt;/p&gt;\r\n\r\n&lt;p&gt;①网站在线服务的具体内容网站根据实际情况提供，例如网络硬盘、外链、论坛等。网站保留随时变更、中止或终止部分或全部网络服务的权利。&lt;/p&gt;\r\n\r\n&lt;p&gt;②网站在提供网络服务时，可能会对部分网络服务（例如网络存储及其他电信增值服务）的用户收取一定的费用。在此情况下，网站会在相关页面上做明确的提示。如用户不同意支付该等费用，则可不接受相关的网络服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;③网站仅提供相关的网络服务，除此之外与相关网络服务有关的设备（如电脑、调制解调器及其他与接入互联网有关的装置）及所需的费用（如为接入互联网而支付的电话费及上网费）均应由用户自行负担。&lt;/p&gt;\r\n\r\n&lt;p&gt;④用户应使用正版软件接受网络服务。&lt;/p&gt;\r\n\r\n&lt;p&gt;⑤用户需理解网站也会为其他互联网企业定制专业化的用户服务体系，即用户通过网站获得的服务内容有可能来源于第三方企业，一旦用户接受该第三方企业提供的网络服务内容，则用户应当遵守该第三方企业对其服务做出的约定。如第三方企业接入网站系统且其既有用户可以使用网站提供的服务，则该既有用户即成为网站的用户，其帐号也自动成为网站帐号。该既有用户同意亦将与在网站系统中直接注册的用户一样遵守本协议的约定。但对于这些既有用户，网站在服务过程中会仍然提供其已经熟悉的网站界面，该过程仅为方便用户接受服务而设，既有用户与网站之间的关系仍应受本协议的约定。&lt;/p&gt;\r\n\r\n&lt;p&gt;⑥关于用户付费的特别提示：在网站系统中，用户可以通过支付手段（包括但不限于网银充值、银行卡充值、实物充值、手机卡充值等）为其帐号购买在线增值服务，以及提供第三方应用内容提供企业联营的在线服务。对于需要支付一定的费用的收费服务，网站在用户使用前明示，只有用户根据相关提示确认其原意支付相关费用，用户才能使用该等收费的网络服务。如果用户拒绝支付相关费用，则网站有权不向该用户提供该等收费网络服务。为了尊重用户的消费习惯和符合用户体验习惯，用户在利用网站提供的服务进行付费的过程中，用户需要理解并知晓网站可能出现需要第三方支付系统进行支付。1&lt;/p&gt;\r\n\r\n&lt;p&gt;4、结束服务用户或网站可随时根据实际情况中断一项或多项服务。网站不需对任何个人或第三方负责而随时中断服务。用户若反对任何服务条款的建议或对后来的条款修改有异议，或对网站服务不满，用户可以行使如下权利：&lt;/p&gt;\r\n\r\n&lt;p&gt;①不再使用网站所有服务；&lt;/p&gt;\r\n\r\n&lt;p&gt;②网站停止对该用户的服务。结束用户服务后，用户使用网站服务的权利马上中止。从那时起，用户没有权利，网站也没有义务传送任何未处理的信息或未完成的服务给用户或第三方。1&lt;/p&gt;\r\n\r\n&lt;p&gt;5、通告所有发给用户的通告都可通过重要页面的公告或电子邮件或常规的信件传送。服务条款的修改、服务变更、或其它重要事件的通告都会以此形式进行。1&lt;/p&gt;\r\n\r\n&lt;p&gt;6、信息内容的所有权网站和网站服务中的所有知识产权、网站中的信息内容或作为服务内容的信息、数据库、所有网站设计、文字和图表、软件、照片、录像、音乐、声音及其前述组合，以及所有软件编译、相关源代码和软件（包括小应用程序和脚本）均为网站的财产。您不得、亦不得意图获得该知识产权。未经网站书面允许，您不得为商业目的复制、更改、拷贝、发送或使用网站上的任何材料或内容，如因您的行为而给网站造成损害，网站将通过法律途径追索经济和法律责任。1&lt;/p&gt;\r\n\r\n&lt;p&gt;7、法律网站服务条款要与中华人民共和国国的法律解释一致。用户和网站一致同意服从网站所在地有管辖权的_____________法院管辖。&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\";}');

-- ----------------------------
-- Table structure for x2_category
-- ----------------------------
DROP TABLE IF EXISTS `x2_category`;
CREATE TABLE `x2_category`  (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `catapp` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `catlite` int(11) NOT NULL DEFAULT 0,
  `catname` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `catimg` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `caturl` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `catuseurl` int(1) NOT NULL DEFAULT 0,
  `catparent` int(11) NULL DEFAULT 0,
  `catdes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cattpl` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `catmanager` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `catinmenu` int(1) NOT NULL DEFAULT 0,
  `catindex` int(4) NOT NULL DEFAULT 0,
  `catsubject` int(11) NOT NULL,
  PRIMARY KEY (`catid`) USING BTREE,
  INDEX `catlite`(`catlite`, `catparent`) USING BTREE,
  INDEX `catappid`(`catapp`) USING BTREE,
  INDEX `catuseurl`(`catuseurl`) USING BTREE,
  INDEX `catinmenu`(`catinmenu`, `catindex`) USING BTREE,
  INDEX `catsubject`(`catsubject`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 47 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_category
-- ----------------------------
INSERT INTO `x2_category` VALUES (1, 'content', 0, '考试信息', 'files/attach/images/content/20160630/14672817197914.jpg', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 1);
INSERT INTO `x2_category` VALUES (2, 'content', 0, '首页头图', 'files/attach/images/content/20160630/14672817455479.jpg', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 1);
INSERT INTO `x2_category` VALUES (3, 'content', 0, '考试资料', 'files/attach/images/content/20160630/14672817048286.jpg', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 1);
INSERT INTO `x2_category` VALUES (4, 'content', 0, '帮助信息', 'files/attach/images/content/20160630/14672817317018.jpg', '', 0, 0, '&lt;h1 class=&quot;wikititle&quot;&gt;区委区为企鹅&lt;/h1&gt;\r\n\r\n&lt;h2 class=&quot;wikititle&quot;&gt;这是一个什么段落&lt;/h2&gt;', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 0, 1);
INSERT INTO `x2_category` VALUES (5, 'course', 0, '会计基础', 'files/attach/images/content/20180709/15311345313268.png', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 6, 0);
INSERT INTO `x2_category` VALUES (11, 'content', 0, '友情链接', 'app/core/styles/images/noimage.gif', '', 0, 4, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 0, 5, 0);
INSERT INTO `x2_category` VALUES (12, 'docs', 0, '人物', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 0);
INSERT INTO `x2_category` VALUES (13, 'course', 0, '会计实务', 'app/core/styles/images/noimage.gif', '', 0, 5, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 0, 0, 0);
INSERT INTO `x2_category` VALUES (14, 'content', 0, '联系我们', 'app/core/styles/images/noimage.gif', '', 0, 4, '', 'category_default', '', 0, 0, 0);
INSERT INTO `x2_category` VALUES (16, 'course', 0, '商务英语', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 1, 0, 0);
INSERT INTO `x2_category` VALUES (17, 'course', 0, '英语', 'app/core/styles/images/noimage.gif', '', 0, 16, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 0, 0, 0);
INSERT INTO `x2_category` VALUES (18, 'docs', 0, '英语', 'app/core/styles/images/noimage.gif', '', 0, 12, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 0, 0, 0);
INSERT INTO `x2_category` VALUES (19, 'docs', 0, '英语', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 0);
INSERT INTO `x2_category` VALUES (21, 'docs', 0, '数学', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 5, 0);
INSERT INTO `x2_category` VALUES (22, 'course', 0, '应用英语', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', 'a:2:{s:8:\\\"pubusers\\\";s:0:\\\"\\\";s:9:\\\"pubgroups\\\";s:0:\\\"\\\";}', 1, 0, 0);
INSERT INTO `x2_category` VALUES (46, 'item', 0, '默认分类', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', '', 0, 0, 0);
INSERT INTO `x2_category` VALUES (24, 'seminar', 0, '活动', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', '', 0, 0, 0);
INSERT INTO `x2_category` VALUES (25, 'seminar', 0, '会议', 'app/core/styles/images/noimage.gif', '', 0, 0, '', 'category_default', '', 0, 0, 0);
INSERT INTO `x2_category` VALUES (26, 'content', 0, '网站公告', 'app/core/styles/images/noimage.gif', '', 0, 4, '', 'category_default', '', 0, 6, 0);
INSERT INTO `x2_category` VALUES (32, 'content', 546, '初级会计', 'app/core/styles/images/noimage.gif', '', 0, 1, '&lt;p&gt;56464&lt;/p&gt;', 'category_page', '', 0, 0, 0);
INSERT INTO `x2_category` VALUES (33, 'course', 0, '会计技能', 'app/core/styles/images/noimage.gif', '', 0, 5, '', 'category_default', 'a:2:{s:8:\"pubusers\";s:0:\"\";s:9:\"pubgroups\";s:0:\"\";}', 0, 0, 0);

-- ----------------------------
-- Table structure for x2_cequeue
-- ----------------------------
DROP TABLE IF EXISTS `x2_cequeue`;
CREATE TABLE `x2_cequeue`  (
  `ceqid` int(11) NOT NULL AUTO_INCREMENT,
  `ceqceid` int(11) NOT NULL,
  `cequserid` int(11) NOT NULL,
  `ceqinfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ceqtime` int(11) NOT NULL,
  `ceqstatus` tinyint(1) NOT NULL,
  `ceqordersn` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ceqpubtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ceqid`) USING BTREE,
  INDEX `cequserid`(`cequserid`) USING BTREE,
  INDEX `ceqtime`(`ceqtime`) USING BTREE,
  INDEX `ceqstatus`(`ceqstatus`) USING BTREE,
  INDEX `ceqordersn`(`ceqordersn`) USING BTREE,
  INDEX `ceqceid`(`ceqceid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_cequeue
-- ----------------------------

-- ----------------------------
-- Table structure for x2_certificate
-- ----------------------------
DROP TABLE IF EXISTS `x2_certificate`;
CREATE TABLE `x2_certificate`  (
  `ceid` int(11) NOT NULL AUTO_INCREMENT,
  `cetitle` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cethumb` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ceprice` int(10) NOT NULL,
  `cebasic` int(11) NULL DEFAULT NULL,
  `cedays` int(11) NULL DEFAULT NULL,
  `cetime` int(11) NULL DEFAULT NULL,
  `cetpl` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cetags` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cedescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cetext` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`ceid`) USING BTREE,
  INDEX `cebasic`(`cebasic`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_certificate
-- ----------------------------
INSERT INTO `x2_certificate` VALUES (1, '会计资格证', 'files/attach/images/content/20210830/16302940954876.jpg', 0, 1, 60, 1506817500, 'files/attach/images/content/20210617/16239238824206.jpg', 'txt,140,350,{username},25\r\ntxt,700,350,会计资格证,25\r\ntxt,594,660,{ceqtime},25', '会计资格证', '&lt;p&gt;1.学习完课程&lt;/p&gt;\r\n\r\n&lt;p&gt;2.通过考试&lt;/p&gt;');

-- ----------------------------
-- Table structure for x2_city
-- ----------------------------
DROP TABLE IF EXISTS `x2_city`;
CREATE TABLE `x2_city`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cityid` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cityid`(`cityid`) USING BTREE,
  INDEX `father`(`father`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 371 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_city
-- ----------------------------
INSERT INTO `x2_city` VALUES (1, '110100', '北京市', '110000');
INSERT INTO `x2_city` VALUES (3, '120100', '天津市', '120000');
INSERT INTO `x2_city` VALUES (5, '130100', '石家庄市', '130000');
INSERT INTO `x2_city` VALUES (6, '130200', '唐山市', '130000');
INSERT INTO `x2_city` VALUES (7, '130300', '秦皇岛市', '130000');
INSERT INTO `x2_city` VALUES (8, '130400', '邯郸市', '130000');
INSERT INTO `x2_city` VALUES (9, '130500', '邢台市', '130000');
INSERT INTO `x2_city` VALUES (10, '130600', '保定市', '130000');
INSERT INTO `x2_city` VALUES (11, '130700', '张家口市', '130000');
INSERT INTO `x2_city` VALUES (12, '130800', '承德市', '130000');
INSERT INTO `x2_city` VALUES (13, '130900', '沧州市', '130000');
INSERT INTO `x2_city` VALUES (14, '131000', '廊坊市', '130000');
INSERT INTO `x2_city` VALUES (15, '131100', '衡水市', '130000');
INSERT INTO `x2_city` VALUES (16, '140100', '太原市', '140000');
INSERT INTO `x2_city` VALUES (17, '140200', '大同市', '140000');
INSERT INTO `x2_city` VALUES (18, '140300', '阳泉市', '140000');
INSERT INTO `x2_city` VALUES (19, '140400', '长治市', '140000');
INSERT INTO `x2_city` VALUES (20, '140500', '晋城市', '140000');
INSERT INTO `x2_city` VALUES (21, '140600', '朔州市', '140000');
INSERT INTO `x2_city` VALUES (22, '140700', '晋中市', '140000');
INSERT INTO `x2_city` VALUES (23, '140800', '运城市', '140000');
INSERT INTO `x2_city` VALUES (24, '140900', '忻州市', '140000');
INSERT INTO `x2_city` VALUES (25, '141000', '临汾市', '140000');
INSERT INTO `x2_city` VALUES (26, '141100', '吕梁市', '140000');
INSERT INTO `x2_city` VALUES (27, '150100', '呼和浩特市', '150000');
INSERT INTO `x2_city` VALUES (28, '150200', '包头市', '150000');
INSERT INTO `x2_city` VALUES (29, '150300', '乌海市', '150000');
INSERT INTO `x2_city` VALUES (30, '150400', '赤峰市', '150000');
INSERT INTO `x2_city` VALUES (31, '150500', '通辽市', '150000');
INSERT INTO `x2_city` VALUES (32, '150600', '鄂尔多斯市', '150000');
INSERT INTO `x2_city` VALUES (33, '150700', '呼伦贝尔市', '150000');
INSERT INTO `x2_city` VALUES (34, '150800', '巴彦淖尔市', '150000');
INSERT INTO `x2_city` VALUES (35, '150900', '乌兰察布市', '150000');
INSERT INTO `x2_city` VALUES (36, '152200', '兴安盟', '150000');
INSERT INTO `x2_city` VALUES (37, '152500', '锡林郭勒盟', '150000');
INSERT INTO `x2_city` VALUES (38, '152900', '阿拉善盟', '150000');
INSERT INTO `x2_city` VALUES (39, '210100', '沈阳市', '210000');
INSERT INTO `x2_city` VALUES (40, '210200', '大连市', '210000');
INSERT INTO `x2_city` VALUES (41, '210300', '鞍山市', '210000');
INSERT INTO `x2_city` VALUES (42, '210400', '抚顺市', '210000');
INSERT INTO `x2_city` VALUES (43, '210500', '本溪市', '210000');
INSERT INTO `x2_city` VALUES (44, '210600', '丹东市', '210000');
INSERT INTO `x2_city` VALUES (45, '210700', '锦州市', '210000');
INSERT INTO `x2_city` VALUES (46, '210800', '营口市', '210000');
INSERT INTO `x2_city` VALUES (47, '210900', '阜新市', '210000');
INSERT INTO `x2_city` VALUES (48, '211000', '辽阳市', '210000');
INSERT INTO `x2_city` VALUES (49, '211100', '盘锦市', '210000');
INSERT INTO `x2_city` VALUES (50, '211200', '铁岭市', '210000');
INSERT INTO `x2_city` VALUES (51, '211300', '朝阳市', '210000');
INSERT INTO `x2_city` VALUES (52, '211400', '葫芦岛市', '210000');
INSERT INTO `x2_city` VALUES (53, '220100', '长春市', '220000');
INSERT INTO `x2_city` VALUES (54, '220200', '吉林市', '220000');
INSERT INTO `x2_city` VALUES (55, '220300', '四平市', '220000');
INSERT INTO `x2_city` VALUES (56, '220400', '辽源市', '220000');
INSERT INTO `x2_city` VALUES (57, '220500', '通化市', '220000');
INSERT INTO `x2_city` VALUES (58, '220600', '白山市', '220000');
INSERT INTO `x2_city` VALUES (59, '220700', '松原市', '220000');
INSERT INTO `x2_city` VALUES (60, '220800', '白城市', '220000');
INSERT INTO `x2_city` VALUES (61, '222400', '延边朝鲜族自治州', '220000');
INSERT INTO `x2_city` VALUES (62, '230100', '哈尔滨市', '230000');
INSERT INTO `x2_city` VALUES (63, '230200', '齐齐哈尔市', '230000');
INSERT INTO `x2_city` VALUES (64, '230300', '鸡西市', '230000');
INSERT INTO `x2_city` VALUES (65, '230400', '鹤岗市', '230000');
INSERT INTO `x2_city` VALUES (66, '230500', '双鸭山市', '230000');
INSERT INTO `x2_city` VALUES (67, '230600', '大庆市', '230000');
INSERT INTO `x2_city` VALUES (68, '230700', '伊春市', '230000');
INSERT INTO `x2_city` VALUES (69, '230800', '佳木斯市', '230000');
INSERT INTO `x2_city` VALUES (70, '230900', '七台河市', '230000');
INSERT INTO `x2_city` VALUES (71, '231000', '牡丹江市', '230000');
INSERT INTO `x2_city` VALUES (72, '231100', '黑河市', '230000');
INSERT INTO `x2_city` VALUES (73, '231200', '绥化市', '230000');
INSERT INTO `x2_city` VALUES (74, '232700', '大兴安岭地区', '230000');
INSERT INTO `x2_city` VALUES (75, '310100', '上海市', '310000');
INSERT INTO `x2_city` VALUES (77, '320100', '南京市', '320000');
INSERT INTO `x2_city` VALUES (78, '320200', '无锡市', '320000');
INSERT INTO `x2_city` VALUES (79, '320300', '徐州市', '320000');
INSERT INTO `x2_city` VALUES (80, '320400', '常州市', '320000');
INSERT INTO `x2_city` VALUES (81, '320500', '苏州市', '320000');
INSERT INTO `x2_city` VALUES (82, '320600', '南通市', '320000');
INSERT INTO `x2_city` VALUES (83, '320700', '连云港市', '320000');
INSERT INTO `x2_city` VALUES (84, '320800', '淮安市', '320000');
INSERT INTO `x2_city` VALUES (85, '320900', '盐城市', '320000');
INSERT INTO `x2_city` VALUES (86, '321000', '扬州市', '320000');
INSERT INTO `x2_city` VALUES (87, '321100', '镇江市', '320000');
INSERT INTO `x2_city` VALUES (88, '321200', '泰州市', '320000');
INSERT INTO `x2_city` VALUES (89, '321300', '宿迁市', '320000');
INSERT INTO `x2_city` VALUES (90, '330100', '杭州市', '330000');
INSERT INTO `x2_city` VALUES (91, '330200', '宁波市', '330000');
INSERT INTO `x2_city` VALUES (92, '330300', '温州市', '330000');
INSERT INTO `x2_city` VALUES (93, '330400', '嘉兴市', '330000');
INSERT INTO `x2_city` VALUES (94, '330500', '湖州市', '330000');
INSERT INTO `x2_city` VALUES (95, '330600', '绍兴市', '330000');
INSERT INTO `x2_city` VALUES (96, '330700', '金华市', '330000');
INSERT INTO `x2_city` VALUES (97, '330800', '衢州市', '330000');
INSERT INTO `x2_city` VALUES (98, '330900', '舟山市', '330000');
INSERT INTO `x2_city` VALUES (99, '331000', '台州市', '330000');
INSERT INTO `x2_city` VALUES (100, '331100', '丽水市', '330000');
INSERT INTO `x2_city` VALUES (101, '340100', '合肥市', '340000');
INSERT INTO `x2_city` VALUES (102, '340200', '芜湖市', '340000');
INSERT INTO `x2_city` VALUES (103, '340300', '蚌埠市', '340000');
INSERT INTO `x2_city` VALUES (104, '340400', '淮南市', '340000');
INSERT INTO `x2_city` VALUES (105, '340500', '马鞍山市', '340000');
INSERT INTO `x2_city` VALUES (106, '340600', '淮北市', '340000');
INSERT INTO `x2_city` VALUES (107, '340700', '铜陵市', '340000');
INSERT INTO `x2_city` VALUES (108, '340800', '安庆市', '340000');
INSERT INTO `x2_city` VALUES (109, '341000', '黄山市', '340000');
INSERT INTO `x2_city` VALUES (110, '341100', '滁州市', '340000');
INSERT INTO `x2_city` VALUES (111, '341200', '阜阳市', '340000');
INSERT INTO `x2_city` VALUES (112, '341300', '宿州市', '340000');
INSERT INTO `x2_city` VALUES (113, '341400', '巢湖市', '340000');
INSERT INTO `x2_city` VALUES (114, '341500', '六安市', '340000');
INSERT INTO `x2_city` VALUES (115, '341600', '亳州市', '340000');
INSERT INTO `x2_city` VALUES (116, '341700', '池州市', '340000');
INSERT INTO `x2_city` VALUES (117, '341800', '宣城市', '340000');
INSERT INTO `x2_city` VALUES (118, '350100', '福州市', '350000');
INSERT INTO `x2_city` VALUES (119, '350200', '厦门市', '350000');
INSERT INTO `x2_city` VALUES (120, '350300', '莆田市', '350000');
INSERT INTO `x2_city` VALUES (121, '350400', '三明市', '350000');
INSERT INTO `x2_city` VALUES (122, '350500', '泉州市', '350000');
INSERT INTO `x2_city` VALUES (123, '350600', '漳州市', '350000');
INSERT INTO `x2_city` VALUES (124, '350700', '南平市', '350000');
INSERT INTO `x2_city` VALUES (125, '350800', '龙岩市', '350000');
INSERT INTO `x2_city` VALUES (126, '350900', '宁德市', '350000');
INSERT INTO `x2_city` VALUES (127, '360100', '南昌市', '360000');
INSERT INTO `x2_city` VALUES (128, '360200', '景德镇市', '360000');
INSERT INTO `x2_city` VALUES (129, '360300', '萍乡市', '360000');
INSERT INTO `x2_city` VALUES (130, '360400', '九江市', '360000');
INSERT INTO `x2_city` VALUES (131, '360500', '新余市', '360000');
INSERT INTO `x2_city` VALUES (132, '360600', '鹰潭市', '360000');
INSERT INTO `x2_city` VALUES (133, '360700', '赣州市', '360000');
INSERT INTO `x2_city` VALUES (134, '360800', '吉安市', '360000');
INSERT INTO `x2_city` VALUES (135, '360900', '宜春市', '360000');
INSERT INTO `x2_city` VALUES (136, '361000', '抚州市', '360000');
INSERT INTO `x2_city` VALUES (137, '361100', '上饶市', '360000');
INSERT INTO `x2_city` VALUES (138, '370100', '济南市', '370000');
INSERT INTO `x2_city` VALUES (139, '370200', '青岛市', '370000');
INSERT INTO `x2_city` VALUES (140, '370300', '淄博市', '370000');
INSERT INTO `x2_city` VALUES (141, '370400', '枣庄市', '370000');
INSERT INTO `x2_city` VALUES (142, '370500', '东营市', '370000');
INSERT INTO `x2_city` VALUES (143, '370600', '烟台市', '370000');
INSERT INTO `x2_city` VALUES (144, '370700', '潍坊市', '370000');
INSERT INTO `x2_city` VALUES (145, '370800', '济宁市', '370000');
INSERT INTO `x2_city` VALUES (146, '370900', '泰安市', '370000');
INSERT INTO `x2_city` VALUES (147, '371000', '威海市', '370000');
INSERT INTO `x2_city` VALUES (148, '371100', '日照市', '370000');
INSERT INTO `x2_city` VALUES (149, '371200', '莱芜市', '370000');
INSERT INTO `x2_city` VALUES (150, '371300', '临沂市', '370000');
INSERT INTO `x2_city` VALUES (151, '371400', '德州市', '370000');
INSERT INTO `x2_city` VALUES (152, '371500', '聊城市', '370000');
INSERT INTO `x2_city` VALUES (153, '371600', '滨州市', '370000');
INSERT INTO `x2_city` VALUES (154, '371700', '荷泽市', '370000');
INSERT INTO `x2_city` VALUES (155, '410100', '郑州市', '410000');
INSERT INTO `x2_city` VALUES (156, '410200', '开封市', '410000');
INSERT INTO `x2_city` VALUES (157, '410300', '洛阳市', '410000');
INSERT INTO `x2_city` VALUES (158, '410400', '平顶山市', '410000');
INSERT INTO `x2_city` VALUES (159, '410500', '安阳市', '410000');
INSERT INTO `x2_city` VALUES (160, '410600', '鹤壁市', '410000');
INSERT INTO `x2_city` VALUES (161, '410700', '新乡市', '410000');
INSERT INTO `x2_city` VALUES (162, '410800', '焦作市', '410000');
INSERT INTO `x2_city` VALUES (163, '410900', '濮阳市', '410000');
INSERT INTO `x2_city` VALUES (164, '411000', '许昌市', '410000');
INSERT INTO `x2_city` VALUES (165, '411100', '漯河市', '410000');
INSERT INTO `x2_city` VALUES (166, '411200', '三门峡市', '410000');
INSERT INTO `x2_city` VALUES (167, '411300', '南阳市', '410000');
INSERT INTO `x2_city` VALUES (168, '411400', '商丘市', '410000');
INSERT INTO `x2_city` VALUES (169, '411500', '信阳市', '410000');
INSERT INTO `x2_city` VALUES (170, '411600', '周口市', '410000');
INSERT INTO `x2_city` VALUES (171, '411700', '驻马店市', '410000');
INSERT INTO `x2_city` VALUES (172, '420100', '武汉市', '420000');
INSERT INTO `x2_city` VALUES (173, '420200', '黄石市', '420000');
INSERT INTO `x2_city` VALUES (174, '420300', '十堰市', '420000');
INSERT INTO `x2_city` VALUES (175, '420500', '宜昌市', '420000');
INSERT INTO `x2_city` VALUES (176, '420600', '襄樊市', '420000');
INSERT INTO `x2_city` VALUES (177, '420700', '鄂州市', '420000');
INSERT INTO `x2_city` VALUES (178, '420800', '荆门市', '420000');
INSERT INTO `x2_city` VALUES (179, '420900', '孝感市', '420000');
INSERT INTO `x2_city` VALUES (180, '421000', '荆州市', '420000');
INSERT INTO `x2_city` VALUES (181, '421100', '黄冈市', '420000');
INSERT INTO `x2_city` VALUES (182, '421200', '咸宁市', '420000');
INSERT INTO `x2_city` VALUES (183, '421300', '随州市', '420000');
INSERT INTO `x2_city` VALUES (184, '422800', '恩施土家族苗族自治州', '420000');
INSERT INTO `x2_city` VALUES (185, '429000', '省直辖行政单位', '420000');
INSERT INTO `x2_city` VALUES (186, '430100', '长沙市', '430000');
INSERT INTO `x2_city` VALUES (187, '430200', '株洲市', '430000');
INSERT INTO `x2_city` VALUES (188, '430300', '湘潭市', '430000');
INSERT INTO `x2_city` VALUES (189, '430400', '衡阳市', '430000');
INSERT INTO `x2_city` VALUES (190, '430500', '邵阳市', '430000');
INSERT INTO `x2_city` VALUES (191, '430600', '岳阳市', '430000');
INSERT INTO `x2_city` VALUES (192, '430700', '常德市', '430000');
INSERT INTO `x2_city` VALUES (193, '430800', '张家界市', '430000');
INSERT INTO `x2_city` VALUES (194, '430900', '益阳市', '430000');
INSERT INTO `x2_city` VALUES (195, '431000', '郴州市', '430000');
INSERT INTO `x2_city` VALUES (196, '431100', '永州市', '430000');
INSERT INTO `x2_city` VALUES (197, '431200', '怀化市', '430000');
INSERT INTO `x2_city` VALUES (198, '431300', '娄底市', '430000');
INSERT INTO `x2_city` VALUES (199, '433100', '湘西土家族苗族自治州', '430000');
INSERT INTO `x2_city` VALUES (200, '440100', '广州市', '440000');
INSERT INTO `x2_city` VALUES (201, '440200', '韶关市', '440000');
INSERT INTO `x2_city` VALUES (202, '440300', '深圳市', '440000');
INSERT INTO `x2_city` VALUES (203, '440400', '珠海市', '440000');
INSERT INTO `x2_city` VALUES (204, '440500', '汕头市', '440000');
INSERT INTO `x2_city` VALUES (205, '440600', '佛山市', '440000');
INSERT INTO `x2_city` VALUES (206, '440700', '江门市', '440000');
INSERT INTO `x2_city` VALUES (207, '440800', '湛江市', '440000');
INSERT INTO `x2_city` VALUES (208, '440900', '茂名市', '440000');
INSERT INTO `x2_city` VALUES (209, '441200', '肇庆市', '440000');
INSERT INTO `x2_city` VALUES (210, '441300', '惠州市', '440000');
INSERT INTO `x2_city` VALUES (211, '441400', '梅州市', '440000');
INSERT INTO `x2_city` VALUES (212, '441500', '汕尾市', '440000');
INSERT INTO `x2_city` VALUES (213, '441600', '河源市', '440000');
INSERT INTO `x2_city` VALUES (214, '441700', '阳江市', '440000');
INSERT INTO `x2_city` VALUES (215, '441800', '清远市', '440000');
INSERT INTO `x2_city` VALUES (216, '441900', '东莞市', '440000');
INSERT INTO `x2_city` VALUES (217, '442000', '中山市', '440000');
INSERT INTO `x2_city` VALUES (218, '445100', '潮州市', '440000');
INSERT INTO `x2_city` VALUES (219, '445200', '揭阳市', '440000');
INSERT INTO `x2_city` VALUES (220, '445300', '云浮市', '440000');
INSERT INTO `x2_city` VALUES (221, '450100', '南宁市', '450000');
INSERT INTO `x2_city` VALUES (222, '450200', '柳州市', '450000');
INSERT INTO `x2_city` VALUES (223, '450300', '桂林市', '450000');
INSERT INTO `x2_city` VALUES (224, '450400', '梧州市', '450000');
INSERT INTO `x2_city` VALUES (225, '450500', '北海市', '450000');
INSERT INTO `x2_city` VALUES (226, '450600', '防城港市', '450000');
INSERT INTO `x2_city` VALUES (227, '450700', '钦州市', '450000');
INSERT INTO `x2_city` VALUES (228, '450800', '贵港市', '450000');
INSERT INTO `x2_city` VALUES (229, '450900', '玉林市', '450000');
INSERT INTO `x2_city` VALUES (230, '451000', '百色市', '450000');
INSERT INTO `x2_city` VALUES (231, '451100', '贺州市', '450000');
INSERT INTO `x2_city` VALUES (232, '451200', '河池市', '450000');
INSERT INTO `x2_city` VALUES (233, '451300', '来宾市', '450000');
INSERT INTO `x2_city` VALUES (234, '451400', '崇左市', '450000');
INSERT INTO `x2_city` VALUES (235, '460100', '海口市', '460000');
INSERT INTO `x2_city` VALUES (236, '460200', '三亚市', '460000');
INSERT INTO `x2_city` VALUES (237, '469000', '省直辖县级行政单位', '460000');
INSERT INTO `x2_city` VALUES (238, '500100', '重庆市', '500000');
INSERT INTO `x2_city` VALUES (241, '510100', '成都市', '510000');
INSERT INTO `x2_city` VALUES (242, '510300', '自贡市', '510000');
INSERT INTO `x2_city` VALUES (243, '510400', '攀枝花市', '510000');
INSERT INTO `x2_city` VALUES (244, '510500', '泸州市', '510000');
INSERT INTO `x2_city` VALUES (245, '510600', '德阳市', '510000');
INSERT INTO `x2_city` VALUES (246, '510700', '绵阳市', '510000');
INSERT INTO `x2_city` VALUES (247, '510800', '广元市', '510000');
INSERT INTO `x2_city` VALUES (248, '510900', '遂宁市', '510000');
INSERT INTO `x2_city` VALUES (249, '511000', '内江市', '510000');
INSERT INTO `x2_city` VALUES (250, '511100', '乐山市', '510000');
INSERT INTO `x2_city` VALUES (251, '511300', '南充市', '510000');
INSERT INTO `x2_city` VALUES (252, '511400', '眉山市', '510000');
INSERT INTO `x2_city` VALUES (253, '511500', '宜宾市', '510000');
INSERT INTO `x2_city` VALUES (254, '511600', '广安市', '510000');
INSERT INTO `x2_city` VALUES (255, '511700', '达州市', '510000');
INSERT INTO `x2_city` VALUES (256, '511800', '雅安市', '510000');
INSERT INTO `x2_city` VALUES (257, '511900', '巴中市', '510000');
INSERT INTO `x2_city` VALUES (258, '512000', '资阳市', '510000');
INSERT INTO `x2_city` VALUES (259, '513200', '阿坝藏族羌族自治州', '510000');
INSERT INTO `x2_city` VALUES (260, '513300', '甘孜藏族自治州', '510000');
INSERT INTO `x2_city` VALUES (261, '513400', '凉山彝族自治州', '510000');
INSERT INTO `x2_city` VALUES (262, '520100', '贵阳市', '520000');
INSERT INTO `x2_city` VALUES (263, '520200', '六盘水市', '520000');
INSERT INTO `x2_city` VALUES (264, '520300', '遵义市', '520000');
INSERT INTO `x2_city` VALUES (265, '520400', '安顺市', '520000');
INSERT INTO `x2_city` VALUES (266, '522200', '铜仁地区', '520000');
INSERT INTO `x2_city` VALUES (267, '522300', '黔西南布依族苗族自治州', '520000');
INSERT INTO `x2_city` VALUES (268, '522400', '毕节地区', '520000');
INSERT INTO `x2_city` VALUES (269, '522600', '黔东南苗族侗族自治州', '520000');
INSERT INTO `x2_city` VALUES (270, '522700', '黔南布依族苗族自治州', '520000');
INSERT INTO `x2_city` VALUES (271, '530100', '昆明市', '530000');
INSERT INTO `x2_city` VALUES (272, '530300', '曲靖市', '530000');
INSERT INTO `x2_city` VALUES (273, '530400', '玉溪市', '530000');
INSERT INTO `x2_city` VALUES (274, '530500', '保山市', '530000');
INSERT INTO `x2_city` VALUES (275, '530600', '昭通市', '530000');
INSERT INTO `x2_city` VALUES (276, '530700', '丽江市', '530000');
INSERT INTO `x2_city` VALUES (277, '530800', '思茅市', '530000');
INSERT INTO `x2_city` VALUES (278, '530900', '临沧市', '530000');
INSERT INTO `x2_city` VALUES (279, '532300', '楚雄彝族自治州', '530000');
INSERT INTO `x2_city` VALUES (280, '532500', '红河哈尼族彝族自治州', '530000');
INSERT INTO `x2_city` VALUES (281, '532600', '文山壮族苗族自治州', '530000');
INSERT INTO `x2_city` VALUES (282, '532800', '西双版纳傣族自治州', '530000');
INSERT INTO `x2_city` VALUES (283, '532900', '大理白族自治州', '530000');
INSERT INTO `x2_city` VALUES (284, '533100', '德宏傣族景颇族自治州', '530000');
INSERT INTO `x2_city` VALUES (285, '533300', '怒江傈僳族自治州', '530000');
INSERT INTO `x2_city` VALUES (286, '533400', '迪庆藏族自治州', '530000');
INSERT INTO `x2_city` VALUES (287, '540100', '拉萨市', '540000');
INSERT INTO `x2_city` VALUES (288, '542100', '昌都地区', '540000');
INSERT INTO `x2_city` VALUES (289, '542200', '山南地区', '540000');
INSERT INTO `x2_city` VALUES (290, '542300', '日喀则地区', '540000');
INSERT INTO `x2_city` VALUES (291, '542400', '那曲地区', '540000');
INSERT INTO `x2_city` VALUES (292, '542500', '阿里地区', '540000');
INSERT INTO `x2_city` VALUES (293, '542600', '林芝地区', '540000');
INSERT INTO `x2_city` VALUES (294, '610100', '西安市', '610000');
INSERT INTO `x2_city` VALUES (295, '610200', '铜川市', '610000');
INSERT INTO `x2_city` VALUES (296, '610300', '宝鸡市', '610000');
INSERT INTO `x2_city` VALUES (297, '610400', '咸阳市', '610000');
INSERT INTO `x2_city` VALUES (298, '610500', '渭南市', '610000');
INSERT INTO `x2_city` VALUES (299, '610600', '延安市', '610000');
INSERT INTO `x2_city` VALUES (300, '610700', '汉中市', '610000');
INSERT INTO `x2_city` VALUES (301, '610800', '榆林市', '610000');
INSERT INTO `x2_city` VALUES (302, '610900', '安康市', '610000');
INSERT INTO `x2_city` VALUES (303, '611000', '商洛市', '610000');
INSERT INTO `x2_city` VALUES (304, '620100', '兰州市', '620000');
INSERT INTO `x2_city` VALUES (305, '620200', '嘉峪关市', '620000');
INSERT INTO `x2_city` VALUES (306, '620300', '金昌市', '620000');
INSERT INTO `x2_city` VALUES (307, '620400', '白银市', '620000');
INSERT INTO `x2_city` VALUES (308, '620500', '天水市', '620000');
INSERT INTO `x2_city` VALUES (309, '620600', '武威市', '620000');
INSERT INTO `x2_city` VALUES (310, '620700', '张掖市', '620000');
INSERT INTO `x2_city` VALUES (311, '620800', '平凉市', '620000');
INSERT INTO `x2_city` VALUES (312, '620900', '酒泉市', '620000');
INSERT INTO `x2_city` VALUES (313, '621000', '庆阳市', '620000');
INSERT INTO `x2_city` VALUES (314, '621100', '定西市', '620000');
INSERT INTO `x2_city` VALUES (315, '621200', '陇南市', '620000');
INSERT INTO `x2_city` VALUES (316, '622900', '临夏回族自治州', '620000');
INSERT INTO `x2_city` VALUES (317, '623000', '甘南藏族自治州', '620000');
INSERT INTO `x2_city` VALUES (318, '630100', '西宁市', '630000');
INSERT INTO `x2_city` VALUES (319, '632100', '海东地区', '630000');
INSERT INTO `x2_city` VALUES (320, '632200', '海北藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (321, '632300', '黄南藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (322, '632500', '海南藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (323, '632600', '果洛藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (324, '632700', '玉树藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (325, '632800', '海西蒙古族藏族自治州', '630000');
INSERT INTO `x2_city` VALUES (326, '640100', '银川市', '640000');
INSERT INTO `x2_city` VALUES (327, '640200', '石嘴山市', '640000');
INSERT INTO `x2_city` VALUES (328, '640300', '吴忠市', '640000');
INSERT INTO `x2_city` VALUES (329, '640400', '固原市', '640000');
INSERT INTO `x2_city` VALUES (330, '640500', '中卫市', '640000');
INSERT INTO `x2_city` VALUES (331, '650100', '乌鲁木齐市', '650000');
INSERT INTO `x2_city` VALUES (332, '650200', '克拉玛依市', '650000');
INSERT INTO `x2_city` VALUES (333, '652100', '吐鲁番地区', '650000');
INSERT INTO `x2_city` VALUES (334, '652200', '哈密地区', '650000');
INSERT INTO `x2_city` VALUES (335, '652300', '昌吉回族自治州', '650000');
INSERT INTO `x2_city` VALUES (336, '652700', '博尔塔拉蒙古自治州', '650000');
INSERT INTO `x2_city` VALUES (337, '652800', '巴音郭楞蒙古自治州', '650000');
INSERT INTO `x2_city` VALUES (338, '652900', '阿克苏地区', '650000');
INSERT INTO `x2_city` VALUES (339, '653000', '克孜勒苏柯尔克孜自治州', '650000');
INSERT INTO `x2_city` VALUES (340, '653100', '喀什地区', '650000');
INSERT INTO `x2_city` VALUES (341, '653200', '和田地区', '650000');
INSERT INTO `x2_city` VALUES (342, '654000', '伊犁哈萨克自治州', '650000');
INSERT INTO `x2_city` VALUES (343, '654200', '塔城地区', '650000');
INSERT INTO `x2_city` VALUES (344, '654300', '阿勒泰地区', '650000');
INSERT INTO `x2_city` VALUES (345, '659000', '省直辖行政单位', '650000');
INSERT INTO `x2_city` VALUES (346, '710100', '台北市', '710000');
INSERT INTO `x2_city` VALUES (347, '710200', '高雄市', '710000');
INSERT INTO `x2_city` VALUES (348, '710300', '基隆市', '710000');
INSERT INTO `x2_city` VALUES (349, '710400', '台中市', '710000');
INSERT INTO `x2_city` VALUES (350, '710500', '台南市', '710000');
INSERT INTO `x2_city` VALUES (351, '710600', '新竹市', '710000');
INSERT INTO `x2_city` VALUES (352, '710700', '嘉义市', '710000');
INSERT INTO `x2_city` VALUES (353, '710800', '台北县', '710000');
INSERT INTO `x2_city` VALUES (354, '710900', '宜兰县', '710000');
INSERT INTO `x2_city` VALUES (355, '711000', '新竹县', '710000');
INSERT INTO `x2_city` VALUES (356, '711100', '桃园县', '710000');
INSERT INTO `x2_city` VALUES (357, '711200', '苗栗县', '710000');
INSERT INTO `x2_city` VALUES (358, '711300', '台中县', '710000');
INSERT INTO `x2_city` VALUES (359, '711400', '彰化县', '710000');
INSERT INTO `x2_city` VALUES (360, '711500', '南投县', '710000');
INSERT INTO `x2_city` VALUES (361, '711600', '嘉义县', '710000');
INSERT INTO `x2_city` VALUES (362, '711700', '云林县', '710000');
INSERT INTO `x2_city` VALUES (363, '711800', '台南县', '710000');
INSERT INTO `x2_city` VALUES (364, '711900', '高雄县', '710000');
INSERT INTO `x2_city` VALUES (365, '712000', '屏东县', '710000');
INSERT INTO `x2_city` VALUES (366, '712100', '台东县', '710000');
INSERT INTO `x2_city` VALUES (367, '712200', '花莲县', '710000');
INSERT INTO `x2_city` VALUES (368, '712300', '澎湖县', '710000');
INSERT INTO `x2_city` VALUES (369, '810100', '香港特别行政区', '810000');
INSERT INTO `x2_city` VALUES (370, '820100', '澳门特别行政区', '820000');

-- ----------------------------
-- Table structure for x2_cityarea
-- ----------------------------
DROP TABLE IF EXISTS `x2_cityarea`;
CREATE TABLE `x2_cityarea`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `areaid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `area` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `father` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `areaid`(`areaid`) USING BTREE,
  INDEX `father`(`father`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 820103 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_cityarea
-- ----------------------------
INSERT INTO `x2_cityarea` VALUES (110101, '110101', '东城区', '110100');
INSERT INTO `x2_cityarea` VALUES (110102, '110102', '西城区', '110100');
INSERT INTO `x2_cityarea` VALUES (110103, '110103', '崇文区', '110100');
INSERT INTO `x2_cityarea` VALUES (110104, '110104', '宣武区', '110100');
INSERT INTO `x2_cityarea` VALUES (110105, '110105', '朝阳区', '110100');
INSERT INTO `x2_cityarea` VALUES (110106, '110106', '丰台区', '110100');
INSERT INTO `x2_cityarea` VALUES (110107, '110107', '石景山区', '110100');
INSERT INTO `x2_cityarea` VALUES (110108, '110108', '海淀区', '110100');
INSERT INTO `x2_cityarea` VALUES (110109, '110109', '门头沟区', '110100');
INSERT INTO `x2_cityarea` VALUES (110111, '110111', '房山区', '110100');
INSERT INTO `x2_cityarea` VALUES (110112, '110112', '通州区', '110100');
INSERT INTO `x2_cityarea` VALUES (110113, '110113', '顺义区', '110100');
INSERT INTO `x2_cityarea` VALUES (110114, '110114', '昌平区', '110100');
INSERT INTO `x2_cityarea` VALUES (110115, '110115', '大兴区', '110100');
INSERT INTO `x2_cityarea` VALUES (110116, '110116', '怀柔区', '110100');
INSERT INTO `x2_cityarea` VALUES (110117, '110117', '平谷区', '110100');
INSERT INTO `x2_cityarea` VALUES (110228, '110228', '密云县', '110200');
INSERT INTO `x2_cityarea` VALUES (110229, '110229', '延庆县', '110200');
INSERT INTO `x2_cityarea` VALUES (120101, '120101', '和平区', '120100');
INSERT INTO `x2_cityarea` VALUES (120102, '120102', '河东区', '120100');
INSERT INTO `x2_cityarea` VALUES (120103, '120103', '河西区', '120100');
INSERT INTO `x2_cityarea` VALUES (120104, '120104', '南开区', '120100');
INSERT INTO `x2_cityarea` VALUES (120105, '120105', '河北区', '120100');
INSERT INTO `x2_cityarea` VALUES (120106, '120106', '红桥区', '120100');
INSERT INTO `x2_cityarea` VALUES (120107, '120107', '塘沽区', '120100');
INSERT INTO `x2_cityarea` VALUES (120108, '120108', '汉沽区', '120100');
INSERT INTO `x2_cityarea` VALUES (120109, '120109', '大港区', '120100');
INSERT INTO `x2_cityarea` VALUES (120110, '120110', '东丽区', '120100');
INSERT INTO `x2_cityarea` VALUES (120111, '120111', '西青区', '120100');
INSERT INTO `x2_cityarea` VALUES (120112, '120112', '津南区', '120100');
INSERT INTO `x2_cityarea` VALUES (120113, '120113', '北辰区', '120100');
INSERT INTO `x2_cityarea` VALUES (120114, '120114', '武清区', '120100');
INSERT INTO `x2_cityarea` VALUES (120115, '120115', '宝坻区', '120100');
INSERT INTO `x2_cityarea` VALUES (120221, '120221', '宁河县', '120200');
INSERT INTO `x2_cityarea` VALUES (120223, '120223', '静海县', '120200');
INSERT INTO `x2_cityarea` VALUES (120225, '120225', '蓟　县', '120200');
INSERT INTO `x2_cityarea` VALUES (130101, '130101', '市辖区', '130100');
INSERT INTO `x2_cityarea` VALUES (130102, '130102', '长安区', '130100');
INSERT INTO `x2_cityarea` VALUES (130103, '130103', '桥东区', '130100');
INSERT INTO `x2_cityarea` VALUES (130104, '130104', '桥西区', '130100');
INSERT INTO `x2_cityarea` VALUES (130105, '130105', '新华区', '130100');
INSERT INTO `x2_cityarea` VALUES (130107, '130107', '井陉矿区', '130100');
INSERT INTO `x2_cityarea` VALUES (130108, '130108', '裕华区', '130100');
INSERT INTO `x2_cityarea` VALUES (130121, '130121', '井陉县', '130100');
INSERT INTO `x2_cityarea` VALUES (130123, '130123', '正定县', '130100');
INSERT INTO `x2_cityarea` VALUES (130124, '130124', '栾城县', '130100');
INSERT INTO `x2_cityarea` VALUES (130125, '130125', '行唐县', '130100');
INSERT INTO `x2_cityarea` VALUES (130126, '130126', '灵寿县', '130100');
INSERT INTO `x2_cityarea` VALUES (130127, '130127', '高邑县', '130100');
INSERT INTO `x2_cityarea` VALUES (130128, '130128', '深泽县', '130100');
INSERT INTO `x2_cityarea` VALUES (130129, '130129', '赞皇县', '130100');
INSERT INTO `x2_cityarea` VALUES (130130, '130130', '无极县', '130100');
INSERT INTO `x2_cityarea` VALUES (130131, '130131', '平山县', '130100');
INSERT INTO `x2_cityarea` VALUES (130132, '130132', '元氏县', '130100');
INSERT INTO `x2_cityarea` VALUES (130133, '130133', '赵　县', '130100');
INSERT INTO `x2_cityarea` VALUES (130181, '130181', '辛集市', '130100');
INSERT INTO `x2_cityarea` VALUES (130182, '130182', '藁城市', '130100');
INSERT INTO `x2_cityarea` VALUES (130183, '130183', '晋州市', '130100');
INSERT INTO `x2_cityarea` VALUES (130184, '130184', '新乐市', '130100');
INSERT INTO `x2_cityarea` VALUES (130185, '130185', '鹿泉市', '130100');
INSERT INTO `x2_cityarea` VALUES (130201, '130201', '市辖区', '130200');
INSERT INTO `x2_cityarea` VALUES (130202, '130202', '路南区', '130200');
INSERT INTO `x2_cityarea` VALUES (130203, '130203', '路北区', '130200');
INSERT INTO `x2_cityarea` VALUES (130204, '130204', '古冶区', '130200');
INSERT INTO `x2_cityarea` VALUES (130205, '130205', '开平区', '130200');
INSERT INTO `x2_cityarea` VALUES (130207, '130207', '丰南区', '130200');
INSERT INTO `x2_cityarea` VALUES (130208, '130208', '丰润区', '130200');
INSERT INTO `x2_cityarea` VALUES (130223, '130223', '滦　县', '130200');
INSERT INTO `x2_cityarea` VALUES (130224, '130224', '滦南县', '130200');
INSERT INTO `x2_cityarea` VALUES (130225, '130225', '乐亭县', '130200');
INSERT INTO `x2_cityarea` VALUES (130227, '130227', '迁西县', '130200');
INSERT INTO `x2_cityarea` VALUES (130229, '130229', '玉田县', '130200');
INSERT INTO `x2_cityarea` VALUES (130230, '130230', '唐海县', '130200');
INSERT INTO `x2_cityarea` VALUES (130281, '130281', '遵化市', '130200');
INSERT INTO `x2_cityarea` VALUES (130283, '130283', '迁安市', '130200');
INSERT INTO `x2_cityarea` VALUES (130301, '130301', '市辖区', '130300');
INSERT INTO `x2_cityarea` VALUES (130302, '130302', '海港区', '130300');
INSERT INTO `x2_cityarea` VALUES (130303, '130303', '山海关区', '130300');
INSERT INTO `x2_cityarea` VALUES (130304, '130304', '北戴河区', '130300');
INSERT INTO `x2_cityarea` VALUES (130321, '130321', '青龙满族自治县', '130300');
INSERT INTO `x2_cityarea` VALUES (130322, '130322', '昌黎县', '130300');
INSERT INTO `x2_cityarea` VALUES (130323, '130323', '抚宁县', '130300');
INSERT INTO `x2_cityarea` VALUES (130324, '130324', '卢龙县', '130300');
INSERT INTO `x2_cityarea` VALUES (130401, '130401', '市辖区', '130400');
INSERT INTO `x2_cityarea` VALUES (130402, '130402', '邯山区', '130400');
INSERT INTO `x2_cityarea` VALUES (130403, '130403', '丛台区', '130400');
INSERT INTO `x2_cityarea` VALUES (130404, '130404', '复兴区', '130400');
INSERT INTO `x2_cityarea` VALUES (130406, '130406', '峰峰矿区', '130400');
INSERT INTO `x2_cityarea` VALUES (130421, '130421', '邯郸县', '130400');
INSERT INTO `x2_cityarea` VALUES (130423, '130423', '临漳县', '130400');
INSERT INTO `x2_cityarea` VALUES (130424, '130424', '成安县', '130400');
INSERT INTO `x2_cityarea` VALUES (130425, '130425', '大名县', '130400');
INSERT INTO `x2_cityarea` VALUES (130426, '130426', '涉　县', '130400');
INSERT INTO `x2_cityarea` VALUES (130427, '130427', '磁　县', '130400');
INSERT INTO `x2_cityarea` VALUES (130428, '130428', '肥乡县', '130400');
INSERT INTO `x2_cityarea` VALUES (130429, '130429', '永年县', '130400');
INSERT INTO `x2_cityarea` VALUES (130430, '130430', '邱　县', '130400');
INSERT INTO `x2_cityarea` VALUES (130431, '130431', '鸡泽县', '130400');
INSERT INTO `x2_cityarea` VALUES (130432, '130432', '广平县', '130400');
INSERT INTO `x2_cityarea` VALUES (130433, '130433', '馆陶县', '130400');
INSERT INTO `x2_cityarea` VALUES (130434, '130434', '魏　县', '130400');
INSERT INTO `x2_cityarea` VALUES (130435, '130435', '曲周县', '130400');
INSERT INTO `x2_cityarea` VALUES (130481, '130481', '武安市', '130400');
INSERT INTO `x2_cityarea` VALUES (130501, '130501', '市辖区', '130500');
INSERT INTO `x2_cityarea` VALUES (130502, '130502', '桥东区', '130500');
INSERT INTO `x2_cityarea` VALUES (130503, '130503', '桥西区', '130500');
INSERT INTO `x2_cityarea` VALUES (130521, '130521', '邢台县', '130500');
INSERT INTO `x2_cityarea` VALUES (130522, '130522', '临城县', '130500');
INSERT INTO `x2_cityarea` VALUES (130523, '130523', '内邱县', '130500');
INSERT INTO `x2_cityarea` VALUES (130524, '130524', '柏乡县', '130500');
INSERT INTO `x2_cityarea` VALUES (130525, '130525', '隆尧县', '130500');
INSERT INTO `x2_cityarea` VALUES (130526, '130526', '任　县', '130500');
INSERT INTO `x2_cityarea` VALUES (130527, '130527', '南和县', '130500');
INSERT INTO `x2_cityarea` VALUES (130528, '130528', '宁晋县', '130500');
INSERT INTO `x2_cityarea` VALUES (130529, '130529', '巨鹿县', '130500');
INSERT INTO `x2_cityarea` VALUES (130530, '130530', '新河县', '130500');
INSERT INTO `x2_cityarea` VALUES (130531, '130531', '广宗县', '130500');
INSERT INTO `x2_cityarea` VALUES (130532, '130532', '平乡县', '130500');
INSERT INTO `x2_cityarea` VALUES (130533, '130533', '威　县', '130500');
INSERT INTO `x2_cityarea` VALUES (130534, '130534', '清河县', '130500');
INSERT INTO `x2_cityarea` VALUES (130535, '130535', '临西县', '130500');
INSERT INTO `x2_cityarea` VALUES (130581, '130581', '南宫市', '130500');
INSERT INTO `x2_cityarea` VALUES (130582, '130582', '沙河市', '130500');
INSERT INTO `x2_cityarea` VALUES (130601, '130601', '市辖区', '130600');
INSERT INTO `x2_cityarea` VALUES (130602, '130602', '新市区', '130600');
INSERT INTO `x2_cityarea` VALUES (130603, '130603', '北市区', '130600');
INSERT INTO `x2_cityarea` VALUES (130604, '130604', '南市区', '130600');
INSERT INTO `x2_cityarea` VALUES (130621, '130621', '满城县', '130600');
INSERT INTO `x2_cityarea` VALUES (130622, '130622', '清苑县', '130600');
INSERT INTO `x2_cityarea` VALUES (130623, '130623', '涞水县', '130600');
INSERT INTO `x2_cityarea` VALUES (130624, '130624', '阜平县', '130600');
INSERT INTO `x2_cityarea` VALUES (130625, '130625', '徐水县', '130600');
INSERT INTO `x2_cityarea` VALUES (130626, '130626', '定兴县', '130600');
INSERT INTO `x2_cityarea` VALUES (130627, '130627', '唐　县', '130600');
INSERT INTO `x2_cityarea` VALUES (130628, '130628', '高阳县', '130600');
INSERT INTO `x2_cityarea` VALUES (130629, '130629', '容城县', '130600');
INSERT INTO `x2_cityarea` VALUES (130630, '130630', '涞源县', '130600');
INSERT INTO `x2_cityarea` VALUES (130631, '130631', '望都县', '130600');
INSERT INTO `x2_cityarea` VALUES (130632, '130632', '安新县', '130600');
INSERT INTO `x2_cityarea` VALUES (130633, '130633', '易　县', '130600');
INSERT INTO `x2_cityarea` VALUES (130634, '130634', '曲阳县', '130600');
INSERT INTO `x2_cityarea` VALUES (130635, '130635', '蠡　县', '130600');
INSERT INTO `x2_cityarea` VALUES (130636, '130636', '顺平县', '130600');
INSERT INTO `x2_cityarea` VALUES (130637, '130637', '博野县', '130600');
INSERT INTO `x2_cityarea` VALUES (130638, '130638', '雄　县', '130600');
INSERT INTO `x2_cityarea` VALUES (130681, '130681', '涿州市', '130600');
INSERT INTO `x2_cityarea` VALUES (130682, '130682', '定州市', '130600');
INSERT INTO `x2_cityarea` VALUES (130683, '130683', '安国市', '130600');
INSERT INTO `x2_cityarea` VALUES (130684, '130684', '高碑店市', '130600');
INSERT INTO `x2_cityarea` VALUES (130701, '130701', '市辖区', '130700');
INSERT INTO `x2_cityarea` VALUES (130702, '130702', '桥东区', '130700');
INSERT INTO `x2_cityarea` VALUES (130703, '130703', '桥西区', '130700');
INSERT INTO `x2_cityarea` VALUES (130705, '130705', '宣化区', '130700');
INSERT INTO `x2_cityarea` VALUES (130706, '130706', '下花园区', '130700');
INSERT INTO `x2_cityarea` VALUES (130721, '130721', '宣化县', '130700');
INSERT INTO `x2_cityarea` VALUES (130722, '130722', '张北县', '130700');
INSERT INTO `x2_cityarea` VALUES (130723, '130723', '康保县', '130700');
INSERT INTO `x2_cityarea` VALUES (130724, '130724', '沽源县', '130700');
INSERT INTO `x2_cityarea` VALUES (130725, '130725', '尚义县', '130700');
INSERT INTO `x2_cityarea` VALUES (130726, '130726', '蔚　县', '130700');
INSERT INTO `x2_cityarea` VALUES (130727, '130727', '阳原县', '130700');
INSERT INTO `x2_cityarea` VALUES (130728, '130728', '怀安县', '130700');
INSERT INTO `x2_cityarea` VALUES (130729, '130729', '万全县', '130700');
INSERT INTO `x2_cityarea` VALUES (130730, '130730', '怀来县', '130700');
INSERT INTO `x2_cityarea` VALUES (130731, '130731', '涿鹿县', '130700');
INSERT INTO `x2_cityarea` VALUES (130732, '130732', '赤城县', '130700');
INSERT INTO `x2_cityarea` VALUES (130733, '130733', '崇礼县', '130700');
INSERT INTO `x2_cityarea` VALUES (130801, '130801', '市辖区', '130800');
INSERT INTO `x2_cityarea` VALUES (130802, '130802', '双桥区', '130800');
INSERT INTO `x2_cityarea` VALUES (130803, '130803', '双滦区', '130800');
INSERT INTO `x2_cityarea` VALUES (130804, '130804', '鹰手营子矿区', '130800');
INSERT INTO `x2_cityarea` VALUES (130821, '130821', '承德县', '130800');
INSERT INTO `x2_cityarea` VALUES (130822, '130822', '兴隆县', '130800');
INSERT INTO `x2_cityarea` VALUES (130823, '130823', '平泉县', '130800');
INSERT INTO `x2_cityarea` VALUES (130824, '130824', '滦平县', '130800');
INSERT INTO `x2_cityarea` VALUES (130825, '130825', '隆化县', '130800');
INSERT INTO `x2_cityarea` VALUES (130826, '130826', '丰宁满族自治县', '130800');
INSERT INTO `x2_cityarea` VALUES (130827, '130827', '宽城满族自治县', '130800');
INSERT INTO `x2_cityarea` VALUES (130828, '130828', '围场满族蒙古族自治县', '130800');
INSERT INTO `x2_cityarea` VALUES (130901, '130901', '市辖区', '130900');
INSERT INTO `x2_cityarea` VALUES (130902, '130902', '新华区', '130900');
INSERT INTO `x2_cityarea` VALUES (130903, '130903', '运河区', '130900');
INSERT INTO `x2_cityarea` VALUES (130921, '130921', '沧　县', '130900');
INSERT INTO `x2_cityarea` VALUES (130922, '130922', '青　县', '130900');
INSERT INTO `x2_cityarea` VALUES (130923, '130923', '东光县', '130900');
INSERT INTO `x2_cityarea` VALUES (130924, '130924', '海兴县', '130900');
INSERT INTO `x2_cityarea` VALUES (130925, '130925', '盐山县', '130900');
INSERT INTO `x2_cityarea` VALUES (130926, '130926', '肃宁县', '130900');
INSERT INTO `x2_cityarea` VALUES (130927, '130927', '南皮县', '130900');
INSERT INTO `x2_cityarea` VALUES (130928, '130928', '吴桥县', '130900');
INSERT INTO `x2_cityarea` VALUES (130929, '130929', '献　县', '130900');
INSERT INTO `x2_cityarea` VALUES (130930, '130930', '孟村回族自治县', '130900');
INSERT INTO `x2_cityarea` VALUES (130981, '130981', '泊头市', '130900');
INSERT INTO `x2_cityarea` VALUES (130982, '130982', '任丘市', '130900');
INSERT INTO `x2_cityarea` VALUES (130983, '130983', '黄骅市', '130900');
INSERT INTO `x2_cityarea` VALUES (130984, '130984', '河间市', '130900');
INSERT INTO `x2_cityarea` VALUES (131001, '131001', '市辖区', '131000');
INSERT INTO `x2_cityarea` VALUES (131002, '131002', '安次区', '131000');
INSERT INTO `x2_cityarea` VALUES (131003, '131003', '广阳区', '131000');
INSERT INTO `x2_cityarea` VALUES (131022, '131022', '固安县', '131000');
INSERT INTO `x2_cityarea` VALUES (131023, '131023', '永清县', '131000');
INSERT INTO `x2_cityarea` VALUES (131024, '131024', '香河县', '131000');
INSERT INTO `x2_cityarea` VALUES (131025, '131025', '大城县', '131000');
INSERT INTO `x2_cityarea` VALUES (131026, '131026', '文安县', '131000');
INSERT INTO `x2_cityarea` VALUES (131028, '131028', '大厂回族自治县', '131000');
INSERT INTO `x2_cityarea` VALUES (131081, '131081', '霸州市', '131000');
INSERT INTO `x2_cityarea` VALUES (131082, '131082', '三河市', '131000');
INSERT INTO `x2_cityarea` VALUES (131101, '131101', '市辖区', '131100');
INSERT INTO `x2_cityarea` VALUES (131102, '131102', '桃城区', '131100');
INSERT INTO `x2_cityarea` VALUES (131121, '131121', '枣强县', '131100');
INSERT INTO `x2_cityarea` VALUES (131122, '131122', '武邑县', '131100');
INSERT INTO `x2_cityarea` VALUES (131123, '131123', '武强县', '131100');
INSERT INTO `x2_cityarea` VALUES (131124, '131124', '饶阳县', '131100');
INSERT INTO `x2_cityarea` VALUES (131125, '131125', '安平县', '131100');
INSERT INTO `x2_cityarea` VALUES (131126, '131126', '故城县', '131100');
INSERT INTO `x2_cityarea` VALUES (131127, '131127', '景　县', '131100');
INSERT INTO `x2_cityarea` VALUES (131128, '131128', '阜城县', '131100');
INSERT INTO `x2_cityarea` VALUES (131181, '131181', '冀州市', '131100');
INSERT INTO `x2_cityarea` VALUES (131182, '131182', '深州市', '131100');
INSERT INTO `x2_cityarea` VALUES (140101, '140101', '市辖区', '140100');
INSERT INTO `x2_cityarea` VALUES (140105, '140105', '小店区', '140100');
INSERT INTO `x2_cityarea` VALUES (140106, '140106', '迎泽区', '140100');
INSERT INTO `x2_cityarea` VALUES (140107, '140107', '杏花岭区', '140100');
INSERT INTO `x2_cityarea` VALUES (140108, '140108', '尖草坪区', '140100');
INSERT INTO `x2_cityarea` VALUES (140109, '140109', '万柏林区', '140100');
INSERT INTO `x2_cityarea` VALUES (140110, '140110', '晋源区', '140100');
INSERT INTO `x2_cityarea` VALUES (140121, '140121', '清徐县', '140100');
INSERT INTO `x2_cityarea` VALUES (140122, '140122', '阳曲县', '140100');
INSERT INTO `x2_cityarea` VALUES (140123, '140123', '娄烦县', '140100');
INSERT INTO `x2_cityarea` VALUES (140181, '140181', '古交市', '140100');
INSERT INTO `x2_cityarea` VALUES (140201, '140201', '市辖区', '140200');
INSERT INTO `x2_cityarea` VALUES (140202, '140202', '城　区', '140200');
INSERT INTO `x2_cityarea` VALUES (140203, '140203', '矿　区', '140200');
INSERT INTO `x2_cityarea` VALUES (140211, '140211', '南郊区', '140200');
INSERT INTO `x2_cityarea` VALUES (140212, '140212', '新荣区', '140200');
INSERT INTO `x2_cityarea` VALUES (140221, '140221', '阳高县', '140200');
INSERT INTO `x2_cityarea` VALUES (140222, '140222', '天镇县', '140200');
INSERT INTO `x2_cityarea` VALUES (140223, '140223', '广灵县', '140200');
INSERT INTO `x2_cityarea` VALUES (140224, '140224', '灵丘县', '140200');
INSERT INTO `x2_cityarea` VALUES (140225, '140225', '浑源县', '140200');
INSERT INTO `x2_cityarea` VALUES (140226, '140226', '左云县', '140200');
INSERT INTO `x2_cityarea` VALUES (140227, '140227', '大同县', '140200');
INSERT INTO `x2_cityarea` VALUES (140301, '140301', '市辖区', '140300');
INSERT INTO `x2_cityarea` VALUES (140302, '140302', '城　区', '140300');
INSERT INTO `x2_cityarea` VALUES (140303, '140303', '矿　区', '140300');
INSERT INTO `x2_cityarea` VALUES (140311, '140311', '郊　区', '140300');
INSERT INTO `x2_cityarea` VALUES (140321, '140321', '平定县', '140300');
INSERT INTO `x2_cityarea` VALUES (140322, '140322', '盂　县', '140300');
INSERT INTO `x2_cityarea` VALUES (140401, '140401', '市辖区', '140400');
INSERT INTO `x2_cityarea` VALUES (140402, '140402', '城　区', '140400');
INSERT INTO `x2_cityarea` VALUES (140411, '140411', '郊　区', '140400');
INSERT INTO `x2_cityarea` VALUES (140421, '140421', '长治县', '140400');
INSERT INTO `x2_cityarea` VALUES (140423, '140423', '襄垣县', '140400');
INSERT INTO `x2_cityarea` VALUES (140424, '140424', '屯留县', '140400');
INSERT INTO `x2_cityarea` VALUES (140425, '140425', '平顺县', '140400');
INSERT INTO `x2_cityarea` VALUES (140426, '140426', '黎城县', '140400');
INSERT INTO `x2_cityarea` VALUES (140427, '140427', '壶关县', '140400');
INSERT INTO `x2_cityarea` VALUES (140428, '140428', '长子县', '140400');
INSERT INTO `x2_cityarea` VALUES (140429, '140429', '武乡县', '140400');
INSERT INTO `x2_cityarea` VALUES (140430, '140430', '沁　县', '140400');
INSERT INTO `x2_cityarea` VALUES (140431, '140431', '沁源县', '140400');
INSERT INTO `x2_cityarea` VALUES (140481, '140481', '潞城市', '140400');
INSERT INTO `x2_cityarea` VALUES (140501, '140501', '市辖区', '140500');
INSERT INTO `x2_cityarea` VALUES (140502, '140502', '城　区', '140500');
INSERT INTO `x2_cityarea` VALUES (140521, '140521', '沁水县', '140500');
INSERT INTO `x2_cityarea` VALUES (140522, '140522', '阳城县', '140500');
INSERT INTO `x2_cityarea` VALUES (140524, '140524', '陵川县', '140500');
INSERT INTO `x2_cityarea` VALUES (140525, '140525', '泽州县', '140500');
INSERT INTO `x2_cityarea` VALUES (140581, '140581', '高平市', '140500');
INSERT INTO `x2_cityarea` VALUES (140601, '140601', '市辖区', '140600');
INSERT INTO `x2_cityarea` VALUES (140602, '140602', '朔城区', '140600');
INSERT INTO `x2_cityarea` VALUES (140603, '140603', '平鲁区', '140600');
INSERT INTO `x2_cityarea` VALUES (140621, '140621', '山阴县', '140600');
INSERT INTO `x2_cityarea` VALUES (140622, '140622', '应　县', '140600');
INSERT INTO `x2_cityarea` VALUES (140623, '140623', '右玉县', '140600');
INSERT INTO `x2_cityarea` VALUES (140624, '140624', '怀仁县', '140600');
INSERT INTO `x2_cityarea` VALUES (140701, '140701', '市辖区', '140700');
INSERT INTO `x2_cityarea` VALUES (140702, '140702', '榆次区', '140700');
INSERT INTO `x2_cityarea` VALUES (140721, '140721', '榆社县', '140700');
INSERT INTO `x2_cityarea` VALUES (140722, '140722', '左权县', '140700');
INSERT INTO `x2_cityarea` VALUES (140723, '140723', '和顺县', '140700');
INSERT INTO `x2_cityarea` VALUES (140724, '140724', '昔阳县', '140700');
INSERT INTO `x2_cityarea` VALUES (140725, '140725', '寿阳县', '140700');
INSERT INTO `x2_cityarea` VALUES (140726, '140726', '太谷县', '140700');
INSERT INTO `x2_cityarea` VALUES (140727, '140727', '祁　县', '140700');
INSERT INTO `x2_cityarea` VALUES (140728, '140728', '平遥县', '140700');
INSERT INTO `x2_cityarea` VALUES (140729, '140729', '灵石县', '140700');
INSERT INTO `x2_cityarea` VALUES (140781, '140781', '介休市', '140700');
INSERT INTO `x2_cityarea` VALUES (140801, '140801', '市辖区', '140800');
INSERT INTO `x2_cityarea` VALUES (140802, '140802', '盐湖区', '140800');
INSERT INTO `x2_cityarea` VALUES (140821, '140821', '临猗县', '140800');
INSERT INTO `x2_cityarea` VALUES (140822, '140822', '万荣县', '140800');
INSERT INTO `x2_cityarea` VALUES (140823, '140823', '闻喜县', '140800');
INSERT INTO `x2_cityarea` VALUES (140824, '140824', '稷山县', '140800');
INSERT INTO `x2_cityarea` VALUES (140825, '140825', '新绛县', '140800');
INSERT INTO `x2_cityarea` VALUES (140826, '140826', '绛　县', '140800');
INSERT INTO `x2_cityarea` VALUES (140827, '140827', '垣曲县', '140800');
INSERT INTO `x2_cityarea` VALUES (140828, '140828', '夏　县', '140800');
INSERT INTO `x2_cityarea` VALUES (140829, '140829', '平陆县', '140800');
INSERT INTO `x2_cityarea` VALUES (140830, '140830', '芮城县', '140800');
INSERT INTO `x2_cityarea` VALUES (140881, '140881', '永济市', '140800');
INSERT INTO `x2_cityarea` VALUES (140882, '140882', '河津市', '140800');
INSERT INTO `x2_cityarea` VALUES (140901, '140901', '市辖区', '140900');
INSERT INTO `x2_cityarea` VALUES (140902, '140902', '忻府区', '140900');
INSERT INTO `x2_cityarea` VALUES (140921, '140921', '定襄县', '140900');
INSERT INTO `x2_cityarea` VALUES (140922, '140922', '五台县', '140900');
INSERT INTO `x2_cityarea` VALUES (140923, '140923', '代　县', '140900');
INSERT INTO `x2_cityarea` VALUES (140924, '140924', '繁峙县', '140900');
INSERT INTO `x2_cityarea` VALUES (140925, '140925', '宁武县', '140900');
INSERT INTO `x2_cityarea` VALUES (140926, '140926', '静乐县', '140900');
INSERT INTO `x2_cityarea` VALUES (140927, '140927', '神池县', '140900');
INSERT INTO `x2_cityarea` VALUES (140928, '140928', '五寨县', '140900');
INSERT INTO `x2_cityarea` VALUES (140929, '140929', '岢岚县', '140900');
INSERT INTO `x2_cityarea` VALUES (140930, '140930', '河曲县', '140900');
INSERT INTO `x2_cityarea` VALUES (140931, '140931', '保德县', '140900');
INSERT INTO `x2_cityarea` VALUES (140932, '140932', '偏关县', '140900');
INSERT INTO `x2_cityarea` VALUES (140981, '140981', '原平市', '140900');
INSERT INTO `x2_cityarea` VALUES (141001, '141001', '市辖区', '141000');
INSERT INTO `x2_cityarea` VALUES (141002, '141002', '尧都区', '141000');
INSERT INTO `x2_cityarea` VALUES (141021, '141021', '曲沃县', '141000');
INSERT INTO `x2_cityarea` VALUES (141022, '141022', '翼城县', '141000');
INSERT INTO `x2_cityarea` VALUES (141023, '141023', '襄汾县', '141000');
INSERT INTO `x2_cityarea` VALUES (141024, '141024', '洪洞县', '141000');
INSERT INTO `x2_cityarea` VALUES (141025, '141025', '古　县', '141000');
INSERT INTO `x2_cityarea` VALUES (141026, '141026', '安泽县', '141000');
INSERT INTO `x2_cityarea` VALUES (141027, '141027', '浮山县', '141000');
INSERT INTO `x2_cityarea` VALUES (141028, '141028', '吉　县', '141000');
INSERT INTO `x2_cityarea` VALUES (141029, '141029', '乡宁县', '141000');
INSERT INTO `x2_cityarea` VALUES (141030, '141030', '大宁县', '141000');
INSERT INTO `x2_cityarea` VALUES (141031, '141031', '隰　县', '141000');
INSERT INTO `x2_cityarea` VALUES (141032, '141032', '永和县', '141000');
INSERT INTO `x2_cityarea` VALUES (141033, '141033', '蒲　县', '141000');
INSERT INTO `x2_cityarea` VALUES (141034, '141034', '汾西县', '141000');
INSERT INTO `x2_cityarea` VALUES (141081, '141081', '侯马市', '141000');
INSERT INTO `x2_cityarea` VALUES (141082, '141082', '霍州市', '141000');
INSERT INTO `x2_cityarea` VALUES (141101, '141101', '市辖区', '141100');
INSERT INTO `x2_cityarea` VALUES (141102, '141102', '离石区', '141100');
INSERT INTO `x2_cityarea` VALUES (141121, '141121', '文水县', '141100');
INSERT INTO `x2_cityarea` VALUES (141122, '141122', '交城县', '141100');
INSERT INTO `x2_cityarea` VALUES (141123, '141123', '兴　县', '141100');
INSERT INTO `x2_cityarea` VALUES (141124, '141124', '临　县', '141100');
INSERT INTO `x2_cityarea` VALUES (141125, '141125', '柳林县', '141100');
INSERT INTO `x2_cityarea` VALUES (141126, '141126', '石楼县', '141100');
INSERT INTO `x2_cityarea` VALUES (141127, '141127', '岚　县', '141100');
INSERT INTO `x2_cityarea` VALUES (141128, '141128', '方山县', '141100');
INSERT INTO `x2_cityarea` VALUES (141129, '141129', '中阳县', '141100');
INSERT INTO `x2_cityarea` VALUES (141130, '141130', '交口县', '141100');
INSERT INTO `x2_cityarea` VALUES (141181, '141181', '孝义市', '141100');
INSERT INTO `x2_cityarea` VALUES (141182, '141182', '汾阳市', '141100');
INSERT INTO `x2_cityarea` VALUES (150101, '150101', '市辖区', '150100');
INSERT INTO `x2_cityarea` VALUES (150102, '150102', '新城区', '150100');
INSERT INTO `x2_cityarea` VALUES (150103, '150103', '回民区', '150100');
INSERT INTO `x2_cityarea` VALUES (150104, '150104', '玉泉区', '150100');
INSERT INTO `x2_cityarea` VALUES (150105, '150105', '赛罕区', '150100');
INSERT INTO `x2_cityarea` VALUES (150121, '150121', '土默特左旗', '150100');
INSERT INTO `x2_cityarea` VALUES (150122, '150122', '托克托县', '150100');
INSERT INTO `x2_cityarea` VALUES (150123, '150123', '和林格尔县', '150100');
INSERT INTO `x2_cityarea` VALUES (150124, '150124', '清水河县', '150100');
INSERT INTO `x2_cityarea` VALUES (150125, '150125', '武川县', '150100');
INSERT INTO `x2_cityarea` VALUES (150201, '150201', '市辖区', '150200');
INSERT INTO `x2_cityarea` VALUES (150202, '150202', '东河区', '150200');
INSERT INTO `x2_cityarea` VALUES (150203, '150203', '昆都仑区', '150200');
INSERT INTO `x2_cityarea` VALUES (150204, '150204', '青山区', '150200');
INSERT INTO `x2_cityarea` VALUES (150205, '150205', '石拐区', '150200');
INSERT INTO `x2_cityarea` VALUES (150206, '150206', '白云矿区', '150200');
INSERT INTO `x2_cityarea` VALUES (150207, '150207', '九原区', '150200');
INSERT INTO `x2_cityarea` VALUES (150221, '150221', '土默特右旗', '150200');
INSERT INTO `x2_cityarea` VALUES (150222, '150222', '固阳县', '150200');
INSERT INTO `x2_cityarea` VALUES (150223, '150223', '达尔罕茂明安联合旗', '150200');
INSERT INTO `x2_cityarea` VALUES (150301, '150301', '市辖区', '150300');
INSERT INTO `x2_cityarea` VALUES (150302, '150302', '海勃湾区', '150300');
INSERT INTO `x2_cityarea` VALUES (150303, '150303', '海南区', '150300');
INSERT INTO `x2_cityarea` VALUES (150304, '150304', '乌达区', '150300');
INSERT INTO `x2_cityarea` VALUES (150401, '150401', '市辖区', '150400');
INSERT INTO `x2_cityarea` VALUES (150402, '150402', '红山区', '150400');
INSERT INTO `x2_cityarea` VALUES (150403, '150403', '元宝山区', '150400');
INSERT INTO `x2_cityarea` VALUES (150404, '150404', '松山区', '150400');
INSERT INTO `x2_cityarea` VALUES (150421, '150421', '阿鲁科尔沁旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150422, '150422', '巴林左旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150423, '150423', '巴林右旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150424, '150424', '林西县', '150400');
INSERT INTO `x2_cityarea` VALUES (150425, '150425', '克什克腾旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150426, '150426', '翁牛特旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150428, '150428', '喀喇沁旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150429, '150429', '宁城县', '150400');
INSERT INTO `x2_cityarea` VALUES (150430, '150430', '敖汉旗', '150400');
INSERT INTO `x2_cityarea` VALUES (150501, '150501', '市辖区', '150500');
INSERT INTO `x2_cityarea` VALUES (150502, '150502', '科尔沁区', '150500');
INSERT INTO `x2_cityarea` VALUES (150521, '150521', '科尔沁左翼中旗', '150500');
INSERT INTO `x2_cityarea` VALUES (150522, '150522', '科尔沁左翼后旗', '150500');
INSERT INTO `x2_cityarea` VALUES (150523, '150523', '开鲁县', '150500');
INSERT INTO `x2_cityarea` VALUES (150524, '150524', '库伦旗', '150500');
INSERT INTO `x2_cityarea` VALUES (150525, '150525', '奈曼旗', '150500');
INSERT INTO `x2_cityarea` VALUES (150526, '150526', '扎鲁特旗', '150500');
INSERT INTO `x2_cityarea` VALUES (150581, '150581', '霍林郭勒市', '150500');
INSERT INTO `x2_cityarea` VALUES (150602, '150602', '东胜区', '150600');
INSERT INTO `x2_cityarea` VALUES (150621, '150621', '达拉特旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150622, '150622', '准格尔旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150623, '150623', '鄂托克前旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150624, '150624', '鄂托克旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150625, '150625', '杭锦旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150626, '150626', '乌审旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150627, '150627', '伊金霍洛旗', '150600');
INSERT INTO `x2_cityarea` VALUES (150701, '150701', '市辖区', '150700');
INSERT INTO `x2_cityarea` VALUES (150702, '150702', '海拉尔区', '150700');
INSERT INTO `x2_cityarea` VALUES (150721, '150721', '阿荣旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150722, '150722', '莫力达瓦达斡尔族自治旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150723, '150723', '鄂伦春自治旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150724, '150724', '鄂温克族自治旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150725, '150725', '陈巴尔虎旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150726, '150726', '新巴尔虎左旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150727, '150727', '新巴尔虎右旗', '150700');
INSERT INTO `x2_cityarea` VALUES (150781, '150781', '满洲里市', '150700');
INSERT INTO `x2_cityarea` VALUES (150782, '150782', '牙克石市', '150700');
INSERT INTO `x2_cityarea` VALUES (150783, '150783', '扎兰屯市', '150700');
INSERT INTO `x2_cityarea` VALUES (150784, '150784', '额尔古纳市', '150700');
INSERT INTO `x2_cityarea` VALUES (150785, '150785', '根河市', '150700');
INSERT INTO `x2_cityarea` VALUES (150801, '150801', '市辖区', '150800');
INSERT INTO `x2_cityarea` VALUES (150802, '150802', '临河区', '150800');
INSERT INTO `x2_cityarea` VALUES (150821, '150821', '五原县', '150800');
INSERT INTO `x2_cityarea` VALUES (150822, '150822', '磴口县', '150800');
INSERT INTO `x2_cityarea` VALUES (150823, '150823', '乌拉特前旗', '150800');
INSERT INTO `x2_cityarea` VALUES (150824, '150824', '乌拉特中旗', '150800');
INSERT INTO `x2_cityarea` VALUES (150825, '150825', '乌拉特后旗', '150800');
INSERT INTO `x2_cityarea` VALUES (150826, '150826', '杭锦后旗', '150800');
INSERT INTO `x2_cityarea` VALUES (150901, '150901', '市辖区', '150900');
INSERT INTO `x2_cityarea` VALUES (150902, '150902', '集宁区', '150900');
INSERT INTO `x2_cityarea` VALUES (150921, '150921', '卓资县', '150900');
INSERT INTO `x2_cityarea` VALUES (150922, '150922', '化德县', '150900');
INSERT INTO `x2_cityarea` VALUES (150923, '150923', '商都县', '150900');
INSERT INTO `x2_cityarea` VALUES (150924, '150924', '兴和县', '150900');
INSERT INTO `x2_cityarea` VALUES (150925, '150925', '凉城县', '150900');
INSERT INTO `x2_cityarea` VALUES (150926, '150926', '察哈尔右翼前旗', '150900');
INSERT INTO `x2_cityarea` VALUES (150927, '150927', '察哈尔右翼中旗', '150900');
INSERT INTO `x2_cityarea` VALUES (150928, '150928', '察哈尔右翼后旗', '150900');
INSERT INTO `x2_cityarea` VALUES (150929, '150929', '四子王旗', '150900');
INSERT INTO `x2_cityarea` VALUES (150981, '150981', '丰镇市', '150900');
INSERT INTO `x2_cityarea` VALUES (152201, '152201', '乌兰浩特市', '152200');
INSERT INTO `x2_cityarea` VALUES (152202, '152202', '阿尔山市', '152200');
INSERT INTO `x2_cityarea` VALUES (152221, '152221', '科尔沁右翼前旗', '152200');
INSERT INTO `x2_cityarea` VALUES (152222, '152222', '科尔沁右翼中旗', '152200');
INSERT INTO `x2_cityarea` VALUES (152223, '152223', '扎赉特旗', '152200');
INSERT INTO `x2_cityarea` VALUES (152224, '152224', '突泉县', '152200');
INSERT INTO `x2_cityarea` VALUES (152501, '152501', '二连浩特市', '152500');
INSERT INTO `x2_cityarea` VALUES (152502, '152502', '锡林浩特市', '152500');
INSERT INTO `x2_cityarea` VALUES (152522, '152522', '阿巴嘎旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152523, '152523', '苏尼特左旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152524, '152524', '苏尼特右旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152525, '152525', '东乌珠穆沁旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152526, '152526', '西乌珠穆沁旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152527, '152527', '太仆寺旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152528, '152528', '镶黄旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152529, '152529', '正镶白旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152530, '152530', '正蓝旗', '152500');
INSERT INTO `x2_cityarea` VALUES (152531, '152531', '多伦县', '152500');
INSERT INTO `x2_cityarea` VALUES (152921, '152921', '阿拉善左旗', '152900');
INSERT INTO `x2_cityarea` VALUES (152922, '152922', '阿拉善右旗', '152900');
INSERT INTO `x2_cityarea` VALUES (152923, '152923', '额济纳旗', '152900');
INSERT INTO `x2_cityarea` VALUES (210101, '210101', '市辖区', '210100');
INSERT INTO `x2_cityarea` VALUES (210102, '210102', '和平区', '210100');
INSERT INTO `x2_cityarea` VALUES (210103, '210103', '沈河区', '210100');
INSERT INTO `x2_cityarea` VALUES (210104, '210104', '大东区', '210100');
INSERT INTO `x2_cityarea` VALUES (210105, '210105', '皇姑区', '210100');
INSERT INTO `x2_cityarea` VALUES (210106, '210106', '铁西区', '210100');
INSERT INTO `x2_cityarea` VALUES (210111, '210111', '苏家屯区', '210100');
INSERT INTO `x2_cityarea` VALUES (210112, '210112', '东陵区', '210100');
INSERT INTO `x2_cityarea` VALUES (210113, '210113', '新城子区', '210100');
INSERT INTO `x2_cityarea` VALUES (210114, '210114', '于洪区', '210100');
INSERT INTO `x2_cityarea` VALUES (210122, '210122', '辽中县', '210100');
INSERT INTO `x2_cityarea` VALUES (210123, '210123', '康平县', '210100');
INSERT INTO `x2_cityarea` VALUES (210124, '210124', '法库县', '210100');
INSERT INTO `x2_cityarea` VALUES (210181, '210181', '新民市', '210100');
INSERT INTO `x2_cityarea` VALUES (210201, '210201', '市辖区', '210200');
INSERT INTO `x2_cityarea` VALUES (210202, '210202', '中山区', '210200');
INSERT INTO `x2_cityarea` VALUES (210203, '210203', '西岗区', '210200');
INSERT INTO `x2_cityarea` VALUES (210204, '210204', '沙河口区', '210200');
INSERT INTO `x2_cityarea` VALUES (210211, '210211', '甘井子区', '210200');
INSERT INTO `x2_cityarea` VALUES (210212, '210212', '旅顺口区', '210200');
INSERT INTO `x2_cityarea` VALUES (210213, '210213', '金州区', '210200');
INSERT INTO `x2_cityarea` VALUES (210224, '210224', '长海县', '210200');
INSERT INTO `x2_cityarea` VALUES (210281, '210281', '瓦房店市', '210200');
INSERT INTO `x2_cityarea` VALUES (210282, '210282', '普兰店市', '210200');
INSERT INTO `x2_cityarea` VALUES (210283, '210283', '庄河市', '210200');
INSERT INTO `x2_cityarea` VALUES (210301, '210301', '市辖区', '210300');
INSERT INTO `x2_cityarea` VALUES (210302, '210302', '铁东区', '210300');
INSERT INTO `x2_cityarea` VALUES (210303, '210303', '铁西区', '210300');
INSERT INTO `x2_cityarea` VALUES (210304, '210304', '立山区', '210300');
INSERT INTO `x2_cityarea` VALUES (210311, '210311', '千山区', '210300');
INSERT INTO `x2_cityarea` VALUES (210321, '210321', '台安县', '210300');
INSERT INTO `x2_cityarea` VALUES (210323, '210323', '岫岩满族自治县', '210300');
INSERT INTO `x2_cityarea` VALUES (210381, '210381', '海城市', '210300');
INSERT INTO `x2_cityarea` VALUES (210401, '210401', '市辖区', '210400');
INSERT INTO `x2_cityarea` VALUES (210402, '210402', '新抚区', '210400');
INSERT INTO `x2_cityarea` VALUES (210403, '210403', '东洲区', '210400');
INSERT INTO `x2_cityarea` VALUES (210404, '210404', '望花区', '210400');
INSERT INTO `x2_cityarea` VALUES (210411, '210411', '顺城区', '210400');
INSERT INTO `x2_cityarea` VALUES (210421, '210421', '抚顺县', '210400');
INSERT INTO `x2_cityarea` VALUES (210422, '210422', '新宾满族自治县', '210400');
INSERT INTO `x2_cityarea` VALUES (210423, '210423', '清原满族自治县', '210400');
INSERT INTO `x2_cityarea` VALUES (210501, '210501', '市辖区', '210500');
INSERT INTO `x2_cityarea` VALUES (210502, '210502', '平山区', '210500');
INSERT INTO `x2_cityarea` VALUES (210503, '210503', '溪湖区', '210500');
INSERT INTO `x2_cityarea` VALUES (210504, '210504', '明山区', '210500');
INSERT INTO `x2_cityarea` VALUES (210505, '210505', '南芬区', '210500');
INSERT INTO `x2_cityarea` VALUES (210521, '210521', '本溪满族自治县', '210500');
INSERT INTO `x2_cityarea` VALUES (210522, '210522', '桓仁满族自治县', '210500');
INSERT INTO `x2_cityarea` VALUES (210601, '210601', '市辖区', '210600');
INSERT INTO `x2_cityarea` VALUES (210602, '210602', '元宝区', '210600');
INSERT INTO `x2_cityarea` VALUES (210603, '210603', '振兴区', '210600');
INSERT INTO `x2_cityarea` VALUES (210604, '210604', '振安区', '210600');
INSERT INTO `x2_cityarea` VALUES (210624, '210624', '宽甸满族自治县', '210600');
INSERT INTO `x2_cityarea` VALUES (210681, '210681', '东港市', '210600');
INSERT INTO `x2_cityarea` VALUES (210682, '210682', '凤城市', '210600');
INSERT INTO `x2_cityarea` VALUES (210701, '210701', '市辖区', '210700');
INSERT INTO `x2_cityarea` VALUES (210702, '210702', '古塔区', '210700');
INSERT INTO `x2_cityarea` VALUES (210703, '210703', '凌河区', '210700');
INSERT INTO `x2_cityarea` VALUES (210711, '210711', '太和区', '210700');
INSERT INTO `x2_cityarea` VALUES (210726, '210726', '黑山县', '210700');
INSERT INTO `x2_cityarea` VALUES (210727, '210727', '义　县', '210700');
INSERT INTO `x2_cityarea` VALUES (210781, '210781', '凌海市', '210700');
INSERT INTO `x2_cityarea` VALUES (210782, '210782', '北宁市', '210700');
INSERT INTO `x2_cityarea` VALUES (210801, '210801', '市辖区', '210800');
INSERT INTO `x2_cityarea` VALUES (210802, '210802', '站前区', '210800');
INSERT INTO `x2_cityarea` VALUES (210803, '210803', '西市区', '210800');
INSERT INTO `x2_cityarea` VALUES (210804, '210804', '鲅鱼圈区', '210800');
INSERT INTO `x2_cityarea` VALUES (210811, '210811', '老边区', '210800');
INSERT INTO `x2_cityarea` VALUES (210881, '210881', '盖州市', '210800');
INSERT INTO `x2_cityarea` VALUES (210882, '210882', '大石桥市', '210800');
INSERT INTO `x2_cityarea` VALUES (210901, '210901', '市辖区', '210900');
INSERT INTO `x2_cityarea` VALUES (210902, '210902', '海州区', '210900');
INSERT INTO `x2_cityarea` VALUES (210903, '210903', '新邱区', '210900');
INSERT INTO `x2_cityarea` VALUES (210904, '210904', '太平区', '210900');
INSERT INTO `x2_cityarea` VALUES (210905, '210905', '清河门区', '210900');
INSERT INTO `x2_cityarea` VALUES (210911, '210911', '细河区', '210900');
INSERT INTO `x2_cityarea` VALUES (210921, '210921', '阜新蒙古族自治县', '210900');
INSERT INTO `x2_cityarea` VALUES (210922, '210922', '彰武县', '210900');
INSERT INTO `x2_cityarea` VALUES (211001, '211001', '市辖区', '211000');
INSERT INTO `x2_cityarea` VALUES (211002, '211002', '白塔区', '211000');
INSERT INTO `x2_cityarea` VALUES (211003, '211003', '文圣区', '211000');
INSERT INTO `x2_cityarea` VALUES (211004, '211004', '宏伟区', '211000');
INSERT INTO `x2_cityarea` VALUES (211005, '211005', '弓长岭区', '211000');
INSERT INTO `x2_cityarea` VALUES (211011, '211011', '太子河区', '211000');
INSERT INTO `x2_cityarea` VALUES (211021, '211021', '辽阳县', '211000');
INSERT INTO `x2_cityarea` VALUES (211081, '211081', '灯塔市', '211000');
INSERT INTO `x2_cityarea` VALUES (211101, '211101', '市辖区', '211100');
INSERT INTO `x2_cityarea` VALUES (211102, '211102', '双台子区', '211100');
INSERT INTO `x2_cityarea` VALUES (211103, '211103', '兴隆台区', '211100');
INSERT INTO `x2_cityarea` VALUES (211121, '211121', '大洼县', '211100');
INSERT INTO `x2_cityarea` VALUES (211122, '211122', '盘山县', '211100');
INSERT INTO `x2_cityarea` VALUES (211201, '211201', '市辖区', '211200');
INSERT INTO `x2_cityarea` VALUES (211202, '211202', '银州区', '211200');
INSERT INTO `x2_cityarea` VALUES (211204, '211204', '清河区', '211200');
INSERT INTO `x2_cityarea` VALUES (211221, '211221', '铁岭县', '211200');
INSERT INTO `x2_cityarea` VALUES (211223, '211223', '西丰县', '211200');
INSERT INTO `x2_cityarea` VALUES (211224, '211224', '昌图县', '211200');
INSERT INTO `x2_cityarea` VALUES (211281, '211281', '调兵山市', '211200');
INSERT INTO `x2_cityarea` VALUES (211282, '211282', '开原市', '211200');
INSERT INTO `x2_cityarea` VALUES (211301, '211301', '市辖区', '211300');
INSERT INTO `x2_cityarea` VALUES (211302, '211302', '双塔区', '211300');
INSERT INTO `x2_cityarea` VALUES (211303, '211303', '龙城区', '211300');
INSERT INTO `x2_cityarea` VALUES (211321, '211321', '朝阳县', '211300');
INSERT INTO `x2_cityarea` VALUES (211322, '211322', '建平县', '211300');
INSERT INTO `x2_cityarea` VALUES (211324, '211324', '喀喇沁左翼蒙古族自治县', '211300');
INSERT INTO `x2_cityarea` VALUES (211381, '211381', '北票市', '211300');
INSERT INTO `x2_cityarea` VALUES (211382, '211382', '凌源市', '211300');
INSERT INTO `x2_cityarea` VALUES (211401, '211401', '市辖区', '211400');
INSERT INTO `x2_cityarea` VALUES (211402, '211402', '连山区', '211400');
INSERT INTO `x2_cityarea` VALUES (211403, '211403', '龙港区', '211400');
INSERT INTO `x2_cityarea` VALUES (211404, '211404', '南票区', '211400');
INSERT INTO `x2_cityarea` VALUES (211421, '211421', '绥中县', '211400');
INSERT INTO `x2_cityarea` VALUES (211422, '211422', '建昌县', '211400');
INSERT INTO `x2_cityarea` VALUES (211481, '211481', '兴城市', '211400');
INSERT INTO `x2_cityarea` VALUES (220101, '220101', '市辖区', '220100');
INSERT INTO `x2_cityarea` VALUES (220102, '220102', '南关区', '220100');
INSERT INTO `x2_cityarea` VALUES (220103, '220103', '宽城区', '220100');
INSERT INTO `x2_cityarea` VALUES (220104, '220104', '朝阳区', '220100');
INSERT INTO `x2_cityarea` VALUES (220105, '220105', '二道区', '220100');
INSERT INTO `x2_cityarea` VALUES (220106, '220106', '绿园区', '220100');
INSERT INTO `x2_cityarea` VALUES (220112, '220112', '双阳区', '220100');
INSERT INTO `x2_cityarea` VALUES (220122, '220122', '农安县', '220100');
INSERT INTO `x2_cityarea` VALUES (220181, '220181', '九台市', '220100');
INSERT INTO `x2_cityarea` VALUES (220182, '220182', '榆树市', '220100');
INSERT INTO `x2_cityarea` VALUES (220183, '220183', '德惠市', '220100');
INSERT INTO `x2_cityarea` VALUES (220201, '220201', '市辖区', '220200');
INSERT INTO `x2_cityarea` VALUES (220202, '220202', '昌邑区', '220200');
INSERT INTO `x2_cityarea` VALUES (220203, '220203', '龙潭区', '220200');
INSERT INTO `x2_cityarea` VALUES (220204, '220204', '船营区', '220200');
INSERT INTO `x2_cityarea` VALUES (220211, '220211', '丰满区', '220200');
INSERT INTO `x2_cityarea` VALUES (220221, '220221', '永吉县', '220200');
INSERT INTO `x2_cityarea` VALUES (220281, '220281', '蛟河市', '220200');
INSERT INTO `x2_cityarea` VALUES (220282, '220282', '桦甸市', '220200');
INSERT INTO `x2_cityarea` VALUES (220283, '220283', '舒兰市', '220200');
INSERT INTO `x2_cityarea` VALUES (220284, '220284', '磐石市', '220200');
INSERT INTO `x2_cityarea` VALUES (220301, '220301', '市辖区', '220300');
INSERT INTO `x2_cityarea` VALUES (220302, '220302', '铁西区', '220300');
INSERT INTO `x2_cityarea` VALUES (220303, '220303', '铁东区', '220300');
INSERT INTO `x2_cityarea` VALUES (220322, '220322', '梨树县', '220300');
INSERT INTO `x2_cityarea` VALUES (220323, '220323', '伊通满族自治县', '220300');
INSERT INTO `x2_cityarea` VALUES (220381, '220381', '公主岭市', '220300');
INSERT INTO `x2_cityarea` VALUES (220382, '220382', '双辽市', '220300');
INSERT INTO `x2_cityarea` VALUES (220401, '220401', '市辖区', '220400');
INSERT INTO `x2_cityarea` VALUES (220402, '220402', '龙山区', '220400');
INSERT INTO `x2_cityarea` VALUES (220403, '220403', '西安区', '220400');
INSERT INTO `x2_cityarea` VALUES (220421, '220421', '东丰县', '220400');
INSERT INTO `x2_cityarea` VALUES (220422, '220422', '东辽县', '220400');
INSERT INTO `x2_cityarea` VALUES (220501, '220501', '市辖区', '220500');
INSERT INTO `x2_cityarea` VALUES (220502, '220502', '东昌区', '220500');
INSERT INTO `x2_cityarea` VALUES (220503, '220503', '二道江区', '220500');
INSERT INTO `x2_cityarea` VALUES (220521, '220521', '通化县', '220500');
INSERT INTO `x2_cityarea` VALUES (220523, '220523', '辉南县', '220500');
INSERT INTO `x2_cityarea` VALUES (220524, '220524', '柳河县', '220500');
INSERT INTO `x2_cityarea` VALUES (220581, '220581', '梅河口市', '220500');
INSERT INTO `x2_cityarea` VALUES (220582, '220582', '集安市', '220500');
INSERT INTO `x2_cityarea` VALUES (220601, '220601', '市辖区', '220600');
INSERT INTO `x2_cityarea` VALUES (220602, '220602', '八道江区', '220600');
INSERT INTO `x2_cityarea` VALUES (220621, '220621', '抚松县', '220600');
INSERT INTO `x2_cityarea` VALUES (220622, '220622', '靖宇县', '220600');
INSERT INTO `x2_cityarea` VALUES (220623, '220623', '长白朝鲜族自治县', '220600');
INSERT INTO `x2_cityarea` VALUES (220604, '220604', '江源区', '220600');
INSERT INTO `x2_cityarea` VALUES (220681, '220681', '临江市', '220600');
INSERT INTO `x2_cityarea` VALUES (220701, '220701', '市辖区', '220700');
INSERT INTO `x2_cityarea` VALUES (220702, '220702', '宁江区', '220700');
INSERT INTO `x2_cityarea` VALUES (220721, '220721', '前郭尔罗斯蒙古族自治县', '220700');
INSERT INTO `x2_cityarea` VALUES (220722, '220722', '长岭县', '220700');
INSERT INTO `x2_cityarea` VALUES (220723, '220723', '乾安县', '220700');
INSERT INTO `x2_cityarea` VALUES (220724, '220724', '扶余县', '220700');
INSERT INTO `x2_cityarea` VALUES (220801, '220801', '市辖区', '220800');
INSERT INTO `x2_cityarea` VALUES (220802, '220802', '洮北区', '220800');
INSERT INTO `x2_cityarea` VALUES (220821, '220821', '镇赉县', '220800');
INSERT INTO `x2_cityarea` VALUES (220822, '220822', '通榆县', '220800');
INSERT INTO `x2_cityarea` VALUES (220881, '220881', '洮南市', '220800');
INSERT INTO `x2_cityarea` VALUES (220882, '220882', '大安市', '220800');
INSERT INTO `x2_cityarea` VALUES (222401, '222401', '延吉市', '222400');
INSERT INTO `x2_cityarea` VALUES (222402, '222402', '图们市', '222400');
INSERT INTO `x2_cityarea` VALUES (222403, '222403', '敦化市', '222400');
INSERT INTO `x2_cityarea` VALUES (222404, '222404', '珲春市', '222400');
INSERT INTO `x2_cityarea` VALUES (222405, '222405', '龙井市', '222400');
INSERT INTO `x2_cityarea` VALUES (222406, '222406', '和龙市', '222400');
INSERT INTO `x2_cityarea` VALUES (222424, '222424', '汪清县', '222400');
INSERT INTO `x2_cityarea` VALUES (222426, '222426', '安图县', '222400');
INSERT INTO `x2_cityarea` VALUES (230101, '230101', '市辖区', '230100');
INSERT INTO `x2_cityarea` VALUES (230102, '230102', '道里区', '230100');
INSERT INTO `x2_cityarea` VALUES (230103, '230103', '南岗区', '230100');
INSERT INTO `x2_cityarea` VALUES (230104, '230104', '道外区', '230100');
INSERT INTO `x2_cityarea` VALUES (230110, '230110', '香坊区', '230100');
INSERT INTO `x2_cityarea` VALUES (230107, '230107', '动力区', '230100');
INSERT INTO `x2_cityarea` VALUES (230108, '230108', '平房区', '230100');
INSERT INTO `x2_cityarea` VALUES (230109, '230109', '松北区', '230100');
INSERT INTO `x2_cityarea` VALUES (230111, '230111', '呼兰区', '230100');
INSERT INTO `x2_cityarea` VALUES (230123, '230123', '依兰县', '230100');
INSERT INTO `x2_cityarea` VALUES (230124, '230124', '方正县', '230100');
INSERT INTO `x2_cityarea` VALUES (230125, '230125', '宾　县', '230100');
INSERT INTO `x2_cityarea` VALUES (230126, '230126', '巴彦县', '230100');
INSERT INTO `x2_cityarea` VALUES (230127, '230127', '木兰县', '230100');
INSERT INTO `x2_cityarea` VALUES (230128, '230128', '通河县', '230100');
INSERT INTO `x2_cityarea` VALUES (230129, '230129', '延寿县', '230100');
INSERT INTO `x2_cityarea` VALUES (230112, '230112', '阿城区', '230100');
INSERT INTO `x2_cityarea` VALUES (230182, '230182', '双城市', '230100');
INSERT INTO `x2_cityarea` VALUES (230183, '230183', '尚志市', '230100');
INSERT INTO `x2_cityarea` VALUES (230184, '230184', '五常市', '230100');
INSERT INTO `x2_cityarea` VALUES (230201, '230201', '市辖区', '230200');
INSERT INTO `x2_cityarea` VALUES (230202, '230202', '龙沙区', '230200');
INSERT INTO `x2_cityarea` VALUES (230203, '230203', '建华区', '230200');
INSERT INTO `x2_cityarea` VALUES (230204, '230204', '铁锋区', '230200');
INSERT INTO `x2_cityarea` VALUES (230205, '230205', '昂昂溪区', '230200');
INSERT INTO `x2_cityarea` VALUES (230206, '230206', '富拉尔基区', '230200');
INSERT INTO `x2_cityarea` VALUES (230207, '230207', '碾子山区', '230200');
INSERT INTO `x2_cityarea` VALUES (230208, '230208', '梅里斯达斡尔族区', '230200');
INSERT INTO `x2_cityarea` VALUES (230221, '230221', '龙江县', '230200');
INSERT INTO `x2_cityarea` VALUES (230223, '230223', '依安县', '230200');
INSERT INTO `x2_cityarea` VALUES (230224, '230224', '泰来县', '230200');
INSERT INTO `x2_cityarea` VALUES (230225, '230225', '甘南县', '230200');
INSERT INTO `x2_cityarea` VALUES (230227, '230227', '富裕县', '230200');
INSERT INTO `x2_cityarea` VALUES (230229, '230229', '克山县', '230200');
INSERT INTO `x2_cityarea` VALUES (230230, '230230', '克东县', '230200');
INSERT INTO `x2_cityarea` VALUES (230231, '230231', '拜泉县', '230200');
INSERT INTO `x2_cityarea` VALUES (230281, '230281', '讷河市', '230200');
INSERT INTO `x2_cityarea` VALUES (230301, '230301', '市辖区', '230300');
INSERT INTO `x2_cityarea` VALUES (230302, '230302', '鸡冠区', '230300');
INSERT INTO `x2_cityarea` VALUES (230303, '230303', '恒山区', '230300');
INSERT INTO `x2_cityarea` VALUES (230304, '230304', '滴道区', '230300');
INSERT INTO `x2_cityarea` VALUES (230305, '230305', '梨树区', '230300');
INSERT INTO `x2_cityarea` VALUES (230306, '230306', '城子河区', '230300');
INSERT INTO `x2_cityarea` VALUES (230307, '230307', '麻山区', '230300');
INSERT INTO `x2_cityarea` VALUES (230321, '230321', '鸡东县', '230300');
INSERT INTO `x2_cityarea` VALUES (230381, '230381', '虎林市', '230300');
INSERT INTO `x2_cityarea` VALUES (230382, '230382', '密山市', '230300');
INSERT INTO `x2_cityarea` VALUES (230401, '230401', '市辖区', '230400');
INSERT INTO `x2_cityarea` VALUES (230402, '230402', '向阳区', '230400');
INSERT INTO `x2_cityarea` VALUES (230403, '230403', '工农区', '230400');
INSERT INTO `x2_cityarea` VALUES (230404, '230404', '南山区', '230400');
INSERT INTO `x2_cityarea` VALUES (230405, '230405', '兴安区', '230400');
INSERT INTO `x2_cityarea` VALUES (230406, '230406', '东山区', '230400');
INSERT INTO `x2_cityarea` VALUES (230407, '230407', '兴山区', '230400');
INSERT INTO `x2_cityarea` VALUES (230421, '230421', '萝北县', '230400');
INSERT INTO `x2_cityarea` VALUES (230422, '230422', '绥滨县', '230400');
INSERT INTO `x2_cityarea` VALUES (230501, '230501', '市辖区', '230500');
INSERT INTO `x2_cityarea` VALUES (230502, '230502', '尖山区', '230500');
INSERT INTO `x2_cityarea` VALUES (230503, '230503', '岭东区', '230500');
INSERT INTO `x2_cityarea` VALUES (230505, '230505', '四方台区', '230500');
INSERT INTO `x2_cityarea` VALUES (230506, '230506', '宝山区', '230500');
INSERT INTO `x2_cityarea` VALUES (230521, '230521', '集贤县', '230500');
INSERT INTO `x2_cityarea` VALUES (230522, '230522', '友谊县', '230500');
INSERT INTO `x2_cityarea` VALUES (230523, '230523', '宝清县', '230500');
INSERT INTO `x2_cityarea` VALUES (230524, '230524', '饶河县', '230500');
INSERT INTO `x2_cityarea` VALUES (230601, '230601', '市辖区', '230600');
INSERT INTO `x2_cityarea` VALUES (230602, '230602', '萨尔图区', '230600');
INSERT INTO `x2_cityarea` VALUES (230603, '230603', '龙凤区', '230600');
INSERT INTO `x2_cityarea` VALUES (230604, '230604', '让胡路区', '230600');
INSERT INTO `x2_cityarea` VALUES (230605, '230605', '红岗区', '230600');
INSERT INTO `x2_cityarea` VALUES (230606, '230606', '大同区', '230600');
INSERT INTO `x2_cityarea` VALUES (230621, '230621', '肇州县', '230600');
INSERT INTO `x2_cityarea` VALUES (230622, '230622', '肇源县', '230600');
INSERT INTO `x2_cityarea` VALUES (230623, '230623', '林甸县', '230600');
INSERT INTO `x2_cityarea` VALUES (230624, '230624', '杜尔伯特蒙古族自治县', '230600');
INSERT INTO `x2_cityarea` VALUES (230701, '230701', '市辖区', '230700');
INSERT INTO `x2_cityarea` VALUES (230702, '230702', '伊春区', '230700');
INSERT INTO `x2_cityarea` VALUES (230703, '230703', '南岔区', '230700');
INSERT INTO `x2_cityarea` VALUES (230704, '230704', '友好区', '230700');
INSERT INTO `x2_cityarea` VALUES (230705, '230705', '西林区', '230700');
INSERT INTO `x2_cityarea` VALUES (230706, '230706', '翠峦区', '230700');
INSERT INTO `x2_cityarea` VALUES (230707, '230707', '新青区', '230700');
INSERT INTO `x2_cityarea` VALUES (230708, '230708', '美溪区', '230700');
INSERT INTO `x2_cityarea` VALUES (230709, '230709', '金山屯区', '230700');
INSERT INTO `x2_cityarea` VALUES (230710, '230710', '五营区', '230700');
INSERT INTO `x2_cityarea` VALUES (230711, '230711', '乌马河区', '230700');
INSERT INTO `x2_cityarea` VALUES (230712, '230712', '汤旺河区', '230700');
INSERT INTO `x2_cityarea` VALUES (230713, '230713', '带岭区', '230700');
INSERT INTO `x2_cityarea` VALUES (230714, '230714', '乌伊岭区', '230700');
INSERT INTO `x2_cityarea` VALUES (230715, '230715', '红星区', '230700');
INSERT INTO `x2_cityarea` VALUES (230716, '230716', '上甘岭区', '230700');
INSERT INTO `x2_cityarea` VALUES (230722, '230722', '嘉荫县', '230700');
INSERT INTO `x2_cityarea` VALUES (230781, '230781', '铁力市', '230700');
INSERT INTO `x2_cityarea` VALUES (230801, '230801', '市辖区', '230800');
INSERT INTO `x2_cityarea` VALUES (230802, '230802', '永红区', '230800');
INSERT INTO `x2_cityarea` VALUES (230803, '230803', '向阳区', '230800');
INSERT INTO `x2_cityarea` VALUES (230804, '230804', '前进区', '230800');
INSERT INTO `x2_cityarea` VALUES (230805, '230805', '东风区', '230800');
INSERT INTO `x2_cityarea` VALUES (230811, '230811', '郊　区', '230800');
INSERT INTO `x2_cityarea` VALUES (230822, '230822', '桦南县', '230800');
INSERT INTO `x2_cityarea` VALUES (230826, '230826', '桦川县', '230800');
INSERT INTO `x2_cityarea` VALUES (230828, '230828', '汤原县', '230800');
INSERT INTO `x2_cityarea` VALUES (230833, '230833', '抚远县', '230800');
INSERT INTO `x2_cityarea` VALUES (230881, '230881', '同江市', '230800');
INSERT INTO `x2_cityarea` VALUES (230882, '230882', '富锦市', '230800');
INSERT INTO `x2_cityarea` VALUES (230901, '230901', '市辖区', '230900');
INSERT INTO `x2_cityarea` VALUES (230902, '230902', '新兴区', '230900');
INSERT INTO `x2_cityarea` VALUES (230903, '230903', '桃山区', '230900');
INSERT INTO `x2_cityarea` VALUES (230904, '230904', '茄子河区', '230900');
INSERT INTO `x2_cityarea` VALUES (230921, '230921', '勃利县', '230900');
INSERT INTO `x2_cityarea` VALUES (231001, '231001', '市辖区', '231000');
INSERT INTO `x2_cityarea` VALUES (231002, '231002', '东安区', '231000');
INSERT INTO `x2_cityarea` VALUES (231003, '231003', '阳明区', '231000');
INSERT INTO `x2_cityarea` VALUES (231004, '231004', '爱民区', '231000');
INSERT INTO `x2_cityarea` VALUES (231005, '231005', '西安区', '231000');
INSERT INTO `x2_cityarea` VALUES (231024, '231024', '东宁县', '231000');
INSERT INTO `x2_cityarea` VALUES (231025, '231025', '林口县', '231000');
INSERT INTO `x2_cityarea` VALUES (231081, '231081', '绥芬河市', '231000');
INSERT INTO `x2_cityarea` VALUES (231083, '231083', '海林市', '231000');
INSERT INTO `x2_cityarea` VALUES (231084, '231084', '宁安市', '231000');
INSERT INTO `x2_cityarea` VALUES (231085, '231085', '穆棱市', '231000');
INSERT INTO `x2_cityarea` VALUES (231101, '231101', '市辖区', '231100');
INSERT INTO `x2_cityarea` VALUES (231102, '231102', '爱辉区', '231100');
INSERT INTO `x2_cityarea` VALUES (231121, '231121', '嫩江县', '231100');
INSERT INTO `x2_cityarea` VALUES (231123, '231123', '逊克县', '231100');
INSERT INTO `x2_cityarea` VALUES (231124, '231124', '孙吴县', '231100');
INSERT INTO `x2_cityarea` VALUES (231181, '231181', '北安市', '231100');
INSERT INTO `x2_cityarea` VALUES (231182, '231182', '五大连池市', '231100');
INSERT INTO `x2_cityarea` VALUES (231201, '231201', '市辖区', '231200');
INSERT INTO `x2_cityarea` VALUES (231202, '231202', '北林区', '231200');
INSERT INTO `x2_cityarea` VALUES (231221, '231221', '望奎县', '231200');
INSERT INTO `x2_cityarea` VALUES (231222, '231222', '兰西县', '231200');
INSERT INTO `x2_cityarea` VALUES (231223, '231223', '青冈县', '231200');
INSERT INTO `x2_cityarea` VALUES (231224, '231224', '庆安县', '231200');
INSERT INTO `x2_cityarea` VALUES (231225, '231225', '明水县', '231200');
INSERT INTO `x2_cityarea` VALUES (231226, '231226', '绥棱县', '231200');
INSERT INTO `x2_cityarea` VALUES (231281, '231281', '安达市', '231200');
INSERT INTO `x2_cityarea` VALUES (231282, '231282', '肇东市', '231200');
INSERT INTO `x2_cityarea` VALUES (231283, '231283', '海伦市', '231200');
INSERT INTO `x2_cityarea` VALUES (232721, '232721', '呼玛县', '232700');
INSERT INTO `x2_cityarea` VALUES (232722, '232722', '塔河县', '232700');
INSERT INTO `x2_cityarea` VALUES (232723, '232723', '漠河县', '232700');
INSERT INTO `x2_cityarea` VALUES (310101, '310101', '黄浦区', '310100');
INSERT INTO `x2_cityarea` VALUES (310103, '310103', '卢湾区', '310100');
INSERT INTO `x2_cityarea` VALUES (310104, '310104', '徐汇区', '310100');
INSERT INTO `x2_cityarea` VALUES (310105, '310105', '长宁区', '310100');
INSERT INTO `x2_cityarea` VALUES (310106, '310106', '静安区', '310100');
INSERT INTO `x2_cityarea` VALUES (310107, '310107', '普陀区', '310100');
INSERT INTO `x2_cityarea` VALUES (310108, '310108', '闸北区', '310100');
INSERT INTO `x2_cityarea` VALUES (310109, '310109', '虹口区', '310100');
INSERT INTO `x2_cityarea` VALUES (310110, '310110', '杨浦区', '310100');
INSERT INTO `x2_cityarea` VALUES (310112, '310112', '闵行区', '310100');
INSERT INTO `x2_cityarea` VALUES (310113, '310113', '宝山区', '310100');
INSERT INTO `x2_cityarea` VALUES (310114, '310114', '嘉定区', '310100');
INSERT INTO `x2_cityarea` VALUES (310115, '310115', '浦东新区', '310100');
INSERT INTO `x2_cityarea` VALUES (310116, '310116', '金山区', '310100');
INSERT INTO `x2_cityarea` VALUES (310117, '310117', '松江区', '310100');
INSERT INTO `x2_cityarea` VALUES (310118, '310118', '青浦区', '310100');
INSERT INTO `x2_cityarea` VALUES (310119, '310119', '南汇区', '310100');
INSERT INTO `x2_cityarea` VALUES (310120, '310120', '奉贤区', '310100');
INSERT INTO `x2_cityarea` VALUES (310230, '310230', '崇明县', '310200');
INSERT INTO `x2_cityarea` VALUES (320101, '320101', '市辖区', '320100');
INSERT INTO `x2_cityarea` VALUES (320102, '320102', '玄武区', '320100');
INSERT INTO `x2_cityarea` VALUES (320103, '320103', '白下区', '320100');
INSERT INTO `x2_cityarea` VALUES (320104, '320104', '秦淮区', '320100');
INSERT INTO `x2_cityarea` VALUES (320105, '320105', '建邺区', '320100');
INSERT INTO `x2_cityarea` VALUES (320106, '320106', '鼓楼区', '320100');
INSERT INTO `x2_cityarea` VALUES (320107, '320107', '下关区', '320100');
INSERT INTO `x2_cityarea` VALUES (320111, '320111', '浦口区', '320100');
INSERT INTO `x2_cityarea` VALUES (320113, '320113', '栖霞区', '320100');
INSERT INTO `x2_cityarea` VALUES (320114, '320114', '雨花台区', '320100');
INSERT INTO `x2_cityarea` VALUES (320115, '320115', '江宁区', '320100');
INSERT INTO `x2_cityarea` VALUES (320116, '320116', '六合区', '320100');
INSERT INTO `x2_cityarea` VALUES (320124, '320124', '溧水县', '320100');
INSERT INTO `x2_cityarea` VALUES (320125, '320125', '高淳县', '320100');
INSERT INTO `x2_cityarea` VALUES (320201, '320201', '市辖区', '320200');
INSERT INTO `x2_cityarea` VALUES (320202, '320202', '崇安区', '320200');
INSERT INTO `x2_cityarea` VALUES (320203, '320203', '南长区', '320200');
INSERT INTO `x2_cityarea` VALUES (320204, '320204', '北塘区', '320200');
INSERT INTO `x2_cityarea` VALUES (320205, '320205', '锡山区', '320200');
INSERT INTO `x2_cityarea` VALUES (320206, '320206', '惠山区', '320200');
INSERT INTO `x2_cityarea` VALUES (320211, '320211', '滨湖区', '320200');
INSERT INTO `x2_cityarea` VALUES (320281, '320281', '江阴市', '320200');
INSERT INTO `x2_cityarea` VALUES (320282, '320282', '宜兴市', '320200');
INSERT INTO `x2_cityarea` VALUES (320301, '320301', '市辖区', '320300');
INSERT INTO `x2_cityarea` VALUES (320302, '320302', '鼓楼区', '320300');
INSERT INTO `x2_cityarea` VALUES (320303, '320303', '云龙区', '320300');
INSERT INTO `x2_cityarea` VALUES (320304, '320304', '九里区', '320300');
INSERT INTO `x2_cityarea` VALUES (320305, '320305', '贾汪区', '320300');
INSERT INTO `x2_cityarea` VALUES (320311, '320311', '泉山区', '320300');
INSERT INTO `x2_cityarea` VALUES (320321, '320321', '丰　县', '320300');
INSERT INTO `x2_cityarea` VALUES (320322, '320322', '沛　县', '320300');
INSERT INTO `x2_cityarea` VALUES (320323, '320323', '铜山县', '320300');
INSERT INTO `x2_cityarea` VALUES (320324, '320324', '睢宁县', '320300');
INSERT INTO `x2_cityarea` VALUES (320381, '320381', '新沂市', '320300');
INSERT INTO `x2_cityarea` VALUES (320382, '320382', '邳州市', '320300');
INSERT INTO `x2_cityarea` VALUES (320401, '320401', '市辖区', '320400');
INSERT INTO `x2_cityarea` VALUES (320402, '320402', '天宁区', '320400');
INSERT INTO `x2_cityarea` VALUES (320404, '320404', '钟楼区', '320400');
INSERT INTO `x2_cityarea` VALUES (320405, '320405', '戚墅堰区', '320400');
INSERT INTO `x2_cityarea` VALUES (320411, '320411', '新北区', '320400');
INSERT INTO `x2_cityarea` VALUES (320412, '320412', '武进区', '320400');
INSERT INTO `x2_cityarea` VALUES (320481, '320481', '溧阳市', '320400');
INSERT INTO `x2_cityarea` VALUES (320482, '320482', '金坛市', '320400');
INSERT INTO `x2_cityarea` VALUES (320501, '320501', '市辖区', '320500');
INSERT INTO `x2_cityarea` VALUES (320502, '320502', '沧浪区', '320500');
INSERT INTO `x2_cityarea` VALUES (320503, '320503', '平江区', '320500');
INSERT INTO `x2_cityarea` VALUES (320504, '320504', '金阊区', '320500');
INSERT INTO `x2_cityarea` VALUES (320505, '320505', '虎丘区', '320500');
INSERT INTO `x2_cityarea` VALUES (320506, '320506', '吴中区', '320500');
INSERT INTO `x2_cityarea` VALUES (320507, '320507', '相城区', '320500');
INSERT INTO `x2_cityarea` VALUES (320581, '320581', '常熟市', '320500');
INSERT INTO `x2_cityarea` VALUES (320582, '320582', '张家港市', '320500');
INSERT INTO `x2_cityarea` VALUES (320583, '320583', '昆山市', '320500');
INSERT INTO `x2_cityarea` VALUES (320584, '320584', '吴江市', '320500');
INSERT INTO `x2_cityarea` VALUES (320585, '320585', '太仓市', '320500');
INSERT INTO `x2_cityarea` VALUES (320601, '320601', '市辖区', '320600');
INSERT INTO `x2_cityarea` VALUES (320602, '320602', '崇川区', '320600');
INSERT INTO `x2_cityarea` VALUES (320611, '320611', '港闸区', '320600');
INSERT INTO `x2_cityarea` VALUES (320621, '320621', '海安县', '320600');
INSERT INTO `x2_cityarea` VALUES (320623, '320623', '如东县', '320600');
INSERT INTO `x2_cityarea` VALUES (320681, '320681', '启东市', '320600');
INSERT INTO `x2_cityarea` VALUES (320682, '320682', '如皋市', '320600');
INSERT INTO `x2_cityarea` VALUES (320683, '320683', '通州市', '320600');
INSERT INTO `x2_cityarea` VALUES (320684, '320684', '海门市', '320600');
INSERT INTO `x2_cityarea` VALUES (320701, '320701', '市辖区', '320700');
INSERT INTO `x2_cityarea` VALUES (320703, '320703', '连云区', '320700');
INSERT INTO `x2_cityarea` VALUES (320705, '320705', '新浦区', '320700');
INSERT INTO `x2_cityarea` VALUES (320706, '320706', '海州区', '320700');
INSERT INTO `x2_cityarea` VALUES (320721, '320721', '赣榆县', '320700');
INSERT INTO `x2_cityarea` VALUES (320722, '320722', '东海县', '320700');
INSERT INTO `x2_cityarea` VALUES (320723, '320723', '灌云县', '320700');
INSERT INTO `x2_cityarea` VALUES (320724, '320724', '灌南县', '320700');
INSERT INTO `x2_cityarea` VALUES (320801, '320801', '市辖区', '320800');
INSERT INTO `x2_cityarea` VALUES (320802, '320802', '清河区', '320800');
INSERT INTO `x2_cityarea` VALUES (320803, '320803', '楚州区', '320800');
INSERT INTO `x2_cityarea` VALUES (320804, '320804', '淮阴区', '320800');
INSERT INTO `x2_cityarea` VALUES (320811, '320811', '清浦区', '320800');
INSERT INTO `x2_cityarea` VALUES (320826, '320826', '涟水县', '320800');
INSERT INTO `x2_cityarea` VALUES (320829, '320829', '洪泽县', '320800');
INSERT INTO `x2_cityarea` VALUES (320830, '320830', '盱眙县', '320800');
INSERT INTO `x2_cityarea` VALUES (320831, '320831', '金湖县', '320800');
INSERT INTO `x2_cityarea` VALUES (320901, '320901', '市辖区', '320900');
INSERT INTO `x2_cityarea` VALUES (320902, '320902', '亭湖区', '320900');
INSERT INTO `x2_cityarea` VALUES (320903, '320903', '盐都区', '320900');
INSERT INTO `x2_cityarea` VALUES (320921, '320921', '响水县', '320900');
INSERT INTO `x2_cityarea` VALUES (320922, '320922', '滨海县', '320900');
INSERT INTO `x2_cityarea` VALUES (320923, '320923', '阜宁县', '320900');
INSERT INTO `x2_cityarea` VALUES (320924, '320924', '射阳县', '320900');
INSERT INTO `x2_cityarea` VALUES (320925, '320925', '建湖县', '320900');
INSERT INTO `x2_cityarea` VALUES (320981, '320981', '东台市', '320900');
INSERT INTO `x2_cityarea` VALUES (320982, '320982', '大丰市', '320900');
INSERT INTO `x2_cityarea` VALUES (321001, '321001', '市辖区', '321000');
INSERT INTO `x2_cityarea` VALUES (321002, '321002', '广陵区', '321000');
INSERT INTO `x2_cityarea` VALUES (321003, '321003', '邗江区', '321000');
INSERT INTO `x2_cityarea` VALUES (321011, '321011', '维扬区', '321000');
INSERT INTO `x2_cityarea` VALUES (321023, '321023', '宝应县', '321000');
INSERT INTO `x2_cityarea` VALUES (321081, '321081', '仪征市', '321000');
INSERT INTO `x2_cityarea` VALUES (321084, '321084', '高邮市', '321000');
INSERT INTO `x2_cityarea` VALUES (321088, '321088', '江都市', '321000');
INSERT INTO `x2_cityarea` VALUES (321101, '321101', '市区', '321100');
INSERT INTO `x2_cityarea` VALUES (321102, '321102', '京口区', '321100');
INSERT INTO `x2_cityarea` VALUES (321111, '321111', '润州区', '321100');
INSERT INTO `x2_cityarea` VALUES (321112, '321112', '丹徒区', '321100');
INSERT INTO `x2_cityarea` VALUES (321181, '321181', '丹阳市', '321100');
INSERT INTO `x2_cityarea` VALUES (321182, '321182', '扬中市', '321100');
INSERT INTO `x2_cityarea` VALUES (321183, '321183', '句容市', '321100');
INSERT INTO `x2_cityarea` VALUES (321201, '321201', '市辖区', '321200');
INSERT INTO `x2_cityarea` VALUES (321202, '321202', '海陵区', '321200');
INSERT INTO `x2_cityarea` VALUES (321203, '321203', '高港区', '321200');
INSERT INTO `x2_cityarea` VALUES (321281, '321281', '兴化市', '321200');
INSERT INTO `x2_cityarea` VALUES (321282, '321282', '靖江市', '321200');
INSERT INTO `x2_cityarea` VALUES (321283, '321283', '泰兴市', '321200');
INSERT INTO `x2_cityarea` VALUES (321284, '321284', '姜堰市', '321200');
INSERT INTO `x2_cityarea` VALUES (321301, '321301', '市辖区', '321300');
INSERT INTO `x2_cityarea` VALUES (321302, '321302', '宿城区', '321300');
INSERT INTO `x2_cityarea` VALUES (321311, '321311', '宿豫区', '321300');
INSERT INTO `x2_cityarea` VALUES (321322, '321322', '沭阳县', '321300');
INSERT INTO `x2_cityarea` VALUES (321323, '321323', '泗阳县', '321300');
INSERT INTO `x2_cityarea` VALUES (321324, '321324', '泗洪县', '321300');
INSERT INTO `x2_cityarea` VALUES (330101, '330101', '市辖区', '330100');
INSERT INTO `x2_cityarea` VALUES (330102, '330102', '上城区', '330100');
INSERT INTO `x2_cityarea` VALUES (330103, '330103', '下城区', '330100');
INSERT INTO `x2_cityarea` VALUES (330104, '330104', '江干区', '330100');
INSERT INTO `x2_cityarea` VALUES (330105, '330105', '拱墅区', '330100');
INSERT INTO `x2_cityarea` VALUES (330106, '330106', '西湖区', '330100');
INSERT INTO `x2_cityarea` VALUES (330108, '330108', '滨江区', '330100');
INSERT INTO `x2_cityarea` VALUES (330109, '330109', '萧山区', '330100');
INSERT INTO `x2_cityarea` VALUES (330110, '330110', '余杭区', '330100');
INSERT INTO `x2_cityarea` VALUES (330122, '330122', '桐庐县', '330100');
INSERT INTO `x2_cityarea` VALUES (330127, '330127', '淳安县', '330100');
INSERT INTO `x2_cityarea` VALUES (330182, '330182', '建德市', '330100');
INSERT INTO `x2_cityarea` VALUES (330183, '330183', '富阳市', '330100');
INSERT INTO `x2_cityarea` VALUES (330185, '330185', '临安市', '330100');
INSERT INTO `x2_cityarea` VALUES (330201, '330201', '市辖区', '330200');
INSERT INTO `x2_cityarea` VALUES (330203, '330203', '海曙区', '330200');
INSERT INTO `x2_cityarea` VALUES (330204, '330204', '江东区', '330200');
INSERT INTO `x2_cityarea` VALUES (330205, '330205', '江北区', '330200');
INSERT INTO `x2_cityarea` VALUES (330206, '330206', '北仑区', '330200');
INSERT INTO `x2_cityarea` VALUES (330211, '330211', '镇海区', '330200');
INSERT INTO `x2_cityarea` VALUES (330212, '330212', '鄞州区', '330200');
INSERT INTO `x2_cityarea` VALUES (330225, '330225', '象山县', '330200');
INSERT INTO `x2_cityarea` VALUES (330226, '330226', '宁海县', '330200');
INSERT INTO `x2_cityarea` VALUES (330281, '330281', '余姚市', '330200');
INSERT INTO `x2_cityarea` VALUES (330282, '330282', '慈溪市', '330200');
INSERT INTO `x2_cityarea` VALUES (330283, '330283', '奉化市', '330200');
INSERT INTO `x2_cityarea` VALUES (330301, '330301', '市辖区', '330300');
INSERT INTO `x2_cityarea` VALUES (330302, '330302', '鹿城区', '330300');
INSERT INTO `x2_cityarea` VALUES (330303, '330303', '龙湾区', '330300');
INSERT INTO `x2_cityarea` VALUES (330304, '330304', '瓯海区', '330300');
INSERT INTO `x2_cityarea` VALUES (330322, '330322', '洞头县', '330300');
INSERT INTO `x2_cityarea` VALUES (330324, '330324', '永嘉县', '330300');
INSERT INTO `x2_cityarea` VALUES (330326, '330326', '平阳县', '330300');
INSERT INTO `x2_cityarea` VALUES (330327, '330327', '苍南县', '330300');
INSERT INTO `x2_cityarea` VALUES (330328, '330328', '文成县', '330300');
INSERT INTO `x2_cityarea` VALUES (330329, '330329', '泰顺县', '330300');
INSERT INTO `x2_cityarea` VALUES (330381, '330381', '瑞安市', '330300');
INSERT INTO `x2_cityarea` VALUES (330382, '330382', '乐清市', '330300');
INSERT INTO `x2_cityarea` VALUES (330401, '330401', '市辖区', '330400');
INSERT INTO `x2_cityarea` VALUES (330402, '330402', '南湖区', '330400');
INSERT INTO `x2_cityarea` VALUES (330411, '330411', '秀洲区', '330400');
INSERT INTO `x2_cityarea` VALUES (330421, '330421', '嘉善县', '330400');
INSERT INTO `x2_cityarea` VALUES (330424, '330424', '海盐县', '330400');
INSERT INTO `x2_cityarea` VALUES (330481, '330481', '海宁市', '330400');
INSERT INTO `x2_cityarea` VALUES (330482, '330482', '平湖市', '330400');
INSERT INTO `x2_cityarea` VALUES (330483, '330483', '桐乡市', '330400');
INSERT INTO `x2_cityarea` VALUES (330501, '330501', '市辖区', '330500');
INSERT INTO `x2_cityarea` VALUES (330502, '330502', '吴兴区', '330500');
INSERT INTO `x2_cityarea` VALUES (330503, '330503', '南浔区', '330500');
INSERT INTO `x2_cityarea` VALUES (330521, '330521', '德清县', '330500');
INSERT INTO `x2_cityarea` VALUES (330522, '330522', '长兴县', '330500');
INSERT INTO `x2_cityarea` VALUES (330523, '330523', '安吉县', '330500');
INSERT INTO `x2_cityarea` VALUES (330601, '330601', '市辖区', '330600');
INSERT INTO `x2_cityarea` VALUES (330602, '330602', '越城区', '330600');
INSERT INTO `x2_cityarea` VALUES (330621, '330621', '绍兴县', '330600');
INSERT INTO `x2_cityarea` VALUES (330624, '330624', '新昌县', '330600');
INSERT INTO `x2_cityarea` VALUES (330681, '330681', '诸暨市', '330600');
INSERT INTO `x2_cityarea` VALUES (330682, '330682', '上虞市', '330600');
INSERT INTO `x2_cityarea` VALUES (330683, '330683', '嵊州市', '330600');
INSERT INTO `x2_cityarea` VALUES (330701, '330701', '市辖区', '330700');
INSERT INTO `x2_cityarea` VALUES (330702, '330702', '婺城区', '330700');
INSERT INTO `x2_cityarea` VALUES (330703, '330703', '金东区', '330700');
INSERT INTO `x2_cityarea` VALUES (330723, '330723', '武义县', '330700');
INSERT INTO `x2_cityarea` VALUES (330726, '330726', '浦江县', '330700');
INSERT INTO `x2_cityarea` VALUES (330727, '330727', '磐安县', '330700');
INSERT INTO `x2_cityarea` VALUES (330781, '330781', '兰溪市', '330700');
INSERT INTO `x2_cityarea` VALUES (330782, '330782', '义乌市', '330700');
INSERT INTO `x2_cityarea` VALUES (330783, '330783', '东阳市', '330700');
INSERT INTO `x2_cityarea` VALUES (330784, '330784', '永康市', '330700');
INSERT INTO `x2_cityarea` VALUES (330801, '330801', '市辖区', '330800');
INSERT INTO `x2_cityarea` VALUES (330802, '330802', '柯城区', '330800');
INSERT INTO `x2_cityarea` VALUES (330803, '330803', '衢江区', '330800');
INSERT INTO `x2_cityarea` VALUES (330822, '330822', '常山县', '330800');
INSERT INTO `x2_cityarea` VALUES (330824, '330824', '开化县', '330800');
INSERT INTO `x2_cityarea` VALUES (330825, '330825', '龙游县', '330800');
INSERT INTO `x2_cityarea` VALUES (330881, '330881', '江山市', '330800');
INSERT INTO `x2_cityarea` VALUES (330901, '330901', '市辖区', '330900');
INSERT INTO `x2_cityarea` VALUES (330902, '330902', '定海区', '330900');
INSERT INTO `x2_cityarea` VALUES (330903, '330903', '普陀区', '330900');
INSERT INTO `x2_cityarea` VALUES (330921, '330921', '岱山县', '330900');
INSERT INTO `x2_cityarea` VALUES (330922, '330922', '嵊泗县', '330900');
INSERT INTO `x2_cityarea` VALUES (331001, '331001', '市辖区', '331000');
INSERT INTO `x2_cityarea` VALUES (331002, '331002', '椒江区', '331000');
INSERT INTO `x2_cityarea` VALUES (331003, '331003', '黄岩区', '331000');
INSERT INTO `x2_cityarea` VALUES (331004, '331004', '路桥区', '331000');
INSERT INTO `x2_cityarea` VALUES (331021, '331021', '玉环县', '331000');
INSERT INTO `x2_cityarea` VALUES (331022, '331022', '三门县', '331000');
INSERT INTO `x2_cityarea` VALUES (331023, '331023', '天台县', '331000');
INSERT INTO `x2_cityarea` VALUES (331024, '331024', '仙居县', '331000');
INSERT INTO `x2_cityarea` VALUES (331081, '331081', '温岭市', '331000');
INSERT INTO `x2_cityarea` VALUES (331082, '331082', '临海市', '331000');
INSERT INTO `x2_cityarea` VALUES (331101, '331101', '市辖区', '331100');
INSERT INTO `x2_cityarea` VALUES (331102, '331102', '莲都区', '331100');
INSERT INTO `x2_cityarea` VALUES (331121, '331121', '青田县', '331100');
INSERT INTO `x2_cityarea` VALUES (331122, '331122', '缙云县', '331100');
INSERT INTO `x2_cityarea` VALUES (331123, '331123', '遂昌县', '331100');
INSERT INTO `x2_cityarea` VALUES (331124, '331124', '松阳县', '331100');
INSERT INTO `x2_cityarea` VALUES (331125, '331125', '云和县', '331100');
INSERT INTO `x2_cityarea` VALUES (331126, '331126', '庆元县', '331100');
INSERT INTO `x2_cityarea` VALUES (331127, '331127', '景宁畲族自治县', '331100');
INSERT INTO `x2_cityarea` VALUES (331181, '331181', '龙泉市', '331100');
INSERT INTO `x2_cityarea` VALUES (340101, '340101', '市辖区', '340100');
INSERT INTO `x2_cityarea` VALUES (340102, '340102', '瑶海区', '340100');
INSERT INTO `x2_cityarea` VALUES (340103, '340103', '庐阳区', '340100');
INSERT INTO `x2_cityarea` VALUES (340104, '340104', '蜀山区', '340100');
INSERT INTO `x2_cityarea` VALUES (340111, '340111', '包河区', '340100');
INSERT INTO `x2_cityarea` VALUES (340121, '340121', '长丰县', '340100');
INSERT INTO `x2_cityarea` VALUES (340122, '340122', '肥东县', '340100');
INSERT INTO `x2_cityarea` VALUES (340123, '340123', '肥西县', '340100');
INSERT INTO `x2_cityarea` VALUES (340201, '340201', '市辖区', '340200');
INSERT INTO `x2_cityarea` VALUES (340202, '340202', '镜湖区', '340200');
INSERT INTO `x2_cityarea` VALUES (340203, '340203', '弋江区', '340200');
INSERT INTO `x2_cityarea` VALUES (340204, '340204', '新芜区', '340200');
INSERT INTO `x2_cityarea` VALUES (340207, '340207', '鸠江区', '340200');
INSERT INTO `x2_cityarea` VALUES (340221, '340221', '芜湖县', '340200');
INSERT INTO `x2_cityarea` VALUES (340222, '340222', '繁昌县', '340200');
INSERT INTO `x2_cityarea` VALUES (340223, '340223', '南陵县', '340200');
INSERT INTO `x2_cityarea` VALUES (340301, '340301', '市辖区', '340300');
INSERT INTO `x2_cityarea` VALUES (340302, '340302', '龙子湖区', '340300');
INSERT INTO `x2_cityarea` VALUES (340303, '340303', '蚌山区', '340300');
INSERT INTO `x2_cityarea` VALUES (340304, '340304', '禹会区', '340300');
INSERT INTO `x2_cityarea` VALUES (340311, '340311', '淮上区', '340300');
INSERT INTO `x2_cityarea` VALUES (340321, '340321', '怀远县', '340300');
INSERT INTO `x2_cityarea` VALUES (340322, '340322', '五河县', '340300');
INSERT INTO `x2_cityarea` VALUES (340323, '340323', '固镇县', '340300');
INSERT INTO `x2_cityarea` VALUES (340401, '340401', '市辖区', '340400');
INSERT INTO `x2_cityarea` VALUES (340402, '340402', '大通区', '340400');
INSERT INTO `x2_cityarea` VALUES (340403, '340403', '田家庵区', '340400');
INSERT INTO `x2_cityarea` VALUES (340404, '340404', '谢家集区', '340400');
INSERT INTO `x2_cityarea` VALUES (340405, '340405', '八公山区', '340400');
INSERT INTO `x2_cityarea` VALUES (340406, '340406', '潘集区', '340400');
INSERT INTO `x2_cityarea` VALUES (340421, '340421', '凤台县', '340400');
INSERT INTO `x2_cityarea` VALUES (340501, '340501', '市辖区', '340500');
INSERT INTO `x2_cityarea` VALUES (340502, '340502', '金家庄区', '340500');
INSERT INTO `x2_cityarea` VALUES (340503, '340503', '花山区', '340500');
INSERT INTO `x2_cityarea` VALUES (340504, '340504', '雨山区', '340500');
INSERT INTO `x2_cityarea` VALUES (340521, '340521', '当涂县', '340500');
INSERT INTO `x2_cityarea` VALUES (340601, '340601', '市辖区', '340600');
INSERT INTO `x2_cityarea` VALUES (340602, '340602', '杜集区', '340600');
INSERT INTO `x2_cityarea` VALUES (340603, '340603', '相山区', '340600');
INSERT INTO `x2_cityarea` VALUES (340604, '340604', '烈山区', '340600');
INSERT INTO `x2_cityarea` VALUES (340621, '340621', '濉溪县', '340600');
INSERT INTO `x2_cityarea` VALUES (340701, '340701', '市辖区', '340700');
INSERT INTO `x2_cityarea` VALUES (340702, '340702', '铜官山区', '340700');
INSERT INTO `x2_cityarea` VALUES (340703, '340703', '狮子山区', '340700');
INSERT INTO `x2_cityarea` VALUES (340711, '340711', '铜陵市郊区', '340700');
INSERT INTO `x2_cityarea` VALUES (340721, '340721', '铜陵县', '340700');
INSERT INTO `x2_cityarea` VALUES (340801, '340801', '市辖区', '340800');
INSERT INTO `x2_cityarea` VALUES (340802, '340802', '迎江区', '340800');
INSERT INTO `x2_cityarea` VALUES (340803, '340803', '大观区', '340800');
INSERT INTO `x2_cityarea` VALUES (340811, '340811', '宜秀区', '340800');
INSERT INTO `x2_cityarea` VALUES (340822, '340822', '怀宁县', '340800');
INSERT INTO `x2_cityarea` VALUES (340823, '340823', '枞阳县', '340800');
INSERT INTO `x2_cityarea` VALUES (340824, '340824', '潜山县', '340800');
INSERT INTO `x2_cityarea` VALUES (340825, '340825', '太湖县', '340800');
INSERT INTO `x2_cityarea` VALUES (340826, '340826', '宿松县', '340800');
INSERT INTO `x2_cityarea` VALUES (340827, '340827', '望江县', '340800');
INSERT INTO `x2_cityarea` VALUES (340828, '340828', '岳西县', '340800');
INSERT INTO `x2_cityarea` VALUES (340881, '340881', '桐城市', '340800');
INSERT INTO `x2_cityarea` VALUES (341001, '341001', '市辖区', '341000');
INSERT INTO `x2_cityarea` VALUES (341002, '341002', '屯溪区', '341000');
INSERT INTO `x2_cityarea` VALUES (341003, '341003', '黄山区', '341000');
INSERT INTO `x2_cityarea` VALUES (341004, '341004', '徽州区', '341000');
INSERT INTO `x2_cityarea` VALUES (341021, '341021', '歙　县', '341000');
INSERT INTO `x2_cityarea` VALUES (341022, '341022', '休宁县', '341000');
INSERT INTO `x2_cityarea` VALUES (341023, '341023', '黟　县', '341000');
INSERT INTO `x2_cityarea` VALUES (341024, '341024', '祁门县', '341000');
INSERT INTO `x2_cityarea` VALUES (341101, '341101', '市辖区', '341100');
INSERT INTO `x2_cityarea` VALUES (341102, '341102', '琅琊区', '341100');
INSERT INTO `x2_cityarea` VALUES (341103, '341103', '南谯区', '341100');
INSERT INTO `x2_cityarea` VALUES (341122, '341122', '来安县', '341100');
INSERT INTO `x2_cityarea` VALUES (341124, '341124', '全椒县', '341100');
INSERT INTO `x2_cityarea` VALUES (341125, '341125', '定远县', '341100');
INSERT INTO `x2_cityarea` VALUES (341126, '341126', '凤阳县', '341100');
INSERT INTO `x2_cityarea` VALUES (341181, '341181', '天长市', '341100');
INSERT INTO `x2_cityarea` VALUES (341182, '341182', '明光市', '341100');
INSERT INTO `x2_cityarea` VALUES (341201, '341201', '市辖区', '341200');
INSERT INTO `x2_cityarea` VALUES (341202, '341202', '颍州区', '341200');
INSERT INTO `x2_cityarea` VALUES (341203, '341203', '颍东区', '341200');
INSERT INTO `x2_cityarea` VALUES (341204, '341204', '颍泉区', '341200');
INSERT INTO `x2_cityarea` VALUES (341221, '341221', '临泉县', '341200');
INSERT INTO `x2_cityarea` VALUES (341222, '341222', '太和县', '341200');
INSERT INTO `x2_cityarea` VALUES (341225, '341225', '阜南县', '341200');
INSERT INTO `x2_cityarea` VALUES (341226, '341226', '颍上县', '341200');
INSERT INTO `x2_cityarea` VALUES (341282, '341282', '界首市', '341200');
INSERT INTO `x2_cityarea` VALUES (341301, '341301', '市辖区', '341300');
INSERT INTO `x2_cityarea` VALUES (341302, '341302', '墉桥区', '341300');
INSERT INTO `x2_cityarea` VALUES (341321, '341321', '砀山县', '341300');
INSERT INTO `x2_cityarea` VALUES (341322, '341322', '萧　县', '341300');
INSERT INTO `x2_cityarea` VALUES (341323, '341323', '灵璧县', '341300');
INSERT INTO `x2_cityarea` VALUES (341324, '341324', '泗　县', '341300');
INSERT INTO `x2_cityarea` VALUES (341401, '341401', '市辖区', '341400');
INSERT INTO `x2_cityarea` VALUES (341402, '341402', '居巢区', '341400');
INSERT INTO `x2_cityarea` VALUES (341421, '341421', '庐江县', '341400');
INSERT INTO `x2_cityarea` VALUES (341422, '341422', '无为县', '341400');
INSERT INTO `x2_cityarea` VALUES (341423, '341423', '含山县', '341400');
INSERT INTO `x2_cityarea` VALUES (341424, '341424', '和　县', '341400');
INSERT INTO `x2_cityarea` VALUES (341501, '341501', '市辖区', '341500');
INSERT INTO `x2_cityarea` VALUES (341502, '341502', '金安区', '341500');
INSERT INTO `x2_cityarea` VALUES (341503, '341503', '裕安区', '341500');
INSERT INTO `x2_cityarea` VALUES (341521, '341521', '寿　县', '341500');
INSERT INTO `x2_cityarea` VALUES (341522, '341522', '霍邱县', '341500');
INSERT INTO `x2_cityarea` VALUES (341523, '341523', '舒城县', '341500');
INSERT INTO `x2_cityarea` VALUES (341524, '341524', '金寨县', '341500');
INSERT INTO `x2_cityarea` VALUES (341525, '341525', '霍山县', '341500');
INSERT INTO `x2_cityarea` VALUES (341601, '341601', '市辖区', '341600');
INSERT INTO `x2_cityarea` VALUES (341602, '341602', '谯城区', '341600');
INSERT INTO `x2_cityarea` VALUES (341621, '341621', '涡阳县', '341600');
INSERT INTO `x2_cityarea` VALUES (341622, '341622', '蒙城县', '341600');
INSERT INTO `x2_cityarea` VALUES (341623, '341623', '利辛县', '341600');
INSERT INTO `x2_cityarea` VALUES (341701, '341701', '市辖区', '341700');
INSERT INTO `x2_cityarea` VALUES (341702, '341702', '贵池区', '341700');
INSERT INTO `x2_cityarea` VALUES (341721, '341721', '东至县', '341700');
INSERT INTO `x2_cityarea` VALUES (341722, '341722', '石台县', '341700');
INSERT INTO `x2_cityarea` VALUES (341723, '341723', '青阳县', '341700');
INSERT INTO `x2_cityarea` VALUES (341801, '341801', '市辖区', '341800');
INSERT INTO `x2_cityarea` VALUES (341802, '341802', '宣州区', '341800');
INSERT INTO `x2_cityarea` VALUES (341821, '341821', '郎溪县', '341800');
INSERT INTO `x2_cityarea` VALUES (341822, '341822', '广德县', '341800');
INSERT INTO `x2_cityarea` VALUES (341823, '341823', '泾　县', '341800');
INSERT INTO `x2_cityarea` VALUES (341824, '341824', '绩溪县', '341800');
INSERT INTO `x2_cityarea` VALUES (341825, '341825', '旌德县', '341800');
INSERT INTO `x2_cityarea` VALUES (341881, '341881', '宁国市', '341800');
INSERT INTO `x2_cityarea` VALUES (350101, '350101', '市辖区', '350100');
INSERT INTO `x2_cityarea` VALUES (350102, '350102', '鼓楼区', '350100');
INSERT INTO `x2_cityarea` VALUES (350103, '350103', '台江区', '350100');
INSERT INTO `x2_cityarea` VALUES (350104, '350104', '仓山区', '350100');
INSERT INTO `x2_cityarea` VALUES (350105, '350105', '马尾区', '350100');
INSERT INTO `x2_cityarea` VALUES (350111, '350111', '晋安区', '350100');
INSERT INTO `x2_cityarea` VALUES (350121, '350121', '闽侯县', '350100');
INSERT INTO `x2_cityarea` VALUES (350122, '350122', '连江县', '350100');
INSERT INTO `x2_cityarea` VALUES (350123, '350123', '罗源县', '350100');
INSERT INTO `x2_cityarea` VALUES (350124, '350124', '闽清县', '350100');
INSERT INTO `x2_cityarea` VALUES (350125, '350125', '永泰县', '350100');
INSERT INTO `x2_cityarea` VALUES (350128, '350128', '平潭县', '350100');
INSERT INTO `x2_cityarea` VALUES (350181, '350181', '福清市', '350100');
INSERT INTO `x2_cityarea` VALUES (350182, '350182', '长乐市', '350100');
INSERT INTO `x2_cityarea` VALUES (350201, '350201', '市辖区', '350200');
INSERT INTO `x2_cityarea` VALUES (350203, '350203', '思明区', '350200');
INSERT INTO `x2_cityarea` VALUES (350205, '350205', '海沧区', '350200');
INSERT INTO `x2_cityarea` VALUES (350206, '350206', '湖里区', '350200');
INSERT INTO `x2_cityarea` VALUES (350211, '350211', '集美区', '350200');
INSERT INTO `x2_cityarea` VALUES (350212, '350212', '同安区', '350200');
INSERT INTO `x2_cityarea` VALUES (350213, '350213', '翔安区', '350200');
INSERT INTO `x2_cityarea` VALUES (350301, '350301', '市辖区', '350300');
INSERT INTO `x2_cityarea` VALUES (350302, '350302', '城厢区', '350300');
INSERT INTO `x2_cityarea` VALUES (350303, '350303', '涵江区', '350300');
INSERT INTO `x2_cityarea` VALUES (350304, '350304', '荔城区', '350300');
INSERT INTO `x2_cityarea` VALUES (350305, '350305', '秀屿区', '350300');
INSERT INTO `x2_cityarea` VALUES (350322, '350322', '仙游县', '350300');
INSERT INTO `x2_cityarea` VALUES (350401, '350401', '市辖区', '350400');
INSERT INTO `x2_cityarea` VALUES (350402, '350402', '梅列区', '350400');
INSERT INTO `x2_cityarea` VALUES (350403, '350403', '三元区', '350400');
INSERT INTO `x2_cityarea` VALUES (350421, '350421', '明溪县', '350400');
INSERT INTO `x2_cityarea` VALUES (350423, '350423', '清流县', '350400');
INSERT INTO `x2_cityarea` VALUES (350424, '350424', '宁化县', '350400');
INSERT INTO `x2_cityarea` VALUES (350425, '350425', '大田县', '350400');
INSERT INTO `x2_cityarea` VALUES (350426, '350426', '尤溪县', '350400');
INSERT INTO `x2_cityarea` VALUES (350427, '350427', '沙　县', '350400');
INSERT INTO `x2_cityarea` VALUES (350428, '350428', '将乐县', '350400');
INSERT INTO `x2_cityarea` VALUES (350429, '350429', '泰宁县', '350400');
INSERT INTO `x2_cityarea` VALUES (350430, '350430', '建宁县', '350400');
INSERT INTO `x2_cityarea` VALUES (350481, '350481', '永安市', '350400');
INSERT INTO `x2_cityarea` VALUES (350501, '350501', '市辖区', '350500');
INSERT INTO `x2_cityarea` VALUES (350502, '350502', '鲤城区', '350500');
INSERT INTO `x2_cityarea` VALUES (350503, '350503', '丰泽区', '350500');
INSERT INTO `x2_cityarea` VALUES (350504, '350504', '洛江区', '350500');
INSERT INTO `x2_cityarea` VALUES (350505, '350505', '泉港区', '350500');
INSERT INTO `x2_cityarea` VALUES (350521, '350521', '惠安县', '350500');
INSERT INTO `x2_cityarea` VALUES (350524, '350524', '安溪县', '350500');
INSERT INTO `x2_cityarea` VALUES (350525, '350525', '永春县', '350500');
INSERT INTO `x2_cityarea` VALUES (350526, '350526', '德化县', '350500');
INSERT INTO `x2_cityarea` VALUES (350527, '350527', '金门县', '350500');
INSERT INTO `x2_cityarea` VALUES (350581, '350581', '石狮市', '350500');
INSERT INTO `x2_cityarea` VALUES (350582, '350582', '晋江市', '350500');
INSERT INTO `x2_cityarea` VALUES (350583, '350583', '南安市', '350500');
INSERT INTO `x2_cityarea` VALUES (350601, '350601', '市辖区', '350600');
INSERT INTO `x2_cityarea` VALUES (350602, '350602', '芗城区', '350600');
INSERT INTO `x2_cityarea` VALUES (350603, '350603', '龙文区', '350600');
INSERT INTO `x2_cityarea` VALUES (350622, '350622', '云霄县', '350600');
INSERT INTO `x2_cityarea` VALUES (350623, '350623', '漳浦县', '350600');
INSERT INTO `x2_cityarea` VALUES (350624, '350624', '诏安县', '350600');
INSERT INTO `x2_cityarea` VALUES (350625, '350625', '长泰县', '350600');
INSERT INTO `x2_cityarea` VALUES (350626, '350626', '东山县', '350600');
INSERT INTO `x2_cityarea` VALUES (350627, '350627', '南靖县', '350600');
INSERT INTO `x2_cityarea` VALUES (350628, '350628', '平和县', '350600');
INSERT INTO `x2_cityarea` VALUES (350629, '350629', '华安县', '350600');
INSERT INTO `x2_cityarea` VALUES (350681, '350681', '龙海市', '350600');
INSERT INTO `x2_cityarea` VALUES (350701, '350701', '市辖区', '350700');
INSERT INTO `x2_cityarea` VALUES (350702, '350702', '延平区', '350700');
INSERT INTO `x2_cityarea` VALUES (350721, '350721', '顺昌县', '350700');
INSERT INTO `x2_cityarea` VALUES (350722, '350722', '浦城县', '350700');
INSERT INTO `x2_cityarea` VALUES (350723, '350723', '光泽县', '350700');
INSERT INTO `x2_cityarea` VALUES (350724, '350724', '松溪县', '350700');
INSERT INTO `x2_cityarea` VALUES (350725, '350725', '政和县', '350700');
INSERT INTO `x2_cityarea` VALUES (350781, '350781', '邵武市', '350700');
INSERT INTO `x2_cityarea` VALUES (350782, '350782', '武夷山市', '350700');
INSERT INTO `x2_cityarea` VALUES (350783, '350783', '建瓯市', '350700');
INSERT INTO `x2_cityarea` VALUES (350784, '350784', '建阳市', '350700');
INSERT INTO `x2_cityarea` VALUES (350801, '350801', '市辖区', '350800');
INSERT INTO `x2_cityarea` VALUES (350802, '350802', '新罗区', '350800');
INSERT INTO `x2_cityarea` VALUES (350821, '350821', '长汀县', '350800');
INSERT INTO `x2_cityarea` VALUES (350822, '350822', '永定县', '350800');
INSERT INTO `x2_cityarea` VALUES (350823, '350823', '上杭县', '350800');
INSERT INTO `x2_cityarea` VALUES (350824, '350824', '武平县', '350800');
INSERT INTO `x2_cityarea` VALUES (350825, '350825', '连城县', '350800');
INSERT INTO `x2_cityarea` VALUES (350881, '350881', '漳平市', '350800');
INSERT INTO `x2_cityarea` VALUES (350901, '350901', '市辖区', '350900');
INSERT INTO `x2_cityarea` VALUES (350902, '350902', '蕉城区', '350900');
INSERT INTO `x2_cityarea` VALUES (350921, '350921', '霞浦县', '350900');
INSERT INTO `x2_cityarea` VALUES (350922, '350922', '古田县', '350900');
INSERT INTO `x2_cityarea` VALUES (350923, '350923', '屏南县', '350900');
INSERT INTO `x2_cityarea` VALUES (350924, '350924', '寿宁县', '350900');
INSERT INTO `x2_cityarea` VALUES (350925, '350925', '周宁县', '350900');
INSERT INTO `x2_cityarea` VALUES (350926, '350926', '柘荣县', '350900');
INSERT INTO `x2_cityarea` VALUES (350981, '350981', '福安市', '350900');
INSERT INTO `x2_cityarea` VALUES (350982, '350982', '福鼎市', '350900');
INSERT INTO `x2_cityarea` VALUES (360101, '360101', '市辖区', '360100');
INSERT INTO `x2_cityarea` VALUES (360102, '360102', '东湖区', '360100');
INSERT INTO `x2_cityarea` VALUES (360103, '360103', '西湖区', '360100');
INSERT INTO `x2_cityarea` VALUES (360104, '360104', '青云谱区', '360100');
INSERT INTO `x2_cityarea` VALUES (360105, '360105', '湾里区', '360100');
INSERT INTO `x2_cityarea` VALUES (360111, '360111', '青山湖区', '360100');
INSERT INTO `x2_cityarea` VALUES (360121, '360121', '南昌县', '360100');
INSERT INTO `x2_cityarea` VALUES (360122, '360122', '新建县', '360100');
INSERT INTO `x2_cityarea` VALUES (360123, '360123', '安义县', '360100');
INSERT INTO `x2_cityarea` VALUES (360124, '360124', '进贤县', '360100');
INSERT INTO `x2_cityarea` VALUES (360201, '360201', '市辖区', '360200');
INSERT INTO `x2_cityarea` VALUES (360202, '360202', '昌江区', '360200');
INSERT INTO `x2_cityarea` VALUES (360203, '360203', '珠山区', '360200');
INSERT INTO `x2_cityarea` VALUES (360222, '360222', '浮梁县', '360200');
INSERT INTO `x2_cityarea` VALUES (360281, '360281', '乐平市', '360200');
INSERT INTO `x2_cityarea` VALUES (360301, '360301', '市辖区', '360300');
INSERT INTO `x2_cityarea` VALUES (360302, '360302', '安源区', '360300');
INSERT INTO `x2_cityarea` VALUES (360313, '360313', '湘东区', '360300');
INSERT INTO `x2_cityarea` VALUES (360321, '360321', '莲花县', '360300');
INSERT INTO `x2_cityarea` VALUES (360322, '360322', '上栗县', '360300');
INSERT INTO `x2_cityarea` VALUES (360323, '360323', '芦溪县', '360300');
INSERT INTO `x2_cityarea` VALUES (360401, '360401', '市辖区', '360400');
INSERT INTO `x2_cityarea` VALUES (360402, '360402', '庐山区', '360400');
INSERT INTO `x2_cityarea` VALUES (360403, '360403', '浔阳区', '360400');
INSERT INTO `x2_cityarea` VALUES (360421, '360421', '九江县', '360400');
INSERT INTO `x2_cityarea` VALUES (360423, '360423', '武宁县', '360400');
INSERT INTO `x2_cityarea` VALUES (360424, '360424', '修水县', '360400');
INSERT INTO `x2_cityarea` VALUES (360425, '360425', '永修县', '360400');
INSERT INTO `x2_cityarea` VALUES (360426, '360426', '德安县', '360400');
INSERT INTO `x2_cityarea` VALUES (360427, '360427', '星子县', '360400');
INSERT INTO `x2_cityarea` VALUES (360428, '360428', '都昌县', '360400');
INSERT INTO `x2_cityarea` VALUES (360429, '360429', '湖口县', '360400');
INSERT INTO `x2_cityarea` VALUES (360430, '360430', '彭泽县', '360400');
INSERT INTO `x2_cityarea` VALUES (360481, '360481', '瑞昌市', '360400');
INSERT INTO `x2_cityarea` VALUES (360501, '360501', '市辖区', '360500');
INSERT INTO `x2_cityarea` VALUES (360502, '360502', '渝水区', '360500');
INSERT INTO `x2_cityarea` VALUES (360521, '360521', '分宜县', '360500');
INSERT INTO `x2_cityarea` VALUES (360601, '360601', '市辖区', '360600');
INSERT INTO `x2_cityarea` VALUES (360602, '360602', '月湖区', '360600');
INSERT INTO `x2_cityarea` VALUES (360622, '360622', '余江县', '360600');
INSERT INTO `x2_cityarea` VALUES (360681, '360681', '贵溪市', '360600');
INSERT INTO `x2_cityarea` VALUES (360701, '360701', '市辖区', '360700');
INSERT INTO `x2_cityarea` VALUES (360702, '360702', '章贡区', '360700');
INSERT INTO `x2_cityarea` VALUES (360721, '360721', '赣　县', '360700');
INSERT INTO `x2_cityarea` VALUES (360722, '360722', '信丰县', '360700');
INSERT INTO `x2_cityarea` VALUES (360723, '360723', '大余县', '360700');
INSERT INTO `x2_cityarea` VALUES (360724, '360724', '上犹县', '360700');
INSERT INTO `x2_cityarea` VALUES (360725, '360725', '崇义县', '360700');
INSERT INTO `x2_cityarea` VALUES (360726, '360726', '安远县', '360700');
INSERT INTO `x2_cityarea` VALUES (360727, '360727', '龙南县', '360700');
INSERT INTO `x2_cityarea` VALUES (360728, '360728', '定南县', '360700');
INSERT INTO `x2_cityarea` VALUES (360729, '360729', '全南县', '360700');
INSERT INTO `x2_cityarea` VALUES (360730, '360730', '宁都县', '360700');
INSERT INTO `x2_cityarea` VALUES (360731, '360731', '于都县', '360700');
INSERT INTO `x2_cityarea` VALUES (360732, '360732', '兴国县', '360700');
INSERT INTO `x2_cityarea` VALUES (360733, '360733', '会昌县', '360700');
INSERT INTO `x2_cityarea` VALUES (360734, '360734', '寻乌县', '360700');
INSERT INTO `x2_cityarea` VALUES (360735, '360735', '石城县', '360700');
INSERT INTO `x2_cityarea` VALUES (360781, '360781', '瑞金市', '360700');
INSERT INTO `x2_cityarea` VALUES (360782, '360782', '南康市', '360700');
INSERT INTO `x2_cityarea` VALUES (360801, '360801', '市辖区', '360800');
INSERT INTO `x2_cityarea` VALUES (360802, '360802', '吉州区', '360800');
INSERT INTO `x2_cityarea` VALUES (360803, '360803', '青原区', '360800');
INSERT INTO `x2_cityarea` VALUES (360821, '360821', '吉安县', '360800');
INSERT INTO `x2_cityarea` VALUES (360822, '360822', '吉水县', '360800');
INSERT INTO `x2_cityarea` VALUES (360823, '360823', '峡江县', '360800');
INSERT INTO `x2_cityarea` VALUES (360824, '360824', '新干县', '360800');
INSERT INTO `x2_cityarea` VALUES (360825, '360825', '永丰县', '360800');
INSERT INTO `x2_cityarea` VALUES (360826, '360826', '泰和县', '360800');
INSERT INTO `x2_cityarea` VALUES (360827, '360827', '遂川县', '360800');
INSERT INTO `x2_cityarea` VALUES (360828, '360828', '万安县', '360800');
INSERT INTO `x2_cityarea` VALUES (360829, '360829', '安福县', '360800');
INSERT INTO `x2_cityarea` VALUES (360830, '360830', '永新县', '360800');
INSERT INTO `x2_cityarea` VALUES (360881, '360881', '井冈山市', '360800');
INSERT INTO `x2_cityarea` VALUES (360901, '360901', '市辖区', '360900');
INSERT INTO `x2_cityarea` VALUES (360902, '360902', '袁州区', '360900');
INSERT INTO `x2_cityarea` VALUES (360921, '360921', '奉新县', '360900');
INSERT INTO `x2_cityarea` VALUES (360922, '360922', '万载县', '360900');
INSERT INTO `x2_cityarea` VALUES (360923, '360923', '上高县', '360900');
INSERT INTO `x2_cityarea` VALUES (360924, '360924', '宜丰县', '360900');
INSERT INTO `x2_cityarea` VALUES (360925, '360925', '靖安县', '360900');
INSERT INTO `x2_cityarea` VALUES (360926, '360926', '铜鼓县', '360900');
INSERT INTO `x2_cityarea` VALUES (360981, '360981', '丰城市', '360900');
INSERT INTO `x2_cityarea` VALUES (360982, '360982', '樟树市', '360900');
INSERT INTO `x2_cityarea` VALUES (360983, '360983', '高安市', '360900');
INSERT INTO `x2_cityarea` VALUES (361001, '361001', '市辖区', '361000');
INSERT INTO `x2_cityarea` VALUES (361002, '361002', '临川区', '361000');
INSERT INTO `x2_cityarea` VALUES (361021, '361021', '南城县', '361000');
INSERT INTO `x2_cityarea` VALUES (361022, '361022', '黎川县', '361000');
INSERT INTO `x2_cityarea` VALUES (361023, '361023', '南丰县', '361000');
INSERT INTO `x2_cityarea` VALUES (361024, '361024', '崇仁县', '361000');
INSERT INTO `x2_cityarea` VALUES (361025, '361025', '乐安县', '361000');
INSERT INTO `x2_cityarea` VALUES (361026, '361026', '宜黄县', '361000');
INSERT INTO `x2_cityarea` VALUES (361027, '361027', '金溪县', '361000');
INSERT INTO `x2_cityarea` VALUES (361028, '361028', '资溪县', '361000');
INSERT INTO `x2_cityarea` VALUES (361029, '361029', '东乡县', '361000');
INSERT INTO `x2_cityarea` VALUES (361030, '361030', '广昌县', '361000');
INSERT INTO `x2_cityarea` VALUES (361101, '361101', '市辖区', '361100');
INSERT INTO `x2_cityarea` VALUES (361102, '361102', '信州区', '361100');
INSERT INTO `x2_cityarea` VALUES (361121, '361121', '上饶县', '361100');
INSERT INTO `x2_cityarea` VALUES (361122, '361122', '广丰县', '361100');
INSERT INTO `x2_cityarea` VALUES (361123, '361123', '玉山县', '361100');
INSERT INTO `x2_cityarea` VALUES (361124, '361124', '铅山县', '361100');
INSERT INTO `x2_cityarea` VALUES (361125, '361125', '横峰县', '361100');
INSERT INTO `x2_cityarea` VALUES (361126, '361126', '弋阳县', '361100');
INSERT INTO `x2_cityarea` VALUES (361127, '361127', '余干县', '361100');
INSERT INTO `x2_cityarea` VALUES (361128, '361128', '鄱阳县', '361100');
INSERT INTO `x2_cityarea` VALUES (361129, '361129', '万年县', '361100');
INSERT INTO `x2_cityarea` VALUES (361130, '361130', '婺源县', '361100');
INSERT INTO `x2_cityarea` VALUES (361181, '361181', '德兴市', '361100');
INSERT INTO `x2_cityarea` VALUES (370101, '370101', '市辖区', '370100');
INSERT INTO `x2_cityarea` VALUES (370102, '370102', '历下区', '370100');
INSERT INTO `x2_cityarea` VALUES (370103, '370103', '市中区', '370100');
INSERT INTO `x2_cityarea` VALUES (370104, '370104', '槐荫区', '370100');
INSERT INTO `x2_cityarea` VALUES (370105, '370105', '天桥区', '370100');
INSERT INTO `x2_cityarea` VALUES (370112, '370112', '历城区', '370100');
INSERT INTO `x2_cityarea` VALUES (370113, '370113', '长清区', '370100');
INSERT INTO `x2_cityarea` VALUES (370124, '370124', '平阴县', '370100');
INSERT INTO `x2_cityarea` VALUES (370125, '370125', '济阳县', '370100');
INSERT INTO `x2_cityarea` VALUES (370126, '370126', '商河县', '370100');
INSERT INTO `x2_cityarea` VALUES (370181, '370181', '章丘市', '370100');
INSERT INTO `x2_cityarea` VALUES (370201, '370201', '市辖区', '370200');
INSERT INTO `x2_cityarea` VALUES (370202, '370202', '市南区', '370200');
INSERT INTO `x2_cityarea` VALUES (370203, '370203', '市北区', '370200');
INSERT INTO `x2_cityarea` VALUES (370205, '370205', '四方区', '370200');
INSERT INTO `x2_cityarea` VALUES (370211, '370211', '黄岛区', '370200');
INSERT INTO `x2_cityarea` VALUES (370212, '370212', '崂山区', '370200');
INSERT INTO `x2_cityarea` VALUES (370213, '370213', '李沧区', '370200');
INSERT INTO `x2_cityarea` VALUES (370214, '370214', '城阳区', '370200');
INSERT INTO `x2_cityarea` VALUES (370281, '370281', '胶州市', '370200');
INSERT INTO `x2_cityarea` VALUES (370282, '370282', '即墨市', '370200');
INSERT INTO `x2_cityarea` VALUES (370283, '370283', '平度市', '370200');
INSERT INTO `x2_cityarea` VALUES (370284, '370284', '胶南市', '370200');
INSERT INTO `x2_cityarea` VALUES (370285, '370285', '莱西市', '370200');
INSERT INTO `x2_cityarea` VALUES (370301, '370301', '市辖区', '370300');
INSERT INTO `x2_cityarea` VALUES (370302, '370302', '淄川区', '370300');
INSERT INTO `x2_cityarea` VALUES (370303, '370303', '张店区', '370300');
INSERT INTO `x2_cityarea` VALUES (370304, '370304', '博山区', '370300');
INSERT INTO `x2_cityarea` VALUES (370305, '370305', '临淄区', '370300');
INSERT INTO `x2_cityarea` VALUES (370306, '370306', '周村区', '370300');
INSERT INTO `x2_cityarea` VALUES (370321, '370321', '桓台县', '370300');
INSERT INTO `x2_cityarea` VALUES (370322, '370322', '高青县', '370300');
INSERT INTO `x2_cityarea` VALUES (370323, '370323', '沂源县', '370300');
INSERT INTO `x2_cityarea` VALUES (370401, '370401', '市辖区', '370400');
INSERT INTO `x2_cityarea` VALUES (370402, '370402', '市中区', '370400');
INSERT INTO `x2_cityarea` VALUES (370403, '370403', '薛城区', '370400');
INSERT INTO `x2_cityarea` VALUES (370404, '370404', '峄城区', '370400');
INSERT INTO `x2_cityarea` VALUES (370405, '370405', '台儿庄区', '370400');
INSERT INTO `x2_cityarea` VALUES (370406, '370406', '山亭区', '370400');
INSERT INTO `x2_cityarea` VALUES (370481, '370481', '滕州市', '370400');
INSERT INTO `x2_cityarea` VALUES (370501, '370501', '市辖区', '370500');
INSERT INTO `x2_cityarea` VALUES (370502, '370502', '东营区', '370500');
INSERT INTO `x2_cityarea` VALUES (370503, '370503', '河口区', '370500');
INSERT INTO `x2_cityarea` VALUES (370521, '370521', '垦利县', '370500');
INSERT INTO `x2_cityarea` VALUES (370522, '370522', '利津县', '370500');
INSERT INTO `x2_cityarea` VALUES (370523, '370523', '广饶县', '370500');
INSERT INTO `x2_cityarea` VALUES (370601, '370601', '市辖区', '370600');
INSERT INTO `x2_cityarea` VALUES (370602, '370602', '芝罘区', '370600');
INSERT INTO `x2_cityarea` VALUES (370611, '370611', '福山区', '370600');
INSERT INTO `x2_cityarea` VALUES (370612, '370612', '牟平区', '370600');
INSERT INTO `x2_cityarea` VALUES (370613, '370613', '莱山区', '370600');
INSERT INTO `x2_cityarea` VALUES (370634, '370634', '长岛县', '370600');
INSERT INTO `x2_cityarea` VALUES (370681, '370681', '龙口市', '370600');
INSERT INTO `x2_cityarea` VALUES (370682, '370682', '莱阳市', '370600');
INSERT INTO `x2_cityarea` VALUES (370683, '370683', '莱州市', '370600');
INSERT INTO `x2_cityarea` VALUES (370684, '370684', '蓬莱市', '370600');
INSERT INTO `x2_cityarea` VALUES (370685, '370685', '招远市', '370600');
INSERT INTO `x2_cityarea` VALUES (370686, '370686', '栖霞市', '370600');
INSERT INTO `x2_cityarea` VALUES (370687, '370687', '海阳市', '370600');
INSERT INTO `x2_cityarea` VALUES (370701, '370701', '市辖区', '370700');
INSERT INTO `x2_cityarea` VALUES (370702, '370702', '潍城区', '370700');
INSERT INTO `x2_cityarea` VALUES (370703, '370703', '寒亭区', '370700');
INSERT INTO `x2_cityarea` VALUES (370704, '370704', '坊子区', '370700');
INSERT INTO `x2_cityarea` VALUES (370705, '370705', '奎文区', '370700');
INSERT INTO `x2_cityarea` VALUES (370724, '370724', '临朐县', '370700');
INSERT INTO `x2_cityarea` VALUES (370725, '370725', '昌乐县', '370700');
INSERT INTO `x2_cityarea` VALUES (370781, '370781', '青州市', '370700');
INSERT INTO `x2_cityarea` VALUES (370782, '370782', '诸城市', '370700');
INSERT INTO `x2_cityarea` VALUES (370783, '370783', '寿光市', '370700');
INSERT INTO `x2_cityarea` VALUES (370784, '370784', '安丘市', '370700');
INSERT INTO `x2_cityarea` VALUES (370785, '370785', '高密市', '370700');
INSERT INTO `x2_cityarea` VALUES (370786, '370786', '昌邑市', '370700');
INSERT INTO `x2_cityarea` VALUES (370801, '370801', '市辖区', '370800');
INSERT INTO `x2_cityarea` VALUES (370802, '370802', '市中区', '370800');
INSERT INTO `x2_cityarea` VALUES (370811, '370811', '任城区', '370800');
INSERT INTO `x2_cityarea` VALUES (370826, '370826', '微山县', '370800');
INSERT INTO `x2_cityarea` VALUES (370827, '370827', '鱼台县', '370800');
INSERT INTO `x2_cityarea` VALUES (370828, '370828', '金乡县', '370800');
INSERT INTO `x2_cityarea` VALUES (370829, '370829', '嘉祥县', '370800');
INSERT INTO `x2_cityarea` VALUES (370830, '370830', '汶上县', '370800');
INSERT INTO `x2_cityarea` VALUES (370831, '370831', '泗水县', '370800');
INSERT INTO `x2_cityarea` VALUES (370832, '370832', '梁山县', '370800');
INSERT INTO `x2_cityarea` VALUES (370881, '370881', '曲阜市', '370800');
INSERT INTO `x2_cityarea` VALUES (370882, '370882', '兖州市', '370800');
INSERT INTO `x2_cityarea` VALUES (370883, '370883', '邹城市', '370800');
INSERT INTO `x2_cityarea` VALUES (370901, '370901', '市辖区', '370900');
INSERT INTO `x2_cityarea` VALUES (370902, '370902', '泰山区', '370900');
INSERT INTO `x2_cityarea` VALUES (370903, '370903', '岱岳区', '370900');
INSERT INTO `x2_cityarea` VALUES (370921, '370921', '宁阳县', '370900');
INSERT INTO `x2_cityarea` VALUES (370923, '370923', '东平县', '370900');
INSERT INTO `x2_cityarea` VALUES (370982, '370982', '新泰市', '370900');
INSERT INTO `x2_cityarea` VALUES (370983, '370983', '肥城市', '370900');
INSERT INTO `x2_cityarea` VALUES (371001, '371001', '市辖区', '371000');
INSERT INTO `x2_cityarea` VALUES (371002, '371002', '环翠区', '371000');
INSERT INTO `x2_cityarea` VALUES (371081, '371081', '文登市', '371000');
INSERT INTO `x2_cityarea` VALUES (371082, '371082', '荣成市', '371000');
INSERT INTO `x2_cityarea` VALUES (371083, '371083', '乳山市', '371000');
INSERT INTO `x2_cityarea` VALUES (371101, '371101', '市辖区', '371100');
INSERT INTO `x2_cityarea` VALUES (371102, '371102', '东港区', '371100');
INSERT INTO `x2_cityarea` VALUES (371103, '371103', '岚山区', '371100');
INSERT INTO `x2_cityarea` VALUES (371121, '371121', '五莲县', '371100');
INSERT INTO `x2_cityarea` VALUES (371122, '371122', '莒　县', '371100');
INSERT INTO `x2_cityarea` VALUES (371201, '371201', '市辖区', '371200');
INSERT INTO `x2_cityarea` VALUES (371202, '371202', '莱城区', '371200');
INSERT INTO `x2_cityarea` VALUES (371203, '371203', '钢城区', '371200');
INSERT INTO `x2_cityarea` VALUES (371301, '371301', '市辖区', '371300');
INSERT INTO `x2_cityarea` VALUES (371302, '371302', '兰山区', '371300');
INSERT INTO `x2_cityarea` VALUES (371311, '371311', '罗庄区', '371300');
INSERT INTO `x2_cityarea` VALUES (371312, '371312', '河东区', '371300');
INSERT INTO `x2_cityarea` VALUES (371321, '371321', '沂南县', '371300');
INSERT INTO `x2_cityarea` VALUES (371322, '371322', '郯城县', '371300');
INSERT INTO `x2_cityarea` VALUES (371323, '371323', '沂水县', '371300');
INSERT INTO `x2_cityarea` VALUES (371324, '371324', '苍山县', '371300');
INSERT INTO `x2_cityarea` VALUES (371325, '371325', '费　县', '371300');
INSERT INTO `x2_cityarea` VALUES (371326, '371326', '平邑县', '371300');
INSERT INTO `x2_cityarea` VALUES (371327, '371327', '莒南县', '371300');
INSERT INTO `x2_cityarea` VALUES (371328, '371328', '蒙阴县', '371300');
INSERT INTO `x2_cityarea` VALUES (371329, '371329', '临沭县', '371300');
INSERT INTO `x2_cityarea` VALUES (371401, '371401', '市辖区', '371400');
INSERT INTO `x2_cityarea` VALUES (371402, '371402', '德城区', '371400');
INSERT INTO `x2_cityarea` VALUES (371421, '371421', '陵　县', '371400');
INSERT INTO `x2_cityarea` VALUES (371422, '371422', '宁津县', '371400');
INSERT INTO `x2_cityarea` VALUES (371423, '371423', '庆云县', '371400');
INSERT INTO `x2_cityarea` VALUES (371424, '371424', '临邑县', '371400');
INSERT INTO `x2_cityarea` VALUES (371425, '371425', '齐河县', '371400');
INSERT INTO `x2_cityarea` VALUES (371426, '371426', '平原县', '371400');
INSERT INTO `x2_cityarea` VALUES (371427, '371427', '夏津县', '371400');
INSERT INTO `x2_cityarea` VALUES (371428, '371428', '武城县', '371400');
INSERT INTO `x2_cityarea` VALUES (371481, '371481', '乐陵市', '371400');
INSERT INTO `x2_cityarea` VALUES (371482, '371482', '禹城市', '371400');
INSERT INTO `x2_cityarea` VALUES (371501, '371501', '市辖区', '371500');
INSERT INTO `x2_cityarea` VALUES (371502, '371502', '东昌府区', '371500');
INSERT INTO `x2_cityarea` VALUES (371521, '371521', '阳谷县', '371500');
INSERT INTO `x2_cityarea` VALUES (371522, '371522', '莘　县', '371500');
INSERT INTO `x2_cityarea` VALUES (371523, '371523', '茌平县', '371500');
INSERT INTO `x2_cityarea` VALUES (371524, '371524', '东阿县', '371500');
INSERT INTO `x2_cityarea` VALUES (371525, '371525', '冠　县', '371500');
INSERT INTO `x2_cityarea` VALUES (371526, '371526', '高唐县', '371500');
INSERT INTO `x2_cityarea` VALUES (371581, '371581', '临清市', '371500');
INSERT INTO `x2_cityarea` VALUES (371601, '371601', '市辖区', '371600');
INSERT INTO `x2_cityarea` VALUES (371602, '371602', '滨城区', '371600');
INSERT INTO `x2_cityarea` VALUES (371621, '371621', '惠民县', '371600');
INSERT INTO `x2_cityarea` VALUES (371622, '371622', '阳信县', '371600');
INSERT INTO `x2_cityarea` VALUES (371623, '371623', '无棣县', '371600');
INSERT INTO `x2_cityarea` VALUES (371624, '371624', '沾化县', '371600');
INSERT INTO `x2_cityarea` VALUES (371625, '371625', '博兴县', '371600');
INSERT INTO `x2_cityarea` VALUES (371626, '371626', '邹平县', '371600');
INSERT INTO `x2_cityarea` VALUES (371701, '371701', '市辖区', '371700');
INSERT INTO `x2_cityarea` VALUES (371702, '371702', '牡丹区', '371700');
INSERT INTO `x2_cityarea` VALUES (371721, '371721', '曹　县', '371700');
INSERT INTO `x2_cityarea` VALUES (371722, '371722', '单　县', '371700');
INSERT INTO `x2_cityarea` VALUES (371723, '371723', '成武县', '371700');
INSERT INTO `x2_cityarea` VALUES (371724, '371724', '巨野县', '371700');
INSERT INTO `x2_cityarea` VALUES (371725, '371725', '郓城县', '371700');
INSERT INTO `x2_cityarea` VALUES (371726, '371726', '鄄城县', '371700');
INSERT INTO `x2_cityarea` VALUES (371727, '371727', '定陶县', '371700');
INSERT INTO `x2_cityarea` VALUES (371728, '371728', '东明县', '371700');
INSERT INTO `x2_cityarea` VALUES (410101, '410101', '市辖区', '410100');
INSERT INTO `x2_cityarea` VALUES (410102, '410102', '中原区', '410100');
INSERT INTO `x2_cityarea` VALUES (410103, '410103', '二七区', '410100');
INSERT INTO `x2_cityarea` VALUES (410104, '410104', '管城回族区', '410100');
INSERT INTO `x2_cityarea` VALUES (410105, '410105', '金水区', '410100');
INSERT INTO `x2_cityarea` VALUES (410106, '410106', '上街区', '410100');
INSERT INTO `x2_cityarea` VALUES (410108, '410108', '惠济区', '410100');
INSERT INTO `x2_cityarea` VALUES (410122, '410122', '中牟县', '410100');
INSERT INTO `x2_cityarea` VALUES (410181, '410181', '巩义市', '410100');
INSERT INTO `x2_cityarea` VALUES (410182, '410182', '荥阳市', '410100');
INSERT INTO `x2_cityarea` VALUES (410183, '410183', '新密市', '410100');
INSERT INTO `x2_cityarea` VALUES (410184, '410184', '新郑市', '410100');
INSERT INTO `x2_cityarea` VALUES (410185, '410185', '登封市', '410100');
INSERT INTO `x2_cityarea` VALUES (410201, '410201', '市辖区', '410200');
INSERT INTO `x2_cityarea` VALUES (410202, '410202', '龙亭区', '410200');
INSERT INTO `x2_cityarea` VALUES (410203, '410203', '顺河回族区', '410200');
INSERT INTO `x2_cityarea` VALUES (410204, '410204', '鼓楼区', '410200');
INSERT INTO `x2_cityarea` VALUES (410205, '410205', '禹王台区', '410200');
INSERT INTO `x2_cityarea` VALUES (410211, '410211', '郊   区', '410200');
INSERT INTO `x2_cityarea` VALUES (410221, '410221', '杞　县', '410200');
INSERT INTO `x2_cityarea` VALUES (410222, '410222', '通许县', '410200');
INSERT INTO `x2_cityarea` VALUES (410223, '410223', '尉氏县', '410200');
INSERT INTO `x2_cityarea` VALUES (410224, '410224', '开封县', '410200');
INSERT INTO `x2_cityarea` VALUES (410225, '410225', '兰考县', '410200');
INSERT INTO `x2_cityarea` VALUES (410301, '410301', '市辖区', '410300');
INSERT INTO `x2_cityarea` VALUES (410302, '410302', '老城区', '410300');
INSERT INTO `x2_cityarea` VALUES (410303, '410303', '西工区', '410300');
INSERT INTO `x2_cityarea` VALUES (410304, '410304', '廛河回族区', '410300');
INSERT INTO `x2_cityarea` VALUES (410305, '410305', '涧西区', '410300');
INSERT INTO `x2_cityarea` VALUES (410306, '410306', '吉利区', '410300');
INSERT INTO `x2_cityarea` VALUES (410307, '410307', '洛龙区', '410300');
INSERT INTO `x2_cityarea` VALUES (410322, '410322', '孟津县', '410300');
INSERT INTO `x2_cityarea` VALUES (410323, '410323', '新安县', '410300');
INSERT INTO `x2_cityarea` VALUES (410324, '410324', '栾川县', '410300');
INSERT INTO `x2_cityarea` VALUES (410325, '410325', '嵩　县', '410300');
INSERT INTO `x2_cityarea` VALUES (410326, '410326', '汝阳县', '410300');
INSERT INTO `x2_cityarea` VALUES (410327, '410327', '宜阳县', '410300');
INSERT INTO `x2_cityarea` VALUES (410328, '410328', '洛宁县', '410300');
INSERT INTO `x2_cityarea` VALUES (410329, '410329', '伊川县', '410300');
INSERT INTO `x2_cityarea` VALUES (410381, '410381', '偃师市', '410300');
INSERT INTO `x2_cityarea` VALUES (410401, '410401', '市辖区', '410400');
INSERT INTO `x2_cityarea` VALUES (410402, '410402', '新华区', '410400');
INSERT INTO `x2_cityarea` VALUES (410403, '410403', '卫东区', '410400');
INSERT INTO `x2_cityarea` VALUES (410404, '410404', '石龙区', '410400');
INSERT INTO `x2_cityarea` VALUES (410411, '410411', '湛河区', '410400');
INSERT INTO `x2_cityarea` VALUES (410421, '410421', '宝丰县', '410400');
INSERT INTO `x2_cityarea` VALUES (410422, '410422', '叶　县', '410400');
INSERT INTO `x2_cityarea` VALUES (410423, '410423', '鲁山县', '410400');
INSERT INTO `x2_cityarea` VALUES (410425, '410425', '郏　县', '410400');
INSERT INTO `x2_cityarea` VALUES (410481, '410481', '舞钢市', '410400');
INSERT INTO `x2_cityarea` VALUES (410482, '410482', '汝州市', '410400');
INSERT INTO `x2_cityarea` VALUES (410501, '410501', '市辖区', '410500');
INSERT INTO `x2_cityarea` VALUES (410502, '410502', '文峰区', '410500');
INSERT INTO `x2_cityarea` VALUES (410503, '410503', '北关区', '410500');
INSERT INTO `x2_cityarea` VALUES (410505, '410505', '殷都区', '410500');
INSERT INTO `x2_cityarea` VALUES (410506, '410506', '龙安区', '410500');
INSERT INTO `x2_cityarea` VALUES (410522, '410522', '安阳县', '410500');
INSERT INTO `x2_cityarea` VALUES (410523, '410523', '汤阴县', '410500');
INSERT INTO `x2_cityarea` VALUES (410526, '410526', '滑　县', '410500');
INSERT INTO `x2_cityarea` VALUES (410527, '410527', '内黄县', '410500');
INSERT INTO `x2_cityarea` VALUES (410581, '410581', '林州市', '410500');
INSERT INTO `x2_cityarea` VALUES (410601, '410601', '市辖区', '410600');
INSERT INTO `x2_cityarea` VALUES (410602, '410602', '鹤山区', '410600');
INSERT INTO `x2_cityarea` VALUES (410603, '410603', '山城区', '410600');
INSERT INTO `x2_cityarea` VALUES (410611, '410611', '淇滨区', '410600');
INSERT INTO `x2_cityarea` VALUES (410621, '410621', '浚　县', '410600');
INSERT INTO `x2_cityarea` VALUES (410622, '410622', '淇　县', '410600');
INSERT INTO `x2_cityarea` VALUES (410701, '410701', '市辖区', '410700');
INSERT INTO `x2_cityarea` VALUES (410702, '410702', '红旗区', '410700');
INSERT INTO `x2_cityarea` VALUES (410703, '410703', '卫滨区', '410700');
INSERT INTO `x2_cityarea` VALUES (410704, '410704', '凤泉区', '410700');
INSERT INTO `x2_cityarea` VALUES (410711, '410711', '牧野区', '410700');
INSERT INTO `x2_cityarea` VALUES (410721, '410721', '新乡县', '410700');
INSERT INTO `x2_cityarea` VALUES (410724, '410724', '获嘉县', '410700');
INSERT INTO `x2_cityarea` VALUES (410725, '410725', '原阳县', '410700');
INSERT INTO `x2_cityarea` VALUES (410726, '410726', '延津县', '410700');
INSERT INTO `x2_cityarea` VALUES (410727, '410727', '封丘县', '410700');
INSERT INTO `x2_cityarea` VALUES (410728, '410728', '长垣县', '410700');
INSERT INTO `x2_cityarea` VALUES (410781, '410781', '卫辉市', '410700');
INSERT INTO `x2_cityarea` VALUES (410782, '410782', '辉县市', '410700');
INSERT INTO `x2_cityarea` VALUES (410801, '410801', '市辖区', '410800');
INSERT INTO `x2_cityarea` VALUES (410802, '410802', '解放区', '410800');
INSERT INTO `x2_cityarea` VALUES (410803, '410803', '中站区', '410800');
INSERT INTO `x2_cityarea` VALUES (410804, '410804', '马村区', '410800');
INSERT INTO `x2_cityarea` VALUES (410811, '410811', '山阳区', '410800');
INSERT INTO `x2_cityarea` VALUES (410821, '410821', '修武县', '410800');
INSERT INTO `x2_cityarea` VALUES (410822, '410822', '博爱县', '410800');
INSERT INTO `x2_cityarea` VALUES (410823, '410823', '武陟县', '410800');
INSERT INTO `x2_cityarea` VALUES (410825, '410825', '温　县', '410800');
INSERT INTO `x2_cityarea` VALUES (410881, '410881', '济源市', '410800');
INSERT INTO `x2_cityarea` VALUES (410882, '410882', '沁阳市', '410800');
INSERT INTO `x2_cityarea` VALUES (410883, '410883', '孟州市', '410800');
INSERT INTO `x2_cityarea` VALUES (410901, '410901', '市辖区', '410900');
INSERT INTO `x2_cityarea` VALUES (410902, '410902', '华龙区', '410900');
INSERT INTO `x2_cityarea` VALUES (410922, '410922', '清丰县', '410900');
INSERT INTO `x2_cityarea` VALUES (410923, '410923', '南乐县', '410900');
INSERT INTO `x2_cityarea` VALUES (410926, '410926', '范　县', '410900');
INSERT INTO `x2_cityarea` VALUES (410927, '410927', '台前县', '410900');
INSERT INTO `x2_cityarea` VALUES (410928, '410928', '濮阳县', '410900');
INSERT INTO `x2_cityarea` VALUES (411001, '411001', '市辖区', '411000');
INSERT INTO `x2_cityarea` VALUES (411002, '411002', '魏都区', '411000');
INSERT INTO `x2_cityarea` VALUES (411023, '411023', '许昌县', '411000');
INSERT INTO `x2_cityarea` VALUES (411024, '411024', '鄢陵县', '411000');
INSERT INTO `x2_cityarea` VALUES (411025, '411025', '襄城县', '411000');
INSERT INTO `x2_cityarea` VALUES (411081, '411081', '禹州市', '411000');
INSERT INTO `x2_cityarea` VALUES (411082, '411082', '长葛市', '411000');
INSERT INTO `x2_cityarea` VALUES (411101, '411101', '市辖区', '411100');
INSERT INTO `x2_cityarea` VALUES (411102, '411102', '源汇区', '411100');
INSERT INTO `x2_cityarea` VALUES (411103, '411103', '郾城区', '411100');
INSERT INTO `x2_cityarea` VALUES (411104, '411104', '召陵区', '411100');
INSERT INTO `x2_cityarea` VALUES (411121, '411121', '舞阳县', '411100');
INSERT INTO `x2_cityarea` VALUES (411122, '411122', '临颍县', '411100');
INSERT INTO `x2_cityarea` VALUES (411201, '411201', '市辖区', '411200');
INSERT INTO `x2_cityarea` VALUES (411202, '411202', '湖滨区', '411200');
INSERT INTO `x2_cityarea` VALUES (411221, '411221', '渑池县', '411200');
INSERT INTO `x2_cityarea` VALUES (411222, '411222', '陕　县', '411200');
INSERT INTO `x2_cityarea` VALUES (411224, '411224', '卢氏县', '411200');
INSERT INTO `x2_cityarea` VALUES (411281, '411281', '义马市', '411200');
INSERT INTO `x2_cityarea` VALUES (411282, '411282', '灵宝市', '411200');
INSERT INTO `x2_cityarea` VALUES (411301, '411301', '市辖区', '411300');
INSERT INTO `x2_cityarea` VALUES (411302, '411302', '宛城区', '411300');
INSERT INTO `x2_cityarea` VALUES (411303, '411303', '卧龙区', '411300');
INSERT INTO `x2_cityarea` VALUES (411321, '411321', '南召县', '411300');
INSERT INTO `x2_cityarea` VALUES (411322, '411322', '方城县', '411300');
INSERT INTO `x2_cityarea` VALUES (411323, '411323', '西峡县', '411300');
INSERT INTO `x2_cityarea` VALUES (411324, '411324', '镇平县', '411300');
INSERT INTO `x2_cityarea` VALUES (411325, '411325', '内乡县', '411300');
INSERT INTO `x2_cityarea` VALUES (411326, '411326', '淅川县', '411300');
INSERT INTO `x2_cityarea` VALUES (411327, '411327', '社旗县', '411300');
INSERT INTO `x2_cityarea` VALUES (411328, '411328', '唐河县', '411300');
INSERT INTO `x2_cityarea` VALUES (411329, '411329', '新野县', '411300');
INSERT INTO `x2_cityarea` VALUES (411330, '411330', '桐柏县', '411300');
INSERT INTO `x2_cityarea` VALUES (411381, '411381', '邓州市', '411300');
INSERT INTO `x2_cityarea` VALUES (411401, '411401', '市辖区', '411400');
INSERT INTO `x2_cityarea` VALUES (411402, '411402', '梁园区', '411400');
INSERT INTO `x2_cityarea` VALUES (411403, '411403', '睢阳区', '411400');
INSERT INTO `x2_cityarea` VALUES (411421, '411421', '民权县', '411400');
INSERT INTO `x2_cityarea` VALUES (411422, '411422', '睢　县', '411400');
INSERT INTO `x2_cityarea` VALUES (411423, '411423', '宁陵县', '411400');
INSERT INTO `x2_cityarea` VALUES (411424, '411424', '柘城县', '411400');
INSERT INTO `x2_cityarea` VALUES (411425, '411425', '虞城县', '411400');
INSERT INTO `x2_cityarea` VALUES (411426, '411426', '夏邑县', '411400');
INSERT INTO `x2_cityarea` VALUES (411481, '411481', '永城市', '411400');
INSERT INTO `x2_cityarea` VALUES (411501, '411501', '市辖区', '411500');
INSERT INTO `x2_cityarea` VALUES (411502, '411502', '师河区', '411500');
INSERT INTO `x2_cityarea` VALUES (411503, '411503', '平桥区', '411500');
INSERT INTO `x2_cityarea` VALUES (411521, '411521', '罗山县', '411500');
INSERT INTO `x2_cityarea` VALUES (411522, '411522', '光山县', '411500');
INSERT INTO `x2_cityarea` VALUES (411523, '411523', '新　县', '411500');
INSERT INTO `x2_cityarea` VALUES (411524, '411524', '商城县', '411500');
INSERT INTO `x2_cityarea` VALUES (411525, '411525', '固始县', '411500');
INSERT INTO `x2_cityarea` VALUES (411526, '411526', '潢川县', '411500');
INSERT INTO `x2_cityarea` VALUES (411527, '411527', '淮滨县', '411500');
INSERT INTO `x2_cityarea` VALUES (411528, '411528', '息　县', '411500');
INSERT INTO `x2_cityarea` VALUES (411601, '411601', '市辖区', '411600');
INSERT INTO `x2_cityarea` VALUES (411602, '411602', '川汇区', '411600');
INSERT INTO `x2_cityarea` VALUES (411621, '411621', '扶沟县', '411600');
INSERT INTO `x2_cityarea` VALUES (411622, '411622', '西华县', '411600');
INSERT INTO `x2_cityarea` VALUES (411623, '411623', '商水县', '411600');
INSERT INTO `x2_cityarea` VALUES (411624, '411624', '沈丘县', '411600');
INSERT INTO `x2_cityarea` VALUES (411625, '411625', '郸城县', '411600');
INSERT INTO `x2_cityarea` VALUES (411626, '411626', '淮阳县', '411600');
INSERT INTO `x2_cityarea` VALUES (411627, '411627', '太康县', '411600');
INSERT INTO `x2_cityarea` VALUES (411628, '411628', '鹿邑县', '411600');
INSERT INTO `x2_cityarea` VALUES (411681, '411681', '项城市', '411600');
INSERT INTO `x2_cityarea` VALUES (411701, '411701', '市辖区', '411700');
INSERT INTO `x2_cityarea` VALUES (411702, '411702', '驿城区', '411700');
INSERT INTO `x2_cityarea` VALUES (411721, '411721', '西平县', '411700');
INSERT INTO `x2_cityarea` VALUES (411722, '411722', '上蔡县', '411700');
INSERT INTO `x2_cityarea` VALUES (411723, '411723', '平舆县', '411700');
INSERT INTO `x2_cityarea` VALUES (411724, '411724', '正阳县', '411700');
INSERT INTO `x2_cityarea` VALUES (411725, '411725', '确山县', '411700');
INSERT INTO `x2_cityarea` VALUES (411726, '411726', '泌阳县', '411700');
INSERT INTO `x2_cityarea` VALUES (411727, '411727', '汝南县', '411700');
INSERT INTO `x2_cityarea` VALUES (411728, '411728', '遂平县', '411700');
INSERT INTO `x2_cityarea` VALUES (411729, '411729', '新蔡县', '411700');
INSERT INTO `x2_cityarea` VALUES (420101, '420101', '市辖区', '420100');
INSERT INTO `x2_cityarea` VALUES (420102, '420102', '江岸区', '420100');
INSERT INTO `x2_cityarea` VALUES (420103, '420103', '江汉区', '420100');
INSERT INTO `x2_cityarea` VALUES (420104, '420104', '乔口区', '420100');
INSERT INTO `x2_cityarea` VALUES (420105, '420105', '汉阳区', '420100');
INSERT INTO `x2_cityarea` VALUES (420106, '420106', '武昌区', '420100');
INSERT INTO `x2_cityarea` VALUES (420107, '420107', '青山区', '420100');
INSERT INTO `x2_cityarea` VALUES (420111, '420111', '洪山区', '420100');
INSERT INTO `x2_cityarea` VALUES (420112, '420112', '东西湖区', '420100');
INSERT INTO `x2_cityarea` VALUES (420113, '420113', '汉南区', '420100');
INSERT INTO `x2_cityarea` VALUES (420114, '420114', '蔡甸区', '420100');
INSERT INTO `x2_cityarea` VALUES (420115, '420115', '江夏区', '420100');
INSERT INTO `x2_cityarea` VALUES (420116, '420116', '黄陂区', '420100');
INSERT INTO `x2_cityarea` VALUES (420117, '420117', '新洲区', '420100');
INSERT INTO `x2_cityarea` VALUES (420201, '420201', '市辖区', '420200');
INSERT INTO `x2_cityarea` VALUES (420202, '420202', '黄石港区', '420200');
INSERT INTO `x2_cityarea` VALUES (420203, '420203', '西塞山区', '420200');
INSERT INTO `x2_cityarea` VALUES (420204, '420204', '下陆区', '420200');
INSERT INTO `x2_cityarea` VALUES (420205, '420205', '铁山区', '420200');
INSERT INTO `x2_cityarea` VALUES (420222, '420222', '阳新县', '420200');
INSERT INTO `x2_cityarea` VALUES (420281, '420281', '大冶市', '420200');
INSERT INTO `x2_cityarea` VALUES (420301, '420301', '市辖区', '420300');
INSERT INTO `x2_cityarea` VALUES (420302, '420302', '茅箭区', '420300');
INSERT INTO `x2_cityarea` VALUES (420303, '420303', '张湾区', '420300');
INSERT INTO `x2_cityarea` VALUES (420321, '420321', '郧　县', '420300');
INSERT INTO `x2_cityarea` VALUES (420322, '420322', '郧西县', '420300');
INSERT INTO `x2_cityarea` VALUES (420323, '420323', '竹山县', '420300');
INSERT INTO `x2_cityarea` VALUES (420324, '420324', '竹溪县', '420300');
INSERT INTO `x2_cityarea` VALUES (420325, '420325', '房　县', '420300');
INSERT INTO `x2_cityarea` VALUES (420381, '420381', '丹江口市', '420300');
INSERT INTO `x2_cityarea` VALUES (420501, '420501', '市辖区', '420500');
INSERT INTO `x2_cityarea` VALUES (420502, '420502', '西陵区', '420500');
INSERT INTO `x2_cityarea` VALUES (420503, '420503', '伍家岗区', '420500');
INSERT INTO `x2_cityarea` VALUES (420504, '420504', '点军区', '420500');
INSERT INTO `x2_cityarea` VALUES (420505, '420505', '猇亭区', '420500');
INSERT INTO `x2_cityarea` VALUES (420506, '420506', '夷陵区', '420500');
INSERT INTO `x2_cityarea` VALUES (420525, '420525', '远安县', '420500');
INSERT INTO `x2_cityarea` VALUES (420526, '420526', '兴山县', '420500');
INSERT INTO `x2_cityarea` VALUES (420527, '420527', '秭归县', '420500');
INSERT INTO `x2_cityarea` VALUES (420528, '420528', '长阳土家族自治县', '420500');
INSERT INTO `x2_cityarea` VALUES (420529, '420529', '五峰土家族自治县', '420500');
INSERT INTO `x2_cityarea` VALUES (420581, '420581', '宜都市', '420500');
INSERT INTO `x2_cityarea` VALUES (420582, '420582', '当阳市', '420500');
INSERT INTO `x2_cityarea` VALUES (420583, '420583', '枝江市', '420500');
INSERT INTO `x2_cityarea` VALUES (420601, '420601', '市辖区', '420600');
INSERT INTO `x2_cityarea` VALUES (420602, '420602', '襄城区', '420600');
INSERT INTO `x2_cityarea` VALUES (420606, '420606', '樊城区', '420600');
INSERT INTO `x2_cityarea` VALUES (420607, '420607', '襄阳区', '420600');
INSERT INTO `x2_cityarea` VALUES (420624, '420624', '南漳县', '420600');
INSERT INTO `x2_cityarea` VALUES (420625, '420625', '谷城县', '420600');
INSERT INTO `x2_cityarea` VALUES (420626, '420626', '保康县', '420600');
INSERT INTO `x2_cityarea` VALUES (420682, '420682', '老河口市', '420600');
INSERT INTO `x2_cityarea` VALUES (420683, '420683', '枣阳市', '420600');
INSERT INTO `x2_cityarea` VALUES (420684, '420684', '宜城市', '420600');
INSERT INTO `x2_cityarea` VALUES (420701, '420701', '市辖区', '420700');
INSERT INTO `x2_cityarea` VALUES (420702, '420702', '梁子湖区', '420700');
INSERT INTO `x2_cityarea` VALUES (420703, '420703', '华容区', '420700');
INSERT INTO `x2_cityarea` VALUES (420704, '420704', '鄂城区', '420700');
INSERT INTO `x2_cityarea` VALUES (420801, '420801', '市辖区', '420800');
INSERT INTO `x2_cityarea` VALUES (420802, '420802', '东宝区', '420800');
INSERT INTO `x2_cityarea` VALUES (420804, '420804', '掇刀区', '420800');
INSERT INTO `x2_cityarea` VALUES (420821, '420821', '京山县', '420800');
INSERT INTO `x2_cityarea` VALUES (420822, '420822', '沙洋县', '420800');
INSERT INTO `x2_cityarea` VALUES (420881, '420881', '钟祥市', '420800');
INSERT INTO `x2_cityarea` VALUES (420901, '420901', '市辖区', '420900');
INSERT INTO `x2_cityarea` VALUES (420902, '420902', '孝南区', '420900');
INSERT INTO `x2_cityarea` VALUES (420921, '420921', '孝昌县', '420900');
INSERT INTO `x2_cityarea` VALUES (420922, '420922', '大悟县', '420900');
INSERT INTO `x2_cityarea` VALUES (420923, '420923', '云梦县', '420900');
INSERT INTO `x2_cityarea` VALUES (420981, '420981', '应城市', '420900');
INSERT INTO `x2_cityarea` VALUES (420982, '420982', '安陆市', '420900');
INSERT INTO `x2_cityarea` VALUES (420984, '420984', '汉川市', '420900');
INSERT INTO `x2_cityarea` VALUES (421001, '421001', '市辖区', '421000');
INSERT INTO `x2_cityarea` VALUES (421002, '421002', '沙市区', '421000');
INSERT INTO `x2_cityarea` VALUES (421003, '421003', '荆州区', '421000');
INSERT INTO `x2_cityarea` VALUES (421022, '421022', '公安县', '421000');
INSERT INTO `x2_cityarea` VALUES (421023, '421023', '监利县', '421000');
INSERT INTO `x2_cityarea` VALUES (421024, '421024', '江陵县', '421000');
INSERT INTO `x2_cityarea` VALUES (421081, '421081', '石首市', '421000');
INSERT INTO `x2_cityarea` VALUES (421083, '421083', '洪湖市', '421000');
INSERT INTO `x2_cityarea` VALUES (421087, '421087', '松滋市', '421000');
INSERT INTO `x2_cityarea` VALUES (421101, '421101', '市辖区', '421100');
INSERT INTO `x2_cityarea` VALUES (421102, '421102', '黄州区', '421100');
INSERT INTO `x2_cityarea` VALUES (421121, '421121', '团风县', '421100');
INSERT INTO `x2_cityarea` VALUES (421122, '421122', '红安县', '421100');
INSERT INTO `x2_cityarea` VALUES (421123, '421123', '罗田县', '421100');
INSERT INTO `x2_cityarea` VALUES (421124, '421124', '英山县', '421100');
INSERT INTO `x2_cityarea` VALUES (421125, '421125', '浠水县', '421100');
INSERT INTO `x2_cityarea` VALUES (421126, '421126', '蕲春县', '421100');
INSERT INTO `x2_cityarea` VALUES (421127, '421127', '黄梅县', '421100');
INSERT INTO `x2_cityarea` VALUES (421181, '421181', '麻城市', '421100');
INSERT INTO `x2_cityarea` VALUES (421182, '421182', '武穴市', '421100');
INSERT INTO `x2_cityarea` VALUES (421201, '421201', '市辖区', '421200');
INSERT INTO `x2_cityarea` VALUES (421202, '421202', '咸安区', '421200');
INSERT INTO `x2_cityarea` VALUES (421221, '421221', '嘉鱼县', '421200');
INSERT INTO `x2_cityarea` VALUES (421222, '421222', '通城县', '421200');
INSERT INTO `x2_cityarea` VALUES (421223, '421223', '崇阳县', '421200');
INSERT INTO `x2_cityarea` VALUES (421224, '421224', '通山县', '421200');
INSERT INTO `x2_cityarea` VALUES (421281, '421281', '赤壁市', '421200');
INSERT INTO `x2_cityarea` VALUES (421301, '421301', '市辖区', '421300');
INSERT INTO `x2_cityarea` VALUES (421302, '421302', '曾都区', '421300');
INSERT INTO `x2_cityarea` VALUES (421381, '421381', '广水市', '421300');
INSERT INTO `x2_cityarea` VALUES (422801, '422801', '恩施市', '422800');
INSERT INTO `x2_cityarea` VALUES (422802, '422802', '利川市', '422800');
INSERT INTO `x2_cityarea` VALUES (422822, '422822', '建始县', '422800');
INSERT INTO `x2_cityarea` VALUES (422823, '422823', '巴东县', '422800');
INSERT INTO `x2_cityarea` VALUES (422825, '422825', '宣恩县', '422800');
INSERT INTO `x2_cityarea` VALUES (422826, '422826', '咸丰县', '422800');
INSERT INTO `x2_cityarea` VALUES (422827, '422827', '来凤县', '422800');
INSERT INTO `x2_cityarea` VALUES (422828, '422828', '鹤峰县', '422800');
INSERT INTO `x2_cityarea` VALUES (429004, '429004', '仙桃市', '429000');
INSERT INTO `x2_cityarea` VALUES (429005, '429005', '潜江市', '429000');
INSERT INTO `x2_cityarea` VALUES (429006, '429006', '天门市', '429000');
INSERT INTO `x2_cityarea` VALUES (429021, '429021', '神农架林区', '429000');
INSERT INTO `x2_cityarea` VALUES (430101, '430101', '市辖区', '430100');
INSERT INTO `x2_cityarea` VALUES (430102, '430102', '芙蓉区', '430100');
INSERT INTO `x2_cityarea` VALUES (430103, '430103', '天心区', '430100');
INSERT INTO `x2_cityarea` VALUES (430104, '430104', '岳麓区', '430100');
INSERT INTO `x2_cityarea` VALUES (430105, '430105', '开福区', '430100');
INSERT INTO `x2_cityarea` VALUES (430111, '430111', '雨花区', '430100');
INSERT INTO `x2_cityarea` VALUES (430121, '430121', '长沙县', '430100');
INSERT INTO `x2_cityarea` VALUES (430122, '430122', '望城县', '430100');
INSERT INTO `x2_cityarea` VALUES (430124, '430124', '宁乡县', '430100');
INSERT INTO `x2_cityarea` VALUES (430181, '430181', '浏阳市', '430100');
INSERT INTO `x2_cityarea` VALUES (430201, '430201', '市辖区', '430200');
INSERT INTO `x2_cityarea` VALUES (430202, '430202', '荷塘区', '430200');
INSERT INTO `x2_cityarea` VALUES (430203, '430203', '芦淞区', '430200');
INSERT INTO `x2_cityarea` VALUES (430204, '430204', '石峰区', '430200');
INSERT INTO `x2_cityarea` VALUES (430211, '430211', '天元区', '430200');
INSERT INTO `x2_cityarea` VALUES (430221, '430221', '株洲县', '430200');
INSERT INTO `x2_cityarea` VALUES (430223, '430223', '攸　县', '430200');
INSERT INTO `x2_cityarea` VALUES (430224, '430224', '茶陵县', '430200');
INSERT INTO `x2_cityarea` VALUES (430225, '430225', '炎陵县', '430200');
INSERT INTO `x2_cityarea` VALUES (430281, '430281', '醴陵市', '430200');
INSERT INTO `x2_cityarea` VALUES (430301, '430301', '市辖区', '430300');
INSERT INTO `x2_cityarea` VALUES (430302, '430302', '雨湖区', '430300');
INSERT INTO `x2_cityarea` VALUES (430304, '430304', '岳塘区', '430300');
INSERT INTO `x2_cityarea` VALUES (430321, '430321', '湘潭县', '430300');
INSERT INTO `x2_cityarea` VALUES (430381, '430381', '湘乡市', '430300');
INSERT INTO `x2_cityarea` VALUES (430382, '430382', '韶山市', '430300');
INSERT INTO `x2_cityarea` VALUES (430401, '430401', '市辖区', '430400');
INSERT INTO `x2_cityarea` VALUES (430405, '430405', '珠晖区', '430400');
INSERT INTO `x2_cityarea` VALUES (430406, '430406', '雁峰区', '430400');
INSERT INTO `x2_cityarea` VALUES (430407, '430407', '石鼓区', '430400');
INSERT INTO `x2_cityarea` VALUES (430408, '430408', '蒸湘区', '430400');
INSERT INTO `x2_cityarea` VALUES (430412, '430412', '南岳区', '430400');
INSERT INTO `x2_cityarea` VALUES (430421, '430421', '衡阳县', '430400');
INSERT INTO `x2_cityarea` VALUES (430422, '430422', '衡南县', '430400');
INSERT INTO `x2_cityarea` VALUES (430423, '430423', '衡山县', '430400');
INSERT INTO `x2_cityarea` VALUES (430424, '430424', '衡东县', '430400');
INSERT INTO `x2_cityarea` VALUES (430426, '430426', '祁东县', '430400');
INSERT INTO `x2_cityarea` VALUES (430481, '430481', '耒阳市', '430400');
INSERT INTO `x2_cityarea` VALUES (430482, '430482', '常宁市', '430400');
INSERT INTO `x2_cityarea` VALUES (430501, '430501', '市辖区', '430500');
INSERT INTO `x2_cityarea` VALUES (430502, '430502', '双清区', '430500');
INSERT INTO `x2_cityarea` VALUES (430503, '430503', '大祥区', '430500');
INSERT INTO `x2_cityarea` VALUES (430511, '430511', '北塔区', '430500');
INSERT INTO `x2_cityarea` VALUES (430521, '430521', '邵东县', '430500');
INSERT INTO `x2_cityarea` VALUES (430522, '430522', '新邵县', '430500');
INSERT INTO `x2_cityarea` VALUES (430523, '430523', '邵阳县', '430500');
INSERT INTO `x2_cityarea` VALUES (430524, '430524', '隆回县', '430500');
INSERT INTO `x2_cityarea` VALUES (430525, '430525', '洞口县', '430500');
INSERT INTO `x2_cityarea` VALUES (430527, '430527', '绥宁县', '430500');
INSERT INTO `x2_cityarea` VALUES (430528, '430528', '新宁县', '430500');
INSERT INTO `x2_cityarea` VALUES (430529, '430529', '城步苗族自治县', '430500');
INSERT INTO `x2_cityarea` VALUES (430581, '430581', '武冈市', '430500');
INSERT INTO `x2_cityarea` VALUES (430601, '430601', '市辖区', '430600');
INSERT INTO `x2_cityarea` VALUES (430602, '430602', '岳阳楼区', '430600');
INSERT INTO `x2_cityarea` VALUES (430603, '430603', '云溪区', '430600');
INSERT INTO `x2_cityarea` VALUES (430611, '430611', '君山区', '430600');
INSERT INTO `x2_cityarea` VALUES (430621, '430621', '岳阳县', '430600');
INSERT INTO `x2_cityarea` VALUES (430623, '430623', '华容县', '430600');
INSERT INTO `x2_cityarea` VALUES (430624, '430624', '湘阴县', '430600');
INSERT INTO `x2_cityarea` VALUES (430626, '430626', '平江县', '430600');
INSERT INTO `x2_cityarea` VALUES (430681, '430681', '汨罗市', '430600');
INSERT INTO `x2_cityarea` VALUES (430682, '430682', '临湘市', '430600');
INSERT INTO `x2_cityarea` VALUES (430701, '430701', '市辖区', '430700');
INSERT INTO `x2_cityarea` VALUES (430702, '430702', '武陵区', '430700');
INSERT INTO `x2_cityarea` VALUES (430703, '430703', '鼎城区', '430700');
INSERT INTO `x2_cityarea` VALUES (430721, '430721', '安乡县', '430700');
INSERT INTO `x2_cityarea` VALUES (430722, '430722', '汉寿县', '430700');
INSERT INTO `x2_cityarea` VALUES (430723, '430723', '澧　县', '430700');
INSERT INTO `x2_cityarea` VALUES (430724, '430724', '临澧县', '430700');
INSERT INTO `x2_cityarea` VALUES (430725, '430725', '桃源县', '430700');
INSERT INTO `x2_cityarea` VALUES (430726, '430726', '石门县', '430700');
INSERT INTO `x2_cityarea` VALUES (430781, '430781', '津市市', '430700');
INSERT INTO `x2_cityarea` VALUES (430801, '430801', '市辖区', '430800');
INSERT INTO `x2_cityarea` VALUES (430802, '430802', '永定区', '430800');
INSERT INTO `x2_cityarea` VALUES (430811, '430811', '武陵源区', '430800');
INSERT INTO `x2_cityarea` VALUES (430821, '430821', '慈利县', '430800');
INSERT INTO `x2_cityarea` VALUES (430822, '430822', '桑植县', '430800');
INSERT INTO `x2_cityarea` VALUES (430901, '430901', '市辖区', '430900');
INSERT INTO `x2_cityarea` VALUES (430902, '430902', '资阳区', '430900');
INSERT INTO `x2_cityarea` VALUES (430903, '430903', '赫山区', '430900');
INSERT INTO `x2_cityarea` VALUES (430921, '430921', '南　县', '430900');
INSERT INTO `x2_cityarea` VALUES (430922, '430922', '桃江县', '430900');
INSERT INTO `x2_cityarea` VALUES (430923, '430923', '安化县', '430900');
INSERT INTO `x2_cityarea` VALUES (430981, '430981', '沅江市', '430900');
INSERT INTO `x2_cityarea` VALUES (431001, '431001', '市辖区', '431000');
INSERT INTO `x2_cityarea` VALUES (431002, '431002', '北湖区', '431000');
INSERT INTO `x2_cityarea` VALUES (431003, '431003', '苏仙区', '431000');
INSERT INTO `x2_cityarea` VALUES (431021, '431021', '桂阳县', '431000');
INSERT INTO `x2_cityarea` VALUES (431022, '431022', '宜章县', '431000');
INSERT INTO `x2_cityarea` VALUES (431023, '431023', '永兴县', '431000');
INSERT INTO `x2_cityarea` VALUES (431024, '431024', '嘉禾县', '431000');
INSERT INTO `x2_cityarea` VALUES (431025, '431025', '临武县', '431000');
INSERT INTO `x2_cityarea` VALUES (431026, '431026', '汝城县', '431000');
INSERT INTO `x2_cityarea` VALUES (431027, '431027', '桂东县', '431000');
INSERT INTO `x2_cityarea` VALUES (431028, '431028', '安仁县', '431000');
INSERT INTO `x2_cityarea` VALUES (431081, '431081', '资兴市', '431000');
INSERT INTO `x2_cityarea` VALUES (431101, '431101', '市辖区', '431100');
INSERT INTO `x2_cityarea` VALUES (431102, '431102', '零陵区', '431100');
INSERT INTO `x2_cityarea` VALUES (431103, '431103', '冷水滩区', '431100');
INSERT INTO `x2_cityarea` VALUES (431121, '431121', '祁阳县', '431100');
INSERT INTO `x2_cityarea` VALUES (431122, '431122', '东安县', '431100');
INSERT INTO `x2_cityarea` VALUES (431123, '431123', '双牌县', '431100');
INSERT INTO `x2_cityarea` VALUES (431124, '431124', '道　县', '431100');
INSERT INTO `x2_cityarea` VALUES (431125, '431125', '江永县', '431100');
INSERT INTO `x2_cityarea` VALUES (431126, '431126', '宁远县', '431100');
INSERT INTO `x2_cityarea` VALUES (431127, '431127', '蓝山县', '431100');
INSERT INTO `x2_cityarea` VALUES (431128, '431128', '新田县', '431100');
INSERT INTO `x2_cityarea` VALUES (431129, '431129', '江华瑶族自治县', '431100');
INSERT INTO `x2_cityarea` VALUES (431201, '431201', '市辖区', '431200');
INSERT INTO `x2_cityarea` VALUES (431202, '431202', '鹤城区', '431200');
INSERT INTO `x2_cityarea` VALUES (431221, '431221', '中方县', '431200');
INSERT INTO `x2_cityarea` VALUES (431222, '431222', '沅陵县', '431200');
INSERT INTO `x2_cityarea` VALUES (431223, '431223', '辰溪县', '431200');
INSERT INTO `x2_cityarea` VALUES (431224, '431224', '溆浦县', '431200');
INSERT INTO `x2_cityarea` VALUES (431225, '431225', '会同县', '431200');
INSERT INTO `x2_cityarea` VALUES (431226, '431226', '麻阳苗族自治县', '431200');
INSERT INTO `x2_cityarea` VALUES (431227, '431227', '新晃侗族自治县', '431200');
INSERT INTO `x2_cityarea` VALUES (431228, '431228', '芷江侗族自治县', '431200');
INSERT INTO `x2_cityarea` VALUES (431229, '431229', '靖州苗族侗族自治县', '431200');
INSERT INTO `x2_cityarea` VALUES (431230, '431230', '通道侗族自治县', '431200');
INSERT INTO `x2_cityarea` VALUES (431281, '431281', '洪江市', '431200');
INSERT INTO `x2_cityarea` VALUES (431301, '431301', '市辖区', '431300');
INSERT INTO `x2_cityarea` VALUES (431302, '431302', '娄星区', '431300');
INSERT INTO `x2_cityarea` VALUES (431321, '431321', '双峰县', '431300');
INSERT INTO `x2_cityarea` VALUES (431322, '431322', '新化县', '431300');
INSERT INTO `x2_cityarea` VALUES (431381, '431381', '冷水江市', '431300');
INSERT INTO `x2_cityarea` VALUES (431382, '431382', '涟源市', '431300');
INSERT INTO `x2_cityarea` VALUES (433101, '433101', '吉首市', '433100');
INSERT INTO `x2_cityarea` VALUES (433122, '433122', '泸溪县', '433100');
INSERT INTO `x2_cityarea` VALUES (433123, '433123', '凤凰县', '433100');
INSERT INTO `x2_cityarea` VALUES (433124, '433124', '花垣县', '433100');
INSERT INTO `x2_cityarea` VALUES (433125, '433125', '保靖县', '433100');
INSERT INTO `x2_cityarea` VALUES (433126, '433126', '古丈县', '433100');
INSERT INTO `x2_cityarea` VALUES (433127, '433127', '永顺县', '433100');
INSERT INTO `x2_cityarea` VALUES (433130, '433130', '龙山县', '433100');
INSERT INTO `x2_cityarea` VALUES (440101, '440101', '市辖区', '440100');
INSERT INTO `x2_cityarea` VALUES (440102, '440102', '东山区', '440100');
INSERT INTO `x2_cityarea` VALUES (440103, '440103', '荔湾区', '440100');
INSERT INTO `x2_cityarea` VALUES (440104, '440104', '越秀区', '440100');
INSERT INTO `x2_cityarea` VALUES (440105, '440105', '海珠区', '440100');
INSERT INTO `x2_cityarea` VALUES (440106, '440106', '天河区', '440100');
INSERT INTO `x2_cityarea` VALUES (440107, '440107', '芳村区', '440100');
INSERT INTO `x2_cityarea` VALUES (440111, '440111', '白云区', '440100');
INSERT INTO `x2_cityarea` VALUES (440112, '440112', '黄埔区', '440100');
INSERT INTO `x2_cityarea` VALUES (440113, '440113', '番禺区', '440100');
INSERT INTO `x2_cityarea` VALUES (440114, '440114', '花都区', '440100');
INSERT INTO `x2_cityarea` VALUES (440183, '440183', '增城市', '440100');
INSERT INTO `x2_cityarea` VALUES (440184, '440184', '从化市', '440100');
INSERT INTO `x2_cityarea` VALUES (440201, '440201', '市辖区', '440200');
INSERT INTO `x2_cityarea` VALUES (440203, '440203', '武江区', '440200');
INSERT INTO `x2_cityarea` VALUES (440204, '440204', '浈江区', '440200');
INSERT INTO `x2_cityarea` VALUES (440205, '440205', '曲江区', '440200');
INSERT INTO `x2_cityarea` VALUES (440222, '440222', '始兴县', '440200');
INSERT INTO `x2_cityarea` VALUES (440224, '440224', '仁化县', '440200');
INSERT INTO `x2_cityarea` VALUES (440229, '440229', '翁源县', '440200');
INSERT INTO `x2_cityarea` VALUES (440232, '440232', '乳源瑶族自治县', '440200');
INSERT INTO `x2_cityarea` VALUES (440233, '440233', '新丰县', '440200');
INSERT INTO `x2_cityarea` VALUES (440281, '440281', '乐昌市', '440200');
INSERT INTO `x2_cityarea` VALUES (440282, '440282', '南雄市', '440200');
INSERT INTO `x2_cityarea` VALUES (440301, '440301', '市辖区', '440300');
INSERT INTO `x2_cityarea` VALUES (440303, '440303', '罗湖区', '440300');
INSERT INTO `x2_cityarea` VALUES (440304, '440304', '福田区', '440300');
INSERT INTO `x2_cityarea` VALUES (440305, '440305', '南山区', '440300');
INSERT INTO `x2_cityarea` VALUES (440306, '440306', '宝安区', '440300');
INSERT INTO `x2_cityarea` VALUES (440307, '440307', '龙岗区', '440300');
INSERT INTO `x2_cityarea` VALUES (440308, '440308', '盐田区', '440300');
INSERT INTO `x2_cityarea` VALUES (440401, '440401', '市辖区', '440400');
INSERT INTO `x2_cityarea` VALUES (440402, '440402', '香洲区', '440400');
INSERT INTO `x2_cityarea` VALUES (440403, '440403', '斗门区', '440400');
INSERT INTO `x2_cityarea` VALUES (440404, '440404', '金湾区', '440400');
INSERT INTO `x2_cityarea` VALUES (440501, '440501', '市辖区', '440500');
INSERT INTO `x2_cityarea` VALUES (440507, '440507', '龙湖区', '440500');
INSERT INTO `x2_cityarea` VALUES (440511, '440511', '金平区', '440500');
INSERT INTO `x2_cityarea` VALUES (440512, '440512', '濠江区', '440500');
INSERT INTO `x2_cityarea` VALUES (440513, '440513', '潮阳区', '440500');
INSERT INTO `x2_cityarea` VALUES (440514, '440514', '潮南区', '440500');
INSERT INTO `x2_cityarea` VALUES (440515, '440515', '澄海区', '440500');
INSERT INTO `x2_cityarea` VALUES (440523, '440523', '南澳县', '440500');
INSERT INTO `x2_cityarea` VALUES (440601, '440601', '市辖区', '440600');
INSERT INTO `x2_cityarea` VALUES (440604, '440604', '禅城区', '440600');
INSERT INTO `x2_cityarea` VALUES (440605, '440605', '南海区', '440600');
INSERT INTO `x2_cityarea` VALUES (440606, '440606', '顺德区', '440600');
INSERT INTO `x2_cityarea` VALUES (440607, '440607', '三水区', '440600');
INSERT INTO `x2_cityarea` VALUES (440608, '440608', '高明区', '440600');
INSERT INTO `x2_cityarea` VALUES (440701, '440701', '市辖区', '440700');
INSERT INTO `x2_cityarea` VALUES (440703, '440703', '蓬江区', '440700');
INSERT INTO `x2_cityarea` VALUES (440704, '440704', '江海区', '440700');
INSERT INTO `x2_cityarea` VALUES (440705, '440705', '新会区', '440700');
INSERT INTO `x2_cityarea` VALUES (440781, '440781', '台山市', '440700');
INSERT INTO `x2_cityarea` VALUES (440783, '440783', '开平市', '440700');
INSERT INTO `x2_cityarea` VALUES (440784, '440784', '鹤山市', '440700');
INSERT INTO `x2_cityarea` VALUES (440785, '440785', '恩平市', '440700');
INSERT INTO `x2_cityarea` VALUES (440801, '440801', '市辖区', '440800');
INSERT INTO `x2_cityarea` VALUES (440802, '440802', '赤坎区', '440800');
INSERT INTO `x2_cityarea` VALUES (440803, '440803', '霞山区', '440800');
INSERT INTO `x2_cityarea` VALUES (440804, '440804', '坡头区', '440800');
INSERT INTO `x2_cityarea` VALUES (440811, '440811', '麻章区', '440800');
INSERT INTO `x2_cityarea` VALUES (440823, '440823', '遂溪县', '440800');
INSERT INTO `x2_cityarea` VALUES (440825, '440825', '徐闻县', '440800');
INSERT INTO `x2_cityarea` VALUES (440881, '440881', '廉江市', '440800');
INSERT INTO `x2_cityarea` VALUES (440882, '440882', '雷州市', '440800');
INSERT INTO `x2_cityarea` VALUES (440883, '440883', '吴川市', '440800');
INSERT INTO `x2_cityarea` VALUES (440901, '440901', '市辖区', '440900');
INSERT INTO `x2_cityarea` VALUES (440902, '440902', '茂南区', '440900');
INSERT INTO `x2_cityarea` VALUES (440903, '440903', '茂港区', '440900');
INSERT INTO `x2_cityarea` VALUES (440923, '440923', '电白县', '440900');
INSERT INTO `x2_cityarea` VALUES (440981, '440981', '高州市', '440900');
INSERT INTO `x2_cityarea` VALUES (440982, '440982', '化州市', '440900');
INSERT INTO `x2_cityarea` VALUES (440983, '440983', '信宜市', '440900');
INSERT INTO `x2_cityarea` VALUES (441201, '441201', '市辖区', '441200');
INSERT INTO `x2_cityarea` VALUES (441202, '441202', '端州区', '441200');
INSERT INTO `x2_cityarea` VALUES (441203, '441203', '鼎湖区', '441200');
INSERT INTO `x2_cityarea` VALUES (441223, '441223', '广宁县', '441200');
INSERT INTO `x2_cityarea` VALUES (441224, '441224', '怀集县', '441200');
INSERT INTO `x2_cityarea` VALUES (441225, '441225', '封开县', '441200');
INSERT INTO `x2_cityarea` VALUES (441226, '441226', '德庆县', '441200');
INSERT INTO `x2_cityarea` VALUES (441283, '441283', '高要市', '441200');
INSERT INTO `x2_cityarea` VALUES (441284, '441284', '四会市', '441200');
INSERT INTO `x2_cityarea` VALUES (441301, '441301', '市辖区', '441300');
INSERT INTO `x2_cityarea` VALUES (441302, '441302', '惠城区', '441300');
INSERT INTO `x2_cityarea` VALUES (441303, '441303', '惠阳区', '441300');
INSERT INTO `x2_cityarea` VALUES (441322, '441322', '博罗县', '441300');
INSERT INTO `x2_cityarea` VALUES (441323, '441323', '惠东县', '441300');
INSERT INTO `x2_cityarea` VALUES (441324, '441324', '龙门县', '441300');
INSERT INTO `x2_cityarea` VALUES (441401, '441401', '市辖区', '441400');
INSERT INTO `x2_cityarea` VALUES (441402, '441402', '梅江区', '441400');
INSERT INTO `x2_cityarea` VALUES (441421, '441421', '梅　县', '441400');
INSERT INTO `x2_cityarea` VALUES (441422, '441422', '大埔县', '441400');
INSERT INTO `x2_cityarea` VALUES (441423, '441423', '丰顺县', '441400');
INSERT INTO `x2_cityarea` VALUES (441424, '441424', '五华县', '441400');
INSERT INTO `x2_cityarea` VALUES (441426, '441426', '平远县', '441400');
INSERT INTO `x2_cityarea` VALUES (441427, '441427', '蕉岭县', '441400');
INSERT INTO `x2_cityarea` VALUES (441481, '441481', '兴宁市', '441400');
INSERT INTO `x2_cityarea` VALUES (441501, '441501', '市辖区', '441500');
INSERT INTO `x2_cityarea` VALUES (441502, '441502', '城　区', '441500');
INSERT INTO `x2_cityarea` VALUES (441521, '441521', '海丰县', '441500');
INSERT INTO `x2_cityarea` VALUES (441523, '441523', '陆河县', '441500');
INSERT INTO `x2_cityarea` VALUES (441581, '441581', '陆丰市', '441500');
INSERT INTO `x2_cityarea` VALUES (441601, '441601', '市辖区', '441600');
INSERT INTO `x2_cityarea` VALUES (441602, '441602', '源城区', '441600');
INSERT INTO `x2_cityarea` VALUES (441621, '441621', '紫金县', '441600');
INSERT INTO `x2_cityarea` VALUES (441622, '441622', '龙川县', '441600');
INSERT INTO `x2_cityarea` VALUES (441623, '441623', '连平县', '441600');
INSERT INTO `x2_cityarea` VALUES (441624, '441624', '和平县', '441600');
INSERT INTO `x2_cityarea` VALUES (441625, '441625', '东源县', '441600');
INSERT INTO `x2_cityarea` VALUES (441701, '441701', '市辖区', '441700');
INSERT INTO `x2_cityarea` VALUES (441702, '441702', '江城区', '441700');
INSERT INTO `x2_cityarea` VALUES (441721, '441721', '阳西县', '441700');
INSERT INTO `x2_cityarea` VALUES (441723, '441723', '阳东县', '441700');
INSERT INTO `x2_cityarea` VALUES (441781, '441781', '阳春市', '441700');
INSERT INTO `x2_cityarea` VALUES (441801, '441801', '市辖区', '441800');
INSERT INTO `x2_cityarea` VALUES (441802, '441802', '清城区', '441800');
INSERT INTO `x2_cityarea` VALUES (441821, '441821', '佛冈县', '441800');
INSERT INTO `x2_cityarea` VALUES (441823, '441823', '阳山县', '441800');
INSERT INTO `x2_cityarea` VALUES (441825, '441825', '连山壮族瑶族自治县', '441800');
INSERT INTO `x2_cityarea` VALUES (441826, '441826', '连南瑶族自治县', '441800');
INSERT INTO `x2_cityarea` VALUES (441827, '441827', '清新县', '441800');
INSERT INTO `x2_cityarea` VALUES (441881, '441881', '英德市', '441800');
INSERT INTO `x2_cityarea` VALUES (441882, '441882', '连州市', '441800');
INSERT INTO `x2_cityarea` VALUES (445101, '445101', '市辖区', '445100');
INSERT INTO `x2_cityarea` VALUES (445102, '445102', '湘桥区', '445100');
INSERT INTO `x2_cityarea` VALUES (445121, '445121', '潮安县', '445100');
INSERT INTO `x2_cityarea` VALUES (445122, '445122', '饶平县', '445100');
INSERT INTO `x2_cityarea` VALUES (445201, '445201', '市辖区', '445200');
INSERT INTO `x2_cityarea` VALUES (445202, '445202', '榕城区', '445200');
INSERT INTO `x2_cityarea` VALUES (445221, '445221', '揭东县', '445200');
INSERT INTO `x2_cityarea` VALUES (445222, '445222', '揭西县', '445200');
INSERT INTO `x2_cityarea` VALUES (445224, '445224', '惠来县', '445200');
INSERT INTO `x2_cityarea` VALUES (445281, '445281', '普宁市', '445200');
INSERT INTO `x2_cityarea` VALUES (445301, '445301', '市辖区', '445300');
INSERT INTO `x2_cityarea` VALUES (445302, '445302', '云城区', '445300');
INSERT INTO `x2_cityarea` VALUES (445321, '445321', '新兴县', '445300');
INSERT INTO `x2_cityarea` VALUES (445322, '445322', '郁南县', '445300');
INSERT INTO `x2_cityarea` VALUES (445323, '445323', '云安县', '445300');
INSERT INTO `x2_cityarea` VALUES (445381, '445381', '罗定市', '445300');
INSERT INTO `x2_cityarea` VALUES (450101, '450101', '市辖区', '450100');
INSERT INTO `x2_cityarea` VALUES (450102, '450102', '兴宁区', '450100');
INSERT INTO `x2_cityarea` VALUES (450103, '450103', '青秀区', '450100');
INSERT INTO `x2_cityarea` VALUES (450105, '450105', '江南区', '450100');
INSERT INTO `x2_cityarea` VALUES (450107, '450107', '西乡塘区', '450100');
INSERT INTO `x2_cityarea` VALUES (450108, '450108', '良庆区', '450100');
INSERT INTO `x2_cityarea` VALUES (450109, '450109', '邕宁区', '450100');
INSERT INTO `x2_cityarea` VALUES (450122, '450122', '武鸣县', '450100');
INSERT INTO `x2_cityarea` VALUES (450123, '450123', '隆安县', '450100');
INSERT INTO `x2_cityarea` VALUES (450124, '450124', '马山县', '450100');
INSERT INTO `x2_cityarea` VALUES (450125, '450125', '上林县', '450100');
INSERT INTO `x2_cityarea` VALUES (450126, '450126', '宾阳县', '450100');
INSERT INTO `x2_cityarea` VALUES (450127, '450127', '横　县', '450100');
INSERT INTO `x2_cityarea` VALUES (450201, '450201', '市辖区', '450200');
INSERT INTO `x2_cityarea` VALUES (450202, '450202', '城中区', '450200');
INSERT INTO `x2_cityarea` VALUES (450203, '450203', '鱼峰区', '450200');
INSERT INTO `x2_cityarea` VALUES (450204, '450204', '柳南区', '450200');
INSERT INTO `x2_cityarea` VALUES (450205, '450205', '柳北区', '450200');
INSERT INTO `x2_cityarea` VALUES (450221, '450221', '柳江县', '450200');
INSERT INTO `x2_cityarea` VALUES (450222, '450222', '柳城县', '450200');
INSERT INTO `x2_cityarea` VALUES (450223, '450223', '鹿寨县', '450200');
INSERT INTO `x2_cityarea` VALUES (450224, '450224', '融安县', '450200');
INSERT INTO `x2_cityarea` VALUES (450225, '450225', '融水苗族自治县', '450200');
INSERT INTO `x2_cityarea` VALUES (450226, '450226', '三江侗族自治县', '450200');
INSERT INTO `x2_cityarea` VALUES (450301, '450301', '市辖区', '450300');
INSERT INTO `x2_cityarea` VALUES (450302, '450302', '秀峰区', '450300');
INSERT INTO `x2_cityarea` VALUES (450303, '450303', '叠彩区', '450300');
INSERT INTO `x2_cityarea` VALUES (450304, '450304', '象山区', '450300');
INSERT INTO `x2_cityarea` VALUES (450305, '450305', '七星区', '450300');
INSERT INTO `x2_cityarea` VALUES (450311, '450311', '雁山区', '450300');
INSERT INTO `x2_cityarea` VALUES (450321, '450321', '阳朔县', '450300');
INSERT INTO `x2_cityarea` VALUES (450322, '450322', '临桂县', '450300');
INSERT INTO `x2_cityarea` VALUES (450323, '450323', '灵川县', '450300');
INSERT INTO `x2_cityarea` VALUES (450324, '450324', '全州县', '450300');
INSERT INTO `x2_cityarea` VALUES (450325, '450325', '兴安县', '450300');
INSERT INTO `x2_cityarea` VALUES (450326, '450326', '永福县', '450300');
INSERT INTO `x2_cityarea` VALUES (450327, '450327', '灌阳县', '450300');
INSERT INTO `x2_cityarea` VALUES (450328, '450328', '龙胜各族自治县', '450300');
INSERT INTO `x2_cityarea` VALUES (450329, '450329', '资源县', '450300');
INSERT INTO `x2_cityarea` VALUES (450330, '450330', '平乐县', '450300');
INSERT INTO `x2_cityarea` VALUES (450331, '450331', '荔蒲县', '450300');
INSERT INTO `x2_cityarea` VALUES (450332, '450332', '恭城瑶族自治县', '450300');
INSERT INTO `x2_cityarea` VALUES (450401, '450401', '市辖区', '450400');
INSERT INTO `x2_cityarea` VALUES (450403, '450403', '万秀区', '450400');
INSERT INTO `x2_cityarea` VALUES (450404, '450404', '蝶山区', '450400');
INSERT INTO `x2_cityarea` VALUES (450405, '450405', '长洲区', '450400');
INSERT INTO `x2_cityarea` VALUES (450421, '450421', '苍梧县', '450400');
INSERT INTO `x2_cityarea` VALUES (450422, '450422', '藤　县', '450400');
INSERT INTO `x2_cityarea` VALUES (450423, '450423', '蒙山县', '450400');
INSERT INTO `x2_cityarea` VALUES (450481, '450481', '岑溪市', '450400');
INSERT INTO `x2_cityarea` VALUES (450501, '450501', '市辖区', '450500');
INSERT INTO `x2_cityarea` VALUES (450502, '450502', '海城区', '450500');
INSERT INTO `x2_cityarea` VALUES (450503, '450503', '银海区', '450500');
INSERT INTO `x2_cityarea` VALUES (450512, '450512', '铁山港区', '450500');
INSERT INTO `x2_cityarea` VALUES (450521, '450521', '合浦县', '450500');
INSERT INTO `x2_cityarea` VALUES (450601, '450601', '市辖区', '450600');
INSERT INTO `x2_cityarea` VALUES (450602, '450602', '港口区', '450600');
INSERT INTO `x2_cityarea` VALUES (450603, '450603', '防城区', '450600');
INSERT INTO `x2_cityarea` VALUES (450621, '450621', '上思县', '450600');
INSERT INTO `x2_cityarea` VALUES (450681, '450681', '东兴市', '450600');
INSERT INTO `x2_cityarea` VALUES (450701, '450701', '市辖区', '450700');
INSERT INTO `x2_cityarea` VALUES (450702, '450702', '钦南区', '450700');
INSERT INTO `x2_cityarea` VALUES (450703, '450703', '钦北区', '450700');
INSERT INTO `x2_cityarea` VALUES (450721, '450721', '灵山县', '450700');
INSERT INTO `x2_cityarea` VALUES (450722, '450722', '浦北县', '450700');
INSERT INTO `x2_cityarea` VALUES (450801, '450801', '市辖区', '450800');
INSERT INTO `x2_cityarea` VALUES (450802, '450802', '港北区', '450800');
INSERT INTO `x2_cityarea` VALUES (450803, '450803', '港南区', '450800');
INSERT INTO `x2_cityarea` VALUES (450804, '450804', '覃塘区', '450800');
INSERT INTO `x2_cityarea` VALUES (450821, '450821', '平南县', '450800');
INSERT INTO `x2_cityarea` VALUES (450881, '450881', '桂平市', '450800');
INSERT INTO `x2_cityarea` VALUES (450901, '450901', '市辖区', '450900');
INSERT INTO `x2_cityarea` VALUES (450902, '450902', '玉州区', '450900');
INSERT INTO `x2_cityarea` VALUES (450921, '450921', '容　县', '450900');
INSERT INTO `x2_cityarea` VALUES (450922, '450922', '陆川县', '450900');
INSERT INTO `x2_cityarea` VALUES (450923, '450923', '博白县', '450900');
INSERT INTO `x2_cityarea` VALUES (450924, '450924', '兴业县', '450900');
INSERT INTO `x2_cityarea` VALUES (450981, '450981', '北流市', '450900');
INSERT INTO `x2_cityarea` VALUES (451001, '451001', '市辖区', '451000');
INSERT INTO `x2_cityarea` VALUES (451002, '451002', '右江区', '451000');
INSERT INTO `x2_cityarea` VALUES (451021, '451021', '田阳县', '451000');
INSERT INTO `x2_cityarea` VALUES (451022, '451022', '田东县', '451000');
INSERT INTO `x2_cityarea` VALUES (451023, '451023', '平果县', '451000');
INSERT INTO `x2_cityarea` VALUES (451024, '451024', '德保县', '451000');
INSERT INTO `x2_cityarea` VALUES (451025, '451025', '靖西县', '451000');
INSERT INTO `x2_cityarea` VALUES (451026, '451026', '那坡县', '451000');
INSERT INTO `x2_cityarea` VALUES (451027, '451027', '凌云县', '451000');
INSERT INTO `x2_cityarea` VALUES (451028, '451028', '乐业县', '451000');
INSERT INTO `x2_cityarea` VALUES (451029, '451029', '田林县', '451000');
INSERT INTO `x2_cityarea` VALUES (451030, '451030', '西林县', '451000');
INSERT INTO `x2_cityarea` VALUES (451031, '451031', '隆林各族自治县', '451000');
INSERT INTO `x2_cityarea` VALUES (451101, '451101', '市辖区', '451100');
INSERT INTO `x2_cityarea` VALUES (451102, '451102', '八步区', '451100');
INSERT INTO `x2_cityarea` VALUES (451121, '451121', '昭平县', '451100');
INSERT INTO `x2_cityarea` VALUES (451122, '451122', '钟山县', '451100');
INSERT INTO `x2_cityarea` VALUES (451123, '451123', '富川瑶族自治县', '451100');
INSERT INTO `x2_cityarea` VALUES (451201, '451201', '市辖区', '451200');
INSERT INTO `x2_cityarea` VALUES (451202, '451202', '金城江区', '451200');
INSERT INTO `x2_cityarea` VALUES (451221, '451221', '南丹县', '451200');
INSERT INTO `x2_cityarea` VALUES (451222, '451222', '天峨县', '451200');
INSERT INTO `x2_cityarea` VALUES (451223, '451223', '凤山县', '451200');
INSERT INTO `x2_cityarea` VALUES (451224, '451224', '东兰县', '451200');
INSERT INTO `x2_cityarea` VALUES (451225, '451225', '罗城仫佬族自治县', '451200');
INSERT INTO `x2_cityarea` VALUES (451226, '451226', '环江毛南族自治县', '451200');
INSERT INTO `x2_cityarea` VALUES (451227, '451227', '巴马瑶族自治县', '451200');
INSERT INTO `x2_cityarea` VALUES (451228, '451228', '都安瑶族自治县', '451200');
INSERT INTO `x2_cityarea` VALUES (451229, '451229', '大化瑶族自治县', '451200');
INSERT INTO `x2_cityarea` VALUES (451281, '451281', '宜州市', '451200');
INSERT INTO `x2_cityarea` VALUES (451301, '451301', '市辖区', '451300');
INSERT INTO `x2_cityarea` VALUES (451302, '451302', '兴宾区', '451300');
INSERT INTO `x2_cityarea` VALUES (451321, '451321', '忻城县', '451300');
INSERT INTO `x2_cityarea` VALUES (451322, '451322', '象州县', '451300');
INSERT INTO `x2_cityarea` VALUES (451323, '451323', '武宣县', '451300');
INSERT INTO `x2_cityarea` VALUES (451324, '451324', '金秀瑶族自治县', '451300');
INSERT INTO `x2_cityarea` VALUES (451381, '451381', '合山市', '451300');
INSERT INTO `x2_cityarea` VALUES (451401, '451401', '市辖区', '451400');
INSERT INTO `x2_cityarea` VALUES (451402, '451402', '江洲区', '451400');
INSERT INTO `x2_cityarea` VALUES (451421, '451421', '扶绥县', '451400');
INSERT INTO `x2_cityarea` VALUES (451422, '451422', '宁明县', '451400');
INSERT INTO `x2_cityarea` VALUES (451423, '451423', '龙州县', '451400');
INSERT INTO `x2_cityarea` VALUES (451424, '451424', '大新县', '451400');
INSERT INTO `x2_cityarea` VALUES (451425, '451425', '天等县', '451400');
INSERT INTO `x2_cityarea` VALUES (451481, '451481', '凭祥市', '451400');
INSERT INTO `x2_cityarea` VALUES (460101, '460101', '市辖区', '460100');
INSERT INTO `x2_cityarea` VALUES (460105, '460105', '秀英区', '460100');
INSERT INTO `x2_cityarea` VALUES (460106, '460106', '龙华区', '460100');
INSERT INTO `x2_cityarea` VALUES (460107, '460107', '琼山区', '460100');
INSERT INTO `x2_cityarea` VALUES (460108, '460108', '美兰区', '460100');
INSERT INTO `x2_cityarea` VALUES (460201, '460201', '市辖区', '460200');
INSERT INTO `x2_cityarea` VALUES (469001, '469001', '五指山市', '469000');
INSERT INTO `x2_cityarea` VALUES (469002, '469002', '琼海市', '469000');
INSERT INTO `x2_cityarea` VALUES (469003, '469003', '儋州市', '469000');
INSERT INTO `x2_cityarea` VALUES (469005, '469005', '文昌市', '469000');
INSERT INTO `x2_cityarea` VALUES (469006, '469006', '万宁市', '469000');
INSERT INTO `x2_cityarea` VALUES (469007, '469007', '东方市', '469000');
INSERT INTO `x2_cityarea` VALUES (469025, '469025', '定安县', '469000');
INSERT INTO `x2_cityarea` VALUES (469026, '469026', '屯昌县', '469000');
INSERT INTO `x2_cityarea` VALUES (469027, '469027', '澄迈县', '469000');
INSERT INTO `x2_cityarea` VALUES (469028, '469028', '临高县', '469000');
INSERT INTO `x2_cityarea` VALUES (469030, '469030', '白沙黎族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469031, '469031', '昌江黎族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469033, '469033', '乐东黎族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469034, '469034', '陵水黎族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469035, '469035', '保亭黎族苗族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469036, '469036', '琼中黎族苗族自治县', '469000');
INSERT INTO `x2_cityarea` VALUES (469037, '469037', '西沙群岛', '469000');
INSERT INTO `x2_cityarea` VALUES (469038, '469038', '南沙群岛', '469000');
INSERT INTO `x2_cityarea` VALUES (469039, '469039', '中沙群岛的岛礁及其海域', '469000');
INSERT INTO `x2_cityarea` VALUES (500101, '500101', '万州区', '500100');
INSERT INTO `x2_cityarea` VALUES (500102, '500102', '涪陵区', '500100');
INSERT INTO `x2_cityarea` VALUES (500103, '500103', '渝中区', '500100');
INSERT INTO `x2_cityarea` VALUES (500104, '500104', '大渡口区', '500100');
INSERT INTO `x2_cityarea` VALUES (500105, '500105', '江北区', '500100');
INSERT INTO `x2_cityarea` VALUES (500106, '500106', '沙坪坝区', '500100');
INSERT INTO `x2_cityarea` VALUES (500107, '500107', '九龙坡区', '500100');
INSERT INTO `x2_cityarea` VALUES (500108, '500108', '南岸区', '500100');
INSERT INTO `x2_cityarea` VALUES (500109, '500109', '北碚区', '500100');
INSERT INTO `x2_cityarea` VALUES (500110, '500110', '万盛区', '500100');
INSERT INTO `x2_cityarea` VALUES (500111, '500111', '双桥区', '500100');
INSERT INTO `x2_cityarea` VALUES (500112, '500112', '渝北区', '500100');
INSERT INTO `x2_cityarea` VALUES (500113, '500113', '巴南区', '500100');
INSERT INTO `x2_cityarea` VALUES (500114, '500114', '黔江区', '500100');
INSERT INTO `x2_cityarea` VALUES (500115, '500115', '长寿区', '500100');
INSERT INTO `x2_cityarea` VALUES (500222, '500222', '綦江县', '500200');
INSERT INTO `x2_cityarea` VALUES (500223, '500223', '潼南县', '500200');
INSERT INTO `x2_cityarea` VALUES (500224, '500224', '铜梁县', '500200');
INSERT INTO `x2_cityarea` VALUES (500225, '500225', '大足县', '500200');
INSERT INTO `x2_cityarea` VALUES (500226, '500226', '荣昌县', '500200');
INSERT INTO `x2_cityarea` VALUES (500227, '500227', '璧山县', '500200');
INSERT INTO `x2_cityarea` VALUES (500228, '500228', '梁平县', '500200');
INSERT INTO `x2_cityarea` VALUES (500229, '500229', '城口县', '500200');
INSERT INTO `x2_cityarea` VALUES (500230, '500230', '丰都县', '500200');
INSERT INTO `x2_cityarea` VALUES (500231, '500231', '垫江县', '500200');
INSERT INTO `x2_cityarea` VALUES (500232, '500232', '武隆县', '500200');
INSERT INTO `x2_cityarea` VALUES (500233, '500233', '忠　县', '500200');
INSERT INTO `x2_cityarea` VALUES (500234, '500234', '开　县', '500200');
INSERT INTO `x2_cityarea` VALUES (500235, '500235', '云阳县', '500200');
INSERT INTO `x2_cityarea` VALUES (500236, '500236', '奉节县', '500200');
INSERT INTO `x2_cityarea` VALUES (500237, '500237', '巫山县', '500200');
INSERT INTO `x2_cityarea` VALUES (500238, '500238', '巫溪县', '500200');
INSERT INTO `x2_cityarea` VALUES (500240, '500240', '石柱土家族自治县', '500200');
INSERT INTO `x2_cityarea` VALUES (500241, '500241', '秀山土家族苗族自治县', '500200');
INSERT INTO `x2_cityarea` VALUES (500242, '500242', '酉阳土家族苗族自治县', '500200');
INSERT INTO `x2_cityarea` VALUES (500243, '500243', '彭水苗族土家族自治县', '500200');
INSERT INTO `x2_cityarea` VALUES (500116, '500381', '江津市', '500300');
INSERT INTO `x2_cityarea` VALUES (500117, '500382', '合川市', '500300');
INSERT INTO `x2_cityarea` VALUES (500118, '500383', '永川市', '500300');
INSERT INTO `x2_cityarea` VALUES (500119, '500384', '南川市', '500300');
INSERT INTO `x2_cityarea` VALUES (510101, '510101', '市辖区', '510100');
INSERT INTO `x2_cityarea` VALUES (510104, '510104', '锦江区', '510100');
INSERT INTO `x2_cityarea` VALUES (510105, '510105', '青羊区', '510100');
INSERT INTO `x2_cityarea` VALUES (510106, '510106', '金牛区', '510100');
INSERT INTO `x2_cityarea` VALUES (510107, '510107', '武侯区', '510100');
INSERT INTO `x2_cityarea` VALUES (510108, '510108', '成华区', '510100');
INSERT INTO `x2_cityarea` VALUES (510112, '510112', '龙泉驿区', '510100');
INSERT INTO `x2_cityarea` VALUES (510113, '510113', '青白江区', '510100');
INSERT INTO `x2_cityarea` VALUES (510114, '510114', '新都区', '510100');
INSERT INTO `x2_cityarea` VALUES (510115, '510115', '温江区', '510100');
INSERT INTO `x2_cityarea` VALUES (510121, '510121', '金堂县', '510100');
INSERT INTO `x2_cityarea` VALUES (510122, '510122', '双流县', '510100');
INSERT INTO `x2_cityarea` VALUES (510124, '510124', '郫　县', '510100');
INSERT INTO `x2_cityarea` VALUES (510129, '510129', '大邑县', '510100');
INSERT INTO `x2_cityarea` VALUES (510131, '510131', '蒲江县', '510100');
INSERT INTO `x2_cityarea` VALUES (510132, '510132', '新津县', '510100');
INSERT INTO `x2_cityarea` VALUES (510181, '510181', '都江堰市', '510100');
INSERT INTO `x2_cityarea` VALUES (510182, '510182', '彭州市', '510100');
INSERT INTO `x2_cityarea` VALUES (510183, '510183', '邛崃市', '510100');
INSERT INTO `x2_cityarea` VALUES (510184, '510184', '崇州市', '510100');
INSERT INTO `x2_cityarea` VALUES (510301, '510301', '市辖区', '510300');
INSERT INTO `x2_cityarea` VALUES (510302, '510302', '自流井区', '510300');
INSERT INTO `x2_cityarea` VALUES (510303, '510303', '贡井区', '510300');
INSERT INTO `x2_cityarea` VALUES (510304, '510304', '大安区', '510300');
INSERT INTO `x2_cityarea` VALUES (510311, '510311', '沿滩区', '510300');
INSERT INTO `x2_cityarea` VALUES (510321, '510321', '荣　县', '510300');
INSERT INTO `x2_cityarea` VALUES (510322, '510322', '富顺县', '510300');
INSERT INTO `x2_cityarea` VALUES (510401, '510401', '市辖区', '510400');
INSERT INTO `x2_cityarea` VALUES (510402, '510402', '东　区', '510400');
INSERT INTO `x2_cityarea` VALUES (510403, '510403', '西　区', '510400');
INSERT INTO `x2_cityarea` VALUES (510411, '510411', '仁和区', '510400');
INSERT INTO `x2_cityarea` VALUES (510421, '510421', '米易县', '510400');
INSERT INTO `x2_cityarea` VALUES (510422, '510422', '盐边县', '510400');
INSERT INTO `x2_cityarea` VALUES (510501, '510501', '市辖区', '510500');
INSERT INTO `x2_cityarea` VALUES (510502, '510502', '江阳区', '510500');
INSERT INTO `x2_cityarea` VALUES (510503, '510503', '纳溪区', '510500');
INSERT INTO `x2_cityarea` VALUES (510504, '510504', '龙马潭区', '510500');
INSERT INTO `x2_cityarea` VALUES (510521, '510521', '泸　县', '510500');
INSERT INTO `x2_cityarea` VALUES (510522, '510522', '合江县', '510500');
INSERT INTO `x2_cityarea` VALUES (510524, '510524', '叙永县', '510500');
INSERT INTO `x2_cityarea` VALUES (510525, '510525', '古蔺县', '510500');
INSERT INTO `x2_cityarea` VALUES (510601, '510601', '市辖区', '510600');
INSERT INTO `x2_cityarea` VALUES (510603, '510603', '旌阳区', '510600');
INSERT INTO `x2_cityarea` VALUES (510623, '510623', '中江县', '510600');
INSERT INTO `x2_cityarea` VALUES (510626, '510626', '罗江县', '510600');
INSERT INTO `x2_cityarea` VALUES (510681, '510681', '广汉市', '510600');
INSERT INTO `x2_cityarea` VALUES (510682, '510682', '什邡市', '510600');
INSERT INTO `x2_cityarea` VALUES (510683, '510683', '绵竹市', '510600');
INSERT INTO `x2_cityarea` VALUES (510701, '510701', '市辖区', '510700');
INSERT INTO `x2_cityarea` VALUES (510703, '510703', '涪城区', '510700');
INSERT INTO `x2_cityarea` VALUES (510704, '510704', '游仙区', '510700');
INSERT INTO `x2_cityarea` VALUES (510722, '510722', '三台县', '510700');
INSERT INTO `x2_cityarea` VALUES (510723, '510723', '盐亭县', '510700');
INSERT INTO `x2_cityarea` VALUES (510724, '510724', '安　县', '510700');
INSERT INTO `x2_cityarea` VALUES (510725, '510725', '梓潼县', '510700');
INSERT INTO `x2_cityarea` VALUES (510726, '510726', '北川羌族自治县', '510700');
INSERT INTO `x2_cityarea` VALUES (510727, '510727', '平武县', '510700');
INSERT INTO `x2_cityarea` VALUES (510781, '510781', '江油市', '510700');
INSERT INTO `x2_cityarea` VALUES (510801, '510801', '市辖区', '510800');
INSERT INTO `x2_cityarea` VALUES (510802, '510802', '市中区', '510800');
INSERT INTO `x2_cityarea` VALUES (510811, '510811', '元坝区', '510800');
INSERT INTO `x2_cityarea` VALUES (510812, '510812', '朝天区', '510800');
INSERT INTO `x2_cityarea` VALUES (510821, '510821', '旺苍县', '510800');
INSERT INTO `x2_cityarea` VALUES (510822, '510822', '青川县', '510800');
INSERT INTO `x2_cityarea` VALUES (510823, '510823', '剑阁县', '510800');
INSERT INTO `x2_cityarea` VALUES (510824, '510824', '苍溪县', '510800');
INSERT INTO `x2_cityarea` VALUES (510901, '510901', '市辖区', '510900');
INSERT INTO `x2_cityarea` VALUES (510903, '510903', '船山区', '510900');
INSERT INTO `x2_cityarea` VALUES (510904, '510904', '安居区', '510900');
INSERT INTO `x2_cityarea` VALUES (510921, '510921', '蓬溪县', '510900');
INSERT INTO `x2_cityarea` VALUES (510922, '510922', '射洪县', '510900');
INSERT INTO `x2_cityarea` VALUES (510923, '510923', '大英县', '510900');
INSERT INTO `x2_cityarea` VALUES (511001, '511001', '市辖区', '511000');
INSERT INTO `x2_cityarea` VALUES (511002, '511002', '市中区', '511000');
INSERT INTO `x2_cityarea` VALUES (511011, '511011', '东兴区', '511000');
INSERT INTO `x2_cityarea` VALUES (511024, '511024', '威远县', '511000');
INSERT INTO `x2_cityarea` VALUES (511025, '511025', '资中县', '511000');
INSERT INTO `x2_cityarea` VALUES (511028, '511028', '隆昌县', '511000');
INSERT INTO `x2_cityarea` VALUES (511101, '511101', '市辖区', '511100');
INSERT INTO `x2_cityarea` VALUES (511102, '511102', '市中区', '511100');
INSERT INTO `x2_cityarea` VALUES (511111, '511111', '沙湾区', '511100');
INSERT INTO `x2_cityarea` VALUES (511112, '511112', '五通桥区', '511100');
INSERT INTO `x2_cityarea` VALUES (511113, '511113', '金口河区', '511100');
INSERT INTO `x2_cityarea` VALUES (511123, '511123', '犍为县', '511100');
INSERT INTO `x2_cityarea` VALUES (511124, '511124', '井研县', '511100');
INSERT INTO `x2_cityarea` VALUES (511126, '511126', '夹江县', '511100');
INSERT INTO `x2_cityarea` VALUES (511129, '511129', '沐川县', '511100');
INSERT INTO `x2_cityarea` VALUES (511132, '511132', '峨边彝族自治县', '511100');
INSERT INTO `x2_cityarea` VALUES (511133, '511133', '马边彝族自治县', '511100');
INSERT INTO `x2_cityarea` VALUES (511181, '511181', '峨眉山市', '511100');
INSERT INTO `x2_cityarea` VALUES (511301, '511301', '市辖区', '511300');
INSERT INTO `x2_cityarea` VALUES (511302, '511302', '顺庆区', '511300');
INSERT INTO `x2_cityarea` VALUES (511303, '511303', '高坪区', '511300');
INSERT INTO `x2_cityarea` VALUES (511304, '511304', '嘉陵区', '511300');
INSERT INTO `x2_cityarea` VALUES (511321, '511321', '南部县', '511300');
INSERT INTO `x2_cityarea` VALUES (511322, '511322', '营山县', '511300');
INSERT INTO `x2_cityarea` VALUES (511323, '511323', '蓬安县', '511300');
INSERT INTO `x2_cityarea` VALUES (511324, '511324', '仪陇县', '511300');
INSERT INTO `x2_cityarea` VALUES (511325, '511325', '西充县', '511300');
INSERT INTO `x2_cityarea` VALUES (511381, '511381', '阆中市', '511300');
INSERT INTO `x2_cityarea` VALUES (511401, '511401', '市辖区', '511400');
INSERT INTO `x2_cityarea` VALUES (511402, '511402', '东坡区', '511400');
INSERT INTO `x2_cityarea` VALUES (511421, '511421', '仁寿县', '511400');
INSERT INTO `x2_cityarea` VALUES (511422, '511422', '彭山县', '511400');
INSERT INTO `x2_cityarea` VALUES (511423, '511423', '洪雅县', '511400');
INSERT INTO `x2_cityarea` VALUES (511424, '511424', '丹棱县', '511400');
INSERT INTO `x2_cityarea` VALUES (511425, '511425', '青神县', '511400');
INSERT INTO `x2_cityarea` VALUES (511501, '511501', '市辖区', '511500');
INSERT INTO `x2_cityarea` VALUES (511502, '511502', '翠屏区', '511500');
INSERT INTO `x2_cityarea` VALUES (511521, '511521', '宜宾县', '511500');
INSERT INTO `x2_cityarea` VALUES (511522, '511522', '南溪县', '511500');
INSERT INTO `x2_cityarea` VALUES (511523, '511523', '江安县', '511500');
INSERT INTO `x2_cityarea` VALUES (511524, '511524', '长宁县', '511500');
INSERT INTO `x2_cityarea` VALUES (511525, '511525', '高　县', '511500');
INSERT INTO `x2_cityarea` VALUES (511526, '511526', '珙　县', '511500');
INSERT INTO `x2_cityarea` VALUES (511527, '511527', '筠连县', '511500');
INSERT INTO `x2_cityarea` VALUES (511528, '511528', '兴文县', '511500');
INSERT INTO `x2_cityarea` VALUES (511529, '511529', '屏山县', '511500');
INSERT INTO `x2_cityarea` VALUES (511601, '511601', '市辖区', '511600');
INSERT INTO `x2_cityarea` VALUES (511602, '511602', '广安区', '511600');
INSERT INTO `x2_cityarea` VALUES (511621, '511621', '岳池县', '511600');
INSERT INTO `x2_cityarea` VALUES (511622, '511622', '武胜县', '511600');
INSERT INTO `x2_cityarea` VALUES (511623, '511623', '邻水县', '511600');
INSERT INTO `x2_cityarea` VALUES (511681, '511681', '华莹市', '511600');
INSERT INTO `x2_cityarea` VALUES (511701, '511701', '市辖区', '511700');
INSERT INTO `x2_cityarea` VALUES (511702, '511702', '通川区', '511700');
INSERT INTO `x2_cityarea` VALUES (511721, '511721', '达　县', '511700');
INSERT INTO `x2_cityarea` VALUES (511722, '511722', '宣汉县', '511700');
INSERT INTO `x2_cityarea` VALUES (511723, '511723', '开江县', '511700');
INSERT INTO `x2_cityarea` VALUES (511724, '511724', '大竹县', '511700');
INSERT INTO `x2_cityarea` VALUES (511725, '511725', '渠　县', '511700');
INSERT INTO `x2_cityarea` VALUES (511781, '511781', '万源市', '511700');
INSERT INTO `x2_cityarea` VALUES (511801, '511801', '市辖区', '511800');
INSERT INTO `x2_cityarea` VALUES (511802, '511802', '雨城区', '511800');
INSERT INTO `x2_cityarea` VALUES (511821, '511821', '名山县', '511800');
INSERT INTO `x2_cityarea` VALUES (511822, '511822', '荥经县', '511800');
INSERT INTO `x2_cityarea` VALUES (511823, '511823', '汉源县', '511800');
INSERT INTO `x2_cityarea` VALUES (511824, '511824', '石棉县', '511800');
INSERT INTO `x2_cityarea` VALUES (511825, '511825', '天全县', '511800');
INSERT INTO `x2_cityarea` VALUES (511826, '511826', '芦山县', '511800');
INSERT INTO `x2_cityarea` VALUES (511827, '511827', '宝兴县', '511800');
INSERT INTO `x2_cityarea` VALUES (511901, '511901', '市辖区', '511900');
INSERT INTO `x2_cityarea` VALUES (511902, '511902', '巴州区', '511900');
INSERT INTO `x2_cityarea` VALUES (511921, '511921', '通江县', '511900');
INSERT INTO `x2_cityarea` VALUES (511922, '511922', '南江县', '511900');
INSERT INTO `x2_cityarea` VALUES (511923, '511923', '平昌县', '511900');
INSERT INTO `x2_cityarea` VALUES (512001, '512001', '市辖区', '512000');
INSERT INTO `x2_cityarea` VALUES (512002, '512002', '雁江区', '512000');
INSERT INTO `x2_cityarea` VALUES (512021, '512021', '安岳县', '512000');
INSERT INTO `x2_cityarea` VALUES (512022, '512022', '乐至县', '512000');
INSERT INTO `x2_cityarea` VALUES (512081, '512081', '简阳市', '512000');
INSERT INTO `x2_cityarea` VALUES (513221, '513221', '汶川县', '513200');
INSERT INTO `x2_cityarea` VALUES (513222, '513222', '理　县', '513200');
INSERT INTO `x2_cityarea` VALUES (513223, '513223', '茂　县', '513200');
INSERT INTO `x2_cityarea` VALUES (513224, '513224', '松潘县', '513200');
INSERT INTO `x2_cityarea` VALUES (513225, '513225', '九寨沟县', '513200');
INSERT INTO `x2_cityarea` VALUES (513226, '513226', '金川县', '513200');
INSERT INTO `x2_cityarea` VALUES (513227, '513227', '小金县', '513200');
INSERT INTO `x2_cityarea` VALUES (513228, '513228', '黑水县', '513200');
INSERT INTO `x2_cityarea` VALUES (513229, '513229', '马尔康县', '513200');
INSERT INTO `x2_cityarea` VALUES (513230, '513230', '壤塘县', '513200');
INSERT INTO `x2_cityarea` VALUES (513231, '513231', '阿坝县', '513200');
INSERT INTO `x2_cityarea` VALUES (513232, '513232', '若尔盖县', '513200');
INSERT INTO `x2_cityarea` VALUES (513233, '513233', '红原县', '513200');
INSERT INTO `x2_cityarea` VALUES (513321, '513321', '康定县', '513300');
INSERT INTO `x2_cityarea` VALUES (513322, '513322', '泸定县', '513300');
INSERT INTO `x2_cityarea` VALUES (513323, '513323', '丹巴县', '513300');
INSERT INTO `x2_cityarea` VALUES (513324, '513324', '九龙县', '513300');
INSERT INTO `x2_cityarea` VALUES (513325, '513325', '雅江县', '513300');
INSERT INTO `x2_cityarea` VALUES (513326, '513326', '道孚县', '513300');
INSERT INTO `x2_cityarea` VALUES (513327, '513327', '炉霍县', '513300');
INSERT INTO `x2_cityarea` VALUES (513328, '513328', '甘孜县', '513300');
INSERT INTO `x2_cityarea` VALUES (513329, '513329', '新龙县', '513300');
INSERT INTO `x2_cityarea` VALUES (513330, '513330', '德格县', '513300');
INSERT INTO `x2_cityarea` VALUES (513331, '513331', '白玉县', '513300');
INSERT INTO `x2_cityarea` VALUES (513332, '513332', '石渠县', '513300');
INSERT INTO `x2_cityarea` VALUES (513333, '513333', '色达县', '513300');
INSERT INTO `x2_cityarea` VALUES (513334, '513334', '理塘县', '513300');
INSERT INTO `x2_cityarea` VALUES (513335, '513335', '巴塘县', '513300');
INSERT INTO `x2_cityarea` VALUES (513336, '513336', '乡城县', '513300');
INSERT INTO `x2_cityarea` VALUES (513337, '513337', '稻城县', '513300');
INSERT INTO `x2_cityarea` VALUES (513338, '513338', '得荣县', '513300');
INSERT INTO `x2_cityarea` VALUES (513401, '513401', '西昌市', '513400');
INSERT INTO `x2_cityarea` VALUES (513422, '513422', '木里藏族自治县', '513400');
INSERT INTO `x2_cityarea` VALUES (513423, '513423', '盐源县', '513400');
INSERT INTO `x2_cityarea` VALUES (513424, '513424', '德昌县', '513400');
INSERT INTO `x2_cityarea` VALUES (513425, '513425', '会理县', '513400');
INSERT INTO `x2_cityarea` VALUES (513426, '513426', '会东县', '513400');
INSERT INTO `x2_cityarea` VALUES (513427, '513427', '宁南县', '513400');
INSERT INTO `x2_cityarea` VALUES (513428, '513428', '普格县', '513400');
INSERT INTO `x2_cityarea` VALUES (513429, '513429', '布拖县', '513400');
INSERT INTO `x2_cityarea` VALUES (513430, '513430', '金阳县', '513400');
INSERT INTO `x2_cityarea` VALUES (513431, '513431', '昭觉县', '513400');
INSERT INTO `x2_cityarea` VALUES (513432, '513432', '喜德县', '513400');
INSERT INTO `x2_cityarea` VALUES (513433, '513433', '冕宁县', '513400');
INSERT INTO `x2_cityarea` VALUES (513434, '513434', '越西县', '513400');
INSERT INTO `x2_cityarea` VALUES (513435, '513435', '甘洛县', '513400');
INSERT INTO `x2_cityarea` VALUES (513436, '513436', '美姑县', '513400');
INSERT INTO `x2_cityarea` VALUES (513437, '513437', '雷波县', '513400');
INSERT INTO `x2_cityarea` VALUES (520101, '520101', '市辖区', '520100');
INSERT INTO `x2_cityarea` VALUES (520102, '520102', '南明区', '520100');
INSERT INTO `x2_cityarea` VALUES (520103, '520103', '云岩区', '520100');
INSERT INTO `x2_cityarea` VALUES (520111, '520111', '花溪区', '520100');
INSERT INTO `x2_cityarea` VALUES (520112, '520112', '乌当区', '520100');
INSERT INTO `x2_cityarea` VALUES (520113, '520113', '白云区', '520100');
INSERT INTO `x2_cityarea` VALUES (520114, '520114', '小河区', '520100');
INSERT INTO `x2_cityarea` VALUES (520121, '520121', '开阳县', '520100');
INSERT INTO `x2_cityarea` VALUES (520122, '520122', '息烽县', '520100');
INSERT INTO `x2_cityarea` VALUES (520123, '520123', '修文县', '520100');
INSERT INTO `x2_cityarea` VALUES (520181, '520181', '清镇市', '520100');
INSERT INTO `x2_cityarea` VALUES (520201, '520201', '钟山区', '520200');
INSERT INTO `x2_cityarea` VALUES (520203, '520203', '六枝特区', '520200');
INSERT INTO `x2_cityarea` VALUES (520221, '520221', '水城县', '520200');
INSERT INTO `x2_cityarea` VALUES (520222, '520222', '盘　县', '520200');
INSERT INTO `x2_cityarea` VALUES (520301, '520301', '市辖区', '520300');
INSERT INTO `x2_cityarea` VALUES (520302, '520302', '红花岗区', '520300');
INSERT INTO `x2_cityarea` VALUES (520303, '520303', '汇川区', '520300');
INSERT INTO `x2_cityarea` VALUES (520321, '520321', '遵义县', '520300');
INSERT INTO `x2_cityarea` VALUES (520322, '520322', '桐梓县', '520300');
INSERT INTO `x2_cityarea` VALUES (520323, '520323', '绥阳县', '520300');
INSERT INTO `x2_cityarea` VALUES (520324, '520324', '正安县', '520300');
INSERT INTO `x2_cityarea` VALUES (520325, '520325', '道真仡佬族苗族自治县', '520300');
INSERT INTO `x2_cityarea` VALUES (520326, '520326', '务川仡佬族苗族自治县', '520300');
INSERT INTO `x2_cityarea` VALUES (520327, '520327', '凤冈县', '520300');
INSERT INTO `x2_cityarea` VALUES (520328, '520328', '湄潭县', '520300');
INSERT INTO `x2_cityarea` VALUES (520329, '520329', '余庆县', '520300');
INSERT INTO `x2_cityarea` VALUES (520330, '520330', '习水县', '520300');
INSERT INTO `x2_cityarea` VALUES (520381, '520381', '赤水市', '520300');
INSERT INTO `x2_cityarea` VALUES (520382, '520382', '仁怀市', '520300');
INSERT INTO `x2_cityarea` VALUES (520401, '520401', '市辖区', '520400');
INSERT INTO `x2_cityarea` VALUES (520402, '520402', '西秀区', '520400');
INSERT INTO `x2_cityarea` VALUES (520421, '520421', '平坝县', '520400');
INSERT INTO `x2_cityarea` VALUES (520422, '520422', '普定县', '520400');
INSERT INTO `x2_cityarea` VALUES (520423, '520423', '镇宁布依族苗族自治县', '520400');
INSERT INTO `x2_cityarea` VALUES (520424, '520424', '关岭布依族苗族自治县', '520400');
INSERT INTO `x2_cityarea` VALUES (520425, '520425', '紫云苗族布依族自治县', '520400');
INSERT INTO `x2_cityarea` VALUES (522201, '522201', '铜仁市', '522200');
INSERT INTO `x2_cityarea` VALUES (522222, '522222', '江口县', '522200');
INSERT INTO `x2_cityarea` VALUES (522223, '522223', '玉屏侗族自治县', '522200');
INSERT INTO `x2_cityarea` VALUES (522224, '522224', '石阡县', '522200');
INSERT INTO `x2_cityarea` VALUES (522225, '522225', '思南县', '522200');
INSERT INTO `x2_cityarea` VALUES (522226, '522226', '印江土家族苗族自治县', '522200');
INSERT INTO `x2_cityarea` VALUES (522227, '522227', '德江县', '522200');
INSERT INTO `x2_cityarea` VALUES (522228, '522228', '沿河土家族自治县', '522200');
INSERT INTO `x2_cityarea` VALUES (522229, '522229', '松桃苗族自治县', '522200');
INSERT INTO `x2_cityarea` VALUES (522230, '522230', '万山特区', '522200');
INSERT INTO `x2_cityarea` VALUES (522301, '522301', '兴义市', '522300');
INSERT INTO `x2_cityarea` VALUES (522322, '522322', '兴仁县', '522300');
INSERT INTO `x2_cityarea` VALUES (522323, '522323', '普安县', '522300');
INSERT INTO `x2_cityarea` VALUES (522324, '522324', '晴隆县', '522300');
INSERT INTO `x2_cityarea` VALUES (522325, '522325', '贞丰县', '522300');
INSERT INTO `x2_cityarea` VALUES (522326, '522326', '望谟县', '522300');
INSERT INTO `x2_cityarea` VALUES (522327, '522327', '册亨县', '522300');
INSERT INTO `x2_cityarea` VALUES (522328, '522328', '安龙县', '522300');
INSERT INTO `x2_cityarea` VALUES (522401, '522401', '毕节市', '522400');
INSERT INTO `x2_cityarea` VALUES (522422, '522422', '大方县', '522400');
INSERT INTO `x2_cityarea` VALUES (522423, '522423', '黔西县', '522400');
INSERT INTO `x2_cityarea` VALUES (522424, '522424', '金沙县', '522400');
INSERT INTO `x2_cityarea` VALUES (522425, '522425', '织金县', '522400');
INSERT INTO `x2_cityarea` VALUES (522426, '522426', '纳雍县', '522400');
INSERT INTO `x2_cityarea` VALUES (522427, '522427', '威宁彝族回族苗族自治县', '522400');
INSERT INTO `x2_cityarea` VALUES (522428, '522428', '赫章县', '522400');
INSERT INTO `x2_cityarea` VALUES (522601, '522601', '凯里市', '522600');
INSERT INTO `x2_cityarea` VALUES (522622, '522622', '黄平县', '522600');
INSERT INTO `x2_cityarea` VALUES (522623, '522623', '施秉县', '522600');
INSERT INTO `x2_cityarea` VALUES (522624, '522624', '三穗县', '522600');
INSERT INTO `x2_cityarea` VALUES (522625, '522625', '镇远县', '522600');
INSERT INTO `x2_cityarea` VALUES (522626, '522626', '岑巩县', '522600');
INSERT INTO `x2_cityarea` VALUES (522627, '522627', '天柱县', '522600');
INSERT INTO `x2_cityarea` VALUES (522628, '522628', '锦屏县', '522600');
INSERT INTO `x2_cityarea` VALUES (522629, '522629', '剑河县', '522600');
INSERT INTO `x2_cityarea` VALUES (522630, '522630', '台江县', '522600');
INSERT INTO `x2_cityarea` VALUES (522631, '522631', '黎平县', '522600');
INSERT INTO `x2_cityarea` VALUES (522632, '522632', '榕江县', '522600');
INSERT INTO `x2_cityarea` VALUES (522633, '522633', '从江县', '522600');
INSERT INTO `x2_cityarea` VALUES (522634, '522634', '雷山县', '522600');
INSERT INTO `x2_cityarea` VALUES (522635, '522635', '麻江县', '522600');
INSERT INTO `x2_cityarea` VALUES (522636, '522636', '丹寨县', '522600');
INSERT INTO `x2_cityarea` VALUES (522701, '522701', '都匀市', '522700');
INSERT INTO `x2_cityarea` VALUES (522702, '522702', '福泉市', '522700');
INSERT INTO `x2_cityarea` VALUES (522722, '522722', '荔波县', '522700');
INSERT INTO `x2_cityarea` VALUES (522723, '522723', '贵定县', '522700');
INSERT INTO `x2_cityarea` VALUES (522725, '522725', '瓮安县', '522700');
INSERT INTO `x2_cityarea` VALUES (522726, '522726', '独山县', '522700');
INSERT INTO `x2_cityarea` VALUES (522727, '522727', '平塘县', '522700');
INSERT INTO `x2_cityarea` VALUES (522728, '522728', '罗甸县', '522700');
INSERT INTO `x2_cityarea` VALUES (522729, '522729', '长顺县', '522700');
INSERT INTO `x2_cityarea` VALUES (522730, '522730', '龙里县', '522700');
INSERT INTO `x2_cityarea` VALUES (522731, '522731', '惠水县', '522700');
INSERT INTO `x2_cityarea` VALUES (522732, '522732', '三都水族自治县', '522700');
INSERT INTO `x2_cityarea` VALUES (530101, '530101', '市辖区', '530100');
INSERT INTO `x2_cityarea` VALUES (530102, '530102', '五华区', '530100');
INSERT INTO `x2_cityarea` VALUES (530103, '530103', '盘龙区', '530100');
INSERT INTO `x2_cityarea` VALUES (530111, '530111', '官渡区', '530100');
INSERT INTO `x2_cityarea` VALUES (530112, '530112', '西山区', '530100');
INSERT INTO `x2_cityarea` VALUES (530113, '530113', '东川区', '530100');
INSERT INTO `x2_cityarea` VALUES (530121, '530121', '呈贡县', '530100');
INSERT INTO `x2_cityarea` VALUES (530122, '530122', '晋宁县', '530100');
INSERT INTO `x2_cityarea` VALUES (530124, '530124', '富民县', '530100');
INSERT INTO `x2_cityarea` VALUES (530125, '530125', '宜良县', '530100');
INSERT INTO `x2_cityarea` VALUES (530126, '530126', '石林彝族自治县', '530100');
INSERT INTO `x2_cityarea` VALUES (530127, '530127', '嵩明县', '530100');
INSERT INTO `x2_cityarea` VALUES (530128, '530128', '禄劝彝族苗族自治县', '530100');
INSERT INTO `x2_cityarea` VALUES (530129, '530129', '寻甸回族彝族自治县', '530100');
INSERT INTO `x2_cityarea` VALUES (530181, '530181', '安宁市', '530100');
INSERT INTO `x2_cityarea` VALUES (530301, '530301', '市辖区', '530300');
INSERT INTO `x2_cityarea` VALUES (530302, '530302', '麒麟区', '530300');
INSERT INTO `x2_cityarea` VALUES (530321, '530321', '马龙县', '530300');
INSERT INTO `x2_cityarea` VALUES (530322, '530322', '陆良县', '530300');
INSERT INTO `x2_cityarea` VALUES (530323, '530323', '师宗县', '530300');
INSERT INTO `x2_cityarea` VALUES (530324, '530324', '罗平县', '530300');
INSERT INTO `x2_cityarea` VALUES (530325, '530325', '富源县', '530300');
INSERT INTO `x2_cityarea` VALUES (530326, '530326', '会泽县', '530300');
INSERT INTO `x2_cityarea` VALUES (530328, '530328', '沾益县', '530300');
INSERT INTO `x2_cityarea` VALUES (530381, '530381', '宣威市', '530300');
INSERT INTO `x2_cityarea` VALUES (530401, '530401', '市辖区', '530400');
INSERT INTO `x2_cityarea` VALUES (530402, '530402', '红塔区', '530400');
INSERT INTO `x2_cityarea` VALUES (530421, '530421', '江川县', '530400');
INSERT INTO `x2_cityarea` VALUES (530422, '530422', '澄江县', '530400');
INSERT INTO `x2_cityarea` VALUES (530423, '530423', '通海县', '530400');
INSERT INTO `x2_cityarea` VALUES (530424, '530424', '华宁县', '530400');
INSERT INTO `x2_cityarea` VALUES (530425, '530425', '易门县', '530400');
INSERT INTO `x2_cityarea` VALUES (530426, '530426', '峨山彝族自治县', '530400');
INSERT INTO `x2_cityarea` VALUES (530427, '530427', '新平彝族傣族自治县', '530400');
INSERT INTO `x2_cityarea` VALUES (530428, '530428', '元江哈尼族彝族傣族自治县', '530400');
INSERT INTO `x2_cityarea` VALUES (530501, '530501', '市辖区', '530500');
INSERT INTO `x2_cityarea` VALUES (530502, '530502', '隆阳区', '530500');
INSERT INTO `x2_cityarea` VALUES (530521, '530521', '施甸县', '530500');
INSERT INTO `x2_cityarea` VALUES (530522, '530522', '腾冲县', '530500');
INSERT INTO `x2_cityarea` VALUES (530523, '530523', '龙陵县', '530500');
INSERT INTO `x2_cityarea` VALUES (530524, '530524', '昌宁县', '530500');
INSERT INTO `x2_cityarea` VALUES (530601, '530601', '市辖区', '530600');
INSERT INTO `x2_cityarea` VALUES (530602, '530602', '昭阳区', '530600');
INSERT INTO `x2_cityarea` VALUES (530621, '530621', '鲁甸县', '530600');
INSERT INTO `x2_cityarea` VALUES (530622, '530622', '巧家县', '530600');
INSERT INTO `x2_cityarea` VALUES (530623, '530623', '盐津县', '530600');
INSERT INTO `x2_cityarea` VALUES (530624, '530624', '大关县', '530600');
INSERT INTO `x2_cityarea` VALUES (530625, '530625', '永善县', '530600');
INSERT INTO `x2_cityarea` VALUES (530626, '530626', '绥江县', '530600');
INSERT INTO `x2_cityarea` VALUES (530627, '530627', '镇雄县', '530600');
INSERT INTO `x2_cityarea` VALUES (530628, '530628', '彝良县', '530600');
INSERT INTO `x2_cityarea` VALUES (530629, '530629', '威信县', '530600');
INSERT INTO `x2_cityarea` VALUES (530630, '530630', '水富县', '530600');
INSERT INTO `x2_cityarea` VALUES (530701, '530701', '市辖区', '530700');
INSERT INTO `x2_cityarea` VALUES (530702, '530702', '古城区', '530700');
INSERT INTO `x2_cityarea` VALUES (530721, '530721', '玉龙纳西族自治县', '530700');
INSERT INTO `x2_cityarea` VALUES (530722, '530722', '永胜县', '530700');
INSERT INTO `x2_cityarea` VALUES (530723, '530723', '华坪县', '530700');
INSERT INTO `x2_cityarea` VALUES (530724, '530724', '宁蒗彝族自治县', '530700');
INSERT INTO `x2_cityarea` VALUES (530801, '530801', '市辖区', '530800');
INSERT INTO `x2_cityarea` VALUES (530802, '530802', '翠云区', '530800');
INSERT INTO `x2_cityarea` VALUES (530821, '530821', '普洱哈尼族彝族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530822, '530822', '墨江哈尼族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530823, '530823', '景东彝族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530824, '530824', '景谷傣族彝族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530825, '530825', '镇沅彝族哈尼族拉祜族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530826, '530826', '江城哈尼族彝族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530827, '530827', '孟连傣族拉祜族佤族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530828, '530828', '澜沧拉祜族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530829, '530829', '西盟佤族自治县', '530800');
INSERT INTO `x2_cityarea` VALUES (530901, '530901', '市辖区', '530900');
INSERT INTO `x2_cityarea` VALUES (530902, '530902', '临翔区', '530900');
INSERT INTO `x2_cityarea` VALUES (530921, '530921', '凤庆县', '530900');
INSERT INTO `x2_cityarea` VALUES (530922, '530922', '云　县', '530900');
INSERT INTO `x2_cityarea` VALUES (530923, '530923', '永德县', '530900');
INSERT INTO `x2_cityarea` VALUES (530924, '530924', '镇康县', '530900');
INSERT INTO `x2_cityarea` VALUES (530925, '530925', '双江拉祜族佤族布朗族傣族自治县', '530900');
INSERT INTO `x2_cityarea` VALUES (530926, '530926', '耿马傣族佤族自治县', '530900');
INSERT INTO `x2_cityarea` VALUES (530927, '530927', '沧源佤族自治县', '530900');
INSERT INTO `x2_cityarea` VALUES (532301, '532301', '楚雄市', '532300');
INSERT INTO `x2_cityarea` VALUES (532322, '532322', '双柏县', '532300');
INSERT INTO `x2_cityarea` VALUES (532323, '532323', '牟定县', '532300');
INSERT INTO `x2_cityarea` VALUES (532324, '532324', '南华县', '532300');
INSERT INTO `x2_cityarea` VALUES (532325, '532325', '姚安县', '532300');
INSERT INTO `x2_cityarea` VALUES (532326, '532326', '大姚县', '532300');
INSERT INTO `x2_cityarea` VALUES (532327, '532327', '永仁县', '532300');
INSERT INTO `x2_cityarea` VALUES (532328, '532328', '元谋县', '532300');
INSERT INTO `x2_cityarea` VALUES (532329, '532329', '武定县', '532300');
INSERT INTO `x2_cityarea` VALUES (532331, '532331', '禄丰县', '532300');
INSERT INTO `x2_cityarea` VALUES (532501, '532501', '个旧市', '532500');
INSERT INTO `x2_cityarea` VALUES (532502, '532502', '开远市', '532500');
INSERT INTO `x2_cityarea` VALUES (532522, '532522', '蒙自县', '532500');
INSERT INTO `x2_cityarea` VALUES (532523, '532523', '屏边苗族自治县', '532500');
INSERT INTO `x2_cityarea` VALUES (532524, '532524', '建水县', '532500');
INSERT INTO `x2_cityarea` VALUES (532525, '532525', '石屏县', '532500');
INSERT INTO `x2_cityarea` VALUES (532526, '532526', '弥勒县', '532500');
INSERT INTO `x2_cityarea` VALUES (532527, '532527', '泸西县', '532500');
INSERT INTO `x2_cityarea` VALUES (532528, '532528', '元阳县', '532500');
INSERT INTO `x2_cityarea` VALUES (532529, '532529', '红河县', '532500');
INSERT INTO `x2_cityarea` VALUES (532530, '532530', '金平苗族瑶族傣族自治县', '532500');
INSERT INTO `x2_cityarea` VALUES (532531, '532531', '绿春县', '532500');
INSERT INTO `x2_cityarea` VALUES (532532, '532532', '河口瑶族自治县', '532500');
INSERT INTO `x2_cityarea` VALUES (532621, '532621', '文山县', '532600');
INSERT INTO `x2_cityarea` VALUES (532622, '532622', '砚山县', '532600');
INSERT INTO `x2_cityarea` VALUES (532623, '532623', '西畴县', '532600');
INSERT INTO `x2_cityarea` VALUES (532624, '532624', '麻栗坡县', '532600');
INSERT INTO `x2_cityarea` VALUES (532625, '532625', '马关县', '532600');
INSERT INTO `x2_cityarea` VALUES (532626, '532626', '丘北县', '532600');
INSERT INTO `x2_cityarea` VALUES (532627, '532627', '广南县', '532600');
INSERT INTO `x2_cityarea` VALUES (532628, '532628', '富宁县', '532600');
INSERT INTO `x2_cityarea` VALUES (532801, '532801', '景洪市', '532800');
INSERT INTO `x2_cityarea` VALUES (532822, '532822', '勐海县', '532800');
INSERT INTO `x2_cityarea` VALUES (532823, '532823', '勐腊县', '532800');
INSERT INTO `x2_cityarea` VALUES (532901, '532901', '大理市', '532900');
INSERT INTO `x2_cityarea` VALUES (532922, '532922', '漾濞彝族自治县', '532900');
INSERT INTO `x2_cityarea` VALUES (532923, '532923', '祥云县', '532900');
INSERT INTO `x2_cityarea` VALUES (532924, '532924', '宾川县', '532900');
INSERT INTO `x2_cityarea` VALUES (532925, '532925', '弥渡县', '532900');
INSERT INTO `x2_cityarea` VALUES (532926, '532926', '南涧彝族自治县', '532900');
INSERT INTO `x2_cityarea` VALUES (532927, '532927', '巍山彝族回族自治县', '532900');
INSERT INTO `x2_cityarea` VALUES (532928, '532928', '永平县', '532900');
INSERT INTO `x2_cityarea` VALUES (532929, '532929', '云龙县', '532900');
INSERT INTO `x2_cityarea` VALUES (532930, '532930', '洱源县', '532900');
INSERT INTO `x2_cityarea` VALUES (532931, '532931', '剑川县', '532900');
INSERT INTO `x2_cityarea` VALUES (532932, '532932', '鹤庆县', '532900');
INSERT INTO `x2_cityarea` VALUES (533102, '533102', '瑞丽市', '533100');
INSERT INTO `x2_cityarea` VALUES (533103, '533103', '潞西市', '533100');
INSERT INTO `x2_cityarea` VALUES (533122, '533122', '梁河县', '533100');
INSERT INTO `x2_cityarea` VALUES (533123, '533123', '盈江县', '533100');
INSERT INTO `x2_cityarea` VALUES (533124, '533124', '陇川县', '533100');
INSERT INTO `x2_cityarea` VALUES (533321, '533321', '泸水县', '533300');
INSERT INTO `x2_cityarea` VALUES (533323, '533323', '福贡县', '533300');
INSERT INTO `x2_cityarea` VALUES (533324, '533324', '贡山独龙族怒族自治县', '533300');
INSERT INTO `x2_cityarea` VALUES (533325, '533325', '兰坪白族普米族自治县', '533300');
INSERT INTO `x2_cityarea` VALUES (533421, '533421', '香格里拉县', '533400');
INSERT INTO `x2_cityarea` VALUES (533422, '533422', '德钦县', '533400');
INSERT INTO `x2_cityarea` VALUES (533423, '533423', '维西傈僳族自治县', '533400');
INSERT INTO `x2_cityarea` VALUES (540101, '540101', '市辖区', '540100');
INSERT INTO `x2_cityarea` VALUES (540102, '540102', '城关区', '540100');
INSERT INTO `x2_cityarea` VALUES (540121, '540121', '林周县', '540100');
INSERT INTO `x2_cityarea` VALUES (540122, '540122', '当雄县', '540100');
INSERT INTO `x2_cityarea` VALUES (540123, '540123', '尼木县', '540100');
INSERT INTO `x2_cityarea` VALUES (540124, '540124', '曲水县', '540100');
INSERT INTO `x2_cityarea` VALUES (540125, '540125', '堆龙德庆县', '540100');
INSERT INTO `x2_cityarea` VALUES (540126, '540126', '达孜县', '540100');
INSERT INTO `x2_cityarea` VALUES (540127, '540127', '墨竹工卡县', '540100');
INSERT INTO `x2_cityarea` VALUES (542121, '542121', '昌都县', '542100');
INSERT INTO `x2_cityarea` VALUES (542122, '542122', '江达县', '542100');
INSERT INTO `x2_cityarea` VALUES (542123, '542123', '贡觉县', '542100');
INSERT INTO `x2_cityarea` VALUES (542124, '542124', '类乌齐县', '542100');
INSERT INTO `x2_cityarea` VALUES (542125, '542125', '丁青县', '542100');
INSERT INTO `x2_cityarea` VALUES (542126, '542126', '察雅县', '542100');
INSERT INTO `x2_cityarea` VALUES (542127, '542127', '八宿县', '542100');
INSERT INTO `x2_cityarea` VALUES (542128, '542128', '左贡县', '542100');
INSERT INTO `x2_cityarea` VALUES (542129, '542129', '芒康县', '542100');
INSERT INTO `x2_cityarea` VALUES (542132, '542132', '洛隆县', '542100');
INSERT INTO `x2_cityarea` VALUES (542133, '542133', '边坝县', '542100');
INSERT INTO `x2_cityarea` VALUES (542221, '542221', '乃东县', '542200');
INSERT INTO `x2_cityarea` VALUES (542222, '542222', '扎囊县', '542200');
INSERT INTO `x2_cityarea` VALUES (542223, '542223', '贡嘎县', '542200');
INSERT INTO `x2_cityarea` VALUES (542224, '542224', '桑日县', '542200');
INSERT INTO `x2_cityarea` VALUES (542225, '542225', '琼结县', '542200');
INSERT INTO `x2_cityarea` VALUES (542226, '542226', '曲松县', '542200');
INSERT INTO `x2_cityarea` VALUES (542227, '542227', '措美县', '542200');
INSERT INTO `x2_cityarea` VALUES (542228, '542228', '洛扎县', '542200');
INSERT INTO `x2_cityarea` VALUES (542229, '542229', '加查县', '542200');
INSERT INTO `x2_cityarea` VALUES (542231, '542231', '隆子县', '542200');
INSERT INTO `x2_cityarea` VALUES (542232, '542232', '错那县', '542200');
INSERT INTO `x2_cityarea` VALUES (542233, '542233', '浪卡子县', '542200');
INSERT INTO `x2_cityarea` VALUES (542301, '542301', '日喀则市', '542300');
INSERT INTO `x2_cityarea` VALUES (542322, '542322', '南木林县', '542300');
INSERT INTO `x2_cityarea` VALUES (542323, '542323', '江孜县', '542300');
INSERT INTO `x2_cityarea` VALUES (542324, '542324', '定日县', '542300');
INSERT INTO `x2_cityarea` VALUES (542325, '542325', '萨迦县', '542300');
INSERT INTO `x2_cityarea` VALUES (542326, '542326', '拉孜县', '542300');
INSERT INTO `x2_cityarea` VALUES (542327, '542327', '昂仁县', '542300');
INSERT INTO `x2_cityarea` VALUES (542328, '542328', '谢通门县', '542300');
INSERT INTO `x2_cityarea` VALUES (542329, '542329', '白朗县', '542300');
INSERT INTO `x2_cityarea` VALUES (542330, '542330', '仁布县', '542300');
INSERT INTO `x2_cityarea` VALUES (542331, '542331', '康马县', '542300');
INSERT INTO `x2_cityarea` VALUES (542332, '542332', '定结县', '542300');
INSERT INTO `x2_cityarea` VALUES (542333, '542333', '仲巴县', '542300');
INSERT INTO `x2_cityarea` VALUES (542334, '542334', '亚东县', '542300');
INSERT INTO `x2_cityarea` VALUES (542335, '542335', '吉隆县', '542300');
INSERT INTO `x2_cityarea` VALUES (542336, '542336', '聂拉木县', '542300');
INSERT INTO `x2_cityarea` VALUES (542337, '542337', '萨嘎县', '542300');
INSERT INTO `x2_cityarea` VALUES (542338, '542338', '岗巴县', '542300');
INSERT INTO `x2_cityarea` VALUES (542421, '542421', '那曲县', '542400');
INSERT INTO `x2_cityarea` VALUES (542422, '542422', '嘉黎县', '542400');
INSERT INTO `x2_cityarea` VALUES (542423, '542423', '比如县', '542400');
INSERT INTO `x2_cityarea` VALUES (542424, '542424', '聂荣县', '542400');
INSERT INTO `x2_cityarea` VALUES (542425, '542425', '安多县', '542400');
INSERT INTO `x2_cityarea` VALUES (542426, '542426', '申扎县', '542400');
INSERT INTO `x2_cityarea` VALUES (542427, '542427', '索　县', '542400');
INSERT INTO `x2_cityarea` VALUES (542428, '542428', '班戈县', '542400');
INSERT INTO `x2_cityarea` VALUES (542429, '542429', '巴青县', '542400');
INSERT INTO `x2_cityarea` VALUES (542430, '542430', '尼玛县', '542400');
INSERT INTO `x2_cityarea` VALUES (542521, '542521', '普兰县', '542500');
INSERT INTO `x2_cityarea` VALUES (542522, '542522', '札达县', '542500');
INSERT INTO `x2_cityarea` VALUES (542523, '542523', '噶尔县', '542500');
INSERT INTO `x2_cityarea` VALUES (542524, '542524', '日土县', '542500');
INSERT INTO `x2_cityarea` VALUES (542525, '542525', '革吉县', '542500');
INSERT INTO `x2_cityarea` VALUES (542526, '542526', '改则县', '542500');
INSERT INTO `x2_cityarea` VALUES (542527, '542527', '措勤县', '542500');
INSERT INTO `x2_cityarea` VALUES (542621, '542621', '林芝县', '542600');
INSERT INTO `x2_cityarea` VALUES (542622, '542622', '工布江达县', '542600');
INSERT INTO `x2_cityarea` VALUES (542623, '542623', '米林县', '542600');
INSERT INTO `x2_cityarea` VALUES (542624, '542624', '墨脱县', '542600');
INSERT INTO `x2_cityarea` VALUES (542625, '542625', '波密县', '542600');
INSERT INTO `x2_cityarea` VALUES (542626, '542626', '察隅县', '542600');
INSERT INTO `x2_cityarea` VALUES (542627, '542627', '朗　县', '542600');
INSERT INTO `x2_cityarea` VALUES (610101, '610101', '市辖区', '610100');
INSERT INTO `x2_cityarea` VALUES (610102, '610102', '新城区', '610100');
INSERT INTO `x2_cityarea` VALUES (610103, '610103', '碑林区', '610100');
INSERT INTO `x2_cityarea` VALUES (610104, '610104', '莲湖区', '610100');
INSERT INTO `x2_cityarea` VALUES (610111, '610111', '灞桥区', '610100');
INSERT INTO `x2_cityarea` VALUES (610112, '610112', '未央区', '610100');
INSERT INTO `x2_cityarea` VALUES (610113, '610113', '雁塔区', '610100');
INSERT INTO `x2_cityarea` VALUES (610114, '610114', '阎良区', '610100');
INSERT INTO `x2_cityarea` VALUES (610115, '610115', '临潼区', '610100');
INSERT INTO `x2_cityarea` VALUES (610116, '610116', '长安区', '610100');
INSERT INTO `x2_cityarea` VALUES (610122, '610122', '蓝田县', '610100');
INSERT INTO `x2_cityarea` VALUES (610124, '610124', '周至县', '610100');
INSERT INTO `x2_cityarea` VALUES (610125, '610125', '户　县', '610100');
INSERT INTO `x2_cityarea` VALUES (610126, '610126', '高陵县', '610100');
INSERT INTO `x2_cityarea` VALUES (610201, '610201', '市辖区', '610200');
INSERT INTO `x2_cityarea` VALUES (610202, '610202', '王益区', '610200');
INSERT INTO `x2_cityarea` VALUES (610203, '610203', '印台区', '610200');
INSERT INTO `x2_cityarea` VALUES (610204, '610204', '耀州区', '610200');
INSERT INTO `x2_cityarea` VALUES (610222, '610222', '宜君县', '610200');
INSERT INTO `x2_cityarea` VALUES (610301, '610301', '市辖区', '610300');
INSERT INTO `x2_cityarea` VALUES (610302, '610302', '渭滨区', '610300');
INSERT INTO `x2_cityarea` VALUES (610303, '610303', '金台区', '610300');
INSERT INTO `x2_cityarea` VALUES (610304, '610304', '陈仓区', '610300');
INSERT INTO `x2_cityarea` VALUES (610322, '610322', '凤翔县', '610300');
INSERT INTO `x2_cityarea` VALUES (610323, '610323', '岐山县', '610300');
INSERT INTO `x2_cityarea` VALUES (610324, '610324', '扶风县', '610300');
INSERT INTO `x2_cityarea` VALUES (610326, '610326', '眉　县', '610300');
INSERT INTO `x2_cityarea` VALUES (610327, '610327', '陇　县', '610300');
INSERT INTO `x2_cityarea` VALUES (610328, '610328', '千阳县', '610300');
INSERT INTO `x2_cityarea` VALUES (610329, '610329', '麟游县', '610300');
INSERT INTO `x2_cityarea` VALUES (610330, '610330', '凤　县', '610300');
INSERT INTO `x2_cityarea` VALUES (610331, '610331', '太白县', '610300');
INSERT INTO `x2_cityarea` VALUES (610401, '610401', '市辖区', '610400');
INSERT INTO `x2_cityarea` VALUES (610402, '610402', '秦都区', '610400');
INSERT INTO `x2_cityarea` VALUES (610403, '610403', '杨凌区', '610400');
INSERT INTO `x2_cityarea` VALUES (610404, '610404', '渭城区', '610400');
INSERT INTO `x2_cityarea` VALUES (610422, '610422', '三原县', '610400');
INSERT INTO `x2_cityarea` VALUES (610423, '610423', '泾阳县', '610400');
INSERT INTO `x2_cityarea` VALUES (610424, '610424', '乾　县', '610400');
INSERT INTO `x2_cityarea` VALUES (610425, '610425', '礼泉县', '610400');
INSERT INTO `x2_cityarea` VALUES (610426, '610426', '永寿县', '610400');
INSERT INTO `x2_cityarea` VALUES (610427, '610427', '彬　县', '610400');
INSERT INTO `x2_cityarea` VALUES (610428, '610428', '长武县', '610400');
INSERT INTO `x2_cityarea` VALUES (610429, '610429', '旬邑县', '610400');
INSERT INTO `x2_cityarea` VALUES (610430, '610430', '淳化县', '610400');
INSERT INTO `x2_cityarea` VALUES (610431, '610431', '武功县', '610400');
INSERT INTO `x2_cityarea` VALUES (610481, '610481', '兴平市', '610400');
INSERT INTO `x2_cityarea` VALUES (610501, '610501', '市辖区', '610500');
INSERT INTO `x2_cityarea` VALUES (610502, '610502', '临渭区', '610500');
INSERT INTO `x2_cityarea` VALUES (610521, '610521', '华　县', '610500');
INSERT INTO `x2_cityarea` VALUES (610522, '610522', '潼关县', '610500');
INSERT INTO `x2_cityarea` VALUES (610523, '610523', '大荔县', '610500');
INSERT INTO `x2_cityarea` VALUES (610524, '610524', '合阳县', '610500');
INSERT INTO `x2_cityarea` VALUES (610525, '610525', '澄城县', '610500');
INSERT INTO `x2_cityarea` VALUES (610526, '610526', '蒲城县', '610500');
INSERT INTO `x2_cityarea` VALUES (610527, '610527', '白水县', '610500');
INSERT INTO `x2_cityarea` VALUES (610528, '610528', '富平县', '610500');
INSERT INTO `x2_cityarea` VALUES (610581, '610581', '韩城市', '610500');
INSERT INTO `x2_cityarea` VALUES (610582, '610582', '华阴市', '610500');
INSERT INTO `x2_cityarea` VALUES (610601, '610601', '市辖区', '610600');
INSERT INTO `x2_cityarea` VALUES (610602, '610602', '宝塔区', '610600');
INSERT INTO `x2_cityarea` VALUES (610621, '610621', '延长县', '610600');
INSERT INTO `x2_cityarea` VALUES (610622, '610622', '延川县', '610600');
INSERT INTO `x2_cityarea` VALUES (610623, '610623', '子长县', '610600');
INSERT INTO `x2_cityarea` VALUES (610624, '610624', '安塞县', '610600');
INSERT INTO `x2_cityarea` VALUES (610625, '610625', '志丹县', '610600');
INSERT INTO `x2_cityarea` VALUES (610626, '610626', '吴旗县', '610600');
INSERT INTO `x2_cityarea` VALUES (610627, '610627', '甘泉县', '610600');
INSERT INTO `x2_cityarea` VALUES (610628, '610628', '富　县', '610600');
INSERT INTO `x2_cityarea` VALUES (610629, '610629', '洛川县', '610600');
INSERT INTO `x2_cityarea` VALUES (610630, '610630', '宜川县', '610600');
INSERT INTO `x2_cityarea` VALUES (610631, '610631', '黄龙县', '610600');
INSERT INTO `x2_cityarea` VALUES (610632, '610632', '黄陵县', '610600');
INSERT INTO `x2_cityarea` VALUES (610701, '610701', '市辖区', '610700');
INSERT INTO `x2_cityarea` VALUES (610702, '610702', '汉台区', '610700');
INSERT INTO `x2_cityarea` VALUES (610721, '610721', '南郑县', '610700');
INSERT INTO `x2_cityarea` VALUES (610722, '610722', '城固县', '610700');
INSERT INTO `x2_cityarea` VALUES (610723, '610723', '洋　县', '610700');
INSERT INTO `x2_cityarea` VALUES (610724, '610724', '西乡县', '610700');
INSERT INTO `x2_cityarea` VALUES (610725, '610725', '勉　县', '610700');
INSERT INTO `x2_cityarea` VALUES (610726, '610726', '宁强县', '610700');
INSERT INTO `x2_cityarea` VALUES (610727, '610727', '略阳县', '610700');
INSERT INTO `x2_cityarea` VALUES (610728, '610728', '镇巴县', '610700');
INSERT INTO `x2_cityarea` VALUES (610729, '610729', '留坝县', '610700');
INSERT INTO `x2_cityarea` VALUES (610730, '610730', '佛坪县', '610700');
INSERT INTO `x2_cityarea` VALUES (610801, '610801', '市辖区', '610800');
INSERT INTO `x2_cityarea` VALUES (610802, '610802', '榆阳区', '610800');
INSERT INTO `x2_cityarea` VALUES (610821, '610821', '神木县', '610800');
INSERT INTO `x2_cityarea` VALUES (610822, '610822', '府谷县', '610800');
INSERT INTO `x2_cityarea` VALUES (610823, '610823', '横山县', '610800');
INSERT INTO `x2_cityarea` VALUES (610824, '610824', '靖边县', '610800');
INSERT INTO `x2_cityarea` VALUES (610825, '610825', '定边县', '610800');
INSERT INTO `x2_cityarea` VALUES (610826, '610826', '绥德县', '610800');
INSERT INTO `x2_cityarea` VALUES (610827, '610827', '米脂县', '610800');
INSERT INTO `x2_cityarea` VALUES (610828, '610828', '佳　县', '610800');
INSERT INTO `x2_cityarea` VALUES (610829, '610829', '吴堡县', '610800');
INSERT INTO `x2_cityarea` VALUES (610830, '610830', '清涧县', '610800');
INSERT INTO `x2_cityarea` VALUES (610831, '610831', '子洲县', '610800');
INSERT INTO `x2_cityarea` VALUES (610901, '610901', '市辖区', '610900');
INSERT INTO `x2_cityarea` VALUES (610902, '610902', '汉滨区', '610900');
INSERT INTO `x2_cityarea` VALUES (610921, '610921', '汉阴县', '610900');
INSERT INTO `x2_cityarea` VALUES (610922, '610922', '石泉县', '610900');
INSERT INTO `x2_cityarea` VALUES (610923, '610923', '宁陕县', '610900');
INSERT INTO `x2_cityarea` VALUES (610924, '610924', '紫阳县', '610900');
INSERT INTO `x2_cityarea` VALUES (610925, '610925', '岚皋县', '610900');
INSERT INTO `x2_cityarea` VALUES (610926, '610926', '平利县', '610900');
INSERT INTO `x2_cityarea` VALUES (610927, '610927', '镇坪县', '610900');
INSERT INTO `x2_cityarea` VALUES (610928, '610928', '旬阳县', '610900');
INSERT INTO `x2_cityarea` VALUES (610929, '610929', '白河县', '610900');
INSERT INTO `x2_cityarea` VALUES (611001, '611001', '市辖区', '611000');
INSERT INTO `x2_cityarea` VALUES (611002, '611002', '商州区', '611000');
INSERT INTO `x2_cityarea` VALUES (611021, '611021', '洛南县', '611000');
INSERT INTO `x2_cityarea` VALUES (611022, '611022', '丹凤县', '611000');
INSERT INTO `x2_cityarea` VALUES (611023, '611023', '商南县', '611000');
INSERT INTO `x2_cityarea` VALUES (611024, '611024', '山阳县', '611000');
INSERT INTO `x2_cityarea` VALUES (611025, '611025', '镇安县', '611000');
INSERT INTO `x2_cityarea` VALUES (611026, '611026', '柞水县', '611000');
INSERT INTO `x2_cityarea` VALUES (620101, '620101', '市辖区', '620100');
INSERT INTO `x2_cityarea` VALUES (620102, '620102', '城关区', '620100');
INSERT INTO `x2_cityarea` VALUES (620103, '620103', '七里河区', '620100');
INSERT INTO `x2_cityarea` VALUES (620104, '620104', '西固区', '620100');
INSERT INTO `x2_cityarea` VALUES (620105, '620105', '安宁区', '620100');
INSERT INTO `x2_cityarea` VALUES (620111, '620111', '红古区', '620100');
INSERT INTO `x2_cityarea` VALUES (620121, '620121', '永登县', '620100');
INSERT INTO `x2_cityarea` VALUES (620122, '620122', '皋兰县', '620100');
INSERT INTO `x2_cityarea` VALUES (620123, '620123', '榆中县', '620100');
INSERT INTO `x2_cityarea` VALUES (620201, '620201', '市辖区', '620200');
INSERT INTO `x2_cityarea` VALUES (620301, '620301', '市辖区', '620300');
INSERT INTO `x2_cityarea` VALUES (620302, '620302', '金川区', '620300');
INSERT INTO `x2_cityarea` VALUES (620321, '620321', '永昌县', '620300');
INSERT INTO `x2_cityarea` VALUES (620401, '620401', '市辖区', '620400');
INSERT INTO `x2_cityarea` VALUES (620402, '620402', '白银区', '620400');
INSERT INTO `x2_cityarea` VALUES (620403, '620403', '平川区', '620400');
INSERT INTO `x2_cityarea` VALUES (620421, '620421', '靖远县', '620400');
INSERT INTO `x2_cityarea` VALUES (620422, '620422', '会宁县', '620400');
INSERT INTO `x2_cityarea` VALUES (620423, '620423', '景泰县', '620400');
INSERT INTO `x2_cityarea` VALUES (620501, '620501', '市辖区', '620500');
INSERT INTO `x2_cityarea` VALUES (620502, '620502', '秦城区', '620500');
INSERT INTO `x2_cityarea` VALUES (620503, '620503', '北道区', '620500');
INSERT INTO `x2_cityarea` VALUES (620521, '620521', '清水县', '620500');
INSERT INTO `x2_cityarea` VALUES (620522, '620522', '秦安县', '620500');
INSERT INTO `x2_cityarea` VALUES (620523, '620523', '甘谷县', '620500');
INSERT INTO `x2_cityarea` VALUES (620524, '620524', '武山县', '620500');
INSERT INTO `x2_cityarea` VALUES (620525, '620525', '张家川回族自治县', '620500');
INSERT INTO `x2_cityarea` VALUES (620601, '620601', '市辖区', '620600');
INSERT INTO `x2_cityarea` VALUES (620602, '620602', '凉州区', '620600');
INSERT INTO `x2_cityarea` VALUES (620621, '620621', '民勤县', '620600');
INSERT INTO `x2_cityarea` VALUES (620622, '620622', '古浪县', '620600');
INSERT INTO `x2_cityarea` VALUES (620623, '620623', '天祝藏族自治县', '620600');
INSERT INTO `x2_cityarea` VALUES (620701, '620701', '市辖区', '620700');
INSERT INTO `x2_cityarea` VALUES (620702, '620702', '甘州区', '620700');
INSERT INTO `x2_cityarea` VALUES (620721, '620721', '肃南裕固族自治县', '620700');
INSERT INTO `x2_cityarea` VALUES (620722, '620722', '民乐县', '620700');
INSERT INTO `x2_cityarea` VALUES (620723, '620723', '临泽县', '620700');
INSERT INTO `x2_cityarea` VALUES (620724, '620724', '高台县', '620700');
INSERT INTO `x2_cityarea` VALUES (620725, '620725', '山丹县', '620700');
INSERT INTO `x2_cityarea` VALUES (620801, '620801', '市辖区', '620800');
INSERT INTO `x2_cityarea` VALUES (620802, '620802', '崆峒区', '620800');
INSERT INTO `x2_cityarea` VALUES (620821, '620821', '泾川县', '620800');
INSERT INTO `x2_cityarea` VALUES (620822, '620822', '灵台县', '620800');
INSERT INTO `x2_cityarea` VALUES (620823, '620823', '崇信县', '620800');
INSERT INTO `x2_cityarea` VALUES (620824, '620824', '华亭县', '620800');
INSERT INTO `x2_cityarea` VALUES (620825, '620825', '庄浪县', '620800');
INSERT INTO `x2_cityarea` VALUES (620826, '620826', '静宁县', '620800');
INSERT INTO `x2_cityarea` VALUES (620901, '620901', '市辖区', '620900');
INSERT INTO `x2_cityarea` VALUES (620902, '620902', '肃州区', '620900');
INSERT INTO `x2_cityarea` VALUES (620921, '620921', '金塔县', '620900');
INSERT INTO `x2_cityarea` VALUES (620922, '620922', '安西县', '620900');
INSERT INTO `x2_cityarea` VALUES (620923, '620923', '肃北蒙古族自治县', '620900');
INSERT INTO `x2_cityarea` VALUES (620924, '620924', '阿克塞哈萨克族自治县', '620900');
INSERT INTO `x2_cityarea` VALUES (620981, '620981', '玉门市', '620900');
INSERT INTO `x2_cityarea` VALUES (620982, '620982', '敦煌市', '620900');
INSERT INTO `x2_cityarea` VALUES (621001, '621001', '市辖区', '621000');
INSERT INTO `x2_cityarea` VALUES (621002, '621002', '西峰区', '621000');
INSERT INTO `x2_cityarea` VALUES (621021, '621021', '庆城县', '621000');
INSERT INTO `x2_cityarea` VALUES (621022, '621022', '环　县', '621000');
INSERT INTO `x2_cityarea` VALUES (621023, '621023', '华池县', '621000');
INSERT INTO `x2_cityarea` VALUES (621024, '621024', '合水县', '621000');
INSERT INTO `x2_cityarea` VALUES (621025, '621025', '正宁县', '621000');
INSERT INTO `x2_cityarea` VALUES (621026, '621026', '宁　县', '621000');
INSERT INTO `x2_cityarea` VALUES (621027, '621027', '镇原县', '621000');
INSERT INTO `x2_cityarea` VALUES (621101, '621101', '市辖区', '621100');
INSERT INTO `x2_cityarea` VALUES (621102, '621102', '安定区', '621100');
INSERT INTO `x2_cityarea` VALUES (621121, '621121', '通渭县', '621100');
INSERT INTO `x2_cityarea` VALUES (621122, '621122', '陇西县', '621100');
INSERT INTO `x2_cityarea` VALUES (621123, '621123', '渭源县', '621100');
INSERT INTO `x2_cityarea` VALUES (621124, '621124', '临洮县', '621100');
INSERT INTO `x2_cityarea` VALUES (621125, '621125', '漳　县', '621100');
INSERT INTO `x2_cityarea` VALUES (621126, '621126', '岷　县', '621100');
INSERT INTO `x2_cityarea` VALUES (621201, '621201', '市辖区', '621200');
INSERT INTO `x2_cityarea` VALUES (621202, '621202', '武都区', '621200');
INSERT INTO `x2_cityarea` VALUES (621221, '621221', '成　县', '621200');
INSERT INTO `x2_cityarea` VALUES (621222, '621222', '文　县', '621200');
INSERT INTO `x2_cityarea` VALUES (621223, '621223', '宕昌县', '621200');
INSERT INTO `x2_cityarea` VALUES (621224, '621224', '康　县', '621200');
INSERT INTO `x2_cityarea` VALUES (621225, '621225', '西和县', '621200');
INSERT INTO `x2_cityarea` VALUES (621226, '621226', '礼　县', '621200');
INSERT INTO `x2_cityarea` VALUES (621227, '621227', '徽　县', '621200');
INSERT INTO `x2_cityarea` VALUES (621228, '621228', '两当县', '621200');
INSERT INTO `x2_cityarea` VALUES (622901, '622901', '临夏市', '622900');
INSERT INTO `x2_cityarea` VALUES (622921, '622921', '临夏县', '622900');
INSERT INTO `x2_cityarea` VALUES (622922, '622922', '康乐县', '622900');
INSERT INTO `x2_cityarea` VALUES (622923, '622923', '永靖县', '622900');
INSERT INTO `x2_cityarea` VALUES (622924, '622924', '广河县', '622900');
INSERT INTO `x2_cityarea` VALUES (622925, '622925', '和政县', '622900');
INSERT INTO `x2_cityarea` VALUES (622926, '622926', '东乡族自治县', '622900');
INSERT INTO `x2_cityarea` VALUES (622927, '622927', '积石山保安族东乡族撒拉族自治县', '622900');
INSERT INTO `x2_cityarea` VALUES (623001, '623001', '合作市', '623000');
INSERT INTO `x2_cityarea` VALUES (623021, '623021', '临潭县', '623000');
INSERT INTO `x2_cityarea` VALUES (623022, '623022', '卓尼县', '623000');
INSERT INTO `x2_cityarea` VALUES (623023, '623023', '舟曲县', '623000');
INSERT INTO `x2_cityarea` VALUES (623024, '623024', '迭部县', '623000');
INSERT INTO `x2_cityarea` VALUES (623025, '623025', '玛曲县', '623000');
INSERT INTO `x2_cityarea` VALUES (623026, '623026', '碌曲县', '623000');
INSERT INTO `x2_cityarea` VALUES (623027, '623027', '夏河县', '623000');
INSERT INTO `x2_cityarea` VALUES (630101, '630101', '市辖区', '630100');
INSERT INTO `x2_cityarea` VALUES (630102, '630102', '城东区', '630100');
INSERT INTO `x2_cityarea` VALUES (630103, '630103', '城中区', '630100');
INSERT INTO `x2_cityarea` VALUES (630104, '630104', '城西区', '630100');
INSERT INTO `x2_cityarea` VALUES (630105, '630105', '城北区', '630100');
INSERT INTO `x2_cityarea` VALUES (630121, '630121', '大通回族土族自治县', '630100');
INSERT INTO `x2_cityarea` VALUES (630122, '630122', '湟中县', '630100');
INSERT INTO `x2_cityarea` VALUES (630123, '630123', '湟源县', '630100');
INSERT INTO `x2_cityarea` VALUES (632121, '632121', '平安县', '632100');
INSERT INTO `x2_cityarea` VALUES (632122, '632122', '民和回族土族自治县', '632100');
INSERT INTO `x2_cityarea` VALUES (632123, '632123', '乐都县', '632100');
INSERT INTO `x2_cityarea` VALUES (632126, '632126', '互助土族自治县', '632100');
INSERT INTO `x2_cityarea` VALUES (632127, '632127', '化隆回族自治县', '632100');
INSERT INTO `x2_cityarea` VALUES (632128, '632128', '循化撒拉族自治县', '632100');
INSERT INTO `x2_cityarea` VALUES (632221, '632221', '门源回族自治县', '632200');
INSERT INTO `x2_cityarea` VALUES (632222, '632222', '祁连县', '632200');
INSERT INTO `x2_cityarea` VALUES (632223, '632223', '海晏县', '632200');
INSERT INTO `x2_cityarea` VALUES (632224, '632224', '刚察县', '632200');
INSERT INTO `x2_cityarea` VALUES (632321, '632321', '同仁县', '632300');
INSERT INTO `x2_cityarea` VALUES (632322, '632322', '尖扎县', '632300');
INSERT INTO `x2_cityarea` VALUES (632323, '632323', '泽库县', '632300');
INSERT INTO `x2_cityarea` VALUES (632324, '632324', '河南蒙古族自治县', '632300');
INSERT INTO `x2_cityarea` VALUES (632521, '632521', '共和县', '632500');
INSERT INTO `x2_cityarea` VALUES (632522, '632522', '同德县', '632500');
INSERT INTO `x2_cityarea` VALUES (632523, '632523', '贵德县', '632500');
INSERT INTO `x2_cityarea` VALUES (632524, '632524', '兴海县', '632500');
INSERT INTO `x2_cityarea` VALUES (632525, '632525', '贵南县', '632500');
INSERT INTO `x2_cityarea` VALUES (632621, '632621', '玛沁县', '632600');
INSERT INTO `x2_cityarea` VALUES (632622, '632622', '班玛县', '632600');
INSERT INTO `x2_cityarea` VALUES (632623, '632623', '甘德县', '632600');
INSERT INTO `x2_cityarea` VALUES (632624, '632624', '达日县', '632600');
INSERT INTO `x2_cityarea` VALUES (632625, '632625', '久治县', '632600');
INSERT INTO `x2_cityarea` VALUES (632626, '632626', '玛多县', '632600');
INSERT INTO `x2_cityarea` VALUES (632721, '632721', '玉树县', '632700');
INSERT INTO `x2_cityarea` VALUES (632722, '632722', '杂多县', '632700');
INSERT INTO `x2_cityarea` VALUES (632723, '632723', '称多县', '632700');
INSERT INTO `x2_cityarea` VALUES (632724, '632724', '治多县', '632700');
INSERT INTO `x2_cityarea` VALUES (632725, '632725', '囊谦县', '632700');
INSERT INTO `x2_cityarea` VALUES (632726, '632726', '曲麻莱县', '632700');
INSERT INTO `x2_cityarea` VALUES (632801, '632801', '格尔木市', '632800');
INSERT INTO `x2_cityarea` VALUES (632802, '632802', '德令哈市', '632800');
INSERT INTO `x2_cityarea` VALUES (632821, '632821', '乌兰县', '632800');
INSERT INTO `x2_cityarea` VALUES (632822, '632822', '都兰县', '632800');
INSERT INTO `x2_cityarea` VALUES (632823, '632823', '天峻县', '632800');
INSERT INTO `x2_cityarea` VALUES (640101, '640101', '市辖区', '640100');
INSERT INTO `x2_cityarea` VALUES (640104, '640104', '兴庆区', '640100');
INSERT INTO `x2_cityarea` VALUES (640105, '640105', '西夏区', '640100');
INSERT INTO `x2_cityarea` VALUES (640106, '640106', '金凤区', '640100');
INSERT INTO `x2_cityarea` VALUES (640121, '640121', '永宁县', '640100');
INSERT INTO `x2_cityarea` VALUES (640122, '640122', '贺兰县', '640100');
INSERT INTO `x2_cityarea` VALUES (640181, '640181', '灵武市', '640100');
INSERT INTO `x2_cityarea` VALUES (640201, '640201', '市辖区', '640200');
INSERT INTO `x2_cityarea` VALUES (640202, '640202', '大武口区', '640200');
INSERT INTO `x2_cityarea` VALUES (640205, '640205', '惠农区', '640200');
INSERT INTO `x2_cityarea` VALUES (640221, '640221', '平罗县', '640200');
INSERT INTO `x2_cityarea` VALUES (640301, '640301', '市辖区', '640300');
INSERT INTO `x2_cityarea` VALUES (640302, '640302', '利通区', '640300');
INSERT INTO `x2_cityarea` VALUES (640323, '640323', '盐池县', '640300');
INSERT INTO `x2_cityarea` VALUES (640324, '640324', '同心县', '640300');
INSERT INTO `x2_cityarea` VALUES (640381, '640381', '青铜峡市', '640300');
INSERT INTO `x2_cityarea` VALUES (640401, '640401', '市辖区', '640400');
INSERT INTO `x2_cityarea` VALUES (640402, '640402', '原州区', '640400');
INSERT INTO `x2_cityarea` VALUES (640422, '640422', '西吉县', '640400');
INSERT INTO `x2_cityarea` VALUES (640423, '640423', '隆德县', '640400');
INSERT INTO `x2_cityarea` VALUES (640424, '640424', '泾源县', '640400');
INSERT INTO `x2_cityarea` VALUES (640425, '640425', '彭阳县', '640400');
INSERT INTO `x2_cityarea` VALUES (640501, '640501', '市辖区', '640500');
INSERT INTO `x2_cityarea` VALUES (640502, '640502', '沙坡头区', '640500');
INSERT INTO `x2_cityarea` VALUES (640521, '640521', '中宁县', '640500');
INSERT INTO `x2_cityarea` VALUES (640522, '640522', '海原县', '640500');
INSERT INTO `x2_cityarea` VALUES (650101, '650101', '市辖区', '650100');
INSERT INTO `x2_cityarea` VALUES (650102, '650102', '天山区', '650100');
INSERT INTO `x2_cityarea` VALUES (650103, '650103', '沙依巴克区', '650100');
INSERT INTO `x2_cityarea` VALUES (650104, '650104', '新市区', '650100');
INSERT INTO `x2_cityarea` VALUES (650105, '650105', '水磨沟区', '650100');
INSERT INTO `x2_cityarea` VALUES (650106, '650106', '头屯河区', '650100');
INSERT INTO `x2_cityarea` VALUES (650107, '650107', '达坂城区', '650100');
INSERT INTO `x2_cityarea` VALUES (650108, '650108', '东山区', '650100');
INSERT INTO `x2_cityarea` VALUES (650121, '650121', '乌鲁木齐县', '650100');
INSERT INTO `x2_cityarea` VALUES (650201, '650201', '市辖区', '650200');
INSERT INTO `x2_cityarea` VALUES (650202, '650202', '独山子区', '650200');
INSERT INTO `x2_cityarea` VALUES (650203, '650203', '克拉玛依区', '650200');
INSERT INTO `x2_cityarea` VALUES (650204, '650204', '白碱滩区', '650200');
INSERT INTO `x2_cityarea` VALUES (650205, '650205', '乌尔禾区', '650200');
INSERT INTO `x2_cityarea` VALUES (652101, '652101', '吐鲁番市', '652100');
INSERT INTO `x2_cityarea` VALUES (652122, '652122', '鄯善县', '652100');
INSERT INTO `x2_cityarea` VALUES (652123, '652123', '托克逊县', '652100');
INSERT INTO `x2_cityarea` VALUES (652201, '652201', '哈密市', '652200');
INSERT INTO `x2_cityarea` VALUES (652222, '652222', '巴里坤哈萨克自治县', '652200');
INSERT INTO `x2_cityarea` VALUES (652223, '652223', '伊吾县', '652200');
INSERT INTO `x2_cityarea` VALUES (652301, '652301', '昌吉市', '652300');
INSERT INTO `x2_cityarea` VALUES (652302, '652302', '阜康市', '652300');
INSERT INTO `x2_cityarea` VALUES (652303, '652303', '米泉市', '652300');
INSERT INTO `x2_cityarea` VALUES (652323, '652323', '呼图壁县', '652300');
INSERT INTO `x2_cityarea` VALUES (652324, '652324', '玛纳斯县', '652300');
INSERT INTO `x2_cityarea` VALUES (652325, '652325', '奇台县', '652300');
INSERT INTO `x2_cityarea` VALUES (652327, '652327', '吉木萨尔县', '652300');
INSERT INTO `x2_cityarea` VALUES (652328, '652328', '木垒哈萨克自治县', '652300');
INSERT INTO `x2_cityarea` VALUES (652701, '652701', '博乐市', '652700');
INSERT INTO `x2_cityarea` VALUES (652722, '652722', '精河县', '652700');
INSERT INTO `x2_cityarea` VALUES (652723, '652723', '温泉县', '652700');
INSERT INTO `x2_cityarea` VALUES (652801, '652801', '库尔勒市', '652800');
INSERT INTO `x2_cityarea` VALUES (652822, '652822', '轮台县', '652800');
INSERT INTO `x2_cityarea` VALUES (652823, '652823', '尉犁县', '652800');
INSERT INTO `x2_cityarea` VALUES (652824, '652824', '若羌县', '652800');
INSERT INTO `x2_cityarea` VALUES (652825, '652825', '且末县', '652800');
INSERT INTO `x2_cityarea` VALUES (652826, '652826', '焉耆回族自治县', '652800');
INSERT INTO `x2_cityarea` VALUES (652827, '652827', '和静县', '652800');
INSERT INTO `x2_cityarea` VALUES (652828, '652828', '和硕县', '652800');
INSERT INTO `x2_cityarea` VALUES (652829, '652829', '博湖县', '652800');
INSERT INTO `x2_cityarea` VALUES (652901, '652901', '阿克苏市', '652900');
INSERT INTO `x2_cityarea` VALUES (652922, '652922', '温宿县', '652900');
INSERT INTO `x2_cityarea` VALUES (652923, '652923', '库车县', '652900');
INSERT INTO `x2_cityarea` VALUES (652924, '652924', '沙雅县', '652900');
INSERT INTO `x2_cityarea` VALUES (652925, '652925', '新和县', '652900');
INSERT INTO `x2_cityarea` VALUES (652926, '652926', '拜城县', '652900');
INSERT INTO `x2_cityarea` VALUES (652927, '652927', '乌什县', '652900');
INSERT INTO `x2_cityarea` VALUES (652928, '652928', '阿瓦提县', '652900');
INSERT INTO `x2_cityarea` VALUES (652929, '652929', '柯坪县', '652900');
INSERT INTO `x2_cityarea` VALUES (653001, '653001', '阿图什市', '653000');
INSERT INTO `x2_cityarea` VALUES (653022, '653022', '阿克陶县', '653000');
INSERT INTO `x2_cityarea` VALUES (653023, '653023', '阿合奇县', '653000');
INSERT INTO `x2_cityarea` VALUES (653024, '653024', '乌恰县', '653000');
INSERT INTO `x2_cityarea` VALUES (653101, '653101', '喀什市', '653100');
INSERT INTO `x2_cityarea` VALUES (653121, '653121', '疏附县', '653100');
INSERT INTO `x2_cityarea` VALUES (653122, '653122', '疏勒县', '653100');
INSERT INTO `x2_cityarea` VALUES (653123, '653123', '英吉沙县', '653100');
INSERT INTO `x2_cityarea` VALUES (653124, '653124', '泽普县', '653100');
INSERT INTO `x2_cityarea` VALUES (653125, '653125', '莎车县', '653100');
INSERT INTO `x2_cityarea` VALUES (653126, '653126', '叶城县', '653100');
INSERT INTO `x2_cityarea` VALUES (653127, '653127', '麦盖提县', '653100');
INSERT INTO `x2_cityarea` VALUES (653128, '653128', '岳普湖县', '653100');
INSERT INTO `x2_cityarea` VALUES (653129, '653129', '伽师县', '653100');
INSERT INTO `x2_cityarea` VALUES (653130, '653130', '巴楚县', '653100');
INSERT INTO `x2_cityarea` VALUES (653131, '653131', '塔什库尔干塔吉克自治县', '653100');
INSERT INTO `x2_cityarea` VALUES (653201, '653201', '和田市', '653200');
INSERT INTO `x2_cityarea` VALUES (653221, '653221', '和田县', '653200');
INSERT INTO `x2_cityarea` VALUES (653222, '653222', '墨玉县', '653200');
INSERT INTO `x2_cityarea` VALUES (653223, '653223', '皮山县', '653200');
INSERT INTO `x2_cityarea` VALUES (653224, '653224', '洛浦县', '653200');
INSERT INTO `x2_cityarea` VALUES (653225, '653225', '策勒县', '653200');
INSERT INTO `x2_cityarea` VALUES (653226, '653226', '于田县', '653200');
INSERT INTO `x2_cityarea` VALUES (653227, '653227', '民丰县', '653200');
INSERT INTO `x2_cityarea` VALUES (654002, '654002', '伊宁市', '654000');
INSERT INTO `x2_cityarea` VALUES (654003, '654003', '奎屯市', '654000');
INSERT INTO `x2_cityarea` VALUES (654021, '654021', '伊宁县', '654000');
INSERT INTO `x2_cityarea` VALUES (654022, '654022', '察布查尔锡伯自治县', '654000');
INSERT INTO `x2_cityarea` VALUES (654023, '654023', '霍城县', '654000');
INSERT INTO `x2_cityarea` VALUES (654024, '654024', '巩留县', '654000');
INSERT INTO `x2_cityarea` VALUES (654025, '654025', '新源县', '654000');
INSERT INTO `x2_cityarea` VALUES (654026, '654026', '昭苏县', '654000');
INSERT INTO `x2_cityarea` VALUES (654027, '654027', '特克斯县', '654000');
INSERT INTO `x2_cityarea` VALUES (654028, '654028', '尼勒克县', '654000');
INSERT INTO `x2_cityarea` VALUES (654201, '654201', '塔城市', '654200');
INSERT INTO `x2_cityarea` VALUES (654202, '654202', '乌苏市', '654200');
INSERT INTO `x2_cityarea` VALUES (654221, '654221', '额敏县', '654200');
INSERT INTO `x2_cityarea` VALUES (654223, '654223', '沙湾县', '654200');
INSERT INTO `x2_cityarea` VALUES (654224, '654224', '托里县', '654200');
INSERT INTO `x2_cityarea` VALUES (654225, '654225', '裕民县', '654200');
INSERT INTO `x2_cityarea` VALUES (654226, '654226', '和布克赛尔蒙古自治县', '654200');
INSERT INTO `x2_cityarea` VALUES (654301, '654301', '阿勒泰市', '654300');
INSERT INTO `x2_cityarea` VALUES (654321, '654321', '布尔津县', '654300');
INSERT INTO `x2_cityarea` VALUES (654322, '654322', '富蕴县', '654300');
INSERT INTO `x2_cityarea` VALUES (654323, '654323', '福海县', '654300');
INSERT INTO `x2_cityarea` VALUES (654324, '654324', '哈巴河县', '654300');
INSERT INTO `x2_cityarea` VALUES (654325, '654325', '青河县', '654300');
INSERT INTO `x2_cityarea` VALUES (654326, '654326', '吉木乃县', '654300');
INSERT INTO `x2_cityarea` VALUES (659001, '659001', '石河子市', '659000');
INSERT INTO `x2_cityarea` VALUES (659002, '659002', '阿拉尔市', '659000');
INSERT INTO `x2_cityarea` VALUES (659003, '659003', '图木舒克市', '659000');
INSERT INTO `x2_cityarea` VALUES (659004, '659004', '五家渠市', '659000');
INSERT INTO `x2_cityarea` VALUES (441900, '441901', '莞城区', '441900');
INSERT INTO `x2_cityarea` VALUES (442000, '442001', '中山市', '442000');
INSERT INTO `x2_cityarea` VALUES (810101, '810101', '香港特别行政区', '810100');
INSERT INTO `x2_cityarea` VALUES (820101, '820101', '澳门特别行政区', '820100');
INSERT INTO `x2_cityarea` VALUES (710101, '710101', '中正区', '710100');
INSERT INTO `x2_cityarea` VALUES (710102, '710102', '大同区', '710100');
INSERT INTO `x2_cityarea` VALUES (710103, '710103', '中山区', '710100');
INSERT INTO `x2_cityarea` VALUES (710104, '710104', '松山区', '710100');
INSERT INTO `x2_cityarea` VALUES (710105, '710105', '大安区', '710100');
INSERT INTO `x2_cityarea` VALUES (710106, '710106', '万华区', '710100');
INSERT INTO `x2_cityarea` VALUES (710107, '710107', '信义区', '710100');
INSERT INTO `x2_cityarea` VALUES (710108, '710108', '士林区', '710100');
INSERT INTO `x2_cityarea` VALUES (710109, '710109', '北投区', '710100');
INSERT INTO `x2_cityarea` VALUES (710110, '710110', '内湖区', '710100');
INSERT INTO `x2_cityarea` VALUES (710111, '710111', '南港区', '710100');
INSERT INTO `x2_cityarea` VALUES (710112, '710112', '文山区', '710100');
INSERT INTO `x2_cityarea` VALUES (710201, '710201', '新兴区', '710200');
INSERT INTO `x2_cityarea` VALUES (710202, '710202', '前金区', '710200');
INSERT INTO `x2_cityarea` VALUES (710203, '710203', '芩雅区', '710200');
INSERT INTO `x2_cityarea` VALUES (710204, '710204', '盐埕区', '710200');
INSERT INTO `x2_cityarea` VALUES (710205, '710205', '鼓山区', '710200');
INSERT INTO `x2_cityarea` VALUES (710206, '710206', '旗津区', '710200');
INSERT INTO `x2_cityarea` VALUES (710207, '710207', '前镇区', '710200');
INSERT INTO `x2_cityarea` VALUES (710208, '710208', '三民区', '710200');
INSERT INTO `x2_cityarea` VALUES (710209, '710209', '左营区', '710200');
INSERT INTO `x2_cityarea` VALUES (710210, '710210', '楠梓区', '710200');
INSERT INTO `x2_cityarea` VALUES (710211, '710211', '小港区', '710200');
INSERT INTO `x2_cityarea` VALUES (710301, '710301', '仁爱区', '710300');
INSERT INTO `x2_cityarea` VALUES (710302, '710302', '信义区', '710300');
INSERT INTO `x2_cityarea` VALUES (710303, '710303', '中正区', '710300');
INSERT INTO `x2_cityarea` VALUES (710304, '710304', '中山区', '710300');
INSERT INTO `x2_cityarea` VALUES (710305, '710305', '安乐区', '710300');
INSERT INTO `x2_cityarea` VALUES (710306, '710306', '暖暖区', '710300');
INSERT INTO `x2_cityarea` VALUES (710307, '710307', '七堵区', '710300');
INSERT INTO `x2_cityarea` VALUES (710401, '710401', '中区', '710400');
INSERT INTO `x2_cityarea` VALUES (710402, '710402', '东区', '710400');
INSERT INTO `x2_cityarea` VALUES (710403, '710403', '南区', '710400');
INSERT INTO `x2_cityarea` VALUES (710404, '710404', '西区', '710400');
INSERT INTO `x2_cityarea` VALUES (710405, '710405', '北区', '710400');
INSERT INTO `x2_cityarea` VALUES (710406, '710406', '北屯区', '710400');
INSERT INTO `x2_cityarea` VALUES (710407, '710407', '西屯区', '710400');
INSERT INTO `x2_cityarea` VALUES (710408, '710408', '南屯区', '710400');
INSERT INTO `x2_cityarea` VALUES (710501, '710501', '中西区', '710500');
INSERT INTO `x2_cityarea` VALUES (710502, '710502', '东区', '710500');
INSERT INTO `x2_cityarea` VALUES (710503, '710503', '南区', '710500');
INSERT INTO `x2_cityarea` VALUES (710504, '710504', '北区', '710500');
INSERT INTO `x2_cityarea` VALUES (710505, '710505', '安平区', '710500');
INSERT INTO `x2_cityarea` VALUES (710506, '710506', '安南区', '710500');
INSERT INTO `x2_cityarea` VALUES (710601, '710601', '东区', '710600');
INSERT INTO `x2_cityarea` VALUES (710602, '710602', '北区', '710600');
INSERT INTO `x2_cityarea` VALUES (710603, '710603', '香山区', '710600');
INSERT INTO `x2_cityarea` VALUES (710701, '710701', '东区', '710700');
INSERT INTO `x2_cityarea` VALUES (710702, '710702', '西区', '710700');
INSERT INTO `x2_cityarea` VALUES (710801, '710801', '县辖区', '710800');
INSERT INTO `x2_cityarea` VALUES (710901, '710901', '县辖区', '710900');
INSERT INTO `x2_cityarea` VALUES (711001, '711001', '县辖区', '711000');
INSERT INTO `x2_cityarea` VALUES (711101, '711101', '县辖区', '711100');
INSERT INTO `x2_cityarea` VALUES (711201, '711201', '县辖区', '711200');
INSERT INTO `x2_cityarea` VALUES (711301, '711301', '县辖区', '711300');
INSERT INTO `x2_cityarea` VALUES (711401, '711401', '县辖区', '711400');
INSERT INTO `x2_cityarea` VALUES (711501, '711501', '县辖区', '711500');
INSERT INTO `x2_cityarea` VALUES (711601, '711601', '县辖区', '711600');
INSERT INTO `x2_cityarea` VALUES (711701, '711701', '县辖区', '711700');
INSERT INTO `x2_cityarea` VALUES (711801, '711801', '县辖区', '711800');
INSERT INTO `x2_cityarea` VALUES (711901, '711901', '县辖区', '711900');
INSERT INTO `x2_cityarea` VALUES (712001, '712001', '县辖区', '712000');
INSERT INTO `x2_cityarea` VALUES (712101, '712101', '县辖区', '712100');
INSERT INTO `x2_cityarea` VALUES (712201, '712201', '县辖区', '712200');
INSERT INTO `x2_cityarea` VALUES (712301, '712301', '县辖区', '712300');
INSERT INTO `x2_cityarea` VALUES (441902, '441902', '常平镇', '441900');
INSERT INTO `x2_cityarea` VALUES (441903, '441903', '塘厦镇', '441900');
INSERT INTO `x2_cityarea` VALUES (441904, '441904', '万江区', '441900');
INSERT INTO `x2_cityarea` VALUES (441905, '441905', '虎门镇', '441900');
INSERT INTO `x2_cityarea` VALUES (410186, '410186', '高新技术开发区', '410100');
INSERT INTO `x2_cityarea` VALUES (410187, '410187', '郑东新区', '410100');
INSERT INTO `x2_cityarea` VALUES (410188, '410188', '经济开发区', '410100');
INSERT INTO `x2_cityarea` VALUES (232701, '232701', '加格达奇区', '232700');
INSERT INTO `x2_cityarea` VALUES (232702, '232702', '松岭区', '232700');
INSERT INTO `x2_cityarea` VALUES (232703, '232703', '新林区', '232700');
INSERT INTO `x2_cityarea` VALUES (232704, '232704', '呼中区', '232700');
INSERT INTO `x2_cityarea` VALUES (340208, '340208', '三山区', '340200');
INSERT INTO `x2_cityarea` VALUES (440115, '440115', '南沙区', '440100');
INSERT INTO `x2_cityarea` VALUES (440116, '440116', '萝岗区', '440100');

-- ----------------------------
-- Table structure for x2_cnttouser
-- ----------------------------
DROP TABLE IF EXISTS `x2_cnttouser`;
CREATE TABLE `x2_cnttouser`  (
  `cturid` int(11) NOT NULL AUTO_INCREMENT,
  `cturuserid` int(11) NULL DEFAULT NULL,
  `cturcontentid` int(11) NULL DEFAULT NULL,
  `cturtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cturid`) USING BTREE,
  INDEX `cturuserid`(`cturuserid`) USING BTREE,
  INDEX `cturcontentid`(`cturcontentid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_cnttouser
-- ----------------------------
INSERT INTO `x2_cnttouser` VALUES (1, 1, 104, 0);

-- ----------------------------
-- Table structure for x2_comment
-- ----------------------------
DROP TABLE IF EXISTS `x2_comment`;
CREATE TABLE `x2_comment`  (
  `cmtid` int(11) NOT NULL AUTO_INCREMENT,
  `cmtopenid` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `cmtuserid` int(11) NOT NULL,
  `cmtreply` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cmtcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cmttime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cmtid`) USING BTREE,
  INDEX `cmtuserid`(`cmtuserid`) USING BTREE,
  INDEX `cmtapp`(`cmtopenid`, `cmttime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_comment
-- ----------------------------

-- ----------------------------
-- Table structure for x2_config
-- ----------------------------
DROP TABLE IF EXISTS `x2_config`;
CREATE TABLE `x2_config`  (
  `cfgapp` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cfgsetting` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`cfgapp`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_config
-- ----------------------------

-- ----------------------------
-- Table structure for x2_consumelog
-- ----------------------------
DROP TABLE IF EXISTS `x2_consumelog`;
CREATE TABLE `x2_consumelog`  (
  `conlid` int(11) NOT NULL AUTO_INCREMENT,
  `conlcost` int(11) NOT NULL,
  `conluserid` int(11) NOT NULL,
  `conlinfo` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `conltype` int(4) NOT NULL,
  `conltime` int(11) NOT NULL,
  PRIMARY KEY (`conlid`) USING BTREE,
  INDEX `conluserid`(`conluserid`, `conltype`, `conltime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_consumelog
-- ----------------------------

-- ----------------------------
-- Table structure for x2_content
-- ----------------------------
DROP TABLE IF EXISTS `x2_content`;
CREATE TABLE `x2_content`  (
  `contentid` int(11) NOT NULL AUTO_INCREMENT,
  `contentcatid` int(11) NOT NULL DEFAULT 0,
  `contentmoduleid` int(11) NOT NULL DEFAULT 0,
  `contentuserid` int(11) NOT NULL DEFAULT 0,
  `contentusername` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contentmodifier` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contenttitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contenttags` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contentkeywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contentthumb` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contentlink` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contentinputtime` int(11) NOT NULL DEFAULT 0,
  `contentmodifytime` int(11) NOT NULL DEFAULT 0,
  `contentsequence` int(4) NOT NULL DEFAULT 0,
  `contentdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contentinfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contentstatus` int(2) NOT NULL DEFAULT 0,
  `contenttemplate` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `contenttext` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contentview` int(255) NULL DEFAULT NULL,
  PRIMARY KEY (`contentid`) USING BTREE,
  INDEX `contentuserid`(`contentuserid`, `contentinputtime`, `contentmodifytime`, `contentsequence`) USING BTREE,
  INDEX `contentmoduleid`(`contentmoduleid`) USING BTREE,
  INDEX `contentcatid`(`contentcatid`) USING BTREE,
  INDEX `contentstatus`(`contentstatus`) USING BTREE,
  INDEX `contenttags`(`contenttags`) USING BTREE,
  FULLTEXT INDEX `contentkeywords`(`contentkeywords`)
) ENGINE = MyISAM AUTO_INCREMENT = 117 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_content
-- ----------------------------
INSERT INTO `x2_content` VALUES (1, 26, 35, 1, 'peadmin', '', '测试公告', '测试公告', '测试公告', 'app/core/styles/images/noimage.gif', '', 1574930414, 0, 0, '测试公告', '', 0, 'content_default', '&lt;p&gt;测试公告&lt;/p&gt;', 10);
INSERT INTO `x2_content` VALUES (2, 14, 35, 1, 'peadmin', '', '联系我们', '联系我们', '联系我们', 'app/core/styles/images/noimage.gif', '', 1574930434, 0, 0, '联系我们', '', 0, 'content_default', '&lt;p&gt;联系我们&lt;/p&gt;', 10);
INSERT INTO `x2_content` VALUES (3, 11, 33, 1, 'peadmin', '', '测试连接1', '测试连接1', '测试连接1', 'app/core/styles/images/noimage.gif', '测试连接1', 1577015440, 0, 0, '测试连接1', '', 0, 'content_default', '&lt;p&gt;测试连接1&lt;/p&gt;', NULL);
INSERT INTO `x2_content` VALUES (4, 26, 35, 1, 'peadmin', '', '测试公告1', '测试公告1', '测试公告1', 'app/core/styles/images/noimage.gif', '', 1577015436, 0, 0, '测试公告1', '', 0, 'content_default', '&lt;p&gt;测试公告1&lt;/p&gt;', 15);
INSERT INTO `x2_content` VALUES (5, 2, 35, 1, 'peadmin', '', 'aa', 'a', 'aa', 'files/attach/images/content/20210830/16302939588772.jpg', '', 0, 1630293959, 0, 'a', '', 0, 'content_default', '&lt;p&gt;a&lt;/p&gt;', 29);
INSERT INTO `x2_content` VALUES (6, 11, 35, 1, 'peadmin', '', '测试链接', '测试链接', '测试链接', 'app/core/styles/images/noimage.gif', 'http://www.163.com', 1574930139, 1611491093, 0, '测试链接', '', 0, 'content_default', '&lt;p&gt;测试链接&lt;/p&gt;', NULL);
INSERT INTO `x2_content` VALUES (7, 26, 35, 1, 'peadmin', '', '考试通知', 'tags', '关键字', 'app/core/styles/images/noimage.gif', '', 1581913227, 1620458820, 0, '摘要', '', 0, 'content_default', '&lt;p&gt;内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容&lt;/p&gt;', 23);

-- ----------------------------
-- Table structure for x2_coupon
-- ----------------------------
DROP TABLE IF EXISTS `x2_coupon`;
CREATE TABLE `x2_coupon`  (
  `couponsn` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `couponvalue` int(11) NOT NULL DEFAULT 0,
  `couponstatus` int(1) NOT NULL DEFAULT 0,
  `couponaddtime` int(11) NOT NULL DEFAULT 0,
  `couponendtime` int(11) NOT NULL DEFAULT 0,
  `couponusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `couponusetime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`couponsn`) USING BTREE,
  INDEX `couponstatus`(`couponstatus`, `couponendtime`) USING BTREE,
  INDEX `couponaddtime`(`couponaddtime`) USING BTREE,
  INDEX `couponusername`(`couponusername`) USING BTREE,
  INDEX `couponusetime`(`couponusetime`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_coupon
-- ----------------------------
INSERT INTO `x2_coupon` VALUES ('87099EFC58C8DA97', 100, 1, 1665458135, 1696994135, '', 0);
INSERT INTO `x2_coupon` VALUES ('DC23FD1B8F2C2098', 100, 1, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('03E90B0E9CA7AEB5', 100, 1, 1692843078, 1724379078, 'peadmin', 1692845828);
INSERT INTO `x2_coupon` VALUES ('E484BB15FCBF58FC', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('4A0430716B5FC8F2', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('AFEFFE1CA1392C72', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('2A82510E6EC26861', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('5D49140DEF180F15', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('45C008F000B48578', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('05C7FDABE54F81A3', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('6542B394CD83939B', 100, 0, 1692843078, 1724379078, '', 0);
INSERT INTO `x2_coupon` VALUES ('229E2006D23E1D4F', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('0AA5BADC0A0F08EB', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('CB7D3E734D33346C', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('D9A070D77CED7431', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('C457998DEDA64F07', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('2E53724DF7D6C896', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('BF999DE348C53B98', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('12D918D087055DE3', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('0233DE711123CC08', 100, 0, 1760529015, 1792065015, '', 0);
INSERT INTO `x2_coupon` VALUES ('10F365CCBDD693BA', 100, 0, 1760529015, 1792065015, '', 0);

-- ----------------------------
-- Table structure for x2_course
-- ----------------------------
DROP TABLE IF EXISTS `x2_course`;
CREATE TABLE `x2_course`  (
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  `coursetitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `coursemoduleid` int(11) NULL DEFAULT NULL,
  `coursecsid` int(11) NULL DEFAULT NULL,
  `coursethumb` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `courseuserid` int(11) NULL DEFAULT NULL,
  `courseinputtime` int(11) NULL DEFAULT NULL,
  `coursemodifytime` int(11) NULL DEFAULT NULL,
  `coursesequence` int(11) NULL DEFAULT NULL,
  `coursedescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `course_files` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `course_oggfile` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `course_webmfile` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `course_youtu` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pdf_file` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `coursepasstime` int(11) NOT NULL,
  `YPJX_YP` int(255) NOT NULL,
  PRIMARY KEY (`courseid`) USING BTREE,
  INDEX `coursecsid`(`coursecsid`, `courseuserid`, `courseinputtime`, `coursemodifytime`, `coursesequence`) USING BTREE,
  INDEX `coursemoduleid`(`coursemoduleid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_course
-- ----------------------------
INSERT INTO `x2_course` VALUES (1, '测试', 14, 1, 'files/attach/images/content/20190720/15635927397674.jpg', 1, 1467215744, 1729478673, 0, '', 'https://dev.phpems.net/phpems/petpl2/files/attach/images/content/20240319/17107963707266.mp4', '', '', '', '', 0, 0);
INSERT INTO `x2_course` VALUES (20, '湖南卫视高清直播测试', 14, 12, 'app/core/styles/images/noimage.gif', 1, 1580528728, 1666060249, 0, '&lt;p&gt;本地址仅测试直播使用，如有侵权，请联系QQ2241223009删除。&lt;/p&gt;', 'http://mpv-seg.videocc.net/5cb340c902/5/5cb340c902623bc5a86c97d42da4a7a5_1.mp4/index.m3u8', '', '', '', '', 0, 0);
INSERT INTO `x2_course` VALUES (7, '课件7', 15, 1, 'files/attach/images/content/20190720/15635931122951.jpg', 1, 1503560761, 1620458205, 0, '&lt;p&gt;课件7&lt;/p&gt;', '', '', '', '', 'files/attach/images/content/20210508/16204582045520.pdf', 0, 0);

-- ----------------------------
-- Table structure for x2_coursesubject
-- ----------------------------
DROP TABLE IF EXISTS `x2_coursesubject`;
CREATE TABLE `x2_coursesubject`  (
  `csid` int(11) NOT NULL AUTO_INCREMENT,
  `cstitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `cscatid` int(11) NULL DEFAULT NULL,
  `csuserid` int(11) NULL DEFAULT 0,
  `csbasicid` int(11) NULL DEFAULT 0,
  `cssubjectid` int(11) NULL DEFAULT 0,
  `cstime` int(11) NULL DEFAULT 0,
  `csthumb` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '',
  `cssequence` int(11) NULL DEFAULT NULL,
  `csdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `csdemo` tinyint(1) NULL DEFAULT NULL,
  `csprice` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cstype` tinyint(1) NULL DEFAULT NULL,
  `csprogress` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`csid`) USING BTREE,
  INDEX `csbasicid`(`csbasicid`, `cssubjectid`, `cstime`) USING BTREE,
  INDEX `cscatid`(`cscatid`) USING BTREE,
  INDEX `cuserid`(`csuserid`) USING BTREE,
  INDEX `cssequence`(`cssequence`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 24 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_coursesubject
-- ----------------------------
INSERT INTO `x2_coursesubject` VALUES (1, '会计基础', 5, 1, 1, 1, 1467214449, 'files/attach/images/content/20210830/16302940954876.jpg', 0, '会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础会计基础', 0, '10:10', 1, 1);
INSERT INTO `x2_coursesubject` VALUES (12, '直播测试', 33, 1, 1, 1, 1575361277, 'files/attach/images/content/20210830/16302940801600.jpg', 0, '', 1, '', 0, 1);

-- ----------------------------
-- Table structure for x2_docfloder
-- ----------------------------
DROP TABLE IF EXISTS `x2_docfloder`;
CREATE TABLE `x2_docfloder`  (
  `dfid` int(11) NOT NULL AUTO_INCREMENT,
  `dftitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dfcatid` int(11) NULL DEFAULT NULL,
  `dfthumb` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dftime` int(11) NOT NULL,
  `dfdecrbie` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`dfid`) USING BTREE,
  INDEX `dfcatid`(`dfcatid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_docfloder
-- ----------------------------

-- ----------------------------
-- Table structure for x2_dochistory
-- ----------------------------
DROP TABLE IF EXISTS `x2_dochistory`;
CREATE TABLE `x2_dochistory`  (
  `dhid` int(11) NOT NULL AUTO_INCREMENT,
  `dhdocid` int(11) NULL DEFAULT NULL,
  `dhtitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dhcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dhtime` int(11) NOT NULL,
  `dhusername` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dhstatus` tinyint(4) NOT NULL,
  `dhtop` tinyint(4) NOT NULL,
  PRIMARY KEY (`dhid`) USING BTREE,
  INDEX `dhtime`(`dhtime`) USING BTREE,
  INDEX `dhstatus`(`dhstatus`) USING BTREE,
  INDEX `dhtop`(`dhtop`) USING BTREE,
  INDEX `dhdocid`(`dhdocid`) USING BTREE,
  INDEX `dhusername`(`dhusername`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_dochistory
-- ----------------------------
INSERT INTO `x2_dochistory` VALUES (1, 1, '测试xss', '<script>alert(\\\'ssssss\\\')</script>', 1760523815, 'peadmin', 1, 0);
INSERT INTO `x2_dochistory` VALUES (2, 1, '3333', '', 1760526928, 'peadmin', 1, 0);
INSERT INTO `x2_dochistory` VALUES (3, 1, '双方的', '\r\n2342的萨芬士大夫发士大夫士大夫的撒法', 1760527020, 'peadmin', 1, 0);

-- ----------------------------
-- Table structure for x2_docs
-- ----------------------------
DROP TABLE IF EXISTS `x2_docs`;
CREATE TABLE `x2_docs`  (
  `docid` int(11) NOT NULL AUTO_INCREMENT,
  `doctitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `docthumb` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `doccatid` int(11) NOT NULL,
  `dockeywords` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `doccontentid` int(11) NOT NULL,
  `docinputtime` int(11) NOT NULL,
  `docmodifytime` int(11) NOT NULL,
  `docsequence` int(11) NULL DEFAULT NULL,
  `docdescribe` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `doclocker` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `doclocktime` int(11) NULL DEFAULT NULL,
  `docneedmore` int(1) NULL DEFAULT NULL,
  `docsyslock` tinyint(1) NULL DEFAULT NULL,
  `docistop` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`docid`) USING BTREE,
  INDEX `doctitle`(`doctitle`) USING BTREE,
  INDEX `doccatid`(`doccatid`) USING BTREE,
  INDEX `doccontentid`(`doccontentid`) USING BTREE,
  INDEX `docinputtime`(`docinputtime`) USING BTREE,
  INDEX `docmodifytime`(`docmodifytime`) USING BTREE,
  INDEX `doclocker`(`doclocker`) USING BTREE,
  INDEX `doclocktime`(`doclocktime`) USING BTREE,
  INDEX `docsyslock`(`docsyslock`) USING BTREE,
  INDEX `docsequence`(`docsequence`) USING BTREE,
  INDEX `docistop`(`docistop`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_docs
-- ----------------------------
INSERT INTO `x2_docs` VALUES (1, '欧拉公式', 'app/core/styles/images/noimage.gif', 21, '', 3, 1681980169, 0, 0, '欧拉公式', '', 0, 1, 0, 0);

-- ----------------------------
-- Table structure for x2_enroll
-- ----------------------------
DROP TABLE IF EXISTS `x2_enroll`;
CREATE TABLE `x2_enroll`  (
  `enrollid` int(11) NOT NULL AUTO_INCREMENT,
  `enrollbatid` int(11) NULL DEFAULT NULL,
  `enrolluserid` int(11) NULL DEFAULT NULL,
  `enrolltruename` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enrollpassport` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enrollphone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enrolltime` int(11) NULL DEFAULT NULL,
  `enrollstatus` int(1) NULL DEFAULT NULL,
  `enrollordersn` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enrollsign` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `enrollverify` int(1) NULL DEFAULT NULL,
  `enroll_address` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`enrollid`) USING BTREE,
  INDEX `enrollbatid`(`enrollbatid`) USING BTREE,
  INDEX `enrollstatus`(`enrollstatus`) USING BTREE,
  INDEX `enrollordersn`(`enrollordersn`) USING BTREE,
  INDEX `enrolltruename`(`enrolltruename`) USING BTREE,
  INDEX `enrollpassport`(`enrollpassport`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_enroll
-- ----------------------------
INSERT INTO `x2_enroll` VALUES (6, 5, 1, '111111111111111111', '412012112412012112', '13548961235', 1729137316, 0, '', 'data:image/png;base64,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', 2, '');

-- ----------------------------
-- Table structure for x2_enroll_bats
-- ----------------------------
DROP TABLE IF EXISTS `x2_enroll_bats`;
CREATE TABLE `x2_enroll_bats`  (
  `enbid` int(11) NOT NULL AUTO_INCREMENT,
  `enbthumb` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enbname` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `enbprice` decimal(10, 2) NULL DEFAULT NULL,
  `enbmoduleid` int(11) NULL DEFAULT NULL,
  `enbstarttime` int(11) NULL DEFAULT NULL,
  `enbendtime` int(11) NULL DEFAULT NULL,
  `enbintro` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `enbtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`enbid`) USING BTREE,
  INDEX `enbstarttime`(`enbstarttime`) USING BTREE,
  INDEX `enbendtime`(`enbendtime`) USING BTREE,
  INDEX `enbmoduleid`(`enbmoduleid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_enroll_bats
-- ----------------------------
INSERT INTO `x2_enroll_bats` VALUES (5, 'files/attach/images/content/20241017/17291371345207.png', '9月30日郊游报名', 0.00, 39, 1729094451, 1730304051, '', 1729137145);

-- ----------------------------
-- Table structure for x2_examhistory
-- ----------------------------
DROP TABLE IF EXISTS `x2_examhistory`;
CREATE TABLE `x2_examhistory`  (
  `ehid` int(11) NOT NULL AUTO_INCREMENT,
  `ehexamid` int(11) NOT NULL DEFAULT 0,
  `ehexam` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ehtype` int(11) NOT NULL DEFAULT 0,
  `ehbasicid` int(11) NOT NULL DEFAULT 0,
  `ehquestion` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ehsetting` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ehscorelist` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ehuseranswer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ehtime` int(11) NOT NULL DEFAULT 0,
  `ehscore` decimal(10, 2) NOT NULL DEFAULT 0.00,
  `ehuserid` int(11) NOT NULL DEFAULT 0,
  `ehusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ehstarttime` int(11) NOT NULL DEFAULT 0,
  `ehendtime` int(11) NOT NULL,
  `ehstatus` int(1) NOT NULL DEFAULT 1,
  `ehdecide` int(1) NOT NULL DEFAULT 0,
  `ehtimelist` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ehopenid` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ehneedresit` tinyint(1) NOT NULL,
  `ehispass` tinyint(1) NULL DEFAULT NULL,
  `ehteacher` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ehdecidetime` int(11) NULL DEFAULT NULL,
  `ehbatch` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ehid`) USING BTREE,
  INDEX `ehtype`(`ehtype`, `ehbasicid`, `ehtime`, `ehuserid`) USING BTREE,
  INDEX `ehdecide`(`ehdecide`) USING BTREE,
  INDEX `ehexamid`(`ehexamid`) USING BTREE,
  INDEX `examopenid`(`ehopenid`) USING BTREE,
  INDEX `ehneedresit`(`ehneedresit`) USING BTREE,
  INDEX `ehispass`(`ehispass`) USING BTREE,
  INDEX `ehbatch`(`ehbatch`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_examhistory
-- ----------------------------
INSERT INTO `x2_examhistory` VALUES (27, 1, '演示试卷一', 2, 1, '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', 'a:72:{i:6391;i:0;i:6476;i:0;i:6516;i:0;i:6549;i:0;i:6587;i:0;i:6639;i:0;i:6654;i:0;i:6688;i:0;i:6699;i:0;i:6883;i:0;i:7269;i:0;i:7370;i:0;i:7554;i:0;i:7938;i:0;i:8076;i:0;i:8087;i:0;i:8209;i:0;i:8218;i:0;i:8268;i:0;i:8312;i:0;i:9076;i:0;i:9085;i:0;i:9164;i:0;i:9277;i:0;i:9282;i:0;i:9456;i:0;i:9458;i:0;i:9556;i:0;i:9640;i:0;i:7190;i:0;i:8909;i:0;i:6510;i:0;i:6526;i:0;i:6588;i:0;i:6597;i:0;i:6605;i:0;i:6744;i:0;i:6746;i:0;i:6747;i:0;i:7052;i:0;i:7308;i:0;i:7312;i:0;i:7368;i:0;i:7384;i:0;i:7436;i:0;i:7446;i:0;i:7455;i:0;i:7463;i:0;i:7525;i:0;i:7605;i:0;i:7910;i:0;i:8095;i:0;i:8169;i:0;i:8173;i:0;i:8245;i:0;i:8297;i:0;i:8316;i:0;i:8324;i:0;i:8463;i:0;i:8464;i:0;i:8465;i:0;i:9087;i:0;i:9103;i:0;i:9155;i:0;i:9244;i:0;i:9279;i:0;i:9322;i:0;i:9323;i:0;i:9324;i:0;i:9521;i:0;i:9629;i:0;i:9757;i:0;}', 'a:2:{i:7191;s:0:\"\";i:8051;s:0:\"\";}', 6, 0.00, 1, 'peadmin', 1729132743, 0, 0, 1, '', '', 0, 0, '', 0, '');
INSERT INTO `x2_examhistory` VALUES (28, 1, '演示试卷一', 2, 1, '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', 'a:72:{i:6476;i:0;i:6490;i:0;i:6508;i:0;i:6639;i:0;i:6704;i:0;i:6706;i:0;i:7274;i:0;i:7305;i:0;i:7408;i:0;i:7555;i:0;i:7557;i:0;i:7562;i:0;i:7742;i:0;i:7837;i:0;i:7921;i:0;i:8059;i:0;i:8132;i:0;i:8189;i:0;i:8268;i:0;i:8417;i:0;i:8889;i:0;i:8990;i:0;i:8993;i:0;i:9032;i:0;i:9047;i:0;i:9085;i:0;i:9173;i:0;i:9202;i:0;i:9676;i:0;i:9727;i:0;i:7190;i:0;i:8909;i:0;i:6454;i:0;i:6526;i:0;i:6578;i:0;i:6605;i:0;i:6667;i:0;i:6702;i:0;i:6745;i:0;i:6746;i:0;i:6944;i:0;i:7052;i:0;i:7234;i:0;i:7308;i:0;i:7312;i:0;i:7368;i:0;i:7446;i:0;i:7525;i:0;i:7602;i:0;i:7603;i:0;i:7604;i:0;i:7802;i:0;i:8095;i:0;i:8173;i:0;i:8229;i:0;i:8245;i:0;i:8297;i:0;i:8307;i:0;i:8324;i:0;i:8386;i:0;i:8421;i:0;i:8463;i:0;i:8464;i:0;i:8465;i:0;i:9031;i:0;i:9103;i:0;i:9174;i:0;i:9279;i:0;i:9321;i:0;i:9322;i:0;i:9324;i:0;i:9629;i:0;}', '', 1815, 0.00, 1, 'peadmin', 1729135169, 0, 1, 1, '', '', 0, 0, '', 0, '');
INSERT INTO `x2_examhistory` VALUES (29, 2, '测试组卷', 1, 1, 'eNrtmutT2lgUwL93pv+Dw4d+2q0khFeYnZ2q/0jUVNlFpCRut9PpjLTVgjyEioISa32V1gr4qDY8bP+Z3JvwyX9h700QEoxF3NoyHZwh3Jxzb+7r/M45l8jQJP2Uo9205dEMy/HeaT9n8TA0QT/10gQuWHHJ7aTs+MaN6yJRs7J33OLhaIq24Bq4SJAtJf8kwKoy2kLgb1dLhW9tNtoCs7tKKA0L26C2qJx8BvmoVElI1VmpHJbXXgFxXW1PtRrOcGxQ6/TiqYTDqPUzU2qvTtoSYJnxKa/aGakbl4/h+Knpce/DJ7g+1qIZtXfEsT52jMdSN9Le8/GewL0J3vOAhtkE2NmTd1ewbFAVNrVDNChGr9QO0yCdbNeqg7O29+ufmRrVhoamaWsfG+PnHje1D9oXYZzlxoLeUdagt7f0f/unH3N4DRvbbEUF1QjQijV1alMSf9sb0otu4ElUKS2T8sauUpqXn5ctnmfPkEa3uWNBluFZ3qvtAzYXwkFaKZubtLkvLTPP8DOcYT91OzXJT/mu2J8AE2T9fKOhtX0NOBaV/GOsQW/TmQD7D+vTz1KvHEdbYDALu0HXnJj63GcqHY6OdDi6pcOpWR3+SJUKPEjBzC5c2FUtCn1AOAfCC4iWHiCEsDsMiEiVNMjlYOYUChumlCj5bZj+AsNZqRK5stowDRcyeNLfrjZCg9wZmDsE8RAofwKlMjheba98Dciob0I23AGy4T5ktw+ZsyNkzi4hc2HX/mhmGiEmCvXthCTGJTEBUu/rLxLSl6+/1ZeEem4WBSn4+bCeDkmVmFROaw3A/Kq89hJmS2BpTxJngVBBdgrOyn/2AI8OI47KyQ7YDknlKBqhKY715a8gWmmvcA1oyH5kuk1oiO8AjasjNK5uIxOSw3AKeV0ozMLMB4QB2D0Gi0eg8A4UTxESvcCAizIwIC8WYLZgHozSm3LywDwArSegOCfP5fv52q8VStwdqXB3SQWFBoSCCDyMQOEjTkTmBZSzoTONVI7Ut+aVrZVmrJDO4j1ICKi9VfKvTQlBGCiv9mA4aQpJvfoSfN7qE/JLEWK3diLEbu2SEDuBCVmRl2OSuCDv72MSxD2wmJITB0A4kLdDILSITFASCyi24DNPtnReW+vBWLK7AuaPULpkDstRGEb3zY//CLHNze9IylAHUob6pNw+KURHUohuMyw0G2T/8mFVwwTub8qrVSiEcQgR3qMoggLMeW2jF47+VuOvY4TbYTfFAikcplAghdv0WE+4nWT/CP9rsUJ2ZIXsNu9C98pBCGGhpApKMgbmjiUxCmMpOVQCOwJcyZzXUMCJg/C88kJQPm30CDc2R3v2Vd9+83v9w75yOmf+y3KzBjg6NCVJOTmRKqmrnzGipmpf316q8b/Z6mdsPcCWrSNbti7ZcqJOQe4tXMvA9Vko7NVDzxFMytZHmCvDpThcKUjldRh7hYQgcqSEY7iAOHu+JZ0tKbMxWKhqv5EhQHsEO4IwYhdPSGcZc96SEVA+NgVNTkRBIQmFuClkcj6ufEl9R7r6WV4P0EV1pIvq9jxE6kxRKYlKKidVikAU8Vm7lJaLm1L1CLyOafAY7elnH4icxvc95SQszd1jpgIe/ygX8Ayo0UqJlHQidPoprMLCO51ohAZ5AYEkR1Z/VCwiDdlq25r2CbotgtTZ68YcVNdK/28GuECq2SGFlxlPomHUqBmpdo+HHmxnSoUxqMeKsOldfH0rC8QzdNW25Ly21tr0u3fu3mlW1Nllx2I9O6eUqnA9CVdWQfkUFGMwnKxniqgbo0nhf6sIXt+WiEu2hG5gLS3vVNpMyYkffOlVAbavoAGVltjgJcjW0un9g9rd8ioQw8j5yMl5kMo2jSZ4pYvQ9sVoyQ6SIhxavqH2ftmE1Rm0W5G7ITSaj2oO4wzPNJcQeduOLwPt3b4MpNw6uwHLC6D4BkaW0BXs5JXoolbWrj3ljG1Gbzxw3aEbzH/oZs2Gb9Zs5GbNcME7NTHA+Pg/tLew2nWAC441BA+9PpYbZHieGZsc1G7G0M4jNzhIWkmb1U7aBgmHi3JZXW6Hg6Ccrvt/BSYuHsM/8bGNBz32jvOT9ABltQb+9QxMst6JSZ4eIEk7um1UH7wY04+IXCZ+tuk8RpFP6Rxe1Enb7dRNwkujB9PY0nTQP+k1p/r3H+Rj+lo=', 'eNqtVM1SgzAQfpecOSQBAqRPk0LUqEAlYWqnw82b49Hn8OR48Hn8eQyzCTCh015qL8vOt7vft2GTFZzEfK8540g+ilpVaKU54Yi6L/Go7te3sjRjiMA38REHUY6+359/315/Pp++Xj4WldIY1VyjlbAKVib3sFG1hDRbyTA4GUdlW191bR2KpBzpsu1camwx7HILjjZC6zkyk0AjD73UZreR98pIUM34XnEycypOAz8O/MT7GPw0wFngZ3PO4I4yiYFQ6oUEn35n09dr2Y0NEnx4nhm0PJXUZafWDsccWXro8xiVV18yTdgJovhSROmliNhliAY7BHt53YVyk1BtoxejoCBSjHPyUctvSaMiSxMwMRgKhoDB1iQFmBxMBoaBSSPXjlXr2q1e8NmXEFEazUM7Kuo6PkEQDurs4vQ/xez84sEVuac+DW0qwiNuhOn1wTTdEnAvJ9g21OOiNzdtN28iEpL52LgxNlJUtWpCynGvQDphLI9pjikLF9Kd3G3brjrSZyVLVQW3bvgDXjWEfQ==', 'a:11:{i:9745;i:0;i:9746;i:0;i:9747;i:0;i:9748;i:0;i:9749;i:0;i:9750;i:0;i:9751;i:0;i:9752;i:0;i:9753;i:0;i:9754;i:0;i:9757;i:0;}', '', 3600, 0.00, 1, 'peadmin', 1729401348, 0, 1, 0, '', '', 0, 0, '', 0, '');
INSERT INTO `x2_examhistory` VALUES (30, 2, '测试组卷', 1, 1, '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', 'a:11:{i:9745;s:2:\"10\";i:9746;s:2:\"10\";i:9747;i:0;i:9748;i:0;i:9749;i:0;i:9750;i:0;i:9751;i:0;i:9752;i:0;i:9753;i:0;i:9754;i:0;i:9757;i:0;}', 'a:4:{i:9745;s:1:\"A\";i:9746;s:1:\"C\";i:9747;s:1:\"B\";i:9748;s:1:\"B\";}', 3600, 20.00, 1, 'peadmin', 1729409436, 0, 1, 0, '', '', 0, 0, '', 0, '');
INSERT INTO `x2_examhistory` VALUES (31, 1, '演示试卷一', 1, 1, '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', 'a:72:{i:6368;i:0;i:6391;i:0;i:6499;i:0;i:6501;i:0;i:6887;i:0;i:6979;i:0;i:7039;i:0;i:7298;i:0;i:7313;i:0;i:7355;i:0;i:7392;i:0;i:7417;i:0;i:7707;i:0;i:7871;i:0;i:7874;i:0;i:8216;i:0;i:8227;i:0;i:8268;i:0;i:8344;i:0;i:8407;i:0;i:8418;i:0;i:8423;i:0;i:8783;i:0;i:9093;i:0;i:9157;i:0;i:9203;i:0;i:9275;i:0;i:9281;i:0;i:9282;i:0;i:9593;i:0;i:7190;i:0;i:8909;i:0;i:6450;i:0;i:6578;i:0;i:6588;i:0;i:6597;i:0;i:6605;i:0;i:6667;i:0;i:6702;i:0;i:6747;i:0;i:6944;i:0;i:7052;i:0;i:7308;i:0;i:7312;i:0;i:7384;i:0;i:7446;i:0;i:7463;i:0;i:7602;i:0;i:7604;i:0;i:7605;i:0;i:7802;i:0;i:7910;i:0;i:8169;i:0;i:8173;i:0;i:8229;i:0;i:8245;i:0;i:8297;i:0;i:8316;i:0;i:8324;i:0;i:8464;i:0;i:8771;i:0;i:9031;i:0;i:9103;i:0;i:9165;i:0;i:9174;i:0;i:9244;i:0;i:9279;i:0;i:9321;i:0;i:9322;i:0;i:9323;i:0;i:9521;i:0;i:9629;i:0;}', '', 1267, 0.00, 1, 'peadmin', 1729475376, 0, 1, 1, '', '', 0, 0, '', 0, '');
INSERT INTO `x2_examhistory` VALUES (32, 0, '123123', 0, 1, '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', 'a:15:{i:6492;i:0;i:6573;i:0;i:6729;i:0;i:6925;i:0;i:6973;i:1;i:7381;i:0;i:7535;i:0;i:7658;i:0;i:7666;i:0;i:9757;i:0;i:7192;s:1:\"1\";i:8041;s:1:\"1\";i:8050;s:0:\"\";i:7191;s:0:\"\";i:8051;s:0:\"\";}', 'a:8:{i:6573;s:1:\"A\";i:6729;s:1:\"C\";i:6973;s:1:\"B\";i:7192;s:0:\"\";i:8041;s:0:\"\";i:8050;s:0:\"\";i:7191;s:0:\"\";i:8051;s:0:\"\";}', 13, 3.00, 1, 'peadmin', 1760522439, 0, 1, 0, '', '', 0, 1, '', 0, '');

-- ----------------------------
-- Table structure for x2_examhistory_log
-- ----------------------------
DROP TABLE IF EXISTS `x2_examhistory_log`;
CREATE TABLE `x2_examhistory_log`  (
  `ehlid` int(11) NOT NULL AUTO_INCREMENT,
  `ehlehid` int(11) NULL DEFAULT NULL,
  `ehluserid` int(11) NULL DEFAULT NULL,
  `ehltype` int(2) NULL DEFAULT NULL,
  `ehlinfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `ehltime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ehlid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of x2_examhistory_log
-- ----------------------------
INSERT INTO `x2_examhistory_log` VALUES (11, 28, 1, 3, '要求补考', 1760527872);
INSERT INTO `x2_examhistory_log` VALUES (12, 28, 1, 3, '要求补考', 1760527926);

-- ----------------------------
-- Table structure for x2_exams
-- ----------------------------
DROP TABLE IF EXISTS `x2_exams`;
CREATE TABLE `x2_exams`  (
  `examid` int(11) NOT NULL AUTO_INCREMENT,
  `examsubject` int(11) NOT NULL DEFAULT 0,
  `exam` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `examsetting` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examquestions` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examscore` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examstatus` int(1) NOT NULL DEFAULT 0,
  `examtype` int(11) NOT NULL DEFAULT 0,
  `examauthorid` int(11) NOT NULL DEFAULT 0,
  `examauthor` varchar(120) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL DEFAULT '',
  `examtime` int(11) NOT NULL DEFAULT 0,
  `examkeyword` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `examdecide` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`examid`) USING BTREE,
  INDEX `examstatus`(`examstatus`) USING BTREE,
  INDEX `examtype`(`examtype`, `examauthorid`) USING BTREE,
  INDEX `examtime`(`examtime`) USING BTREE,
  INDEX `examsubject`(`examsubject`) USING BTREE,
  INDEX `examdecide`(`examdecide`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_exams
-- ----------------------------
INSERT INTO `x2_exams` VALUES (1, 1, '演示试卷一', 'a:7:{s:8:\"examtime\";s:2:\"60\";s:7:\"comfrom\";s:0:\"\";s:5:\"score\";s:3:\"100\";s:9:\"passscore\";s:1:\"1\";s:12:\"questypelite\";a:6:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"0\";i:5;s:1:\"1\";i:6;s:1:\"1\";}s:10:\"scalemodel\";s:1:\"0\";s:8:\"questype\";a:5:{i:1;a:6:{s:6:\"number\";s:2:\"30\";s:5:\"score\";s:1:\"1\";s:8:\"describe\";s:0:\"\";s:10:\"easynumber\";s:2:\"30\";s:12:\"middlenumber\";s:1:\"0\";s:10:\"hardnumber\";s:1:\"0\";}i:2;a:6:{s:6:\"number\";s:2:\"20\";s:5:\"score\";s:1:\"1\";s:8:\"describe\";s:0:\"\";s:10:\"easynumber\";s:2:\"20\";s:12:\"middlenumber\";s:1:\"0\";s:10:\"hardnumber\";s:1:\"0\";}i:3;a:6:{s:6:\"number\";s:2:\"40\";s:5:\"score\";s:1:\"1\";s:8:\"describe\";s:0:\"\";s:10:\"easynumber\";s:2:\"40\";s:12:\"middlenumber\";s:1:\"0\";s:10:\"hardnumber\";s:1:\"0\";}i:5;a:6:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";s:10:\"easynumber\";s:1:\"0\";s:12:\"middlenumber\";s:1:\"0\";s:10:\"hardnumber\";s:1:\"0\";}i:6;a:6:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";s:10:\"easynumber\";s:1:\"0\";s:12:\"middlenumber\";s:1:\"0\";s:10:\"hardnumber\";s:1:\"0\";}}}', '', '', 0, 1, 2, 'peadmin', 1479265100, '', 1);
INSERT INTO `x2_exams` VALUES (2, 1, '测试组卷', 'a:6:{s:8:\"examtime\";s:2:\"60\";s:7:\"comfrom\";s:1:\"1\";s:5:\"score\";s:3:\"100\";s:9:\"passscore\";s:2:\"60\";s:12:\"questypelite\";a:7:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"0\";i:5;s:1:\"1\";i:6;s:1:\"1\";i:7;s:1:\"0\";}s:8:\"questype\";a:5:{i:1;a:3:{s:6:\"number\";s:2:\"10\";s:5:\"score\";s:2:\"10\";s:8:\"describe\";s:0:\"\";}i:2;a:3:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";}i:3;a:3:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";}i:5;a:3:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";}i:6;a:3:{s:6:\"number\";s:1:\"0\";s:5:\"score\";s:1:\"0\";s:8:\"describe\";s:0:\"\";}}}', 'a:5:{i:1;a:2:{s:9:\"questions\";s:51:\",9754,9753,9752,9751,9750,9749,9748,9747,9746,9745,\";s:13:\"rowsquestions\";s:4:\",22,\";}i:2;a:2:{s:9:\"questions\";s:0:\"\";s:13:\"rowsquestions\";s:0:\"\";}i:3;a:2:{s:9:\"questions\";s:0:\"\";s:13:\"rowsquestions\";s:0:\"\";}i:5;a:2:{s:9:\"questions\";s:0:\"\";s:13:\"rowsquestions\";s:0:\"\";}i:6;a:2:{s:9:\"questions\";s:0:\"\";s:13:\"rowsquestions\";s:0:\"\";}}', '', 0, 2, 1, 'peadmin', 1668328026, '', 0);

-- ----------------------------
-- Table structure for x2_examsession
-- ----------------------------
DROP TABLE IF EXISTS `x2_examsession`;
CREATE TABLE `x2_examsession`  (
  `examsessionid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionuserid` int(11) NOT NULL DEFAULT 0,
  `examsession` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `examsessionsetting` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionsign` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionbasic` int(11) NOT NULL DEFAULT 0,
  `examsessiontype` int(1) NOT NULL,
  `examsessionkey` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `examsessionquestion` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionuseranswer` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionstarttime` int(11) NOT NULL DEFAULT 0,
  `examsessiontime` int(11) NOT NULL DEFAULT 0,
  `examsessionstatus` int(1) NOT NULL DEFAULT 0,
  `examsessionscore` decimal(10, 1) NOT NULL DEFAULT 0.0,
  `examsessionscorelist` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessionissave` int(1) NOT NULL DEFAULT 0,
  `examsessiontimelist` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `examsessiontoken` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`examsessionid`) USING BTREE,
  INDEX `examsessionstarttime`(`examsessionstarttime`) USING BTREE,
  INDEX `examsessionstatus`(`examsessionstatus`) USING BTREE,
  INDEX `examsessiontype`(`examsessiontype`) USING BTREE,
  INDEX `examsessionkey`(`examsessionkey`) USING BTREE,
  INDEX `examsubject`(`examsessionbasic`) USING BTREE,
  INDEX `examsessionissave`(`examsessionissave`) USING BTREE,
  INDEX `examsessionuserid`(`examsessionuserid`) USING BTREE,
  INDEX `examsessiontoken`(`examsessiontoken`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_examsession
-- ----------------------------

-- ----------------------------
-- Table structure for x2_exercise
-- ----------------------------
DROP TABLE IF EXISTS `x2_exercise`;
CREATE TABLE `x2_exercise`  (
  `exerid` int(11) NOT NULL AUTO_INCREMENT,
  `exeruserid` int(11) NOT NULL,
  `exerbasicid` int(11) NOT NULL,
  `exerknowsid` int(11) NOT NULL,
  `exernumber` int(11) NOT NULL,
  `exerqutype` int(11) NOT NULL,
  PRIMARY KEY (`exerid`) USING BTREE,
  INDEX `exeruserid`(`exeruserid`) USING BTREE,
  INDEX `exerbasicid`(`exerbasicid`) USING BTREE,
  INDEX `exerknowsid`(`exerknowsid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_exercise
-- ----------------------------

-- ----------------------------
-- Table structure for x2_favor
-- ----------------------------
DROP TABLE IF EXISTS `x2_favor`;
CREATE TABLE `x2_favor`  (
  `favorid` int(11) NOT NULL AUTO_INCREMENT,
  `favoruserid` int(11) NOT NULL DEFAULT 0,
  `favorsubjectid` int(11) NOT NULL DEFAULT 0,
  `favorquestionid` int(11) NOT NULL DEFAULT 0,
  `favortime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`favorid`) USING BTREE,
  INDEX `favoruserid`(`favoruserid`, `favorquestionid`, `favortime`) USING BTREE,
  INDEX `favorsubjectid`(`favorsubjectid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_favor
-- ----------------------------

-- ----------------------------
-- Table structure for x2_feedback
-- ----------------------------
DROP TABLE IF EXISTS `x2_feedback`;
CREATE TABLE `x2_feedback`  (
  `fbid` int(11) NOT NULL AUTO_INCREMENT,
  `fbquestionid` int(11) NOT NULL,
  `fbtype` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fbcontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fbuserid` int(11) NOT NULL,
  `fbtime` int(11) NOT NULL,
  `fbstatus` tinyint(4) NOT NULL,
  `fbdoneuserid` int(11) NOT NULL,
  `fbdonetime` int(11) NOT NULL,
  PRIMARY KEY (`fbid`) USING BTREE,
  INDEX `fbquestionid`(`fbquestionid`, `fbuserid`) USING BTREE,
  INDEX `fbtype`(`fbtype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_feedback
-- ----------------------------

-- ----------------------------
-- Table structure for x2_knows
-- ----------------------------
DROP TABLE IF EXISTS `x2_knows`;
CREATE TABLE `x2_knows`  (
  `knowsid` int(11) NOT NULL AUTO_INCREMENT,
  `knows` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `knowssectionid` int(11) NOT NULL DEFAULT 0,
  `knowsdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `knowsstatus` int(1) NOT NULL DEFAULT 1,
  `knowssequence` int(11) NOT NULL,
  `knowsnumber` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `knowsquestions` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`knowsid`) USING BTREE,
  INDEX `knows`(`knows`, `knowssectionid`) USING BTREE,
  INDEX `knowsstatus`(`knowsstatus`) USING BTREE,
  INDEX `knowssequence`(`knowssequence`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_knows
-- ----------------------------
INSERT INTO `x2_knows` VALUES (1, '演示知识点', 1, '', 1, 0, 'a:7:{i:1;i:1672;i:3;i:34;i:2;i:2;i:6;i:2;i:5;i:3;i:4;i:4;i:0;i:1;}', 'a:7:{i:1;a:1672:{i:0;s:4:\"6335\";i:1;s:4:\"6336\";i:2;s:4:\"6337\";i:3;s:4:\"6338\";i:4;s:4:\"6339\";i:5;s:4:\"6340\";i:6;s:4:\"6341\";i:7;s:4:\"6342\";i:8;s:4:\"6343\";i:9;s:4:\"6344\";i:10;s:4:\"6345\";i:11;s:4:\"6346\";i:12;s:4:\"6347\";i:13;s:4:\"6348\";i:14;s:4:\"6349\";i:15;s:4:\"6350\";i:16;s:4:\"6351\";i:17;s:4:\"6352\";i:18;s:4:\"6353\";i:19;s:4:\"6354\";i:20;s:4:\"6355\";i:21;s:4:\"6356\";i:22;s:4:\"6357\";i:23;s:4:\"6358\";i:24;s:4:\"6359\";i:25;s:4:\"6360\";i:26;s:4:\"6361\";i:27;s:4:\"6362\";i:28;s:4:\"6363\";i:29;s:4:\"6364\";i:30;s:4:\"6365\";i:31;s:4:\"6366\";i:32;s:4:\"6367\";i:33;s:4:\"6368\";i:34;s:4:\"6369\";i:35;s:4:\"6370\";i:36;s:4:\"6371\";i:37;s:4:\"6372\";i:38;s:4:\"6373\";i:39;s:4:\"6374\";i:40;s:4:\"6375\";i:41;s:4:\"6377\";i:42;s:4:\"6378\";i:43;s:4:\"6379\";i:44;s:4:\"6380\";i:45;s:4:\"6381\";i:46;s:4:\"6382\";i:47;s:4:\"6383\";i:48;s:4:\"6384\";i:49;s:4:\"6385\";i:50;s:4:\"6386\";i:51;s:4:\"6387\";i:52;s:4:\"6388\";i:53;s:4:\"6389\";i:54;s:4:\"6390\";i:55;s:4:\"6391\";i:56;s:4:\"6392\";i:57;s:4:\"6393\";i:58;s:4:\"6394\";i:59;s:4:\"6395\";i:60;s:4:\"6396\";i:61;s:4:\"6397\";i:62;s:4:\"6398\";i:63;s:4:\"6399\";i:64;s:4:\"6400\";i:65;s:4:\"6401\";i:66;s:4:\"6402\";i:67;s:4:\"6403\";i:68;s:4:\"6404\";i:69;s:4:\"6405\";i:70;s:4:\"6406\";i:71;s:4:\"6407\";i:72;s:4:\"6408\";i:73;s:4:\"6409\";i:74;s:4:\"6410\";i:75;s:4:\"6411\";i:76;s:4:\"6412\";i:77;s:4:\"6413\";i:78;s:4:\"6414\";i:79;s:4:\"6415\";i:80;s:4:\"6416\";i:81;s:4:\"6417\";i:82;s:4:\"6418\";i:83;s:4:\"6419\";i:84;s:4:\"6420\";i:85;s:4:\"6421\";i:86;s:4:\"6422\";i:87;s:4:\"6423\";i:88;s:4:\"6424\";i:89;s:4:\"6425\";i:90;s:4:\"6426\";i:91;s:4:\"6427\";i:92;s:4:\"6428\";i:93;s:4:\"6429\";i:94;s:4:\"6430\";i:95;s:4:\"6431\";i:96;s:4:\"6432\";i:97;s:4:\"6433\";i:98;s:4:\"6434\";i:99;s:4:\"6435\";i:100;s:4:\"6436\";i:101;s:4:\"6437\";i:102;s:4:\"6438\";i:103;s:4:\"6439\";i:104;s:4:\"6440\";i:105;s:4:\"6441\";i:106;s:4:\"6442\";i:107;s:4:\"6443\";i:108;s:4:\"6444\";i:109;s:4:\"6445\";i:110;s:4:\"6446\";i:111;s:4:\"6447\";i:112;s:4:\"6448\";i:113;s:4:\"6449\";i:114;s:4:\"6451\";i:115;s:4:\"6452\";i:116;s:4:\"6453\";i:117;s:4:\"6455\";i:118;s:4:\"6456\";i:119;s:4:\"6457\";i:120;s:4:\"6458\";i:121;s:4:\"6459\";i:122;s:4:\"6460\";i:123;s:4:\"6461\";i:124;s:4:\"6462\";i:125;s:4:\"6463\";i:126;s:4:\"6464\";i:127;s:4:\"6465\";i:128;s:4:\"6466\";i:129;s:4:\"6467\";i:130;s:4:\"6468\";i:131;s:4:\"6469\";i:132;s:4:\"6470\";i:133;s:4:\"6471\";i:134;s:4:\"6472\";i:135;s:4:\"6473\";i:136;s:4:\"6474\";i:137;s:4:\"6475\";i:138;s:4:\"6476\";i:139;s:4:\"6477\";i:140;s:4:\"6478\";i:141;s:4:\"6479\";i:142;s:4:\"6480\";i:143;s:4:\"6481\";i:144;s:4:\"6482\";i:145;s:4:\"6483\";i:146;s:4:\"6484\";i:147;s:4:\"6485\";i:148;s:4:\"6486\";i:149;s:4:\"6487\";i:150;s:4:\"6488\";i:151;s:4:\"6489\";i:152;s:4:\"6490\";i:153;s:4:\"6491\";i:154;s:4:\"6492\";i:155;s:4:\"6493\";i:156;s:4:\"6494\";i:157;s:4:\"6495\";i:158;s:4:\"6496\";i:159;s:4:\"6497\";i:160;s:4:\"6498\";i:161;s:4:\"6499\";i:162;s:4:\"6500\";i:163;s:4:\"6501\";i:164;s:4:\"6502\";i:165;s:4:\"6503\";i:166;s:4:\"6504\";i:167;s:4:\"6505\";i:168;s:4:\"6506\";i:169;s:4:\"6507\";i:170;s:4:\"6508\";i:171;s:4:\"6509\";i:172;s:4:\"6511\";i:173;s:4:\"6512\";i:174;s:4:\"6513\";i:175;s:4:\"6514\";i:176;s:4:\"6515\";i:177;s:4:\"6516\";i:178;s:4:\"6517\";i:179;s:4:\"6518\";i:180;s:4:\"6519\";i:181;s:4:\"6520\";i:182;s:4:\"6521\";i:183;s:4:\"6522\";i:184;s:4:\"6523\";i:185;s:4:\"6524\";i:186;s:4:\"6525\";i:187;s:4:\"6527\";i:188;s:4:\"6528\";i:189;s:4:\"6529\";i:190;s:4:\"6530\";i:191;s:4:\"6531\";i:192;s:4:\"6532\";i:193;s:4:\"6533\";i:194;s:4:\"6534\";i:195;s:4:\"6535\";i:196;s:4:\"6536\";i:197;s:4:\"6537\";i:198;s:4:\"6538\";i:199;s:4:\"6539\";i:200;s:4:\"6540\";i:201;s:4:\"6541\";i:202;s:4:\"6542\";i:203;s:4:\"6543\";i:204;s:4:\"6544\";i:205;s:4:\"6545\";i:206;s:4:\"6546\";i:207;s:4:\"6547\";i:208;s:4:\"6548\";i:209;s:4:\"6549\";i:210;s:4:\"6550\";i:211;s:4:\"6551\";i:212;s:4:\"6552\";i:213;s:4:\"6553\";i:214;s:4:\"6554\";i:215;s:4:\"6555\";i:216;s:4:\"6556\";i:217;s:4:\"6557\";i:218;s:4:\"6558\";i:219;s:4:\"6559\";i:220;s:4:\"6560\";i:221;s:4:\"6561\";i:222;s:4:\"6562\";i:223;s:4:\"6563\";i:224;s:4:\"6564\";i:225;s:4:\"6565\";i:226;s:4:\"6566\";i:227;s:4:\"6567\";i:228;s:4:\"6568\";i:229;s:4:\"6569\";i:230;s:4:\"6570\";i:231;s:4:\"6571\";i:232;s:4:\"6572\";i:233;s:4:\"6573\";i:234;s:4:\"6574\";i:235;s:4:\"6575\";i:236;s:4:\"6576\";i:237;s:4:\"6577\";i:238;s:4:\"6579\";i:239;s:4:\"6580\";i:240;s:4:\"6581\";i:241;s:4:\"6582\";i:242;s:4:\"6583\";i:243;s:4:\"6584\";i:244;s:4:\"6585\";i:245;s:4:\"6586\";i:246;s:4:\"6587\";i:247;s:4:\"6589\";i:248;s:4:\"6590\";i:249;s:4:\"6591\";i:250;s:4:\"6592\";i:251;s:4:\"6593\";i:252;s:4:\"6594\";i:253;s:4:\"6595\";i:254;s:4:\"6596\";i:255;s:4:\"6598\";i:256;s:4:\"6599\";i:257;s:4:\"6600\";i:258;s:4:\"6601\";i:259;s:4:\"6602\";i:260;s:4:\"6603\";i:261;s:4:\"6604\";i:262;s:4:\"6606\";i:263;s:4:\"6607\";i:264;s:4:\"6608\";i:265;s:4:\"6609\";i:266;s:4:\"6610\";i:267;s:4:\"6611\";i:268;s:4:\"6612\";i:269;s:4:\"6613\";i:270;s:4:\"6614\";i:271;s:4:\"6615\";i:272;s:4:\"6616\";i:273;s:4:\"6617\";i:274;s:4:\"6618\";i:275;s:4:\"6619\";i:276;s:4:\"6620\";i:277;s:4:\"6621\";i:278;s:4:\"6622\";i:279;s:4:\"6623\";i:280;s:4:\"6624\";i:281;s:4:\"6625\";i:282;s:4:\"6626\";i:283;s:4:\"6627\";i:284;s:4:\"6628\";i:285;s:4:\"6629\";i:286;s:4:\"6630\";i:287;s:4:\"6631\";i:288;s:4:\"6632\";i:289;s:4:\"6633\";i:290;s:4:\"6634\";i:291;s:4:\"6635\";i:292;s:4:\"6636\";i:293;s:4:\"6637\";i:294;s:4:\"6638\";i:295;s:4:\"6639\";i:296;s:4:\"6640\";i:297;s:4:\"6641\";i:298;s:4:\"6642\";i:299;s:4:\"6643\";i:300;s:4:\"6644\";i:301;s:4:\"6645\";i:302;s:4:\"6646\";i:303;s:4:\"6647\";i:304;s:4:\"6648\";i:305;s:4:\"6649\";i:306;s:4:\"6650\";i:307;s:4:\"6651\";i:308;s:4:\"6652\";i:309;s:4:\"6653\";i:310;s:4:\"6654\";i:311;s:4:\"6655\";i:312;s:4:\"6656\";i:313;s:4:\"6657\";i:314;s:4:\"6658\";i:315;s:4:\"6659\";i:316;s:4:\"6660\";i:317;s:4:\"6661\";i:318;s:4:\"6662\";i:319;s:4:\"6663\";i:320;s:4:\"6664\";i:321;s:4:\"6665\";i:322;s:4:\"6666\";i:323;s:4:\"6668\";i:324;s:4:\"6669\";i:325;s:4:\"6670\";i:326;s:4:\"6671\";i:327;s:4:\"6672\";i:328;s:4:\"6673\";i:329;s:4:\"6674\";i:330;s:4:\"6675\";i:331;s:4:\"6676\";i:332;s:4:\"6677\";i:333;s:4:\"6678\";i:334;s:4:\"6679\";i:335;s:4:\"6680\";i:336;s:4:\"6681\";i:337;s:4:\"6682\";i:338;s:4:\"6683\";i:339;s:4:\"6684\";i:340;s:4:\"6685\";i:341;s:4:\"6686\";i:342;s:4:\"6687\";i:343;s:4:\"6688\";i:344;s:4:\"6689\";i:345;s:4:\"6690\";i:346;s:4:\"6691\";i:347;s:4:\"6692\";i:348;s:4:\"6693\";i:349;s:4:\"6694\";i:350;s:4:\"6695\";i:351;s:4:\"6696\";i:352;s:4:\"6697\";i:353;s:4:\"6698\";i:354;s:4:\"6699\";i:355;s:4:\"6700\";i:356;s:4:\"6701\";i:357;s:4:\"6703\";i:358;s:4:\"6704\";i:359;s:4:\"6705\";i:360;s:4:\"6706\";i:361;s:4:\"6707\";i:362;s:4:\"6708\";i:363;s:4:\"6709\";i:364;s:4:\"6710\";i:365;s:4:\"6711\";i:366;s:4:\"6712\";i:367;s:4:\"6713\";i:368;s:4:\"6714\";i:369;s:4:\"6715\";i:370;s:4:\"6716\";i:371;s:4:\"6717\";i:372;s:4:\"6718\";i:373;s:4:\"6719\";i:374;s:4:\"6720\";i:375;s:4:\"6721\";i:376;s:4:\"6722\";i:377;s:4:\"6723\";i:378;s:4:\"6724\";i:379;s:4:\"6725\";i:380;s:4:\"6726\";i:381;s:4:\"6727\";i:382;s:4:\"6728\";i:383;s:4:\"6729\";i:384;s:4:\"6730\";i:385;s:4:\"6731\";i:386;s:4:\"6732\";i:387;s:4:\"6733\";i:388;s:4:\"6734\";i:389;s:4:\"6735\";i:390;s:4:\"6736\";i:391;s:4:\"6737\";i:392;s:4:\"6738\";i:393;s:4:\"6739\";i:394;s:4:\"6740\";i:395;s:4:\"6741\";i:396;s:4:\"6742\";i:397;s:4:\"6743\";i:398;s:4:\"6748\";i:399;s:4:\"6749\";i:400;s:4:\"6750\";i:401;s:4:\"6751\";i:402;s:4:\"6752\";i:403;s:4:\"6753\";i:404;s:4:\"6754\";i:405;s:4:\"6755\";i:406;s:4:\"6756\";i:407;s:4:\"6757\";i:408;s:4:\"6758\";i:409;s:4:\"6759\";i:410;s:4:\"6760\";i:411;s:4:\"6761\";i:412;s:4:\"6762\";i:413;s:4:\"6763\";i:414;s:4:\"6764\";i:415;s:4:\"6765\";i:416;s:4:\"6766\";i:417;s:4:\"6767\";i:418;s:4:\"6768\";i:419;s:4:\"6769\";i:420;s:4:\"6770\";i:421;s:4:\"6771\";i:422;s:4:\"6772\";i:423;s:4:\"6773\";i:424;s:4:\"6774\";i:425;s:4:\"6775\";i:426;s:4:\"6776\";i:427;s:4:\"6777\";i:428;s:4:\"6778\";i:429;s:4:\"6779\";i:430;s:4:\"6780\";i:431;s:4:\"6781\";i:432;s:4:\"6782\";i:433;s:4:\"6783\";i:434;s:4:\"6784\";i:435;s:4:\"6785\";i:436;s:4:\"6786\";i:437;s:4:\"6787\";i:438;s:4:\"6788\";i:439;s:4:\"6789\";i:440;s:4:\"6790\";i:441;s:4:\"6791\";i:442;s:4:\"6792\";i:443;s:4:\"6793\";i:444;s:4:\"6794\";i:445;s:4:\"6795\";i:446;s:4:\"6796\";i:447;s:4:\"6797\";i:448;s:4:\"6798\";i:449;s:4:\"6799\";i:450;s:4:\"6800\";i:451;s:4:\"6801\";i:452;s:4:\"6802\";i:453;s:4:\"6803\";i:454;s:4:\"6804\";i:455;s:4:\"6805\";i:456;s:4:\"6806\";i:457;s:4:\"6807\";i:458;s:4:\"6808\";i:459;s:4:\"6809\";i:460;s:4:\"6810\";i:461;s:4:\"6811\";i:462;s:4:\"6812\";i:463;s:4:\"6813\";i:464;s:4:\"6814\";i:465;s:4:\"6815\";i:466;s:4:\"6816\";i:467;s:4:\"6817\";i:468;s:4:\"6818\";i:469;s:4:\"6819\";i:470;s:4:\"6820\";i:471;s:4:\"6821\";i:472;s:4:\"6822\";i:473;s:4:\"6823\";i:474;s:4:\"6824\";i:475;s:4:\"6825\";i:476;s:4:\"6826\";i:477;s:4:\"6827\";i:478;s:4:\"6828\";i:479;s:4:\"6829\";i:480;s:4:\"6830\";i:481;s:4:\"6831\";i:482;s:4:\"6832\";i:483;s:4:\"6833\";i:484;s:4:\"6834\";i:485;s:4:\"6835\";i:486;s:4:\"6836\";i:487;s:4:\"6837\";i:488;s:4:\"6838\";i:489;s:4:\"6839\";i:490;s:4:\"6840\";i:491;s:4:\"6841\";i:492;s:4:\"6842\";i:493;s:4:\"6843\";i:494;s:4:\"6844\";i:495;s:4:\"6845\";i:496;s:4:\"6846\";i:497;s:4:\"6847\";i:498;s:4:\"6848\";i:499;s:4:\"6849\";i:500;s:4:\"6850\";i:501;s:4:\"6851\";i:502;s:4:\"6852\";i:503;s:4:\"6853\";i:504;s:4:\"6854\";i:505;s:4:\"6855\";i:506;s:4:\"6856\";i:507;s:4:\"6857\";i:508;s:4:\"6858\";i:509;s:4:\"6859\";i:510;s:4:\"6860\";i:511;s:4:\"6861\";i:512;s:4:\"6862\";i:513;s:4:\"6863\";i:514;s:4:\"6864\";i:515;s:4:\"6865\";i:516;s:4:\"6866\";i:517;s:4:\"6867\";i:518;s:4:\"6868\";i:519;s:4:\"6869\";i:520;s:4:\"6870\";i:521;s:4:\"6871\";i:522;s:4:\"6872\";i:523;s:4:\"6873\";i:524;s:4:\"6874\";i:525;s:4:\"6875\";i:526;s:4:\"6876\";i:527;s:4:\"6877\";i:528;s:4:\"6878\";i:529;s:4:\"6879\";i:530;s:4:\"6880\";i:531;s:4:\"6881\";i:532;s:4:\"6882\";i:533;s:4:\"6883\";i:534;s:4:\"6884\";i:535;s:4:\"6885\";i:536;s:4:\"6886\";i:537;s:4:\"6887\";i:538;s:4:\"6888\";i:539;s:4:\"6889\";i:540;s:4:\"6890\";i:541;s:4:\"6891\";i:542;s:4:\"6892\";i:543;s:4:\"6893\";i:544;s:4:\"6894\";i:545;s:4:\"6895\";i:546;s:4:\"6896\";i:547;s:4:\"6897\";i:548;s:4:\"6898\";i:549;s:4:\"6899\";i:550;s:4:\"6900\";i:551;s:4:\"6901\";i:552;s:4:\"6902\";i:553;s:4:\"6903\";i:554;s:4:\"6904\";i:555;s:4:\"6905\";i:556;s:4:\"6906\";i:557;s:4:\"6907\";i:558;s:4:\"6908\";i:559;s:4:\"6909\";i:560;s:4:\"6910\";i:561;s:4:\"6911\";i:562;s:4:\"6912\";i:563;s:4:\"6913\";i:564;s:4:\"6914\";i:565;s:4:\"6915\";i:566;s:4:\"6916\";i:567;s:4:\"6917\";i:568;s:4:\"6918\";i:569;s:4:\"6919\";i:570;s:4:\"6920\";i:571;s:4:\"6921\";i:572;s:4:\"6922\";i:573;s:4:\"6923\";i:574;s:4:\"6924\";i:575;s:4:\"6925\";i:576;s:4:\"6926\";i:577;s:4:\"6927\";i:578;s:4:\"6928\";i:579;s:4:\"6929\";i:580;s:4:\"6930\";i:581;s:4:\"6931\";i:582;s:4:\"6932\";i:583;s:4:\"6933\";i:584;s:4:\"6934\";i:585;s:4:\"6935\";i:586;s:4:\"6936\";i:587;s:4:\"6937\";i:588;s:4:\"6938\";i:589;s:4:\"6939\";i:590;s:4:\"6940\";i:591;s:4:\"6941\";i:592;s:4:\"6942\";i:593;s:4:\"6943\";i:594;s:4:\"6945\";i:595;s:4:\"6946\";i:596;s:4:\"6947\";i:597;s:4:\"6948\";i:598;s:4:\"6949\";i:599;s:4:\"6950\";i:600;s:4:\"6951\";i:601;s:4:\"6952\";i:602;s:4:\"6953\";i:603;s:4:\"6954\";i:604;s:4:\"6955\";i:605;s:4:\"6956\";i:606;s:4:\"6957\";i:607;s:4:\"6958\";i:608;s:4:\"6959\";i:609;s:4:\"6960\";i:610;s:4:\"6961\";i:611;s:4:\"6962\";i:612;s:4:\"6963\";i:613;s:4:\"6964\";i:614;s:4:\"6965\";i:615;s:4:\"6966\";i:616;s:4:\"6967\";i:617;s:4:\"6968\";i:618;s:4:\"6969\";i:619;s:4:\"6970\";i:620;s:4:\"6971\";i:621;s:4:\"6972\";i:622;s:4:\"6973\";i:623;s:4:\"6974\";i:624;s:4:\"6975\";i:625;s:4:\"6976\";i:626;s:4:\"6977\";i:627;s:4:\"6978\";i:628;s:4:\"6979\";i:629;s:4:\"6980\";i:630;s:4:\"6981\";i:631;s:4:\"6982\";i:632;s:4:\"6983\";i:633;s:4:\"6984\";i:634;s:4:\"6985\";i:635;s:4:\"6986\";i:636;s:4:\"6987\";i:637;s:4:\"6988\";i:638;s:4:\"6989\";i:639;s:4:\"6990\";i:640;s:4:\"6991\";i:641;s:4:\"6992\";i:642;s:4:\"6993\";i:643;s:4:\"6994\";i:644;s:4:\"6995\";i:645;s:4:\"6996\";i:646;s:4:\"6997\";i:647;s:4:\"6998\";i:648;s:4:\"6999\";i:649;s:4:\"7000\";i:650;s:4:\"7001\";i:651;s:4:\"7002\";i:652;s:4:\"7003\";i:653;s:4:\"7004\";i:654;s:4:\"7005\";i:655;s:4:\"7006\";i:656;s:4:\"7007\";i:657;s:4:\"7008\";i:658;s:4:\"7009\";i:659;s:4:\"7010\";i:660;s:4:\"7011\";i:661;s:4:\"7012\";i:662;s:4:\"7013\";i:663;s:4:\"7014\";i:664;s:4:\"7015\";i:665;s:4:\"7016\";i:666;s:4:\"7017\";i:667;s:4:\"7018\";i:668;s:4:\"7019\";i:669;s:4:\"7020\";i:670;s:4:\"7021\";i:671;s:4:\"7022\";i:672;s:4:\"7023\";i:673;s:4:\"7024\";i:674;s:4:\"7025\";i:675;s:4:\"7026\";i:676;s:4:\"7027\";i:677;s:4:\"7028\";i:678;s:4:\"7029\";i:679;s:4:\"7030\";i:680;s:4:\"7031\";i:681;s:4:\"7032\";i:682;s:4:\"7033\";i:683;s:4:\"7034\";i:684;s:4:\"7035\";i:685;s:4:\"7036\";i:686;s:4:\"7037\";i:687;s:4:\"7038\";i:688;s:4:\"7039\";i:689;s:4:\"7040\";i:690;s:4:\"7041\";i:691;s:4:\"7042\";i:692;s:4:\"7043\";i:693;s:4:\"7044\";i:694;s:4:\"7045\";i:695;s:4:\"7046\";i:696;s:4:\"7047\";i:697;s:4:\"7048\";i:698;s:4:\"7049\";i:699;s:4:\"7050\";i:700;s:4:\"7051\";i:701;s:4:\"7053\";i:702;s:4:\"7054\";i:703;s:4:\"7055\";i:704;s:4:\"7056\";i:705;s:4:\"7057\";i:706;s:4:\"7058\";i:707;s:4:\"7059\";i:708;s:4:\"7060\";i:709;s:4:\"7061\";i:710;s:4:\"7062\";i:711;s:4:\"7063\";i:712;s:4:\"7064\";i:713;s:4:\"7065\";i:714;s:4:\"7066\";i:715;s:4:\"7067\";i:716;s:4:\"7068\";i:717;s:4:\"7069\";i:718;s:4:\"7070\";i:719;s:4:\"7071\";i:720;s:4:\"7072\";i:721;s:4:\"7073\";i:722;s:4:\"7074\";i:723;s:4:\"7075\";i:724;s:4:\"7076\";i:725;s:4:\"7077\";i:726;s:4:\"7078\";i:727;s:4:\"7079\";i:728;s:4:\"7080\";i:729;s:4:\"7081\";i:730;s:4:\"7082\";i:731;s:4:\"7083\";i:732;s:4:\"7084\";i:733;s:4:\"7085\";i:734;s:4:\"7086\";i:735;s:4:\"7087\";i:736;s:4:\"7088\";i:737;s:4:\"7089\";i:738;s:4:\"7090\";i:739;s:4:\"7091\";i:740;s:4:\"7092\";i:741;s:4:\"7093\";i:742;s:4:\"7094\";i:743;s:4:\"7095\";i:744;s:4:\"7096\";i:745;s:4:\"7097\";i:746;s:4:\"7098\";i:747;s:4:\"7099\";i:748;s:4:\"7100\";i:749;s:4:\"7101\";i:750;s:4:\"7102\";i:751;s:4:\"7103\";i:752;s:4:\"7104\";i:753;s:4:\"7105\";i:754;s:4:\"7106\";i:755;s:4:\"7107\";i:756;s:4:\"7108\";i:757;s:4:\"7109\";i:758;s:4:\"7110\";i:759;s:4:\"7111\";i:760;s:4:\"7112\";i:761;s:4:\"7113\";i:762;s:4:\"7114\";i:763;s:4:\"7115\";i:764;s:4:\"7116\";i:765;s:4:\"7117\";i:766;s:4:\"7118\";i:767;s:4:\"7119\";i:768;s:4:\"7120\";i:769;s:4:\"7121\";i:770;s:4:\"7122\";i:771;s:4:\"7123\";i:772;s:4:\"7124\";i:773;s:4:\"7125\";i:774;s:4:\"7126\";i:775;s:4:\"7127\";i:776;s:4:\"7128\";i:777;s:4:\"7129\";i:778;s:4:\"7130\";i:779;s:4:\"7131\";i:780;s:4:\"7132\";i:781;s:4:\"7133\";i:782;s:4:\"7134\";i:783;s:4:\"7135\";i:784;s:4:\"7136\";i:785;s:4:\"7137\";i:786;s:4:\"7138\";i:787;s:4:\"7139\";i:788;s:4:\"7140\";i:789;s:4:\"7141\";i:790;s:4:\"7142\";i:791;s:4:\"7143\";i:792;s:4:\"7144\";i:793;s:4:\"7145\";i:794;s:4:\"7146\";i:795;s:4:\"7147\";i:796;s:4:\"7148\";i:797;s:4:\"7149\";i:798;s:4:\"7150\";i:799;s:4:\"7151\";i:800;s:4:\"7152\";i:801;s:4:\"7153\";i:802;s:4:\"7154\";i:803;s:4:\"7155\";i:804;s:4:\"7156\";i:805;s:4:\"7157\";i:806;s:4:\"7158\";i:807;s:4:\"7159\";i:808;s:4:\"7160\";i:809;s:4:\"7161\";i:810;s:4:\"7162\";i:811;s:4:\"7163\";i:812;s:4:\"7164\";i:813;s:4:\"7165\";i:814;s:4:\"7166\";i:815;s:4:\"7167\";i:816;s:4:\"7168\";i:817;s:4:\"7169\";i:818;s:4:\"7170\";i:819;s:4:\"7171\";i:820;s:4:\"7172\";i:821;s:4:\"7173\";i:822;s:4:\"7174\";i:823;s:4:\"7175\";i:824;s:4:\"7176\";i:825;s:4:\"7177\";i:826;s:4:\"7178\";i:827;s:4:\"7179\";i:828;s:4:\"7180\";i:829;s:4:\"7181\";i:830;s:4:\"7182\";i:831;s:4:\"7183\";i:832;s:4:\"7184\";i:833;s:4:\"7185\";i:834;s:4:\"7186\";i:835;s:4:\"7187\";i:836;s:4:\"7188\";i:837;s:4:\"7189\";i:838;s:4:\"7193\";i:839;s:4:\"7194\";i:840;s:4:\"7195\";i:841;s:4:\"7196\";i:842;s:4:\"7197\";i:843;s:4:\"7198\";i:844;s:4:\"7199\";i:845;s:4:\"7200\";i:846;s:4:\"7201\";i:847;s:4:\"7202\";i:848;s:4:\"7203\";i:849;s:4:\"7204\";i:850;s:4:\"7205\";i:851;s:4:\"7206\";i:852;s:4:\"7207\";i:853;s:4:\"7208\";i:854;s:4:\"7209\";i:855;s:4:\"7210\";i:856;s:4:\"7211\";i:857;s:4:\"7212\";i:858;s:4:\"7213\";i:859;s:4:\"7214\";i:860;s:4:\"7215\";i:861;s:4:\"7216\";i:862;s:4:\"7217\";i:863;s:4:\"7218\";i:864;s:4:\"7219\";i:865;s:4:\"7220\";i:866;s:4:\"7221\";i:867;s:4:\"7222\";i:868;s:4:\"7223\";i:869;s:4:\"7224\";i:870;s:4:\"7225\";i:871;s:4:\"7226\";i:872;s:4:\"7227\";i:873;s:4:\"7228\";i:874;s:4:\"7229\";i:875;s:4:\"7230\";i:876;s:4:\"7231\";i:877;s:4:\"7232\";i:878;s:4:\"7233\";i:879;s:4:\"7235\";i:880;s:4:\"7236\";i:881;s:4:\"7237\";i:882;s:4:\"7238\";i:883;s:4:\"7239\";i:884;s:4:\"7240\";i:885;s:4:\"7241\";i:886;s:4:\"7242\";i:887;s:4:\"7243\";i:888;s:4:\"7244\";i:889;s:4:\"7245\";i:890;s:4:\"7246\";i:891;s:4:\"7247\";i:892;s:4:\"7248\";i:893;s:4:\"7249\";i:894;s:4:\"7250\";i:895;s:4:\"7251\";i:896;s:4:\"7252\";i:897;s:4:\"7253\";i:898;s:4:\"7254\";i:899;s:4:\"7255\";i:900;s:4:\"7256\";i:901;s:4:\"7257\";i:902;s:4:\"7258\";i:903;s:4:\"7259\";i:904;s:4:\"7260\";i:905;s:4:\"7261\";i:906;s:4:\"7262\";i:907;s:4:\"7263\";i:908;s:4:\"7264\";i:909;s:4:\"7265\";i:910;s:4:\"7266\";i:911;s:4:\"7267\";i:912;s:4:\"7268\";i:913;s:4:\"7269\";i:914;s:4:\"7270\";i:915;s:4:\"7271\";i:916;s:4:\"7272\";i:917;s:4:\"7273\";i:918;s:4:\"7274\";i:919;s:4:\"7275\";i:920;s:4:\"7276\";i:921;s:4:\"7277\";i:922;s:4:\"7278\";i:923;s:4:\"7279\";i:924;s:4:\"7280\";i:925;s:4:\"7281\";i:926;s:4:\"7282\";i:927;s:4:\"7283\";i:928;s:4:\"7284\";i:929;s:4:\"7285\";i:930;s:4:\"7286\";i:931;s:4:\"7287\";i:932;s:4:\"7288\";i:933;s:4:\"7289\";i:934;s:4:\"7290\";i:935;s:4:\"7291\";i:936;s:4:\"7292\";i:937;s:4:\"7293\";i:938;s:4:\"7294\";i:939;s:4:\"7295\";i:940;s:4:\"7296\";i:941;s:4:\"7297\";i:942;s:4:\"7298\";i:943;s:4:\"7299\";i:944;s:4:\"7300\";i:945;s:4:\"7301\";i:946;s:4:\"7302\";i:947;s:4:\"7303\";i:948;s:4:\"7304\";i:949;s:4:\"7305\";i:950;s:4:\"7306\";i:951;s:4:\"7307\";i:952;s:4:\"7309\";i:953;s:4:\"7310\";i:954;s:4:\"7311\";i:955;s:4:\"7313\";i:956;s:4:\"7314\";i:957;s:4:\"7315\";i:958;s:4:\"7316\";i:959;s:4:\"7317\";i:960;s:4:\"7318\";i:961;s:4:\"7319\";i:962;s:4:\"7320\";i:963;s:4:\"7321\";i:964;s:4:\"7322\";i:965;s:4:\"7323\";i:966;s:4:\"7324\";i:967;s:4:\"7325\";i:968;s:4:\"7326\";i:969;s:4:\"7327\";i:970;s:4:\"7328\";i:971;s:4:\"7329\";i:972;s:4:\"7330\";i:973;s:4:\"7331\";i:974;s:4:\"7332\";i:975;s:4:\"7333\";i:976;s:4:\"7334\";i:977;s:4:\"7335\";i:978;s:4:\"7336\";i:979;s:4:\"7337\";i:980;s:4:\"7338\";i:981;s:4:\"7339\";i:982;s:4:\"7340\";i:983;s:4:\"7341\";i:984;s:4:\"7342\";i:985;s:4:\"7343\";i:986;s:4:\"7344\";i:987;s:4:\"7345\";i:988;s:4:\"7346\";i:989;s:4:\"7347\";i:990;s:4:\"7348\";i:991;s:4:\"7349\";i:992;s:4:\"7350\";i:993;s:4:\"7351\";i:994;s:4:\"7352\";i:995;s:4:\"7353\";i:996;s:4:\"7354\";i:997;s:4:\"7355\";i:998;s:4:\"7356\";i:999;s:4:\"7357\";i:1000;s:4:\"7358\";i:1001;s:4:\"7359\";i:1002;s:4:\"7360\";i:1003;s:4:\"7361\";i:1004;s:4:\"7362\";i:1005;s:4:\"7363\";i:1006;s:4:\"7364\";i:1007;s:4:\"7365\";i:1008;s:4:\"7366\";i:1009;s:4:\"7367\";i:1010;s:4:\"7369\";i:1011;s:4:\"7370\";i:1012;s:4:\"7371\";i:1013;s:4:\"7372\";i:1014;s:4:\"7373\";i:1015;s:4:\"7374\";i:1016;s:4:\"7375\";i:1017;s:4:\"7376\";i:1018;s:4:\"7377\";i:1019;s:4:\"7378\";i:1020;s:4:\"7379\";i:1021;s:4:\"7380\";i:1022;s:4:\"7381\";i:1023;s:4:\"7382\";i:1024;s:4:\"7383\";i:1025;s:4:\"7385\";i:1026;s:4:\"7386\";i:1027;s:4:\"7387\";i:1028;s:4:\"7388\";i:1029;s:4:\"7389\";i:1030;s:4:\"7390\";i:1031;s:4:\"7391\";i:1032;s:4:\"7392\";i:1033;s:4:\"7393\";i:1034;s:4:\"7394\";i:1035;s:4:\"7395\";i:1036;s:4:\"7396\";i:1037;s:4:\"7397\";i:1038;s:4:\"7398\";i:1039;s:4:\"7399\";i:1040;s:4:\"7400\";i:1041;s:4:\"7401\";i:1042;s:4:\"7402\";i:1043;s:4:\"7403\";i:1044;s:4:\"7404\";i:1045;s:4:\"7405\";i:1046;s:4:\"7406\";i:1047;s:4:\"7407\";i:1048;s:4:\"7408\";i:1049;s:4:\"7409\";i:1050;s:4:\"7410\";i:1051;s:4:\"7411\";i:1052;s:4:\"7412\";i:1053;s:4:\"7413\";i:1054;s:4:\"7414\";i:1055;s:4:\"7415\";i:1056;s:4:\"7416\";i:1057;s:4:\"7417\";i:1058;s:4:\"7418\";i:1059;s:4:\"7419\";i:1060;s:4:\"7420\";i:1061;s:4:\"7421\";i:1062;s:4:\"7422\";i:1063;s:4:\"7423\";i:1064;s:4:\"7424\";i:1065;s:4:\"7425\";i:1066;s:4:\"7426\";i:1067;s:4:\"7427\";i:1068;s:4:\"7428\";i:1069;s:4:\"7429\";i:1070;s:4:\"7430\";i:1071;s:4:\"7431\";i:1072;s:4:\"7432\";i:1073;s:4:\"7433\";i:1074;s:4:\"7434\";i:1075;s:4:\"7435\";i:1076;s:4:\"7437\";i:1077;s:4:\"7438\";i:1078;s:4:\"7439\";i:1079;s:4:\"7440\";i:1080;s:4:\"7441\";i:1081;s:4:\"7442\";i:1082;s:4:\"7443\";i:1083;s:4:\"7444\";i:1084;s:4:\"7445\";i:1085;s:4:\"7447\";i:1086;s:4:\"7448\";i:1087;s:4:\"7449\";i:1088;s:4:\"7450\";i:1089;s:4:\"7451\";i:1090;s:4:\"7452\";i:1091;s:4:\"7453\";i:1092;s:4:\"7454\";i:1093;s:4:\"7456\";i:1094;s:4:\"7457\";i:1095;s:4:\"7458\";i:1096;s:4:\"7459\";i:1097;s:4:\"7460\";i:1098;s:4:\"7461\";i:1099;s:4:\"7462\";i:1100;s:4:\"7464\";i:1101;s:4:\"7465\";i:1102;s:4:\"7466\";i:1103;s:4:\"7467\";i:1104;s:4:\"7468\";i:1105;s:4:\"7469\";i:1106;s:4:\"7470\";i:1107;s:4:\"7471\";i:1108;s:4:\"7472\";i:1109;s:4:\"7473\";i:1110;s:4:\"7474\";i:1111;s:4:\"7475\";i:1112;s:4:\"7476\";i:1113;s:4:\"7477\";i:1114;s:4:\"7478\";i:1115;s:4:\"7479\";i:1116;s:4:\"7480\";i:1117;s:4:\"7481\";i:1118;s:4:\"7482\";i:1119;s:4:\"7483\";i:1120;s:4:\"7484\";i:1121;s:4:\"7485\";i:1122;s:4:\"7486\";i:1123;s:4:\"7487\";i:1124;s:4:\"7488\";i:1125;s:4:\"7489\";i:1126;s:4:\"7490\";i:1127;s:4:\"7491\";i:1128;s:4:\"7492\";i:1129;s:4:\"7493\";i:1130;s:4:\"7494\";i:1131;s:4:\"7495\";i:1132;s:4:\"7496\";i:1133;s:4:\"7497\";i:1134;s:4:\"7498\";i:1135;s:4:\"7499\";i:1136;s:4:\"7500\";i:1137;s:4:\"7501\";i:1138;s:4:\"7502\";i:1139;s:4:\"7503\";i:1140;s:4:\"7504\";i:1141;s:4:\"7505\";i:1142;s:4:\"7506\";i:1143;s:4:\"7507\";i:1144;s:4:\"7508\";i:1145;s:4:\"7509\";i:1146;s:4:\"7510\";i:1147;s:4:\"7511\";i:1148;s:4:\"7512\";i:1149;s:4:\"7513\";i:1150;s:4:\"7514\";i:1151;s:4:\"7515\";i:1152;s:4:\"7516\";i:1153;s:4:\"7517\";i:1154;s:4:\"7518\";i:1155;s:4:\"7519\";i:1156;s:4:\"7520\";i:1157;s:4:\"7521\";i:1158;s:4:\"7522\";i:1159;s:4:\"7523\";i:1160;s:4:\"7524\";i:1161;s:4:\"7526\";i:1162;s:4:\"7527\";i:1163;s:4:\"7528\";i:1164;s:4:\"7529\";i:1165;s:4:\"7530\";i:1166;s:4:\"7531\";i:1167;s:4:\"7532\";i:1168;s:4:\"7533\";i:1169;s:4:\"7534\";i:1170;s:4:\"7535\";i:1171;s:4:\"7536\";i:1172;s:4:\"7537\";i:1173;s:4:\"7538\";i:1174;s:4:\"7539\";i:1175;s:4:\"7540\";i:1176;s:4:\"7541\";i:1177;s:4:\"7542\";i:1178;s:4:\"7543\";i:1179;s:4:\"7544\";i:1180;s:4:\"7545\";i:1181;s:4:\"7546\";i:1182;s:4:\"7547\";i:1183;s:4:\"7548\";i:1184;s:4:\"7549\";i:1185;s:4:\"7550\";i:1186;s:4:\"7551\";i:1187;s:4:\"7552\";i:1188;s:4:\"7553\";i:1189;s:4:\"7554\";i:1190;s:4:\"7555\";i:1191;s:4:\"7556\";i:1192;s:4:\"7557\";i:1193;s:4:\"7558\";i:1194;s:4:\"7559\";i:1195;s:4:\"7561\";i:1196;s:4:\"7562\";i:1197;s:4:\"7563\";i:1198;s:4:\"7564\";i:1199;s:4:\"7565\";i:1200;s:4:\"7566\";i:1201;s:4:\"7567\";i:1202;s:4:\"7568\";i:1203;s:4:\"7569\";i:1204;s:4:\"7570\";i:1205;s:4:\"7571\";i:1206;s:4:\"7572\";i:1207;s:4:\"7573\";i:1208;s:4:\"7574\";i:1209;s:4:\"7575\";i:1210;s:4:\"7576\";i:1211;s:4:\"7577\";i:1212;s:4:\"7578\";i:1213;s:4:\"7579\";i:1214;s:4:\"7580\";i:1215;s:4:\"7581\";i:1216;s:4:\"7582\";i:1217;s:4:\"7583\";i:1218;s:4:\"7584\";i:1219;s:4:\"7585\";i:1220;s:4:\"7586\";i:1221;s:4:\"7587\";i:1222;s:4:\"7588\";i:1223;s:4:\"7589\";i:1224;s:4:\"7590\";i:1225;s:4:\"7591\";i:1226;s:4:\"7592\";i:1227;s:4:\"7593\";i:1228;s:4:\"7594\";i:1229;s:4:\"7595\";i:1230;s:4:\"7596\";i:1231;s:4:\"7597\";i:1232;s:4:\"7598\";i:1233;s:4:\"7599\";i:1234;s:4:\"7600\";i:1235;s:4:\"7601\";i:1236;s:4:\"7606\";i:1237;s:4:\"7607\";i:1238;s:4:\"7608\";i:1239;s:4:\"7609\";i:1240;s:4:\"7610\";i:1241;s:4:\"7611\";i:1242;s:4:\"7612\";i:1243;s:4:\"7613\";i:1244;s:4:\"7614\";i:1245;s:4:\"7615\";i:1246;s:4:\"7616\";i:1247;s:4:\"7617\";i:1248;s:4:\"7618\";i:1249;s:4:\"7619\";i:1250;s:4:\"7620\";i:1251;s:4:\"7621\";i:1252;s:4:\"7622\";i:1253;s:4:\"7623\";i:1254;s:4:\"7624\";i:1255;s:4:\"7625\";i:1256;s:4:\"7626\";i:1257;s:4:\"7627\";i:1258;s:4:\"7628\";i:1259;s:4:\"7629\";i:1260;s:4:\"7630\";i:1261;s:4:\"7631\";i:1262;s:4:\"7632\";i:1263;s:4:\"7633\";i:1264;s:4:\"7634\";i:1265;s:4:\"7635\";i:1266;s:4:\"7636\";i:1267;s:4:\"7637\";i:1268;s:4:\"7638\";i:1269;s:4:\"7639\";i:1270;s:4:\"7640\";i:1271;s:4:\"7641\";i:1272;s:4:\"7642\";i:1273;s:4:\"7643\";i:1274;s:4:\"7644\";i:1275;s:4:\"7645\";i:1276;s:4:\"7646\";i:1277;s:4:\"7647\";i:1278;s:4:\"7648\";i:1279;s:4:\"7649\";i:1280;s:4:\"7650\";i:1281;s:4:\"7651\";i:1282;s:4:\"7652\";i:1283;s:4:\"7653\";i:1284;s:4:\"7654\";i:1285;s:4:\"7655\";i:1286;s:4:\"7656\";i:1287;s:4:\"7657\";i:1288;s:4:\"7658\";i:1289;s:4:\"7659\";i:1290;s:4:\"7660\";i:1291;s:4:\"7661\";i:1292;s:4:\"7662\";i:1293;s:4:\"7663\";i:1294;s:4:\"7664\";i:1295;s:4:\"7665\";i:1296;s:4:\"7666\";i:1297;s:4:\"7667\";i:1298;s:4:\"7668\";i:1299;s:4:\"7669\";i:1300;s:4:\"7670\";i:1301;s:4:\"7671\";i:1302;s:4:\"7672\";i:1303;s:4:\"7673\";i:1304;s:4:\"7674\";i:1305;s:4:\"7675\";i:1306;s:4:\"7676\";i:1307;s:4:\"7677\";i:1308;s:4:\"7678\";i:1309;s:4:\"7679\";i:1310;s:4:\"7680\";i:1311;s:4:\"7681\";i:1312;s:4:\"7682\";i:1313;s:4:\"7683\";i:1314;s:4:\"7684\";i:1315;s:4:\"7685\";i:1316;s:4:\"7686\";i:1317;s:4:\"7687\";i:1318;s:4:\"7688\";i:1319;s:4:\"7689\";i:1320;s:4:\"7690\";i:1321;s:4:\"7691\";i:1322;s:4:\"7692\";i:1323;s:4:\"7693\";i:1324;s:4:\"7694\";i:1325;s:4:\"7695\";i:1326;s:4:\"7696\";i:1327;s:4:\"7697\";i:1328;s:4:\"7698\";i:1329;s:4:\"7699\";i:1330;s:4:\"7700\";i:1331;s:4:\"7701\";i:1332;s:4:\"7702\";i:1333;s:4:\"7703\";i:1334;s:4:\"7704\";i:1335;s:4:\"7705\";i:1336;s:4:\"7706\";i:1337;s:4:\"7707\";i:1338;s:4:\"7708\";i:1339;s:4:\"7709\";i:1340;s:4:\"7710\";i:1341;s:4:\"7711\";i:1342;s:4:\"7712\";i:1343;s:4:\"7713\";i:1344;s:4:\"7714\";i:1345;s:4:\"7715\";i:1346;s:4:\"7716\";i:1347;s:4:\"7717\";i:1348;s:4:\"7718\";i:1349;s:4:\"7719\";i:1350;s:4:\"7720\";i:1351;s:4:\"7721\";i:1352;s:4:\"7722\";i:1353;s:4:\"7723\";i:1354;s:4:\"7724\";i:1355;s:4:\"7725\";i:1356;s:4:\"7726\";i:1357;s:4:\"7727\";i:1358;s:4:\"7728\";i:1359;s:4:\"7729\";i:1360;s:4:\"7730\";i:1361;s:4:\"7731\";i:1362;s:4:\"7732\";i:1363;s:4:\"7733\";i:1364;s:4:\"7734\";i:1365;s:4:\"7735\";i:1366;s:4:\"7736\";i:1367;s:4:\"7737\";i:1368;s:4:\"7738\";i:1369;s:4:\"7739\";i:1370;s:4:\"7740\";i:1371;s:4:\"7741\";i:1372;s:4:\"7742\";i:1373;s:4:\"7743\";i:1374;s:4:\"7744\";i:1375;s:4:\"7745\";i:1376;s:4:\"7746\";i:1377;s:4:\"7747\";i:1378;s:4:\"7748\";i:1379;s:4:\"7749\";i:1380;s:4:\"7750\";i:1381;s:4:\"7751\";i:1382;s:4:\"7752\";i:1383;s:4:\"7753\";i:1384;s:4:\"7754\";i:1385;s:4:\"7755\";i:1386;s:4:\"7756\";i:1387;s:4:\"7757\";i:1388;s:4:\"7758\";i:1389;s:4:\"7759\";i:1390;s:4:\"7760\";i:1391;s:4:\"7761\";i:1392;s:4:\"7762\";i:1393;s:4:\"7763\";i:1394;s:4:\"7764\";i:1395;s:4:\"7765\";i:1396;s:4:\"7766\";i:1397;s:4:\"7767\";i:1398;s:4:\"7768\";i:1399;s:4:\"7769\";i:1400;s:4:\"7770\";i:1401;s:4:\"7771\";i:1402;s:4:\"7772\";i:1403;s:4:\"7773\";i:1404;s:4:\"7774\";i:1405;s:4:\"7775\";i:1406;s:4:\"7776\";i:1407;s:4:\"7777\";i:1408;s:4:\"7778\";i:1409;s:4:\"7779\";i:1410;s:4:\"7780\";i:1411;s:4:\"7781\";i:1412;s:4:\"7782\";i:1413;s:4:\"7783\";i:1414;s:4:\"7784\";i:1415;s:4:\"7785\";i:1416;s:4:\"7786\";i:1417;s:4:\"7787\";i:1418;s:4:\"7788\";i:1419;s:4:\"7789\";i:1420;s:4:\"7790\";i:1421;s:4:\"7791\";i:1422;s:4:\"7792\";i:1423;s:4:\"7793\";i:1424;s:4:\"7794\";i:1425;s:4:\"7795\";i:1426;s:4:\"7796\";i:1427;s:4:\"7797\";i:1428;s:4:\"7798\";i:1429;s:4:\"7799\";i:1430;s:4:\"7800\";i:1431;s:4:\"7801\";i:1432;s:4:\"7803\";i:1433;s:4:\"7804\";i:1434;s:4:\"7805\";i:1435;s:4:\"7806\";i:1436;s:4:\"7807\";i:1437;s:4:\"7808\";i:1438;s:4:\"7809\";i:1439;s:4:\"7810\";i:1440;s:4:\"7811\";i:1441;s:4:\"7812\";i:1442;s:4:\"7813\";i:1443;s:4:\"7814\";i:1444;s:4:\"7815\";i:1445;s:4:\"7816\";i:1446;s:4:\"7817\";i:1447;s:4:\"7818\";i:1448;s:4:\"7819\";i:1449;s:4:\"7820\";i:1450;s:4:\"7821\";i:1451;s:4:\"7822\";i:1452;s:4:\"7823\";i:1453;s:4:\"7824\";i:1454;s:4:\"7825\";i:1455;s:4:\"7826\";i:1456;s:4:\"7827\";i:1457;s:4:\"7828\";i:1458;s:4:\"7829\";i:1459;s:4:\"7830\";i:1460;s:4:\"7831\";i:1461;s:4:\"7832\";i:1462;s:4:\"7833\";i:1463;s:4:\"7834\";i:1464;s:4:\"7835\";i:1465;s:4:\"7836\";i:1466;s:4:\"7837\";i:1467;s:4:\"7838\";i:1468;s:4:\"7839\";i:1469;s:4:\"7840\";i:1470;s:4:\"7841\";i:1471;s:4:\"7842\";i:1472;s:4:\"7843\";i:1473;s:4:\"7844\";i:1474;s:4:\"7845\";i:1475;s:4:\"7846\";i:1476;s:4:\"7847\";i:1477;s:4:\"7848\";i:1478;s:4:\"7849\";i:1479;s:4:\"7850\";i:1480;s:4:\"7851\";i:1481;s:4:\"7852\";i:1482;s:4:\"7853\";i:1483;s:4:\"7854\";i:1484;s:4:\"7855\";i:1485;s:4:\"7856\";i:1486;s:4:\"7857\";i:1487;s:4:\"7858\";i:1488;s:4:\"7859\";i:1489;s:4:\"7860\";i:1490;s:4:\"7861\";i:1491;s:4:\"7862\";i:1492;s:4:\"7863\";i:1493;s:4:\"7864\";i:1494;s:4:\"7865\";i:1495;s:4:\"7866\";i:1496;s:4:\"7867\";i:1497;s:4:\"7868\";i:1498;s:4:\"7869\";i:1499;s:4:\"7870\";i:1500;s:4:\"7871\";i:1501;s:4:\"7872\";i:1502;s:4:\"7873\";i:1503;s:4:\"7874\";i:1504;s:4:\"7875\";i:1505;s:4:\"7876\";i:1506;s:4:\"7877\";i:1507;s:4:\"7878\";i:1508;s:4:\"7879\";i:1509;s:4:\"7880\";i:1510;s:4:\"7881\";i:1511;s:4:\"7882\";i:1512;s:4:\"7883\";i:1513;s:4:\"7884\";i:1514;s:4:\"7885\";i:1515;s:4:\"7886\";i:1516;s:4:\"7887\";i:1517;s:4:\"7888\";i:1518;s:4:\"7889\";i:1519;s:4:\"7890\";i:1520;s:4:\"7891\";i:1521;s:4:\"7892\";i:1522;s:4:\"7893\";i:1523;s:4:\"7894\";i:1524;s:4:\"7895\";i:1525;s:4:\"7896\";i:1526;s:4:\"7897\";i:1527;s:4:\"7898\";i:1528;s:4:\"7899\";i:1529;s:4:\"7900\";i:1530;s:4:\"7901\";i:1531;s:4:\"7902\";i:1532;s:4:\"7903\";i:1533;s:4:\"7904\";i:1534;s:4:\"7905\";i:1535;s:4:\"7906\";i:1536;s:4:\"7907\";i:1537;s:4:\"7908\";i:1538;s:4:\"7909\";i:1539;s:4:\"7911\";i:1540;s:4:\"7912\";i:1541;s:4:\"7913\";i:1542;s:4:\"7914\";i:1543;s:4:\"7915\";i:1544;s:4:\"7916\";i:1545;s:4:\"7917\";i:1546;s:4:\"7918\";i:1547;s:4:\"7919\";i:1548;s:4:\"7920\";i:1549;s:4:\"7921\";i:1550;s:4:\"7922\";i:1551;s:4:\"7923\";i:1552;s:4:\"7924\";i:1553;s:4:\"7925\";i:1554;s:4:\"7926\";i:1555;s:4:\"7927\";i:1556;s:4:\"7928\";i:1557;s:4:\"7929\";i:1558;s:4:\"7930\";i:1559;s:4:\"7931\";i:1560;s:4:\"7932\";i:1561;s:4:\"7933\";i:1562;s:4:\"7934\";i:1563;s:4:\"7935\";i:1564;s:4:\"7936\";i:1565;s:4:\"7937\";i:1566;s:4:\"7938\";i:1567;s:4:\"7939\";i:1568;s:4:\"7940\";i:1569;s:4:\"7941\";i:1570;s:4:\"7942\";i:1571;s:4:\"7943\";i:1572;s:4:\"7944\";i:1573;s:4:\"7945\";i:1574;s:4:\"7946\";i:1575;s:4:\"7947\";i:1576;s:4:\"7948\";i:1577;s:4:\"7949\";i:1578;s:4:\"7950\";i:1579;s:4:\"7951\";i:1580;s:4:\"7952\";i:1581;s:4:\"7953\";i:1582;s:4:\"7954\";i:1583;s:4:\"7955\";i:1584;s:4:\"7956\";i:1585;s:4:\"7957\";i:1586;s:4:\"7958\";i:1587;s:4:\"7959\";i:1588;s:4:\"7960\";i:1589;s:4:\"7961\";i:1590;s:4:\"7962\";i:1591;s:4:\"7963\";i:1592;s:4:\"7964\";i:1593;s:4:\"7965\";i:1594;s:4:\"7966\";i:1595;s:4:\"7967\";i:1596;s:4:\"7968\";i:1597;s:4:\"7969\";i:1598;s:4:\"7970\";i:1599;s:4:\"7971\";i:1600;s:4:\"7972\";i:1601;s:4:\"7973\";i:1602;s:4:\"7974\";i:1603;s:4:\"7975\";i:1604;s:4:\"7976\";i:1605;s:4:\"7977\";i:1606;s:4:\"7978\";i:1607;s:4:\"7979\";i:1608;s:4:\"7980\";i:1609;s:4:\"7981\";i:1610;s:4:\"7982\";i:1611;s:4:\"7983\";i:1612;s:4:\"7984\";i:1613;s:4:\"7985\";i:1614;s:4:\"7986\";i:1615;s:4:\"7987\";i:1616;s:4:\"7988\";i:1617;s:4:\"7989\";i:1618;s:4:\"7990\";i:1619;s:4:\"7991\";i:1620;s:4:\"7992\";i:1621;s:4:\"7993\";i:1622;s:4:\"7994\";i:1623;s:4:\"7995\";i:1624;s:4:\"7996\";i:1625;s:4:\"7997\";i:1626;s:4:\"7998\";i:1627;s:4:\"7999\";i:1628;s:4:\"8000\";i:1629;s:4:\"8001\";i:1630;s:4:\"8002\";i:1631;s:4:\"8003\";i:1632;s:4:\"8004\";i:1633;s:4:\"8005\";i:1634;s:4:\"8006\";i:1635;s:4:\"8007\";i:1636;s:4:\"8008\";i:1637;s:4:\"8009\";i:1638;s:4:\"8010\";i:1639;s:4:\"8011\";i:1640;s:4:\"8013\";i:1641;s:4:\"8014\";i:1642;s:4:\"8015\";i:1643;s:4:\"8016\";i:1644;s:4:\"8017\";i:1645;s:4:\"8018\";i:1646;s:4:\"8019\";i:1647;s:4:\"8020\";i:1648;s:4:\"8021\";i:1649;s:4:\"8022\";i:1650;s:4:\"8023\";i:1651;s:4:\"8024\";i:1652;s:4:\"8025\";i:1653;s:4:\"8026\";i:1654;s:4:\"8027\";i:1655;s:4:\"8028\";i:1656;s:4:\"8029\";i:1657;s:4:\"8030\";i:1658;s:4:\"8031\";i:1659;s:4:\"8032\";i:1660;s:4:\"8033\";i:1661;s:4:\"8034\";i:1662;s:4:\"8035\";i:1663;s:4:\"8036\";i:1664;s:4:\"8037\";i:1665;s:4:\"8038\";i:1666;s:4:\"8039\";i:1667;s:4:\"8040\";i:1668;s:4:\"8042\";i:1669;s:4:\"8043\";i:1670;s:4:\"8044\";i:1671;s:4:\"9757\";}i:3;a:34:{i:0;s:4:\"6376\";i:1;s:4:\"6450\";i:2;s:4:\"6454\";i:3;s:4:\"6510\";i:4;s:4:\"6526\";i:5;s:4:\"6578\";i:6;s:4:\"6588\";i:7;s:4:\"6597\";i:8;s:4:\"6605\";i:9;s:4:\"6667\";i:10;s:4:\"6702\";i:11;s:4:\"6744\";i:12;s:4:\"6745\";i:13;s:4:\"6746\";i:14;s:4:\"6747\";i:15;s:4:\"6944\";i:16;s:4:\"7052\";i:17;s:4:\"7234\";i:18;s:4:\"7308\";i:19;s:4:\"7312\";i:20;s:4:\"7368\";i:21;s:4:\"7384\";i:22;s:4:\"7436\";i:23;s:4:\"7446\";i:24;s:4:\"7455\";i:25;s:4:\"7463\";i:26;s:4:\"7525\";i:27;s:4:\"7560\";i:28;s:4:\"7602\";i:29;s:4:\"7603\";i:30;s:4:\"7604\";i:31;s:4:\"7605\";i:32;s:4:\"7802\";i:33;s:4:\"7910\";}i:2;a:2:{i:0;s:4:\"7190\";i:1;s:4:\"8012\";}i:6;a:2:{i:0;s:4:\"7191\";i:1;s:4:\"8051\";}i:5;a:3:{i:0;s:4:\"7192\";i:1;s:4:\"8041\";i:2;s:4:\"8050\";}i:4;a:4:{i:0;s:4:\"8045\";i:1;s:4:\"8046\";i:2;s:4:\"8047\";i:3;s:4:\"8049\";}i:0;a:1:{i:0;s:4:\"8048\";}}');
INSERT INTO `x2_knows` VALUES (2, '测试2知识点', 1, '', 1, 0, 'a:5:{i:6;i:3;i:1;i:1664;i:3;i:34;i:2;i:2;i:5;i:1;}', 'a:5:{i:6;a:3:{i:0;s:4:\"8052\";i:1;s:4:\"8910\";i:2;s:4:\"9755\";}i:1;a:1664:{i:0;s:4:\"8053\";i:1;s:4:\"8054\";i:2;s:4:\"8055\";i:3;s:4:\"8056\";i:4;s:4:\"8057\";i:5;s:4:\"8058\";i:6;s:4:\"8059\";i:7;s:4:\"8060\";i:8;s:4:\"8061\";i:9;s:4:\"8062\";i:10;s:4:\"8063\";i:11;s:4:\"8064\";i:12;s:4:\"8065\";i:13;s:4:\"8066\";i:14;s:4:\"8067\";i:15;s:4:\"8068\";i:16;s:4:\"8069\";i:17;s:4:\"8070\";i:18;s:4:\"8071\";i:19;s:4:\"8072\";i:20;s:4:\"8073\";i:21;s:4:\"8074\";i:22;s:4:\"8075\";i:23;s:4:\"8076\";i:24;s:4:\"8077\";i:25;s:4:\"8078\";i:26;s:4:\"8079\";i:27;s:4:\"8080\";i:28;s:4:\"8081\";i:29;s:4:\"8082\";i:30;s:4:\"8083\";i:31;s:4:\"8084\";i:32;s:4:\"8085\";i:33;s:4:\"8086\";i:34;s:4:\"8087\";i:35;s:4:\"8088\";i:36;s:4:\"8089\";i:37;s:4:\"8090\";i:38;s:4:\"8091\";i:39;s:4:\"8092\";i:40;s:4:\"8093\";i:41;s:4:\"8094\";i:42;s:4:\"8096\";i:43;s:4:\"8097\";i:44;s:4:\"8098\";i:45;s:4:\"8099\";i:46;s:4:\"8100\";i:47;s:4:\"8101\";i:48;s:4:\"8102\";i:49;s:4:\"8103\";i:50;s:4:\"8104\";i:51;s:4:\"8105\";i:52;s:4:\"8106\";i:53;s:4:\"8107\";i:54;s:4:\"8108\";i:55;s:4:\"8109\";i:56;s:4:\"8110\";i:57;s:4:\"8111\";i:58;s:4:\"8112\";i:59;s:4:\"8113\";i:60;s:4:\"8114\";i:61;s:4:\"8115\";i:62;s:4:\"8116\";i:63;s:4:\"8117\";i:64;s:4:\"8118\";i:65;s:4:\"8119\";i:66;s:4:\"8120\";i:67;s:4:\"8121\";i:68;s:4:\"8122\";i:69;s:4:\"8123\";i:70;s:4:\"8124\";i:71;s:4:\"8125\";i:72;s:4:\"8126\";i:73;s:4:\"8127\";i:74;s:4:\"8128\";i:75;s:4:\"8129\";i:76;s:4:\"8130\";i:77;s:4:\"8131\";i:78;s:4:\"8132\";i:79;s:4:\"8133\";i:80;s:4:\"8134\";i:81;s:4:\"8135\";i:82;s:4:\"8136\";i:83;s:4:\"8137\";i:84;s:4:\"8138\";i:85;s:4:\"8139\";i:86;s:4:\"8140\";i:87;s:4:\"8141\";i:88;s:4:\"8142\";i:89;s:4:\"8143\";i:90;s:4:\"8144\";i:91;s:4:\"8145\";i:92;s:4:\"8146\";i:93;s:4:\"8147\";i:94;s:4:\"8148\";i:95;s:4:\"8149\";i:96;s:4:\"8150\";i:97;s:4:\"8151\";i:98;s:4:\"8152\";i:99;s:4:\"8153\";i:100;s:4:\"8154\";i:101;s:4:\"8155\";i:102;s:4:\"8156\";i:103;s:4:\"8157\";i:104;s:4:\"8158\";i:105;s:4:\"8159\";i:106;s:4:\"8160\";i:107;s:4:\"8161\";i:108;s:4:\"8162\";i:109;s:4:\"8163\";i:110;s:4:\"8164\";i:111;s:4:\"8165\";i:112;s:4:\"8166\";i:113;s:4:\"8167\";i:114;s:4:\"8168\";i:115;s:4:\"8170\";i:116;s:4:\"8171\";i:117;s:4:\"8172\";i:118;s:4:\"8174\";i:119;s:4:\"8175\";i:120;s:4:\"8176\";i:121;s:4:\"8177\";i:122;s:4:\"8178\";i:123;s:4:\"8179\";i:124;s:4:\"8180\";i:125;s:4:\"8181\";i:126;s:4:\"8182\";i:127;s:4:\"8183\";i:128;s:4:\"8184\";i:129;s:4:\"8185\";i:130;s:4:\"8186\";i:131;s:4:\"8187\";i:132;s:4:\"8188\";i:133;s:4:\"8189\";i:134;s:4:\"8190\";i:135;s:4:\"8191\";i:136;s:4:\"8192\";i:137;s:4:\"8193\";i:138;s:4:\"8194\";i:139;s:4:\"8195\";i:140;s:4:\"8196\";i:141;s:4:\"8197\";i:142;s:4:\"8198\";i:143;s:4:\"8199\";i:144;s:4:\"8200\";i:145;s:4:\"8201\";i:146;s:4:\"8202\";i:147;s:4:\"8203\";i:148;s:4:\"8204\";i:149;s:4:\"8205\";i:150;s:4:\"8206\";i:151;s:4:\"8207\";i:152;s:4:\"8208\";i:153;s:4:\"8209\";i:154;s:4:\"8210\";i:155;s:4:\"8211\";i:156;s:4:\"8212\";i:157;s:4:\"8213\";i:158;s:4:\"8214\";i:159;s:4:\"8215\";i:160;s:4:\"8216\";i:161;s:4:\"8217\";i:162;s:4:\"8218\";i:163;s:4:\"8219\";i:164;s:4:\"8220\";i:165;s:4:\"8221\";i:166;s:4:\"8222\";i:167;s:4:\"8223\";i:168;s:4:\"8224\";i:169;s:4:\"8225\";i:170;s:4:\"8226\";i:171;s:4:\"8227\";i:172;s:4:\"8228\";i:173;s:4:\"8230\";i:174;s:4:\"8231\";i:175;s:4:\"8232\";i:176;s:4:\"8233\";i:177;s:4:\"8234\";i:178;s:4:\"8235\";i:179;s:4:\"8236\";i:180;s:4:\"8237\";i:181;s:4:\"8238\";i:182;s:4:\"8239\";i:183;s:4:\"8240\";i:184;s:4:\"8241\";i:185;s:4:\"8242\";i:186;s:4:\"8243\";i:187;s:4:\"8244\";i:188;s:4:\"8246\";i:189;s:4:\"8247\";i:190;s:4:\"8248\";i:191;s:4:\"8249\";i:192;s:4:\"8250\";i:193;s:4:\"8251\";i:194;s:4:\"8252\";i:195;s:4:\"8253\";i:196;s:4:\"8254\";i:197;s:4:\"8255\";i:198;s:4:\"8256\";i:199;s:4:\"8257\";i:200;s:4:\"8258\";i:201;s:4:\"8259\";i:202;s:4:\"8260\";i:203;s:4:\"8261\";i:204;s:4:\"8262\";i:205;s:4:\"8263\";i:206;s:4:\"8264\";i:207;s:4:\"8265\";i:208;s:4:\"8266\";i:209;s:4:\"8267\";i:210;s:4:\"8268\";i:211;s:4:\"8269\";i:212;s:4:\"8270\";i:213;s:4:\"8271\";i:214;s:4:\"8272\";i:215;s:4:\"8273\";i:216;s:4:\"8274\";i:217;s:4:\"8275\";i:218;s:4:\"8276\";i:219;s:4:\"8277\";i:220;s:4:\"8278\";i:221;s:4:\"8279\";i:222;s:4:\"8280\";i:223;s:4:\"8281\";i:224;s:4:\"8282\";i:225;s:4:\"8283\";i:226;s:4:\"8284\";i:227;s:4:\"8285\";i:228;s:4:\"8286\";i:229;s:4:\"8287\";i:230;s:4:\"8288\";i:231;s:4:\"8289\";i:232;s:4:\"8290\";i:233;s:4:\"8291\";i:234;s:4:\"8292\";i:235;s:4:\"8293\";i:236;s:4:\"8294\";i:237;s:4:\"8295\";i:238;s:4:\"8296\";i:239;s:4:\"8298\";i:240;s:4:\"8299\";i:241;s:4:\"8300\";i:242;s:4:\"8301\";i:243;s:4:\"8302\";i:244;s:4:\"8303\";i:245;s:4:\"8304\";i:246;s:4:\"8305\";i:247;s:4:\"8306\";i:248;s:4:\"8308\";i:249;s:4:\"8309\";i:250;s:4:\"8310\";i:251;s:4:\"8311\";i:252;s:4:\"8312\";i:253;s:4:\"8313\";i:254;s:4:\"8314\";i:255;s:4:\"8315\";i:256;s:4:\"8317\";i:257;s:4:\"8318\";i:258;s:4:\"8319\";i:259;s:4:\"8320\";i:260;s:4:\"8321\";i:261;s:4:\"8322\";i:262;s:4:\"8323\";i:263;s:4:\"8325\";i:264;s:4:\"8326\";i:265;s:4:\"8327\";i:266;s:4:\"8328\";i:267;s:4:\"8329\";i:268;s:4:\"8330\";i:269;s:4:\"8331\";i:270;s:4:\"8332\";i:271;s:4:\"8333\";i:272;s:4:\"8334\";i:273;s:4:\"8335\";i:274;s:4:\"8336\";i:275;s:4:\"8337\";i:276;s:4:\"8338\";i:277;s:4:\"8339\";i:278;s:4:\"8340\";i:279;s:4:\"8341\";i:280;s:4:\"8342\";i:281;s:4:\"8343\";i:282;s:4:\"8344\";i:283;s:4:\"8345\";i:284;s:4:\"8346\";i:285;s:4:\"8347\";i:286;s:4:\"8348\";i:287;s:4:\"8349\";i:288;s:4:\"8350\";i:289;s:4:\"8351\";i:290;s:4:\"8352\";i:291;s:4:\"8353\";i:292;s:4:\"8354\";i:293;s:4:\"8355\";i:294;s:4:\"8356\";i:295;s:4:\"8357\";i:296;s:4:\"8358\";i:297;s:4:\"8359\";i:298;s:4:\"8360\";i:299;s:4:\"8361\";i:300;s:4:\"8362\";i:301;s:4:\"8363\";i:302;s:4:\"8364\";i:303;s:4:\"8365\";i:304;s:4:\"8366\";i:305;s:4:\"8367\";i:306;s:4:\"8368\";i:307;s:4:\"8369\";i:308;s:4:\"8370\";i:309;s:4:\"8371\";i:310;s:4:\"8372\";i:311;s:4:\"8373\";i:312;s:4:\"8374\";i:313;s:4:\"8375\";i:314;s:4:\"8376\";i:315;s:4:\"8377\";i:316;s:4:\"8378\";i:317;s:4:\"8379\";i:318;s:4:\"8380\";i:319;s:4:\"8381\";i:320;s:4:\"8382\";i:321;s:4:\"8383\";i:322;s:4:\"8384\";i:323;s:4:\"8385\";i:324;s:4:\"8387\";i:325;s:4:\"8388\";i:326;s:4:\"8389\";i:327;s:4:\"8390\";i:328;s:4:\"8391\";i:329;s:4:\"8392\";i:330;s:4:\"8393\";i:331;s:4:\"8394\";i:332;s:4:\"8395\";i:333;s:4:\"8396\";i:334;s:4:\"8397\";i:335;s:4:\"8398\";i:336;s:4:\"8399\";i:337;s:4:\"8400\";i:338;s:4:\"8401\";i:339;s:4:\"8402\";i:340;s:4:\"8403\";i:341;s:4:\"8404\";i:342;s:4:\"8405\";i:343;s:4:\"8406\";i:344;s:4:\"8407\";i:345;s:4:\"8408\";i:346;s:4:\"8409\";i:347;s:4:\"8410\";i:348;s:4:\"8411\";i:349;s:4:\"8412\";i:350;s:4:\"8413\";i:351;s:4:\"8414\";i:352;s:4:\"8415\";i:353;s:4:\"8416\";i:354;s:4:\"8417\";i:355;s:4:\"8418\";i:356;s:4:\"8419\";i:357;s:4:\"8420\";i:358;s:4:\"8422\";i:359;s:4:\"8423\";i:360;s:4:\"8424\";i:361;s:4:\"8425\";i:362;s:4:\"8426\";i:363;s:4:\"8427\";i:364;s:4:\"8428\";i:365;s:4:\"8429\";i:366;s:4:\"8430\";i:367;s:4:\"8431\";i:368;s:4:\"8432\";i:369;s:4:\"8433\";i:370;s:4:\"8434\";i:371;s:4:\"8435\";i:372;s:4:\"8436\";i:373;s:4:\"8437\";i:374;s:4:\"8438\";i:375;s:4:\"8439\";i:376;s:4:\"8440\";i:377;s:4:\"8441\";i:378;s:4:\"8442\";i:379;s:4:\"8443\";i:380;s:4:\"8444\";i:381;s:4:\"8445\";i:382;s:4:\"8446\";i:383;s:4:\"8447\";i:384;s:4:\"8448\";i:385;s:4:\"8449\";i:386;s:4:\"8450\";i:387;s:4:\"8451\";i:388;s:4:\"8452\";i:389;s:4:\"8453\";i:390;s:4:\"8454\";i:391;s:4:\"8455\";i:392;s:4:\"8456\";i:393;s:4:\"8457\";i:394;s:4:\"8458\";i:395;s:4:\"8459\";i:396;s:4:\"8460\";i:397;s:4:\"8461\";i:398;s:4:\"8462\";i:399;s:4:\"8467\";i:400;s:4:\"8468\";i:401;s:4:\"8469\";i:402;s:4:\"8470\";i:403;s:4:\"8471\";i:404;s:4:\"8472\";i:405;s:4:\"8473\";i:406;s:4:\"8474\";i:407;s:4:\"8475\";i:408;s:4:\"8476\";i:409;s:4:\"8477\";i:410;s:4:\"8478\";i:411;s:4:\"8479\";i:412;s:4:\"8480\";i:413;s:4:\"8481\";i:414;s:4:\"8482\";i:415;s:4:\"8483\";i:416;s:4:\"8484\";i:417;s:4:\"8485\";i:418;s:4:\"8486\";i:419;s:4:\"8487\";i:420;s:4:\"8488\";i:421;s:4:\"8489\";i:422;s:4:\"8490\";i:423;s:4:\"8491\";i:424;s:4:\"8492\";i:425;s:4:\"8493\";i:426;s:4:\"8494\";i:427;s:4:\"8495\";i:428;s:4:\"8496\";i:429;s:4:\"8497\";i:430;s:4:\"8498\";i:431;s:4:\"8499\";i:432;s:4:\"8500\";i:433;s:4:\"8501\";i:434;s:4:\"8502\";i:435;s:4:\"8503\";i:436;s:4:\"8504\";i:437;s:4:\"8505\";i:438;s:4:\"8506\";i:439;s:4:\"8507\";i:440;s:4:\"8508\";i:441;s:4:\"8509\";i:442;s:4:\"8510\";i:443;s:4:\"8511\";i:444;s:4:\"8512\";i:445;s:4:\"8513\";i:446;s:4:\"8514\";i:447;s:4:\"8515\";i:448;s:4:\"8516\";i:449;s:4:\"8517\";i:450;s:4:\"8518\";i:451;s:4:\"8519\";i:452;s:4:\"8520\";i:453;s:4:\"8521\";i:454;s:4:\"8522\";i:455;s:4:\"8523\";i:456;s:4:\"8524\";i:457;s:4:\"8525\";i:458;s:4:\"8526\";i:459;s:4:\"8527\";i:460;s:4:\"8528\";i:461;s:4:\"8529\";i:462;s:4:\"8530\";i:463;s:4:\"8531\";i:464;s:4:\"8532\";i:465;s:4:\"8533\";i:466;s:4:\"8534\";i:467;s:4:\"8535\";i:468;s:4:\"8536\";i:469;s:4:\"8537\";i:470;s:4:\"8538\";i:471;s:4:\"8539\";i:472;s:4:\"8540\";i:473;s:4:\"8541\";i:474;s:4:\"8542\";i:475;s:4:\"8543\";i:476;s:4:\"8544\";i:477;s:4:\"8545\";i:478;s:4:\"8546\";i:479;s:4:\"8547\";i:480;s:4:\"8548\";i:481;s:4:\"8549\";i:482;s:4:\"8550\";i:483;s:4:\"8551\";i:484;s:4:\"8552\";i:485;s:4:\"8553\";i:486;s:4:\"8554\";i:487;s:4:\"8555\";i:488;s:4:\"8556\";i:489;s:4:\"8557\";i:490;s:4:\"8558\";i:491;s:4:\"8559\";i:492;s:4:\"8560\";i:493;s:4:\"8561\";i:494;s:4:\"8562\";i:495;s:4:\"8563\";i:496;s:4:\"8564\";i:497;s:4:\"8565\";i:498;s:4:\"8566\";i:499;s:4:\"8567\";i:500;s:4:\"8568\";i:501;s:4:\"8569\";i:502;s:4:\"8570\";i:503;s:4:\"8571\";i:504;s:4:\"8572\";i:505;s:4:\"8573\";i:506;s:4:\"8574\";i:507;s:4:\"8575\";i:508;s:4:\"8576\";i:509;s:4:\"8577\";i:510;s:4:\"8578\";i:511;s:4:\"8579\";i:512;s:4:\"8580\";i:513;s:4:\"8581\";i:514;s:4:\"8582\";i:515;s:4:\"8583\";i:516;s:4:\"8584\";i:517;s:4:\"8585\";i:518;s:4:\"8586\";i:519;s:4:\"8587\";i:520;s:4:\"8588\";i:521;s:4:\"8589\";i:522;s:4:\"8590\";i:523;s:4:\"8591\";i:524;s:4:\"8592\";i:525;s:4:\"8593\";i:526;s:4:\"8594\";i:527;s:4:\"8595\";i:528;s:4:\"8596\";i:529;s:4:\"8597\";i:530;s:4:\"8598\";i:531;s:4:\"8599\";i:532;s:4:\"8600\";i:533;s:4:\"8601\";i:534;s:4:\"8602\";i:535;s:4:\"8603\";i:536;s:4:\"8604\";i:537;s:4:\"8605\";i:538;s:4:\"8606\";i:539;s:4:\"8607\";i:540;s:4:\"8608\";i:541;s:4:\"8609\";i:542;s:4:\"8610\";i:543;s:4:\"8611\";i:544;s:4:\"8612\";i:545;s:4:\"8613\";i:546;s:4:\"8614\";i:547;s:4:\"8615\";i:548;s:4:\"8616\";i:549;s:4:\"8617\";i:550;s:4:\"8618\";i:551;s:4:\"8619\";i:552;s:4:\"8620\";i:553;s:4:\"8621\";i:554;s:4:\"8622\";i:555;s:4:\"8623\";i:556;s:4:\"8624\";i:557;s:4:\"8625\";i:558;s:4:\"8626\";i:559;s:4:\"8627\";i:560;s:4:\"8628\";i:561;s:4:\"8629\";i:562;s:4:\"8630\";i:563;s:4:\"8631\";i:564;s:4:\"8632\";i:565;s:4:\"8633\";i:566;s:4:\"8634\";i:567;s:4:\"8635\";i:568;s:4:\"8636\";i:569;s:4:\"8637\";i:570;s:4:\"8638\";i:571;s:4:\"8639\";i:572;s:4:\"8640\";i:573;s:4:\"8641\";i:574;s:4:\"8642\";i:575;s:4:\"8643\";i:576;s:4:\"8644\";i:577;s:4:\"8645\";i:578;s:4:\"8646\";i:579;s:4:\"8647\";i:580;s:4:\"8648\";i:581;s:4:\"8649\";i:582;s:4:\"8650\";i:583;s:4:\"8651\";i:584;s:4:\"8652\";i:585;s:4:\"8653\";i:586;s:4:\"8654\";i:587;s:4:\"8655\";i:588;s:4:\"8656\";i:589;s:4:\"8657\";i:590;s:4:\"8658\";i:591;s:4:\"8659\";i:592;s:4:\"8660\";i:593;s:4:\"8661\";i:594;s:4:\"8662\";i:595;s:4:\"8664\";i:596;s:4:\"8665\";i:597;s:4:\"8666\";i:598;s:4:\"8667\";i:599;s:4:\"8668\";i:600;s:4:\"8669\";i:601;s:4:\"8670\";i:602;s:4:\"8671\";i:603;s:4:\"8672\";i:604;s:4:\"8673\";i:605;s:4:\"8674\";i:606;s:4:\"8675\";i:607;s:4:\"8676\";i:608;s:4:\"8677\";i:609;s:4:\"8678\";i:610;s:4:\"8679\";i:611;s:4:\"8680\";i:612;s:4:\"8681\";i:613;s:4:\"8682\";i:614;s:4:\"8683\";i:615;s:4:\"8684\";i:616;s:4:\"8685\";i:617;s:4:\"8686\";i:618;s:4:\"8687\";i:619;s:4:\"8688\";i:620;s:4:\"8689\";i:621;s:4:\"8690\";i:622;s:4:\"8691\";i:623;s:4:\"8692\";i:624;s:4:\"8693\";i:625;s:4:\"8694\";i:626;s:4:\"8695\";i:627;s:4:\"8696\";i:628;s:4:\"8697\";i:629;s:4:\"8698\";i:630;s:4:\"8699\";i:631;s:4:\"8700\";i:632;s:4:\"8701\";i:633;s:4:\"8702\";i:634;s:4:\"8703\";i:635;s:4:\"8704\";i:636;s:4:\"8705\";i:637;s:4:\"8706\";i:638;s:4:\"8707\";i:639;s:4:\"8708\";i:640;s:4:\"8709\";i:641;s:4:\"8710\";i:642;s:4:\"8711\";i:643;s:4:\"8712\";i:644;s:4:\"8713\";i:645;s:4:\"8714\";i:646;s:4:\"8715\";i:647;s:4:\"8716\";i:648;s:4:\"8717\";i:649;s:4:\"8718\";i:650;s:4:\"8719\";i:651;s:4:\"8720\";i:652;s:4:\"8721\";i:653;s:4:\"8722\";i:654;s:4:\"8723\";i:655;s:4:\"8724\";i:656;s:4:\"8725\";i:657;s:4:\"8726\";i:658;s:4:\"8727\";i:659;s:4:\"8728\";i:660;s:4:\"8729\";i:661;s:4:\"8730\";i:662;s:4:\"8731\";i:663;s:4:\"8732\";i:664;s:4:\"8733\";i:665;s:4:\"8734\";i:666;s:4:\"8735\";i:667;s:4:\"8736\";i:668;s:4:\"8737\";i:669;s:4:\"8738\";i:670;s:4:\"8739\";i:671;s:4:\"8740\";i:672;s:4:\"8741\";i:673;s:4:\"8742\";i:674;s:4:\"8743\";i:675;s:4:\"8744\";i:676;s:4:\"8745\";i:677;s:4:\"8746\";i:678;s:4:\"8747\";i:679;s:4:\"8748\";i:680;s:4:\"8749\";i:681;s:4:\"8750\";i:682;s:4:\"8751\";i:683;s:4:\"8752\";i:684;s:4:\"8753\";i:685;s:4:\"8754\";i:686;s:4:\"8755\";i:687;s:4:\"8756\";i:688;s:4:\"8757\";i:689;s:4:\"8758\";i:690;s:4:\"8759\";i:691;s:4:\"8760\";i:692;s:4:\"8761\";i:693;s:4:\"8762\";i:694;s:4:\"8763\";i:695;s:4:\"8764\";i:696;s:4:\"8765\";i:697;s:4:\"8766\";i:698;s:4:\"8767\";i:699;s:4:\"8768\";i:700;s:4:\"8769\";i:701;s:4:\"8770\";i:702;s:4:\"8772\";i:703;s:4:\"8773\";i:704;s:4:\"8774\";i:705;s:4:\"8775\";i:706;s:4:\"8776\";i:707;s:4:\"8777\";i:708;s:4:\"8778\";i:709;s:4:\"8779\";i:710;s:4:\"8780\";i:711;s:4:\"8781\";i:712;s:4:\"8782\";i:713;s:4:\"8783\";i:714;s:4:\"8784\";i:715;s:4:\"8785\";i:716;s:4:\"8786\";i:717;s:4:\"8787\";i:718;s:4:\"8788\";i:719;s:4:\"8789\";i:720;s:4:\"8790\";i:721;s:4:\"8791\";i:722;s:4:\"8792\";i:723;s:4:\"8793\";i:724;s:4:\"8794\";i:725;s:4:\"8795\";i:726;s:4:\"8796\";i:727;s:4:\"8797\";i:728;s:4:\"8798\";i:729;s:4:\"8799\";i:730;s:4:\"8800\";i:731;s:4:\"8801\";i:732;s:4:\"8802\";i:733;s:4:\"8803\";i:734;s:4:\"8804\";i:735;s:4:\"8805\";i:736;s:4:\"8806\";i:737;s:4:\"8807\";i:738;s:4:\"8808\";i:739;s:4:\"8809\";i:740;s:4:\"8810\";i:741;s:4:\"8811\";i:742;s:4:\"8812\";i:743;s:4:\"8813\";i:744;s:4:\"8814\";i:745;s:4:\"8815\";i:746;s:4:\"8816\";i:747;s:4:\"8817\";i:748;s:4:\"8818\";i:749;s:4:\"8819\";i:750;s:4:\"8820\";i:751;s:4:\"8821\";i:752;s:4:\"8822\";i:753;s:4:\"8823\";i:754;s:4:\"8824\";i:755;s:4:\"8825\";i:756;s:4:\"8826\";i:757;s:4:\"8827\";i:758;s:4:\"8828\";i:759;s:4:\"8829\";i:760;s:4:\"8830\";i:761;s:4:\"8831\";i:762;s:4:\"8832\";i:763;s:4:\"8833\";i:764;s:4:\"8834\";i:765;s:4:\"8835\";i:766;s:4:\"8836\";i:767;s:4:\"8837\";i:768;s:4:\"8838\";i:769;s:4:\"8839\";i:770;s:4:\"8840\";i:771;s:4:\"8841\";i:772;s:4:\"8842\";i:773;s:4:\"8843\";i:774;s:4:\"8844\";i:775;s:4:\"8845\";i:776;s:4:\"8846\";i:777;s:4:\"8847\";i:778;s:4:\"8848\";i:779;s:4:\"8849\";i:780;s:4:\"8850\";i:781;s:4:\"8851\";i:782;s:4:\"8852\";i:783;s:4:\"8853\";i:784;s:4:\"8854\";i:785;s:4:\"8855\";i:786;s:4:\"8856\";i:787;s:4:\"8857\";i:788;s:4:\"8858\";i:789;s:4:\"8859\";i:790;s:4:\"8860\";i:791;s:4:\"8861\";i:792;s:4:\"8862\";i:793;s:4:\"8863\";i:794;s:4:\"8864\";i:795;s:4:\"8865\";i:796;s:4:\"8866\";i:797;s:4:\"8867\";i:798;s:4:\"8868\";i:799;s:4:\"8869\";i:800;s:4:\"8870\";i:801;s:4:\"8871\";i:802;s:4:\"8872\";i:803;s:4:\"8873\";i:804;s:4:\"8874\";i:805;s:4:\"8875\";i:806;s:4:\"8876\";i:807;s:4:\"8877\";i:808;s:4:\"8878\";i:809;s:4:\"8879\";i:810;s:4:\"8880\";i:811;s:4:\"8881\";i:812;s:4:\"8882\";i:813;s:4:\"8883\";i:814;s:4:\"8884\";i:815;s:4:\"8885\";i:816;s:4:\"8886\";i:817;s:4:\"8887\";i:818;s:4:\"8888\";i:819;s:4:\"8889\";i:820;s:4:\"8890\";i:821;s:4:\"8891\";i:822;s:4:\"8892\";i:823;s:4:\"8893\";i:824;s:4:\"8894\";i:825;s:4:\"8895\";i:826;s:4:\"8896\";i:827;s:4:\"8897\";i:828;s:4:\"8898\";i:829;s:4:\"8899\";i:830;s:4:\"8900\";i:831;s:4:\"8901\";i:832;s:4:\"8902\";i:833;s:4:\"8903\";i:834;s:4:\"8904\";i:835;s:4:\"8905\";i:836;s:4:\"8906\";i:837;s:4:\"8907\";i:838;s:4:\"8908\";i:839;s:4:\"8912\";i:840;s:4:\"8913\";i:841;s:4:\"8914\";i:842;s:4:\"8915\";i:843;s:4:\"8916\";i:844;s:4:\"8917\";i:845;s:4:\"8918\";i:846;s:4:\"8919\";i:847;s:4:\"8920\";i:848;s:4:\"8921\";i:849;s:4:\"8922\";i:850;s:4:\"8923\";i:851;s:4:\"8924\";i:852;s:4:\"8925\";i:853;s:4:\"8926\";i:854;s:4:\"8927\";i:855;s:4:\"8928\";i:856;s:4:\"8929\";i:857;s:4:\"8930\";i:858;s:4:\"8931\";i:859;s:4:\"8932\";i:860;s:4:\"8933\";i:861;s:4:\"8934\";i:862;s:4:\"8935\";i:863;s:4:\"8936\";i:864;s:4:\"8937\";i:865;s:4:\"8938\";i:866;s:4:\"8939\";i:867;s:4:\"8940\";i:868;s:4:\"8941\";i:869;s:4:\"8942\";i:870;s:4:\"8943\";i:871;s:4:\"8944\";i:872;s:4:\"8945\";i:873;s:4:\"8946\";i:874;s:4:\"8947\";i:875;s:4:\"8948\";i:876;s:4:\"8949\";i:877;s:4:\"8950\";i:878;s:4:\"8951\";i:879;s:4:\"8952\";i:880;s:4:\"8954\";i:881;s:4:\"8955\";i:882;s:4:\"8956\";i:883;s:4:\"8957\";i:884;s:4:\"8958\";i:885;s:4:\"8959\";i:886;s:4:\"8960\";i:887;s:4:\"8961\";i:888;s:4:\"8962\";i:889;s:4:\"8963\";i:890;s:4:\"8964\";i:891;s:4:\"8965\";i:892;s:4:\"8966\";i:893;s:4:\"8967\";i:894;s:4:\"8968\";i:895;s:4:\"8969\";i:896;s:4:\"8970\";i:897;s:4:\"8971\";i:898;s:4:\"8972\";i:899;s:4:\"8973\";i:900;s:4:\"8974\";i:901;s:4:\"8975\";i:902;s:4:\"8976\";i:903;s:4:\"8977\";i:904;s:4:\"8978\";i:905;s:4:\"8979\";i:906;s:4:\"8980\";i:907;s:4:\"8981\";i:908;s:4:\"8982\";i:909;s:4:\"8983\";i:910;s:4:\"8984\";i:911;s:4:\"8985\";i:912;s:4:\"8986\";i:913;s:4:\"8987\";i:914;s:4:\"8988\";i:915;s:4:\"8989\";i:916;s:4:\"8990\";i:917;s:4:\"8991\";i:918;s:4:\"8992\";i:919;s:4:\"8993\";i:920;s:4:\"8994\";i:921;s:4:\"8995\";i:922;s:4:\"8996\";i:923;s:4:\"8997\";i:924;s:4:\"8998\";i:925;s:4:\"8999\";i:926;s:4:\"9000\";i:927;s:4:\"9001\";i:928;s:4:\"9002\";i:929;s:4:\"9003\";i:930;s:4:\"9004\";i:931;s:4:\"9005\";i:932;s:4:\"9006\";i:933;s:4:\"9007\";i:934;s:4:\"9008\";i:935;s:4:\"9009\";i:936;s:4:\"9010\";i:937;s:4:\"9011\";i:938;s:4:\"9012\";i:939;s:4:\"9013\";i:940;s:4:\"9014\";i:941;s:4:\"9015\";i:942;s:4:\"9016\";i:943;s:4:\"9017\";i:944;s:4:\"9018\";i:945;s:4:\"9019\";i:946;s:4:\"9020\";i:947;s:4:\"9021\";i:948;s:4:\"9022\";i:949;s:4:\"9023\";i:950;s:4:\"9024\";i:951;s:4:\"9025\";i:952;s:4:\"9026\";i:953;s:4:\"9028\";i:954;s:4:\"9029\";i:955;s:4:\"9030\";i:956;s:4:\"9032\";i:957;s:4:\"9033\";i:958;s:4:\"9034\";i:959;s:4:\"9035\";i:960;s:4:\"9036\";i:961;s:4:\"9037\";i:962;s:4:\"9038\";i:963;s:4:\"9039\";i:964;s:4:\"9040\";i:965;s:4:\"9041\";i:966;s:4:\"9042\";i:967;s:4:\"9043\";i:968;s:4:\"9044\";i:969;s:4:\"9045\";i:970;s:4:\"9046\";i:971;s:4:\"9047\";i:972;s:4:\"9048\";i:973;s:4:\"9049\";i:974;s:4:\"9050\";i:975;s:4:\"9051\";i:976;s:4:\"9052\";i:977;s:4:\"9053\";i:978;s:4:\"9054\";i:979;s:4:\"9055\";i:980;s:4:\"9056\";i:981;s:4:\"9057\";i:982;s:4:\"9058\";i:983;s:4:\"9059\";i:984;s:4:\"9060\";i:985;s:4:\"9061\";i:986;s:4:\"9062\";i:987;s:4:\"9063\";i:988;s:4:\"9064\";i:989;s:4:\"9065\";i:990;s:4:\"9066\";i:991;s:4:\"9067\";i:992;s:4:\"9068\";i:993;s:4:\"9069\";i:994;s:4:\"9070\";i:995;s:4:\"9071\";i:996;s:4:\"9072\";i:997;s:4:\"9073\";i:998;s:4:\"9074\";i:999;s:4:\"9075\";i:1000;s:4:\"9076\";i:1001;s:4:\"9077\";i:1002;s:4:\"9078\";i:1003;s:4:\"9079\";i:1004;s:4:\"9080\";i:1005;s:4:\"9081\";i:1006;s:4:\"9082\";i:1007;s:4:\"9083\";i:1008;s:4:\"9084\";i:1009;s:4:\"9085\";i:1010;s:4:\"9086\";i:1011;s:4:\"9088\";i:1012;s:4:\"9089\";i:1013;s:4:\"9090\";i:1014;s:4:\"9091\";i:1015;s:4:\"9092\";i:1016;s:4:\"9093\";i:1017;s:4:\"9094\";i:1018;s:4:\"9095\";i:1019;s:4:\"9096\";i:1020;s:4:\"9097\";i:1021;s:4:\"9098\";i:1022;s:4:\"9099\";i:1023;s:4:\"9100\";i:1024;s:4:\"9101\";i:1025;s:4:\"9102\";i:1026;s:4:\"9104\";i:1027;s:4:\"9105\";i:1028;s:4:\"9106\";i:1029;s:4:\"9107\";i:1030;s:4:\"9108\";i:1031;s:4:\"9109\";i:1032;s:4:\"9110\";i:1033;s:4:\"9111\";i:1034;s:4:\"9112\";i:1035;s:4:\"9113\";i:1036;s:4:\"9114\";i:1037;s:4:\"9115\";i:1038;s:4:\"9116\";i:1039;s:4:\"9117\";i:1040;s:4:\"9118\";i:1041;s:4:\"9119\";i:1042;s:4:\"9120\";i:1043;s:4:\"9121\";i:1044;s:4:\"9122\";i:1045;s:4:\"9123\";i:1046;s:4:\"9124\";i:1047;s:4:\"9125\";i:1048;s:4:\"9126\";i:1049;s:4:\"9127\";i:1050;s:4:\"9128\";i:1051;s:4:\"9129\";i:1052;s:4:\"9130\";i:1053;s:4:\"9131\";i:1054;s:4:\"9132\";i:1055;s:4:\"9133\";i:1056;s:4:\"9134\";i:1057;s:4:\"9135\";i:1058;s:4:\"9136\";i:1059;s:4:\"9137\";i:1060;s:4:\"9138\";i:1061;s:4:\"9139\";i:1062;s:4:\"9140\";i:1063;s:4:\"9141\";i:1064;s:4:\"9142\";i:1065;s:4:\"9143\";i:1066;s:4:\"9144\";i:1067;s:4:\"9145\";i:1068;s:4:\"9146\";i:1069;s:4:\"9147\";i:1070;s:4:\"9148\";i:1071;s:4:\"9149\";i:1072;s:4:\"9150\";i:1073;s:4:\"9151\";i:1074;s:4:\"9152\";i:1075;s:4:\"9153\";i:1076;s:4:\"9154\";i:1077;s:4:\"9156\";i:1078;s:4:\"9157\";i:1079;s:4:\"9158\";i:1080;s:4:\"9159\";i:1081;s:4:\"9160\";i:1082;s:4:\"9161\";i:1083;s:4:\"9162\";i:1084;s:4:\"9163\";i:1085;s:4:\"9164\";i:1086;s:4:\"9166\";i:1087;s:4:\"9167\";i:1088;s:4:\"9168\";i:1089;s:4:\"9169\";i:1090;s:4:\"9170\";i:1091;s:4:\"9171\";i:1092;s:4:\"9172\";i:1093;s:4:\"9173\";i:1094;s:4:\"9175\";i:1095;s:4:\"9176\";i:1096;s:4:\"9177\";i:1097;s:4:\"9178\";i:1098;s:4:\"9179\";i:1099;s:4:\"9180\";i:1100;s:4:\"9181\";i:1101;s:4:\"9183\";i:1102;s:4:\"9184\";i:1103;s:4:\"9185\";i:1104;s:4:\"9186\";i:1105;s:4:\"9187\";i:1106;s:4:\"9188\";i:1107;s:4:\"9189\";i:1108;s:4:\"9190\";i:1109;s:4:\"9191\";i:1110;s:4:\"9192\";i:1111;s:4:\"9193\";i:1112;s:4:\"9194\";i:1113;s:4:\"9195\";i:1114;s:4:\"9196\";i:1115;s:4:\"9197\";i:1116;s:4:\"9198\";i:1117;s:4:\"9199\";i:1118;s:4:\"9200\";i:1119;s:4:\"9201\";i:1120;s:4:\"9202\";i:1121;s:4:\"9203\";i:1122;s:4:\"9204\";i:1123;s:4:\"9205\";i:1124;s:4:\"9206\";i:1125;s:4:\"9207\";i:1126;s:4:\"9208\";i:1127;s:4:\"9209\";i:1128;s:4:\"9210\";i:1129;s:4:\"9211\";i:1130;s:4:\"9212\";i:1131;s:4:\"9213\";i:1132;s:4:\"9214\";i:1133;s:4:\"9215\";i:1134;s:4:\"9216\";i:1135;s:4:\"9217\";i:1136;s:4:\"9218\";i:1137;s:4:\"9219\";i:1138;s:4:\"9220\";i:1139;s:4:\"9221\";i:1140;s:4:\"9222\";i:1141;s:4:\"9223\";i:1142;s:4:\"9224\";i:1143;s:4:\"9225\";i:1144;s:4:\"9226\";i:1145;s:4:\"9227\";i:1146;s:4:\"9228\";i:1147;s:4:\"9229\";i:1148;s:4:\"9230\";i:1149;s:4:\"9231\";i:1150;s:4:\"9232\";i:1151;s:4:\"9233\";i:1152;s:4:\"9234\";i:1153;s:4:\"9235\";i:1154;s:4:\"9236\";i:1155;s:4:\"9237\";i:1156;s:4:\"9238\";i:1157;s:4:\"9239\";i:1158;s:4:\"9240\";i:1159;s:4:\"9241\";i:1160;s:4:\"9242\";i:1161;s:4:\"9243\";i:1162;s:4:\"9245\";i:1163;s:4:\"9246\";i:1164;s:4:\"9247\";i:1165;s:4:\"9248\";i:1166;s:4:\"9249\";i:1167;s:4:\"9250\";i:1168;s:4:\"9251\";i:1169;s:4:\"9252\";i:1170;s:4:\"9253\";i:1171;s:4:\"9254\";i:1172;s:4:\"9255\";i:1173;s:4:\"9256\";i:1174;s:4:\"9257\";i:1175;s:4:\"9258\";i:1176;s:4:\"9259\";i:1177;s:4:\"9260\";i:1178;s:4:\"9261\";i:1179;s:4:\"9262\";i:1180;s:4:\"9263\";i:1181;s:4:\"9264\";i:1182;s:4:\"9265\";i:1183;s:4:\"9266\";i:1184;s:4:\"9267\";i:1185;s:4:\"9268\";i:1186;s:4:\"9269\";i:1187;s:4:\"9270\";i:1188;s:4:\"9271\";i:1189;s:4:\"9272\";i:1190;s:4:\"9273\";i:1191;s:4:\"9274\";i:1192;s:4:\"9275\";i:1193;s:4:\"9276\";i:1194;s:4:\"9277\";i:1195;s:4:\"9278\";i:1196;s:4:\"9280\";i:1197;s:4:\"9281\";i:1198;s:4:\"9282\";i:1199;s:4:\"9283\";i:1200;s:4:\"9284\";i:1201;s:4:\"9285\";i:1202;s:4:\"9286\";i:1203;s:4:\"9287\";i:1204;s:4:\"9288\";i:1205;s:4:\"9289\";i:1206;s:4:\"9290\";i:1207;s:4:\"9291\";i:1208;s:4:\"9292\";i:1209;s:4:\"9293\";i:1210;s:4:\"9294\";i:1211;s:4:\"9295\";i:1212;s:4:\"9296\";i:1213;s:4:\"9297\";i:1214;s:4:\"9298\";i:1215;s:4:\"9299\";i:1216;s:4:\"9300\";i:1217;s:4:\"9301\";i:1218;s:4:\"9302\";i:1219;s:4:\"9303\";i:1220;s:4:\"9304\";i:1221;s:4:\"9305\";i:1222;s:4:\"9306\";i:1223;s:4:\"9307\";i:1224;s:4:\"9308\";i:1225;s:4:\"9309\";i:1226;s:4:\"9310\";i:1227;s:4:\"9311\";i:1228;s:4:\"9312\";i:1229;s:4:\"9313\";i:1230;s:4:\"9314\";i:1231;s:4:\"9315\";i:1232;s:4:\"9316\";i:1233;s:4:\"9317\";i:1234;s:4:\"9318\";i:1235;s:4:\"9319\";i:1236;s:4:\"9320\";i:1237;s:4:\"9325\";i:1238;s:4:\"9326\";i:1239;s:4:\"9327\";i:1240;s:4:\"9328\";i:1241;s:4:\"9329\";i:1242;s:4:\"9330\";i:1243;s:4:\"9331\";i:1244;s:4:\"9332\";i:1245;s:4:\"9333\";i:1246;s:4:\"9334\";i:1247;s:4:\"9335\";i:1248;s:4:\"9336\";i:1249;s:4:\"9337\";i:1250;s:4:\"9338\";i:1251;s:4:\"9339\";i:1252;s:4:\"9340\";i:1253;s:4:\"9341\";i:1254;s:4:\"9342\";i:1255;s:4:\"9343\";i:1256;s:4:\"9344\";i:1257;s:4:\"9345\";i:1258;s:4:\"9346\";i:1259;s:4:\"9347\";i:1260;s:4:\"9348\";i:1261;s:4:\"9349\";i:1262;s:4:\"9350\";i:1263;s:4:\"9351\";i:1264;s:4:\"9352\";i:1265;s:4:\"9353\";i:1266;s:4:\"9354\";i:1267;s:4:\"9355\";i:1268;s:4:\"9356\";i:1269;s:4:\"9357\";i:1270;s:4:\"9358\";i:1271;s:4:\"9359\";i:1272;s:4:\"9360\";i:1273;s:4:\"9361\";i:1274;s:4:\"9362\";i:1275;s:4:\"9363\";i:1276;s:4:\"9364\";i:1277;s:4:\"9365\";i:1278;s:4:\"9366\";i:1279;s:4:\"9367\";i:1280;s:4:\"9368\";i:1281;s:4:\"9369\";i:1282;s:4:\"9370\";i:1283;s:4:\"9371\";i:1284;s:4:\"9372\";i:1285;s:4:\"9373\";i:1286;s:4:\"9374\";i:1287;s:4:\"9375\";i:1288;s:4:\"9376\";i:1289;s:4:\"9377\";i:1290;s:4:\"9378\";i:1291;s:4:\"9379\";i:1292;s:4:\"9380\";i:1293;s:4:\"9381\";i:1294;s:4:\"9382\";i:1295;s:4:\"9383\";i:1296;s:4:\"9384\";i:1297;s:4:\"9385\";i:1298;s:4:\"9386\";i:1299;s:4:\"9387\";i:1300;s:4:\"9388\";i:1301;s:4:\"9389\";i:1302;s:4:\"9390\";i:1303;s:4:\"9391\";i:1304;s:4:\"9392\";i:1305;s:4:\"9393\";i:1306;s:4:\"9394\";i:1307;s:4:\"9395\";i:1308;s:4:\"9396\";i:1309;s:4:\"9397\";i:1310;s:4:\"9398\";i:1311;s:4:\"9399\";i:1312;s:4:\"9400\";i:1313;s:4:\"9401\";i:1314;s:4:\"9402\";i:1315;s:4:\"9403\";i:1316;s:4:\"9404\";i:1317;s:4:\"9405\";i:1318;s:4:\"9406\";i:1319;s:4:\"9407\";i:1320;s:4:\"9408\";i:1321;s:4:\"9409\";i:1322;s:4:\"9410\";i:1323;s:4:\"9411\";i:1324;s:4:\"9412\";i:1325;s:4:\"9413\";i:1326;s:4:\"9414\";i:1327;s:4:\"9415\";i:1328;s:4:\"9416\";i:1329;s:4:\"9417\";i:1330;s:4:\"9418\";i:1331;s:4:\"9419\";i:1332;s:4:\"9420\";i:1333;s:4:\"9421\";i:1334;s:4:\"9422\";i:1335;s:4:\"9423\";i:1336;s:4:\"9424\";i:1337;s:4:\"9425\";i:1338;s:4:\"9426\";i:1339;s:4:\"9427\";i:1340;s:4:\"9428\";i:1341;s:4:\"9429\";i:1342;s:4:\"9430\";i:1343;s:4:\"9431\";i:1344;s:4:\"9432\";i:1345;s:4:\"9433\";i:1346;s:4:\"9434\";i:1347;s:4:\"9435\";i:1348;s:4:\"9436\";i:1349;s:4:\"9437\";i:1350;s:4:\"9438\";i:1351;s:4:\"9439\";i:1352;s:4:\"9440\";i:1353;s:4:\"9441\";i:1354;s:4:\"9442\";i:1355;s:4:\"9443\";i:1356;s:4:\"9444\";i:1357;s:4:\"9445\";i:1358;s:4:\"9446\";i:1359;s:4:\"9447\";i:1360;s:4:\"9448\";i:1361;s:4:\"9449\";i:1362;s:4:\"9450\";i:1363;s:4:\"9451\";i:1364;s:4:\"9452\";i:1365;s:4:\"9453\";i:1366;s:4:\"9454\";i:1367;s:4:\"9455\";i:1368;s:4:\"9456\";i:1369;s:4:\"9457\";i:1370;s:4:\"9458\";i:1371;s:4:\"9459\";i:1372;s:4:\"9460\";i:1373;s:4:\"9461\";i:1374;s:4:\"9462\";i:1375;s:4:\"9463\";i:1376;s:4:\"9464\";i:1377;s:4:\"9465\";i:1378;s:4:\"9466\";i:1379;s:4:\"9467\";i:1380;s:4:\"9468\";i:1381;s:4:\"9469\";i:1382;s:4:\"9470\";i:1383;s:4:\"9471\";i:1384;s:4:\"9472\";i:1385;s:4:\"9473\";i:1386;s:4:\"9474\";i:1387;s:4:\"9475\";i:1388;s:4:\"9476\";i:1389;s:4:\"9477\";i:1390;s:4:\"9478\";i:1391;s:4:\"9479\";i:1392;s:4:\"9480\";i:1393;s:4:\"9481\";i:1394;s:4:\"9482\";i:1395;s:4:\"9483\";i:1396;s:4:\"9484\";i:1397;s:4:\"9485\";i:1398;s:4:\"9486\";i:1399;s:4:\"9487\";i:1400;s:4:\"9488\";i:1401;s:4:\"9489\";i:1402;s:4:\"9490\";i:1403;s:4:\"9491\";i:1404;s:4:\"9492\";i:1405;s:4:\"9493\";i:1406;s:4:\"9494\";i:1407;s:4:\"9495\";i:1408;s:4:\"9496\";i:1409;s:4:\"9497\";i:1410;s:4:\"9498\";i:1411;s:4:\"9499\";i:1412;s:4:\"9500\";i:1413;s:4:\"9501\";i:1414;s:4:\"9502\";i:1415;s:4:\"9503\";i:1416;s:4:\"9504\";i:1417;s:4:\"9505\";i:1418;s:4:\"9506\";i:1419;s:4:\"9507\";i:1420;s:4:\"9508\";i:1421;s:4:\"9509\";i:1422;s:4:\"9510\";i:1423;s:4:\"9511\";i:1424;s:4:\"9512\";i:1425;s:4:\"9513\";i:1426;s:4:\"9514\";i:1427;s:4:\"9515\";i:1428;s:4:\"9516\";i:1429;s:4:\"9517\";i:1430;s:4:\"9518\";i:1431;s:4:\"9519\";i:1432;s:4:\"9520\";i:1433;s:4:\"9522\";i:1434;s:4:\"9523\";i:1435;s:4:\"9524\";i:1436;s:4:\"9525\";i:1437;s:4:\"9526\";i:1438;s:4:\"9527\";i:1439;s:4:\"9528\";i:1440;s:4:\"9529\";i:1441;s:4:\"9530\";i:1442;s:4:\"9531\";i:1443;s:4:\"9532\";i:1444;s:4:\"9533\";i:1445;s:4:\"9534\";i:1446;s:4:\"9535\";i:1447;s:4:\"9536\";i:1448;s:4:\"9537\";i:1449;s:4:\"9538\";i:1450;s:4:\"9539\";i:1451;s:4:\"9540\";i:1452;s:4:\"9541\";i:1453;s:4:\"9542\";i:1454;s:4:\"9543\";i:1455;s:4:\"9544\";i:1456;s:4:\"9545\";i:1457;s:4:\"9546\";i:1458;s:4:\"9547\";i:1459;s:4:\"9548\";i:1460;s:4:\"9549\";i:1461;s:4:\"9550\";i:1462;s:4:\"9551\";i:1463;s:4:\"9552\";i:1464;s:4:\"9553\";i:1465;s:4:\"9554\";i:1466;s:4:\"9555\";i:1467;s:4:\"9556\";i:1468;s:4:\"9557\";i:1469;s:4:\"9558\";i:1470;s:4:\"9559\";i:1471;s:4:\"9560\";i:1472;s:4:\"9561\";i:1473;s:4:\"9562\";i:1474;s:4:\"9563\";i:1475;s:4:\"9564\";i:1476;s:4:\"9565\";i:1477;s:4:\"9566\";i:1478;s:4:\"9567\";i:1479;s:4:\"9568\";i:1480;s:4:\"9569\";i:1481;s:4:\"9570\";i:1482;s:4:\"9571\";i:1483;s:4:\"9572\";i:1484;s:4:\"9573\";i:1485;s:4:\"9574\";i:1486;s:4:\"9575\";i:1487;s:4:\"9576\";i:1488;s:4:\"9577\";i:1489;s:4:\"9578\";i:1490;s:4:\"9579\";i:1491;s:4:\"9580\";i:1492;s:4:\"9581\";i:1493;s:4:\"9582\";i:1494;s:4:\"9583\";i:1495;s:4:\"9584\";i:1496;s:4:\"9585\";i:1497;s:4:\"9586\";i:1498;s:4:\"9587\";i:1499;s:4:\"9588\";i:1500;s:4:\"9589\";i:1501;s:4:\"9590\";i:1502;s:4:\"9591\";i:1503;s:4:\"9592\";i:1504;s:4:\"9593\";i:1505;s:4:\"9594\";i:1506;s:4:\"9595\";i:1507;s:4:\"9596\";i:1508;s:4:\"9597\";i:1509;s:4:\"9598\";i:1510;s:4:\"9599\";i:1511;s:4:\"9600\";i:1512;s:4:\"9601\";i:1513;s:4:\"9602\";i:1514;s:4:\"9603\";i:1515;s:4:\"9604\";i:1516;s:4:\"9605\";i:1517;s:4:\"9606\";i:1518;s:4:\"9607\";i:1519;s:4:\"9608\";i:1520;s:4:\"9609\";i:1521;s:4:\"9610\";i:1522;s:4:\"9611\";i:1523;s:4:\"9612\";i:1524;s:4:\"9613\";i:1525;s:4:\"9614\";i:1526;s:4:\"9615\";i:1527;s:4:\"9616\";i:1528;s:4:\"9617\";i:1529;s:4:\"9618\";i:1530;s:4:\"9619\";i:1531;s:4:\"9620\";i:1532;s:4:\"9621\";i:1533;s:4:\"9622\";i:1534;s:4:\"9623\";i:1535;s:4:\"9624\";i:1536;s:4:\"9625\";i:1537;s:4:\"9626\";i:1538;s:4:\"9627\";i:1539;s:4:\"9628\";i:1540;s:4:\"9630\";i:1541;s:4:\"9631\";i:1542;s:4:\"9632\";i:1543;s:4:\"9633\";i:1544;s:4:\"9634\";i:1545;s:4:\"9635\";i:1546;s:4:\"9636\";i:1547;s:4:\"9637\";i:1548;s:4:\"9638\";i:1549;s:4:\"9639\";i:1550;s:4:\"9640\";i:1551;s:4:\"9641\";i:1552;s:4:\"9642\";i:1553;s:4:\"9643\";i:1554;s:4:\"9644\";i:1555;s:4:\"9645\";i:1556;s:4:\"9646\";i:1557;s:4:\"9647\";i:1558;s:4:\"9648\";i:1559;s:4:\"9649\";i:1560;s:4:\"9650\";i:1561;s:4:\"9651\";i:1562;s:4:\"9652\";i:1563;s:4:\"9653\";i:1564;s:4:\"9654\";i:1565;s:4:\"9655\";i:1566;s:4:\"9656\";i:1567;s:4:\"9657\";i:1568;s:4:\"9658\";i:1569;s:4:\"9659\";i:1570;s:4:\"9660\";i:1571;s:4:\"9661\";i:1572;s:4:\"9662\";i:1573;s:4:\"9663\";i:1574;s:4:\"9664\";i:1575;s:4:\"9665\";i:1576;s:4:\"9666\";i:1577;s:4:\"9667\";i:1578;s:4:\"9668\";i:1579;s:4:\"9669\";i:1580;s:4:\"9670\";i:1581;s:4:\"9671\";i:1582;s:4:\"9672\";i:1583;s:4:\"9673\";i:1584;s:4:\"9674\";i:1585;s:4:\"9675\";i:1586;s:4:\"9676\";i:1587;s:4:\"9677\";i:1588;s:4:\"9678\";i:1589;s:4:\"9679\";i:1590;s:4:\"9680\";i:1591;s:4:\"9681\";i:1592;s:4:\"9682\";i:1593;s:4:\"9683\";i:1594;s:4:\"9684\";i:1595;s:4:\"9685\";i:1596;s:4:\"9686\";i:1597;s:4:\"9687\";i:1598;s:4:\"9688\";i:1599;s:4:\"9689\";i:1600;s:4:\"9690\";i:1601;s:4:\"9691\";i:1602;s:4:\"9692\";i:1603;s:4:\"9693\";i:1604;s:4:\"9694\";i:1605;s:4:\"9695\";i:1606;s:4:\"9696\";i:1607;s:4:\"9697\";i:1608;s:4:\"9698\";i:1609;s:4:\"9699\";i:1610;s:4:\"9700\";i:1611;s:4:\"9701\";i:1612;s:4:\"9702\";i:1613;s:4:\"9703\";i:1614;s:4:\"9704\";i:1615;s:4:\"9705\";i:1616;s:4:\"9706\";i:1617;s:4:\"9707\";i:1618;s:4:\"9708\";i:1619;s:4:\"9709\";i:1620;s:4:\"9710\";i:1621;s:4:\"9711\";i:1622;s:4:\"9712\";i:1623;s:4:\"9713\";i:1624;s:4:\"9714\";i:1625;s:4:\"9715\";i:1626;s:4:\"9716\";i:1627;s:4:\"9717\";i:1628;s:4:\"9718\";i:1629;s:4:\"9719\";i:1630;s:4:\"9720\";i:1631;s:4:\"9721\";i:1632;s:4:\"9722\";i:1633;s:4:\"9723\";i:1634;s:4:\"9724\";i:1635;s:4:\"9725\";i:1636;s:4:\"9726\";i:1637;s:4:\"9727\";i:1638;s:4:\"9728\";i:1639;s:4:\"9729\";i:1640;s:4:\"9730\";i:1641;s:4:\"9732\";i:1642;s:4:\"9733\";i:1643;s:4:\"9734\";i:1644;s:4:\"9735\";i:1645;s:4:\"9736\";i:1646;s:4:\"9737\";i:1647;s:4:\"9738\";i:1648;s:4:\"9739\";i:1649;s:4:\"9740\";i:1650;s:4:\"9741\";i:1651;s:4:\"9742\";i:1652;s:4:\"9743\";i:1653;s:4:\"9744\";i:1654;s:4:\"9745\";i:1655;s:4:\"9746\";i:1656;s:4:\"9747\";i:1657;s:4:\"9748\";i:1658;s:4:\"9749\";i:1659;s:4:\"9750\";i:1660;s:4:\"9751\";i:1661;s:4:\"9752\";i:1662;s:4:\"9753\";i:1663;s:4:\"9754\";}i:3;a:34:{i:0;s:4:\"8095\";i:1;s:4:\"8169\";i:2;s:4:\"8173\";i:3;s:4:\"8229\";i:4;s:4:\"8245\";i:5;s:4:\"8297\";i:6;s:4:\"8307\";i:7;s:4:\"8316\";i:8;s:4:\"8324\";i:9;s:4:\"8386\";i:10;s:4:\"8421\";i:11;s:4:\"8463\";i:12;s:4:\"8464\";i:13;s:4:\"8465\";i:14;s:4:\"8466\";i:15;s:4:\"8663\";i:16;s:4:\"8771\";i:17;s:4:\"8953\";i:18;s:4:\"9027\";i:19;s:4:\"9031\";i:20;s:4:\"9087\";i:21;s:4:\"9103\";i:22;s:4:\"9155\";i:23;s:4:\"9165\";i:24;s:4:\"9174\";i:25;s:4:\"9182\";i:26;s:4:\"9244\";i:27;s:4:\"9279\";i:28;s:4:\"9321\";i:29;s:4:\"9322\";i:30;s:4:\"9323\";i:31;s:4:\"9324\";i:32;s:4:\"9521\";i:33;s:4:\"9629\";}i:2;a:2:{i:0;s:4:\"8909\";i:1;s:4:\"9731\";}i:5;a:1:{i:0;s:4:\"8911\";}}');
INSERT INTO `x2_knows` VALUES (3, '演示三', 1, '', 0, 0, 'a:1:{i:4;i:1;}', 'a:1:{i:4;a:1:{i:0;s:4:\"4908\";}}');

-- ----------------------------
-- Table structure for x2_log
-- ----------------------------
DROP TABLE IF EXISTS `x2_log`;
CREATE TABLE `x2_log`  (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `loguserid` int(11) NULL DEFAULT 0,
  `logcourseid` int(11) NULL DEFAULT 0,
  `logtime` int(11) NULL DEFAULT 0,
  `logstatus` int(1) NULL DEFAULT NULL,
  `logendtime` int(11) NULL DEFAULT NULL,
  `logprogress` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`logid`) USING BTREE,
  INDEX `loguserid`(`loguserid`, `logcourseid`) USING BTREE,
  INDEX `logtime`(`logtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 257 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_log
-- ----------------------------
INSERT INTO `x2_log` VALUES (254, 1, 1, 1664423199, 1, 1729479948, 0);
INSERT INTO `x2_log` VALUES (255, 1, 20, 1666060258, 0, 0, 2185);
INSERT INTO `x2_log` VALUES (256, 1, 7, 1729481412, 0, 0, 0);

-- ----------------------------
-- Table structure for x2_module
-- ----------------------------
DROP TABLE IF EXISTS `x2_module`;
CREATE TABLE `x2_module`  (
  `moduleid` int(11) NOT NULL AUTO_INCREMENT,
  `modulecode` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `modulename` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `moduledescribe` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `moduleapp` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `moduletable` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `moduleallowreg` tinyint(1) NOT NULL DEFAULT 0,
  `modulestatus` int(1) NOT NULL DEFAULT 0,
  `modulelockfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `modulebrands` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`moduleid`) USING BTREE,
  UNIQUE INDEX `modulecode`(`modulecode`) USING BTREE,
  INDEX `modulename`(`modulename`) USING BTREE,
  INDEX `moduleapp`(`moduleapp`) USING BTREE,
  INDEX `moduleallowreg`(`moduleallowreg`) USING BTREE,
  INDEX `modulestatus`(`modulestatus`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 41 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_module
-- ----------------------------
INSERT INTO `x2_module` VALUES (1, 'manager', '管理员模型', '管理员', 'user', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (9, 'normal', '普通用户模型', '普通用户', 'user', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (12, 'teacher', '教师模型', '教师模型', 'user', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (14, 'course', '视频课程', '视频课程', 'course', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (15, 'pdf', '文本课程', '文本课程', 'course', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (16, 'news', '新闻', '新闻', 'content', '', 0, 0, '', NULL);
INSERT INTO `x2_module` VALUES (39, 'enroll', '普通报名', '', 'enroll', '', 0, 0, '', '');
INSERT INTO `x2_module` VALUES (40, 'dirs', '文件夹', '文件夹模型', 'course', '', 0, 0, '', '');

-- ----------------------------
-- Table structure for x2_module_fields
-- ----------------------------
DROP TABLE IF EXISTS `x2_module_fields`;
CREATE TABLE `x2_module_fields`  (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldappid` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldmoduleid` int(4) NOT NULL DEFAULT 0,
  `fieldsequence` tinyint(4) NOT NULL DEFAULT 0,
  `field` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldtitle` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldlength` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fielddescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fieldtype` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldhtmltype` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldhtmlproperty` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fieldvalues` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fielddefault` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fieldlock` tinyint(1) NOT NULL DEFAULT 0,
  `fieldindextype` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fieldforbidactors` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fieldsystem` int(1) NOT NULL DEFAULT 0,
  `fieldpublic` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fieldid`) USING BTREE,
  INDEX `field`(`field`, `fieldlock`) USING BTREE,
  INDEX `fieldmoduleid`(`fieldmoduleid`) USING BTREE,
  INDEX `fieldsequence`(`fieldsequence`) USING BTREE,
  INDEX `fieldsystem`(`fieldsystem`) USING BTREE,
  INDEX `fieldpublic`(`fieldpublic`) USING BTREE,
  INDEX `fieldappid`(`fieldappid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_module_fields
-- ----------------------------
INSERT INTO `x2_module_fields` VALUES (1, 'user', 1, 2, 'manager_apps', '可管理模块', '240', '', 'varchar', 'checkboxarray', 'class=form-control\r\nstyle=width:30%', '用户=user\r\n内容=content\r\n考试=exam\r\n文件=document\r\n课程=course\r\n财务=bank\r\n表单=autoform', '', 0, '', ',-1,', 0, 0);
INSERT INTO `x2_module_fields` VALUES (2, 'user', 12, 10, 'userphoto', '头像', '240', '', 'varchar', 'thumb', '', '', '', 0, '', ',,', 1, 1);
INSERT INTO `x2_module_fields` VALUES (3, 'user', 1, 9, 'usertruename', '真实姓名', '24', '', 'varchar', 'text', 'class=form-control noborder\r\nplaceholder=请输入真实姓名', '', '', 0, '0', ',,', 1, 1);
INSERT INTO `x2_module_fields` VALUES (4, 'user', 12, 0, 'teacher_subjects', '可管理科目', '', '', 'text', 'checkboxarray', '', '演示课程=1\r\n测试科目二=2\r\n测试考试=3\r\n用户=user\r\n内容=content\r\n考试=exam\r\n文件=document\r\n课程=course\r\n财务=bank\r\n表单=autoform', '', 0, '', ',-1,1,', 0, 0);
INSERT INTO `x2_module_fields` VALUES (5, 'course', 14, 0, 'course_files', 'MP4视频', '240', 'MP4的视频格式，用于支持IE浏览器的H5播放', 'varchar', 'videotext', 'exectype=upfile\r\nuptypes=*.mp4\r\nfilesize=120 MB', '', '', 0, '', ',,', 0, 0);
INSERT INTO `x2_module_fields` VALUES (6, 'user', 12, 3, 'userprofile', '个人简介', '', '', 'text', 'textarea', 'class=form-control\r\nrows=5\r\nplaceholder=请输入个人简介', '', '', 0, '', ',,', 0, 1);
INSERT INTO `x2_module_fields` VALUES (7, 'course', 15, 0, 'pdf_file', 'PDF文件', '240', '', 'varchar', 'videotext', 'exectype=upfile\r\nuptypes=*.pdf\r\nfilesize=20 MB\r\nattr-ftype=pdf', '', '', 0, '', ',,', 0, 0);
INSERT INTO `x2_module_fields` VALUES (8, 'user', 12, 7, 'userphone', '手机号', '15', '', 'varchar', 'text', 'class=form-control', '', '', 0, 'INDEX', ',,', 0, 1);
INSERT INTO `x2_module_fields` VALUES (9, 'user', 12, 4, 'useraddress', '地址', '120', '', 'varchar', 'text', 'class=form-control', '信息部=信息部', '', 0, '', ',,', 1, 1);
INSERT INTO `x2_module_fields` VALUES (10, 'user', 12, 6, 'usergender', '性别', '6', '', 'varchar', 'radio', '', '男=男\r\n女=女', '男', 0, '', ',,', 0, 1);
INSERT INTO `x2_module_fields` VALUES (11, 'user', 9, 0, 'normal_sfz', '身份证号', '25', '', 'text', 'text', '', '', '', 0, '', ',,', 0, 0);
INSERT INTO `x2_module_fields` VALUES (12, 'item', 37, 0, 'coupon_coin', '积分额度', '', '', 'int', 'text', '', '', '', 0, '', ',,', 1, 0);
INSERT INTO `x2_module_fields` VALUES (13, 'item', 37, 0, 'coupon_number', '课时数', '', '', 'int', 'text', '', '', '', 0, '', ',,', 1, 0);
INSERT INTO `x2_module_fields` VALUES (14, 'enroll', 39, 0, 'enrolltruename', '姓名', '48', '', 'varchar', 'text', 'class=form-control normal\r\nneedle=needle\r\nmsg=姓名\r\nplaceholder=姓名', '', '', 0, '', ',,', 1, 1);
INSERT INTO `x2_module_fields` VALUES (15, 'enroll', 39, 0, 'enrollpassport', '身份证号', '36', '', 'varchar', 'text', 'class=form-control normal\r\nneedle=needle\r\nmsg=身份证号\r\nplaceholder=身份证号', '', '', 0, '', ',,', 0, 1);
INSERT INTO `x2_module_fields` VALUES (16, 'enroll', 39, 0, 'enrollphone', '手机号', '15', '', 'varchar', 'text', 'class=form-control normal\r\nneedle=needle\r\nmsg=手机号\r\nplaceholder=手机号', '', '', 0, '', ',,', 0, 1);

-- ----------------------------
-- Table structure for x2_navs
-- ----------------------------
DROP TABLE IF EXISTS `x2_navs`;
CREATE TABLE `x2_navs`  (
  `navid` int(11) NOT NULL AUTO_INCREMENT,
  `navtitle` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `navurl` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `navsequence` int(11) NULL DEFAULT NULL,
  `navstatus` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`navid`) USING BTREE,
  INDEX `navsequence`(`navsequence`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_navs
-- ----------------------------
INSERT INTO `x2_navs` VALUES (1, '考试', 'index.php?exam-app', 4, 1);
INSERT INTO `x2_navs` VALUES (2, '首页', 'index.php', 6, 1);
INSERT INTO `x2_navs` VALUES (3, '内容', 'index.php?content', 5, 1);
INSERT INTO `x2_navs` VALUES (6, '课程', 'index.php?course', 0, 1);
INSERT INTO `x2_navs` VALUES (7, '调查', 'index.php?survey', 0, 1);
INSERT INTO `x2_navs` VALUES (9, '报名', 'index.php?enroll', 0, 1);
INSERT INTO `x2_navs` VALUES (10, '提问', 'index.php?ask', 0, 1);

-- ----------------------------
-- Table structure for x2_openbasics
-- ----------------------------
DROP TABLE IF EXISTS `x2_openbasics`;
CREATE TABLE `x2_openbasics`  (
  `obid` int(11) NOT NULL AUTO_INCREMENT,
  `obuserid` int(11) NOT NULL DEFAULT 0,
  `obbasicid` int(11) NOT NULL DEFAULT 0,
  `obtime` int(11) NOT NULL DEFAULT 0,
  `obendtime` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`obid`) USING BTREE,
  INDEX `oluserid`(`obuserid`, `obbasicid`, `obtime`, `obendtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_openbasics
-- ----------------------------
INSERT INTO `x2_openbasics` VALUES (5, 1, 1, 1729132737, 1760668737);

-- ----------------------------
-- Table structure for x2_opencourse
-- ----------------------------
DROP TABLE IF EXISTS `x2_opencourse`;
CREATE TABLE `x2_opencourse`  (
  `ocid` int(11) NOT NULL AUTO_INCREMENT,
  `ocuserid` int(11) NOT NULL,
  `occourseid` int(11) NOT NULL,
  `octime` int(11) NOT NULL,
  `ocendtime` int(11) NOT NULL,
  PRIMARY KEY (`ocid`) USING BTREE,
  INDEX `ocuserid`(`ocuserid`, `occourseid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_opencourse
-- ----------------------------
INSERT INTO `x2_opencourse` VALUES (6, 1, 1, 1760067797, 1760931797);
INSERT INTO `x2_opencourse` VALUES (5, 1, 12, 1729478368, 1761014368);

-- ----------------------------
-- Table structure for x2_orders
-- ----------------------------
DROP TABLE IF EXISTS `x2_orders`;
CREATE TABLE `x2_orders`  (
  `ordersn` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ordertitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderitems` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderprice` decimal(10, 2) NOT NULL,
  `orderuserid` int(11) NOT NULL,
  `orderuserinfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderstatus` int(2) NOT NULL,
  `orderfullprice` decimal(10, 2) NOT NULL,
  `ordercreatetime` int(11) NOT NULL,
  `orderpaytime` int(11) NOT NULL,
  `orderouttime` int(11) NOT NULL,
  `orderrecivetime` int(11) NOT NULL,
  `orderfaq` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderpost` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `orderapp` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `orderpaytype` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `orderbill` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ordersn`) USING BTREE,
  INDEX `orderuserid`(`orderuserid`) USING BTREE,
  INDEX `orderapp`(`orderapp`) USING BTREE,
  INDEX `orderprice`(`orderprice`) USING BTREE,
  INDEX `orderpaytype`(`orderpaytype`) USING BTREE,
  INDEX `ordercreatetime`(`ordercreatetime`) USING BTREE,
  INDEX `orderpaytime`(`orderpaytime`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_orders
-- ----------------------------

-- ----------------------------
-- Table structure for x2_poscontent
-- ----------------------------
DROP TABLE IF EXISTS `x2_poscontent`;
CREATE TABLE `x2_poscontent`  (
  `pcid` int(11) NOT NULL AUTO_INCREMENT,
  `pcposid` int(11) NOT NULL DEFAULT 0,
  `pcposapp` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pccontentid` int(11) NOT NULL DEFAULT 0,
  `pcthumb` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `pcsequence` int(11) NOT NULL DEFAULT 0,
  `pctitle` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `pctime` int(11) NOT NULL DEFAULT 0,
  `pcdescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`pcid`) USING BTREE,
  INDEX `pcposid`(`pcposid`, `pccontentid`, `pcsequence`) USING BTREE,
  INDEX `pctime`(`pctime`) USING BTREE,
  INDEX `pcposapp`(`pcposapp`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_poscontent
-- ----------------------------

-- ----------------------------
-- Table structure for x2_position
-- ----------------------------
DROP TABLE IF EXISTS `x2_position`;
CREATE TABLE `x2_position`  (
  `posid` int(11) NOT NULL AUTO_INCREMENT,
  `posname` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `posapp` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`posid`) USING BTREE,
  INDEX `posapp`(`posapp`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_position
-- ----------------------------
INSERT INTO `x2_position` VALUES (1, 'PC首页轮播图', 'content');
INSERT INTO `x2_position` VALUES (2, '热点新闻', 'content');
INSERT INTO `x2_position` VALUES (3, '精彩专题', 'content');
INSERT INTO `x2_position` VALUES (4, '手机首页轮播', 'content');

-- ----------------------------
-- Table structure for x2_progress
-- ----------------------------
DROP TABLE IF EXISTS `x2_progress`;
CREATE TABLE `x2_progress`  (
  `prsid` int(11) NOT NULL AUTO_INCREMENT,
  `prsuserid` int(11) NOT NULL,
  `prstime` int(11) NOT NULL,
  `prsendtime` int(11) NOT NULL,
  `prscourseid` int(11) NOT NULL,
  `prscoursestatus` tinyint(1) NOT NULL,
  `prsexamid` int(11) NOT NULL,
  `prsexamstatus` tinyint(1) NOT NULL,
  `prstatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`prsid`) USING BTREE,
  INDEX `prsuserid`(`prsuserid`) USING BTREE,
  INDEX `prscoursestatus`(`prscoursestatus`) USING BTREE,
  INDEX `prsexamstatus`(`prsexamstatus`) USING BTREE,
  INDEX `prstatus`(`prstatus`) USING BTREE,
  INDEX `prscourseid`(`prscourseid`) USING BTREE,
  INDEX `prsexamid`(`prsexamid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_progress
-- ----------------------------
INSERT INTO `x2_progress` VALUES (1, 1, 1729478880, 0, 1, 0, 1, 0, 0);

-- ----------------------------
-- Table structure for x2_province
-- ----------------------------
DROP TABLE IF EXISTS `x2_province`;
CREATE TABLE `x2_province`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provinceid` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `province` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `province`(`province`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_province
-- ----------------------------
INSERT INTO `x2_province` VALUES (1, '110000', '北京市');
INSERT INTO `x2_province` VALUES (2, '120000', '天津市');
INSERT INTO `x2_province` VALUES (3, '130000', '河北省');
INSERT INTO `x2_province` VALUES (4, '140000', '山西省');
INSERT INTO `x2_province` VALUES (5, '150000', '内蒙古自治区');
INSERT INTO `x2_province` VALUES (6, '210000', '辽宁省');
INSERT INTO `x2_province` VALUES (7, '220000', '吉林省');
INSERT INTO `x2_province` VALUES (8, '230000', '黑龙江省');
INSERT INTO `x2_province` VALUES (9, '310000', '上海市');
INSERT INTO `x2_province` VALUES (10, '320000', '江苏省');
INSERT INTO `x2_province` VALUES (11, '330000', '浙江省');
INSERT INTO `x2_province` VALUES (12, '340000', '安徽省');
INSERT INTO `x2_province` VALUES (13, '350000', '福建省');
INSERT INTO `x2_province` VALUES (14, '360000', '江西省');
INSERT INTO `x2_province` VALUES (15, '370000', '山东省');
INSERT INTO `x2_province` VALUES (16, '410000', '河南省');
INSERT INTO `x2_province` VALUES (17, '420000', '湖北省');
INSERT INTO `x2_province` VALUES (18, '430000', '湖南省');
INSERT INTO `x2_province` VALUES (19, '440000', '广东省');
INSERT INTO `x2_province` VALUES (20, '450000', '广西壮族自治区');
INSERT INTO `x2_province` VALUES (21, '460000', '海南省');
INSERT INTO `x2_province` VALUES (22, '500000', '重庆市');
INSERT INTO `x2_province` VALUES (23, '510000', '四川省');
INSERT INTO `x2_province` VALUES (24, '520000', '贵州省');
INSERT INTO `x2_province` VALUES (25, '530000', '云南省');
INSERT INTO `x2_province` VALUES (26, '540000', '西藏自治区');
INSERT INTO `x2_province` VALUES (27, '610000', '陕西省');
INSERT INTO `x2_province` VALUES (28, '620000', '甘肃省');
INSERT INTO `x2_province` VALUES (29, '630000', '青海省');
INSERT INTO `x2_province` VALUES (30, '640000', '宁夏回族自治区');
INSERT INTO `x2_province` VALUES (31, '650000', '新疆维吾尔自治区');
INSERT INTO `x2_province` VALUES (32, '810000', '香港特别行政区');
INSERT INTO `x2_province` VALUES (33, '820000', '澳门特别行政区');
INSERT INTO `x2_province` VALUES (34, '710000', '台湾省');

-- ----------------------------
-- Table structure for x2_quest2knows
-- ----------------------------
DROP TABLE IF EXISTS `x2_quest2knows`;
CREATE TABLE `x2_quest2knows`  (
  `qkid` int(11) NOT NULL AUTO_INCREMENT,
  `qkquestionid` int(11) NOT NULL DEFAULT 0,
  `qkknowsid` int(11) NOT NULL DEFAULT 0,
  `qktype` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`qkid`) USING BTREE,
  INDEX `qkquestionid`(`qkquestionid`, `qkknowsid`) USING BTREE,
  INDEX `qktype`(`qktype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9602 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_quest2knows
-- ----------------------------

-- ----------------------------
-- Table structure for x2_questionanalysis
-- ----------------------------
DROP TABLE IF EXISTS `x2_questionanalysis`;
CREATE TABLE `x2_questionanalysis`  (
  `qaid` int(11) NOT NULL AUTO_INCREMENT,
  `qabasicid` int(11) NULL DEFAULT NULL,
  `qaquestionid` int(11) NULL DEFAULT NULL,
  `qauserid` int(11) NULL DEFAULT NULL,
  `qanumber` int(11) NULL DEFAULT NULL,
  `qarightnumber` int(11) NULL DEFAULT NULL,
  `qawrongnumber` int(11) NULL DEFAULT NULL,
  `qalasttime` int(11) NULL DEFAULT NULL,
  `qafirststatus` int(1) NULL DEFAULT NULL,
  `qalaststatus` int(1) NULL DEFAULT NULL,
  `qarate` int(11) NULL DEFAULT NULL,
  `qaqnparent` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`qaid`) USING BTREE,
  INDEX `qabasicid`(`qabasicid`) USING BTREE,
  INDEX `qaquestionid`(`qaquestionid`) USING BTREE,
  INDEX `qauserid`(`qauserid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_questionanalysis
-- ----------------------------

-- ----------------------------
-- Table structure for x2_questionrows
-- ----------------------------
DROP TABLE IF EXISTS `x2_questionrows`;
CREATE TABLE `x2_questionrows`  (
  `qrid` int(11) NOT NULL AUTO_INCREMENT,
  `qrtype` tinyint(4) NOT NULL DEFAULT 2,
  `qrquestion` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qrknowsid` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `qrlevel` int(1) NOT NULL DEFAULT 0,
  `qrnumber` int(4) NOT NULL DEFAULT 0,
  `qruserid` int(11) NOT NULL DEFAULT 0,
  `qrusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `qrlastmodifyuser` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `qrtime` int(11) NOT NULL DEFAULT 0,
  `qrstatus` tinyint(1) NOT NULL DEFAULT 1,
  `qrdeler` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `qrdeltime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`qrid`) USING BTREE,
  INDEX `qrlevel`(`qrlevel`, `qrnumber`) USING BTREE,
  INDEX `qruserid`(`qruserid`) USING BTREE,
  INDEX `qrtime`(`qrtime`) USING BTREE,
  INDEX `qrstatus`(`qrstatus`) USING BTREE,
  INDEX `qrtype`(`qrtype`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_questionrows
-- ----------------------------

-- ----------------------------
-- Table structure for x2_questions
-- ----------------------------
DROP TABLE IF EXISTS `x2_questions`;
CREATE TABLE `x2_questions`  (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `questiontype` int(3) NOT NULL DEFAULT 0,
  `question` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questionuserid` int(11) NOT NULL DEFAULT 0,
  `questionusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `questionlastmodifyuser` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `questionselect` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questionselectnumber` tinyint(11) NOT NULL DEFAULT 0,
  `questionanswer` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questiondescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questionknowsid` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questioncreatetime` int(11) NOT NULL DEFAULT 0,
  `questionstatus` int(1) NOT NULL DEFAULT 1,
  `questionhtml` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `questionparent` int(11) NOT NULL DEFAULT 0,
  `questionsequence` int(3) NOT NULL DEFAULT 0,
  `questionlevel` int(1) NOT NULL DEFAULT 0,
  `questiondeler` varchar(72) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `questiondeltime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`questionid`) USING BTREE,
  INDEX `questioncreatetime`(`questioncreatetime`) USING BTREE,
  INDEX `questiontype`(`questiontype`) USING BTREE,
  INDEX `questionstatus`(`questionstatus`) USING BTREE,
  INDEX `questionuserid`(`questionuserid`) USING BTREE,
  INDEX `questionparent`(`questionparent`, `questionsequence`) USING BTREE,
  INDEX `questionlevel`(`questionlevel`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9758 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_questions
-- ----------------------------

-- ----------------------------
-- Table structure for x2_questype
-- ----------------------------
DROP TABLE IF EXISTS `x2_questype`;
CREATE TABLE `x2_questype`  (
  `questid` int(11) NOT NULL AUTO_INCREMENT,
  `questype` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `questsort` int(1) NOT NULL DEFAULT 0,
  `questchoice` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`questid`) USING BTREE,
  INDEX `questchoice`(`questchoice`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_questype
-- ----------------------------
INSERT INTO `x2_questype` VALUES (1, '单选题', 0, 1);
INSERT INTO `x2_questype` VALUES (2, '多选题', 0, 2);
INSERT INTO `x2_questype` VALUES (3, '判断题', 0, 4);
INSERT INTO `x2_questype` VALUES (4, '定值填空', 0, 5);
INSERT INTO `x2_questype` VALUES (5, '填空题', 1, 2);
INSERT INTO `x2_questype` VALUES (6, '问答题', 1, 102);
INSERT INTO `x2_questype` VALUES (7, '题冒题', 0, 1);

-- ----------------------------
-- Table structure for x2_record
-- ----------------------------
DROP TABLE IF EXISTS `x2_record`;
CREATE TABLE `x2_record`  (
  `recordid` int(11) NOT NULL AUTO_INCREMENT,
  `recordquestionid` int(11) NOT NULL DEFAULT 0,
  `recorduserid` int(11) NOT NULL DEFAULT 0,
  `recordtime` int(11) NOT NULL DEFAULT 0,
  `recordsubjectid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`recordid`) USING BTREE,
  INDEX `recordquestionid`(`recordquestionid`) USING BTREE,
  INDEX `recorduserid`(`recorduserid`) USING BTREE,
  INDEX `recordsubjectid`(`recordsubjectid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 554 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of x2_record
-- ----------------------------

-- ----------------------------
-- Table structure for x2_recorddata
-- ----------------------------
DROP TABLE IF EXISTS `x2_recorddata`;
CREATE TABLE `x2_recorddata`  (
  `rdid` int(11) NOT NULL AUTO_INCREMENT,
  `rduserid` int(11) NULL DEFAULT NULL,
  `rdsubjectid` int(11) NULL DEFAULT NULL,
  `rddata` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `rdtime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`rdid`) USING BTREE,
  INDEX `rduserid`(`rduserid`) USING BTREE,
  INDEX `rdsubjectid`(`rdsubjectid`) USING BTREE,
  INDEX `rdtime`(`rdtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_recorddata
-- ----------------------------

-- ----------------------------
-- Table structure for x2_reply
-- ----------------------------
DROP TABLE IF EXISTS `x2_reply`;
CREATE TABLE `x2_reply`  (
  `replyid` int(11) NOT NULL AUTO_INCREMENT,
  `replyuserid` int(11) NOT NULL DEFAULT 0,
  `replyusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `replycommentid` int(11) NOT NULL DEFAULT 0,
  `replytime` int(11) NOT NULL DEFAULT 0,
  `replycontent` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`replyid`) USING BTREE,
  INDEX `replyuserid`(`replyuserid`, `replycommentid`, `replytime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_reply
-- ----------------------------

-- ----------------------------
-- Table structure for x2_sections
-- ----------------------------
DROP TABLE IF EXISTS `x2_sections`;
CREATE TABLE `x2_sections`  (
  `sectionid` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sectionsubjectid` int(11) NOT NULL DEFAULT 0,
  `sectiondescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sectionsequence` int(11) NOT NULL,
  PRIMARY KEY (`sectionid`) USING BTREE,
  INDEX `section`(`section`) USING BTREE,
  INDEX `sectionsubjectid`(`sectionsubjectid`) USING BTREE,
  INDEX `sectionsequence`(`sectionsequence`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_sections
-- ----------------------------
INSERT INTO `x2_sections` VALUES (1, '演示章节', 1, '', 1);

-- ----------------------------
-- Table structure for x2_session
-- ----------------------------
DROP TABLE IF EXISTS `x2_session`;
CREATE TABLE `x2_session`  (
  `sessionid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sessionuserid` int(11) NOT NULL DEFAULT 0,
  `sessionusername` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sessionpassword` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sessionip` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sessionmanage` tinyint(1) NULL DEFAULT 0,
  `sessiongroupid` int(11) NOT NULL DEFAULT 0,
  `sessioncurrent` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sessionrandcode` char(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `sessionlogintime` int(11) NOT NULL DEFAULT 0,
  `sessiontimelimit` int(11) NOT NULL DEFAULT 0,
  `sessionlasttime` int(11) NOT NULL DEFAULT 0,
  `sessionmaster` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sessionid`) USING BTREE,
  INDEX `sessionlasttime`(`sessionlasttime`) USING BTREE,
  INDEX `sessioncurrent`(`sessioncurrent`) USING BTREE,
  INDEX `sessionmaster`(`sessionmaster`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_session
-- ----------------------------
INSERT INTO `x2_session` VALUES ('00969feff071de0164b5198ed620822b', 0, '', '', '127.0.0.1', 0, 0, '', '', 0, 1760529140, 1760530105, 0);

-- ----------------------------
-- Table structure for x2_subject
-- ----------------------------
DROP TABLE IF EXISTS `x2_subject`;
CREATE TABLE `x2_subject`  (
  `subjectid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `subjectsetting` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`subjectid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_subject
-- ----------------------------
INSERT INTO `x2_subject` VALUES (1, '演示课程', 'a:1:{s:9:\"questypes\";a:5:{i:1;s:1:\"1\";i:2;s:1:\"1\";i:3;s:1:\"1\";i:5;s:1:\"1\";i:6;s:1:\"1\";}}');

-- ----------------------------
-- Table structure for x2_survey
-- ----------------------------
DROP TABLE IF EXISTS `x2_survey`;
CREATE TABLE `x2_survey`  (
  `svyid` int(11) NOT NULL AUTO_INCREMENT,
  `svytitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `svythumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `svytime` int(11) NULL DEFAULT NULL,
  `svytype` int(4) NULL DEFAULT NULL,
  `svydescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `svystime` int(11) NULL DEFAULT NULL,
  `svyendtime` int(11) NULL DEFAULT NULL,
  `svyuserid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`svyid`) USING BTREE,
  INDEX `svyuserid`(`svyuserid`) USING BTREE,
  INDEX `svystime`(`svystime`) USING BTREE,
  INDEX `svyendtime`(`svyendtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_survey
-- ----------------------------
INSERT INTO `x2_survey` VALUES (1, '编程语言使用调查', 'files/attach/images/content/20231007/16966638538217.png', 1728962249, 0, '&lt;p&gt;编程语言使用调查&lt;/p&gt;', 1696608024, 1733500824, 1);

-- ----------------------------
-- Table structure for x2_survey_history
-- ----------------------------
DROP TABLE IF EXISTS `x2_survey_history`;
CREATE TABLE `x2_survey_history`  (
  `syhyid` int(11) NOT NULL AUTO_INCREMENT,
  `syhyuserid` int(11) NULL DEFAULT NULL,
  `syhysvyid` int(11) NULL DEFAULT NULL,
  `syhyanswers` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `syhycode` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `syhytime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`syhyid`) USING BTREE,
  INDEX `syhysvyid`(`syhysvyid`) USING BTREE,
  INDEX `syhyuserid`(`syhyuserid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_survey_history
-- ----------------------------
INSERT INTO `x2_survey_history` VALUES (1, 0, 1, 'a:2:{i:1;a:2:{i:0;s:1:\"A\";i:1;s:1:\"B\";}i:2;a:2:{i:1;s:1:\"B\";i:2;s:1:\"C\";}}', '', 1729225305);

-- ----------------------------
-- Table structure for x2_survey_node
-- ----------------------------
DROP TABLE IF EXISTS `x2_survey_node`;
CREATE TABLE `x2_survey_node`  (
  `syneid` int(11) NOT NULL AUTO_INCREMENT,
  `synesvyid` int(11) NULL DEFAULT NULL,
  `synetitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `synedescribe` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`syneid`) USING BTREE,
  INDEX `synesvyid`(`synesvyid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_survey_node
-- ----------------------------
INSERT INTO `x2_survey_node` VALUES (1, 1, '前端语言', '');
INSERT INTO `x2_survey_node` VALUES (2, 1, '后端语言', '');

-- ----------------------------
-- Table structure for x2_survey_questions
-- ----------------------------
DROP TABLE IF EXISTS `x2_survey_questions`;
CREATE TABLE `x2_survey_questions`  (
  `syqnid` int(11) NOT NULL AUTO_INCREMENT,
  `syqnsvyid` int(11) NULL DEFAULT NULL,
  `syqnsyneid` int(11) NULL DEFAULT NULL,
  `syqnquestion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `syqnquestiontype` int(11) NULL DEFAULT NULL,
  `syqnquestionselect` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `syqnquestionselectnumber` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`syqnid`) USING BTREE,
  INDEX `syqnsvyid`(`syqnsvyid`) USING BTREE,
  INDEX `syqnsyneid`(`syqnsyneid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_survey_questions
-- ----------------------------
INSERT INTO `x2_survey_questions` VALUES (1, 1, 1, '&lt;p&gt;常用的前端语言&lt;/p&gt;', 2, '&lt;p&gt;A&lt;/p&gt;\r\n\r\n&lt;p&gt;B&lt;/p&gt;\r\n\r\n&lt;p&gt;C&lt;/p&gt;\r\n\r\n&lt;p&gt;D&lt;/p&gt;', 4);
INSERT INTO `x2_survey_questions` VALUES (2, 1, 2, '&lt;p&gt;常用的后端语言&lt;/p&gt;', 2, '&lt;p&gt;A&lt;/p&gt;\r\n\r\n&lt;p&gt;B&lt;/p&gt;\r\n\r\n&lt;p&gt;C&lt;/p&gt;\r\n\r\n&lt;p&gt;D&lt;/p&gt;', 4);

-- ----------------------------
-- Table structure for x2_user
-- ----------------------------
DROP TABLE IF EXISTS `x2_user`;
CREATE TABLE `x2_user`  (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `useropenid` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userunionid` varchar(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `useremail` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `userpassword` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `usercoin` int(11) NOT NULL DEFAULT 0,
  `userregip` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `userregtime` int(11) NOT NULL DEFAULT 0,
  `userlogtime` int(11) NOT NULL DEFAULT 0,
  `userverifytime` int(11) NULL DEFAULT NULL,
  `usergroupid` int(11) NOT NULL DEFAULT 0,
  `usermoduleid` int(11) NOT NULL DEFAULT 0,
  `useranswer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `manager_apps` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usertruename` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `normal_favor` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `teacher_subjects` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userprofile` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usergender` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userphone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `useraddress` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userphoto` varchar(240) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userstatus` int(4) NULL DEFAULT NULL,
  `normal_sfz` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userdisable` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`userid`) USING BTREE,
  UNIQUE INDEX `useremail`(`useremail`) USING BTREE,
  INDEX `username`(`username`) USING BTREE,
  INDEX `module`(`usercoin`) USING BTREE,
  INDEX `userregtime`(`userregtime`) USING BTREE,
  INDEX `usermoduleid`(`usermoduleid`) USING BTREE,
  INDEX `userlogtime`(`userlogtime`) USING BTREE,
  INDEX `useropenid`(`useropenid`) USING BTREE,
  INDEX `userphone`(`userphone`) USING BTREE,
  INDEX `userunionid`(`userunionid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_user
-- ----------------------------
INSERT INTO `x2_user` VALUES (1, '', NULL, 'peadmin', '958074@163.com', '244153a2599be7685c32d2281f57ae67', 239, '127.0.0.1', 1471795200, 0, NULL, 1, 0, NULL, 'a:7:{i:0;s:4:\"user\";i:1;s:7:\"content\";i:2;s:4:\"exam\";i:3;s:8:\"document\";i:4;s:6:\"course\";i:5;s:4:\"bank\";i:6;s:8:\"autoform\";}', '111111111111111111', '', '', '', '男', '', '信息部', 'files/attach/images/content/20241017/17291338997515.jpg', 3, '', NULL);
INSERT INTO `x2_user` VALUES (2, '', NULL, '教师管理员', '958074@126.com', '96e79218965eb72c92a549dd5a330112', 98, '127.0.0.1', 1471795200, 0, NULL, 9, 0, NULL, '', '213123', '', 'a:14:{i:0;s:2:\"13\";i:1;s:2:\"12\";i:2;s:1:\"5\";i:3;s:1:\"4\";i:4;s:1:\"3\";i:5;s:1:\"1\";i:6;s:1:\"2\";i:7;s:2:\"17\";i:8;s:2:\"15\";i:9;s:2:\"16\";i:10;s:2:\"18\";i:11;s:2:\"19\";i:12;s:2:\"20\";i:13;s:2:\"21\";}', '77777', '', '', '', '', 3, '', NULL);

-- ----------------------------
-- Table structure for x2_user_group
-- ----------------------------
DROP TABLE IF EXISTS `x2_user_group`;
CREATE TABLE `x2_user_group`  (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `groupmoduleid` tinyint(4) NOT NULL DEFAULT 0,
  `groupdescribe` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `groupright` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `groupmoduledefault` int(1) NOT NULL DEFAULT 0,
  `groupdefault` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`groupid`) USING BTREE,
  INDEX `groupname`(`groupname`, `groupmoduleid`) USING BTREE,
  INDEX `groupmoduledefault`(`groupmoduledefault`) USING BTREE,
  INDEX `groupdefault`(`groupdefault`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_user_group
-- ----------------------------
INSERT INTO `x2_user_group` VALUES (1, '管理员', 1, '管理员', '', 1, 0);
INSERT INTO `x2_user_group` VALUES (8, '普通用户', 9, '普通用户', '', 0, 1);
INSERT INTO `x2_user_group` VALUES (9, '教师', 12, '教师', '', 0, 0);

-- ----------------------------
-- Table structure for x2_user_log
-- ----------------------------
DROP TABLE IF EXISTS `x2_user_log`;
CREATE TABLE `x2_user_log`  (
  `ulid` int(11) NOT NULL AUTO_INCREMENT,
  `uluserid` int(11) NULL DEFAULT NULL,
  `ulip` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ulcliect` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ultime` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`ulid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of x2_user_log
-- ----------------------------
INSERT INTO `x2_user_log` VALUES (1, 1, '127.0.0.1', 'pc', 1760064643);
INSERT INTO `x2_user_log` VALUES (2, 1, '127.0.0.1', 'pc', 1760522227);

-- ----------------------------
-- Table structure for x2_wxlogin
-- ----------------------------
DROP TABLE IF EXISTS `x2_wxlogin`;
CREATE TABLE `x2_wxlogin`  (
  `wxsid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wxinfo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wxtime` int(11) NOT NULL,
  `wxtoken` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`wxsid`) USING BTREE,
  INDEX `wxtime`(`wxtime`) USING BTREE,
  INDEX `wxtoken`(`wxtoken`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of x2_wxlogin
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
