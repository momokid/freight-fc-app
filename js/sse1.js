if (typeof(EventSource) !== "undefined") {
    const source = new EventSource("sse_disbursement_paid_account.php");

    source.onmessage = function(event) {
        const data = JSON.parse(event.data);
        const notificationText = `BL: ${data.BL}, AccountID: ${data.AccountID}, AccountName: ${data.AccountName}`;
        document.getElementById("notification").innerText = notificationText;
    };
} else {
    document.getElementById("notification").innerText = "Your browser does not support Server-Sent Events.";
}