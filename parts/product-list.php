<?php

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['grade'] === 'low') {
        $mem_sql = $pdo->query("SELECT  * FROM `member` WHERE 1;")->fetchAll();
        foreach ($mem_sql as $member_rows => $member_r) {
            if ($member_r['mem-account'] === $_SESSION['user']['mem_account']) {
                // 取得登入中的會員id
                $memLoginID = $member_r['sid'];
                $cart_sql = $pdo->query("SELECT * FROM `cart` WHERE `member_id` = $memLoginID")->fetchAll();
                $count_sql = $pdo->query("SELECT COUNT(1) FROM `cart` WHERE `member_id` = $memLoginID")->fetchAll();
                $cartCount = $count_sql[0]['COUNT(1)'];

                // 右上角稱呼的顯示跟其他資訊
                $memName = $member_r['mem-name'];
                $memNick = $member_r['mem-nickname'];
                $memAvatar = $member_r['mem-avatar'];
                $memLevel = $member_r['mem-level'];
                $memCreated = $member_r['mem-created_at'];
                $memEmail = $member_r['mem-email'];
                $iconName = $memNick;
                if ($memNick == '') {
                    $iconName = $memName;
                }
            }
        }
    }
    if ($_SESSION['user']['grade'] === 'high') {
        $ad_sql = $pdo->query("SELECT  * FROM `admin` WHERE 1;")->fetchAll();
        foreach ($ad_sql as $ad_rows => $ad_r) {
            if ($ad_r['ad-account'] === $_SESSION['user']['mem_account']) {
                // 取得登入中的會員id
                $memLoginID = $ad_r['sid'];

                // 右上角稱呼的顯示跟其他資訊
                $memName = $ad_r['ad-name'];
                $memAvatar = $ad_r['ad-avatar'];

                $iconName = $memName;
            }
        }
    }
}
?>
<style>
    .cart-icon {
        position: relative;
    }

    .cart-count {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 15px;
        height: 15px;
        font-size: 5px;
        color: white;
        background-color: red;
        border-radius: 50%;
        text-align: center;
        line-height: 15px;
        opacity: 0.9;
    }

    .memName {
        color: white;
    }

    .memName:hover {
        color: white;
    }

    .AvatarImg {
        border-radius: 50%;
        width: 30px !important;
        height: 30px;
    }

    .newDis {
        height: 60px;
        background-color: WHITE;
        color: red;
        font-size: 20px;
        font-weight: 600;
        opacity: 0.8;
    }

    .newDis span {
        margin-right: 20px;
    }

    .spanBig {
        font-size: 30px;
    }

    .dsn {
        display: none;
    }
    .product-icon>i{
        color: white;
    }
</style>

<body>
    <header class="header-color">
        <div class="container container-maxWidth">
            <div class="row nav-info">
                <div class="col-4 nav-left d-flex">
                    <div class="logo-container">
                        <a href=""><img src="./images/Street_logo.png" alt=""></a>
                    </div>

                    <!-- NAVBAR 連結 BY KEVIN -->
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="der-NewsList.php" style="color: white;">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $_SESSION['user']['grade'] === 'high' ? '' : 'dsn'; ?>" href="gary-mem-list-true.php" style="color:white ;">Admin</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>


                </div>
                <div class="col-8 nav-right">
                    <a href="<?= isset($_SESSION['user']) ? 'gary-Member.php' : 'gary-member-login.php'; ?>" class="memName text-decoration-none">
                        <!-- 有登入就把訪客icon隱藏 -->
                        <?= isset($_SESSION['user']) ? '' : '<i class="fa-solid fa-user"></i>'; ?>
                        <!-- 有登入就顯示個人照片 -->
                        <!-- 沒登入就把img欄位隱藏 -->
                        <img src="<?= isset($_SESSION['user']) ? "gary-uploaded/$memAvatar" : ''; ?>" class="AvatarImg <?= isset($_SESSION['user']) ? '' : 'dsn'; ?>">
                        <!-- 顯示的名稱 -->
                        <?= isset($iconName) ? $iconName : 'Visitor'; ?>
                    </a>

                    <!-- LOGIN/LOGOUT -->
                    <a href=" <?= isset($_SESSION['user']) ? 'gary-logout.php' : 'gary-member-login.php'; ?> " class="memName text-decoration-none"><?= isset($_SESSION['user']) ? 'Logout' : 'Login'; ?></a>
                    
                    <a class="product-icon" href="kevin-produst.php"><i class="fa-solid fa-box-archive"></i></a>

                    <a class="cart-icon <?= $_SESSION['user']['grade'] === 'high' ? 'dsn' : ''; ?>" style="cursor: pointer;" onclick="ifconfirm('Go cart?','Nathan-ViewCart.php')"><i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count"><?= isset($cartCount) ? $cartCount : '0'; ?></span>
                    </a>

                </div>
            </div>
        </div>
    </header>
    <div class="<?= $_SESSION['user']['new'] === true ? '' : 'dsn'; ?>">
        <div class="newDis d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center">
                <span class="spanBig">20%</span>
                <span class="spanSmall">off for New members</span>
                <span class="spanSmall">The promotion will be ended in</span>
                <sapn class="timeWord spanBig"></sapn>
                <input type="hidden" value="<?= $memCreated ?>" id="memCreat"></input>
            </div>
        </div>
    </div>

    <div class="list-section <?= $pageName === 'kevin-produst-list' ? 'd-none' : '' ?>">
        <div class="list-group">
            <a href="der-NewsList.php" class="list-a list-group-item list-group-item-action <?= $pageName === "der-NewsList" ? 'active' : ''; ?>">最新消息</a>
            <a href="gary-mem-list-true.php" class="list-a list-group-item list-group-item-action <?= $pageName === "會員管理" ? 'active' : ''; ?>">會員管理</a>
            <a href="kevin-produst.php" class="list-a list-group-item list-group-item-action">商品列表</a>
            <a href="cooler-list.php" class="list-a list-group-item list-group-item-action <?= $pageName === "課程資訊" ? 'active' : ''; ?>">課程資訊</a>
            <a href="Nathan-CartList.php" class="list-a list-group-item list-group-item-action <?= $pageName === "Nathan's cart" ? 'active' : ''; ?>">購物車</a>
            <a href="Nathan-Orders.php" class="list-a list-group-item list-group-item-action <?= $pageName === 'Nathan-orders' ? 'active' : ''; ?>">訂單資訊</a>

        </div>
    </div>
    <script>
        // confirm 專用 function
        const ifconfirm = (text, href) => {
            if (confirm(text)) {
                window.location.href = href;
            }
        }

        const Avatar = document.querySelector('.AvatarImg');
        const icon = document.querySelector('#ICON');


        const doRun = () => {
            // 取得會員創建時間(PHP格式)
            const memCreat = document.getElementById('memCreat').value;
            // 轉成JS時間格式
            const memTime = new Date(memCreat);
            // 現在時間
            const nowTime = new Date();
            //讓創建日期+1天
            Date.prototype.addDays = function(days) {
                this.setDate(this.getDate() + days);
                return this;
            }
            const newDis = memTime.addDays(1);

            //計算剩下多久優惠時間
            const only = newDis - nowTime;
            const SEC_PER_DAY = 24 * 60 * 60000;
            //padStart(2, '0') 字串方法 不足二位數補0
            const hours = (parseInt((only % SEC_PER_DAY) / 3600000) + '').padStart(2, '0');
            const min = (parseInt((only % 3600000) / 60000) + '').padStart(2, '0');;
            const sec = (parseInt((only % 60000) / 1000) + '').padStart(2, '0');
            const time = document.querySelector('.timeWord');
            time.innerText = `${hours}:${min}:${sec}`;
            setTimeout(doRun, 1000);
        };

        doRun();
    </script>