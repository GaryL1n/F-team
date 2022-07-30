<?php
require __DIR__ . '/parts/connect_db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$title = isset($_POST['title']) ? $_POST['title'] : '';
$info = isset($_POST['info']) ? $_POST['info'] : '';
$image = isset($_POST['der_img']) ? $_POST['der_img'] : '';

$sql = "INSERT INTO `News`(`title`, `info`, `image`, `created_at`, `update_at`) VALUES (?,?,?,NOW(),NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $title,
    $info,
    $image,
]);
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
