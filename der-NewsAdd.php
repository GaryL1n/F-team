<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'der-NewEdit';
$title = 'der-NewEdit';

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>
<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }

    .der-img-info {
        width: 200px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增檔案</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <input type="hidden" name="der_img" value="images.png">
                        <div class="mb-3">
                            <label for="title" class="form-label">title</label>
                            <input type="text" class="form-control" id="title" name="title" value="" required="required">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="info" class="form-label">info</label>
                            <input type="" class="form-control" id="info" name="info" value="">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">img</label>
                        </div>
                        <div class="img">
                            <img class="der-img-info" id="myimg" src="" />
                        </div>
                        <div class="" id="btn" onclick="uploadAvatar()"><i class="fa-solid fa-camera cameraICON"></i></div>
                </div>
                <button type="submit" class="btn btn-primary">新增</button>
                </form>
                <form name="form2" action="der-photo-api.php" method="post" enctype="multipart/form-data" style="display: none">
                    <input type="file" name="img" accept="image/*" />
                </form>
                <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                    資料編輯成功
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    async function sendData() {

        const fd = new FormData(document.form1);
        const r = await fetch('der-NewsAddapi.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        if (result.success) {
            alert('新增成功,1秒後跳回列表頁')
            setTimeout(() => {
                location.href = 'der-NewsList.php'; // 跳轉到列表頁
            }, 1000);
        } else {
            alert('新增失敗,請再次嘗試')
            setTimeout(() => {
                location.href = 'der-NewsAdd.php'; // 跳轉到新增頁
            }, 1000);
        }
    }

    // 上傳大頭照
    const btn = document.querySelector('#btn');
    const myimg = document.querySelector('#myimg');
    const img = document.form2.img;

    // 監聽的事件是內容改變(change)才會觸發
    img.addEventListener("change", async function() {

        // 上傳表單

        // 先拿到整個表單
        const fd2 = new FormData(document.form2);

        // r=拿到的回傳值(response)
        const r = await fetch("der-photo-api.php", {
            // 預設是GET 這邊設定成POST
            method: "POST",
            // 我要傳的資料
            body: fd2,
        });

        // 設定一個變數是拿回來的JSON格式轉回JS格式
        const obj = await r.json();
        console.log(obj);

        // 顯示的照片路徑 uploaded這個資料夾+回傳過來的檔名
        myimg.src = "./derphoto/" + obj.filename;
        document.form1.der_img.value = obj.filename;
    });

    // 點擊btn等於點擊了input
    function uploadAvatar() {
        img.click(); // 模擬點擊
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>