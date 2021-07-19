<?php
  if(isset($_POST['name'])){
    require_once("databasecon.php");

$name=$_POST['name'];


$sql="select * from catagory where name='$name'";
$rows=mysqli_query($link, $sql);
if(mysqli_num_rows($rows)>0){
  $output['unique'] = 'unique';

  echo json_encode($output);
  return;
}

    $sql="insert into catagory(name)values('".$name."')";
    mysqli_query($link, $sql);
    $output = array();
    if(mysqli_affected_rows($link) > 0){
      $id = mysqli_insert_id($link);
      $output['row'] = "<tr  id='rowcat_$id'><td data-label='id'>".$id."</td>
        <td data-label='Name'><input type='text' class='form-control' id='cat_".$id."' value='".$name."'></td>
        <td data-label='options'>
        <i class='text-success fas fa-edit' onclick='updatecat(".$id.")' ></i>  
        <i class='text-danger fas fa-trash' onClick='deletecat(".$id.")'></i>

        </td>
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
