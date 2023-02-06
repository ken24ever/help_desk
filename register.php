<?php
// define variables and set to empty values
//$firstname = $lastname = $country = $state= $gender= $dateOfBirth= $mda= $email= $password=$getdate= $error=$user_status="";
$dispMsg = "";

if (isset($_POST['first']) && isset($_POST['middle']) && isset($_POST['last'])&& isset($_POST['gender'])
&& isset($_POST['pass1']) && isset($_POST['ministry']) && isset($_POST['em'])
&& isset($_POST['office_title']) && isset($_POST['ictaUnits']) && $_SERVER["REQUEST_METHOD"] == "POST") 
{

  //now we validate data from javascript
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 



  //now assign variables locally
  $firstname = test_input($_POST["first"]);
  $middle =test_input($_POST["middle"]);
  $lastname = test_input($_POST["last"]);
  $gender = test_input($_POST["gender"]);
  $mda = test_input($_POST["ministry"]);
  $email = test_input($_POST["em"]);
  $office_title = test_input($_POST["office_title"]);
  $paswd =  test_input($_POST["pass1"]);
  $ictaUnits =  test_input($_POST["ictaUnits"]);
  $paswd = md5($paswd);
  $usersAccessLevel = 1;
  $createdDate = date('M d Y');


//connect to db
include("includes/db_connect.php");

 // Prepare a select statement
 $sql = "SELECT * FROM users WHERE email_address = ?";

 $stmt2 = mysqli_stmt_init($conn);
$get_stmt_prepared= mysqli_stmt_prepare($stmt2, $sql);
if(!$get_stmt_prepared){
  $output_msg .= "SQL statement failed!";
 // return false;
}else{
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt2, "s", $email);
// execute query
mysqli_stmt_execute($stmt2) ; 
//here get results from query          
$result = mysqli_stmt_get_result($stmt2);

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
        $units = $row["units"];
        $MDA = $row["MDA"]; 
        $created_at  = $row["created_at"];
        $updated_at  = $row["updated_at"];

       }// end of while loop 
       
        if (mysqli_num_rows($result) ==0 ){
         
          //add full names
         $fullnames= $firstname.' '. $middle.' '. $lastname;
                      // prepare and bind and also insert into users table
  $stmt = $conn->prepare("INSERT INTO users (fullnames, firstName , middleName, lastName , gender, jobTitle, access_level ,email_address 
  ,pass_word ,MDA, units ,created_at  ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param("ssssssssssss",$fullnames, $firstname, $middle, $lastname,$gender,$office_title,$usersAccessLevel,$email,$paswd,$mda,$ictaUnits,$createdDate
   );
  $stmt->execute(); 

  
  if (!file_exists($firstname."_".$lastname."_".$middle)){
  mkdir("profile_pics/".$firstname."_".$lastname."_".$middle,0777);
  }
  else {
    unlink("profile_pics/".$firstname."_".$lastname."_".$middle);
  }
  $dispMsg .= 1;
  // "Great! Your Registration Was Successful, Login Now To Explore!"
  mysqli_close($conn);

        }else if (mysqli_num_rows($result) == 1){ 

             
          $dispMsg .= 0;

//"Sorry! That Email Address Already Exists In Our System!" 
        }//end of else


        echo $dispMsg;

}//end of else statement







}//end of if set








?>