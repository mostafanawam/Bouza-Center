<?php
  if(isset($_POST['photo'])){
    require_once("databasecon.php");

    $type  = $_POST ['type'];
    $desc  = $_POST ['desc' ];
    $price = $_POST ['price'];
     $image =$_POST ['photo'];
     $rank  = $_POST ['rank' ];

     $sql="select * from menu where description='$desc' and type='$type'";
     $rows=mysqli_query($link, $sql);
     if(mysqli_num_rows($rows)>0){
       $output['unique'] = 'unique';

       echo json_encode($output);
       return;
     }
     $dir = "menu";

//  copy($image, "$dir/$image");

       $sql="insert into menu(type,description,rank,price,photo)
             values('$type','$desc',$rank,$price,'$image')";

    mysqli_query($link, $sql);
    $output = array();
    if(mysqli_affected_rows($link) > 0){
      $id = mysqli_insert_id($link);


      $output['row'] = "<tr  id='row_$id'>
        <td>$id</td>
        <td><input class=form-control type='text' id='txttype_$id' value='$type'></td>
        <td><input class=form-control type='text' id='txtdesc_$id' value='$desc'></td>
        <td><input class=form-control type='text' id='txtrank_$id' value='$rank'></td>
        <td><input class=form-control type='text' id='txtprice_$id' value='$price'></td>
        <td><img id='txtphoto_$id' class=im src='menu/$image'></td>
        <td>
        <i class='text-success fas fa-edit' onclick='updateitem($id)' id='btnupdate'></i>
        <i class='text-danger fas fa-trash'   onclick='delitem($id)' id='btndel'></i>

      </tr>";
      $output['status'] = 'success';
    }
    else
      $output['status'] = 'failed';
    echo json_encode($output);
  }
  else
    die("Invalid Parameters");
?>
