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

	
	$query = "SELECT * FROM rides,persons WHERE start_time>=NOW() AND start_time <= (NOW() +interval 1 week) AND persons.personid=rides.personid AND active=1 ORDER BY start_time ASC";
        $result=mysql_query($query) or die (mysql_error());;
	$table="";
	while ($row = mysql_fetch_array($result))
	{
		$joinable=1;$unjoin_form="";$iAmDriver=0;
		
		$query = "SELECT name, persons.personid as personid FROM persons, riders WHERE persons.personid=riders.personid AND riders.rideid=".$row[rideid]." AND active=1";
		$result2=mysql_query($query) or die (mysql_error());;
print_r($riders);
		$table.="<div class=\"car\">
				<div class=\"driver\"> Driver: <b>".$row[name]."</b></div><br />\n
				<div class=\"time\"> Time: <b>".$row[start_time]."</b></div><br /> \n
				<div class=\"source\">From: <b>".$row[source]."</b></div><br />\n
				<div class=\"destination\">Destination: <b>".$row[destination]."</b></div><br />\n
				<div class=\"allseats\">Seats: <b>".($row[seats]-mysql_num_rows($result2))."</b> remaining out of <b>".$row[seats]."</b></div>
				<div class=\"riders\">People:&nbsp;";
				while ($riders =mysql_fetch_array($result2))
				{
					if ($riders[personid]==$userid)
					{
						$joinable=0;
						$unjoin_form="<form class =\"removeForm\" method=\"GET\" action=\"index.php\">
						<input type=\"hidden\" name=\"rideid\" value=\"".$row[rideid]."\"/>
						<input type=\"hidden\" name=\"personid\" value=\"".$riders[personid]."\"/>
						<input type=\"hidden\" name=\"operation\" value=\"remove\" />
						<input type=\"submit\" value=\"Un-join\" /> 
						</form>\n";
					}
					$table.="<b>".$riders[name]."</b>&nbsp;/&nbsp;\n";
				}
				if ($row[personid]==$userid)
				{
					$joinable=0;
					$table.="<form method=\"GET\" class=\"cancelForm\" action=\"index.php\">
					<input type=\"hidden\" name=\"rideid\" value=\"".$row[rideid]."\"/>
					<input type=\"hidden\" name=\"operation\" value=\"delete\" />
					<input type=\"submit\" value=\"Cancel ride\" /> 
					</form>\n";
					$iAmDriver=1;
				}
				$table.=$unjoin_form;
				$table.="<form method=\"GET\" class=\"seatselection\" action=\"index.php\">\n";
		if (($row[seats] > mysql_num_rows($result2)) && !$iAmDriver && $joinable)
		{
			$table.="<input type=\"hidden\" name=\"rideid\" value=\"".$row[rideid]."\"/>
				<input type=\"hidden\" name=\"operation\" value=\"add\" />
				<input type=\"hidden\" name=\"ajax\" value=\"true\" />	
				<input type=\"submit\" value=\"Join?\" /> \n";
		}
				$table.="</form>\n
					</div>\n
			</div>\n";
	}

	echo $table;
?>
