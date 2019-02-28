<?php
/*
*函数:绘制校验码
*输入：宽度(可选)，高度(可选)，验证码数量(可选)，干扰点数量(可选)
*输出：PNG格式验证码图片
*/
function createCheckCode($width = 60,$height = 25,$num_code = 5,$num_disturb_points = 200){
 
 
   /* ---------------------创建画布---------------------*/
   $img = imagecreate($width,$height);                       //图像句柄
 
 
   /*---------------------绘制背景和边框---------------------*/
   $bg_color = imagecolorallocate($img,255,255,255);          //背景色
   $border_color = imagecolorallocate($img,0,0,0);            //边框颜色    
   imagerectangle($img,0,0,$width-1,$height-1,$border_color); //绘制边框
 
 
   /*---------------------产生随机码_MD5---------------------*/
   $rand_num = rand();              //产生随机数
   $str = md5($rand_num);           //取得随机数的MD5值
   $str_code = strtoupper(substr($str,0,$num_code) );  //从MD5值截取字符作为验证码。strtoupper()，大写 
 
 
   /*---------------------绘制随机码---------------------*/
   for($i = 0; $i < $num_code; ++$i){
        $str_color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255) );  //随机字体颜色
        $font_size = 5;                                                             //字体大小
        $str_x = floor(($width/$num_code)*$i )+ rand(0,5);                           //随机字体 x 坐标，rand(0,5)，一个区间左右
        $str_y = rand(2,$height-15);                                                 //随机字体 y 坐标
 
        imagechar($img,$font_size,$str_x,$str_y,$str_code[$i],$str_color);  //绘制单个字符
 
   } 
 
 
 
   /*---------------------绘制干扰点---------------------*/
   for($i = 0;$i <$num_disturb_points; ++$i){              
        $point_color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255) );  //随机像素点颜色
        $point_x = rand(2,$width-2);                           //随机像素点 x 坐标
        $point_y = rand(2,$height-2);                          //随机像素点 y 坐标
 
        imagesetpixel($img,$point_x,$point_y,$point_color);  //绘制像素点
    }
 

 
   /* ---------------------输出图片---------------------*/
    header("Content-type: image/png");   //发送header信息
    imagepng($img);                      //输出图像
    imagedestroy($img);                  //释放内存
}
 
 
     /*调用测试*/
     createCheckCode(100,50,5,100);
?>