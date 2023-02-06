<?php
session_start();

$table = "";

if (isset($_POST['ticketNo']) && isset($_SESSION['email']) && isset($_SESSION['access_level'])){

    $email = $_SESSION['email'];
    $ticketNo = $_POST['ticketNo'];
    $accessLevel = $_SESSION['access_level'];

   if (!empty($_POST['ticketNo'])){
    include('includes/db_connect.php');



    // SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details  WHERE ticket_no LIKE '%$ticketNo%' ";
$result = mysqli_query($conn, $sql);

//table goes here
$table .= '
<center><button class=" backToChart btn btn-info"  onclick="loadTable()" style="margin:12px auto !important">Go Back</button></center>
<table class="table text-white table-borderless table-hover align-middle " id="myTable">
<thead>

<tr>


<th scope="col">Ticket No</th>
<th scope="col">Names</th>
<th scope="col">Job Title</th>
<th scope="col">Ticket Status</th>
<th scope="col">MDAs</th>
<th scope="col">Issue</th>
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
if (mysqli_num_rows($result) > 0)
{
       // output data of each row
       $row = mysqli_fetch_assoc($result);
       $title = $row['title'];
       $firstName = $row['firstName'];
       $middle_name = $row['middle_name'];
       $lastName = $row['lastName'];
       $units = $row['assign_unit'];
       $staff_email = $row['staff_email'];
       $job_title = $row['job_title'];
       $ticket_status = $row['ticket_status'];
       $MDAs = $row['MDAs'];
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
               
           if ($actionOnTickets === "Opened" ){
   
               $actionOnTickets = '<button class="btn btn-primary">'. $actionOnTickets.'</button>';
           }
   
           if ($actionOnTickets === "Closed"){
   
               $actionOnTickets = '<button class="btn btn-success">'. $actionOnTickets.'</button>';
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
            <td id='.$ticket_no.' class="editButton" title="Click to edit ticket no: '.$ticket_no.'" >
           <p class="fw-bold mb-1">'. $actionOnTickets .'</p>
           </td>
        
           
           </tr>
           </tbody>
            ';
           
   
      // }//end of while loop


}//end of (mysqli_num_rows($result) > 0)
else{
    $table .= '
    <tr>
    <td>Records Not Available</td>
    <td>
    <button class=" backToChart btn btn-info"  onclick="loadTable()">Go Back</button>
    </td>
    </tr>
    ';

}//end of else

$table .= '
            </table>

';


   }else{


   }//end of else for !empty
}//end of isset

echo $table;

?>