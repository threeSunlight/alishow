<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-07 15:48:46
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
?>
<?php 
include_once 'checksession.php';
//连接数据库
include_once 'include.php' ;
//2.编写sql 语句 查询的关键是 也要显示的时候需要显示来用,所以关键的条件是cate_show =1的时候
$sql="select * from ali_cate where cate_show=1";
//3.是资源结果集 所以要用资源结果集来进行展示
$rew=mysql_query($sql);
?>  
 <h1 class="logo"><a href="index.php"><img src="../../assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
        <!--要使用循环来是数据进行不断的展示进行结果的展示-->
        <?php  while($row=mysql_fetch_assoc($rew)) :?>
        <li><a href="javascript:;"><i class="fa <?= $row['cate_class'];?>"></i><?= $row['cate_name']?></a></li>
      <?php endwhile;?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
