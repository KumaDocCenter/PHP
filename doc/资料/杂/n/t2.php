<?php
   /*
   *可变函数  创建图像句柄
   *输入：文件路径名
   *返回：数组，第一个图像句柄，第二个图像类型
   *失败则返回false
   */
   function createImg($filepath){
      if(!file_exists($filepath) ) return false;  //文件不存在则返回false
      $img_info = getimagesize($filepath);        //获取图像文件信息
 
      switch($img_info[2]){                       //根据图像类型选择操作
          case 1:
                $func_img = 'imagecreatefromgif';
                $img_type = 'gif';
                break;
 
          case 2:
                $func_img = 'imagecreatefromjpeg';
                $img_type = 'jpeg';
                break;
 
          case 3:
                $func_img = 'imagecreatefrompng';
                $img_type = 'png';
                break;
 
          default:
                return false;
      }      
 
      $img = $func_img($filepath);         //创建图像句柄
      return array($img,$img_type);
   }
 
 
   $path = './t/蜘蛛洞地图.jpg';                      //图像文件
//   $path = iconv('utf-8','gb2312',$path);  //转码，避免中文问题
   $img_array = createImg($path);        //调用函数
   $img = $img_array[0];                 //图像句柄
   $img_type = $img_array[1];            //图像类型
 
   header("Content-type:image/$img_type"); //发送header信息
   imagepng($img);                         //输出图像
   imagedestroy($img);                     //释放内存      
?>