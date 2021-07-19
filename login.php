
<?php
require("databasecon.php");
$alert="";
if(isset($_POST['txtuser']))
	$username=$_POST['txtuser'];
else $username="";

if(isset($_POST['txtpwd']))
	$pass=$_POST['txtpwd'];
else $pass="";
if(isset($_POST['btnlogin']))
{
$sql="select * from login where username='$username' and password='$pass'";
$res=mysqli_query($link,$sql);
if(mysqli_num_rows($res)>0)
{
session_start();
$_SESSION['nID'] = 1;
header('location:menu_admin.php');
}
$alert="You enter wrong information!!";
}

?>


<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>

	<title>Login Page</title>

	

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="logincss.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>

			</div>
			<div class="card-body">
				<form method=post>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="txtuser" autocomplete="off">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="txtpwd">
					</div>

					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn" name=btnlogin>
					</div>
				</form>
			</div>
			<div class="alert" align=center style="color:purple">
    <?php echo "$alert"; ?>
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
