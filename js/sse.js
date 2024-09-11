if (typeof EventSource !== "undefined") {
  //Event source 1
  const eventSource = new EventSource("sse_alert_disbursement.php");
  eventSource.onmessage = function (event) {
    const data = JSON.parse(event.data);
    $("#disbursement-analysis-count").html(data.containerCount);

    //console.log(data);
  };

  //Event source 2
  const source = new EventSource("sse_disbursement_paid_account.php");
  source.onmessage = function (res) {
    const data = JSON.parse(res.data);

    //$(".notification-div").html(data.data_rows[0].AccountName);
    //console.log(data.data_rows);

    $(".notification-div").each(function () {
      // Get the id of the current div
      var divId = $(this).attr("id");

      // Clear the content of the div before appending new content
      $(this).html('');

      // Log the id to the console or use it as needed
      console.log("Div ID:", divId);

      // Use the filter function to find all matching items in the data array where BL matches divId
      var matchingItems = data.data_rows.filter(function (item) {
        return item.BL === divId;
      });

      // Loop through the filtered items and log the AccountName to the console
      matchingItems.forEach(function (item) {
        var span = $(`<span class='badge bg-dark text-white m-1 p-1 d-inline-block text-truncate' style="max-width: 100px;" title="${item.AccountName}"></span>`).html( item.AccountName);

        // Append the span to the div with the matching id
        $("#" + divId).append(span);

        //console.log("AccountName for BL " + divId + ": " + item.AccountName);
      });
    });
  };
} else {
  
  console.error("Your browser does not support Server-Sent Events.");
}

$(".disbursement_analysis").click(function () {
  $("#display_disbursement_analysis").load(
    "load_disbursement_analysis_approval_new.php"
  );
});
