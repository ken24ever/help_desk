$(document).ready(function(){



    //here we retreive units of icta staffs based on selection of mda == icta
    $(document).on('submit', '#accessLevel', function(e){
        const ictaNames = $("#ictaNames").val() 
      e.preventDefault()
    
      if (ictaNames == ""){

        function toasterOptions() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "3000",
                "timeOut": "9000",
                "extendedTimeOut": "9000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "show",
                "hideMethod": "hide"
            };
        };
        
        
        toasterOptions();
             toastr.error("Input Field(s) Cannot Be Empty!", "ERROR DETECTED!" )
     return false;
     }
     else{
          $.ajax({
            type: "Post",
            url: "getIctaStaffNames.php",
            beforeSend: function(){
              function toasterOptions() {
             toastr.options = {
                 "closeButton": false,
                 "debug": false,
                 "newestOnTop": false,
                 "progressBar": true,
                 "positionClass": "toast-bottom-right",
                 "preventDuplicates": true,
                 "onclick": null,
                 "showDuration": "3000",
                 "hideDuration": "3000",
                 "timeOut": "9000",
                 "extendedTimeOut": "9000",
                 "showEasing": "swing",
                 "hideEasing": "linear",
                 "showMethod": "show",
                 "hideMethod": "hide"
             };
         };
         
         
         toasterOptions();
              toastr.info("Loading Staff Names! ", "Loading..." )
                       },
            data:{ictaNames:ictaNames},
            success:function(getNames){
                $("#showStaffDetails").html(getNames)
            
            }// end of success
    
    
    })//end of ajax
    
      }//end of if (ictaNames)

    })//end of on onsubmit for icta
    
    
    
    
    
    
    
    
    })//end of ready state