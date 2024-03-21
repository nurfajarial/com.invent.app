<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
//cek apakah user sudah login

include 'config/koneksi.php';
//$_GET['no_sesi'] = $no;
//$_GET['kd_po'];
date_default_timezone_set('Asia/Jakarta');
$x = 'PO';
$y = date('dmY');
$tgl_po = date('Y-m-d');
$a = 0;

include 'config/koneksi.php';
$text_data1 = "SELECT * FROM po_detail_temp ORDER BY tanggal_po DESC";
$text_data2 = "SELECT sesi FROM `po_detail_temp` ORDER BY tanggal_po DESC, sesi DESC LIMIT 1";
//$text_data3 = "SELECT DATE_FORMAT(tanggal_po, '%d-%m-%Y') as tanggal FROM po_detail DESC LIMIT 1";

$proses1 = mysqli_query($buka, $text_data1);
$proses2 = mysqli_query($buka, $text_data2);

$row1 = mysqli_fetch_array($proses1);
$row2 = mysqli_fetch_array($proses2);

echo "
<div class='row'>
    <h3><center>PO Order</center></h3>
        <div class='row'>";

            $total = 0;

            $tgl_data = date($row1['tanggal_po']);
            if($tgl_data != $tgl_po)
            {
                $nomor = 1;
                $z = $nomor;
                $kd_po = $x.'-'.$y.'-'.$z;
            }
            else
            {
                $no = $row2['sesi'];
                $nomor = $no + 1;
                $z = $nomor;
                $kd_po = $x.'-'.$y.'-'.$z;
            }

echo "
<form action='tambah-data-po.php' method='post' name='form-tambah-data-po' enctype='multipart/form-data'>
    <ul class='view-cart' style='list-style: none'>
        <li><hr></li>
        <li>Kode PO <input type='hidden' name='kd_po' value='".$kd_po."' /> : ".$kd_po."</li>
        <li>Tanggal <input type='hidden' name='tgl_po' value='".$tgl_po."' /> : ".$tgl_po."</li>
        <li><input type='hidden' name='sesi' value='".$nomor."' /></li>
    </ul>";

    if(isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"])>0)
    {
        $cart_box = "
        <ul class='view-cart' style='list-style: none'>
            <table class='' align='center'>
                <tr>
                    <td>&nbsp;No&nbsp;</td>
                    <td>&nbsp;Nama Barang&nbsp;</td>
                    <td>&nbsp;Jumlah&nbsp;</td>
                </tr>";
                $idx = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    $a =  $a + 1;
                    $product_id = $values["product_id"];
                    $product_name = $values["product_name"];
                    $product_qty = $values["product_quantity"];
                    $jumlah[] = $product_qty;
                    $total = array_sum($jumlah);
                    $cart_box .= '
                    <li>
                        <tr>
                            <td>&nbsp;'.$a.'&nbsp;<input type="hidden" name="kd_brg[]" value="'.$product_id.'" /></td>
                            <td>
                                <input type="hidden" name="nm_brg[]" value="'.$product_name.'" />&nbsp;'.$product_name.'&nbsp;
                            </td>
                            <td align="center"><input type="hidden" name="jml_brg[]" value="'.$product_qty.'" />&nbsp;'.$product_qty.'&nbsp;</td>
                        </tr>
                    </li>';
                    $text_po .= $product_name.' '.$product_qty.'%3A%0A';
                    $idx++;
                }

                $b = count($jumlah);
                $are = $_SESSION['user'];
                $asd = mysqli_query($buka, "select * from karyawan where user='$are'");
                $dsa = mysqli_fetch_array($asd);

                $cart_box .= "
            </table>
            <li class=\"view-cart-total\"></li>
            <li>&nbsp;</li>
            <li>
                <div align=''>Total pesanan : &nbsp;".$total."</div>
            </li>
            <li>
                <input type='hidden' name='jml_item' value='".$b."' />
            </li>";
            $cart_box .= "
        </ul>";
        echo $cart_box;
        echo "
        <ul class='view-cart' style='list-style: none'>
            <li>
                <div align=''>Kasir : ".$dsa['nama_karyawan']."</div>
            </li>
            <li>
                <div align='center'><u>Terima kasih</u></div>
            </li>
        </ul>";
        echo "
        <div align='center'>
            <input type='Submit' name='Submit' class='btn btn-success' value='Simpan' />
            &nbsp;
            <a class='btn btn-success' onclick='window.print()'>Print</a>
            &nbsp;
            <a href='home.php?page=pesanan-beli' class='btn btn-success'>Kembali</a>
            &nbsp;
            <a href='whatsapp://send?text=".$text_po." class='btn btn-success'>
                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-whatsapp' viewBox='0 0 16 16'>
                        <path d='M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z' />
                </svg>
            </a>
        </div>";
    }
    else
    {
        echo "<script>alert('data masih kosong')</script>";
        echo "<script>document.location='home.php?page=pesanan-beli'</script>";
    }
    echo "
        </div>
    </div>
</form>";


?>