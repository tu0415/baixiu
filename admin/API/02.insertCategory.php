<?php
    // 函数
    include_once '../../tool/tools.php';
    // 接收数据
    $slug = $_REQUEST['slug'];
    $name = $_REQUEST['name'];

    // 准备sql
    $sql ="insert into categories(slug,name)values('$slug','$name')";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    // echo $rowNum;
    if($rowNum==1){
        // 返回结果
        echo '恭喜你,新增成功!!';
    }else{
        echo '由于一些莫名其妙的问题,新增不成功';
    }

?>