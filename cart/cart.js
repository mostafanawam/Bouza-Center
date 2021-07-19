function addtocart(id) {
    var x=$('#txtqty_'+id).val();
      if(isNaN(x))
      {alert("Only Numeric accepted")
      $('#txtqty_'+id).val(1);}
      else{
  $.ajax({
    url: "fillcart.php",
    type: "post",
    data: {
      id:id,
      quantity:$('#txtqty_'+id).val()

    },
    success: function(output) { //result of the page searchmenu.php

     var out = JSON.parse(output);

     if(out['status']=='alreadyexist')
    {
      alert("exist");
    }

    else  if(out['status'] == 'success'){
          $("#table_cart").append(out['row']);
          $("#totalqty").html(out['qty']);
          $("#badge").html(out['qty']);
          $("#totalprice").html(out['price']);
          $('#txtqty_'+id).val(1);
            }
            else if(out['status'] == 'failed') alert("error");
    }
  });
}
}

function add(id) {
var c = parseInt(document.getElementById('txtqty_'+id).value);
c++;
document.getElementById('txtqty_'+id).value = c;
}
function sub(id) {
var c = parseInt(document.getElementById('txtqty_'+id).value);
c--;
if(c==0)
c=1;
document.getElementById('txtqty_'+id).value = c;
}



function openNav() {
  document.getElementById("mySidenav").style.width = "100%";
  //document.body.style.backgroundColor = "rgba(0,0,0,0)";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  //document.getElementById("main").style.marginLeft= "0";

}
