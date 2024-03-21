<?php
// membaca file koneksi.php
include "config/koneksi.php";

// membaca tabel-tabel yang dipilih dari form
//$tabel = $_POST['tabel'];

$tables = '*';

    //save file
    //header("Content-Disposition: attachment; filename="."backup_".$dbName."_".$tgl[mday]."_".$tgl[mon]."_".$tgl[year].".sql");
    //header("Content-Disposition: attachment; filename=".$nama_simpan.".sql");
    //header("Content-type: application/download");
    //$fp  = fopen($dbName.".sql", 'r');
    //$fp  = fopen($nama_simpan.".sql", 'w+');
    //$content = fread($fp, filesize($dbName.".sql"));
    //fwrite($fp,$return);

//Call the core function
backup_tables($buka, $tables);

//Core function
function backup_tables($buka, $tables = '*') {

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($buka, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($buka, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysqli_query($buka, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($buka, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++)
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    //$fileName = 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
    $folder = "backup"; //Sesuaikan Folder nya
    if(!($buka_folder = opendir($folder))) die ("eRorr... Tidak bisa membuka Folder");
    $tgl = date('dmY_H.i');
    $nama_simpan = "backup_db_invent_".$tgl;
    $fileName = $nama_simpan.'.sql';
    $handle = fopen($folder.'/'.$fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        echo "<script>alert('Done, the file name is: ".$fileName."')</script>";
        echo "<script>document.location='home.php?page=backup-data'</script>";
        exit;
    }
}
?>