<?php require __DIR__ . '/parts/connect_db.php';
// unset($_SESSION['user']);

$sql = "SELECT  * FROM `member` WHERE 1;";
$mem_sql = $pdo->query($sql)->fetchAll();
if (isset($_SESSION['user'])) {
    foreach ($mem_sql as $rows => $r) {
        if ($r['mem-account'] === $_SESSION['user']['mem_account']) {
            // 取得登入中的會員資料
            $memLogin = $r;
        }
    }
    $memLogin_sid = $memLogin['sid'];

    // 取得此會員的所有購物車紀錄
    $sql = "SELECT * FROM `cart` WHERE `member_id` = $memLogin_sid";
    $cart_sql = $pdo->query($sql)->fetchAll();
    // 取得 post

    $product_id = $_POST['id'];
    $product_name = $_POST['name'];
    if ($_SESSION['user']['new'] === true) {
        $product_price = $_POST['price'] * 0.8;
    } else {
        $product_price = $_POST['price'];
    }
    $product_qty = $_POST['qty'];

    // add cart
    $come_from = 'Nathan-CartList.php';
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $come_from = $_SERVER['HTTP_REFERER'];
    }
    $empty_ar = [];
    if (isset($_POST['addCart'])) {
        foreach ($cart_sql as $key => $val) {
            // 取得該會員所有商品的商品編號
            array_push($empty_ar, $val['produst_id']);
        }
        // 跟 add post 商品編號比對
        if (in_array($product_id, $empty_ar)) {
            echo "<script>alert('此商品已加入購物車');
            window.location.href = '$come_from';
            </script>";
        } else {
            $sql = "INSERT INTO `cart`(
        `produst_id`,`name`,`qty`,
        `price`,`member_id`
        ) VALUES (
            ?, ?, ?,
            ?, ?
        )";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $product_id,
                $product_name,
                $product_qty,
                $product_price,
                $memLogin_sid,
            ]);
            echo "<script>alert('加入成功');
            window.location.href = '$come_from';
            </script>";
        }
    };
    // cart delete 刪除數量被改為0的商品
    $proId = isset($_GET['proId']) ? intval($_GET['proId']) : 0;
    $pdo->query("DELETE FROM cart WHERE `produst_id` = $proId");

    // cart edit 
    if (isset($_POST['update'])) {
        $edit_id = $_POST['cart_id'];
        $edit_qty = $_POST['cart_qty'];
        $cart_edit_sql = "UPDATE `cart` SET `qty` = $edit_qty WHERE `cart`.`produst_id` = $edit_id";
        $pdo->query($cart_edit_sql);
        header('Location: Nathan-ViewCart.php');
    };
} else {
    echo "<script>alert('請登入會員');
    window.location.href = 'gary-member-login.php';
    </script>";
}
