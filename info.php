<?php
$fp = fopen("info.txt","r");
$line = array();
$body = '';

if($fp){
    while(!feof($fp)){
        $line[] = fgets($fp);
    }
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <title>SALON</title>
        <link rel="stylesheet" href="./style.css"> 
    </head>

    <body>
        <?php include('navbar.php') ?>

        <main class="container">
            <div>
                <h1>SALON</h1>
            </div>
    
            <h1>お知らせ</h1>
            <?php
            if(count($line) >0){
                for($i=0;$i < count($line); $i++){
                    if($i == 0){
                        echo '<h2>'.$line[0].'</h2>';
                    }else{
                        $body .= $line[1].'<br>';
                    }
                }
            }else{
                $body = 'お知らせはありません';
            }
            echo '<p>'.$body.'</p>';
            ?>
            </main>
    </body>
</html>
