<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'kevin-produst-list';
$title = 'Product-List';

$perPage = 15; // 每一頁有幾筆

// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // intval -> 轉換成整數值
if ($page < 1) {
    header('Location: ?page=1'); // 轉向到第一頁
    exit;
}

// 總筆數
$t_sql = "SELECT COUNT(1) FROM produst";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
// 總頁數
$totalPages = ceil($totalRows / $perPage);
$rows = []; // 設定一個預設值就是空陣列，如果有資料才會執行下面的if。 修復給分頁數會超過總頁數

if ($totalRows > 0) {
    // 頁碼若超過總頁數
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages"); // 如果超過總頁數，直接轉向到總頁數
        exit;
    }

    $sql = sprintf("SELECT * FROM produst ORDER BY `sid` ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

$hobbies = [
    '1' => '價格從高到低',
    '2' => '價格從低到高',
];

// 商品價格從高到低 and 從低到高
$x = isset($_GET['x']) ? intval($_GET['x']) : 0;

if ($x === 1) {
    $sql = sprintf("SELECT * FROM `produst` ORDER BY `price` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
} else if ($x === 2) {
    $sql = sprintf("SELECT * FROM `produst` ORDER BY `price` ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
} else {
    $sql = sprintf("SELECT * FROM produst ORDER BY sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
};

// checkbox 多條件篩選
$checkbox = isset($_GET["checkbox"]) ? ($_GET['checkbox']) : [];

if (!empty($checkbox)) {
    $str_tag = implode(',', $checkbox);

    $sql = "SELECT * FROM `produst` WHERE `category_id` IN ($str_tag)";
    $rows = $pdo->query($sql)->fetchAll();
};

// 關鍵字搜尋
$search = isset($_GET["search"]) ? ($_GET['search']) : '';


if (!empty($_GET["search"])) {
    $str_tag = $_GET['search'];
    $sql = "SELECT * FROM `produst` WHERE `info` LIKE '%$str_tag%'";
    $rows = $pdo->query($sql)->fetchAll();
}

// 顏色篩選
$yellow = isset($_GET["yellow"]) ? ($_GET['yellow']) : '';
if (!empty($_GET["yellow"])) {
    $yellow = $_GET['yellow'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$yellow%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$blue = isset($_GET["blue"]) ? ($_GET['blue']) : '';
if (!empty($_GET["blue"])) {
    $blue = $_GET['blue'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$blue%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$red = isset($_GET["red"]) ? ($_GET['red']) : '';
if (!empty($_GET["red"])) {
    $red = $_GET['red'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$red%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$pink = isset($_GET["pink"]) ? ($_GET['pink']) : '';
if (!empty($_GET["pink"])) {
    $blue = $_GET['pink'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$pink%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$green = isset($_GET["green"]) ? ($_GET['green']) : '';
if (!empty($_GET["green"])) {
    $blue = $_GET['green'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$green%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$black = isset($_GET["black"]) ? ($_GET['black']) : '';
if (!empty($_GET["black"])) {
    $black = $_GET['black'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$black%'";
    $rows = $pdo->query($sql)->fetchAll();
}

$white = isset($_GET["white"]) ? ($_GET['white']) : '';
if (!empty($_GET["white"])) {
    $white = $_GET['white'];

    $sql = "SELECT * FROM `produst` WHERE `color` LIKE '%$white%'";
    $rows = $pdo->query($sql)->fetchAll();
}


?>

<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>
<style>
    option {
        padding: 8px;
    }

    label {
        margin: 8px;
    }

    .lable-box {

        display: flex;
        justify-content: center;
        align-items: center;
    }

    input {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* 隱藏側邊攔 */
    .kevin_product {
        display: none;
    }

    .color_btn {
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        border: none;
    }

    .color_btn button {
        width: 100%;
        height: 100%;
        display: inline-block;
        border-radius: 50%;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .4);
    }

    .btn_yellow {
        background-color: #FAD689;
    }

    .btn_yellow:hover {
        background-color: #FAD689;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(255, 214, 137);
        -moz-box-shadow: 10px 10px 60px 6px rgba(255, 214, 137);
        box-shadow: 10px 10px 60px 6px rgba(255, 214, 137);
    }

    .btn_blue {
        background-color: #58B2DC;
    }

    .btn_blue:hover {
        background-color: #58B2DC;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(88, 178, 220);
        -moz-box-shadow: 10px 10px 60px 6px rgba(88, 178, 220);
        box-shadow: 10px 10px 60px 6px rgba(88, 178, 220);
    }

    .btn_red {
        background-color: #CB4042;
    }

    .btn_red:hover {
        background-color: #CB4042;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(203, 64, 66);
        -moz-box-shadow: 10px 10px 60px 6px rgba(203, 64, 66);
        box-shadow: 10px 10px 60px 6px rgba(203, 64, 66);
    }

    .btn_pink {
        background-color: #F596AA;
    }

    .btn_pink:hover {
        background-color: #F596AA;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(245, 150, 170);
        -moz-box-shadow: 10px 10px 60px 6px rgba(245, 150, 170);
        box-shadow: 10px 10px 60px 6px rgba(245, 150, 170);
    }

    .btn_green {
        background-color: #B1B479;
    }

    .btn_green:hover {
        background-color: #B1B479;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(177, 180, 121);
        -moz-box-shadow: 10px 10px 60px 6px rgba(177, 180, 121);
        box-shadow: 10px 10px 60px 6px rgba(177, 180, 121);
    }

    .btn_black {
        background-color: #1C1C1C;
    }

    .btn_black:hover {
        background-color: #1C1C1C;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(28, 28, 28);
        -moz-box-shadow: 10px 10px 60px 6px rgba(28, 28, 28);
        box-shadow: 10px 10px 60px 6px rgba(28, 28, 28);
    }

    .btn_white {
        background-color: whitesmoke;
    }

    .btn_white:hover {
        background-color: whitesmoke;
        -webkit-box-shadow: 10px 10px 60px 6px rgba(255, 255, 251);
        -moz-box-shadow: 10px 10px 60px 6px rgba(255, 255, 251);
        box-shadow: 10px 10px 60px 6px rgba(255, 255, 251);
    }


    .fliter_select {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 5vh;
        margin-bottom: 30px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_select_1 {
        text-align: center;
    }

    .fliter_search {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 5vh;
        margin-bottom: 30px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_search_h2 {
        display: flex;
        text-align: left;
        width: 100%;
        margin-bottom: 10px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_search_h2 h2 {
        font-size: 20px;
        font-weight: 700;
    }

    .fliter_search_1 {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .fliter_search_input {
        height: 3vh;
    }

    .fliter_search_btn {
        vertical-align: auto;
        height: 3vh;
        border: none;
    }

    .fliter_color {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-bottom: 30px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_color_h2 {
        display: flex;
        text-align: left;
        width: 100%;
        margin-bottom: 10px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_color_h2 h2 {
        font-size: 20px;
        font-weight: 700;
    }

    .fliter_color_button {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }

    .fliter_color_button button {
        margin: 15px;
    }

    .fliter_color_button span {
        text-align: center;
        display: flex;
        justify-content: center;
        font-size: small;
        font-weight: 600;
        position: relative;
        bottom: 10px
    }


    .fliter_checkbox {
        /* display: flex; */
        flex-direction: column;
        /* justify-content: center;
        align-items: center; */
        width: 100%;
        /* height: 20vh; */
        margin-bottom: 30px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_checkbox button {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .fliter_checkbox_h2 {
        display: flex;
        text-align: left;
        width: 100%;
        margin-bottom: 10px;
        border-bottom: 1px solid lightgray;
    }

    .fliter_checkbox_h2 h2 {
        font-size: 20px;
        font-weight: 700;
    }

    .btn_menu {
        width: 100%;
        border: 2px soild black;
        display: flex;
        justify-content: space-between;
    }

    .btn_menu button {
        border: 1px solid black;
        background-color: white;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .mycard .img-wrap {
        width: 100%;
        height: 260px;
    }

    .btn_best {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        padding: 9px 12px;
        border: 1px solid #aba7a5;
        border-radius: 10px;
        background: #f4efeb;
        background: -webkit-gradient(linear, left top, left bottom, from(#f4efeb), to(#aba7a5));
        background: -moz-linear-gradient(top, #f4efeb, #aba7a5);
        background: linear-gradient(to bottom, #f4efeb, #aba7a5);
        -webkit-box-shadow: #ffffff 0px 0px 0px 0px;
        -moz-box-shadow: #ffffff 0px 0px 0px 0px;
        box-shadow: #ffffff 0px 0px 0px 0px;
        text-shadow: #ffffff 1px 1px 1px;
        font: normal normal bold 12px arial;
        color: #111111;
        text-decoration: none;
        text-transform: uppercase
    }

    .btn_best:hover {
        border: 1px solid #f4efeb;
        background: #ffffff;
        background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#cdc8c6));
        background: -moz-linear-gradient(top, #ffffff, #cdc8c6);
        background: linear-gradient(to bottom, #ffffff, #cdc8c6);
        color: #111111;
        text-decoration: none;
        text-transform: uppercase
    }

    .btn_best:active {
        background: #aba7a5;
        background: -webkit-gradient(linear, left top, left bottom, from(#aba7a5), to(#aba7a5));
        background: -moz-linear-gradient(top, #aba7a5, #aba7a5);
        background: linear-gradient(to bottom, #aba7a5, #aba7a5);
        text-transform: uppercase
    }

    .btn_best:focus {
        text-transform: uppercase
    }

    .btn_best::before {
        content: "\0000a0";
        display: inline-block;
        height: 24px;
        width: 24px;
        line-height: 24px;
        margin: 0 4px -6px -4px;
        position: relative;
        top: 0px;
        left: 0px;
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABUklEQVRIid3VP0oDQRgF8J8hhScQCcHKEwQsFGuLYGEndiktvIG1d7A0ldiJRU5gDCEEL5AypPAEFhIsZsQN7kxW10YfLDs7833vfTt/3vDXsVEhpoUT7MU2LDDBA+Y/FW+jjyEu0MFWfDqxbxhjdr5LfoRnHKORiWvEmGnMqUw+xPY3CtrGqIpIO1aTIj9HLyMyjRxJ9IVfTiEnIOb2ix3F+W1hF4NcBWswiBwfu21F4AS3WNYQWOIucn0R2MNTDfIPPEYu0CwMtKweml5J8j7eEsQ38T1XmKJmaWjAZklfMzNWiqLAQthiL/H7OpHz6rPaMrQjF1bXYIKDqpVlcIhxmcA9zuStYR0aOBVM8IvAAjN0awh0I8ciFVDXKp6tsQqCYY0yIinySmZXFJn6BbvO3WhtXAneciec0Hlh7FBY0BkuJW62OlfmWNgtyQX9H3gHYhk+PTN5BEoAAAAASUVORK5CYII=") no-repeat left center transparent;
        background-size: 100% 100%;
    }


    .btn_best_del {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        padding: 9px 12px;
        border: 1px solid #aba7a5;
        border-radius: 10px;
        background: #f4efeb;
        background: -webkit-gradient(linear, left top, left bottom, from(#f4efeb), to(#aba7a5));
        background: -moz-linear-gradient(top, #f4efeb, #aba7a5);
        background: linear-gradient(to bottom, #f4efeb, #aba7a5);
        -webkit-box-shadow: #ffffff 0px 0px 0px 0px;
        -moz-box-shadow: #ffffff 0px 0px 0px 0px;
        box-shadow: #ffffff 0px 0px 0px 0px;
        text-shadow: #ffffff 1px 1px 1px;
        font: normal normal bold 12px arial;
        color: #111111;
        text-decoration: none;
        text-transform: uppercase
    }

    .btn_best_del:hover {
        border: 1px solid #f4efeb;
        background: #ffffff;
        background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#cdc8c6));
        background: -moz-linear-gradient(top, #ffffff, #cdc8c6);
        background: linear-gradient(to bottom, #ffffff, #cdc8c6);
        color: #111111;
        text-decoration: none;
        text-transform: uppercase
    }

    .btn_best_del:active {
        background: #aba7a5;
        background: -webkit-gradient(linear, left top, left bottom, from(#aba7a5), to(#aba7a5));
        background: -moz-linear-gradient(top, #aba7a5, #aba7a5);
        background: linear-gradient(to bottom, #aba7a5, #aba7a5);
        text-transform: uppercase
    }

    .btn_best_del:focus {
        text-transform: uppercase
    }

    .btn_best_del::before {
        content: "\0000a0";
        display: inline-block;
        height: 24px;
        width: 24px;
        line-height: 24px;
        margin: 0 4px -6px -4px;
        position: relative;
        top: 0px;
        left: 0px;
        background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAg0lEQVRIie2VsQqAIBRFTyEO9RFtfU//v4RT/UANEdgiIqbFa2l5Bx6KPu/RSVA+0iU1AjPgs3JhL+290VTCXXLAALZykQM4w3wHhjBGzMsL3rAPcqD8glQiYS8tPgk2oaCXCrxQUMxqhSFiVKACFfwsWAU5kt7IBCzcP5q8ltCrfOMCYqkauSTV5I0AAAAASUVORK5CYII=") no-repeat left center transparent;
        background-size: 100% 100%;
    }
</style>


<div class="container">
    <div class="list-section">

        <div class="col w-75">
            <form action="kevin-produst.php" method="get" enctype="multipart/form-data">
                <div class="fliter_select">
                    <select class="select w-100 fliter_select_1" aria-label="Default select example" name="option_price" id="option_price" onchange="select()">
                        <option class="" selected>--Filter menu--</option>
                        <option value="1" name="option_price">Price:High-Low</option>
                        <option value="2" name="option_price">Price:Low-High</option>
                    </select>
                </div>
            </form>

        </div>

        <div class="col w-75 ">
            <div class="fliter_search_h2">
                <h2>Search</h2>
            </div>
            <div class="fliter_search">
                <form class="d-flex" action="kevin-produst.php" method="get" enctype="mu">
                    <div class="fliter_search_1 d-flex w-100">
                        <input class="w-100 fliter_search_input" type="text" placeholder="Search" aria-label="Search" name="search">
                        <button class="fliter_search_btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>


        <div class="col w-75 fliter_color">
            <div class="fliter_color_h2">
                <h2>Color</h2>
            </div>

            <div class="fliter_color_button">
                <div class="fliter_color_span">
                    <button value="yellow" class="btn_yellow color_btn" onclick="yellow()" id="yellow" name="color"></button>
                    <span>Yellow</span>
                </div>

                <div class="fliter_color_span">
                    <button value="blue" class="btn_blue color_btn" onclick="blue()" id="blue" name="color"></button>
                    <span>Blue</span>
                </div>

                <div class="fliter_color_span">
                    <button value="red" class="btn_red color_btn" onclick="red()" id="red" name="color"></button>
                    <span>Red</span>
                </div>

                <div class="fliter_color_span">
                    <button value="pink" class="btn_pink color_btn" onclick="pink()" id="pink" name="color"></button>
                    <span>Pink</span>
                </div>

                <div class="fliter_color_span">
                    <button value="green" class="btn_green color_btn" onclick="green()" id="green" name="color"></button>
                    <span>Green</span>
                </div>

                <div class="fliter_color_span">
                    <button value="black" class="btn_black color_btn" onclick="black()" id="black" name="color"></button>
                    <span>Black</span>
                </div>

                <div class="fliter_color_span">
                    <button value="white" class="btn_white color_btn" onclick="white()" id="white" name="color"></button>
                    <span>White</span>
                </div>
            </div>
        </div>



        <div class="col w-75">
            <div class="fliter_checkbox">
                <div class="fliter_checkbox_h2">
                    <h2>Category</h2>
                </div>
                <form action="kevin-produst.php" method="get" enctype="multipart/form-data">
                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="3" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Shortboard</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="4" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Old School</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="6" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Decks</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="7" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Trucks</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="8" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Wheels</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="9" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Bearings</span>
                        </label>
                    </div>

                    <div class="fliter_checkbox_btn">
                        <label for="">
                            <input type="checkbox" value="2" style="vertical-align:middle;" name="checkbox[]">
                            <span style="vertical-align:middle;">Spray Paint</span>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary" name="ok">Type Submit</button>
                </form>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="btn_menu mb-4">
            <button class="btn_best_del" onclick="delete_select()">Delete Select</button>
            <button class="btn_best" type="button"><a style="text-decoration: none;" href="kevin-produst-add.php">Product Update</a></button>
        </div>

        <div class="row">
            <?php foreach ($rows as $r) : ?>


                <div class="col-4 mycard mb-5 d-flex flex-column">

                    <div class="card_sid d-flex">
                        <input class="form-check-input singleCheck me-1" type="checkbox" value="<?= $r['sid'] ?>" id="singleSelect" name="c">
                        <a href="kevin-produst-delete-api.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')"><i class="fa-solid fa-trash-can"></i></a>
                        <h5 class="ms-2"><?= $r['sid'] ?></h5>
                    </div>

                    <div class="img-wrap">
                        <img src="./Fteam-produst_img/<?= $r['img'] ?>" class="w-100 h-100" alt="">
                    </div>

                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title"><?= $r['name'] ?></h5>
                        <p class="flex-grow-1"><?= $r['info'] ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5>Brand: </h5><?= $r['brand'] ?>
                        </li>
                        <li class="list-group-item">
                            <h5>Price: </h5><?= $r['price'] ?>
                        </li>
                        <li class="list-group-item">
                            <h5>Creat Time: </h5><?= $r['create_at'] ?>
                        </li>
                        <li class="list-group-item">
                            <h5>Update Time: </h5><?= $r['update_at'] ?>
                        </li>
                    </ul>
                    <div class="card-body border-bottom d-flex w-100 justify-content-between">
                        <a style="cursor: poninter;" href="kevin-edit.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a style="cursor: poninter;" onclick="favSend(<?= $r['sid'] ?>)"><i class="fa-solid fa-heart"></i></a>
                    </div>
                </div>


            <?php endforeach; ?>

        </div>

        <div class="row d-flex w-100">
            <div class="col d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </li>
                        <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                            if ($i >= 1 and $i <= $totalPages) :
                        ?>
                                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                        <?php endif;
                        endfor; ?>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $totalPages ?>">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/parts/scripts.php' ?>

<script>
    // 多選垃圾桶刪除
    const singleSelect = document.querySelectorAll('#singleSelect');

    async function delete_select() {
        const select_ar = [];
        for (let i of singleSelect) {
            if (i.checked) {
                select_ar.push(Number(i.value));
            }
        }
        // console.log(select_ar);
        if (confirm(`確定要刪除編號為${select_ar}的資料嗎`)) {
            location.href = `kevin-produst-delete-api.php?sid=${select_ar}`;
        }
    }

    let x;
    // 下拉式選單
    function select() {
        let x = document.getElementById('option_price').value;
        location.href = `kevin-produst.php?x=${x}`;
    }

    // 顏色篩選
    function yellow() {
        let btn = document.getElementById("yellow");
        let yellow = btn.value;
        location.href = `kevin-produst.php?yellow=${yellow}`;
    };

    function blue() {
        let btn = document.getElementById("blue");
        let blue = btn.value;
        location.href = `kevin-produst.php?blue=${blue}`;
    };

    function red() {
        let btn = document.getElementById("red");
        let red = btn.value;
        location.href = `kevin-produst.php?red=${red}`;
    };

    function pink() {
        let btn = document.getElementById("pink");
        let pink = btn.value;
        location.href = `kevin-produst.php?pink=${pink}`;
    };

    function green() {
        let btn = document.getElementById("green");
        let green = btn.value;
        location.href = `kevin-produst.php?green=${green}`;
    };

    function black() {
        let btn = document.getElementById("black");
        let black = btn.value;
        location.href = `kevin-produst.php?blue=${black}`;
    };

    function white() {
        let btn = document.getElementById("white");
        let white = btn.value;
        location.href = `kevin-produst.php?white=${white}`;
    };

    // 收藏商品
    const favSend = (sid) => {
        location.href = `kevin-favorite-api.php?produstSid=${sid}`;
    }
</script>

<?php require __DIR__ . '/parts/html-foot.php' ?>