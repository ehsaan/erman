<?
require_once("config.php");
require_once($phpmailer_path."/class.phpmailer.php");
$mail = new PHPMailer(); 
$mail->IsSMTP(); // send via SMTP
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "erman.service"; // SMTP username
$mail->Password = "iscrideshare1"; // SMTP password
$webmaster_email = "erman.service@gmail.com"; //Reply to this email ID
$mail->From = $webmaster_email;
$mail->FromName = "Erman";
$mail->AddAddress($webmaster_email,"Erman");
$mail->AddReplyTo($webmaster_email,"Erman");
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
?>
