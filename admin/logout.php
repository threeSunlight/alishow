<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-03 20:48:31
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.清除session
session_start();
session_destroy();
echo "退出成功";
//2.跳转到login.html页面
header('Refresh:2;url=login.html');
