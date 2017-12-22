<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 10:10:14
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受前台传过来的信息
$id=$_GET['id'];
//2.连接数据库
include_once('../include/include.php');
//3.编写sql语句并且执行sql语句
$sql="delete from ali_cate where cate_id=$id";
$row=mysql_query($sql);
//4.判断是否删除成功
if($row){
	echo "删除成功";
	header('Refresh:2; url=categories.php');
}else{
	echo "删除失败";
	header('Refresh:2; url=categories.php');
}
