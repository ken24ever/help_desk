$(document).ready(function(){
          
    $(document). on('submit','#signupForm',  function(e){
      e.preventDefault()
           var first = $("#first").val()
           var middle = $("#middle").val()
           var last = $("#last").val()
           var gender = $("#gender").val()
           var office_title = $("#office_title").val()
           var em = $("#em").val();
           var pass1 = $("#pass1").val();
           var confPass = $("#confPass").val();
           var ministry = $(".ministry").val();
           var ictaUnits = $("#ictaUnits").val()

           
           if (first == "" || middle ==""|| last=="" || gender==""|| office_title==""|| em==""|| pass1=="" || confPass=="" || ministry==""
             || ictaUnits == ""){

                function toasterOptions() {
                  toastr.options = {
                      "closeButton": false,
                      "debug": false,
                      "newestOnTop": false,
                      "progressBar": true,
                      "positionClass": "toast-top-right",
                      "preventDuplicates": true,
                      "onclick": null,
                      "showDuration": "4000",
                      "hideDuration": "3000",
                      "timeOut": "9000",
                      "extendedTimeOut": "5000",
                      "showEasing": "swing",
                      "hideEasing": "linear",
                      "showMethod": "show",
                      "hideMethod": "hide"
                  }; 
              };
              
              
              toasterOptions();
                   toastr.error("Empty Form Field(s) Detected!", "ERROR DETECTED! " )
                return false;
  
           } else if ( pass1.length < 8){
  
              function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "4000",
                    "hideDuration": "3000",
                    "timeOut": "9000",
                    "extendedTimeOut": "5000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "hide"
                }; 
            };
            
            
            toasterOptions();
                 toastr.error("Password Should Be More Than 8 Characters Long!", "ERROR DETECTED! " )

           }
           else if (pass1 != confPass){

              function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "4000",
                    "hideDuration": "3000",
                    "timeOut": "9000",
                    "extendedTimeOut": "5000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "hide"
                }; 
            };
            
            
            toasterOptions();
                 toastr.error("Password Fields Mis-Matched!", "ERROR DETECTED! " )
  
            return false;
           } 
           
           else if (!em.match("@")){
    
              function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "4000",
                    "hideDuration": "3000",
                    "timeOut": "9000",
                    "extendedTimeOut": "5000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "hide"
                }; 
            };
            
            
            toasterOptions();
                 toastr.error("Email address is invalid", "ERROR DETECTED! " )
  
            return false;
  
           } 
           else{
  
        $.ajax({
            method:"POST",
            beforeSend: function(){
              swal({
                title: '',
                html: '<img src="img/icta_logo.png" height="60" width="60"><br><br><strong>Please Wait...</strong>',
                allowOutsideClick: false,
                timer: 3000
               });
               swal.showLoading();
                           },
            data: {first:first, middle:middle, last:last, gender:gender, em:em, pass1:pass1, ministry:ministry, office_title:office_title, ictaUnits:ictaUnits},
            url: 'register.php',
            success:function(data){ 
           
               console.log(data)

                if (data == 1 ){ 
                function toasterOptions() {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "1800",
                        "timeOut": "6000",
                        "extendedTimeOut": "2000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "show",
                        "hideMethod": "hide"
                    };
                };
                
                
                toasterOptions();
                     toastr.success("Great! Your Registration Was Successful, Login Now To Explore!", "HELLO! "+last )
             
                     
           $("#first").val("")
           $("#middle").val("")
           $("#last").val("")
            $("#gender").val("")
            $("#office_title").val("")
            $("#em").val("")
            $("#pass1").val("")
            $("#confPass").val("")
            $(".ministry").val("")
            $("#DOB").val("")
            $("#ictaUnits").val("")

            }//end of if Great! Your Registration Was A Huge Success, Login Now To Explore!
            else {
                $("#pass1").val("")
                $("#confPass").val("")

                function toasterOptions() {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "1800",
                        "timeOut": "6000",
                        "extendedTimeOut": "2000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "show",
                        "hideMethod": "hide"
                    }; 
                };
                
                
                toasterOptions();
                     toastr.error( "Sorry! That Email Address Already Exists In Our System!", "HELLO! "+last )

            }
                  
             
              
                   
            }// end of success function
           
          
        }) //end of ajax call 
  
       
  
    }//end of else control statement
    
    })//end of doc onClick
  
  })//end of doc ready
  
  
  