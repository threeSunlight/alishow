<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 11:02:58
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受前台穿过的来的数据
$id=$_POST['id'];
$icon=$_POST['icon'];
$slug=$_POST['slug'];
$class=$_POST['class'];
$state=$_POST['state'];
$show=$_POST['show'];
//2.连接数据库
include_once('../include/include.php');
//3.编写sql语句并且执行sql语句
$sql ="update ali_cate set cate_name='$icon',cate_slug='$slug',cate_class='$class',cate_state='$state',cate_show='$show' where cate_id='$id'";
$ros=mysql_query($sql);
//4.根据结果显示修改成功/失败,并跳转
if($ros){
	echo "修改成功";
	header('Refresh:2;url=categories.php');
}else{
	echo "修改失败";
	header('Refresh:2;url=categories.php?id='.$id);
}
