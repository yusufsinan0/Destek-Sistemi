<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $talepPriority = $_POST['prioritySelect'];
    $talepDescription = $_POST['talepDescription'];
    $talepTitle = $_POST['talepTitle'];
    echo $talepTitle;


    $requestAdd = sendApiRequestToken('/request/add','POST',[
        'requestPriority'=> $talepPriority,
        'requestDescription'=> $talepDescription,
        'requestTitle'=> $talepTitle
    ],$token);


    if($requestAdd && $requestAdd['status']=='success'){
        showAlert('Talebiniz başarıyla oluşturuldu','success');

    } else {
        showAlert('Talebiniz oluşturulurken hata alındı','danger');

    }


}

$userData = $response['message'];
$userFirstname = $userData['User_Firstname'];
$userLastname = $userData['User_Lastname'];
$userEmail = $userData['User_Email'];
$userPhone = $userData['User_Phone'];
$userPassword = $userData['User_Password'];
$userTypeID = ($userData['User_Type_ID']);
?>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="basicform">
            <h3 class="section-title">Talep Oluştur</h3>
            <p>Aşağıdaki formu doldurarak Easy Criptoland destek ekibi ile iletişime geçebilirsiniz.</p>
        </div>
        <div class="card">
            <h5 class="card-header">Talep Oluşturma Formu</h5>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="inputText3" class="col-form-label">Adınız</label>
                        <input type="text" name="userFirstname" readonly value="<?= htmlspecialchars($userFirstname) ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputText4" class="col-form-label">Soyadınız</label>
                        <input type="text" readonly value="<?= htmlspecialchars($userLastname) ?>" name="userLastname" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input name="userEmail" readonly value="<?= htmlspecialchars($userEmail) ?>" type="email" placeholder="name@example.com" class="form-control">
                        <p>Email adresiniz üçüncü bir kişiyle paylaşılmayacaktır.</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputText4" class="col-form-label">Telefon Numaranız</label>
                        <input name="userPhone" readonly value="<?= htmlspecialchars($userPhone) ?>" type="text" class="form-control">
                    </div>

                    <label for="prioritySelect">Öncelik Durumu:</label>
                    <select class="form-control" name="prioritySelect">
                        <option value="1">Düşük</option>
                        <option value="2">Orta</option>
                        <option value="3">Yüksek</option>
                    </select>

                    <br>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Talep Başlığı</label>
                        <input name="talepTitle"   type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Talep Açıklaması</label>
                        <textarea class="form-control" id="talepDescription" name="talepDescription" rows="8"></textarea>
                    </div>
                    
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-rounded btn-secondary">Talep Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
