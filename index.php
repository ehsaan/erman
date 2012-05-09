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

if (!isset($_SESSION['validated']) || $_SESSION['validated']!=1)
{
	header('location: login.php');
	die("auth error");
}
$newLogin=1;
if (!isset($_SESSION['dbLogin']))
{
	$_SESSION['dbLogin']=1;
	$newLogin=1;
}

$head="	
<html> 
<head> 
    <title>Erman Shared Ride Utility</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <meta http-equiv=\"Content-Language\" Content=\"en\">
    <script type=\"text/javascript\" src=\"lib/jquery-1.6.4.min.js\"></script> 
    <script type=\"text/javascript\" src=\"lib/jquery.form.js\"></script> 
    <script type=\"text/javascript\" src=\"lib/jquery-ui-1.8.16.custom/js/jquery-ui-1.8.16.custom.min.js\"></script>
    <script type=\"text/javascript\" src=\"lib/jquery-ui-timepicker-addon.js\"></script>
    <link rel=\"stylesheet\" media=\"all\" type=\"text/css\" href=\"lib/jquery-ui-1.8.16.custom/css/ui-lightness/jquery-ui-1.8.16.custom.css\" />
    <script type=\"text/javascript\"> 
messageDelay=1000;
toggleInited=false;
cnt=0;
toggleOfferLock=0;
cnt2=0;
function submitFinished( response ) {
  $('#sendingMessage').fadeOut();
  var tabs = $('#tabs').tabs();
  switch ( response  ) {
	case \"success-profile\":
		toggleOfferLock--;
		if (toggleOfferLock==0)
		{
			tabs.tabs('load',1);
		}
		break;
 	case \"success\":
		$('#successMessage').fadeIn().delay(messageDelay).fadeOut();
		$('#offerSource2').val( \"\" );
		$('#offerDestination2').val( \"\" );
		$('#timeOffer').val( \"\" );
		$('#seats').val( \"\" );
		$('#offerForm2').fadeIn();
		$('#content').delay(messageDelay+500).fadeTo( 'slow', 1 );
		$('#content').load('index.php?operation=listonly&ajax', init);
		tabs.delay(3*messageDelay+500).tabs('load',0).delay(3*messageDelay+1500).tabs('select', 0);
		break;
 	case \"success-comment\":
		$('#successMessage').fadeIn().delay(messageDelay).fadeOut();
		$('#content').delay(messageDelay+500).fadeTo( 'slow', 1 );
		$('#content').load('index.php?operation=comment&ajax', init);
		tabs.delay(messageDelay+500).tabs('select', 0);
		break;
	default:
		$('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
		$('#returnMessage').html('<p>'+response+'</p>');
		$('#returnMessage').delay(messageDelay).fadeIn().delay(messageDelay).fadeOut();
		$('#offerForm2').delay(messageDelay*2).fadeIn();
		$('#content').delay(2*messageDelay).fadeTo( 'slow', 1 );
		$('#content').load('index.php?operation=listonly&ajax', init);
		tabs.delay(3*messageDelay).tabs('select', 0);
  }
}

function submitForm() {

//  if  (jQuery.active > 0 ){ return false;};
  var contactForm = $(this);
 
  // Are all the fields filled in?
 
 
    $('#sendingMessage').fadeIn();
    contactForm.fadeOut();
 
    $.ajax( {
     url: contactForm.attr( 'action' ) + \"?ajax=true\",
      type: contactForm.attr( 'method' ),
      data: contactForm.serialize(),
      success: submitFinished
    } );
 
  // Prevent the default form submission occurring
  return false;
}

function initTabs()
{
	$(function() {
		$( \"#tabs\" ).tabs({
			//event: \"mouseover\",
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						\"Couldn't load this tab. We'll try to fix this as soon as possible. \");
				}
			}
		});
		$(\"#tabs\").bind('tabsload',  function(event, ui) {	
			$('a[href=\"#toggleEmailOffer\"]').unbind();
			$('a[href=\"#toggleEmailCancel\"]').unbind();
			$('a[href=\"#toggleEmailOffer\"]').click( function() {
			    if  (jQuery.active > 0 ){ return false;};
			    toggleOfferLock++;
			    $('#sendingMessage').fadeIn();
			    $.get(\"index.php\",{operation:\"profile-change\",change:\"offer\",ajax:\"true\"},
			    	submitFinished
			    );
			
			    // Prevent the default form submission occurring
			    return false;
			});
			$('a[href=\"#toggleEmailCancel\"]').click( function() {
			    if  (jQuery.active > 0 ){ return false;};
			    toggleOfferLock++;
			    $('#sendingMessage').fadeIn();
			    $.get(\"index.php\",{operation:\"profile-change\",change:\"cancel\",ajax:\"true\"},
			    	submitFinished
			    );
			
			    // Prevent the default form submission occurring
			    return false;
			});
		});
	});

}
function init()
{
cnt2++;
//alert(cnt2);
	jQuery.ajaxSetup({
		beforeSend: function() {
		$('#mask').show()
		},
		complete: function(){
			$('#mask').hide()
		},
		timeout: 5000 
	    });
            // bind 'myForm' and provide a simple callback function 
	    $('#mask').hide();
            $('.seatselection').unbind().submit(submitForm); 
            $('.removeForm').unbind().submit(submitForm); 
            $('.cancelForm').unbind().submit(submitForm); 
	    $('.submitComment').unbind().submit(submitForm);
	    $('#offerForm').hide().unbind().submit( submitForm ).addClass( 'positioned' );
	    $('#offerForm2').unbind().submit( submitForm );

	    initTabs();
	    $('a[href=\"#test\"]').click(function() {
	alert('aaaa');	
	var tabs = $('#tabs').tabs();
	tabs.tabs('select', 0);
		$(\"#content\").hide();
		return false;
	     });
	$('#timeOffer').datetimepicker({
		showSecond: false,
		timeFormat: 'hh:mm:ss',
		dateFormat: 'yy-mm-dd',
		stepHour: 1,
		stepMinute: 15,
		minDate: 0, 
		maxDate: +7
	});
	var availableSources = [
			\"Rutford and Drive A\",
			\"Clubhouse of phase 8\",
			\"Chatham Court\"
		];
	var availableLocations = [
			\"Sara Bakery\",
			\"Walmart on Coit\",
			\"Target on Coit\",
			\"Airport\",
			\"IKEA\",
			\"Costco\",
			\"Downtown\"
		];
		$( '#offerDestination2' ).autocomplete({
			source: availableLocations
		});
		$( '#offerSource2' ).autocomplete({
			source: availableSources
		});
} 
        // wait for the DOM to be loaded 
        $(document).ready(init); 
    </script> 
</head> 
<body>
<div id=\"sendingMessage\" class=\"statusMessage\"><p>Sending your message. Please wait...</p></div>
<div id=\"successMessage\" class=\"statusMessage\"><p>Operation was successful.</p></div>
<div id=\"failureMessage\" class=\"statusMessage\"><p>There was a problem. Please try again.</p></div>
<div id=\"returnMessage\" class=\"statusMessage\"><p>Unkonw problem.</p></div>
<div id=\"incompleteMessage\" class=\"statusMessage\"><p>Incomplete</p></div>
<div id=\"showWindow\" class=\"window\"></div>
<div id=\"mask\" ><img src=\"images/pinwheel.gif\" alt=\"pinwheel\" />Loading...</div>
<div class=\"log\"></div>
<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/en_US/all.js#xfbml=1&appId=158913524204031\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
 

";
		$output="<link href=\"style.css\" type=\"text/css\" rel=\"stylesheet\" />\n";
        	$output.='<div class="container">Logged in as ' . $_SESSION['first'].' '.$_SESSION['last'].'('.$_SESSION['email'] . ") [<a href='logout.php' />logout</a>]\n";
   		$output.="<div id=\"tabs\">
	<ul>
		<li><a href=\"#content\">Available Rides</a></li>
		<li><a href=\"?operation=profile&ajax=true\">Profile</a></li>
		<li><a href=\"#tabs-2\">Offer A Ride</a></li>
		<li><a href=\"#about\">About</a></li>
	</ul>\n";
		$output.="<div id=\"tabs-2\">
		<form method=\"GET\" id=\"offerForm2\" action=\"index.php\">
			<input type=\"hidden\" name=\"operation\" value=\"offer-add\" />
			From: <input id=\"offerSource2\" type=\"text\" id=\"source\" name=\"source\" />
			Destination:<input id=\"offerDestination2\" type=\"text\" id=\"destination\" name=\"destination\" />
			Time: <input id=\"timeOffer\" type=\"text\" name=\"time\" />
			Available seats (exluding yourself): <input type=\"text\" name=\"seats\" value=\"3\" />
			<input type=\"submit\" value=\"Add\" />
			</form>
		</div>\n";
		$output.="<div id=\"about\">
		<div class=\"fb-like-box\" data-href=\"https://www.facebook.com/apps/application.php?id=158913524204031\" data-width=\"592\" data-show-faces=\"true\" data-stream=\"true\" data-header=\"false\" ></div>\n";
	$output.="<div ><a rel=\"license\" href=\"http://www.gnu.org/licenses/gpl.txt\"><img alt=\"GNU Public License v3.0\" style=\"border-width:0\" src=\"images/gplv3-88x31.png\" /></a><br />by <a href=\"http://www.utdallas.edu/~ehsaan/\">Ehsan Nourbakhsh</a> </a></div>\n";
		$output.="</div>\n";
		$output.="<div id=\"content\">\n";

	$link = mysql_connect('dslabcomp', 'ehsansr','t3xAKeQaAdTq8z9X');
	if (!$link) {
    		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('ehsansr');
############## set USER ID or insert new user
	$query = "SELECT personid FROM persons WHERE email='".$_SESSION['email']."';";
	$result=mysql_query($query) or die (mysql_error());;
	$row=mysql_fetch_row($result);
	if (!$row)
	{
		$query = "INSERT INTO persons(name, email) VALUES ('".$_SESSION['first']." ".$_SESSION['last']."','".$_SESSION['email']."');";
		$result=mysql_query($query) or die (mysql_error());;
		$userid=mysql_insert_id();
	}
	else
	{
		$userid=$row[0];
	}

	if ($newLogin==1)
	{
		$query = "UPDATE persons SET lastLogin=NOW() WHERE `personid`=".$userid.";";
		$result=mysql_query($query) or die (mysql_error());;

	}
################
	if (!isset($_GET['ajax']))
	{	
		echo $head.$output;
	}
	switch($_GET['operation'])
	{
		case 'add':
			include('add.php');	
			break;
		case 'remove':
			include('remove.php');
			break;
		case 'delete':
			include('delete.php');	
			break;
		case 'listonly':
			include('list.php');
			break;
		case 'comments':
			include('comments.php');
			break;
		case 'comment-submit':
			include('comment-submit.php');
			break;
		case 'profile':
			include('profile.php');
			break;
		case 'profile-change':
			include('profile-change.php');
			break;
		case 'offer-add':
			include('offer-do.php');
		default:
			if (!isset($_GET['ajax']))
			{
				include('list.php');	
			}
			break;
	}

	$output="</div>\n</div>\n";
	//$output.="<img class=\"bgimg\"src=\"images/10.jpg\" />";
#/<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.';
	$output.=" </div>\n</body>\n</html>\n";
	if (!isset($_GET['ajax'])){echo $output;}
?>
