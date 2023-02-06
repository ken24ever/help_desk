<?php

include('includes/db_connect.php');

    $stmt = "SELECT complaints, date_issued, COUNT(actionOnTickets) AS actions FROM ticket_details WHERE actionOnTickets = 'Closed' group BY complaints ";
    $query_stmt = mysqli_query($conn, $stmt);

    // set up a foreach loop 
    foreach($query_stmt as $records){

          $issues_raised [] = $records['complaints'];
          $noOfOccurence [] = $records['actions'];
          $getDates [] = $records['date_issued'];

    }


    $response = array (
        'issues' => $issues_raised ,
        'occurence' => $noOfOccurence,
        'dates' => $getDates,
    );
    
    echo json_encode($response);

?>