<?php
session_start();
$table = "";
$navLinkks  = "";

$limit1 = 3;
$page1 = 0;



if (isset($_POST['page1'])){
    $page1 = $_POST['page1'];
 
}
else{
    $page1 = 1;
}

$start_from1 = ($page1-1)*$limit1;

if (isset($_SESSION['email']) && isset($_SESSION['access_level'])){

  $fname = $_SESSION['firstName'];
   $Mname = $_SESSION['middleName'];
   $lname = $_SESSION['lastName'];
    $email = $_SESSION['email'];
   $accessLevel = $_SESSION['access_level'];
    include('includes/db_connect.php');

            // SELECT DATA FROM DB

            if ($accessLevel == 3){
                $sql = "SELECT * FROM ticket_details WHERE assigned_to  = '$fname $Mname $lname'  AND newOfficer != '' OR newOfficer = '$fname $Mname $lname' ORDER BY assigned_time DESC limit $start_from1, $limit1 ";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0)
                {
                
                //table goes here
                $table .= '
                <table class="table text-white table-borderless table-hover align-middle" style="background-color:#000000 !important">
                <thead>
                
                <tr>
                
                <th scope="col">Ticket No</th>
                <th scope="col">Names</th>
                <th scope="col">Ticket Status</th>
                <th scope="col">MDAs</th>
                <th scope="col">Issue</th>
                <th scope="col">Description</th>
                <th scope="col">Assigned Unit</th>
                <th scope="col">Initially Assigned To</th>
                <th scope="col">Assigned Officer</th>
                <th scope="col">Assigned At</th>
                <th scope="col">Priority Level</th>
                <th scope="col">Date Issued</th>
                 <th scope="col">Time Created</th>
                <th scope="col">Action</th>
                
                
                     
                  </tr>
                  </thead>
                  
                  
                  
                  ';
                
                        while ($row = mysqli_fetch_assoc($result)){
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
                
                            $actionOnTickets = '<td  class=" one" title="Click to edit ticket no: '.$ticket_no.'" ><button id='.$ticket_no.' class="editButton btn btn-primary">'. $actionOnTickets.'</button></td>';
                        }
                
                        if ($actionOnTickets == "Closed"){
                
                            $actionOnTickets  = '<td  class=" one" title="Click to edit ticket no: '.$ticket_no.'" ><button id='.$ticket_no.' class="editButton btn btn-success">'. $actionOnTickets.'</button></td>';
                            $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
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
                        $assigned_time = '<span class="badge badge-warnig rounded-pill text-white text-lg">'.$updatedTimeStamp.'</span>'; 
                
                    }
                
                
                
                            $table .= '
                
                            <tbody>
                        <tr class="text-dark">
                        <td >
                        <p class="fw-bold mb-1">'. $ticket_no .'</p>
                        </td>
                        
                        <td>
                        <div class="d-flex align-items-center">
                        <div class="ms-3">
                        <p class="fw-bold mb-1">'. $fullNames.'</p>
                        <p class="text-muted mb-0">'.$staff_email.'</p>
                        </div>
                        </div>
                        </td>
                        
                        <td>
                        <p class="fw-bold mb-1">'. $ticket_status .'</p>
                        </td>
                        
                        <td>
                        <p class="fw-bold mb-1">'. $MDAs.'</p>
                        </td>
                        
                        <td>
                        <p class="fw-bold mb-1">'. $complaints .'</p>
                        </td>
                        
                        <td class="">
                        <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
                        </td>
                        
                        <td>
                        <p class="fw-bold mb-1">'. $units .'</p>
                        </td>
                
                        <td class="">
                        <p class="fw-bold mb-1">'.$assigned_to.'</p> 
                        </td>
                        
                        <td class="">
                        <p class="fw-bold mb-1">'.$newOfficer.'</p> 
                        </td>
                
                        <td class="">
                        <p class="fw-bold mb-1">'.$assigned_time.'</p> 
                        </td>
                        
                        <td class="">
                        <p class="fw-bold mb-1">'.$priorityLevel.'</p>  
                        </td>
                
                        <td class="">
                        <p class="fw-bold mb-1">'.$date_issued.'</p> 
                        </td>
                
                        <td class="">
                        <p class="fw-bold mb-1">'.$agoTime.'</p> 
                        </td>
                
                        '.$actionOnTickets.'
                        
                        </tr>
                        </tbody>
                         ';
                      
                          
                
                        }//end of while loop
                
                        }// if (mysqli_num_rows($result) > 0)
                
                       else {
                            $table .= '
                            <tr style="background-color:#000000 !important">
                          <td></td> <td></td>  <td></td>  <td></td>   <td>NO TRAY TO SHOW AT THE MOMENT.</td> <td></td>  <td></td>  
                            </tr>
                            ';
                        }
                
                        $countRec = "SELECT *, COUNT(*) AS REC FROM ticket_details WHERE assigned_to != '$fname $Mname $lname' AND newOfficer = '$fname $Mname $lname'  AND actionOnTickets = 'Opened'  AND newOfficer ='$fname $Mname $lname'";
                        $countRecresult = mysqli_query($conn, $countRec);
                       
                        
                                    // output data of each row
                         while($row2 = mysqli_fetch_assoc($countRecresult)) {
                            $priority_unitsCounts = $row2['REC']; 

                        
                         }
                          
                        
                
                
                        // pagination code 
                   $query = mysqli_query($conn, "SELECT * FROM ticket_details WHERE assigned_to  = '$fname $Mname $lname'  AND newOfficer != '' OR newOfficer = '$fname $Mname $lname'  ");
                   $total_records = mysqli_num_rows($query);
                   $total_pages = ceil($total_records/$limit1);
                   $navLinkks .= '
                   <ul class="pagination pagination-md pagination-circle">';
                   
                   // now conditions for previous and next
                   if ($page1 > 1){
                       $previous = $page1-1;
                       $navLinkks .= '<li class="page-item1" id="1"><span class="page-link">First Page</span></li>';
                       $navLinkks .= '<li class="page-item1" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
                   }
                   
                   //iteration for th number of pages to be seen 
                   for ($i=1; $i<=$total_pages; $i++){
                           $active_class = "";
                           if ($i == $page1){
                               $active_class = "active" ;
                           }
                           $navLinkks .= '<li class="page-item1'.$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
                   }
                   
                   if ($page1 < $total_pages){
                           $page1++;
                           $navLinkks .= '<li class="page-item1" id="'.$page1.'"><span class="page-link"><i  class="fa fa-arrow-right" >
                           </i></span></li>';
                           $navLinkks .= '<li class="page-item1" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
                   
                   }
                
                   $navLinkks  .= '</ul>'; 
                   $response = array (
                    'table' => $table,
                    'occurence' => $priority_unitsCounts,
                     'pagination' => $navLinkks
                );
                
                

            }//end of ($accessLevel == 3)

/* ******************************************************************************************************************************************** */
            
            if ($accessLevel == 2){

                $sql = "SELECT * FROM ticket_details WHERE assigned_to  = '$fname $Mname $lname'  AND newOfficer != '' OR newOfficer = '$fname $Mname $lname' ORDER BY assigned_time DESC limit $start_from1, $limit1 ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

//table goes here
$table .= '
<table class="table text-white table-borderless table-hover align-middle" style="background-color:#000000 !important">
<thead>

<tr>

<th scope="col">Ticket No</th>
<th scope="col">Names</th>
<th scope="col">Ticket Status</th>
<th scope="col">MDAs</th>
<th scope="col">Issue</th>
<th scope="col">Description</th>
<th scope="col">Assigned Unit</th>
<th scope="col">Initially Assigned To</th>
<th scope="col">Assigned Officer</th>
<th scope="col">Assigned At</th>
<th scope="col">Priority Level</th>
<th scope="col">Date Issued</th>
 <th scope="col">Time Created</th>
<th scope="col">Action</th>


     
  </tr>
  </thead>
  
  
  
  ';

        while ($row = mysqli_fetch_assoc($result)){
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

            $actionOnTickets = '<td  class=" one" title="Click to edit ticket no: '.$ticket_no.'" ><button id='.$ticket_no.' class="editButton btn btn-primary">'. $actionOnTickets.'</button></td>';
        }

        if ($actionOnTickets == "Closed"){

            $actionOnTickets  = '<td  class=" one" title="Click to edit ticket no: '.$ticket_no.'" ><button id='.$ticket_no.' class="editButton btn btn-success">'. $actionOnTickets.'</button></td>';
            $agoTime = '<strong style="color:whitesmoke !important; font-size:25px; font-family:open sans;"><span class="timeEffect">-:-</span></strong>';
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
        $assigned_time = '<span class="badge badge-warnig rounded-pill text-white text-lg">'.$updatedTimeStamp.'</span>'; 

    }



            $table .= '

            <tbody>
        <tr class="text-dark">
        <td >
        <p class="fw-bold mb-1">'. $ticket_no .'</p>
        </td>
        
        <td>
        <div class="d-flex align-items-center">
        <div class="ms-3">
        <p class="fw-bold mb-1">'. $fullNames.'</p>
        <p class="text-muted mb-0">'.$staff_email.'</p>
        </div>
        </div>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $ticket_status .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $MDAs.'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $complaints .'</p>
        </td>
        
        <td class="">
        <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $units .'</p>
        </td>

        <td class="">
        <p class="fw-bold mb-1">'.$assigned_to.'</p> 
        </td>
        
        <td class="">
        <p class="fw-bold mb-1">'.$newOfficer.'</p> 
        </td>

        <td class="">
        <p class="fw-bold mb-1">'.$assigned_time.'</p> 
        </td>
        
        <td class="">
        <p class="fw-bold mb-1">'.$priorityLevel.'</p>  
        </td>

        <td class="">
        <p class="fw-bold mb-1">'.$date_issued.'</p> 
        </td>

        <td class="">
        <p class="fw-bold mb-1">'.$agoTime.'</p> 
        </td>

        '.$actionOnTickets.'
        
        </tr>
        </tbody>
         ';
      
          

        }//end of while loop

        }// if (mysqli_num_rows($result) > 0)

       else {
            $table .= '
            <tr style="background-color:#000000 !important">
          <td></td> <td></td>  <td></td>  <td></td>   <td>NO TRAY TO SHOW AT THE MOMENT.</td> <td></td>  <td></td>  
            </tr>
            ';
        }

        $countRec = "SELECT *, COUNT(*) AS REC FROM ticket_details WHERE  newOfficer ='$fname $Mname $lname' AND actionOnTickets = 'Opened'";
        $countRecresult = mysqli_query($conn, $countRec);
               // output data of each row
         while($row2 = mysqli_fetch_assoc($countRecresult)) {
            $priority_unitsCounts = $row2['REC']; 
        
         }
  


        // pagination code 
   $query = mysqli_query($conn, "SELECT * FROM ticket_details WHERE assigned_to  = '$fname $Mname $lname'  AND newOfficer != '' OR newOfficer = '$fname $Mname $lname'  ");
   $total_records = mysqli_num_rows($query);
   $total_pages = ceil($total_records/$limit1);
   $table .= '
   <ul class="pagination pagination-md pagination-circle">';
   
   // now conditions for previous and next
   if ($page1 > 1){
       $previous = $page1-1;
       $table .= '<li class="page-item1" id="1"><span class="page-link">First Page</span></li>';
       $table .= '<li class="page-item1" id="'.$previous.'"><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
   }
   
   //iteration for th number of pages to be seen 
   for ($i=1; $i<=$total_pages; $i++){
           $active_class = "";
           if ($i == $page1){
               $active_class = "active" ;
           }
           $table .= '<li class="page-item1' .$active_class.'" id="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
   }
   
   if ($page1 < $total_pages){
           $page1++;
           $table .= '<li class="page-item1" id="'.$page1.'"><span class="page-link"><i  class="fa fa-arrow-right" >
           </i></span></li>';
           $table .= '<li class="page-item1" id="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
   
   }

   
   $response = array (
    'table' => $table,
    'occurence' => $priority_unitsCounts,
  
);


            }//end of ($accessLevel == 2)

            

 }//end of (isset($_SESSION['email']) && isset($_SESSION['access_level'])){ 

        $table .= ' 
        </table>';
       
      
         echo  json_encode($response);




?>