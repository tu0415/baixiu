<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Password reset &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './INC/navbar.php';?>
    <?php
      // 引入函数
      include_once '../tool/tools.php';
      // 定义标示变量
      $message = null;
      if (isset($_REQUEST['old'])) {
          // 接收数据
          $old = $_REQUEST['old'];
          $new = $_REQUEST['new'];
          $reNew = $_REQUEST['reNew'];
          // 旧密码是否为正确的
          // session_start();
          if ($old == $_SESSION['userInfo']['password']) {
              // 没问题
              // 准备sql
              $id = $_SESSION['userInfo']['id'];
              // 判断两次新密码是否一致
              if($new==$reNew){
                $sql = "update users set password ='$new' where id =$id";
                // 执行sql 函数
                $rowNum = my_ZSG($sql);
                // 重新登录
                // 删除session
                // unset($_SESSION['userInfo']);
                // 跳到登出页
                header('location:./logout.php');
              }else{
                $message = '哥们,你两次密码不一样哦,是不是没有睡好,早睡保秀发!!';
              }
          } else {
              // 有问题 不能继续执行
              $message = '哥们,你的旧密码是不是不太对呀,你是谁!!!';
          }
      }
    ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>修改密码</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <?php if ($message != null): ?>
        <div class="alert alert-danger">
          <strong>错误！</strong><?php echo $message; ?>
        </div>
      <?php endif;?>
      <form action="./password-reset.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="old" class="col-sm-3 control-label">旧密码</label>
          <div class="col-sm-7">
            <input id="old" name="old" class="form-control" type="password" placeholder="旧密码">
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-3 control-label">新密码</label>
          <div class="col-sm-7">
            <input id="password" name="new" class="form-control" type="password" placeholder="新密码">
          </div>
        </div>
        <div class="form-group">
          <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
          <div class="col-sm-7">
            <input id="confirm" name="reNew"  class="form-control" type="password" placeholder="确认新密码">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-7">
            <button type="submit" class="btn btn-primary">修改密码</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include_once './INC/aside.php';?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
<!-- <script>
  .setRequestHeader("Content-type","application/x-www-form-urlencoded");
</script> -->
