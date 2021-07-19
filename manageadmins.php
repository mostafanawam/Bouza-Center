<!DOCTYPE html>
<?php
require("databasecon.php");
 session_start();
if (!isset($_SESSION['nID']))
    header("Location:login.php");
    if(isset($_POST['btnadd'])) {
       $email=$_POST['txtemail'];
$password=password_hash($_POST['txtpass'],PASSWORD_DEFAULT);

$sql="insert into login(username,password)values('$email','$password')";
 $res=mysqli_query($link,$sql);
 if($res==true)
 echo "success";
 else echo "error";
}

 ?>
<html lang="en" dir="ltr">
<head>
  <title>Bouza Center</title>
  

  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
  <body>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Registration new Admin</h3>

			</div>
			<div class="card-body">
				<form method=post>
          <input type="hidden" name="action" value="Registration">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" style="color:purple" class="form-control" placeholder="username" name="txtemail" autocomplete="off">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" style="color:purple" class="form-control" placeholder="password" name="txtpass">
					</div>

					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn" name="btnadd">
					</div>
				</form>
			</div>
			<div class="alert" align=center style="color:purple">

  </div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a style=color:purple; href="#">Sign Up</a>
				</div>

			</div>
		</div>
	</div>
</div>
</body>
</html>
