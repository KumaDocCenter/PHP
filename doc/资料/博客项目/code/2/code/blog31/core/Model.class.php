<?php

namespace core;//创建一个   全局空间   下的  core空间

class Model{
    private $type;//数据库的类型
    private $host;//IP地址
    private $port;//端口号
    private $charset;//字符集
    private $dbname;//默认选择的数据库
    private $acc;//帐号
    private $pwd;//密码

    private $pdo;

    //public function __construct($type='mysql', $host='localhost', $port=3306, $charset='utf8', $dbname='test', $acc='root', $pwd='123abc'){ 
    public function __construct($type='', $host='', $port='', $charset='', $dbname='', $acc='', $pwd=''){ 

        //初始化参数
        //$this->type = $type;
        //$this->host = $host;
        //$this->port = $port;
        //$this->charset = $charset;
        //$this->dbname = $dbname;
        //$this->acc = $acc;
        //$this->pwd = $pwd;

        //$this->type = ($type==='') ? $GLOBALS['config']['PDO']['type'] : $type;//如果$type为空字符串，表示没有传值，没有传值则直接使用配置中的配置值；如果有值，则直接使用传递的$type的值
        //$this->host = ($host==='') ? $GLOBALS['config']['PDO']['host'] : $host;
        //$this->port = ($port==='') ? $GLOBALS['config']['PDO']['port'] : $port;
        //$this->charset = ($charset==='') ? $GLOBALS['config']['PDO']['char'] : $charset;
        //$this->dbname = ($dbname==='') ? $GLOBALS['config']['PDO']['db'] : $dbname;
        //$this->acc = ($acc==='') ? $GLOBALS['config']['PDO']['acc'] : $acc;
        //$this->pwd = ($pwd==='') ? $GLOBALS['config']['PDO']['pwd'] : $pwd;

        $this->type = ($type==='') ? C('PDO.type') : $type;//如果$type为空字符串，表示没有传值，没有传值则直接使用配置中的配置值；如果有值，则直接使用传递的$type的值
        $this->host = ($host==='') ? C('PDO.host') : $host;
        $this->port = ($port==='') ? C('PDO.port') : $port;
        $this->charset = ($charset==='') ? C('PDO.char') : $charset;
        $this->dbname = ($dbname==='') ? C('PDO.db') : $dbname;
        $this->acc = ($acc==='') ? C('PDO.acc') : $acc;
        $this->pwd = ($pwd==='') ? C('PDO.pwd') : $pwd;

        //连库基本操作
        $this->connect();

        //设置错误处理模式属性
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    #连库基本操作
    private function connect(){ 
        
        $dsn = "{$this->type}:host={$this->host};port={$this->port};charset={$this->charset};dbname={$this->dbname}";
        $this->pdo = new \PDO($dsn, $this->acc, $this->pwd);
    }

    #设置操作
    public function setData($sql){ 
        
        try{
            $this->pdo->exec($sql);//监听执行增删改的操作
        }catch(\PDOException $err){
            //输出错误信息
            echo '错误的代号：' . $err->getCode() . '<br/>'; 
            echo '错误的信息：' . $err->getMessage() . '<br/>'; 
            echo '错误的行号：' . $err->getLine() . '<br/>'; 
            echo '错误的文件：' . $err->getFile(); 
            return false;
        }
        return true;
    }

    #查一条数据
    public function getRow($sql){ 
        
        try{
            $pdostatement = $this->pdo->query($sql);//监听执行增删改的操作
        }catch(\PDOException $err){
            //输出错误信息
            echo '错误的代号：' . $err->getCode() . '<br/>'; 
            echo '错误的信息：' . $err->getMessage() . '<br/>'; 
            echo '错误的行号：' . $err->getLine() . '<br/>'; 
            echo '错误的文件：' . $err->getFile(); 
            return false;
        }
        return $pdostatement->fetch(\PDO::FETCH_ASSOC);//返回解析得到的一条关联数组数据
    }

    #查询多条数据
    public function getRows($sql){ 
        
        try{
            $pdostatement = $this->pdo->query($sql);//监听执行增删改的操作
        }catch(\PDOException $err){
            //输出错误信息
            echo '错误的代号：' . $err->getCode() . '<br/>'; 
            echo '错误的信息：' . $err->getMessage() . '<br/>'; 
            echo '错误的行号：' . $err->getLine() . '<br/>'; 
            echo '错误的文件：' . $err->getFile(); 
            return false;
        }
        return $pdostatement->fetchAll();//返回解析得到的一条关联数组数据
    }
}