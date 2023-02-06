<?php


$dispResult= "";


    include('includes/db_connect.php');
    
    $sql = "SELECT * FROM ministries";
    $result = mysqli_query($conn, $sql);
    while( $row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $MDAs = $row['namesOfMinistries'];

        //get queried results
       
        $dispResult .= '<option value="'.$MDAs.'">'.$MDAs.'</option>';
    }

    echo $dispResult;



?>