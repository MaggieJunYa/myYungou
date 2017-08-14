/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tpshop

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-09 16:26:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sp_attribute
-- ----------------------------
DROP TABLE IF EXISTS `sp_attribute`;
CREATE TABLE `sp_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `attr_name` varchar(32) NOT NULL COMMENT '属性名称',
  `type_id` smallint(5) unsigned NOT NULL COMMENT '外键，类型id',
  `attr_sel` enum('only','many') NOT NULL DEFAULT 'only' COMMENT 'only:输入框(唯一)  many:后台下拉列表/前台单选框',
  `attr_write` enum('manual','list') NOT NULL DEFAULT 'manual' COMMENT 'manual:手工录入  list:从列表选择',
  `attr_vals` varchar(256) NOT NULL DEFAULT '' COMMENT '可选值列表信息,例如颜色：白色,红色,绿色,多个可选值通过逗号分隔',
  PRIMARY KEY (`attr_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='属性表';

-- ----------------------------
-- Records of sp_attribute
-- ----------------------------
INSERT INTO `sp_attribute` VALUES ('1', '颜色', '1', 'many', 'list', '红色|蓝色|黑色|');
INSERT INTO `sp_attribute` VALUES ('2', '型号', '1', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('3', '外观样式', '1', 'many', 'list', '滑盖|翻盖|触屏|折叠');
INSERT INTO `sp_attribute` VALUES ('4', '内存容量', '1', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('5', 'ed sheeran', '2', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('6', 'swift', '2', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('7', '小黄人', '3', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('8', '演员', '3', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('9', '出版社', '4', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('10', '作者', '4', 'only', 'manual', '');
INSERT INTO `sp_attribute` VALUES ('11', 'lana del rey', '2', 'many', 'list', 'A|B|C|D');

-- ----------------------------
-- Table structure for sp_auth
-- ----------------------------
DROP TABLE IF EXISTS `sp_auth`;
CREATE TABLE `sp_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_level` enum('0','1') NOT NULL DEFAULT '0' COMMENT '权限等级',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of sp_auth
-- ----------------------------
INSERT INTO `sp_auth` VALUES ('101', '商品管理', '0', '', '', '0');
INSERT INTO `sp_auth` VALUES ('102', '订单管理', '0', '', '', '0');
INSERT INTO `sp_auth` VALUES ('103', '权限管理', '0', '', '', '0');
INSERT INTO `sp_auth` VALUES ('104', '商品列表', '101', 'Goods', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('105', '添加商品', '101', 'Goods', 'tianjia', '1');
INSERT INTO `sp_auth` VALUES ('106', '商品分类', '101', 'Category', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('107', '订单列表', '102', 'Order', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('108', '订单打印', '102', 'Order', 'dayin', '1');
INSERT INTO `sp_auth` VALUES ('109', '添加订单', '102', 'Order', 'tianjia', '1');
INSERT INTO `sp_auth` VALUES ('110', '管理员列表', '103', 'Manager', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('111', '角色列表', '103', 'Role', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('112', '权限列表', '103', 'Auth', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('113', '商品类型', '101', 'Type', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('114', '会员管理', '0', '', '', '0');
INSERT INTO `sp_auth` VALUES ('115', '会员列表', '114', 'User', 'showlist', '1');
INSERT INTO `sp_auth` VALUES ('116', '会员级别添加', '114', 'User', 'addMemberLevel', '1');
INSERT INTO `sp_auth` VALUES ('117', '会员级别列表', '114', 'User', 'memberLevelList', '1');

-- ----------------------------
-- Table structure for sp_backage
-- ----------------------------
DROP TABLE IF EXISTS `sp_backage`;
CREATE TABLE `sp_backage` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单',
  `backage_state` text NOT NULL COMMENT '快递信息',
  `backage_number` varchar(32) NOT NULL COMMENT '运单号',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='包裹快递';

-- ----------------------------
-- Records of sp_backage
-- ----------------------------

-- ----------------------------
-- Table structure for sp_consignee
-- ----------------------------
DROP TABLE IF EXISTS `sp_consignee`;
CREATE TABLE `sp_consignee` (
  `cgn_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int(11) NOT NULL COMMENT '会员id',
  `cgn_name` varchar(32) NOT NULL COMMENT '收货人名称',
  `cgn_address` varchar(200) NOT NULL DEFAULT '' COMMENT '收货人地址',
  `cgn_tel` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人电话',
  `cgn_code` char(6) NOT NULL DEFAULT '' COMMENT '邮编',
  PRIMARY KEY (`cgn_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='收货人表';

-- ----------------------------
-- Records of sp_consignee
-- ----------------------------
INSERT INTO `sp_consignee` VALUES ('1', '133', '王二柱', '北京市海淀区苏州街长远天地大厦305室', '13566771298', '306810');
INSERT INTO `sp_consignee` VALUES ('2', '133', '铁锤', '北京市海淀区西北旺用友大厦777室', '13126537865', '600981');
INSERT INTO `sp_consignee` VALUES ('3', '224', '鸭蛋', '北京市海淀区西三旗建材城西路中腾大厦15室', '18902564321', '600214');
INSERT INTO `sp_consignee` VALUES ('4', '224', '赵大海', '北京市海淀区中关村大街太平洋大厦801室', '15765329087', '600983');
INSERT INTO `sp_consignee` VALUES ('5', '226', '变形金刚', '北京市海淀区人大西门和平小区2#4门', '15028374375', '600912');
INSERT INTO `sp_consignee` VALUES ('6', '226', '葫芦娃', '北京市海淀区软件园软件大厦10室', '18679871209', '600011');

-- ----------------------------
-- Table structure for sp_goods
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods`;
CREATE TABLE `sp_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_name` varchar(128) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_number` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `goods_weight` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品重量',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类型id',
  `goods_introduce` text COMMENT '商品详情介绍',
  `goods_big_logo` char(128) NOT NULL DEFAULT '' COMMENT '图片logo大图',
  `goods_small_logo` char(128) NOT NULL DEFAULT '' COMMENT '图片logo小图',
  `is_del` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0:正常  1:删除',
  `add_time` int(11) NOT NULL COMMENT '添加商品时间',
  `upd_time` int(11) NOT NULL COMMENT '修改商品时间',
  `goods_member_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `static_url` char(128) DEFAULT NULL COMMENT '静态页面地址',
  PRIMARY KEY (`goods_id`),
  UNIQUE KEY `goods_name` (`goods_name`),
  KEY `goods_price` (`goods_price`),
  KEY `add_time` (`add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of sp_goods
-- ----------------------------
INSERT INTO `sp_goods` VALUES ('6', '7869', '789456.00', '255', '465', '0', '456', './Public/Upload/logo/2017-07-08/5960900abc18a.jpg', './Public/Upload/logo/2017-07-08/small_5960900abc18a.jpg', '0', '1498983887', '1499500554', '70000.00', './GoodsHTML/6.html');
INSERT INTO `sp_goods` VALUES ('7', '789789', '45645.00', '255', '123', '0', '123', './Public/Upload/logo/2017-07-08/59608ffd625f1.jpg', './Public/Upload/logo/2017-07-08/small_59608ffd625f1.jpg', '0', '1498983898', '1499500541', '0.00', null);
INSERT INTO `sp_goods` VALUES ('9', '1234', '123.00', '123', '123', '0', '123', './Public/Upload/logo/2017-07-08/59608feeaa6a8.jpg', './Public/Upload/logo/2017-07-08/small_59608feeaa6a8.jpg', '0', '1498984047', '1499500526', '0.00', null);
INSERT INTO `sp_goods` VALUES ('10', '7865645', '45645.00', '255', '4564', '0', '456456', './Public/Upload/logo/2017-07-08/59608f5dc735e.jpg', './Public/Upload/logo/2017-07-08/small_59608f5dc735e.jpg', '0', '1498984069', '1499500381', '0.00', null);
INSERT INTO `sp_goods` VALUES ('11', 'huhu', '99999999.99', '1', '40', '0', '<p><span style=\"color: rgb(255, 255, 0); text-decoration: underline; font-size: 24px;\"><strong>无</strong><strong>价</strong></span></p>', '', '', '0', '1498986465', '1498986465', '0.00', null);
INSERT INTO `sp_goods` VALUES ('12', 'taylor 1989', '25.00', '3', '25', '0', '<span style=\"font-size:20px;\"><em><strong>good  </strong></em></span>', './Public/Upload/logo/2017-07-08/59608f3dc9051.jpg', './Public/Upload/logo/2017-07-08/small_59608f3dc9051.jpg', '0', '1498988324', '1499500349', '0.00', null);
INSERT INTO `sp_goods` VALUES ('16', '1234444', '4444.00', '255', '66', '0', '66', './Public/Upload/logo/2017-07-08/59608efd4407f.jpg', './Public/Upload/logo/2017-07-08/small_59608efd4407f.jpg', '0', '1498997056', '1499500285', '0.00', null);
INSERT INTO `sp_goods` VALUES ('17', '777777', '77.00', '7', '777', '0', '', './Public/Upload/logo/2017-07-08/59608eeae8310.jpg', './Public/Upload/logo/2017-07-08/small_59608eeae8310.jpg', '0', '1499050445', '1499500266', '0.00', null);
INSERT INTO `sp_goods` VALUES ('18', '345546', '34.00', '255', '65', '0', '奥<span style=\"color:rgb(227,108,9);\"><strong>斯卡端口的646</strong></span>465<br />', './Public/Upload/logo/2017-07-03/5959b56a329fa.jpg', './Public/Upload/logo/2017-07-03/small_5959b56a329fa.jpg', '0', '1499051370', '1499085262', '0.00', null);
INSERT INTO `sp_goods` VALUES ('19', '99999', '99.00', '99', '99', '0', '奥斯卡的计划撒<strong>谎大理石</strong><br />', './Public/Upload/logo/2017-07-03/5959ecd0c9bd1.jpg', './Public/Upload/logo/2017-07-03/small_5959ecd0c9bd1.jpg', '0', '1499065553', '1499085239', '0.00', null);
INSERT INTO `sp_goods` VALUES ('21', '9852', '99.00', '99', '99', '0', 'askdhahak<br />', './Public/Upload/logo/2017-07-03/5959ed1babe06.jpg', './Public/Upload/logo/2017-07-03/small_5959ed1babe06.jpg', '0', '1499065627', '1499085222', '0.00', null);
INSERT INTO `sp_goods` VALUES ('22', 'test1', '11.00', '11', '111', '0', '7777777777<br />', './Public/Upload/logo/2017-07-03/5959fe504471d.JPG', './Public/Upload/logo/2017-07-03/small_5959fe504471d.JPG', '0', '1499070032', '1499084889', '0.00', null);
INSERT INTO `sp_goods` VALUES ('23', 'qwer', '78527.00', '72', '725', '0', '啊山东尿酸钠<br />', './Public/Upload/logo/2017-07-03/595a3a5c53897.JPG', './Public/Upload/logo/2017-07-03/small_595a3a5c53897.JPG', '0', '1499085404', '1499085404', '0.00', null);
INSERT INTO `sp_goods` VALUES ('24', '大哥大', '1000.00', '10', '100', '1', 'big and cool<br />', './Public/Upload/logo/2017-07-08/59608ed87e39b.jpg', './Public/Upload/logo/2017-07-08/small_59608ed87e39b.jpg', '0', '1499477855', '1499514218', '0.00', null);
INSERT INTO `sp_goods` VALUES ('25', '从你的全世界路过', '27.00', '255', '10', '4', 'beautiful<br />', './Public/Upload/logo/2017-07-08/59608ecbe36ff.jpg', './Public/Upload/logo/2017-07-08/small_59608ecbe36ff.jpg', '0', '1499477970', '1499500236', '0.00', null);
INSERT INTO `sp_goods` VALUES ('26', '海王', '123456.00', '255', '321', '1', '厉害来花落谁家<br />', './Public/Upload/logo/2017-07-08/596078f7f22c4.jpg', './Public/Upload/logo/2017-07-08/small_596078f7f22c4.jpg', '0', '1499494648', '1499494648', '0.00', null);
INSERT INTO `sp_goods` VALUES ('27', '会员测试', '1000.00', '111', '111', '1', '', './Public/Upload/logo/2017-07-11/5964960eb1403.png', './Public/Upload/logo/2017-07-11/small_5964960eb1403.png', '0', '1499764239', '1499764239', '0.00', null);
INSERT INTO `sp_goods` VALUES ('29', '会员测试22', '2222.00', '240', '242', '1', '', './Public/Upload/logo/2017-07-11/5964b3a46f32f.jpg', './Public/Upload/logo/2017-07-11/small_5964b3a46f32f.jpg', '0', '1499771812', '1499771812', '0.00', null);
INSERT INTO `sp_goods` VALUES ('30', '会员测试333', '3333.00', '33', '33', '1', '', './Public/Upload/logo/2017-07-11/5964b3f56633e.jpg', './Public/Upload/logo/2017-07-11/small_5964b3f56633e.jpg', '0', '1499771893', '1499776933', '3000.00', null);
INSERT INTO `sp_goods` VALUES ('31', '会员测试1', '456.00', '4', '4', '1', '', './Public/Upload/logo/2017-07-11/5964b64519935.jpg', './Public/Upload/logo/2017-07-11/small_5964b64519935.jpg', '0', '1499772485', '1499772485', '455.00', null);

-- ----------------------------
-- Table structure for sp_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_attr`;
CREATE TABLE `sp_goods_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `attr_id` smallint(5) unsigned NOT NULL COMMENT '属性id',
  `attr_value` varchar(32) NOT NULL COMMENT '商品对应属性的值',
  PRIMARY KEY (`id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COMMENT='商品-属性关联表';

-- ----------------------------
-- Records of sp_goods_attr
-- ----------------------------
INSERT INTO `sp_goods_attr` VALUES ('44', '24', '4', '8G');
INSERT INTO `sp_goods_attr` VALUES ('43', '24', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('42', '24', '3', '折叠');
INSERT INTO `sp_goods_attr` VALUES ('41', '24', '3', '滑盖');
INSERT INTO `sp_goods_attr` VALUES ('40', '24', '3', '触屏');
INSERT INTO `sp_goods_attr` VALUES ('39', '24', '2', '897757');
INSERT INTO `sp_goods_attr` VALUES ('38', '24', '1', '黑色');
INSERT INTO `sp_goods_attr` VALUES ('26', '25', '10', '张嘉佳');
INSERT INTO `sp_goods_attr` VALUES ('25', '25', '9', '不知道');
INSERT INTO `sp_goods_attr` VALUES ('37', '24', '1', '红色');
INSERT INTO `sp_goods_attr` VALUES ('36', '24', '1', '蓝色');
INSERT INTO `sp_goods_attr` VALUES ('19', '26', '1', '黑色');
INSERT INTO `sp_goods_attr` VALUES ('20', '26', '1', '红色');
INSERT INTO `sp_goods_attr` VALUES ('21', '26', '2', '45689');
INSERT INTO `sp_goods_attr` VALUES ('22', '26', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('23', '26', '3', '折叠');
INSERT INTO `sp_goods_attr` VALUES ('24', '26', '4', '2222');
INSERT INTO `sp_goods_attr` VALUES ('45', '28', '1', '蓝色');
INSERT INTO `sp_goods_attr` VALUES ('46', '28', '1', '黑色');
INSERT INTO `sp_goods_attr` VALUES ('47', '28', '2', '123');
INSERT INTO `sp_goods_attr` VALUES ('48', '28', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('49', '28', '3', '折叠');
INSERT INTO `sp_goods_attr` VALUES ('50', '28', '4', '312');
INSERT INTO `sp_goods_attr` VALUES ('51', '29', '1', '黑色');
INSERT INTO `sp_goods_attr` VALUES ('52', '29', '1', '红色');
INSERT INTO `sp_goods_attr` VALUES ('53', '29', '2', '453');
INSERT INTO `sp_goods_attr` VALUES ('54', '29', '3', '折叠');
INSERT INTO `sp_goods_attr` VALUES ('55', '29', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('56', '29', '4', '453');
INSERT INTO `sp_goods_attr` VALUES ('74', '30', '4', '333');
INSERT INTO `sp_goods_attr` VALUES ('73', '30', '3', '滑盖');
INSERT INTO `sp_goods_attr` VALUES ('72', '30', '2', '33');
INSERT INTO `sp_goods_attr` VALUES ('71', '30', '1', '红色');
INSERT INTO `sp_goods_attr` VALUES ('61', '31', '1', '黑色');
INSERT INTO `sp_goods_attr` VALUES ('62', '31', '1', '蓝色');
INSERT INTO `sp_goods_attr` VALUES ('63', '31', '2', '42');
INSERT INTO `sp_goods_attr` VALUES ('64', '31', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('65', '31', '3', '翻盖');
INSERT INTO `sp_goods_attr` VALUES ('66', '31', '4', '42');

-- ----------------------------
-- Table structure for sp_goods_pics
-- ----------------------------
DROP TABLE IF EXISTS `sp_goods_pics`;
CREATE TABLE `sp_goods_pics` (
  `pics_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `pics_big` char(128) NOT NULL DEFAULT '' COMMENT '相册大图800*800',
  `pics_mid` char(128) NOT NULL DEFAULT '' COMMENT '相册中图350*350',
  `pics_sma` char(128) NOT NULL DEFAULT '' COMMENT '相册小图50*50',
  PRIMARY KEY (`pics_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='商品-相册关联表';

-- ----------------------------
-- Records of sp_goods_pics
-- ----------------------------
INSERT INTO `sp_goods_pics` VALUES ('14', '23', './Public/Upload/pics/2017-07-03/big_595a3a5c7a063.JPG', './Public/Upload/pics/2017-07-03/mid_595a3a5c7a063.JPG', './Public/Upload/pics/2017-07-03/sma_595a3a5c7a063.JPG');
INSERT INTO `sp_goods_pics` VALUES ('2', '21', './Public/Upload/pics/2017-07-03/big_5959ed1bcb384.jpg', './Public/Upload/pics/2017-07-03/mid_5959ed1bcb384.jpg', './Public/Upload/pics/2017-07-03/sma_5959ed1bcb384.jpg');
INSERT INTO `sp_goods_pics` VALUES ('3', '21', './Public/Upload/pics/2017-07-03/big_5959ed1bcd744.png', './Public/Upload/pics/2017-07-03/mid_5959ed1bcd744.png', './Public/Upload/pics/2017-07-03/sma_5959ed1bcd744.png');
INSERT INTO `sp_goods_pics` VALUES ('4', '22', './Public/Upload/pics/2017-07-03/big_5959fe5083899.JPG', './Public/Upload/pics/2017-07-03/mid_5959fe5083899.JPG', './Public/Upload/pics/2017-07-03/sma_5959fe5083899.JPG');
INSERT INTO `sp_goods_pics` VALUES ('13', '22', './Public/Upload/pics/2017-07-03/big_595a385812354.JPG', './Public/Upload/pics/2017-07-03/mid_595a385812354.JPG', './Public/Upload/pics/2017-07-03/sma_595a385812354.JPG');
INSERT INTO `sp_goods_pics` VALUES ('6', '22', './Public/Upload/pics/2017-07-03/big_5959fe5086a56.JPG', './Public/Upload/pics/2017-07-03/mid_5959fe5086a56.JPG', './Public/Upload/pics/2017-07-03/sma_5959fe5086a56.JPG');
INSERT INTO `sp_goods_pics` VALUES ('11', '22', './Public/Upload/pics/2017-07-03/big_595a38580fcec.JPG', './Public/Upload/pics/2017-07-03/mid_595a38580fcec.JPG', './Public/Upload/pics/2017-07-03/sma_595a38580fcec.JPG');
INSERT INTO `sp_goods_pics` VALUES ('15', '23', './Public/Upload/pics/2017-07-03/big_595a3a5c7b0e8.JPG', './Public/Upload/pics/2017-07-03/mid_595a3a5c7b0e8.JPG', './Public/Upload/pics/2017-07-03/sma_595a3a5c7b0e8.JPG');
INSERT INTO `sp_goods_pics` VALUES ('16', '23', './Public/Upload/pics/2017-07-03/big_595a3a5c7c0a0.JPG', './Public/Upload/pics/2017-07-03/mid_595a3a5c7c0a0.JPG', './Public/Upload/pics/2017-07-03/sma_595a3a5c7c0a0.JPG');
INSERT INTO `sp_goods_pics` VALUES ('17', '23', './Public/Upload/pics/2017-07-03/big_595a3a5c7d070.JPG', './Public/Upload/pics/2017-07-03/mid_595a3a5c7d070.JPG', './Public/Upload/pics/2017-07-03/sma_595a3a5c7d070.JPG');
INSERT INTO `sp_goods_pics` VALUES ('18', '26', './Public/Upload/pics/2017-07-08/big_596078f833abd.jpg', './Public/Upload/pics/2017-07-08/mid_596078f833abd.jpg', './Public/Upload/pics/2017-07-08/sma_596078f833abd.jpg');
INSERT INTO `sp_goods_pics` VALUES ('19', '26', './Public/Upload/pics/2017-07-08/big_596078f83530e.JPG', './Public/Upload/pics/2017-07-08/mid_596078f83530e.JPG', './Public/Upload/pics/2017-07-08/sma_596078f83530e.JPG');
INSERT INTO `sp_goods_pics` VALUES ('20', '26', './Public/Upload/pics/2017-07-08/big_596078f8368e2.JPG', './Public/Upload/pics/2017-07-08/mid_596078f8368e2.JPG', './Public/Upload/pics/2017-07-08/sma_596078f8368e2.JPG');
INSERT INTO `sp_goods_pics` VALUES ('21', '26', './Public/Upload/pics/2017-07-08/big_596078f837b1d.JPG', './Public/Upload/pics/2017-07-08/mid_596078f837b1d.JPG', './Public/Upload/pics/2017-07-08/sma_596078f837b1d.JPG');
INSERT INTO `sp_goods_pics` VALUES ('22', '24', './Public/Upload/pics/2017-07-08/big_5960c5691d5eb.jpg', './Public/Upload/pics/2017-07-08/mid_5960c5691d5eb.jpg', './Public/Upload/pics/2017-07-08/sma_5960c5691d5eb.jpg');
INSERT INTO `sp_goods_pics` VALUES ('23', '24', './Public/Upload/pics/2017-07-08/big_5960c5691e1a6.jpg', './Public/Upload/pics/2017-07-08/mid_5960c5691e1a6.jpg', './Public/Upload/pics/2017-07-08/sma_5960c5691e1a6.jpg');
INSERT INTO `sp_goods_pics` VALUES ('24', '24', './Public/Upload/pics/2017-07-08/big_5960c569221c5.jpg', './Public/Upload/pics/2017-07-08/mid_5960c569221c5.jpg', './Public/Upload/pics/2017-07-08/sma_5960c569221c5.jpg');
INSERT INTO `sp_goods_pics` VALUES ('25', '24', './Public/Upload/pics/2017-07-08/big_5960c56922d39.jpg', './Public/Upload/pics/2017-07-08/mid_5960c56922d39.jpg', './Public/Upload/pics/2017-07-08/sma_5960c56922d39.jpg');
INSERT INTO `sp_goods_pics` VALUES ('26', '24', './Public/Upload/pics/2017-07-08/big_5960c56923774.jpg', './Public/Upload/pics/2017-07-08/mid_5960c56923774.jpg', './Public/Upload/pics/2017-07-08/sma_5960c56923774.jpg');
INSERT INTO `sp_goods_pics` VALUES ('27', '24', './Public/Upload/pics/2017-07-08/big_5960c56924022.jpg', './Public/Upload/pics/2017-07-08/mid_5960c56924022.jpg', './Public/Upload/pics/2017-07-08/sma_5960c56924022.jpg');
INSERT INTO `sp_goods_pics` VALUES ('28', '24', './Public/Upload/pics/2017-07-08/big_5960c569249ad.jpg', './Public/Upload/pics/2017-07-08/mid_5960c569249ad.jpg', './Public/Upload/pics/2017-07-08/sma_5960c569249ad.jpg');
INSERT INTO `sp_goods_pics` VALUES ('29', '24', './Public/Upload/pics/2017-07-08/big_5960c5692525e.jpg', './Public/Upload/pics/2017-07-08/mid_5960c5692525e.jpg', './Public/Upload/pics/2017-07-08/sma_5960c5692525e.jpg');
INSERT INTO `sp_goods_pics` VALUES ('30', '28', './Public/Upload/pics/2017-07-11/big_59649871160b8.jpg', './Public/Upload/pics/2017-07-11/mid_59649871160b8.jpg', './Public/Upload/pics/2017-07-11/sma_59649871160b8.jpg');
INSERT INTO `sp_goods_pics` VALUES ('31', '28', './Public/Upload/pics/2017-07-11/big_5964987117516.jpg', './Public/Upload/pics/2017-07-11/mid_5964987117516.jpg', './Public/Upload/pics/2017-07-11/sma_5964987117516.jpg');
INSERT INTO `sp_goods_pics` VALUES ('32', '29', './Public/Upload/pics/2017-07-11/big_5964b3a488f7a.jpg', './Public/Upload/pics/2017-07-11/mid_5964b3a488f7a.jpg', './Public/Upload/pics/2017-07-11/sma_5964b3a488f7a.jpg');
INSERT INTO `sp_goods_pics` VALUES ('33', '30', './Public/Upload/pics/2017-07-11/big_5964b3f582fa4.jpg', './Public/Upload/pics/2017-07-11/mid_5964b3f582fa4.jpg', './Public/Upload/pics/2017-07-11/sma_5964b3f582fa4.jpg');
INSERT INTO `sp_goods_pics` VALUES ('34', '30', './Public/Upload/pics/2017-07-11/big_5964b3f58524f.jpg', './Public/Upload/pics/2017-07-11/mid_5964b3f58524f.jpg', './Public/Upload/pics/2017-07-11/sma_5964b3f58524f.jpg');
INSERT INTO `sp_goods_pics` VALUES ('35', '31', './Public/Upload/pics/2017-07-11/big_5964b6453cb1d.jpg', './Public/Upload/pics/2017-07-11/mid_5964b6453cb1d.jpg', './Public/Upload/pics/2017-07-11/sma_5964b6453cb1d.jpg');

-- ----------------------------
-- Table structure for sp_manager
-- ----------------------------
DROP TABLE IF EXISTS `sp_manager`;
CREATE TABLE `sp_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `mg_name` varchar(32) NOT NULL COMMENT '名称',
  `mg_pwd` varchar(32) NOT NULL COMMENT '密码',
  `mg_time` int(10) unsigned NOT NULL COMMENT '注册时间',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of sp_manager
-- ----------------------------
INSERT INTO `sp_manager` VALUES ('500', 'linken', 'e10adc3949ba59abbe56e057f20f883e', '1499218726', '30');
INSERT INTO `sp_manager` VALUES ('501', 'tom', 'e10adc3949ba59abbe56e057f20f883e', '1499218727', '31');
INSERT INTO `sp_manager` VALUES ('502', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1499218727', '0');

-- ----------------------------
-- Table structure for sp_member_level
-- ----------------------------
DROP TABLE IF EXISTS `sp_member_level`;
CREATE TABLE `sp_member_level` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `level_rate` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '折扣率，100=10折 98=9.8折 90=9折，用时除100',
  `point_bottom` mediumint(8) unsigned NOT NULL COMMENT '积分下限',
  `point_top` mediumint(8) unsigned NOT NULL COMMENT '积分上限',
  `flag` int(1) NOT NULL DEFAULT '1' COMMENT '1正常 0删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='会员级别';

-- ----------------------------
-- Records of sp_member_level
-- ----------------------------
INSERT INTO `sp_member_level` VALUES ('14', '普通会员', '100', '0', '5000', '1');
INSERT INTO `sp_member_level` VALUES ('15', '黄金会员', '98', '5001', '10000', '1');
INSERT INTO `sp_member_level` VALUES ('16', '白金会员', '95', '10001', '30000', '1');
INSERT INTO `sp_member_level` VALUES ('17', '钻石会员', '90', '30001', '70000', '1');
INSERT INTO `sp_member_level` VALUES ('18', '尊享会员', '88', '70001', '150000', '1');
INSERT INTO `sp_member_level` VALUES ('19', '至尊会员', '85', '150001', '1000000', '1');

-- ----------------------------
-- Table structure for sp_member_price
-- ----------------------------
DROP TABLE IF EXISTS `sp_member_price`;
CREATE TABLE `sp_member_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `level_id` tinyint(3) unsigned NOT NULL COMMENT '级别id',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  KEY `goods_id` (`goods_id`),
  KEY `level_id` (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员价格';

-- ----------------------------
-- Records of sp_member_price
-- ----------------------------
INSERT INTO `sp_member_price` VALUES ('28', '14', '1000.00');
INSERT INTO `sp_member_price` VALUES ('28', '15', '966.00');
INSERT INTO `sp_member_price` VALUES ('28', '16', '955.00');
INSERT INTO `sp_member_price` VALUES ('28', '17', '944.00');
INSERT INTO `sp_member_price` VALUES ('28', '18', '933.00');
INSERT INTO `sp_member_price` VALUES ('28', '19', '888.00');
INSERT INTO `sp_member_price` VALUES ('29', '14', '2222.00');
INSERT INTO `sp_member_price` VALUES ('29', '15', '2111.00');
INSERT INTO `sp_member_price` VALUES ('29', '16', '2000.00');
INSERT INTO `sp_member_price` VALUES ('29', '17', '1999.00');
INSERT INTO `sp_member_price` VALUES ('29', '18', '1888.00');
INSERT INTO `sp_member_price` VALUES ('29', '19', '1777.00');
INSERT INTO `sp_member_price` VALUES ('30', '14', '3000.00');
INSERT INTO `sp_member_price` VALUES ('30', '15', '2888.00');
INSERT INTO `sp_member_price` VALUES ('30', '16', '2777.00');
INSERT INTO `sp_member_price` VALUES ('30', '17', '2666.00');
INSERT INTO `sp_member_price` VALUES ('30', '18', '2555.00');
INSERT INTO `sp_member_price` VALUES ('30', '19', '2333.00');

-- ----------------------------
-- Table structure for sp_order
-- ----------------------------
DROP TABLE IF EXISTS `sp_order`;
CREATE TABLE `sp_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT '下订单会员id',
  `order_number` varchar(32) NOT NULL COMMENT '订单编号',
  `order_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `order_pay` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '支付方式 0支付宝 1微信  2银行卡',
  `order_invoice_title` enum('0','1') NOT NULL DEFAULT '0' COMMENT '发票抬头 0个人 1公司',
  `order_invoice_company` varchar(32) NOT NULL DEFAULT '' COMMENT '公司名称',
  `order_invoice_content` varchar(32) NOT NULL DEFAULT '' COMMENT '发票内容',
  `cgn_id` int(10) unsigned NOT NULL COMMENT 'consignee收货人地址-外键',
  `order_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '订单状态： 0未付款、1已付款',
  `add_time` int(10) unsigned NOT NULL COMMENT '记录生成时间',
  `upd_time` int(10) unsigned NOT NULL COMMENT '记录修改时间',
  `is_send` enum('是','否') NOT NULL DEFAULT '否' COMMENT '订单是否已经发货',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `cgn_id` (`cgn_id`),
  KEY `add_time` (`add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of sp_order
-- ----------------------------
INSERT INTO `sp_order` VALUES ('1', '224', 'itshop-20170712180303-8561', '6910.00', '', '0', '', '明细', '3', '0', '1499853783', '1499853783', '否');
INSERT INTO `sp_order` VALUES ('2', '224', 'itshop-20170712180401-2213', '9299.60', '0', '0', '', '明细', '1', '1', '1499853841', '1499853841', '否');

-- ----------------------------
-- Table structure for sp_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `sp_order_goods`;
CREATE TABLE `sp_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `order_id` int(10) unsigned NOT NULL COMMENT '订单id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `goods_number` tinyint(4) NOT NULL DEFAULT '1' COMMENT '购买单个商品数量',
  `goods_total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品小计价格',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品订单关联表';

-- ----------------------------
-- Records of sp_order_goods
-- ----------------------------
INSERT INTO `sp_order_goods` VALUES ('1', '1', '30', '3000.00', '2', '6000.00');
INSERT INTO `sp_order_goods` VALUES ('2', '1', '31', '455.00', '2', '910.00');
INSERT INTO `sp_order_goods` VALUES ('3', '2', '29', '2000.00', '4', '8000.00');
INSERT INTO `sp_order_goods` VALUES ('4', '2', '31', '433.20', '3', '1299.60');

-- ----------------------------
-- Table structure for sp_role
-- ----------------------------
DROP TABLE IF EXISTS `sp_role`;
CREATE TABLE `sp_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作,控制器-操作,控制器-操作',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sp_role
-- ----------------------------
INSERT INTO `sp_role` VALUES ('30', '主管', '101,104,105,106,102,107,108,109', 'Goods-showlist,Goods-tianjia,Category-showlist,Order-showlist,Order-dayin,Order-tianjia');
INSERT INTO `sp_role` VALUES ('31', '经理', '102,107,108', 'Order-showlist,Order-dayin');

-- ----------------------------
-- Table structure for sp_type
-- ----------------------------
DROP TABLE IF EXISTS `sp_type`;
CREATE TABLE `sp_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type_name` varchar(32) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='类型表';

-- ----------------------------
-- Records of sp_type
-- ----------------------------
INSERT INTO `sp_type` VALUES ('1', '精品手机');
INSERT INTO `sp_type` VALUES ('2', '音乐');
INSERT INTO `sp_type` VALUES ('3', '电影');
INSERT INTO `sp_type` VALUES ('4', '书');

-- ----------------------------
-- Table structure for sp_user
-- ----------------------------
DROP TABLE IF EXISTS `sp_user`;
CREATE TABLE `sp_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '登录名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `user_email` varchar(64) NOT NULL DEFAULT '' COMMENT '邮箱',
  `is_active` enum('激活','未激活') NOT NULL DEFAULT '未激活' COMMENT '账号是否激活',
  `active_code` char(15) NOT NULL DEFAULT '' COMMENT '激活校验码',
  `user_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别',
  `user_qq` varchar(32) NOT NULL DEFAULT '' COMMENT 'qq',
  `user_tel` varchar(32) NOT NULL DEFAULT '' COMMENT '手机',
  `user_xueli` tinyint(4) NOT NULL DEFAULT '1' COMMENT '学历',
  `user_hobby` varchar(32) NOT NULL DEFAULT '' COMMENT '爱好',
  `user_introduce` text COMMENT '简介',
  `user_time` int(11) DEFAULT NULL,
  `last_time` int(11) NOT NULL DEFAULT '0',
  `flag` tinyint(1) DEFAULT '1' COMMENT '状态 0 注销 1正常 2冻结 3永久冻结',
  `blocked_time` int(11) DEFAULT NULL COMMENT '冻结时间',
  `points` int(11) NOT NULL DEFAULT '0',
  `wb_id` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of sp_user
-- ----------------------------
INSERT INTO `sp_user` VALUES ('125', 'trump5', 'e10adc3949ba59abbe56e057f20f883e', 'mp@163.com', '未激活', '', '1', '231354654', '', '1', '', '', null, '0', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('133', 'jack', 'e10adc3949ba59abbe56e057f20f883e', 'jack@qq.com', '激活', '', '3', '1234987', '', '0', '', null, null, '0', '2', '1499821878', '0', null);
INSERT INTO `sp_user` VALUES ('224', 'jim', 'e10adc3949ba59abbe56e057f20f883e', 'jim@163.com', '激活', '', '3', '2233454', '', '0', '', null, null, '0', '1', null, '20000', null);
INSERT INTO `sp_user` VALUES ('226', 'bier', 'e10adc3949ba59abbe56e057f20f883e', 'bier@sohu.com', '激活', '', '3', '224234324', '13899062356', '0', '', null, null, '0', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('227', 'aobama', 'e10adc3949ba59abbe56e057f20f883e', 'aobama@sohu.com', '激活', '', '3', '8276382638', '', '0', '', null, null, '0', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('228', 'trump', 'e10adc3949ba59abbe56e057f20f883e', 'trump@163.com', '未激活', '', '3', '23628322', '', '0', '', null, null, '0', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('229', 'jerry', 'e10adc3949ba59abbe56e057f20f883e', '', '未激活', '', '1', '', '18699680821', '1', '', null, '1500023669', '1500023669', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('230', 'mack', 'e10adc3949ba59abbe56e057f20f883e', '530727829@qq.com', '未激活', '', '1', '', '18699680821', '1', '', null, '1500025042', '1500025042', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('231', 'mary', 'ab233b682ec355648e7891e66c54191b', '530727829@qq.com', '未激活', '', '1', '', '18699680821', '1', '', null, '1500025483', '1500025483', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('232', 'mary', 'ab233b682ec355648e7891e66c54191b', '530727829@qq.com', '激活', '', '1', '', '18699680821', '1', '', null, '1500025558', '1500025558', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('233', 'mary', 'ab233b682ec355648e7891e66c54191b', '530727829@qq.com', '未激活', '', '1', '', '18699680821', '1', '', null, '1500025584', '1500025584', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('234', 'mark', '202cb962ac59075b964b07152d234b70', '530727829@qq.com', '未激活', '8427e1500026702', '1', '', '18699680821', '1', '', null, '1500026702', '1500026702', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('235', 'app', '202cb962ac59075b964b07152d234b70', '530727829@qq.com', '激活', '', '1', '', '18699680821', '1', '', null, '1500026842', '1500026842', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('238', '123456789', 'e10adc3949ba59abbe56e057f20f883e', '', '未激活', '', '1', '', '', '1', '', null, '1500684860', '1500684860', '1', null, '0', null);
INSERT INTO `sp_user` VALUES ('239', '456789', 'e10adc3949ba59abbe56e057f20f883e', '', '未激活', '', '1', '', '', '1', '', null, '1500684934', '1500684934', '1', null, '0', null);
