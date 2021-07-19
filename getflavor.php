<?php

if(isset($_POST['type'])){
        $type=$_POST['type'];

      require("databasecon.php");

      $sql = "select * from menu where type='$type'";
      $res = mysqli_query($link, $sql);
      
      while($row=mysqli_fetch_array($res)){

          echo"<option value=".$row[2].">".$row[2]."</option>";

        }
}
 ?>
