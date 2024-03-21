<?php
include 'config/koneksi.php';
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login
if(!isset($_SESSION['user']))
{
        //jika belum login jangan lanjut
	echo "<script>alert('Anda belum login')</script>";
	echo "<script>document.location='index.php'</script>";
}

if (isset($_GET['kode_mutasi_masuk']))
{
    $kode_mutasi_masuk = $_GET['kode_mutasi_masuk'];
}
else
{
    die ('Error. Tidak ada yang dipilih! ');
}

echo "
<form>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <div class='card-header' align='center'>
                    <b><h4>Mutasi Masuk Tunggu</h4></b>
                </div>
            </div>
            <div class='modal-body'>
                <div class='card-body' align='center'>";
                    //Tampilkan data dari tabel mutasi masuk sementara
                    $query = "SELECT * FROM temp_mutasi_masuk JOIN karyawan ON karyawan.kode_user = temp_mutasi_masuk.kode_user WHERE kode_mutasi_masuk = '$kode_mutasi_masuk'";
                    $sql1 = mysqli_query($buka, $query);
                    $ls = mysqli_fetch_array($sql1);
                    
                    echo "
                    <p>Kode Mutasi : ".$ls['kode_mutasi_masuk']."</p>
                    <p>Tanggal : ".$ls['tanggal_mutasi_masuk']."</p>
                    <p>Nama Barang : ".$ls['kode_barang']."</p>
                    <p>Jumlah : ".$ls['jumlah_masuk']."</p>
                    <p>Pengirim : ".$ls['nama_karyawan']."</p>
                    <p>Status :<strong>".$ls['status_masuk']."</strong></p>                  
                </div>
            </div>
            <div class='modal-footer'>
                <div align='center'>
                    <a href='home.php?page=mutasi-masuk-temp-ubah&&kode_mutasi_masuk=".$kode_mutasi_masuk."' class='btn btn-primary'><i class='glyphicon glyphicon-list'></i></a>
                    <a href='#'' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'><i class='glyphicon glyphicon-remove'></i></a>              
                </div>
            </div>
        </div>
    </div>
</form>";

//<!-- Modal Hapus -->
echo "
<div id='deleteModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel' >Yakin dihapus?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>�</span>
                </button>
            </div>
            <div class='modal-body' >Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal' >Batal</button>
                    <a class='btn btn-primary' href='home.php?page=mutasi-masuk-temp-hapus&&kode_mutasi_masuk=".$kode_mutasi_masuk."' >Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
//<!-- End of Modal Hapus -->
?>