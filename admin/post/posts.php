<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
<?php 
include_once '../include/checksession.php';
include_once '../include/include.php';
//1. 接收cate_id和state
//如果没有筛选条件，则设置为0
$id = isset($_GET['cate'])?$_GET['cate']:0;
$state = isset($_GET['state'])?$_GET['state']:0;
//2. 根据$id和$state的值，拼接where条件
$where = ""; //所有的筛选条件全部要拼接到$where中
if($id != 0){
    $where .= "cate_id=$id and ";  //cate_id=1
}
if($state != 0){
    $where .= "post_state=$state and "; //post_state=2
}
$where .= "1";
//3. 定义页号，每页显示数量，起始位置
$pageno = isset($_GET['pageno'])?$_GET['pageno']:1;
$pagesize = 2;
$start = ($pageno - 1) * $pagesize;
$sql = "SELECT post_id,post_title,user_nickname,cate_name,post_addtime,post_state FROM ali_post p
  JOIN ali_user u ON p.post_author=u.user_id
  JOIN ali_cate c ON p.post_cateid=c.cate_id
  where $where
  limit $start,$pagesize";
$res = mysql_query($sql);
?>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once '../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
<?php 
$sql = "select * from ali_cate";
$cate_res = mysql_query($sql);
?>
        <form action="posts.php" method="get" class="form-inline">
          <select name="cate" class="form-control input-sm">
            <option value="0">所有分类</option>
            <?php while ($row = mysql_fetch_assoc($cate_res)):?>
            <option value="<?=$row['cate_id'];?>"><?=$row['cate_name'];?></option>
            <?php endwhile;?>
          </select>
          <select name="state" class="form-control input-sm">
            <option value="0">所有状态</option>
            <option value="2">草稿</option>
            <option value="1">已发布</option>
          </select>
          <input type="submit" class="btn btn-default btn-sm" value="筛选" />
        </form>
<?php 
//计算分页导航条
//1. 计算总条数
$sql = "SELECT count(post_id) num FROM ali_post p
  JOIN ali_user u ON p.post_author=u.user_id
  JOIN ali_cate c ON p.post_cateid=c.cate_id
  where $where";
$count_res = mysql_query($sql);
$count_arr = mysql_fetch_assoc($count_res);
//总记录数
$count = $count_arr['num'];
//2. 计算总页数
$pages = ceil($count/$pagesize);

//计算上一页和下一页
$prev = $pageno - 1;
$next = $pageno + 1;

$len = 5;
$specail = ($len - 1) / 2;
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="posts.php?cate=<?=$id?>&state=<?=$state?>&pageno=1">首页</a></li>
          <li><a href="posts.php?cate=<?=$id?>&state=<?=$state?>&pageno=<?=$prev;?>">上一页</a></li>
          <?php 
           //如果总页数小于等于导航条长度，则输出所有的页号
           if($pages <= $len){
               for($i = 1; $i <= $pages; $i++){
                   echo "<li><a href='posts.php?cate=$id&state=$state&pageno=$i'>$i</a></li>";
               }
           } else {
               //如果总页数大于导航条长度，则分为三种情况来输出页号
               if($pageno <= $specail){
                   for($i = 1; $i <= $len; $i++){
                       echo "<li><a href='posts.php?cate=$id&state=$state&pageno=$i'>$i</a></li>";
                   }
               } else if($pageno >= $pages - $specail + 1){
                   for($i = $pages - $len + 1; $i <= $pages; $i++){
                       echo "<li><a href='posts.php?cate=$id&state=$state&pageno=$i'>$i</a></li>";
                   }
               } else {
                   for($i = $pageno - $specail; $i <= $pageno + $specail; $i++){
                       echo "<li><a href='posts.php?cate=$id&state=$state&pageno=$i'>$i</a></li>";
                   }
               }
           }
          ?>
          <li><a href="posts.php?cate=<?=$id?>&state=<?=$state?>&pageno=<?=$next;?>">下一页</a></li>
          <li><a href="posts.php?cate=<?=$id?>&state=<?=$state?>&pageno=<?=$pages;?>">尾页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysql_fetch_assoc($res)):?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?=$row['post_title'];?></td>
            <td><?=$row['user_nickname'];?></td>
            <td><?=$row['cate_name'];?></td>
            <td class="text-center"><?=date('Y/m/d',$row['post_addtime']);?></td>
            <td class="text-center"><?=($row['post_state']==1)?'已发布':'草稿';?></td>
            <td class="text-center">
              <a href="editposts.php?id=<?= $row['post_id'] ;?>" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php';?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
