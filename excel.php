<?php
 $table ="";


if (isset($_POST['selectStart']) && isset($_POST['selectEnd']) && isset($_POST['action'])  ) {
    
        header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename= ".$action." Tickets Reports.xls");

    include('includes/db_connect.php');

   $startDate = $_POST['selectStart'];
   $endDate = $_POST['selectEnd'];
   $action = $_POST['action'];

   if (!empty($startDate) && !empty($endDate) && !empty($action)  )
   {

  //table goes here
  $table .= '
   <h2 >'.$action.' Tickets! </h2>
  <table class="table" bordered = "1">
  <thead>
  
  <tr>
    <th scope="col">List Of Complaints</th>
    <th scope="col">No. Of Occurence</th>
    <th scope="col">Range of Dates</th>
  </tr>
  </thead>
  
  ';
  
// SELECT OPENED DATA FROM DB 
$sql = "SELECT complaints, date_issued, COUNT(actionOnTickets) AS occurence FROM ticket_details WHERE actionOnTickets ='$action' AND date_issued  BETWEEN  '$startDate' AND '$endDate' GROUP BY complaints ORDER BY id";
$result = mysqli_query($conn, $sql);

//here we check for any matching data
if (mysqli_num_rows($result) > 0)
      {
            


         // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
       
        $complaints = $row['complaints'];
        $date_issued = $row['date_issued'];
        $occurence = $row['occurence'];
        $date_issued = strtotime($date_issued);
        $date_issued = date('M d Y', $date_issued); 


        $table .= '
         
        <tbody>
    <tr class="text-dark">
      <td>
      '.$complaints.'
      </td>
      <td>
      '.$occurence.'
      </td>
      <td>
      '.$date_issued.'
      </td>
    
    </tr>
    </tbody>
     ';



     }//end of while loop



 
      }//end of if (mysqli_num_rows($result) > 0)


      else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td><p class='lead' style='color:red !important'>Records Not Available</p></td> <td></td> <td></td> <td></td> <td></td>
        </tr>
        ";
    }
    


    
       
}//end of if (isset($_SESSION['email']) && isset($_SESSION['access_level']) == 1) 

$table .= '
            </table>

';
}//end of (!empty($startDate) && !empty($endDate) && !empty($action)  )
else{
    header("location:dashboard.php");
}




echo $table;


?>