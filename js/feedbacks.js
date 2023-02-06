$(document).ready(function(){

       //load data pagination links         
    function pagination (pageData) { 
      
            $.ajax({
             type: "Post", 
             data: {pageData:pageData},
               url: "feedbacks.php", 
               success:function(feedbacks){
               $(".feedbacks").html(feedbacks)
    
              }// end of success 


})//end of ajax

}//end of pagination



$(document).on("click", ".pageItem",   function () {

  var page= $(this).attr("id");
  console.log(page)
  pagination(page)
})// end of feedbacksData ()

pagination()
         

    
      
    })//end of on keyup for icta
    
    
    
    
    
    
    
