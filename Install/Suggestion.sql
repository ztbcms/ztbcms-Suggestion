DROP TABLE IF EXISTS `cms_suggestion`;

CREATE TABLE `cms_suggestion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '发布人ID',
  `area_province` varchar(16) NOT NULL DEFAULT '' COMMENT '所属省',
  `area_city` varchar(16) NOT NULL DEFAULT '' COMMENT '所属市',
  `area_district` varchar(16) NOT NULL DEFAULT '' COMMENT '所属区',
  `suggest_object` varchar(64) NOT NULL DEFAULT '' COMMENT '投诉建议对象',
  `suggest_object_id` int(11) NOT NULL COMMENT '投诉建议关联ID',
  `suggest_reason` varchar(512) NOT NULL DEFAULT '' COMMENT '投诉原因',
  `contact_phone` varchar(64) NOT NULL DEFAULT '' COMMENT '联系人电话',
  `contact_name` varchar(64) NOT NULL DEFAULT '' COMMENT '联系人',
  `images` text NOT NULL COMMENT '关联图片',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `cms_suggestion_config`;

CREATE TABLE `cms_suggestion_config` (
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_phone` varchar(32) DEFAULT NULL COMMENT '联系电话',
  `enable_contact_phone` tinyint(1) DEFAULT NULL COMMENT '是否启用联系电话 0/1 否/是',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='投诉配置';