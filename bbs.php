<?php
$num =10;

//DBに接続
$dsn= 'mysql:host=localhost;dbname=salon;charset=utf8';
$user = 'user';
$password = 'password';

//GETメソッドで2ページ目以降が指定されているとき
$page =1;
if(isset($_GET['page']) && $_GET['page'] >1){
    $page = intval($_GET['page']);
}

try{
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $db->prepare("SELECT * FROM bbs ORDER BY date DESC LIMIT :page, :num");
    $page = ($page-1) * $num;
    $stmt->bindParam(':page',$page,PDO::PARAM_INT);
    $stmt->bindParam(':num',$num,PDO::PARAM_INT);

    $stmt->execute();
}catch(PDOException $e){
    exit("エラー：".$e->getMessage());
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

            <h1>予約</h1>
            <form acton="write.php" method="post">
                <div class="form-group">
                    <label>タイトル</label><br>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>名前</label>
                    <input typ="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="body" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>削除パスワード</label>
                    <input type="text" name="pass" class="form-control">
                 </div>
                 <input type="submit" class="btn btn-primary" value="書き込む">
            </form>
            <hr>
            <?php while($row = $stmt->fetch()): ?>
            <div class="card">
                <div class="card-header"><?php echo $row['title']?$row['title']:'（無題）'; ?></div>
                <div class="card-body">
                    <p class="card-text"><?php echo nl2br($row['body']) ?></p>
                </div>
                <div class="card-footer">
                    <form action="delete.php" method="post" class="form-inline">
                        <?php echo $row['name']; ?>
                        (<?php echo $row['date']; ?>)
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="text" name="pass" placeholder="削除パスワード" class="form-control">
                        <input type="submit" value="削除" class="btn btn-secondary">
                    </form>
                </div>
            </div>
            <hr>
            <?php endwhile; ?>

            <?php
            try{
                $stmt = $db->prepre("SELECT COUNT(*) FROM bbs");
                $stmt->execute();
            }catch(PDOException $e){
                exit("エラー：".$e->getMessage());
            }

            $comments = $stmt->fetchColumn();
            $max_page = ceil($comments/$num);
            if($max_page >=1){
                echo '<nav><ul class="pagination">';
                for($i =1;$i<= $max_page; $i++){
                    echo '<li class="page-item"><a href="bbs.php?page='.$i.'">'.$i.'</a></li>';
                }
                echo '</ul><?nav>';
            }
            ?>
        </main>
    </body>
</html>