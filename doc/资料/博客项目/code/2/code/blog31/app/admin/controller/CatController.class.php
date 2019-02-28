<?php

namespace admin\controller;//创建一个 全局空间  下的  admin空间  下的  controller空间
use \core\Controller;//引入  全局空间  下的  core空间  下的  Controller类

class CatController extends Controller{

    #编辑页相关
    public function showUpd(){ 
        
        //接收GET方式传递的id值
        $id = $_GET['id'];

        //查询需要回显的数据
        $model = \core\App::single('\model\CatModel');
        $sql = "select * from bg_category where id={$id}";
        $cat = $model->getRow($sql);

        //获得所有整理有序的分类数据
        //$allCat = $this->getAllCats();
        $allCat = $model->getAllCats();

        //分配模板变量
        $this->assign('cat', $cat);
        $this->assign('allCat', $allCat);

        $this->display('Category/categoryEdit.html');
    }
    //编辑处理方法
    public function updh(){ 
        
        //接收表单提交的数据
        $id = $_GET['id'];

        $name = trim($_POST['name']);//新的分类名称
        $old_name = trim($_POST['old_name']);//老的分类名称
        $parent_id = trim($_POST['parent_id']);//新的父级id
        $old_parent_id = trim($_POST['old_parent_id']);//老的父级id

        //检查是否有数据真的被修改了
        $target = [];

        if( $name!=$old_name && $name!='' ){//如果新的名称不等于老的名称并且新的名称不为空，则需要修改name值
            $target[] = "name='{$name}'";
        }

        if( $parent_id!=$old_parent_id ){//如果新的父级id不等于老的父级id
            $target[] = "parent_id={$parent_id}";
        }

        if( !empty($target) ){//如果$target不为空，说明有数据需要被更新
        
            $strTarget = implode(', ', $target);//  $strTarget="name='xxxx', parent_id=xxxx";
            $sql = "update bg_category set {$strTarget} where id={$id}";

            //调用模型执行更新操作
            $model = \core\App::single('\model\CatModel');
            $re = $model->setData($sql);

            if( $re ){//更新成功
                echo '嘿嘿嘿，运气不错，更新成功咯～'; 
            }else{//更新失败
                echo '哈哈哈，你更新失败了！'; 
            }
        }else{//否则给出提示没有数据被更新
            echo '您当前还没有更新数据哟～'; 
        }

        //2秒之后跳转回编辑页
        $url = C('URL') . '/index.php?p=admin&m=cat&a=showUpd&id='.$id;
        header('Refresh:2; url='.$url);
        exit;
    }


    #列表页相关
    public function showList(){ 

        #调用模型查找所有分类数据
        //$model = \core\App::single('\model\CatModel');
        //$sql = 'select * from bg_category where 1';
        //$cats = $model->getRows($sql);//获得所有数据
        //$cats = $this->getAllCats();//得到所有整理之后的分类数据
        $model = \core\App::single('\model\CatModel');
        $cats = $model->getAllCats();//得到所有整理之后的分类数据

        #分配数据
        $this->assign('cats', $cats);
        
        #渲染模板
        $this->display('Category/categoryIndex.html');
    }
}