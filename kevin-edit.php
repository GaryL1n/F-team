<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'kevin-edit';
$title = 'Product Edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: kevin-produst.php');
    exit;
}

$row = $pdo->query("SELECT * FROM produst WHERE sid=$sid")->fetch();
if (empty($row)) {
    header('Location: kevin-produst.php');
    exit;
}



?>
<?php include __DIR__ . '/parts/html-head.php' ?>

<?php require __DIR__ . '/parts/product-list.php' ?>
<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Edit</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="mb-3">
                            <label for="produst_img" class="form-label">Product pictures</label>
                            <input type="text" class="form-control" id="produst_img" name="produst_img" required value="<?= htmlentities($row['img']) ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="<?= $row['brand'] ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="produst_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="produst_name" name="produst_name" pattern="09\d{8}" value="<?= $row['name'] ?>">
                            <div class="form-text red"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="price" class="form-label">價錢</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?= $row['price'] ?>">
                            <div class="form-text"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="info" class="form-label">Info</label>
                            <textarea class="form-control" name="info" id="info" cols="30" rows="3"><?= $row['info'] ?></textarea>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?= $row['price'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                    <!-- <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料編輯成功
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</div>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?>;

    async function sendData() {
        const fd = new FormData(document.form1);
        const r = await fetch('kevin-edit-api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        if (result.success == true) {
            alert('商品編輯成功,');
            setTimeout(() => {
                location.href = 'kevin-produst.php';
            }, 1000);
        } else {
            alert('商品編輯失敗');
        }

    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>