<?php
// 告訴檔頭這是JSON格式
header('Content-Type: application/json');

// 定義一個變數是這個php檔案所在位置的uploaded 結尾斜線可加可不加
$folder = __DIR__ . '/gary-uploaded/';

// 用來篩選檔案, 用來決定副檔名
$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$output = [
    // 有沒有上傳成功
    'success' => false,
    // 檔案名稱
    'filename' => '',
    // 錯誤訊息
    'error' => '',
];

// 如果是空值，程式碼就不往下做了
if (empty($extMap[$_FILES['avatar']['type']])) {
    // 在console提示訊息
    $output['error'] = '檔案類型錯誤';
    // 中文字正常顯示
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$ext = $extMap[$_FILES['avatar']['type']]; // 副檔名

// 主檔名名稱
// 接亂數再經過md5編碼長度固定再32個字元 最後再接上副檔名
$filename = md5($_FILES['avatar']['name'] . rand()) . $ext;

// 最終檔案名稱叫什麼
$output['filename'] = $filename;

// 把上傳的檔案搬移到指定的位置 然後用原來的檔名['myfile']['name']
// 暫存的名稱(tmp_name)會包含路徑所以不用給路徑
// 把上傳的檔案搬移到指定的位置
if (move_uploaded_file($_FILES['avatar']['tmp_name'], $folder . $filename)) {
    $output['success'] = true;
} else {
    $output['error'] = '無法搬動檔案';
}

// 轉換成JSON格式輸出
echo json_encode($output);
