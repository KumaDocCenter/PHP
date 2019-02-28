<?php
/*
*����:����У����
*���룺���(��ѡ)���߶�(��ѡ)����֤������(��ѡ)�����ŵ�����(��ѡ)
*�����PNG��ʽ��֤��ͼƬ
*/
function createCheckCode($width = 60,$height = 25,$num_code = 5,$num_disturb_points = 200){
 
 
   /* ---------------------��������---------------------*/
   $img = imagecreate($width,$height);                       //ͼ����
 
 
   /*---------------------���Ʊ����ͱ߿�---------------------*/
   $bg_color = imagecolorallocate($img,255,255,255);          //����ɫ
   $border_color = imagecolorallocate($img,0,0,0);            //�߿���ɫ    
   imagerectangle($img,0,0,$width-1,$height-1,$border_color); //���Ʊ߿�
 
 
   /*---------------------���������_MD5---------------------*/
   $rand_num = rand();              //���������
   $str = md5($rand_num);           //ȡ���������MD5ֵ
   $str_code = strtoupper(substr($str,0,$num_code) );  //��MD5ֵ��ȡ�ַ���Ϊ��֤�롣strtoupper()����д 
 
 
   /*---------------------���������---------------------*/
   for($i = 0; $i < $num_code; ++$i){
        $str_color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255) );  //���������ɫ
        $font_size = 5;                                                             //�����С
        $str_x = floor(($width/$num_code)*$i )+ rand(0,5);                           //������� x ���꣬rand(0,5)��һ����������
        $str_y = rand(2,$height-15);                                                 //������� y ����
 
        imagechar($img,$font_size,$str_x,$str_y,$str_code[$i],$str_color);  //���Ƶ����ַ�
 
   } 
 
 
 
   /*---------------------���Ƹ��ŵ�---------------------*/
   for($i = 0;$i <$num_disturb_points; ++$i){              
        $point_color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255) );  //������ص���ɫ
        $point_x = rand(2,$width-2);                           //������ص� x ����
        $point_y = rand(2,$height-2);                          //������ص� y ����
 
        imagesetpixel($img,$point_x,$point_y,$point_color);  //�������ص�
    }
 

 
   /* ---------------------���ͼƬ---------------------*/
    header("Content-type: image/png");   //����header��Ϣ
    imagepng($img);                      //���ͼ��
    imagedestroy($img);                  //�ͷ��ڴ�
}
 
 
     /*���ò���*/
     createCheckCode(100,50,5,100);
?>