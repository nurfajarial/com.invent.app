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

//cek button
if ($_POST['Submit'] == 'Submit') 
{
    //$kd_byr = $_POST['txt_kode_bayar'];
    $hari = $_POST['txt_hari'];
    $ket = $_POST['txt_keterangan'];

    include 'config/koneksi.php';
    $cek = mysqli_query($buka, "SELECT kode_bayar FROM pembayaran WHERE hari = '$hari'");
    $row = mysqli_fetch_array($cek);
    if($row['kode_bayar'] == $kd_byr)
    {
        echo "<script>alert('Kode sudah ada !, silahkan diulang kembali')</script>";
        echo "<script>document.location='home.php?page=pembayaran-tambah'</script>";
    }
    else    
    {
        //Masukan data ke Table
        $input1 = "INSERT INTO pembayaran
        (,
        hari,
        keterangan
        )
        VALUES
        (
        '$hari',
        '$ket'
        )";
        
        $user = $_SESSION['user'];
        $tgl = date('Y-m-d');
        $jam = date('H:i');
        $audit = "INSERT INTO audit_log 
        (
            user, aksi, data_lama, data_baru, tabel, alat, IP, tanggal, jam
        )
        VALUES 
        (
            '$user', 
            'INSERT',
            '',
            '$ket',
            'pembayaran',
            '',
            '',
            '$tgl', 
            '$jam'
        )";

        mysqli_query($buka, $input1);
        mysqli_query($buka, $audit);

        //Jika Sukses
        echo "<script>alert('Data berhasil diinput')</script>";
        echo "<script>document.location='home.php?page=pembayaran-lihat'</script>";
    }

    //tutup koneksi ke database
    mysqli_close($buka);
}
?>