<?php

 
// Define variables and initialize with empty values
$email= $password=$output_msg="";
 
// Processing form data when form is submitted
if( isset($_POST['confEml']) && isset($_POST['newPass']) && $_SERVER["REQUEST_METHOD"] == "POST"){
     
   


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
          $email = test_input($_POST['confEml']); 
          $password = md5(test_input($_POST['newPass']));
       

    
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE email_address = ? ";

          $stmt = mysqli_stmt_init($conn);
         $get_stmt_prepared= mysqli_stmt_prepare($stmt, $sql);

        if(!$get_stmt_prepared){
            $output_msg .= "SQL statement failed!";
           // return false;
        }
        else{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $email);
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
                    

        
            } //end of while loop

                    if (mysqli_num_rows($result)  > 0 ){
             
             /*      header("location:dashboard.php"); */
               $output_msg .= 1 ;  

               $updateTicketRecord = "UPDATE users SET pass_word = '$password'  WHERE email_address ='$email' LIMIT 1 ";
               $getResult = mysqli_query($conn, $updateTicketRecord);

                    
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