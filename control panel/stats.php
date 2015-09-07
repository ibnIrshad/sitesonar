<?php

include ("header.php"); //connects to database and controls sessions
?>

<html>
<head>
<title>SiteSonar.net: Your Site's Statistics</title>
<link href="../include/styles.css" rel="stylesheet" type="text/css" media="screen, tv, projection">
<script type="text/javascript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner" align="left">
<div class="topspacer"></div>

<div class="logo"><a href="main.php" title="Click to go to our Main Page" target="_top" ><img border="0" src="../images/logo.jpg" alt="SiteSonar.net" /></a></div>
<div class="topsection">
  <h1> Your Site's Statistics</h1> 
  <?php if (!$session->logged_in) echo "You are not logged in! If you were, you could see various statistics about the sites that you have monitored. <a href=\"../index.php\" title=\"Free website monitoring\" target=\"_top\">Click here</a> to sign in or sign up!</div>" ?>
  <?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
?>
  <p>This is where you can view your site's statistics, such as uptime percentage and recent statuses. Thank you for using SiteSonar.net</p>
  <!-- Begin: AdBrite --><div align="center">
<script type="text/javascript">
   var AdBrite_Title_Color = 'FBCD49';
   var AdBrite_Text_Color = 'FFFFFF';
   var AdBrite_Background_Color = '3A82B5';
   var AdBrite_Border_Color = '4DB5F1';
   var AdBrite_URL_Color = '00F100';
</script>
<span style="white-space:nowrap;"><script src="http://ads.adbrite.com/mb/text_group.php?sid=793281&zs=3732385f3930" type="text/javascript"></script><!--
--><a target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=793281&afsid=1"><img src="http://files.adbrite.com/mb/images/adbrite-your-ad-here-leaderboard.gif" style="background-color:#FFFFFF;border:none;padding:0;margin:0;" alt="Your Ad Here" width="14" height="90" border="0" /></a></span>
</div><!-- End: AdBrite -->
</div>
<div class="nav">
  <?php
echo "<a class='accountFunctions' href=\"main.php\">Main Control Panel</a> &nbsp;&nbsp; | &nbsp;&nbsp;"
       ."<a class='accountFunctions' href=\"settings.php?user=$session->username\">Edit My Account & Settings</a> &nbsp;&nbsp; | &nbsp;&nbsp;";

   if($session->isAdmin()){
      echo "<a class='accountFunctions' href=\"../admin/admin.php\">Admin Center</a> &nbsp;&nbsp; | &nbsp;&nbsp;";
   } echo "<a class='accountFunctions' href=\"stats.php\">Site Reports & Statistics</a>&nbsp;&nbsp; | &nbsp;&nbsp;";
   	echo "<a class='accountFunctions' href=\"premium.php\">Premium User Options</a>&nbsp;&nbsp; | &nbsp;&nbsp;";
	echo "<a class='accountFunctions' href=\"process.php\">Logout</a>";
?>
  <br>
</div>
<div class="controlbox">
<h3>Stats </h3>
<form name="alias_stats" method="get" action="">
  <label>For which site would you like to see your stats?:
  <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,0)">
    <option value="stats.php" selected> - Select A Site -</option>
    <?php 
	$select_sites = mysql_query("SELECT * FROM websites WHERE user = '$session->username'", $con);
	
	if (!$select_sites) {
		echo "Error! Could not get sites for $session->username. If this problem persists, please try logging out and back in, then pressing Ctrl + F5.";
	}
	
	else {
		while ($row = mysql_fetch_array($select_sites))
		{
		echo "<option ";
		
		if ($_GET['show']==$row['alias']) {
			echo "selected=\"selected\"";
		}
		
		echo "value=\"stats.php?show=" . $row['alias'] . "&url=" . $row['URL'] . "\">" . $row['alias'] . "</option>";
		
		} //close while element
	}//close else from !if select sites
	?>
    </select>
  </label>
</form>

<?php 
if (isset($_GET['show'])) {

	$site = $_GET['show'];
	$url = $_GET['url'];
	
	$select_site = mysql_query("SELECT * FROM websites WHERE user = '$session->username' AND alias = '$site'", $con);
		
	$select_statuses = mysql_query("SELECT * FROM status_records WHERE user = '$session->username' AND URL = '$url' ORDER BY timestamp DESC", $con);
	
	$data = mysql_fetch_array($select_site);
	
	$uptime_percentage = round($data['uptime'] / ($data['uptime'] + $data['downtime']) * 100, 2);

	echo "<div class=\"columnLeft\">";
	
	echo "<h2>Uptime Percentage for " . $site . ":</h2>";
	
	if ($uptime_percentage > 90) {
		echo "<font class=\"good\">"; 
	}
	
	else {
		if ($uptime_percentage > 75) {echo "<font class=\"ok\">"; }
	}
	
	if ($uptime_percentage < 75) echo "<font class=\"bad\">";
	
	echo $uptime_percentage . "%</font><br><br>This site is checked every " . $data['checkinterval'] . ". To change this site's settings, go to your main control panel. <br><br> Number of good accesses for this site (since it was registered): $data[uptime] <br> Number of bad acceses: $data[downtime]</div>";	
?>
<div class="columnCenter" id="recentStatuses">
<h2>Recent Statuses of <?php echo $site; ?>:</h2>
<div class="statuses"><table align="center" class="recStatuses">
<?php
	while ($sdata = mysql_fetch_array($select_statuses)) {
		
		echo "<tr class=";
		
		if ($sdata['status']=="UP") {
			echo "goodStatus>";
		}
		
		else {
			echo "badStatus>";
		}
		
		echo "<td class=\"recStatuses\">" . $sdata['date'] . "</td><td class=\"recStatuses\">" . $sdata['time'] . "</td><td class=\"recStatuses\">" . $sdata['status'] . "</td>";
		echo "</tr>";
		
	}// end while loop
?>
</table></div></div>

<?php
}
else { //if the variable "show" is not set
	echo "I can't display your statistics unless you choose a site! Use the drop-down box above.";
}

?>
</div>
<?php 
}
else{
	header('Location: ../index.php');
}
//Close My SQL connection
mysql_close($con);
?>
<div class="columnRight" id="stats">
<a href="http://www.1and1.com/?k_id=19219734" target="_blank"><img src="http://banner.1and1.com/xml/banner?size=5%26%number=1" width="140" height="28" alt="Banner"  border="0"/></a>
</div>
<div class="footer">
  <p>Website designed, owned and operated by Isa Hassen. Co-designer: Faiq Samsudeen. SiteSonar.net was designed as a free website monitoring service, free site monitoring, every 10 min to 1hr.</p>
</div>
<div align="center"><a title="Clicky Web Analytics" href="http://getclicky.com/29859"><img align="center" alt="Clicky Web Analytics" src="http://static.getclicky.com/media/links/badge.gif" border="0" /></a>
  
  <script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>
  
  <noscript>
  <p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p>
  </noscript>
  <script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>
  <noscript>
  <p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p>
  </noscript>
</div>
</div>
</div>
</body>
</html>
