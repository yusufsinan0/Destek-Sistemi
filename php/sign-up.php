<?php 





if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $userFirstname = $_POST['userFirstname'];
    $userLastname = $_POST['userLastname'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $userPhone = $_POST['userPhone'];
    $userTypeID = $_POST['userTypeID'];
    $userGenderID = $_POST['userGenderID'];

    
}


if(isset($_POST['submitButton'])){

   $loginResponse = sendApiRequest('/users/register','POST',[
    'userFirstname' => $userFirstname,
    'userLastname' => $userLastname,
    'userEmail'=> $userEmail,
    'userPassword'=> $userPassword,
    'userPhone'=> $userPhone,
    'userTypeID' => $userTypeID,
    'userGenderID'=> $userGenderID
]);

      
    if($loginResponse){
        
        showAlert('Başarılı bir şekilde kayıt oldunuz ! ','success');
        header('Refresh: 1 ; URL=https://proje.yusufsinan.com/login.php');
        
    } else {
        showAlert('Kayıt esnasında bir hata oluştu ! ','error');
    }


}


?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>

.form-control.form-control-lg-confirm{
    display: none;
}           

        
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
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form action=""  method="POST" class="splash-container">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Kayıt Ol ! </h3>
                <img style="max-width: 250px;" src="./assets/images/black-logo.png">
                <p>Aşağıdaki bilgileri doldurarak destek sistemimize kayıt olabilirsiniz .</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="userFirstname" required="" placeholder="Adınız" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="userLastname" required="" placeholder="Soyadınız" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="userEmail" required="" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg"  type="text" name="userPhone" required="" pattern="^0[0-9]{10}$" placeholder="05..." autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="userPassword" type="password" required="" placeholder="Şifreniz">
                </div>

                <div class="form-group">
                    <select class="form-control form-control-lg" name="userTypeID"  required>
                        <option value="" disabled selected>Kullanıcı Türü Seçiniz</option>
                        <option value="2">Destek Veren</option>
                        <option value="1">Müşteri</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control form-control-lg" name="userGenderID"  required>
                        <option value="" disabled selected>Cinsiyet  Seçiniz</option>
                        <option value="1">Erkek</option>
                        <option value="2">Kadın</option>
                    </select>
                </div>
                
                <div class="form-group pt-2">
                    <button  class="btn btn-block btn-primary" name="submitButton" type="submit">Kayıt Ol </button>
                </div>
                </form>

                <div class="form-group">
                    
                </div>
                <div class="form-group row pt-0">
                  
            </div>
            <div class="card-footer bg-white">
                <p>Zaten üye misiniz ?  <a href="/login" class="text-secondary">Giriş Yap ! .</a></p>
            </div>
        </div>
</body>



 
</html>


