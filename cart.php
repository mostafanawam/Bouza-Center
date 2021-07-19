<!DOCTYPE html>
<?php
require_once 'databasecon.php';

session_start();
if(isset($_GET['remove'])){
  $id=$_GET['id'];
  $sql="delete from cart where id= $id";
  mysqli_query($link, $sql);
}


$sql='select sum(qty),sum(totalprice) from cart';
$res=mysqli_query($link,$sql);
$rows=mysqli_fetch_array($res);
if($rows[0]==0)
$qty=0;
else $qty=$rows[0];
$price=$rows[1];

if(isset($_POST['btnempty'])){
  $sql="delete from cart";
  mysqli_query($link, $sql);
  $qty=0;
  $price=0;
}
if(isset($_POST['btncheck'])){

               $_SESSION['qty']=$qty;
         header("Location:checkout.php");
   }
 ?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
					<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
					<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
						<title>Bouza Center Shop</title>
            <link rel = "icon" href ="https://st.depositphotos.com/1005920/1832/i/950/depositphotos_18323389-stock-photo-shopping-cart-green-glossy-icon.jpg" type = "image/x-icon">
						<link rel="stylesheet" href="cart/cart2.css">
							<script src="cart/cart.js"></script>
						</head>
						<body>

              <!-- #############################################333 -->
              <!-- Start Header -->
              <!-- #############################################333 -->
							<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
								<a class="navbar-brand" href="index.php">Home</a>
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav pull-sm-left">
										<li class="nav-item active">
											<a class="nav-link" href="#">
												<span class="sr-only">(current)</span>
											</a>
										</li>

										<li class="nav-item">
											<a  class="nav-link notification" onclick="openNav()" >
												<span class="fa fa-shopping-cart"></span>
												<span class="badge" id=badge >
													<?php echo "$qty"; ?>
												</span>
											</a>
										</li>

									</ul>
                  <ul class="nav navbar-nav  mx-auto">
                    <li class="nav-item">
                    <h1 class="text-light text-center">Bouza Center Shop</h1>
                    </li>
                  </ul>
									<form class="form-inline my-2 my-lg-0 ">
										<input id=txtsearch class="form-control mr-sm-2" type="search" placeholder="Search for product" aria-label="Search">
										</form>
									</div>
								</nav>
                <!-- #############################################333 -->
                <!-- End Header -->
                <!-- #############################################333 -->



<form  method="post">
<!-- #############################################333 -->
<!-- Start Sidebar -->
<!-- #############################################333 -->
									<div id="mySidenav" class="sidenav text-center ">
<div class="container">
										<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
										<h1 class="text-center" style="color:white">  Shopping Cart</h1>
<br>
											<input type="submit" class="btn btn-danger" style="margin-bottom:10px;" name="btnempty" value="Empty Cart">

											<table class="table table-striped  table-responsive-lg" style="color:white;">
												<thead class="thead-light">
													<tr>
														<th>Product Name</th>
														<th>Product Type</th>
														<th>Quantity</th>
														<th>Unit Price</th>
														<th>Total Price</th>
														<th>Remove</th>
													</tr>
												</thead>
												<tbody id='table_cart'>
													<?php
                                 $sql="select * from cart";
                                $res=mysqli_query($link,$sql);
                                  while($rows=mysqli_fetch_assoc($res)){
                                    echo "
													<tr  id='row_".$rows['id']."'>
														<td>
															<img id='txtphoto_".$rows['id']."' class='cart-item-image' loading='lazy'  src='menu/".$rows['prodimage']."'>".$rows['proddesc']."
															</td>
															<td>".$rows['prodtype']."</td>
															<td>".$rows['qty']."</td>
															<td>".$rows['prodprice']." L.L</td>
															<td>".$rows['totalprice']." L.L</td>
															<td>
																<a href='cart.php?remove=action&id=".$rows['id']."' >
																	<i class='text-danger fa fa-trash'   id='btndel'></i>
																</a>
															</td>
														</tr>";
                                    }

                                    echo "
													</tbody>
													<tfoot >
														<tr>
															<td></td>
															<td>Total Quantity</td>
															<td id=totalqty>$qty</td>
															<td>Total Price</td>
															<td id=totalprice>$price L.L</td>
															<td></td>
														</tr>
													</tfoot>";
                                 ?>
												</table>
												<div class="container">
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                              <button type="button" class="btn btn-block btn-light" onclick=closeNav();>
                                Continue Shopping <i class="fa fa-shopping-cart"></i> </button>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                              	<button type="submit" class="btn btn-block btn-success" name="btncheck">Check Out</button>
                            </div>
                          </div>
												</div>
											</div>
</div>
<!-- #############################################333 -->
<!-- End Sidebar -->
<!-- #############################################333 -->


<!-- #############################################333 -->
<!-- Start Main -->
<!-- #############################################333 -->
											<div class="container" id=main>
												<div class="row">
													<?php
      $sql="select * from menu order by rank asc";
      $res=mysqli_query($link,$sql);

      while($rows=mysqli_fetch_assoc($res))
      {
        echo"
        <div class='col-lg-3 col-md-3 col-sm-3'>

          <div class='card' style=border-radius:15px;>
            <img src   =   'menu/".$rows['photo']."' loading=lazy class='card-img-top' >
            <div class='card-body'>
              <h5 class='card-title'>".$rows['description']."</h5>
              <h6 class='card-subtitle'>".$rows['price']."</h6>
                <p class='card-text'>  <i class='fa fa-minus text-danger t '  onclick='sub(".$rows['id'].")'></i>
                    <input type=text id='txtqty_".$rows['id']."' class='form-control text-center t' name=quantity value='1' size='1' />
                    <i class='fa fa-plus text-success t' onclick='add(".$rows['id'].")' ></i>
                    </p>
                    <div class='text-center'>
                <input type=button onClick='addtocart(".$rows['id'].")' value='Add to Cart' class='btn btncart' /></div>
            </div>
            </div>


          </div>";
      }

         ?>
													</div>
												</div>

                        <!-- #############################################333 -->
                        <!-- End Main -->
                        <!-- #############################################333 -->

											</form>
										</body>
									</html>
