<?php require __DIR__ . '/parts/connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (!empty($sid)) {


$bollen = '0';




$sql = "UPDATE `member` SET `mem-bollen`=? WHERE `sid`=$sid ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $bollen

]);

}
$come_from = 'gary-mem-list-true.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");