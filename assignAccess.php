<?php


if ( isset($_POST['inputValue']) && isset($_POST['getId']) ){

    $inputtedVal = $_POST['inputValue'];
    $getUserID =  $_POST['getId'];

    include('includes/db_connect.php');

 

    $updateTicketRecord1 = "UPDATE users SET  access_level ='$inputtedVal'  WHERE id = '$getUserID'";
    $getResult1 = mysqli_query($conn, $updateTicketRecord1);
    
    $stmt = "SELECT * FROM users WHERE id = '$getUserID' "; 
    $query_stmt = mysqli_query($conn, $stmt);
  
    // set up a foreach loop 
    foreach($query_stmt as $records){

          $id [] = $records['id'];
          $first [] = $records['firstName'];
          $middle [] = $records['middleName'];
          $last [] = $records['lastName'];
          $access [] = $records['access_level'];

    }

  
    $feedback = array (
        'id' => $id ,
        'first' => $first,
        'middle' => $middle,
        'last' => $last,
        'access' => $access,
    );
    
    echo json_encode($feedback);
    
}// end of isset condition 



?>