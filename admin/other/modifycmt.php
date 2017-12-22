<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-06 14:50:33
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");

//接受前台发送的时间
$id=$_POST['id'];
$state=$_POST['state'];
//2.连接数据库
include_once '../include/include.php';
//3.编写修改状态的sql语句
$sql="update ali_comment set cmt_state='$state' where cmt_id=$id";
//4.执行结果是一个结果集,只有true和false 所以不需要进行判断对和错
$res=mysql_query($sql);

//5.判断结果返回数据
if($res){
	echo 1;
}else {
	echo 2;
}
?>
