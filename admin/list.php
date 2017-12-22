<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-07 16:36:46
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <div class="header">
		<?php include_once 'include/left.php' ;?>
    </div>
    <div class="aside">
 	 <?php  include_once 'include/right.php' ;?>
    </div>
    <div class="content">
      <div class="panel new">
<?php 
//1.连接数据库
include_once 'include/include.php' ;

//接受cate_name 和 cate_id 
$name=$_GET['name'];
$id=$_GET['id'];
//2.编写$sql语句需要两个表格来进行连接和循环展示
$sql="SELECT post_id,post_title,post_desc,cate_name,user_nickname,post_addtime,post_good,post_file,post_click,num from ali_post p 
left join ali_cate c on p.post_cateid=c.cate_id
left join ali_user u on p.post_author=u.user_id
left join (SELECT cmt_postid,count(*) num from ali_comment group by cmt_postid) t on t.cmt_postid=p.post_id
where cate_id=$id 
limit 0,5";
//3.将结果展示位资源型
$post_res=mysql_query($sql);

?>
        <h3><?= $name ;?></h3>
        <div class="entry">
<?php  while($row=mysql_fetch_assoc($post_res)):?>
          <div class="head">
            <a href="other/detail.php?id=<?=$row['post_id'] ;?>"><?= $row['post_title'] ;?></a>
          </div>
          <div class="main">
            <p class="info">admin 发表于 <?=date('Y-m-d',$row['post_addtime'])  ;?></p>
            <p class="brief"><?= $row['post_desc'] ;?>/p>
            <p class="extra">
              <span class="reading">阅读<?= $row['post_click'] ;?></span>
              <span class="comment">评论 <?= $row['num'] ;?></span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?= $row['post_good'] ;?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/../<?= $row['post_file'] ;?>" alt="">
            </a>
          </div>
<?php   endwhile;?>
        </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>

