<?php
//╔════════════════════════════════════════════════════╗
//║        DO NOT REMOVE OR CHANGE THIS SECTION        ║
//║                                                    ║
//║Filename : CMailer.php                              ║
//║Version  : 0.1                                      ║
//║Author   : Prince 3                                 ║
//║E-MAIL   : khatibe_30@hotmail.fr                    ║
//║Copyright: Ikariama(c) 2010. All rights reserved.   ║
//╚════════════════════════════════════════════════════╝
?>
<?php

class CMailer {
	
	function sendActivate($email,$username,$pass,$act) {
		
		$subject = "Welcome to ".NETWORK_NAME;
		
		$message = "Hello ".$username."</br></br>";
		$message .= "Thank you for your registration.</br></br>";
		$message .= "----------------------------</br>";
		$message .= "Name:: ".$username."</br>";
		$message .= "Password: ".$pass."</br>";
		$message .= "Activation code:: ".$act."</br>";
		$message .= "----------------------------</br></br>";
		$message .= "Click the following link in order to activate your account:</br></br>";
		$message .= "http://".$_SERVER['SERVER_NAME']."/activate.php?un=".$username."&act=".$act;
		if(!SUBDOMAIN) {
			$message .= SERVER_NAME."/";
		}
		$message .= "activate.php?id=".$act;
		
		$headers = "From: ".ADMIN_NAME."\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		//return mail($email, $subject, $message, $headers, "-f".ADMIN_EMAIL);
	}
	
};
$mailer = new CMailer;
?>