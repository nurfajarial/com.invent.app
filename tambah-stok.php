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
<br />
<body bgcolor='#EEF2F7'>
<?php
//cek button
if ($_POST['Submit'] == 'Submit')
{

    //$file = $_FILES['image']['name'];

    $kode_barang = $_POST['cmb_barang'];
    $lokasi = $_POST['cmb_lokasi'];
    $stok_awal = $_POST['txt_stok_awal'];
    $min_stok = $_POST['txt_min_stok'];
    $total = $_POST['txt_total'];
    $satuan = $_POST['cmb_satuan'];

    //validasi data jika kosong
    if(empty($_POST['cmb_barang']))
 		{
            echo "<script>alert('Data Harap Dilengkapi')</script>";
            echo "<script>document.location='home.php?page=stok-tambah'</script>";
        }
    else
    {
        //koneksi ke database
        include 'config/koneksi.php';

        $cek = mysqli_query($buka, "SELECT stok_awal FROM stok WHERE kode_barang='$kode_barang' and kode_lokasi='$lokasi'");
        $row = mysqli_fetch_array($cek);
        if($row['stok_awal'] == null)
        {
            //Masukan data ke Table Order

            $input1 = "INSERT INTO stok
            (
            kode_barang,
            kode_lokasi,
            stok_awal,
            min_stok,
            total,
            kode_satuan
            )
            VALUES
            (
            '$kode_barang',
            '$lokasi',
            '$stok_awal',
            '$min_stok',
            '$total',
            '$satuan'
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
                '$kode_barang',
                'stok',
                '',
                '',
                '$tgl', 
                '$jam'
            )";

            mysqli_query($buka, $input1);
            mysqli_query($buka, $audit);

            //Jika Sukses
            echo "<script>alert('Data Stok Barang Berhasil diinput')</script>";
            echo "<script>document.location='home.php?page=stok-lihat'</script>";
        }
        else
        {
            echo "<script>alert('Stok Awal sudah ada !, silahkan diulang kembali')</script>";
            echo "<script>document.location='home.php?page=stok-tambah'</script>";
        }
        //tutup koneksi ke database
        mysqli_close($buka);
    }
}

?>
</body>