<?php
require __DIR__ . '/parts/connect_db.php';

$pageName = "會員資訊";
$title = "Gary-Member";

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['grade'] === 'low') {
        $mem_sql = $pdo->query("SELECT  * FROM `member` WHERE 1;")->fetchAll();
        foreach ($mem_sql as $member_rows => $member_r) {
            if ($member_r['mem-account'] === $_SESSION['user']['mem_account']) {
                // 取得登入中的會員id
                $memLoginID = $member_r['sid'];

                $coll_sql = $pdo->query("SELECT `favorite`.mem_id, `produst`.*, `favorite`.`product_img`, `favorite`.product_name, `favorite`.product_price, `favorite`.`product_id` FROM favorite JOIN produst ON `favorite`.product_img=`produst`.img WHERE `favorite`.mem_id= $memLoginID ORDER BY `favorite`.sid DESC, `produst`.sid;")->fetchAll();
            }
        }
    }
}
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>
<?php include __DIR__ . '/gary-MemList.php' ?>

<style>
    .memberNews {
        border: 1px solid gray;
    }

    .memberNews-box {
        margin-left: 200px;
    }

    .memberNews-word {
        margin-left: 150px;
    }

    .memberNews-fw {
        font-weight: 600;
        font-size: 18px;
    }

    .photo {
        width: 400px;
        margin-top: 23px;
        position: relative;
        transition: 1s;
        transform-style: preserve-3d;
        transform-origin: center;
        animation: card 6s linear infinite;
    }

    .photo:hover {
        animation-play-state: paused;
    }

    @keyframes card {
        from {
            transform: rotateY(0deg);
        }

        to {
            transform: rotateY(360deg);
        }
    }

    .cardRotate {
        transform: rotateY(180deg);
    }

    .front {
        /* 背面朝向用戶時不可見 */
        width: 400px;
        height: 250px;
        position: absolute;
        top: 0px;
        left: 0px;
        border-radius: 15px;
        cursor: pointer;
        backface-visibility: hidden;
    }

    .back {
        /* 背面朝向用戶時不可見 */
        width: 400px;
        height: 250px;
        position: absolute;
        top: 0px;
        left: 0px;
        transform: rotateY(-180deg);
        border-radius: 15px;
        cursor: pointer;
        backface-visibility: hidden;
    }

    .WordColor {
        color: white;
    }

    .Bigcard {
        position: relative;
    }

    .CardBGC {
        width: 400px;
        height: 250px;
        background-color: gray;
        opacity: 0.5;
        position: absolute;
        border-radius: 25px;
    }

    .cardBOX {
        position: absolute;
        width: 400px;
    }

    .img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
    }

    .EditIcon {
        width: 100px;
        height: 100px;
    }

    .scro-left {
        width: 97%;
        height: 200px;
        overflow: auto;
    }

    .scro-left::-webkit-scrollbar {
        width: 1em;
    }

    .scro-left::-webkit-scrollbar-thumb {
        background-color: black;
        border: 1px solid slategrey;
    }

    .Leftscrollbarbox {
        margin-right: 20px;
        width: 150px;
    }

    .Leftscrollbarbox:hover {
        opacity: 0.8;
    }

    .boxLeft-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .Leftscrollbarbox img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
    }

    .Leftscrollbarbox img:hover {
        border: 3px solid gray;
    }

    .Leftscrollbarbox p {
        width: 100%;
        margin-top: 5px;
        font-size: 20px;
        text-align: center;
        color: white;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }
</style>

<?php if ($_SESSION['user']['grade'] === 'low') : ?>
    <div class="row d-flex justify-content-around">
        <div class="col-6 memberNews">
            <h3 class="mt-3 mb-4 text-center">會員資訊</h3>
            <div class="memberNews-box">
                <div class="d-flex mb-3">
                    <p class="memberNews-fw">會員姓名</p>
                    <p class="memberNews-word"><?= $memName ?></p>
                </div>
                <div class="d-flex mb-3">
                    <p class="memberNews-fw">會員等級</p>
                    <p class="memberNews-word memberNews-fw"><?= $memLevel ?></p>
                </div>
                <div class="d-flex mb-3">
                    <p class="memberNews-fw">Email</p>
                    <p class="memberNews-word"><?= $memEmail ?></p>
                </div>
                <div class="d-flex mb-3">
                    <p class="memberNews-fw">加入時間</p>
                    <p class="memberNews-word"><?= $memCreated ?></p>
                </div>
            </div>
        </div>
        <div class="col-5 memberNews d-flex justify-content-center mt-3">
            <div class="photo" <?= $_SESSION['user']['grade'] === 'high' ? '' : 'onclick="Click()"' ?>>
                <div class="front">
                    <div class="Bigcard">
                        <div class="CardBGC"></div>
                        <div class="cardBOX">
                            <h5 class="d-flex justify-content-center mb-5 mt-5 WordColor"><?= $_SESSION['user']['grade'] === 'high' ? 'ADMIN CARD' : 'MEMBERSHIP CARD' ?></h5>
                            <div class="d-flex justify-content-around">
                                <div class="WordColor">
                                    <p><?= $iconName ?></p>
                                    <p><?= $memLoginID ?></p>
                                </div>
                                <div>
                                    <img src="<?= "gary-uploaded/$memAvatar" ?>" alt="" class="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="back">
                    <div class="Bigcard">
                        <div class="CardBGC"></div>
                        <div class="cardBOX">
                            <div class="d-flex justify-content-around mb-5 mt-5 WordColor">
                                <h5>MEMBER INFO</h5>
                                <h5><?= $memLevel ?></h5>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="WordColor">
                                    <p>Join Time</p>
                                    <p><?= $memCreated ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 d-flex justify-content-center">
        <div class="scrollbar scro-left">
            <div class="d-flex">
                <?php foreach ($coll_sql as $coll_rows => $coll_r) : ?>
                    <div class="Leftscrollbarbox">
                        <a href="kevin-edit.php?sid=<?= $coll_r['product_id'] ?>" class="text-decoration-none">
                            <div class="boxLeft-img">
                                <img src="Fteam-produst_img/<?= $coll_r['img'] ?>" alt="">
                            </div>
                            <div>
                                <p><?= $coll_r['name'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>