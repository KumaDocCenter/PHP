<?php

namespace home\controller;   //创建了一个  全局空间   下的   home空间  下的   controller空间
use \core\Controller;   //引入  全局空间  下的  core空间  下的  Controller类

class IndexController extends Controller{

    #发表评论
    public function talk(){ 
        
        //接收表单提交的评论数据
        $comment = addslashes(trim($_POST['comment']));
        $article_id = addslashes(trim($_POST['article_id']));
        $article_title = addslashes(trim($_POST['article_title']));
        $post_date = time();

        @session_start();
        $user_id = $_SESSION['home']['id'];
        $user_nickname = $_SESSION['home']['nickname'];

        //调用模型新增评论数据
        $commentModel = \core\App::single('\model\CommentModel');
        $sql = "insert into bg_comment values (null, '{$comment}', {$post_date}, {$article_id}, '{$article_title}', {$user_id}, '{$user_nickname}')";

        if( $commentModel->setData($sql) ){//执行成功
            echo '您的支持是我们改进的动力哟～'; 
        }else{//否则表示执行失败
            echo '评论失败！请联系管理员MM'; 
        }

        $url = C('URL') . '/index.php?p=home&m=index&a=showInfo&id='.$article_id;
        header('Refresh:2; url='.$url);
        exit;
    }

    #登陆方法
    public function login(){ 
        
        //接收登陆表单提交的数据
        $acc = addslashes(trim($_POST['acc']));
        $pwd = md5(addslashes(trim($_POST['pwd'])));

        //检查帐号密码是否填写正确
        $userModel = \core\App::single('\model\UserModel');
        $sql = "select * from bg_user where acc='{$acc}' and pwd='{$pwd}'";
        $user = $userModel->getRow($sql);

        if( !empty($user) ){//不是空，说明根据帐号密码能够查询到一个用户

            @session_start();
            $_SESSION['home'] = $user;//登陆成功，记录登陆成功者的用户信息，相当于为以后检查是否登陆成功开了个证明

            echo 'hi~欢迎来到神奇的世界'; 
        }else{//否则，表示登陆失败
            echo '登陆失败，请重新填写帐号或密码'; 
        }

        //2秒后跳回首页
        $url = C('URL') . '/index.php?p=home&m=index&a=index';
        header('Refresh:2; url='.$url);
        exit;
    }


    #注册相关
    public function register(){ 
        
        //接收注册表单提交的数据
        $acc = addslashes(trim($_POST['acc']));
        $pwd = md5(addslashes(trim($_POST['pwd'])));

        $key = mt_rand(0, 3);
        $nickname =  uniqid($acc.'_') . mt_rand(0, 100);

        $regtime = time();

        //调用模型新增用户数据
        $userModel = \core\App::single('\model\UserModel');
        $sql = "insert into bg_user (acc, nickname, pwd, regtime) values ('{$acc}', '{$nickname}', '{$pwd}', {$regtime})";
        
        if( $userModel->setData($sql) ){//表示执行新增成功
            echo '注册成功！'; 
        }else{//执行新增失败
            echo '注册失败！'; 
        }
        $url = C('URL') . '/index.php?p=home&m=index&a=index';
        header('Refresh:2; url='.$url);
        exit;
    }


    #博文详情页
    public function showInfo(){ 

        //接收GET方式传递的文章id
        $id = $_GET['id'];

        //调用模型查询需要回显的数据
        $articleModel = \core\App::single('\model\ArticleModel');
        $sql = "select * from bg_article where id={$id}";
        $article = $articleModel->getRow($sql);

        //调用模型查询评论数据
        $commentModel = \core\App::single('\model\CommentModel');
        $sql = "select * from bg_comment where article_id={$id} order by post_date";
        $comments = $commentModel->getRows($sql);

        //分配模板变量回显数据
        $this->assign('article', $article);
        $this->assign('comments', $comments);
        
        //渲染模板
        $this->display('blogShow.html');
    }


   #首页相关
   public function index(){ 

       //调用模型查询需要显示的数据
       $articleModel = \core\App::single('\model\ArticleModel');
       $sql = 'select id, title, intro, user_nickname, cat_name, comment_num, post_date from bg_article where 1 order by post_date desc limit 10';
       $articles = $articleModel->getRows($sql);

       //调用模型查询所有的整理好的分类数据
       $catModel = \core\App::single('\model\CatModel');
       $cats = $catModel->getAllCats();

        //分配模板变量
        $this->assign('articles', $articles);
        $this->assign('cats', $cats);
    
        //渲染模板
        $this->display('blogShowList.html');
   }
}