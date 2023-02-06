<?php

 
// Define variables and initialize with empty values
$email= $password=$output_msg="";
 
// Processing form data when form is submitted
if( isset($_POST['email']) && isset($_POST['password']) && $_SERVER["REQUEST_METHOD"] == "POST"){
     
   


    //connect to db
     include("includes/db_connect.php");

      //now we validate data from javascript
      function test_input($data) {
        $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
        return $data;
          } //end of test_input

          //now assign variables locally
          $email = test_input($_POST["email"]); 
          $password = md5($_POST["password"]);
         // $time = date("h:i:s");
          $loginUpdateDate = date('M, d, Y');

    
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE email_address = ? AND pass_word = ?";

          $stmt = mysqli_stmt_init($conn);
         $get_stmt_prepared= mysqli_stmt_prepare($stmt, $sql);

        if(!$get_stmt_prepared){
            $output_msg .= "SQL statement failed!";
           // return false;
        }
        else{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $email,$password);
            // execute query
            mysqli_stmt_execute($stmt) ; 
            //here get results from query          
            $result = mysqli_stmt_get_result($stmt);
          
            //loop
           while($row = mysqli_fetch_assoc($result)){
             
            $usrID = $row['id'];
            $Email = $row['email_address'];
            $pass_word = $row['pass_word'];
            $access_level = $row['access_level'];
            $firstName = $row["firstName"];
            $middleName = $row["middleName"];
            $lastName = $row['lastName'];
            $gender = $row["gender"];
            $jobTitle = $row["jobTitle"];
            $display_pic = $row["display_pic"];
            $MDA = $row["MDA"];
            $created_at  = $row["created_at"];
            $updated_at  = $row["updated_at"];
            $access_level   = $row["access_level"];
                    

                         //here we assign the local variables to session super global variable 
                         session_start(); 
                $_SESSION['email'] = $Email;
                $_SESSION['password'] = $pass_word;
                $_SESSION['access_level'] = $access_level;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['middleName'] = $middleName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['gender'] = $gender;
                $_SESSION['jobTitle'] = $jobTitle;
                $_SESSION['display_pic'] = $display_pic;
                $_SESSION['MDA'] = $MDA;
                $_SESSION['created_at'] = $created_at;
                $_SESSION['updated_at'] = $updated_at;
                $_SESSION['access_level'] = $access_level;
             
            } //end of while loop

                    if (mysqli_num_rows($result)  > 0 ){
             
             /*      header("location:dashboard.php"); */
               $output_msg .= 1 ;  

               $updateTicketRecord = "UPDATE users SET updated_at = '$loginUpdateDate'  WHERE email_address ='$email' LIMIT 1 ";
               $getResult = mysqli_query($conn, $updateTicketRecord);

               $ticketAccessLevel = "UPDATE ticket_details  SET access_level  = '$access_level'  WHERE staff_email  ='$email'  ";
               $getResult1 = mysqli_query($conn, $ticketAccessLevel);
                    
                    } else if (mysqli_num_rows($result) < 1 ){
                        $output_msg .= 0 ;
                        /* header("location:index.php"); */
                    }

                
                    echo $output_msg;
                   
                    
         

           
            
         }// end of  else stmt
            
    
     

            // Close connection
            mysqli_close($conn);

        }// end of if isset  





   


?>