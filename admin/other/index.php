<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-08 16:22:11
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
<!--引入左边的共享的菜单部分-->      
<?php  include_once '../include/left.php' ;?>
    </div>
    <div class="aside">
<!--引入右边的共享的菜单部分-->         
<?php  include_once '../include/right.php' ;?>     
    </div>
    <div class="content">
      <div class="swipe">
        <?php 
//1.连接数据库
include_once '../include/include.php' ;
//2.编写sql语句 他只查询一个表格中的语句因为是中间展示的一些内容,所以要ali_pic的表格 要有中间的内容和地址
//
$sql="select * from ali_pic where pic_state='显示'";
//3.将结果展现为资源结果集
$pic_res=mysql_query($sql);
?>
        <ul class="swipe-wrapper">
<!--要使用循环来使下面的内容全部循环的展示下面的内容中条件就是讲结果集展示位一维数组 -->

<?php while($pic_row=mysql_fetch_assoc($pic_res)) :?>        
          <li>
            <a href="<?= $pic_row['pic_link'] ;?>">
              <img src="<?= $pic_row['pic_path']  ;?>">
              <span><?= $pic_row['pic_title'] ;?></span>
            </a>
          </li>
<?php endwhile ;?>
        </ul>
        <p class="cursor"><span class="active"></span><span></span><span></span><span></span></p>
        <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
        <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
<?php 
//编写sql 语句来进行判断回去sql 的语句来进行访问
$sql="SELECT * from ali_post where post_fo=1 and post_file!='' 
 order by post_addtime desc
limit 0,5 ";
//3.将结果进行资源集的展示
$fo_res=mysql_query($sql);
$num=0;
?>        
        <ul>
<?php while($row=mysql_fetch_assoc($fo_res)) :?>
<?php if($num==0) :?>
          <li class="large">
<?php else :?>
          <li>
<?php endif;?>
            <a href="detail.php?id=<?= $row['post_id']?>">
              <img src="/admin/uploads/../<?=$row['post_file'] ;?>" alt="">
              <span><?= $row['post_title'] ;?></span>
            </a>
          </li>
<?php endwhile ; $num++;?>
        </ul>
      </div>
      <div class="panel top">
        <h3>一周热门排行</h3>
        <ol>
          <li>
            <i>1</i>
            <a href="javascript:;">你敢骑吗？全球第一辆全功能3D打印摩托车亮相</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>2</i>
            <a href="javascript:;">又现酒窝夹笔盖新技能 城里人是不让人活了！</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span class="">阅读 (18206)</span>
          </li>
          <li>
            <i>3</i>
            <a href="javascript:;">实在太邪恶！照亮妹纸绝对领域与私处</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>4</i>
            <a href="javascript:;">没有任何防护措施的摄影师在水下拍到了这些画面</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
          <li>
            <i>5</i>
            <a href="javascript:;">废灯泡的14种玩法 妹子见了都会心动</a>
            <a href="javascript:;" class="like">赞(964)</a>
            <span>阅读 (18206)</span>
          </li>
        </ol>
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
              <img src="../../uploads/hots_4.jpg" alt="">
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
      <div class="panel new">
        <h3>最新发布</h3>
<?php 
//编写sql语句是将三个表格中的内容进行对比  三张表的内容进行拼接 
$sql="SELECT 
  post_id,post_title,post_desc,cate_name,user_nickname,post_addtime,post_good,post_bad,post_file,post_click,num from ali_post p 
  left join ali_cate c on p.post_cateid=c.cate_id
  left join ali_user u on p.post_author=u.user_id
  left join(SELECT cmt_postid,count(*) num from ali_comment group by cmt_postid) t on t.cmt_postid=p.post_id
  limit 0,3" ;
  //4.将结果进行资源的展示
  $z_res=mysql_query($sql);
?>
<!--将结果进行循环展示-->
<?php  while($row=mysql_fetch_assoc($z_res)) :?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?= $row['cate_name'] ;?></span>
            <a href="javascript:;"><?= $row['post_title'] ;?></a>
          </div>
          <div class="main">
            <p class="info"><?= $row['user_nickname'] ;?>发表于<?= date('Y-m-d',$row['post_addtime']) ;?></p>
            <p class="brief"><?= $row['post_desc'] ;?></p>
            <p class="extra">
              <span class="reading">阅读<?= $row['post_click'] ;?></span>
              <span class="comment">评论<?= ($row['num']=='')?0:$row['num'] ;?></span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞<?= $row['post_good'] ;?></span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span>星球大战</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/../<?= $row['post_file'] ;?>" alt="">
            </a>
          </div>
        </div>
<?php  endwhile ;?>
 <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });

    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if(_this.is('.prev')) {
        swiper.prev();
      } else if(_this.is('.next')) {
        swiper.next();
      }
    })
  </script>
</body>
</html>

