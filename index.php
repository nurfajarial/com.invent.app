<?php 
error_reporting (E_ALL ^ E_NOTICE);
if(isset($_SESSION['user']))
{
    echo "<script>document.location='home.php'</script>";
}

require_once('config/functions.php');

?>
<!doctype html>
<html lang='en'>
<head>
    <title>SIM Stok Barang</title>
    <meta charset='utf-8'>
   	<meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <link rel='stylesheet' type='text/css' href='css/jquery-ui.css'>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/signin.css">    
    <link rel="shortcut icon" href="favicon.ico" >
</head>

<body>
<div class="container">
  <form class="form-signin" action='login.php?op=in' method='post' enctype='multipart/form-data'>
    <h2 class="form-signin-heading">Silahkan masuk</h2>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" name="txt_username" class="form-control" placeholder="Username" required="" autofocus="ON" autocomplete="OFF">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="txt_password" class="form-control" placeholder="Password" required="" autocomplete="OFF">
      <input class="btn btn-lg btn-primary btn-block" type="submit" id="Submit" name="Submit" value="Masuk" />
    </form>

</div>
</body>
<script src='js/jquery-3.4.1.min.js'></script>
<script src='js/bootstrap.min.js'></script>
<script src='js/jquery-ui.js'></script>    
<script src='model/js/ie10-viewport-bug-workaround.js.download'></script>
<script>
    var sw = screen.width;
    var sh = screen.height;
    <?php $_SESSION['sw'] = sw; ?>
    <?php $_SESSION['sh'] = sh; ?>
</script>
</html>