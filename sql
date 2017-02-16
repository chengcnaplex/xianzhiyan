//管理员表
CREATE TABLE IF NOT EXISTS `xzy_admin`(
    `uid` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `level` int(2) NOT NULL DEFAULT 1, 
    PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


INSERT INTO `xzy_admin`(`username` ,`password`,`level`) VALUES
('linchen','atuchen',3);


//管理员等级表
CREATE TABLE IF NOT EXISTS `xzy_admin_level_detail`(
    `level_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `level_name` varchar(255) NOT NULL,
    PRIMARY KEY (`level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


INSERT INTO `xzy_admin_level_detail`(`level_id` ,`level_name`) VALUES
(1,'超级管理员');

INSERT INTO `xzy_admin_level_detail`(`level_id` ,`level_name`) VALUES
(2,'管理员');


INSERT INTO `xzy_admin_level_detail`(`level_id` ,`level_name`) VALUES
(3,'会员');


//黑名单表
CREATE TABLE IF NOT EXISTS `xzy_blacklist`(
    `uid` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `zhifubao_id` varchar(255) ,
    `taobao_id` varchar(255) ,
    `phone_num` varchar(255), 
    `addr` varchar(255) , 
    `bad_behavior_id` int(2) NOT NULL DEFAULT 1,
    `bad_type_id` int(2) NOT NULL DEFAULT 1,
    `create_time` datetime DEFAULT NOW(),
    `admin_id` int(8),
    PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;


INSERT INTO `xzy_blacklist`(`zhifubao_id` ,`taobao_id` ,`phone_num`,`addr`,`bad_behavior_id` ,`bad_type_id` ,`admin_id`) VALUES
('l8233038888','18582828989','18582828989','莆田市涵江区白糖湖一枝花',2,1,1);

INSERT INTO `xzy_blacklist`(`zhifubao_id` ,`taobao_id` ,`phone_num`,`addr`,`bad_behavior_id` ,`bad_type_id` ,`admin_id`) VALUES
('l8233038887','18582828985','18582828983','莆田市涵江区白糖湖一枝花',2,1,1);





//恶意行径详情表
CREATE TABLE IF NOT EXISTS `xzy_badbehavior_info`(
    `bad_behavior_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `bad_behavior_detail` varchar(255) ,
    PRIMARY KEY (`bad_behavior_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

INSERT INTO `xzy_badbehavior_info`(`bad_behavior_id` ,`bad_behavior_detail`) VALUES
(1,'诈单');

INSERT INTO `xzy_badbehavior_info`(`bad_behavior_id` ,`bad_behavior_detail`) VALUES
(2,'差评买家');

INSERT INTO `xzy_badbehavior_info`(`bad_behavior_id` ,`bad_behavior_detail`) VALUES
(3,'可疑风险');



//恶意类目详情表
CREATE TABLE IF NOT EXISTS `xzy_badtype_info`(
    `bad_type_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `bad_type_detail` varchar(255) ,
    PRIMARY KEY (`bad_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

INSERT INTO `xzy_badtype_info`(`bad_type_id` ,`bad_type_detail`) VALUES
(1,'腕表');

INSERT INTO `xzy_badtype_info`(`bad_type_id` ,`bad_type_detail`) VALUES
(2,'包类');

INSERT INTO `xzy_badtype_info`(`bad_type_id` ,`bad_type_detail`) VALUES
(3,'鞋类');




linchen	超级管理员	 
	chengmz	管理员	 
	doudou	会员	


update xzy_admin set uid = 1 where username = 'linchen'
