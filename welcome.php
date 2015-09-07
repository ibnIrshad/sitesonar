<?php
include("include/session.php");

if ($session->logged_in) {
	header('Location: /control panel/main.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="include/styles.css" rel="stylesheet" type="text/css" />
<title>SiteSonar.net: Free website monitoring, every 10 minutes.</title>
</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner" align="left">
<div class="topspacer"></div>

<div class="logo"><img src="images/logo.jpg" alt="SiteSonar.net"/></div>
<div><img title="Checks the status of your site 24/7, alerts when it comes down and sends you weekly reports of your site's uptime performance." src="images/topsection.jpg" alt="Checks the status of your site 24/7, alerts when it comes down and sends you weekly reports of your site's uptime performance." width="1000" height="199" /></div>
<div class="controlbox">
  <h1>Welcome to SiteSonar.net, <?php echo "$_GET[user]"; ?></h1>
  <p>You are now a member of SiteSonar.net! To get started on monitoring your sites right away, use the form below. </p>
  <h1 style="text-align:center">Login (with the account that you have just registered)</h1>
  <form action="control panel/process.php" method="POST">
<table align="center" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $_GET['user']; ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>
<font size="2">Remember me next time &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>
<tr><td colspan="2" align="left"><br><font size="2">[<a href="forgotpass.php">Forgot Password?</a>]</font></td><td align="right"></td></tr>
<tr><td colspan="2" align="left"><br>Not registered? <a href="register.php">Sign-Up!</a></td></tr>
</table>
</form>
</p>
</div>
<div class="footer">
  <p>Website designed, owned and operated by Isa Hassen. Co-designer: Faiq Samsudeen. SiteSonar.net was designed as a free website monitoring service, free site monitoring, every 10 min to 1hr. Free web site monitoring, free website monitor, free website monitoring, free website tools. Server monitoring, web site monitoring, website monitor, website monitoring, website monitoring service, website monitoring services, website monitoring software. Website monitoring tool websites monitoring.</p>
</div>
<a title="Clicky Web Analytics" href="http://getclicky.com/29859"><img align="center" alt="Clicky Web Analytics" src="http://static.getclicky.com/media/links/badge.gif" border="0" /></a>

<script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>

<noscript><p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p></noscript>
<script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>
<noscript><p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p></noscript></div></div></body>
</html>