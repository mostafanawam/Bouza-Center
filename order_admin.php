<?php
	require("databasecon.php");
	

?>
<!DOCTYPE html>
<html lang="en"><!-- Basic -->
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
<title>Order_admin</title> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.btn{transition-duration: 0.4s;background-color:gray;color: white;width:60px;height:30px;}
.btn:hover {background-color:pink; color: white;}	

.date
	{
		width:200px;height:30px;
	}
	
.cmb{transition-duration: 0.4s;background-color:gray;color: white;width:100px;height:30px;}
	
	.topnav {
  overflow: hidden;
  background-color: gray;
}

.topnav a {
  float: left;
  display: block;
  color: whitesmoke;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}
@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}
	
	@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>
</head>
<body>
<div class="topnav" id="myTopnav">
<a class=link href=index.php >Home</a>
<a class=link href=menu_admin.php >Menu </a>
<a class=link href=gallery_admin.php >Gallery   </a>
<a class=link href=order_admin.php>Orders</a>
<!--<a class=link href=sales_admin.php>Sales</a>-->
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>

	</div>
	<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
	
<div class=main>
<form method=post>

<?php

	  $sql="select * from customer" ;
        $res=mysqli_query($link,$sql);
		$today = (new DateTime())->setTime(0,0);
		$date1=$today->format('Y-m-d H:i:s');
		$date2=date('Y-m-d H:i:s');
	
if(isset($_POST['datefrom'])) $date1=$_POST['datefrom'];
 else  {$today = (new DateTime())->setTime(0,0);$date1=$today->format('Y-m-d H:i:s');}
if(isset($_POST['dateTo'])) $date2=$_POST['dateTo'];else $date2=date('Y-m-d H:i:s');
	
	  if(isset($_POST['cmbFilter'])) $type  =$_POST['cmbFilter']; else $type='Date';
	  if(isset($_POST['txtfilter'])) $filter=$_POST['txtfilter']; else $filter="";
	
if(isset($_POST['btnFilter']))
	{	
	   if(isset($_POST['datefrom'])) $date1=$_POST['datefrom']; else $date1="";
	    if(isset($_POST['dateTo'])) $date2=$_POST['dateTo']; else $date2="";
	 if($type=='Date')
	 {
		 
		$sql="select * from customer where (Date between '".$date1."' AND '".$date2."')" ;
		$res=mysqli_query($link,$sql);
	 }
	else if($type=='Flavor')
	{
		if($date1=="" && $date2=="" )
		{
			$sql="select * from customer where flavor='$filter'";
		}
		else $sql="select * from customer where flavor='$filter' and (Date between '".$date1."' AND '".$date2."')" ;
		$res=mysqli_query($link,$sql);
	}
	else if($type=='Type')	
	{
		if($date1=="" && $date2=="")
		{
			$sql="select * from customer where type='$filter'";
		}
		else $sql="select * from customer where type='$filter' and (Date between '".$date1."' AND '".$date2."')" ;
		$res=mysqli_query($link,$sql);
	}
	}
	
	if(isset($_POST['btnAll']))
	{
		
	    $sql="select * from customer" ;
        $res=mysqli_query($link,$sql);
		$today = (new DateTime())->setTime(0,0);
		$date1=$today->format('Y-m-d H:i:s');
		$date2=date('Y-m-d H:i:s');
	}
	
	 
       /* $sql="select * from customer where (Date between '".$date1."' AND '".$date2."')" ;
		$res=mysqli_query($link,$sql);*/
?>

<div class="container">  
	<center>
                <h3 align="center">Total orders</h3> 
		<select name=cmbFilter class=cmb>
			<option value="<?php echo $type; ?>"> <?php echo $type; ?></option>
			<option>Date</option>
			<option>Flavor</option>
			<option>Type</option>
		</select>
		<input type=text name=txtfilter class=date value="<?php echo $filter;?>" >
		From:<input type=text class=date name=datefrom value="<?php echo $date1;?>" >
             To:  <input type=text class=date name=dateTo value="<?php echo $date2; ?>">
		<input type=submit value=Filter name=btnFilter class=btn>&nbsp;&nbsp;
		<input type=submit value=All name=btnAll class=btn>
		
	</center>
	
				<div class="table-responsive">  
						
                     <table id="employee_data" class="table table-striped table-bordered">  
						 
                          <thead>  
                               <tr>  
                                    <td>ID      </td>  
                                    <td>Date    </td>  
                                    <td>Name    </td>  
                                    <td>Phone   </td>  
                                    <td>Email   </td> 
									<td>Type    </td> 
									<td>Flavor  </td> 
									<td>Quantity</td> 	
									<td>Cost    </td>
                               </tr>  
                          </thead> 
 <tbody>						  
						<?php  
						$totalqty=0;
						$totalprice=0;
                          while($rows = mysqli_fetch_array($res))  
                          {  
					  		  $totalqty+=$rows[7];
                              $totalprice+=	$rows[8];	
                               echo "  
                               <tr>  
                                   <td>".$rows[0]." </td>
								   <td>".$rows[1]." </td>
								   <td>".$rows[2]." </td>
							       <td>".$rows[3]." </td>
								   <td>".$rows[4]." </td>
                                   <td>".$rows[5]." </td>
                                   <td>".$rows[6]." </td>
                                   <td>".$rows[7]." </td> 
								   <td>".$rows[8]." </td> 
                               </tr>  
                               ";
							
                          }  
                          ?> 
						  </tbody>
						  <tfoot style=background-color:#F5F5F5;>
						  <tr>
						    <th>Totals </th>  
                            <th colspan=6></th>  
                            <th><?php echo $totalqty;   ?></th> 
							<th><?php echo $totalprice; ?>$</th>
						  </tr>
						  </tfoot>
                     </table>  
                </div>  
           </div> 

</table>
</div>
<br><br>
</body></html>
 <script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable();  
 });  
 </script>  