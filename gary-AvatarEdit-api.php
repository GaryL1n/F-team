<?php
require __DIR__ . '/parts/connect_db.php';
// 檔頭設定成JSON  預設是HTML
header("Content-type:application/json");

// 要輸出的功能
$output = [
    // 有沒有新增成功
    'success' => false,
    // 前端傳過來什麼資料 再丟回去
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];



$avatar = $_POST['mem_avatar'] ?? '';
// 沒有給的話給空字串

$sid = $_POST['mem_sid'];
$sql = "UPDATE `member` SET `mem-avatar`=? WHERE `sid`=$sid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $avatar,
]);

// rowCount()有沒有修改
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


// JSON_UNESCAPED_UNICODE 中文字不要編碼進行正確輸出
echo json_encode($output, JSON_UNESCAPED_UNICODE);