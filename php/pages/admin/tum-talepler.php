<?php 

//Admin için tüm talepleri çeken endpointe istek atma
$allRequest = sendApiRequestToken('/request/admin','POST',[],$token);

if($allRequest && $allRequest['status']=='success'){
    $requestData = $allRequest['message'];
} else {
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
                <h5 class="mb-0">Tüm Talepler</h5>
                <p>Müşterinin oluşturmuş olduğu tüm talepleri bu kısımdan görebilirsiniz</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width:100%">
    <thead>
        <tr>
            <th>Talep ID</th>
            <th>Adınız</th>
            <th>Email</th>
            <th>Oluşturulma Tarihi</th>
            <th>Talep Konusu</th>
            <th>Öncelik Durumu</th>
            <th>Durumu</th>
            <th>Detay</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($requestData): ?>
            <?php foreach ($requestData as $request): ?>
                <?php if (in_array($request['Request_Status_ID'], ['1', '2', '3'])): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['Request_ID']); ?></td>

                        <td><?php echo htmlspecialchars($request['Request_Firstname']); ?> <?php echo htmlspecialchars($request['Request_Lastname']); ?></td>
                        <td><?php echo htmlspecialchars($request['Request_Email']); ?></td>
                        <td><?php echo htmlspecialchars($request['Request_Timestamp']); ?></td>
                        <td><?php echo htmlspecialchars($request['Request_Title']); ?></td>

                        <td>
                            <?php if ($request['Request_Priority_ID'] == '1'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-warning">Düşük</a>
                            <?php elseif ($request['Request_Priority_ID'] == '2'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-primary">Orta</a>
                            <?php elseif ($request['Request_Priority_ID'] == '3'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-danger">Yüksek</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($request['Request_Status_ID'] == '1'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-warning">Bekliyor</a>
                            <?php elseif ($request['Request_Status_ID'] == '2'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-primary">İşleme Alındı</a>
                            <?php elseif ($request['Request_Status_ID'] == '3'): ?>
                                <a style="color:white;" class="btn btn-rounded btn-danger">Reddedildi</a>
                            <?php endif; ?>
                        </td>
                        <td><a href="details?id=<?php echo urlencode(Encrypt($request['Request_ID'])); ?>" style="color:white;" class="btn btn-rounded btn-dark">Detay</a></td>
                        </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Veri bulunamadı.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Adınız</th>
            <th>Email</th>
            <th>Oluşturulma Tarihi</th>
            <th>Öncelik Durumu</th>
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
