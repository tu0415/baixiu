<?php
include_once '../tool/tools.php';

// 定义错误信息
$message = null;

// 第一次进来是没有数据的
if (isset($_REQUEST['email'])&&isset($_REQUEST['password'])) {
// 接收数据
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

// 准备sql
    $sql = "select * from users where email ='$email' and password ='$password'";
// 调用函数执行sql
    $data = my_SELECT($sql);
    // var_dump($data);
// 判断结果
  if(count($data)==1){
    // 开启session
    session_start();
    // 记录session
    $_SESSION['userInfo'] = $data[0];
    // 跳转到首页
    header('location:./index.php');
  }else{
    // 登录失败
    $message = '用户名或密码错误,你到底是😏😏😏😏';
  }
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <!-- 自己提交给自己 action 可以不写 -->
    <form class="login-wrap" action="./login.php" method="post">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if($message!=null): ?>
        <div class="alert alert-danger">
          <strong>错误！</strong> <?php echo $message; ?>
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <button class="btn btn-primary btn-block" type="submit">登 录</button>
    </form>
  </div>
</body>
</html>
