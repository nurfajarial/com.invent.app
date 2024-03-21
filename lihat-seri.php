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

echo 
"
<div align='center'>
    <h3><b>Daftar Seri</b></h3>    
</div>
<br />
<input class='form-control' id='myInput' type='text' placeholder='Cari..' onkeyup='myFunction()'>
<br />";

$query = mysqli_query($buka, "SELECT * FROM seri_barang ");
while ($data = mysqli_fetch_array($query))
{
    $kode_seri = $data["kode_seri"];
    echo "
    <form>
        <div id='myList' class='list-group' >
            <div class='list-group-item'>
                <h4 class='list-group-item-heading'>".$data['kode_seri']."</h4>
                <table class='table-striped' width='100%'>
                    <tr>
                        <td>
                            <span class='list-group-item-text' id='subjectName' >
                                Nama        : <b>".$data['nama_seri']."</b><br />
                                Keterangan  : <b>".$data['keterangan']."</b><br />
                            </span>
                        </td>
                        <td align='center' width='30%'>
                            <a href='home.php?page=seri-ubah&&kode_seri=".$data['kode_seri']."' class='btn btn-primary'>
                                <i class='glyphicon glyphicon-list'></i>
                            </a>&nbsp;
                            <a href='#' class='btn btn-danger btn-icon-split' data-toggle='modal' data-target='#deleteModal'>
                                <i class='glyphicon glyphicon-remove'></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>";
}


echo "
<div id='deleteModal' class='modal fade' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Yakin dihapus?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            <div class='modal-body'>Pilih 'Hapus' untuk menghapus</div>
            <div class='modal-footer'>
                <div align='center'>
                    <button class='btn btn-secondary' type='button' data-dismiss='modal'>Batal</button>
                    <a class='btn btn-primary' href='home.php?page=seri-hapus&&kode_seri=".$kode_seri."'>Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>";
?>

<div class='modal fade' id='modalTambah' tabindex='-1' role='dialog' aria-labelledby='modalTambah' aria-hidden='true'>
	<div class='modal-dialog' role='document'>
		<div class='modal-content'>
			<form id='formTambah'>
			<div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>				
                <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-edit'></i><b>Input Data Merk</b></h5>				
			</div>
			<div class='modal-body'>
				<div class='form-group'>
					<label>Kode :</label>
					<input type='text' id='txt_kode_merk' name='txt_kode_merk' class='form-control' placeholder='...Angka...' />
				</div>
				<div class='form-group'>
					<span id='pesan1'></span>
				</div>
				<div class='form-group'>
					<label>Nama :</label>
					<input type='text' id='txt_nama_merk' name='txt_nama_merk' class='form-control' placeholder='...Merk...' />
				</div>
				<div class='form-group'>
					<span id='pesan2'></span>
				</div>				
				<div class='form-group'>
					<label>Keterangan :</label>
					<textarea id='txt_ket' name='txt_ket' class='form-control' ></textarea>
				</div>
			</div>
			<div class='modal-footer'>
                <button type='button' class='btn btn-info btn-submit' id='btnSimpan'>Simpan</button>
                <button type='button' class='btn btn-secondary btn-reset' data-dismiss='modal'>Batal</button>				
			</div>
			</form>
		</div>
	</div>
</div>

<script src='js/jquery-3.4.1.min.js'></script>
<script>
$(document).ready(function()
{
    $('#myInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#myList div').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) !== -1)
        });
    });

    $('#btnSimpan').click(function()
    {
	    if($('#txt_kode_merk').val()=='')
	    {
	    	$('#txt_kode_merk').focus();
			swal('Peringatan!', 'Kode tidak boleh kosong.', 'Warning');         
	    }
	    else if($('#txt_nama_merk').val()=='')
	    {
	    	$('#txt_nama_merk').focus();
	    	swal('Peringatan!', 'Nama tidak boleh kosong.', 'Warning');
	    }
	    else
	    {
            var kode_merk = $('#txt_kode_merk').val();
            var nama_merk = $('#txt_nama_merk').val();
            var ket = $('#txt_ket').val();

            $.ajax(
            {
            type : 'POST',
            url : 'tambah-merk.php',
            data : 
            {
               kode_merk: kode_merk,
               nama_merk: nama_merk,
               ket: ket,
            },
            success: function(data)
            {
                alert(data);
            }
        }
            /*
	    	var data = $('#formTambah').serialize();

			$.ajax(
			{
                type : 'POST',
                url  : 'tambah-merk.php',
                data : data,
                success: function(result)
                {                          
                	// ketika sukses menyimpan data
                	if (result==='sukses') 
                	{
                        // tutup modal tambah data transaksi
                        $('#modalTambah').modal('hide');
                        // tampilkan pesan sukses simpan data
                        swal("Sukses!", "Data berhasil disimpan.", "success");
                        // tampilkan data transaksi
                        //var table = $('#tabel-transaksi').DataTable(); 
                        //table.ajax.reload( null, false );
                    }
                    else
                    {
                    	$('#modalTambah').modal('hide');
                        // tampilkan pesan gagal simpan data
                        swal("Gagal!", "Data tidak bisa disimpan.", "error");
                    }
                }
            });
            return false;
            */
    });

});
</script>
