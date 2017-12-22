<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-11-02 14:36:17
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
    <?php 

            	include_once'../include/include.php';
            	//2.编写sql语句
            	//进行判断是否有$pageno这个数,如果有就进行设置 没有就设置为1
            	$pageno =isset($_GET['pageno'])?$_GET['pageno']:1;
            	//设置每页显示的数量
            	$pagesize =3;
            	//计算查询的起始位置
            	$start =($pageno-1)*$pagesize;
            	//拼接核心的sql语句
            	$sql="select * from ali_user limit $start,$pagesize";
            	$rew=mysql_query($sql);
     		 include_once '../include/checksession.php' ;
            ?>
  <div class="main">
    <?php include_once'../include/nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户列表</h1>
        <input type="button" value="添加新用户" onclick="adduser()" />
      </div>
   
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">    
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
            	
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
        
            <tbody>
            <?php while ($row=mysql_fetch_assoc($rew)) :?>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="../../assets/img/default.png"></td>
                <td><?= $row['user_email'] ;?></td>
                <td><?= $row['user_slug'] ;?></td>
                <td><?= $row['user_nickname'] ;?></td>
                <td><?= ($row['user_state']==1)? '激活':'不激活' ;?></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn  edituser  btn-default btn-xs" data="<?= $row['user_id'];?>" >编辑</a>
                  <a href="javascript:;" data="<?= $row['user_id'];?>" class="btn  deluser btn-danger btn-xs">删除</a>
                </td>
              </tr>
             <?php endwhile;?>
            </tbody>
          </table>
          <?php
            //计算总记录数
            		//num 是为count(*)设置别名,方便下面的使用和查询
            		$sql="select count(*) num  from ali_user";
            		//将结果型转换为资源型
            		$info=mysql_query($sql);
            		//将结果资源型转化为数组的形状
            		$row=mysql_fetch_assoc($info);
            		//取得总记录数
            		$count =$row['num'];
            		//计算总页数
            		$pages=ceil($count/$pagesize);

            		//计算上一页的页号
            		$prev=$pageno-1;
            		//计算下一页的页号
            		$next=$pageno+1; 
            		//设置分页的导航
            		//先来设置每页显示的页码数
            		//先要计算特殊的页码数然后在计算三个正常的页码
            		//导航的长度
            		$len=5;
            		$special=($len -1)/2 ;

            	?>
            	 <ul class="pagination pagination-sm pull-right">
          			<li><a href="users.php?pageno=1">首页</a></li>
          			<li><a href="users.php?pageno=<?= $prev;?>">上一页</a></li>
          			<?php 
          			if($pageno<=$special){
          				for( $i=1;$i<=$len ;$i++){
          					echo "<li><a href='users.php?pageno=$i'>$i</a></li>";
          				}
          			}else if($pageno >= $pages - $special){
          				for( $i=$pages -$len +1;$i<=$pages ;$i++){
          					echo "<li><a href='users.php?pageno=$i'>$i</a></li>";
          				}
          			}else{
						for($i=$pageno-$special;$i<=$pageno+$special;$i++){
						echo "<li><a href='users.php?pageno=$i'>$i</a></li>";
					}
          		}
          			?>
          			<li><a href="users.php?pageno=<?= $next;?>">下一页</a></li>
          			<li><a href="users.php?pageno=<?= $pages ;?>">尾页</a></li>
        		</ul>
        </div>
      </div>
    </div>


  <div class="aside">
   <?php  include_once"../include/aside.php";?>
  </div>

  <script src="../../assets/vendors/jquery/jquery.js"></script>
  <script src="../../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
     <script type="text/javascript">
      	function adduser(){
      		layer.ready(function(){
      			layer.open({
      				type:2,
      				title:'添加新用户',
      				area:['500px','500px'],
      				content:'adduser.php',
      			});
      		});
      	}
      	//获取删除按钮对象,绑定点击事件
      	$('.deluser').click(function(){
      		var id=$(this).attr('data');
      		//转存$(this).方便后面使用
      		_this=$(this);
      		//发送ajax请求
      		$.post('deluser.php',{id:id},function(msg){
      			if(msg==1){
      				//使用删除按钮对象,找parent到td对象,在找到parnet刀tr对象
      			_this.parent().parent().remove();
      			alert('删除用户成功');
      			}else{
      				alert('删除用户失败');
      			}
      		})
      	})

//为编辑事件绑定点击事件
        $('.edituser').click(function(){
            var id=$(this).attr('data');
            //转存$(this),方便后面使用使用laryer的固定代码
            layer.ready(function(){
              layer.open({
                type:2,
                title:'编辑用户', 
                area:['600px','600px'],
                maxmin:false,
                content:'edituser.php?id='+id ,
              });
            });
        });
      </script>
</body>
</html>
