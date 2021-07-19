 <?php
session_start();
if (!isset($_SESSION['nID']))
    header("location:login.php");
 require("databasecon.php");

 ?>

 <!DOCTYPE html>
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


 <!-- Data table -->
 <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

 <style>



 *{margin:0;}
 .ig{width:200px;height: 100px;}
 .im{height:50px;   width: 100%;}/* manage the size of images in dataable */
 #all{width:100%;height:100vh;scroll-behavior: smooth;overflow-y:scroll;}/*all the page*/
 #show {position:relative;width:100%;height:100%;}
 #insert{position:relative;width:100%;height:100%;margin-top: 10%;}
 #cat{position:relative;width:100%;height:100%;}
 #edititem{position:relative;width:100%;height:100%;}
 #editcat{position:relative;width:100%;height:100%;margin-top: 30%;}

 .tableCat{
 width: 100%;
 border-collapse: collapse;
 }

 .tableCat td,.tableCat th{
 padding:12px 15px;
 border:1px solid #ddd;
 text-align: center;
 font-size:16px;
 }

 .tableCat th{
 background-color: gray;
 color:#ffffff;
 }

 .tableCat tbody tr:nth-child(even){
 background-color: #f5f5f5;
 }

 @media screen and (max-width: 600px) {

   .tableCat thead{
   display: none;
}
#insert{
  margin-top: 80%;
}
.tableCat, .tableCat tbody, .tableCat tr, .tableCat td{
   display: block;
   width: 100%;
}
.tableCat tr{
   margin-bottom:15px;
}
.tableCat td{
   text-align: right;
   padding-left: 50%;
   text-align: right;
   position: relative;
}
.tableCat td::before{
   content: attr(data-label);
   position: absolute;
   left:0;
   width: 50%;
   padding-left:15px;
   font-size:15px;
   font-weight: bold;
   text-align: left;
}


 }
     </style>

 </head>

 <body >
 <!--###########################################################################-->
 <!--#####################links to sections#####################################-->
 <!--###########################################################################-->


 <!--###########################################################################-->
 <!--#####################end links#############################################-->
 <!--###########################################################################-->
 <?php

 //###################################################################
 //##################### ADD Catagory ################################
 //###################################################################

 if(isset($_POST['btnAddCat']))
     {
         if(isset($_POST['txtCat'])) $cat   = $_POST['txtCat'];  else $cat="";
         if($cat==""){
             $sql="";
         echo"<script>alert('please fill name of cat');</script>";
         }
         else
         {
          $sql="insert into catagory(name)values('$cat')";
          $res=mysqli_query($link,$sql);
             if($res==true)
     {
         echo"<script>alert('catagory added');</script>";
     }
         }

     }
 //###################################################################
 //#####################end  ADD Catagory ############################
 //###################################################################

 //###################################################################
 //#####################delete Catagory ##############################
 //###################################################################
 if(isset($_GET['DeleteCat']))
 {
 if(isset($_GET['txtNumber'])) {
 $nb=$_GET['txtNumber'];
 $ty=$_GET['cat'];
 $sql="select * from menu where type='$ty'";
 $res=mysqli_query($link,$sql);
 $nbrows=mysqli_num_rows($res);

 if($nbrows>0)
 {
     echo"<script>alert('please empty the items related to this catagory before');</script>";
 }
 else {
 $sql1="delete from catagory where id=$nb";
 $res1=mysqli_query($link,$sql1);
     if($res1==true)
     {
         echo"<script>alert('catagory deleted');</script>";
     }
 }}}
 //###################################################################
 //#####################end delete Catagory ##########################
 //###################################################################


 //###################################################################
 //#####################  delete item from menu ######################
 //###################################################################

 if(isset($_GET['btnDelete']))
 {
   $dir="menu";
  $nb= $_GET['txtNumber'];
  $sql="select * from menu where id=$nb";
 $res=mysqli_query($link,$sql);
  $rows=mysqli_fetch_assoc($res);
  $name=$rows['photo'];
 unlink("$dir/$name");
 $sql="delete from menu where id=$nb";
 $res=mysqli_query($link,$sql);

 }
 //###################################################################
 //#####################  end delete item ############################
 //###################################################################



 //###################################################################
 //##################### EDIT ITEMS###################################
 //###################################################################

     if(isset($_POST['btnUpdate' ]))
     {
     if(isset($_POST['etxtdesc'  ]))     $desc=$_POST ['etxtdesc'   ];   else $desc  ="";
     if(isset($_POST['etype'     ]))     $type=$_POST ['etype'      ];   else $type  ="";
     if(isset($_POST['etxtid'    ]))     $id=$_POST   ['etxtid'     ];   else $id    ="";
     if(isset($_POST['etxtrank'  ]))     $rank=$_POST ['etxtrank'   ];   else $rank  ="";

     if(isset($_POST['etxtprice' ]))     $price=$_POST['etxtprice'  ];   else $price ="";


     if(isset($_POST['etxtphoto' ]))     $photo=$_POST['etxtphoto'  ];   else $photo ="";


     $sql="update menu set type='$type',description='$desc',rank=$rank,price=$price,photo='$photo' where id=$id";
     $res=mysqli_query($link,$sql);

     if($res==true){

     echo "<script>alert('Record updated successfully');</script>";
     }
     else {echo "<script>alert('error in updating'); </script>";}
     }

 //###################################################################
 //##################### end EDIT ITEMS###############################
 //###################################################################


 //###################################################################
 //##################### Update Catagory##############################
 //###################################################################

         if(isset($_POST['btnUpdateCat' ]))
         {
             if(isset($_POST['txtnamecat'  ]))       $name=$_POST ['txtnamecat'   ];   else  $name ="";
             if(isset($_POST['txtidcat'    ]))       $id=$_POST ['txtidcat'     ];   else  $id   ="";

             $sql="update catagory set name='$name' where id=$id";
             $res=mysqli_query($link,$sql);
              if($res==true){echo "<script>alert('Catagory updated successfully');</script>";}
              else {echo "<script>alert('error in updating'); </script>";}
        }


 //###################################################################
 //##################### end EDIT ITEMS###############################
 //###################################################################



 //###################################################################
 //#####################  insert #####################################
 //###################################################################

     if(isset($_POST['btnInsert']))
     {

 if(isset($_POST['type'    ]))      $type  = $_POST ['type'    ];   else $type ="" ;
 if(isset($_POST['txtdesc' ]))      $desc  = $_POST ['txtdesc' ];   else $desc ="" ;
 if(isset($_POST['txtprice']))      $price = $_POST ['txtprice'];   else $price="" ;
 if(isset($_POST['txtPhoto']))      $image = $_POST ['txtPhoto'];   else $image="" ;
 if(isset($_POST['txtRank' ]))      $rank  = $_POST ['txtRank' ];   else $rank =0 ;
 $filename = $_FILES["txtPhoto" ]["name"    ];
 $tempname = $_FILES["txtPhoto" ]["tmp_name"];
 $size     = $_FILES['txtPhoto' ]['size'    ];
 //$folder   = "menu/".$filename;


 if($size>0 && $size<=2097152){


   $sql1="select max(id) from menu";//get the max id
   $res=mysqli_query($link,$sql1);
   $rows=mysqli_fetch_array($res);
   $photonb=$rows[0]+1;//max id +1 to get a unique photoname

   $a = explode('.',$filename);
   $ext=strtolower($a[count($a) - 1]);//get extension of photo
   $nm=strtolower($a[0]);//name of photo without ext
   $photoname=$nm."(".$photonb.").".$ext;//get the full name of the photo("name(id).ext")

   $folder   = "menu/".$photoname;
   $sql="insert into menu(type,description,rank,price,photo)
         values('$type','$desc',$rank,$price,'$photoname')";
         // Execute query
         $succ=mysqli_query($link,$sql);

        if($succ==true)
        {
            copy($tempname, $folder);// Now let's move the uploaded image into the folder:menu
          echo "<script>alert('Description:$desc,Type:$type,Price:$price Added Successfully')</script>";
         }
        else
        {
             echo "<script>alert('Failed to insert item')</script>";
       }

       } else echo"<script>alert('Please enter a compatable file 0<file< 2mb');</script>";//alert if >2mb
       }
 ?>
  <script>
    function validate(val){
       var a = val.value.split(".");
       if(a[a.length-1].toLowerCase() == 'jpg' || a[a.length-1].toLowerCase() == 'png' || a[a.length-1].toLowerCase() == 'gif')
         document.getElementById("btnUpload").disabled =false; //activate the upload button
       else{
         document.getElementById("txtPhoto").value="";
         alert("Please enter a jpg,png,gif image");
       }
     }
   </script>

 <div id=all><!--#####################div of all the page############################-->


 <!--############################################################################-->
 <!--#####################show items section#####################################-->
 <!--############################################################################-->

 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse"  id="navbarNav">
    <ul class="navbar-nav "> <!-- add ml-auto float left-->

      <li class="nav-item dropdown active">
       <a class="nav-link dropdown-toggle" href="menu_admin.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Menu
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
         <a class="dropdown-item" href="menu_admin.php#show">Show All </a>
         <a class="dropdown-item" href="menu_admin.php#insert">Add Items</a>
         <a class="dropdown-item" href="menu_admin.php#cat">Manage Catagories</a>
       </div>
     </li>

      <li class="nav-item">
        <a class="nav-link" href="gallery_admin.php">Gallery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order_admin.php">Orders</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href=sales_admin.php>Sales</a>
      </li>-->

      <!--<li class="nav-item">
        <a class="nav-link" href="textmanage.php">Texts Manging</a>
      </li>-->
    </ul>
  </div>
</nav>


<br><br><br><br>
 <div id=show>
 <div class="container" id=container>
<h1 class="text-center">List Items</h1>
 <br />

 <div class="table-responsive">
   <table id="example" class="table table-striped table-bordered" style="width:100%">

 <thead >
 <tr >  <th>ID</th>  <th>Type</th><th>Description</th>  <th>Rank</th> <th>Price </th> <th>Photo</th> <th>Options</th> </tr>
 </thead>
 <?php
 $sql="select * from menu";
 $res=mysqli_query($link,$sql);
 while($rows = mysqli_fetch_array($res))
 {
 echo"
 <tr style=font-size:30px;>
 <td>".$rows[0]." </td>
 <td>".$rows[1]." </td>
 <td>".$rows[2]." </td>
 <td>".$rows[3]." </td>
 <td>".$rows[4]." </td>
 <td><img class=im src='menu/$rows[5]'></td>
 <td >
 <a href=?Update=mode&id=".$rows['id']."&type=".$rows['type']."&desc=".$rows['description']."&rank=".$rows['rank']."&price=".$rows['price']."&photo=".$rows['photo']."#edititem>
 <input type=button class='btn btn-success' name=btnEdit value=Edit></a>
 <input type=button class='btn btn-danger'  onClick=deleteme(".$rows['id'].") name=Delete value=Delete>
 </td>
 </tr>
 ";
 } ?>
 <!--#####################delete after confirmation############################-->
  <script language="javascript">
  function deleteme(delid)
  {
  if(confirm("Do you want Delete ? ")){
  window.location.href='?btnDelete=ok&txtNumber='+delid+'';
  return true;}}
  </script>
  <!--##################### end delete after confirmation############################-->
 </table>
 </div></div></div>
  <!--############################################################################-->
 <!--##################### end of show items section############################-->
 <!--############################################################################-->


 <!--############################################################################-->
 <!--############################### Add Item ###################################-->
 <!--############################################################################-->
 <div id=insert>
     <div class="container">
 <form name=form2  method=post enctype="multipart/form-data">
     <h1 class="text-center">Add Items</h1>

 <div class="form-group">
 <label for=type>Type:</label>

  <select  name=type id=type class="custom-select" >
      <option value="Select Type">Select Type</option>
      <?php
 //##################### fill combox with catagory####################

         $sql = "select * from catagory";
         $res=mysqli_query($link,$sql);
             while($rows=mysqli_fetch_assoc($res))
             {echo "<option value=".$rows['name'].">".$rows['name']."</option>";}
 //##################### end fill combobox ############################
         ?>
   </select>
 </div>


   <div class="form-group">
   <label for=txtdesc>Description:</label>
   <input type=text placeholder=Description name=txtdesc id=txtdesc class="form-control" >
   </div>


<div class="form-group">
<label for=txtprice>Price:</label>
<input type=text  class="form-control" placeholder=Price name=txtprice id="txtprice">
Photo(size<2MB):
</div>

<div class="custom-file">
 <input class="custom-file-input" type=file name=txtPhoto onchange="validate(this)" id=txtPhoto accept="image/png,image/gif,image/jpg">
 <label  for="txtPhoto" class="custom-file-label">Choose file:</label>
</div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>


<div class="form-group">
<label for="txtRank">Rank:</label>
 <input type=text class="form-control" name=txtRank id="txtRank" placeholder=Rank>
</div>


<div class="text-center">
<input type=submit class="btn btn-primary btn-lg" value=Insert name=btnInsert>
</div>


 </form>
     </div>
     </div>
 <!--############################################################################-->
 <!--############################### end  Add Item ############################-->
 <!--############################################################################-->


 <!--############################################################################-->
 <!--###############################Add catagory ############################-->
 <!--############################################################################-->
 <div id=cat>
 <form method=post>
     <div class="container">

     <h1 class="text-center">Manage Catagories</h1>

         <table class="tableCat">
      <thead>
          <th>Id</th>
          <th>Name</th>
          <th>Options</th>
      </thead>
<?php
 //##################### fill catagory table##########################

 $sql="select * from catagory";

 $res=mysqli_query($link,$sql);
 while($rows=mysqli_fetch_array($res))
 {
 echo"
 <tr>

  <td data-label='id'>".$rows[0]."
 <td data-label='Name'>".$rows[1]."</td>

 <td data-label='options'>
 <a  href=?DeleteCat=ok&txtNumber=".$rows[0]."&cat=".$rows[1]."#cat>

 [DELETE]</a><a href=?EditCat=ok&idcat=".$rows[0]."&namecat=".$rows[1]."#editcat>[EDIT]</a></td></tr>";

 }

 //#####################end fill catagory table#######################
 ?>
         </table>
<br>
<form class="form-inline"  method="post">
<div class="input-group mb-3">
<input type=text   required name=txtCat aria-label="Recipient's username"   id=txtCat placeholder="Add Catagory" class="form-control">
<div class="input-group-append">
  <button class="btn btn-primary" name=btnAddCat   type="submit">Add</button>
</div>
</div>


</form>

  </form></div></div>
 <!--############################################################################-->
 <!--###############################end  Add Catagory############################-->
 <!--############################################################################-->


 <!--############################################################################-->
 <!--############################### Edit items  Div############################-->
 <!--############################################################################-->

 <?php if(isset($_GET['desc'])) $editdesc=$_GET['desc']; else $editdesc="";
 if(isset($_GET['id'])) $editid=$_GET['id']; else $editid="";
 if(isset($_GET['type'])) $edittype=$_GET['type']; else $edittype="";
 if(isset($_GET['price'])) $editprice=$_GET['price']; else $editprice="";
if(isset($_GET['rank'])) $editrank=$_GET['rank']; else $editrank="";
if(isset($_GET['photo'])) $editphoto=$_GET['photo']; else $editphoto="";
   ?>
 <div id=edititem>
     <div class=container>
 <form method=post name=editform enctype="multipart/form-data">
     <h1 class="text-center">Edit Items</h1>


 <div class="form-group">
 <label for="etxtid">ID:	</label>
 <input  type=text readonly name=etxtid id=etxtid value="<?php echo $editid;?>"  class="form-control" >
 </div>


<div class="form-group">
 <label for="etype">Type:</label>
 <select  id=etype name=etype  class="custom-select">
  <option value="<?php echo $edittype;?>"><?php  echo  $edittype;?></option>
 <?php
        $sql = "select * from catagory";
         $res=mysqli_query($link,$sql);
             while($rows=mysqli_fetch_assoc($res))
             {

      echo "<option value=".$rows['name'].">".$rows['name']."</option>";
             }
         ?>
           </select>
          </div>

   <script>
         function getphoto()
         {
             var name=editform.etxtfile.value;var res = name.split("\\"); editform.etxtphoto.value=res[2];
         }
     </script>





<div class="form-group">
<label for="etxtdesc">Description:</label>
<input type=text name=etxtdesc id=etxtdesc value="<?php echo $editdesc;?>" class="form-control" >
</div>

  <div class="form-group">
 <label for="etxtprice">Price:</label>
 <input type=text name=etxtprice class="form-control"  id=etxtprice value="<?php echo $editprice;?>">
 Photo:
</div>

<div class="custom-file">
<label for="etxtfile" class="custom-file-label">File:</label>
 <input type=file name=etxtfile class="custom-file-input" id=etxtfile onchange="getphoto();" accept="image/png,image/gif,image/jpg">


</div>
<img class="ig img-fluid" src='menu/<?php echo $editphoto;?>'/>


  <div class="form-group">
<label for="etxtrank">Rank:</label>
 <input type=text class="form-control" name=etxtrank id=etxtrank  value="<?php echo $editrank;?>">
</div>



<div class="text-center">
<a href=#show><input align=center type=submit value=Update class="btn  btn-primary btn-lg" name=btnUpdate></a>
</div>

 </form>
 </div>
 <!--############################################################################-->
 <!--############################### end Edit  Div############################-->
 <!--############################################################################-->


 <!--############################################################################-->
 <!--############################### Edit  Catagory ############################-->
 <!--############################################################################-->
 <div id=editcat>
     <form method=post name=catedit >
         <div class="container">
             <h1 class="text-center">Edit Catagories</h1>

<?php
if(isset($_GET['idcat']))   $editcatid=$_GET['idcat']; else $editcatid="";
if(isset($_GET['namecat'])) $editcatname=$_GET['namecat']; else $editcatname="";
 ?>
     <div class="form-group">
<label for="txtidcat">ID:</label>
<input class="form-control"  type=text readonly name=txtidcat id=txtidcat value="<?php echo $editcatid?>" >
   </div>

   <div class="form-group">
<label for="txtnamecat">Name:</label>
 <input class="form-control" type=text name=txtnamecat id=txtnamecat value="<?php echo $editcatname?>">
     </div>


     <div class="text-center">
      <a href=#show ><input type=submit value=Update class="btn btn-primary btn-lg" name=btnUpdateCat></a>
     </div>

 </div>
 <!--############################################################################-->
 <!--############################### end Edit  catagory############################-->
 <!--############################################################################-->
     </form>
     </div>

 </body></html>

  <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
