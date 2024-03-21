<?php
if ($_POST['Submit'] == 'Masuk')
{
    session_start();
    include 'config/koneksi.php';
    $user = $_POST['txt_username'];
    $pass = md5($_POST['txt_password']);
    $op = $_GET['op'];

    if($op=='in')
    {
        $sql = mysqli_query($buka, "SELECT * FROM karyawan WHERE user='$user' AND password='$pass'");
        if(mysqli_num_rows($sql)==1)
        {
            //jika berhasil akan bernilai 1
            $qry = mysqli_fetch_array($sql);
            $_SESSION['user'] = $qry['user'];
            $_SESSION['nama'] = $qry['nama_karyawan'];
            $_SESSION['level'] = $qry['kode_level'];
            if(isset($_SESSION['sw']) AND isset($_SESSION['sh']))
            {
                session_unset();
                //session_unset($_SESSION['sh']);
                //echo "<script>alert('Sesi dihapus')</script>";
            }
            else
            {
                $_SESSION['sw'] = "<script>document.write(screen.width);</script>";
                $_SESSION['sh'] = "<script>document.write(screen.height);</script>";
                
                if(isset($_SESSION['alat']))
                {
                    session_unset();
                }
                else
                {
                    if($_SESSION['sh'] <= 780)
                    {
                        $_SESSION['alat'] = 'mobile';
                    }
                    else
                    {
                        $_SESSION['alat'] = 'computer';
                    }
                }
            }
            
            if($qry['kode_level']=='1' || $qry['kode_level']=='2' || $qry['kode_level']=='3')
            {
                echo "<script>document.location='home.php'</script>";
                include 'audit/log-in.php';
            }
        }
        else
        {
            echo "<script>alert('Username atau Password tidak sesuai. Silahkan diulang kembali!')</script>";
            echo "<script>document.location='index.php'</script>";
        }
    }
    
    else if($op=='out')
    {
        unset($_SESSION['user']);
        unset($_SESSION['level']);
        unset($_SESSION['alat']);
        header('location:index.php');
    }
    
}
?>