<?php

namespace core;//创建一个   全局空间   下的  core空间

class Controller extends \Smarty{

    public function __construct(){ 

        @session_start();

        //不是访问前台  并且 不是访问admin下的LoginController下的所有方法  才做后台登陆检查
        if( $GLOBALS['plat']!='home'&&!($GLOBALS['plat']=='admin'&&$GLOBALS['module']=='Login') ){
        
            //@session_start();
            if( !isset($_SESSION['admin']) ){//不存在admin元素，说明访问这个页面之前没有登录或没有登录成功
            
                if( !isset($_COOKIE['user_id']) ){//不存在COOKIE数据，说明以前即便登陆成功也没有勾选过7天免登录
                    echo '请您不要翻墙'; 
                    $url = C('URL') . '/index.php?p=admin&m=login&a=showLogin';
                    header('Refresh:2; url='.$url);
                    exit;
                }

                //调用模型找回之前登陆成功者的数据
                $userModel = \core\App::single('\model\UserModel');
                $sql = "select * from bg_user where id=" . $_COOKIE['user_id'];
                $user = $userModel->getRow($sql);

                $_SESSION['admin'] = $user;//把找回的之前登陆者的数据重新交回给SESSION数据的admin元素
            }
        }

        parent::__construct();//解决父类构造方法被重写的问题

        //$this->setTemplateDir(APP_ADMIN_VIEW_PATH);//设置存放模板文件的目录  mvc/app/admin/view目录

        $templateDir = APP_PATH . $GLOBALS['plat'] . '/view';
        $this->setTemplateDir($templateDir);//设置存放模板文件的目录  如果访问的是后台，则是mvc/app/admin/view目录；如果访问的是前台，mvc/app/home/view

        //$this->setCompileDir(APP_ADMIN_PATH.'view_c');//设置存放编译缓存文件的目录   mvc/app/admin/view_c目录

        $compileDir = APP_PATH . $GLOBALS['plat'] . '/view_c';
        $this->setCompileDir($compileDir);//设置存放编译缓存文件的目录   如果访问的是后台，则是mvc/app/admin/view_c目录；如果访问的是前台，mvc/app/home/view_c
    }
}