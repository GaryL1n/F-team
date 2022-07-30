<?php require __DIR__ . '/parts/connect_db.php';

// 有設定的話轉換成整數 沒有的話就是0
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

// 如果不是空字串或者是0
if (!empty($sid)) {
    $pdo->query("DELETE FROM `member` WHERE sid=$sid");
}

unset($_SESSION['user']);

$come_from = 'gary-member-login.php';

// 頁面跳轉到
header("Location: $come_from");
