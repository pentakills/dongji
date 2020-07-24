UPDATE `ey_quickentry` SET `action` = 'api_conf', `title` = '接口配置', `laytext` = '接口配置' WHERE `controller` = 'System' AND `action` = 'smtp';

CREATE TABLE `ey_media_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aid` int(10) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `content` longtext COMMENT '内容详情',
  `courseware` varchar(200) NOT NULL DEFAULT '' COMMENT '课件地址',
  `courseware_free` enum('免费','收费') NOT NULL DEFAULT '免费' COMMENT '课件收费',
  `total_duration` int(10) NOT NULL DEFAULT '0' COMMENT '视频总时长',
  `total_video` int(10) NOT NULL DEFAULT '0' COMMENT '视频数',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='视频附加表';

DROP TABLE IF EXISTS `ey_media_file`;
CREATE TABLE `ey_media_file` (
  `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '视频模型文件表',
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '文档标题',
  `file_name` varchar(200) NOT NULL DEFAULT '' COMMENT '文件名称',
  `file_title` varchar(200) NOT NULL DEFAULT '' COMMENT '选集标题',
  `file_url` varchar(255) NOT NULL DEFAULT '' COMMENT '存储路径',
  `file_time` int(8) NOT NULL DEFAULT '0' COMMENT '文件时长',
  `file_ext` varchar(50) NOT NULL DEFAULT '' COMMENT '文件后缀名',
  `file_size` varchar(255) NOT NULL DEFAULT '' COMMENT '文件大小',
  `file_mime` varchar(200) NOT NULL DEFAULT '' COMMENT '文件类型',
  `uhash` varchar(200) NOT NULL DEFAULT '' COMMENT '自定义的一种加密方式，用于视频播放的权限验证',
  `md5file` varchar(200) NOT NULL DEFAULT '' COMMENT 'md5_file加密，可以检测上传/播放的视频文件是否损坏',
  `is_remote` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否远程 1-远程',
  `playcount` int(10) NOT NULL DEFAULT '0' COMMENT '播放次数',
  `sort_order` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`file_id`) USING BTREE,
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='视频附件表';

DROP TABLE IF EXISTS `ey_media_log`;
CREATE TABLE `ey_media_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `users_id` int(10) DEFAULT '0' COMMENT '用户ID',
  `aid` int(10) DEFAULT '0' COMMENT '文档ID',
  `file_id` int(10) DEFAULT '0' COMMENT '视频ID',
  `ip` varchar(20) DEFAULT '' COMMENT 'ip',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`log_id`),
  KEY `file_id` (`file_id`,`aid`,`users_id`) USING BTREE,
  KEY `aid` (`aid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='视频日志表';

DROP TABLE IF EXISTS `ey_channelfield_log`;
CREATE TABLE `ey_channelfield_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '' COMMENT '字段名称',
  `channel_id` int(10) DEFAULT '0' COMMENT '模型ID',
  `dtype` varchar(32) DEFAULT '' COMMENT '字段类型',
  `add_time` int(11) DEFAULT '0' COMMENT '新增时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='自定义字段日志表';

DROP TABLE IF EXISTS `ey_pay_api_config`;
CREATE TABLE `ey_pay_api_config` (
  `pay_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付接口配置ID，自增',
  `pay_name` varchar(64) NOT NULL DEFAULT '' COMMENT '支付接口配置名称，微信支付，支付宝支付...',
  `pay_mark` varchar(64) NOT NULL DEFAULT '' COMMENT '支付接口配置标识，wechat，alipay...',
  `pay_info` text NOT NULL COMMENT '支付接口配置信息，数组以序列化存储',
  `pay_terminal` varchar(100) NOT NULL DEFAULT '' COMMENT '支付时的终端，暂时预留',
  `system_built` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否属于系统内置，0否，1是',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0=关闭，1=开启)',
  `lang` varchar(30) NOT NULL DEFAULT 'cn' COMMENT '语言标识',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='支付接口配置表';

DELETE FROM `ey_channeltype` WHERE `id` = '5';
INSERT INTO `ey_channeltype` (`id`, `nid`, `title`, `ntitle`, `table`, `ctl_name`, `status`, `ifsystem`, `is_repeat_title`, `is_release`, `is_litpic_users_release`, `is_del`, `sort_order`, `add_time`, `update_time`) VALUES ('5', 'media', '视频模型', '视频', 'media', 'Media', '0', '1', '1', '0', '1', '0', '5', '1509197711', '1564532747');
ALTER TABLE `ey_channeltype` ADD COLUMN `data`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '额外序列化存储数据' AFTER `is_litpic_users_release`;
UPDATE `ey_channeltype` SET `data` = '';
ALTER TABLE `ey_ui_config` MODIFY COLUMN `theme_style`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'pc' COMMENT '模板风格' AFTER `md5key`;
ALTER TABLE `ey_users_parameter` ADD COLUMN `is_reg`  tinyint(1) NULL DEFAULT 1 COMMENT '是否为注册表单，1为是，0为否' AFTER `is_required`;

DELETE FROM `ey_pay_api_config` WHERE `pay_id` IN ('1','2');
INSERT INTO `ey_pay_api_config` (`pay_id`, `pay_name`, `pay_mark`, `pay_info`, `pay_terminal`, `system_built`, `status`, `lang`, `add_time`, `update_time`) VALUES ('1', '微信支付', 'wechat', '', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', '1', '1', 'cn', '1590111253', '1590661409');
INSERT INTO `ey_pay_api_config` (`pay_id`, `pay_name`, `pay_mark`, `pay_info`, `pay_terminal`, `system_built`, `status`, `lang`, `add_time`, `update_time`) VALUES ('2', '支付宝支付', 'alipay', '', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}', '1', '1', 'cn', '1590111253', '1590662059');

ALTER TABLE `ey_tagindex` ADD COLUMN `seo_title`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'SEO标题' AFTER `typeid`;
ALTER TABLE `ey_tagindex` ADD COLUMN `seo_keywords`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT 'SEO关键词' AFTER `seo_title`;
ALTER TABLE `ey_tagindex` ADD COLUMN `seo_description`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'SEO描述' AFTER `seo_keywords`;
UPDATE `ey_tagindex` SET `seo_description` = '';