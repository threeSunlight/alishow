<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-03 21:04:38
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//检查是否有sessin信息
include_once '../include/checksession.php';
//1.接受后台传过来的数据
$oldpwd=md5($_POST['oldpwd']);

//2.连接数据库进行数据的比较
//并且将数据进行改变
//执行sql语句
include_once '../include/include.php';
//3.编写SQL语句
$sql="select * from  ali_user where user_id=".$_SESSION['id'];
$res=mysql_query($sql);
//4.将资源转为一维数组
$user_into=mysql_fetch_assoc($res);
//5.判断旧密码是否和数据表中的密码一样
if($oldpwd!==$user_into['user_pwd']){
	echo "旧密码错误,请重新确认";
	header('Refresh:2;url=password-reset.php');
	die;
}else{
//验证两次新密码一致
	$newpwd=$_POST['newpwd'];
	$re=$_POST['re-newpwd'];
	if($newpwd!=$re){
		echo "两次新密码不一致";
		header('Refresh:2;url=password-reset.php');
		die;
	}else{
		//如果两个相等,则修改数据表
		$pwd=md5($newpwd);
		$sql="update ali_user set user_pwd='$pwd' where user_id=".$_SESSION['id'];
		$res=mysql_query($sql);
		if($res){
			echo "修改密码成功";
			header('Refresh: 2;url=profile.php');
			die;
		}else{
			echo "修改密码失败";
			header('Refresh:2;url=password-reset.php');
			die;
		}
	}
	
}
