<?php

        //db connect
        include('includes/db_connect.php');

                  // SELECT DATA FROM DB where issues are opened
$sql = " SELECT COUNT(complaints) AS issuesClosed  FROM ticket_details  WHERE actionOnTickets = 'Closed'";

$result = mysqli_query($conn, $sql);
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {

            $totIssuesClosed = $row['issuesClosed'];

     }//end of while loop

    
     $stmt ="SELECT  COUNT(complaints) AS Opennedissues  FROM ticket_details  WHERE actionOnTickets = 'Opened'";
     $stmtResult =  mysqli_query($conn, $stmt);

// output data of each row
     while($row1 = mysqli_fetch_assoc($stmtResult)) {

    $totIssuesOpened = $row1['Opennedissues'];
 

     }//end of while loop

     $response = array (
        'issuesOpened' =>  $totIssuesOpened ,
        'closedIssues' => $totIssuesClosed,
    );

     
echo json_encode($response);
?>