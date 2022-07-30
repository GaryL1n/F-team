<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

// TODO: 欄位檢查, 後端的檢查
if (empty($sid) or empty($_POST['produst_name'])) {
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

// if (!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
//     $output['error'] = 'email 格式錯誤';
//     $output['code'] = 405;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// TODO: 其他欄位檢查


$sql = "UPDATE `produst` SET `img`=?, `brand`=?, `name`=?, `info`=?, `price`=?, `update_at`=NOW() WHERE `sid`=$sid ";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $produst_img,
    $brand,
    $produst_name,
    $info,
    $price
]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
