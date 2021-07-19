<html>

<style>
*{
    margin: 0px;
    padding: 0px;
}
.header { position:absolute;
        top : 0;
		left : 0;
		height:10%;
		width:100%;
		background-color :#2F4F4F;
		color:white;
		text-align:center;
		font-size:25;
}
.menu {position:absolute;
         top:10%;left:0px;
		 width:70%;
		 height:85%;
		 font-size:30;
		 background-color:#DCDCDC;}
.payment {position:absolute;
         top:10%;left:70%;
		 width:30%;
		 height:85%;
		 background-color:white;}
		 
.footer {position:absolute;
         bottom:0px;
		 width:100%;
		 height:5%;
		 color:white;
		 background-color:#2F4F4F;
		 font-size:20;
		 left:0}

.search {
  width: 50%;
  position: relative;
  display: flex;
float: right;
margin-left:70%;
margin-top:10;
}

.searchTerm {
  width:50%;
  border: 3px solid #1E90FF;
  border-right: none;
  padding: 5px;
  height: 36px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
  float: right;
}

.searchTerm:focus{color:#1E90FF;}

.searchButton {
  width: 40px;
  height: 36px;
  border:3px solid #1E90FF;
  background: white;
  text-align: center;
  color:#2F4F4F;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
  float: right;
}
.btn{transition-duration: 0.4s;background-color:#1E90FF;color: white;
 width:100;height:50;font-size:20;border-radius: 5px 5px 5px 5px;} 
.btn:hover { background-color:pink; color: white;}
.catagory{margin-top:14;}
.im
{
	width:100%;height:100%;
}
.icon
{
	width:20;height:30;
}
.total
{
	color:#1E90FF;
	border:3px solid #1E90FF;
	
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:#2F4F4F;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>
<?php
require("databasecon.php");

?>

<title>POS System</title>	
<body>
<div class=header>
<h1 >Bouza Hadaya</h1>
</div>

<!--###############################startt menu div####################################-->
  <div class=menu>
  <form name=fmenu method=get>
  <div class="wrap">
   <div class="search">
     <input type="text" class="searchTerm" placeholder="Search...">
   <button type="submit" class="searchButton">
        
     </button>
	   </div>
</div>
<br>
<div class=catagory>	
<ul>
 			
<?php

//###############################fill catagory####################################

$sql = "select * from catagory" ;
$res =  mysqli_query($link,$sql); 
while($rows=mysqli_fetch_assoc($res))
{     
 echo " <li><a href=?Cat=".$rows['name'].">".$rows['name']."</a></li> ";   
}
echo"</ul>";
//#############################################################################


//###############################fill items####################################

if(isset($_GET['Cat']))
{ 
$cat=$_GET['Cat'];
$sql = "select * from menu where type='$cat'  order by rank" ;
$res =  mysqli_query($link,$sql); 

echo"<table width=600 style=background-color:white;><tr>";
while($rows=mysqli_fetch_assoc($res))
{
	echo "<th> <a href=?desc=".$rows['description']."&price=".$rows['price']."&type=".$rows['type']."><img name=img class=im src='menu/".$rows['photo']."'>".$rows['price']."$</a></th>";
	
}
echo"</tr>";
}
//#################################################################################
?>
</table>
</div>
  </form></div
<!--###############################end menu div####################################-->
  
<!--###############################start payment Div ##############################-->
      <div class=payment >
	  
	  <table width=450 >
	  <tr>
	  <th>Product</th>
	  <th>Quantity</th>
	  <th>Price</th>
	  </tr>
	  <?php
	  $sum=0;
///###############################send info to payment####################################
if(isset($_GET['desc']))
{
$desc=$_GET['desc' ];
$price=$_GET['price'];
$typ  =$_GET['type' ];
echo"<tr><th>".$desc." ".$typ."</th><th>
<input style=width:15;text-align:center; type=text name=txtqty value=1>
</th>";
if(isset($_post['txtqty'])) $qty=$_post['txtqty']; else $qty=1;
$total=$price*$qty;
echo"<th>".$total."</th></tr>";
$sum+=$total;
}
echo"</table>";
//###############################end send info to payment#################################### 

//###############################total price################################################# 
echo"<table width=450 class=total><tr><th colspan=2 align=left>Total</th><th>".$sum."</th></tr></table>";
?>
</div>
<!--###############################end payment div####################################-->
<div class=footer>
footer
</div>

</html>