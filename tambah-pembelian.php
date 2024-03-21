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
    $kode_beli = $_POST['txt_kode_beli'];
    $kode_faktur = $_POST['txt_kode_faktur'];
    $kode_do = $_POST['txt_kode_do'];
    $kode_pemasok = $_POST['cmb_pemasok'];
    $tanggal_beli = $_POST['txt_tanggal'];
    $kode_po = $_POST['txt_kode_po'];
    $sesi = $_POST['txt_sesi'];
    $kdbrg = $_POST['txt_kdbrg'];
    $qty = $_POST['txt_qtybrg'];
    $harga = $_POST['txt_harga'];
    $jumlah = $_POST['txt_jml_harga'];
    $disc = $_POST['txt_diskon'];
    $pengirim = $_POST['cmb_pengirim'];
    $kd_byr = $_POST['cmb_bayar'];
    $tanggal_tempo = $_POST['txt_tempo'];
    $tempo = date($tanggal_tempo);
    $plat = $_POST['txt_no_plat'];
    $supir = $_POST['txt_nama_supir'];


    $arr_harga = json_encode($harga);
    
    $c_harga = count($harga);
    
    //koneksi ke database
    include 'config/koneksi.php';
    $cek = mysqli_query($buka, "SELECT kode_beli FROM pembelian WHERE kode_beli='$_POST[txt_kode_beli]'");
    $row = mysqli_fetch_array($cek);
    if($row['kode_beli'] == null)
    {
        $cek3= mysqli_query($buka, "SELECT kode_po FROM po_detail WHERE kode_po = '$kode_po'");
        $row3 = mysqli_fetch_array($cek3);
        if($row3['kode_po'] == null)
        {
            echo "<script>alert('Data PO tidak ada')</script>";
            echo "<script>document.location='home.php?page=pembelian-tambah&&kode_po=".$kode_po."&&sesi=".$sesi."'</script>";
        }
        else
        {
            $idx = 0;
            $qry_po = "INSERT INTO po_detail (kode_po, sesi, tanggal_po, kode_barang, jumlah_beli, harga, status) VALUES";
            $qry_m = "INSERT INTO modal (kode_beli, kode_barang, tanggal, harga_beli, tanggal_jual1, harga_jual1, tanggal_jual2, harga_jual2, tanggal_jual3, harga_jual3) VALUES ";

            foreach($kdbrg as $key => $n)
            {
                $idx++;

                //tabel stok                
                $cek_stok = mysqli_query($buka, "SELECT * FROM stok WHERE kode_barang = '$n'");
                $row_s = mysqli_fetch_array($cek_stok);
                if($row_s['kode_barang'] == null)
                {
                    //echo "Kode Barang tidak ada";
                    echo "<script>alert('Stok barang tidak ada')</script>";
                    echo "<script>document.location='home.php?page=pembelian-tambah&&kode_po=".$kode_po."&&sesi=".$sesi."'</script>";
                }
                else
                {
                    $stok_a = $row_s['stok_awal'].[$key];
                    $stok_b = $row_s['total'].[$key];
                    $stok_qty = $qty[$key];
                    $stok_c = $stok_b + $stok_qty;
                    $qry_stok = "UPDATE stok SET total = '$stok_c' WHERE kode_barang = '$n' AND kode_lokasi = '2'";
                    mysqli_query($buka, $qry_stok);
                    //echo $qry_stok.';<br />';

                    //tabel PO
                    $cek3= mysqli_query($buka, "SELECT kode_po FROM po_detail WHERE kode_po = $kode_po");
                    $tglblnthn = substr($kode_po, 3, 8);
                    $thn = substr($tglblnthn, 4, 4);
                    $bln = substr($tglblnthn, 2, 2);
                    $tgl = substr($tglblnthn, 0, 2);
                    $tgl_po = $thn.'-'.$bln.'-'.$tgl;            
                    $qry_po = "UPDATE po_detail SET harga = '".$harga[$key]."', status = 'Order' WHERE kode_po = '".$kode_po."' AND sesi = '".$sesi."' AND kode_barang = '".$n."'";
                    mysqli_query($buka, $qry_po);
                    //echo $qry_po.';<br />';

                    //tabel modal
                    $cek_modal = mysqli_query($buka, "SELECT * FROM modal WHERE tanggal_beli='$tanggal_beli'");
                    //$row2 = mysqli_fetch_array($cek_modal);
                    //date_default_timezone_set('Asia/Jakarta');
                    //$kd_a = date('dmY');
                    //$kd_b = '-';
                    //$kd_c = date('Hi');
                    //$kd_mod = $kd_a.$kd_b.$kd_c;
                    //$jam = date('H:i:s');
                    $qry_m .= "('".$kode_beli."', '".$n."', '".$tanggal_beli."', '".$harga[$key]."', null, '0', null, '0', null, '0'),";       
                }                 
            }
            $qry_m = substr($qry_m, 0, strlen($qry_m) - 1);
            mysqli_query($buka, $qry_m);
            //echo '<p>'.$qry_m.'</p>';

            //tabel hutang
            $kd_sup = substr($kode_pemasok, 0, 2);
            if($kd_byr = 1)
            {
                $ttl_harga = 0;
                $sisa_u = $ttl_harga;
                $stat = 'Lunas';
            }
            else
            {
                $ttl_harga = $_POST['txt_ttl_harga'];
                $sisa_u = $ttl_harga;
                $stat = 'Belum Lunas';
            }
            
            $kd_u = $kd_sup.substr($kode_beli, 0, 8).$kd_byr1;

            $qry_u = "INSERT INTO utang 
            (kode_utang, 
            kode_pemasok, 
            tanggal_hutang, 
            tanggal_tempo, 
            kode_bayar, 
            jumlah, 
            tanggal1, 
            angsuran1, 
            tanggal2, 
            angsuran2, 
            tanggal3, 
            angsuran3, 
            tanggal4, 
            angsuran4, 
            tanggal5, 
            angsuran5, 
            tanggal6, 
            angsuran6, 
            sisa, 
            status) 
            VALUES 
            ('$kd_u', 
            '$kode_pemasok', 
            '$tanggal_beli', 
            '$tempo', 
            '$kd_byr', 
            '$ttl_harga', 
            null, 
            0, 
            null, 
            0, 
            null, 
            0, 
            null, 
            0, 
            null, 
            0, 
            null, 
            0, 
            '$sisa_u', 
            'Belum Lunas')";

            if($kd_byr != 0)
            {
                mysqli_query($buka, $qry_u);
                //echo '<p>'.$qry_u.'</p>';
            }

			//tabel pembelian
            $qry_p = "INSERT INTO pembelian (kode_beli, kode_faktur, kode_do, kode_pemasok, tanggal_beli, kode_po, jumlah, diskon, total, kode_user, kode_bayar, tanggal_tempo, no_plat, nama_supir) VALUES
            ('$kode_beli', '$kode_faktur', '$kode_do', '$kode_pemasok', '$tanggal_beli', '$kode_po', '$jumlah', '$disc', '$ttl_harga', '$pengirim', '$kd_byr', '$tempo', '$plat', '$supir')";
            
            mysqli_query($buka, $qry_p);
            //echo '<p>'.$qry_p.'</p>';            

            //Jika Sukses
            echo "<script>alert('Data tersimpan')</script>";
            echo "<script>document.location='home.php?page=pembelian-lihat&&kode_po=".$kode_po."&&sesi=".$sesi."'</script>";
            
        }

    }
    else
    {
        echo "<script>alert('Kode sudah ada')</script>";
        echo "<script>document.location='home.php?page=pembelian-tambah&&kode_po=".$kode_po."&&sesi=".$sesi."'</script>";
    }    

}
