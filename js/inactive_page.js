$(document).ready(function(){

    function timeChecker(){
        setInterval(function(){
            var storedTimeStamp =  sessionStorage.getItem("lastTimeStamp");
            timeCompare(storedTimeStamp);
    }, 3000)
      }

      function timeCompare(timeString){
        var currentTime = new Date();
        var pastTime = new Date(timeString);
        var timeDiff = currentTime - pastTime;
        var minPast = Math.floor( (timeDiff/60000) );

        if (minPast === 2) // greater than a min
        {
            sessionStorage.removeItem("lastTimeStamp") ;  
     

            toastr.warning( "Page Has Been Inactive For Awhile, Logging Out Shortly!", "INACTIVE" )

        }// end of if
        else if ( minPast >= 2){
            sessionStorage.removeItem("lastTimeStamp") ;  
            window.location = "http://localhost/Thehelpdesk/logout.php";
        } 
        else{
            console.log(currentTime +" - "+ pastTime+" - "+minPast+"min past");
        }//end of else
      }//end of timeCompare()

        $(document).mouseover(function(){
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp", timeStamp);
        })//end of $(document).mouseover

            timeChecker()

})//end of first function