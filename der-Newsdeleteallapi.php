<?php require __DIR__ . '/parts/connect_db.php';

$sid_ar = isset($_GET['sid']) ? $_GET['sid'] : [];

// if (!empty($sid_ar)) {
//     echo json_encode($sid_ar);
//     exit;
// } 測試回傳資料是什麼型態

if (!empty($sid_ar)) {
    $pdo->query("DELETE FROM `News` WHERE `sid` IN ($sid_ar)");
}


$come_from = 'der-NewsList.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}


// // 刪除完成 跳轉回列表
header("Location: $come_from");
