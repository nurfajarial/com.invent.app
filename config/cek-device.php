<?php

if(isset($_SESSION['sw']) AND isset($_SESSION['sh']))
{
    //echo 'User resolution: ' . $_SESSION['sw'] . 'x' . $_SESSION['sh'];
    
}
else if(isset($_REQUEST['width']) AND isset($_REQUEST['height']))
{
    $_SESSION['sw'] = $_REQUEST['width'];
    $_SESSION['sh'] = $_REQUEST['height'];
    header('Location: ' . $_SERVER['PHP_SELF']);
}
else
{
    //echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}
?>