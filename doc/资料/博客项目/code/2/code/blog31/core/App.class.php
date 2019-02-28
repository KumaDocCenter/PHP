<?php

namespace core;//创建一个   全局空间   下的  core空间

class App{

    private static $_obj=array();
                                     //第一次，\admin\controller\NewsController
                                     //第二次，\admin\controller\UserController
    public static function single($className){ 

        //       self::$_obj['\admin\controller\NewsController']
        //       self::$_obj['\admin\controller\UserController']
        if( empty(self::$_obj[$className]) ){
            self::$_obj[$className] = new $className;
        }
        return self::$_obj[$className];
    }


    //启动方法
    public static function run(){ 
        #（动作参数）构建了一个$action变量，保存需要访问的方法名，如果没有传递GET参数的a数据，则默认访问showList页面
        //$action = isset($_GET['a']) ? $_GET['a'] : 'showList';
        //$action = isset($_GET['a']) ? $_GET['a'] : C('web.a');
        $GLOBALS['action'] = $action = isset($_GET['a']) ? $_GET['a'] : C('web.a');

        #（模块参数）构建了一个$module变量，保存需要实例化的控制器类的类名，不包含Controller部分
        //$module = isset($_GET['m']) ? ucfirst(strtolower($_GET['m'])) : 'News';
        //$module = isset($_GET['m']) ? ucfirst(strtolower($_GET['m'])) : C('web.m');
        $GLOBALS['module'] = $module = isset($_GET['m']) ? ucfirst(strtolower($_GET['m'])) : C('web.m');

        #（平台参数）构建了一个$plat变量，保存需要访问的控制器类所在的空间名
        //$plat = isset($_GET['p']) ? $_GET['p'] : 'admin';
        //$plat = isset($_GET['p']) ? $_GET['p'] : C('web.p');
        $GLOBALS['plat'] = $plat = isset($_GET['p']) ? $_GET['p'] : C('web.p');

        //$obj = new \admin\controller\NewsController;//实例化控制器类的对象

        //$className = '\\admin\\controller\\'.$module.'Controller';
        $className = '\\'.$plat.'\\controller\\'.$module.'Controller';
        //$obj = new $className;
        $obj = App::single($className);//调用single方法实现实例化单例对象

        #调用相关方法展示相关页面
        //$obj->showList();
        //$obj->showAd();
        //$obj->showUpd();
        $obj->$action();
    }

    /**
     * 功能：实现自动加载功能的方法
     * @param  $className   string   使用到的类的类名，$className='NewsController';
     */
    public static function autoload($className){ 
        $baseClassName = basename($className);//获得去除了命名空间的基础类名，比如如果类名是home\controller\IndexController，则处理后将会是IndexController

        if( substr($baseClassName, -10)=='Controller' ){//说明这个类一定是一个控制器类
        
            $path = APP_PATH . $GLOBALS['plat'] . '/controller/' . $baseClassName . '.class.php';//拼接控制器类的全路径文件名
            include $path;//把控制器类文件引入到程序中
        }elseif( substr($baseClassName, -5)=='Model' ){//说明这个类一定是一个模型类
            
            $path = APP_MODEL_PATH . $baseClassName . '.class.php';
            include $path;
        }elseif( substr($baseClassName, -4)=='Tool' ){//说明这个类一定是一个工具类
        
            //           blog31/plugins/    CaptchaTool          .class.php
            $path = PLUGINS_PATH . $baseClassName . '.class.php';
            include $path;
        }
    }
}