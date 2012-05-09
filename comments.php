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
	$rideid=mysql_real_escape_string($_GET['rideid']);
	
	$query = "SELECT * FROM comments,persons WHERE comments.rideid=".$rideid." AND persons.personid=comments.personid AND active=1 ORDER BY comments.insert_date ASC";
        $result=mysql_query($query) or die (mysql_error());;
	$table="";
	while ($row = mysql_fetch_array($result))
	{
		echo "<div class=\"comment\">\n";
		echo "<span class=\"commentauthor\">".$row['name']."</span> at ".$row['insert_date']." said:\n<br/>\n";
		echo "<div class=\"commenttext\">".$row['ctext']."</div>";
		echo "</div>\n";
	}
	$form_html="<form method=\"post\" class=\"submitComment\" action=\"?operation=comment-submit&ajax\">
	<input type=\"hidden\" name=\"rideid\" value=\"".$_GET['rideid']."\" />
	<textarea name=\"commentText\"></textarea>\n
	<input type=\"submit\" value=\"send\" /> \n</form>";
	if (!isset($_GET['ajax'])){echo $form_html;}
?>
