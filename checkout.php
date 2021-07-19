<!DOCTYPE html>
<?php
session_start();
if(!$_SESSION['qty'])
header("location:cart.php");
 require_once 'databasecon.php';

 if(isset($_POST['btnplace'])){
 $desc=$_POST['products'];
 $price=$_POST['grand_total'];
 $name=$_POST['name'];
 $email=$_POST['email'];
 $phone=$_POST['phone'];
 $address=$_POST['address'];

 $sql="insert into orders(description,price,name,email,phone,address)
  values ('".$desc."',".$price.",'".$name."','".$email."','".$phone."','".$address."')";

 mysqli_query($link, $sql);
 if(mysqli_affected_rows($link) > 0){
   $sql="delete from cart";
   mysqli_query($link, $sql);
   $desc='';$price='';$name='';$email='';$phone='';$address='';
   session_start();
   $_SESSION['succ']=1;
   header('location:successorder.php');

 }
 else {
   echo "error";
 }
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
  </head>
  <body>
<style media="screen">
.notification {
font-size: 30px;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}
.notification .badge {
  position: absolute;
  top: -3px;
  right: -12px;
  padding: 5px 10px;
  border-radius: 50%;
  font-size: 25px;
}
</style>
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
            <a  href=cart.php class="nav-link notification" onclick="openNav()" >
              <span class="fa fa-shopping-cart"></span>
              <span class="badge" id=badge >
                <?php
                $sql='select sum(qty)from cart';
                $res=mysqli_query($link,$sql);
                $rows=mysqli_fetch_array($res);
                $qty=$rows[0];
                echo "$qty";
                 ?>

              </span>
            </a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ">
          <input id=txtsearch class="form-control mr-sm-2" type="search" placeholder="Search for product" aria-label="Search">
          </form>
        </div>
      </nav>









<div class="container" id="main">

<div class="row justify-content-center">
<div class="col-lg-6 px-4 pb-4" id="showOrder">

  <h3 class="text-center text-info p-2">Complete your order!</h3>
  <div class="jumbotron p-3 mb-2 text-center">
    <h6 class="load"><b>Product(s) :</b></h6>
    <?php
    $sql="select * from cart";
   $res=mysqli_query($link,$sql);
   $products='';
   echo "<ol >";
     while($rows=mysqli_fetch_assoc($res)){
       $products=$products.$rows['proddesc']."(".$rows['qty']."),";
       echo "<li>".$rows['proddesc']."(".$rows['qty'].")</li>";
     }
     echo "</ol>";
     ?>

    <h6 class="lead"><b>Delivery Charge : </b>5000</h6>
    <h5><b>Total Amount Payable :</b> </h5>
    <?php   $sql="select sum(totalprice) from cart";
     $res=mysqli_query($link,$sql);
     $rows=mysqli_fetch_array($res);
     $totalprice=$rows[0]+5000;
     echo $totalprice;
     ?>
  </div>

  <form method="post" id="placeOrder">

    <input type="hidden" name="products" value="<?php echo $products; ?>">
    <input type="hidden" name="grand_total" value="<?php echo $totalprice; ?>">

    <div class="form-group">
      <input type="text" name="name" class="form-control" placeholder="enter name" required>
    </div>

    <div class="form-group">
      <input type="email" name="email" class="form-control" placeholder="enter email" required>
    </div>

    <div class="form-group">
      <input type="tel" name="phone" class="form-control" placeholder="enter phone" required>
    </div>

    <div class="form-group">
      <textarea name="address" class="form-control" rows="3" cols="10" placeholder="enter address" required></textarea>
    </div>

  <!--  <h6 class="text-center lead">Select Payment Mode</h6>
    <div class="form-group">
      <select name="pmode" class="form-control" required>
        <option value="">-- select payment --</option>
        <option value="cod">Cash On Delivery</option>
        <option value="netbanking">Net Banking</option>
        <option value="card">Debit/credit Card</option>
      </select>
    </div>-->

    <div class="form-group">
      <input type="submit" name="btnplace" class="btn btn-danger btn-block" value="Place Order">
    </div>
  </form>
</div>
</div>

</div>








  </body>
</html>
