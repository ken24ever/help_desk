<?php
$report = "";

if (isset($_POST['id']) && isset($_POST['dept']) && isset($_POST['officerName'])  && isset($_POST['priorityL']) ){

    $id = $_POST['id'];
    $dept =  $_POST['dept'];
    $officerName =  $_POST['officerName'];
    $priorityL =  $_POST['priorityL']; 
    $Nowtime = time(); 

    

 
    if (empty($id)){
      $errMsg .= "Empty Field Detected!";
   } else  if (empty($dept)){
    $errMsg .= "Empty Field Detected!";
   } else if (empty($priorityL)){
   $errMsg .= "Empty Field Detected!";
   } else  if (empty($Nowtime)){
    $errMsg .= "Empty Field Detected!";
   }else{
    include('includes/db_connect.php');
    $updateTicketRecord1 = "UPDATE ticket_details SET  assign_unit  ='$dept', priorityLevel ='$priorityL', assigned_to ='$officerName',  assigned_time  ='$Nowtime'  WHERE id = '$id' LIMIT 1";
    $getResult1 = mysqli_query($conn, $updateTicketRecord1);
    
    $stmt = "SELECT * FROM ticket_details WHERE id = '$id' LIMIT 1 ";
    $query_stmt = mysqli_query($conn, $stmt);
    
    
  
    // set up a foreach loop 
    foreach($query_stmt as $records){

      $id [] = $records['id'];
      $comments [] = $records['comments'];
      $fullnames [] = $records['fullNames']; 

    }

  
    $report = array (
      'id' => $id ,
      'fullNames' =>$fullnames,
      'tick_no' => $ticket_no 
  );
    
}//end of if else
    echo json_encode($report);
    
}// end of isset condition 



?>