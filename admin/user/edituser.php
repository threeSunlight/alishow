<?php
/**
 * 4
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 21:32:13
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
//1.接受user_id
$id=$_GET['id'];
//2.连接数据可
include_once '../include/include.php';
//3.编写sql语句
$sql="select * from ali_user where user_id='$id'";
//展示结果
$row=mysql_query($sql);
$rew=mysql_fetch_assoc($row);

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
  <script src="../../assets/layer/jquery-1.12.1.min.js"></script>
  <script src="../../assets/layer/layer.js"></script>
</head>
<body>
      <div class="row">
        <div class="col-md-4">
          <form  id="main" method="post">
            <h2>编辑用户</h2>
            <input type="hidden" id="id" value="<?= $rew['user_id'] ;?>" >
            <div class="form-group">
              <label for="email">邮箱</label>
              <input  value="<?= $rew['user_email'] ;?>" id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input value="<?= $rew['user_slug'] ;?>" id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input value="<?= $rew['user_nickname'] ;?>" id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input value="<?= $rew['user_pwd'] ;?>" id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>                      
            <div class="form-group">
             <input  type="button" value="修改" id="btn" />
            </div>
          </form>
        </div>
      </div>
<script type="text/javascript">
	$('#btn').click(function(){
		//1.获取所有表单信息
		var id=$('#id').val();                        
		var email=$('#email').val();
		var slug=$('#slug').val();
		var nickname=$('#nickname').val();
		var pwd=$('#password').val();
		//2.发送ajax请求并将表单数据一起发送到后台
		var data={id:id,email:email,slug:slug,nickname:nickname,pwd:pwd};
		$.post('modifyuser.php',data,function(msg){
			if(msg==1){
				alert('修改用户信息成功');
			}else{
				alert('修改用户信息失败');
			}
			var index=parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
			parent.location.reload();//重新载入页面 因为是父级页面所以要更新修改后面的页面
		})
	});

</script>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
