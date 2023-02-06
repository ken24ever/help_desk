


function countRows () {
  
    $.ajax({
            type: "Post",
            url: "countRows.php",
            dataType:'json',
            /* cache:false,
            contentType: false,
            processData: false, */
            success:function(info){
               // console.log(info.occurence)
                    $("#tableInfo").html(info.table)
                    $(".num").html(info.occurence)
            }// end of success


    })//end of ajax
}
countRows()

setInterval(countRows,4000)

$(document).on('click', '.action', function(){
 
  
    const  getDepartments = () => {
        $.ajax({
                  type: "Post",
                  url: "getIctaUnits.php",
                  success:function(units){
                      $("#departments").html(units)
                  
                  }// end of success
  
  
          })//end of ajax
  
  
      }// end of getDepartments()
  
      getDepartments()
  
     const getHOU = () => {
        $.ajax({
                  type: "Post",
                  url: "getHOUs.php",
                  success:function(rec){
                      $("#getHOUnames").html(rec)
                  
                  }// end of success
  
  
          })//end of ajax
  
  
      }// end of getHOU()
  
      getHOU()

   

    //here we script for Assigning access level
    Swal.fire({
       title: 'Assign Priority And Unit To Heads Of Unit/Junior Staffs',
       html:
       '<input list="departments" class="form-control departments"  placeholder="Search For Departments/Units" ><datalist  id="departments" name="departments"></datalist> <br>'+
       '<input list="getHOUnames" class="form-control houNames"  placeholder="Search For HOU" > <datalist  id="getHOUnames" name="getHOUnames"></datalist><br>'+
       '  <select id="priorityL" name="priorityL" class="form-control" >'+
       '<option value="">Select Priority Level</option>'+
       '<option value="High">High</option>'+
       '<option value="Medium">Medium</option>'+
       '<option value="Low">Low</option>'+
     '</select>',
       focusConfirm: false,
       showCancelButton: true,
        confirmButtonColor: 'darkGreen',
        cancelButtonColor: 'darkRed',
        confirmButtonText: 'Yes, Assign', 
  
       
      }).then((result) => {
        
        if (result.value==""){
          Swal.fire({
            title: "Error Detected!",
            icon:"error",
            html: '<b style="color:red !important">Empty Inputs!</b>',
            timer: 4000
  
             })
       return false
        }else{
         
            var id  = $("#id").attr("data-id")
            var dept = $(".departments").val();
            var officerName = $(".houNames").val();
            var priorityL = $("#priorityL").val();
        
            

            $.ajax({
              method: 'post',
              url: "processPA.php", 
              data: {id:id, dept:dept, officerName:officerName, priorityL:priorityL},
              dataType: 'json',
              beforeSend: function(){
                Swal.showLoading();
                
              },
              success: function(reportDetails){
           
                Swal.fire({
                    icon: 'info',
                    html: '<strong style="color:green"> Ticket No: <u>'+reportDetails.tick_no+'</u><br>Assigned To: '+reportDetails.fullNames+'</strong>', 
                  
                    })    
    
     
                 
              }//end of success func
     
     
          }) // end of ajax
     

        }//end of else stmt
  
      })//end of then()
       
  
  

  
  


})//end of on click event 

/* read more scripting */

$(document).on('click', '.readMore', function(){
    var getId = $(this).attr("data-id")
 
    $.ajax({
      method: 'post',
      url: 'getFullDescipt.php',
      dataType:'json',
      data: { getId:getId },
      beforeSend:function(){
        Swal.showLoading()
       
      },
      success: function(report){
 
        Swal.fire({
          title:"Full Description",  
          icon:"info",
          html: '<b style="color:black !important; font">'+report.comments+'</b>',
        
      }) 

      
      }//end of success func


  }) // end of ajax
  

})//end of onclick



