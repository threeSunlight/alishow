<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <?php 
//1.引入SESSION缓存
  include_once 'checksession.php';
//2.连接数据库
include_once 'include.php';
//3.编写sql语句进行判断并且进行执行语句
$sql="select * from ali_user where user_id=".$_SESSION['id'];
//4.将结果展示成资源结果型
$rew=mysql_query($sql);
//5.将结果展示成一维数组
$row=mysql_fetch_assoc($rew);

  ?>

   <div class="profile">
      <img class="avatar" src="../../uploads/avatar.jpg">
      
      <h3 class="name"><?= $row['user_nickname'];?></h3>
    </div>
    <ul class="nav">
      <li class="active">
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li><a href="/admin/posts/posts.php">所有文章</a></li>
          <li><a href="/admin/post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.html"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="users.html"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="slides.html">图片轮播</a></li>
          <li><a href="settings.html">网站设置</a></li>
        </ul>
      </li>
    </ul>
</body>
</html>