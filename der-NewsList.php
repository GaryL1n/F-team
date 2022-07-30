<?php
require __DIR__ . '/parts/connect_db.php'
?>
<?php
$pageName = 'der-NewsList';
$title = "der-NewsList-der's news";

$perPage = 5; // 每一頁有幾筆

// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM News";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 總筆數

$totalPages = ceil($totalRows / $perPage); // 總共有幾頁

$rows = [];

if ($totalRows > 0) {
    // 頁碼若超過總頁數
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM News ORDER BY sid LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/product-list.php' ?>

<div class="row">
    <div class="col-12">
        <a class=" d-inline-block mt-3 text-decoration-none btn-sm btn-dark" href="der-NewsAdd.php">Add item</a>

        <a style="cursor:pointer;" onclick="delete_select()" class=" d-inline-block mt-3 text-decoration-none btn-sm btn-dark">Delete Select</a>

        <table class="table w-100">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input totalCheck" type="checkbox" value="" id="flexCheckDefault" name="all" onclick="check_all(this,'c')">
                        </div>
                    </th>
                    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">info</th>
                    <th scope="col">image</th>
                    <th scope="col">created_at</th>
                    <th scope="col">update_at</th>
                    <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input singleCheck" type="checkbox" value="<?= $r['sid'] ?>" id="singleSelect" name="c">
                            </div>
                        </td>
                        <td>
                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>

                        <td><?= $r['sid'] ?></td>
                        <td><?= $r['title'] ?></td>
                        <td><?= $r['info'] ?></td>
                        <td>
                            <img class="w-75" src="./derphoto/<?= $r['image'] ?>" alt="">
                        </td>
                        <td><?= $r['created_at'] ?></td>
                        <td><?= $r['update_at'] ?></td>
                        <td>
                            <a href="der-NewsEdit.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
<?php require __DIR__ . '/parts/scripts.php' ?>
<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `der-NewsDelete.php?sid=${sid}`;
        }
    }
    // 全選checkbox同步設定
    function check_all(obj, cName) {
        const allCheck = document.getElementsByName(cName);
        for (let i = 0; i < allCheck.length; i++) {
            allCheck[i].checked = obj.checked;
        }
    }
    async function delete_select() {
        const select_ar = [];
        for (let i of singleSelect) {
            if (i.checked) {
                select_ar.push(Number(i.value));
            }
        }
        // console.log(select_ar);
        if (confirm(`確定要刪除編號為${select_ar}的資料嗎`)) {
            location.href = `der-Newsdeleteallapi.php?sid=${select_ar}`;
        }
    }
</script>
<?php require __DIR__ . '/parts/html-foot.php' ?>