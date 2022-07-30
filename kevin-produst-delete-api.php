<?php require __DIR__ . '/parts/connect_db.php';

$sid_ar = isset($_GET['sid']) ? $_GET['sid'] : [];

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (!empty($sid)) {
    $pdo->query("DELETE FROM `produst` WHERE sid=$sid");
}

if (!empty($sid_ar)) { // 如果我這個陣列沒有勾，
    $pdo->query("DELETE FROM `produst` WHERE `sid` IN ($sid_ar)");
}


$come_from = 'kevin-produst.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");
