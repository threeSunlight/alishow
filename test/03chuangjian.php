<?php

/**
 * @Author: 王斌晶
 * @Date:   2017-11-07 08:25:43
 * @Last Modified by:   王斌晶
 * @Last Modified time: 2017-11-07 08:57:26
 */
//创建一个表格
//
create table ali_member1(
	member_id int  unsigned  auto_increment primary key,
	member_id int(10) unsigned auto_increment primary key,
	member_id  int(10) unsigned auto_increment primary key,
	member_name int(10) unique not null comment '会员名',
	member_name int(10) unique not null  comment '会员昵称',
	member_nickname varchar(20) not null unique comment '会员昵称',
	membet_pwd char(30) not null comment '会员密码',
)engine=myisam default charset=utf-8;