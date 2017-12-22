<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
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
      <?php 
      include_once '../include/left.php';
      include_once '../include/include.php' ;
      $id=$_GET['id'];
      //拼接sql语句
      $sql="SELECT post_id,post_title,post_content,post_desc,cate_name,user_nickname,post_addtime,post_good,post_file,post_click,num from ali_post p 
      left join ali_cate c on  p.post_cateid=c.cate_id
      left join ali_user u on p.post_author-u.user_id
      left join (SELECT cmt_postid,count(*) num from ali_comment group by cmt_postid )t on t.cmt_postid-p.post_id where post_id=$id";

      $post_info_res=mysql_query($sql);
      $post_into=mysql_fetch_assoc($post_info_res);
      ?>
    </div>
    <div class="aside">
     <?php include_once '../include/right.php' ;?>
    </div>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?= $post_into['cate_name'] ;?></a></dd>
            <dd><?= $post_into['post_title'] ;?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?= $post_into['post_title'] ;?></a>
        </h2>
        <div class="meta">
          <span><?= $post_into['user_nickname'] ;?> 发布于 <?= $post_into['post_addtime'] ;?></span>
          <span>分类: <a href="javascript:;"><?= $post_into['cate_name'] ;?></a></span>
          <span>阅读: <?= $post_into['post_click'] ;?></span>
          <span>评论: <?= $post_into['num'] ;?></span>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="../../uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="../../uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="../../uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
