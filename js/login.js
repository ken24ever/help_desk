$(document).ready(function(){
          
    $(document). on('click','#login',  function(event){
     event.preventDefault()
           var email = $("#email1").val();
           var password = $("#password").val();
   
  
           if (email==" " || password==" "){
  
            Swal.fire({
                title: "Ooops!",
                text: "Empty Fields Detected!",
                icon: "error",
                confirmButtonText:"Exit",
                 allowOutsideClick: false,
      timer: 3000
                });

                return false;
  
           } 
   
          else{ 
  
        $.ajax({
            method:"POST",
            beforeSend: function(){
              Swal.fire({
                title: '',
                html: '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>logging In Shortly...</strong>',
                allowOutsideClick: false,
               });
               Swal.showLoading();
                           },
            data: {email:email, password:password},
            url: 'login.php',
           
            success:function(data){ 
       
                if (data == 1  ){
                    
                    Swal.fire({
                        text:"Authentication Success!" ,
                        icon: "success",
                        confirmButtonText:"Exit",
                         allowOutsideClick: false,
              timer: 3000
                        });

                        
                        window.location.href = "https://edoictaservices.com.ng/helpdesk/dashboard.php";      

                }else if (data == 0  ) {
                    Swal.fire({
                        text:"Authentication Failed!",
                        icon: "error",
                        confirmButtonText:"Exit",
                         allowOutsideClick: false,
              timer: 3000
                        });

                } 
            
                         
            }//end of success
           
          
        }) //end of ajax call 
  
       
  
    }//end of else control statement
    
    })//end of doc onClick
  
  })//end of doc ready
  
  
  