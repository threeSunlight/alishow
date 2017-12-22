<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-06 10:34:00
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受前面传过来的信息 进行接受表单数据
$id=$_POST['id'];//通过隐藏域传过来不的值
$title=$_POST['title'];
$content=$_POST['content'];
$slug=$_POST['slug'];
$category=$_POST['category'];
$status = $_POST['status'];

//2.特殊数据不全
$desc =substr($content,0,100);//截取摘要 截取100个
$updtime=time();
//根据post_id查询原来数据库中源文件的图片的路径进行修改和保存
//所以要连接数据库
include_once '../include/include.php';
//编写sql语句
$sql="select post_file from ali_post where post_id=$id";
//因为是资源结果型所以要进行展示
$res=mysql_query($sql);
$arr=mysql_fetch_assoc($res);
//定义原来的路径不能和下面路径的名字相同防止出现错误
$oldpath=$arr['post_file'];

//3.处理图片上传判断有没有图片上传
$path='';//定义一个空的路径
if($_FILES['feature']['error']==0){
	//有上传文件
	$ext=strrchr($_FILES['feature']['name'], '.');
	//定义路径放置重名
	$path='../uploads/'.time().mt_rand(100,999).$ext;
	//有文件上传并且移动到永久的目录
	move_uploaded_file($_FILES['feature']['tmp_name'], $path);
	//删除原来的图片
	//参数:要删除图片的路径
	unlink($oldpath);
}else{
	$path=$oldpath;
}


//4.修改数据表 并且返回给前台
$sql="update ali_post set  post_title='$title',post_desc='$desc',post_slug='$slug',post_updtime=$updtime,post_cateid='$category' ,post_file='$path' where post_id=$id";
 
//5.执行这个结果 因为是资源结果行所以有true 和false
$res=mysql_query($sql);
// echo $sql;

                             
//6.进行判断结果  输出失败还是成功
if($res){
	echo "文章修改成功";
	header('Refresh :2 ;url=posts.php');
}else{
	echo "修改文章失败";
	header('Refresh :2 ;url=editposts.php?id ='.$id);
}            
?>