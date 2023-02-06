<?php

session_start();

 
//fetch limit data code
 

$table= " ";
$email = "";
$accessLevel="";
$feedback = "";






if (isset($_SESSION['email']) && isset($_SESSION['access_level']) ){

    $email = $_SESSION['email'];
    $accessLevel = $_SESSION['access_level'];


include('includes/db_connect.php');

if ($accessLevel == 4){   

// SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details WHERE assigned_to != ''  AND actionOnTickets = 'Opened' ORDER BY assigned_time   DESC limit 6 ";
$result = mysqli_query($conn, $sql);



//table goes here
$table .= '

<table class="table text-white table-borderless  align-middle" id="None_P_A">
<thead>

<tr>
<th scope="col">Ticket No</th>
<th scope="col">Names</th>
<th scope="col">Ticket Status</th>
<th scope="col">MDAs</th>
<th scope="col">Issue</th>
<th scope="col">Description</th>
<th scope="col">Assigned Unit</th>
<th scope="col">Assigned To</th>
<th scope="col">Re-assigned To</th>
<th scope="col">Assigned At</th>
<th scope="col">Priority Level</th>
<th scope="col">Date Issued</th>
 <th scope="col">Time Created</th>
<th scope="col">Status</th>
<th scope="col">Re-assign</th>
<th scope="col">Action</th>
</tr>
</thead>

 

';

if (mysqli_num_rows($result) > 0)
{
         // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $title = $row['title'];
    $fullNames  = $row['fullNames'];
    $units = $row['assign_unit'];
    $staff_email = $row['staff_email'];
    $job_title = $row['job_title'];
    $ticket_status = $row['ticket_status'];
    $MDAs = $row['MDAs'];
    $ticket_no = $row['ticket_no'];
    $complaints = $row['complaints'];
    $comments = $row['comments'];
    $assigned_to = $row['assigned_to'];
    $newOfficer = $row['newOfficer'];
    $files = $row['files'];
    $priorityLevel = $row['priorityLevel'];
    $date_issued = $row['date_issued'];
    $timeOfIssue = $row['timeOfIssue'];
    $actionOnTickets = $row['actionOnTickets'];
    $date_issued = strtotime($date_issued);
    $date_issued = date('M d Y', $date_issued);
    $assigned_time = $row['assigned_time']; 

            //set up  time
            include_once('agoTime.php');
            $agoTime = get_time_ago($timeOfIssue);
            
            //$updatedTime = get_time_ago($assigned_time);
            $updatedTimeStamp = get_time_ago($assigned_time);

           // cut down length of description with this script
           $string = strip_tags($comments);
           if (strlen($string) > 5){
               //truncate
               $stringCut = substr($string, 0, 15);
       $endPoint = strrpos($stringCut,'');
       $continueReading = substr($string,  19);

       $string = $stringCut;
       
     }//end of if (strlen($string) > 20)

            //set up logic and condition for display of priority levels, action taken of tickets

            if ($actionOnTickets == "Opened" ){

                $actionOnTickets = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-primary">'. $actionOnTickets.'</button></td>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
              
           
             </ul>
           </div> 
           ';
           
            }
    
            if ($actionOnTickets == "Closed"){
    
                $actionOnTickets  = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-success">'. $actionOnTickets.'</button></td>';
                $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
             
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
           
             </ul>
           </div>';
           
            }
        

        if ($priorityLevel === "High"){  

            $priorityLevel = '<span class="badge badge-danger rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Medium"){

            $priorityLevel = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
        }

        if ($priorityLevel === "Low"){

            $priorityLevel = '<span class="badge badge-primary rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
        }
        if ($ticket_status === "Pending"){

            $ticket_status = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
        }

        if ($ticket_status == "Waiting"){
            $agoTime = '<strong style="color:#000000 !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
            $ticket_status = '<span class="badge badge-primary rounded-pill text-dark text-lg">'.$ticket_status.'</span>';
        }

        if ($ticket_status === "Attended"){

            $ticket_status = '<span class="badge badge-success rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
        }

        if ($units === "Help Desk Will Assign!" && $priorityLevel == "Help Desk Will Assign!"){
            $priorityLevel = '<span class="badge badge-info rounded-pill">None</span>';
            $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">None</span>';
        }else{
            $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">'.$units.'</span>';     
            $priorityLevel = $priorityLevel ;
        }

        if ( $assigned_time == 0){
            $assigned_time = 'None'; 
        }else{
            $assigned_time = '<span class="badge badge-warnig rounded-pill text-dark text-lg">'.$updatedTimeStamp.'</span>'; 

        }





   
        $table .= '
         
            <tbody>
        <tr class="text-white">
    
        <td class="one">
        <p class="fw-bold mb-1">'. $ticket_no .'</p>
        </td>

        <td class="one">
        <div class="d-flex align-items-center">
        <div class="ms-3">
        <p class="fw-bold mb-1">'. $fullNames.'</p>
        <p class="mb-0">'.$staff_email.'</p>
        </div>
        </div>
        </td>
       
        <td class="one">
        <p class="fw-bold mb-1">'. $ticket_status .'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'. $MDAs .'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'. $complaints.'</p>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'. $units .'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$assigned_to.'</p> 
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$newOfficer.'</p> 
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$assigned_time.'</p> 
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$priorityLevel.'</p>  
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$date_issued.'</p> 
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$agoTime.'</p> 
        </td>

        '.$actionOnTickets.'

     

        <td class="one" class=""  >
        <p class="fw-bold mb-1"><button  data-id='.$ticket_no.' class="reassign btn btn-primary p-2 text-white" title="Reassign ticket no: '.$ticket_no.'">Reassign </button></p>
        </td>

        <td class="one" >
        '.$takeActionOnTicket .'
       </td>
     
        </tr>
        </tbody>
         ';
        

 }// end of while($row = mysqli_fetch_assoc($result))


}// if (mysqli_num_rows($result) > 0)

else {
    $table .= "
    <tr>
   <td></td> <td></td> <td></td><td>Records Not Available</td><td></td><td></td><td></td>
    </tr>
    ";
}

  


$countRec = "SELECT *, COUNT(*) AS prior_units FROM ticket_details WHERE assigned_to != ''    AND actionOnTickets = 'Opened' ORDER BY id DESC ";
$countRecresult = mysqli_query($conn, $countRec);
if (mysqli_num_rows($result) > 0)
{
            // output data of each row
 while($row2 = mysqli_fetch_assoc($countRecresult)) {
    $priority_unitsCounts = $row2['prior_units']; 

 }
  
}


        }//end of if ($accessLevel == 4)

  /* *****************************************************end of if accesslevel == 4****************************************************************** */     
  
  
  
  /* *************************************start of access level 3*********************************** */
  

  if ($accessLevel == 3){   
    include('includes/db_connect.php');
  // SELECT DATA FROM DB
  $sql_stmt = "SELECT * FROM users WHERE email_address = '$email' limit 1 ";
  $returnResults = mysqli_query($conn, $sql_stmt);
    while($res = mysqli_fetch_assoc($returnResults)){
        $firstName = $res["firstName"];
        $middleName = $res["middleName"];
        $lastName = $res['lastName'];

    }

  $sql = "SELECT * FROM ticket_details WHERE assigned_to = '$firstName $middleName $lastName' AND actionOnTickets = 'Opened' ORDER BY assigned_time   DESC limit 6  ";
  $result = mysqli_query($conn, $sql);
  
  
  
  //table goes here
  $table .= '
  
  <table class="table text-white table-borderless  align-middle" id="None_P_A">
  <thead>
  
  <tr>
  <th scope="col">Ticket No</th>
  <th scope="col">Names</th>
  <th scope="col">Ticket Status</th>
  <th scope="col">MDAs</th>
  <th scope="col">Issue</th>
  <th scope="col">Description</th>
  <th scope="col">Assigned Unit</th>
  <th scope="col">Assigned To</th>
  <th scope="col">Assigned At</th>
  <th scope="col">Priority Level</th>
  <th scope="col">Date Issued</th>
   <th scope="col">Time Created</th>
   <th scope="col">Status</th>
   <th scope="col">Re-assign</th>
   <th scope="col">Action</th>
  
  </tr>
  </thead>
  
  
  
  ';
  
  if (mysqli_num_rows($result) > 0)
  {
           // output data of each row
   while($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $title = $row['title'];
      $fullNames  = $row['fullNames'];
      $units = $row['assign_unit'];
      $staff_email = $row['staff_email'];
      $job_title = $row['job_title'];
      $ticket_status = $row['ticket_status'];
      $MDAs = $row['MDAs'];
      $ticket_no = $row['ticket_no'];
      $complaints = $row['complaints'];
      $comments = $row['comments'];
      $assigned_to = $row['assigned_to'];
      $files = $row['files'];
      $priorityLevel = $row['priorityLevel'];
      $date_issued = $row['date_issued'];
      $timeOfIssue = $row['timeOfIssue'];
      $actionOnTickets = $row['actionOnTickets'];
      $date_issued = strtotime($date_issued);
      $date_issued = date('M d Y', $date_issued);
      $assigned_time = $row['assigned_time']; 
  
              //set up  time
              include_once('agoTime.php');
              $agoTime = get_time_ago($timeOfIssue);
              
              //$updatedTime = get_time_ago($assigned_time);
              $updatedTimeStamp = get_time_ago($assigned_time);
  
             // cut down length of description with this script
             $string = strip_tags($comments);
             if (strlen($string) > 5){
                 //truncate
                 $stringCut = substr($string, 0, 15);
         $endPoint = strrpos($stringCut,'');
         $continueReading = substr($string,  19);
  
         $string = $stringCut;
         
       }//end of if (strlen($string) > 20)
  
              //set up logic and condition for display of priority levels, action taken of tickets
  
              if ($actionOnTickets == "Opened" ){

                $actionOnTickets = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-primary">'. $actionOnTickets.'</button></td>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
              
           
             </ul>
           </div> 
           ';
           
            }
    
            if ($actionOnTickets == "Closed"){
    
                $actionOnTickets  = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-success">'. $actionOnTickets.'</button></td>';
                $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
             
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
           
             </ul>
           </div>';
           
            }
  
          if ($priorityLevel === "High"){ 
  
              $priorityLevel = '<span class="badge badge-danger rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
          }
  
          if ($priorityLevel === "Medium"){
  
              $priorityLevel = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
          }
  
          if ($priorityLevel === "Low"){
  
              $priorityLevel = '<span class="badge badge-primary rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
          }
          if ($ticket_status === "Pending"){
  
              $ticket_status = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
          }
  
          if ($ticket_status == "Waiting"){
              $agoTime = '<strong style="color:#000000 !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
              $ticket_status = '<span class="badge badge-primary rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
          }
  
          if ($ticket_status === "Attended"){
  
              $ticket_status = '<span class="badge badge-success rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
          }
  
          if ($units === "Help Desk Will Assign!" && $priorityLevel == "Help Desk Will Assign!"){
              $priorityLevel = '<span class="badge badge-info rounded-pill">None</span>';
              $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">None</span>';
          }else{
              $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">'.$units.'</span>';     
              $priorityLevel = $priorityLevel ;
          }
  
          if ( $assigned_time == 0){
              $assigned_time = 'None'; 
          }else{
              $assigned_time = '<span class="badge badge-warnig rounded-pill text-dark text-lg">'.$updatedTimeStamp.'</span>'; 
  
          }
  
  
  
  
  
     
          $table .= '
           
              <tbody>
          <tr class="text-white">
      
          <td class="one">
          <p class="fw-bold mb-1">'. $ticket_no .'</p>
          </td>
  
          <td class="one">
          <div class="d-flex align-items-center">
          <div class="ms-3">
          <p class="fw-bold mb-1">'. $fullNames.'</p>
          <p class="mb-0">'.$staff_email.'</p>
          </div>
          </div>
          </td>
         
          <td class="one">
          <p class="fw-bold mb-1">'. $ticket_status .'</p>
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'. $MDAs .'</p>
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'. $complaints.'</p>
          </td>
          
          <td class="one">
          <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'. $units .'</p>
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'.$assigned_to.'</p> 
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'.$assigned_time.'</p> 
          </td>
          <td class="one">
          <p class="fw-bold mb-1">'.$priorityLevel.'</p>  
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'.$date_issued.'</p> 
          </td>
  
          <td class="one">
          <p class="fw-bold mb-1">'.$agoTime.'</p> 
          </td>
  
          '.$actionOnTickets.'
  
          <td class="one" class=""  >
          <p class="fw-bold mb-1"><button  data-id='.$ticket_no.' class="reassign btn btn-primary p-2 text-white" title="Reassign ticket no: '.$ticket_no.'">Reassign </button></p>
          </td>
          <td class="one" >
          '.$takeActionOnTicket .'
         </td>
          </tr>
          </tbody>
           ';
          
  
   }// end of while($row = mysqli_fetch_assoc($result))
  
  
  }// if (mysqli_num_rows($result) > 0)
  
  else {
      $table .= "
      <tr>
     <td></td> <td></td> <td></td><td>Records Not Available</td><td></td><td></td><td></td>
      </tr>
      ";
  }
  



  
$countRec = "SELECT *, COUNT(*) AS prior_units FROM ticket_details WHERE assigned_to =  '$firstName $middleName $lastName'  AND actionOnTickets = 'Opened' ORDER BY id DESC ";
  $countRecresult = mysqli_query($conn, $countRec);
  if (mysqli_num_rows($result) > 0)
  {
              // output data of each row
   while($row2 = mysqli_fetch_assoc($countRecresult)) {
      $priority_unitsCounts = $row2['prior_units']; 
  
   }
    
  }
  
  
   

  
          }//end of if ($accessLevel == 3)
  
  

   /* **************************************end of access level 3************************************* */
   
   
   
   
   /* ********************************start of access level 2 ****************************************** */


   include('includes/db_connect.php');

   if ($accessLevel == 2){   
   
   // SELECT DATA FROM DB
   $sql_stmt = "SELECT * FROM users WHERE email_address = '$email' limit 1 ";
   $returnResults = mysqli_query($conn, $sql_stmt);
     while($res = mysqli_fetch_assoc($returnResults)){
         $firstName = $res["firstName"];
         $middleName = $res["middleName"];
         $lastName = $res['lastName'];
 
     }
 
   $sql = "SELECT * FROM ticket_details WHERE assigned_to = '$firstName $middleName $lastName' AND actionOnTickets = 'Opened' ORDER BY assigned_time   DESC limit 6 ";
   $result = mysqli_query($conn, $sql);
   
   
   
   //table goes here
   $table .= '
   
   <table class="table text-white table-borderless  align-middle" id="None_P_A">
   <thead>
   
   <tr>
   <th scope="col">Ticket No</th>
   <th scope="col">Names</th>
   <th scope="col">Ticket Status</th>
   <th scope="col">MDAs</th>
   <th scope="col">Issue</th>
   <th scope="col">Description</th>
   <th scope="col">Assigned Unit</th>
   <th scope="col">Assigned To</th>
   <th scope="col">Assigned At</th>
   <th scope="col">Priority Level</th>
   <th scope="col">Date Issued</th>
    <th scope="col">Time Created</th>
    <th scope="col">Status</th>
    <th scope="col">Re-assign</th>
    <th scope="col">Action</th>
   
   </tr>
   </thead>
   
   
   
   ';
   
   if (mysqli_num_rows($result) > 0)
   {
            // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       $id = $row['id'];
       $title = $row['title'];
       $fullNames  = $row['fullNames'];
       $units = $row['assign_unit'];
       $staff_email = $row['staff_email'];
       $job_title = $row['job_title'];
       $ticket_status = $row['ticket_status'];
       $MDAs = $row['MDAs'];
       $ticket_no = $row['ticket_no'];
       $complaints = $row['complaints'];
       $comments = $row['comments'];
       $assigned_to = $row['assigned_to'];
       $files = $row['files'];
       $priorityLevel = $row['priorityLevel'];
       $date_issued = $row['date_issued'];
       $timeOfIssue = $row['timeOfIssue'];
       $actionOnTickets = $row['actionOnTickets'];
       $date_issued = strtotime($date_issued);
       $date_issued = date('M d Y', $date_issued);
       $assigned_time = $row['assigned_time']; 
   
               //set up  time
               include_once('agoTime.php');
               $agoTime = get_time_ago($timeOfIssue);
               
               //$updatedTime = get_time_ago($assigned_time);
               $updatedTimeStamp = get_time_ago($assigned_time);
   
              // cut down length of description with this script
              $string = strip_tags($comments);
              if (strlen($string) > 5){
                  //truncate
                  $stringCut = substr($string, 0, 15);
          $endPoint = strrpos($stringCut,'');
          $continueReading = substr($string,  19);
   
          $string = $stringCut;
          
        }//end of if (strlen($string) > 20)
   
               //set up logic and condition for display of priority levels, action taken of tickets
   
               if ($actionOnTickets == "Opened" ){

                $actionOnTickets = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-primary">'. $actionOnTickets.'</button></td>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#">Close And Add Comment</a></li>
              
           
             </ul>
           </div> 
           ';
           
            }
    
            if ($actionOnTickets == "Closed"){
    
                $actionOnTickets  = '<td  class=" one"  ><button id='.$ticket_no.' class=" btn btn-success">'. $actionOnTickets.'</button></td>';
                $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
                $takeActionOnTicket = '<div class="btn-group dropstart">
             <button type="button" class="btn btn-primary dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
               Take Action
             </button>
             <ul class="dropdown-menu">
             
               <li id='.$ticket_no.' class="editButton1" title="Click to edit ticket no: '.$ticket_no.'"  ><a class="dropdown-item" href="#" >Re-open And Add Comment</a></li>
           
             </ul>
           </div>';
           
            }
  
           
   
           if ($priorityLevel === "High"){ 
   
               $priorityLevel = '<span class="badge badge-danger rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
           }
   
           if ($priorityLevel === "Medium"){
   
               $priorityLevel = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
           }
   
           if ($priorityLevel === "Low"){
   
               $priorityLevel = '<span class="badge badge-primary rounded-pill text-dark text-lg"">'.$priorityLevel.'</span>';
           }
           if ($ticket_status === "Pending"){
   
               $ticket_status = '<span class="badge badge-warning rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
           }
   
           if ($ticket_status == "Waiting"){
               $agoTime = '<strong style="color:#000000 !important; font-family:open sans;"><span>'.$agoTime.'</span></strong>';
               $ticket_status = '<span class="badge badge-primary rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
           }
   
           if ($ticket_status === "Attended"){
   
               $ticket_status = '<span class="badge badge-success rounded-pill text-dark text-lg"">'.$ticket_status.'</span>';
           }
   
           if ($units === "Help Desk Will Assign!" && $priorityLevel == "Help Desk Will Assign!"){
               $priorityLevel = '<span class="badge badge-info rounded-pill">None</span>';
               $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">None</span>';
           }else{
               $units = '<span class="badge badge-info rounded-pill text-dark text-lg"">'.$units.'</span>';     
               $priorityLevel = $priorityLevel ;
           }
   
           if ( $assigned_time == 0){
               $assigned_time = 'None'; 
           }else{
               $assigned_time = '<span class="badge badge-warnig rounded-pill text-dark text-lg">'.$updatedTimeStamp.'</span>'; 
   
           }
   
   
   
   
   
      
           $table .= '
            
               <tbody>
           <tr class="text-white">
       
           <td class="one">
           <p class="fw-bold mb-1">'. $ticket_no .'</p>
           </td>
   
           <td class="one">
           <div class="d-flex align-items-center">
           <div class="ms-3">
           <p class="fw-bold mb-1">'. $fullNames.'</p>
           <p class="mb-0">'.$staff_email.'</p>
           </div>
           </div>
           </td>
          
           <td class="one">
           <p class="fw-bold mb-1">'. $ticket_status .'</p>
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'. $MDAs .'</p>
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'. $complaints.'</p>
           </td>
           
           <td class="one">
           <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'. $units .'</p>
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'.$assigned_to.'</p> 
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'.$assigned_time.'</p> 
           </td>
           <td class="one">
           <p class="fw-bold mb-1">'.$priorityLevel.'</p>  
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'.$date_issued.'</p> 
           </td>
   
           <td class="one">
           <p class="fw-bold mb-1">'.$agoTime.'</p> 
           </td>
   
           '.$actionOnTickets.'
   
           <td class="one" class=""  >
           <p class="fw-bold mb-1"><button  data-id='.$ticket_no.' class="reassign btn btn-primary p-2 text-white" title="Reassign ticket no: '.$ticket_no.'">Reassign </button></p>
           </td>

           <td class="one" >
           '.$takeActionOnTicket .'
          </td>
          
           </tr>
           </tbody>
            ';
           
   
    }// end of while($row = mysqli_fetch_assoc($result))
   
   
   }// if (mysqli_num_rows($result) > 0)
   
   else {
       $table .= "
       <tr>
      <td></td> <td></td> <td></td><td>Records Not Available</td><td></td><td></td><td></td>
       </tr>
       ";
   }
   
   
 $countRec = "SELECT *, COUNT(*) AS prior_units FROM ticket_details WHERE assigned_to =  '$firstName $middleName $lastName'  AND actionOnTickets = 'Opened' ORDER BY id DESC ";
   $countRecresult = mysqli_query($conn, $countRec);
   if (mysqli_num_rows($result) > 0)
   {
               // output data of each row
    while($row2 = mysqli_fetch_assoc($countRecresult)) {
       $priority_unitsCounts = $row2['prior_units']; 
   
    }
     
   }
   
   

   
           }//end of if ($accessLevel == 2)
   
   
 
    
 

   /* *******************************************end of access level 2****************************************************** */
    
   $response = array (
    'table' => $table,
    'occurence' => $priority_unitsCounts,
  
);

}//end of (isset($_SESSION['email']) && isset($_SESSION['access_level'])){
    $table .= '
    </table>
';
echo  json_encode($response);
?>


