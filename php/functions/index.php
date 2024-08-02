<?php
/**
 * Dinamik bir alert mesajı oluşturur ve HTML, CSS, JavaScript kodunu ekler.
 *
 * @param string $message.
 * @param string $type 
 * 
 * 
 */
function formatDate($dateString) {
    $date = new DateTime($dateString);
    return $date->format('d-m-Y H:i');
}

function Encrypt($data) {
    $encryption = openssl_encrypt($data, "AES-128-CTR",
        "2QVWPokvccnWGTkob2MBvk7KfBn5RM8G", 0, "1309530638939283");
    
    return $encryption;
}

function Decrypt($data) {
    $decryption = openssl_decrypt($data, "AES-128-CTR",
        "2QVWPokvccnWGTkob2MBvk7KfBn5RM8G", 0, "1309530638939283");

    return $decryption;
}

 
function showAlert($message, $type = 'info') {
    $alertClass = '';
    switch ($type) {
        case 'success':
            $alertClass = 'success';
            break;
        case 'error':
            $alertClass = 'error';
            break;
        case 'info':
            $alertClass = 'info';
            break;
        default:
            $alertClass = 'info';
            break;
    }

    echo "
    <style>
        /* Alert Box Styling */
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #f44336; /* Kırmızı arka plan */
            color: white;
            padding: 20px; /* Padding büyütüldü */
            border-radius: 10px; /* Köşeler yuvarlatıldı */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Gölge artırıldı */
            display: none;
            z-index: 9999;
            max-width: 400px; /* Maksimum genişlik belirlendi */
            font-size: 16px; /* Yazı boyutu artırıldı */
        }
        .custom-alert.success {
            background: #4CAF50; /* Yeşil arka plan */
        }
        .custom-alert.error {
            background: #f44336; /* Kırmızı arka plan */
        }
        .custom-alert.info {
            background: #2196F3; /* Mavi arka plan */
        }
        .custom-alert .closebtn {
            margin-left: 20px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 20px; /* Kapatma düğmesi boyutu artırıldı */
        }
        .custom-alert .closebtn:hover {
            color: black;
        }
    </style>
    <div id='customAlert' class='custom-alert $alertClass'>
        <span class='closebtn' onclick='closeAlert()'>&times;</span>
        <span id='alertMessage'>$message</span>
    </div>
    <script>
        function showAlert(message, type) {
            var alertBox = document.getElementById('customAlert');
            var alertMessage = document.getElementById('alertMessage');
            alertBox.className = 'custom-alert ' + type;
            alertMessage.textContent = message;
            alertBox.style.display = 'block';
            
            // Alerti 5 saniye sonra gizle
            setTimeout(function() {
                alertBox.style.display = 'none';
            }, 5000);
        }

        function closeAlert() {
            document.getElementById('customAlert').style.display = 'none';
        }

        // Sayfa yüklendiğinde alert göster
        document.addEventListener('DOMContentLoaded', function() {
            showAlert('$message', '$alertClass');
        });
    </script>
    ";
}
?> 

