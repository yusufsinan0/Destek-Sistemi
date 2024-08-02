<?php 
include_once('config.php');
include_once('functions/index.php');

$token = isset($_COOKIE['token']) ? $_COOKIE['token'] : '';
$response = sendApiToken('/users/me', $token);

$userData = $response['message'];
$userTypeID = isset($userData['User_Type_ID']) ? $userData['User_Type_ID'] : '';
$userID = isset($userData['User_ID']) ? $userData['User_ID'] : '';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="./assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <title>Destek Sistemi</title>
</head>
<body>

    <main>
      
    <?php 

if (empty($token)) {
    echo '<script>window.location.href = "login.php";</script>';
    exit; 
}

    $mainDirPages = ['login', 'sign-up'];
    $sayfa = isset($_GET["sayfa"]) ? $_GET["sayfa"] : '';

    // Yönlendirme işlemi
    if (empty($sayfa) || $sayfa == "anasayfa") {
        $sayfa = 'dashboard'; // Varsayılan sayfa
    }

    if (in_array($sayfa, $mainDirPages)) {
        include __DIR__ . '/' . $sayfa . '.php';
    } else {
        if ($userTypeID == '1') {
            include 'pages/partials/header.php';
            include 'pages/partials/customer-menu.php';
            include 'pages/partials/page-header.html';

            $pageFile = 'pages/customer/' . $sayfa . '.php';
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                include 'pages/404-page.html';
            }
        } else if ($userTypeID == '2') { // Yönetici
            include 'pages/partials/header.php';
            include 'pages/partials/admin-menu.php';
            include 'pages/partials/page-header.html';

            $pageFile = 'pages/admin/' . $sayfa . '.php';
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                include 'pages/404-page.html';
            }
        } else {
            include 'pages/404-page.html';
        }
    }
    ?>

    </main>

    <script src="./assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="./assets/libs/js/main-js.js"></script>
    <script src="./assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="./assets/vendor/charts/morris-bundle/morris.js"></script>
    <script src="./assets/vendor/charts/morris-bundle/morrisjs.html"></script>
    <script src="./assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="./assets/vendor/charts/charts-bundle/chartjs.js"></script>
    <script src="./assets/libs/js/dashboard-influencer.js"></script>
</body>
</html>
