$(document).ready(function(){

 const trayReport = (page1) => {
    $.ajax({
      method: 'post',
      url: 'trayReport.php',
      data:{page1:page1},
      dataType:'json',
      success: function(report){
       /*  console.log(report.occurence) */
        $(".tray").html(report.table)
        $(".pagination1").html(report.pagination)
       
      }//end of success func


          }) // end of ajax
  
        }//end of trayReport

        const CountTrayReport = () => {
          $.ajax({
            method: 'post',
            url: 'trayReport.php',
            dataType:'json',
            success: function(report){
                if (report.occurence == 0){
                  $(".numOfOpenedTray").html("")
                }else{

                  $(".numOfOpenedTray").html(report.occurence)
                }
             
            
            }//end of success func
      
      
                }) // end of ajax
        
              }//end of CountTrayReport
              setInterval(CountTrayReport, 1000)
        
        $(document).on("click", ".page-item1", function(){
            var page1 = $(this).attr("id");
            console.log(page1)
            trayReport(page1)
             
            })//end of onclick event
 
            trayReport()

})//end of doc ready
