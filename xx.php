<?php
echo 1;die;
    $mysqli = new mysqli('主库或者从库地址', '用户名', '密码', '数据库', '主库或者从库端口');
    if ($mysqli->connect_error) {
        exit($mysqli->connect_error);
    }
    echo "connect ok";
    $mysqli->close();