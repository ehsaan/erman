<?
/* 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
    Author: Ehsan Nourbakhsh <ehsaan@gmail.com>
    Date: 2011/10/27
*/
session_name("sharedride");
session_start();

require './lib/lightopenid/openid.php';
try {
    # Change 'localhost' to your domain name.
    $openid = new LightOpenID('dslab.utdallas.edu');
    if(!$openid->mode) {
        if(isset($_GET['login'])) {
    		$openid->identity = 'https://www.google.com/accounts/o8/id';
		$openid->required = array('namePerson/first', 'namePerson/last', 'contact/email');
		header('Location: ' . $openid->authUrl());	
     }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Erman OpenID Login</title>
	<!-- Simple OpenID Selector -->
	<link type="text/css" rel="stylesheet" href="lib/openid.css" />
	<!--<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
	<scr ipt type="text/javascript" src="js/openid-jquery.js"></script>
	<script type="text/javascript" src="js/openid-en.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			openid.init('openid_identifier');
			openid.setDemoMode(true); //Stops form submission for client javascript-only test purposes
		});
	</script>
	-->
	<!-- /Simple OpenID Selector -->
	<style type="text/css">
		/* Basic page formatting */
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			background-image:url('images/rideshare.gif');
			background-repeat:no-repeat;
			width:800px;
			height:350px;
			background-position:right center;
		}
	</style>
</head>

<body>
Why not sharing your weekly grocery store trip with others? Iranian Student Community at UTD (ISC@UTD) definitely endorses that!
<br />
<br />
<form action="login.php?login" method="post">
		<fieldset>
			<legend>Sign-in to Erman using your Google OpenID Account</legend>
				<p>OpenID is service that allows you to log-on to many different websites using a single indentity. Only your <b>name</b> and <b>email</b> from your <a href="http://profiles.google.com">Google profile</a> will be made available to current website.

				Find out <a href="http://openid.net/what/">more about OpenID</a>.</p>
    				<input type="submit" value="Login with Google" />
		</fieldset>
	</form>
	<!-- /Simple OpenID Selector -->
</body>
</html>

<?
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
	if ($openid->validate())
	{
	        $data = $openid->getAttributes();
        	$_SESSION['email'] = $data['contact/email'];
	        $_SESSION['first'] = $data['namePerson/first'];
        	$_SESSION['last'] = $data['namePerson/last'];
		$_SESSION['validated']=1;
		header('location: index.php');
	}
	else
	{
        	$_SESSION['email'] = "";
	        $_SESSION['first'] = "";
        	$_SESSION['last'] = "";
		$_SESSION['validated']=0;
	}
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
?>
