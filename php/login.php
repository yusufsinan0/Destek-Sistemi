<?php 

include_once ('config.php');
include_once ('functions/index.php');


session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

}


if(isset($_POST['submitButton'])){

    $loginResponse = sendApiRequest('/users/login', 'POST', [
        'userEmail' => $userEmail,
        'userPassword' => $userPassword
    ]);

    if($loginResponse && $loginResponse['status'] == 'success'){
        $userFirstname = $loginResponse['userFirstname'];
        $userLastname = $loginResponse['userLastname'];
        $userTypeID = $loginResponse['userTypeID'];
        $token = $loginResponse['token'];

        setcookie('token', $token, time() + (7 * 24 * 60 * 60), "/", "", false, true);

            header('Refresh:1; URL = https://proje.yusufsinan.com/dashboard');

        

        showAlert("Hoşgeldiniz $userFirstname $userLastname ",'success');
        } else {
        showAlert('Email veya şifre yanlış : ', 'error');
    }

}
?>

<!doctype html>
<html lang="tr">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        justify-content: center;
    }
    </style>
</head>

<body>
   
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a><img style="max-width:250px;" class="logo-img" src="./assets/images/black-logo.png" alt="logo"></a><span class="splash-description"></span></div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="userEmail" type="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="userPassword" type="password" placeholder="Şifre">
                    </div>
                    
                    <button type="submit" name="submitButton" class="btn btn-primary btn-lg btn-block">Giriş Yap</button>
                </form>
            </div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="sign-up.php" class="footer-link">Kayıt Ol </a></div>
                <div class="card-footer-item card-footer-item-bordered">
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="./assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
