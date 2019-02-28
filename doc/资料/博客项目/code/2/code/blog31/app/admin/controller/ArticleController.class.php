<?php

namespace admin\controller;//创建一个 全局空间  下的  admin空间  下的  controller空间
use \core\Controller;//引入  全局空间  下的  core空间  下的  Controller类

class ArticleController extends Controller{

    #列表页相关
    public function showList(){ 
        
        //调用模型查找数据
        $model = \core\App::single('\model\ArticleModel');
        $sql = "select id, title, post_date, intro, cat_name, comment_num from bg_article where 1 order by post_date desc limit 10";
        $articles = $model->getRows($sql);

        //分配模板变量
        $this->assign('articles', $articles);

        $this->display('Article/articleIndex.html');
    }

    #添加页相关
    public function showAd(){ 
        
        //查询所有整理后的分类数据
        $catModel = \core\App::single('\model\CatModel');
        $allCat = $catModel->getAllCats();

        //分配模板变量
        $this->assign('allCat', $allCat);

        $this->display('Article/articleAdd.html');
    }
    //添加文章处理方法
    public function adh(){ 
        
        //接收表单提交的数据
        $title = trim($_POST['title']);
        $intro = trim($_POST['intro']);

        $cat = trim($_POST['cat']);
        $catArr = explode('|', $cat);
        $cat_id = $catArr[0];//所属分类id
        $cat_name = $catArr[1];//所属分类的名称

        $content = trim($_POST['content']);
        $post_date = time();

        //调用模型新增数据
        $model = \core\App::single('\model\ArticleModel');
        $sql = "insert into bg_article (title, intro, content, post_date, cat_id, cat_name) values ('{$title}', '{$intro}', '{$content}', '{$post_date}', {$cat_id}, '{$cat_name}')";
        //var_dump( $sql ); 

        $re = $model->setData($sql);

        if( $re ){//执行成功
            echo '你好棒棒哟~'; 
        }else{//执行失败
            echo '嘿嘿嘿嘿，添加失败咯～'; 
        }

        //2秒之后跳转到博文列表页
        $url = C('URL') . '/index.php?p=admin&m=article&a=showList';
        header('Refresh:2; url='.$url);
        exit;
    }
}