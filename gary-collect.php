<?php
require __DIR__ . '/parts/connect_db.php';
$title = 'Gary-Collet';
$pageName = "會員管理";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 1;

$coll_sql = $pdo->query("SELECT `favorite`.mem_id, `produst`.*, `favorite`.`product_img`, `favorite`.product_name, `favorite`.product_price, `favorite`.`product_id` FROM favorite JOIN produst ON `favorite`.product_img=`produst`.img WHERE `favorite`.mem_id= $sid ORDER BY `favorite`.sid DESC, `produst`.sid;")->fetchAll();
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>

<style>
    .title {
        margin-top: 3%;
        font-size: 38px;
    }

    .scrollbar {
        width: 100%;
        height: 775px;
    }

    .scrollbarbox {
        background-color: white;
        border-radius: 10px;
        margin-right: 5px;
        margin-bottom: 5px;
        border: 3px solid black;
    }

    .scrollbarbox:hover {
        opacity: 0.8;
        background-color: pink;
    }

    .scrollbarbox_left {
        width: 35%;
        height: 150px;
    }

    .box_img {
        width: 100%;
        height: 100%;
        overflow: hidden;
        object-fit: contain;
    }

    .scrollbarbox_right {
        width: 65%;
        height: 150px;
    }

    .box-TN {
        color: red;
        font-size: 14px;
        font-weight: 600;
        line-height: 4px;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .box-word {
        font-size: 16px;
        font-weight: 600;
    }

    .dsn {
        display: none;
    }
</style>

<div class="row">
    <div>
        <p class="title text-center">Member <?= $sid ?> Favorites</p>
    </div>
    <div class="scrollbar d-flex justify-content-center">
        <div class="scrollbarIN">
            <?php foreach ($coll_sql as $coll_rows => $coll_r) : ?>
                <div class="scrollbarbox">
                    <a href="kevin-edit.php?sid=<?= $coll_r['product_id'] ?>" class="d-flex text-decoration-none">
                        <div class="scrollbarbox_left">
                            <img src="Fteam-produst_img/<?= $coll_r['img'] ?>" alt="" class="box_img">
                        </div>
                        <div class="scrollbarbox_right d-flex align-items-center">
                            <div>
                                <p class="box-word"><?= $coll_r['name'] ?></p>
                                <div>
                                    <p class="box-word">$<?= $coll_r['price'] ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php' ?>



<?php include __DIR__ . '/parts/html-foot.php' ?>