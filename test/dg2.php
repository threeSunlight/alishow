<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-03 14:08:05
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.创建
//参数为长宽
$img=imagecreatetruecolor(200,200);
//2创建画笔
//三个参数  
//参数1 引入画布
//参数2 三原色的颜色
$red=imagecolorallocate($img, 255, 0, 0);
$blue= imagecolorallocate($img,0,255,0 );
$green= imagecolorallocate($img,0,0,255);
$black =imagecolorallocate($img,0,0,0);   
$white= imagecolorallocate($img,255,255,255);
//3.填充画布与颜色
//两个参数
//参数1: 画布资源
//参数2/3:起点范围  只要在画布范围之内                           
imagefill($img,0,0,$red);