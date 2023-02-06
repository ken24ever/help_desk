<?php
/*  $info = array (
    'issuesUpdated' => '',
    'occurenceUpdated' => '',
    'datesUpdated' => '',
);  */

$errMsg = "";

if (isset($_POST['startDate']) && isset($_POST['endDate']) ){
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    include('includes/db_connect.php');
    
    $sql = "SELECT complaints, date_issued, COUNT(complaints) AS occurence  FROM ticket_details WHERE actionOnTickets='Opened' AND date_issued BETWEEN ? AND ? GROUP BY complaints";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

/* while ($row = $result->fetch_assoc()) {
    echo $row['name']; actionOnTickets='Opened' And
} */

/* if (mysqli_num_rows($result < 1)){
    $errMsg = "No Tickets Raised On This Date(s)!";  
} */



foreach($result as $record){

    $issues_raised [] = $record['complaints'];
    $noOfOccurence [] = $record['occurence'];
    $getDates [] = $record['date_issued'];

}



$info['issuesUpdated'] = $issues_raised ;
$info['occurenceUpdated'] = $noOfOccurence ;
$info['datesUpdated'] = $getDates ;
//$info['message'] = $errMsg ;

    
/* 

    $stmt = "SELECT * FROM ticket_details WHERE date_issued = ";
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
    
    echo json_encode($response); */

}//end of isset
//echo $dates
echo json_encode($info);
?>