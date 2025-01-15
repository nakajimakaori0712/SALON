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

            <h1>画像アップロード</h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>アップロードファイル</label>
                    <input type="file" name="image" class="form-control-file">
                </div>
                <input type="submit" value="アップロードする" class="btn btn-primary">
            </form>
        </main>
    </body>
</html>