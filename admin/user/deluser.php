<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 22:40:41
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");

//1.接受user+_id
$id=$_POST['id'];
//2.连接数据库
include_once '../include/include.php';
//编写删除的语句
$sql="delete from ali_user where user_id='$id'";
//将结果资源集进行展示
$res=mysql_query($sql);
//4.判断结果返回给前台
if($res){
	echo 1;
}else{
	echo 2;
}
