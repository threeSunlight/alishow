<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-04 11:27:01
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
include_once '../include/checksession.php';
//接受表单数据
$title=$_POST['title'];
$content=$_POST['content'];
$slug=$_POST['slug'];
$category=$_POST['category'];
//能够将字符串的格式事件转换成时间戳
$created=strtotime($_POST['created']);
$status=$_POST['status'];
//2.手动上传数据
$uid=$_SESSION['id'];
$desc=substr($content,0,100);//截取的主要字符串关键字
$updime=$created;//修改时间等于发布时间
$click=mt_rand(300,500);//阅读事件
$good=mt_rand(100,300);//点赞事件
$bad=mt_rand(0,10);//猜事件
//3.文件上传
$path='';                   
if($_FILES['feature']['error']==0){
	//当有文件上传是,将该文件移动到永久文件目录admin/uploads;
	$ext=strrchr($_FILES['feature']['name'],'.');
	$path="../uploads".time().mt_rand(100,900).$ext;
	move_uploaded_file($_FILES['feature']['tmp_name'], $path);
}  


//4.连接数据库
include_once "../include/include.php";
//5.拼接SQL语句
$sql="insert into ali_post values
(null ,'$title','$slug','$desc','$content','$uid','$category','$path','$created','$updime',$click,'$good','$bad','$status')";
echo $sql;
//6.还行这个语句
$res=mysql_query($sql);

//7.进行判断
if($res){
	echo "添加成功";
	header('Refresh :2;url=posts.php');
}else{
	echo "添加失败";
	header('Refresh:2;url=addpost.php');
}                              

