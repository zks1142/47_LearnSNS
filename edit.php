<?php
session_start();
require('dbconnect.php');

$sql = 'SELECT * FROM `users` WHErE `id` =?';
$data = [$_SESSION['47_learnsns']['id']];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

//編集措置
//1.GETパラメータを取得
if(isset($_GET['feed_id'])){
$feed_id = $_GET['feed_id'];
//2.SQL文定義
$sql = 'SELECT f.*,`u`.`name`, `u`.`img_name` FROM `feeds` as `f` LEFT JOIN `users` as `u` ON `f`.`user_id` = `u`.`id` WHERE `f`.`id` = ?';
$data = [$feed_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);
//3.　投稿情報を一軒取得
$feed = $stmt->fetch(PDO::FETCH_ASSOC);
}
if(!empty($_POST)){
    $feed = $_POST['feed'];
    $sql = 'UPDATE `feeds` SET `feed` = ? WHERE `id` = ?';
    $data = [$_POST['feed'],$_POST['feed_id']];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location: timeline.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px;">
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <form class="form-group" method="post" action="edit.php">
                    <img src="user_profile_img/<?php echo $feed['img_name'];?>" width="60">
                    <?php echo $feed['name'];?><br>
                    <?php echo $feed['created'];?><br>
                    <textarea name="feed" class="form-control"><?php echo $feed['feed'];?></textarea>
                    <input type="hidden" name="feed_id" value="<?php echo $feed['id']; ?>">
                    <input type="submit" value="更新" class="btn btn-warning btn-xs">
                </form>
            </div>
        </div>
    </div>
</body>
<?php include('layouts/footer.php'); ?>
</html>