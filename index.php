<?php $fp = fopen("info.txt","r"); ?>
<?php $info = file_get_contents("info.txt"); ?>
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
            if($fp){
                $title = fgets($fp);
                if($title){
                  echo '<p><a href="info.php">'.$title.'</a></p>';
                }else{
                    echo '<p>お知らせはありません</p>';
                }  
                fclose($fp);
            }else{
                echo '<p>お知らせはありません</p>';
            }
             ?>
        </main>
    </body>
</html>