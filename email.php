<?php

if(isset($_POST['name'])) {
	// EDIT THE 2 LINES BELOW AS REQUIRED
	$subject = "SCH Website: Ask Anti";

	function died($error) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}

	// validation expected data exists
	if(!isset($_POST['name']) ||
		!isset($_POST['year_group']) ||
		!isset($_POST['comments'])) {
		died('Please note that all fields are required.');		
	}

	$name = $_POST['name']; // required
	$year_group = $_POST['year_group']; // required
	$comments = $_POST['comments']; // required
	
	$error_message = "";
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
  	$error_message .= 'The name you entered does not appear to be valid.<br />';
  }
        $yeargroup_exp = "/^[A-Za-z0-9 .'-]+$/";
  if($year_group == "Year 7") {
	$to = "AAY07@School.org";
	}
  elseif($year_group == "Year 8") {
	$to = "AAY08@School.org";
	}
  elseif($year_group == "Year 9") {
	$to = "AAY09@School.org";
	}
  elseif($year_group == "Year 10") {
	$to = "AAY10@School.org";
	}
  elseif($year_group == "Year 11") {
	$to = "AAY11@School.org";
	}
  else {
  	$error_message .= 'The Year Group you entered does not appear to be valid.<br />';
 	}
  if(strlen($comments) < 2) {
  	$error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
  	died($error_message);
  }
	$message = "Message from Ask Anti Service.\n\n";

	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}

	$message .= "Name: ".clean_string($name)."\n";
	$message .= "Year Group: ".clean_string($year_group)."\n";
	$message .= "Comments: ".clean_string($comments)."\n";

// create email headers

//$headers = 'From: '.$sender."\r\n".
//'Reply-To: '.$sender."\r\n" .
//'X-Mailer: PHP/' . phpversion();
//@mail($to, $subject, $message, $headers);
include('smtpwork.php');
?>

<p>Thank you for contacting us. We will get in touch with you soon.</p>

<?php
}

echo '<script type="text/javascript">
       window.location = "http://www.School.org"
     </script>';
die();

?>
