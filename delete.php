<?php
require('dbconnect.php');
//1.どの投稿を削除するか
$feed_id = $_GET['feed_id'];
//POST→登録などのフォーム(formタグ)
//GET→データを取得(aタグ)

//2.Delete処理
$sql = 'DELETE FROM `feeds` WHERE `id` = ?';
$data = [$feed_id];
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

//3.
header("Location: timeline.php");
exit();