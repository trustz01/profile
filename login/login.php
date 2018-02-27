<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <p>
</p>
  <div class="container">
   
    
     
    <h2 class="login-title text-center">Sign in to Continue</h2>
    <div class="account-wall">
      <img class="profile-img" src="login.png">
    <form role="form" method="post" class="form-signin">
      
 <label for="username"></label>
 <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required" autofocus>
      
      
 <label for="password"></label>
 <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
      
      <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Login</button>
    </form>
       
      
     
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../assets/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <?php


if(isset($_POST['login'])){
  $mysqli = new mysqli("localhost", "root", "", "magang");

  $username=$_POST['username'];
  $password=$_POST['password'];

  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  }
  $res = $mysqli->query("SELECT * FROM login where username='$username' and password='$password'");
  $row = $res->fetch_assoc();
  $name = $row['name_login'];
  $user = $row['username'];
  $pass = $row['password'];
  $type = $row['level'];

  if($user==$username && $pass=$password){
    session_start();
    if($type=="admin"){
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$type;
      echo "<script>window.location.assign('../admin/admin.php')</script>";
    } else if($type=="user"){
      $_SESSION['mysesi']=$name;
      $_SESSION['mytype']=$type;
      echo "<script>window.location.assign('../user/user.php')</script>";
    } else{
?>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
  <strong>Maaf!</strong> Tidak sesuai dengan type user.
</div>
<?php
    }
  } else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
  <strong>Warning!</strong> Username atau Password tidak sesuai.
</div>
<?php
  }
}
?>


  </body>
</html> 