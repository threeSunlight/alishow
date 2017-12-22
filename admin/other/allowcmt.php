<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-06 15:57:19
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受前台传过来的数据是一个字符串
$ids=$_POST['ids'];
//2.连接数据库
include_once '../include/include.php' ;

//3.拼接sql语句
$sql ="update ali_comment set cmt_state='批准' where cmt_id in($ids)";
//4.执行这个sql语句
$res=mysql_query($sql);
//5.计算影响行数
//是一个资源结果类型 可以获取增删改的时间的获取函数
$num=mysql_affected_rows($link);

//6.听过修改的行数来判断进行修改的成功 如果他小于0就是修改失败
if($num>0){
	echo 1;
}else{
	echo 2;
}

?>
