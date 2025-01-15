<?php
$name = $_POST['name'];
$title = $_POST['title'];
$body = $_POST['body'];
$pass = $_POST['pass'];

if($name =='' || $body == ''){
    header("Location:bbs.php");   //空の時bbs.phpｈ移動
    exit();
}

//パスワードが4桁の数字かどうか
if(!preg_match("/^[0-9]{4}$/",$pass)){
    header("Location:bbs.php");
    exit();
}

//DBに接続
$dsn = 'mysql:host=localhost;dbname=salon;charset=utf8';
$user = 'user';
$password = 'password';

try{
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt =$db->prepare("
    INSERT INTO bbs(name,title,body,date,pass)
    VALUES(:name,:title,:body,now(),:pass)"
    );

    $stmt->bindParam(':name',$name,PDO::PARAM_STR);
    $stmt->bindParam(':title',$title,PDO::PARAM_STR);
    $stmt->bindParam(':body',$body,PDO::PARAM_STR);
    $stmt->bindParam(':pass',$pass,PDO::PARAM_STR);

    $stmt->execute();

    header('Location:bbs.php');
    exit();
}catch(PDOException $e){
    exit('エラー：'. $e->getMessage());
}
?>