<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'kevin-produst-list';
$title = 'Product-List';

$perPage = 20; // 每一頁有幾筆

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
// if (isset($_GET['option_price'])) {
//     // 查詢商品的價格 (降冪)

//     $option_price = $_GET["option_price"];

//     if ($option_price  == 1) {
//         $sql = sprintf("SELECT * FROM `produst` ORDER BY `price` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
//         $rows = $pdo->query($sql)->fetchAll();
//     } else if ($option_price  == 2) {
//         $sql = sprintf("SELECT * FROM `produst` ORDER BY `price` ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
//         $rows = $pdo->query($sql)->fetchAll();
//     }
// } else {
//     // 查詢所有商品

//     $sql = sprintf("SELECT * FROM produst ORDER BY sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
//     $rows = $pdo->query($sql)->fetchAll();
// };



// checkbox 多條件篩選
$checkbox = isset($_GET["checkbox"]) ? ($_GET['checkbox']) : [];

if (!empty($checkbox)) {
    $str_tag = implode(',', $checkbox);

    $sql = "SELECT * FROM `produst` WHERE `category_id` IN ($str_tag)";
    $rows = $pdo->query($sql)->fetchAll();
};



$search = isset($_GET["search"]) ? ($_GET['search']) : '';


if (!empty($_GET["search"])) {
    $str_tag = $_GET['search'];
    $sql = "SELECT * FROM `produst` WHERE `name` LIKE '%$str_tag%'";
    $rows = $pdo->query($sql)->fetchAll();
}


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
    .list-section {
        display: none;
    }

    .color_btn {
        width: 100px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .color_btn button {
        width: 100%;
        height: 100%;
        display: inline-block;
        border-radius: 50%;
        border: none;
    }

    .btn_yellow {
        background-color: yellow;
    }

    .btn_blue {
        background-color: blue;
    }
</style>
<div class="container">
    <div class="row d-flex">
        <div class="col-6 d-flex justify-content-around align-items-center">
            <button type="button" class="btn btn-outline-secondary"><a style="text-decoration: none;" href="kevin-produst-add.php">Product Update</a></button>

            <form action="kevin-produst.php" method="get" enctype="multipart/form-data">
                <select class="select jc" aria-label="Default select example" name="option_price" id="option_price" onchange="select()">

                    <option selected>Open this select menu</option>


                    <option value="1" name="option_price">價格從高到低</option>
                    <option value="2" name="option_price">價格從低到高</option>

                </select>



            </form>

            <form class="d-flex" action="kevin-produst-test.php" method="get" enctype="mu">
                <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>


        </div>



        <div class="col color_btn d-flex justify-content-between align-items-center">
            <button value="yellow" class="btn_yellow" onclick="yellow()" id="yellow" name="color"></button>
            <button value="blue" class="btn_blue" onclick="blue()" id="blue" name="color"></button>
        </div>





        <div class="col d-flex justify-content-between align-items-center">
            <div class="form-check d-flex">
                <form action="kevin-produst.php" method="get" enctype="multipart/form-data">
                    <label for="">
                        <input type="checkbox" value="3" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Shortboard</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="4" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Old School</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="6" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Decks</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="7" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Trucks</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="8" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Wheels</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="9" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Bearings</span>
                    </label>

                    <label for="">
                        <input type="checkbox" value="2" style="vertical-align:middle;" name="checkbox[]">
                        <span style="vertical-align:middle;">Spray Paint</span>
                    </label>

                    <button type="submit" class="btn btn-primary" name="ok">Type Submit</button>
                </form>
            </div>

        </div>
    </div>
    <div class="row">
        <button onclick="delete_select()" class=" d-inline-block w-25 btn-sm btn-danger">Delete Select</button>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                    <th scope="col" class="text-center">sid</th>
                    <th scope="col" class="text-center">Product</th>
                    <th scope="col" class="text-center">Brand</th>
                    <th scope="col" class="text-center">Product Name</th>
                    <th scope="col" class="text-center">Info</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Creat Time</th>
                    <th scope="col" class="text-center">Update Time</th>
                    <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td class="">
                            <div class="form-check">
                                <input class="form-check-input singleCheck" type="checkbox" value="<?= $r['sid'] ?>" id="singleSelect" name="c">
                                <a href="kevin-produst-delete-api.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')"><i class="fa-solid fa-trash-can"></i></a>
                            </div>

                        </td>
                        <td><?= $r['sid'] ?></td>
                        <td class="w-25">
                            <img src=./Fteam-produst_img/<?= $r['img'] ?> class="w-100" alt="">
                        </td>
                        <td class="text-center"><?= $r['brand'] ?></td>
                        <td class="text-center"><?= $r['name'] ?></td>
                        <td class="text-center"><?= $r['info'] ?></td>
                        <td class="text-center"><?= $r['price'] ?></td>
                        <td class="text-center"><?= $r['create_at'] ?></td>
                        <td class="text-center"><?= $r['update_at'] ?></td>
                        <td>
                            <a href="kevin-edit.php?sid=<?= $r['sid'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div class="row">
            <div class="col">
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
    // async function priceDesc() {
    //     const fd = new FormData(document.form1);

    //     const r = await fetch('/kevin-produst-api.php', {
    //         method: 'POST',
    //         body: fd,
    //     });
    //     const result = await r.json();

    //     console.log(result);
    // }

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

    function select() {
        let x = document.getElementById('option_price').value;
        location.href = `kevin-produst-test.php?x=${x}`;
    }

    function yellow() {
        let btn = document.getElementById("yellow");
        let yellow = btn.value;
        location.href = `kevin-produst-test.php?yellow=${yellow}`;
    };

    function blue() {
        let btn = document.getElementById("blue");
        let blue = btn.value;
        location.href = `kevin-produst-test.php?blue=${blue}`;
    };
</script>

<?php require __DIR__ . '/parts/html-foot.php' ?>