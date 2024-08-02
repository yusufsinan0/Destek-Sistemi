<?php
include_once ('functions/index.php');
session_start();

if (isset($_POST['logout'])) {
    // Tüm oturum değişkenlerini temizle
    $_SESSION = array();

    // Oturumu sonlandır
    session_destroy();

    // Tüm çerezleri temizle
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 1000, '/');
            setcookie($name, '', time() - 1000);
        }
    }
    showAlert(' Giriş sayfasına yönlendiriliyorsunuz','info');
        header('Refresh:1;URL=https://proje.yusufsinan.com/login.php');
    exit();
}

$userEmail = $userData['User_Email'];
$userFirstname = $userData['User_Firstname'];
$userLastname = $userData['User_Lastname'];

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- CSS ve JS dosyalarınızı burada ekleyin -->
</head>
<body>
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <img style="max-width: 150px;" src="assets/images/black-logo.png">
                <a class="navbar-brand" href="dashboard">Destek Sistemi</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <!-- Diğer menü elemanları buraya gelebilir -->
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?= $userFirstname." ".$userLastname?></h5>
                                    <span class="status"></span><span class="ml-2"><?=$userEmail?></span>
                                </div>
                                <form method="post" style="margin: 0;">
                                    <button type="submit" name="logout" class="dropdown-item">
                                        <i class="fas fa-power-off mr-2"></i>Çıkış Yap
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</body>
</html>
