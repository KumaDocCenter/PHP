<?php

namespace admin\controller;//创建一个 全局空间  下的  admin空间  下的  controller空间
use \core\Controller;//引入  全局空间  下的  core空间  下的  Controller类

class LoginController extends Controller{

    #登陆相关
    public function showLogin(){ 
        
        //渲染模板
        $this->display('Privilege/login.html');
    }

    //登陆验证方法
    public function loginh(){ 
        
        //接收表单提交的数据
        $acc = trim($_POST['acc']);//帐号
        $pwd = md5(addslashes(trim($_POST['pwd'])));//密码
        $captcha = addslashes(trim($_POST['captcha']));//验证码

        //检查验证码是否填写正确
        @session_start();
        if( $captcha!==$_SESSION['captchaStr'] ){//用户填写的验证码和生成的验证码不相等，则说明用户输入的验证码是错误的
            echo '你好棒棒哟，竟然写错了哟！～'; 
            $url = C('URL') . '/index.php?p=admin&m=login&a=showLogin';
            header('Refresh:2; url='.$url);
            exit;
        }

        //检查帐号和密码是否正确
        $userModel = \core\App::single('\model\UserModel');
        $sql = "select * from bg_user where acc='{$acc}' and pwd='{$pwd}'";
        $row = $userModel->getRow($sql);

        if( !empty($row) ){//帐号密码填写正确
            
            $_SESSION['admin'] = $row;//登陆成功后将用户的完整信息记录到SESSION中的admin元素里

            echo '客官，您又来了吖～'; 
            $url = C('URL') . '/index.php?p=admin&m=article&a=showList';
            header('Refresh:2; url='.$url);
        }else{//否则至少有一个填写错误
            
            echo '帐号或密码填写错误，请重新填写！'; 
            $url = C('URL') . '/index.php?p=admin&m=login&a=showLogin';
            header('Refresh:2; url='.$url);
        }
        exit;
    }

    //输出验证码图像的方法
    public function captcha(){ 
        
        //调用工具类，输出验证码图像
        $captchaTool = \core\App::single('\plugins\CaptchaTool');
        $captchaTool->output();
    }
}