<?php


$dispResult= "";


    include('includes/db_connect.php');
    
    $sql = "SELECT * FROM users WHERE MDA = 'INFORMATION COMMUNICATION TECHNOLOGY AGENCY' ";
    $result = mysqli_query($conn, $sql);

    //by default
    $dispResult .= '<option selected > Select Officer .<strong style="color: red !important;">*</strong></option>';
    while( $row = mysqli_fetch_assoc($result)){

        $first = $row['firstName'];
        $mid = $row['middleName'];
        $last = $row['lastName'];
        $ictaUnits = $row['units'];

        //get queried results
       
        $dispResult .= '<option value="'.$first.' '.$mid.' '.$last.'">'.$first.' '.$mid.' '.$last.' ('.$ictaUnits.')</option>';
    }

    echo $dispResult;



?>