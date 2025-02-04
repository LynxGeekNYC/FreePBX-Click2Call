<?php

class Click2Call {
    private $host = '127.0.0.1';
    private $port = 5038;
    private $username = 'admin';  // Update with your AMI username
    private $password = 'adminpass';  // Update with your AMI password
    private $extension = '1000';  // Update with the correct FreePBX extension

    public function makeCall($number) {
        if (!$this->validateNumber($number)) {
            return "Invalid number format.";
        }

        $fp = fsockopen($this->host, $this->port, $errno, $errstr, 30);
        if (!$fp) {
            return "Connection Error: $errno - $errstr";
        }

        // Login to Asterisk AMI
        fwrite($fp, "Action: Login\r\nUsername: {$this->username}\r\nSecret: {$this->password}\r\nEvents: off\r\n\r\n");
        fread($fp, 1024);

        // Dial the number using the defined extension
        $originate = "Action: Originate\r\n";
        $originate .= "Channel: SIP/{$this->extension}\r\n";
        $originate .= "Context: from-internal\r\n";
        $originate .= "Exten: {$number}\r\n";
        $originate .= "Priority: 1\r\n";
        $originate .= "CallerID: Click2Call <{$this->extension}>\r\n";
        $originate .= "Timeout: 30000\r\n";
        $originate .= "Async: yes\r\n\r\n";

        fwrite($fp, $originate);
        fread($fp, 1024);

        // Logout from AMI
        fwrite($fp, "Action: Logoff\r\n\r\n");
        fclose($fp);

        return "Call to $number initiated successfully!";
    }

    private function validateNumber($number) {
        return preg_match('/^\d{3,15}$/', $number);  // Allows 3-15 digit numbers
    }
}

?>
