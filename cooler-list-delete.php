<?php require __DIR__ . '/parts/connect_db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sid_ar = isset($_GET['sid']) ? ($_GET['sid']) : [];


if (!empty($sid)) {
    $pdo->query("DELETE FROM `lesson` WHERE sid=$sid");
}

if (!empty($sid_ar)) { // 如果我這個陣列沒有勾，
    $pdo->query("DELETE FROM `lesson` WHERE `sid` IN ($sid_ar)");
}

$come_from = 'cooler-list.php';

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");
