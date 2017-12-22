<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-03 10:29:28
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//接受表单提供的数据
$id=$_POST['id'];
$email=$_POST['email'];
$slug=$_POST['slug'];
$nickname=$_POST['nickname'];
$pwd=$_POST['pwd'];
//2.连接数据库
include_once'../include/include.php';

//3.编写sql语句
$sql="update ali_user set user_email='$email',user_slug='$slug',user_nickname='$nickname',user_pwd='$pwd' where user_id='$id'";
//用资源结果型进行直接判断对和错  不用进行展示成为一维数组
$row=mysql_query($sql);
//$res=mysql_fetch_assoc($row);

//4.判断结果又返回结果
if($row){
	echo 1;
}else{
	echo 2;
}
