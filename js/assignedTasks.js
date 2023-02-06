

function assignedWork(){
  $.ajax({
    method: 'post',
    url: 'assignedTasks.php',
    dataType:'json',
   /*  cache:false,
    contentType: false,
    processData: false, */
    success: function(getAll){
//console.log(getAll.table)
   $("#assignedTasks").html(getAll.table)
   $(".countTasks").html(getAll.occurence) 

  }//end of success

  }) // end of ajax 

}//end of assignedWork()

  
setInterval(assignedWork, 3000);

$(document).on('click', '.reassign', function(){
  
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
      preConfirm: () => [
        document.querySelector('#departments').value,
        document.querySelector('#getHOUnames').value, 
        document.querySelector('#priorityL').value, 
         
        
      ],
    }).then((result) => {
      
      if (result.value == ""){
        Swal.fire({ 
          title: "Error Detected!",
          icon:"error",
          html: '<b style="color:red !important">Empty Inputs!</b>',
          timer: 4000

           })
    
      }else{
       
        var id  = $(this).attr("data-id")
          var dept = $(".departments").val();
          var officerName = $(".houNames").val();
          var priorityL = $("#priorityL").val();
      
          if (id == "" && dept == "" && officerName == "" && priorityL ==""){
            Swal.fire({ 
              title: "Error Detected!",
              icon:"error",
              html: '<b style="color:red !important">Empty Inputs!</b>',
              timer: 4000
    
               })

          }
          else{

          $.ajax({
            method: 'post',
            url: "reassignTasks.php", 
            data: {id:id, dept:dept, officerName:officerName, priorityL:priorityL},
            dataType: 'json',
            success: function(reportDetails){ 
         
              Swal.fire({
                  icon: 'info',
                  html: '<strong style="color:green"> Ticket No: <u>'+reportDetails.tick_no+'</u><br>Assigned To: '+reportDetails.fullNames+'</strong>', 
                
                  })    
  
   
               
            }//end of success func
   
   
        }) // end of ajax

      }// end of inner if else

      }//end of else stmt

    })//end of then()
     







})//end of on click event 
