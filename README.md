# FreePBX-Click2Call Module

# Steps to Create the Module
1.) Install FreePBX Developer Tools: Make sure you have the FreePBX development environment set up. If you don't, you can follow the FreePBX development documentation.

2.) Create a Custom Module: You'll need to create a custom FreePBX module. This can be done by creating a folder in the /var/www/html/admin/modules/ directory. Let’s name the module click2call.

3.) File:

click2call.class.php (This file contains the PHP logic for your module).
click2call.php (This file is responsible for generating the interface to interact with).
click2call.xml (This file defines the module to FreePBX).
images/ (Optional folder for storing your images).
Add the Clickable Image and Input Field: In the click2call.php file, you'll want to display the image and an input field to allow the user to enter a number. For example:

4.) Backend Logic (call.php): The PHP script call.php will handle the backend logic to initiate the call. It can use the Asterisk Manager Interface (AMI) to make a call to the specified extension.

5.) Define the Module (click2call.xml): In click2call.xml, you define the module’s metadata:

6.) Test the Module: After creating the necessary files, you need to install the module by running:
"fwconsole moduleadmin install /var/www/html/admin/modules/click2call"

7.) Ensure AMI Permissions: Make sure the Asterisk Manager Interface (AMI) credentials you’re using in call.php have permissions to initiate calls. You can configure this in /etc/asterisk/manager.conf

Ensure that you validate the phone number input (e.g., check if it's a valid extension or format).
Use AJAX or some other mechanism to improve the user experience and prevent page reloads.
Make sure the extension and the number are configured in FreePBX for the call to be correctly routed.

# How It Works
1.) Establishes a connection to Asterisk's AMI.
2.) Logs in using the provided credentials.
3.) Uses the Originate action to call the number via the defined extension.
4.) Logs out and closes the connection after initiating the call.
5.) Validates the phone number to ensure only valid numbers are dialed.

Next Steps:
- Save this file in /var/www/html/admin/modules/click2call/click2call.class.php
- Ensure AMI credentials (/etc/asterisk/manager.conf) allow this connection.
- Modify the $extension variable to match the correct FreePBX extension that should originate the call.
- Restart Asterisk after changes

# I put a lot of work into these scripts so please donate if you can. Even $1 helps!

PayPal: alex@alexandermirvis.com

CashApp / Venmo: LynxGeekNYC

BitCoin: bc1q8sthd96c7chhq5kr3u80xrxs26jna9d8c0mjh7
