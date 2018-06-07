<?php
  // cookie
  // session
  // 开启session
  session_start();

  // 判断
  if(isset($_SESSION['userInfo'])){
    // 登陆啦
  }else{
    // 打到登录页
    header('location:./login.php');
  }
?>
<nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="./logout.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
</nav>