<?php

/**
 * @Author: 王斌晶
 * @Date:   2017-10-31 18:58:57
 * @Last Modified by:   王斌晶
 * @Last Modified time: 2017-10-31 20:23:50
 */
header("content-type:text/html;charset=utf-8");
//连接数据库
$link=mysql_connect('localhost','root','root');
mysql_query("set names utf8");
mysql_query("use alishow");
