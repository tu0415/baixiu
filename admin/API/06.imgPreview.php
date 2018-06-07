<?php
    // 引入函数
    include_once '../../tool/tools.php';
    // 接收文件
    $fileName = my_move_upload_file('preview','../../uploads/');

    // 返回文件的路径
    // / 网站的根目录
    echo '/uploads/'.$fileName;
?>