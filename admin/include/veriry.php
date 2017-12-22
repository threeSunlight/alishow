<?php

/**
 * @Author: 王斌晶
 * @Date:   2017-11-03 14:33:59
 * @Last Modified by:   王斌晶
 * @Last Modified time: 2017-11-03 20:42:02
 */
header("content-type:image/png;");
//1.产生4位数字字母缓和的字符串

$str="2345678abcdefhjkmnABCDEFGHIMLKN";
$code='';
for( $i=0;$i<4;$i ++){
	$code.=$str[mt_rand(0,strlen($str)-1)];

}
//将验证码保存到session中
session_start();
$_SESSION['code']=$code;
//echo $code;
//1.创建一个画布
$img=imagecreatetruecolor(90,30);
//2.创建画笔
$green=imagecolorallocate($img,0,255,0);
//3.填充画布颜色
imagefill($img,0,0,$green);
//4.绘图
//绘制字符串的专用函数
//angle 随机角度

for( $i=0;$i<4;$i++){
	imagettftext(
		$img, 
		rand(15,25), 
		rand(-30,30),
		 10+($i*20), 
		 25,  
		imagecolorallocate($img,rand(0,255),rand(0,100),rand(0,255)),
		'ARLRDBD.TTF', 	
		 $code[$i]	
	);
}

//5.显示画布
imagepng($img);
//6.销毁画布
imagedestroy($img);

// imagettftext(image, size, angle, x, y, color, fontfile, text)
// imagecolorallocate(image, red, green, blue)