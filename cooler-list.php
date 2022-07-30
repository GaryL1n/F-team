<?php require __DIR__ . '/parts/connect_db.php';
$pageName = '課程資訊';
$title = '課程資訊';

$perPage = 5; // 每一頁有幾筆





// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM lesson";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 總筆數

$totalPages = ceil($totalRows / $perPage); // 總共有幾頁

$rows = [];

if ($totalRows > 0) {
    // 頁碼若超過總頁數
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM lesson ORDER BY updated_at DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
?>



<?php include __DIR__ . '/parts/html-head.php' ?>
<style>
    .cooler-creat-delete:hover {
        background-color: #dee2e6;
        color: #222;
    }



    .cooler-info-text-limited {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
        /* white-space: normal; */
        /* line-height: 40px; */
        /* box-sizing: border-box; */
        padding: 0 .5rem !important;
        margin: .5rem 0;
        width: 150px;

        /* border: 1px solid; */
        /* word-wrap: break-word; */
        /* font-weight: 900; */
    }

    .table {
        --bs-table-striped-bg: white;
        border: 0px solid transparent;
    }
</style>
<?php include __DIR__ . '/parts/product-list.php' ?>

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
                <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
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

            <div>
                <button onclick="delete_select()" class="btn btn-danger cooler-creat-delete">Delete</button>
                
                    <a href="cooler-list-add.php" class="btn-danger btn  float-end  cooler-creat-delete">create</a>
            </div>


        </nav>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input totalCheck" type="checkbox" value="" id="flexCheckDefault" name="all" onclick="check_all(this,'delALL')">
                        </div>
                    </th>

                    <th scope="col">#</th>
                    <th scope="col">課程名稱</th>
                    <th scope="col">課程內容</th>
                    <th scope="col">開始時間</th>
                    <th scope="col">結束時間</th>
                    <th scope="col">預約人數</th>
                    <th scope="col">價格</th>
                    <th scope="col">老師</th>
                    <th scope="col">活動位置</th>
                    <th scope="col">上傳時間</th>
                    <th scope="col">更新時間</th>

                    <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input singleCheck" type="checkbox" value="<?= $r['sid'] ?>" id="singleSelect" name="delALL">
                            </div>
                        </td>


                        <td><?= $r['sid'] ?></td>
                        <td><?= htmlentities($r['name']) ?></td>
                        <td class="cooler-info-text-limited"><?= htmlentities($r['info']) ?></td>
                        <!-- <td><?= $r['categories_id'] ?></td> -->
                        <td><?= $r['duringtime_begin'] ?></td>
                        <td><?= $r['duringtime_end'] ?></td>

                        <td><?= ($r['number_of_people']) ?></td>

                        <td><?= $r['price'] ?></td>
                        <td><?= $r['teacher'] ?></td>
                        <td><?= $r['location'] ?></td>
                        <td><?= $r['created_at'] ?></td>
                        <td><?= $r['updated_at'] ?></td>

                        <td>
                            <a href="cooler-list-edit.php?sid=<?= $r['sid'] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <?php /*
                        <a href="ab-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為 <?= $r['sid'] ?> 的資料嗎?')">
                        */ ?>

                            <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

</div>









<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `cooler-list-delete.php?sid=${sid}`;
        }
    }

    // 全選checkbox同步設定
    function check_all(obj, delALL) {
        const allCheck = document.getElementsByName(delALL);
        for (let i = 0; i < allCheck.length; i++) {
            allCheck[i].checked = obj.checked;
        }
    }
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
            location.href = `cooler-list-delete.php?sid=${select_ar}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>