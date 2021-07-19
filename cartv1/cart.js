
function add(id, desc, price) { //function to add to basket
  var length = document.getElementById("mytable").rows.length;

  var markup = "<tr id=row" + length + "><td>" + desc + "</td><td>1</td><td>" + price + "</td><td>" + price + "</td>" +
    "<td><input type=button class='btn btn-danger' value=delete onClick=delfrombasket(" + length + ");></td></tr>";

  $("#mytable tbody").append(markup);

  document.getElementById('nbitems').innerHTML++; //add 1 to basket icon counter
  var val = document.getElementById('btnadd' + id).value; //get the value from the button +
  if (val == "+") {
    document.getElementById('btndel' + id).hidden = false; // if add item the delete button appear
    document.getElementById('btnadd' + id).value = 1; // add 1 if button ==+
  } else
    document.getElementById('btnadd' + id).value++; //increment the nb of items on the button




}

function del(id) { // function to delete from the basket
  document.getElementById('nbitems').innerHTML--; //sub 1 from basket icon counter
  var x = document.getElementById('btnadd' + id).value; //get the value from the button +
  if (x == 1) {
    document.getElementById('btnadd' + id).value = "+"; // make the button + if nb of items =0
    document.getElementById('btndel' + id).hidden = true; //hide the delete button
  } else
    document.getElementById('btnadd' + id).value--; //decrement  nb of items on the button
}

function delfrombasket(i) { //function to remove row
  document.getElementById("row" + i).remove();
}

$(document).ready(function() { //function to filter menu accodring searching
  $("#txtsearch").keyup(function() {

    //send a request in the background (ajax) to the server:searchmenu.php
    $.ajax({
      url: "searchmenu.php",
      type: "get",
      data: {
        name: $(this).val()
      },
      success: function(outputSentByServer) { //result of the page searchmenu.php
        $("#menurow").html(outputSentByServer);
      }
    });
  });
});
