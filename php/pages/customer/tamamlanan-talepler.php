<?php 

$allRequest = sendApiRequestToken('/request/customer', 'POST', [
    'userID'=> $userID
], $token);

if ($allRequest && $allRequest['status'] == 'success') {

    $requestData = $allRequest['message'];
} else {
    echo 'API request failed or returned an error.';
    $requestData = [];
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
                <h5 class="mb-0">Tamamlanan Talepler</h5>
                <p>Oluşturduğunuz tüm talepleri bu kısımdan görebilirsiniz</p>
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
                                <th>Oluşturulma Tarihi</th>
                                <th>Durumu</th>
                                <th>Detay</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($requestData as $request): ?>
                               
                                <?php if($request['Request_Status_ID'] == '4'): ?>
                                
                                    ysususuususus
                                    <tr>
                                        <td><?php echo htmlspecialchars($request['Request_ID'])?></td>
                                        <td><?php echo htmlspecialchars($request['Request_Lastname']); ?></td>
                                        <td><?php echo htmlspecialchars($request['Request_Email']); ?></td>
                                        <td><?php echo htmlspecialchars($request['Request_Phone']); ?></td>
                                        <td><?php echo htmlspecialchars(formatDate($request['Request_Timestamp'])); ?></td>
                                            <td>
                                        <?php if($request['Priority_ID']=='1'): ?>
                                                <a style="color:white;" class="btn btn-rounded btn-warning">Düşük</a>
                                        <?php endif;?>

                                        <?php if($request['Priority_ID']=='2') : ?>
                                            <a style="color:white;" class="btn btn-rounded btn-primary">Orta</a>
                                        <?php endif;?>

                                        <?php if($request['Priority_ID']=='3') : ?>
                                            <a style="color:white;" class="btn btn-rounded btn-danger">Yüksek   </a>
                                        <?php endif;?>

                                        
                                    </td>
                                    <td><a href="details.php?id=<?php echo urlencode(Encrypt($request['Request_ID'])); ?>" style="color:white;" class="btn btn-rounded btn-dark">Detay</a></td>
                                    </tr>
                                <?php endif; ?>
            
                            
                            <?php endforeach;?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Talep ID</th>
                                <th>Adınız</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Durumu</th>
                                <th>Detay</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
