<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-04 11:10:14
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
    <link href="../../assets/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../../assets/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="../../assets/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../../assets/umeditor.min.js"></script>
    <script type="text/javascript" src="../../assets/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
<?php include_once '../include/checksession.php' ;?> 
  <script>NProgress.start()</script>
  <div class="main">
   <?php  include_once '../include/nav.php' ;?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="addpost_deal.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content"  name="content"  placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
   <?php  
   include_once '../include/include.php';
 //查询cate 表
   $sql="select * from  ali_cate where cate_state=1";
   //展示的是结果集
   $rew=mysql_query($sql);
   ?>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
            <?php while($row=mysql_fetch_assoc($rew)) :?>
              <option value="<?= $row['cate_id'] ;?> "><?= $row['cate_name'] ;?></option>
              <?php endwhile;?>
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="2">草稿</option>
              <option value="1">已发布</option>
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="aside">
   <?php include_once '../include/aside.php' ;?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  	var um =UM.getEditor('content',{
  		initialFrameWidth:850,
  		initialFrameHeight:300,
  		//isshow:false,//是否显示编辑器
  		initialContenr:'Ueditor测试',//初始化富文本编辑器中的内容
  		toolbar:[
            'source | undo redo | bold italic underline strikethrough | superscript subscript | forecolor backcolor | removeformat |',
            'insertorderedlist insertunorderedlist | selectall cleardoc paragraph | fontfamily fontsize' ,
            '| justifyleft justifycenter justifyright justifyjustify |',
            'link unlink | emotion image video  | map',
            '| horizontal print preview fullscreen', 'drafts', 'formula'
        ]
  	});
  </script>
</body>
</html>                   

