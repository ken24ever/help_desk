


<?php
if ( isset($_POST['id']) && isset($_POST['dept']) && isset($_POST['officerName'])  && isset($_POST['priorityL'])  ){

    $id = $_POST['id'];
    $dept =  $_POST['dept'];
    $officerName =  $_POST['officerName'];
    $priorityL =  $_POST['priorityL'];

$res = array (
    'id' => $id ,
    'ticket_no' => "error",
    'assign_unit' => $dept,
    'assigned_to' => "none",
    'priorityLevel' => $priorityL,
 
  );
  echo json_encode($res);


}
?>