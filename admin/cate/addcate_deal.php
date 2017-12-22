<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-10-31 21:04:13
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");

//接受前台传来的数据进行接受
$icon=$_POST['icon'];
$slug=$_POST['slug'];
$class=$_POST['class'];
$state=$_POST['state'];
$show=$_POST['show'];

//连接数据库进行数据的整理
//连接数据库
 include_once "../include/include.php";
 //编写SQL语句
 $sql="insert into ali_cate values 
 (null,'$icon','$slug','$class','$state','$show')";
 //让sql语句进行展示
 $res=mysql_query($sql);
// echo $res;
//下面就是判断值能不能进行成功返回
//进行判断语句的执行
if($res){
	echo "添加分类成功";
	header("Refresh:2;url=categories.php");
}else{
	echo "添加分类失败";
	header('Refresh:2;url=add.php');
}