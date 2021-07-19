function deletecat(id){//function to delete catagory

    if(confirm("Do you want Delete ? ")){
  $.ajax({
     url: "deletecat.php",
    type:'post',
    data:{
      id: id,
      name:$("#cat_"+id).val()
    },
    success: function(output){
      var out = JSON.parse(output);
      if(out['status'] == 'success'){
        $( "#msgcat" ).removeClass( "alert-danger" ).addClass( "alert-success" );
       $("#msgcat").html('Catagory deleted successfully');
        $("#rowcat_"+id).remove();
      }
      else if(out['status'] == 'failed'){
        $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
        $("#msgcat").html("Error in deleting category");
      }
      else if(out['full'] == 'full'){
        $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
        $("#msgcat").html("Please empty the Category before deleting");
      }
    }
  });
}
}




function delitem(id){//function to delete item using ajax

  if(confirm("Do you want Delete ? ")){
    $.ajax({
       url: "deleteitem.php",
      type:'post',
      data:{id: id},
      success: function(output){
        var out = JSON.parse(output);
        if(out['status'] == 'success'){
         $("#msg").html('Item deleted successfully');
          $("#row_"+id).remove();
        }
        else
          $("#msg").html("Item has not beeen deleted");
      }
    });
}}


function updateitem(id){//function to update item using ajax
  $.ajax({
         url: 'updateitem.php',
         type:'post',
         data:{
                  type: $("#txttype_"+id).val(),
                  desc: $("#txtdesc_"+id).val(),
                  rank: $("#txtrank_"+id).val(),
                  price: $("#txtprice_"+id).val(),
                  photo: $("#txtphoto_"+id).val(),
                  id: id
             },
         success: function(output){

           var out = JSON.parse(output);
           if(out['unique'] == 'unique'){
             $( "#msg" ).removeClass( "alert-danger" ).addClass( "alert-success" );
               $("#msg").html('Item is updated ');
           }
          else  if(out['error'] == 'fail')
          {$( "#msg" ).removeClass( "alert-success" ).addClass( "alert-danger" );
             $("#msg").html('error');}
             else {$( "#msg" ).removeClass( "alert-danger" ).addClass( "alert-success" );
               $("#msg").html('Item updated successfully');}
         }
       });
}


function addcat() {
  $.ajax({
     url: "addcat.php",
     type:'post',
     data:{
       name:$("#txtCat_0").val()
    },
    success: function(output){

      var out = JSON.parse(output);
      if(out['unique'] == 'unique'){
        $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
          $("#msgcat").html('This Category is already exists');
      }
    else  if(out['status'] == 'success'){
          $("#table_cat").append(out['row']);
          $( "#msgcat" ).removeClass( "alert-danger" ).addClass( "alert-success" );
          $("#msgcat").html('Category added successfully');
          $("#txtCat_0").val('');
      }
      else
        {
          $("#msgcat").html("Category has not beeen added");
        $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
      }
    }

  });
}


function updatecat(id) {
  $.ajax({
         url: 'updatecat.php',
         type:'post',
         data:{
                  name:$("#cat_"+id).val(),

                  id: id
             },
         success: function(output){

           var out = JSON.parse(output);
           if(out['unique'] == 'unique'){
             $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
               $("#msgcat").html('This Category is already exists');
           }
           else if(out['error'] == 'fail'){
           $( "#msgcat" ).removeClass( "alert-success" ).addClass( "alert-danger" );
             $("#msgcat").html('error');
           }
             else {
                      $( "#msgcat" ).removeClass( "alert-danger" ).addClass( "alert-success" );
                      $("#msgcat").html('Item updated successfully');

                    }
         }
       });
}
