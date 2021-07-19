<?php
  if(isset($_POST['id'])){
    require_once("databasecon.php");
    $dir="menu";
    $sql="delete from menu where id={$_POST['id']}";

    mysqli_query($link, $sql);
    //$name=$_POST['photo'];
    //unlink("$dir/$name");
    $output = array();
    if(mysqli_affected_rows($link) > 0){
      $output['status'] = 'success';
    }
    else
      $output['status'] = 'failed';
    echo json_encode($output);
  }
  else
    die("Invalid Parameters");
?>
