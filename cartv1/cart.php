<!DOCTYPE html>
<?php
  $currency='$';
require("databasecon.php");
 ?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
			<title>Bouza Center</title>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
				<!-- jQuery library -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<!-- Popper JS -->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
				<!-- Latest compiled JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
				<!-- css sheet -->
				<link rel="stylesheet" href="cart/cart1.css">
					<!-- icons sheet -->
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
						<!-- javascript sheet -->
						<script src="cart/cart.js"></script>
					</head>
					<body>
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<a class="navbar-brand" href="#">Navbar</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav mr-auto">
									<li class="nav-item active">
										<a class="nav-link" href="#">
											<span class="sr-only">(current)</span>
										</a>
									</li>
									<li class="nav-item">
										<a href="#" class="nav-link notification" >
											<span class="fa fa-shopping-cart"></span>
											<span class="badge" id=nbitems >0</span>
										</a>
									</li>
								</ul>
								<form class="form-inline my-2 my-lg-0 ">
									<input id=txtsearch class="form-control mr-sm-2" type="search" placeholder="Search for product" aria-label="Search">
									</form>
								</div>
							</nav>
							<br>
								<br>
                <caption class="text-center">Cart</caption>
                <table border=1  id=mytable>

                  <thead>
                    <tr>
                      <td>description</td>
                      <td>Quantity</td>
                      <td>Unit price</td>
                      <td>Total price</td>
                      <td>&nbsp;</td>
                    </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot>
                    <tr>
                      <td>Total Quantity</td>
                      <td id=totalqty></td>
                      <td >Total price</td>
                      <td id=totalprice></td>
                    </tr>
                  </tfoot>
                </table>



									<div class="container" >
										<div class="row" id="menurow">
											<?php


								$sql="select * from menu order by rank asc";
								$res=mysqli_query($link,$sql);

								while($rows=mysqli_fetch_assoc($res))
								{

									echo"

											<div class='col-lg-3 col-md-3 col-sm-3'>
												<div class=card>
													<div class=overlay>
														<input type='button' onClick=add(".$rows['id'].",'".$rows['description']."',".$rows['price'].")
                            value=+ id='btnadd".$rows['id']."'  name='btnadd".$rows['id']."'
                            class='btn btn-success edit-image-btn pull-right plus'>
														</div>
														<img src   =   'menu/".$rows['photo']."'  >
															<input hidden type='button' onClick=del(".$rows['id'].") value=- id='btndel".$rows['id']."'
                                name='btndel".$rows['id']."' class='btn btn1 btn-danger edit-image-btn'>
																<p class='text-left'>".$rows['description']."</p>
																<p class='text-right price'>".$rows['price']."$currency</p>
															</div>
														</div>";
								}

									 ?>
													</div>
												</div>

											</body>
										</html>
