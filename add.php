<?php
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
	$query = "SELECT count(*) FROM riders WHERE rideid=".mysql_real_escape_string($_GET['rideid'])." AND active=1";
	$r=mysql_query($query) or die (mysql_error());;
	$query = "SELECT seats FROM rides WHERE rideid=".mysql_real_escape_string($_GET['rideid'])." AND active=1";
	$r2=mysql_query($query) or die (mysql_error());;
	if ($r[0]>$r2[0])
	{
		echo "Seats already taken";
		exit;
	}
	$query = "INSERT INTO  `ehsansr`.`riders` (
`personid` ,
`rideid` ,
`insert_time`,
`riderid`
)
VALUES (
'".$userid."',  ".mysql_real_escape_string($_GET['rideid']).", now(), NULL
);";
        $result=mysql_query($query) or die (mysql_error());;
	if (isset($_GET['ajax'])){ echo "success";}
?>
