<?php
include_once('/var/www/html/admin/modules/click2call/click2call.class.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $number = isset($_POST['number']) ? trim($_POST['number']) : '';

    if (empty($number) || !preg_match('/^\d{3,15}$/', $number)) {
        echo "Invalid number format.";
        exit;
    }

    $click2call = new Click2Call();
    $response = $click2call->makeCall($number);

    echo $response;
}
?>
