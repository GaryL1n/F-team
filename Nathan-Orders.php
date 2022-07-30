<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'Nathan-orders';
$title = "Nathan OrderList";
//MV 資料處理 後端邏輯

$seach_sql = "SELECT * FROM `orders` WHERE `sid` LIKE '%%';";
// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: Nathan-Orders.php'); //轉向自己 或 給page=1 給值
    exit;
};
// 每一頁要幾筆
$perpage = 20;

// 取得總比數
$t_sql = "SELECT COUNT(1) FROM `orders`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿出來是索引式陣列用法

// 取得總頁數
$totalPage = ceil($totalRows / $perpage);

$seachValue = isset($_GET['search']) ? intval($_GET['search']) : 0;
$rows = []; // 給預設值 如果沒有資料 跑回圈用到 會出錯
if ($totalPage > 0) { //如果有資料 在執行if內的內容
    if ($page > $totalPage) {
        header("Location: ?page=$totalPage"); // 如果使用著輸入urlencoded > 總頁數,跳轉最後一頁
        exit;
    };
    if (!empty($seachValue)) {
        $sql = sprintf("SELECT o.*, m.`mem-name` FROM `orders` o JOIN member m ON o.member_sid = m.sid WHERE o.sid LIKE '%%$seachValue%%'  LIMIT %s,%s", ($page - 1) * $perpage, $perpage);
        $rows = $pdo->query($sql)->fetchAll();
    } else {
        $sql = sprintf("SELECT o.*, m.`mem-name` FROM `orders` o JOIN member m ON o.member_sid = m.sid LIMIT %s,%s", ($page - 1) * $perpage, $perpage);

        $rows = $pdo->query($sql)->fetchAll();
    }
}
$opValue = isset($_GET['opValue']) ? intval($_GET['opValue']) : 0;
if(!empty($opValue)){
    if($opValue === 1){
        $sql ="SELECT o.*, m.`mem-name` FROM `orders` o JOIN member m ON o.member_sid = m.sid WHERE order_date BETWEEN DATE_SUB(NOW(),INTERVAL 3 month) AND NOW() ORDER BY order_date";
        $rows = $pdo->query($sql)->fetchAll();
    }elseif($opValue === 2){
        $sql ="SELECT o.*, m.`mem-name` FROM `orders` o JOIN member m ON o.member_sid = m.sid WHERE order_date BETWEEN DATE_SUB(NOW(),INTERVAL 6 month) AND NOW() ORDER BY order_date";
        $rows = $pdo->query($sql)->fetchAll();
    }elseif($opValue === 3){
        $sql ="SELECT o.*, m.`mem-name` FROM `orders` o JOIN member m ON o.member_sid = m.sid WHERE order_date BETWEEN DATE_SUB(NOW(),INTERVAL 1 year) AND NOW() ORDER BY order_date";
        $rows = $pdo->query($sql)->fetchAll();
    }
}
?>

<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>
<style>
    .magnifying {
        transform: scale(1.3);
        transition: all .3s ease;
        cursor: pointer;
    }

    .magnifying:hover {
        transform: scale(1.8);
    }

    .search-inp {
        border-color: #ccc;
        border-radius: 5px;
    }

    .odNum {
        text-decoration: underline;
        color: darkgreen;
    }

    .odNum:hover {
        text-decoration: none;
    }
    .optionDate{
        width: 19%;
    }
</style>
<div class="row mb-4">
    <div class="col-12 mt-4 mb-4">
        <h4 class="ms-5 fw-bold">Order Record</h4>
    </div>
    <div class="col">
        <nav class="d-flex justify-content-center" aria-label="Page navigation example">
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
    <div class="col-12 mb-4">
        <input title="輸入後三或後四碼" class="search-inp mb-3 ms-5" placeholder="Order Number:" type="search" value="">
        <a class="btn magnifying" onclick="seachOrder()"><i class="fa-solid fa-magnifying-glass"></i></a>
        <select onchange="chooseDate();" class="optionDate form-select ms-5" aria-label="Default select example">
            <option selected>---- Within ----</option>
            <option value="1" <?= $opValue === 1 ? 'selected':''?>>Within 3 months</option>
            <option value="2" <?= $opValue === 2 ? 'selected':''?>>Within 6 months</option>
            <option value="3" <?= $opValue === 3 ? 'selected':''?>>Within 1 year</option>
        </select>
    </div>
    <table>
        <thead>
            <tr class="text-center">
                <th scope="col">Order Numer</th>
                <th scope="col">Total Price</th>
                <th scope="col">Member Name</th>
                <th scope="col">Order time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr class="text-center mb-2">
                    <td scope="col">
                        <a class="odNum btn" onclick="turnToDetail(<?= $r['sid'] ?>);"><?= $r['sid'] ?></a>
                    </td>
                    <td scope="col">$ <?= $r['total'] ?></td>
                    <td scope="col"><?= $r['mem-name'] ?></td>
                    <td scope="col"><?= $r['order_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php require __DIR__ . '/parts/scripts.php' ?>
<script>
    const turnToDetail = (sid) => {
        location.href = `Nathan-Order-detail.php?sid=${sid}`;
    }
    const seachOrder = () => {
        const odValue = document.querySelector('.search-inp').value;
        location.href = `Nathan-Orders.php?search=${odValue}`;
    }
    let option;
    const chooseDate = () =>{
        let option = document.querySelector('.optionDate');
        console.log(option.value);
        location.href = `Nathan-Orders.php?opValue=${option.value}`;
    }
</script>
<?php require __DIR__ . '/parts/html-foot.php' ?>