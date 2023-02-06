<?php
//GET DATA STORED IN THE GLOBAL VARIABLE SESSION THATS SPREAD ACCROSS PAGES
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
//initialise local variables
$msgBox = "";
$errMsg = "";

if ( isset($_POST['replyMsgs'] ) && isset($_POST['ticketNo'] ) )
{
      //here we sanitize all data entry for
  function test_input($data)
   {
         $data = trim($data);
         $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
   }
 

    $ticketNo  = $_POST['ticketNo'];
    $messageSent  =  test_input($_POST['replyMsgs']);
    $createdDateAndTime = date('M d Y h:i:sa ');
    $time = time();

    include('includes/db_connect.php');


              // SELECT DATA FROM DB
            $sql = "SELECT * FROM comment_registry  WHERE ticket_id = '$ticketNo' ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result))
            {
                  $issuer_name = $row['issuer_name']; 

            }//end of while loop

               // SELECT DATA FROM DB
$sql1 = "SELECT * FROM ticket_details  WHERE ticket_no = '$ticketNo' ";
$result1 = mysqli_query($conn, $sql1);

        while ($row1 = mysqli_fetch_assoc($result1)){
            $title = $row1['title'];
            $issuerName =$row1['fullNames'];
            $firstName = $row1['firstName'];	
            $middle_name = $row1['middle_name'];
            $lastName = $row1['lastName'];
            $staff_email = $row1['staff_email'];
            $job_title = $row1['job_title'];
            $ticket_status = $row1['ticket_status'];
            $MDAs = $row1['MDAs'];
            $assign_unit = $row1['assign_unit'];
            $assigned_to = $row1['assigned_to'];
            $ticket_no = $row1['ticket_no'];
            $complaints = $row1['complaints'];
            $comments = $row1['comments'];
            $files = $row1['files'];
            $priorityLevel = $row1['priorityLevel'];
            $date_issued = $row1['date_issued'];
            $timeOfIssue = $row1['timeOfIssue'];
            $actionOnTickets = $row1['actionOnTickets'];
            $timeOfIssue = time(); 

           
            

        }//end of while loop

                // insert into comments_logs

            /*  $stmt = $conn->prepare("INSERT INTO comments_logs (ticket_id, created_at, ticket_issuer, commentBy, commentsBody, timeCreated) 
               VALUES (?,?,?,?,?,?)");
             $stmt->bind_param("ssssss", $ticketNo, $createdDateAndTime, $issuer_name , $commented_by, $comments, $time  );
            $stmt->execute(); */ 
  
             // Here we insert into comments_logs
             $stmt_query1 = "INSERT INTO comments_logs (ticket_id, created_at, ticket_issuer, commentBy, commentsBody, timeCreated )
             VALUES ('$ticketNo', '$createdDateAndTime', '$issuer_name', '$usersFullNames', '$messageSent', '$time')";
  
                if ($conn->query($stmt_query1) === TRUE)
                 {
                 //  echo "New record created successfully";
                 $msgBox .= "Comment Added Successfully to ticket :". $ticketNo;
                         
                } else
                 {
                     $msgBox .=  "Error: " . $stmt_query1 . "<br>" . $conn->error;
                  }

                     //update comment registy tab
    $updateTicketRecord3 = "UPDATE comment_registry SET  timeCreated ='$time'  WHERE ticket_id = '$ticketNo'";
    $getResult3 = mysqli_query($conn, $updateTicketRecord3);

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
                              COMMENT ADDED  : <b>'.$messageSent.'</b>
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
 
            
            
            
            echo  $msgBox." ".$errMsg;
}


?>