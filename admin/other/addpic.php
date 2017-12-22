<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-06 17:06:12
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受前台传过来的信息
$text=$_POST['text'];
$link1=$_POST['link'];


//2.接受上传的图片
if($_FILES['image']['error']==0){
	//计算文件名和保存路径
	$ext = strrchr($_FILES['image']['name'],'.');
	$path="../uploads/".time().mt_rand().$ext;
	move_uploaded_file($_FILES['image']['tmp_name'], $path);
}else{
	echo "图片上传错误";
	header('Refresh :2;url=sildes.php');
	die;
}
//3.连接数据库
include_once '../include/include.php';


//4.拼接sql语句
$sql="insert into ali_pic values
(null,'$path','$text','$link1','不显示')";
$res =mysql_query($sql);

//5.提示结果成功/失败,在跳转
if($res){
	echo "添加成功图片";
	header('Refresh:2;url=sildes.php');
}else{
	echo "添加图片失败";
	header('Refresh:2;url=sildes.php');
}
?>
