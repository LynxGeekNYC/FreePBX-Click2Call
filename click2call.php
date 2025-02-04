<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click2Call</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #dialer {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Click to Call</h2>
<img src="images/call_icon.png" onclick="showDialer()" style="cursor:pointer; width:100px;">

<div id="dialer">
    <label for="number">Enter Number to Dial:</label>
    <input type="text" id="number" name="number">
    <button onclick="dialNumber()">Call</button>
    <p id="status"></p>
</div>

<script>
    function showDialer() {
        $("#dialer").show();
    }

    function dialNumber() {
        var number = $("#number").val().trim();
        if (number === "") {
            $("#status").text("Please enter a number.");
            return;
        }

        $("#status").text("Dialing...");

        $.ajax({
            url: "/admin/modules/click2call/call.php",
            type: "POST",
            data: { number: number },
            success: function(response) {
                $("#status").text(response);
            },
            error: function() {
                $("#status").text("Error making the call.");
            }
        });
    }
</script>

</body>
</html>
