<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['succ']))
header("location:checkout.php");
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
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="cart.php">Cart</a>
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

          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ">
          <input id=txtsearch class="form-control mr-sm-2" type="search" placeholder="Search for product" aria-label="Search">
          </form>
        </div>
      </nav>




    <div class="container">
    <?php
    require_once 'databasecon.php';
    $last_id = mysqli_insert_id($link);
    $sql="select * from orders  ORDER BY id DESC LIMIT 1;";
    $res=mysqli_query($link,$sql);
    $rows=mysqli_fetch_array($res);
      $products=$rows['description'];
      $name=$rows['name'];
      $phone=$rows['phone'];
      $email=$rows['email'];
      $address=$rows['address'];
      $price=$rows['price'];
    echo "
    <div class='text-center'>
    				<h1 class='text-success'>Thank You!</h1>
    				<h2>Your Order Placed Successfully!</h2>
    				<h4 class='bg-success text-light rounded p-2 text-center'>Items Purchased :<br> $products</h4>
    				<h4>Your Name : $name</h4>
    				<h4>Your E-mail : $email </h4>
    				<h4>Your Phone : $phone  </h4>
            <h4>Your Address : $address  </h4>
    				<h4>Total Amount Paid :$price</h4>
    				<h4>Payment Mode :  Cash On Delivery </h4>
    			</div>";
     ?>
    </div>
  </body>
</html>
