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
    Date: 2011/10/29
*/
if (!empty($_POST['commentText']) && !empty($_POST['rideid']))
{
	$query = "INSERT INTO  `ehsansr`.`comments` (
`personid` ,
`ctext` ,
`rideid`,
`insert_date`,
`active`,
`commentid`
)
VALUES (
'".$userid."',  
'".strip_tags(mysql_real_escape_string($_POST['commentText']))."',
'".mysql_real_escape_string($_POST['rideid'])."',
NOW(),
1,
NULL
);";
        $result=mysql_query($query) or die (mysql_error());;
	if (isset($_GET['ajax'])){ echo "success";}
}
else
{
	if (isset($_GET['ajax'])){echo "please enter all data fields";}
}
?>
