<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-06 11:49:47
 * @version $Id$
 */
header("content-type:text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
  <link rel="stylesheet" href="../../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <script src="../../assets/vendors/nprogress/nprogress.js"></script>
   <script src="../../assets/vendors/jquery/jquery.js"></script>
</head>
<body>
	<?php  include_once '../include/checksession.php' ;
	//1.连接数据库的
	include_once '../include/include.php';
	//写这段php代码是为了将表格中的内容进行循环展示到结果中间所以要三个表进行联动,判断id的值想等性
//2.编写sql语句使两个表的内容进行联动进行id的相等的对换
	$sql="select cmt_id,member_nickname,cmt_content,post_title,cmt_state,cmt_time from ali_comment c 
	join ali_member m on c.cmt_memid=m.member_id
	join ali_post p on c.cmt_postid=p.post_id";
	//3.将查询的资源结果集展示出来.进行判断
	$res=mysql_query($sql);
	?>
  <script>NProgress.start()</script>

  <div class="main">
   <?php  include_once '../include/nav.php' ;?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: block">
          <button class="btn btn-info btn-sm" id="allowBtn">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        	<?php while($row=mysql_fetch_assoc($res)) :?>
          <tr class="danger">
            <td class="text-center"><input type="checkbox" value="<?= $row['cmt_id'] ;?>"></td>
            <td><?= $row['member_nickname'] ;?></td>
            <td><?= $row['cmt_content'] ;?></td>
            <td><?= $row['post_title'] ;?></td>
            <td><?= date('Y/m/d',$row['cmt_time']);?></td>
            <td class="state"><?= $row['cmt_state'] ;?></td>
            <td class="text-center">
            	<?php if($row['cmt_state']=='驳回') :?>
              <a href="javascript:;" class="btn  cmtBtn btn-info btn-xs" data="<?= $row['cmt_id'];?>">批准</a>
              <?php else :?>
               <a href="javascript:;" class="btn cmtBtn btn-warning btn-xs" data="<?= $row['cmt_id'];?>">驳回</a>
           	   <?php endif ;?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
      <?php endwhile ;?>
        </tbody>
      </table>
      <script type="text/javascript">
      	//在批准驳回按键上面绑定点击事件
      	$('.cmtBtn' ).click(function(){
      		//分别获取cmt_id和按钮内容(状态)
      		var id=$(this).attr('data');
      		var state=$(this).html();
                 // alert(id +"----"+ state);
		//转存这个按钮对象
      		_this=$(this);
      		//发送ajax请求
      		var data={id:id,state:state};
      		$.post('modifycmt.php',data,function(msg){
      			if(msg==1){
      				_this.parent().parent().find('.state').html(state);
      				//修改按钮对象
      				if(state=='批准'){
      					_this.html('驳回');//和原按钮是相反的,如果是批准就改成驳回,通过转存来保存新的按钮状态;
      				//将原来的样式也实现改变,将[准的样式移除 增加驳回的按钮
      				_this.removeClass('btn-info');
      				_this.addClass('btn-warning');
      				}else{
      					_this.html('批准');
      					_this.removeClass('btn-warning');
      					_this.addClass('btn-info');
      				}
      				alert ("修改成功");
      			}else{
      				alert("修改失败") ;
      			}
      		}) 		
      	}) ;

      	//在批量批准的按钮上绑定点击事件批量批准的点击事件 进行点击 连接后台进行传输数值
      	$('#allowBtn').click(function(){

      		//获取所有已选中的复选框的值取出并且其中的value值 拼接成一个字符串
      		//:checkbox:选中所有的复选框
      		//:checkbox:checked:选中勾选的复选框
      		var check_list=$(':checkbox:checked');
      		//是一个数组 要进行循环遍历,遍历已选中的复选框
      		//index 是每次取出的下标
      		//el :是标签的对象.HTMLInputElement是一个表单的标签
      		var str="";
      		check_list.each(function(index,el){
      			str+=el.value+",";
      		});
      		//去掉最后的一个,用字符串来进行截取
      		str=str.substr(0,str.length-1);
      		//alert(str);
      		$.post('allowcmt.php',{ids:str},function(msg){
      			if(msg==1){
      				alert('修改成功');
      				//循环checkbox_list,通过check_box对象,找状态的td对象此时已经是jquery的对象了 以后要注意对象的变换
      				check_list.each(function(){
      					//此时的这个对象为jquery对象所以要用$this
      					$(this).parent().parent().find('.state').html('批准');
      					$(this).parent().parent().find('.cmtBtn').html('驳回')
                .removeClass('btn_info').addClass('btn_warning');
      				})
      			}else{
      				alert('修改失败');
      			}
      		})
      	});
      </script>
    </div>
  </div>

  <div class="aside">
   <?php include_once "../include/aside.php"  ;?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>

