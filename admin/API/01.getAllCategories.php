<?php
    // 设置数据的格式
    header('content-type:application/json;charset=utf-8');
    // 引入函数
    include_once '../../tool/tools.php';
    // 准备sql
    $sql = "select * from categories";
    // 调用函数执行sql -php的数组
    $data = my_SELECT($sql);
    // JSON是一种格式 载体是字符串
    // 把php的数组 转化为json格式
    $jsonString = json_encode($data);
    // 返回数据
    // var_dump() 
    // var_dump($jsonString); string{"name":"jack"}
    echo $jsonString;
?>
