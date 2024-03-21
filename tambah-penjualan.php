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

if ($_POST['Submit'] == 'Submit') 
{
    //kirimkan variabel
    $nomor = 0;
    $kd_jual = $_POST['txt_kd_jual'];
    $kd_faktur = $_POST['txt_kd_faktur'];
    $kd_cust1 = $_POST['cmb_pelanggan']; 
    $kd_cust2 = $_POST['txt_pelanggan'];
    $tgl_jual = $_POST['txt_tgl_jual'];
    $kd_do = $_POST['txt_kd_do'];
    $kd_po = $_POST['txt_kd_po'];
    $jml = $_POST['txt_jml'];
    $dis = $_POST['txt_dis'];
    $ttl_hrg = $_POST['txt_ttl_hrg'];
    $byr = $_POST['txt_bayar'];
    $kmbl = $_POST['txt_kembali'];
    $kd_user = $_POST['txt_user'];
    $kd_byr = $_POST['cmb_bayar'];
    $tmp = $_POST['txt_tempo'];

    include 'config/koneksi.php';
    //cek Data di database
    $cek = mysqli_query($buka, "SELECT kode_jual FROM penjualan WHERE kode_jual='$_POST[txt_kd_jual]'");
    $row = mysqli_fetch_array($cek);
    if($row['kode_jual'] == null)
    {

        //Masukan data ke Table Penjualan
        $input = "INSERT INTO penjualan
        (
            kode_jual,
            kode_faktur,            
            kode_pelanggan,
            tanggal_jual,
            kode_do,            
            kode_po,
            jumlah,
            diskon,
            total_harga,
            bayar,
            kembalian,
            kode_user,
            kode_bayar,
            tanggal_tempo
        )
        VALUES
        (
            '$kd_jual',
            '$kd_faktur',
            '$kd_cust1 $kd_cust2',
            '$tgl_jual',
            '$kd_do',
            '$kd_po',
            '$jml',
            '$dis',
            '$ttl_hrg',
            '$byr',
            '$kmbl',
            '$kd_user',
            '$kd_byr',
            '$tmp'   
        )";
        
        //input data ke tabel DO_Detail
        if(!empty($_SESSION["shopping_cart2"]))
        {
            $qry_do = "INSERT INTO do_detail (kode_do, tanggal_do, kode_barang, jumlah_jual, harga, status) VALUES ";

            foreach($_SESSION["shopping_cart2"] as $key => $it)
            {
                $nomor++;

                $tgl = $tgl_jual;
                $kd_brg = $it['product_id'];
                $jml_jual = $it['product_quantity'];
                $hrg = $_POST['cmb_harga'][$key];
                $status = "Terjual";
                $qry_do .= "('".$kd_do."', '".$tgl."', '".$kd_brg."', '".$jml_jual."', '".$hrg."', '".$status."'),"; 
                $qry_do2 = substr($qry_do, 0, strlen($qry_do) - 1);
            }
        }

        //tabel pelanggan
        if($_POST['cmb_pelanggan'] == 'baru')
        {
            $n = 0;
            $qry_cust = mysqli_query($buka, "SELECT * FROM pelanggan");
            while($dt2 = mysqli_fetch_array($qry_cust))
            {
                $n++;
                if($dt2['kode_pelanggan'] == null)
                {
                    //$angka = 0;
                    $kd_cust = $dt2['kode_pelanggan'];
                    $kode1 = substr($kd_cust, 6, 1);
                    $angka = 1;

                    $o_kd_cust = 'CUST-0'.$angka;

                }
                else
                {
                    $kd_cust = $dt2['kode_pelanggan'];
                    $kode2 = substr($kd_cust, 6, 1);
                    $new_kd = $kode2 + 1;
                    $n_kd_cust = 'CUST-0'.$new_kd;
                }

                //input ke tabel Pelanggan
                $inp_cust = 
                "
                INSERT INTO pelanggan (kode_pelanggan, nama_pelanggan, npwp, alamat_pelanggan, alamat_pengiriman, alamat_penagihan, telp, hp1, hp2, fax, email) VALUES ('$o_kd_cust $n_kd_cust', '$kd_cust2', '', '', '', '', '', '', '', '', '')
                ";
            }
        }


        //jika sukses
        mysqli_query($buka, $input);
        mysqli_query($buka, $qry_do2);
        mysqli_query($buka, $inp_cust);
        unset($_SESSION["shopping_cart2"]);
        //echo $input."<br />".$qry_do2."<br />";
        //echo $inp_cust;
        echo "<script>alert('Data Berhasil diinput')</script>";
        echo "<script>document.location='home.php'</script>";
    }
    else
    {
        echo "<script>alert('Kode sudah dipakai !, silahkan diulang kembali')</script>";
        echo "<script>document.location='home.php?page=penjualan-tambah'</script>";
    }
    //Tutup koneksi engine MySQL
    mysqli_close($buka);
}
?>