<?php
session_start();
require('dbconnect.php');

$sql = 'SELECT * FROM `users` WHErE `id` =?';
$data = [$_SESSION['47_learnsns']['id']];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

$users = $stmt->fetch(PDO::FETCH_ASSOC);



?>
<?php include('layouts/header.php'); ?>
<body style="margin-top: 60px; background: #E4E6EB;">
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php foreach($users as $user): ?>
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="user_profile_img/<?php echo $user['img_name']; ?>" width="80px">
                        </div>
                        <div class="col-xs-10">
                            名前 <a href="profile.php" style="color: #7f7f7f;"><?php echo $user['name']; ?></a>
                            <br>
                            2018-10-14 12:34:56からメンバー
                        </div>
                    </div>
                    <div class="row feed_sub">
                        <div class="col-xs-12">
                            <span class="comment_count">つぶやき数：10</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
<?php include('layouts/footer.php'); ?>
</html>
