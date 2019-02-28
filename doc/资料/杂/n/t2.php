<?php
   /*
   *�ɱ亯��  ����ͼ����
   *���룺�ļ�·����
   *���أ����飬��һ��ͼ�������ڶ���ͼ������
   *ʧ���򷵻�false
   */
   function createImg($filepath){
      if(!file_exists($filepath) ) return false;  //�ļ��������򷵻�false
      $img_info = getimagesize($filepath);        //��ȡͼ���ļ���Ϣ
 
      switch($img_info[2]){                       //����ͼ������ѡ�����
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
 
      $img = $func_img($filepath);         //����ͼ����
      return array($img,$img_type);
   }
 
 
   $path = './t/֩�붴��ͼ.jpg';                      //ͼ���ļ�
//   $path = iconv('utf-8','gb2312',$path);  //ת�룬������������
   $img_array = createImg($path);        //���ú���
   $img = $img_array[0];                 //ͼ����
   $img_type = $img_array[1];            //ͼ������
 
   header("Content-type:image/$img_type"); //����header��Ϣ
   imagepng($img);                         //���ͼ��
   imagedestroy($img);                     //�ͷ��ڴ�      
?>