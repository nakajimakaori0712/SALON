<?php
$images =array();
$num =4;   //1ページに表示する画像の枚数

if($handle =opendir('./album')){
    while($entry = readdir($handle)){
        if($entry != "." && $entry != ".."){
            $images[] =$entry;
        }
    }
    closedir($handle);
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

            <h1>アルバム</h1>
            <?php
            if(count($images) >0){
                echo '<div class="row">';

                //指定枚数ごとに画像ファイルを分解
                $images = arry_chunk($images,$num);
                $page =1;    //ページ数

                //GETでページ数が指定されていた時
                if(isset($_GET['page']) && is_numeric($_GET['page'])){
                    $page = intval($_GET['page']);
                    if(!isset($images[$page-1])){
                        $page =1;
                    }
                }
                foreach($images[$page-1] as $img){
                    echo '<div class="col-3">';
                    echo   '<div class="card">';
                    echo     '<a href="./album/'.$img.'" target="_brank"><img src="./album/'.$img.'" class="img-fluid"></a>';
                    echo   '</div>';
                    echo '</div>';
                }
                echo '</div>';

                //ページ数リンクを表示
                echo '<nav><ul class="pagination">';
                for($i = 1; $i <= count($images); $i++){
                    echo '<li class="page-item"><a class="page-link" href="album.php?page='.$i.'">'.$i.'</a></li>';
                }
                echo '</ul></nav>';
            }else{
                echo '<div class="alert alert-dark" role="alert">画像はまだありません</div>';
            }
             ?>
        </main>
    </body>
</html>