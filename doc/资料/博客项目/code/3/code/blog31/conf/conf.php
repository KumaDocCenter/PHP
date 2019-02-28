<?php


$config = array(

    #网站域名
    'URL' => 'http://www.blog31.com',

    #PDO相关配置
    'PDO' => [
        'type' => 'mysql',//数据库类型
        'host' => 'localhost',//数据库的IP地址
        'port' => 3306,//端口号
        'char' => 'utf8',//默认设置的字符集
        'db' => 'blog31',//默认选择的数据库名
        'acc' => 'root',//数据库帐号
        'pwd' => '123abc'//数据库密码
    ],

    #网站的默认访问页面
    'web' => [
        'p' => 'home',//默认访问的$plat参数
        'm' => 'test',//默认访问的$module参数
        'a' => 'test'//默认访问的$action参数
    ]
);

