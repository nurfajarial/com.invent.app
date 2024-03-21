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
    <center><h2>LAPORAN DATA STOK AWAL</h2></center>
    <div align="center">
        <button onclick="window.print()">Print</button>
        <a href="export_xls_barang.php"><button>Export</button></a>
    </div><br>
    <div>
        <table class='table table-striped table-bordered data' align='center'>
            <thead>
                <tr bgcolor='#B0C4DE'>
                	<td>Nomor</td>
                    <td>Nama Barang</td>
                    <td>Lokasi</td>
                    <td>Stok Awal</td>
                    <td>Minimal Stok</td>
                	<td>Jumlah Masuk</td>
                    <td>Jumlah Keluar</td>
                	<td>Total</td>
                    <td>Satuan</td>
                </tr>
            </thead>
            <tbody>
                    			<?php
                                include 'config/koneksi.php';
                                $cari = 'select * from stok, barang, satuan WHERE barang.kode_barang=stok.kode_barang and satuan.kode_satuan=stok.kode_satuan';
                                $tampil = mysqli_query($buka, $cari);
                                $nomer=1;
                                while ($hasil = mysqli_fetch_assoc($tampil))
                                {
                                    $no = $hasil['nomor'];
                                    $kode_barang = $hasil['kode_barang'];
                                    $nama_barang = $hasil['nama_barang'];
                                    $kode_lokasi = $hasil['kode_lokasi'];
                                    $nama_lokasi = $hasil['nama_lokasi'];
                                    $stok_awal = $hasil['stok_awal'];
                                    $min_stok = $hasil['min_stok'];
                                    $jumlah_masuk = $hasil['jumlah_masuk'];
                                    $jumlah_keluar = $hasil['jumlah_keluar'];
                                    $total = $hasil['total'];
                                    $satuan = $hasil['nama_satuan'];
                                    //$image = $hasil['gambar'];
                                ?>
                    				<tr>
                    				    <td align='center'><?php echo $no; ?></td>
                  						<td align='center'><?php echo $nama_barang; ?></td>
                  						<td><?php echo $nama_lokasi; ?></td>
                  						<td align='center'><?php echo $stok_awal; ?></td>
                  						<td align='center'><?php echo $min_stok; ?></td>
                                        <td align='center'><?php echo $jumlah_masuk; ?></td>
                  						<td><?php echo $jumlah_keluar; ?></td>
                  						<td align='center'><?php echo $total; ?></td>
                  						<td align='center'><?php echo $satuan; ?></td>
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