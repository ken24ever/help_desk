

//here we script for Assigning access level
$(document).on("click", '.accessLevel', function (e){ 
  e.preventDefault()
  Swal.fire({
     title: 'Assign Access Level',
     html:
       '<input type="number" id="inputtedVal" max="4" min="1" placeholder="Enter Numbers As Input"  class="swal2-input">' ,
     focusConfirm: false,
     showCancelButton: true,
      confirmButtonColor: 'darkGreen',
      cancelButtonColor: 'darkRed',
      confirmButtonText: 'Yes, Assign',  
     showLoaderOnConfirm:true,
     preConfirm: () => [
       document.querySelector('#inputtedVal').value, 
       
     ],
     
    }).then((result) => {
      
      if (isNaN(result.value)){
       
        Swal.fire({
          title: "Error Detected!",
          icon:"error",
          html: '<b style="color:red !important">Input Must Be A Number!</b>',
          timer: 4000

           })
      }else if (result.value==""){
        Swal.fire({
          title: "Error Detected!",
          icon:"error",
          html: '<b style="color:red !important">Empty Inputs!</b>',
          timer: 4000

           })

      }else if (result.value > 4){

        Swal.fire({
          title: "Error Detected!",
          icon:"info",
          html: '<b style="color:red !important">Numbers Can Only Be less than 4!</b>',
          timer: 4000

           })
      }else{
        var inputValue = $("#inputtedVal").val(); 
        var getId = $(this).attr("data-id");
       // alert(getId)
        $.ajax({
          method: 'post',
          url: 'assignAccess.php',
          dataType:'json',
          data: {inputValue:inputValue, getId:getId },
          beforeSend:function(){
            Swal.showLoading()
           
          },
          success: function(feedback){
     
            Swal.fire({
              icon:"success",
              html: '<b style="color:green !important"> User Name: '+feedback.first+' '+feedback.middle+' '+feedback.last+' Has Been Assigned A New Access Level  ('+feedback.access+')</b>',
            
          }) 

          
          }//end of success func


      }) // end of ajax

      }//end of else stmt

    })//end of then()
     


})//end of on click

