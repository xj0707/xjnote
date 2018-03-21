<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6
 * Time: 17:19
 */
header("content-type:text/html;charset=utf8");
define('DB_HOST','localhost');//设置主机
define('DB_NAME','root');//用户名
define('DB_PWD','123321');//密码
define('DB_DATABASE','xiaojun');//数据库名
define('DB_TYPE','mysql');//数据库类型
define('DB_CHARSET','utf8');//显示编码方式
define('DB_LONGTIME',FALSE);//是否开启长连接

//单例模式
class XjPdo{
    private static $instance;//保存类的实例
    private static $pdo;//保存pdo的实例
    public static  $lastsql;//保存最后一条sql语句。
    private static $stmt;//保存pdostatment对象
    public static $lastInsertId=null;//自增最后一个id；
    //私有构造方法
    private function __construct(){
        //检查支不支持pdo;
        if(!class_exists("PDO")){
            self::throw_exception('不支持pdo,请先开启扩展');
        }
        //连接数据库
        $dsn=DB_TYPE.':host='.DB_HOST.';dbname='.DB_DATABASE;
        $params=array();
        if(constant('DB_LONGTIME')){//判断是否开启长连接；
            $params=array(PDO::ATTR_PERSISTENT=>true);
        }
        try{
            self::$pdo=new PDO($dsn,DB_NAME,DB_PWD,$params);
        }catch(PDOException $e){
            self::throw_exception($e->getMessage());
        }
        //设置数据库显示编码方式
        self::$pdo->exec('SET NAMES '.DB_CHARSET);
    }
    //唯一入口，实例化一次
    public static function getInstance(){
        if(!(self::$instance instanceof self)){//用instanceof这个关键字检测变量中存放的是不是当前的类实例,是返回true,不是返回false;
            self::$instance=new self;
        }
        return self::$instance;
    }
    //抛出异常
    private static function throw_exception($errMsg){
        echo '<div style="widht:80%;background-color: #ABCDEF;font-size: 20px;color: black">'.$errMsg.'</div>';
    }
   //新增数据
    public static function addData($table,$data){
        if(!is_array($data)){
            self::throw_exception('参数应该是个键值对的数组');
        }
        $data_keys_str=join(',',array_keys($data));
        //echo $data_keys_str;exit;
        $data_value=array_values($data);
        array_walk($data_value,array('XjPdo','addStrYinHao'));
        $data_val_str=join(',',$data_value);
        $sql="INSERT {$table}({$data_keys_str}) VALUES({$data_val_str})";
        self::$lastsql=$sql;
        self::$stmt=self::$pdo->prepare($sql);
        $res=self::$stmt->execute();
        if($res==false){
            self::haveErrorThrowException();
        }
        self::$lastInsertId= self::$pdo->lastInsertId();
        return  self::$stmt->rowCount();
    }
    //获取上一条自增主键ID
    public static  function getLastInsetId(){
        return self::$lastInsertId;
    }
    //删除数据
    public static function del($table,$where=''){
        $where_str='';
        if(is_array($where)){
            $where_str=join(',',$where);
        }
        if(is_string($where)){
            $where_str=$where;
        }
        if($where_str==''){
            $sql='delete from '.$table;
        }else{
            $sql='delete from '.$table.' where '.$where_str;
        }
        self::$lastsql=$sql;
        self::$stmt=self::$pdo->prepare($sql);
        $res=self::$stmt->execute();
        if($res==false){
            self::haveErrorThrowException();
        }
        return  self::$stmt->rowCount();
    }
    //修改数据
    public static function update($table,$data,$where=''){
        $where_str='';
        if(is_array($where)){
            $where_str=join(',',$where);
        }
        if(is_string($where)){
            $where_str=$where;
        }
        $filedstr='';
        if(is_array($data)){
            foreach($data as $k=>$v){
                $filedstr.= $k .'='.self::$pdo->quote($v).', ';
            }
            $filedstr=substr($filedstr,0,strlen($filedstr)-2);
        }
        //echo $filedstr;exit;
        if(is_string($data)){
            $filedstr=$data;
        }
        if($where_str==''){
            $sql='update '.$table.' set '.$filedstr ;
        }else{
            $sql='update '.$table.' set '.$filedstr .' where '.$where_str;
        }
        self::$lastsql=$sql;
        self::$stmt=self::$pdo->prepare($sql);
        $res=self::$stmt->execute();
        if($res==false){
            self::haveErrorThrowException();
        }
        return  self::$stmt->rowCount();
    }
    //查询数据
    public static function find($sql){
        $pdostat=self::$pdo->prepare($sql);
        $res=$pdostat->execute();
        if($res==false){
            self::haveErrorThrowException();
        }
        $row=$pdostat->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    //抛出异常
    public static function haveErrorThrowException(){
        $arrError=self::$stmt->errorInfo();
        if($arrError[0]!='00000'){
            $error='SQLSTATE: '.$arrError[0].' <br/>SQL Error: '.$arrError[2].'<br/>Error SQL:'.self::$lastsql;
            self::throw_exception($error);
            return false;
        }
    }
    //给值加上引号
    public static function addStrYinHao(&$value){
        $value=self::$pdo->quote($value);
        return $value;
    }
    //防止克隆
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

$dbObj=XjPdo::getInstance();
//$data=[
//    'username'=>'test1',
//    'password'=>md5('123'),
//    'email'=>'test@qq.com',
//    'create_time'=>time()
//];
////$dbObj->addData('admin_user',$data);
////echo $dbObj->update('admin_user',$data,'id=9');
////echo $dbObj::$lastsql;
$sql="select * from admin_user";
$res=$dbObj::find($sql);
var_dump($res);
////echo $dbObj->getLastInsetId();
////echo $dbObj->del('admin_user','id=8');