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
	
	public  $Status_code=array();  //错误状态码   Error status code
	
    /**
     * @title     Constructor function 
	 * @title_zh  构造函数
     * @param  string  $DataFile   @note_zh 必需，数据文件路径  @note  Required, data file path
     * @param  string  $sep2  @note_zh 二级分割符               @note  Secondary separator
	 * @param  string  $sep3  @note_zh 三级分割符               @note  Tertiary separator
     */    
    public function __construct($DataFile,$sep2="",$sep3="") {

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

	}
	
//--------------------------辅助函数----------------------------------------------------//
	
	
	/**
	 * @title    Time format
 	 * @title_zh 时间格式化
	 * @param string $dateformat           @note_zh  时间格式               @note  time format
	 * @param boolean $ReturnTimestamp     @note_zh  返回时间戳格式?        @note  Returns the timestamp format?
	 * @param int $timestamp               @note_zh  时间戳                 @note  Timestamp
	 * @param int $timeoffset              @note_zh  时区偏移量             @note  Time zone offset
	 * @return string
	 */
	public function get_gmdate($dateformat = 'Y-m-d H:i:s',$ReturnTimestamp=false, $timeoffset = 8, $timestamp = '') { //默认 8 ，即中国时区

	}
	
	/**
 	 * @title    Random character generation
	 * @title_zh 随机字符生成	 
	 * @param int $length  @note_zh 生成字符的长度	 @note The length of the generated character 
	 * @return string
	 */ 
	public function generate_str( $length = 4 ) { 

	}
	
	/**
 	 * @title    Remove line breaks and remove Spaces
	 * @title_zh 去除换行符，去除空格	 
	 * @param string $value  @note_zh 需处理字符串   @note  Need to deal with string
	 * @return string
	 */ 
	public function Remove_EOL_Spaces($value) { 
	
	}
	
    /**
     * @title     Is numerically indexed array?
	 * @title_zh  是数字索引数组?
     * @param  array $arr   @note_zh 需判断的数组  @note  Need judge array
     * @return boolen 
     */
    public function is_num_array($arr){    
   
	}
	
    /**
     * @title     (2d / 3d) one column handle
	 * @title_zh  (二维/三维)单列处理 
     * @param  array $arr   @note_zh 需要处理的数组  @note  An array that needs to be handle
     * @param  boolen $toOne   @note_zh 转换为一(二)维数组?    @note   Converts to a one(two) dimensional array?
	 * @return array 
     */
	public function one_column_handle($arr,$toOne=false){

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

	}
	
    /**
     * @title     Two-dimensional array value handle, remove null element, remove the empty array
	 * @title_zh  二维数组值处理，去除空值元素，去除空数组
     * @param  array $arr   @note_zh 二维数组  @note   two-dimensional array
	 * @param  boolen $ResetNumIndex   @note_zh 重置数字索引?  @note   Reset the digital index?
     * @return array 
     */	
	public function two_arr_value_noempty($arr,$ResetNumIndex=true){

	}
	
	/**
     * @title     Three-dimensional array value handle, remove null element, remove the empty array
	 * @title_zh  三维数组值处理，去除空值元素，去除空数组
     * @param  array $arr   @note_zh 三维数组  @note   three-dimensional array
	 * @param  boolen $ResetNumIndex   @note_zh 重置数字索引?  @note   Reset the digital index?
     * @return array 
     */	
	public function three_arr_value_noempty($arr,$ResetNumIndex=true){

	}
	
    /**
     * @title     Value is not empty array
	 * @title_zh  值不是空数组
     * @param  array $arr   @note_zh 需判断的数组  @note  Need judge array
     * @return boolen 
     */
	public function value_noempty_arr($arr){
	
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
	
	}
	
	/**
	* @title    The depth of the array
	* @title_zh 数组深度
	* @param array $array    @note_zh 需判断的数组  @note  Need judge array
	* @return  int
	*/
	public function array_depth($array) {
   
	}
	
    /**
     * @title     dir handle
	 * @title_zh  目录处理
     * @param  string $file   @note_zh 包含路径的文件   @note  File, contains the path
	 * @param  string $mode   @note_zh 访问权限         @note  access permission  
     * @return handle |false 
     */
    public function dir_handle ($file,$mode= 0777){

	}
	
    /**
     * @title     fopen handle
	 * @title_zh  fopen 处理
     * @param  string $file   @note_zh 包含路径的文件   @note  File, contains the path
	 * @param  string $mode   @note_zh fopen()访问类型  @note  fopen() mode 
     * @return handle |false 
     */
    public function fopen_handle ($file,$mode){
	
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

	}

//--------------------------辅助函数----------------------------------------------------//

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

	
	/**
     * @title     Constructor function 
	 * @title_zh  构造函数
     * @param  bool  $toms   @note_zh 转换为毫秒?  @note  Convert to milliseconds?
     */ 
	public function __construct($toms=false){
		
	}
	
	/**
     * @title     Get current Unix timestamp with microseconds
	 * @title_zh  获取当前 Unix 时间戳和微秒数
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function microtime_float(){
       
    }
	
	/**
     * @title     Start time
	 * @title_zh  开始时间
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function startTime(){
		
	}
	
	/**
     * @title     Stop time
	 * @title_zh  结束时间
     * @return    microtime() ((float)$usec + (float)$sec)
     */
	public function stopTime(){
		
	}
	
	/**
     * @title     Stop time - Start time
	 * @title_zh  结束时间 - 开始时间
     * @return    seconds | milliseconds 
     */
	public function stop_start(){
		
	}

}

	




?>