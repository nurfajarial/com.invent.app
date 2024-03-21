<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

include 'config/koneksi.php';

echo "
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <div class='card-header text-center'>
                <b><h4>Detail Tagihan</h4></b>
            </div>
        </div>
        <div class='modal-body'>
            <div class='card-body'>";
            if(isset($_GET['kode_tagihan']))
            {
                $kd_tagihan = $_GET['kode_tagihan'];
            }
            else
            {
                die('Error. No Kode Selected! ');
            }
            
            //tampilkan data dari tabel tagihan
            $q_tgh = mysqli_query($buka, "SELECT * FROM tagihan JOIN pelanggan ON pelanggan.kode_pelanggan = tagihan.kode_pelanggan JOIN pembayaran ON pembayaran.kode_bayar = tagihan.kode_bayar " );
            while($dt_t = mysqli_fetch_array($q_tgh, MYSQLI_BOTH))
            {
                $kd_tagihan = $dt_t['kode_tagihan'];
                $nm_pelanggan = $dt_t['nama_pelanggan'];
                $kd_byr = $dt_t['kode_bayar'];
                $ket = $dt_t['keterangan'];
                $tgl = $dt_t['tanggal_tagihan'];
                $tgl_temp = $dt_t['tanggal_tempo'];
                $jmlh = $dt_t['jumlah'];
                $t1 = $dt_t['tanggal1'];
                $a1 = $dt_t['angsuran1'];
                $t2 = $dt_t['tanggal2'];
                $a2 = $dt_t['angsuran2'];
                $t3 = $dt_t['tanggal3'];
                $a3 = $dt_t['angsuran3'];
                $t4 = $dt_t['tanggal4'];
                $a4 = $dt_t['angsuran4'];
                $t5 = $dt_t['tanggal5'];
                $a5 = $dt_t['angsuran5'];
                $t6 = $dt_t['tanggal6'];
                $a6 = $dt_t['angsuran6'];
                $sisa = $dt_t['sisa'];
                $sisa1 = $jmlh - ($a1 + $a2 + $a3 + $a4 + $a5 + $a6);
                $status = $dt_t['status'];
                if($sisa1 = 0)
                {
                    $stat = "Lunas";
                    $status = $stat;
                }
                else
                {
                    $stat = "Belum Lunas";
                    $status = $stat;
                }
            }
            
            echo "
                <table align='center'>
                    <tr>
                        <td>Nama</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$nm_pelanggan."</td>
                    </tr>
                    <tr>
                        <td>Cicilan</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$ket."</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$tgl."</td>
                    </tr>
                    <tr>
                        <td>Tempo</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$tgl_temp."</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$jmlh."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 1</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a1."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 2</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a2."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 3</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a3."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 4</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a4."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 5</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a5."</td>
                    </tr>
                    <tr>
                        <td>Angsuran 6</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$a6."</td>
                    </tr>
                    <tr>
                        <td>Sisa</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'>".$sisa."</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td align='right'><b>".$status."</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class='modal-footer'>
            <div align='center'>
                <a href='home.php?page=tagihan-ubah&&kode_tagihan=".$kd_tagihan."' class='btn btn-primary' >Ubah</a>
                <a href='home.php?page=tagihan-lihat' class='btn btn-default' >Cancel</a>
            </div>
        </div>
    </div>
</div>";
