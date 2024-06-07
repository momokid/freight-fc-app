const eventSource = new EventSource("alert_disbursement_sse.php");

eventSource.onmessage = function (event) {
  const data = JSON.parse(event.data);
  $("#disbursement-analysis-count").html(data.containerCount);
  //console.log(data)
};

$(".disbursement_analysis").click(function () {

  $("#display_disbursement_analysis").load(
    "load_disbursement_analysis_approval.php"
  );
  
});

//   setInterval(() => {
//     $("#display_disbursement_analysis").load("load_tracked_shipping_count.php");
//   }, 150000);
