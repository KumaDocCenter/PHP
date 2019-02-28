<?php
/* // echo date_default_timezone_get ( );
$weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
echo "星期".$weekarray[date("w")];  //（0 表示 Sunday[星期日]，6 表示 Saturday[星期六]）

// echo phpinfo();


?>

<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'cn';
if($lang == 'en'){
    $word = 'Hello';
}else{
    $word = '你好';
}
echo($word); */

// http协议分析
$httptop;
if ($_SERVER['HTTPS'] != "on") {
	$httptop = 'http://';
 }else{    
	$httptop = 'https://';
}
//包含端口号的完整url
$fullurl = $httptop.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];  


//------------------------
// http协议类型分析
$httptop;
if ($_SERVER['HTTPS'] != "on") {
	$httptop = 'http://';
 }else{    
	$httptop = 'https://';
}
echo '<br /><br /><br />';
echo '获取域名或主机地址:<br />';  
echo $_SERVER['HTTP_HOST']."<br /><br />"; 
echo '获取网页地址:<br />';   
echo $_SERVER['PHP_SELF']."<br /><br />";  
echo '获取网址参数:<br />';  
echo $_SERVER["QUERY_STRING"]."<br /><br />";  
echo '获取用户代理:<br />';   
echo $_SERVER['HTTP_REFERER']."<br /><br />";  
echo '获取完整的url:<br />';   
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."<br />";  
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']."<br /><br />";  
echo '包含端口号的完整url:<br />';   
echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]."<br /><br />";  
echo '不包含端口号的完整url:<br />';   
$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]."<br /><br />";  
echo dirname($url);  

echo '<br/>-------------------------------<br/>';


/*
* URL handle
* URL  处理
*/
class Url_handle{
	
	function __construct() {
        $this->allInfo();
   }
	
	/*
	* http://wiki.com/p1.php?user=aa
	* Get URL info
	* 获取URL信息
	*
	* return  array   e.g. 'HTTP_HOST' => 'wiki.com:8800'
	* 返回    数组     如. 'HTTP_HOST' => 'wiki.com:8800'
	*/
	function allInfo(){
		$httptop;
		/* http协议类型分析 */
        if ($_SERVER['HTTPS'] != "on") {
	        $httptop = 'http://';
        }else{    
	        $httptop = 'https://';
        }
		/* URL 信息 */
		$allArray = array(
		 'HTTP_HOST' => $_SERVER['HTTP_HOST'], //获取域名或主机地址  wiki.com:8800
		 'PHP_SELF' => $_SERVER['PHP_SELF'],  //获取网页地址  /p1.php
		 'QUERY_STRING' => $_SERVER['QUERY_STRING'],  //获取网址参数  user=aa
		 'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],  //获取用户代理
		 'ALL_URL' => $httptop.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],  //包含端口号的完整url  http://wiki.com:8800/p1.php?user=aa
		 'ALL_URL_NOPORT' => $httptop.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"],  //不包含端口号的完整url http://wiki.com/p1.php?user=aa
		);
		return $allArray;
		 
	}
	
	/*
	*  user=aa
	*  Get query info of URL
	*  获取URL传递的参数信息
	*
	* return  array   e.g. 'user' => 'aa'
	* 返回    数组     如. 'user' => 'aa'
	*/
	function query_info(){
	  $queryStr = $this->allInfo();
      $queryParts = explode('&', $queryStr['QUERY_STRING']);
      $params = array();
      foreach ($queryParts as $param) {
          $item = explode('=', $param);
          $params[$item[0]] = $item[1];
        }
        return $params; 
	}
	
	
}

/*
* Array handle
* 数组处理
*/
class arr_handle{
	
   function __construct() {

   }

    
	/*
    * Array filter call back Method
	* 数组过滤 回调方法
	*/
    function searchArray($array){
		
		$urlStr = new Url_handle();
        $urlQuery = $urlStr-> query_info();
        $Lvalue = $urlQuery['name'];
		foreach($array as $key=>$value){  // $key = 'name'  $value = 'Samuel'
           if($value==$Lvalue){
			  return true;               
            }else{
			  return false;				  
			} 
        }

	}
	
    /*
    * Array filter _file
	* 数组过滤   _文件
	*/
    function searchArray_file($array){		 
		
		$urlStr = new Url_handle();
        $urlQuery = $urlStr-> query_info();
        $Lvalue = $urlQuery['user'];
		$fields = array();
		$newArrStr;
		
		// 遍历数组
		foreach($array as $key=>$value){  // $key = 'name'  $value = 'Samuel'
		   $fileArr = @file($value);	  // 数组的值作为文件路径
           if(is_array($fileArr)) foreach($fileArr as $fArr){   //文件内容作为数组遍历
                $fields = explode(" ",$fArr);	                //分割成数组              
                
		   }
		   
           if(in_array($Lvalue, $fields)){    //检查数组中是否存在值			  
			  $newArrStr .= '###'.$value;      //传入数组的值，连接成字符串，待分割成数组 
			  print_r($newArrStr);          //调试用的
			                
            }
        }
		
		$newArr = explode("###",$newArrStr);  //首位数组为空值
		return  array_filter($newArr);        //返回数组，已过滤空值

	}
    
	/*
    * Array filter
	* 数组过滤
	*
	* @$arr array   input array
	* @$arr array   输入数组
	*/
	function arr_filter($arr){
		   
	return	array_filter($arr, array($this,'searchArray') );
		
	}
   
   
}
$p2= array(
0 => './data/meta/.mlist' ,
1 => './data/meta/plugins/.mlist' ,
2 => './data/meta/start.mlist' ,
3 => './data/meta/test/.mlist' ,
4 => './data/meta/test/test2.mlist' ,
);

 $people = array(
  2 => array(
    'name' => 'John',
    'fav_color' => 'green'
  ),
  3 => array(
    'name' => 'John',
    'fav_color' => 'green'
  ),
  5=> array(
    'name' => 'Samuel',
    'fav_color' => 'blue'
  )
);

$bb=new arr_handle();
// print_r($p2);
print_r($bb->searchArray_file($p2));	
?>
<?php
$path = 'wiki:site:info';
$filename = substr(strrchr($path, ":"), 1);
echo $filename.'<br/>';// info

echo strrchr($path, ":").'<br/>'; //:info

/**
* $conf[$keyType][$keyTypeName][$keyName]
* $conf['plugin']['anewssystem']['prev_length']  
*
* @param string $keyName  键名
* @param string $keyType  键类型
* @param string $keyTypeName 键类型名
* @return string
*/
function getFarmConf($keyName,$keyType="",$keyTypeName=""){
		$fields = array(); //最终数组
		// $filelocal = @file(DOKU_CONF.'local.php',FILE_SKIP_EMPTY_LINES);	
		$filelocal = @file('C:\Users\meuser\Desktop\dokuwiki+server-2017-02-19b\DokuWikiStick\dokuwiki\conf\local.php',FILE_SKIP_EMPTY_LINES);
		$filelocal=str_replace(';','',$filelocal);  //去除分号 ‘;’ 
        $filelocal=array_filter($filelocal,'callBack_conf');
		
        // 数组构成， $conf['title'] => '插件调试'		
        if(is_array($filelocal)) {
		  foreach($filelocal as $key => $value){
            
			$keyStart = strpos ($value,'$');
			$kv = strpos ($value,'=');
			$valueStart = $kv+1;			
			$keyStr=trim(substr($value,$keyStart,$kv-1));
			$valueStr=trim(substr($value,$kv+1));
			
			$fields[$keyStr]=$valueStr;  // $key => $value 数组赋值
			
		    }
		}
			
				
		$keyS;	// 查询键	
		if($keyType!=="" && $keyTypeName!=="") {
			$keyS= "\$conf['".$keyType."']['".$keyTypeName."']['".$keyName."']"; 
		}else{
			$keyS= "\$conf['".$keyName."']";
		}
		
		// return $fields[$keyS];  //结果，有单引号
		return str_replace("'",'',$fields[$keyS]); //结果，去除单引号
				
		
}

/*
*
* 获取值包含$conf的数组元素
* @return string
*/
function callBack_conf($value){
	
		if(strpos($value,'$conf')!==false){
			return true;
		}else{
			return false;
		}
	
}

echo '</br>';
$a = getFarmConf('site_notice_msg','plugin','sitenotice');
echo $a;
echo '</br>';


?>

