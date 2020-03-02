<?php
 require("configdbconnect.php");
$configuration = $globleConnectDB;
$config['useragent'] = 'CodeIgniter';
$config['protocol'] = 'smtp';
//$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] ="server.costcokart.com";
$config['smtp_user'] = "do-not-reply-nita-fashions-ssl-email-465@costcokart.com";
$config['smtp_pass'] = "stljEdTPmYno";
$config['smtp_port'] = "587";
//$config['smtp_secure'] = "tls";
$config['smtp_timeout'] = 5;
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
$config['charset'] = 'iso-8859-1';
$config['validate'] = FALSE;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = TRUE;
$config['bcc_batch_size'] = 200;

    