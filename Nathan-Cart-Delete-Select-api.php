<?php require __DIR__ . '/parts/connect_db.php';

$produst_id_ar = isset($_GET['produst_id']) ? $_GET['produst_id'] : [];

// if (!empty($sid_ar)) {
//     echo json_encode($sid_ar);
//     exit;
// } 測試回傳資料是什麼型態

if (!empty($produst_id_ar)) {
        $pdo->query("DELETE FROM `cart` WHERE `produst_id` IN ($produst_id_ar)");
    }


$come_from = 'Nathan-ViewCart.php';
if(!empty($_SERVER['HTTP_REFERER'])){
    $come_from = $_SERVER['HTTP_REFERER'];
}


// // 刪除完成 跳轉回列表
header("Location: $come_from");
