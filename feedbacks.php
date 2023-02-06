<?php
session_start(); 
  //session variable  for the user that's commenting
  $userNames = $_SESSION['fullnames'];
  $firstName =$_SESSION['firstName'];
  $middleName = $_SESSION['middleName'];
  $lastName = $_SESSION['lastName'] ;
  $user_id = $_SESSION['user_id'];
  $user_accsLvl = $_SESSION['access_level'];
   $usersFullNames = $firstName .''. $middleName .''. $lastName;


   //fetch limit data code
$pageLimit = 4;
$pageData = 0;

// check if pageData isset
if (isset($_POST['pageData'])){
  $pageData = $_POST['pageData'];

}
else{
  $pageData = 1;
}
//where the page is going to start from
$start_from = ($pageData-1)*$pageLimit;



/* access level 1 */
  if ($user_accsLvl == 1){
    include('includes/db_connect.php');
    $table= " ";
        //table goes here
        $table .= '
        

        
        
        <table id="customers">
       
        
        <tr>
     
        <th >Ticket No</th>
        <th >Isuer Name</th>
        <th >Comments By</th>
        <th >Ticket Status</th>
        <th>Date/Time</th>
        <th >Action</th>
        </tr>
      
        
        ';

         // SELECT DATA FROM DB  
         $sql = "SELECT * FROM comment_registry WHERE issuer_name LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  OR issuer_name LIKE '%$firstName%'  ORDER BY timeCreated DESC  LIMIT $start_from, $pageLimit ";
         $result = mysqli_query($conn, $sql);
         //here we check for any matching data
        if (mysqli_num_rows($result) > 0)
        {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        $ticketID =$row['ticket_id'];
        $issuedBy =$row['issuer_name'];
        $seen =$row['seen'];
        $ticketStatus =$row['ticket_status'];
        $commentBy =$row['commented_by'];
        $dateNtime = $row['created_at']; 
        //$dateNtime = strtotime($dateNtime);
        //$dateNtime = date('M d Y', $dateNtime);   
        
        
         
        $table .= '
        
       
        <tr class="text-dark">
        
        <td>
            '.$ticketID.'
        </td>
        
        <td>
        '.$issuedBy.'
        </td>

        <td>
        '.$commentBy.'
        </td>

        <td>
        '.$ticketStatus.'
        </td>

         <td>
         '.$dateNtime.'
          </td>

          <td>
          <button class=" myBtn getID btn btn-success" id='.$ticketID.'  title='.$ticketID.'> View/Add Comments </button>
           </td>
        </tr>
     
        ';
        
        
        
        }//end of while loop
        
        
        
        }//end of if (mysqli_num_rows($result) > 0)
        else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td><p style='color:red !important'; font-size:19px>Records Not Available</p></td> <td></td> 
        </tr>
        ";
        }
        
 // pagination code 
 $query = mysqli_query($conn, "SELECT * FROM comment_registry WHERE issuer_name LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  OR issuer_name LIKE '%$firstName%' ORDER BY timeCreated DESC ");
 $total_records = mysqli_num_rows($query);
 $total_pages = ceil($total_records/$pageLimit);
 $table .= '
 <ul class="pagination pagination-md pagination-circle">';
 
 // now conditions for previous and next
 if ($pageData > 1){
     $previous = $pageData-1;
     $table .= '<li class="pageItem page-item" id="1"><span class="page-link">First Page</span></li>';
     $table .= '<li class="pageItem page-item" id="'.$previous.'" title="'.$previous.'" ><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
 }
 
 //iteration for th number of pages to be seen 
 for ($i=1; $i<=$total_pages; $i++){
         $active_class = "";
         if ($i == $pageData){
             $active_class = "active" ;
         }
         $table .= '<li class="pageItem page-item '.$active_class.'" id="'.$i.'" title="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
 }
 
 if ($pageData < $total_pages){
         $pageData++;
         $table .= '<li class="pageItem page-item" id="'.$pageData.'" title="'.$pageData.'" ><span class="page-link"><i  class="fa fa-arrow-right" >
         </i></span></li>';
         $table .= '<li class="pageItem page-item" id="'.$total_pages.'" title="'.$total_pages.'"><span class="page-link">Last Page</span></li>';
 
 }
 
 
 $table .= '</ul>';
 
        


echo $table;

        

  }

/* end of access level 1 */






  /* access level 2 */
  else if ($user_accsLvl == 2 ){

    include('includes/db_connect.php');
    $table= " ";
        //table goes here
        $table .= '
        

        
        
        <table id="customers">
       
        
        <tr>
     
        <th >Ticket No</th>
        <th >Isuer Name</th>
        <th >Comments By</th>
        <th >Ticket Status</th>
        <th>Date/Time</th>
        <th >Action</th>
        </tr>
      
        
        ';

         // SELECT DATA FROM DB  
         $sql = "SELECT * FROM comment_registry WHERE issuer_name LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  OR issuer_name LIKE '%$firstName%' ORDER BY timeCreated DESC LIMIT $start_from, $pageLimit ";
         $result = mysqli_query($conn, $sql);
         //here we check for any matching data
        if (mysqli_num_rows($result) > 0)
        {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        $ticketID =$row['ticket_id'];
        $issuedBy =$row['issuer_name'];
        $seen =$row['seen'];
        $ticketStatus =$row['ticket_status'];
        $commentBy =$row['commented_by'];
        $dateNtime = $row['created_at']; 
        //$dateNtime = strtotime($dateNtime);
        //$dateNtime = date('M d Y', $dateNtime);   
        
        
         
        $table .= '
        
       
        <tr class="text-dark">
        
        <td>
            '.$ticketID.'
        </td>
        
        <td>
        '.$issuedBy.'
        </td>

        <td>
        '.$commentBy.'
        </td>

        <td>
        '.$ticketStatus.'
        </td>

         <td>
         '.$dateNtime.'
          </td>

          <td>
          <button class=" myBtn getID btn btn-success" id='.$ticketID.'  title='.$ticketID.'> View/Add Comments </button>
           </td>
        </tr>
     
        ';
        
        
        
        }//end of while loop
        
        
        
        }//end of if (mysqli_num_rows($result) > 0)
        else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td><p style='color:red !important'; font-size:19px>Records Not Available</p></td> <td></td> 
        </tr>
        ";
        }
        

       // pagination code 
$query = mysqli_query($conn, "SELECT * FROM comment_registry WHERE issuer_name LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  OR issuer_name LIKE '%$firstName%' ORDER BY timeCreated ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$pageLimit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($pageData > 1){
    $previous = $pageData-1;
    $table .= '<li class="pageItem page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="pageItem page-item" id="'.$previous.'" title="'.$previous.'" ><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $pageData){
            $active_class = "active" ;
        }
        $table .= '<li class="pageItem page-item '.$active_class.'" id="'.$i.'" title="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($pageData < $total_pages){
        $pageData++;
        $table .= '<li class="pageItem page-item" id="'.$pageData.'" title="'.$pageData.'" ><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="pageItem page-item" id="'.$total_pages.'" title="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';
  


echo $table;

   

  }
   /* end of access level 2 */









    /* access level 3 */
  else if ($user_accsLvl == 3){

    include('includes/db_connect.php');
    $table= " ";
        //table goes here
        $table .= '
        

        
        
        <table id="customers">
       
        
        <tr>
     
        <th >Ticket No</th>
        <th >Isuer Name</th>
        <th >Comments By</th>
        <th >Ticket Status</th>
        <th>Date/Time</th>
        <th >Action</th>
        </tr>
      
        
        ';
       

         // SELECT DATA FROM DB  
         $sql = "SELECT * FROM comment_registry WHERE  commented_by LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  ORDER BY timeCreated DESC LIMIT $start_from, $pageLimit ";
         $result = mysqli_query($conn, $sql);
         //here we check for any matching data
        if (mysqli_num_rows($result) > 0)
        {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        $ticketID =$row['ticket_id'];
        $issuedBy =$row['issuer_name'];
        $seen =$row['seen'];
        $ticketStatus =$row['ticket_status'];
        $commentBy =$row['commented_by'];
        $dateNtime = $row['created_at']; 
        //$dateNtime = strtotime($dateNtime);
        //$dateNtime = date('M d Y', $dateNtime);   
        
        
         
        $table .= '
        
       
        <tr class="text-dark">
        
        <td>
            '.$ticketID.'
        </td>
        
        <td>
        '.$issuedBy.'
        </td>

        <td>
        '.$commentBy.'
        </td>

        <td>
        '.$ticketStatus.'
        </td>

         <td>
         '.$dateNtime.'
          </td>

          <td>
          <button class=" myBtn getID btn btn-success" id='.$ticketID.'  title='.$ticketID.'> View/Add Comments </button>
           </td>
        </tr>
     
        ';
        
        
        
        }//end of while loop
        
        
        
        }//end of if (mysqli_num_rows($result) > 0)
        else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td><p style='color:red !important'; font-size:19px>Records Not Available</p></td> <td></td> 
        </tr>
        ";
        }
        

               // pagination code 
$query = mysqli_query($conn, "SELECT * FROM comment_registry WHERE issuer_name LIKE '%$usersFullNames%' OR issuer_name LIKE '%$usersFullNames%' OR commented_by LIKE '%$firstName%'  OR issuer_name LIKE '%$firstName%' ORDER BY timeCreated ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$pageLimit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($pageData > 1){
    $previous = $pageData-1;
    $table .= '<li class="pageItem page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="pageItem page-item" id="'.$previous.'" title="'.$previous.'" ><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $pageData){
            $active_class = "active" ;
        }
        $table .= '<li class="pageItem page-item '.$active_class.'" id="'.$i.'" title="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($pageData < $total_pages){
        $pageData++;
        $table .= '<li class="pageItem page-item" id="'.$pageData.'" title="'.$pageData.'" ><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="pageItem page-item" id="'.$total_pages.'" title="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';

   


echo $table;

   

  }
   /* end of access level 3 */










    /* access level 4*/
   else if ($user_accsLvl == 4){

    include('includes/db_connect.php');
    $table= " ";
        //table goes here
        $table .= '
        

        
        
        <table id="customers">
       
        
        <tr>
     
        <th >Ticket No</th>
        <th >Isuer Name</th>
        <th >Comments By</th>
        <th >Ticket Status</th>
        <th>Date/Time</th>
        <th >Action</th>
        </tr>
      
        
        ';

         // SELECT DATA FROM DB  
         $sql = "SELECT * FROM comment_registry ORDER BY timeCreated DESC LIMIT $start_from, $pageLimit ";
         $result = mysqli_query($conn, $sql);
         //here we check for any matching data
        if (mysqli_num_rows($result) > 0)
        {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        $ticketID =$row['ticket_id'];
        $issuedBy =$row['issuer_name'];
        $seen =$row['seen'];
        $ticketStatus =$row['ticket_status'];
        $commentBy =$row['commented_by'];
        $dateNtime = $row['created_at']; 
        //$dateNtime = strtotime($dateNtime);
        //$dateNtime = date('M d Y', $dateNtime);   
        
        
         
        $table .= '
        
       
        <tr class="text-dark">
        
        <td> 
            '.$ticketID.'
        </td>
        
        <td>
        '.$issuedBy.'
        </td>

        <td>
        '.$commentBy.'
        </td>

        <td>
        '.$ticketStatus.'
        </td>

         <td>
         '.$dateNtime.'
          </td>

          <td>
          <button class=" myBtn getID btn btn-success" id='.$ticketID.'  title='.$ticketID.'> View/Add Comments </button>
           </td>
        </tr>
     
        ';
        
        
        
        }//end of while loop
        
        
        
        }//end of if (mysqli_num_rows($result) > 0)
        else{
        $table .= "
        <tr>
        <td></td> <td></td> <td></td> <td></td> <td><p style='color:red !important'; font-size:19px>Records Not Available</p></td> <td></td> 
        </tr>
        ";
        }
        

          // pagination code 
$query = mysqli_query($conn, "SELECT * FROM comment_registry ORDER BY timeCreated ");
$total_records = mysqli_num_rows($query);
$total_pages = ceil($total_records/$pageLimit);
$table .= '
<ul class="pagination pagination-md pagination-circle">';

// now conditions for previous and next
if ($pageData > 1){
    $previous = $pageData-1;
    $table .= '<li class="pageItem page-item" id="1"><span class="page-link">First Page</span></li>';
    $table .= '<li class="pageItem page-item" id="'.$previous.'" title="'.$previous.'" ><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>';
}

//iteration for th number of pages to be seen 
for ($i=1; $i<=$total_pages; $i++){
        $active_class = "";
        if ($i == $pageData){
            $active_class = "active" ;
        }
        $table .= '<li class="pageItem page-item '.$active_class.'" id="'.$i.'" title="'.$i.'"  ><span class="page-link">'.$i.'</span></li>';
}

if ($pageData < $total_pages){
        $pageData++;
        $table .= '<li class="pageItem page-item" id="'.$pageData.'" title="'.$pageData.'" ><span class="page-link"><i  class="fa fa-arrow-right" >
        </i></span></li>';
        $table .= '<li class="pageItem page-item" id="'.$total_pages.'" title="'.$total_pages.'"><span class="page-link">Last Page</span></li>';

}


$table .= '</ul>';



echo $table;

   

   }
    /* end of access level 4 */