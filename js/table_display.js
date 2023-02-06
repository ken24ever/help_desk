
            
     
    function loadTable (page) { 
        $.ajax({
                type: "Post",
                url: "table_display.php",
                data: {page:page},
                success:function(table_info){

                    $(".ticket_records ").html(table_info);
                   
                }


        })//end of ajax

}//end of loadTable

//setInterval(loadTable, 3000)

$(document).on("click", ".page-item", function(){
var page = $(this).attr("id");
console.log(page)
loadTable(page)

})//end of onclick event
loadTable()


//here we script for toggle edit/update of ticket button
$(document).on("click", '.editButton', function (){

    /* alert(id) */
    
    Swal.fire({
      title: 'Are you sure you want to update this ticket?',
      html: '<img src="img/icta_logo.png" height="50" width="50">',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: 'darkGreen',
      cancelButtonColor: 'darkRed',
      confirmButtonText: 'Yes, Update ticket!', 
      showLoaderOnConfirm:true,
      
    }).then((result) => {
      if (result.value) {
        var ticketNo = $(this).attr("id");
    
       // console.log(ticketNo);
        //alert(ticketNo)
         $.ajax({
                method: 'post',
                url: 'updateTicket.php',
                data: {ticketNo:ticketNo},
                beforeSend:function(){
                  Swal.isLoading()
                },
                success: function(updatedData){ 
                  Swal.fire(
                    'TICKET UPDATED!',
                     updatedData,
                    'success'
                  ) 

                  loadTable()
                }
    
    
            }) // end of ajax
     
      }else{
    
        Swal.fire("Cancelled", "No Action Was Taken! :)", "info");
      
      }
    
    })
    
    })