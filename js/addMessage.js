
   $(document).ready(function(){ 
  
  
    setInterval(function loadMessages(){ 
        $(document).on('click', '.getID', function (){
            var ticketID = $(this).attr("id");
            $.ajax({
                method: 'post',
                data: {ticketID:ticketID },
                url: 'messages.php',
                success: function(feedback){
           
                $('#messages').html(feedback)
                $('.header').html(ticketID)
                
                }//end of success func
        
        
            }) // end of ajax
            
        })
    }, 1000)

  

$('#formReply').on('submit',function(e){

    e.preventDefault()

    var replyMsgs = $('#comments').val()
    var ticketNo = $(".text").text();
    $.ajax({
        method: 'post',
        beforeSend: function(){
            //alert(ticketNo)
            Swal.fire({
              title: '',
              html: '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>Adding Comment...</strong>',
              allowOutsideClick: false,
             });
             Swal.showLoading();
                         },

        data: {replyMsgs:replyMsgs, ticketNo:ticketNo },
        url: 'sendReply.php',
        success: function(feedback){
            //alert(feedback)
            
            $('#comments').val("");
            Swal.fire({
                icon:"success",
                html: '<b style="color:green !important">'+feedback+'</b>',
              
            }) 
           

        

        
        }//end of success func


    }) // end of ajax
})

})
