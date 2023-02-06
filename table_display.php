<?php
session_start(); 
$assigned_To = $_SESSION['fullnames']; 
$firstName =$_SESSION['firstName'];
$middleName = $_SESSION['middleName'];
$lastName = $_SESSION['lastName'] ;
include('includes/db_connect.php');
//fetch limit data code
$limit = 4;
$page = 0;
$table= " ";
$email = "";

if (isset($_POST['page'])){
    $page = $_POST['page'];
 
}
else{
    $page = 1;
}

$start_from = ($page-1)*$limit;




if (isset($_SESSION['email']) && isset($_SESSION['access_level']) ) {

    //session variable is assigned here
    $email = $_SESSION['email'];
    $feedback ="";
    $accessLevel = $_SESSION['access_level']; 

      if ( $accessLevel == 1 ){

  //table goes here
  $table .= '


  <form class="myForm example" onSubmit="return false" style="margin:auto;max-width:800px !important; margin:12px auto !important" >
  <input type="text" placeholder="Search For Ticket No..." title="start with # then type a number!" class="searchTick" id="myInput" onkeyup="myFunction()" name="myInput">
  <center><button class="btn btn-success text-white text-lg" type="submit" id="searchTickets"  >Search For Ticket!</button>
  </center>
  </form>
  
  
  <table class="table text-white table-borderless table-hover align-middle" id="myTable">
  <thead>
  
  <tr>
  
    <th scope="col">Ticket No</th>
    <th scope="col">Names</th>
    <th scope="col">Job Title</th>
    <th scope="col">Ticket Status</th>
    <th scope="col">MDAs</th>
    <th scope="col">Issue</th>
    <th scope="col">File Attached</th>
    <th scope="col">Assigned Unit</th>
    <th scope="col">Assigned To</th>
    <th scope="col">Assigned At</th>
    <th scope="col">Priority Level</th>
    <th scope="col">Date Issued</th>
     <th scope="col">Time Created</th>
    <th scope="col">Action</th>
    
  </tr>
  </thead>
  
  ';
  
// SELECT DATA FROM DB  	access_level 
$sql = "SELECT * FROM ticket_details WHERE staff_email ='$email'  ORDER BY timeOfIssue     DESC limit $start_from, $limit ";
$result = mysqli_query($conn, $sql);

//here we check for any matching data
if (mysqli_num_rows($result) > 0)
      {
            


         // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $firstName = $row['firstName'];
        $middle_name = $row['middle_name'];
        $lastName = $row['lastName'];
        $units = $row['assign_unit'];
        $staff_email = $row['staff_email'];
        $job_title = $row['job_title'];
        $ticket_status = $row['ticket_status'];
        $MDAs = $row['MDAs'];
        $access_level = $row['access_level'];
        $ticket_no = $row['ticket_no'];
        $complaints = $row['complaints'];
        $comments = $row['comments'];
        $files = $row['files'];
        $priorityLevel = $row['priorityLevel'];
        $date_issued = $row['date_issued'];
        $timeOfIssue = $row['timeOfIssue'];
        $actionOnTickets = $row['actionOnTickets'];
        $assigned_time = $row['assigned_time']; 
        $assigned_to = $row['assigned_to']; 
        $date_issued = strtotime($date_issued);
        $date_issued = date('M d Y', $date_issued); 


            //set up  time
            include_once('agoTime.php');
            $agoTime = get_time_ago($timeOfIssue);
            
            $updatedTimeStamp = get_time_ago($assigned_time);


            //set up logic and condition for display of priority levels, action taken of tickets
   
  
            if ($actionOnTickets == "Opened" ){
 
                $actionButton = '<td id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'" ><button class="btn btn-primary">'. $actionOnTickets.'</button></td>';
            }
    
            if ($actionOnTickets == "Closed"){
    
                $actionButton  = '<td id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'" ><button class="btn btn-success">'. $actionOnTickets.'</button></td>';
                $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
            }
     
       

        if ($priorityLevel === "High"){

            $priorityLevel = '<span class="badge badge-danger rounded-pill">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Medium"){

            $priorityLevel = '<span class="badge badge-warning rounded-pill">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Low"){

            $priorityLevel = '<span class="badge badge-primary rounded-pill">'.$priorityLevel.'</span>';
        }
        if ($ticket_status === "Pending"){

            $ticket_status = '<span class="badge badge-warning rounded-pill">'.$ticket_status.'</span>';
        }

        if ($ticket_status == "Waiting"){
            $agoTime = '<strong style="color:whitesmoke !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
            $ticket_status = '<span class="badge badge-primary rounded-pill">'.$ticket_status.'</span>';
        }

        if ($ticket_status === "Attended"){

            $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
        }

        if ( $assigned_time == 0){
            $assigned_time = 'None'; 
        }else{
            $assigned_time = $updatedTimeStamp; 

        }

               //file download

               if ($files == ""){
                $files = '<td>
                <p class="fw-bold mb-1">No file(s) attached</p>
               </td>';
              }
              else{
                $files ='<td>
                <a href="uploads/'.$files.'" target="_blank">Download Attachment</a>
               </td>';
              }
        
        $table .= '
         
        <tbody>
    <tr class="text-white">

    <td>
    <p class="fw-bold mb-1">'. $ticket_no .'</p>
    </td>

    <td>
    <div class="d-flex align-items-center">
    <div class="ms-3">
    <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
    <p class="text-muted mb-0">'.$staff_email.'</p>
    </div>
    </div>
    </td>
    
    <td>
    <p class="fw-bold mb-1">'. $job_title .'</p>
    </td>
    
    <td>
    <p class="fw-bold mb-1">'. $ticket_status .'</p>
    </td>
    
    <td>
    <p class="fw-bold mb-1">'. $MDAs .'</p>
    </td>
    
    <td>
    <p class="fw-bold mb-1">'. $complaints .'</p>
    </td>
    '. $files.'
    <td>
    <p class="fw-bold mb-1">'. $units .'</p>
    </td>
    <td>
    <p class="fw-bold mb-1">'.$assigned_to.'</p>
    </td>
    <td>
    <p class="fw-bold mb-1">'.$assigned_time.'</p>
    </td>
    <td>
    <p class="fw-bold mb-1">'. $priorityLevel .'</p>
    </td>
    <td>
     <p class="fw-bold mb-1">'. $date_issued .'</p>
     </td>
     <td>
     <p class="fw-bold mb-1">'. $agoTime .'</p>
     </td>

     <td id='.$ticket_no.' class=""  >
     <p class="fw-bold mb-1"><button class="btn btn-info p-1" title="Your Ticket No: '.$ticket_no.'">'. $actionOnTickets .'</button></p>
     <p class="fw-bold mb-1"><button class="feedback btn btn-primary p-1 text-success" title="Your Feedback Is Relevant">Feedback</button></p>
     
     </td>
    
 
    
    </tr>
    </tbody>
     ';



     }//end of while loop



 
      }//end of if (mysqli_num_rows($result) > 0)


      else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
        </tr>
        ";
    }
    

            // pagination code 
$query = mysqli_query($conn, "SELECT * FROM ticket_details  WHERE staff_email ='$email' ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$limit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($page > 1){
    $previous = $page-1;
    $table .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $page){
            $active_class = "active" ;
        }
        $table .= '<li class="page-item '.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($page < $total_pages){
        $page++;
        $table .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';



      }//end of if ( $accessLevel == 1 )

      /* *********************end of $accessLevel == 1******************************** */

        /* *********************start of $accessLevel == 2******************************** */

           if ($accessLevel ==2){


                    //table goes here
$table .= '


<form class="myForm example" onSubmit="return false" style="margin:auto;max-width:800px !important; margin:12px auto !important" >
<input type="text" placeholder="Search For Ticket No..." title="start with # then type a number!" class="searchTick" id="myInput" onkeyup="myFunction()" name="myInput">
<center><button class="btn btn-success text-white text-lg" type="submit" id="searchTickets"  >Search For Ticket!</button>
</center>
</form>


<table class="table text-white table-borderless table-hover align-middle" id="myTable">
<thead>

<tr>

  <th scope="col">Ticket No</th>
  <th scope="col">Names</th>
  <th scope="col">Job Title</th>
  <th scope="col">Ticket Status</th>
  <th scope="col">MDAs</th>
  <th scope="col">Issue</th>
  <th scope="col">File Attached</th>
  <th scope="col">Assigned Unit</th>
  <th scope="col">Assigned To</th>
  <th scope="col">Assigned At</th>
  <th scope="col">Priority Level</th>
  <th scope="col">Date Issued</th>
   <th scope="col">Time Created</th>
  <th scope="col">Action</th>
  
</tr>
</thead>

';

 // SELECT DATA FROM DB  	access_level 
 $sql = "SELECT * FROM ticket_details WHERE staff_email ='$email' OR ticketCreatedBy = '$email'  ORDER BY timeOfIssue     DESC limit $start_from, $limit ";
 $result = mysqli_query($conn, $sql);

 //here we check for any matching data
 if (mysqli_num_rows($result) > 0)
{

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
     $title = $row['title'];
     $firstName = $row['firstName'];
     $middle_name = $row['middle_name'];
     $lastName = $row['lastName'];
     $units = $row['assign_unit'];
     $staff_email = $row['staff_email'];
     $job_title = $row['job_title'];
     $ticket_status = $row['ticket_status'];
     $MDAs = $row['MDAs'];
     $access_level = $row['access_level'];
     $ticket_no = $row['ticket_no'];
     $complaints = $row['complaints'];
     $comments = $row['comments'];
     $files = $row['files'];
     $priorityLevel = $row['priorityLevel'];
     $date_issued = $row['date_issued'];
     $timeOfIssue = $row['timeOfIssue'];
     $actionOnTickets = $row['actionOnTickets'];
     $assigned_time = $row['assigned_time']; 
     $assigned_to = $row['assigned_to']; 
     $date_issued = strtotime($date_issued);
     $date_issued = date('M d Y', $date_issued); 


         //set up  time
         include_once('agoTime.php');
         $agoTime = get_time_ago($timeOfIssue);
         
         $updatedTimeStamp = get_time_ago($assigned_time);


         //set up logic and condition for display of priority levels, action taken of tickets


         if ($actionOnTickets == "Opened" ){
        
            $actionOnTickets = '<td   ><button class="btn btn-primary">'. $actionOnTickets.'</button></td>';
            $takeActionOnTicket = '<div class="btn-group dropstart">
            <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
              Take Action
            </button>
            <ul class="dropdown-menu">
              <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
              <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
          
            </ul>
          </div> 
          ';
           }
       
       else if ($actionOnTickets == "Closed"){
       
            $actionOnTickets  = '<td  ><button class="btn btn-success">'. $actionOnTickets.'</button></td>';
            $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
        
            $takeActionOnTicket = '<div class="btn-group dropstart">
            <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
              Take Action
            </button>
            <ul class="dropdown-menu">
            
              <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
              <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
            </ul>
          </div>';
           }
     

     if ($priorityLevel === "High"){

         $priorityLevel = '<span class="badge badge-danger rounded-pill">'.$priorityLevel.'</span>';
     }

     if ($priorityLevel === "Medium"){

         $priorityLevel = '<span class="badge badge-warning rounded-pill">'.$priorityLevel.'</span>';
     }

     if ($priorityLevel === "Low"){

         $priorityLevel = '<span class="badge badge-primary rounded-pill">'.$priorityLevel.'</span>';
     }
     if ($ticket_status === "Pending"){

         $ticket_status = '<span class="badge badge-warning rounded-pill">'.$ticket_status.'</span>';
     }

     if ($ticket_status == "Waiting"){
         $agoTime = '<strong style="color:whitesmoke !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
         $ticket_status = '<span class="badge badge-primary rounded-pill">'.$ticket_status.'</span>';
     }

     if ($ticket_status === "Attended"){

         $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
     }

     if ( $assigned_time == 0){
         $assigned_time = 'None'; 
     }else{
         $assigned_time = $updatedTimeStamp; 

     }

         //file download

         if ($files == ""){
          $files = '<td>
          <p class="fw-bold mb-1">No file(s) attached</p>
         </td>';
        }
        else{
          $files ='<td>
          <a href="uploads/'.$files.'" target="_blank">Download Attachment</a>
         </td>';
        }
     
     $table .= '
      
     <tbody>
 <tr class="text-white">

 <td>
 <p class="fw-bold mb-1">'. $ticket_no .'</p>
 </td>

 <td>
 <div class="d-flex align-items-center">
 <div class="ms-3">
 <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
 <p class="text-muted mb-0">'.$staff_email.'</p>
 </div>
 </div>
 </td>
 
 <td>
 <p class="fw-bold mb-1">'. $job_title .'</p>
 </td>
 
 <td>
 <p class="fw-bold mb-1">'. $ticket_status .'</p>
 </td>
 
 <td>
 <p class="fw-bold mb-1">'. $MDAs .'</p>
 </td>
 
 <td>
 <p class="fw-bold mb-1">'. $complaints .'</p>
 </td>
 '.$files.'
 <td>
 <p class="fw-bold mb-1">'. $units .'</p>
 </td>
 <td>
 <p class="fw-bold mb-1">'.$assigned_to.'</p>
 </td>
 <td>
 <p class="fw-bold mb-1">'.$assigned_time.'</p>
 </td>
 <td>
 <p class="fw-bold mb-1">'. $priorityLevel .'</p>
 </td>
 <td>
  <p class="fw-bold mb-1">'. $date_issued .'</p>
  </td>
  <td>
  <p class="fw-bold mb-1">'. $agoTime .'</p>
  </td>

'. $actionOnTickets .'
 
<td>
'.$takeActionOnTicket .'
</td>
 
 </tr>
 </tbody>
  ';



  }//end of while loop



}//end of if (mysqli_num_rows($result) > 0)
else{
 $table .= "
 <tr>
 <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
 </tr>
 ";
}


// pagination code 
$query = mysqli_query($conn, "SELECT * FROM ticket_details  WHERE staff_email ='$email' ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$limit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($page > 1){
    $previous = $page-1;
    $table .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $page){
            $active_class = "active" ;
        }
        $table .= '<li class="page-item '.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($page < $total_pages){
        $page++;
        $table .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';


           }//end of if ($accessLevel ==2)

         /* *********************end of $accessLevel == 2******************************** */

         

         /* *********************start of $accessLevel == 3******************************** */


         if ($accessLevel ==3){


            //table goes here
$table .= '


<form class="myForm example" onSubmit="return false" style="margin:auto;max-width:800px !important; margin:12px auto !important" >
<input type="text" placeholder="Search For Ticket No..." title="start with # then type a number!" class="searchTick" id="myInput" onkeyup="myFunction()" name="myInput">
<center><button class="btn btn-success text-white text-lg" type="submit" id="searchTickets"  >Search For Ticket!</button>
</center>
</form>


<table class="table text-white table-borderless table-hover align-middle" id="myTable">
<thead>

<tr>

<th scope="col">Ticket No</th>
<th scope="col">Names</th>
<th scope="col">Job Title</th>
<th scope="col">Ticket Status</th>
<th scope="col">MDAs</th>
<th scope="col">Issue</th>
<th scope="col">File Attached</th>
<th scope="col">Assigned Unit</th>
<th scope="col">Assigned To</th>
<th scope="col">Assigned At</th>
<th scope="col">Priority Level</th>
<th scope="col">Date Issued</th>
<th scope="col">Time Created</th>
<th scope="col">Action</th>

</tr>
</thead>

';

// SELECT DATA FROM DB  	access_level 
$sql = "SELECT * FROM ticket_details WHERE staff_email ='$email' OR ticketCreatedBy = '$email' OR  assigned_to LIKE '%$lastName%'  ORDER BY timeOfIssue   DESC limit $start_from, $limit ";
$result = mysqli_query($conn, $sql);

//here we check for any matching data
if (mysqli_num_rows($result) > 0)
{

// output data of each row
while($row = mysqli_fetch_assoc($result)) {
$title = $row['title'];
$firstName = $row['firstName'];
$middle_name = $row['middle_name'];
$lastName = $row['lastName'];
$units = $row['assign_unit'];
$staff_email = $row['staff_email'];
$job_title = $row['job_title'];
$ticket_status = $row['ticket_status'];
$MDAs = $row['MDAs'];
$access_level = $row['access_level'];
$ticket_no = $row['ticket_no'];
$complaints = $row['complaints'];
$comments = $row['comments'];
$files = $row['files'];
$priorityLevel = $row['priorityLevel'];
$date_issued = $row['date_issued'];
$timeOfIssue = $row['timeOfIssue'];
$actionOnTickets = $row['actionOnTickets'];
$assigned_time = $row['assigned_time']; 
$assigned_to = $row['assigned_to']; 
$date_issued = strtotime($date_issued);
$date_issued = date('M d Y', $date_issued); 


 //set up  time
 include_once('agoTime.php');
 $agoTime = get_time_ago($timeOfIssue);
 
 $updatedTimeStamp = get_time_ago($assigned_time);


 //set up logic and condition for display of priority levels, action taken of tickets


 if ($actionOnTickets == "Opened" ){
        
    $actionOnTickets = '<td   ><button class="btn btn-primary">'. $actionOnTickets.'</button></td>';
    $takeActionOnTicket = '<div class="btn-group dropstart">
    <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
      Take Action
    </button>
    <ul class="dropdown-menu">
      <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
      <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
  
    </ul>
  </div> 
  ';
   }

else if ($actionOnTickets == "Closed"){

    $actionOnTickets  = '<td  ><button class="btn btn-success">'. $actionOnTickets.'</button></td>';
    $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';

    $takeActionOnTicket = '<div class="btn-group dropstart">
    <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
      Take Action
    </button>
    <ul class="dropdown-menu">
    
      <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
      <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
    </ul>
  </div>';
   }



if ($priorityLevel === "High"){

 $priorityLevel = '<span class="badge badge-danger rounded-pill">'.$priorityLevel.'</span>';
}

if ($priorityLevel === "Medium"){

 $priorityLevel = '<span class="badge badge-warning rounded-pill">'.$priorityLevel.'</span>';
}

if ($priorityLevel === "Low"){

 $priorityLevel = '<span class="badge badge-primary rounded-pill">'.$priorityLevel.'</span>';
}
if ($ticket_status === "Pending"){

 $ticket_status = '<span class="badge badge-warning rounded-pill">'.$ticket_status.'</span>';
}

if ($ticket_status == "Waiting"){
 $agoTime = '<strong style="color:whitesmoke !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
 $ticket_status = '<span class="badge badge-primary rounded-pill">'.$ticket_status.'</span>';
}

if ($ticket_status === "Attended"){

 $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
}

if ( $assigned_time == 0){
 $assigned_time = 'None'; 
}else{
 $assigned_time = $updatedTimeStamp; 

}

     //file download

     if ($files == ""){
      $files = '<td>
      <p class="fw-bold mb-1">No file(s) attached</p>
     </td>';
    }
    else{
      $files ='<td>
      <a href="uploads/'.$files.'" target="_blank">Download Attachment</a>
     </td>';
    }
    

$table .= '

<tbody>
<tr class="text-white">

<td>
<p class="fw-bold mb-1">'. $ticket_no .'</p>
</td>

<td>
<div class="d-flex align-items-center">
<div class="ms-3">
<p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
<p class="text-muted mb-0">'.$staff_email.'</p>
</div>
</div>
</td>

<td>
<p class="fw-bold mb-1">'. $job_title .'</p>
</td>

<td>
<p class="fw-bold mb-1">'. $ticket_status .'</p>
</td>

<td>
<p class="fw-bold mb-1">'. $MDAs .'</p>
</td>

<td>
<p class="fw-bold mb-1">'. $complaints .'</p>
</td>

'.$files.'

<td>
<p class="fw-bold mb-1">'. $units .'</p>
</td>
<td>
<p class="fw-bold mb-1">'.$assigned_to.'</p>
</td>
<td>
<p class="fw-bold mb-1">'.$assigned_time.'</p>
</td>
<td>
<p class="fw-bold mb-1">'. $priorityLevel .'</p>
</td>
<td>
<p class="fw-bold mb-1">'. $date_issued .'</p>
</td>
<td>
<p class="fw-bold mb-1">'. $agoTime .'</p>
</td>
'. $actionOnTickets .'
<td>
'.$takeActionOnTicket .'
</td>
</tr>
</tbody>
';



}//end of while loop



}//end of if (mysqli_num_rows($result) > 0)
else{
$table .= "
<tr>
<td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
</tr>
";
}


// pagination code 
$query = mysqli_query($conn, "SELECT * FROM ticket_details  WHERE staff_email ='$email' ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$limit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($page > 1){
    $previous = $page-1;
    $table .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $page){
            $active_class = "active" ;
        }
        $table .= '<li class="page-item '.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($page < $total_pages){
        $page++;
        $table .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';


   }//end of if ($accessLevel ==3)



         /* *********************end of $accessLevel == 3******************************** */


                  /* *********************start of $accessLevel == 4******************************** */


                  if ($accessLevel ==4){


                    //table goes here
        $table .= '
        
        
        <form class="myForm example" onSubmit="return false" style="margin:auto;max-width:800px !important; margin:12px auto !important" >
        <input type="text" placeholder="Search For Ticket No..." title="start with # then type a number!" class="searchTick" id="myInput" onkeyup="myFunction()" name="myInput">
        <center><button class="btn btn-success text-white text-lg" type="submit" id="searchTickets"  >Search For Ticket!</button>
        </center>
        </form>
        
        
        <table class="table text-white table-borderless table-hover align-middle" id="myTable">
        <thead>
        
        <tr>
        
        <th scope="col">Ticket No</th>
        <th scope="col">Names</th>
        <th scope="col">Job Title</th>
        <th scope="col">Ticket Status</th>
        <th scope="col">MDAs</th>
        <th scope="col">Issue</th>
        <th scope="col">File Attached</th>
        <th scope="col">Assigned Unit</th>
        <th scope="col">Assigned To</th>
        <th scope="col">Assigned At</th>
        <th scope="col">Priority Level</th>
        <th scope="col">Date Issued</th>
        <th scope="col">Time Created</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
        </thead>
        
        ';
        
        // SELECT DATA FROM DB  
        $sql = "SELECT * FROM ticket_details   ORDER BY timeOfIssue DESC limit $start_from, $limit ";
        $result = mysqli_query($conn, $sql);
        
        //here we check for any matching data
        if (mysqli_num_rows($result) > 0)
        {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) { 
        $title = $row['title'];
        $firstName = $row['firstName'];
        $middle_name = $row['middle_name'];
        $lastName = $row['lastName'];
        $units = $row['assign_unit'];
        $staff_email = $row['staff_email'];
        $job_title = $row['job_title'];
        $ticket_status = $row['ticket_status'];
        $MDAs = $row['MDAs'];
        $access_level = $row['access_level'];
        $ticket_no = $row['ticket_no'];
        $complaints = $row['complaints'];
        $comments = $row['comments'];
        $files = $row['files'];
        $priorityLevel = $row['priorityLevel'];
        $date_issued = $row['date_issued'];
        $timeOfIssue = $row['timeOfIssue'];
        $actionOnTickets = $row['actionOnTickets'];
        $assigned_time = $row['assigned_time']; 
        $assigned_to = $row['assigned_to']; 
        $date_issued = strtotime($date_issued);
        $date_issued = date('M d Y', $date_issued); 
        
        
         //set up  time
         include_once('agoTime.php');
         $agoTime = get_time_ago($timeOfIssue);
         
         $updatedTimeStamp = get_time_ago($assigned_time);
        
        
         //set up logic and condition for display of priority levels, action taken of tickets
        
      
        
         if ($actionOnTickets == "Opened" ){
        
             $actionOnTickets = '<td   ><button class="btn btn-primary">'. $actionOnTickets.'</button></td>';
             $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
               <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
           
             </ul>
           </div> 
           ';
            }
        
        else if ($actionOnTickets == "Closed"){
        
             $actionOnTickets  = '<td  ><button class="btn btn-success">'. $actionOnTickets.'</button></td>';
             $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
         
             $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
             
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
               <li id='.$ticket_no.' class="" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Add Comment Only</a></li>
             </ul>
           </div>';
            }
     
        
        
        if ($priorityLevel === "High"){
        
         $priorityLevel = '<span class="badge badge-danger rounded-pill">'.$priorityLevel.'</span>';
        }
        
        if ($priorityLevel === "Medium"){
        
         $priorityLevel = '<span class="badge badge-warning rounded-pill">'.$priorityLevel.'</span>';
        }
        
        if ($priorityLevel === "Low"){
        
         $priorityLevel = '<span class="badge badge-primary rounded-pill">'.$priorityLevel.'</span>';
        }
        if ($ticket_status === "Pending"){
        
         $ticket_status = '<span class="badge badge-warning rounded-pill">'.$ticket_status.'</span>';
        }
        
        if ($ticket_status == "Waiting"){
         $agoTime = '<strong style="color:whitesmoke !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
         $ticket_status = '<span class="badge badge-primary rounded-pill">'.$ticket_status.'</span>';
        }
        
        if ($ticket_status === "Attended"){
        
         $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
        }
        
        if ( $assigned_time == 0){
         $assigned_time = 'None'; 
        }else{
         $assigned_time = $updatedTimeStamp; 
        
        }

        //file download

        if ($files == ""){
          $files = '<td>
          <p class="fw-bold mb-1">No file(s) attached</p>
         </td>';
        }
        else{
          $files ='<td>
          <a href="uploads/'.$files.'" target="_blank">Download Attachment</a>
         </td>';
        }
        
        $table .= '
        
        <tbody>
        <tr class="text-white">
        
        <td>
        <p class="fw-bold mb-1">'. $ticket_no .'</p>
        </td>
        
        <td>
        <div class="d-flex align-items-center">
        <div class="ms-3">
        <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
        <p class="text-muted mb-0">'.$staff_email.'</p>
        </div>
        </div>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $job_title .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $ticket_status .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $MDAs .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $complaints .'</p>
        </td>
        '.$files.'
        <td>
        <p class="fw-bold mb-1">'. $units .'</p>
        </td>
        <td>
        <p class="fw-bold mb-1">'.$assigned_to.'</p>
        </td>
        <td>
        <p class="fw-bold mb-1">'.$assigned_time.'</p>
        </td>
        <td>
        <p class="fw-bold mb-1">'. $priorityLevel .'</p>
        </td>
        <td>
        <p class="fw-bold mb-1">'. $date_issued .'</p>
        </td>
        <td>
        <p class="fw-bold mb-1">'. $agoTime .'</p>
        </td>
        
  '. $actionOnTickets .'
        
       <td>
        '.$takeActionOnTicket .'
       </td>
        
        </tr>
        </tbody>
        ';
        
        
        
        }//end of while loop
        
        
        
        }//end of if (mysqli_num_rows($result) > 0)
        else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
        </tr>
        ";
        }
        
       // pagination code 
$query = mysqli_query($conn, "SELECT * FROM ticket_details  ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$limit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($page > 1){
    $previous = $page-1;
    $table .= '<li class="page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="page-item" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $page){
            $active_class = "active" ;
        }
        $table .= '<li class="page-item '.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($page < $total_pages){
        $page++;
        $table .= '<li class="page-item" id="'.$page.'"><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="page-item" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>'; 
        
        
        
           }//end of if ($accessLevel ==4)





                  /* *********************end of $accessLevel == 4******************************** */

}//end of if (isset($_SESSION['email']) && isset($_SESSION['access_level']) == 1) 
/* **************************************************************************************************************************************** */







/* **************************************************************************************************************************************************************************************************** */

$table .= '
            </table>

';






echo $table;


?>