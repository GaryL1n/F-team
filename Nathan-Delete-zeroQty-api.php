<?php require __DIR__ . '/parts/connect_db.php';
// cart delete 刪除數量被改為0的商品
$proId = isset($_GET['proId']) ? intval($_GET['proId']) : 0;
$pdo->query("DELETE FROM cart WHERE `produst_id` = $proId");
echo "<script>
    window.location.href = 'Nathan-ViewCart.php';
    </script>";
