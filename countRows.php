<?php


//fetch limit data code

$table= " ";
$response = " ";



include('includes/db_connect.php');
// SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details WHERE assign_unit = '' AND priorityLevel = '' ORDER BY timeOfIssue DESC limit 4 ";
$result = mysqli_query($conn, $sql);



//table goes here
$table .= '

<table class="table text-white table-borderless  align-middle" id="None_P_A">
<thead>

<tr>

  <th scope="col">Ticket No</th>
  <th scope="col">Issuer</th>
  <th scope="col">Job Title</th>
  <th scope="col">Ticket Status</th>
  <th scope="col">Description</th>
  <th scope="col">Assigned Unit</th>
  <th scope="col">Assigned To</th>
  <th scope="col">Priority</th>
  <th scope="col">Date Created</th>
  <th scope="col">Time Created</th>
  <th scope="col">Assigned At</th>
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
    $date_issued = strtotime($date_issued);
    $date_issued = date('M d Y', $date_issued);
    $assigned_time = $row['assigned_time']; 

            //set up  time
            include_once('agoTime.php');
            $agoTime = get_time_ago($timeOfIssue);
            
            //$updatedTime = get_time_ago($assigned_time);
           $getUpdatedTime = strtotime($assigned_time);

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
            $agoTime = '<strong style="color:whitesmoke !important; font-family:open sans;"><span class="text-dark">'.$agoTime.'</span></strong>';
            $ticket_status = '<span class="badge badge-primary rounded-pill">'.$ticket_status.'</span>';
        }

        if ($ticket_status === "Attended"){

            $ticket_status = '<span class="badge badge-success rounded-pill">'.$ticket_status.'</span>';
        }

        if ($units === "Help Desk Will Assign!" && $priorityLevel == "Help Desk Will Assign!"){
            $priorityLevel = '<span class="badge badge-info rounded-pill">None</span>';
            $units = '<span class="badge badge-info rounded-pill">None</span>';
        }else{
            $units = '<span class="badge badge-info rounded-pill">'.$units.'</span>';     
            $priorityLevel = $priorityLevel ;
        }

        if ( $assigned_time == null){
            $assigned_time = 'None'; 
        }else{
            $assigned_time = '<span class="badge badge-warnig rounded-pill">'.$getUpdatedTime.'</span>'; 

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
        <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
        <p class="mb-0">'.$staff_email.'</p>
        </div>
        </div>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1">'. $job_title .'</p>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1">'. $ticket_status .'</p>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1">'. $string .'... <button   data-id="'.$id.'"  class="readMore btn btn-info">Read More!</button></p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'. $units .'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">None</p> 
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'. $priorityLevel .'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$date_issued.'</p>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1">'.$agoTime.'</p>
        </td>

        <td class="one">
        <p class="fw-bold mb-1">'.$assigned_time.'</p>
        </td>
        
        <td class="one">
        <p class="fw-bold mb-1"> <button id="id" class="action btn btn-danger" data-id="'.$id.'" title="Click to edit ticket no: '.$ticket_no.'"
>Assign</button></p>
        </td>
        
        </tr>
        </tbody>
         ';
        

 }// end of while($row = mysqli_fetch_assoc($result))


}// if (mysqli_num_rows($result) > 0)
else if (mysqli_num_rows($result)  < 1){
    $table .= "
    <tr>
   <td></td> <td></td> <td></td><td>Records Not Available</td><td></td><td></td><td></td>
    </tr>
    ";
}

$table .= '
            </table>
';


$countRec = "SELECT *, COUNT(*) AS prior_units FROM ticket_details WHERE assign_unit = '' AND priorityLevel = '' ORDER BY id DESC limit 4 ";
$countRecresult = mysqli_query($conn, $countRec);
if (mysqli_num_rows($result) > 0)
{
            // output data of each row
 while($row2 = mysqli_fetch_assoc($countRecresult)) {
    $priority_unitsCounts = $row2['prior_units']; 

 }
  
}


 
$response = array (
    'table' => $table,
    'occurence' => $priority_unitsCounts,
  
);



echo  json_encode($response);
?>