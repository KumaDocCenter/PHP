<?php

namespace admin\controller;//创建一个 全局空间  下的  admin空间  下的  controller空间
use \core\Controller;//引入  全局空间  下的  core空间  下的  Controller类

class UserController extends Controller{

    #列表页相关
    public function showIndex(){ 
        
        //调用模型查询列表页需要的数据
        $model = \core\App::single('\model\UserModel');
        $sql = 'select id, nickname, acc, type, regtime from bg_user where 1 order by regtime desc';
        $users = $model->getRows($sql);

        //分配模板变量
        $this->assign('users', $users);

        //渲染模板
        $this->display('User/userIndex.html');
    }

    #添加页相关
    public function showAd(){ 
        
        //渲染模板
        $this->display('User/userAdd.html');
    }
    //程序处理方法
    public function adh(){ 
        
        //接收form表单提交的数据
        $acc = trim($_POST['acc']);
        $pwd = md5(trim($_POST['pwd']));//对密码进行MD5方式的加密
        $type = trim($_POST['type']);//用户类型
        $nickname = trim($_POST['nickname']);//用户昵称
        $cell = trim($_POST['cell']);//手机号

        $regtime = time();

        //调用模型
        $model = \core\App::single('\model\UserModel');
        $sql = "insert into bg_user values (null, '{$acc}', '{$nickname}', '{$pwd}', '{$cell}', {$regtime}, {$type})";
        $re = $model->setData($sql);

        if( $re ){//执行添加成功
            echo '欢迎你哟！'; 
        }else{//执行添加失败
            echo '添加失败，请联系管理员！'; 
        }

        //2秒后跳回到后台用户管理系统列表页
        $url = C('URL') . '/index.php?p=admin&m=user&a=showIndex';
        header('Refresh:2; url='.$url);
        exit;
    }

    #编辑页相关
    public function showUpd(){ 

        //接收GET方式传递的id值
        $id = $_GET['id'];

        //调用模型查询需要回显的数据
        $model = \core\App::single('\model\UserModel');
        $sql = "select id, acc, nickname, cell, type from bg_user where id={$id}";
        $user = $model->getRow($sql);

        //分配模板变量
        $this->assign('user', $user);
        
        //渲染模板
        $this->display('User/userEdit.html');
    }
    //编辑功能
    public function updh(){ 

        //接收GET方式传递的id值
        $id = $_GET['id'];

        //接收POST方式传递的表单数据
        $acc = trim($_POST['acc']);
        $pwd = md5(trim($_POST['pwd']));//对密码进行MD5方式的加密
        $type = trim($_POST['type']);//用户类型
        $nickname = trim($_POST['nickname']);//用户昵称
        $cell = trim($_POST['cell']);//手机号

        //对比数据，检查提交的数据是否是修改过了的数据
        $model = \core\App::single('\model\UserModel');
        $sql = "select acc, pwd, type, nickname, cell from bg_user where id={$id}";//查询没有改变之前的数据
        $oldUser = $model->getRow($sql);

        $strArr = [];

        if( $acc!=$oldUser['acc'] ){//提交的帐号数据和数据表原来有的帐号数据如果不相等，则说明提交的数据是修改了的数据
            $strArr[] = "acc='{$acc}'";
        }

        if( $type!=$oldUser['type'] ){//$type新提交的type值与老的type值$oldUser['type']不相等，说明type被改了
            $strArr[] = "type={$type}";
        }

        if( $nickname!=$oldUser['nickname'] ){
            $strArr[] = "nickname='{$nickname}'";
        }

        if( $cell!=$oldUser['cell'] ){
            $strArr[] = "cell='{$cell}'";
        }

        if( $pwd!=$oldUser['pwd']&&trim($_POST['pwd'])!='' ){//只要提交的密码不等于老的密码  并且  提交的密码不能是空字符串，则说明才是被修改了的密码
            $strArr[] = "pwd='{$pwd}'";
        }

        //var_dump( $strArr ); echo '<hr/>';

        $target = implode($strArr, ', ');//如果acc和cell被修改了，则最后拼接的字符串结果为：acc='wangwu11', cell='186'
        //var_dump( $target ); echo '<hr/>';


        if( empty($strArr) ){//如果为空则表示没有数据被更新
        
            echo '不要胡闹哦~'; 
        }else{//否则，才是有数据被更新了
            //构建更新数据的SQL语句
            $sql = "update bg_user set {$target} where id={$id}";//将$target拼接到SQL语句中来，作为set后面需要更新的数据部分
            //var_dump( $sql ); echo '<hr/>';
            $re = $model->setData($sql);//执行更新SQL语句

            if( $re ){//执行成功
                echo '更新成功'; 
            }else{//执行失败
                echo '更新失败'; 
            }
        }

        $url = C('URL') . '/index.php?p=admin&m=user&a=showUpd&id='.$id;
        header('Refresh:2; url='.$url);//2秒之后跳回更新页面
    }
    

    #测试验证码输出方法
    public function test(){ 
        
        //$img = new CaptchaTool;
        $img = \core\App::single('\plugins\CaptchaTool');
        $img->output();
    }
}