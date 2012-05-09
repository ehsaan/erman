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
	$query="UPDATE persons SET ";
	switch ($_GET['change'])
	{
		case 'offer':
			$query.="emailOffer";
			$key="emailOffer";
			break;
		default:
			$query.="emailCancel";
			$key="emailCancel";
	}
	$query.="=IF(".$key."=1, 0, 1) ";
	$query.="WHERE personid=".$userid.";";
        $result=mysql_query($query) or die (mysql_error());;
	echo "success-profile";
?>
