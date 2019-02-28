<?php

namespace model;   //创建了一个   全局空间   下的   model空间
use \core\Model;    //引入   全局空间  下的  core空间  下的  Model类

class CatModel extends Model{//继承父类模型

    //查找所有经过整理之后的有序分类数据数组集合
    //private function getAllCats(){
    public function getAllCats(){
        //查询所有分类数据
        //$model = \core\App::single('\model\CatModel');
        $sql = 'select * from bg_category where 1';
        //$allCats = $model->getRows($sql);//获得所有数据
        $allCats = $this->getRows($sql);//获得所有数据

        $cats = [];
        $this->recursiveCat($allCats, $cats);//调用无限级递归分类方法
        //echo '<pre>';
        //print_r( $cats ); 

        //return $allCats;
        return $cats;
    }

    /**
     *  整理分类数据的顺序的
     * @param   $allCats    array    从数据表中查得的所有分类的数据，（即表示从哪个分类数组集合中找符合条件的目标），例：通过select * from bg_category where 1查得的分类的所有数据
     * @param   $cats  array    存放整理后的分类数据数组
     * @param   $parent_id    int   表示需要查询的分类数据父级的id
     * @param   $space   int     当前查找到的分类需要缩进的个数
     */
    private function recursiveCat($allCats, &$cats, $parent_id=0, $space=0){ 
        
        foreach( $allCats as $cat ){ //从所有的分类中找
            
            if( $cat['parent_id']==$parent_id ){//获得所有的顶级分类的条件，能够走进这个if中，说明这个分类一定是顶级分类
                $cat['space'] = $space;
                $cats[] = $cat;

                $this->recursiveCat($allCats, $cats, $cat['id'], $space+1);//调用相同的操作，查找当前这个分类的子分类
                /*foreach( $allCats as $cat2 ){ 
                    
                    if( $cat2['parent_id']==$cat['id'] ){//获得所有的二级分类的条件
                        $cat2['space'] = $space+1;
                        $cats[] = $cat2;
                    }
                }*/

            }
        }
    }
}