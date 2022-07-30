<?php require __DIR__ . '/parts/connect_db.php';
$pageName = "Nathan's cart";
$title = "Nathan-CartList - Nathan's cart";

// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: Nathan-CartList.php'); //轉向自己 或 給page=1 給值
    exit;
};
// 每一頁要幾筆
$perpage = 4;

// 取得總比數
$t_sql = "SELECT COUNT(1) FROM `produst`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿出來是索引式陣列用法

// 取得總頁數
$totalPage = ceil($totalRows / $perpage);


$rows = []; // 給預設值 如果沒有資料 跑回圈用到 會出錯
if ($totalPage > 0) { //如果有資料 在執行if內的內容
    if ($page > $totalPage) {
        header("Location: ?page=$totalPage"); // 如果使用著輸入urlencoded > 總頁數,跳轉最後一頁
        exit;
    };
    $sql = sprintf("SELECT * FROM `produst` LIMIT %s,%s", ($page - 1) * $perpage, $perpage);

    $rows = $pdo->query($sql)->fetchAll();
};

?>
<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>


<style>
    .cart-container {
        font-family: 'Anton', sans-serif;
    }
    .cart-card{
        font-size: .8rem;
        border: none;
    }
    .cart-card-info{
        height: 430px;
        border: none;
    }
    .cart-card-img{
        width: 100%;
        height: 229px;
    }
    .btn{
        transition: all 0.2s ease;
        border: none;
        border-radius: 7px;
    }
    .btn:hover{
        background-color: #000;
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(33,33,33,.5); 
    }
    .discount-price{
        color: red;
    }
    .money-tag::before{
        content: "$ ";
        color: black;
    }
    .money-discount-tag::before{
        content: "$ ";
        color: red;
    }
    .qty-width{
        width: 50%;
    }
</style>
<div class="cart-container">
    <!-- 內導覽 -->
    <div class="row" id="cart-info-nav">
        <header class="mt-3">
            <div class=" d-flex align-items-center pb-3 mb-3 border-bottom">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">Street Born Online Shop</span>
                </a>

                <nav class="d-inline-flex mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-light text-decoration-none btn btn-primary btn-sm" href="Nathan-CartList.php">Cart List</a>
                    <a class=" py-2 text-light text-decoration-none btn btn-primary btn-sm" href="Nathan-ViewCart.php">View Cart</a>
                </nav>
            </div>
        </header>
    </div>
    <!-- 內導覽 -->

    <!-- 呈現區 -->
    <div class="row">

        <!-- 商品卡 -->
        <?php foreach ($rows as $r) : ?>
            <div class="col-3 cart-card mb-3">
                <div class="cart-card-info card w-100 justify-content-center">
                    <img  src="Fteam-produst_img/<?= $r['img'] ?>" class="cart-card-img card-img-top text-center w-100" alt="">
                    <div class="card-body">
                        <p class="card-text"><?= htmlentities($r['name']) ?></p>
                        <p class="money-tag card-text mb-1"><?=$r['price']?></p>
                        <p class="money-discount-tag card-text discount-price"><?= $_SESSION['user']['new'] === true ? $r['price']*0.8 : $r['price']; ?></p>
                    </div>
                    <form class="text-center" action="Nathan-AddCart-api.php" method="post">
                        <input type="hidden" name="id" value="<?=$r['sid']?>">
                        <input type="hidden" name="name" value="<?=$r['name']?>">
                        <input type="hidden" name="price" value="<?=$r['price']?>">
                        <div><input class="mb-2  qty-width" type="number" name="qty" class="form-control" value="1"></div>
                        <input onclick="return submitConfirm('加入購物車?')" type="submit" name="addCart" value="Add cart" class="btn btn-dark">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- 商品卡 -->

    </div>
    <!-- 呈現區 -->

    <!-- 頁碼區 -->
    <div class="row mt-5">
        <div class="col">
            <nav class=" d-flex justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>
                    <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                        if ($i >= 1 and $i <= $totalPage) : ?>
                            <li class="page-item <?= $page == $i ? 'active' : ''; ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $page == $totalPage ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>
                    <li class="page-item <?= $page == $totalPage ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $totalPage ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- 頁碼區 -->
</div>


<?php require __DIR__ . '/parts/scripts.php' ?>
<script>
    // input submit confirm 合併使用
    function submitConfirm(text){
        let agree = confirm(text);
        if(agree){
            return true;
        }else{
            return false;
        }
    }
    // if new member discount
    const discountPriceList = document.querySelectorAll('.discount-price');
    for(let i of discountPriceList){
        if(+i.innerText === +i.previousElementSibling.innerText*.8){
            i.previousElementSibling.style.textDecoration = 'line-through';
        }else{
            i.style.display = 'none';
        }
    }
</script>
<?php require __DIR__ . '/parts/html-foot.php' ?>