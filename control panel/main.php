<?php
/**
 * Main.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
include ("header.php"); //connects to database and controls sessions
?>

<html>
<head>
<title>SiteSonar.net: Free Website Monitoring every 10 minutes</title>
<link href="../include/styles.css" rel="stylesheet" type="text/css" media="screen, tv, projection">
</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner">
    <div class="topspacer"></div>
    <div class="logo"><a href="main.php" title="Click to go to our Main Page" target="_top" ><img border="0" src="../images/logo.jpg" alt="SiteSonar.net" /></a></div>
    <div class="topsection"><h1>Welcome to your Control Panel </h1> <?php if (!$session->logged_in) echo "You are not logged in! Please go to our main page to login. This page is used by our users to see their sites being monitored and other info. <a href=\"../index.php\" title=\"Free website monitoring\" target=\"_top\">Sign up or login</a> to find out more! </div>"; ?>
      <p><?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
?></p>
      <p>This is where you can manage your site's which are being monitored by the SiteSonar.net system. Add a site by using the &quot;Add A Site&quot; form at the bottom. Delete and edit sites using the links right beside the site's name and URL, located in the &quot;Manage Sites&quot; box. Thank you for using SiteSonar.net</p><!-- Begin: AdBrite --><div align="center">
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
      <h3>Manage Sites</h3>
      <p> 
        <?php $mng_site_list = mysql_query("SELECT * FROM websites WHERE USER='$session->username'"); //Select the websites registered to the user
if (mysql_num_rows($mng_site_list) == 0) echo "You have not registered any sites yet :( &nbsp;&nbsp; Why not start by using the form below?"; 
else {?>
      <table>
        <tr><th align="left">Name</th><th align="left">URL</th><th align="center">Status</th><th align="center"></th></tr>
        <?php //All the sites that the user has registered for monitoring are listed here. 


while($row = mysql_fetch_array($mng_site_list))
{
	echo "<tr>";
	echo "<td>" . $row['alias'] . "</td><td>" . $row['URL'] . "</td>";
	echo "<td align='center'>";
	
	//Echo's status icon
		if ( $row['status']=="UP" )
			{
			echo '<img src="../images/green-light.jpg" title="Your site is UP!">';
			}
		
		else
			{
			echo '<img src="../images/red-light.jpg" title="Your site is down currently.">';
			}
		
	echo "</td><td align='center'>(checked every " . $row['checkinterval'] . ")</td>";
	echo "<td>" . '<a href="/control panel/editsite.php?site=' . $row['alias'] . '&url=' . $row['URL'] . '&interval=' . $row['checkinterval'] . '&rdown=' . $row['rdown'] . '&rup=' . $row['rup'] . '" title="Edit this site" target="_top">Edit</a>' . "</td>";
	
	echo "<td>" . "<a href='/control panel/deletesite.php?site=$row[alias]&sure=no' title='Delete this site' target='_top'>Delete</a>" . "</td>";
	echo "</tr>";

} //end while loop
?>
      </table>
      <?php } // close if no sites are registered's else ?>
      </p>
      </div>
    <div class="controlbox">
      <h3>Add A Site</h3>
      
<form action="addsite.php" method="post" name="addsite" target="_top" id="addsite">
  <label>Site URL
    <input name="url_submit" type="text" id="url_submit" tabindex="1" value="http://" maxlength="75" />
    </label>
  (must be full URL, including &quot;http://www.&quot;)<br />
  <label>Site Name
    <input name="sitename_submit" type="text" id="sitename_submit" maxlength="10" />
    </label>
  (the site will be referred to by this name)<br />
  <label>How often should this site be checked?</label>
  <select name="interval_submit" id="interval_submit">
    <option value="error1" selected>&lt;Select Time Interval&gt;</option>
    <option value="5min">Every 5 Min (premium)</option>
    <option value="10min">Every 10 min (premium)</option>
    <option value="15min">Every 15 min</option>
    <option value="20min">Every 20 min</option>
    <option value="30min">Every 30 min</option>
    <option value="45min">Every 45 min</option>
    <option value="1hr">Every hour</option>
    </select>
  (every 20min is recommended)<br>
  <label>
    <input name="rdown" type="checkbox" id="rdown" value="yes" checked>
    Do you want to receive an email if this site goes down?</label>
  <br>
  <label>
    <input name="rup" type="checkbox" id="rup" value="yes" checked>
    Do you want to receive an email if this site comes back up (after it has gone down)?</label>
  <br />
  <input type="submit" name="submit" id="addsite" value="Add Site" />
  </form>
        </div>
    <?php 
}
else{//if the user is NOT logged in...
	echo "<a href=\"../index.php\" title=\"Free website monitoring\" target=\"_top\">Click here</a> to login or sign up.";
}
//Close My SQL connection
mysql_close($con);
?>
    
    </td>
    </tr>
    </table>
    <div class="footer">
      <p>Website designed, owned and operated by Isa Hassen. Co-designer: Faiq Samsudeen. SiteSonar.net was designed as a free website monitoring service, free site monitoring, every 10 min to 1hr.</p>
      </div>
    <SCRIPT type="text/javascript">
<!-- Beginning of JavaScript -
<?php 
if ($_SESSION['popup']=="site_edit_success")
{
	unset($_SESSION['popup']);
	echo "alert ('Your site details were edited! :)')";
}

if ($_SESSION['popup']=="site_delete_success")
{
	unset($_SESSION['popup']);	
	echo "alert ('Your site was deleted! :(')";
}

if ($_SESSION['popup']=="site_add_success")
{
	unset($_SESSION['popup']);	
	echo "alert ('Your site was succesfully added! :(')";
}

if ($_SESSION['popup']=="not_premium")
{
	unset($_SESSION['popup']);	
	echo "alert ('You cannot set your site to be monitored every 10 minutes or every 5 minutes unless you are a premium user! To become one, goto the Premium User Options page. Site not added.')";
}
?>
// - End of JavaScript - -->
  </SCRIPT>
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
