<?php 
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

if (isset($_GET['kode_user']))
{
    $kode_user = $_GET['kode_user'];
}
else
{
    die ('Error. No Kode Selected! ');
}

echo
"
<div class='modal-dialog'>
    <div class='modal-content'>
        <div class='modal-header'>
            <div class='card-header' align='center'>
                <h4>Detail User</h4>
            </div>
        </div>
        <div class='modal-body'>
            <div class='card-body' align='center'>";
                include 'config/koneksi.php';
                $query = "SELECT * FROM karyawan JOIN level ON level.kode_level = karyawan.kode_level WHERE kode_user='$kode_user'";
                $sql = mysqli_query($buka, $query);
                $hasil = mysqli_fetch_array($sql, MYSQLI_BOTH);
                $user = $hasil['user'];
                $nama = $hasil['nama_karyawan'];
                $pass = $hasil['temp_pass'];
                $level = $hasil['jenis_level'];
                    
                echo "
                <p>Nama : $nama</p>";
                if($_SESSION["level"] == '1')
                {
                    echo "
                    <p>Username : ".$user."</p>
                    <p>Password : ".$pass."</p>";
                }
                echo "
                <p>Level : $level</p>
            </div>
        </div>
        <div class='modal-footer'>
            <div align='center'>
                <a href='home.php?page=pengguna-ubah&&kode_user=".$kode_user."' class='btn btn-default glyphicon glyphicon-edit'></a>
                <a href='home.php?page=pengguna-lihat' class='btn btn-default glyphicon glyphicon-repeat'></a>
            </div>
        </div>
    </div>
</div>
";
?>
