$(document).ready(function(){



//here we retreive units of icta staffs based on selection of mda == icta
$(document).on('keyup', '#ictaNames', function(){
  /*   const namesOfStaffs = $(this).val() */
  


      $.ajax({
        type: "Post",
        url: "accessLevelSearch.php", 
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
        success:function(getNames){
            $("#getIctaNames").html(getNames)
        
        }// end of success


})//end of ajax

  
})//end of on keyup for icta








})//end of ready state