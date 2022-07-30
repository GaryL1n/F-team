<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');



$output = [
    'success' => false,
    'bollen' => false,
    'new' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['mem_account'])) {
    $output['error'] = '沒有';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$mem_account = $_POST['mem_account'];
$mem_password = $_POST['mem_password'];


$sql = "SELECT  * FROM `member` WHERE 1;";

// $stmt = $pdo->query($sql);

$AccAndPwd = $pdo->query($sql)->fetchAll();
// echo json_encode($rrr, JSON_UNESCAPED_UNICODE);

foreach ($AccAndPwd as $k => $v) {

    if (isset($_POST['mem_account'])) {

        if (!empty($_POST['mem_account']) and !empty($_POST['mem_password'])) {


            if (!empty($AccAndPwd[$k])) {
                // echo json_encode($rrr[1]['member_password'], JSON_UNESCAPED_UNICODE);

                if ($_POST['mem_password'] === $AccAndPwd[$k]['mem-password']) {

                    $output['bollen'] = true;
                    
                    if ($AccAndPwd[$k]['mem-bollen'] == 1) {
                        // 登入成功
                        // 把資料設定到 session 裡 
                        $output['success'] = true;
                        $_SESSION['user'] = [
                            'mem_account' => $_POST['mem_account'],
                            'grade' => 'low',
                        ];
                        //台灣時間
                        date_default_timezone_set('Asia/Taipei');
                        # 取得日期與時間
                        $now = date('Y/m/d H:i:s');
                        // 會員創建時間
                        $created = $AccAndPwd[$k]['mem-created_at'];
                        if ((strtotime($now) - strtotime($created)) / (60 * 60 * 24) < 1) {
                            $output['new'] = true;
                            $_SESSION['user'] = [
                                'mem_account' => $_POST['mem_account'],
                                'grade' => 'low',
                                'new' => true,
                            ];
                        } else {
                            $_SESSION['user'] = [
                                'mem_account' => $_POST['mem_account'],
                                'grade' => 'low',
                                'new' => false,
                            ];
                        }
                    }
                }
            }
        }
    }
}






echo json_encode($output, JSON_UNESCAPED_UNICODE);
