<?php


$encryptRequestID = $_GET['id'];
$requestID = Decrypt($encryptRequestID);
$requestSingle = sendApiRequestToken('/request/id', 'POST', ["requestID" => $requestID], $token);

if ($requestSingle && $requestSingle['status'] == 'success') {
    $requestData = $requestSingle['message'];
    foreach ($requestData as $data) {
        $requestFirstname = $data['Request_Firstname'];
        $requestLastname = $data['Request_Lastname'];
        $requestEmail = $data['Request_Email'];
        $requestPhone = $data['Request_Phone'];
        $formattedDate = formatDate($data['Request_Timestamp']);
        $requestTitle = $data['Request_Title'];
        $requestStatus = $data['Request_Status_ID'];
        $requestDescription = $data['Request_Description'];
        $requestDescriptionReply = $data['Request_Description_Reply']; 
    }
} else {
    $requestData = [];
    }
?>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="section-block" id="basicform">
        <h3 class="section-title">Talep Detayları</h3>
        <p>Oluşturmuş olduğunuz talep detaylarını aşağıdan görebilirsiniz...</p>
    </div>
    <div class="card">
        <h5 class="card-header">Oluşturulan Talep</h5>
        <div class="card-body">
            <form action="" method="POST">
                <!-- Form alanları -->
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Adınız</label>
                    <input type="text" name="userFirstname" value="<?=$requestFirstname?>" readonly class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText4" class="col-form-label">Soyadınız</label>
                    <input type="text" readonly value="<?=$requestLastname?>" name="userLastname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input name="userEmail" readonly value="<?=$requestEmail?>" type="email" class="form-control">
                    <p>Email adresiniz üçüncü bir kişiyle paylaşılmayacaktır.</p>
                </div>
                <div class="form-group">
                    <label for="inputText4" class="col-form-label">Telefon Numaranız</label>
                    <input name="userPhone" readonly value="<?=$requestPhone?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText4" class="col-form-label">Talep Tarihi</label>
                    <input name="userPhone" readonly value="<?=$formattedDate?>" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Talep Başlığı</label>
                    <textarea class="form-control" readonly name="talepDescription" rows="4"><?=$requestTitle?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Talep Açıklaması</label>
                    <textarea class="form-control" readonly name="talepDescription" rows="4"><?=$requestDescription?></textarea>
                </div>
                <?php if ($requestStatus == '4'): ?>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Talep Cevabı</label>
                        <textarea class="form-control" id="talepDescriptionReply" readonly name="talepDescriptionReply" rows="4"><?=$requestDescriptionReply?></textarea>
                    </div>
                <?php else: ?>
                   
                <?php endif; ?>
               
                
            </form>
        </div>
    </div>
</div>
