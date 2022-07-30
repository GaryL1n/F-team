<?php require __DIR__ . '/parts/connect_db.php';
if (!isset($_SESSION['user'])) {
    echo "<script>alert('請登入會員');
    window.location.href = 'gary-member-login.php';
    </script>";
}
$sql = "SELECT  * FROM `member` WHERE 1;";
$mem_sql = $pdo->query($sql)->fetchAll();
foreach ($mem_sql as $rows => $r) {
    if ($r['mem-account'] === $_SESSION['user']['mem_account']) {
        // 取得登入中的會員id
        $memLoginID = $r['sid'];
    }
}
// 變更商品數量
$nowQty = isset($_GET['nowQty']) ? intval($_GET['nowQty']) : 0;
$pro_id = isset($_GET['proId']) ? intval($_GET['proId']) : 0;
$pdo->query("UPDATE `cart` SET `qty` = $nowQty WHERE `produst_id` = $pro_id;");
if ($nowQty === 0) {
    $pdo->query("DELETE FROM `cart` WHERE `produst_id` = $pro_id;");
};

// 取得此會員的購物車紀錄
$cart = $pdo->query("SELECT c.*, p.`img` FROM `cart` c JOIN `produst` p ON c.produst_id = p.sid WHERE c.member_id = $memLoginID;")->fetchAll();
if ($cart === []) {
    echo "<script>alert('購物車內沒有商品');
    window.location.href = 'Nathan-CartList.php';
    </script>";
}

if (empty($_SESSION['user']['mem_account'])) {
    echo "<script>alert('請先登入會員');
    window.location.href = 'gary-member-login.php';
    </script>";
    exit;
}
$sql = "SELECT COUNT(1) FROM `cart` WHERE `member_id` = $memLoginID";
$count_sql = $pdo->query($sql)->fetchAll();



$pageName = "Nathan's cart";
$title = "Nathan-ViewCart - Nathan's cart";

?>
<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>
<style>
    .cart-container {
        font-family: 'Anton', sans-serif;
    }

    .prod-bottom td {
        border: 0;
    }

    .total-text-wrap {
        border-top: 2px solid black;
    }

    .total-text {
        font-weight: 600;
        color: #777;
    }

    .total-text-info {
        font-size: 1.2rem;
        font-weight: 600;
        color: #777;
        padding-right: 0;
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
    .money-tag::before{
        content: "$ ";
        color: black;
    }
    .cart-img-wrap{
        display: inline-block;
        width: 50px;
        height: 50px;
        overflow: hidden;
        background-size: cover;
    }
    .cart-img-wrap>img{
        width: 100%;
        object-fit: cover;
    }
    .cart-name-info{
        font-size: 1rem;
    }
</style>
<div class="cart-container">
    <!-- 內導覽 -->
    <div class="row">
        <header class="mt-3">
            <div class="d-flex align-items-center pb-3 mb-3 border-bottom">
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
        <a style="width:10%; cursor:pointer;" class="btn btn-dark text-decoration-none" onclick="delete_select()">Delete</a>
        <table class="table w-100">
            <thead>
                <tr class="text-center">
                    <th>
                        <div class="form-check">
                            <input class="form-check-input totalCheck" type="checkbox" value="" id="flexCheckDefault" name="all" onclick="check_all(this,'select')">
                        </div>
                    </th>
                    <th scope="col">NO.</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total price</th>

                </tr>
            </thead>
            <tbody>
                <?php
                // 計算每樣商品總價
                $total = 0;
                $productTotal = 0;
                $i = 1;
                foreach ($cart as $rows => $r) :
                    $productTotal = $r['price'] * $r['qty'];
                    $total += $r['price'] * $r['qty'];
                    $i = $rows + 1;
                ?>
                    <form action="Nathan-AddCart-api.php" method="POST">
                        <tr class="text-center prod-bottom">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input singleCheck" type="checkbox" value="<?= $r['produst_id'] ?>" id="singleSelect" name="select">
                                </div>
                            </td>
                            <td scope="col"><?= $i ?></td>
                            <input type="hidden" name="cart_id" value="<?= $r['produst_id']; ?>">
                            <td scope="col"><?= $r['produst_id']; ?></td>
                            <td class="d-flex justify-content-start align-content-center" scope="col">
                                <div class="cart-img-wrap me-1"><img src="Fteam-produst_img/<?= $r['img']?>"></div>
                                <span class="cart-name-info"><?= $r['name']; ?></span>
                            </td>
                            <input type="hidden" name="cart_name" value="<?= $r['name']; ?>">
                            <td class="money-tag" scope="col"><?= $r['price']; ?></td>
                            <input type="hidden" name="cart_price" value="<?= $r['price']; ?>">
                            <td>
                                <button type="button" class="minusBtn btn btn-dark"><i class="fa-solid fa-minus"></i></button>
                                <input class="w-25 qty-input" type="number" name="cart_qty" min="0" value="<?= $r['qty']; ?>">
                                <button type="button" class="plusBtn btn btn-dark">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                            <td scope="col">NT$ <?= $productTotal; ?></td>

                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row total-text-wrap pt-2">
        <div class="col-2">
            <h5 class="total-text pb-2">TotalPrice :</h5>
        </div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2 total-text-info d-flex align-content-center justify-content-end mt-1 pe-3">NT$ <?= $total ?></div>

    </div>
    <div class="col-12 text-end pe-3">
        <a style="cursor: pointer;" onclick="checkout_select();" class="btn btn-dark">Checkout</a>
    </div>
    <!-- 呈現區 -->
</div>

<?php require __DIR__ . '/parts/scripts.php' ?>
<script>
    // 全選checkbox同步設定
    function check_all(obj, cName) {
        const allCheck = document.getElementsByName(cName);
        for (let i = 0; i < allCheck.length; i++) {
            allCheck[i].checked = obj.checked;
        }
    }
    const singleSelect = document.querySelectorAll('#singleSelect');

    // 刪除所選商品
    function delete_select() {
        const select_ar = [];
        for (let i of singleSelect) {
            if (i.checked) {
                select_ar.push(Number(i.value));
            }
        }
        // console.log(select_ar);
        if (confirm(`確定要刪除商品ID ${select_ar} 商品嗎？`)) {
            location.href = `Nathan-Cart-Delete-Select-api.php?produst_id=${select_ar}`;
        }
    }

    // plus & minus qty
    const minusBtnList = document.querySelectorAll('.minusBtn');
    const plusBtnList = document.querySelectorAll('.plusBtn');
    for (let i of plusBtnList) {
        i.addEventListener('click', (e) => {
            const produstId = i.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
            console.log(produstId);
            let plusInput = i.previousElementSibling;
            plusInput.value = +plusInput.value + 1;
            location.href = `Nathan-ViewCart.php?nowQty=${plusInput.value}&proId=${produstId}`;
        })
    }
    for (let i of minusBtnList) {
        i.addEventListener('click', (e) => {
            const produstId = i.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
            console.log(produstId);
            let minusInput = i.nextElementSibling;
            minusInput.value = +minusInput.value - 1;
            if (minusInput.value === '0') {
                if (confirm('是否刪除此商品？')) {
                    location.href = `Nathan-Delete-zeroQty-api.php?proId=${produstId}`;
                } else {
                    minusInput.value = +minusInput.value + 1;
                }
            } else {
                location.href = `Nathan-ViewCart.php?nowQty=${minusInput.value}&proId=${produstId}`;
            }

        })
    }



    // 結帳所選商品
    function checkout_select() {
        const select_produst_id = [];
        for (let i of singleSelect) {
            if (i.checked) {
                select_produst_id.push(Number(i.value));
            }
        }
        console.log(select_produst_id);
        if (confirm('是否前往結帳頁面?')) {
            location.href = `Nathan-InsertOrder.php?produst_id=${select_produst_id}`;
        }
    }
</script>
<?php require __DIR__ . '/parts/html-foot.php' ?>