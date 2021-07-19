<?php

      if(isset($_POST['id']))
        {
          require_once("databasecon.php");
          $name=$_POST ['name'];
          $id=$_POST ['id'];

          $sql="select * from catagory where name='$name'";
          $rows=mysqli_query($link, $sql);
          if(mysqli_num_rows($rows)>0){
            $output['unique'] = 'unique';
            echo json_encode($output);
            return;
          }

            $sql="update catagory set name='$name' where id=$id";
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
