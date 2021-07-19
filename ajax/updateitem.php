<?php
  if(isset($_POST['id'])){

    require_once("databasecon.php");

$desc=$_POST ['desc'   ];
$type=$_POST ['type'      ];
$id=$_POST   ['id'     ];
$rank=$_POST ['rank'   ];
$price=$_POST['price'  ];
$photo='dasd.png';


$sql="select * from menu where description='$desc'";
$rows=mysqli_query($link, $sql);
if(mysqli_num_rows($rows)>0){
  $output['unique'] = 'unique';
  $sql="update menu set type='$type',rank=$rank,price=$price,photo='$photo' where id=$id";
  mysqli_query($link, $sql);
  echo json_encode($output);
  return;
}
    $sql="update menu set type='$type',description='$desc',rank=$rank,price=$price,photo='$photo' where id=$id";
    mysqli_query($link, $sql);
    $output = array();
    if(mysqli_affected_rows($link) > 0){
      $output['status'] = 'success';
    }
    echo json_encode($output);
  }
  else
    die("Invalid Parameters");
?>
