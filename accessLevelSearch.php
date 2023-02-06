<?php


$dispResult= "";


    include('includes/db_connect.php');
    
    $sql = "SELECT * FROM users WHERE MDA = 'Information And Communication Agency' ";
    $result = mysqli_query($conn, $sql);

    //by default
    $dispResult .= '<option selected value=""> Select Staff name.<strong style="color: red !important;">*</strong></option>';
    while( $row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $first = $row['firstName'];
        $middle = $row['middleName'];
        $last = $row['lastName']; 
        $jobTitle = $row['jobTitle'];
        $units = $row['units'];
        

        //get queried results
       
        $dispResult .= '<option value="'.$first.'"  >'.$first." ".$middle." ".$last." ( ".$units." )".'</option>';
    }

    echo $dispResult;



?>