<?php 


//Bütün kullanıcıları döndüren endpointe istek atma

$userAll = sendApiRequestToken('/users/all','GET',[],$token);

$userData = [];

if ($userAll && $userAll['status'] == 'success') {
    $userData = $userAll['message']; 
}

//Kullanıcı silme endpointine istek atma

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    
    $userDelete = sendApiRequestToken('/users/delete','POST',[
        'userID' => $user_id
    ], $token);
    
    if ($userDelete && $userDelete['status'] == 'success') {
        showAlert('Kullanıcı başarıyla silindi','success');
        
        echo "<script>
                window.location.href = window.location.href;
              </script>";
        exit();
        
    } else {
        showAlert('Kullanıcı silinirken hata oluştu','error');
        echo "<script>
                window.location.href = window.location.href;
              </script>";
        exit();
    }
}
?>


<link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/buttons.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/select.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../assets/vendor/datatables/css/fixedHeader.bootstrap4.css">

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Kullanıcı Listesi</h5>
                <p>Sistemdeki tüm kullanıcıları bu kısımdan görebilirsiniz</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width:100%">
                    <thead>
                        <tr>
                            <th>Talep ID</th>
                            <th>Adınız</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Oluşturma Tarihi</th>
                            <th>Kullanıcı Türü</th>
                            <th>Diğer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($userData): ?>
                            <?php foreach ($userData as $user): ?>
                                <tr>
                                    
                                    <?php $formattedDate = formatDate($user['User_Created_At']) ?>
                                    <td><?php echo htmlspecialchars($user['User_ID']); ?></td>
                                    <td><?php echo htmlspecialchars($user['User_Firstname']) . ' ' . htmlspecialchars($user['User_Lastname']); ?></td>
                                    <td><?php echo htmlspecialchars($user['User_Email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['User_Phone']);?></td>
                                    <td><?php echo htmlspecialchars($formattedDate); ?></td>
                                    
                                    <?php if($user['User_Type_ID']=='2'):?>
                                    <td><a style="color:white;" class="btn btn-rounded btn-dark">Destek Veren</a></td>
                                    <?php elseif($user['User_Type_ID']=='1'):?>
                                    <td><a style="color:white;" class="btn btn-rounded btn-warning">Müşteri</a></td>
                                    <?php endif;?>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['User_ID']); ?>">
                                            <button type="submit" class="btn btn-rounded btn-danger">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Veri bulunamadı.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Talep ID</th>
                            <th>Adınız</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Kullanıcı Türü</th>
                            <th>Diğer</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="../assets/vendor/multi-select/js/jquery.multi-select.js"></script>
<script src="../assets/libs/js/main-js.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="../assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/vendor/datatables/js/data-table.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/js/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>