<?php


$dispResult= "";

if (isset($_POST['getIssue'])){

    //assign posted variable to a local var
    $getIssue = $_POST['getIssue'];

    include('includes/db_connect.php');

 /*    if ($getIssue === 'NETWORK'){

    }else if ($getIssue === 'NETWORK'){

    }else if (){

    }else if (){

    }else if (){

    }else if (){

    }else if () */

    switch ($getIssue) {
        case "NETWORK":

            $sql = "SELECT departments_units FROM icta_units WHERE departments_units = 'Network Support Unit'";
    $result = mysqli_query($conn, $sql);
    while( $row = mysqli_fetch_assoc($result)){
      
        $MDAs = $row['departments_units'];

        //get queried results
       
        $dispResult .= $MDAs;
    }
            break;
        case "OFFICE 365":
            $sql1 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Infrastructure And System Engineering Unit'";
            $result1 = mysqli_query($conn, $sql1);
            while( $row1 = mysqli_fetch_assoc($result1)){
               
                $MDAs1 = $row1['departments_units'];
        
                //get queried results
               
                $dispResult .=$MDAs1;
            }
            break;
        case "SCANNER":
            $sql2 = "SELECT departments_units FROM icta_units WHERE departments_units = 'IT Project Management Office'";
            $result2 = mysqli_query($conn, $sql2);
            while( $row2 = mysqli_fetch_assoc($result2)){
               
                $MDAs2 = $row2['departments_units'];
        
                //get queried results
               
                $dispResult .= $MDAs2;
            }
            break;

            case "3CX":
                $sql3 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Infrastructure And System Engineering Unit'";
                $result3 = mysqli_query($conn, $sql3);
                while( $row3 = mysqli_fetch_assoc($result3)){
                 
                    $MDAs3 = $row3['departments_units'];
            
                    //get queried results
                   
                    $dispResult .= $MDAs3;
                }
                break;

                case "EDOGOV PASSWORD":
                    $sql4 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Customer Service And Content Management Unit'";
                    $result4 = mysqli_query($conn, $sql4);
                    while( $row4 = mysqli_fetch_assoc($result4)){
                     
                        $MDAs4 = $row4['departments_units'];
                
                        //get queried results
                       
                        $dispResult .= $MDAs4;
                    }
                    break;
                    case "FAULTY LAPTOP":
                        $sql5 = "SELECT departments_units FROM icta_units WHERE departments_units = 'IT Project Management Office'";
                        $result5 = mysqli_query($conn, $sql5);
                        while( $row5 = mysqli_fetch_assoc($result5)){
                      
                            $MDAs5 = $row5['departments_units'];
                    
                            //get queried results
                           
                            $dispResult .=$MDAs5;
                        }
                        break;
                        case "EMAIL":
                            $sql6 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Infrastructure And System Engineering Unit'";
                            $result6 = mysqli_query($conn, $sql6);
                            while( $row6 = mysqli_fetch_assoc($result6)){
                              
                                $MDAs6 = $row6['departments_units'];
                        
                                //get queried results
                               
                                $dispResult .=$MDAs6;
                            }
                            break;
                            case "APPLICATION SUPPORT":
                                $sql7 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Customer Service And Content Management Unit'";
                                $result7 = mysqli_query($conn, $sql7);
                                while( $row7 = mysqli_fetch_assoc($result7)){
                                   
                                    $MDAs7 = $row7['departments_units'];
                            
                                    //get queried results
                                   
                                    $dispResult .= $MDAs7;
                                }
                                break;
                                case "NO LAPTOP":
                                    $sql8 = "SELECT departments_units FROM icta_units WHERE departments_units = 'IT Project Management Office'";
                                    $result8 = mysqli_query($conn, $sql8);
                                    while( $row8 = mysqli_fetch_assoc($result8)){
                                      
                                        $MDAs8 = $row8['departments_units'];
                                
                                        //get queried results
                                       
                                        $dispResult .=$MDAs8;
                                    }
                                    break;
                                    case "VPN":
                                        $sql9 = "SELECT departments_units FROM icta_units WHERE departments_units = 'Infrastructure And System Engineering Unit'";
                                        $result9 = mysqli_query($conn, $sql9);
                                        while( $row9 = mysqli_fetch_assoc($result9)){
                                          
                                            $MDAs9 = $row9['departments_units'];
                                    
                                            //get queried results
                                           
                                            $dispResult .= $MDAs9;
                                        }
                                        break;
                                        case "OTHERS":
                                          
                                            $dispResult .='Help Desk Will Assign!';
                                            break;
                                            
       
    } 

   
    


    echo $dispResult;


}// end of isset post




?>