<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-07 16:47:14
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");

?>
     <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <?php 
      //1.连接数据库
include_once 'include.php';
//2.编写sql 语句 因为他的下面对应的是文章所以要去ali_post的表格中去寻找内容然后进行循环,查询的关键是允许展示的时候进行的展示每页随机展示5条,所以要进行随机展示,然后暗战降序的方式展示最近的发布信息order by
$sql="select * from ali_post order by rand() limit 0,5  ";
//3.展示最近的结果的查询,五条信息要进行循环
$post_rand_res=mysql_query($sql);
?>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random"> 
        	<?php while($post_rand_row=mysql_fetch_assoc($post_rand_res)) :?>
          <li>
          	<!--进行循环吧表中的数据循环展示到下面中-->

            <a href="javascript:;">
              <p class="title"><?= $post_rand_row['post_title'] ;?></p>
              <p class="reading"><?= $post_rand_row['post_click'] ;?></p>
              <div class="pic">
                <img src="../../uploads/widget_1.jpg" alt="">
              </div>
            </a>
          </li>
 <?php endwhile ;?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
<!--最新评论也需要倒序orredy by desc 从时间顺序上来进行改变
-->
<?php 
//因为上面连接过数据库了 所以不用进行连接数据库
//编写sql语句 因为是评论所以要进行查询两个表格的数据,两个表格合并起来查询 cmt_id ,memeber_nickname,cmt_content ,cmt_time,memebr_id 来进行查询,使用倒序的方式进行整理ordey  by  cmt_time 来进行查询最新的评轮
$sql="SELECT cmt_id ,cmt_content,member_nickname,cmt_postid from ali_comment c 
	  join  ali_member m on c.cmt_memid=m.member_id
	  order by cmt_time desc
	  limit 0,6";
//3.查询出来的结果进行资源结果集的展示
$post_member_res=mysql_query($sql);	
?>
          <li>
<!--因为要循环展示所以要写循环的语句 ,然后条件上面资源结果进行转化为一维数组-->          	
<?php while($post_member_row=mysql_fetch_assoc($post_member_res)) :?>       
            <a href="javascript:;">
              <div class="avatar">
                <img src="../../uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span><?= $post_member_row['member_nickname'] ;?></span>
                  9个月前(<?= date('m-d',$row['cmt_time']) ;  ?>)说:
                </p>
                <p><?= $post_member_row['cmt_content'] ;?></p>
              </div>
            </a>
<?php endwhile ;?>
          </li>
         
        </ul>
      </div>
