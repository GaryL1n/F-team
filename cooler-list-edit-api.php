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
if (empty($_POST['name'])) {
    $output['error'] = '沒有課程名稱資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['name'];
$info = $_POST['info'];
$duringtime_begin = $_POST['duringtime_begin'];
$duringtime_end = $_POST['duringtime_end'];
$number_of_people = $_POST['number_of_people'];
$price = $_POST['price'];
$teacher = $_POST['teacher'];
$location = $_POST['location'];

// TODO: 其他欄位檢查


$sql = "UPDATE `lesson` SET `name`=?, `info`=?, `duringtime_begin`=?, `duringtime_end`=?, `number_of_people`=?, `price`=?, `teacher`=?, `location`=?, `updated_at`=NOW() WHERE `sid`=$sid";

// `created_at`=NOW()

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $name,
    $info,
    $duringtime_begin,
    $duringtime_end,
    $number_of_people,
    $price,
    $teacher,
    $location,


]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key

} 
// 後端呈現但我的會影響畫面
else {
    $output['error'] = '資料沒有修改';  
}
// isset() vs empty()


echo json_encode($output, JSON_UNESCAPED_UNICODE);
