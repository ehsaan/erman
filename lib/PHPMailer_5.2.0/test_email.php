<?
require("./class.phpmailer.php");
$mail = new PHPMailer(); 
$mail->IsSMTP(); // send via SMTP
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "erman.service"; // SMTP username
$mail->Password = "iscrideshare1"; // SMTP password
$webmaster_email = "erman.service@gmail.com"; //Reply to this email ID
$email="ehsaan@gmail.com"; // Recipients email ID
$name="Ehsan"; // Recipient's name
$mail->From = $webmaster_email;
$mail->FromName = "Webmaster";
$mail->AddAddress($email,$name);
$mail->AddReplyTo($webmaster_email,"Webmaster");
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->IsHTML(true); // send as HTML
$mail->Subject = "This is the subject";
$mail->Body = "Hi,
This is the HTML BODY "; //HTML Body
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
?>
