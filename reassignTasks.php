<?php
$report = "";
$errMsg = "";

if (isset($_POST['id']) && isset($_POST['dept']) && isset($_POST['officerName'])  && isset($_POST['priorityL']) ){

    $id = $_POST['id'];
    $dept =  $_POST['dept'];
    $officerName =  $_POST['officerName'];
    $priorityL =  $_POST['priorityL'];
    $Nowtime = time(); 

    include('includes/db_connect.php');

     if (empty($id)){
        $errMsg .= "Empty Field Detected!";
     } else  if (empty($dept)){
      $errMsg .= "Empty Field Detected!";
     } else if (empty($priorityL)){
     $errMsg .= "Empty Field Detected!";
     } else  if (empty($Nowtime)){
      $errMsg .= "Empty Field Detected!";
     }else{

    $updateTicketRecord1 = "UPDATE ticket_details SET  assign_unit  ='$dept', priorityLevel ='$priorityL', newOfficer ='$officerName',  assigned_time  ='$Nowtime'  WHERE ticket_no = '$id' LIMIT 1";
    $getResult1 = mysqli_query($conn, $updateTicketRecord1);
    
    $stmt = "SELECT * FROM ticket_details WHERE ticket_no = '$id' LIMIT 1 ";
    $query_stmt = mysqli_query($conn, $stmt);
     
    //here we select users email addrss from icta notifying them of the assigned task
    $sql = "SELECT email_address FROM users  WHERE MDA = 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY' AND fullnames = '$officerName' ";
$result = mysqli_query($conn, $sql);
    //loop
    while($row = mysqli_fetch_assoc($result)){
        $userEmail = $row['email_address'];

        //send email
      $to = $userEmail;
      $subject = "TICKET ASSIGNMENT NOTIFICATION";
      $message = '<html>
      <head>
          <title>ICTA|TICKET NUMBER</title>
          <style>
             body{
                 background-color: rgb(70, 70, 134);
                 font-size: 18px;
                 font-family:  Tahoma;
        }
        .holder{
             border: 4px #03718d solid;
             background-color: rgb(246, 246, 250);
             width: 300px auto;
             margin: 200px;
             height: auto !important;
             border-radius: 8px;
             box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.6), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        }
        .ticket_details{
         background-color: rgb(235, 233, 229);
         font-weight: bold;
        }
          </style>
      </head>
      <body>
                 <center>
                     <div class="holder">
                         <center><u><h2>ALERT</h2></u></center>
                       <p class="greetings"> Hello <b>'.$officerName.'</b>.</p> 
                       <p class="mail_body"> 
                          This mail is to notify you that ticket <u>'.$id.'</u> has been assigned to you.
                          Kindly see below the ticket details and you should login to your account to 
                          treat this ticket by clicking this link <a href="https://edoictaservices.com.ng/helpdesk">login</a>.
                          Thank you and have a good day. 
                         </p>
                         <center><h2>Ticket details</h2></center>
                         <hr>
                          <p class="ticket_details">
                             DEPARTMENT CONCERNED : <u>'.$dept.'</u>
                          </p>
                          <hr>
                          <p class="ticket_details">
                             PRIORITY LEVEL : '.$priorityL.'
                          </p>
                          <hr>

                          <p>&copy; <?php echo date(Y); ?> ICTA HELP DESK  Email:<b>icta.helpdesk@edostate.gov.ng</b></p> 


                     </div>
                 </center> 
  
  
      </body>
  </html>';
      $headers = "From: ictahelpdesk@edoictaservices.com.ng\r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'Cc:icta.helpdesk@edostate.gov.ng' . "\r\n";

            $email_box = mail($to, $subject, $message, $headers);

              if ($email_box == true){

              }
              else{
                $errMsg = "could not send mail!"; 
              } 
 
    }
  
    // set up a foreach loop 
    foreach($query_stmt as $records){

      $id [] = $records['id'];
      $comments [] = $records['comments'];
      $fullnames [] = $records['fullNames']; 

    }

     }//end of if else

    $report = array (
      'id' => $id ,
      'fullNames' =>$fullnames,
      'tick_no' => $ticket_no,
      'email_unsent' => $errMsg 
  );
    

    
}// end of isset condition 

echo json_encode($report);

?>