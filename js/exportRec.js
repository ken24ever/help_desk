$(document).ready(function(){

    $(document).on('submit', '#exportForm', function(e){
       e.preventDefault()
        const startDate = $("#selectStart").val();
        const startEnd = $("#selectEnd").val();
        const action = $("#action").val();
        
         if (startDate == "" || startEnd == "" || action == ""){
            function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "3000",
                    "timeOut": "9000",
                    "extendedTimeOut": "4000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "hide"
                };
            };
            
           
            toasterOptions();
                 toastr.error("Empty Fields Detected!", "ERROR ALERT!")
         }else{

        $.ajax({
            type: "Post",
            url: "excel.php",
            data: {startDate:startDate, startEnd:startEnd, action:action },
            cache:false,
            contentType: false,
            processData: false,
            success:function(exportRecord){
                $("#").html(exportRecord)
            
            }// end of success


    })//end of ajax


}//end of else

    })//end of on click '#exportInExcel'

})//end of ready state