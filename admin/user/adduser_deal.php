<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 21:45:09
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1收集表单数据
$email=$_POST['email'];
$slug=$_POST['slug'];
$nickname=$_POST['nickname'];
$password=md5($_POST['password']);
//2.连接mysql数据库
include_once '../include/include.php';
//3.编写添加用户的sql语句
$sql="insert into ali_user values
	(null,'$email','$slug','$nickname','$password','',2)";
$res=mysql_query($sql);
//4.判断结果
if($res&&!empty($email||$slug)){
	echo 1;
}else{
	echo 2;
}
?>