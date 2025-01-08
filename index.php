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
              <p><?php echo $info; ?></p>
        </main>
    </body>
</html>