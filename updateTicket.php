<?php
     session_start();
  //session variable  for the user that's commenting
 $commentedBy = $_SESSION['fullnames'];
 $user_id = $_SESSION['user_id'];
 $user_accsLvl = $_SESSION['access_level'];
   $firstName =$_SESSION['firstName'];
  $middleName = $_SESSION['middleName'];
  $lastName = $_SESSION['lastName'] ;
  $usersFullNames = $firstName .' '. $middleName .' '. $lastName; 
   $Accslevel4Email = $_SESSION['email'];
$msg = "";

if (isset($_POST['ticketNo']) && isset($_POST['inputValue'])){


    //here we sanitize all data entry for
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $ticketNo = $_POST['ticketNo'];
  $message = test_input($_POST["inputValue"]);
  $createdDateAndTime = date('M d Y h:i:sa ');
  $time = time(); 
   
    if (empty($message)){
      //do nothing!
    }else{

      include('includes/db_connect.php');
          // SELECT DATA FROM DB
$sql = "SELECT * FROM ticket_details  WHERE ticket_no = '$ticketNo' ";
$result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $issuerName =$row['fullNames'];
            $firstName = $row['firstName'];	
            $middle_name = $row['middle_name'];
            $lastName = $row['lastName'];
            $staff_email = $row['staff_email'];
            $job_title = $row['job_title'];
            $ticket_status = $row['ticket_status'];
            $MDAs = $row['MDAs'];
            $assign_unit = $row['assign_unit'];
            $assigned_to = $row['assigned_to'];
            $ticket_no = $row['ticket_no'];
            $complaints = $row['complaints'];
            $comments = $row['comments'];
            $files = $row['files'];
            $priorityLevel = $row['priorityLevel'];
            $date_issued = $row['date_issued'];
            $timeOfIssue = $row['timeOfIssue'];
            $actionOnTickets = $row['actionOnTickets'];
            $timeOfIssue = time(); 

            

        }//end of while loop

     //select ticket No. from table for checking
    $check_db_for_existing_ticket_thread = mysqli_query($conn, "SELECT  id FROM  comment_registry  WHERE ticket_id = '$ticket_no' ");
    $check = mysqli_num_rows($check_db_for_existing_ticket_thread);

    
 

    //here we check if ticket thread exist, if it doesn't ticket is insert
    if ($check < 1)
      {
        //we can now insert into comment_registry table since the condition is met
        $stmt_query1 = "INSERT INTO comment_registry (ticket_id, issuer_name, ticket_status, commented_by, user_id, access_lv, created_at, timeCreated)
        VALUES ('$ticket_no', '$issuerName', '$actionOnTickets','$usersFullNames', '$user_id', '$user_accsLvl', '$createdDateAndTime', '$time')";
        
        if ($conn->query($stmt_query1) === TRUE) {
        //  echo "New record created successfully";
        } else {
         $msg .=  "Error: " . $stmt_query1 . "<br>" . $conn->error;
        }

      }

    // Here we insert into comments_logs
    $stmt_query2 = "INSERT INTO comments_logs (ticket_id, created_at, ticket_issuer, commentBy, commentsBody, timeCreated )
    VALUES ('$ticket_no', '$createdDateAndTime', '$issuerName', '$usersFullNames', '$message', '$time')";
    
    if ($conn->query($stmt_query2) === TRUE) {
    //  echo "New record created successfully";
    } else {
     $msg .=  "Error: " . $stmt_query2 . "<br>" . $conn->error;
    }


       //here we set logic conditions for updating various tables
     
       if ($actionOnTickets == 'Closed' && $ticket_status == 'Attended' ){
        $updateTicketRecord1 = "UPDATE ticket_details SET ticket_status = 'Waiting', actionOnTickets= 'Opened', timeOfIssue ='$timeOfIssue'  WHERE ticket_no = '$ticket_no'";
        $getResult1 = mysqli_query($conn, $updateTicketRecord1);

        //update comment registy tab
        $updateTicketRecord2 = "UPDATE comment_registry SET  ticket_status= 'Opened', timeCreated ='$time'  WHERE ticket_id = '$ticket_no'";
        $getResult2 = mysqli_query($conn, $updateTicketRecord2);

        $msg .= "<b style='color:green'>Comment(s) Added And Ticket <u>" .$ticket_no."</u> Has Been Reopened </b>";

    }else{
      //updates based on certain action on ticket like when ticket is closed
    $updateTicketRecord = "UPDATE ticket_details SET ticket_status = 'Attended', actionOnTickets= 'Closed'  WHERE ticket_no = '$ticket_no'";
    $getResult = mysqli_query($conn, $updateTicketRecord);

    //update comment registy tab
    $updateTicketRecord3 = "UPDATE comment_registry SET  ticket_status= 'Closed', timeCreated ='$time'  WHERE ticket_id = '$ticket_no'";
    $getResult3 = mysqli_query($conn, $updateTicketRecord3);

        $msg .= "<b style='color:green'>Comment(s) Added And Ticket <u>" .$ticket_no."</u> Updated Successfully!</b>";
    } 

    //send email notifications when a ticket has been updated
      $to = $staff_email;
      $subject = "COMMENT NOTIFICATION";
      $message = '<html>
      <head>
          <title>ICTA|COMMENT NOTIFICATION</title>
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
                       <p class="greetings"> <b>Good Day '.$issuerName .',</b></p> 
                       <p class="mail_body"> 
                          This is to notify you that a comment has been added to the ticket you raised earlier
                          <u>'.$ticket_no.'</u>. To view this comment and add a reply, kindly login to
                          your account by clicking this login link <a href="https://edoictaservices.com.ng/helpdesk">login</a>.
                          Thank you and have a good day. 
                         </p>
                         <center><h2>Details</h2></center>
                         <hr>
                          <p class="ticket_details">
                             TICKET STATUS : <u>'.$ticket_status.'</u>
                          </p>
                          <hr>
                          <p class="ticket_details">
                             PRIORITY LEVEL : '.$priorityLevel.'
                          </p>
                          <hr>
                          <p class="ticket_details">
                             COMPLAINT RAISED : '.$complaints.'
                          </p>
                          <hr>
                          <p class="ticket_details">
                              COMMENT ADDED  : <b>'.$message.'</b>
                          </p>
                          <hr>
                          <p class="ticket_details">
                            COMMENTED BY : '.$usersFullNames.'
                          </p>
                          <hr>

                          <p>&copy; <?php echo date(Y); ?> ICTA HELP DESK  Email:<b>icta.helpdesk@edostate.gov.ng</b></p> 


                     </div>
                 </center> 
  
  
      </body>
  </html>';
      $headers = "From: ictahelpdesk@edoictaservices.com.ng \r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'Cc:icta.helpdesk@edostate.gov.ng' . "\r\n";
      $headers .= 'Cc:'.$Accslevel4Email."\r\n";

            $email_box = mail($to, $subject, $message, $headers);

              if ($email_box == true){

              }
              else{
                $errMsg = "could not send mail!"; 
              } 
 
            
       
        echo $msg." ".$errMgs;

    
    }//end of if empty

        
}// end of isset condition 



?>