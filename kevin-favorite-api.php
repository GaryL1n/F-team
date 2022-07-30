<?php
require __DIR__ . '/parts/connect_db.php';

// 拿到會員資料表
$sql = "SELECT  * FROM `member` WHERE 1;";
$mem_sql = $pdo->query($sql)->fetchAll();

// 比對登入會員後，會員資料表的帳號是不是同個會員的帳號
foreach ($mem_sql as $rows => $r) {
    if ($r['mem-account'] === $_SESSION['user']['mem_account']) {
        // 取得登入中的會員id
        $memLoginID = $r['sid'];
    }
}

// 接收點擊後拿到該欄位的資料設定
$produstSid = isset($_GET['produstSid']) ? intval($_GET['produstSid']) : 0;
// 商品資料表拿到該欄位的所有資料
$pro_sql = "SELECT * FROM `produst` WHERE `produst`.`sid` = $produstSid";
$produst_sql = $pdo->query($pro_sql)->fetch();

// 避免重複收藏商品
$fav_where = "SELECT * FROM `favorite` WHERE `mem_id`= $memLoginID";
$fav_sql = $pdo->query($fav_where)->fetchAll();

foreach ($fav_sql as $rows => $r) {
    if ($r['product_id'] == $produstSid) {
        echo "
            <script>
                alert('此商品已經收藏。');
                history.back()
            </script>
        ";
        exit;
    }
}



// 把商品資料表拿到的資料新增到 收藏資料表裡
$insert_fav_sql = "REPLACE INTO `favorite`(`mem_id`, `product_img`, `product_brand`, `product_name`, `product_info`, `product_price`,`product_id`) VALUES (?,?,?,?,?,?,?);";
$stmt = $pdo->prepare($insert_fav_sql);
$stmt->execute([
    $memLoginID,
    $produst_sql['img'],
    $produst_sql['brand'],
    $produst_sql['name'],
    $produst_sql['info'],
    $produst_sql['price'],
    $produst_sql['sid']
]);






$come_from = 'kevin-produst.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}
if ($stmt->rowCount() === 1) {
    echo "
    <script>
        alert('收藏成功。');
        window.location.href = '$come_from';
    </script>
";
} else {
    echo "
    <script>
        alert('收藏失敗，請再次嘗試。');
        window.location.href = '$come_from';
    </script>
";
}
