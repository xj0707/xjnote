<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/6 0006
 * Time: 上午 12:31
 */
//pdo一些知识汇总
try{
    //1.pdo 连接
    $dsn='mysql:host=localhost;dbname=XiaoJun';
    $username='root';
    $password='';
    $pdo=new PDO($dsn,$username,$password);
    //2.pdo  exec()方法 返回受影响记录的条数,用于新增，更新，删除。如果sql 语句有错，返回false .所以可以用errorInfo()来看错误信息.
    $sql="";
    $res=$pdo->exec($sql);
    //3.pdo lastInsertId() 返回最后插入的ID的值，实际上是auto_increment的值。
    $pdo->lastInsertId();//只针对插入
    //4.pdo errorCode();返回错误码， errorInfo();返回错误信息数组
    //if($res===false){print_r($pdo->errorInfo())}
    //5.pdo query()方法，用于查询，返回PDOStatement对象
    $pdostat=$pdo->query($sql);//得到一个二维数组，可以用foreach()来遍历
    //6.预处理 准备sql语句 prepare();返回PDOStatement对象------常用这种方法来做
    $pdostat=$pdo->prepare($sql);
    //7.然后执行预处理语句 execute();
    $res=$pdostat->execute();//操作成功返回TRUE；
    //8.然后调用pdostatement里面的方法 获取结果集 fetch()获取结果集的一条记录
    $row=$pdostat->fetch();
    //9. 获取所有结果集
    $row=$pdostat->fetchAll();
    //10.getAttribute()获取数据集连接属性
    $pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);//获取自动提交的值
    //11.setAttribute()设置数据库连接的属性；
    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
    //12.不建议使用；quote()PDO对象中quote方法返回带引号的字符串，可以过滤来自输入中的特殊字符用反斜线转义\
    //$username = $_POST['username'];
    //$username=$pdo->quote($username);//自动为字符串加上引号
    //$sql='select * from uesr where username={$username}'//这里的$username就不用加引号了
    //13.常用占位符来防止sql注入。
    $sql="select * from user where username=:username and password=:password";
    $pdostatme=$pdo->prepare($sql);
    //$pdostatme->execute(array(':username'=>$username,':password'=>$password));//方法一直接通过数组来写；
    //方法二绑定参数
    $pdostatme->bindParam(":username",$username);//注：必须写变量，不能直接写值
    $pdostatme->bindParam(":password",$password);
    $pdostatme->execute();
    $pdostatme->rowCount();//返回上一个sql语句影响的行数。
    //14.如果一个值一直使用可以用bindValue()来绑定一个值。可以只写一次
    //15.打印预处理语句的方法 debugDumpParams();
    $pdostatme->debugDumpParams();
    //16.pdo 错误处理模式。默认模式是静默模式，不会报错。
    //常用异常模式，设置异常模式。
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//设置这个会报出异常错误。
    //17.pdo 的事务处理
    $pdo->beginTransaction();//开启事务，关闭自动提交。
    $pdo->commit();//都成功提交
    $pdo->rollBack();//失败就回滚，开启自动提交。
}catch(PDOException $e){
    echo $e->getMessage();
}
