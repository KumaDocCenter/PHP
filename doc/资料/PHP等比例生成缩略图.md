# PHP等比例生成缩略图

```php
    /**
     * 等比例生成缩略图
     * @param $imgSrc
     * @param $resize_width
     * @param $resize_height
     * @param $isCut
     * @author james.ou 2011-11-1
     */
    public function reSizeImg($imgSrc, $resize_width, $resize_height, $isCut = false) {
        //图片的类型
        $type = substr(strrchr($imgSrc, "."), 1);
        //初始化图象
        if ($type == "jpg") {
            $im = imagecreatefromjpeg($imgSrc);
        }
        if ($type == "gif") {
            $im = imagecreatefromgif($imgSrc);
        }
        if ($type == "png") {
            $im = imagecreatefrompng($imgSrc);
        }
        //目标图象地址
        $full_length = strlen($imgSrc);
        $type_length = strlen($type);
        $name_length = $full_length - $type_length;
        $name = substr($imgSrc, 0, $name_length - 1);
        $dstimg = $name . "_s." . $type;
 
        $width = imagesx($im);
        $height = imagesy($im);
 
        //生成图象
        //改变后的图象的比例
        $resize_ratio = ($resize_width) / ($resize_height);
        //实际图象的比例
        $ratio = ($width) / ($height);
        if (($isCut) == 1) { //裁图
            if ($ratio >= $resize_ratio) { //高度优先
                $newimg = imagecreatetruecolor($resize_width, $resize_height);
                imagecopyresampled($newimg, $im, 0, 0, 0, 0, $resize_width, $resize_height, (($height) * $resize_ratio), $height);
                ImageJpeg($newimg, $dstimg);
            }
            if ($ratio < $resize_ratio) { //宽度优先
                $newimg = imagecreatetruecolor($resize_width, $resize_height);
                imagecopyresampled($newimg, $im, 0, 0, 0, 0, $resize_width, $resize_height, $width, (($width) / $resize_ratio));
                ImageJpeg($newimg, $dstimg);
            }
        } else { //不裁图
            if ($ratio >= $resize_ratio) {
                $newimg = imagecreatetruecolor($resize_width, ($resize_width) / $ratio);
                imagecopyresampled($newimg, $im, 0, 0, 0, 0, $resize_width, ($resize_width) / $ratio, $width, $height);
                ImageJpeg($newimg, $dstimg);
            }
            if ($ratio < $resize_ratio) {
                $newimg = imagecreatetruecolor(($resize_height) * $ratio, $resize_height);
                imagecopyresampled($newimg, $im, 0, 0, 0, 0, ($resize_height) * $ratio, $resize_height, $width, $height);
                ImageJpeg($newimg, $dstimg);
            }
        }
        ImageDestroy($im);
    }
```

