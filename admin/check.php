<?php

/**
 * @Author: 王斌晶
 * @Date:   2017-11-03 15:52:14
 * @Last Modified by:   王斌晶
 * @Last Modified time: 2017-11-03 19:46:37
 */
header("content-type:text/html;charset=utf-8");
$code_user=$_POST['verify'];
//2.获取系统产生验证码
session_start();
$code_sys=$_SESSION['code'];
//3.判断用户输入的验证码和系统产生验证码是否一致
if(strtoupper($code_user)!=strtoupper($code_sys)){
	echo "验证码不正确";
	header('Refresh:2;url=login.html');
	die;
}

//4.接受用户名和密码
$email=$_POST['email'];
$pwd=md5($_POST['pwd']);
//.5连接数据可
include_once   'include/include.php';
//6.拼接sql语句并且执行
$sql="select * from ali_user where user_email='$email'";
$res=mysql_query($sql);
$user_info=mysql_fetch_assoc($res);


//8.判断用户是否为空
if(empty($user_info)){
	echo "用户名错误";
	header('Refresh:2;url=login.html');
	die;
}else{
	//如果不是为空 需要验证密码
	if($pwd==$user_info['user_pwd']){
		//如果相等则说明登录成功,要晶用户的重要信息保存到session当中
		$_SESSION['id']=$user_info['user_id'];
		$_SESSION['email']=$user_info['user_email'];
		$_SESSION['nickname']=$user_info['user_nickname'];
		echo "登录成功";
		header('Refresh:2;url=index.php');
	}else{
		//如果不相等说明密码错误
		echo "密码错误";
		header('Refresh:2;url=login.html');
		die;
	}
}
