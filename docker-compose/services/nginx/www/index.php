<?php
$redis = new Redis();
$redis->connect('172.19.0.5', 6379);
$redis->auth('121212');
//$redis->set('a','bbb');
echo $redis->get('a');
die;
# host中的mysql是服务别名，这里代表ip地址
$serve = 'mysql:host=mysql:3306;dbname=test;charset=utf8';
$username = 'root';
$password = 'L@123.';
/*
 * CREATE USER 'newuser'@'%' IDENTIFIED BY '121212';
 * GRANT ALL PRIVILEGES ON *.* TO 'newuser'@'%';
 * ALTER USER ‘root'@'localhost' IDENTIFIED BY ‘xxxx'
 *  flush privileges;
 * */
try{ // PDO连接数据库若错误则会抛出一个PDOException异常
    $pdo = new PDO($serve,$username,$password);
    $stmt = $pdo->prepare('select * from user where id=:id');
    $stmt->execute(["id"=>'3']);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC表示将对应结果集中的每一行作为一个由列名索引的数组返回
    var_dump($data);
} catch (PDOException $error){
    echo 'connect failed:'.$error->getMessage();
}
