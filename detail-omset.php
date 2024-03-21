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
                            <div class=' card-header text-center'>
                            <h4>Detail Omset</h4>
                            </div>
                            <div class='card-body text-center'>

                            <?php
		                    include 'config/koneksi.php';
		                    if (isset($_GET['kode_omset']))
		                    {
			                    $kode_omset = $_GET['kode_omset'];
		                    }
		                    else
		                    {
			                    die ('Error. Tidak ada yang dipilih! ');
		                    }
                            //Tampilkan data dari tabel modal
		                    $query = "SELECT * FROM omset WHERE kode_omset='$kode_omset'";
		                    $sql = mysqli_query($buka, $query);
		                    $hasil = mysqli_fetch_array($sql);
		                    $kode_omset = $hasil['kode_omset'];
		                    $tanggal = $hasil['tanggal'];
		                    $bulan = $hasil['bulan'];
		                    $tahun = $hasil['tahun'];
		                    $jumlah = $hasil['jumlah'];
		                    $harga = $hasil['harga'];
		                    ?>
                            <p>Kode Omset : <?= $kode_omset ?></p>
                            <p>Tanggal : <?= $tanggal ?></p>
                            <p>Bulan : <?= $bulan ?></p>
                            <p>Tahun : <?= $tahun ?></p>
                            <p>Jumlah : <?= $jumlah ?></p>
                            <p>Harga : <?= $harga ?></p>
                            <p>
        					<?php
							if($_SESSION['level']=='1' || $_SESSION['level']=='2')
							{
							?>
                	        <a href='home.php?page=omset-ubah&&kode_omset=<?=$kode_omset?>' class='btn btn-primary btn-icon-split'>
                	            Ubah
                	        </a>
                            <a class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                                Hapus
                            </a>
                            <?php
                            }
                            ?>
                            </div>
                            <!-- /end of card content -->
