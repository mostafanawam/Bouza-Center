<?php
require("databasecon.php");
?>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
 </script>
   <div>
 
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

 <style>
 * {
  box-sizing: border-box;
}
.split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.row1
  {
   background-color: gainsboro;
  }
  .fa-trash
  {
   background-color: red;
   width:20px;height:20px;padding: 3px;
  }

.part2
  {
 right: 0;
  background-color:white;

  }
   table {
            width: 100%;
            margin-top: 0;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #cdcdcd;
        }

        table th,
        table td {
            padding: 5px;
            text-align:center;
        }
  .bt
  {
   margin-top: 10px;
   background-color: mediumblue;
   border-radius:5px;
   height:30px;width: 120px;

  }
  .txt
  {
   width:25px;
  }
  .span
  {
   margin-left:250px;
   font-size: 30px;color:deepskyblue;

  }
  .total
  {
   width:100%; height:50px;top:55%;border:2px solid aqua;padding:5px;color:deepskyblue; font-size: 30px;
  }
  .payment
  {
   right: 0;
   background-color: slategray;
   height:33%;margin: 0;
  }
  .pay
  {
  margin-top: 10px;
   width:120px;
   height:60px;
   background-color: deepskyblue;
   border-radius: 5px;

  }
  .img
  {
   width: 100%;
   height: 150px;
   text-align: center;
    }

.filter-button
{
    font-size: 18px;
   background-color: deepskyblue;
    border-radius: 5px;
    text-align: center;
    color: white;
    margin-bottom:5px;

}
  .cen
  {
   text-align: center;
   font-size: 15px;
   text-decoration: underline;
  font-weight: bold;
  }
.filter-button:hover
{
    font-size: 18px;

    border-radius: 5px;
    text-align: center;
    color:  deepskyblue;
    background-color: white;

}
.btn-default:active .filter-button:active
{
    background-color: #42B32F;
    color: white;
}

.port-image
{
    width:50%;
}

 </style>
 </head>
<script>
 var qty=1;
function get(desc,price)
 {
  frm.txtprice.value=price;
  frm.txtdesc.value=desc;

 }
    var sum=0;
 function getsum()
 {
  sum=0;
     var table = document.getElementById("mytable");

           for (var i = 1;i<table.rows.length; i++)
           {
            sum=sum+parseInt(table.rows[i].cells[3].innerHTML);
           }
         document.getElementById("span").innerHTML=sum;
 }
 function getqty()
 {
  var rowsnb=document.getElementById("mytable").rows.length-1;
     var totalqty=0;
            for (var i = 1; i<=rowsnb ; i++)
          {
           totalqty+=  parseInt(document.getElementById("qty"+i).value);
          }
         document.getElementById("totalqty").innerHTML=totalqty;
 }
function productDelete(ctl)
 {
    document.getElementById("row"+ctl+"").remove();
  getsum();
      var nbrows=document.getElementById("mytable").rows.length-1;
         document.getElementById("totalitems").innerHTML=nbrows;
}
function changeqty(ctl,pr)
 {
  qty1=document.getElementById("qty"+ctl+"").value;
 document.getElementById("price"+ctl+"").innerHTML=pr*qty1;
  getsum();

 }

    $(document).ready(function(){
        $(".img").click(function(){
            var desc = $("#txtdesc").val();
            var price = $("#txtprice").val();
          var length = document.getElementById("mytable").rows.length;
            var markup = "<tr id='row"+length+"'><td>"+desc+"</td><td>" +price + "</td><td><input class=txt type=text name=qtytxt id='qty"+length+"' onchange=changeqty("+length+","+price+"); value="+qty+">&nbsp;&nbsp;<i class='fa fa-trash' onclick='productDelete("+length+");'></i></td><td id='price"+length+"'>"+price*qty+"</td></tr>";

            $("#mytable tbody").append(markup);

            getsum();
            var nbrows=document.getElementById("mytable").rows.length-1;
            document.getElementById("totalitems").innerHTML=nbrows;
         getqty();

        });


    });
</script>


 <body>

 <div class="split row1">
 <div align="center">
            <button class="btn btn-default filter-button" data-filter="all">All</button>

    <?php
  $sql = "select * from catagory";
$res =  mysqli_query($link,$sql);
    while($rows=mysqli_fetch_assoc($res)){
    echo"<button class='btn btn-default filter-button' data-filter='".$rows['name']."'>".$rows['name']."</button>";

    }
  ?>
  </div>
  <div class="row">
  <?php
  $sql = "select * from menu order by rank" ;
$res =  mysqli_query($link,$sql);
  while($rows=mysqli_fetch_assoc($res))
{
    echo"<div class='gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter ".$rows['type']."'>
      <img id=photo onclick=get('".$rows['description']."',".$rows['price'].");  src='menu/".$rows['photo']."' class='img' ><p class=cen>".$rows['description']." ".$rows['price']."$</p></img></div>";

  }
 ?>
 </div>
   </div>
  <script>
$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');

        if(value == "all")
        {

            $('.filter').show('1000');
        }
        else
        {

            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');

        }
    });

    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>

 <div class='split part2'>
      <form name=frm>
       <input type="text" id="txtdesc"  name="txtdesc"  placeholder="Description" class=desc hidden>
        <input type="text" id="txtprice" hidden name=txtprice placeholder="Price" class=price>


    </form>
   <div style="width:100%; height:55%; overflow:auto;">
<table class=tb id=mytable>
        <thead>
            <tr>
                <th>Product</th>
              <th>Unit Price</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
      <tbody>

        </tbody>

</table>

  </div>
  <div class=total id=total>
   Total:<span id=totalitems>0</span><!-- total items-->
   <span id=totalqty>0</span><!-- total quantities-->
        <span class=span id=span>0</span><!-- total price-->
  </div>
  <hr>
  <div id=payment  class=payment>Customer:<select class=bt id=customer name=customer><option>Cash</option><option>Credit Card</option>  </select>

   <br>

   <input type=button onclick="inv();" value="Payment" class=Pay name=btnPay></div>
 </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>

  function inv()
   {

   var cust= document.getElementById("customer").value;
    alert("Customer:"+cust+"\ntotal price:"+sum);
     var  length = document.getElementById("mytable").rows.length;
     for (var i = 1; i<length ; i++)
      {
       document.getElementById("row"+i+"").remove();
      }

    document.getElementById("totalitems").innerHTML=0;
     document.getElementById("span").innerHTML=0;


   }



  </script>
 </body></html>
