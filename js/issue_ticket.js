
    $(document).ready(function(){ 
      
      $("#myForm").on('submit', function(e){ 
  
        e.preventDefault()
  
          //we create local variables to hold inputs from the form fields
 
          const title = $("#title").val();
                  const firstName = $("#firstName").val();
                  const lastName = $("#lastName").val();
                  const middleName = $("#middleName").val();
                  const job = $("#job").val();
                  const email = $("#email").val();
                  const MDA = $(".MDA").val();
                  const selectTicketCat = $("#selectTicketCat").val();
                  const files = $("#file").val();
                  const description = $("#description").val();
                  const issues = $("#issues").val();
                 // const priority = $("#priority").val();
                  const entry_date = $("#entry_date").val();
                 // const units = $("#units").val();
                  
               /*    if (title == ""){
                     $('#title').css('borderColor','red')
                  } */
              /*     if (firstName == "" || lastName == "" || middleName == "" || job =="" || email =="" 
                  || MDA=="" || issues== "" || description == "" || priority == "" || entry_date ==""){
                     $('#title,#firstName,#lastName,#job,#email,#issues,#description,#priority,#entry_date').css('borderColor','red')
                  } */
 
                console.log()
                
                     if (!email.match("@")){
                        // alert("Email Address Invalid.")
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
                              "hideDuration": "1000",
                              "timeOut": "5000",
                              "extendedTimeOut": "1000",
                              "showEasing": "swing",
                              "hideEasing": "linear",
                              "showMethod": "show",
                              "hideMethod": "hide"
                          };
                      };
                      
                      
                      toasterOptions();
                           toastr.error( "Email Address Invalid", "Invalid Email!" )
                 
                     
                     }//end of if !email.match()
                     else{
 
                          // creating an instance of the object
                  const formObj = new FormData(this);
  
                  //here we append all form fields
                  formObj.append('title', title);
                  formObj.append('firstName', firstName);
                  formObj.append('lastName', lastName);
                  formObj.append('middleName', middleName);
                  formObj.append('job', job);
                  formObj.append('email', email);
                  formObj.append('MDA', MDA);
                  formObj.append('issues', issues);
                  formObj.append('selectTicketCat', selectTicketCat);
                  formObj.append('files', files);
                  formObj.append('description', description);
                 // formObj.append('priority', priority);
                  formObj.append('entry_date', entry_date);
                  //formObj.append('units', units);
                
          $.ajax({
          type: "POST",
          url:"process_ticket.php", 
          data: formObj,
          dataType:'json',
          cache:false,
          contentType: false,
          processData: false,
          beforeSend: function(){
          
            $("#ticket").attr('disabled', 'disabled'); 
 
                       Swal.fire({
                        title: '',
                        icon: 'info',
                        html: '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>Creating Ticket Shortly...</strong>',
                        allowOutsideClick: false,
                        timer:2000
                        });
                       Swal.showLoading();
               
          },
          success: function(response){
             
             $("#ticket").removeAttr('disabled'); 
            
 
            console.log(response.status,response.message)
             if (response.status == 1){
          $("#myForm")[0].reset();
          $(".alert").css({
             'font-size': '20px',
             'display':'block',
             'text-align':'center'
         });
              $('.alert').html('Ticket Number Created Successfully: '+response.ticketNo+'. A Copy Of The Ticket Number Has Been Sent To Your Email!');
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
                     "extendedTimeOut": "9000",
                     "showEasing": "swing",
                     "hideEasing": "linear",
                     "showMethod": "show",
                     "hideMethod": "hide"
                 };
             };
             
             
             toasterOptions();
                  toastr.success( response.message, "Successful!" )
        
              
            } //ende here
         else if (response.status == 0){
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
                     "hideDuration": "1000",
                     "timeOut": "5000",
                     "extendedTimeOut": "1000",
                     "showEasing": "swing",
                     "hideEasing": "linear",
                     "showMethod": "show",
                     "hideMethod": "hide"
                 };
             };
             
             
             toasterOptions();
                  toastr.error( response.message, "ERROR DETECTED!" )
        
          } 
  
    
  
          }//end of success function
  
          })//end of ajax 
  
 
                     }// end of if !email.match else statement
  
                 
  
      })//end of $("myForm")onSubmit
  
          // file type validation
          var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg']       
           $("#file").change(function(){
             for(i=0; i<this.files.length; i++){
                      var file = this.files[i];
                      var fileType = file.type;
             }
      
             if (!( (fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3])
             || (fileType == match[4]) || (fileType == match[5]) 
             )) {
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
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "show",
              "hideMethod": "hide"
          };
      };
      
      
      toasterOptions();
           toastr.warning( "Ooops!!! System Can Only Accept PNG, JPEG, JPG, PDF and DOC File Format!", "ERROR DETECTED!" )
      
           $("#file").val("");
                   return false;
             }
      
           }) // end of change file  
  
  
  
  
  
  
       })/* end of ready state */
  
  
    
  
  
 