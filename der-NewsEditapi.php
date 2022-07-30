<?php
require __DIR__ . '/parts/connect_db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$sid = isset($_POST['sid']) ? $_POST['sid'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$info = isset($_POST['info']) ? $_POST['info'] : '';

$sql = "UPDATE `News` SET `title`=?,`info`=? ,`update_at` = NOW() WHERE `sid` = $sid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $title,
    $info,
]);
if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
