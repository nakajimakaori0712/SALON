<?php
$id = intval($_POST['id']);
$pass = $_POST['pass'];

if($id == '' || $pass==''){
    header('Location:bbs.php');
    exit();
}

$dsn='mysql:host=localhost;dbname=salon;charset=utf8';
$user='user';
$password='password';

try{
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $db->prepare("DELETE FROM bbs WHERE id=:id AND pass=:pass");
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $stmt->bindParam(':pass',$pass,PDO::PARAM_STR);

    $stmt->execute();
}catch(PDOException $e){
    exit("エラー：".$e->getMessage());
}
header('Location:bbs.php');
exit();
?>