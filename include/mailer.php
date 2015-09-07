<?php 
/**
 * Mailer.php
 *
 * The Mailer class is meant to simplify the task of sending
 * emails to users. Note: this email system will not work
 * if your server is not setup to send mail.
 *
 * If you are running Windows and want a mail server, check
 * out this website to see a list of freeware programs:
 * <http://www.snapfiles.com/freeware/server/fwmailserver.html>
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 19, 2004
 */
 
class Mailer
{
   /**
    * sendWelcome - Sends a welcome message to the newly
    * registered user, also supplying the username and
    * password.
    */
   function sendWelcome($user, $email, $pass){
      $from = "From: SiteSonar <admin@sitesonar.net>";
      $subject = "SiteSonar.net - Welcome!";
      $body = $user.",\n\n"
             ."Welcome! You've just registered at SiteSonar.net "
             ."with the following information:\n\n"
             ."Username: ".$user."\n"
             ."Password: ".$pass."\n\n"
             ."If you ever lose or forget your password, a new "
             ."password will be generated for you and sent to this "
             ."email address, if you would like to change your "
             ."email address you can do so by going to the "
             ."My Account page after signing in.\n\n"
             ."- Admin at SiteSonar.net";

      return mail($email,$subject,$body,$from);
   }
   
   /**
    * sendNewPass - Sends the newly generated password
    * to the user's email address that was specified at
    * sign-up.
    */
   function sendNewPass($user, $email, $pass){
      $from = "From: SiteSonar <admin@sitesonar.net>";
      $subject = "SiteSonar.net - Your new password";
      $body = $user.",\n\n"
             ."We've generated a new password for you at your "
             ."request, you can use this new password with your "
             ."username to log in to SiteSonar.net.\n\n"
             ."Username: ".$user."\n"
             ."New Password: ".$pass."\n\n"
             ."It is recommended that you change your password "
             ."to something that is easier to remember, which "
             ."can be done by going to the My Account page "
             ."after signing in.\n\n"
             ."- Admin at SiteSonar.net";
             
      return mail($email,$subject,$body,$from);
   }
   
   function sendDownAlert($usersEmail, $usersSite, $usersUrl) {
   					$to = "$usersemail";
					$subject = "SiteSonar.net: One of your sites has come down";
					$headers = "From: checker@SiteSonar.net\r\n";
					$headers .= "Reply-To: checker@SiteSonar.net\r\n";
					$headers .= "Return-Path: checker@SiteSonar.net\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
					$message = "<html><body>";
					$message .= "This is an alert from SiteSonar.net to notify you that one of your sites, $usersSite, located at $usersUrl, has come down on $date, at $time (GMT -5 Eastern Standard Time). Note: No more alerts will be sent until your site gets up and running again. Thank you for using SiteSonar.net.";
					$message .= "<br /> <a href=\"http://www.1and1.com/?k_id=19219734\" title=\"1and1 Hosting\" target=\"_blank\">SiteSonar.net uses 1and1's excellent hosting services. Why not see for yourself why 1and1 is the world's number 1 webhost? Click here to get hosting from 1.99 a month!</a>";
					$message .= "</body></html>";
   }
};

/* Initialize mailer object */
$mailer = new Mailer;
 
?>
