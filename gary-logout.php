<?php

session_start();

// session_destroy(); // 清除所有的 session
unset($_SESSION['user']); // 移除 'user' 對應的值

header('Location: gary-member-login.php');