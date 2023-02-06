<?php
//GET DATA STORED IN THE GLOBAL VARIABLE SESSION THATS SPREAD ACCROSS PAGES
session_start();
$fullnames =  $_SESSION['fullnames'] ;
//initialise local variables
$msgBox = "";

if ( isset($_POST['ticketID'] ))
{
    $ticketNo  = $_POST['ticketID'];
    include('includes/db_connect.php');
  // SELECT DATA FROM DB
  $sql = "SELECT * FROM comments_logs  WHERE ticket_id = '$ticketNo' ORDER BY timeCreated ASC";
  $result = mysqli_query($conn, $sql);
      //here we check for any matching data
      if (mysqli_num_rows($result) > 0)
      {

                // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                { 
                    $ticket_ID = $row['id'];
                    $ticketUniqueHashNum = $row['ticket_id'];
                    $ticket_issuer = $row['ticket_issuer'];
                    $commentBy = $row['commentBy'];
                    $commentsBody = $row['commentsBody'];
                    $checkSeen = $row['checkSeen'];
                    $timeCreated = $row['timeCreated'];
                    $created_at = $row['created_at'];
                    $created_at = strtotime($created_at);
                    $created_at = date('M d Y', $created_at);


                       //set up  time
                     include_once('agoTime.php');
                     $agoTime = get_time_ago($timeCreated);

                     //MESSAGES BOX OUTPUT
if ($commentBy === $ticket_issuer && $commentBy === $fullnames){

 
                      $msgBox .= ' <div class="holder_ darker">
                        <span style="font-size:16px !important; font-family:tahoma !important; color:red">'.$commentBy.'</span>
                        <p>'.$commentsBody.'</p>
                        <span class="time-left">'.$created_at .' - '.$agoTime.'</span>;
                      </div>';

}

else 
{
   
    $msgBox .= ' <div class="holder_">
    <span style="font-size:16px !important; font-family:tahoma !important; color:red">'.$commentBy.'</span>
    <p>'.$commentsBody.'</p>
    <span class="time-right">'.$created_at .' - '.$agoTime.'</span>;
  </div>';               
}
                
                        
                  
                  

                }//end of while loop

  // SELECT DATA FROM DB
  $sql1 = "SELECT * FROM comments_logs  WHERE ticket_id = '$ticketNo' ORDER BY timeCreated ASC";
  $result1 = mysqli_query($conn, $sql1);
   // output data of each row
   while($row = mysqli_fetch_assoc($result)) 
   { 



   }//end of loop
          
        }//end of if (mysqli_num_rows($result) > 0)
        else
            {
            
                $msgBox .='
                 <div class="holder_" style="background-color:#ffffff !important">
                <p style="color:red !important">There are no messages to display now!</p>
                 </div>';

             

         
             }

       echo $msgBox;

}


?>