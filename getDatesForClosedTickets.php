<?php


$errMsg = "";

if (isset($_POST['ActionClosed1']) && isset($_POST['ActionClosed2']) ){
    $startDate = $_POST['ActionClosed1'];
    $endDate = $_POST['ActionClosed2'];
    $actionTaken = 'Closed';
    include('includes/db_connect.php');
    
    $sql = "SELECT complaints, date_issued, COUNT(complaints) AS closedData  FROM ticket_details WHERE actionOnTickets = ? AND date_issued BETWEEN ? AND ? GROUP BY complaints";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("sss", $actionTaken, $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

/* while ($row = $result->fetch_assoc()) {
    echo $row['name'];
} */

/* if (mysqli_num_rows($result < 1)){
    $errMsg = "No Tickets Raised On This Date(s)!";  
} */



foreach($result as $record){

    $issues_raised [] = $record['complaints'];
    $noOfOccurence [] = $record['closedData'];
    $getDates [] = $record['date_issued'];

}



$info['issuesUpdated1'] = $issues_raised ;
$info['occurenceUpdated1'] = $noOfOccurence ;
$info['datesUpdated1'] = $getDates ;
//$info['message'] = $errMsg ;

    


}//end of isset
//echo $dates
echo json_encode($info);
?>