<html>
<body>
<h2>Click to Call</h2>
<img src="images/call_icon.png" onclick="showDialer()">

<div id="dialer" style="display:none;">
  <label for="number">Enter Number to Dial:</label>
  <input type="text" id="number" name="number">
  <button onclick="dialNumber()">Call</button>
</div>

<script type="text/javascript">
  function showDialer() {
    document.getElementById("dialer").style.display = "block";
  }

  function dialNumber() {
    var number = document.getElementById("number").value;
    if (number) {
      window.location.href = "/admin/modules/click2call/call.php?number=" + number;
    }
  }
</script>
</body>
</html>
