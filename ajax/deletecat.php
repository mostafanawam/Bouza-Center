<?php


if(isset($_POST['id']) && isset($_POST['name']) ) {
require_once("databasecon.php");
$id=$_POST['id'];
$ty=$_POST['name'];
$sql="select * from menu where type='$ty'";
$res=mysqli_query($link,$sql);
$nbrows=mysqli_num_rows($res);
 $output = array();
if($nbrows>0)
{
    $output['full'] = 'full';

}
else {
$sql1="delete from catagory where id=$id";
$res1=mysqli_query($link,$sql1);
    if($res1==true)
    {
        $output['status'] = 'success';
    }
    else {
       $output['status'] = 'failed';
    }

}
echo json_encode($output);
}

 ?>
