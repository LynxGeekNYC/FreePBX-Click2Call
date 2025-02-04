<?php
include_once('/var/www/html/admin/common/functions.inc.php');
include_once('/var/www/html/admin/modules/click2call/click2call.class.php');

$number = isset($_GET['number']) ? $_GET['number'] : '';

if ($number) {
    $click2call = new Click2Call();
    $click2call->makeCall($number);
}

class Click2Call {
    public function makeCall($number) {
        // Use AMI (Asterisk Manager Interface) to initiate the call
        $host = '127.0.0.1';
        $port = '5038';
        $username = 'admin';  // AMI username
        $password = 'adminpass';  // AMI password
        
        $fp = fsockopen($host, $port, $errno, $errstr, 30);
        if (!$fp) {
            die("Error: $errno - $errstr");
        }

        $action = "Action: Login\r\nUsername: $username\r\nSecret: $password\r\n\r\n";
        fwrite($fp, $action);
        $response = fread($fp, 1024);

        $dialAction = "Action: Originate\r\nChannel: SIP/1000\r\nContext: from-internal\r\nExten: $number\r\nPriority: 1\r\n\r\n";
        fwrite($fp, $dialAction);
        fclose($fp);
    }
}
?>
