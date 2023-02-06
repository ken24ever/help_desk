<?php


$dispResult= "";


    include('includes/db_connect.php');
    
    $sql = "SELECT * FROM icta_units";
    $result = mysqli_query($conn, $sql);

    //by default
    $dispResult .= '<option selected > Select ICTA UNIT .<strong style="color: red !important;">*</strong></option>';
    while( $row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $ictaUnits = $row['departments_units'];

        //get queried results
       
        $dispResult .= '<option value="'.$ictaUnits.'">'.$ictaUnits.'</option>';
    }

    echo $dispResult;



?>