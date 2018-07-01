<?php
header('Content-Type:text/html;Charset=utf-8');
$arr = array(
    "user" => "xuguixin",
    "pass" => "123456",
    "name" => 'response'

);
echo $_GET['jsoncallback'].'('.json_encode($arr).')';//输出