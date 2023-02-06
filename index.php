<?php
  session_start(); 

if (isset($_SESSION['email'])){
  header("location: http://mda.edostate.gov.ng/ictahelpdesk/dashboard.php");

  } 



?>



<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ICTA | Help-Desk</title>
        
        <!-- MDB icon -->
    <link rel="icon" href="img/icta_logo.png" type="image/x-icon" />
    
   
  
     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     
      <link rel="stylesheet" href="bootstrap_updated/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap_updated/js/bootstrap.min.js"></script>
     
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="jquery/jquery-3.6.0.min.js"></script>

     <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

   <style>
       body{
           margin: 0 auto;
           font-family: open san;

       }
       .logo{
            height: 50px;
            width: 50px;
            
           
       }
     /*   #description{
           width:100% !important;
           height: 40% !important;
       } */

/* styling for the page content and change of background image transition effects */
       .section_top{
          width: 100%;
          overflow:hidden;
          position:relative;
          background-image:url(img/icta1.jpg);
          background-position:center;
          background-repeat: no-repeat;
          background-size:cover;
          text-align:center;
          justify-content:center;
          animation: change 20s infinite ease-in-out;
       }
       .content{
        margin: 80px auto;
        font-size:30px !important;
        height:1200px;
       }

       @keyframes change{

            0%
            {
              background-image: url(img/icta5.jpg)
            }
            
    
            

       }/* end of change */

       /* styles for forms on this page */

       * {
  box-sizing: border-box;
}

input[type=text],input[type=password], select {
  width: 60%;
  padding: 2px;
  font-size: 20px !important;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 5px 5px 5px 5px;
  display: inline-block;
}

input[type=submit] {
  background-color: #062743;
  color: white;
  padding: 5px 60px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background: rgba(14, 80, 0, 0.4);
  padding: 20px;
  color: #ffffff !important;

}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }

  .content{
        margin: 30px auto;
        font-size:30px !important;
        height:1480px;
       }

}
.forgot{
  font-size:16px !important;
  font-family: tahoma !important;
  color: #ffffff !important;
  cursor: pointer;
}
#show{
  margin-left: 200px;
  color: #ffffff;
}
/* about help desk */
.p{
  color: #000000;
  font-family: Tahoma;
  font-size: 16px
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #100F0F !important;
   color: white;
   text-align: center;
   border-top: 2px solid #E2DCC8;
   font-size:14px !important;
}

.footer .footer_info{
  background-color: #0F3D3E !important;
  color:#F1F1F1;
  font-family: Tahoma !important;
  width: 100%;
  text-align: center !important;
  border:1px solid #100F0F ;
  
}
   </style>
  
   
   <link rel="stylesheet" href="toastr/build/toastr.min.css">
  
 <script src="js/login.js"></script>
 
 
 <script>

  $(document).ready(function(){

   // $("#ictaUnits").css("display", "none")
    //here fetch all MDAs from the DB for ticket issuing
    getMDAs = () => {
      $.ajax({
                type: "Post",
                url: "getMDAs.php",
                success:function(MDAs){
                    $("#MDA").html(MDAs)
                
                }// end of success


        })//end of ajax


    }// end of getMDAs()

    //here we call the function to execute
    getMDAs()

    //here fetch all MDAs for registration purpose
       //here fetch all MDAs from the DB
       getMDAsForRegistration = () => {
      $.ajax({
                type: "Post",
                url: "getMDAs.php",
                success:function(MDAs){
                    $("#ministry").html(MDAs)
                
                }// end of success


        })//end of ajax


    }// end of getMDAsForRegistration() 

    getMDAsForRegistration()


     //forget password scripting
     $(document).on('keyup', '#forgotEmail', function(e){
     e.preventDefault();
           let confEml = $("#forgotEmail").val();
      $.ajax({
                type: "Post",
                url: "confirmEmail.php", 
                data: {confEml:confEml},
                success:function(confirm){
                  if (confirm == 1){
                 /*    function toasterOptions() {
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
              toastr.success("Hooray! Email Exists In Our System", "CONFIRMATION" ) */
                  }
                  else if (confirm == 0){
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
              toastr.error("Oops! Email Doesn't Exists In Our System", "CONFIRMATION" )
                

                  }
                    
                }// end of success


        })//end of ajax

    })// end of on submit event



    //forget password scripting
    $(document).on('submit', '#forgotPass', function(e){
     e.preventDefault();
     let confEml = $("#forgotEmail").val();
     let  newPass= $("#updatePass").val();
     let confNewPass = $("#cnfmPass").val();

         
     if (confEml == "" || newPass =="" || confNewPass==""){

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
  
           } else if ( newPass.length < 8){
  
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
                 return false;

           }
           else if (newPass != confNewPass){

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

      $.ajax({
                type: "Post",
                url: "updatePassword.php",
                beforeSend: function(){
          

          Swal.fire({
           title: '',
           icon: 'info',
           html:  '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>Just A Moment...</strong>',
           allowOutsideClick: true,
           });
          Swal.showLoading();


                      },
                data: {confEml:confEml, newPass:newPass, confNewPass:confNewPass},
                success:function(updatePass){
                    if (updatePass == 1){
                      
                        Swal.fire({ 
                            title: '',
                            icon: 'success',
                            html: '<b style="color:green;">Password Updated Successfully!</b>',
                            allowOutsideClick: false,
                            });


                    }else if (updatePass == 0){

               
                        Swal.fire({
                        title: '',
                        icon: 'error',
                        html:  '<b style="color:red;">Password Update Failed, Something Went Wrong!</b>',
                        allowOutsideClick: false,
                        });

                    }

              $("#forgotEmail").val("");
             $("#updatePass").val("");
              $("#cnfmPass").val("");
                }// end of success 


        })//end of ajax

    })// end of on submit event

    //here we retreive units of icta staffs based on selection of mda == icta
    $(document).on('change', '.ministry', function(){
        const ministry = $(this).val()
        if (ministry == "INFORMATION COMMUNICATION TECHNOLOGY AGENCY"){

          //show form field for icta units
          $("#ictaUnits").css("display", "block")
           

          $.ajax({
            type: "Post",
            url: "getIctaUnits.php",
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
              toastr.info("Loading All ICTA Units! ", "Loading..." )
                       },
            success:function(units){
                $("#ictaUnits").html(units)
            
            }// end of success


    })//end of ajax

        }else{
          $("#ictaUnits").css("display", "none")
          $("#ictaUnits").val("")
        
        }
    })//end of on change for icta


  })// end of ready state
 </script>
 <script>
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

           
           if (first == "" || last=="" || gender==""|| office_title==""|| em==""|| pass1=="" || confPass=="" || ministry==""
            ){

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
           
           else if (!em.match("@edostate.gov.ng")){
    
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
                 toastr.error("Its either you are registering an email that is not an EDSG official email or there is no @ symbol in the email address.", "ERROR DETECTED! " )
  
            return false;
  
           } 
           else{
  
        $.ajax({
            method:"POST",
            beforeSend: function(){
              swal.fire({
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
  
  
  
 </script>
    </head>
    <body>
    
    
      <!-- toast js  -->
      <script src="toastr/build/toastr.min.js"></script>
     
        <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="images/edologo1.png"class="logo" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Login</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Register</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">About ICTA Help Desk</a>
  </li>
</ul>
    </div> 
  </div>
</nav>


<!-- content area -->

<div class="section_top">

            <div class="content">

            <!-- Tab panes -->
<div class="tab-content">
  <!-- login section -->
  <div class="tab-pane container1 active" id="home">

  <div class="container">
    
 
  <form id="myForm2" >
    <div class="row">
      
      <div class="col-25">
        <label for="email">Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email1" name="email1" placeholder="Enter Email Address...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password" placeholder="Enter Password">
      </div>
    </div>
    
    <div class="row">
    <div class="col-75">
    <center> <input type="submit" value="Log In" id="login" ></center>
    </div>
</div>
    <center><span><b class="forgot btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Forgot Password?</b></span></center>
  </form>
  
  
   <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:green">UPDATE PASSWORD</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="forgotPass" > 
<div class="input-group mb-3 m-2">
    <span class="input-group-text" id="inputGroup-sizing-default">Email<strong style="color: red !important;">*</strong>:</span>
    <input type="text" class="form-control" id="forgotEmail" name="forgotEmail" placeholder="Enter Your Email Address" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
  </div>

  <div class="input-group mb-3 m-2">
    <span class="input-group-text" id="inputGroup-sizing-default">New Password<strong style="color: red !important;">*</strong>:</span>
    <input type="password" class="form-control" id="updatePass" name="updatePass" placeholder="Enter Your New Password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
  </div>

  <div class="input-group mb-3 m-2">
    <span class="input-group-text" id="inputGroup-sizing-default">Confirm Password<strong style="color: red !important;">*</strong>:</span>
    <input type="password" class="form-control" id="cnfmPass" name="cnfmPass" placeholder="Confirm New Password" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
  </div>

  

  <div class="input-group mb-3 m-2">
    <button type="submit" class="form-control  btn btn-success p-2"  >UPDATE PASSWORD </button>
  </div>
</form>
      </div>
      <div class="modal-footer" style="color:green; text-align:center !important; font-size:14px !important">
      <center><p> <span style="color:red"><i class="fa fa-phone fa-md" aria-hidden="true"></i></span> Call Us On  3CX By Dailing: 6000 </p></center>
      <center><p><span style="color:red"><i class="fa fa-envelope fa-md" aria-hidden="true"></i></span> Email Us Via: icta.helpdesk@edostate.gov.ng</p></center>
      </div>
    </div>
  </div>
</div>

  

</div><!-- end of  <div class="container"> -->

</div><!-- end of    <div class="tab-pane container fade" id="home"> -->

  <!-- end of login section -->

  <!-- register section -->

  <div class="tab-pane container2 fade" id="menu1">

  <div class="container">
    
 
    <form id="signupForm" >
      <div class="row">
        <div class="col-25">
          <label for="fname">First Name:</label>
        </div>
        <div class="col-75">
        <input type="text"  id="first" name="first" placeholder="Enter First Name" >
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="mname">Middle Name:</label>
        </div>
        <div class="col-75">
        <input type="text" id="middle" name="middle"  placeholder="Enter Middle Name">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="lname">Last Name:</label>
        </div>
        <div class="col-75">
        <input type="text"  id="last" name="last"  placeholder="Enter Last Name">
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="gender">Gender:</label>
        </div>
        <div class="col-75">
        <select id="gender" name="gender" >
            <option selected value=""> Select Gender.</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="MDA">MDA:</label>
        </div>
        <div class="col-75">
        <input list="ministry" type="text"  class="ministry"  placeholder="Search For Ministry,Department and Agency"  >
            <datalist  id="ministry" name="ministry">
         
            </datalist>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="jtitle">Job Title:</label>
        </div>
        <div class="col-75">
        <input type="text" class="" id="office_title" name="office_title" placeholder="Enter Your Job Title" >
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="em">Email:</label>
        </div>
        <div class="col-75">
        <input type="text" class="" id="em" name="em" placeholder="Enter Your Email Address"  >
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="pswrd">Password:</label>
        </div>
        <div class="col-75">
        <input type="password" class="" id="pass1" name="pass1" placeholder="Enter Your Password" >
        </div>
      </div>

      <div class="row">
      
        <div class="col-75">
     <p style="font-size:14px" id="show"><input type="checkbox" onclick="myFunction1()"  > Show Password</p>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="cnfPass">Confirm Password:</label>
        </div>
        <div class="col-75">
        <input type="password" class="" id="confPass" name="confPass" placeholder="Re-type password" >
        </div>
      </div>
      
      
      <div class="row">
      <div class="col-25">
          <label for="units"></label>
        </div>
        <div class="col-75">
        
        <select class="m-2" id="ictaUnits" name="ictaUnits" style="display:none" >
            
        
            </select>
        </div>
      </div>


      <div class="row">
    <div class="col-75">
    <center> <input type="submit" value="Register" id="submit" ></center>
    </div>
     </div>
    

    </form>
  
  </div><!-- end of  <div class="container"> --> 

  </div><!-- end of  <div class="tab-pane container fade" id="menu1"> -->

  <!-- end of register section -->

  <!-- about helpdesk section -->
  <div class="tab-pane container3 fade" id="menu2">
    
  <div class="container">
        
       <div>
        <h1>Welcome to
Edo State ICTA</h1>

<p class="p">The Agency is an enabler of ICT for Edo State Government which is achieved through highly
   skilled professionals who constantly maintain good 
  ethical values and principles in engaging, collaborating and enabling emerging technologies
   across all sectors of the State Government.</p>
   <hr>
   <h1>About ICTA Help Desk</h1>
   <p class="p">The help desk platform is used as an avenue to treat issues relating to ICT in all government ministries, departments and agencies
    of the Edo State government.
     The application starts with a landing page for users who has ICT related issues to raise. Users must register and then 
    log into their dashboard or account to raise a ticket. All tickets are directed to the help desk unit of the ICTA.
     Users can monitor every ticket raised and also there is room for them to be able to give feedbacks on each ticket raised when tickets are already closed by the help desk officers.</p>
       </div>

  </div>

  </div><!-- end of  <div class="tab-pane container3 fade" id="menu2">-->
</div>
<!-- footer section starts here -->

<div class="footer"><!-- start of footer --> 

<center><img src="images/image001.png" alt="" style="border-radius:15px !important; width:100px; height:70px; margin:12px;"> </center>
<center><h2 style="color:whitesmoke !important; text-shadow: 2px 2px #000000; "> <?php  echo '<b style="color:Orange !important;">&copy; '.date('Y').'</b> <b  style="color:red !important; text-shadow: 2px 2px #000000;">EDO STATE</b> ICT AGENCY.';  ?> </h2></center>
<div class="footer_info">
<p>follow us on: <span ><i class="fa fa-facebook-official fa-lg w3-hover-opacity"></i> 
  <i class="fa fa-instagram fa-lg w3-hover-opacity"></i>  <i class="fa fa-youtube fa-lg w3-hover-opacity"></i></span></p>
<p> <span style="color:red"><i class="fa fa-phone fa-md" aria-hidden="true"></i></span> Call Us On  3CX By Dailing: 6000 </p>
<p><span style="color:red"><i class="fa fa-envelope fa-md" aria-hidden="true"></i></span> Email Us Via: icta.helpdesk@edostate.gov.ng</p>
</div><!-- end of footer --> 

<!-- end of footer -->
            </div><!-- end of  class="content" -->


        </div><!-- end of class="section_top" -->

<script>
function myFunction() {
  var x = document.getElementById("updatePass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function myFunction1 () {
  var x = document.getElementById("pass1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
    </body>
</html>