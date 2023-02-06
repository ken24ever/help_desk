$(document).ready(function(){
$(document).on('click', '#searchTickets', function(){
        $('#searchedTickets').css('display','display')
     $('.chartDisplay').css('display','display')
         $(".loader").css('display','none') 
        const ticketNo = $('.searchTick').val()
        if (ticketNo == ""){

            function toasterOptions() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "100",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "show",
                    "hideMethod": "hide"
                };
            };
            
            
            toasterOptions();
                 toastr.error( "Input Must Not Be Empty!", "EMPTY FIELD!" )
          return false
        }else{
        $.ajax({
                type: "Post",
                url: "searchedTickets.php",
                data: {ticketNo:ticketNo},
                beforeSend:function(){
                    Swal.fire({
                        title: '',
                        icon: 'info',
                        html: '<img src="img/icta_logo.png" height="80" width="80"><br><br><strong>Loading Shortly...</strong>',
                        allowOutsideClick: false,
                        timer:2000
                        });
                       Swal.showLoading();
                        
                } ,
                success:function(searchTicket){
               

                    $(".ticket_records").html(searchTicket);
                /*     $('.chartDisplay').fadeOut("slow")
                    $("#searchedTickets ").fadeIn(4000);
                    */
                }// end of success


        })//end of ajax

    }// end of if (!ticketNo == "")

})




$(document).on('click', '.backToChart', function(){
    $('.chartDisplay').fadeIn("slow")
    $("#searchedTickets ").fadeOut("slow");
    $('#searchTick').val("")
  })//end of document onChange event 

})//end of doc ready