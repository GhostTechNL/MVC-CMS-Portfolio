<?php
class contact_model extends Functions{

	protected static $mailactive = true;

	public static function form(){
		if (controller::getURLValue(2,"short") == "submit") {
			$requiredInput = array('name','email','message');
			$counter = 0;
			foreach ($requiredInput as $key => $value) {
				$validate = $_POST[$value];
				if (empty($validate)) {
					controller::set_errorMessage("Een/meerdere velden zijn niet ingevuld!");
					//Add email validation
				}else{
					$counter++;
				}
			}
			if (count($requiredInput) == $counter && self::$mailactive === true) {
				//The content of the be sended email
			   $name = $_POST['name'];
			   $email = $_POST['email'];
			   $subject = "Portfolio contactform || " . $_POST['email'];
			   $message = $_POST['message'];
			   //Needed to send
			   require_once 'classes/PHPMailer/SMTP.php';
			   require_once 'classes/PHPMailer/Exception.php';
			   //Get the PHPMailer class
			   $mail = new PHPMailer();
			   //SMTP
			   //$mail->SMTPDebug = 1;
			   $mail->isSMTP();
			   $mail->SMTPAuth = true;
			   $mail->SMTPSecure = "tls"; //tls of ssl
			   $mail->Port = 587; //587 of 465
			   //---- Email ----
			   $mail->Host = "smtp.office365.com";
			   $mail->Username = "Email";
			   $mail->Password = "Password";
			   //Email settings
			   $mail->isHTML(true);
			   $mail->setFrom("Sendemail", "Porfolio");
			   $mail->addAddress("Sendemail");
			   $mail->Subject = $subject;
			   $mail->Body = "From: " . $email . "<br>".
			                 "Name: " . $name . "<br>".
			                 "Message: <br><pre style='white-space: pre-line;, font-family: sans-serif;'>" . $message . "</pre>";
			   //Send the mail
			   if ($mail->send()) {
			   	//Email sended
			   	controller::set_noteMessage("De email is verstuurd! Dank u wel, ik zal er zo spoedig mogenlijk naar kijken.");
			   } else {
			   	//Error something went wrong
			   	controller::set_errorMessage("De email is niet verstuurd. Probeer het later nog is!");
			   }
			}
			if (self::$mailactive === false) {
				controller::set_errorMessage("Contact formulier is tijdelijk buitenwerking");
			}
			header("Location: " . controller::Weblink() . controller::getURLValue(1,"short"). "/");
		}
	}
}
?>