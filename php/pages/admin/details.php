<?php
require './pages/admin/Exception.php';
require './pages/admin/PHPMailer.php';
require './pages/admin/SMTP.php';

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $requestDescriptionReply = $_POST['talepDescriptionReply'];
        $requestStatusID = $_POST['requestStatus'];
        $requestClosedID = $userID;

        // API üzerinden güncelleme yap
        $requestAdminUpdate = sendApiRequestToken('/request/admin/update', 'POST', [
            "requestID" => $requestID,
            "requestDescriptionReply" => $requestDescriptionReply,
            "requestStatus" => $requestStatusID,
            "requestClosedID" => $requestClosedID,
        ], $token);

        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

        try {
            
  
            $mail->isSMTP();
            $mail->Host       = 'mail.yusufsinan.com'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'destek@yusufsinan.com'; 
            $mail->Password   = 'Destek102030'; 
            $mail->SMTPSecure = "ssl";
            $mail->Port       = 465;
            $mail->CharSet    = "UTF-8";

            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );

            $mail->setFrom('destek@yusufsinan.com', 'Talep Güncellemesi');
            $mail->addAddress($requestEmail);

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = "Talep Cevaplandırıldı";
            $mail->Body = '
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0;">
        <meta name="format-detection" content="telephone=no"/>
        <style>
        /* Reset styles */ 
        body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
        body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
        img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        #outlook a { padding: 0; }
        .ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }

        /* Rounded corners for advanced mail clients only */ 
        @media all and (min-width: 560px) {
            .container { border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; -khtml-border-radius: 10px;}
        }

        /* Set color for auto links (addresses, dates, etc.) */ 
        a, a:hover {
            color: #127DB3;
        }
        .footer a, .footer a:hover {
            color: #999999;
        }
        </style>
    </head>

    <!-- BODY -->
    <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; background-color: #141423; color: #fff;" bgcolor="#141423" text="#000000">

    <!-- SECTION / BACKGROUND -->
    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background">
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;" bgcolor="#141423">
                <!-- WRAPPER -->
                <table border="0" cellpadding="0" cellspacing="0" align="center" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="wrapper">
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; padding-top: 40px; padding-bottom: 40px;">
                            <!-- LOGO -->
                        </td>
                    </tr>
                </table>

                <!-- WRAPPER / CONTAINER -->
                <table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#1e1c34" width="560" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit; max-width: 560px;" class="container">
                    <!-- HEADER -->
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%; padding-top: 30px; color: #ffffff; font-size: 35px; font-weight: 800; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;" class="header">
                            Destek Talebinde Güncelleme Var!
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 16px; font-weight: 400; line-height: 160%; padding-top: 25px; font-size: 25px; color: #ffffff; font-weight: 700; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;" class="paragraph">
                            <b>Easy Criptoland</b> destek ekibimiz talebini inceledi ve talebinde güncelleme yaptı. Lütfen talebini kontrol et!
                        </td>
                    </tr>
                    <tr>

                     <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; padding-top: 25px; background-color: transparent;" class="line" width="100%" size="1">
                        <a target="_blank" style="text-decoration: none;" href="">
                            <img height="60px" width="auto" border="0" vspace="0" hspace="0" src="proje.yusufsinan.com/assets/images/white-logo.png" width="170px" height="60px" alt="Logo" title="Logo" style="color: #000000; font-size: 10px; margin: 0; padding: 0; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; border: none; display: block; margin-left: auto; margin-right: auto;" />
                        </a>
                    </td>


                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 16px; font-weight: 400; line-height: 160%; padding-top: 25px; color: #ffffff; font-weight: 700; font-size: 25px; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;" class="paragraph">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; padding-top: 25px; font-size: 30px; padding-bottom: 5px;" class="button">
                            <a href= target="_blank" style="text-decoration: none;">
                                <table border="0" cellpadding="0" cellspacing="0" align="center" style="max-width: 240px; min-width: 120px; border-collapse: collapse; border-spacing: 0; padding: 0;">
                                    <tr>
                                        <td align="center" valign="middle" style="padding: 12px 24px; margin: 0; border-collapse: collapse; border-spacing: 0; border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px; color: #ffffff; background-color: #007cdb;" bgcolor="#007cdb">
                                            <a href="https://proje.yusufsinan.com/" t   arget="_blank" style="color: #ffffff; font-size: 16px; font-weight: 600; text-decoration: none; line-height: 100%; font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, Oxygen, Ubuntu, Cantarell, \'Open Sans\', \'Helvetica Neue\', sans-serif;" class="button-link">
                                                Talebi Görüntüle
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; padding-top: 25px; padding-bottom: 25px;" class="footer">
                            <table border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: 100%;">
                                <tr>
                                    <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;">
                                        <font face="Verdana, Arial, sans-serif" size="2" color="#999999">
                                            <a href="https://www.proje.yusufsinan.com/" target="_blank" style="color: #999999; text-decoration: none;">EASY INTERNATIONAL TEKNOLOJİ YATIRIM ANONİM ŞİRKETİ</a><br/>
                                            <span style="font-size: 12px; line-height: 120%;">&copy;  Otomatik yanıtlama sistemidir . Lütfen mailde dönüş yapmayınız.</span>
                                        </font>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- END WRAPPER / CONTAINER -->
            </td>
        </tr>
    </table>
    </body>
    </html>
';


            $mail->send();

            showAlert('Talep başarılı şekilde cevaplandı ve e-posta gönderildi.', 'success'); 
        } catch (Exception $e) {
            showAlert('E-posta gönderilirken hata oluştu: ' . $mail->ErrorInfo, 'danger'); 
        }
    }
} else {
    $requestData = [];
}
?>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="section-block" id="basicform">
        <h3 class="section-title">Talep Oluştur</h3>
        <p>Müşterinin oluşturmuş olduğu talebi aşağıdan yanıtlayabilirsiniz.</p>
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
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Talep Cevabı</label>
                        <textarea class="form-control" id="talepDescriptionReply" name="talepDescriptionReply" rows="4"></textarea>
                    </div>
                <?php endif; ?>
                <label for="requestStatus">Talep Durumu:</label>
                <select class="form-control" name="requestStatus">
                    <option value="1">Bekliyor</option>
                    <option value="2">İşleme Alındı</option>
                    <option value="3">Reddedildi</option>
                    <option value="4">Tamamlandı</option>
                </select>
                <br>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-block">Raporu Gönder</button>
                </div>
            </form>
        </div>
    </div>
</div>
