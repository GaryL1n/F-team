<?php
require __DIR__ . '/parts/connect_db.php';
$title = 'Gary-Register';
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/product-list.php' ?>

<style>
    .list-section {
        display: none;
    }

    body {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('./gary-img/DzqvS6DWoAAztYc.jpg_large')center center/cover;
        background-attachment: fixed;
    }

    .card {
        margin-top: 10%;
        width: 100%;
        border: 3px solid black;
    }

    .register-title {
        background-color: black;
        color: white;
        font-size: 1.8rem;
        width: 100%;
    }

    .cameraICON {
        cursor: pointer;
    }

    .eyes-input {
        width: 90%;
    }

    .eyes {
        cursor: pointer;
    }

    .eyes img {
        width: 1.2rem;
    }

    .red {
        color: red;
    }

    .form2 {
        display: none;
    }

    .login {
        background: white;
        color: black;
    }

    #btn {
        border: 0px;
    }

    #myimg {
        margin-left: 20%;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form name="form1" onsubmit="sendData(); return false;" novoalidate>
                    <h5 class="register-title">會員註冊</h5>
                    <input type="hidden" name="mem_avatar" value="images.png">
                    <div class="card-body d-flex justify-content-between">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">個人照片</label>
                            </div>
                            <div class="avatar">
                                <img id="myimg" src="" />
                            </div>
                            <div class="" id="btn" onclick="uploadAvatar()"><i class="fa-solid fa-camera cameraICON"></i></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="mem_account" class="form-label">帳號</label>
                                <!-- require 表示必填 -->
                                <input type="text" class="form-control" id="mem_account" name="mem_account" require>
                                <div class="form-text red"></div>
                            </div>
                            <div class="mb-3">
                                <label for="mem_password" class="form-label">密碼</label>
                                <div class="form-control d-flex justify-content-between">
                                    <input type="password" class="form-control eyes-input" id="mem_password" name="mem_password" require>
                                    <a class="eyes d-flex align-items-center" onclick="togglePwd()">
                                        <img src="./gary-img/eyes_off.png" alt="" id="eyes">
                                    </a>
                                </div>
                                <div class="form-text red password-red"></div>
                            </div>
                        </div>
                    </div>

                    <h5 class="register-title">申請人資訊</h5>

                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <!-- novoalidate 不要用HTML5的檢查方式 -->
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="mem_name" class="form-label">姓名</label>
                                    <!-- require 表示必填 -->
                                    <input type="text" class="form-control" id="mem_name" name="mem_name" require>
                                    <div class="form-text red"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="mem_mobile" class="form-label">手機</label>
                                    <!-- pattern 設定輸入格式 -->
                                    <input type="text" class="form-control" id="mem_mobile" name="mem_mobile" pattern="09\d{2}-?\d{3}-?\d{3}">
                                    <div class="form-text red"></div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="mem_nickname" class="form-label">暱稱</label>
                                    <input type="text" class="form-control" id="mem_nickname" name="mem_nickname">
                                    <div class="form-text red"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="mem_birthday" class="form-label">生日</label>
                                    <input type="date" class="form-control" id="mem_birthday" name="mem_birthday">
                                    <div class="form-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="mem_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="mem_email" name="mem_email">
                                <div class="form-text red"></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 col-6">
                                <label for="mem_address" class="form-label">地址</label>
                                <textarea class="form-control" name="mem_address" id="mem_address" cols="30" rows="1"></textarea>
                                <div class="form-text"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="gary-member-login.php" class="btn btn-primary login">LOGIN</a>
                            <button type="submit" class="btn btn-primary">立即註冊</button>
                        </div>
                    </div>
                </form>

                <form name="form2" action="gary-upload-avatar-api.php" method="post" enctype="multipart/form-data" style="display: none">
                    <input type="file" name="avatar" accept="image/*" />
                </form>

                <!-- 回應提示 -->
                <!-- <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                    註冊成功
                </div> -->
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    // 設定eamil格式
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
    // 設定手機格式
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    // 取得新增提示的Element
    // const info_bar = document.querySelector('#info-bar');


    // 取得該欄位的參照
    const name_f = document.form1.mem_name;
    const account_f = document.form1.mem_account;
    const email_f = document.form1.mem_email;
    const mobile_f = document.form1.mem_mobile;
    const password_f = document.form1.mem_password;


    // 查看密碼的眼睛
    const eyes = document.querySelector('#eyes');
    const pwd = () => {
        password_f.setAttribute('type', 'password');
    };
    const seePwd = () => {
        password_f.setAttribute('type', 'text');
    };
    let isPwd = false;
    const togglePwd = () => {
        isPwd = !isPwd;
        if (isPwd) {
            eyes.src = './gary-img/eyes_off.png';
            pwd();
        } else {
            eyes.src = './gary-img/eyes_on.png';
            seePwd();
        }
    };



    // 檢查的
    // 把這些欄位放進一個陣列裡面
    const fields = [name_f, account_f, email_f, mobile_f];
    // 建立一個空陣列
    const fieldTexts = [];
    // 把fields這些欄位的下一個Element放進上面的空陣列
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }


    async function sendData() {
        //如果符合格式讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            // 讓文字內容變回空值
            fieldTexts[i].innerText = '';
        }

        // info_bar.style.display = 'none';



        // TODO: 欄位檢查, 前端的檢查
        // 這個變數是來判斷欄位有沒有通過檢查
        let isPass = true; // 預設是通過檢查的

        // 如果這個欄位的值的長度小於2
        if (name_f.value.length < 2) {
            // alert('姓名至少兩個字');
            // name_f.classList.add('red');
            // nextElementSibling 往下一個Element
            // name_f.nextElementSibling.classList.add('red');
            // 往上層找再往下層
            // name_f.closet('.mb-3').querySelector('.form-text').classList.add('red');

            // 寫入
            fieldTexts[0].innerText = '姓名至少兩個字';
            // 沒通過檢查
            isPass = false;
        }

        if (account_f.value === '') {
            // 寫入
            fieldTexts[1].innerText = '請輸入帳號';
            // 沒通過檢查
            isPass = false;
        }

        if (password_f.value === '') {
            const passred = document.querySelector('.password-red');
            // 寫入
            passred.innerText = '請輸入密碼';
            // 沒通過檢查
            isPass = false;
        }

        // 有填內容但不符合格式 裡面的值符不符合設定的格式
        if (email_f.value && !email_re.test(email_f.value)) {
            // alert('email 格式錯誤');
            fieldTexts[2].innerText = 'email 格式錯誤';
            isPass = false;
        }
        // 有填內容但不符合格式
        if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            // alert('手機號碼格式錯誤');
            fieldTexts[3].innerText = '手機號碼格式錯誤';
            isPass = false;
        }

        // 如果isPass是false 程式碼就不要繼續往下走
        if (!isPass) {
            return; // 結束函式
        }

        // 把整個表單內容抓出來
        const fd = new FormData(document.form1);

        // 把表單送給誰
        const r = await fetch('gary-register-api.php', {
            method: 'POST',
            body: fd,
        });
        // .then(d=>d.json())
        // .then(d=>{
        //     console.log(d);
        // })

        // 回傳的資料是JSON 轉回JS的陣列
        const result = await r.json();

        console.log(result);

        // info_bar.style.display = 'block'; //顯示提示訊息

        // 如果新增成功 success=true
        if (result.success) {
            // 關於顏色的CSS
            // info_bar.classList.remove('alert-danger');
            // info_bar.classList.add('alert-success');
            // 寫入文字
            // info_bar.innerText = '註冊成功';
            alert('註冊成功，新會員24小時內享8折優惠!');

            // 把整個表單內容抓出來
            // const fd = new FormData(document.form1);

            // 把表單送給誰
            const r = await fetch('gary-mem-login-api.php', {
                method: 'POST',
                body: fd,
            });
            // .then(d=>d.json())
            // .then(d=>{
            //     console.log(d);
            // })

            // 回傳的資料是JSON 轉回JS的陣列
            const result = await r.json();

            console.log(result);

            // const info_bar = document.querySelector('#info-bar');


            // 如果成功 success=true
            // if (result.success) {
            //     setTimeout(() => {
            //         location.href = 'gary-member-card.php'; //跳轉到列表頁
            //     }, 1000);
            // }

            location.href = 'gary-Member.php'; //跳轉到列表頁


            // setTimeout(() => {
            //     location.href = ''; //跳轉到列表頁
            // }, 2000);
            // 如果新增失敗 success=false
        } else {
            // info_bar.classList.remove('alert-success');
            // info_bar.classList.add('alert-danger');
            // info_bar.innerText = result.error || '會員無法註冊';
            alert('會員無法註冊');
        }

    }

    // 上傳大頭照
    const btn = document.querySelector('#btn');
    const myimg = document.querySelector('#myimg');
    const avatar = document.form2.avatar;

    // 監聽的事件是內容改變(change)才會觸發
    avatar.addEventListener("change", async function() {

        // 上傳表單

        // 先拿到整個表單
        const fd2 = new FormData(document.form2);

        // r=拿到的回傳值(response)
        const r = await fetch("gary-upload-avatar-api.php", {
            // 預設是GET 這邊設定成POST
            method: "POST",
            // 我要傳的資料
            body: fd2,
        });

        // 設定一個變數是拿回來的JSON格式轉回JS格式
        const obj = await r.json();
        console.log(obj);

        // 顯示的照片路徑 uploaded這個資料夾+回傳過來的檔名
        myimg.src = "./gary-uploaded/" + obj.filename;
        document.form1.mem_avatar.value = obj.filename;
    });

    // 點擊btn等於點擊了input
    function uploadAvatar() {
        avatar.click(); // 模擬點擊
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>