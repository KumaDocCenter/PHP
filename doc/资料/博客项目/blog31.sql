
drop database blog31;
create database blog31;

#############用户表：
CREATE TABLE `bg_user` (
  `id` int unsigned auto_increment,
  `acc` varchar(50) not null default '' COMMENT '帐号',
  `nickname` varchar(30) not null default '' COMMENT '昵称',
  `pwd` char(32) not null default '' COMMENT '密码',
  `cell` varchar(15) not null default '' COMMENT '手机号',
  `regtime` int unsigned default 0 COMMENT '注册时间',
  `type` tinyint unsigned not null default 0 COMMENT '用户类型 0:普通用户 1:管理员',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=utf8;

#############博客文章表：
CREATE TABLE `bg_article` (
  `id` int(11) unsigned AUTO_INCREMENT,
  `title` varchar(100) not null default '' COMMENT '文章标题',
  `intro` varchar(255) not null default '' COMMENT '文章简介',
  `content` text not null,
  `post_date` int unsigned not null default 0 COMMENT '发布时间',
  `user_id` int unsigned not null default 0 COMMENT '发布管理员id',
  `user_nickname` varchar(30) not null default '' COMMENT '发布管理员昵称',
  `comment_num` smallint unsigned not null default 0 COMMENT '评论数量',
  `cat_id` int unsigned not null default 0 COMMENT '所属分类id',
  `cat_name` varchar(30) not null default '' COMMENT '所属分类名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=utf8;

#############博客文章分类表：
CREATE TABLE `bg_category` (
  `id` int unsigned AUTO_INCREMENT,
  `name` varchar(30) not null COMMENT '分类名称',
  `parent_id` int unsigned not null default '0' COMMENT '上级分类ID，0表示顶级分类',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=utf8;


#############评论表：
CREATE TABLE `bg_comment` (
  `id` int unsigned AUTO_INCREMENT,
  `content` text not null,
  `post_date` int unsigned not null default 0 COMMENT '评论时间',
  `article_id` int unsigned not null default 0 COMMENT '所属文章ID',
  `article_title` varchar(50)  not null default '' COMMENT '所属文章标题',
  `user_id` int unsigned not null default 0 COMMENT '用户ID',
  `user_nickname` varchar(30)  not null default '' COMMENT '用户昵称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARSET=utf8;
