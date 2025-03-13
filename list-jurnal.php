<?php
include 'koneksi.php';
?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="text-center">List Jurnal Transaksi</h4>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Keterangan</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT DTGL_TRANS, NNO_TRANS, GROUP_CONCAT(CKET) AS CKET, SUM(IDRAMOUNT) AS nilai
                                                    FROM jurnal 
                                                    WHERE CTRANSFLAG='TR' AND CDEBKRED='D' 
                                                    GROUP BY DTGL_TRANS, NNO_TRANS");
                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo date('d-m-Y', strtotime($data['DTGL_TRANS'])); ?></td>
                                    <td><?php echo $data['NNO_TRANS']; ?></td>
                                    <td><?php echo $data['CKET']; ?></td>
                                    <td align="right"><?php echo number_format($data['nilai'], 2, ',', '.'); ?></td>
                                    <td>
                                        <a onclick="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-member.php?page=hapus-jurnal&tanggal=<?php echo $data['DTGL_TRANS']; ?>&notrans=<?php echo $data['NNO_TRANS']; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>