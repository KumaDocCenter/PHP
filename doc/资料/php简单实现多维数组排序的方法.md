# php简单实现多维数组排序的方法

**来源** https://www.jb51.net/article/93923.htm



本文实例讲述了php简单实现多维数组排序的方法。分享给大家供大家参考，具体如下：

之前在做一个功能的时候，必须要把数据放到二维数组里并且排序，然后上网找找解决思路，

这时候会用到array_multisort函数，**array_multisort()** 函数对多个数组或多维数组进行排序

注意，数字键将被重新索引

先来看一个实例

```php
<?php
$data=array(
        0=>array('one'=>34,'two'=>'d'),
        1=>array('one'=>45,'two'=>'e'),
        2=>array('one'=>47,'two'=>'h'),
        3=>array('one'=>12,'two'=>'c'),
        4=>array('one'=>15,'two'=>'w'),
        5=>array('one'=>85,'two'=>'r'),
);
foreach($data as $val){
$key_arrays[]=$val['one'];
}
array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$data);
var_dump($data);
```



输出结果：按键值one排序，如下：

```php
array
 0 => 
  array
   'one' => int 12
   'two' => string 'c' (length=1)
 1 => 
  array
   'one' => int 15
   'two' => string 'w' (length=1)
 2 => 
  array
   'one' => int 34
   'two' => string 'd' (length=1)
 3 => 
  array
   'one' => int 45
   'two' => string 'e' (length=1)
 4 => 
  array
   'one' => int 47
   'two' => string 'h' (length=1)
 5 => 
  array
   'one' => int 85
   'two' => string 'r' (length=1)
```



**php 多维数组排序**

下面来封装成函数方便使用

```php
function my_array_multisort($data,$sort_order_field,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC){
    foreach($data as $val){
    	$key_arrays[]=$val[$sort_order_field];
    }
    array_multisort($key_arrays,SORT_ASC,SORT_NUMERIC,$data);
    return $data;
}
```



