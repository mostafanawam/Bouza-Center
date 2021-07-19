<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Bouza Hadaya Admin</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

  
<style>

	.list2{position:fixed;top:50%;right:15px;transform:translateY(-50%);padding:0;margin:0;z-index:1;}
.list2 li{list-style:none;}
.link{display:block;text-decoration:none;
height:30px;line-height:30px;font-size:20px;width:140px;margin:4px 0;text-transform:uppercase;}
.link:hover{background-color:gray;color:white;text-decoration:none;}

</style>
</head>
<body>
	<ul class=list2>
<li><a class=link href=menu_admin.php >Menu </a></li>
<li><a class=link href=gallery_admin.php >Gallery   </a></li>
<li><a class=link href=order_admin.php>Orders</a></li>
<li><a class=link href=sales_admin.php>Sales</a></li>
</ul>
<?php
require("databasecon.php");

?>



	<br><br><br><br>