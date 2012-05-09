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
	$query = "SELECT * FROM persons WHERE personid=".$userid.";";
        $result=mysql_query($query) or die (mysql_error());;
	$table="";
	while ($row = mysql_fetch_array($result))
	{
		$table.="<div class=\"car\">
				<div class=\"driver\"> Name: <b>".$row[name]."</b></div><br />\n
				<div class=\"time\"> Email: <b>".$row[email]."</b></div><br /> \n
				<div class=\"source\">Email if new offer is posted? <b>".($row[emailOffer]?"yes":"no")."</b>&nbsp;<a href=\"#toggleEmailOffer\">toggle</a></div><br />\n
				<div class=\"source\">Email if ride offer is cancelled? <b>".($row[emailCancel]?"yes":"no")."</b>&nbsp;<a href=\"#toggleEmailCancel\">toggle</a></div><br />\n
			</div>";

	}

	echo $table;


	//if (isset($_GET['ajax'])){ echo "success";}
?>
