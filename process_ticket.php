<?php
 session_start(); 
$errMessages = "";
$valid = 1;


         //file directory
         $target_dir = 'uploads/'; 
            // response messages
            $response = array (
                'status' => 0,
                'message' => "Form submission failed, please try again!",
                'ticketNo' => " "
            );

   //file type formats the program can allow
   $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');

if (isset($_POST['title']) || isset($_POST['firstName']) || isset($_POST['middleName']) || isset($_POST['lastName'])|| isset($_POST['job'])
|| isset($_POST['email'])|| isset($_POST['MDA']) || isset($_POST['job']) || isset($_POST['issues']) 
|| isset($_POST['description'])|| isset($_POST['files'])|| isset($_POST['entry_date'])|| isset($_POST['selectTicketCat']) ){

    
    

         //now we validate data from javascript lastName
 function test_input($data) { 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // set up a local variable to grab the posted data from the form
    $personalityTitle =  test_input($_POST['title']);
    $firstName =  test_input($_POST['firstName']);
    $middleName =  test_input($_POST['middleName']);
    $lastName =  test_input($_POST['lastName']);
    $email =  test_input($_POST['email']);
    $job_title = test_input($_POST['job']);
    $MDA =  test_input($_POST['MDA']);
    $issues =  test_input($_POST['issues']);
    $selectTicketCat =  test_input($_POST['selectTicketCat']);
    //$hidden_issues_section =  test_input($_POST['hidden_issues_section']);
    $description =  test_input($_POST['description']);
   // $units = test_input($_POST['units']);
    $file =  $_FILES["files"];
    //$priority =  test_input($_POST['priority']);
    $entry_date =  test_input($_POST['entry_date']);
    $actionOnTicket = test_input("Opened");
    $ticketStatus = test_input("Pending");
    $timeOfIssue = time();  
    $fullNames = $firstName .' '.$middleName.' '.$lastName;

    if (empty( $personalityTitle)){
        $valid = 0;
        $errMessages .= "<br> Please Enter Your Title!";
        //return false;

    }//end of if empty
  else  if (empty( $firstName)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your First Name!";
       //return false;
   }//end of if empty

   else if (empty( $lastName)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Last Name!";
      // return false;
   }//end of if empty
   else if (empty( $email)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Official Email!";
      // return false;
   }//end of if empty
   else if (empty( $MDA)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Ministry, Department and Agency!";
      // return false;
   }//end of if empty

   else if (empty( $description)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Your Description!";
      // return false;
   }//end of if empty
   else if (empty( $entry_date)){
       $valid = 0;
       $errMessages .= "<br> Please Enter Date Of Entry!";
       //return false;
   }//end of if empty
   
     //validate Email field 

     else if (filter_var($email, FILTER_VALIDATE_EMAIL)===false){

        $valid = 0;
        $errMessages .= "<br>Please Enter A Valid Email!.";
       // return false;
}//end of (filter_var($email, FILTER_VALIDATE_EMAIL)===false)
else{
            //when valid == 1 the upload files 
            if ($valid == 1){

             // generate a random ticket number each time a form is submitted using Mersenne Twister
                $generateRandomNum =  '#'.mt_rand(1000000,9000000);

       

                    $uploadStatus = 1;
                    $fileNames = array_filter($file['name']);

                    //upload file(s) now
                    $uploadedFile = "";
                    if (!empty($fileNames)) {

                            foreach($file['name'] as $key => $var){

                                $file_name = basename($file['name'][$key]);

                                //filepath
                                $targetedFilePath = $target_dir . $file_name;

                                //check whether file type is valid
                                $fileType = pathinfo($targetedFilePath, PATHINFO_EXTENSION);

                                if (in_array($fileType, $allowTypes)){

                                    if (move_uploaded_file($file['tmp_name'][$key], $targetedFilePath)){

                                        $uploadedFile .= $file_name.',';

                                    }//end of (move_uploaded_file($file['tmp_name'][$key], $targetedFilePath))
                                        
                                    else{

                                        $uploadStatus = 0;
                                        $response['message'] = "Oops! There was an error uploading your file!";

                                        }//end of else for move_upload

                                }//end of (in_array($fileType, $allowTypes))
                                else{

                                    $uploadStatus = 0;
                                    $response['message'] = "Sorry! System can only accept 'pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg' ";
                               
                                }// end of (in_array($fileType, $allowTypes)

                            }//end of foreach

                    }//end of if (!empty($fileNames))

            }//end of if valid == 1

                if ($uploadStatus == 1){ 

                    // Now we include database connect script
            include("includes/db_connect.php");

            //here we use validate function to trim the file

            $uploadFileStr = trim($uploadedFile, ',');
             $ticketCreatedBy = $_SESSION['email'];

               //here we insert into the database table of all posted data using prepared stmt
 $stmt = $conn->prepare("INSERT INTO ticket_details (title,fullNames,firstName,middle_name,lastName,staff_email,job_title,
 ticket_status,MDAs,ticket_no,ticketCreatedBy, ticketCat, complaints,comments,files,date_issued,timeOfIssue,actionOnTickets) 
               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
     $stmt->bind_param("ssssssssssssssssss", $personalityTitle, $fullNames, $firstName, $middleName, $lastName, $email,
     $job_title,$ticketStatus,$MDA,$generateRandomNum,$ticketCreatedBy, $selectTicketCat, $issues, $description, $uploadFileStr,
      $entry_date, $timeOfIssue, $actionOnTicket);
     $stmt->execute(); 

     if ($stmt){
        
        $response['status'] = 1;
        $response['ticketNo'] = $generateRandomNum;

         //send email
   /*       $to = $email;
         $subject = "TICKET NUMBER GENERATED";
         $message = '<!DOCTYPE html>
         <html>
             <head>
                 <title>ICTA|TICKET NUMBER</title>
                 <style>
                    body{
                 background-color: hsl(218,41%,15%);
                 background-image: radial-gradient(
                   650px circle at 0% 0%,
                 hsl(218, 41%, 35%) 15%,
                 hsl(218, 41%, 30%) 35%,
                 hsl(218, 41%, 20%) 75%,
                 hsl(218, 41%, 19%) 80%,
                 transparent 100%
                 ),
                 radial-gradient(
                 1250px circle at 100% 100%,
                 hsl(218, 41%, 35%) 15%,
                 hsl(218, 41%, 30%) 35%,
                 hsl(218, 41%, 20%) 75%,
                 hsl(218, 41%, 19%) 80%,
                 transparent 100%
         
                 );
                 height:100vh;
                 color:whitesmoke;
                 font-family: open sans;
               }
         
               div{
                 margin: 200px auto;
                 text-align: center;
               }
                 </style>
             </head>
             <body>
                         <div>
                              <p> Dear <b>'.$lastName.'</b>, </p>
                             <p>Thank You <b>'.$lastName.' '.$firstName.'</b> For Contacting ICTA Help Desk. </p>
                            <p> <b>Please wait while we attend to the complaint!</b></p>
                             <p>Your ticket Number is : '.$generateRandomNum.' </p>
                             <p>Type of ticket: '.$selectTicketCat.' </p>
                              <p>Reason for raising a ticket: '.$issues.' </p>
                              <hr>
                              <p>Ticket Discription: '.$description.' </p>
                              <hr>
                              <p>&copy; ICTA HELP DESK  Email:<b>helpdesk@edostate.gov.ng</b></p> 
                         </div>
         
         
             </body>
         </html>';
         $headers = "From: Icta-helpdesk@edostate.gov.ng \r\n";
         $headers .= "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
         $headers .= 'Cc:helpdesk@edostate.gov.ng' . "\r\n";
 
               $email_box = mail($to, $subject, $message, $headers);

                 if ($email_box == true){

                 }
                 else{
                    $response['message'] = "could not send mail!"; 
                 } */ 
 
        $response['message'] = 'Form Data Successfully Submitted!';

           

    }//end of if $stmt

                }//end of if $uploadStatus == 1

              else {
                error_log('Could not create a statement:' . $conn->error);
                        $response['message'] = "Please, Fill All Mandatory Fields!".$errMessages;
                      //return false;  
                }// else for if ($uploadStatus == 1) 

                //return response

                
 }//end of isset function

}// if error else  

// header('Content-Type: application/json');
echo json_encode($response);
?>