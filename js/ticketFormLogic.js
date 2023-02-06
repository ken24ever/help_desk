$(document).ready(function(){

    // $("#ictaUnits").css("display", "none")
     //here fetch all MDAs from the DB for ticket issuing
     getMDAs = () => {
       $.ajax({
                 type: "Post",
                 url: "getMDAs.php",
                 success:function(MDAs){
                     $("#MDA").html(MDAs)
                 
                 }// end of success
 
 
         })//end of ajax
 
 
     }// end of getMDAs()
 
     //here we call the function to execute
     getMDAs()
 
     //here fetch all MDAs for registration purpose
        //here fetch all MDAs from the DB
        getMDAsForRegistration = () => {
       $.ajax({
                 type: "Post",
                 url: "getMDAs.php",
                 success:function(MDAs){
                     $("#ministry").html(MDAs)
                 
                 }// end of success
 
 
         })//end of ajax
 
 
     }// end of getMDAsForRegistration()
 
     getMDAsForRegistration()
 
     //selecting the issue the onchange event triggers and assigns the department concerned for that issue
     $(document).on('change', '#issues', function(){
       const getIssue = $("#issues").val()
 
       switch (getIssue) {
   case "NETWORK":
   $("#priority").val("High")
     break;
   case "OFFICE 365":
     $("#priority").val("High")
     break;
   case "SCANNER":
     $("#priority").val("Low")
     break;
   case "3CX":
     $("#priority").val("Medium")
     break;
   case "EDOGOV PASSWORD":
     $("#priority").val("High")
     break;
   case "FAULTY LAPTOP":
     $("#priority").val("Medium")
     break;
   case "EMAIL":
     $("#priority").val("High")
     break;
     case "APPLICATION SUPPORT":
     $("#priority").val("Medium")
     break;
     case "NO LAPTOP":
     $("#priority").val("Medium")
     break;
     case "VPN":
     $("#priority").val("High")
     break;
     case "OTHERS":
     $("#priority").val("Help Desk Will Assign!")
     break;
 
      }
 
       $.ajax({
                 type: "Post",
                 url: "assignUnitForIssue.php",
                 data: {getIssue:getIssue},
                 success:function(assignUnit){
                     $("#units ").val(assignUnit)
                 }// end of success
 
 
         })//end of ajax
 
     })// end of on change event
 
     
 
   })// end of ready state
 