<?php

namespace admin\controller;//创建一个 全局空间  下的  admin空间  下的  controller空间
use \core\Controller;//引入  全局空间  下的  core空间  下的  Controller类

class ArticleController extends Controller{

    #列表页相关
    public function showList(){ 

        //接收搜索表单提交的数据
        $s_title = isset($_REQUEST['s_title']) ? trim($_REQUEST['s_title']) : '';
        $s_cat_id = isset($_REQUEST['s_cat_id']) ? trim($_REQUEST['s_cat_id']) : 0;
        $s_user_id = isset($_REQUEST['s_user_id']) ? trim($_REQUEST['s_user_id']) : 0;

        //$condition = "1 and title like '%{$s_title}%' and  cat_id={$s_cat_id} and user_id={$s_user_id}";
        $condition = "1";

        if( !empty($s_title) ){//如果接收的搜索标题不为空，则表示是一个有效的搜索条件
            $condition .= " and title like '%{$s_title}%'";
        }

        if( $s_cat_id!=0 ){//如果接收的搜索分类id不为0值，则表示是一个有效的搜索条件
            $condition .= " and  cat_id={$s_cat_id}";
        }

        if( $s_user_id!=0 ){//如果接收的搜索管理员用户id不为0值，则表示是一个有效的搜索条件
            $condition .= " and user_id={$s_user_id}";
        }

        //分配接收到的搜索数据
        $this->assign('s_title', $s_title);
        $this->assign('s_cat_id', $s_cat_id);
        $this->assign('s_user_id', $s_user_id);

        //调用模型查找数据
        $model = \core\App::single('\model\ArticleModel');

        //计算分页所需参数
        $nowPage =  isset($_GET['page']) ? $_GET['page'] : 1;//当前页，只要没有page参数，则默认为第一页
        $numPerPage = 10;//每页显示10条

        //$sql = "select count(*) as num from bg_article where 1";
        $sql = "select count(*) as num from bg_article where {$condition}";
        $totalNumArr = $model->getRow($sql);//执行SQL语句查询总的数据条数

        $totalPage = (int)ceil($totalNumArr['num']/$numPerPage);//总页数
        $totalPage = ($totalPage==0) ? 1 : $totalPage;//排除总页数为0的这种情况

        //$url = C('URL') . "/index.php?p=admin&m=article&a=showList&page";//分页链接
        $url = C('URL') . "/index.php?p=admin&m=article&a=showList&s_title={$s_title}&s_cat_id={$s_cat_id}&s_user_id={$s_user_id}&page";//分页链接

        $pageHtml = pageHtml($nowPage, $totalPage, $url);//调用函数获取分页的HTML部分
        $this->assign('pageHtml', $pageHtml);//分配模板变量

        $firstNum = ($nowPage-1)*$numPerPage+1;//当前页的第一条数据的序号
        $this->assign('firstNum', $firstNum);

/*

数据表中总的记录条数：246
每一页显示10条
总共页数：246/10=24.6

页码       偏移量$x                             每页显示的条数
1               0                                              10
2               10                                            10
3               20                                            10
nowPage    (nowPage-1)*10                      10

*/
        //查询当前页显示的数据
        //$sql = "select id, title, post_date, intro, cat_name, comment_num from bg_article where 1 order by post_date desc limit 10";

        $x = ($nowPage-1)*$numPerPage;//limit的偏移量
        //$sql = "select id, title, post_date, intro, cat_name, comment_num from bg_article where 1 order by post_date desc limit {$x}, {$numPerPage}";
        $sql = "select id, title, post_date, intro, cat_name, comment_num from bg_article where {$condition} order by post_date desc limit {$x}, {$numPerPage}";
        $articles = $model->getRows($sql);
        //分配模板变量
        $this->assign('articles', $articles);


        //查询搜索所需的数据
        //所有的管理员数据
        $userModel = \core\App::single('\model\UserModel');
        $sql = 'select id, nickname from bg_user where type=1';
        $users = $userModel->getRows($sql);

        $this->assign('users', $users);

        //所有的分类数据
        $catModel = \core\App::single('\model\CatModel');
        $cats = $catModel->getAllCats();

        $this->assign('cats', $cats);

        //渲染模板
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

        $content = htmlspecialchars(trim($_POST['content']));
        $post_date = time();

        //获取当前添加者的信息
        @session_start();
        $user_id = $_SESSION['admin']['id'];//发布者的id
        $user_nickname = $_SESSION['admin']['nickname'];//发布者的昵称

        //调用模型新增数据
        $model = \core\App::single('\model\ArticleModel');
        //$sql = "insert into bg_article (title, intro, content, post_date, cat_id, cat_name) values ('{$title}', '{$intro}', '{$content}', '{$post_date}', {$cat_id}, '{$cat_name}')";
        $sql = "insert into bg_article (title, intro, content, post_date, cat_id, cat_name, user_id, user_nickname) values ('{$title}', '{$intro}', '{$content}', '{$post_date}', {$cat_id}, '{$cat_name}', {$user_id}, '{$user_nickname}')";

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

    #编辑页相关
    public function showUpd(){ 
        
        //接收GET方式传递的id值
        $id = $_GET['id'];

        //根据接收的id值查询需要回显的数据
        $model = \core\App::single('\model\ArticleModel');
        $sql = "select id, title, intro, content, cat_name, cat_id from bg_article where id={$id}";
        $article = $model->getRow($sql);

        @session_start();
        $key = 'old_article' . $article['id'];
        //$_SESSION['old_article'] = $article;
        $_SESSION[$key] = $article;


        //查询所有整理好的分类数据
        $catModel = \core\App::single('\model\CatModel');
        $cats = $catModel->getAllCats();

        //分配模板变量
        $this->assign('article', $article);
        $this->assign('cats', $cats);

        //渲染模板
        $this->display('Article/articleEdit.html');
    }

    public function updh(){ 
        
        //接收表单传递的数据
        //GET传递的
        $id = $_GET['id'];

        //POST传递的
        $new_title = trim($_POST['title']);
        $new_intro = trim($_POST['intro']);
        
        $cat = $_POST['cat'];
        $catArr = explode('|', $cat);//处理接收到的分类数据
        $new_cat_id = $catArr[0];
        $new_cat_name = $catArr[1];

        $new_content = trim($_POST['content']);

        //检查哪些数据真的被修改了
        @session_start();
        $target = [];
        $key = 'old_article' . $id;


        if( $new_title!=$_SESSION[$key]['title']&&!empty($new_title) ){//如果新的标题数据和老的标题数据不一样，则说明标题确实被修改了
            $target[] = "title='{$new_title}'";
        }

        if( $new_intro!=$_SESSION[$key]['intro']&&!empty($new_intro) ){//如果新的简介数据和老的简介数据不一样，则说明简介确实被修改了
            $target[]  = "intro='{$new_intro}'";
        }

        if( $new_cat_id!=$_SESSION[$key]['cat_id'] ){//如果新的分类id数据和老的分类id数据不一样，则说明分类确实被修改了
            //                 cat_id=xxx, cat_name="xxx"
            $target[] = "cat_id={$new_cat_id}, cat_name='{$new_cat_name}'";
        }

        if( $new_content!=$_SESSION[$key]['content']&&!empty($new_content) ){//如果新的内容数据和老的内容数据不一样，则说明内容确实被修改了
            $target[]  = "content='{$new_content}'";
        }

        //根据检查的结果判断是否需要真的执行更新操作
        if( !empty($target) ){//$target不为空，则说明确实有数据被修改了
        
            $strTarget = implode(',', $target);
            
            $model = \core\App::single('\model\ArticleModel');
            $sql = "update bg_article set {$strTarget} where id={$id}";

            if( $model->setData($sql) ){//执行成功
                
                echo '修改成功！'; 
            }else{//执行失败
                echo '修改失败，请联系超级管理员！'; 
            }

        }else{//否则，则说明没有数据需要被更新
            echo '您还没有修改数据呐～';     
        }

        //2秒之后跳回编辑页
        $url = C('URL') . '/index.php?p=admin&m=article&a=showUpd&id='.$id;
        header('Refresh:2; url='.$url);
        exit;
    }
}




