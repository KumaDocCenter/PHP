<?php

//引入常量配置文件
include './conf/define.php';

//引入配置文件
include CONF_PATH . 'conf.php';

//引入公共函数文件
include CORE_PATH . 'Func.php';

//引入SMARTY核心类文件
include PLUGINS_PATH . 'smarty/Smarty.class.php';

//引入父类控制器（基础控制器类）文件
include CORE_PATH . 'Controller.class.php';

//引入父类模型（基础模型类）文件
include CORE_PATH . 'Model.class.php';

//引入新闻管理系统新闻表的模型类文件
//include APP_MODEL_PATH . 'NewsModel.class.php';

//引入新闻管理系统控制器类文件
//include './app/admin/controller/NewsController.class.php';
//include APP_ADMIN_CONTR_PATH . 'NewsController.class.php';
//include APP_HOME_CONTR_PATH . 'IndexController.class.php';

//引入核心框架类
include CORE_PATH . 'App.class.php';
//注册自动加载方法
spl_autoload_register('\core\App::autoload');

