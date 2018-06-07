<pre>
<?php
  header('content-type:text/html;charset=utf-8');
  // session_start();
  // var_dump($_SESSION);
  // 判断是否有数据
  if(isset($_REQUEST['slug'])){
    // echo 'have data';
    // 引入函数
    include_once '../tool/tools.php';
    // 接收数据
    $email = $_REQUEST["email"];
    $slug = $_REQUEST["slug"];
    $nickname = $_REQUEST["nickname"];
    $bio = $_REQUEST["bio"];
    // 文件保存
    $avatar = '/uploads/'.my_move_upload_file('avatar','../uploads/');
    // 开启了 session
    session_start();
    $id = $_SESSION['userInfo']['id'];

    // 准备sql
    // update 
    // updata
    $sql = "update users set email = '$email',slug = '$slug',nickname = '$nickname',bio='$bio',avatar ='$avatar' where id =$id";
    // echo $sql ;
    // 执行sql 函数
    $rowNum = my_ZSG($sql);
    // 用户的数据保存在session中 
    // 修改了数据库的数据 还需要修改保存在session中的用户信息 否则会有缓存问题
    $_SESSION['userInfo'] = my_SELECT("select * from users where id = $id")[0];
    
    // 重新打回 个人中心页即可
    // 屏蔽了 那个警告提示
    // 因为页面重新加载了 原本提交的数据没有了 用户哪怕刷新页面 也不会提示重新提交数据
    header('location:./profile.php');

  }else{
    // 没有数据
    // echo 'no data';
  }
?>
</pre>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './INC/navbar.php'; ?>
    <?php
      // var_dump($_SESSION);
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>我的个人资料</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form action="./profile.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-3 control-label">头像</label>
          <div class="col-sm-6">
            <label class="form-image">
              <input id="avatar" required name="avatar" type="file">
              <img src="<?php echo $_SESSION['userInfo']['avatar'];?>">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">邮箱</label>
          <div class="col-sm-6">
            <input id="email"  class="form-control" name="email" type="type" value="<?php echo $_SESSION['userInfo']['email'];?>" placeholder="邮箱" readonly>
            <p class="help-block">登录邮箱不允许修改</p>
          </div>
        </div>
        <div class="form-group">
          <label for="slug" class="col-sm-3 control-label">别名</label>
          <div class="col-sm-6">
            <input id="slug" required class="form-control" name="slug" type="type" value="<?php echo $_SESSION['userInfo']['slug'];?>" placeholder="slug">
            <p class="help-block">https://zce.me/author/<strong><?php echo $_SESSION['userInfo']['slug'];?></strong></p>
          </div>
        </div>
        <div class="form-group">
          <label for="nickname" class="col-sm-3 control-label">昵称</label>
          <div class="col-sm-6">
            <input id="nickname" class="form-control" name="nickname" type="type" value="<?php echo $_SESSION['userInfo']['nickname'];?>" placeholder="昵称">
            <p class="help-block">限制在 2-16 个字符</p>
          </div>
        </div>
        <div class="form-group">
          <label for="bio" class="col-sm-3 control-label">简介</label>
          <div class="col-sm-6">
            <textarea id="bio" name="bio" class="form-control" placeholder="Bio" cols="30" rows="6"><?php echo $_SESSION['userInfo']['bio'];?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary">更新</button>
            <a class="btn btn-link" href="password-reset.php">修改密码</a>
          </div>
        </div>
      </form>
    </div>
  </div>

    <?php include_once './INC/aside.php'; ?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
<script>
  $(function(){
    // 图片选择预览
    $("#avatar").change(function(){
      // console.log('改变啦');
      // 获取 文件
      // 调用api生成url
      // H5的新api
      var url = URL.createObjectURL(this.files[0]);
      // 设置给自己隔壁的img
      // attr jQ提供的操纵属性的方法 prop
      $(this).next('img').attr('src',url);
    })
  })

</script>
