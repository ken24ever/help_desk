<?php
$table = "";

if (isset($_POST['ictaNames'])){
    $ictaNamesOnly = $_POST['ictaNames'];
    include('includes/db_connect.php');

            // SELECT DATA FROM DB
$sql = "SELECT * FROM users  WHERE MDA = 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY' AND firstName LIKE '%$ictaNamesOnly%' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

//table goes here
$table .= '
<table class="table text-white table-borderless table-hover align-middle" style="background-color:#000000 !important">
<thead>

<tr>


  <th scope="col">Names</th>
  <th scope="col">Gender</th>
  <th scope="col">Access Level</th>
  <th scope="col">Job Title</th>
  <th scope="col">MDAs</th>
  <th scope="col">Department/Unit</th>
  <th scope="col">Action</th>
     
  </tr>
  </thead>
  
  
  
  ';

        while ($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $firstName = $row['firstName'];
            $middle_name = $row['middleName'];
            $lastName = $row['lastName'];
            $gender  = $row['gender'];
            $jobTitle  = $row['jobTitle'];
            $access_level  = $row['access_level'];
            $email_address = $row['email_address'];
            $display_pic  = $row['display_pic'];
            $MDA  = $row['MDA'];
            $units  = $row['units'];
            $created_at = $row['created_at'];
            $updated_at = $row['updated_at'];

            $table .= '

            <tbody>
        <tr class="text-dark">
        
        
        <td>
        <div class="d-flex align-items-center">
        <div class="ms-3">
        <p class="fw-bold mb-1">'. $firstName.'  '.$middle_name.'  '.$lastName.'</p>
        <p class="text-muted mb-0">'.$email_address.'</p>
        </div>
        </div>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $gender .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $access_level.'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $jobTitle .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $MDA .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1">'. $units .'</p>
        </td>
        
        <td>
        <p class="fw-bold mb-1"><button class="accessLevel btn btn-info" data-id="'.$id.'">Assign Access Level</button></p>
        </td>
        
        
      
        
        </tr>
        </tbody>
         ';
      
          

        }//end of while loop

        }// if (mysqli_num_rows($result) > 0)

       else {
            $table .= '
            <tr style="background-color:#000000 !important">
          <td></td> <td></td>  <td></td>  <td></td>   <td>Records Not Available</td> <td></td>  <td></td>  
            </tr>
            ';
        }
        
      /*   $updateTicketRecord = "UPDATE ticket_details SET ticket_status = 'Attended', actionOnTickets= 'Closed'  WHERE ticket_no = '$ticket_no'";
        $getResult = mysqli_query($conn, $updateTicketRecord); */

        $table .= '
        </table>';
       
        echo $table;

}// end of isset condition 



?>