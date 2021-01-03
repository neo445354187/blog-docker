<?php
$aa = ['a', 'b', 'c'];

die;
# host中的mysql是服务别名，这里代表ip地址
//$serve = 'mysql:host=host.docker.internal;dbname=learn-yii;charset=utf8';
$serve = 'mysql:host=132.232.70.99;dbname=mysql;charset=utf8';#访问外网的数据库
$username = 'root';
$password = 'Flzx3000c.';
/*
 * CREATE USER 'newuser'@'%' IDENTIFIED BY '121212';
 * GRANT ALL PRIVILEGES ON *.* TO 'newuser'@'%';
 * ALTER USER ‘root'@'localhost' IDENTIFIED BY ‘xxxx'
 *  flush privileges;
 * */
try { // PDO连接数据库若错误则会抛出一个PDOException异常
    $pdo = new PDO($serve, $username, $password);
    $stmt = $pdo->prepare('select host,user,plugin from user where host=:id');
    $stmt->execute(["id" => '%']);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC表示将对应结果集中的每一行作为一个由列名索引的数组返回
    var_dump($data);
} catch (PDOException $error) {
    echo 'connect failed:' . $error->getMessage();
}
