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
<title>SiteSonar.net: Free website monitoring,with downtime alerts and uptime statistics &amp; info</title>
<script type="text/javascript">
<!--
function dd_StatusBarMsg(msgStr) { //v1.0 www.dazdezines.com/mme
  window.status=msgStr;
  document.MM_returnValue = true;
}
//-->
</script>
</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner" align="left">
<div class="topspacer"></div>

<div class="logo"><img src="images/logo.jpg" alt="SiteSonar.net"/></div>
<div><img src="http://i152.photobucket.com/albums/s165/hi_tech67/topsection.jpg" alt="Checks the status of your site 24/7, alerts when it comes down and sends you weekly reports of your site's uptime performance." width="1000" height="199" title="Checks the status of your site 24/7, alerts when it comes down and sends you weekly reports of your site's uptime performance." onmouseover="dd_StatusBarMsg('This is basically what SiteSonar.net does.');return document.MM_returnValue" onmouseout="dd_StatusBarMsg('Welcome to SiteSonar.net!')" /></div>
<div class="columnLeft" onmouseout="dd_StatusBarMsg('Welcome to SiteSonar.net!')" onfocus="dd_StatusBarMsg('All our features are listed here!');return document.MM_returnValue">
  <h1>Welcome to SiteSonar.net</h1>
  <p>SiteSonar.net is a 24/7 free website monitoring service which can check your site every 10 minutes to 1 hour. The service is completely free; for extra options you can become a &quot;Premium User&quot;.</p>
  <ul>
    <li>Get an email  when your site goes down</li>
    <li>Get an email when it goes back up</li>
    <li> SMS alert service <strong>(Premium User)</strong></li>
    <li>No link-back required<strong> (Premium User)</strong></li>
    <li>Get regular reports on your site's performance, downtime and uptime statistics.</li>
    <li>Read recent statuses</li>
    <li>See your site's percentage uptime for the past 6 months</li>
    <li>No  limit on the number of websites monitored</li>
  </ul>
</div>
<div class="columnCenter">
  <h1>Register</h1>
  <p>Register now to recieve our free service!</p>
  <?php if ($_GET['show']=="regform") {?>
  <form action="control panel/process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"></td><td><?php echo $form->error("email"); ?></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subjoin" value="1">
<input type="submit" value="Join!"></td></tr>
</table>
</form>
<?php echo $_GET['error']; ?>
<?php } else { ?>
<a class="accountFunctions" href="index.php?show=regform"><img src="images/register_btn.jpg" alt="Register Now!" width="150" height="50" onmouseover="dd_StatusBarMsg('Register for your own good!');return document.MM_returnValue" onmouseout="dd_StatusBarMsg('Welcome to SiteSonar.net')" /></a>
<?php } ?>
</div>
<div class="columnRight">
  <h1>Login</h1>
  <?php if ($_GET['show']=="regform") {?>
  <p>You must first register (using the form on the left). Already registered? Click <a href="index.php" title="Click here to login" target="_top">here to login.</a></p>
  <?php } else { ?>
  <form action="control panel/process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"></td><td><?php echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"></td><td><?php echo $form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>
<font size="2">Remember me next time &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>
<tr><td colspan="2" align="left"><br><font size="2">[<a href="forgotpass.php">Forgot Password?</a>]</font></td><td align="right"></td></tr>
<tr><td colspan="2" align="left"><br>
  Not registered? Sign using the button on the left<a href="register.php">!</a></td>
</tr>
</table>
</form>
<?php } ?>
</div>
<div class="footer">
  <p>Website designed, owned and operated by Isa Hassen. Co-designer: Faiq Samsudeen. SiteSonar.net was designed as a free website monitoring service, free site monitoring, every 10 min to 1hr. Free web site monitoring, free website monitor, free website monitoring, free website tools. Server monitoring, web site monitoring, website monitor, website monitoring, website monitoring service, website monitoring services, website monitoring software. Website monitoring tool websites monitoring.</p>
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