<?php
    // 引入函数
    include_once '../../tool/tools.php';
    // 接收数据
    $slug = $_REQUEST['slug'];
    $title = $_REQUEST['title'];
    $created = $_REQUEST['created'];
    $content = $_REQUEST['content'];
    $category = $_REQUEST['category'];
    $status = $_REQUEST['status'];
    // 图片
    $feature = '/uploads/'.my_move_upload_file('feature','../../uploads/');

    // 通过session 获取当前登录的人的 id
    session_start();
    $id = $_SESSION['userInfo']['id'];
    

    // 准备sql
    $sql = "insert into posts (slug,title,feature,created,content,category_id,status,user_id) values('$slug','$title','$feature','$created','$content','$category','$status',$id)";
    // echo $sql;
    
    // 执行sql
    $rowNum = my_ZSG($sql);
    // echo $rowNum;
    // 判断结果
    if($rowNum==1){
        echo '恭喜你,写好了文章哦';
    }else{
        // 提示用户
        echo '嘤嘤嘤,没有写好 ';
    }
?>