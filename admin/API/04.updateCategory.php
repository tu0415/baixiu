<?php
    // 函数
    include_once '../../tool/tools.php';
    // 接收数据
    $slug = $_REQUEST['slug'];
    $name = $_REQUEST['name'];
    $id = $_REQUEST['id'];

    // 准备sql
    $sql ="update categories set slug='$slug' ,name='$name' where id = $id";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    // echo $rowNum;
    if($rowNum==1){
        // 返回结果
        echo '恭喜你,改好了哦!!';
    }else{
        echo '由于一些莫名其妙的问题,新增不成功';
    }

?>