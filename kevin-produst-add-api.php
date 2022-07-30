<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['produst_name'])) {
    $output['error'] = '沒有商品資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$produst_img = $_POST['produst_img'] ?? '';
$brand = $_POST['brand'] ?? '';
$produst_name = $_POST['produst_name'] ?? '';
// $birthday = empty($_POST['birthday']) ? NULL : $_POST['birthday'];
$info = $_POST['info'] ?? '';
$price = $_POST['price'] ?? '';
$mem_avatar = $_POST['mem_avatar'] ?? '';

if (!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $output['error'] = 'email 格式錯誤';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
// TODO: 其他欄位檢查


$sql = "INSERT INTO `produst`(
    `img`, `brand`, `name`, 
    `info`, `price`, `create_at`
    ) VALUES (
        ?, ?, ?,
        ?, ?, NOW()
    )";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $mem_avatar,
    $brand,
    $produst_name,
    $info,
    $price,
]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}
// isset() vs empty()


echo json_encode($output, JSON_UNESCAPED_UNICODE);
