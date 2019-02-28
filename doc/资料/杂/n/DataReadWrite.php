<?php
/**
* @title     PHP implements the four basic methods of inserting, modifying, deleting, and querying the text database.
* @title_zh  PHP实现对文本数据库的插入、修改、删除、查询 四大基本操作的方法。 
*
* @abstract   TxtDB 
* @access     public
* @author     kuma<kuma000@qq.com>
* @date       2017-08-15 
*  
*/
class TxtDB {
    /* 示例数据
    * datatime_create=2017-08-15 02:31:35|id=Axcg1502735495|sub_time=2017-08-15 02:31:35|name=php|class=pc|des=phpdec|status=UnderReview|ok_time=|url=http://www.goo.com|wiki_des=
    * "|" 	二级分割符     "="  三级分割符
	* 结果：
	
Array ( 
       [0] => Array ( 
           [datatime_create] => 2017-08-15 02:31:35 
		   [id] => Axcg1502735495 
		   [sub_time] => 2017-08-15 02:31:35 
		   [name] => php 
		   [class] => pc 
		   [des] => phpdec 
		   [status] => UnderReview 
		   [handle_time] => 
		   [url] => http://www.goo.com 
		   [wiki_des] => 
		) 
    ) 		
	*/
	
    public  $DefaultDataFile; //默认数据文件
    private $separator_2; //二级分割符，即 一维数组生成二维数组 的分割依据 。因list()已按行分割成一维数组，所以命名为 _2
    private $separator_3; //三级分割符，即 析构二维数组的值 。再次细分值的字符串，使其成为 键=>值 对
	private $time_offset; //时区偏移量	
	public  $Status_code=array();  //错误状态码   Error status code
	
     
    /**
     * @title     Constructor function 
	 * @title_zh  构造函数
     * @param  string  $DataFile   @note_zh 必需，数据文件路径  @note  Required, data file path
     * @param  string  $sep2  @note_zh 二级分割符               @note  Secondary separator
	 * @param  string  $sep3  @note_zh 三级分割符               @note  Tertiary separator
	 * @param  int  $t_offset @note_zh 时区偏移量               @note  Time zone offset
     */    
    public function __construct($DataFile,$t_offset=8,$sep2="",$sep3="") {
		
        $this->DefaultDataFile = $DataFile; // 数据文件必需在实例化时指定
		if(!empty($sep2)){
			$this->separator_2 = $sep2;
		}else{
			$this->separator_2 = "|";
		}
		
         
        if(!empty($sep3)){
			$this->separator_3 = $sep3;
		}else{
			$this->separator_3 = "=";
		} 
		
		if(!empty($time_offset)){
			$this->time_offset = $t_offset;
		}else{
			$this->time_offset = 8;
		} 

    }
	
    /**
     * @title    Data insert
	 * @title_zh 数据插入
     * @param  array  $input  @note_zh 需插入的记录  @note Need to insert the record
     * @return boolean 
	 *  
     * Status code:  Data_file_not_specified  @note_zh 数据文件没有指定  @note Data file is not specified
	 * Status code:  Unexpected_input         @note_zh 意外的输入        @note Unexpected input  
     */
    public  function insert($input) {
		// date_default_timezone_set("Asia/Shanghai"); //设置时区，以获得准确时间
		
		//------------传入参数处理------------//		
		if(is_array($input)){ //$input 是数组
			$input = array_map(array($this,'Remove_EOL_Spaces'),$input ); //数组值去空格,去换行符.
		
		}else{ //$input 不是数组 返回 false
		    $this->Status_code['fatal'][] = 'Unexpected_input';//  '意外的输入'
			return false;
		}
		//------------传入参数处理------------//
		
		//------------内置参数处理------------//		
        
        $date_create = $this->get_gmdate( "Y-m-d H:i:s",$this->time_offset); //取得系统时间，作为数据创建时间 
        $date_id = $this->generate_str().$this->get_gmdate( "Y-m-d H:i:s",$this->time_offset,'',true); //随机4位字母连接时间，作为数据id		  
		
		//------------内置参数处理------------//
		
        
    //-----------------------执行代码------------------------//    
		//------------连接字符串------------//
        foreach ( $input as $key => $value ) {
            
			//将所有数据赋予变量$str，$separator_2的目的是用来今后作数据分割时的数据间隔符号。
			$str .= $key.$this->separator_3.$value.$this->separator_2; //无引号			
			
        }
		//------------连接字符串------------//
		
		//------------写入文件--------------//
        if(!empty($this->DefaultDataFile)){
			           
			$str = substr_replace($str,"",strripos($str,$this->separator_2)); //去除末尾的$separator_2
			
			if(array_key_exists('data_id', $input)){ // $input 数组的键包含 data_id 时
				$str = "datatime_create".$this->separator_3.$date_create.$this->separator_2.$str. "\r\n"; //增加数据创建时间 ，分行
			}else{  // $input 数组的键不包含 data_id 时
				$str = "data_id".$this->separator_3.$date_id.$this->separator_2."datatime_create".$this->separator_3.$date_create.$this->separator_2.$str. "\r\n"; //增加数据创建时间和id ，分行
			}
			
			// $fp = fopen ( $this->DefaultDataFile, "a" ); //以只写模式打开文本文件,文件指针指向文件尾部. 
            // fwrite ( $fp, $str); //将数据写入文件 
            // fclose ( $fp ); //关闭文件
			$write = $this->write_files($this->DefaultDataFile,$str ,"a");//"a"，附加模式，将数据添加到文件			
			return $write==true? true : false;
			
		}else{
			$this->Status_code['fatal'][] = 'Data_file_not_specified';//  "数据文件没有指定"
			return false;
		}
		//------------写入文件--------------//	

			
    //-----------------------执行代码------------------------//  
    }
     
     
    /**
     * 数据修改程序段
     * @param  array $input    @note_zh 需修改的记录，必需包含 data_id 字段  @note Need to modify the record,the  data_id  field must be included
     * @return boolean 
	 *
	 * Status code:  Data_file_not_specified  @note_zh 数据文件没有指定  @note Data file is not specified
	 * Status code:  Unexpected_input         @note_zh 意外的输入        @note Unexpected input
     */
    public  function alter($input) {		
        // $date_last = date ( "Y-m-d H:i:s",time() ); //取得系统时间，作为数据修改时间,因此要在每次调用时更新，所以不能像datatime_create那样内置。
		
		//------------传入参数处理------------//		
		if(is_array($input)){ //$input 是数组
			$input = array_map(array($this,'Remove_EOL_Spaces'),$input ); //数组值去空格,去换行符.
		
		}else{ //$input 不是数组 返回 false
		    $this->Status_code['fatal'][] = 'Unexpected_input';//  '意外的输入'
			return false;
		}
		//------------传入参数处理------------//
		
		//------------内置参数处理------------//
		if(!empty($this->DefaultDataFile)){ //不为空
		    clearstatcache(); //清除缓存的文件属性
		    if(file_exists($this->DefaultDataFile)){  //文件存在
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}else{ //文件不存在
			    $this->dir_handle($this->DefaultDataFile); //目录不存在则创建				
				fclose(fopen($this->DefaultDataFile, "a" )); //fopen以只写模式打开文本文件,如果文件不存在则尝试创建之.然后fclose()关闭
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}			
		}else{ //为空		    
		    $this->Status_code['fatal'][] = 'Data_file_not_specified';//  "数据文件没有指定"
			return false;
			
		}  
		//------------内置参数处理------------//
        	
	//-----------------------执行代码------------------------// 	
        if ($n > 0) { //如果记录总数大于0
            
            
			//------------查找更改------------//
            for($i = 0; $i < $n; $i ++) { //进入循环
                $f = explode ( $this->separator_2, $list [$i] ); //以$separator_2作为分隔符,切开$list[$i](第$i条),并将这些数据赋予数组$f
				$f =$this->get_array_substr($f);  //数组$f的值，按指定字符截取生成一维数组
				
				if($f['data_id']==$input['data_id']){  //id 等值判断 
				 // if (@eregi ( $input, $list [$i] )) { //将$input与数组$list[$i]里的字串进行匹配比较,不区分大小写。在 $list[$i] 查找 $input。可用，但已废弃函数，报错，需屏蔽错误	
				     $diff=array_diff_key($f,$input);  //计算数组的差集，$f有的，在$input中没有的项 $f-$input
					 $strinput;
					 $strdiff;
				    if(count($diff)>0){   //差集数组不为空时
						
					    foreach($input as $key => $value){ //循环，连接 $input 为字符串
					    	$strinput .= $key.$this->separator_3.$value. $this->separator_2; //无引号
					    	
					    }					
					    foreach($diff as $key => $value){ //循环，连接 $diff 为字符串
					    	$strinput .= $key.$this->separator_3.$value. $this->separator_2; //无引号
					    	
					    }
					    $str = $strinput.$strdiff;
					    $str = substr_replace($str,"",strripos($str,$this->separator_2)); //去除末尾的$separator_2
					    $str =  $str . "\r\n";	//分行
                        $list[$i] = $str;   //赋值给$list[$i] 
					}
			        else{ //差集数组为空时
						foreach($input as $key => $value){ //循环，连接 $input 为字符串
					    	$strinput .= $key.$this->separator_3.$value. $this->separator_2; //无引号					    	
					    }
						$str = $strinput;
					    $str = substr_replace($str,"",strripos($str,$this->separator_2)); //去除末尾的$separator_2
					    $str =  $str . "\r\n";	//分行
                        $list[$i] = $str;   //赋值给$list[$i]
					}
					
                    break; //跳出循环，因为修改完，后面的也就不用寻找了 
                }		
						
			}//循环结束符			
            //------------查找更改------------//
			
			//------------写入文件------------//
			$fp = $this->fopen_handle ( $this->DefaultDataFile, "w" ); //以重写模式打开文件
		    for($i = 0; $i <= $n; $i ++) { //进入循环 
                fwrite ( $fp, $list[$i] ); //将数组$list的每个单元为一行，写入文件。因上面对应的$list[$i]已赋值，所以在此也生效
				
            } //循环结束符            
			fclose ( $fp ); //关闭文件	
			//------------写入文件------------//
			return true;
		}
		else{  //如果记录总数小于0，源文件中没有记录时
			$this->insert($input);  //调用插入记录函数
		}
	//-----------------------执行代码------------------------// 	
	 
		
    }
	
	
    /**
	 * @title     Data delete
     * @title_zh  数据删除 
     * @param  array|string * $input    @note_zh  删除条件 或 *                @note  Delete condition or *
	 * @param  string $OrAnd            @note_zh  条件组合模式，"and" 或 "or"  @note  Conditional combination model, "and" or "or" 
     * @return boolean 
	 *  
     * Status code:  Data_source_empty        @note_zh 数据源为空        @note Data source is empty                    
     * Status code:  Data_file_not_specified  @note_zh 数据文件没有指定  @note Data file is not specified
	 * Status code:  Unexpected_input         @note_zh 意外的输入        @note Unexpected input 
     */
	public  function delet($input,$OrAnd="and") {
		//------------传入参数处理------------//		
		if(is_array($input)){ //$input 是数组
			$input = array_map(array($this,'Remove_EOL_Spaces'),$input ); //数组值去空格,去换行符.
		}elseif($input=="*"){ //$input 是字符串 "*"  用于删除所有
			$input = $this->Remove_EOL_Spaces($input); //去空格,去换行符.
		}else{ //$input 是意外字符 返回 false
		    $this->Status_code['fatal'][] = 'Unexpected_input';//  '意外的输入'
			return false;
		}
		
		if(!empty($OrAnd)){ //$show 不为空
		
		    if(in_array(strtolower($OrAnd),array('and','or')) ){ //$show 在数组array('and','or')中
				$OrAnd=strtolower ($OrAnd); //条件组合模式，or 或 and ，转换成小写
			}else{ //$show 是意外字符 按 "and" 处理
				$OrAnd="and";
			}
			
		}else{ //$show 为空 按 "and" 处理
			$OrAnd="and";
		}
		//------------传入参数处理------------//
		
		//------------内置参数处理------------//
		if(!empty($this->DefaultDataFile)){ //不为空
		    clearstatcache(); //清除缓存的文件属性
		    if(file_exists($this->DefaultDataFile)){  //文件存在
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}else{ //文件不存在
			    $this->dir_handle($this->DefaultDataFile); //目录不存在则创建
				fclose(fopen($this->DefaultDataFile, "a" )); //fopen以只写模式打开文本文件,如果文件不存在则尝试创建之.然后fclose()关闭
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}			
		}else{ //为空
		    $this->Status_code['fatal'][] = 'Data_file_not_specified';//  "数据文件没有指定"
			return false;
			
		}  				
		//------------内置参数处理------------//	


		//-----------------------执行代码------------------------//
        if ($n > 0) { //如果记录总数大于0 
		    if(is_array($input)){ //$input 是数组 
                		
                for($i = 0; $i < $n; $i ++) { //进入循环  读取
			        $f = explode ( $this->separator_2, $list [$i] ); //以$separator_2作为分隔符,默认"|", 切开$list[$i](第$i条),并将这些数据赋予数组$f
			    	$f =$this->get_array_substr($f);  //数组$f的值，按指定字符(默认"=")截取生成一维数组
				    
					//-----------判断-----------//
			    	$arrif=array();  //预置数组，装载每个条件的判断结果
			    	$truefalse=false; //预置开关，根据搜索$arrif 而设置，供给if判断
			    	foreach($input as $key => $value){  //循环传入的数组$input变量
				    	if( $f[$key]== $input[$key] ){  // 根据键，对比 源和传入变量， true则 $arrif[]='true'; false 则 $arrif[]='false'
				    		$arrif[]='true';
				    	}else{
				    		$arrif[]='false';
				    	}
				    }
				
				    if($OrAnd=='or'){  //or(或)，在数组$arrif查找"true"字符串，存在任一个则预置开关为true
				    	if(in_array ("true",$arrif)){
				    		$truefalse=true;
				    	}
					
				    }elseif($OrAnd=='and'){ //and(和)，在数组$arrif查找"false"字符串，不存在"false"预置开关才设置为true
				    	if(!in_array ("false",$arrif)){
				    		$truefalse=true;
				    	}
				    }else{  //意外字符串，则按 and 处理
				    	if(!in_array ("false",$arrif)){
					    	$truefalse=true;
				    	}
				    }
					//-----------判断-----------//
					
				    //-----------删除内容-----------//
				    if($truefalse){  
                				
                        $list [$i] = ""; //如果匹配成功，则将$list[$i]清空（达到删除的目的） 
                   
                    }
					//-----------删除内容-----------//
					
                } //循环结束符
				
			//----------------写入文件----------------//
			    $fp = $this->fopen_handle ( $this->DefaultDataFile, "w" ); //以重写模式打开文件
                for($i = 0; $i <= $n; $i ++) { //进入循环 写入
                    fwrite ( $fp, $list [$i] ); //将数组$list的每个单元为一行，写入文件。因上面对应的$list [$i]已清空，所以在此也生效
                } //循环结束符 
                fclose ( $fp ); //关闭文件
				return true;
				
			}elseif($input=="*"){ //$input 是字符串 "*"  用于删除所有
			    $fp = fopen ( $this->DefaultDataFile, "w" ); //以只写模式打开文件
				fwrite ( $fp, "" ); //""，写入文件,  以删除所有
			    fclose ( $fp ); //关闭文件
				return true;
			}else{ //$input 是意外字符
			    $this->Status_code['fatal'][] = 'Unexpected_input';//  '意外的输入'
			    return false;
			}
			//----------------写入文件----------------//
        }
		else{ //如果记录总数小于0 
		    $this->Status_code['fatal'][] = 'Data_source_empty';// '数据源为空'
			return false;			
		}	
        //-----------------------执行代码------------------------//
		
	
	
    }
     
    /**
	 * @title    Data query
     * @title_zh 数据查询 
     * @param array|string * $input  @note_zh  查询条件                     @note  query conditions
	 * @param string $OrAnd          @note_zh  条件组合模式，"and" 或 "or"  @note  Conditional combination model, "and" or "or" 
	 * @param array|string * $show   @note_zh  显示字段                     @note  Display field   
	 * @param array  $sort           @note_zh  排序条件 键：字段  值(无引号)： SORT_DESC 或  SORT_ASC   @note  Sorting conditions  Key:field   Value(no quotes): SORT_DESC  or  SORT_ASC 
	 * @param string $GroupbyKey     @note_zh  分组字段                     @note  Grouping field
     * @return array2|array3 |boolean
	 * 
	 * array2:  @note_zh 没有分组，二维数组，顶层索引是数字。 Array ( [0] => Array ( [name] => ADFAST ) )  @note No Grouping, two-dimensional array, top index is numbers. Array ( [0] => Array ( [name] => ADFAST ) )    
	 * array3:  @note_zh 有分组，三维数组，顶层索引是分组的值。 array( [GroupbyKey] =>array( [0] => Array ( [name] => ADFAST), ) )  @note   Group, three-dimensional array, the top index is value of the group.  array( [GroupbyKey] =>array( [0] => Array ( [name] => ADFAST), ) ) 
	 * boolean: false
	 *
	 * Status code:  Sort_field_needs_array        @note_zh 排序字段需要数组      @note  Sort field needs to be an array       
     * Status code:  Grouping_field_need_string    @note_zh 分组字段需要字符串    @note  Grouping field need to string        
     * Status code:  input_is_empty                @note_zh 输入为空              @note  Input is empty
	 * Status code:  Data_source_empty        @note_zh 数据源为空        @note Data source is empty        
     * Status code:  No_matching_records      @note_zh 没有匹配的记录    @note No matching records         
     * Status code:  Data_file_not_specified  @note_zh 数据文件没有指定  @note Data file is not specified
	 * Status code:  input_is_Unexpected_characters  @note_zh 输入是意外字符   @note Input is Unexpected characters	 
     */
/*---code
$input:
array(
    'field' =>'aaa',
	'field2' =>'bbb'
)

$show:
array('aa','bb')

$sort:
array(
    'field' =>SORT_DESC,
	'field2' =>SORT_ASC
)

array2:
Array ( 
   [0] => Array ( [name] => ADFAST ),
   [1] => Array ( [name] => ADFAST ), 
)

array3: 
array(
   [GroupbyKey] =>array(
                   [0] => Array ( [name] => ADFAST),
				   [1] => Array ( [name] => ADFAST),
				   [2] => Array ( [name] => ADFAST),
                )
   [GroupbyKey2] =>array(
                   [0] => Array ( [name] => ADFAST),
				   [1] => Array ( [name] => ADFAST),
				   [2] => Array ( [name] => ADFAST),
                )
) 
code---*/	 
    public  function select($input,$show="*",$OrAnd="and",$sort="",$GroupbyKey="") {
		
		//--------------预处理--------------//		
		if(is_array($sort)){ //$sort 是数组			
			$sort = array_map(array($this,'Remove_EOL_Spaces'),$sort ); //数组值去空格,去换行符.
			
		}else{ //$sort 不是数组时
			$this->Status_code['error'][] = 'Sort_field_needs_array';//'排序字段需要数组'
		}
		
		
		if(is_array($GroupbyKey)){ //$GroupbyKey 是数组			
			$this->Status_code['error'][] = 'Grouping_field_need_string';//   '分组字段需要字符串'	
			
		}else{ //$GroupbyKey 不是数组时
			$GroupbyKey = $this->Remove_EOL_Spaces($GroupbyKey); //去空格,去换行符.			
		}
		
		
		if(!empty($input)){
			$Results = $this->sel($input,$OrAnd); //查询数据 返回二维数组 
		}else{
			 $this->Status_code['fatal'][] = 'input_is_empty';  //  '输入为空'
			 return false;
		}
				
		if(!empty($show)){ //$show 不为空
		
			if(is_array($show)){ //$show 是数组			
				$show = array_map(array($this,'Remove_EOL_Spaces'),$show ); //数组值去空格,去换行符.
				foreach($show as $value){
					$show[$value]=$value;  //键==值，以便下面使用
				}
			}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
				$show = $this->Remove_EOL_Spaces($show); //去空格,去换行符.
				$show = array($show => $show);  //转换为数组 键==值
			
			}else{ //$show 是意外字符 按 "*" 处理，用于查找所有
				$show = "*";
			}
			
		}else{ //$show 为空 按 "*" 处理
			$show="*";
		}
		
		/*
		if(!empty($AsName)){ //$AsName 不为空
		
			if(is_array($AsName)){ //$AsName 是数组			
				$AsName = array_map(array($this,'Remove_EOL_Spaces'),$AsName ); //数组值去空格,去换行符.
			     	
			}else{ //$AsName 是意外字符 按 "" 处理，用于查找所有
				$AsName = "";
			}
			
		}else{ //$AsName 为空 按 "" 处理
			$AsName="";
		}
		*/
		
		$selcode = array(   //sel 查询状态码
		  'Data_source_empty',
		  'No_matching_records',
		  'Data_file_not_specified',
		  'input_is_Unexpected_characters',		  
		  
		);
		
		$tmpResults;
		$showarr=array(); //筛选返回的字段，过滤结果		
		$newshow=array();  // 新的，合法的$show
		//--------------预处理--------------//
		
		
		//--------------代码执行--------------//
	    if(!in_array($Results,$selcode) ){  //不在状态码中 时
		
		    //----------排序----------//
			if( !empty($sort) && empty($GroupbyKey) ){ //排序不为空，分组为空 时
				if(is_array($sort) ){   //$sort  是数组时
					$Results = $this->array_msort($Results,$sort);  //调用排序函数
					// return $Results; //返回二维数组
					$tmpResults = $Results;
				}else{  //$sort 不是数组时，返回未排序的数组
					// return $Results; //返回二维数组
					$tmpResults = $Results;
				}
			//----------排序----------//
			
			//----------分组 排序----------//
			}elseif( !empty($sort) && !empty($GroupbyKey) ){  //排序 分组都不为空
				if(is_array($sort) ){   //$sort  是数组时
			  	    $Results = $this->array_group_by($Results,$GroupbyKey); //调用分组函数
				
					foreach($Results as $key => $value){ // 循环 对每个分组排序
					   $Results[$key]=array_msort($value, $sort);  //调用排序函数  $Results[$key] 每个分组，即二维数组
					}
					
					// return $Results; //返回三维数组
				    $tmpResults = $Results;	
					
				}else{  //$sort 不是数组时，返回分组未排序的数组
			 	    $Results = $this->array_group_by($Results,$GroupbyKey);  //调用分组函数
					// return $Results; // 返回三维数组
					$tmpResults = $Results;
				}
			//----------分组 排序----------//
			
			//----------分组----------//
			}elseif( empty($sort) && !empty($GroupbyKey) ){ //排序为空，分组不为空
			 	    $Results = $this->array_group_by($Results,$GroupbyKey); 
					// return $Results; // 三维数组
					$tmpResults = $Results;
			//----------分组----------//
			
			//----------未分组 未排序----------//
			}else{
				    // return $Results; //二维数组
					$tmpResults = $Results;
			}
			//----------未分组 未排序----------//
		
	    }
		else{ //在状态码中 时
		  $this->Status_code['fatal'][] = $Results; //状态码传递给数组
		  return false;
	    }
		//--------------代码执行--------------//
		
		
		//--------------显示字段show--------------//
		
		    //----------排序--OUT--------//
			if( !empty($sort) && empty($GroupbyKey) ){ //排序不为空，分组为空 时  二维数组
				if(is_array($show)){ //$show 是数组  返回指定字段
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						
						//----------------去除非法键----------------//
						if(is_array($show)){ //$show 是数组			
				    	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   	 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    	}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    	}
						//----------------去除非法键----------------//
						if(count($newshow)>0){ //存在合法键
						    foreach($value as $k => $v){ //循环一维数组
								
								foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
									if($k==$nskey){  //键相等 ，则对应的值写入新数组
										$showarr[$key][$k]=$v;
									}
								}//循环 $newshow
							
							}//循环一维数组							
						}	
						
					} //循环二维数组
				
				}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						
						//----------------去除非法键----------------//
						if(is_array($show)){ //$show 是数组			
				    	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   	 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    	}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    	}
						//----------------去除非法键----------------//
						if(count($newshow)>0){ //存在合法键
						    foreach($value as $k => $v){ //循环一维数组
								
								foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
									if($k==$nskey){  //键相等 ，则对应的值写入新数组
										$showarr[$key][$k]=$v;
									}
								}//循环 $newshow
							
							}//循环一维数组							
						}	
						
					} //循环二维数组
				
				
				}else{ //$show 是意外字符 按 "*" 处理， 返回所有字段
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						$showarr[$key]=$value;						
						
					} //循环二维数组				 
				}
			//----------排序--OUT--------//	
			
			//----------分组 排序---OUT-------//
			}elseif( (!empty($sort) && !empty($GroupbyKey)) || (empty($sort) && !empty($GroupbyKey)) ){  //排序 分组都不为空||排序为空，分组不为空  三维数组
				if(is_array($show)){ //$show 是数组  返回指定字段
				    foreach($tmpResults as $Topkey =>$Topvalue){ //循环三维数组，$Topkey --> 关联索引  $Topvalue --> 二维数组 array( [0] => Array ( [name] => ADFAST ))
						foreach($Topvalue as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
							//----------------去除非法键----------------//
							if(is_array($show)){ //$show 是数组			
				    		    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   		 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    		}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 		    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    		}
							//----------------去除非法键----------------//
							if(count($newshow)>0){ //存在合法键
						  	  foreach($value as $k => $v){ //循环一维数组
								
									foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
										if($k==$nskey){  //键相等 ，则对应的值写入新数组
											$showarr[$Topkey][$key][$k]=$v;
											
										}
									}//循环 $newshow
							
								}//循环一维数组							
							}	
						
						}//循环二维数组
											
					} //循环三维数组
				
				}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
				    foreach($tmpResults as $Topkey =>$Topvalue){ //循环三维数组，$Topkey --> 关联索引  $Topvalue --> 二维数组 array( [0] => Array ( [name] => ADFAST ))
						foreach($Topvalue as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
							//----------------去除非法键----------------//
							if(is_array($show)){ //$show 是数组			
				    		    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   		 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    		}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 		    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    		}
							//----------------去除非法键----------------//
							if(count($newshow)>0){ //存在合法键
						  	  foreach($value as $k => $v){ //循环一维数组
								
									foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
										if($k==$nskey){  //键相等 ，则对应的值写入新数组
											$showarr[$Topkey][$key][$k]=$v;
											
										}
									}//循环 $newshow
							
								}//循环一维数组							
							}	
						
						}//循环二维数组
											
					} //循环三维数组
								
				}else{ //$show 是意外字符 按 "*" 处理， 返回所有字段
					
				    foreach($tmpResults as $Topkey =>$Topvalue){ //循环三维数组，$Topkey --> 关联索引  $Topvalue --> 二维数组 array( [0] => Array ( [name] => ADFAST ))
				        foreach($Topvalue as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
					    	$showarr[$Topkey][$key]=$value;	
                            							
                             						
						
					    } //循环二维数组
				    }//循环三维数组 
				}			
			//----------分组 排序--OUT--------//
			
			//----------未分组 未排序---OUT-------//
			}else{ //二维数组
				if(is_array($show)){ //$show 是数组  返回指定字段
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						
						//----------------去除非法键----------------//
						if(is_array($show)){ //$show 是数组			
				    	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   	 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    	}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    	}
						//----------------去除非法键----------------//
						if(count($newshow)>0){ //存在合法键
						    foreach($value as $k => $v){ //循环一维数组
								
								foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
									if($k==$nskey){  //键相等 ，则对应的值写入新数组
										$showarr[$key][$k]=$v;
									}
								}//循环 $newshow
							
							}//循环一维数组							
						}	
						
					} //循环二维数组
				
				}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						
						//----------------去除非法键----------------//
						if(is_array($show)){ //$show 是数组			
				    	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					   	 	$newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键
				    	}elseif(!is_array($show) && $show !="*"){ //$show 是字符串 且不等于"*"
					 	    $oldshow = array_diff_key($show,$value);  //$show - $value  不合法的键，因为是查询，并不需要新建键
					 	    $newshow = array_diff_key($show,$oldshow);  //$show - $oldshow	 合法的键		
				    	}
						//----------------去除非法键----------------//
						if(count($newshow)>0){ //存在合法键
						    foreach($value as $k => $v){ //循环一维数组
								
								foreach($newshow as $nskey =>$nsvalue){ //循环 $newshow 
									if($k==$nskey){  //键相等 ，则对应的值写入新数组
										$showarr[$key][$k]=$v;
									}
								}//循环 $newshow
							
							}//循环一维数组							
						}	
						
					} //循环二维数组
				
				
				}else{ //$show 是意外字符 按 "*" 处理， 返回所有字段
				    foreach($tmpResults as $key =>$value){ //循环二维数组，$key --> 数字索引  $value --> 一维数组 Array ( [name] => ADFAST )
						$showarr[$key]=$value;						
						
					} //循环二维数组				 
				}    
								
			}			
			//----------未分组 未排序---OUT-------//
			
		//--------------显示字段show--------------//
	    return $showarr;  //返回结果
     
 
    }

    /**
     * @title     Data query _simple
	 * @title_zh  数据查询_简单 
     * @param array|string * $input  @note_zh  查询条件                     @note  query conditions     
	 * @param string $OrAnd          @note_zh  条件组合模式，"and" 或 "or"  @note  Conditional combination model, "and" or "or" 
	 * @param array|string * $show   @note_zh  显示字段                     @note  Display field   
     * @return array|Status code 
	 * 
	 * array:  @note_zh  二维数组，顶层索引是数字。 Array ( [0] => Array ( [name] => ADFAST ) )  @note two-dimensional array, top index is numbers. Array ( [0] => Array ( [name] => ADFAST ) )    
     * Status code:  Data_source_empty        @note_zh 数据源为空        @note Data source is empty        
     * Status code:  No_matching_records      @note_zh 没有匹配的记录    @note No matching records         
     * Status code:  Data_file_not_specified  @note_zh 数据文件没有指定  @note Data file is not specified
	 * Status code:  input_is_Unexpected_characters  @note_zh 输入是意外字符   @note Input is Unexpected characters	 
     */
	private  function sel($input,$OrAnd="and") {
		
		//------------传入参数处理------------//
		if(is_array($input)){ //$input 是数组
			// $input = array_map('trim',$input ); //数组值去空格.
			$input = array_map(array($this,'Remove_EOL_Spaces'),$input ); //数组值去空格,去换行符.
		}elseif($input=="*"){ //$input 是字符串 "*"  用于查找所有
			$input = $this->Remove_EOL_Spaces($input); //去空格,去换行符.
			
		}else{ //$input 是意外字符 返回 
			return 'input_is_Unexpected_characters';  //  '输入是意外字符'
		}
		
		
		if(!empty($OrAnd)){ //$OrAnd 不为空
		
		    if(in_array(strtolower($OrAnd),array('and','or')) ){  //$OrAnd 在数组array('and','or')中
				$OrAnd=strtolower ($OrAnd); //条件组合模式，or 或 and ，转换成小写
			}else{ //$OrAnd 是意外字符 按 "and" 处理
				$OrAnd="and";
			}
			
		}else{ //$OrAnd 为空 按 "and" 处理
			$OrAnd="and";
		}
		
		//------------传入参数处理------------//
		
		//------------内置参数处理------------//
		if(!empty($this->DefaultDataFile)){ //不为空
		    clearstatcache(); //清除缓存的文件属性
		    if(file_exists($this->DefaultDataFile)){  //文件存在
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}else{ //文件不存在
			    $this->dir_handle($this->DefaultDataFile); //目录不存在则创建
				fclose(fopen($this->DefaultDataFile, "a" )); //fopen以只写模式打开文本文件,如果文件不存在则尝试创建之.然后fclose()关闭
				$list = @file ( $this->DefaultDataFile ); //读取整个文件到数组$list,每行为数组的一个元素，($list[0]是第一行的数据、$list[1]是第二行的数据..... 
      	        $n = count ( $list ); //计算$list行的总数,并赋予变量$n
			}			
		}else{ //为空
			return "Data_file_not_specified"; // "数据文件没有指定"
		}       
		
		$Results = array(); //接收结果数组
		//------------内置参数处理------------//
	
		//------------执行代码------------//
        if ($n > 0) { //如果记录总数大于0             
			// $showarr=array(); //筛选返回的字段，过滤结果
			if(is_array($input)){ //$input 是数组
        	    for($i = 0; $i < $n; $i ++) { //进入循环  处理每行数据
				    $f = explode ( $this->separator_2, $list [$i] ); //以$separator_2作为分隔符,默认"|",切开$list[$i](第$i条),并将这些数据赋予数组$f
					$f =$this->get_array_substr($f);  //数组$f的值，按指定字符(默认"=")截取生成一维数组
				
					$arrif=array();  //预置数组，装载每个条件的判断结果
					$truefalse=false; //预置开关，根据搜索$arrif 而设置，供给if判断
					$newinput=array(); // 新的，合法的$input
					
					
					//----------------去除非法键----------------//
					//计算数组的差集 array_diff_key($arr1,$arr2) $arr1有的，在$arr2中没有的项  $arr1 - $arr2
					$oldinput = array_diff_key($input,$f);  //$input - $f  不合法的键，因为是查询，并不需要新建键
					$newinput = array_diff_key($input,$oldinput);  //$input - $oldinput	 合法的键                  					
					
					//----------------去除非法键----------------//
					
					//----------------条件判断----------------//
					if(count($newinput)>0){ //存在合法键
					 	foreach($newinput as $key => $value){  //循环传入的查询条件变量										
					
					  		// 根据键，对比 源和传入变量 的值， true则 $arrif[]='true'; false 则 $arrif[]='false'
						    if( $f[$key]== $newinput[$key] ){  
						 		$arrif[]='true';
						 	}else{
							 	$arrif[]='false';
							}						
													
					    }//循环传入的查询条件变量
										
				
					    if($OrAnd=='or'){  //or(或)，在数组$arrif查找"true"字符串，找到任一个则预置开关为true
					    	if(in_array ("true",$arrif)){
					    		$truefalse=true;
					    	}
					
					    }elseif($OrAnd=='and'){ //and(和)，在数组$arrif查找"false"字符串，不存在任何"false"，即所有条件字段值都相等，预置开关才设置为true
						    if(!in_array ("false",$arrif)){
						    	$truefalse=true;
						    }
					    }else{  //意外字符串，则按 and 处理
						    if(!in_array ("false",$arrif)){
						    	$truefalse=true;
						    }
					    }
					
					}//不需要else ，当条记录不符合时需要继续循环，所以不能return
					
				    //----------------条件判断----------------//
					$this->Status_code['debug'][]=$truefalse;
					//----------------填充结果 $input 是数组----------------//
					if($truefalse==true){  //有符合查询条件的记录时
					   
						$Results[]=$f;  //填充$Results数组，$Results --> 二维数组	顶层索引是数字
					
              	    }//不需要else ，当条记录不符合时需要继续循环，所以不能return
						
					//----------------填充结果 $input 是数组----------------//
					
            	} //循环结束 处理每行数据
				//返回结果，二维数组，顶层索引是数字 ，未找到返回 '没有匹配的记录'
				return (count($Results)>0 ?  $Results : 'No_matching_records');  
            
			}elseif($input=="*"){ //$input 是字符串 "*"  用于查找所有
				for($i = 0; $i < $n; $i ++) { //进入循环  处理每行数据
				    $f = explode ( $this->separator_2, $list [$i] ); //以$separator_2作为分隔符,切开$list[$i](第$i条),并将这些数据赋予数组$f
					$f =$this->get_array_substr($f);  //数组$f的值，按指定字符截取生成一维数组				
					
					
					//----------------填充结果 $input 是字符串 "*"----------------//					
                      
						$Results[]=$f;  //填充$Results数组，$Results --> 二维数组	顶层索引是数字
					    
					//----------------填充结果 $input 是字符串 "*"----------------//
				                 	    
            	} //循环结束 处理每行数据
				//返回结果，二维数组，顶层索引是数字 ，未找到返回 '没有匹配的记录'
				return (count($Results)>0 ?  $Results : 'No_matching_records'); 
				
			}else{ //$input 是意外字符 返回 
				return 'input_is_Unexpected_characters';  //  '输入是意外字符'
			}
			
        }
		else{ //如果记录总数小于0 
			return 'Data_source_empty'; //'数据源为空'
		}	
        //------------执行代码------------//
    }
	

//--------------------------辅助函数----------------------------------------------------//
	
	/**
	* @title    Split array values
	* @title_zh 分割数组值
	* @param array $arr    @note_zh 一维数组  array(0 => 'name=php')  @note  One dimensional array.  array(0 => 'name=php')
	* @return  array
	* array:  @note_zh 一维数组  array('name' => 'php')  @note  One dimensional array.  array('name' => 'php')
	*/
	private function get_array_substr($arr){
		//---根据指定字符分割数组值，生成值的一维数组---//
		$fields;
		foreach($arr as $key => $value){
            
			// $keyStart = strpos ($value,'$'); //键，字符串起始位置
			$keyStart = 0;   //键，字符串起始位置
			$kv = strpos ($value,$this->separator_3);  //分隔符位置
			$valueStart = $kv+1;	    //值，字符串起始位置		
			$keyStr=trim(substr($value,$keyStart,$kv));  //键，截取字符串，并去除两边空格
			$valueStr=trim(substr($value,$valueStart));  //值，截取字符串，并去除两边空格
			
			$fields[$keyStr]=$valueStr; 	// 赋值给数组		
		}
		return $fields;
	}
		
    /**
	 * @title     Two dimensional array dynamic sorting
     * @title_zh  二维数组动态排序
     * @param array   $array      @note_zh  需排序的数组      @note  An array that needs to be sorted
	 * @param array   $cols       @note_zh  排序条件 键：字段  值(无引号)： SORT_DESC 或  SORT_ASC   @note  Sorting conditions  Key:field   Value(no quotes): SORT_DESC  or  SORT_ASC 
	 * @param boolean $keepnum    @note_zh  保持数字索引吗?   @note  Keep a digital index?
     * @return array 
	 * array: @note_zh 二维数组，不改变维度   @note  Two dimensional array,unchanging dimensions
     */
    private function array_msort($array, $cols,$keepnum=true){
		
		//
		// 原型<二维数组排序>
		// 本例中将把 volume 降序排列，把 edition 升序排列。
		// 现在有了包含有行的数组，但是 array_multisort() 需要一个包含列的数组，因此用以下代码来取得列，然后排序。
		//
		// $data[] = array('volume' => 67, 'edition' => 2);
		// $data[] = array('volume' => 86, 'edition' => 1);
		// $data[] = array('volume' => 85, 'edition' => 6);
		// $data[] = array('volume' => 98, 'edition' => 2);
		// $data[] = array('volume' => 86, 'edition' => 6);
		// $data[] = array('volume' => 67, 'edition' => 7);
		//
		// foreach ($Results as $key => $row) {
    	    // $volume[$key]  = $row['volume'];
    	    // $edition[$key] = $row['edition'];
		// }

		// 将数据根据 volume 降序排列，根据 edition 升序排列
		// 把 $Results 作为最后一个参数，以通用键排序
		//array_multisort($volume, SORT_DESC, $edition, SORT_ASC, $Results);  //直接这样使用
        
		 
		 
         $colarr = array();
         foreach ($cols as $col => $order) { //循环 排序条件
             $colarr[$col] = array(); //$colarr[$col]作为数组变量，相当于 $volume;
             foreach ($array as $k => $row) {   //循环 需排序的数组，$k，数字索引， 相当于 foreach ($Results as $key => $row) {
			     $colarr[$col]['_'.$k] = strtolower($row[$col]);	//小写，析构出一维数组，然后根据键$col进行赋值，循环完后得到该排序字段的所有值。相当于 $volume[$key]  = $row['volume'];	
		     }
         }
	
	     //----连接字符串并转化为可执行函数，参照原型-----//
         $eval = 'array_multisort(';
         foreach ($cols as $col => $order) { //循环 排序条件
             $eval .= '$colarr[\''.$col.'\'],'.$order.',';  
         }
		 //----连接字符串并转化为可执行函数，参照原型-----//
		  
		 if($keepnum==true){  //保持数字索引
			$eval = substr($eval,0,-1).');'; //去除末尾逗号 ','  
		 }else{  //不保持数字索引，带 $array 数组执行
			$eval = $eval."\$array".');';   //添加变量，参照原型
		 }         	      
         eval($eval); //把字符串作为PHP代码执行
		 
	   
	     
	     //--------保持数字索引--------//
         $ret = array();
         foreach ($colarr as $col => $arr) { //循环 新三维数组
             foreach ($arr as $k => $v) { //循环 其中的值 $k=['_'.$k]  $v=strtolower($row[$col])
                 $k = substr($k,1); //去除 '_' ，因为这样才保留下了数字索引，然后下面利用
                 if (!isset($ret[$k])) $ret[$k] = $array[$k];  //填充新数组，$k 数字索引相同，$array是传入的二维数组。如，$ret[02] = $array[02]
                 $ret[$k][$col] = $array[$k][$col];            //继续填充次级维度。 如，$ret[02]['name']=$array[02]['name']
             }
         }
		 //--------保持数字索引--------//
		 
		 if($keepnum==true){  //保持数字索引
			return $ret; 
		 }else{  //不保持数字索引
			return $array; 
		 }         

    }

	/**
	* @title     Two dimensional array grouping
	* @title_zh  二维数组分组
	* @param array   $arr    @note_zh  需分组的二维数组     @note  The two-dimensional array to be grouped
	* @param string  $key    @note_zh  分组字段             @note  Grouping field
	* @return  array         
	* array:   @note_zh 三维数组，顶层索引是分组的值。 array( [GroupbyKey] =>array( [0] => Array ( [name] => ADFAST), ) )  @note   Group, three-dimensional array, the top index is value of the group.  array( [GroupbyKey] =>array( [0] => Array ( [name] => ADFAST), ) ) 
	*/
    private function array_group_by($arr, $key){
            $grouped = [];
            foreach ($arr as $value) {  //循环数组
                $grouped[$value[$key]][] = $value; //重新生成数组
            }

            return $grouped;
        }
	
	/**
	 * @title    Time format
 	 * @title_zh 时间格式化
	 * @param string $dateformat           @note_zh  时间格式               @note  time format
	 * @param boolean $ReturnTimestamp     @note_zh  返回时间戳格式?        @note  Returns the timestamp format?
	 * @param int $timestamp               @note_zh  时间戳                 @note  Timestamp
	 * @param int $timeoffset              @note_zh  时区偏移量             @note  Time zone offset
	 * @return string
	 */
	public function get_gmdate($dateformat = 'Y-m-d H:i:s', $timeoffset = 8, $timestamp = '',$ReturnTimestamp=false) { //默认 8 ，即中国时区
 
   		if(empty($timestamp)) {
        	$timestamp = time();
    	}
		if(empty($timeoffset)) {
        	$timeoffset = 8;
    	}
		
		if($ReturnTimestamp){  //返回时间戳
			$result =  $timestamp + $timeoffset * 3600;
		}else{
			$result = gmdate($dateformat, $timestamp + $timeoffset * 3600); //返回时间
		}
    	
    	return $result;
	}
	
	/**
 	 * @title    Random character generation
	 * @title_zh 随机字符生成	 
	 * @param int $length  @note_zh 生成字符的长度	 @note The length of the generated character 
	 * @return string
	 */ 
	public function generate_str( $length = 4 ) { 
	// 字符集，可任意添加你需要的字符 
	$chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ'; 
	$str = ""; 
	for ( $i = 0; $i < $length; $i++ ){  //循环，每次一个字符
	
	// 这里提供两种字符获取方式 
	// 第一种是使用 substr 截取$chars中的任意一位字符； 
	// 第二种是取字符数组 $chars 的任意元素 
	// $str .= substr($chars, mt_rand(0, strlen($chars) – 1), 1); 
	$str .= $chars[ mt_rand(0, strlen($chars) - 1) ];  //mt_rand(min,max) 生成随机字数
	} 
	return $str; 
	}

	/**
 	 * @title    Remove line breaks and remove Spaces
	 * @title_zh 去除换行符，去除空格	 
	 * @param string $value  @note_zh 需处理字符串   @note  Need to deal with string
	 * @return string
	 */ 
	public function Remove_EOL_Spaces($value) { 
	
	$value = trim($value); //去空格.
	$value = str_replace(PHP_EOL, '', $value); //去除换行符
	return $value; 
	}
	
    /**
     * @title     Is numerically indexed array?
	 * @title_zh  是数字索引数组?
     * @param  array $arr   @note_zh 需判断的数组  @note  Need judge array
     * @return boolen 
     */
    public function is_num_array($arr){    
   
        // array_keys — 返回数组中部分的或所有的键名,数字或者字符串的键名 
	    // range 0-数组最大数量  数字
	    return array_keys($arr) == range(0, count($arr) - 1);  // == 则为数字数组 true 
    
    }

    /**
     * @title     (2d / 3d) one column handle
	 * @title_zh  (二维/三维)单列处理 
     * @param  array $arr   @note_zh 需要处理的数组  @note  An array that needs to be handle
     * @param  boolen $toOne   @note_zh 转换为一(二)维数组?    @note   Converts to a one(two) dimensional array?
	 * @return array 
     */
	public function one_column_handle($arr,$toOne=false){
		 
		$Results; 
		switch($this->array_depth($arr)){
			case 2 : //二维数组处理
			    $Results=$this->two_arr_value_noempty($arr);
				if($toOne==true){
					$Results=$this->to_One_Two_DimensionalArray($Results);
				}
				return $Results;
			break;
			case 3 :	//三维数组处理
			    $Results=$this->three_arr_value_noempty($arr);
				if($toOne==true){
					$Results=$this->to_One_Two_DimensionalArray($Results);
				}
				return $Results; 
			break;
			default:
			    $Results=$this->two_arr_value_noempty($arr);
				if($toOne==true){
					$Results=$this->to_One_Two_DimensionalArray($Results);
				}
				return $Results;
			break;
		}	
			
			
	}
	
    /**
     * @title     Returns the column in a two-dimensional array
	 * @title_zh  返回二维数组中指定的列
     * @param  array $arr   @note_zh 二维数组  @note   two-dimensional array
	 * @param  string $show   @note_zh 列(键)      @note   Column (key)
	 * @param  boolen $ResetNumIndex      @note_zh 重置数字索引?  @note   Reset the digital index?
	 * @param  boolen $RemoveRepetition   @note_zh 移除重复值?    @note   Remove repetition value?
     * @return array | boolen
     */
/*---code	 
Array ( [0] => ADO [1] => bbb [2] => office [3] => php )
code---*/	 
	public function get_one_column_TwoDimensionalArray($arr,$show,$ResetNumIndex=true,$RemoveRepetition=true){
		$newarr=array();
		$show=trim($show);
		
		if(is_array($arr)){
			if($RemoveRepetition==true){
				//可返回 二维数组中指定列，但其不处理空值
				$Results=array_column($arr,$show,$show); //指定列为$show，并将$show作为键，即 键值相等，这样相同键的值被覆盖为只剩一个，达到去重复
			}else{
				//可返回 二维数组中指定列，但其不处理空值
				$Results=array_column($arr,$show); 
			}			
		    $Results=array_filter($Results,'trim'); //处理空值
		    // return $Results;
		}else{
			return false;
		}
		
		//-------重置数字索引---------//
		
		//原数组 Array ( [33] => ADO [22] => bbb [23] => office [44] => php )
		//新数组 Array ( [0] => ADO [1] => bbb [2] => office [3] => php )
        $i = 0;	//索引从0开始	
		foreach($Results as $key =>$value){
			
			$newarr[$i]=$value; //此适用于：一维数组
			$i ++; //此适用于：一维数组，每次循环递增
					
		}
		//-------重置数字索引---------//
		
		if($ResetNumIndex==true){
			return $newarr; //已重置数字索引
		}else{
			return $arr; //未重置数字索引
		}	
	}
	
    /**
     * @title     Two-dimensional array value handle, remove null element, remove the empty array
	 * @title_zh  二维数组值处理，去除空值元素，去除空数组
     * @param  array $arr   @note_zh 二维数组  @note   two-dimensional array
	 * @param  boolen $ResetNumIndex   @note_zh 重置数字索引?  @note   Reset the digital index?
     * @return array 
     */	
	public function two_arr_value_noempty($arr,$ResetNumIndex=true){
		
		$newarr=array();
		
		//(二维数组)$arr:
		//Array ( [0] => Array ([class] => php,[name] => ),[1] => Array ([class] => ADO) )
		foreach($arr as $key =>$value){
			
			//去除数组$value中除空值的元素，如 [name] => ，操作在一维数组
			// Array ( [class] => ADO,[name] =>  )
			$arr[$key]=array_filter($value,'trim');	
           	
		}
		 //去除数组$arr中为空的值(数组)，如  [0] => Array () ，操作在二维数组
		 // Array ( [0] => Array (),[1] => Array ([class] => ADO)  )
		 //(二维数组)$arr: 
		 //Array ( [1] => Array ([class] => ADO)  )
		$arr=array_filter($arr,array($this,'value_noempty_arr'));  //未重置数字索引
		
		//-------重置数字索引---------//
		foreach($arr as $key =>$value){			
			
			//(一维数组)$value: Array ([class] => ADO)
			//(二维数组)$newarr: Array ( [0] => Array ([class] => php),[1] => Array ([class] => ADO)  )
			$newarr[]=$value;
           			
		}
		//-------重置数字索引---------//
		
		if($ResetNumIndex==true){
			return $newarr; //已重置数字索引
		}else{
			return $arr; //未重置数字索引
		}	
	
		
	}
	
	/**
     * @title     Three-dimensional array value handle, remove null element, remove the empty array
	 * @title_zh  三维数组值处理，去除空值元素，去除空数组
     * @param  array $arr   @note_zh 三维数组  @note   three-dimensional array
	 * @param  boolen $ResetNumIndex   @note_zh 重置数字索引?  @note   Reset the digital index?
     * @return array 
     */	
	public function three_arr_value_noempty($arr,$ResetNumIndex=true){
		
		$newarr=array();
		
		//-----------去除空值-------------//
		//(二维数组)$Topvalue:
		// array( [GroupbyKey] => Array ( [0] => Array ([class] => php,[name] => ),[1] => Array ([class] => ADO) ) )
		foreach($arr as $Topkey =>$Topvalue){
			//(二维数组)$Topvalue:
			//Array ( [0] => Array ([class] => php,[name] => ),[1] => Array ([class] => ADO) )
			foreach($Topvalue as $key =>$value){
			
				//去除数组$value中除空值的元素，如 [name] => ，操作在一维数组
				// Array ( [class] => ADO,[name] =>  )
				$arr[$Topkey][$key]=array_filter($value,'trim');				
           	
			}
		
		}
		//-----------去除空值-------------//
		
		//-----------去除空数组-------------//
		foreach($arr as $Topkey =>$Topvalue){
			
			//去除数组$Topvalue中为空的值(数组)，如  [0] => Array () ，操作在二维数组
		    // Array ( [0] => Array (),[1] => Array ([class] => ADO)  )
		    //(二维数组)$Topvalue: 
		    //Array ( [1] => Array ([class] => ADO)  )
			$arr[$Topkey]=array_filter($Topvalue,array($this,'value_noempty_arr'));  //未重置数字索引
		}		
		
		 //去除数组$arr中为空的值(数组)，如  [0] => Array () ，操作在二维数组
		 // Array ( [0] => Array (),[1] => Array ([class] => ADO)  )
		 //(三维数组)$arr: 
		 //array( [GroupbyKey] => Array ( [1] => Array ([class] => ADO)  ) )
		$arr=array_filter($arr,array($this,'value_noempty_arr'));  //未重置数字索引
		//-----------去除空数组-------------//
		
		//-------重置数字索引---------//
		foreach($arr as $Topkey =>$Topvalue){
			foreach($Topvalue as $key =>$value){			
			
				//(一维数组)$value: Array ([class] => ADO)
				//(二维数组)$newarr: Array ( [0] => Array ([class] => php),[1] => Array ([class] => ADO)  )
				$newarr[$Topkey][]=$value;
           			
			}
		}
		//-------重置数字索引---------//
		
		if($ResetNumIndex==true){
			return $newarr; //已重置数字索引
		}else{
			return $arr; //未重置数字索引
		}	
	
		
	}

    /**
     * @title     Value is not empty array
	 * @title_zh  值不是空数组
     * @param  array $arr   @note_zh 需判断的数组  @note  Need judge array
     * @return boolen 
     */
	public function value_noempty_arr($arr){
				
		//$value，数组，统计其中的元素不为空
		foreach($arr as $key => $value){
			
			if(count($value)>0){
				return true;
			}else{
				return false; 
			}
		}
		
	}
	
    /**
     * @title     Converts to a one(two) dimensional array
	 * @title_zh  转换为一(二)维数组
     * @param  array $arr   @note_zh 需转换的数组  @note  An array that needs to be converted
	 * @param  boolen $RemoveRepetition   @note_zh 移除重复值?    @note   Remove repetition value?
     * @return array |array2
     */
/*---code
array:
Array ( 
      [0] =>  ADFASTt , 
	  [1] =>  ADFAST
	)
	  
array2:
array(
    [GroupbyKey] => Array ( 
	                [0] =>  ADFASTt , 
					[1] =>  ADFAST 
					)	
	)	
code---*/	 
	public function to_One_Two_DimensionalArray($arr,$RemoveRepetition=true){
				
		$newarr=array();
		
		switch($this->array_depth($arr)){
			case 2 : //二维数组处理
			    // return array:
			    // Array ( [0] =>  ADFASTt , [1] =>  ADFAST )			
			    foreach($arr as $key => $value){
					foreach($value as $k => $v){
						$newarr[]=$v;
					}
				}
				if($RemoveRepetition==true){  
					return array_unique($newarr); //去重复
				}else{
					return $newarr;
				}
				
			break;
			case 3 :	//三维数组处理
			    // return array2:
			    // array([GroupbyKey] => Array ( [0] =>  ADFASTt , [1] =>  ADFAST )	)		
			    foreach($arr as $Topkey => $Topvalue){
					
					if($RemoveRepetition==true){
						$Topvalue=array_unique($Topvalue); //去重复
					}
					
					foreach($Topvalue as $key => $value){
						foreach($value as $k => $v){
						    $newarr[$Topkey][]=$v;
						}
					}
				}
				return $newarr;
			break;
			default:
			    // return array:
			    // Array ( [0] =>  ADFASTt , [1] =>  ADFAST )			
			    foreach($arr as $key => $value){
					foreach($value as $k => $v){
						$newarr[]=$v;
					}
				}
				if($RemoveRepetition==true){  
					return array_unique($newarr); //去重复
				}else{
					return $newarr;
				}
				
			break;
			
		}
		
	}
	
	/**
	* @title    The depth of the array
	* @title_zh 数组深度
	* @param array $array    @note_zh 需判断的数组  @note  Need judge array
	* @return  int
	*/
	public function array_depth($array) {
        if(!is_array($array)) return 0;
        $max_depth = 1;
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = $this->array_depth($value) + 1; //在类中需要添加 $this->
                // 递归完毕后，判断每次递归的深度是否大于当前的最大深度
                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }
        return $max_depth;
    }

    /**
     * @title     dir handle
	 * @title_zh  目录处理
     * @param  string $file   @note_zh 包含路径的文件   @note  File, contains the path
	 * @param  string $mode   @note_zh 访问权限         @note  access permission  
     * @return handle |false 
     */
    public function dir_handle ($file,$mode= 0777){
	    $dir= dirname($file); //返回路径中的目录部分
	    if(!is_dir($dir)){  //目录不存在
	    	mkdir ($dir,$mode);   //创建目录
	    }
	}
	
    /**
     * @title     fopen handle
	 * @title_zh  fopen 处理
     * @param  string $file   @note_zh 包含路径的文件   @note  File, contains the path
	 * @param  string $mode   @note_zh fopen()访问类型  @note  fopen() mode 
     * @return handle |false 
     */
    public function fopen_handle ($file,$mode){
	    $dir= dirname($file); //返回路径中的目录部分
	    if(!is_dir($dir)){  //目录不存在
	    	mkdir ($dir);   //创建目录
	    }
	
	    $t = new Timer(true);
	    $fp=fopen($file,$mode);
	    if($fp){
 	        $startTime=$t->startTime();
		
 	        do{
 	            $canWrite=flock($fp,LOCK_EX); //取得独占锁定（写入的程序）
 	        
	        }while((!$canWrite)&&(($t->stopTime()-$startTime)<10)); //单位：毫秒(ms)  <10ms
		
 	        if($canWrite){  	            
		    	return $fp;
 	        }else{			    
			    return false;
		    }
	    
	    }
    }

    /**
     * @title     Write to Flie 
	 * @title_zh  写入文件
     * @param  string $file   @note_zh 包含路径的文件   @note  File, contains the path
	 * @param  string $data   @note_zh 需写入的内容     @note  The content of the need to write to the file
	 * @param  string $mode   @note_zh fopen()访问类型  @note  fopen() mode 
	 * @param  bool   $close  @note_zh 关闭文件？       @note  Close the file? 
     * @return boolen 
     */
    public function write_files ($file,$data,$mode){
	    $dir= dirname($file); //返回路径中的目录部分
	    if(!is_dir($dir)){  //目录不存在
	    	mkdir ($dir);   //创建目录
	    }
	
	    $t = new Timer(true);
	    $fp=fopen(iconv('UTF-8','GB2312',$file),$mode); //iconv() 'UTF-8'转'GB2312'，解决中文文件名乱码问题
	    if($fp){
 	        $startTime=$t->startTime();
		
 	        do{
 	            $canWrite=flock($fp,LOCK_EX); //取得独占锁定（写入的程序）
 	        
	        }while((!$canWrite)&&(($t->stopTime()-$startTime)<10)); //单位：毫秒(ms)  <10ms
		
 	        if($canWrite){
  	            fwrite($fp,$data); //写入文件
		    	fclose($fp);      //关闭文件
		    	return true;
 	        }else{
			    fclose($fp);      //关闭文件
			    return false;
		    }
	    
	    }
    }

	
//--------------------------辅助函数----------------------------------------------------//
	
    public function __destruct() {
     
    }
}


/**
* @title     Calculation time difference
* @title_zh  计算时间差。 
*
* @abstract   Timer 
* @access     public
* @author     kuma<kuma000@qq.com>
* @date       2017-08-15 
*  
*/
class Timer{
	private $startTime;
	private $stopTime;
	private $To_ms=false; //转换为毫秒(ms)
	
	/**
     * @title     Constructor function 
	 * @title_zh  构造函数
     * @param  bool  $toms   @note_zh 转换为毫秒?  @note  Convert to milliseconds?
     */ 
	public function __construct($toms=false){
		$this->To_ms =$toms;
	}
	
	/**
     * @title     Get current Unix timestamp with microseconds
	 * @title_zh  获取当前 Unix 时间戳和微秒数
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function microtime_float(){
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
	
	/**
     * @title     Start time
	 * @title_zh  开始时间
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function startTime(){
		$this->startTime=$this->microtime_float();
	}
	
	/**
     * @title     Stop time
	 * @title_zh  结束时间
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function stopTime(){
		$this->stopTime=$this->microtime_float();
	}
	
	/**
     * @title     Stop time - Start time
	 * @title_zh  结束时间 - 开始时间
     * @return    seconds | milliseconds 
     */
	public function stop_start(){
		$timediff=$this->stopTime - $this->startTime; //计算差值
		$timediff= round($timediff,6);
		if($this->To_ms){  //转换为毫秒(ms)
			$timediff=$timediff*1000;
		}
		return $timediff;
	}

}


?>