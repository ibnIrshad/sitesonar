#!/usr/local/bin/php -q
<?php
//include ('../include/mailer.php');

?>
<html><!-- InstanceBegin template="/Templates/checkscript.dwt.php" codeOutsideHTMLIsLocked="true" -->
<head>

<?php
//---------My Sql Connection
$con = mysql_connect("db1559.perfora.net","dbo251384058","knqTen8q");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db251384058", $con);

//--------End My SQl Connection

$date = date("F j, Y"); //Displays April 25, 2007 (Assuming that is the current date)
$time = date("g:i a");  //Displays 4:26 PM (Assuming that is the current time)
$timestamp = time();


function Visit($url)

{

$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();

curl_setopt ($ch, CURLOPT_URL,$url );

curl_setopt($ch, CURLOPT_USERAGENT, $agent);

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt ($ch,CURLOPT_VERBOSE,false);

curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$page=curl_exec($ch);

//echo curl_error($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if($httpcode>=200 && $httpcode<300) return true;

else return false;

}

function getEmails($username) {

	$sql105 = mysql_query("SELECT email, email2, email3, email4 FROM users WHERE username = '$username'");
	
	if (!$sql105) echo mysql_error();
	else {
		return mysql_fetch_array($sql105);
		}
}
?>
</head>
<body>
<?php



?>
<!-- InstanceBeginEditable name="checkInterval" -->
<?php
$all_data = mysql_query("SELECT * FROM websites WHERE checkInterval = '5min'");
?>
<!-- InstanceEndEditable -->
<?php
while($row = mysql_fetch_array($all_data))
{
		$edata = getEmails($row[user]);
		
		if ($edata['email']==NULL) $edata['email']="no_email@noemail.com";
		if ($edata['email2']==NULL) $edata['email2']="no_email@noemail.com";
		if ($edata['email3']==NULL) $edata['email3']="no_email@noemail.com";
		if ($edata['email4']==NULL) $edata['email4']="no_email@noemail.com";
		
		if(Visit($row['URL']))
		{
			if ($row[status]=="DOWN" && $row['rup']=='yes') { //if the site has come back up and was down before, send email 
				
				$to = "$edata[email], $edata[email2], $edata[email3], $edata[email4]";
				$subject = "SiteSonar.net: Your site, $row[alias], has come back up!";
				$headers = "From: checker@SiteSonar.net\r\n";
				$headers .= "Reply-To: checker@SiteSonar.net\r\n";
				$headers .= "Return-Path: checker@SiteSonar.net\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$message = "<html><body>";
				$message .= "This is an email from SiteSonar.net to notify you that one of your sites, $row[alias], located at $row[URL], has come back up on $date, at $time (GMT -5 Eastern Standard Time). Note: No more alerts will be sent until your site goes down again (hopefully not!)<br>. Thank you for using SiteSonar.net. <br><br>If you do not want to receive these emails, please login to your account and change your settings for your site, $row[alias].";
				$message .= "<br /><br /> <a href=\"http://www.1and1.com/?k_id=19219734\" title=\"1and1 Hosting\" target=\"_blank\">SiteSonar.net uses 1and1's excellent hosting services. Why not see for yourself why 1and1 is the world's number 1 webhost? Click here to get hosting from 1.99 a month!</a>";
				$message .= "</body></html>";
				
				if ( mail($to,$subject,$message,$headers) ) {
				   echo "Mail sent to $row[user] at ($edata[email], $edata[email2], $edata[email3], $edata[email4]) to <b>notify</b> him/her that his/her site $row[alias] ($row[URL]) has <b>come back up</b>. ";
				   } 
				   else {
				   echo "ERROR sending email to $edata[email], $edata[email2], $edata[email3], $edata[email4] ($row[user]) to notify him/her that his/her site $row[alias] ($row[URL]) had come <b>back up</b>.";
				   }
				
			}//end function of sending mail to user that his site came back up
			
			$uptime_num = $row['uptime'] + 1; //increase the uptime stat by 1
			
			$edit_status_up = "UPDATE websites SET status = 'UP'
			WHERE alias = '$row[alias]'";
			
			$record_uptime = "UPDATE websites SET uptime = '$uptime_num'
			WHERE alias = '$row[alias]'";
			
			$record_status_up = "INSERT INTO status_records (user, URL, status, date, time, timestamp)
			VALUES ('$row[user]', '$row[URL]', 'UP', '$date', '$time', '$timestamp')";
			
			
			if (!mysql_query($edit_status_up, $con)) {
				echo "Could not update status to UP for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
				mysql_error();
			}
			
			else {	
				if (!mysql_query($record_status_up, $con)) {
					echo "Could not record status to UP for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
					mysql_error();
				}
			
				else {
					if (!mysql_query($record_uptime, $con)) {
						echo "Could not increase uptime variable for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
					}
					
					else {
						echo "Site " . $row['alias'] . " is up, and status is set to UP, and record is set." . "<br>";
					}
				}
			
			}//end else from if!mysql query
			
		} //End if VISIT is succesful, the site is down, so start else
	
		else //else the site is down::
		{
			if ($row[status]==DOWN) //If the alert email has been sent previously, do not send again
			{
				echo "$row[user] has already been alerted previously that his site, $row[alias] at $row[URL], had come down. ";
			}	
			
			
			if ($row['rdown']=='yes' && $row[status]!=DOWN) { //if the user has set his settings to recieve email OnDown
				
				$to = "$edata[email], $edata[email2], $edata[email3], $edata[email4]";
				$subject = "SiteSonar.net: One of your sites has come down";
				$headers = "From: checker@SiteSonar.net\r\n";
				$headers .= "Reply-To: checker@SiteSonar.net\r\n";
				$headers .= "Return-Path: checker@SiteSonar.net\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$message = "<html><body>";
				$message .= "This is an alert from SiteSonar.net to notify you that one of your sites, $row[alias], located at $row[URL], has come down on $date, at $time (GMT -5 Eastern Standard Time). Note: No more alerts will be sent until your site gets up and running again. Thank you for using SiteSonar.net. <br>If you do not want to receice these emails, please login to your account and change your settings for your site, $row[alias].";
				$message .= "<br /><br /> <a href=\"http://www.1and1.com/?k_id=19219734\" title=\"1and1 Hosting\" target=\"_blank\">SiteSonar.net uses 1and1's excellent hosting services. Why not see for yourself why 1and1 is the world's number 1 webhost? Click here to get hosting from 1.99 a month!</a>";
				$message .= "</body></html>";
				
				if ( mail($to,$subject,$message,$headers) ) {
				   echo "Mail sent to $row[user] at ($edata[email], $edata[email2], $edata[email3], $edata[email4]) to alert him/her that his/her site $row[alias] ($row[URL]) had come down. ";
				   } 
				   else {
				   echo "ERROR sending email to $edata[email], $edata[email2], $edata[email3], $edata[email4]($row[user]) to alert him/her that his/her site $row[alias] ($row[URL]) had come down.";
				   }
				
			} //close if settings allow the sending of the email
			
			if ($row['rdown'] !='yes' && $row[status]!=DOWN) {
				echo "$row[user] does not want to recieve email OnSiteDown for $row[URL]( $row[rdown] )! ";
			}//close if above
			
			
			//------Edit the status of the person's site in the database to "down"
			
			$downtime_num = $row['downtime'] + 1; //increase the downtime stat by 1
			
			$edit_status_down = "UPDATE websites SET status = 'DOWN'
			WHERE alias = '$row[alias]'";
			
			$record_downtime = "UPDATE websites SET downtime = '$downtime_num'
			WHERE alias = '$row[alias]'";
			
			$record_status_down = "INSERT INTO status_records (user, URL, status, date, time, timestamp)
			VALUES ('$row[user]', '$row[URL]', 'DOWN', '$date', '$time', '$timestamp')";
			
			if (!mysql_query($edit_status_down, $con)) {
				echo "Could not update status to DOWN for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
				mysql_error();
			}
			
			else {	
				if (!mysql_query($record_status_down, $con)) {
					echo "Could not record status to DOWN for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
					mysql_error();
				}
			
				else {
					if (!mysql_query($record_downtime, $con)) {
						echo "Could not increase downtime variable for this site:" . " " . $row['URL'] . " " . $row['alias'] . " " . $row['user'] . "<br>";
					}
					
					else {
						echo "Site " . $row['alias'] . " is DOWN, and status is set to DOWN, and record is set." . "<br>";
					}
				}
			
			}//end else from first if!mysql query
		} //close if(visit = true) element
}//close While element

mysql_close($con);
?>

</body>
<!-- InstanceEnd --></html>