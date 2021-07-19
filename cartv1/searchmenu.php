<?php
$currency='$';

require("databasecon.php");
echo "<script src='cart.js'></script>";
  if(isset($_GET['name'])){
    $name = $_GET['name'];

    if($name==""){
      $sql="select * from menu order by rank asc";
      $res=mysqli_query($link,$sql);

      while($rows=mysqli_fetch_assoc($res))
      {

        echo"
            <div class='col-lg-3 col-md-3 col-sm-3'>
              <div class=card>
                <div class=overlay>
                  <input type='button' onClick=add(".$rows['id'].",'".$rows['description']."',".$rows['price'].")
                  value=+ id='btnadd".$rows['id']."'  name='btnadd".$rows['id']."'
                  class='btn btn-success edit-image-btn pull-right plus'>
                  </div>
                  <img src   =   'menu/".$rows['photo']."'  >
                    <input hidden type='button' onClick=del(".$rows['id'].") value=- id='btndel".$rows['id']."'
                      name='btndel".$rows['id']."' class='btn btn1 btn-danger edit-image-btn'>
                    <p class='text-left'>".$rows['description']."</p>
                    <p class='text-right price'>".$rows['price']."$currency</p>

                    </div>
                  </div>";
      }

    }
else{
    $sql="select * from menu  WHERE description LIKE '$name%' order by rank asc";
    $res=mysqli_query($link,$sql);

    while($rows=mysqli_fetch_assoc($res))
    {

      echo"
          <div class='col-lg-3 col-md-3 col-sm-3'>
            <div class=card>
              <div class=overlay>
                <input type='button' onClick=add(".$rows['id'].",'".$rows['description']."',".$rows['price'].")
                value=+ id='btnadd".$rows['id']."'  name='btnadd".$rows['id']."'
                class='btn btn-success edit-image-btn pull-right plus'>
                </div>
                <img src   =   'menu/".$rows['photo']."'  >
                  <input hidden type='button' onClick=del(".$rows['id'].") value=- id='btndel".$rows['id']."'
                    name='btndel".$rows['id']."' class='btn btn1 btn-danger edit-image-btn'>
                  <p class='text-left'>".$rows['description']."</p>
                  <p class='text-right price'>".$rows['price']."$currency</p>

                  </div>
                </div>";
    }
}

}

?>
