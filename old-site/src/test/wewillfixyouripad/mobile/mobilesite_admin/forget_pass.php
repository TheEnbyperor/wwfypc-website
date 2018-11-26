<?php
include ("db_connection.php");

$result = mysql_query ("SELECT * FROM content ");
					
$existCount = mysql_num_rows($result); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
	 exit();
} else
{

}

while ($row = mysql_fetch_array ($result)){

	$username = $row ['username'];

}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mobile Admin Panel</title>
<style type="text/css">body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
body {
	background-color: #f4f4f4;
	}
a:link {
	color: #0000FF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #0000FF;
}
#content{
	width:900px;
	margin-left:auto;
	margin-right:auto;
	margin-top:10px;
	padding:10px;
	border:1px solid #0000CC;
}
</style>
<script type="text/javascript">
function validate_email(field,alerttxt)
{
with (field)
  {
  apos=value.indexOf("@");
  dotpos=value.lastIndexOf(".");
  if (apos<1||dotpos-apos<2)
    {alert(alerttxt);return false;}
  else {return true;}
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_email(email,"Not a valid e-mail address!")==false)
    {email.focus();return false;}
  }
}
</script>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validate_form(thisform)
{
with (thisform)
  {
   
  if (validate_email(email,"Not a valid e-mail address!")==false)
    {email.focus();return false;}
	
  if (validate_required(password,"Password must be filled out!")==false)
  {
  password.focus();return false;}
  
   if (validate_required( intro_acc_id," Introducer Account ID must be filled out!")==false)
  {
   intro_acc_id.focus();return false;}
    if (validate_required( intro_mobile,"Introducer Mobile Number  must be filled out!")==false)
  {
   intro_mobile.focus();return false;}
    if (validate_required( intro_with_relation," Relation with Introducer must be filled out!")==false)
  {
   intro_with_relation.focus();return false;}
 
  
  
  
  
  
  if (validate_required(intro_mobile,"Mobile Number must be filled out!")==false)
  {
  intro_mobile.focus();return false;}
  
  if (validate_required(account_type," Account Type must be filled out!")==false)
  {
  account_type.focus();return false;}
  
  if (validate_required( declaration_account," Account Declaration must be filled out!")==false)
  {
   declaration_account.focus();return false;}
   
   if (validate_required( member_family_name,"Family Name  must be filled out!")==false)
  {
   member_family_name.focus();return false;}
   
   if (validate_required( member_first_name," Member First Name must be filled out!")==false)
  {
   member_first_name.focus();return false;}
   
   if (validate_required( member_DOB," Member Date of Birth  must be filled out!")==false)
  {
   member_DOB.focus();return false;}
   
   if (validate_required(member_father_name ," Member Father's Name must be filled out!")==false)
  {
   member_father_name.focus();return false;}
   
   if (validate_required( member_permanent_add,"Member Parmenent Address  must be filled out!")==false)
  {
   member_permanent_add.focus();return false;}
   
   if (validate_required( member_occupation,"Member Occupation  must be filled out!")==false)
  {
   member_occupation.focus();return false;}
   
   if (validate_required(member_mobile ,"Member Mobile Number  must be filled out!")==false)
  {
   member_mobile.focus();return false;}
   
   if (validate_required( member_email," Member Email Address must be filled out!")==false)
  {
   member_email.focus();return false;}
   
   if (validate_required( member_sex," Member Sex must be filled out!")==false)
  {
   member_sex.focus();return false;}
   
   if (validate_required( nominee_name,"Nominee Name  must be filled out!")==false)
  {
   nominee_name.focus();return false;}
   
   if (validate_required(nominee_fathers_name ," Nominee Father's Name must be filled out!")==false)
  {
   nominee_fathers_name.focus();return false;}
   
   if (validate_required( nominee_permanent_add,"Nominee Permanent Address  must be filled out!")==false)
  {
   nominee_permanent_add.focus();return false;}
   
   if (validate_required( nominee_with_relation," Relation with Nominee  must be filled out!")==false)
  {
   nominee_with_relation.focus();return false;}
   
  
   
  
  
  if ( ( thisform.payment[0].checked == false ) && ( thisform.payment[1].checked == false ) ) { alert ( "Please choose your Payment Method: Bank Deposit or Credit Card" ); return false; }
  
 
  
  }
}
</script>
</head>

<body>

	<div id="content" style="width:500px;">
    
    <table width="500" border="0">
  <tr>
    <td><h2>Mobile Admin Panel</h2></td>
    <td><h5 align="right"><a href="index.php">Login page</a></h5></td>
  </tr>
</table>

     <br />
    	<form id="form" method="post" action="pass_update.php" onSubmit="return validate_form(this)">
        <fieldset>
        	<br />
            <table width="480" border="0">
  <tr >
    <td colspan="2"><strong style="color:#FF0000;">Change username and password:</strong></td>
    
  </tr>
  <tr bgcolor="#999">
    <td>Username:</td>
    <td> <input type="text" name="username" value="<?php echo $username;?>" /> </td>
  </tr>
  <tr bgcolor="#999">
    <td>Password:</td>
    <td><input type="password" name="password" /> </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit"  value="Change" style="border:1px solid #CCCCCC; color:#666666;"/></td>
  </tr>
</table>

             
             
        </fieldset>
        
        </form>
    </div>



</body>
</html>


   