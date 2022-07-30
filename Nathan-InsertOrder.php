<?php require __DIR__ . '/parts/connect_db.php';
$pageName = "Nathan's Order Page";
$title = "Nathan-OrderPage - Nathan's cart";

// get 拿取 被選取項目的 produst_id
$produst_id = isset($_GET['produst_id'])?($_GET['produst_id']):'';
if($produst_id === ""){
    echo "
        <script>
            alert('請勾選您要結帳的商品');
            window.location.href = 'Nathan-ViewCart.php';
        </script>
    ";
};

// 取得登入中的會員sid
$sql = "SELECT  * FROM `member` WHERE 1;";
$mem_sql = $pdo->query($sql)->fetchAll();
foreach ($mem_sql as $rows => $r) {
    if ($r['mem-account'] === $_SESSION['user']['mem_account']) {
        $memLoginID = $r['sid'];
    }
}

// 取得此會員的購物車紀錄 and 被選取的項目
$cart_sql = $pdo->query("SELECT * FROM `cart` WHERE `produst_id` IN ($produst_id) AND `member_id` = $memLoginID;")->fetchAll();


// 取得此筆消費總金額
$od_total_price = 0;
foreach ($cart_sql as $k => $v) {
    $od_total_price += $v['price'];
};

// insert order
$sql = "INSERT INTO `orders`(
    `member_sid`,`total`,`order_date`
    ) VALUES (
        ?, ?, NOW()
    )";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $memLoginID,
    $od_total_price,
]);


// $pdo -> lastInsertId() 拿到剛新增訂單的sid
$last_insert_sid = $pdo -> lastInsertId();

// 解決重新整理重複新增訂單的問題
$last_insert = $pdo->query("SELECT * FROM `orders` WHERE `sid` = $last_insert_sid")->fetch();
if($last_insert['total'] === '0'){
    $pdo ->query("DELETE FROM `orders` WHERE `sid` = $last_insert_sid");
    echo "
    <script>
        alert('感謝您，訂單已經新增成功囉，前往查看訂單記錄吧。');
        window.location.href = 'Nathan-Orders.php';
    </script>
";
}
// insert order_detail
foreach ($cart_sql as $rows => $r) {
    $sql = "INSERT INTO `order_details`(
    `order_sid`,`member_sid`,`produst_sid`,
    `price`,`quantity`
    ) VALUES (
        ?, ?, ?,
        ?, ?
    )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $last_insert_sid,
        $r['member_id'],
        $r['produst_id'],
        $r['price'],
        $r['qty'],
    ]);
}


// 訂單成立 刪除已結帳的商品
echo "
        <script>
            alert('訂購成功');
        </script>
";
$pdo->query("DELETE FROM `cart` WHERE `produst_id` in ($produst_id) AND `member_id` = $memLoginID;");
?>
<?php require __DIR__.'/parts/html-head.php'?>
<?php require __DIR__.'/parts/product-list.php'?>
<style>
    .od-wrap {
        border: 1px solid #ccc;
        border-radius: 10px;
        text-align: center;
    }

    .check-wrap {
        height: 60px;
    }

    .check-wrap>svg {
        transform: scale(3);
    }

    .word-break {
        word-break: break-all;
        padding: 0 10px;
        text-align: start;
    }
    .pointer{
        cursor: pointer;
    }
</style>
<div class="row justify-content-center">
    <div class=" mt-5 w-50 od-wrap">
        <div class=" mt-5 ">
            <label class="form-label check-wrap"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                    <g stroke="#2ca02c" stroke-width="2.3" fill="#fff">
                        <circle cx="10" cy="10" r="8.5" />
                        <path d="M5.2,10 8.5,13.4 14.8,7.2" />
                    </g>
                </svg></label>
            <div class="form-text">已收到您的訂單</div>
        </div>
        <div class="mb-2 fw-bold fs-4">
            <div class="form-text">您的訂單編號為 : <?=$last_insert_sid?></div>
        </div>
        <div class="mb-5">
            <div class="form-text word-break">運送服務：<br>
                我們所提供的產品配送區域範圍目前僅限台灣本島。
                商品之實際配貨日期、退換貨日期，依我們向您另行通知之內容為準。
                將有專人與您約定送貨時間(可約定出貨日30天內日期)。※若為預購商品，以下單日網頁公告之配送日期，於一個工作天內（不含例假日）與您約定送貨時間。</div>
        </div>
        <div>
            <a onclick="ifconfirm('Continue to shopping?','Nathan-CartList.php')" class="pointer btn btn-primary mb-5">繼續購物</a>
            <a href="Nathan-Orders.php" class="pointer btn btn-primary mb-5">查看訂單</a>
        </div>
    </div>
</div>
<?php require __DIR__.'/parts/scripts.php'?>
<?php require __DIR__.'/parts/html-foot.php'?>