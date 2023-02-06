<?php


if ( isset($_POST['getId']) ){

   
    $getID =  $_POST['getId'];

    include('includes/db_connect.php');

    
    $stmt = "SELECT * FROM ticket_details  WHERE id = '$getID' "; 
    $query_stmt = mysqli_query($conn, $stmt);
  
    // set up a foreach loop 
    foreach($query_stmt as $records){

          $id [] = $records['id'];
          $ticket_no [] = $records['ticket_no'];
          $comments [] = $records['comments'];
          $fullnames [] = $records['fullNames'];  

    }

  
    $feedback = array (
        'id' => $id ,
        'fullNames' =>$fullnames,
        'comments' => $comments,
        'tick_no' => $ticket_no 
    );
    
    echo json_encode($feedback);
    
}// end of isset condition 



?>