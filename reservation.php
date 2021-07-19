<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Site Metas -->
    <title>Bouza Center</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
	<!-- Pickadate CSS -->
    <link rel="stylesheet" href="css/classic.css">
	<link rel="stylesheet" href="css/classic.date.css">
	<link rel="stylesheet" href="css/classic.time.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style media="screen">
	.btnorder{
		color: #cfa671;
		background-color: white;
		border-color:  #cfa671;
	}
	.btnorder:hover{
		color: white;
		background-color: #cfa671;
	}
	.redalert{
		color: red;
	}
</style>
</head>

<body>
	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-rs-food">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
						<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
						<li class="nav-item"><a class="nav-link" href="reservation.php">
							Reservation</a></li>

								<li class="nav-item">	<a class="nav-link" href="gallery.php">Gallery</a></li>
						<!--<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Blog</a>
							<div class="dropdown-menu" aria-labelledby="dropdown-a">
								<a class="dropdown-item" href="blog.html">blog</a>
								<a class="dropdown-item" href="blog-details.html">blog Single</a>
							</div>
						</li>-->
						<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->

	<!-- Start All Pages -->
	<div class="all-page-title page-breadcrumb">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Reservation</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- End All Pages -->

	<!-- Start Reservation -->
		<div class=main>
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

<?php
require("databasecon.php");
if(isset($_POST['txtName' ]))      $name  =$_POST['txtName' ]; else $name="";
if(isset($_POST['txtEmail']))      $email =$_POST['txtEmail']; else $email="";
if(isset($_POST['txtPhone']))      $phone =$_POST['txtPhone']; else $phone="";
if(isset($_POST ['type'   ]))      $type  =$_POST['type'    ]; else $type="Select Type";
if(isset($_POST['txtQty'  ]))      $qty   =$_POST['txtQty'  ]; else $qty="";
if(isset($_POST['flav'    ]))      $flavor=$_POST['flav'    ]; else $flavor="Select Flavor";
?>
<script>

$(document).ready(function(){
	$("#type").change(function(){//function to get the flavors according to the type

		//send a request in the background (ajax) to the server: getflavor.php
		$.ajax({
							url:"getflavor.php",
							type:"post",
							data:{type:$(this).val()},
							success: function(outputSentByServer){//result of the page getflavor.php

										$("#flav").html(outputSentByServer);

									}
					});
	});
});


</script>
<?php
$cost=0;
	$alertphone="";
	$alertname="";
	$alerttype="";
	$alertflavor="";
	$alertemail="";
	$alertqty="";

	$hidename="hidden";
	$hidephone="hidden";
	$hideemail="hidden";
	$hideqty="hidden";
	$hideflavor="hidden";
	$hidetype="hidden";

$showsuccess="hidden";

if(isset($_POST['flav' ]))
{
$sql1="select * from menu where description='$flavor'";
		$res1=mysqli_query($link,$sql1);
$cost=0;
while($rows1=mysqli_fetch_assoc($res1))
		 {
		$cost=$rows1['price'];
		 }

}

if(isset($_POST['btnOrder']))
{
	if($flavor=="Select Flavor" || $type=="Select Type" || $email=="" || $name="" || $phone=="" || $qty=="")
	{
		if( $phone=="")							 {$alertphone ="Please Fill Your Phone Number"; $hidephone="visible";}
		if($flavor=="Select Flavor") {$alertflavor="Please Select Flavor";					$hideflavor="visible";}
		if ($type=="Select Type") 	 {$alerttype  ="Please Select Type";						$hidetype="visible";}
		if($email=="")							 {$alertemail ="Please Enter Your Email";				$hideemail="visible";}
		if($qty=="")								 {$alertqty   ="Please Enter Quantity";					$hideqty="visible";}
		if($name=="")							   {$alertname  ="Please Enter Your Name"; 			  $hidename="visible";}
	 }
else {
			$cost=$cost*$qty;
	    $date = date('Y-m-d H:i:s');
	    if(isset($_POST['txtName' ]))      $name  =$_POST['txtName' ]; else $name="";

		$sql="insert into customer(Date,name,phone,email,type,flavor,quantity,cost)
		values('$date','$name',$phone,'$email','$type','$flavor',$qty,$cost)";
		$res=mysqli_query($link,$sql);

if($res==true)
{
	//echo "<div id=error>Thank you for ordering!!<br>your order cost:".$cost."$</div>";
	$success="Thank you for ordering!! your order cost:$cost $";
	$showsuccess="visible";
	$name="";
	$type="Select Type";
	$phone="";
	$flavor="Select Flavor";
	$email="";
	$qty="";
}
}
}
?>
<body>

<div id=toggle>
<form name=f1 method=post >
	<br><br>
	<div class=container>

		<div class="form-group">
	 <label for="txtName">Name:</label>
	<input type=text class="form-control" id=txtName placeholder=Name name=txtName value='<?php echo"$name";?>'>
 </div>
 <div class="alert alert-danger" role="alert" <?php echo $hidename; ?>><?php echo "$alertname"; ?></div>


 <div class="form-group">
       <label for="type">Select Type : </label>
	<select name=type id=type   class="form-control" >
<option value="Select Type"><?php echo $type; ?></option>
<?php
$sql = "select * from catagory";
$res=mysqli_query($link,$sql);
while($rows=mysqli_fetch_assoc($res))
{
echo "<option value=".$rows['name'].">".$rows['name']."</option>";
}
?>
</select></div>
<div class="alert alert-danger" role="alert" <?php echo $hidetype; ?> ><?php echo "$alerttype"; ?></div>



<div class="form-group">
<label for="txtPhone">Phone Number:</label>
	<input type=text placeholder=Phone class="form-control"  id=txtPhone name=txtPhone value='<?php echo"$phone";?>'>
</div>
<div class="alert alert-danger" role="alert" <?php echo $hidephone; ?>><?php echo "$alertphone"; ?></div>




<div class="form-group">
<label for="flav">Select Flavor:</label>
<select name=flav id=flav class="form-control">
	<option value="Select Flavor"><?php echo "$flavor"; ?></option></select></div>
<div class="alert alert-danger" role="alert" <?php echo $hideflavor; ?>><?php echo "$alertflavor"; ?></div>


<div class="form-group">
<label for="txtEmail">Email Address:</label>
<input type=email  class="form-control" placeholder=Email id=txtEmail name=txtEmail value='<?php echo"$email";?>' >
</div>
<div class="alert alert-danger" role="alert" <?php echo $hideemail; ?>><?php echo "$alertemail"; ?></div>

<div class="form-group">
<label for="txtQty">Quantity:</label>
<input type=text class="form-control" placeholder=Quantity id=txtQty name=txtQty  value='<?php echo"$qty";?>'>
</div>
<div class="alert alert-danger" role="alert" <?php echo $hideqty; ?>>
<?php echo "$alertqty"; ?>
</div>

<div class="text-center">
<input type=submit class="btn  btn-lg btnorder"  name=btnOrder value="Order">
</div><br>


<div class="text-center  alert alert-success" role="alert" <?php echo "$showsuccess"; ?>>
  <?php echo $success; ?>
</div>
 </div>
</div>
</div>
<!-- End Reservation -->

	<!-- Start Customer Reviews -->
	<div class="customer-reviews-box">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading-title text-center">
						<h2>Customer Reviews</h2>
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 mr-auto ml-auto text-center">
					<div id="reviews" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner mt-4">
							<div class="carousel-item text-center active">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="images/profile-1.jpg" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Paul Mitchel</strong></h5>
								<h6 class="text-dark m-0">Web Developer</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="images/profile-3.jpg" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Steve Fonsi</strong></h5>
								<h6 class="text-dark m-0">Web Designer</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
							<div class="carousel-item text-center">
								<div class="img-box p-1 border rounded-circle m-auto">
									<img class="d-block w-100 rounded-circle" src="images/profile-7.jpg" alt="">
								</div>
								<h5 class="mt-4 mb-0"><strong class="text-warning text-uppercase">Daniel vebar</strong></h5>
								<h6 class="text-dark m-0">Seo Analyst</h6>
								<p class="m-0 pt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Idac bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet.</p>
							</div>
						</div>
						<a class="carousel-control-prev" href="#reviews" role="button" data-slide="prev">
							<i class="fa fa-angle-left" aria-hidden="true"></i>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#reviews" role="button" data-slide="next">
							<i class="fa fa-angle-right" aria-hidden="true"></i>
							<span class="sr-only">Next</span>
						</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Customer Reviews -->


		<!-- Start Contact info -->
	<div class="contact-imfo-box">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<i class="fa fa-volume-control-phone"></i>
					<div class="overflow-hidden">
						<h4>Phone</h4>
						<p class="lead">
							+961 81602936
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-envelope"></i>
					<div class="overflow-hidden">
						<h4>Email</h4>
						<p class="lead">
							bouzacenter@gmail.com
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<i class="fa fa-map-marker"></i>
					<div class="overflow-hidden">
						<h4>Location</h4>
						<p class="lead">
							Lebanon
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact info -->

	<!-- Start Footer -->
	<footer class="footer-area bg-f">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3>About Us</h3>
					<p></p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Opening hours</h3>
					<p><span class="text-color">Monday: </span>2:Am - 8:PM</p>
					<p><span class="text-color">Tue-Wed :</span> 2:Am - 8:PM</p>
					<p><span class="text-color">Thu :</span> 2:Am - 8:PM</p>
					<p><span class="text-color">Fri </span>closed</p>
					<p><span class="text-color">Sat-Sun :</span> 2:Am - 8:PM</p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Contact information</h3>
					<p class="lead">Lebanon</p>
					<p class="lead"><a href="#">+961 81602936</a></p>
					<p><a href="#"> mostafanawam44@gmail.com</a></p>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3>Subscribe</h3>
					<div class="subscribe_form">
						<form class="subscribe_form">
							<input name="EMAIL" id="subs-email" class="form_input" placeholder="Email Address..." type="email">
						    <button type="submit" class="btn btn-lg submit">SUBSCRIBE</button>
							<div class="clearfix"></div>
						</form>
					</div>
					<ul class="list-inline f-social">
						<li class="list-inline-item"><a href="https://www.facebook.com/mostafa.nawam.3"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="company-name">All Rights Reserved. &copy; 2020 <a href="#">Bouza Center</a> Design By :
					<a href="https://www.facebook.com/mostafa.nawam.3">Mostafa Nawam</a></p>
					</div>
				</div>
			</div>
		</div>

	</footer>
	<!-- End Footer -->

	<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

	<!-- ALL JS FILES -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
	<script src="js/jquery.superslides.min.js"></script>
	<script src="js/images-loded.min.js"></script>
	<script src="js/isotope.min.js"></script>
	<script src="js/baguetteBox.min.js"></script>
	<script src="js/picker.js"></script>
	<script src="js/picker.date.js"></script>
	<script src="js/picker.time.js"></script>
	<script src="js/legacy.js"></script>
	<script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
