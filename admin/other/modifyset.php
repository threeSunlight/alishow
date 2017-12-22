<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-07 14:28:31
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");

//1.接受表单数据
$site_name=$_POST['site_name'];
$site_desc=$_POST['site_desc'];
$site_keys=$_POST['site_keys'];
$cmt_start=isset($_POST['cmt_start'])?$_POST['cmt_start']:0;
$cmt_sh=isset($_POST['$cmt_sh'])?$_POST['cmt_sh']:0;

//2.logo上传文件
$site_logo =$conf['site_logo'];
if($_FILES['site_logo']['error']==0){
	$ext=strrchr($_FILES['site_logo']['name'],'.');
	//计算上传文件的路径
	$site_logo_tmp=time().mt_rang(100,999).$ext;
	//判断文件是否上传成功
	if(move_uploaded_file($_FILES['site_logo']['tmp_name'],$site_logo_tmp)){
		//图片移动成功之后,将元图片删除
		unlink($site_logo);
		//将上传图片的路径赋值到$site_logo,因为之后写入文件的操作使用的$site_logo变量
		$site_logo=$site_logo_tmp;
	}
} 
//3.将数据协会到set.conf.php文件中
$fp=fopen('set.conf.php','w');
$str="<?php
return array(
	'site_logo' =>'111111.png',
	'site_name' =>'阿狸百秀网',
	'site_desc' =>'离别都是蓄谋已久,相遇都是漫不经心',
	'site_keys' =>'php,js,潮科技',
	'cmt_start' =>1,
	'cmt_sh'    =>0
);";
fwrite($fp,$str);
echo "修改网站配置成功";
header('Refresh :2;url=settings.php');



