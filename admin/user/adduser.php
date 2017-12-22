<?php
/**
 * 4
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 21:32:13
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
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
            <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
             <input type="button" value="添加" onclick="adduser_ajax()" />
            </div>
          </form>
        </div>
      </div>
<script type="text/javascript">
	function adduser_ajax(){
		//获取表单对象
		var fm=$('#main')[0];
		//实例化表单对象
		var fd=new FormData(fm);
		//发送ajax请求
		$.ajax({
			url:'adduser_deal.php',
			type:'post',
			data: fd,
			contentType :false,
			processData : false,
			dataType:'text',
			success :function(msg){
				if(msg ==1){
					alert('添加新用户成功');
				}else{
					alert('添加新用户失败');
				}
				//关闭弹出层
				var index=parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
			}
		});
	}

</script>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
