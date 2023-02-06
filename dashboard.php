<?php
  session_start(); 

   if (!isset($_SESSION['email'])){
  header("location: index.php");

  } 



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Help-Desk | Dashboard</title>

    
    <!-- MDB icon -->
    <link rel="icon" href="img/icta_logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
 
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />

    <style>

body{
        background-color: hsl(218,41%,15%);
        background-image: radial-gradient(
          650px circle at 0% 0%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%
        ),
        radial-gradient(
        1250px circle at 100% 100%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%

        );
        height:100vh;
        color:whitesmoke;
      }
      @media screen and (max-height: 991.98px) {
  body{
    height: 100%;
    font-size:18px !important
  }
}
      
      table, td {
        font-size:18px !important
      }

      button{
        font-size:18px !important;
      }
      #searchNames{
        width:140px !important
      }
      .bg-glass {
        background: hsla(0, 0%, 100%, 0.15);
        backdrop-filter: blur(30px);
     
      }

      .bg-glass:hover{
        background: hsla(21, 21%, 33%, 0.17);
        backdrop-filter: blur(40px);
}
      .bg-theme {
        background-color: hsla(218, 41%, 25%);
      }
      .text-muted {
        color:hsl(0, 0%, 80%) !important
      }
      .text-success{
        color: hsl(144, 100%, 40%) !important;
      }
      .text-danger{
        color: hsl(350, 94.3%, 68.4%) !important;
      }
    .mb-5 {
      margin-top: 20px;
    }
    td{
      color:whitesmoke !important;
    }

    /* searched tickets */
    .lead{
      color: whitesmoke !important;
      text-align: center;
    }

    /* ticket without priority & assigned unit */
    #None_P_A{
     
      text-align: left;
      border-collapse: collapse;
    width: 100%;
    }
    #None_P_A .one {
    text-align: left;
    padding: 8px;
    vertical-align: bottom;
    border-bottom: 1px solid #000000;
    color:#000000 !important;
    background-color:#ffffff !important;
  
}

#None_P_A tr:nth-child(even){background-color: #f2f2f2}

#None_P_A th {
    background-color: #4CAF50;
    color: white;
    text-align: left;
    padding: 8px;
}
    /***pagination style */
span.page-link{
  cursor: pointer !important;
 color:green;
 font-weight:900 !important;
 font-size:18px !important;
}
 .pagination{
   justify-content:center !important ;
  
 }

 .active1{
  background-color: blue !important
 }

 /* style for download to excel format */
 .downloadReport{
  font-size:100px !important;
  color:Brown !important;
 }
 .style{
  color:brown !important;
  font-size:20px !important;
 }

 /* styling for notification section */
 ul li a{
  font-size:18px !important
 }

 /* read more button */
.readMore{padding:-10 !important}


/* sideBar styling */

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: hsl(218,41%,15%);
        background-image: radial-gradient(
          650px circle at 0% 0%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%
        ),
        radial-gradient(
        1250px circle at 100% 100%,
        hsl(218, 41%, 35%) 15%,
        hsl(218, 41%, 30%) 35%,
        hsl(218, 41%, 20%) 75%,
        hsl(218, 41%, 19%) 80%,
        transparent 100%

        );
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

/* tickets_options */
.flex-container {
  display: flex;
}

.flex-container > div {
  background-color: #f1f1f1;
  margin: 10px;
  padding: 20px;
  font-size: 30px;
}

.incident, .request{
   width:70%;
   height:40% !important;
}

/* end of tickets_options */


.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 20px;
  font-family: open san !important;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}




    </style>
<link rel="stylesheet" href="css/modal.css">
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  color: #000000 !important
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  color: #000000 !important
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}


</style>

<style>


.holder_ {
  border: 2px solid #dedede;
  background-color: gray; 
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  color: #ffffff;
}

.darker {
  border-color: #000000;
  background-color: rgb(75, 63, 63);
}

.holder_::after {
  content: "";
  clear: both;
  display: table;
}

.holder_ img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.holder_ img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right; 
  color: pink;
}

.time-left {
  float: left;
  color: pink;
}

#messages{
  overflow: auto;
}

/* send comment input styling */

#comments{
  padding:30px;
  width:84%;
  font-size:20px;
  
}

.send{
  padding:32px;
  font-size:20px;
}

</style>


<link rel="stylesheet" href="css/tableSearch.css"/>    
<link rel="stylesheet" href="toastr/build/toastr.min.css">

<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="jquery/jquery-3.6.0.min.js"></script>
   <link rel="stylesheet" href="toastr/build/toastr.min.css">
  
   <link rel="stylesheet" href="animate.css-master/animate.min.css">
  
   <script src="js/assignAccess.js"></script>
  
 
       <link rel="stylesheet" href="font_awe_6/css/all.css">  
       <script src="js/issue_ticket.js"></script>
       <script src="js/countTickets.js"></script>
       <script src="js/ticketFormLogic.js"></script>
     <!--  <script src="js/inactive_page.js"></script>  -->
       <script src="js/accessLevelSearch.js"></script>
       <script src="js/retreiveIctaNames.js"></script>
       <script src="js/addComment.js"></script> 
        
       
       <!-- <script type="text/javascript" src="js/modal.js"></script> -->
       <script>
          function animElem(){
                    var animateNam = 'animated zoomOut';
                    var animationend ='webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationEnd animationEnd'
                    $(document).ready(function(e){
                    
                    $(".timeEffect").addClass(animateNam).one(animationend, function(){ $(this).removeClass(animateNam)})
                    })
                    
                    
                    }
                    
                    setInterval(animElem,450)

                  
       </script>


    
  </head>
  <body>
   <!--  <script src="js/exportRec.js"></script> -->
  <script src="toastr/build/toastr.min.js"></script>
  
  <script type="text/javascript" src="bootstrap_updated/js/bootstrap.min.js"></script>
 
  <script>
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
                     toastr.success('<?php echo  $_SESSION['lastName']." ".$_SESSION['firstName'] ; ?>'+', Access Level:'+ '<?php echo $_SESSION['access_level']; ?>'+' ', "WELCOME! " )
  </script>
  
<!-- sidebar -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#"> <i class="bg-theme fas fa-user fa-lg text-white fa-fw"></i> Profile</a>
  <a href="#"><i class="bg-theme fas fa-envelope fa-lg text-white fa-fw"></i> Notification</a>
  <a href="#"><i class="bg-theme fas fa-ticket fa-lg text-white fa-fw"></i> Create Ticket</a>
  <a href="logout.php"><i class="bg-theme fas fa-right-from-bracket fa-lg text-white fa-fw"></i> Logout</a>
 
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<!-- end of side bar -->

   <!-- Project Development Begins here! -->

   <!-- This section shows what a user would see on logging in here based on access level -->
                <div class="container pt-5">
                <!-- section for creating ticket by admin -->
                <section class="">
              
                  <!-- section for viewing profile -->

                  <div class="row">

                  <div class="col-lg-12 mb-4 mb-lg-0">

                  <div class="p-2  bg-dark">

                  <div class="accordion accordion-flush" id="accordionFlushExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingProfile">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseProfile" aria-expanded="false" aria-controls="flush-collapseProfile">
            <strong ><i class="fas fa-user fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216)  !important; font-size: 40px !important;"></i> &nbsp; PROFILE</strong>
          </button>
        </h2>
        <div id="flush-collapseProfile" class="accordion-collapse collapse" aria-labelledby="flush-headingProfile" data-bs-parent="#accordionFlushExample">
          <div class="bg-glass accordion-body">

                    <center><p style="color:#000000">coming soon!</p></center>

          </div><!-- endo fo accordion body -->
        </div>
      </div>
      </div>


                  </div><!-- end of p-2 bg-dark -->


                  </div><!-- end of div class col-lg-12 mb-4 mb-lg-0 -->

                 </div><!-- end of 1st row -->




                  <!-- *********************************NEW ROW********************************** -->
                  <div class="row">

                  <div class="col-lg-12 mb-4 mb-lg-0">
                    <!-- long card starts here -->
                    <div class="p-2  bg-dark">

<div class="accordion accordion-flush" id="accordionFlushExample">
<div class="accordion-item">
<h2 class="accordion-header" id="flush-headingOne">
 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
  <strong ><i class="fas fa-ticket fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216) !important; font-size: 40px !important;"></i> &nbsp; RAISE A TICKET </strong>
 </button>
</h2>
<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
 <div class="bg-glass accordion-body">
   
 

<!--start of incident -->

<form id="myForm" enctype="multipart/form-data" > 

<!-- Alert/Notification area -->
<div class="container">
  <div class="row">
    <div class="alert alert-success alert-dismissible fade show" style="display:none ;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
</div>
</div>
<!-- ******end of Alert/Notification area ******* -->



       <select class="form-select m-2" aria-label="Default select example" id="title" name="title" >
           <option selected value="">Title <strong style="color: red !important;">*</strong></option>
           <option value="Mr">Mr.</option>
           <option value="Dr">Dr.</option>
           <option value="Mrs">Mrs.</option>
           <option value="Miss">Miss.</option>
         </select>
 
         <div class="input-group m-2">
           <span class="input-group-text">First, Middle And Last Name <strong style="color: red !important;">*</strong></span>
           <input type="text" aria-label="First name" id="firstName" value="<?php echo $_SESSION['firstName']; ?>" name="firstName" class="form-control" placeholder="Enter First Name" >
           <input type="text" aria-label="Middle name" id="middleName" value="<?php echo $_SESSION['middleName']; ?>" name="middleName" class="form-control" placeholder="Enter Middle Name" >
           <input type="text" aria-label="Last name" id="lastName" value="<?php echo $_SESSION['lastName']; ?>" name="lastName" class="form-control" placeholder="Enter Last Name" >
         </div>
         
         <div class="input-group mb-3 m-2">
           <span class="input-group-text" id="inputGroup-sizing-default">Job Title<strong style="color: red !important;">*</strong>:</span>
           <input type="text" class="form-control" id="job" value="<?php echo $_SESSION['jobTitle']; ?>"  name="job" placeholder="Enter Your Job Title" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
         </div>
 
         <div class="input-group mb-3 m-2">
           <span class="input-group-text" id="inputGroup-sizing-default">Email<strong style="color: red !important;">*</strong>:</span>
           <input type="text" class="form-control" value="<?php echo $_SESSION['email']; ?>" id="email" name="email" placeholder="Enter Your Official Email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  >
         </div>
 

         <div class="input-group mb-3 m-2">
           <span class="input-group-text" id="inputGroup-sizing-default">MDA<strong style="color: red !important;">*</strong>:</span>
           <input list="MDA" class="form-control MDA" value="<?php echo $_SESSION['MDA']; ?>"  placeholder="Search For Ministry" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
         <datalist  id="MDA" name="MDA">
      
         </datalist>
         </div> 

         <select class="form-select m-2" aria-label="Default select example" id="selectTicketCat" name="selectTicketCat" >
           <option selected value="">Select Ticket Category <strong style="color: red !important;">*</strong></option>
           <option value="incident">INCIDENT</option>
           <option value="request">REQUEST</option>
         </select>

         <select class="form-select m-2" aria-label="Default select example" id="issues" name="issues" >
         <option selected value="">Select The Issues<strong style="color: red !important;">*</strong></option>
         <option value="NETWORK">Network.</option>
         <option value="OFFICE 365">Office 365.</option>
         <option value="3CX">3CX.</option>
         <option value="SCANNER">Scanner.</option>
         <option value="EDOGOV PASSWORD">EdoGov Password</option>
         <option value="FAULTY LAPTOP">Faulty Laptop</option>
         <option value="EMAIL">Email.</option>
         <option value="APPLICATION SUPPORT">Application Support</option>
         <option value="NO LAPTOP">No laptop</option>
         <option value="VPN">VPN</option>
         <option value="OTHERS" style="color:red !important; font-weight: 900 !important;">Others</option>
       </select>


       <div class="input-group mb-3 m-2">
         <span class="input-group-text" >Your Description<strong style="color: red !important;">*</strong>:</span>
         <textarea class="form-control" id="description" name="description" aria-label="Your Description" ></textarea>
       </div>

         <div class="input-group mb-3 m-2">
           <input class="form-control" type="file" id="file" name="files[]" multiple>
         </div>
  

   

       <div class="input-group mb-3 m-2">
         <span class="input-group-text" id="inputGroup-sizing-default">Pick A Date<strong style="color: red !important;">*</strong>:</span>
         <input type="date" class="form-control" id="entry_date" name="entry_date" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
       </div>
       <div class="container">
         <div class="row">
               <div class="col-md-12">
                 <div class="input-group mb-3 m-2">
                   <input type="submit" class="ticket form-control btn btn-success p-2"  value="Submit Ticket" aria-describedby="inputGroup-sizing-default">
                 </div>
               
               </div>
           </div>
       </div>
   </form>




   </div><!-- endo of accordion body -->
</div>
</div>


                     <!-- long card ends here -->

                  </div><!-- end of div class col-lg-12 mb-4 mb-lg-0-->

                  </div><!-- end of 2nd row  -->

<!-- ************************************************New Row********************************************************* -->
                  <!-- section for Creating access level for Head Of Units -->

                  <div class="row">

                  <div class="col-lg-12 mb-4 mb-lg-0">
                  <?php 

// dynamic notification counts for all access levels
$accessLevelSection = "";
  
if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){

$email = $_SESSION['email'];
$accessLevel = $_SESSION['access_level'];

if ($accessLevel == 1){
//you can add sections for this access level here
}
else
if ($accessLevel == 2){
$accessLevelSection .='';
}
else
if ($accessLevel == 3){
$accessLevelSection .='';
}
else
if ($accessLevel == 4){
$accessLevelSection .='



<div class="p-2  bg-dark">

                  <div class="accordion accordion-flush" id="accordionFlushExample2">
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseOne">
            <strong ><i class="fas fa-key fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216)  !important; font-size: 40px !important;"></i> &nbsp; CREATE ACCESS LEVEL</strong>
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample2">
          <div class="bg-glass accordion-body">

                  
                      <div class="container">

                        <section class="">

                                <div class="row">

                                    <div class="col-lg-12">

                                    <center><h2 style="color:#000000">SEARCH FOR ICTA HOU(s)</h2></center> 
                                      <form  id="accessLevel">

                                          <label for="ictaNames" class="form-label">Search For Names:</label>
                                          <input class="form-control" list="getIctaNames" id="ictaNames" name="ictaNames" placeholder="Type to search names...">
                                          <datalist id="getIctaNames" >
                                          
                                          </datalist>

                     <br>
                 <center>  <button type="submit" class="form-control btn btn-success p-2" id="searchNames"  aria-describedby="inputGroup-sizing-default">View Details</button></center> 
            
                                        </form>
                                        <br>

                                        <center><div id="showStaffDetails" class="table-responsive"></div></center>


                                    </div><!-- end of col-lg-12 -->


                                </div><!-- end of row for accesslevel -->


                        </section><!-- end of section -->


                      </div><!-- end of container for access level  -->
                     



          </div><!-- endo fo accordion body -->
        </div>
      </div>
              </div>

                  </div><!-- end of p-2 bg-dark -->





';//end of access section in php code
}

}
echo $accessLevelSection;
?>
                  
                  </div><!-- end of div class col-lg-12 mb-4 mb-lg-0 -->

                 </div><!-- end of 3rd row -->


                 <!-- ************************************************New Row********************************************************* -->
                  <!-- section for viewing notificatios -->
                  <?php 

                  // dynamic notification counts for all access levels
                  $notificationCount1 = "";
          $notificationCount2 = "";   
            if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){
            
              $email = $_SESSION['email'];
              $accessLevel = $_SESSION['access_level'];
             
              if ($accessLevel == 1){

              }
              else
              if ($accessLevel == 2){
                $notificationCount2 .='<span class="countTasks" style="color:whitesmoke; background-color:red;"></span>';
              }
              else
              if ($accessLevel == 3){
                $notificationCount2 .='<span class="countTasks" style="color:whitesmoke; background-color:red;"></span>';
              }
              else
              if ($accessLevel == 4){
                $notificationCount2 .='<span class="num" style="color:whitesmoke; background-color:red;"></span>';
              }

            }

          ?>
                  <div class="row">

                  <div class="col-lg-12 mb-4 mb-lg-0">

                  <div class="p-2  bg-dark">

                  <div class="accordion accordion-flush" id="accordionFlushExample3">
      
      
                  <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
            <strong ><i class="fas fa-envelope fa-lg  text-white fa-fw m-2" style="color: rgb(7, 164, 216)  !important; font-size: 40px !important;"></i> &nbsp; NOTIFICATIONS  <?php echo $notificationCount2;  ?> </strong>
          </button>
   
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample3">
          <div class="bg-glass accordion-body">

                <!-- tabs stays here -->
                <div class="container mt-3">

                  <div class="row">

                        <div class="col-lg-12">

                        <!-- Nav tabs -->
                        <script src="js/assignedTasks.js"></script>
                        
 <!-- Tab panes -->

<?php

if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){
    $email = $_SESSION['email'];
    $accessLevel = $_SESSION['access_level'];
    $link ="";
$div = "";



 

    if ($accessLevel == 1){
     
      $link .= ' 
      <ul class="nav nav-tabs justify-content-center ">

  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="tab" href="#menu1">FEEDBACKS</a>
</li>

    </ul>
    ';


    }

    else if ($accessLevel == 2){
        $link .= ' 
        <ul class="nav nav-tabs justify-content-center ">
     
      <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#menu1">TRAY <span class="numOfOpenedTray" style="color:whitesmoke; background-color:red"></span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#menu2">FEEDBACKS</a>
  </li>
  <li class="nav-item">
  <a class="nav-link active" data-bs-toggle="tab" href="#menu3">ASSIGNED TASK(s) <span class="countTasks" style="color:whitesmoke; background-color:red;"></span></a>
  </li>
    <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#menu4">EXPORT REPORT</a>
  </li>
      </ul>
      ';
      

    }
    else if ($accessLevel == 3){
      $link .= ' 
      <ul class="nav nav-tabs justify-content-center ">
    <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#menu1">TRAY <span class="numOfOpenedTray" style="color:whitesmoke; background-color:red"></span></a>
  </li>
  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="tab" href="#menu2">FEEDBACKS</a>  <span class="commentsNotification" style="color:white !important; background-color:red"></>
</li>
<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#menu3">ASSIGNED TASK(s) <span class="countTasks" style="color:whitesmoke; background-color:red;"></span></a>
</li>
  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="tab" href="#menu4">EXPORT REPORT</a>
</li>
    </ul>
    ';
      
    }
    else if ($accessLevel == 4){
      $link .= ' 
      <ul class="nav nav-tabs justify-content-center ">
      <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#home">ASSIGN UNIT, PRIORITY & TASKS<span class="num" style="color:whitesmoke; background-color:red;"></span></a>
    </li>
  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="tab" href="#menu2">FEEDBACKS</a>
</li>
<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#menu3">ASSIGNED TASK(s) <span class="countTasks" style="color:whitesmoke; background-color:red;"></span></a>
</li>
  <li class="nav-item">
  <a class="nav-link" data-bs-toggle="tab" href="#menu4">EXPORT REPORT</a>
</li>
    </ul>
    ';
      
    }

 

}



echo '<div class="tab-content">';
     if  ($accessLevel == 1){
$div .= '<div class="tab-pane container " id="menu2">
    
<div class="mt-4 p-5  text-dark rounded">
<center><h1><u>Feedbacks / Comments</u></h1></center>
<div class="feedbacks  table-responsive"></div>

</div>

</div>
';
     }
     else if ($accessLevel == 2){
  $div .=' 
  <div class="tab-content">
<div class="tab-pane container " id="menu1">

<div class="mt-4 p-5  text-dark rounded">
<script src="js/tray_reports.js"></script>
<div class="tray table-responsive"></div>


</div>

</div>

<div class="tab-pane container " id="menu2">

<div class="mt-4 p-5  text-dark rounded">
<center><h1><u>Feedbacks / Comments</u></h1></center>
<div class="feedbacks  table-responsive"></div>
</div>

</div>

<div class="tab-pane container active" id="menu3">
    
    <div class="mt-4 p-5  text-dark rounded">
    <script src="js/countRows.js"></script>
    <script src="js/assignedTasks.js"></script>
    <center>  <h1>Tasks Assigned To You</h1></center>
    <div id="assignedTasks" class="table-responsive">

    </div>
  
    </div>
    
    </div>


<div class="tab-pane container " id="menu4">

<div class="mt-4 p-5  text-dark rounded"> 
<h1>Coming Soon!</h1>

</div>

</div>


    </div>';

     }
     else if ($accessLevel == 3){
      $div .=' 
      <div class="tab-content">
    
    
    <div class="tab-pane container " id="menu1">
    
    <div class="mt-4 p-5  text-dark rounded">
    <script src="js/tray_reports.js"></script>
    <span class="pagination1"></span>
    <span class="pagination2"></span>
    <div class="tray table-responsive"></div>
    
    
    </div>
    
    </div>
    
    <div class="tab-pane container " id="menu2">
    
    <div class="mt-4 p-5  text-dark rounded">
    <center><h1><u>Feedbacks / Comments</u></h1></center>
<div class="feedbacks  table-responsive"></div>
    
    </div>
    
    </div>

    <div class="tab-pane container active" id="menu3">
    
    <div class="mt-4 p-5  text-dark rounded">
    <script src="js/countRows.js"></script>
    <script src="js/assignedTasks.js"></script>
    <center>  <h1>Tasks Assigned To You</h1></center>
    <div id="assignedTasks" class="table-responsive">

    </div>
  
    </div>
    
    </div>
    
    <div class="tab-pane container " id="menu4">
    
    <div class="mt-4 p-5  text-dark rounded">
    <h1>Coming Soon!</h1>
    
    </div>
    
    </div>
    
    
        </div>';

    }

    else if ($accessLevel == 4){
      $div .=' 
      <div class="tab-content">
    
      <div class="tab-pane container active" id="home">
    
      <div class="mt-4 p-5 text-dark rounded">
      <center><h1>Tickets Without Assigned Units,Priority And Tasks</h1></center>
      <center><div id="tableInfo" class="table-responsive" ></div></center>
      <script src="js/countRows.js"></script>
    </div>
    </div>
    
    
    <div class="tab-pane container " id="menu1">
    
    <div class="mt-4 p-5  text-dark rounded">
    <script src="js/tray_reports.js"></script>
    <div class="tray table-responsive"></div>
    
    </div>
    
    </div>
    
    <div class="tab-pane container " id="menu2">
    
    <div class="mt-4 p-5  text-dark rounded">
    <center><h1><u>Feedbacks / Comments</u></h1></center>
    <div class="feedbacks  table-responsive"></div>

    
    <!-- end of modal -->

    </div>
    
    </div>

    <div class="tab-pane container " id="menu3">
    
    <div class="mt-4 p-5  text-dark rounded">
    <script src="js/countRows.js"></script>
    <center>  <h1>Tasks Assigned To Officer(s)</h1></center>
    <div id="assignedTasks" class="table-responsive">

    </div>
  
    </div>
    
    </div>
    
    <div class="tab-pane container " id="menu4">
    
    <div class="mt-4 p-5  text-dark rounded">
    <center>  <h1 style="color:Blue !important">EXPORT REPORT FILE TO EXCEL. </h1></center>
   <center><span class="downloadReport"> <i class="fa fa-download" ></i></span></center>
    <form id="exportForm" action="excel.php" method="post">
    <center>
    <h2>Select Start Date And End Date To Export. </h2>

    <div class="col-lg-4 m-2">
         <span class="input-group-text" id="inputGroup-sizing-default">Pick Start Date</span>
         <input type="date" class="form-control" id="selectStart" name="selectStart" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
       </div>
       <div class="col-lg-4 m-2">
       <span class="input-group-text" id="inputGroup-sizing-default">Pick End Date</span>
       <input type="date" class="form-control" id="selectEnd" name="selectEnd" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" >
   
  
       <span class="input-group-text m-2" id="inputGroup-sizing-default">Type Of Action On Tickets:</span>
        <select class="form-select" aria-label="Default select example" id="action" name="action" >
         <option value="Opened">Opened.</option>
         <option value="Closed">Closed.</option>
        </select>


     </div>


  </center>
  <center><button class="btn btn-success text-white text-lg m-2"  id="exportInExcel"><i class=" style fa fa-download" ></i>  Export Records</button>
  </center>
  </div>

    </form>
    </div>
    
    </div>
    
    
        </div>';

    }

echo '</div><!-- end of tab-content -->';
echo $link;
echo $div;
?>










<!-- end of tab-content -->

                        </div><!-- end of col-lg-12 -->

                  </div><!-- end of row -->

              </div><!-- end of container mt-3 -->

          </div><!-- endo fo accordion body -->
        </div>
      </div>
      </div>

                  </div><!-- end of p-2 bg-dark -->


                  </div><!-- end of div class col-lg-12 mb-4 mb-lg-0 -->

                 </div><!-- end of fourth row -->



                 

                </section><!-- end of section class="" -->

                <!-- end of section for creating ticket by admin  -->
                </div><!-- end of container pt-5 -->



    </div><!-- end of container pt-5 -->

<!-- ******************************************** main section starts here! **************************************************** -->
    


<?php
    if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){

      $email = $_SESSION['email'];
      $accessLevel = $_SESSION['access_level'];
        
      //set up who will be seeing this section
      if ($accessLevel == 1){
        //you can add sections for this access level here
        }
        else
        if ($accessLevel == 2){
        include("chartCountAnalysis.php");
        }
        else
        if ($accessLevel == 3){
          include("chartCountAnalysis.php");
        }
        else if ($accessLevel == 4){
          include("chartCountAnalysis.php");
          }



    }//end of isset($_SESSION['email']) && isset($_SESSION['access_level'])

?>

    <!-- section table -->

      <div class="container mb-5">

      <script src="js/tableSearch.js"></script>
          <script src="js/table_display.js"></script>

        <div class="table-responsive ticket_records bg-glass shadow-4-strong rounded-6">
          <!-- table goes here! -->
         
         
        </div>

      </div>

    <!-- End of section table -->

    <!-- section: visualization -->
    <section class="container">
    <script src="js/searchTickets.js"></script>
    <?php
    if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){

      $email = $_SESSION['email'];
      $accessLevel = $_SESSION['access_level'];
        
      //set up who will be seeing this section
      if ($accessLevel == 1){
        //you can add sections for this access level here
        
        }
        else
        if ($accessLevel == 2){
        include("chartAnalysis.php");
        }
        else
        if ($accessLevel == 3){
          include("chartAnalysis.php");
        }
        else if ($accessLevel == 4){
          include("chartAnalysis.php");
          }



    }//end of isset($_SESSION['email']) && isset($_SESSION['access_level'])

?>


        </section><!-- End of section: visualization -->
        <!-- footer section starts here -->
   <div class="container">

<div class="row">

    <div class="col-lg-12 mt-5 mb-5">

    <center><h2 style="color:whitesmoke !important; text-shadow: 2px 2px #000000; background-color:darkBlue;"> <?php  echo '<b style="color:Orange !important;">&copy; '.date('Y').' Powered By</b> <b  style="color:red !important; text-shadow: 2px 2px #000000;">EDO STATE</b> ICT AGENCY.';  ?> </h2></center>

    </div>

</div>


</div> <!-- end of container --> 

<!-- end of footer -->

    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="chart.js/dist/chart.js"></script> 
    <!-- Custom scripts -->
    <script type="text/javascript">
 $(document).ready(function(){ 

   getChartAnalysis = () => {
                  $.ajax({
          type: "POST",
          url:"chart.php",
          dataType:'json',
          cache:false,
          /* contentType: false,
          processData: false, */
          success: function(response){
           
                 //chart script starts here!

                  // var ctx = document.getElementById("barChart")
 const ctx = document.getElementById("bar-chart").getContext("2d")// added '.getContext("2d")'
 const gradientFill = ctx.createLinearGradient(0, 0, 0, 290);
  gradientFill.addColorStop(0, "hsla(0, 71%, 35%, 1)");
  gradientFill.addColorStop(1, "hsla(0, 41%, 35%, 0.2)");
const myChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: response.issues,  
    datasets: [
      {
      label: "Tickets Opened Breakdown",
      backgroundColor: gradientFill /* [
          'rgba(255, 26, 104, 0.5)',
          'rgba(54, 162, 235, 0.5)',
          'rgba(255, 206, 86, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(255, 159, 64, 0.5)',
          'rgba(0, 0, 0, 0.5)',
          'rgba(104, 102, 34, 0.5)',
          'rgba(111, 89, 68, 0.5)',
          'rgba(244, 183, 50, 0.5)'
        ] */, 
        
      borderWidth: 1,
      hoverBackgroundColor: "white",
      hoverBorderColor: "orange",
      scaleStepWidth: 1,
      data: response.occurence, 
    }
    
  
  ]
  },

  options: {
    plugins: {  // 'legend' now within object 'plugins {}'
      legend: {
        labels: {
          color: "whitesmoke",  // not 'fontColor:' anymore
          // fontSize: 18  // not 'fontSize:' anymore
          font: {
            size: 18 // 'size' now within object 'font {}'
          }
        }
      }
    },
    scales: {
      y: {  // not 'yAxes: [{' anymore (not an array anymore)
        ticks: {
          color: "whiteSmoke", // not 'fontColor:' anymore
          // fontSize: 18,
          font: {
            size: 14, // 'size' now within object 'font {}'
          },
          stepSize: 1,
          beginAtZero: true
        }
      },
      x: {  // not 'xAxes: [{' anymore (not an array anymore)
        ticks: {
          color: "whiteSmoke",  // not 'fontColor:' anymore
          //fontSize: 14,
          font: {
            size: 10 // 'size' now within object 'font {}'
          },
          stepSize: 1,
          beginAtZero: true
        }
      }
    }
  }
}); 


$(document).on('change', '#startDate,#endDate', function(){

            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            $.ajax({
          type: "post",
          url:"getDates.php",
          data: {startDate:startDate, endDate:endDate},
          dataType:'json',
          cache:false,
          success: function(info){
           //console.log(info.datesUpdated,info.issuesUpdated,info.occurenceUpdated)
            myChart.data.labels = info.issuesUpdated;
            myChart.data.datasets[0].data = info.occurenceUpdated;
            myChart.update(); 
            
          }//end of success
          
          })//end of ajax 

})//end of document onChange event
$(document).on('click', '#resetChart', function(){
            myChart.data.labels = response.issues;
            myChart.data.datasets[0].data = response.occurence;
            myChart.update(); 
            })
                 //chart script ends here!
                
          }//end of success 


        })//end of ajax request

      }//end of getChartAnalysis()



      
     setInterval( getChartAnalysis(), 3000);
      })//end of ready state    
             
          
   

    </script>
     
     <script src="js/action.js"></script>

<!-- side bar -->
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<script src="js/addMessage.js"></script>
<script src="js/modal.js"></script>
<script src="js/feedbacks.js"></script>
<!-- Modal content -->
<div id="myModal" class="modal1">
<div class="modal-content1">
  <div class="modal-header1">
    <span class="close1">&times;</span>
    <h2>Comments Box for ticket  </h2>
  </div>
  <div class="modal-body1">
  <!--modal body starts here -->
  <!--load all messages here -->
<div id="messages" class=""></div>
 
  <!-- ends here -->
  </div>
  <div class="modal-footer1">
    <button class="text btn btn-success" style="display:none"><span class="header"></span></button> 
    <form id="formReply">
    
      <center><p><input type="text" placeholder="Add Comments Here..." id="comments" name="comments" required><input type="submit"  value="Send" class="send btn btn-success"></p></center>
    </form>
  </div>
</div>
<!-- Modal content -->
  </body>


</html>

