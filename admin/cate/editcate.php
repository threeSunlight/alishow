<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 10:23:26
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
$id=$_GET['id'];
//2连接数据库
include_once('../include/include.php');
//3.根据cate_id查询数据
$sql="select * from ali_cate where cate_id='$id'";
$row=mysql_query($sql);
//4.将将资源型的结果集转化为数组的结果的级
$rew=mysql_fetch_assoc($row);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
   <?php  include_once"../include/nav.php";?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form action="modifycate.php" method="post">
            <input type="hidden" name="id" value="<?= $rew['cate_id'] ;?>"/>
            <div class="form-group">
              <label for="name">名称</label>
              <input  class="form-control" name="icon" type="text"  value="<?= $rew['cate_name'] ;?>">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input class="form-control" name="slug" type="text" value="<?= $rew['cate_slug'] ;?>">
            </div>
             <div class="form-group">
              <label for="slug">图标</label>
              <input  class="form-control" name="class" type="text" value="<?= $rew['cate_class'] ;?> ">
            </div>
             </div>
             <div class="form-group">
              <label for="slug">状态</label>
              <?php  if($rew['cate_state']==1 ) :?>
              <input type="radio" name="state" checked>启用
              <input type="radio" name="state" >禁用  
               <?php  else :?>
               	 <input type="radio" name="state" >启用
              <input type="radio" name="state" checked>禁用  
          <?php endif ;?>
            </div>
               <div class="form-group">
              <label for="slug">显示</label>
              <?php if($rew['cate_show']==1) :?>
              <input type="radio" name="show" checked>显示
              <input type="radio" name="show" >不显示  
          <?php  else :?>
          	<input type="radio" name="show" >显示
              <input type="radio" name="show" checked>不显示 
              <?php endif;?> 
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">添加</button>
            </div>
          </form>
        </div>
      </div>
  </div>

  <div class="aside">
   <?php include_once'../include/aside.php' ;?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
