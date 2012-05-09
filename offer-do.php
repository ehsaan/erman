<?php
require("email_settings.php");
error_reporting(-1);
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

if (!empty($_GET['seats']) && !empty($_GET['time']) && !empty($_GET['source']) && !empty($_GET['destination']) )
{
	$query = "INSERT INTO  `ehsansr`.`rides` (
`personid` ,
`seats` ,
`start_time`,
`source`,
`destination`,
`insert_time`,
`rideid`
)
VALUES (
'".$userid."',  
'".mysql_real_escape_string($_GET['seats'])."',
'".mysql_real_escape_string($_GET['time'])."',
'".mysql_real_escape_string($_GET['source'])."',
'".mysql_real_escape_string($_GET['destination'])."',
now(),
 NULL
);";
        $result=mysql_query($query) or die (mysql_error());;

	$query= "SELECT email,name FROM persons WHERE emailOffer=1;";
        $result=mysql_query($query) or die (mysql_error());;

	while ($to = mysql_fetch_array($result))
	{
		//if (!isset($_GET['ajax']))
		{	
			$email=$to[0]; // Recipients email ID
			$name=$to[1]; // Recipient's name
			$mail->AddBCC($email,$name);
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = "A new ride has been shared";
			$mail->Body = "Hi buddy,<br />
			Just wanted to let you know there's a new ride from ".mysql_real_escape_string($_GET['source'])." to ".mysql_real_escape_string($_GET['destination']).
			" scheduled at ".mysql_real_escape_string($_GET['time']).". There are ".mysql_real_escape_string($_GET['seats'])." seats available in this ride.<br />".
			"You can join them by logging in <a href=\"".$erman_address."\">Erman</a>. <br />You can unsubscribe from these notifications through your profile in Erman, under the Profile tab.<br /><br /> Cheers,<br />Erman.";

			$mail->AltBody = "There's a new ride, please check Erman for more details. Why are you looking at the text version?"; //Text Body
		}
	}
	if ($email_enabled==1)
	{
		if(!$mail->Send())
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else
		{
				//echo "Message has been sent";
		}
	}
	if (isset($_GET['ajax'])){ echo "success";}
}
else
{
	if (isset($_GET['ajax'])){echo "please enter all data fields";}
}
?>
