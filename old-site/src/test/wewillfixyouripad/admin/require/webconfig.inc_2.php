<?php
//##################### Start session for all application pages 
session_start(); 

// ----- DATABASE CONNECTION INFORMATION -----
define('SERVER_ADDRESS','localhost');
define('SMTP_SERVER','localhost');
define('MAILER','smtp');
define('MAILTO_BCC','');
define('MAILTO_TITLE','Admin');

/**
 * Database selection to use.
 */

//define('DATABASE','wewillf2_sabritech');
define('DATABASE','wewillfi_wewillfixyouripad');

/**
 * Username to connect the Database.
 */

define('USERNAME','wewillfi_wewillf');

/**
 * Password to Connect Database.
 */

define('PASSWORD','d3f3nd3r');

/**
 * Enter port to Connect Database.
 */

define('PORT','3306');

// ----- WEBSITE DISPLAY INFORMATION -----------------

/**
 * Generated website name for display as title
 */

define('WEBSITE_NAME','We Will Fix Your IPad');
define('WEBSITE_HOST','');

/**
 * generated web site url .
 */

define('WEBSITE_URL','http://wewillfixyouripad.co.uk');

/**
 * website slogon.
 */

define('WEBSITE_SLOGAN','We Will Fix Your IPad');

/**
 * Admin email for the generated website.
 */

define('ADMIN_EMAIL','info@wewillfixyourpc.co.uk');
define('EMAIL_DEFAULT_FROM_NAME','We Will Fix Your IPad Administrator');

/**
 * TimeFormate for generated website.
 */

define('ADMIN_PASSWORD','');

//########## Define server connection error message in case of error while connecting with localhost  asubhani@titledevelopments 29/05/2007

define ("LOGININFO","Please enter Username and Password.");

//########## Define server connection error message in case of error while connecting with localhost  asubhani@titledevelopments 29/05/2007

define ("CONNECTIONERROR","Connection failure");

//########## Define database selection error message in case of error while selecting database asubhani@titledevelopments 29/05/2007

define ("DBSELECTIONERROR","Database selection error");

//########## Define query error messages for database operations  asubhani@titledevelopments 16/07/2007

define ('QUERYERROR',"Unable to execute query .");

//########## Define add display messages for database operations  asubhani@titledevelopments 09/05/2007

define ('ADDMESSAGE',"Record has been added successfully.");

//########## Define update display messages for database operations  asubhani@titledevelopments 09/05/2007

define ('INSERTMESSAGE',"Record has been inserted successfully.");
define ('UPDATEMESSAGE',"Record has been updated successfully.");
define ('STATUSCHANGED',"Status of member has been updated successfully.");
define ('NAME_ALREADY_EXISTS_MESSAGE',"This Username already exists. Please choose a different Username.");
define ('NAME_ALREADY_EXISTS_DOCUMENT',"This Document Title already exists. Please choose a different Document Title.");
define ('LINK_LIMIT_REACHED',"Only eight links can be added.");
define ('SIGNUPMESSAGE',"Your account has been created successfully.<br />Now you can login consortium.");
define ('SIGNUPMESSAGEADMIN',"Account has been created successfully.");
define ('VOUCHERADDMESSAGEADMIN',"Voucher has been created successfully.");
define ('VOUCHERUPDATEMESSAGEADMIN',"Voucher has been updated successfully.");

//########## Define Delete display messages for database operations  asubhani@titledevelopments 09/05/2007

define ('DELETEMESSAGE',"Record has been deleted successfully.");

//########## Define password error message in case of wrong old password asubhani@titledevelopments 09/05/2007

define ('WRONGOLDPASSWORD',"Incorrect old password.");

//########## Define password error message in case of error from password updation asubhani@titledevelopments 09/05/2007

define ('UPDATEPASSWORDERROR',"There was an error in record updation.");

//########## Define password error message in case of error from password updation asubhani@titledevelopments 09/05/2007

define ("LOGINERRORMESSAGE","Please use a valid Username and Password to gain access to the administrator Control Panel.");

//########## Define mail  error message in case failure in sending mail asubhani@titledevelopments 09/05/2007

define ("MAILERRORMESSAGE","Failure in sending e-mail.");

//########## Define mail  error message in case failure in sending mail asubhani@titledevelopments 09/05/2007

define ("MAILSUCCESSRMESSAGE","Mail has been sent successfully.");

//#################### Subcription email message asubhani@titledevelopments 17/07/2007

define ("SUBSCRIPTIONEMAIL","Please check your inbox for a verification message from Title. You will need to click a link listed in this message to activate your subscription.");

//#################### Subcription error message asubhani@titledevelopments 17/07/2007

define ("SUBSCRIPTIONERROR","Unable to subscribed you because email address already exist.");

//#################### Subcription limit for email addresses asubhani@titledevelopments 17/07/2007

define ("SUBSCRIPTIONLIMIT","You are not allowed to subscribed.");

//#################### Subcription limit for email addresses asubhani@titledevelopments 17/07/2007

define ("SUBSCRIPTIONSUCCESS","You are subscribed successfully.");

//####################

define ("ENTERVALIDUSERNAMEPASSWORD","Please enter a valid Username and Password.");
define ("LOGOUTMSG","You have been logged out successfully.");
define ("ACCOUNTDISABLED","Your account has been disabled by administrator.");
define ("DOCUMENTACCESSMSG","Please login first for accessing documents.");
define ('UPDATEPASWORD',"Password has been updated successfully.");
define ('FILE_UPLOAD_ERROR', "Error occurred during file uploading.");

define ('MYDOMAIN',$_SERVER['HTTP_HOST']);
define ('ROOTPATH','http://'.MYDOMAIN.'/'.WEBSITE_HOST.'/');
define ('FCKEDITOR','http://'.MYDOMAIN.WEBSITE_HOST.'/admin/fckeditor/');
#echo FCKEDITOR;
define ('DATEFORMAT', "Y-m-d H:i:s");
//define ('IMAGEMAXLIMIT', 10);
//define ('PDFMAXLIMIT', 8);
?>