$(document).ready(function(){ 
     
  getNoOfAction = () => {
                   // var ctx = document.getElementById("barChart")
  const ctx = document.getElementById("closedChart").getContext("2d")// added '.getContext("2d")'
  const gradientFill = ctx.createLinearGradient(0, 0, 0, 290);
  gradientFill.addColorStop(0, "hsla(110, 71%, 35%, 1)");
  gradientFill.addColorStop(1, "hsla(110, 41%, 35%, 0.2)");
  $.ajax({
    type: "POST",
    url:"getNoOfAction.php",
    dataType:'json',
    cache:false,
    /* contentType: false,
    processData: false, */
    success: function(NoOfActions){
 
 const myChart2 = new Chart(ctx, {
   type: "bar",
   data: {
     labels: NoOfActions.issues, /* ['doors','windows', 'electronics'], */  
     datasets: [
       {
       label: "Tickets Closed Breakdown", 
       backgroundColor: gradientFill /* [
           'rgba(255, 26, 104, 0.5)',
           'rgba(54, 162, 235, 0.5)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)',
           'rgba(0, 0, 0, 0.5)',
           'rgba(104, 102, 34, 0.5)',
           'rgba(111, 89, 68, 0.5)',
           'rgba(244, 183, 50, 0.5)'
         ] */, 
         
       borderWidth: 1,
       hoverBackgroundColor: "white",
       hoverBorderColor: "orange",
       scaleStepWidth: 1,
       data:  NoOfActions.occurence,/* [12, 23, 18], */ 
     }
     
   
   ]
   },
 
   options: {
     plugins: {  // 'legend' now within object 'plugins {}'
       legend: {
         labels: {
           color: "whiteSmoke",  // not 'fontColor:' anymore
           // fontSize: 18  // not 'fontSize:' anymore
           font: {
             size: 18 // 'size' now within object 'font {}'
           }
         }
       }
     },
     scales: {
       y: {  // not 'yAxes: [{' anymore (not an array anymore)
         ticks: {
           color: "whiteSmoke", // not 'fontColor:' anymore
           // fontSize: 18,
           font: {
             size: 14, // 'size' now within object 'font {}'
           },
           stepSize: 1,
           beginAtZero: true
         }
       },
       x: {  // not 'xAxes: [{' anymore (not an array anymore)
         ticks: {
           color: "whiteSmoke",  // not 'fontColor:' anymore
           //fontSize: 14,
           font: {
             size: 10 // 'size' now within object 'font {}'
           },
           stepSize: 1,
           beginAtZero: true
         }
       }
     }
   }
 }); 


 $(document).on('change', '#ActionClosed1,#ActionClosed2', function(){

  const ActionClosed1 = $('#ActionClosed1').val();
  const ActionClosed2 = $('#ActionClosed2').val();
  //console.log(ActionClosed1, ActionClosed2)
  $.ajax({
type: "post",
url:"getDatesForClosedTickets.php",
data: {ActionClosed1:ActionClosed1, ActionClosed2:ActionClosed2},
dataType:'json',
cache:false,
success: function(info){
/*  console.log(info.issuesUpdated1) */
  myChart2.data.labels = info.issuesUpdated1;
  myChart2.data.datasets[0].data = info.occurenceUpdated1;
  myChart2.update(); 


  
}//end of success

})//end of ajax 


})//end of document onChange event

$(document).on('click', "#resetClosedChart", function(){

  myChart2.data.labels = NoOfActions.issues;
  myChart2.data.datasets[0].data = NoOfActions.occurence;
  myChart2.update(); 
  })

}//end of success

  })// end of ajax



}// end of getNoOfAction

getNoOfAction()

 
})// end of ready state