<?php

namespace plugins;//创建一个   全局空间  下的  plugins空间

class CaptchaTool{

    private $_w;//画布的宽度
    private $_h;//画布的高度

    private $_img;//画布资源
    
    public function __construct($w=200, $h=80){ 
        
        #初始化参数
        $this->_w = $w;
        $this->_h = $h;

        $this->_img = imagecreatetruecolor($this->_w, $this->_h);//创建画布

        #填充背景色
        $color = $this->color();//获得随机色
        imagefill($this->_img, 0, 0, $color);//填充背景色

        #写字
        $randStr = $this->randStr();//构建4个随机字
        $color = $this->color();//获得随机色
        $fontPath = PUBLIC_PATH . '/fonts/font1.ttf';//字体文件所在路径
        $bx = $this->_w/4;//左下角起点x坐标
        $by = $this->_h*3/4;//左下角起点y坐标
        $fontSize = $this->_h *37/80;//字体大小，高度尺寸的37/80

        imagettftext($this->_img, $fontSize, 0, $bx, $by, $color, $fontPath, $randStr);//写字

        #设置干扰元素
        //设置干扰点
        $this->setPoint(180);

        //设置干扰线
        $this->setLine(8);
    }

    #画干扰线
    private function setLine($num){ 

        for($i=0; $i<$num; $i++ ){ //画$num个点
            $color = $this->color();//获得随机色

            $bx = mt_rand(0, $this->_w/2);//起点x坐标
            $by = mt_rand(0, $this->_h);//起点y坐标
            $ex = mt_rand($this->_w/2, $this->_w);//终点x坐标
            $ey = mt_rand(0, $this->_h);//终点y坐标

            imageline($this->_img, $bx, $by, $ex, $ey, $color);//画点
        }
    }

    #画干扰点
    private function setPoint($num){ 

        for($i=0; $i<$num; $i++ ){ //画$num个点
            $color = $this->color();//获得随机色

            $bx = mt_rand(0, $this->_w);//起点x坐标
            $by = mt_rand(0, $this->_h);//起点y坐标
            $ex = mt_rand($bx-2, $bx+2);//终点x坐标
            $ey = mt_rand($by-2, $by+2);//终点y坐标

            imageline($this->_img, $bx, $by, $ex, $ey, $color);//画点
        }
    }

    #构建随机字
    private function randStr($num=4){ 
        
        $mixedArr = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));//构建随机字采集库

        $str = '';
        for($i=0; $i<$num; $i++ ){ //采集$num次
            
            $key = mt_rand(0, count($mixedArr)-1);//取得当前随机字符对应的元素下标
            $str .= $mixedArr[$key];//从字库中取得下标为$key的元素值拼接给$str
        }

        return $str;
        
    }

    #分配颜色
    private function color($r='', $g='', $b=''){ 
        
        //初始化三原色
        $r = ($r==='') ? mt_rand(0, 255) : $r;//红
        $g = ($g==='') ? mt_rand(0, 255) : $g;//绿
        $b = ($b==='') ? mt_rand(0, 255) : $b;//蓝

        //分配颜色
        return imagecolorallocate($this->_img, $r, $g, $b);
    }

    #输出图像的方法
    public function output(){ 
        
        header('Content-type:image/jpeg');//指定一个响应协议项

        imagejpeg($this->_img);//直接将图像输出到浏览器
    }
}