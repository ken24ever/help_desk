function countTickets () {
    $(".loader").css('display','block') 
    $.ajax({
            type: "Post",
            url: "totalTickets.php",
            dataType:'json',
           
            success:function(response){


                // for blinking directions
function animElem2(){
    var animateNam = 'animated hinge';
    var animationend ='webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationEnd animationEnd'
    $(document).ready(function(e){
    
    $(".shake").addClass(animateNam).one(animationend, function(){ $(this).removeClass(animateNam)})
    })
    
    
    }
    
    setInterval(animElem2,1000)

    function animElem(){
        var animateNam = 'animated zoomOut';
        var animationend ='webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationEnd animationEnd'
        $(document).ready(function(e){
        
        $(".shake2").addClass(animateNam).one(animationend, function(){ $(this).removeClass(animateNam)})
        })
        
        
        }
        
        setInterval(animElem,1000)
                
               const percentageForOpen =  response.issuesOpened/100; 
              const  percentageForClose =response.closedIssues/100;

                $(".opened ").html(response.issuesOpened); 
                $(".closed ").html(response.closedIssues); 
                
                if (percentageForOpen >= percentageForClose ){

                    $(".percentage ").html('<b style="font-weight:900!important; font-size:16px!important"><i style="font-weight:900!important; font-size:16px!important" class="fas fa-arrow-up fa-sm me-1 text-danger "></i>'+percentageForOpen+'%'+'</b>');  
                }
                else if (percentageForOpen <= percentageForClose){
                    $(".percentage ").html('<b style="font-weight:900!important; font-size:16px!important"><i style="font-weight:900!important; font-size:16px!important" class="fas fa-arrow-down fa-sm me-1 text-danger "></i>'+percentageForOpen+'%'+'</b>');

                }

                if (percentageForClose >= percentageForOpen ){

                    $(".percentage1 ").html('<b style="font-weight:900!important; font-size:16px!important"><i style="font-weight:900!important; font-size:16px!important" class=" shake2 fas fa-arrow-up fa-sm me-1 text-success "></i>'+percentageForClose+'%'+'</b>');  
                }
                else if (percentageForClose <= percentageForOpen){
                    $(".percentage1 ").html('<b style="font-weight:900!important; font-size:16px!important"><i  style="font-weight:900!important; font-size:20px!important" class="shake fas fa-arrow-down fa-sm me-1 text-danger "></i>'+percentageForClose+'%'+'</b>');

                }

            }// end of success


    })//end of ajax
}


setInterval(countTickets,1000)