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

// TODO: 欄位檢查, 後端的檢查


if (empty($_POST['your_password'])) {
    // 告訴用戶端沒有姓名資料
    $output['error'] = '沒有原密碼資料';
    // 除錯用的代號 可以自己定義
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_POST['new_password'])) {
    // 告訴用戶端沒有姓名資料
    $output['error'] = '沒有新密碼資料';
    // 除錯用的代號 可以自己定義
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$password = $_POST['new_password'];

$sid = $_POST['mem_sid'];
$sql = "UPDATE `member` SET `mem-password`=? WHERE `sid`=$sid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $password
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


// JSON_UNESCAPED_UNICODE 中文字不要編碼進行正確輸出
echo json_encode($output, JSON_UNESCAPED_UNICODE);