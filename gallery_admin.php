<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['nID']))
    header("Location:login.php"); ?>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Site Metas -->
    <title>Bouza Center Admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <!-- Popper JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Site Icons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.btn,.btnup
{
  transition-duration: 0.4s;

  width:80px;height:50px;
  border-radius:5px;
}



.row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 25%;
  max-width: 15%;
  padding: 0 4px;
	margin-top: 5px;
}
	*{
		margin: 0 0 0 0;
	}
.column img {
  margin-top: 0px;
  vertical-align: middle;
  width: 100%;
}


/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    flex: 100%;
    max-width: 100%;
	  margin-top: 5px;
  }
	.btn
{position:fixed;top:50%;right:15px;transform:translateY(-50%);padding:0;margin:0;z-index:1;
	}

}
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="index.php">Home</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNav">
     <ul class="navbar-nav">
       <li class="nav-item">
         <a class="nav-link" href="menu_admin.php">Menu <span class="sr-only">(current)</span></a>
       </li>
       <li class="nav-item">
         <a class="nav-link  active" href="gallery_admin.php">Gallery</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="order_admin.php">Orders</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href=sales_admin.php>Sales</a>
       </li>
       <!--<li class="nav-item">
         <a class="nav-link" href="textmanage.php">Texts Manging</a>
       </li>-->
     </ul>
   </div>
 </nav>


<?php
require("databasecon.php");

?>
   <?php
      $dir = "gallery";
      if(isset($_REQUEST['btnUpload'])){
        if(isset($_FILES['txtPhoto']) && $_FILES['txtPhoto']['size'] > 0 && $_FILES['txtPhoto']['size'] <= 2097152)
        {
            $a = explode('.', $_FILES['txtPhoto']['name']);
            if(strtolower($a[count($a) - 1]) == 'jpg' || strtolower($a[count($a) - 1]) == 'png' || strtolower($a[count($a) - 1]) == 'gif' ){
              copy($_FILES['txtPhoto']['tmp_name'], "$dir/{$_FILES['txtPhoto']['name']}");
          }//end if(strtolower..)
        }//end if(isset($_FILES...))
       else echo"<script>alert('Too large file!Please enter file < 2mb');</script>";
      }//end if(isset($_REQUEST...))
      else if(isset($_REQUEST['btnDelete'])){
        $name = basename($_REQUEST['txtPhotoName']);
        unlink("$dir/$name");
      echo" <script>alert('Photo is successfuly deleted');</script>";
      }
    ?>
    <form method='post' enctype="multipart/form-data">
    <div class="row">
      <?php
        $d = opendir($dir); //open the directory images located in the current directory


        //browse the images directory
        while($f = readdir($d)){

          //We accept only the png images
          $a = explode('.', $f);
          //image.1.2.3.png: the extension is in the last case

          if(strtolower($a[count($a) - 1]) == 'jpg' || strtolower($a[count($a) - 1]) == 'png' || strtolower($a[count($a) - 1]) == 'gif' ){

              echo "<div class='column'>
			  <img  src='$dir/$f'
                          class=img onclick='display(this.src)'>";
			  echo"</div>";
			            }//end if
        }//end while

      ?>
		</div>

	<img src="" id="photo" width='300' >

  <input type='submit' class="btn btn-danger" name='btnDelete' value='Delete'>
  <input type='file' name='txtPhoto'  onchange="validate(this)" id="txtPhoto" class=stylefile accept="image/png,image/gif,image/jpg">
  <input type='submit' name='btnUpload' value='Upload' disabled id='btnUpload' class="btnup btn-primary">
  <input type='hidden' name ='txtPhotoName' id ='txtPhotoName'>


  </form>
  <script>
    function display(src){//src: source of the clicked image
      //display the image with width = 300px
      document.getElementById("photo").src = src;
      //store the name of image in order send it to the Server
      //when the delete button is clicked
      document.getElementById("txtPhotoName").value = src;
      //activate the delete button
      document.getElementById("btnDelete").disabled = false;
    }
    function validate(val){
      var a = val.value.split(".");
      if(a[a.length-1].toLowerCase() == 'jpg' || a[a.length-1].toLowerCase() == 'png' ||
         a[a.length-1].toLowerCase() == 'gif'  )
        document.getElementById("btnUpload").disabled =false; //activate the upload button
      else{
        document.getElementById("txtPhoto").value="";
        alert("Please enter a jpg,png,gif images");
      }
    }
  </script>
	</div>
	<br><br>

	</body></html>
