<?php
$msg = null;   //アップロード状況を示す
$alert = null;    //メッセージのデザイン用
//アップロード処理
if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    $old_name = $_FILES['image']['tmp_name'];
    $new_name = date("YmdHis");   //ベースは日付
    $new_name.= mt_rand();    //ランダム数字追加
    $size = getimagesize($_FILES['image']['tmp_name']);
    switch($size[2]){
        case IMAGETYPE_JPEG:
            $new_name.= '.jpg';
            break;
        case IMAGETYPE_GIF:
            $new_name.= '.gif';
            break;
        case IMAGETYPE_PNG:
            $new_name.='.png';
            break;
        default:
        header('Location:upload.php');
        exit();
    }
    if(move_uploaded_file($old_name,'album/'.$new_name)){
        $msg = 'アップロードしました';
        $alert = 'success';
    }else{
        $msg = 'アップロードできませんでした';
        $alert = 'danger';  
    }
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

            <h1>画像アップロード</h1>
            <?php
            if($msg){
                echo '<div class="alert alert-'.$alert.'" role="alert">'.$msg.'</dv>';
            }
            ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>アップロードファイル</label><br>
                    <input type="file" name="image" class="form-control-file">
                </div>
                <input type="submit" value="アップロードする" class="btn btn-primary">
            </form>
        </main>
    </body>
</html>