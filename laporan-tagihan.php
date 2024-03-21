<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
    echo "<script>alert('Anda belum login')</script>";
    echo "<script>document.location='index.php'</script>";
}
?>

        				<!-- Content -->
                        <div class='table-responsive'>

                <center><h2>LAPORAN DATA TAGIHAN</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <button>Export</button>
                </div><br>
                <div>
                <table class='table table-striped table-bordered data' align='center'>
                  	<thead>
                   		<tr bgcolor='#B0C4DE'>
                       		<td>No</td>
                            <td>Kode Tagihan</td>
                            <td>Kode Customer</td>
                            <td>Nama Customer</td>
                            <td>Tgl Invoice</td>
                            <td>Total</td>
                            <td>Tgl Pelunasan</td>
                            <td>Jenis Pembayaran</td>
                      	</tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'config/koneksi.php';
                    $cari = 'select * from tagihan';
                    $tampil = mysqli_query($buka, $cari);
                    $nomer=1;
                    while ($hasil = mysqli_fetch_assoc($tampil))
                    {
                        $kode_tagihan = $hasil['kode_tagihan'];
                        $kode_customer = $hasil['kode_customer'];
                        $nama_customer = $hasil['nama_customer'];
                        $tgl_invoice = $hasil['tanggal_invoice'];
                        $total = $hasil['total'];
                        $tgl_pelunasan = $hasil['tanggal_pelunasan'];
                        $jns_pembayaran = $hasil['jenis_pembayaran'];
                    ?>
                    <tr>
            		    <td align='center'><?php echo $nomer++; ?></td>
            		    <td align='center'><?php echo $kode_tagihan; ?></td>
            		    <td align='center'><?php echo $kode_customer; ?></td>
            		    <td><?php echo $nama_customer; ?></td>
            		    <td align='center'><?php echo $tgl_invoice; ?></td>
            		    <td align='right'><?php echo $total; ?></td>
                        <td align='center'><?php echo $tgl_pelunasan; ?></td>
                        <td align='center'><?php echo $jns_pembayaran; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                </div>

                			</div>
                			<!-- /content -->

<script>
    $(document).ready(function()
    {
        $('.data').DataTable();
    });

</script>