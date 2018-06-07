<?php
    // 函数
    include_once '../../tool/tools.php';
    // 接收数据
    $id = $_REQUEST['id'];

    // 准备sql
    $sql ="delete from categories where id = $id";
    // 执行sql
    $rowNum = my_ZSG($sql);
    // 判断结果
    // echo $rowNum;
    if($rowNum==1){
        // 返回结果
        echo '恭喜你,删除成功!!';
    }else{
        echo '由于一些莫名其妙的问题,新增不成功';
    }

?>