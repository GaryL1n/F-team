<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'Nathan-orders';
$title = "Nathan Order Details";
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '';


$sql = "SELECT od.*,p.img,p.name FROM `order_details` od JOIN `produst` p ON od.produst_sid = p.sid WHERE `order_sid` = $sid;";
$od_sql = $pdo->query($sql)->fetchAll();
?>
<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>
<style>
    .od-img {
        width: 60px;
    }
</style>
<div class="row mb-4">
    <div class="col-12 mt-4 mb-3">
        <h4 class=" fw-bold">Order Detail</h4>
    </div>
    <table class=" ps-3">
        <thead>
            <tr class=" mb-2">
                <th class="text-center" scope="col">Produst ID</th>
                <th scope="col">Produst Image</th>
                <th scope="col">Produst Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Produst Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $od_total = 0;
                $od_total_qty = 0;
                foreach ($od_sql as $r) : 
                $od_total += $r['price'];
                $od_total_qty += $r['quantity'];
                ?>
                <tr class="mb-2">
                    <td class="text-center" scope="col"><?= $r['produst_sid'] ?></td>
                    <td scope="col"><img class="od-img" src="./Fteam-produst_img/<?= $r['img'] ?>" alt=""></td>
                    <td scope="col"><?= $r['name'] ?></td>
                    <td scope="col"><?= $r['quantity'] ?></td>
                    <td scope="col">$ <?= $r['price'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="text-center fs-5 fw-bolder" scope="col">Total : </td>
                <td scope="col"></td>
                <td scope="col"></td>
                <td class="fs-5 fw-bolder" scope="col"><?= $od_total_qty ?></td>
                <td class="fs-5 fw-bolder" scope="col">$ <?= $od_total ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php require __DIR__ . '/parts/scripts.php' ?>
<?php require __DIR__ . '/parts/html-foot.php' ?>