<?php
header("content-type:text/html;charset=utf-8");
//检测是否存在session
session_start();
if(empty($_SESSION['id'])){
	//判断session 是否有id,如果没有则说明是跳墙访问
	echo "请您先登录,在访问当前页面";
	header('Refresh :2;url=../login.html');
	die;
}
