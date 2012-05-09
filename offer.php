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
?>
	<form method="GET" name="offer" action="index.php">
		<input type="hidden" name="rideid" value="<?=$row[rideid];?>"/>
		<input type="hidden" name="operation" value="offer-add" />
		<input type="hidden" name="login" value="1" />
		<input type="hidden" name="openid.identity" value="<?=urlencode($openid->identity);?>" />
		Destination:<input type="text" name="destination" />
		Time: <input type="text" name="time" />
		Available seats (exluding yourself): <input type="text" name="seats" value="3" />
		<input type="submit" value="Add" />
	</form>

