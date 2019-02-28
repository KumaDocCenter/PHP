<?php

namespace home\controller;   //创建了一个  全局空间   下的   home空间  下的   controller空间
use \core\Controller;   //引入  全局空间  下的  core空间  下的  Controller类

class TestController extends Controller{


    public function test(){ 
        
        $model = \core\App::single('\model\TestModel');
        echo '测试模型对象：'; 
        var_dump( $model ); echo '<hr/>';
        //echo '<hr/>';
        //echo '验证码测试展示：<img src="'.URL.'/index.php?p=admin&m=test&a=captchaTest" /><hr/>'; 
        echo '<hr/>';
        echo '恭喜您，框架部署成功！'; 
    }
}