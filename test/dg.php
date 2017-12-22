<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-03 11:28:25
 * @version $Id$
 */
header("content-type:image/png;charset=utf-8");
//.1.创建画布
//参数1/2:画布的宽高
//返回值:画布资源
$img=imagecreatetruecolor(200, 200);
//2.创建画笔
$red=imagecolorallocate($img, 255, 0, 0);
$green=imagecolorallocate($img, 0, 255, 0);
$blue=imagecolorallocate($img, 0, 0, 255);
$white=imagecolorallocate($img, 255, 255, 255);
$black=imagecolorallocate($img, 0, 0, 0);

//3.填充画布 颜色
////参数1:画布资源
//参数2/3:作弊熬点只要在画布范围之内即可
//参数4:画布的颜色
imagefill($img,0,0,$red);
//4.绘图---使用gd库提供的绘图函数
//参数1"画布资源
//参数2:文字大小1-5,超过5则显示最大为5 ;
//参数3/4:回执文字的起始坐标点
//参数5:绘制字符串
//参数6:绘制的字符串的颜色
imagestring($img,5,10,20,'abc',$green);
//参数1:画布资源
//参数2/3:起始的坐标点	左上角的点
//参数4:/5:结束的坐标点  右下角的点
//参数6:矩形的颜色
imagefilledrectangle($img, 50, 40, 90, 80, $white);
imagefilledarc($img, 100, 100, 100, 50, 0, 360, $black, IMG_ARC_PIE);
//5.显示或者保存这个图片(                         
//显示和保存只能二选其一 是互斥的)
//参数:画布资源
//保存的imgepng同时也设置最后的图片格式为png,另外有imagejpeg imagegif
//参数2:可选 图片保存的路径        如果设置保存路径则保存图片,如果没有设置参数2 则显示图片
imagepng($img);

//6.销毁画布资源
imagedestroy($img);
