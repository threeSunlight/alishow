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
<?php 
include_once '../include/checksession.php' ;

//1.接受post_id
$id=$_GET['id'];
//2.连接数据可
include_once '../include/include.php';
//3.根绝POST_id查询文章信息
$sql = "select * from ali_post where post_id=$id";
//4.执行ssql语句是一个资源结果型
$res= mysql_query($sql);
//5.将结果转换为一维数组
$post_info =mysql_fetch_assoc($res);    
?> 
  <script>NProgress.start()</script>
  <div class="main">
   <?php  include_once '../include/nav.php' ;?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="modifyposts.php" method="post" enctype="multipart/form-data">
      	<!--隐藏域来进行传值 传递隐藏的图片 默认的-->
      	<input type="hidden" name="id"  value="<?=$post_info['post_id'] ;?>">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" value="<?= $post_info['post_title'] ;?>"  name="title" type="text" >
          </div>
          <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content"  name="content" ><?= $post_info['post_content'] ;?></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" value="<?= $post_info['post_slug'] ;?>" class="form-control" name="slug" type="text" >
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img src="<?= $post_info['post_file'] ;?>" class="help-block thumbnail" style="display: block;">
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
            	<?php if($post_info['post_cateid']== $row[' cate_id ']) :?>
              <option value="<?= $row['cate_id'] ;?>" selected><?= $row['cate_name'] ;?></option>
               <?php else :?>
			  <option value="<?= $row['cate_id'] ;?>"><?= $row['cate_name'] ;?></option>
				<?php endif ;?>
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
            	<?php if($post_info['post_state']==1)  :?>
              <option value="2">草稿</option>
              <option value="1" selected>已发布</option>
          <?php else :?>
             <option value="2" selected>草稿</option>
              <option value="1" >已发布</option>
            <?php  endif ;?>
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


