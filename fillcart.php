<?php
  if(isset($_POST['id'])){
    require_once("databasecon.php");

    $id  = $_POST ['id'];
    $qty  = $_POST ['quantity' ];


     $sql="select * from menu where id=$id";
     $res=mysqli_query($link,$sql);

     while($rows=mysqli_fetch_assoc($res)){
       $type=$rows['type'];
       $desc=$rows['description'];
       $price=$rows['price'];
        $image=$rows['photo'];
     }
    /* if(mysqli_num_rows($rows)>0){
       $output['unique'] = 'unique';

       echo json_encode($output);
       return;
     }*/

$output = array();

     $sql="select * from cart where proddesc='$desc' and prodtype='$type'";
     $res1=mysqli_query($link,$sql);
     $rowcount=mysqli_num_rows($res1);
     if($rowcount>0){
         $output['status'] = 'alreadyexist';
     }


     $totalprice=$price*$qty;
       $sql="insert into cart(proddesc,prodtype,prodprice,prodimage,qty,totalprice)
             values('$desc','$type',$price,'$image',$qty,$totalprice)";

    mysqli_query($link, $sql);

    if(mysqli_affected_rows($link) > 0){

      $id1 = mysqli_insert_id($link);
      $output['row'] =
      "<tr  id='row_$id'>
        <td><img id='txtphoto_$id' class='cart-item-image' src='menu/$image'>$desc</td>
        <td>$type</td>
        <td>$qty</td>
        <td>$price</td>
        <td>$totalprice</td>
        <td><a href='cart.php?remove=action&id=".$id1."'> <i class='text-danger fa fa-trash' id='btndel'></i></a></td>
      </tr>";
      $output['status'] = 'success';
      $sql="select sum(qty),sum(totalprice) from cart";
      $res=mysqli_query($link,$sql);
      $rows=mysqli_fetch_array($res);
      $output['qty']=$rows[0];
      $output['price']=$rows[1];
    }
    else
      $output['status'] = 'failed';
    echo json_encode($output);
  }
  else
    die("Invalid Parameters");
?>
