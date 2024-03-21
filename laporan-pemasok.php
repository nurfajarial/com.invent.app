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

                <center><h2>LAPORAN DATA PEMASOK</h2></center>
                <div align="center">
                    <button onclick="window.print()">Print</button>
                    <a href="export_xls_pemasok.php"><button>Export</button></a>
                </div><br>
                <div>
                <table class='table table-striped table-bordered data' align='center'>
                  	<thead>
                   		<tr bgcolor='#B0C4DE'>
                            <td>Kode Pemasok</td>
                            <td>Nama Pemaosk</td>
                            <td>Alamat</td>
                            <td>PIC</td>
                            <td>Email</td>
                            <td>Telp</td>
                      	</tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'config/koneksi.php';
                    $cari = 'select * from pemasok order by kode_pemasok';
                    $tampil = mysqli_query($buka, $cari);
                    $nomer=1;
                    while ($hasil = mysqli_fetch_assoc($tampil))
                    {
                        $kode_pemasok = $hasil['kode_pemasok'];
                        $nama_pemasok = $hasil['nama_pemasok'];
                        $alamat_pemasok = $hasil['alamat_pemasok'];
                        $kontak = $hasil['kontak'];
                        $email =$hasil['email'];
                        $telp = $hasil['telp'];
                    ?>
                    <tr>
            		    <td align='center'><?php echo $kode_pemasok; ?></td>
            		    <td><?php echo $nama_pemasok; ?></td>
                        <td><?php echo $alamat_pemasok; ?></td>
                        <td align='center'><?php echo $kontak; ?></td>
                        <td align='center'><?php echo $email; ?></td>
                        <td align='center'><?php echo $telp; ?></td>
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