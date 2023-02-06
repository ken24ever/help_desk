<?php

include('includes/db_connect.php');

    $stmt = "SELECT complaints, date_issued, COUNT(complaints) AS occurence FROM ticket_details Where actionOnTickets = 'Opened' group BY complaints";
    $query_stmt = mysqli_query($conn, $stmt);

    // set up a foreach loop 
    foreach($query_stmt as $records){

          $issues_raised [] = $records['complaints'];
          $noOfOccurence [] = $records['occurence'];
          $getDates [] = $records['date_issued'];

    }


    $response = array (
        'issues' => $issues_raised ,
        'occurence' => $noOfOccurence,
        'dates' => $getDates,
    );
    
    echo json_encode($response); 

?>