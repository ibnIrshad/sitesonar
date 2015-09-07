<?php

include ("header.php"); //connects to database and controls sessions
?>

<html>
<head>
<link href="../include/styles.css" rel="stylesheet" type="text/css" media="screen, tv, projection">
<title>SiteSonar.net: Edit and View Your Account Info</title>

</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner" align="left">
<div class="topspacer"></div>

<div class="logo"><a href="main.php" title="Click to go to our Main Page" target="_top"><img border="0" src="../images/logo.jpg" alt="SiteSonar.net" /></a></div>
<div class="topsection">
  <h1> Your Account Info</h1> 
  <?php if (!$session->logged_in) echo "</div>" ?>
  <?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
?>
  <p>This is where you can view your account settings, and edit them. Thank you for using SiteSonar.net</p><!-- Begin: AdBrite --><div align="center">
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

<div class="columnLeft">
<?php
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
?>

<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !eregi("^([0-9a-z])+$", $req_user) ||
   !$database->usernameTaken($req_user)){
   die("Error in processing request. Please try <a href=\"settings.php?user=$session->username\">clicking here.</a>");
}

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
   echo "<h1>My Account</h1>";
}
/* Visitor not viewing own account */
else{
   echo "<h1>User Info</h1>";
}

/* Display requested user information */
$req_user_info = $database->getUserInfo($req_user);

/* Username */
echo "<b>Username: ".$req_user_info['username']."</b><br>";

/* Email */
echo "<b>Email:</b> ".$req_user_info['email']."<br>";

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcmp($session->username,$req_user) == 0){
   echo "<br><a href=\"settings.php?show=edit\">Edit Account Information</a><br>";
}

/* Link back to main */
echo "<br>Back To [<a href=\"main.php\">Main</a>]<br>";
?>
</div>

<div class="columnCenter">
<?php
/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
   unset($_SESSION['useredit']);
   
   echo "<h1>User Account Edit Success!</h1>";
   echo "<p><b>$session->username</b>, your account has been successfully updated. "
       ."<a href=\"main.php\">Main</a>.</p>";
}
else {
?>

<?php
/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */

?>

<h1>Edit My Account: <?php echo $session->username; ?></h1>
<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Current Password:</td>
<td><input type="password" name="curpass" maxlength="30" value=""></td>
<td><?php echo $form->error("curpass"); ?></td>
</tr>
<tr>
<td>New Password:</td>
<td><input type="password" name="newpass" maxlength="30" value="
<?php echo $form->value("newpass"); ?>"></td>
<td><?php echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="email" maxlength="50" value="
<?php
if($form->value("email") == ""){
   echo $session->userinfo['email'];
}else{
   echo $form->value("email");
}
?>">
</td>
<td><?php echo $form->error("email"); ?></td>
</tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subedit" value="1">
<input type="submit" value="Edit Account"></td></tr>
<tr><td colspan="2" align="left"></td></tr>
</table>
</form>

<?php
echo "<div style=\"clear:both\"><br>Back To [<a href=\"main.php\">Main</a>]<br></div>";
} //end if not edited already
?>
</div>

<div class="columnRight">
<h1>My Settings</h1>
<?php if ($_GET['popup']==save) echo "<p class=\"good\">Settings saved!</p>"; ?>
<form action="settinger.php" method="post" name="editsettings" target="_top" id="editsettings">
<?php
$settings_query = mysql_query("SELECT * FROM users WHERE username = '$session->username'");
$settings = mysql_fetch_array($settings_query);

?>
   <label></label>
   <br>
  <label>
  <input name="rnews" type="checkbox" id="rnews" value="yes" <?php if ($settings['rnews']=='yes') echo "checked"; ?>>
  Receive some cool news from us now and then?<br>
  <br>
  <input  align="middle" type="submit" name="submitBtn" id="submitBtn" value="Save Settings">
  </label>
  <p>To edit the individual settings for each site (such as whether you want to receive emails about that site), go to the main panel and click &quot;Edit Site&quot;.</p>
</form>
</div>
<?php
}// end if not logged in
else {
	header('Location: ../index.php');
}
mysql_close($con);
?>
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