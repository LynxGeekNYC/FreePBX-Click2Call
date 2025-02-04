<?php

class Click2Call {
    private $host = '127.0.0.1';
    private $port = 5038;
    private $username = 'admin';  // Change this to your AMI username
    private $password = 'adminpass';  // Change this to your AMI password
    private $extension = '1000';  // Change this to the extension that will initiate the call

    public function __construct() {
        // Ensure the Asterisk Manager Interface (AMI) credentials are set correctly
    }

    public function makeCall($number) {
        if (!$this->validateNumber($number)) {
            die("Invalid number format.");
        }

        $fp = fsockopen($this->host, $this->port, $errno, $errstr, 30);
        if (!$fp) {
            die("Error: $errno - $errstr");
        }

        // Login to Asterisk Manager Interface (AMI)
        $login = "Action: Login\r\nUsername: {$this->username}\r\nSecret: {$this->password}\r\nEvents: off\r\n\r\n";
        fwrite($fp, $login);
        fread($fp, 1024);  // Read the response from AMI

        // Dial the number via the extension
        $originate = "Action: Originate\r\n";
        $originate .= "Channel: PJSIP/{$this->extension}\r\n";
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

        echo "Call to $number initiated successfully!";
    }

    private function validateNumber($number) {
        return preg_match('/^\d{3,15}$/', $number);  // Basic validation for numbers (3-15 digits)
    }
}

?>
